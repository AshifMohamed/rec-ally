<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Job extends CI_Controller {

	
    public function __construct()
    {
        parent::__construct();
        $this->load->model('account_model');
        $this->load->model('configuration_model');
        $this->load->library('pagination');
        $this->load->library('email');
    }
    
    public function index()
    {
        $data = $this->get_search_info();
        $data['jobs'] = new stdClass();
        // if($data['keyword'] == '' && $data['keyword_s'] == '')
        //         $data['keyword'] = $keyword;
        // print_r($data);exit;

        $data['jobs'] = $jobs = $this->account_model->get_job_profiles_by_search_options($data,true);
        
//        echo '<pre>'. print_r($jobs,1). '</pre>'; exit;

        $data['employment_statuses'] = $this->configuration_model->get_all_records('employment_status');
        $data['countries'] = $this->configuration_model->get_all_records('country','country','ASC');
        $data['career_levels'] = $this->configuration_model->get_all_records('career_level');
        $data['salary_ranges'] = $this->configuration_model->get_all_records('salary_range');
        $data['search_info'] = $this->get_search_info();
        // print_r($data);exit;
        $this->update_job_appearance($data['jobs']);
        $page = $data['page'];
        unset($data['page']);
        $jobs_count = count($this->account_model->get_job_profiles_by_search_options($data));
        // print_r(count($data['jobs']));exit;
        $data['pagination'] = $this->get_pages($jobs_count,$page);
        //print_r($data['pagination']);exit;
//        $this->load->view('header');
        $this->load->view('job_listing',$data);
//        $this->load->view('footer');
    }

    public function get_search_info()
    {
        $data = array(
            'keyword' => ($this->input->get_post('keyword')) ? $this->input->get_post('keyword') : '',
            'keyword_s' => ($this->input->get_post('keyword_s')) ? $this->input->get_post('keyword_s') : '',
            'salary_range' => $this->input->get_post('salary_range') ? implode(',',$this->input->get_post('salary_range')) : '' ,
            'industry_s' => $this->input->get_post('industry_s') ? $this->input->get_post('industry_s') : '',
            'experience_level_s' => $this->input->get_post('experience_level_s') ? $this->input->get_post('experience_level_s') : '',
            'career_level' => $this->input->get_post('career_level') ? implode(',',$this->input->get_post('career_level')) : '',
            'country' => $this->input->get_post('country') ? implode(',',$this->input->get_post('country')): '',
            'country_s' => $this->input->get_post('country_s') ? $this->input->get_post('country_s') : '',
            'notice_period' => $this->input->get_post('notice_period') ? $this->input->get_post('notice_period') : '',
            'employment_status' => $this->input->get_post('employment_status') ? implode(',', $this->input->get_post('employment_status')) : '',
            'page' => $this->input->get_post('page') ? $this->input->get_post('page') : '0',
        );
        return $data;
    }

    private function update_job_appearance($jobs)
    {
        //print_r($jobs);exit;
        foreach ($jobs as $key => $job) {
            if($job->job_profile_id != 0 && $job->job_profile_id!= '')
            {
                $this->account_model->update_job_appearance_count($job->job_profile_id);
            }
        }
    }

    private function get_pages($total_jobs,$current_page=1)
    {
        //pagination settings
        $config['base_url'] = base_url('listings');
        $config['total_rows'] = $total_jobs;
        $config['per_page'] = JOBS_LISTED_PER_PAGE;
        //$config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        //config for bootstrap pagination class integration
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        // $config['prev_link'] = '&laquo';
        // $config['prev_tag_open'] = '<li class="prev">';
        // $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="hidden">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);      

        return $this->pagination->create_links();
    }
    
    public function posting($job_ref_no=0)
    {
        if($job_ref_no !== 0)
        {
            $user_profile_id = $this->account_model->get_user_profile_id_by_email($this->session->userdata('logged_email'));
            $candidate_profile_id = $this->account_model->get_candidate_profile_id_by_user_profile_id($user_profile_id);

            $job_profile_id = $this->account_model->get_job_profile_id_by_ref($job_ref_no);
            $data['job'] = $this->account_model->get_job_profile_by_id($job_profile_id);
            log_message('debug', 'This is the job ref number used - '.$job_ref_no.' and candidate_profile_id is - '.$candidate_profile_id);
            if(isset($data['job']->job_profile_id))
            {
                $data['languages'] = $this->account_model->get_data_by_id_collection($data['job']->required_language_ids,'language','language_id','language');
                $data['nationalities'] = $this->account_model->get_data_by_id_collection($data['job']->nationality_ids,'nationality','nationality_id','nationality');
                $data['mobilities'] = $this->account_model->get_data_by_id_collection($data['job']->mobility_ids,'mobility','mobility_id','mobility');
                $data['driving_licenses'] = $this->account_model->get_data_by_id_collection($data['job']->driving_license_country_ids,'country','country_id','country');
                $data['job_history_categories'] = $this->account_model->get_data_by_id_collection($data['job']->job_history_category_ids,'job_history_category','job_history_category_id','history_category');
                $data['industries'] = $this->account_model->get_data_by_id_collection($data['job']->industry_ids,'industry','industry_id','industry');
                if($candidate_profile_id != 0)
                    $data['has_applied'] = $this->account_model->has_candidate_applied($job_profile_id,$candidate_profile_id);
                else
                    $data['has_applied'] = -1;

                $curdate=strtotime(date('Y-m-d'));
                $end_date = new DateTime($data['job']->close_date);
                $end_date = $end_date->format('Y-m-d');
                $end_date=strtotime($end_date);
                if($curdate > $end_date)
                    $data['is_ad_expired'] = 1;
                else
                    $data['is_ad_expired'] = 0;

                $data['candidate_profile'] = $this->account_model->get_candidate_by_user_profile_id($user_profile_id);  //Candidate Profile, Salary and Notice Period
                $data['candidate_address'] = $this->account_model->get_address_by_user_profile_id($user_profile_id);
                $data['candidate_educations'] = $this->account_model->get_education_by_user_profile_id($user_profile_id); //Degree Table
                $data['candidate_experiences'] = $this->account_model->get_experience_by_user_profile_id($user_profile_id);
                $data['candidate_certificates'] = $this->account_model->get_certificate_by_user_profile_id($user_profile_id);
                $data['profile_score'] = get_profile_score($data['candidate_profile'],$data['candidate_educations'],$data['candidate_experiences'],$data['candidate_certificates'],$data['candidate_address']);

                $data['countries'] = $this->configuration_model->get_all_records('country','country','ASC');
                
                if(count($data['nationalities']) == count($data['countries']))
                    $data['is_all_nationality'] = 1;
        
//        echo '<pre>'. print_r($data,1). '</pre>'; exit;

                $this->load->view('job_posting', $data);
                
            }
            else
            {
                set_message('Please make sure the job reference is valid or send us an email using the contact form','alert-danger');
                redirect(base_url().'listings','refresh');
            }
        }
        else
            redirect(base_url().'listings','refresh');
    }

    public function filter_results()
    {
        $data = $this->get_search_info();
        //$keyword = isset($keyword) ? $keyword : '';

        $listing_data['jobs'] = $this->account_model->get_job_profiles_by_search_options($data);
        //$this->update_job_appearance($listing_data['jobs']);
        unset($data['page']);
        $jobs_count = count($this->account_model->get_job_profiles_by_search_options($data));
        $listing_data['pagination'] = $this->get_pages($jobs_count);

        print json_encode($listing_data);exit;
    }

    public function apply_job($job_ref_no = 0)
    {
        if($job_ref_no !== 0)
        {
            $job_profile_id = $this->account_model->get_job_profile_id_by_ref($job_ref_no);
            $data['job'] = $this->account_model->get_job_profile_by_id($job_profile_id);

            $user_profile_id = $this->account_model->get_user_profile_id_by_email($this->session->userdata('logged_email'));
            $candidate_profile_id = $this->account_model->get_candidate_profile_id_by_user_profile_id($user_profile_id);
            if($candidate_profile_id != 0)
            {
                $candidate = $this->account_model->get_candidate_by_candidate_profile_id($candidate_profile_id);
                $job_profile = $this->account_model->get_job_profile_by_id($job_profile_id);
                $has_candidate_applied = $this->account_model->has_candidate_applied($job_profile_id,$candidate_profile_id);
                if($has_candidate_applied == false)
                {
                    $filtering_status_id = $this->account_model->get_filtering_status_id_by_status('Not Viewed');
                    $job_data = array(
                        'job_profile_id' => $job_profile_id,
                        'candidate_profile_id' => $candidate_profile_id,
                        'filtering_status_id' => $filtering_status_id
                    );
                    $candidate_job_application_status_id = $this->account_model->insert_data($job_data,'candidate_job_application_status_id','candidate_job_application_status');

                    $history_data = array(
                        'candidate_job_application_status_id' => $candidate_job_application_status_id,
                        'filtering_status_id' => $filtering_status_id,
                        'filtering_state' => 'not_viewed',
                    );
                    $this->account_model->insert_data($history_data,'candidate_job_application_status_history_id','candidate_job_application_status_history');
                    $mail_data = array(
                        'from_email' => 'recruitment@recruitment-ally.com',
                        'from_email_title' => 'RecruitmentAlly',
                        'to_email' => $this->session->userdata('logged_email'),
                        'subject' => 'Job Application:Successful - '.$data['job']->position,
                        'job_ref_no' => $job_ref_no,
                        'position' => $data['job']->position,
                    );
                    $this->send_email($mail_data,'job_application_confirmation');

                    $mail_data['to_email'] = $job_profile->email; //'nifalm@gmail.com';
                    $mail_data['subject'] = 'Job Application Received - '.$data['job']->position;
                    $mail_data['is_employer'] = true;
                    $mail_data['name'] = $candidate->first_name.' '.$candidate->last_name;
                    $mail_data['is_employer'] = true;
                    $this->send_email($mail_data,'job_application_confirmation');
                }
                else
                {
                    set_message('You have already applied for this position','alert-danger');
                }
            }
            else
            {
                //err msg
            }
        }
        redirect(base_url().'posting/'.$job_ref_no.'?status=successful','refresh');
    }

    public function save_job_position($job_ref_no='')
    {
        if(!empty($job_ref_no))
        {
            $user_profile_id = $this->account_model->get_user_profile_id_by_email($this->session->userdata('logged_email')); 
            // print empty($user_profile_id);exit;
            $job_profile_id = $this->account_model->get_job_profile_id_by_ref($job_ref_no);
            if($job_profile_id != 0 && empty($user_profile_id)==0 && $user_profile_id!=0)
            {
                $job_data = array(
                        'job_profile_id' => $job_profile_id,
                        'user_profile_id' => $user_profile_id
                );
                $this->account_model->insert_data($job_data,'saved_job_id','saved_job');
            }
            if($this->input->is_ajax_request() && empty($user_profile_id) && $user_profile_id!=0)
            {
                    print '1';exit;
            }
            if(!$this->input->is_ajax_request())
                redirect(base_url(),'refresh');
        }
        redirect(base_url(),'refresh');
    }
    
    public function like_job($job_ref_no='')
    {
        if(!empty($job_ref_no))
        {
            $user_profile_id = $this->account_model->get_user_profile_id_by_email($this->session->userdata('logged_email')); 
            $job_profile_id = $this->account_model->get_job_profile_id_by_ref($job_ref_no);
            if($job_profile_id != 0 && $user_profile_id != 0)
            {
                $job_data = array(
                    'job_profile_id' => $job_profile_id,
                    'user_profile_id' => $user_profile_id
                );
                $this->account_model->insert_data($job_data,'liked_job_id','liked_job');
            }
            if($this->input->is_ajax_request())
                print 'success';
            else
                redirect(base_url(),'refresh');
        }
        redirect(base_url(),'refresh');
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
        //$this->email->bcc('nifalm@gmail.com'); 

        $this->email->subject($data['subject']);
        $this->email->message($this->load->view('/templates/'.$template_name,$data,true));	

        $this->email->send();
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */