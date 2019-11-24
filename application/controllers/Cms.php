<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cms extends CI_Controller {

	
    public function __construct()
    {
        parent::__construct();
        $this->load->model('account_model');
        $this->load->model('configuration_model');
    }
    
    public function index()
    {
        $user_profile_id = $this->account_model->get_user_profile_id_by_email($this->session->userdata('logged_email'));

        $header_data['profile_image_url']='';
        if( strcasecmp(get_user_type(),'candidate') == 0)
        {
          $image_name = $this->account_model->get_candidate_profile_url_by_user_profile_id($user_profile_id);  
          $header_data['profile_image_url'] = base_url().'uploads/candidate_profiles/'.$image_name;
        }

        $data['jobs'] = $this->account_model->get_job_profiles(1,'DESC',3,0);   
        $data['companies'] = $this->account_model->get_companies(1,'DESC',3,0);
        $data['industries'] = $this->configuration_model->get_all_records('industry');
        $data['countries'] = $this->configuration_model->get_all_records('country');
        $data['current_poll'] = $this->account_model->getCurrentPoll($user_profile_id);
        $data['polls'] = $this->account_model->get_polls();
        
        $this->load->view('header',$header_data);
        $this->load->view('index', $data);
        $this->load->view('footer');
    }

    public function login()
    {
        $data['title_header'] = 'Login';

        $this->load->view('login/header', $data);
        $this->load->view('login/user-login');
        $this->load->view('login/footer');
    }

    public function register()
    {
        $data['title_header'] = 'Register';

        $this->load->view('login/header', $data);
        $this->load->view('login/user-register');
        $this->load->view('login/footer');
    }

    public function forgot_password()
    {
        $data['title_header'] = 'Forget password';

        $this->load->view('login/header', $data);
        $this->load->view('login/user-forget-pass');
        $this->load->view('login/footer');
    }

    public function job_list_1()
    {
        $this->load->view('header');
        $this->load->view('job-list-1');
        $this->load->view('footer');
    }

    public function job_detail()
    {
        $this->load->view('header');
        $this->load->view('job_detail');
        $this->load->view('footer');
    }
    public function about()
    {
        $this->load->view('header');
        $this->load->view('about');
        $this->load->view('footer');
    }
    public function recruitment_outsourcing()
    {
        $this->load->view('header');
        $this->load->view('recruitment_outsourcing');
        $this->load->view('footer');
    }
    public function recruitment_portal()
    {
        $this->load->view('header');
        $this->load->view('recruitment_portal');
        $this->load->view('footer');
    }
    public function recruitment_consultancy()
    {
        $this->load->view('header');
        $this->load->view('recruitment_consultancy');
        $this->load->view('footer');
    }
    public function terms_conditions()
    {
        $this->load->view('header');
        $this->load->view('terms_conditions');
        $this->load->view('footer');
    }
    public function privacy_policy()
    {
        $this->load->view('header');
        $this->load->view('privacy_policy');
        $this->load->view('footer');
    }
    public function contact()
    {
        $this->load->view('header');
        $this->load->view('contact');
        $this->load->view('footer');
    }

    public function submit_contact_us()
    {
        $contact_data = array(
                'name' =>$this->input->post('name'),
                'email' =>$this->input->post('email'),
                'mobile' =>$this->input->post('mobile'),
                'country_id' =>$this->input->post('country'),
                'request_type' =>$this->input->post('request_type'),
                'message' => $this->input->post('message',true),
        );
        //print_r($contact_data);exit;
        $this->account_model->insert_data($contact_data,'contact_email_id','contact_email');
        $contact_data['subject'] = $contact_data['request_type'];
        $contact_data['from_email'] = $contact_data['email'];
        $contact_data['from_email_title'] = $contact_data['name'];
        $contact_data['to_email'] = 'info@recruitment-ally.com';
        $contact_data['country'] = $this->configuration_model->get_value_by_id('country','country','country_id',$contact_data['country_id']);
        $this->send_email($contact_data,'contact_email');
        $this->session->set_flashdata('email_sent', 'true');
        redirect(base_url().'contact?#contact_form','refresh');
    } 

    private function send_email($email_data,$template_name)
    {
        $this->load->library('email');
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
        $this->email->initialize($config);

        $data = $email_data;
        $this->email->from($data['from_email'], $data['from_email_title']);
        $this->email->to($data['to_email']); 
        //$this->email->cc('another@another-example.com'); 
        $this->email->bcc('nifalm@gmail.com'); 

        $this->email->subject($data['subject']);
        $this->email->message($this->load->view('/templates/'.$template_name,$data,true));	

        $this->email->send();
    }

    public function submit_poll_feedback()
    {
        $user_profile_id = $this->account_model->get_user_profile_id_by_email($this->session->userdata('logged_email'));
        if($user_profile_id > 0)
        {
            $poll_id = $this->input->post('poll_id');
            $is_user_answered = $this->account_model->is_poll_answered($poll_id,$user_profile_id);
            if($is_user_answered == 0)
            {
                if(isset($poll_id))
                {
                    $poll_option_id = $this->input->post('poll_option');

                    $poll_data = array(
                            'poll_option_id' =>$poll_option_id,
                            'user_profile_id' =>$user_profile_id,
                    );
                    $this->account_model->insert_data($poll_data,'poll_choice_id','poll_choice');
                    set_message('Thank You for your interest in the poll.','alert-success');
                }
                else
                {
                    set_message('Something went wrong. Please re-submit','alert-warning');
                }
            }
            else
            {
                set_message('You have already answered this poll','alert-info');
            }
        }
        else
        {
            set_message('Please login and submit poll','alert-danger');
        }

        $return_message = array(
            'message' => '',
            'error_code' => '0',
            'redirect' => base_url(),
    );

        // redirect(base_url(),'refresh');
        header('Content-Type: application/json');
            echo json_encode($return_message);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */