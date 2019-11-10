<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Author: NIFAL MUNZIR
*/
class Account extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('account_model');
        $this->load->model('configuration_model');
    }

    public function login($param = '',$return_url='')
    {
        $return_url = str_replace('_','/', $return_url);
        if($param == 'validate')
        {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $remember_me = $this->input->post('remember_me');
            $password = md5($password);
            
            $return_message = array();
            if(!empty($email) && !empty($password))
            {

                $login_data = array(
                    'email' => $email,
                    'password' => $password
                );
//print_r($login_data);exit; 
                $login_info = $this->account_model->get_login($login_data);
                //print_r($login_info);exit; 

                //print_r($user_type);exit; 
                if(empty($login_info)) //|| strtolower($login_info->method) != 'direct'
                {
                    $return_message= array(
                            'message' => 'Incorrect Username or Password',
                            'error_code' => '1'
                    );
                }
                elseif ($login_info->is_active == false || $login_info->is_deleted == true) {
                    $return_message= array(
                            'message' => 'You account hasn\'t been activated yet',
                            'error_code' => '1'
                    );
                }
                else
                {
                    $user_type = $this->account_model->get_user_type_by_type_id($login_info->user_type_id);
                    $user_type = strtolower($user_type);
                    //$profile_data = $this->account_model->get_user_by_id($login_info->user_profile_id);
                  // write code to count rows and if count 0 set flash session data and redirect them to login page
                    
                    if($remember_me)
                        $this->session->sess_expiration = '172800'; // this expire the session in 2 days. the default is 7200
                    $user_profile_id = $this->account_model->get_user_profile_id_by_email($email);
                    $name = 'Development';
                    
                    if($user_type == 'candidate' || $user_type == 'employer')
                        $name = $this->account_model->get_name_by_user_profile_id_and_type($user_profile_id,$user_type);
                    $session_data = array(
                        'email'     => $email,
                        'name' => $name,
                        'logged_user_type' =>$user_type,
                    );
                    
                    if($user_type == 'administrator')
                    {
                        $session_data['is_admin'] = 0;
                        $session_data['logged_user_type'] = ADMIN_PATH_NAME;
                    }
                    
                    set_user_session('',$session_data);

                    if(isset($session_data['is_admin']))
                    {
                        set_message('You have been successfully logged in as an Administrator! ','alert-success');
                    }
                    else
                        set_message('You have been successfully logged in! ','alert-success');
                    
                    $return_message = array(
                            'message' => '',
                            'error_code' => '0',
                            'redirect' => base_url().$return_url,
                    );
                    
                    $last_logged_data = array(
                            'ip_address' => $this->input->ip_address(),
                            'login_id' => $login_info->login_id,
                    );
                    
                    $this->account_model->update_last_logged_in($last_logged_data);
                }
            }
            else
            {
                $return_message= array(
                        'message' => 'Username and/or Password cannot be blank',
                        'error_code' => '1'
                );
            }
            
            header('Content-Type: application/json');
            echo json_encode($return_message);
        }
        else
        {
            $user_profile_id = $this->session->userdata('user_profile_id');
            if(isset($user_profile_id))
            {
                set_message('You are already logged in! ','alert-warning');	
                keep_flashmessage();
                redirect(base_url(),'refresh');
            }
            $data['title_header'] = 'Login';

            $this->load->view('login/header', $data);
            $this->load->view('login/user-login');
            $this->load->view('login/footer');
        }
    }

    public function logout()
    {
        $this->session->userdata = array();	   
        //$this->session->sess_destroy();

        set_message('You have been successfully logged out! ','alert-success');
        //print_r($this->session->tempdata());exit;
        //keep_flashmessage();
        redirect(base_url(),'refresh'); 

    } 

    public function register($user_type)
    {
        $user_type = strtolower($user_type);
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $agree_to_terms = $this->input->post('agree_to_terms');
        //print $agree_to_terms;exit;
        $name = '';
        $register_data = array();
        if($this->account_model->is_user_exist(array('email'=>$email)) == 0)
        {
            if($user_type == 'candidate')
            {
                $register_data = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                );
                $name = $register_data['first_name'].' '.$register_data['last_name'];
            }
            elseif($user_type == 'employer')
            {
                $register_data = array(
                    'name' => $this->input->post('company_name'),
                    'owner' => $this->input->post('owners_name'),
                );
                $name = $register_data['name'];
            }
            $user_type_id = $this->account_model->get_user_type_id_by_type(ucfirst($user_type));
            $login_data = array(
                'email' => strtolower($email),
                'password'=> md5($password),
                'user_type_id' =>$user_type_id,
            );
            //array_push($register_data,$login_data);
            if(((!empty($register_data['name']) && !empty($register_data['owner'])) || (!empty($register_data['first_name']) && !empty($register_data['last_name']))) && !empty($email) && !empty($password) && isset($agree_to_terms))
            {
                if($user_type == 'candidate')
                    $login_data['registration_code'] = md5($login_data['email']);
                $login_id = $this->account_model->insert_data($login_data,'login_id','login');
                $user_profile_data = array(
                    'login_id' => $login_id
                );
                $user_profile_id = $this->account_model->insert_data($user_profile_data,'user_profile_id','user_profile');
                $register_data['user_profile_id'] = $user_profile_id;
                $main_table_name = 'candidate_profile';
                if($user_type == 'employer')
                {
                    $main_table_name = 'company_profile';
                }
                $this->account_model->insert_data($register_data,$main_table_name.'_id',$main_table_name);
                if($user_type == 'candidate')
                    $login_data['registered_name'] =  $register_data['first_name'].' '.$register_data['last_name'];
                else
                {
                    $login_data['registered_name'] = $register_data['name'];
                }

                $login_data['subject'] = 'Thank You For Signing Up';
                $login_data['from_email'] = 'recruitment@recruitment-ally.com';
                $login_data['from_email_title'] = 'RecruitmentAlly';
                $login_data['to_email'] = $login_data['email'];
                $login_data['type'] = 'registration';
                $login_data['user_type'] = $user_type;

                //if($user_type == 'candidate')
                //	set_user_session('',array('email'=>$email,'name'=>$name,'logged_user_type'=>$user_type));
                //redirect(base_url());
                $this->send_email($login_data,'email_verification');
                print json_encode(array('message'=>'Registration Successful','email'=>$email,'error_code'=>'0'));
                exit;
            }
            else
            {
                    print json_encode(array('message'=>'Please complete all fields accurately','email'=>$email,'error_code'=>'1'));
                    exit;
            }
            //$this->account_model->insert_user_profile($register)
        }
        else
        {
            print json_encode(array('message'=>'The entered email already has already been registered','error_code'=>'1'));
            exit;
        }
    }

    public function reset_password()
    {
            $email = $this->input->post('reset_email');
            if(isset($email))
            {
                $code = md5($email.date('H:i:s'));
                    //print($code);exit;
                    $this->account_model->set_forgot_password_code($code,$email);
                    $mail_data['subject'] = 'Reset Password Confirmation';
                    $mail_data['from_email'] = 'recruitment@recruitment-ally.com';
                    $mail_data['from_email_title'] = 'RecruitmentAlly';
                    $mail_data['to_email'] = $email;
                    $mail_data['type'] = 'reset_password';
                    $mail_data['code'] = $code; 

                $this->send_email($mail_data,'email_verification');
                    print 1;exit;
            }
            else
            { 
                    set_message('Please check your email address','alert-danger');
                    return false;
            }

    }
	
    //reset_password_confirmation
    public function reset_password_confirmation()
    {
       $code = $this->uri->segment(3);
       $login_id = $this->account_model->get_login_id_by_code($code,'reset_password');
       if($login_id != 0)
       {
                    $data['reset_password_code'] = $code;
                    $data['jobs'] = $this->account_model->get_job_profiles(1,'DESC',3,0);
                    $data['companies'] = $this->account_model->get_companies(1,'DESC',3,0);	
                    $data['industries'] = $this->configuration_model->get_all_records('industry');
                    $data['countries'] = $this->configuration_model->get_all_records('country');
                    $data['experience_levels'] = $this->configuration_model->get_all_records('experience_level');
                    $data['active_poll'] = $this->account_model->get_running_poll();
                    $user_profile_id = $this->account_model->get_user_profile_id_by_email($this->session->userdata('logged_email'));
                    if(isset($data['active_poll']->poll_id))
                            $data['is_poll_answered'] = $this->account_model->is_poll_answered($data['active_poll']->poll_id,$user_profile_id);
                    else
                            $data['is_poll_answered'] = 0;
               $this->load->view('index',$data);
       }
       else
        {
                    set_message('The confirmation code you have provided has either been expired or already used.','alert-info');
                    redirect('/','refresh');

            }
    }
	
    public function change_password()
    {

        $password = $this->input->post('password');
        $code = $this->input->post('reset_password_code');
        $login_id = $this->account_model->get_login_id_by_code($code,'reset_password');
        if($login_id != 0)
            {
                $login_data = array(
                            'login_id' => $login_id,
                            'password' => md5($password),
                    );
                    $this->account_model->change_password($login_data);
                print 1;exit;
            }
        else
        {
          set_message('The confirmation code you have provided has either been expired or already used.','alert-info');
              return false;
          //redirect('/','refresh');
        }
    }

    public function newsletter_subscription()
    {
            $email = $this->input->post('email');
            $email = isset($email) ? $email : '';
            $name = $this->input->post('name');
            $name = isset($name) ? $name : '';

            $is_subscribed = $this->account_model->is_newsletter_subscribed($email);
            if(!$is_subscribed && !empty($email))
            {
                    $newsletter_data = array(
                            'email' => $email,
                            'name' => $name,
                    );
                    $this->account_model->insert_data($newsletter_data,'newsletter_subscription_id','newsletter_subscription');
                    $mail_data = array(
                            'from_email' => 'newsletter@recruitment-ally.com',
                            'from_email_title' => 'RecruitmentAlly',
                            'to_email' => $email,
                            'subject' => 'Newsletter Subscription',
                    );
                    $this->send_email($mail_data,'newsletter_subscription');
                    set_message('You have successfully subscribed','alert-success');
            }
            elseif(empty($email))
                    set_message('Please enter a valid email address','alert-danger');
            else
                    set_message('You are already subscribed','alert-info');
            redirect(base_url(),'refresh');
    }

    private function check_session()
    {
            $user_profile_id = $this->session->userdata('user_profile_id');
            if(!isset($user_profile_id))
            {
                    set_message('Your session has been expired. Please login.','alert-danger');	
                    redirect('/login');
                    return false;
            }
            return true;
    }

    //registration_confirmation
    public function registration_confirmation()
    { 
        $confirmation_code = $this->uri->segment(3);

        $login_id = $this->account_model->get_login_id_by_code($confirmation_code,'registration');
        $this->session->set_userdata('login_id',$login_id);

        if($this->account_model->activate_user_by_code($confirmation_code,'registration') > 0)
        {
                    set_message('Your account has been successfully activated.','alert-success');
            }
        else
        {
          set_message('The confirmation code you have provided has either been expired or already verified.','alert-info');
        }   
            redirect('/','refresh');
    }

    public function login_as_admin()
    {

            $email = $this->session->admin_email;
            if(isset($email))
            {
                    $session_data = array(
                            'name' => 'Development',
                            'email' => $email,
                            'logged_user_type' => ADMIN_PATH_NAME,
                            'is_admin' => 1,
                    );
                    $this->session->userdata = array();	
                    set_user_session('',$session_data); 
                    set_message('You have been switched back to admin','alert-info');
                    redirect(base_url().ADMIN_PATH_NAME,'refresh');
            }
            else
            {
                    set_message('Seems like you dont have access to this','alert-danger');
                    redirect(base_url(),'refresh');
            }
    }

    private function send_email($email_data,$template_name)
    {

        $this->load->library('email');

        //SMTP & mail configuration
        $config = array(
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'shiproject95@gmail.com',
            'smtp_pass' => 'elma@0312',
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'wordwrap'  => TRUE
        );
        $this->email->initialize($config);
        
         $data = $email_data;
         $this->email->from($data['from_email'], $data['from_email_title']);
         $this->email->to($data['to_email']);
        
         $this->email->subject($data['subject']);
        $this->email->message($this->load->view('/templates/'.$template_name,$data,true));
        //Send email
        $this->email->send();

            // $this->load->library('email');
            // $config['charset'] = 'utf-8';
            // $config['wordwrap'] = TRUE;
            // $config['mailtype'] = 'html';
            // $this->email->initialize($config);

            // $data = $email_data;
            // $this->email->from($data['from_email'], $data['from_email_title']);
            // $this->email->to($data['to_email']); 
            // //$this->email->cc('another@another-example.com'); 
            // //$this->email->bcc('nifalm@gmail.com'); 

            // $this->email->subject($data['subject']);
            // $this->email->message($this->load->view('/templates/'.$template_name,$data,true));	

            // $this->email->send();
    }

}

?>
