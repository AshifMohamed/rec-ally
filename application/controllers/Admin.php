<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Author : NIFAL MUNZIR
*/
class Admin extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->verify_access();
		$this->load->model('account_model');
		$this->load->model('configuration_model');
		// print 1;exit;
		// print_r($this->session->userdata())	;exit; 
	}

	private function verify_access()
	{
		if(!is_admin())
		{
			set_message('Access Denied. You don\'t have access to this page','alert-danger');
			redirect(base_url(),'refresh');
		}
	}

	public function get_candidates_dt()
	{
		// print '<pre>';print_r($this->input->get());exit;
		// exit;
		$current_page = $this->input->get('page'); 
		$length =  $this->input->get('length'); 
		$offset = $this->input->get('start'); 
		$draw = $this->input->get('draw'); 
		$candidates_registered = $this->account_model->get_candidates_dt(null,$length,$offset);
		$total_candidates = $this->account_model->get_candidates_count(true);
		$candidates_dt = array(
			'draw'=> $draw,
			'recordsTotal'=> $total_candidates,
			'recordsFiltered' => $total_candidates,
		);
		$data = [];
		foreach ($candidates_registered as $key => $candidate) {
			$data[] = [$candidate->user_profile_id,$candidate->first_name.' '.$candidate->last_name,$candidate->login_email,$candidate->country,$candidate->registered_date,''];
		}
		$candidates_dt['data'] = $data;
		print json_encode($candidates_dt);exit; 
	}

	public function index()
	{
            $newsletter_id = $this->input->get('newsletter_selected_id');
            $data['page_title'] = 'Admininstrator Dashboard';
            // $user_profile_id = $this->account_model->get_user_profile_id_by_email($this->session->userdata('logged_email'));
            $data['active_candidates_registered'] = $this->account_model->get_candidates_count(true);
            $data['active_companies_registered'] = $this->account_model->get_employers_count(true);
            $data['companies_registered'] = $this->account_model->get_employers();
            // $data['candidates_registered'] = $this->account_model->get_candidates(); // COMMENTED AS NOT USED
            $data['administrators'] = $this->account_model->get_administrators();
            // print_r($data['candidates_registered']);exit;
            $data['average_logins'] = $this->account_model->get_average_logins_per_today();
            $data['opened_jobs'] = $this->account_model->get_all_jobs_by_type('open');
            $data['closed_jobs'] = $this->account_model->get_all_jobs_by_type('close');
            $data['jobs_posted'] = $this->account_model->get_job_profiles_by_user_profile_id(-1,true);
            $data['Job_countries'] = $this->account_model->get_job_count_with_countries();
			$data['Candidate_countries'] = $this->account_model->get_candidates_count_with_countries();

			$data_get['registered_candidates'] = $this->account_model->get_candidates_register_count_for_months();
			$data_get['registered_candidates_days'] = $this->account_model->get_candidates_register_count_for_days();
			$data_get['candidates_age'] = $this->account_model->get_candidates_count_with_age();

			$data['candidate_industries'] = $this->account_model->get_candidates_count_of_industries();

            // $industry_ids = [3,4,5];
            
            // $industries_array = [];
            
            // foreach($industry_ids as $industry_id){
            //     $industries_array[] = $this->account_model->get_candidates_count_with_industries($industry_id);
            // }
            
            // $industries_arr = [];
            // foreach ($industries_array as $value) {
            //     $industries_arr = array_merge($industries_arr,$value);
            // }                     
            
            $data['Candidate_experience'] = $this->account_model->get_candidates_count_with_experience();
            // $data['featured_companies'] = $this->account_model->get_featured_companies(1);
//             print'<pre>';print_r($data['Candidate_experience']);
            if(count($data['Job_countries']))
            {
                    $total = ''; 
                    $countries = '';
                    foreach ($data['Job_countries'] as $key => $job) {
                            $total .= $job->job_count.',';
                            $countries .= $job->country.',';
                    }
                    $data['job_count'] = remove_trailing_commas($total);
                    $data['job_countries'] = remove_trailing_commas($countries);
            }
            else
            {
                    $data['job_count'] = 0;
                    $data['job_countries'] = 0;
            }
            if(count($data['Candidate_countries']))
            {
                    $total = ''; 
                    $countries = '';
                    foreach ($data['Candidate_countries'] as $key => $canditate) {
                            $total .= $canditate->candidate_count.',';
                            $countries .= $canditate->country.',';
                    }
                    $data['canditate_count'] = remove_trailing_commas($total);
                    $data['canditate_countries'] = remove_trailing_commas($countries);
            }
            else
            {
                    $data['canditate_count'] = 0;
                    $data['canditate_countries'] = 0;
            }
			
			// if(count($candidate_industries))
            // {
	        //             $total = ''; 
            //         $industries = '';
            //         foreach ($industries_arr as $key => $canditate) {
            //                 $total .= $canditate->candidate_count.',';
            //                 $industries .= $canditate->industry.',';
            //         }
            //         $data['industry_canditate_count'] = remove_trailing_commas($total);
            //         $data['canditate_industries'] = remove_trailing_commas($industries);
            // }
            // else
            // {
            //         $data['industry_canditate_count'] = 0;
            //         $data['canditate_industries'] = 0;
			// }
			
            // if($industries_arr != "")
            // {
	        //             $total = ''; 
            //         $industries = '';
            //         foreach ($industries_arr as $key => $canditate) {
            //                 $total .= $canditate->candidate_count.',';
            //                 $industries .= $canditate->industry.',';
            //         }
            //         $data['industry_canditate_count'] = remove_trailing_commas($total);
            //         $data['canditate_industries'] = remove_trailing_commas($industries);
            // }
            // else
            // {
            //         $data['industry_canditate_count'] = 0;
            //         $data['canditate_industries'] = 0;
            // }
            
            if(count($data['Candidate_experience']))
            {
                    $total = ''; 
                    $experiences = '';
                    foreach ($data['Candidate_experience'] as $key => $canditate) {
                            $total .= $canditate->candidate_count.',';
                            $experiences .= $canditate->level.',';
                    }
                    $data['experience_canditate_count'] = remove_trailing_commas($total);
                    $data['canditate_experiences'] = remove_trailing_commas($experiences);
            }
            else
            {
                    $data['experince_canditate_count'] = 0;
                    $data['canditate_experinces'] = 0;
			}

			if(count($data_get['candidates_age']))
            {
                    $total = ''; 
                    $ages = '';
                    foreach ($data_get['candidates_age'] as $key => $canditate) {
                            $total .= $canditate->candidate_count.',';
                            $ages .= $canditate->age.',';
                    }
                    $data['age_canditate_count'] = remove_trailing_commas($total);
                    $data['canditate_ages'] = remove_trailing_commas($ages);
            }
            else
            {
                    $data['age_canditate_count'] = 0;
                    $data['canditate_ages'] = 0;
			}
			
			$default_registered_count = array_fill(0, 12, 0);
			$default_previous_registered_count = array_fill(0, 6, 0);

			if(count($data_get['registered_candidates']))
            {
                    foreach ($data_get['registered_candidates'] as $key => $candidate) {
							  $index = $candidate->registered_month;
							  $joined_year = $candidate->registered_year;
							  if($joined_year == date("Y")){
								$default_registered_count[$index - 1] = $candidate->no_of_candidates; 
							  }
							  else{
								$default_previous_registered_count[$index - 7] = $candidate->no_of_candidates; 
							  }
                    }
            }
			$data['registered_candidates'] = implode(",", $default_registered_count);
			$data['previous_registered_candidates'] = implode(",", $default_previous_registered_count);

			// $days = date("t");

			$default_registered_count_days = array_fill(0, date("t"), 0);

			if(count($data_get['registered_candidates_days']))
            {
                    foreach ($data_get['registered_candidates_days'] as $key => $canditate) {
							  $index = $canditate->registered_day;
							  $default_registered_count_days[$index - 1] = $canditate->no_of_candidates; 
                    }
            }
			$data['registered_candidates_days'] = implode(",", $default_registered_count_days);
            
//            echo '<pre>'. print_r($data['canditate_industries'],1). '</pre>'; exit;
            
            //print_r($data['Job_countries'] );exit;
			$data['companies_pending_approval'] = $this->account_model->get_companies_pending_approval();
			$data['service'] = $this->account_model->get_service_packages();
            $data['contact_us_requests'] = $this->account_model->get_contact_us_requests();
            $data['unverified_candidates'] = $this->account_model->unverified_candidates();
            $data['newsletter_subscribers'] = $this->configuration_model->get_all_records('newsletter_subscription','date','DESC');
            $data['newsletters'] = $this->configuration_model->get_all_records('newsletter');
            // $data['candidates'] = $this->configuration_model->get_candidates(true);
            // $data['employers'] = $this->configuration_model->get_employers(true);
            if(isset($newsletter_id))
            {
                    //print $newsletter_id;exit;
                    $data['newsletter_loaded'] = $this->configuration_model->get_all_records_filter_by_type('newsletter','newsletter_id',$newsletter_id,true);
            }
            $data['polls'] = $this->account_model->get_polls(true);
			$data['advertisements'] = $this->account_model->get_all_advertisements();
			$data['job_profiles'] = $this->account_model->get_job_profiles_for_admin();

            // $data['polls_results'] = $this->account_model->get_contact_us_requests();
            // print_r($data['companies_pending_approval']);exit;
            $this->load->view('/'.ADMIN_PATH_NAME.'/dashboard',$data);
	}

	public function test()
	{
		
	}
	public function approve_company()
	{
		$user_profile_id = $this->input->get('id');
		$this->account_model->activate_company_profile_by_user_profile_id($user_profile_id);
		set_message('The company has been activated successfully','alert alert-success');
		redirect(base_url().ADMIN_PATH_NAME,'refresh');
	}

	public function save_poll()
	{
		//print_r($this->input->post());exit;
		$poll_id = $this->input->post('poll_id');
		$poll_name =  $this->input->post('poll_name');
		$poll_option =  $this->input->post('poll_option');
		//$poll_end_date = $this->input->post('poll_end_date');
		$is_published = $this->input->post('is_published');
		if(isset($is_published))
		{
			if($is_published == 'on' || $is_published == 1)
				$is_published = 1;
			else
				$is_published = 0;
		}
		else
		{
			$is_published = 0;
		}
		$form_is_published = $is_published;
		$poll_already_running = $this->account_model->get_running_poll();
		//print_r($poll_already_running);exit;
		// if(isset($poll_already_running->is_published))
		// {
		// 	$is_published = 0;
		// }
		$is_poll_published = $this->configuration_model->get_value_by_id('poll','is_published','poll_id',$poll_id);
		$is_poll_feedback_received = $this->account_model->is_poll_answered($poll_id);
		$db_poll_options = get_poll_options_by_poll_id($poll_id);
		// print_r($poll_options);
			//print 'came';exit;
			if(isset($poll_already_running->is_published))
			{
				if($poll_already_running->poll_id != $poll_id)
					$is_published = 0;
			}
			$poll_data = array(
				'poll_id' => $poll_id,
				'name' => $poll_name,
				//'end_date' => $poll_end_date,
				'is_published' => $is_published,
			);
			$poll_inserted_id = $this->account_model->insert_data($poll_data,'poll_id','poll');
			if($poll_id == 0)
				$poll_id = $poll_inserted_id;
			// print empty($is_poll_published).'--'; print($is_poll_feedback_received).'--';print  count($poll_option).'--';exit;
			if(empty($is_poll_published) && $is_poll_feedback_received == 0 && count($db_poll_options) == 0)
			{
				$this->account_model->delete_data('poll_option',array('poll_id'=>$poll_id));

				foreach ($poll_option as $key => $option){
					$poll_options = array(
						'poll_id' => $poll_id,
						'option' => $option,
					);
					$this->account_model->insert_data($poll_options,'poll_option_id','poll_option');
				}
			}
		// else
		// {
		// 	$poll_data = array(
		// 		'poll_id' => $poll_id,
		// 		'name' => $poll_name,
		// 		'is_published'=> $is_published,
		// 	);
		// 	//print_r($poll_data);exit;
		// 	$this->account_model->insert_data($poll_data,'poll_id','poll');
		// }
		//isset($poll_already_running->is_published)
		if(count($db_poll_options) == 0 && isset($poll_already_running->is_published) && $form_is_published)
		{
			set_message('The poll has been created successfully but cannot be published because there is already one running','alert-warning');
		}		
		elseif(count($db_poll_options) == 0)
		{	
			set_message('Poll has been created successfully','alert-success');
		}
		elseif(isset($poll_already_running->poll_id) && $is_published && $poll_already_running->poll_id != $poll_id)
		{
			set_message('The poll cannot be published because there is already one running','alert-warning');
		}	
		elseif($is_poll_feedback_received || $is_poll_published)
		{
			set_message('Poll options cannot be updated. Only the name and the published status will be updated','alert-warning');
		}
		else
		{
			set_message('The Poll has been saved','alert-success');
		}
		redirect(base_url().ADMIN_PATH_NAME,'refresh');
	}

	public function delete_poll($poll_id)
	{
		$is_poll_published = $this->configuration_model->get_value_by_id('poll','is_published','poll_id',$poll_id);
		$is_poll_feedback_received = $this->account_model->is_poll_answered($poll_id);
		// print $is_poll_published;exit;
		if($is_poll_feedback_received)
		{
			if($is_poll_feedback_received)
			{
				set_message('Poll cannot be deleted because feedback has already been received from users','alert-danger');
			}
			elseif($is_poll_published == 1)
			{
				set_message('Poll cannot be deleted because it has been published','alert-danger');
			}
			elseif(empty($is_poll_published))
			{
				set_message('Seeme like the poll doesnt exsist','alert-danger');
			}
		}
		elseif(!$is_poll_feedback_received)
		{ 
			$this->account_model->delete_data(array('poll','poll_option'),array('poll_id'=>$poll_id));
			set_message('Poll has been successfully deleted','alert-info');
		} 
		
		redirect(base_url().ADMIN_PATH_NAME,'refresh');
	}

	public function remind_candidate()
	{
		$to_email = $this->input->get('email');
		$name = $this->input->get('name');
		$email_data['registered_name'] = $name;
		$email_data['registration_code'] = md5($to_email);
		$email_data['subject'] = 'Account Activation Reminder';
		$email_data['from_email'] = 'recruitment@recruitment-ally.com';
		$email_data['from_email_title'] = 'RecruitmentAlly';
		$email_data['to_email'] = $to_email;
		$email_data['type'] = 'registration';
		$email_data['user_type'] = 'candidate';
		
		$this->send_email($email_data,'email_verification');
		$this->session->set_tempdata('registration_confirmation', '1',5);
		$this->account_model->update_reminder_date_by_email($to_email);
		set_message('Activation email has been successfully sent to the candidate','alert-success');
		redirect(base_url().ADMIN_PATH_NAME,'refresh');
	}

	public function save_newsletter()
	{
		$newsletter_id = $this->input->post('newsletter_id');
		$newsletter_title = $this->input->post('newsletter_title');
		$newsletter_email_content = $this->input->post('newsletter_email_content');
		$is_attachment_set = false;
		$newsletter_attachment = '';
		if(!empty($_FILES['newsletter_attachment']['tmp_name']))
		{
			$newsletter_attachment = $this->do_upload('1','1','newsletter_attachment','newsletter_attachments');
			$is_attachment_set = true;
		}
		

		$newsletter_data = array(
			'newsletter_id' => $newsletter_id,
			'title' => $newsletter_title,
			'contents' => $newsletter_email_content,
			'attachment' => $newsletter_attachment,
		);

		if(!$is_attachment_set)
			unset($newsletter_data['attachment']);

		$this->account_model->insert_data($newsletter_data,'newsletter_id','newsletter');
		set_message('Newsletter has been successfully saved','alert-success');
		redirect(base_url().ADMIN_PATH_NAME,'refresh');
	}

	public function send_newsletter()
	{
		$this->load->helper('path');
		$newsletter_id = $this->input->post('newsletter_id');
		if(isset($newsletter_id) && $newsletter_id > 0)
		{
			$newsletter_subscribers = $this->configuration_model->get_all_records('newsletter_subscription','date','ASC');
			//print'<pre>';print_r($newsletter_subscribers);exit;
			$newsletter = $this->configuration_model->get_all_records_filter_by_type('newsletter','newsletter_id',$newsletter_id,true);
			
			$mail_data['from_email'] = 'newsletter@recruitment-ally.com';
			$mail_data['from_email_title'] = 'Newsletter';
			$mail_data['subject'] = $newsletter->title;
			$mail_data['contents'] = $newsletter->contents;
			$path=$_SERVER["DOCUMENT_ROOT"].'/uploads/newsletter_attachments/';
			// $path = set_realpath('uploads/newsletter_attachments/');
			$mail_data['attachment'] =  $path.$newsletter->attachment;
			//print $mail_data['attachment'];exit;
			$newsletter_map_data = array(
				'newsletter_id' => $newsletter_id, 
			);
			foreach ($newsletter_subscribers as $key => $subscriber) {
				$mail_data['subscriber_name'] = $subscriber->name;
				$mail_data['to_email'] = $subscriber->email;
				if($this->send_email($mail_data,'newsletter') == 1)
				{
					$newsletter_map_data['newsletter_subscriber_id'] = $subscriber->newsletter_subscription_id;
					$this->account_model->insert_data($newsletter_map_data,'newsletter_user_map_id','newsletter_user_map');
					set_message('Newsletter successfully sent to all subscribers','alert-success');
				}
				else
				{
					set_message('An error had occurred. Please inform support asap','alert-danger');
					break;
				}
				break;				
			}
			
		}
		else
		{
			set_message('Please select a newsletter to send','alert-danger');
		}
		redirect(base_url().ADMIN_PATH_NAME,'refresh');
	}

	public function save_administrator()
	{
		$admin_id = $this->input->post('admin_team_id');
		$user_profile_id = $this->input->post('user_profile_id');
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		if(!empty($name) && !empty($email) && !empty($password))
		{
			
			$login_data = array(
				'email' => $email,
				'password' => md5($password),
				'user_type_id' => 2,
			);
			if($admin_id == 0 && $user_profile_id == 0)
			{
			
				if($this->account_model->is_user_exist(array('email'=>$email)) == 0)
				{
					$login_id = $this->account_model->insert_data($login_data,'login_id','login');

					$user_profile_data = array(
						'login_id' => $login_id,
						'is_active' => 1,
					);
					$user_profile_id = $this->account_model->insert_data($user_profile_data,'user_profile_id','user_profile');
					set_message('An administrator account has been successfully created','alert-success');
				}
				else
				{
					set_message('The entered email address already exist.','alert-danger');
				}
			}
			else
			{
				if($this->account_model->is_user_exist(array('email'=>$email)) != 0)
					unset($login_data['email']);
				$login_data['login_id'] = $this->configuration_model->get_value_by_id('user_profile','login_id','user_profile_id',$user_profile_id);
				$this->account_model->insert_data($login_data,'login_id','login');
				set_message('Admininstrator account has been successfully updated','alert-success');
			}
			$admin_data = array(
				'admin_team_id' => $admin_id,
				'user_profile_id' => $user_profile_id,
				'name' => $name,
			);

			$this->account_model->insert_data($admin_data,'admin_team_id','admin_team');
		}
		else
			set_message('Please make sure all fields are complete','alert-danger');
		redirect(base_url().ADMIN_PATH_NAME,'refresh');
	}

	public function update_profile_status()
	{
		$user_profile_id = $this->input->get('id');
		$status = $this->input->get('status');

		$status = $status == 'true' ? 0 : 1;
		//print $status;exit;
		$this->account_model->update_profile_status($user_profile_id,$status);
		set_message('Profile status has been successfully updated','alert-success');
		redirect(base_url().ADMIN_PATH_NAME,'refresh');
	}

	public function make_company_featured()
	{
		$user_profile_id = $this->input->get('id');
		$status = $this->input->get('status');
		$status = $status == 'true' ? 0 : 1;
		$this->account_model->set_company_featured_status($user_profile_id,$status);
		if($status)
			set_message('The selected company is now featured','alert-success');
		else
			set_message('The selected company is removed from the featured company list','alert-warning');

		redirect(base_url().ADMIN_PATH_NAME,'refresh');
	}

	public function login_to_account($user_profile_id)
	{
		$user_type = $this->input->get('type');
		$user_type = strtolower($user_type);
		//print $user_profile_id ;exit;

		$name = $name = $this->account_model->get_name_by_user_profile_id_and_type($user_profile_id,$user_type);
		$email = $this->account_model->get_email_by_user_profile_id($user_profile_id);
		//print_r($profile);exit;
		$session_data = array(
			'name' => $name,
			'email' => $email,
			'logged_user_type' => $user_type,
			'access_type' => 'admin',
		);
		$admin_email = $this->session->logged_email;
		$this->session->userdata = array();	
		set_user_session('',$session_data); 
		$this->session->set_userdata('admin_email',$admin_email);
		set_message('You have been logged in as a '.$user_type,'alert-info');
		redirect(base_url(),'refresh');
	}

	public function delete_profile()
	{
		$user_profile_id = $this->input->get('id');
		if(isset($user_profile_id))
		{
			$this->account_model->updata_record('user_profile','user_profile_id',array('user_profile_id'=>$user_profile_id,'is_active'=>0,'is_deleted'=>1));
			set_message('The account has been delete successfully','alert-success');
		}
		else
			set_message('Please make sure the account has been selected','alert-danger');
		redirect(base_url().ADMIN_PATH_NAME,'refresh');
	}
 
	public function get_candidates()
	{
		$data['candidates_registered'] = $this->account_model->get_candidates();
		// if($this->input->is_ajax_request())
		print json_encode($data['candidates_registered']);exit; 
	} 
	public function get_employers()
	{
		$data['companies_registered'] = $this->account_model->get_employers();
	}


	public function get_employers_dt()
	{

		echo '{"data": [
		    [
		      "Airi",
		      "Satou",
		      "Accountant",
		      "Tokyo",
		      "28th Nov 08",
		      "$162,700"
		    ],
		    [
		      "Angelica",
		      "Ramos",
		      "Chief Executive Officer (CEO)",
		      "London",
		      "9th Oct 09",
		      "$1,200,000"
		    ],
		    [
		      "Ashton",
		      "Cox",
		      "Junior Technical Author",
		      "San Francisco",
		      "12th Jan 09",
		      "$86,000"
		    ],
		    [
		      "Bradley",
		      "Greer",
		      "Software Engineer",
		      "London",
		      "13th Oct 12",
		      "$132,000"
		    ],
		    [
		      "Brenden",
		      "Wagner",
		      "Software Engineer",
		      "San Francisco",
		      "7th Jun 11",
		      "$206,850"
		    ],
		    [
		      "Brielle",
		      "Williamson",
		      "Integration Specialist",
		      "New York",
		      "2nd Dec 12",
		      "$372,000"
		    ],
		    [
		      "Bruno",
		      "Nash",
		      "Software Engineer",
		      "London",
		      "3rd May 11",
		      "$163,500"
		    ],
		    [
		      "Caesar",
		      "Vance",
		      "Pre-Sales Support",
		      "New York",
		      "12th Dec 11",
		      "$106,450"
		    ],
		    [
		      "Cara",
		      "Stevens",
		      "Sales Assistant",
		      "New York",
		      "6th Dec 11",
		      "$145,600"
		    ],
		    [
		      "Cedric",
		      "Kelly",
		      "Senior Javascript Developer",
		      "Edinburgh",
		      "29th Mar 12",
		      "$433,060"
		    ]
		  ]
		}';
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
		
 		
		if(isset($email_data['attachment']))
		{
		 	$this->email->attach($data['attachment']);
		}
		if($this->email->send())
	    {
	    	return 1;
	        echo "Mail send successfully!";
	       
	    }
	 
	    else
	    {
	        show_error($this->email->print_debugger());exit;
	    }
	}
 
	private function do_upload($max_width = '1024',$max_height = '768',$input_name,$path='',$additional_types='')
	{
		//print_r(is_dir(APPPATH.'upload\\'));exit;
		
		//if($input_name == 'portrait_pic')
		//	print_r($input_name );//exit;
		$config['upload_path'] =  './uploads/'.$path;
		$config['allowed_types'] = '*';
		$config['max_size']	= '10000';
		/*$config['max_width']  = $max_width;
		$config['max_height']  = $max_height;*/
		$config['file_name'] = uniqid().$input_name;

		$this->load->library('upload', $config);
		$this->upload->initialize($config); // load new config setting
		//print_r($config);exit;
		if ( ! $this->upload->do_upload($input_name))
		{
			print_r($this->upload->display_errors());exit;
			//$error = array('error' => $this->upload->display_errors());
			//$this->load->view('upload_form', $error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			return $this->upload->data('file_name');
			//$this->load->view('upload_success', $data);
		}
	}

	public function delete_company()
	{
		$user_profile_id = $this->input->get('id');
                               
		if(isset($user_profile_id))
		{
			$this->account_model->updata_record('user_profile','user_profile_id',array('user_profile_id'=>$user_profile_id,'is_active'=>0,'is_deleted'=>1));
			set_message('The campany has been delete successfully','alert-success');
		}
		else
			set_message('Please make sure the account has been selected','alert-danger');
		redirect(base_url().ADMIN_PATH_NAME,'refresh');
	}

	public function delete_info_request()
	{
		$contact_email_id = $this->input->get('id');
		if(isset($contact_email_id))
		{
			$this->account_model->updata_record('contact_email','contact_email_id',array('contact_email_id'=>$contact_email_id,'is_deleted'=>1));
			$data['message'] = "Success";
		}
		else
		$data['message'] = "Failed";
		print json_encode($data['message']);
		exit; 
	}

}
?>
