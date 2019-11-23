<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Author: Nifal
*/
class Portal extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('account_model');
		$this->load->model('configuration_model');
		check_session();
	}

	/* START CANDIDATE CONTROLLERS */

	public function index()
	{
		$data['page_title'] = 'Dashboard';
		$user_profile_id = $this->account_model->get_user_profile_id_by_email($this->session->userdata('logged_email'));
		//print $user_profile_id;exit;
		$data['profile'] = $this->account_model->get_candidate_by_user_profile_id($user_profile_id);  //Candidate Profile, Salary and Notice Period
		$data['address'] = $this->account_model->get_address_by_user_profile_id($user_profile_id);
		$data['contact'] = $this->account_model->get_contact_by_user_profile_id($user_profile_id);

		$data['educations'] = $this->account_model->get_education_by_user_profile_id($user_profile_id); //Degree Table
		$data['experiences'] = $this->account_model->get_experience_by_user_profile_id($user_profile_id);
		$data['certificates'] = $this->account_model->get_certificate_by_user_profile_id($user_profile_id);
		// $data['industries'] = $this->configuration_model->get_all_records('industry');
		// $data['countries'] = $this->configuration_model->get_all_records('country','country','ASC');
		// $data['experience_levels'] = $this->configuration_model->get_all_records('experience_level');
 
		$data['jobs_applied'] = $this->account_model->get_candidate_job_count_by_user_profile_id_and_status($user_profile_id);
		$data['all_jobs_applied'] = $this->account_model->get_candidate_job_application_history_count_by_user_profile_id($user_profile_id);
		$data['profile_views_count'] = $this->account_model->get_candidate_profile_views_count_by_user_profile_id($user_profile_id);
		$data['profile_score'] = get_profile_score($data['profile'],$data['experiences'],$data['educations'],$data['certificates'],$data['address']);
		$data['cv_views'] = $this->account_model->get_candidate_profile_visibility_count_by_type($user_profile_id,'cv_views');
		$job_profiles = $this->account_model->get_job_profiles(true,'DESC');
		$data['recommended_jobs'] = $this->get_recommened_jobs($job_profiles);
		$this->load->view('portal/candidate_dashboard',$data);
	}

	public function candidate_profile()
	{
		$data['page_title'] = 'Edit Profile';
		$user_profile_id = $this->account_model->get_user_profile_id_by_email($this->session->userdata('logged_email'));
		// print $user_profile_id;exit;
		$data['profile'] = $this->account_model->get_candidate_by_user_profile_id($user_profile_id);  //Candidate Profile, Salary and Notice Period
		$data['address'] = $this->account_model->get_address_by_user_profile_id($user_profile_id);
		// print_r($data['profile']);exit;
		$data['contact'] = $this->account_model->get_contact_by_user_profile_id($user_profile_id);
		if(isset($data['profile']->candidate_profile_id))
			$data['salary_notice_period'] = $this->account_model->get_salary_notice_period_by_candidate_id($data['profile']->candidate_profile_id);
		// print_r($data['salary_notice_period']);exit;
		//print(empty($data['profile']));exit;
		$data['educations'] = $this->account_model->get_education_by_user_profile_id($user_profile_id); //Degree Table
		$data['experiences'] = $this->account_model->get_experience_by_user_profile_id($user_profile_id);

		$data['certificates'] = $this->account_model->get_certificate_by_user_profile_id($user_profile_id);
		$data['language_expertise'] = $this->account_model->get_language_expertise_by_user_profile_id($user_profile_id);
		$data['memberships'] = $this->account_model->get_membership_by_user_profile_id($user_profile_id);

		$data['career_levels'] = $this->configuration_model->get_all_records('career_level');
		$data['languages'] = $this->configuration_model->get_all_records('language');
		$data['degree_types'] = $this->configuration_model->get_all_records('degree_type');
		$data['education_faculties'] = $this->configuration_model->get_all_records('education_faculty');
		$data['industries'] = $this->configuration_model->get_all_records('industry');
		$data['departments'] = $this->configuration_model->get_all_records('department');
		$data['job_history_categories'] = $this->configuration_model->get_all_records('job_history_category');
		$data['competencies'] = $this->configuration_model->get_all_records('competency');
		$data['soft_skill_types'] = $this->configuration_model->get_all_records('soft_skill_type');
		$data['countries'] = $this->configuration_model->get_all_records('country','country','ASC');
		$data['cities'] = $this->configuration_model->get_all_records('city','city','ASC');
		$data['nationalities'] = $this->configuration_model->get_all_records('nationality','nationality','ASC');
		$data['visa_statuses'] = $this->configuration_model->get_all_records('visa_status');
		$data['notice_periods'] = $this->configuration_model->get_all_records('notice_period');
		$data['salary_ranges'] = $this->configuration_model->get_all_records('salary_range');
		$data['experience_levels'] = $this->configuration_model->get_all_records('experience_level');
		$data['maritial_statuses'] = $this->configuration_model->get_all_records('maritial_status');

		if(isset($data['profile']->candidate_profile_id))
		{
			$data['selected_job_history_categories'] = explode(',', $data['profile']->job_history_category_ids);
			$data['selected_industries'] = explode(',', $data['profile']->industry_ids);
			$data['selected_competencies'] = explode(',', $data['profile']->competency_ids);
			$data['selected_soft_skill_types'] = explode(',', $data['profile']->soft_skill_type_ids);
			$data['selected_driving_license_countries'] = explode(',', $data['profile']->driving_license_country_ids);
		}
		else
		{
			$data['selected_job_history_categories'] = array();
			$data['selected_industries'] =  array();
			$data['selected_competencies'] =  array();
			$data['selected_soft_skill_types'] =  array();
			$data['selected_driving_license_countries'] =  array();
		}
		if(empty($data['profile']->industry_ids))
			$data['profile']->industry_ids = 0;
		if(empty($data['profile']->competency_ids))
			$data['profile']->competency_ids = 0;  
		if(empty($data['profile']->driving_license_country_ids))
			$data['profile']->driving_license_country_ids = 0;

		$data['profile']->industry_ids = remove_trailing_commas($data['profile']->industry_ids);
		$data['profile']->competency_ids = remove_trailing_commas($data['profile']->competency_ids);
		$data['profile']->driving_license_country_ids = remove_trailing_commas($data['profile']->driving_license_country_ids);

		$data['industry_collection'] = $this->account_model->get_data_by_id_collection($data['profile']->industry_ids,'industry','industry_id','industry');
		$data['job_history_collection'] = $this->account_model->get_data_by_id_collection($data['profile']->job_history_category_ids,'job_history_category','job_history_category_id','history_category');
		$data['competency_collection'] = $this->account_model->get_data_by_id_collection($data['profile']->competency_ids,'competency','competency_id');
		$data['soft_skill_collection'] = $this->account_model->get_data_by_id_collection($data['profile']->soft_skill_type_ids,'soft_skill_type','soft_skill_type_id');
		$data['driving_license_collection'] = $this->account_model->get_data_by_id_collection($data['profile']->driving_license_country_ids,'country','country_id','country');

		// print_r($data['profile']->industry_ids);exit;
		$data['profile_score'] = get_profile_score($data['profile'],$data['experiences'],$data['educations'],$data['certificates'],$data['address']);
		/*
		
		$data['industry'] = $this->account_model->get_candidate_profile();
		$data['department'] = $this->account_model->get_candidate_profile();
		*/
		$this->load->view('portal/candidate_profile',$data);
	}

	public function save_candidate_basic_profile_info()
	{

		$is_profile_pic_set = false;
		$is_portrait_pic_set = false;
		$is_passport_copy_set = false;
		$profile_pic_name = '';
		$portrait_pic_name = '';
		$passport_copy_name = '';
		if(!empty($_FILES['profile_pic']['tmp_name']))
		{
			$profile_pic_name = $this->do_upload('1024','768','profile_pic','candidate_profiles');
			$is_profile_pic_set = true;
		}
		if(!empty($_FILES['portrait_pic']['tmp_name']))
		{
			$portrait_pic_name = $this->do_upload('1024','768','portrait_pic','candidate_profiles');
			$is_portrait_pic_set = true;
		}
		if(!empty($_FILES['passport_copy']['tmp_name']))
		{
			$passport_copy_name = $this->do_upload('1024','768','passport_copy','candidate_profiles');
			$is_portrait_pic_set = true;
		}
		

		//print($this->input->post('contact_profile_map_id'));exit;
		
		$address_data = array(
			'building_no' => $this->input->post('building_no'),
			'building_name' => $this->input->post('building_name'),
			'street' => $this->input->post('street'),
			'city_id' => $this->input->post('city'),
			'country_id' => $this->input->post('country'),
			'address_id' => $this->input->post('address_id'),
			);
		$address_id = $this->account_model->insert_data($address_data,'address_id','address');

		$user_profile_id = $this->account_model->get_user_profile_id_by_email($this->session->userdata('logged_email')); 
		$address_profile_map_id = $this->input->post('address_profile_map_id');
		$address_profile_map_data = array(
			'user_profile_id' =>$user_profile_id, 'address_id' => ($address_id == 0) ? $address_data['address_id'] : $address_id,
			'address_profile_map_id' => $address_profile_map_id
			);
		$address_id = $this->account_model->insert_data($address_profile_map_data,'address_profile_map_id','address_profile_map');
		$driving_license_countries = $this->input->post('driving_license_country');
		$candidate_profile_data = array(
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'date_of_birth' => $this->input->post('date_of_birth'),
			'passport_number' => $this->input->post('passport_number'),
			'gender' => $this->input->post('gender'),
			'maritial_status_id' => $this->input->post('maritial_status'),
			'nationality_id' => $this->input->post('nationality'), 	
			'number_of_dependants' => $this->input->post('number_of_dependants'),
			'visa_status_id' => $this->input->post('visa_status'),
			'visa_expiration_date' => $this->input->post('visa_expiration_date'),
			'profile_pic_name' => $profile_pic_name,
			'portrait_pic_name' => $portrait_pic_name,
			'passport_copy_name' => $passport_copy_name,
			'candidate_profile_id' => $this->input->post('candidate_profile_id'),
			'driving_license_country_ids' => isset($driving_license_countries) ? remove_trailing_commas(implode(',',$driving_license_countries)) : ''
		);
		// print_r($candidate_profile_data);exit;
		if(!$is_profile_pic_set)
			unset($candidate_profile_data['profile_pic_name']);
		if(!$is_portrait_pic_set)
			unset($candidate_profile_data['portrait_pic_name']);

		$candidate_profile_id = $this->account_model->insert_data($candidate_profile_data,'candidate_profile_id','candidate_profile');

		//exit;
		set_message('Profile information has been updated successfully','alert-success');
		redirect('/candidate/profile','refresh');
		print('success');exit;
	}

	function do_upload($max_width = '1024',$max_height = '768',$input_name,$path='',$additional_types='')
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
		if (!$this->upload->do_upload($input_name))
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

	public function save_candidate_contact_info()
	{
		//print($this->input->post('contact_profile_map_id'));exit;
		$contact_id = $this->input->post('contact_id');
		$country_code = $this->input->post('country_code');
		$network_code = $this->input->post('network_code');
		$mobile = $this->input->post('mobile');

		$isMobileValid = true;

		if(!empty($country_code))
		{
			if( (!ctype_digit($country_code)) || (strlen($country_code) > 3) || (!ctype_digit($network_code)) || (!ctype_digit($mobile)))
			{
				$isMobileValid = false;
			}
		}
		else if(!empty($network_code) || !empty($mobile))
		{
			$isMobileValid = false;
		}
		
		if(!$isMobileValid)
		{
			set_message('Invalid Mobile Number ','alert-danger');
			print('failed');exit;
		}
		$contact_no = $country_code.'-'.$network_code.'-'.$mobile;
		$contact_data = array(
			'email' => $this->input->post('email'),
			'secondary_email' => $this->input->post('secondary_email'),
			'mobile' => $contact_no,
			'skype' => $this->input->post('skype'),
			'linkedin' => $this->input->post('linkedin'),
			'website' => $this->input->post('website'),
			'contact_id' => $contact_id
			);
		$contact_id = $this->account_model->insert_data($contact_data,'contact_id','contact');

		$user_profile_id = $this->account_model->get_user_profile_id_by_email($this->session->userdata('logged_email')); 
		$contact_profile_map_id = $this->input->post('contact_profile_map_id');
		$contact_profile_map_data = array(
			'user_profile_id' =>$user_profile_id,
			'contact_id' => ($contact_id == 0) ? $contact_data['contact_id'] : $contact_id,
			'contact_profile_map_id' => $contact_profile_map_id
			);
		$contact_id = $this->account_model->insert_data($contact_profile_map_data,'contact_profile_map_id','contact_profile_map');

		$candidate_profile_data = array(
			'candidate_profile_id' => $this->input->post('candidate_profile_id'),
			'preferred_contact_method' => $this->input->post('preferred_contact_method')
			);
		$candidate_profile_id = $this->account_model->insert_data($candidate_profile_data,'candidate_profile_id','candidate_profile');
		set_message('Contact information has been updated successfully','alert-success');
		print('success');exit;
	}

	public function save_about_you_info()
	{
		$about_you_data = array(
			'about_you' => $this->input->post('about_you'),
			'candidate_profile_id' => $this->input->post('candidate_profile_id')
			);
		
		$candidate_profile_id = $this->account_model->insert_data($about_you_data,'candidate_profile_id','candidate_profile');
		set_message($this->input->post('about_you'),'alert-success');
		print('success');exit;
	}
	public function save_salary_notice_period_info()
	{
		$about_you_data = array(
			'current_salary_id' => $this->input->post('current_salary'),
			'expected_salary_id' => $this->input->post('expected_salary'),
			'notice_period_id' => $this->input->post('notice_period'),
			'candidate_profile_id' => $this->input->post('candidate_profile_id'),
			'candidate_salary_notice_period_id' => $this->input->post('candidate_salary_notice_period_id')
			);
		
		$salary_notice_period_id = $this->account_model->insert_data($about_you_data,'candidate_salary_notice_period_id','candidate_salary_notice_period');
		set_message('Salary and Notice Period has been updated successfully','alert-success');
		print('success');exit;
	}

	public function save_education_info()
	{
		$education_data = array(
			'education_faculty_id' => $this->input->post('education_faculty'),
			'degree_type_id' => $this->input->post('degree_type'),
			'university' => $this->input->post('university'),
			'completion_date' => $this->input->post('completion_date'),
			'grade' => $this->input->post('grade'),
			'country_id' => $this->input->post('country'),
			'degree_id' => $this->input->post('degree_id'),
			'candidate_profile_id' => $this->input->post('candidate_profile_id')
			);
		
		$degree_id = $this->account_model->insert_data($education_data,'degree_id','cv_degree');
		/*$profile_data = array(
			'profile_completeness' => 20,
			'candidate_profile_id' =>
		);*/
		// $this->account_model->update_profile_score($education_data['candidate_profile_id']);
		set_message('Education has been updated successfully','alert-success');
		print('success');exit;
	}

	public function save_job_target_info()
	{
		//print_r($this->input->post());exit;
		$industry = $this->input->post('industry');
		$job_history_category = $this->input->post('job_history_category');
		$customer_competency = $this->input->post('customer_competency');
		$people_competency = $this->input->post('people_competency');
		$business_competency = $this->input->post('business_competency');
		$self_management_competency = $this->input->post('self_management_competency');
		$behavioral_competency = $this->input->post('behavioral_competency');
		$soft_skill_type = $this->input->post('soft_skill_type');

		$is_limit_exceeded = false;
		if(count($industry) > 3 || count($this->input->post('job_history_category')) > 3 || count($customer_competency) > 3 || count($people_competency) > 3 || count($business_competency) > 3 || count($self_management_competency) > 3 || count($behavioral_competency) > 3 || count($soft_skill_type)> 3 )
			$is_limit_exceeded = true;
		if($is_limit_exceeded)
		{
			set_message('Error Saving!. Maximum of upto 3 options allowed in each section of the Job Target','alert-danger');
			print('fail');exit;
		}
		else 
		{ 
			
			$competency_ids = '';
			if(isset($customer_competency))
				$competency_ids .= implode(',', $customer_competency);
			if(isset($people_competency))
			{
				$competency_ids = remove_trailing_commas($competency_ids).',';
				$competency_ids .= implode(',', $people_competency);
			}
			if(isset($business_competency))
			{
				$competency_ids = remove_trailing_commas($competency_ids).',';
				$competency_ids .= implode(',', $people_competency);
			}
			if(isset($self_management_competency))
			{
				$competency_ids = remove_trailing_commas($competency_ids).',';
				$competency_ids .= implode(',', $self_management_competency);
			}
			if(isset($behavioral_competency))
			{
				$competency_ids = remove_trailing_commas($competency_ids).',';
				$competency_ids .= implode(',', $behavioral_competency);
			}

			if(!isset($industry))
			{
				$industry = '';
			}
			else
				$industry = implode(',', $industry);
			
			if(!isset($job_history_category))
			{
				$job_history_category = '';
			}
			else
				$job_history_category = implode(',', $job_history_category);

			if(!isset($soft_skill_type))
			{
				$soft_skill_type = '';
			}
			else
				$soft_skill_type = implode(',', $soft_skill_type);

			$job_target_data = array(
				'career_level_id' => $this->input->post('career_level'),
			    'industry_ids' => remove_trailing_commas($industry),
			    'department_id' => $this->input->post('department'),
			    'job_history_category_ids' => remove_trailing_commas($job_history_category),
			    'competency_ids' => $competency_ids,
			    'soft_skill_type_ids' => remove_trailing_commas($soft_skill_type),
			    'candidate_profile_id' => $this->input->post('candidate_profile_id'),
			);
			//print_r($job_target_data);exit;
			$candidate_profile_id = $this->account_model->insert_data($job_target_data,'candidate_profile_id','candidate_profile');
			set_message('Job target has been updated successfully','alert-success');
			print('success');exit;
		}
	}
	
	public function save_certificate_info()
	{
		$certificate_data = array(
			'certificate_id' => $this->input->post('certificate_id'),
			'name' => $this->input->post('name'),
			'number' => $this->input->post('number'),
			'completion_date' => $this->input->post('completion_date'),
			'expiration_date' => $this->input->post('expiration_date'),
			'candidate_profile_id' => $this->input->post('candidate_profile_id')
			);
		$language_expertise_id = $this->account_model->insert_data($certificate_data,'certificate_id','cv_certificate');
		set_message('Certificate has been updated successfully','alert-success');
		print('success');exit;
	}

	public function save_language_info()
	{
		$language_data = array(
			'language_id' => $this->input->post('language'),
			'expertise' => $this->input->post('expertise'),
			'candidate_profile_id' => $this->input->post('candidate_profile_id'),
			'language_expertise_id' => $this->input->post('language_expertise_id')
			);
		$language_expertise_id = $this->account_model->insert_data($language_data,'language_expertise_id','cv_language_expertise');
		set_message('Language has been updated successfully','alert-success');
		print('success');exit;
	}
	public function save_membership_info()
	{
		$membership_data = array(
			'membership' => $this->input->post('membership'),
			'organization' => $this->input->post('organization'),
			'member_since' => $this->input->post('member_since'),
			'membership_description' => $this->input->post('membership_description'),
			'membership_id' => $this->input->post('membership_id'),
			'candidate_profile_id' => $this->input->post('candidate_profile_id')
			);
		$membership_id = $this->account_model->insert_data($membership_data,'membership_id','cv_membership');
		set_message('Memberships has been updated successfully','alert-success');
		print('success');exit;
	}

	public function save_experience_info()
	{
		$experience_data = array(
			'experience_level_id' => $this->input->post('experience_level'),
			'position' => $this->input->post('position'),
			'company_name' => $this->input->post('company_name'),
			'company_website' =>  $this->input->post('company_website'),
			'country_id' => $this->input->post('country'),
			'industry_id' => $this->input->post('industry'),
			'job_description' => $this->input->post('job_description'),
			'start_date' => $this->input->post('start_date'),
			'end_date' => $this->input->post('end_date'),
			'candidate_profile_id' => $this->input->post('candidate_profile_id'),
			'experience_id' => $this->input->post('experience_id')
			);
		//print_r($experience_data);exit;
		$experience_id = $this->account_model->insert_data($experience_data,'experience_id','cv_experience');
		$experience_reference_data = array(
			'name' => $this->input->post('reference_name'),
			'position' => $this->input->post('reference_position'),
			'mobile' => $this->input->post('reference_mobile'),
			'experience_id' => ($experience_id == 0) ? $experience_data['experience_id'] : $experience_id,
			'experience_reference_id' =>  $this->input->post('experience_reference_id')
			);
		$experience_reference_id = $this->account_model->insert_data($experience_reference_data,'experience_reference_id','cv_experience_reference');
		set_message('Work experience has been updated successfully','alert-success');
		print('success');exit;
	}

	public function application_status()
	{
		$data['page_title'] = 'Application Status';
		$user_profile_id = $this->account_model->get_user_profile_id_by_email($this->session->userdata('logged_email'));
		$data['job_applications'] = $this->account_model->get_candidate_job_applications_by_user_profile_id($user_profile_id);
		$this->load->view('portal/application_status',$data);
	}

	public function application_history()
	{
		$data['page_title'] = 'Application History';
		$user_profile_id = $this->account_model->get_user_profile_id_by_email($this->session->userdata('logged_email'));
		$data['application_histories'] = $this->account_model->get_candidate_job_application_history_by_user_profile_id($user_profile_id);
		//print_r($data['job_applications']);exit;
		$this->load->view('portal/application_history',$data);
	}

	public function recommended_jobs()
	{
		$data['page_title'] = 'Recommended Jobs';
		$job_profiles = $this->account_model->get_job_profiles(true,'DESC');

		$data['recommended_jobs'] = $this->get_recommened_jobs($job_profiles);
		$this->load->view('portal/recommended_jobs',$data);
	}

	private function get_recommened_jobs($job_profiles)
	{
		$user_profile_id = $this->account_model->get_user_profile_id_by_email($this->session->userdata('logged_email'));
		$candidate_profile_id = $this->account_model->get_candidate_profile_id_by_user_profile_id($user_profile_id);
		$candidate_jobs = $this->account_model->get_job_profiles_by_user_profile_id($user_profile_id,true,'candidate');
		$recommended_jobs = array();
		//print_r($job_profiles);exit;
		foreach ($candidate_jobs as $key => $applied_job) {
			foreach ($job_profiles as $key => $job_profile) {
				$is_job_profile_added = false;
				$has_candidate_appplied = $this->account_model->has_candidate_applied($job_profile->job_profile_id,$candidate_profile_id);
				if(!$has_candidate_appplied && !has_job_expired($job_profile->close_date)&& !$job_profile->is_position_filled)
				{
					$applied_industries = explode(',', $applied_job->industry_ids);
					$industries = explode(',', $job_profile->industry_ids);
					//$applied_position
					if(array_intersect($applied_industries, $industries) > 0)
					{
						$is_job_profile_added = true;
						array_push($recommended_jobs, $job_profile);
					}
					else
					{ 
						unset($job_profile);
					}
				}
				else
					unset($job_profile);
			}

		}
		// print '<pre>';print_r($recommended_jobs);exit;
		return $recommended_jobs;
	}

	public function candidate_visibility()
	{
		$data['page_title'] = 'Profile Visibility';
		$user_profile_id = $this->account_model->get_user_profile_id_by_email($this->session->userdata('logged_email'));
		$data['employer_views'] = $this->account_model->get_candidate_profile_visibility_count_by_type($user_profile_id,'employer_views');
		$data['cv_views'] = $this->account_model->get_candidate_profile_visibility_count_by_type($user_profile_id,'cv_views');
		// $data['profile_views'] = $this->account_model->get_candidate_profile_visibility_summary($user_profile_id);
 		// print_r($data['profile_views']);exit;
		//$profile_views = $this->account_model->get_candidate_profile_visibility($user_profile_id);
		//$data['month_views_breakdown'] = $this->get_monthly_views_breakdown($profile_views);
		
		$this->load->view('portal/candidate_visibility',$data);
	}

	private function get_monthly_views_breakdown($profile_views)
	{
		// Didnt do logic cause no point
	}

	public function public_profile()
	{
		$data['page_title'] = 'Public Profile View';
		$this->load->view('portal/candidate_public_profile');
	}

	public function delete_cv_item()
	{
		$section = $this->input->get('section');
		$id = $this->input->get('id');
		$user_profile_id = $this->account_model->get_user_profile_id_by_email($this->session->userdata('logged_email'));
		$candidate_profile_id = $this->account_model->get_candidate_profile_id_by_user_profile_id($user_profile_id);
		$conditions['candidate_profile_id'] = $candidate_profile_id;
		$table_name = '';
		$conditions = array();
		if($section == 'education')
		{
			$table_name = 'cv_degree';
			$conditions['degree_id'] = $id;
		}
		elseif($section == 'work_experience')
		{
			$table_name = 'cv_experience';
			$conditions['experience_id'] = $id;
		}
		elseif($section == 'certification')
		{
			$table_name = 'cv_certificate';
			$conditions['certificate_id'] = $id;
		}
		elseif($section == 'language')
		{
			$table_name = 'cv_language_expertise';
			$conditions['language_expertise_id'] = $id;
		}
		elseif($section == 'membership')
		{
			$table_name = 'cv_membership';
			$conditions['membership_id'] = $id;
		}
		if(!empty($table_name))
		{
			$this->account_model->delete_data($table_name,$conditions);
			set_message(ucwords($section).' has been deleted successfully! ','alert-success');
		}
		else
			set_message('Something went wrong. Please try again','alert-danger');

		redirect(base_url().'candidate/profile','refresh');
	}

	/* END CANDIDATE CONTROLLERS*/

	/* START EMPLOYER CONTROLLERS*/
	
	public function employer_dashboard()
	{
		$data['page_title'] = 'Dashboard';
		$user_profile_id = $this->account_model->get_user_profile_id_by_email($this->session->userdata('logged_email'));
		$data['profile'] = $this->account_model->get_company_by_user_profile_id($user_profile_id);
		$data['address'] = $this->account_model->get_address_by_user_profile_id($user_profile_id);
		$data['contact'] = $this->account_model->get_contact_by_user_profile_id($user_profile_id);
		$data['opened_jobs'] = $this->account_model->get_all_jobs_by_type_and_user_profile_id('open',$user_profile_id);
		$data['closed_jobs'] = $this->account_model->get_all_jobs_by_type_and_user_profile_id('close',$user_profile_id);
		// print_r($data['opened_jobs']);exit;
		$this->load->view('portal/employer_dashboard',$data);
	}

	public function reports()
	{
		$data['page_title'] = 'Reports';
		$user_profile_id = $this->account_model->get_user_profile_id_by_email($this->session->userdata('logged_email'));
		$data['opened_jobs'] = $this->account_model->get_all_jobs_by_type_and_user_profile_id('open',$user_profile_id);
		$data['closed_jobs'] = $this->account_model->get_all_jobs_by_type_and_user_profile_id('close',$user_profile_id);
		$data['liked_jobs'] = $this->account_model->get_company_jobs_liked_by_user_profile_id($user_profile_id);
		$data['job_appearances'] = $this->account_model->get_job_appearance_by_user_profile_id($user_profile_id);
		$data['profile'] = $this->account_model->get_company_by_user_profile_id($user_profile_id);
		$data['job_profiles'] = $this->account_model->get_job_profiles_by_user_profile_id($user_profile_id,true);
		// print_r($data['profile']);exit;
		if(count($data['liked_jobs']))
		{
			$total = '';
			$references = '';
			foreach ($data['liked_jobs'] as $key => $job) {
				$total .= $job->total_likes.',';
				$references .= $job->job_ref_no.',';
			}
			$data['liked_job_totals'] = remove_trailing_commas($total);
			$data['liked_job_references'] = remove_trailing_commas($references);
		}
		else
		{
			$data['liked_job_totals'] = 0;
			$data['liked_job_references'] = 0;
		}

		if(count($data['job_appearances']))
		{
			$total = '';
			$references = '';
			foreach ($data['job_appearances'] as $key => $job) {
				$total .= $job->appearance_count.',';
				$references .= $job->job_ref_no.',';
			}
			$data['appearance_job_count'] = remove_trailing_commas($total);
			$data['appearance_job_references'] = remove_trailing_commas($references);
		}
		else
		{
			$data['appearance_job_count'] = 0;
			$data['appearance_job_references'] = 0;
		}
		//print_r($data['liked_jobs']);exit;
		$this->load->view('portal/reports',$data);
	}

	public function positions($type)
	{
		// print $type;
		$data['page_title'] = 'Positions '.ucwords($type);
		$user_profile_id = $this->account_model->get_user_profile_id_by_email($this->session->userdata('logged_email'));
		if($type=="opened")
			$data['positions'] = $this->account_model->get_all_jobs_by_type_and_user_profile_id('open',$user_profile_id);
		else
			$data['positions'] = $this->account_model->get_all_jobs_by_type_and_user_profile_id('close',$user_profile_id);
		$this->load->view('/portal/positions', $data);
	}

	public function employer_profile()
	{
		$data['page_title'] = 'Edit Profile';
		$user_profile_id = $this->account_model->get_user_profile_id_by_email($this->session->userdata('logged_email'));
		$data['profile'] = $this->account_model->get_company_by_user_profile_id($user_profile_id);
		$data['address'] = $this->account_model->get_address_by_user_profile_id($user_profile_id);
		$data['contact'] = $this->account_model->get_contact_by_user_profile_id($user_profile_id);
		$data['countries'] = $this->configuration_model->get_all_records('country','country','ASC');
		$data['cities'] = $this->configuration_model->get_all_records('city','city','ASC');
		//print_r($data['profile']);exit;		
		$data['representative'] = $this->account_model->get_reperesentative_by_user_profile_id($user_profile_id);
		$data['company_types'] = $this->configuration_model->get_all_records('company_type');
		$data['employee_ranges'] = $this->configuration_model->get_all_records('employee_range');
		$data['industries'] = $this->configuration_model->get_all_records('industry');
		$data['experience_levels'] = $this->configuration_model->get_all_records('experience_level');
		$data['selected_industries'] = explode(',', $data['profile']->industry_ids);

		if(empty($data['profile']->industry_ids))
			$data['profile']->industry_ids = 0;

		$data['profile']->industry_ids = remove_trailing_commas($data['profile']->industry_ids);
		$data['industry_collection'] = $this->account_model->get_data_by_id_collection($data['profile']->industry_ids,'industry','industry_id','industry');

		$this->load->view('portal/employer_profile',$data);
	}

	public function save_basic_company_info()
	{
		$is_logo_set = false;
		$company_logo = '';
		if(!empty($_FILES['company_logo']['tmp_name']))
		{
			$company_logo = $this->do_upload('1','1','company_logo','company_logos');
			$is_logo_set = true;
		}

		$company_data = array(
			'name' => $this->input->post('name'),
			'company_logo' => $company_logo,
			'company_profile_id' => $this->input->post('company_profile_id')
			);
		if(!$is_logo_set)
			unset($company_data['company_logo']);
		$address_data = array(
			'building_no' => $this->input->post('building_no'),
			'building_name' => $this->input->post('building_name'),
			'street' => $this->input->post('street'),
			'city_id' => $this->input->post('city'),
			'country_id' => $this->input->post('country'),
			'address_id' => $this->input->post('address_id'),
			);
		$address_id = $this->account_model->insert_data($address_data,'address_id','address');

		$user_profile_id = $this->account_model->get_user_profile_id_by_email($this->session->userdata('logged_email')); 
		$address_profile_map_id = $this->input->post('address_profile_map_id');
		$address_profile_map_data = array(
			'user_profile_id' =>$user_profile_id,
			'address_id' => ($address_id == 0) ? $address_data['address_id'] : $address_id,
			'address_profile_map_id' => $address_profile_map_id
			);
		$address_id = $this->account_model->insert_data($address_profile_map_data,'address_profile_map_id','address_profile_map');


		$contact_id = $this->input->post('contact_id');
		$contact_data = array(
			'email' => $this->input->post('email'),
			'mobile' => $this->input->post('country_code').'-'.$this->input->post('mobile'),
			'website' => $this->input->post('website'),
			'contact_id' => $contact_id
			);
		$contact_id = $this->account_model->insert_data($contact_data,'contact_id','contact');
		$contact_profile_map_id = $this->input->post('contact_profile_map_id');
		$contact_profile_map_data = array(
			'user_profile_id' =>$user_profile_id,
			'contact_id' => ($contact_id == 0) ? $contact_data['contact_id'] : $contact_id,
			'contact_profile_map_id' => $contact_profile_map_id
		);
		$contact_id = $this->account_model->insert_data($contact_profile_map_data,'contact_profile_map_id','contact_profile_map');
		
		if(empty($company_data['company_ref_no']))
		{
			$user_profile_id = $this->account_model->get_user_profile_id_by_email($this->session->userdata('logged_email'));
			$data['profile'] = $this->account_model->get_company_by_user_profile_id($user_profile_id);
			$company_ref_no = '';
			$company_ref_no = $data['profile']->company_profile_id.'COP'.strstr( $data['profile']->name . ' ', ' ', true ).date('Ymd');
			$company_ref_no = strtolower(str_replace(array('.', ',',' '),'', $company_ref_no));
			$company_data["company_ref_no"] = $company_ref_no;
			//$company_data["company_profile_id"] = $company_profile_id;
			//print $company_ref_no;exit;
			//$this->account_model->insert_data($company_data,'company_profile_id','company_profile');
		}
		$this->account_model->insert_data($company_data,'company_profile_id','company_profile');
		
		redirect(base_url().'employer/profile','refresh');
	}

	public function save_representative()
	{
		//print($this->input->post('company_profile_id'));exit;
		$representative_data = array(
			'name' => $this->input->post('name'),
			'position' => $this->input->post('position'),
			'email' => $this->input->post('email'),
			'mobile' => $this->input->post('mobile'),
			'skype' => $this->input->post('skype'),
			'company_representative_id' => $this->input->post('company_representative_id'),
			'company_profile_id' => $this->input->post('company_profile_id')
			);
		$this->account_model->insert_data($representative_data,'company_representative_id','company_representative');
		print('success');exit;
	}

	public function save_company_registration_info()
	{
		//print_r($this->input->post());exit;
		$industry_ids = remove_trailing_commas(implode(',', $this->input->post('industry')));
		$company_registration_data = array(
			'owner' => $this->input->post('owner'),
			'company_type_id' => $this->input->post('company_type'),
			'license_no' => $this->input->post('license_no'),
			'employee_range_id' => $this->input->post('employee_range'),
			'industry_ids' => $industry_ids,
			'company_profile_id' => $this->input->post('company_profile_id')
			);
		//print_r($company_registration_data);exit;
		$this->account_model->insert_data($company_registration_data,'company_profile_id','company_profile');
		print('success');exit;
	}
	public function save_about_company_info()
	{
		$about_you_data = array(
			'about_company' => $this->input->post('about_company'),
			'company_profile_id' => $this->input->post('company_profile_id')
			);
		
		$candidate_profile_id = $this->account_model->insert_data($about_you_data,'company_profile_id','company_profile');

		print('success');exit;
	}
	public function save_job_profile_attachments()
	{
		//print_r($this->input->post());exit;
		$is_kpi_set = false;
		$is_appraisal_set = false;
		$is_criteria_set = false;
		$kpi_performance = '';
		$appraisal_evaluation = '';
		$accept_reject_criteria = '';
		if(!empty($_FILES['kpi_performance']['tmp_name']))
		{
			$kpi_performance = $this->do_upload('1','1','kpi_performance','job_profile_attachments');
			$is_kpi_set = true;
		}
		if(!empty($_FILES['appraisal_evaluation']['tmp_name']))
		{
			$appraisal_evaluation = $this->do_upload('1','1','appraisal_evaluation','job_profile_attachments');
			$is_appraisal_set = true;
		}
		if(!empty($_FILES['accept_reject_criteria']['tmp_name']))
		{
			$accept_reject_criteria = $this->do_upload('1','1','accept_reject_criteria','job_profile_attachments');
			$is_criteria_set = true;
		}
		
		
		
		$job_profile_id = $this->input->post('job_profile_id');
		$attachment_data['job_profile_id'] = $job_profile_id;
		if($is_kpi_set)	
			$attachment_data['kpi_performance'] = $kpi_performance;
		if($is_appraisal_set)	
			$attachment_data['appraisal_evaluation'] = $appraisal_evaluation;
		if($is_criteria_set)	
			$attachment_data['accept_reject_criteria'] = $accept_reject_criteria;

		//print_r($attachment_data);exit;

		$this->account_model->insert_data($attachment_data,'job_profile_id','job_profile');
		// if($attachment_data['job_profile_id'] != 0)
		// {
		// 	$data['profile'] = $this->account_model->get_job_profile_by_id($job_profile_id);
		// 	print_r($data['profile']->posting_elements.','.implode(',', $this->input->post('is_displayed_in_posting')));exit;
		// 	$posting_data = array(
		// 		'posting_elements' =>  $data['profile']->posting_elements.','.implode(',', $this->input->post('is_displayed_in_posting'))
		// 		);
		// }
		redirect(base_url().'employer/job_profile/'.$job_profile_id,'refresh');
		print('success');exit;
	}

	public function save_job_profile_question()
	{
		$question_type = $this->input->post('question_type');
		$question_data = array(
			"job_profile_id" => $this->input->post('job_profile_id'),
			"job_profile_question_id" => $this->input->post('job_profile_question_id'),
			"question" => $this->input->post('question'),
			"type" => $question_type,
		);
		//print_r($question_data);exit;
		$this->account_model->insert_data($question_data,'job_profile_question_id','job_profile_question');
		redirect(base_url().'employer/job_profile/'.$question_data['job_profile_id'].'?#'.$question_type.'_tab','refresh');
	}

	public function delete_job_profile_question($job_profile_id=0,$job_profile_question_id=0)
	{

		$question_data = array(
			"job_profile_id" => $job_profile_id,
			"job_profile_question_id" => $job_profile_question_id
		);
		//print_r($question_data);exit;
		$this->account_model->delete_data('job_profile_question',$question_data);
		redirect(base_url().'employer/job_profile/'.$job_profile_id.'?#ques_tab','refresh');
	}

	public function save_job_profile()
	{
		//print_r($this->input->post());exit;

		$competency_data_set = $this->input->post('competency');
		$job_profile_id = $this->input->post('job_profile_id');
		if(!isset($job_profile_id))
			$job_profile_id = 0;
		$process_completed = $this->account_model->get_filter_process_state_by_job_profile_id($job_profile_id);
		if(empty($process_completed))
		{
			$is_position_filled = $this->input->post('is_position_filled');
			$job_profile_data = array(
				"job_profile_id" => $job_profile_id,
				"company_profile_id" => $this->input->post('company_profile_id'),
				"position" => $this->input->post('position'),
				"is_position_filled" => isset($is_position_filled) ? 1 : 0,
				"close_date" => $this->input->post('close_date'),
				"posting_elements" => implode(',', $this->input->post('is_displayed_in_posting')),
				"screening_elements" => implode(',', $this->input->post('is_shown_in_screening')),
				"qualification_elements" => implode(',', $this->input->post('is_shown_in_qualification')),
				"experience_level_id" => $this->input->post('experience_level'),
			    "career_level_id" => $this->input->post('career_level'),
			    "job_description" => $this->input->post('job_description'),
			    "job_duties" => $this->input->post('job_duties'),
			    "first_year_expectations" => $this->input->post('first_year_expectations'),
			    "working_days" => $this->input->post('working_days'),
			    "working_hours" => $this->input->post('working_hours'),
			    "is_weekend_work_required" => $this->input->post('is_weekend_work_required'),
			    "work_after_working_hours" => $this->input->post('work_after_working_hours'),
			    "work_shift_required" => $this->input->post('work_shifts'),
			    "is_overtime_required" => $this->input->post('is_overtime_required'),
			    "overtime_policy" => $this->input->post('overtime_policy'),
			    "organization_structure_position" => $this->input->post('organization_structure_position'),
			    "reporting_to" => $this->input->post('reporting_to'),
			    "total_employees_reporting_to" => $this->input->post('total_employees_reporting_to'),
			    "grade_of_employee" => $this->input->post('grade_of_employee'),
			    "position_promotion" => $this->input->post('position_promotion'),
			    "probation_period" => $this->input->post('probation_period'),
			    "equipments_devices_used" => $this->input->post('equipments_devices_used'),
			    "degree_type_id" => $this->input->post('degree_type'),
			    "is_training_certificate_retained" => $this->input->post('is_training_certificate_retained'),
			    "training_offered" => $this->input->post('training_offered'),
			    "selection_type" => $this->input->post('selection_type'),
			    "notice_period_id" => $this->input->post('notice_period'),
			    "vacancy_created_by" => $this->input->post('vacancy_created_by'),
			    "preferred_age_id" => $this->input->post('preferred_age'),
			    "maritial_status_id" => $this->input->post('maritial_status'),
			    "visa_status_id" => $this->input->post('visa_status'),
			    "salary_range_id" => $this->input->post('salary_range'),
			    "education_faculty_id" => $this->input->post('education_faculty'),
			    "department_id" => $this->input->post('department'),
			    "employment_type_id" => $this->input->post('employment_type'),
			    "employment_status_id" => $this->input->post('employment_status'),
			    "industry_ids" => $this->input->post('industry'),
			    "job_history_category_ids" => $this->input->post('job_history_category'),
			    "nationality_ids" => $this->input->post('nationality'),
			    "competency_ids" => $this->input->post('competency'),
			    "genders" => $this->input->post('gender'),
			    "required_language_ids" => $this->input->post('required_language'),
			    "country_id" => $this->input->post('country'),
			    "work_environment_ids" => $this->input->post('work_environment'),
			    "mobility_ids" => $this->input->post('mobility'),
			    "position_activity_ids" => $this->input->post('position_activity_ids'),
			    "skills" => $this->input->post('skills'),
			    //"undefined" => $this->input->post('position'),
			    "learning_resource_ids" => $this->input->post('learning_resource'),
			    "driving_license_country_ids" => $this->input->post('driving_license_country'),
			    "soft_skill_type_ids" => $this->input->post('soft_skill_type'),
			);
			$job_profile_id = $this->account_model->insert_data($job_profile_data,'job_profile_id','job_profile');
			
			if($job_profile_data['job_profile_id'] == 0)
				$this->insert_employee_benefits($job_profile_id);
			else
				$this->insert_employee_benefits($job_profile_data['job_profile_id']);

			if(empty($job_profile_data['job_ref_no']) && $job_profile_data['job_profile_id'] == 0)
			{

				$user_profile_id = $this->account_model->get_user_profile_id_by_email($this->session->userdata('logged_email'));
				$data['profile'] = $this->account_model->get_company_by_user_profile_id($user_profile_id);
				$job_ref_no = '';
				$job_ref_no = $job_profile_id.'JOP'.strstr($data['profile']->name . ' ', ' ', true ).date('Ymd');
				$job_ref_no = strtolower(str_replace(array('.', ',',' '),'', $job_ref_no));
				//$job_profile_data = array();
				$job_profile_data["job_ref_no"] = $job_ref_no;
				$job_profile_data["job_profile_id"] = $job_profile_id;
				//print $job_profile_data["job_profile_id"];exit;
				$this->account_model->insert_data($job_profile_data,'job_profile_id','job_profile');
			}
			set_message('Job profile has been successfully saved!','alert-success');
			print('success');exit;	
		}
		else
		{
			set_message('Job profile cannot be updated because the recruitment process has already started!','alert-danger');
			print('fail');exit;	
		}
	}

	public function insert_employee_benefits($job_profile_id)
	{
		$this->account_model->delete_data('job_profile_employee_benefits_map',array('job_profile_id' =>$job_profile_id));
		$employee_benefits = $this->configuration_model->get_all_records('employee_benefit');
		foreach ($employee_benefits as $key => $employee_benefit) {
			$is_checked = $this->input->post('employee_benefits_'.$employee_benefit->employee_benefit_id.'_checkbox');
			$amount = $this->input->post('employee_benefits_'.$employee_benefit->employee_benefit_id.'_amount');
			if(isset($is_checked))
			{
				if(!isset($amount))
					$amount = '';
				$benefit_data = array(
					'job_profile_id' => $job_profile_id,
					'employee_benefit_id' => $employee_benefit->employee_benefit_id,
					'amount' => $amount,
				);
				//print_r($benefit_data);
				$this->account_model->insert_data($benefit_data,'job_profile_employee_benefits_map_id','job_profile_employee_benefits_map');
			}
		}

	}

	public function test_screening_map()
	{
		$job_profile_id = 28;
		$points = 0;
		$job_profile = $this->account_model->get_job_profile_by_id($job_profile_id);
		$candidate = $this->account_model->get_candidate_by_candidate_profile_id(163);
		$user_profile_id = $this->account_model->get_user_profile_id_by_candidate_profile_id($candidate->candidate_profile_id);
		$salary_notice_period = $this->account_model->get_salary_notice_period_by_candidate_id($candidate->candidate_profile_id);
		$screening_elements = explode(',',$job_profile->screening_elements);
		//print $job_profile->screening_elements;exit;
		if($user_profile_id != 0)
		{
			if(in_array('industry', $screening_elements))
			{
				if(!empty($job_profile->industry_ids))
				{
					if(count(array_intersect(explode(',', $candidate->industry_ids),explode(',', $job_profile->industry_ids))) > 0)
					{
						$points++;
						print '<pre> industry';
					}
				}
				else
				{
					$points++;
					print '<pre> industry1';
				}
			}

			if(in_array('nationality', $screening_elements))
			{
				if(!empty($job_profile->nationality_ids))
				{
					if(in_array($candidate->nationality_id,explode(',', $job_profile->nationality_ids)))
					{
						$points++;
						print '<pre> nationality';
					}
				}
				else
				{
					$points++;
					print '<pre> nationality1';
				}
			}

			if(in_array('gender', $screening_elements))
			{
				if(!empty($job_profile->genders))
				{
					if(in_array(strtolower($candidate->gender),explode(',', $job_profile->genders)))
					{
						$points++;
						print '<pre> gender';
					}
				}
				else
				{
					$points++;
					print '<pre> gender1';
				}
			}

			if(in_array('required_language', $screening_elements))
			{
				$data['languages_expertise'] = $this->account_model->get_language_expertise_by_user_profile_id($user_profile_id);
				$language_ids = '';
				foreach ($data['languages_expertise'] as $key => $language) {
					$language_ids .= $language->language_id .',';
				}
				$language_ids = remove_trailing_commas($language_ids);
				if(!empty($job_profile->required_language_ids))
				{
					if(count(array_intersect(explode(',', $language_ids),explode(',', $job_profile->required_language_ids))) > 0)
					{
						$points++;
						print '<pre> language';
					}
				}
				else
				{
					$points++;
					print '<pre> language1';
				}
			}

			if(in_array('experience_level', $screening_elements))
			{
				$data['experiences'] = $this->account_model->get_experience_by_user_profile_id($user_profile_id);
				$experience_level_ids = '';
				foreach ($data['experiences'] as $key => $experience) {
					$experience_level_ids .= $experience->experience_level_id .',';
				}
				$experience_level_ids = remove_trailing_commas($experience_level_ids);
				if(!empty($job_profile->experience_level_id))
				{
					if(in_array($job_profile->experience_level_id,explode(',',$experience_level_ids)))
					{
						$points++;
						print '<pre> experience_level';
					}
				}
				else
				{
					$points++;
					print '<pre> experience_level1';
				}
			}

			if(in_array('country', $screening_elements))
			{
				if(!empty($job_profile->country_id) && $job_profile->country_id != 0)
				{
					if($candidate->country_id == $job_profile->country_id)
					{
						$points++;
						print '<pre> country';
					}
				}
				else
				{
					$points++;
					print '<pre> country1';
				}
			}

			if(in_array('notice_period', $screening_elements))
			{
				if(!empty($job_profile->salary_range))
				{
					if($salary_notice_period->notice_period_id == $job_profile->notice_period_id)
					{
						$points++;
						print '<pre> notice_period';
					}
				}
				else
				{
					$points++;
					print '<pre> notice_period1';
				}
			}

			if(in_array('preferred_age', $screening_elements))
			{
				$preferred_age = $this->configuration_model->get_value_by_id('preferred_age','age','preferred_age_id',$job_profile->preferred_age_id);
				$preferred_age = explode('-', $preferred_age);
				if(!empty($job_profile->preferred_age_id) && $job_profile->preferred_age_id != 0)
				{
					if(isset($preferred_age[0]))
					{
						$age = get_age_by_date($candidate->date_of_birth);
						//print_r($preferred_age);
						//print '<pre> '.$age;
						if($preferred_age[0] < $age )
						{
							if(isset($preferred_age[1]))
							{
								if($preferred_age[1] < $age )
								{
									$points++;
									print '<pre> preferred_age';
								}
							}
							else
							{
								$points++;
								print '<pre> preferred_age';
							}
						}
					}
				}
				else
				{
					$points++;
					print 'preferred_age1';
				}
			}

			if(in_array('maritial_status', $screening_elements))
			{
				if(!empty($job_profile->maritial_status_id) && $job_profile->maritial_status_id != 0)
				{
					if($candidate->maritial_status_id == $job_profile->maritial_status_id)
					{
						$points++;
						print '<pre> maritial_status';
					}
				}
				else
				{
					$points++;
					print '<pre> maritial_status1';
				}
			}
			
			if(in_array('visa_status', $screening_elements))
			{
				if(!empty($job_profile->visa_status_id) && $job_profile->visa_status_id != 0)
				{
					if($candidate->visa_status_id == $job_profile->visa_status_id)
					{
						$points++;
						print '<pre> visa_status';
					}
				}
				else
				{
					$points++;
					print '<pre> visa_status1';
				}
			}

			if(in_array('driving_license_country', $screening_elements))
			{
				if(!empty($job_profile->driving_license_country_ids))
				{
					if(count(array_intersect(explode(',', $candidate->driving_license_country_ids),explode(',', $job_profile->driving_license_country_ids))) > 0)
					{
						$points++;
						print '<pre> driving_license_country';
					}
				}
				else
				{
					$points++;
					print '<pre> driving_license_country1';
				}
			}
			
			if(in_array('salary_range', $screening_elements))
			{
				if(!empty($job_profile->salary_range))
				{	
					if(isset($salary_notice_period->expected_salary))
					{
						if(!is_value_one_greater($salary_notice_period->expected_salary,$job_profile->salary_range))
						{
							$points++;
							print '<pre> salary_range';
						}
					}
				}
				else
				{
					$points++;
					print '<pre> salary_range1';
				}
			}	

			if(in_array('employment_status', $screening_elements))
			{
				$points;
				print '<pre> employment_status';
			}
		}	
		$points_data = array(
			'job_profile_id' => $job_profile_id,
			'candidate_profile_id' => $candidate->candidate_profile_id,
			'points' => get_percentage_value($points,count($screening_elements)),
			'type' => 'screening',
		);
		print '<pre>';print_r($points_data);exit;
	} 

	public function test_qualification_map()
	{
		$job_profile_id = 28;
		$points = 0;
		$job_profile = $this->account_model->get_job_profile_by_id($job_profile_id);
		$candidate = $this->account_model->get_candidate_by_candidate_profile_id(38);
		$user_profile_id = $this->account_model->get_user_profile_id_by_candidate_profile_id($candidate->candidate_profile_id);
		$qualification_elements = explode(',',$job_profile->qualification_elements);
		//print $job_profile->screening_elements;exit;
		if($user_profile_id != 0)
		{
			if(in_array('job_history_category', $qualification_elements))
			{
				if(!empty($job_profile->job_history_category_ids))
				{
					if(count(array_intersect(explode(',', $candidate->job_history_category_ids),explode(',', $job_profile->job_history_category_ids))) > 0)
					{
						$points++;
						print '<pre> job_history_category';
					}
				}
				else
				{
					$points++;
					print '<pre>job_history_category1';
				}
			}

			if(in_array('career_level', $qualification_elements))
			{
				if(!empty($job_profile->career_level_id) && $job_profile->career_level_id != 0)
				{
					if($candidate->career_level_id == $job_profile->career_level_id)
					{
						$points++;
						print '<pre> career_level';
					}
				}
				else
				{
					$points++;
					print '<pre> career_level';
				}
			}

			if(in_array('minimum_education_requirement', $qualification_elements))
			{
				$data['candidate_degrees'] = $this->account_model->get_education_by_user_profile_id($user_profile_id);
				$degree_type_ids = '';
				foreach ($data['candidate_degrees'] as $key => $degree) {
					$degree_type_ids .= $degree->degree_type_id .',';
				}
				$degree_type_ids = remove_trailing_commas($degree_type_ids);
				if(!empty($job_profile->degree_type_id)) //DO
				{
					if(in_array($job_profile->degree_type_id,explode(',',$degree_type_ids)))
					{
						$points++;
						print '<pre> minimum_education_requirement';
					}
				}
				else
				{
					$points++;
					print '<pre> minimum_education_requirement1';
				}
			}

			if(in_array('competencies_needed', $qualification_elements))
			{
				if(!empty($job_profile->competency_ids))
				{
					$competency_collection = $this->account_model->get_data_by_id_collection($job_profile->competency_ids,'competency','competency_id');
					$customer_competency_ids = get_competency_ids_by_type($competency_collection,'customer');
					$people_competency_ids = get_competency_ids_by_type($competency_collection,'people');
					$business_competency_ids= get_competency_ids_by_type($competency_collection,'business');
					$self_management_competency_ids = get_competency_ids_by_type($competency_collection,'self_management');
					$behavioral_competency_ids = get_competency_ids_by_type($competency_collection,'behavioral');

					if(count(array_intersect($customer_competency_ids,explode(',', $job_profile->competency_ids))) > 0)
					{
						$points++;
						print '<pre> customer_competency_ids';
					}
					if(count(array_intersect($people_competency_ids,explode(',', $job_profile->competency_ids))) > 0)
					{
						$points++;
						print '<pre> people_competency_ids';
					}
					if(count(array_intersect($business_competency_ids,explode(',', $job_profile->competency_ids))) > 0)
					{
						$points++;
						print '<pre> business_competency_ids';
					}
					if(count(array_intersect($self_management_competency_ids,explode(',', $job_profile->competency_ids))) > 0)
					{
						$points++;
						print '<pre> self_management_competency_ids';
					}
					if(count(array_intersect($behavioral_competency_ids,explode(',', $job_profile->competency_ids))) > 0)
					{
						$points++;
						print '<pre> behavioral_competency_ids';
					}
				}
				else
				{
					$points = ($points + 5);
					print '<pre> competencies_needed1';
				}
			}

			if(in_array('education_faculty', $qualification_elements))
			{
				$data['educations'] = $this->account_model->get_education_faculties_by_user_profile_id($user_profile_id);
				//print_r($data['educations']);
				$faculty_ids = '';
				foreach ($data['educations'] as $key => $education) {
					$faculty_ids .= $education->education_faculty_id .',';
				}
				$faculty_ids = remove_trailing_commas($faculty_ids);
				//print $user_profile_id;
				if(!empty($job_profile->education_faculty_id) && $job_profile->education_faculty_id != 0)
				{
					if(in_array($job_profile->education_faculty_id,explode(',',$faculty_ids)))
					{
						$points++;
						print '<pre> education_faculty';
					}
				}
				else 
				{
					$points++;
					print '<pre> education_faculty1';
				}
			}
			
			if(in_array('soft_skill_type', $qualification_elements))
			{
				if(!empty($job_profile->soft_skill_type_ids))
				{
					if(count(array_intersect(explode(',', $candidate->soft_skill_type_ids),explode(',', $job_profile->soft_skill_type_ids))) > 0)
					{
						$points++;
						print '<pre> soft_skill_type';
					}
				}
				else
				{
					$points++;
					print '<pre> soft_skill_type1';
				}
			}

			if(in_array('department', $qualification_elements))
			{
				if(!empty($job_profile->department_id) && $job_profile->department_id != 0)
				{
					if($candidate->department_id == $job_profile->department_id)
					{
						$points++;
						print '<pre> department';
					}
				}
				else
				{
					$points++;
					print '<pre> department1';
				}
			}
			
			if(in_array('employment_status', $qualification_elements))
			{
				$points++;
				print '<pre> employment_status';
			}	
		}	
		$points_data = array(
			'job_profile_id' => $job_profile_id,
			'candidate_profile_id' => $candidate->candidate_profile_id,
			'points' => get_percentage_value($points,count($qualification_elements)),
			'type' => 'qualification', 
		);
		print '<pre>';print_r($points_data);exit;
	} 

	public function shortlist_process($job_profile_id=0)
	{

		//$process_stage = ['Screening','Qualification','Question','Interview Call','Structured Interview','Test','Selection'];
		$data['page_title'] = 'Recruitment Process';
		$process = $this->input->get('process');
		$process = isset($process) ? $process : '';
		//print $process;exit;
		$data['process'] = $process != '' ? $process : 'screening';
		$process = $data['process'];
		$data['job_profile_id'] = $job_profile_id;
		//print $data['process']; exit;
		$data['process_completed'] = $this->account_model->get_filter_process_state_by_job_profile_id($job_profile_id);
		$data['process_completed'] = str_replace(' ','_', strtolower($data['process_completed']));
		$candidates_applied = $this->account_model->get_in_process_candidates_by_job_profile_id($job_profile_id);
		$data['candidates_declined'] = 0;
		$data['candidates_passed'] = 0;
		$filtered_applied_candidates = 0;
		$job_profile = $this->account_model->get_job_profile_by_id($job_profile_id);
		$data['is_job_expired'] = has_job_expired($job_profile->close_date);
		
		//if($data['process_completed'] == '' || $data['process_completed'] == 'not_viewed')
		//	$data['process_completed'] = $process;
		//print empty($data['process_completed']);exit;
		//if($data['process_completed'] != $process &&  $data['process_completed'] != 'not_viewed' && ($process == 'result' &&  $data['process_completed'] == 'selection'))
		//	redirect(base_url().'employer/job_profile/process/'.$job_profile_id.'?process='.$process,'refresh');
		$is_question_profiles_completed = $this->is_question_profiles_completed($job_profile_id);
		// print $is_question_profiles_completed ;exit;
		$data['is_question_profiles_completed'] = $is_question_profiles_completed;
		if($data['is_job_expired'] && $is_question_profiles_completed)
		{
			if($process == '' || $process == 'screening')
			{			
				if(empty($data['process_completed']))
				{
					$screening_elements = explode(',',$job_profile->screening_elements);
					//print count($screening_elements);exit;
					
					foreach ($candidates_applied as $key => $candidate)
					{
						$user_profile_id = $this->account_model->get_user_profile_id_by_candidate_profile_id($candidate->candidate_profile_id);
						$points = 0;
						$salary_notice_period = $this->account_model->get_salary_notice_period_by_candidate_id($candidate->candidate_profile_id);

						//print $job_profile->screening_elements;exit;
						
						if(in_array('industry', $screening_elements))
						{
							if(!empty($job_profile->industry_ids))
							{
								if(count(array_intersect(explode(',', $candidate->industry_ids),explode(',', $job_profile->industry_ids))) > 0)
								{
									$points++;
									// print 'industry';
								}
							}
							else
							{
								$points++;
							}
						}

						if(in_array('nationality', $screening_elements))
						{
							if(!empty($job_profile->nationality_ids))
							{
								if(in_array($candidate->nationality_id,explode(',', $job_profile->nationality_ids)))
								{
									$points++;
									// print 'nationality';
								}
							}
							else
							{
								$points++;
							}
						}

						if(in_array('gender', $screening_elements))
						{
							if(!empty($job_profile->genders))
							{
								if(in_array(strtolower($candidate->gender),explode(',', $job_profile->genders)))
								{
									$points++;
									// print 'gender';
								}
							}
							else
							{
								$points++;
							}
						}

						if(in_array('required_language', $screening_elements))
						{
							$data['languages_expertise'] = $this->account_model->get_language_expertise_by_user_profile_id($user_profile_id);
							$language_ids = '';
							foreach ($data['languages_expertise'] as $key => $language) {
								$language_ids .= $language->language_id .',';
							}
							$language_ids = remove_trailing_commas($language_ids);
							if(!empty($job_profile->required_language_ids))
							{
								if(count(array_intersect(explode(',', $language_ids),explode(',', $job_profile->required_language_ids))) > 0)
								{
									$points++;
									// print 'language';
								}
							}
							else
							{
								$points++;
							}
						}

						if(in_array('experience_level', $screening_elements))
						{
							$data['experiences'] = $this->account_model->get_experience_by_user_profile_id($user_profile_id);
							$experience_level_ids = '';
							foreach ($data['experiences'] as $key => $experience) {
								$experience_level_ids .= $experience->experience_level_id .',';
							}
							$experience_level_ids = remove_trailing_commas($experience_level_ids);
							if(!empty($job_profile->experience_level_id))
							{
								if(in_array($job_profile->experience_level_id,explode(',',$experience_level_ids)))
								{
									$points++;
									// print 'experience_level';
								}
							}
							else
							{
								$points++;
							}
						}

						if(in_array('country', $screening_elements))
						{
							if(!empty($job_profile->country_id) && $job_profile->country_id != 0)
							{
								if($candidate->country_id == $job_profile->country_id)
								{
									$points++;
									// print 'country';
								}
							}
							else
							{
								$points++;
							}
						}

						if(in_array('notice_period', $screening_elements))
						{
							if(!empty($job_profile->salary_range))
							{
								if($salary_notice_period->notice_period_id == $job_profile->notice_period_id)
								{
									$points++;
									// print 'notice_period';
								}
							}
							else
							{
								$points++;
							}
						}

						if(in_array('preferred_age', $screening_elements))
						{
							$preferred_age = $this->configuration_model->get_value_by_id('preferred_age','age','preferred_age_id',$job_profile->preferred_age_id);
							$preferred_age = explode('-', $preferred_age);
							if(!empty($job_profile->preferred_age_id) && $job_profile->preferred_age_id != 0)
							{
								if(isset($preferred_age[0]))
								{
									$age = get_age_by_date($candidate->date_of_birth);
									//print_r($preferred_age);
									//print '<pre> '.$age;
									if($preferred_age[0] < $age )
									{
										if(isset($preferred_age[1]))
										{
											if($preferred_age[1] < $age )
											{
												$points++;
											}
										}
										else
										{
											$points++;
										}
									}
								}
							}
							else
							{
								$points++;
							}
						}

						if(in_array('maritial_status', $screening_elements))
						{
							if(!empty($job_profile->maritial_status_id) && $job_profile->maritial_status_id != 0)
							{
								if($candidate->maritial_status_id == $job_profile->maritial_status_id)
								{
									$points++;
									// print 'maritial_status';
								}
							}
							else
							{
								$points++;
							}
						}
						
						if(in_array('visa_status', $screening_elements))
						{
							if(!empty($job_profile->visa_status_id) && $job_profile->visa_status_id != 0)
							{
								if($candidate->visa_status_id == $job_profile->visa_status_id)
								{
									$points++;
								}
							}
							else
							{
								$points++;
							}
						}

						if(in_array('driving_license_country', $screening_elements))
						{
							if(!empty($job_profile->driving_license_country_ids))
							{
								if(count(array_intersect(explode(',', $candidate->driving_license_country_ids),explode(',', $job_profile->driving_license_country_ids))) > 0)
								{
									$points++;
									// print 'driving_license_country';
								}
							}
							else
							{
								$points++;
							}
						}
						
						if(in_array('salary_range', $screening_elements))
						{
							if(!empty($job_profile->salary_range))
							{	
								if(isset($salary_notice_period->expected_salary))
								{
									if(!is_value_one_greater($salary_notice_period->expected_salary,$job_profile->salary_range))
									{
										$points++;
										// print 'salary_range';
									}
								}
							}
							else
								$points++;
						}

						if(in_array('employment_status', $screening_elements))
						{
							$points;
							// print 'employment_status';
						}
						
						$points_data = array(
							'job_profile_id' => $job_profile_id,
							'candidate_profile_id' => $candidate->candidate_profile_id,
							'points' => get_percentage_value($points,count($screening_elements)),
							'type' => 'screening',
						);
						//print '<pre>';print_r($points_data);
						$this->save_screening_qualification_points($points_data);
						
						//print 'success';exit;		
						//print_r($salary_notice_period);exit;
					}
					//exit;
					$loop_count = 0;
					$candidate_screening_qualification_summary = $this->account_model->get_candidate_screening_qualification_summary_by_job_profile_id_type($job_profile_id,'screening');
					$this->filter_shortlist_candidates($candidate_screening_qualification_summary,$job_profile,'Screening',30);
				}
			}
			else if($process == 'qualification')
			{
				$qualification_elements = explode(',',$job_profile->qualification_elements);
				// print count($qualification_elements);exit;
				$data['screening_passed'] = $this->account_model->get_candidate_counts_by_job_profile_id_status_process($job_profile_id,'Screening','screening');
				$filtered_applied_candidates = $data['screening_passed'];
				//print $data['process_completed'];exit;
				if($data['process_completed'] == 'screening')
				{
					foreach ($candidates_applied as $key => $candidate)
					{
						$points = 0;
						$user_profile_id = $this->account_model->get_user_profile_id_by_candidate_profile_id($candidate->candidate_profile_id);
						$is_user_declined = false;
						
						// print $job_profile->screening_elements;exit;
						// print_r(in_array($job_profile->education_faculty_id,explode(',',$faculty_ids)));exit;
						if(in_array('job_history_category', $qualification_elements))
						{
							if(!empty($job_profile->job_history_category_ids))
							{
								if(count(array_intersect(explode(',', $candidate->job_history_category_ids),explode(',', $job_profile->job_history_category_ids))) > 0)
								{
									$points++;
									//print '1';
								}
							}
							else
							{
								$points++;
							}
						}

						if(in_array('career_level', $qualification_elements))
						{
							if(!empty($job_profile->career_level_id) && $job_profile->career_level_id != 0)
							{
								if($candidate->career_level_id == $job_profile->career_level_id)
								{
									$points++;
									//print '2';
								}
							}
							else
							{
								$points++;
							}
						}

						if(in_array('minimum_education_requirement', $qualification_elements))
						{
							$data['candidate_degrees'] = $this->account_model->get_education_by_user_profile_id($user_profile_id);
							$degree_type_ids = '';
							foreach ($data['candidate_degrees'] as $key => $degree) {
								$degree_type_ids .= $degree->degree_type_id .',';
							}
							$degree_type_ids = remove_trailing_commas($degree_type_ids);
							if(!empty($job_profile->degree_type_id)) //DO
							{
								if(in_array($job_profile->degree_type_id,explode(',',$degree_type_ids)))
								{
									$points++;
									//print '3';
								}
							}
							else
							{
								$points++;
							}
						}

						
						if(!empty($job_profile->competency_ids))
						{
							$competency_collection = $this->account_model->get_data_by_id_collection($job_profile->competency_ids,'competency','competency_id');
							$customer_competency_ids = get_competency_ids_by_type($competency_collection,'customer');
							$people_competency_ids = get_competency_ids_by_type($competency_collection,'people');
							$business_competency_ids= get_competency_ids_by_type($competency_collection,'business');
							$self_management_competency_ids = get_competency_ids_by_type($competency_collection,'self_management');
							$behavioral_competency_ids = get_competency_ids_by_type($competency_collection,'behavioral');

							if(in_array('customer_competencies', $qualification_elements))
							{
								if(count(array_intersect($customer_competency_ids,explode(',', $job_profile->competency_ids))) > 0)
								{
									$points++;
								}
							}
							else
							{
								$points++;
							}

							if(in_array('people_competencies', $qualification_elements))
							{
								if(count(array_intersect($people_competency_ids,explode(',', $job_profile->competency_ids))) > 0)
								{
									$points++;
								}
							}
							else
							{
								$points++;
							}

							if(in_array('business_competencies', $qualification_elements))
							{
								if(count(array_intersect($business_competency_ids,explode(',', $job_profile->competency_ids))) > 0)
								{
									$points++;
								}
							}
							else
							{
								$points++;
							}

							if(in_array('self_management_competencies', $qualification_elements))
							{
								if(count(array_intersect($self_management_competency_ids,explode(',', $job_profile->competency_ids))) > 0)
								{
									$points++;
								}
							}
							else
							{
								$points++;
							}

							if(in_array('behavioral_competencies', $qualification_elements))
							{
								if(count(array_intersect($behavioral_competency_ids,explode(',', $job_profile->competency_ids))) > 0)
								{
									$points++;
								}
							}
							else
							{
								$points++;
							}
						}
						else
						{
							$points = ($points + 5);
						}

						if(in_array('education_faculty', $qualification_elements))
						{
							$data['educations'] = $this->account_model->get_education_faculties_by_user_profile_id($user_profile_id);
							$faculty_ids = '';
							foreach ($data['educations'] as $key => $education) {
								$faculty_ids .= $education->education_faculty_id .',';
							}
							$faculty_ids = remove_trailing_commas($faculty_ids);
							//print $faculty_ids;
							if(!empty($job_profile->faculty_ids))
							{
								if(in_array($job_profile->education_faculty_id,explode(',',$faculty_ids)))
								{
									$points++;
									//print '5';
								}
							}
							else 
							{
								$points++;
							}
						}
						
						if(in_array('soft_skill_type', $qualification_elements))
						{
							if(!empty($job_profile->soft_skill_type_ids))
							{
								if(count(array_intersect(explode(',', $candidate->soft_skill_type_ids),explode(',', $job_profile->soft_skill_type_ids))) > 0)
								{
									$points++;
									//print '6';
								}
							}
							else
							{
								$points++;
							}
						}

						if(in_array('department', $qualification_elements))
						{
							if(!empty($job_profile->department_id) && $job_profile->department_id != 0)
							{
								if($candidate->department_id == $job_profile->department_id)
								{
									$points++;
									//print '7';
								}
							}
							else
							{
								$points++;
							}
						}
						
						if(in_array('employment_status', $qualification_elements))
						{
							$points++;
							//print '8';
						}
								
						$points_data = array(
							'job_profile_id' => $job_profile_id,
							'candidate_profile_id' => $candidate->candidate_profile_id,
							'points' => get_percentage_value($points,count($qualification_elements)),
							'type' => 'qualification', 
						);
						//print $is_user_declined;
						$this->save_screening_qualification_points($points_data);
					}
					$candidate_screening_qualification_summary = $this->account_model->get_candidate_screening_qualification_summary_by_job_profile_id_type($job_profile_id,'qualification');
					//print_r($candidate_screening_qualification_summary);exit;
					if($filtered_applied_candidates > 0)		
						$this->filter_shortlist_candidates($candidate_screening_qualification_summary,$job_profile,'Qualification',20);
				} 
			} 
			else if($process == 'question')
			{
				$data['total_candidate_unanswered'] = $this->account_model->get_unanswered_questions_count_by_job_profile_id($job_profile_id);
				$data['total_candidate_answered'] = $this->account_model->get_answered_questions_count_by_job_profile_id($job_profile_id);
				//$data['questions'] = $this->account_model->get_job_profile_questions_by_id_and_type($job_profile_id,'question');
				$data['qualification_passed'] = $this->account_model->get_candidate_counts_by_job_profile_id_status_process($job_profile_id,'Qualification','qualification');
				$data['interview_scheduling_completed'] = $data['qualification_passed'] == total_interview_schedules_for_job($job_profile_id) ? 1 : 0;
				//print_r($data['questions']);exit;
				$filtered_applied_candidates = $data['qualification_passed'];
				$proceed_status = $this->input->get('status');
				
				if($data['process_completed'] == 'qualification')
				{
					if($data['total_candidate_unanswered'] == 0 || (isset($proceed_status) && $proceed_status == 'proceed'))
					{
						$data['proceed_question'] = true;
						foreach ($candidates_applied as $key => $candidate) {
							$is_candidate_answered_question = $this->account_model->has_candidate_answered_questions($job_profile_id,$candidate->candidate_profile_id);
							if(!$is_candidate_answered_question)
							{
								$questions = $this->account_model->get_job_profile_questions_by_id_and_type($job_profile_id,'question');
								foreach ($questions as $key => $question)
								{
									$question_answer_data = array(
									'job_profile_question_id' => $question->job_profile_question_id,
									'candidate_profile_id' => $candidate->candidate_profile_id,
									'choice' => 'not_answered',
									'points' => '0'
									);
									$this->account_model->insert_data($question_answer_data,'job_profile_question_answer_id','job_profile_question_answer');
								}
								$this->account_model->remove_position_questions_code_by_candidate_job_profile_id($candidate->candidate_profile_id,$job_profile_id);
							}
						}
						// print '<pre>';print_r($candidates_applied);exit;
						// print '<pre>';print_r($job_profile);exit;
						$candidate_question_answer_summary = $this->account_model->get_candidate_question_profile_summary_by_job_profile_id_type($job_profile_id,$process);
						//print_r($candidate_question_answer_summary);exit;
						if($filtered_applied_candidates > 0)
							$this->filter_shortlist_candidates($candidate_question_answer_summary,$job_profile,'Question',15);
					}
				}
			}
			else if($process == 'interview_call')
			{
				// print '<pre>';print_r($candidates_applied);exit;
				// print '<pre>';print_r($job_profile);exit; 
				$data['questions'] = $this->account_model->get_job_profile_questions_by_id_and_type($job_profile_id,$process);
				$data['questions_passed'] = $this->account_model->get_candidate_counts_by_job_profile_id_status_process($job_profile_id,'Question','question');
				$data['interview_call_feedback_count'] = $this->account_model->get_candidate_counts_by_job_profile_id_status_process($job_profile_id,'Interview Call Request','interview_call_request');
				$data['reject_interview_requests'] = $this->account_model->get_rejected_interview_request_count_by_job_profile_id($job_profile_id); 
				$data['interview_call_feedback_count'] = $data['interview_call_feedback_count'] + $data['reject_interview_requests'];
				//$data['declined_candidates'] = $this->account_model->get_candidate_declined_by_job_profile_id_status_process($job_profile_id,'interview_call');
				$filtered_applied_candidates = $data['questions_passed'];
				//$data['interview_call_feedback_count'] = $data['interview_call_feedback_count'] -  - $data['reject_interview_requests'];
				// print $data['process_completed'].'--'.$data['interview_call_feedback_count'];exit;
				// print $data['interview_call_feedback_count'].'--'.$filtered_applied_candidates.'---'.$data['reject_interview_requests'];exit;
				if($data['process_completed'] == 'question' && $data['interview_call_feedback_count'] == $filtered_applied_candidates)
				{
					$candidate_question_answer_summary = $this->account_model->get_candidate_question_profile_summary_by_job_profile_id_type($job_profile_id,$process);
					//print_r($candidate_question_answer_summary );exit;
					//print_r($filtered_applied_candidates);exit;
					if($filtered_applied_candidates > 0)
						$this->filter_shortlist_candidates($candidate_question_answer_summary,$job_profile,'Interview Call',10);
				}
					// $process = str_replace('_',' ',$process);
			}
			else if($process == 'structured_interview')
			{
				// print '<pre>';print_r($candidates_applied);exit;
				// print '<pre>';print_r($job_profile);exit;
				$data['questions'] = $this->account_model->get_job_profile_questions_by_id_and_type($job_profile_id,$process);
				$data['interview_calls_passed'] = $this->account_model->get_candidate_counts_by_job_profile_id_status_process($job_profile_id,'Interview Call','interview_call');
				$data['structured_interview_feedback_count'] = $this->account_model->get_questions_completed_count_by_job_profile_id_and_type($job_profile_id,$process);
				$filtered_applied_candidates = $data['interview_calls_passed'];
				if($data['process_completed'] == 'interview_call' && $data['structured_interview_feedback_count'] == $filtered_applied_candidates)
				{
					$candidate_question_answer_summary = $this->account_model->get_candidate_question_profile_summary_by_job_profile_id_type($job_profile_id,$process);
					if($filtered_applied_candidates > 0)
							$this->filter_shortlist_candidates($candidate_question_answer_summary,$job_profile,'Structured Interview',7);
				}
					// $process = str_replace('_',' ',$process);
			}
			else if($process == 'test')
			{
				// print '<pre>';print_r($candidates_applied);exit;
				// print '<pre>';print_r($job_profile);exit;
				$data['questions'] = $this->account_model->get_job_profile_questions_by_id_and_type($job_profile_id,$process);
				$data['structured_interviews_passed'] = $this->account_model->get_candidate_counts_by_job_profile_id_status_process($job_profile_id,'Structured Interview','structured_interview');
				$data['test_feedback_count'] = $this->account_model->get_test_selection_completed_count_by_job_profile_id_and_type($job_profile_id,$process);
				$filtered_applied_candidates = $data['structured_interviews_passed'];
				if($data['process_completed'] == 'structured_interview' && $data['test_feedback_count'] == $filtered_applied_candidates)
				{
					$candidate_test_selection_summary = $this->account_model->get_candidate_test_selection_by_job_profile_id_type($job_profile_id,$process);
					// print_r($candidate_question_answer_summary);exit;
					if($filtered_applied_candidates > 0)
							$this->filter_shortlist_candidates($candidate_test_selection_summary,$job_profile,'Test',5);
				}
					// $process = str_replace('_',' ',$process);
			}
			else if($process == 'selection')
			{
				// print '<pre>';print_r($candidates_applied);exit;
				// print '<pre>';print_r($job_profile);exit;
					$data['questions'] = $this->account_model->get_job_profile_questions_by_id_and_type($job_profile_id,$process);
					$data['test_passed'] = $this->account_model->get_candidate_counts_by_job_profile_id_status_process($job_profile_id,'Test','test');
					$data['selection_feedback_count'] = $this->account_model->get_test_selection_completed_count_by_job_profile_id_and_type($job_profile_id,$process);
					$filtered_applied_candidates = $data['test_passed'];
					if( $data['process_completed'] == 'test'  && $data['selection_feedback_count'] == $filtered_applied_candidates)
					{
						$candidate_test_selection_summary = $this->account_model->get_candidate_test_selection_by_job_profile_id_type($job_profile_id,$process);
						// print_r($candidate_question_answer_summary);exit;
						if($filtered_applied_candidates > 0)
							$this->filter_shortlist_candidates($candidate_test_selection_summary,$job_profile,'Selection',3);
					}
					// $process = str_replace('_',' ',$process);
			}
			else if($process == 'result' && $data['process_completed'] == 'selection')
			{
				$data['selection_passed'] = $this->account_model->get_candidate_counts_by_job_profile_id_status_process($job_profile_id,'Test','test');
				$filtered_applied_candidates = $data['selection_passed'];
				$data['screening_summary'] =  $this->account_model->get_candidate_screening_qualification_by_job_profile_id_type($job_profile_id,'screening');
				$data['qualification_summary'] =  $this->account_model->get_candidate_screening_qualification_by_job_profile_id_type($job_profile_id,'qualification');
				$data['question_summary'] =  $this->account_model->get_candidate_question_profile_summary_by_job_profile_id_type($job_profile_id,'question');;
				$data['interview_call_summary'] =  $this->account_model->get_candidate_question_profile_summary_by_job_profile_id_type($job_profile_id,'interview_call');
				$data['structured_interview_summary'] =  $this->account_model->get_candidate_question_profile_summary_by_job_profile_id_type($job_profile_id,'structured_interview');
				$data['test_summary'] = $this->account_model->get_candidate_test_selection_by_job_profile_id_type($job_profile_id,'test');
				$data['selection_summary'] = $this->account_model->get_candidate_test_selection_by_job_profile_id_type($job_profile_id,'selection');
				// print_r($data['interview_call_summary']);exit;
			}

			$data['candidates'] = $this->account_model->get_in_process_candidates_by_job_profile_id($job_profile_id);
			if($process == 'result' && $data['process_completed'] == 'selection')
			{
				$data['candidates'] = $this->set_candidate_points_questions($data['candidates'],$data['screening_summary'],'screening_summary');
				$data['candidates'] = $this->set_candidate_points_questions($data['candidates'],$data['qualification_summary'],'qualification_summary');
				//print '<pre>'; print_r($data['candidates']);exit;
				$data['candidates'] = $this->set_candidate_points_questions($data['candidates'],$data['question_summary'],'question_summary');
				$data['candidates'] = $this->set_candidate_points_questions($data['candidates'],$data['interview_call_summary'],'interview_call_summary');
				$data['candidates'] = $this->set_candidate_points_questions($data['candidates'],$data['structured_interview_summary'],'structured_interview_summary');
				$data['candidates'] = $this->set_candidate_points_questions($data['candidates'],$data['test_summary'],'test_summary');
				$data['candidates'] = $this->set_candidate_points_questions($data['candidates'],$data['selection_summary'],'selection_summary');
			}
			//print '<pre>';print_r($data['candidates']);exit;
			//$data['interview_call_questions'] = $this->account_model->get_job_profile_questions_by_id_and_type($job_profile_id,'interview_call');
			//$data['structured_questions'] = $this->account_model->get_job_profile_questions_by_id_and_type($job_profile_id,'structured');
			$data['candidates_passed'] = $this->account_model->get_candidate_counts_by_job_profile_id_status_process($job_profile_id,ucwords(str_replace('_',' ',$process)),$process);
			$data['candidates_declined'] = $this->account_model->get_candidate_counts_by_job_profile_id_status_process($job_profile_id,'Declined',$process);
			
			if($process == 'screening')
				$data['candidates_applied'] = $this->account_model->get_candidates_application_counts_by_job_profile_id($job_profile_id);
			else
				$data['candidates_applied'] = $filtered_applied_candidates;
			// $data['candidates_applied'] = 0;
			// print_r(ucwords(str_replace('_',' ',$process)));exit;
			$data['percentage_passed'] = $data['candidates_passed'] != 0 ? get_percentage_value($data['candidates_applied'],$data['candidates_passed']) : 0;
			$data['percentage_declined'] = $data['candidates_declined'] != 0 ? get_percentage_value($data['candidates_applied'],$data['candidates_declined']) : 0;

			// print $data['candidates_passed'];exit; 
			$data['profile'] = $this->account_model->get_job_profile_by_id($job_profile_id);
		}
		$this->load->view('portal/shortlist_process',$data);
	}

	private function filter_shortlist_candidates($candidates,$job_profile,$process,$filter_limit)
	{
		$job_profile_id = $job_profile->job_profile_id;
		$filtering_status_id = $this->account_model->get_filtering_status_id_by_status($process);
		if(strtolower($process) != 'screening')
			$this->account_model->insert_data(array('job_profile_id'=>$job_profile_id,'filtering_status_id'=>$filtering_status_id),'job_profile_id','job_profile_filtering_status');
		else
			$this->account_model->insert_data(array('job_profile_id'=>$job_profile_id,'filtering_status_id'=>$filtering_status_id),'job_profile_filtering_status_id','job_profile_filtering_status');
		$mail_data = array(
			'from_email' => 'recruitment@recruitment-ally.com',
			'from_email_title' => 'RecruitmentAlly',
			'job_ref_no' => $job_profile->job_ref_no,
			'position' => $job_profile->position,
			'subject' => 'Shortlisting Process - '.$job_profile->position,
			'process' => ucwords(str_replace('_',' ',$process)),
			'is_declined' => false,
		); 
		$loop_count = 0; 
		foreach ($candidates as $key => $candidate) {
			$email = $this->account_model->get_email_by_candidate_profile_id($candidate->candidate_profile_id);
			$is_candidate_answered_question = $this->account_model->has_candidate_answered_questions($job_profile_id,$candidate->candidate_profile_id);
			if($loop_count >= $filter_limit)
			{
				$filtering_status_id = $this->account_model->get_filtering_status_id_by_status('Declined');
				$mail_data['is_declined'] = true;
			}
			else
			{
				$filtering_status_id = $this->account_model->get_filtering_status_id_by_status($process);
				$mail_data['is_declined'] = false;
			}
			$application_id = $this->account_model->candidate_job_application_status_id($job_profile_id,$candidate->candidate_profile_id);	
			$job_data = array(
					'candidate_job_application_status_id' => $application_id,
					'filtering_status_id' => $filtering_status_id
			);
			$this->account_model->insert_data($job_data,'candidate_job_application_status_id','candidate_job_application_status');

			$history_data = array(
				'candidate_job_application_status_id' => $application_id,
				'filtering_status_id' => $filtering_status_id,
				'filtering_state' => str_replace(' ','_', strtolower($process)),
			);
			$is_recorded = $this->account_model->is_application_history_recorded($history_data);
			if(!$is_recorded)
				$this->account_model->insert_data($history_data,'candidate_job_application_status_history_id','candidate_job_application_status_history');
			$mail_data['to_email'] = $email;
			$this->send_email($mail_data,'job_shortlisting_process');
			$loop_count++; 

			if($process == 'Qualification')
			{
				if(!$mail_data['is_declined'])
				{
					$question_code =  rand(15000,100000).uniqid();
					$question_link_data = array(
							'candidate_profile_id' => $candidate->candidate_profile_id,
							'job_profile_id' => $job_profile_id,
							'code' => $question_code
					);
					$this->account_model->insert_data($question_link_data,'job_profile_question_link_id','job_profile_question_link');
					$mail_data['question_code'] = $question_code;
					$mail_data['subject'] = 'Shortlisting Process - We have some questions';
					$this->send_email($mail_data,'question_process');
				}
			}
		}
	}

	private function is_question_profiles_completed($job_profile_id)
	{
		$total_posting_questions = $this->account_model->get_job_profile_questions_count_by_id_and_type($job_profile_id,'question');
		$total_interview_call_questions = $this->account_model->get_job_profile_questions_count_by_id_and_type($job_profile_id,'interview_call');
		$total_structured_interview_questions = $this->account_model->get_job_profile_questions_count_by_id_and_type($job_profile_id,'structured_interview');
		if($total_posting_questions == 0 || $total_interview_call_questions == 0 || $total_structured_interview_questions == 0)
			return 0;
		return 1;
	}

	private function set_candidate_points_questions($candidates,$summary,$summary_type='question_summary')
	{
		foreach ($summary as $key => $value) {
			foreach ($candidates as $key => &$candidate) {
				if($value->candidate_profile_id == $candidate->candidate_profile_id)
				{
					$summary_data = array(
						'points' => $value->points,
						'total_questions' =>isset($value->total_questions) ? $value->total_questions : '',
						//'candidate_profile_id' =>$candidate->candidate_profile_id,
					);
					if(!isset($candidate->summary))
						$candidate->summary = array();
					array_push($candidate->summary,$summary_data);
				}
 
			}
		}
		return $candidates;
	}

	public function process_settings($job_profile_id=0)  
	{
		$data['page_title'] = 'Recruitment Process Settings';
		$data['job_profile_id'] = $job_profile_id;
		$data['candidates'] = $this->account_model->get_in_process_candidates_by_job_profile_id($job_profile_id);
		$data['interview_call_questions'] = $this->account_model->get_job_profile_questions_by_id_and_type($job_profile_id,'interview_call');
		$data['structured_interview_questions'] = $this->account_model->get_job_profile_questions_by_id_and_type($job_profile_id,'structured_interview');
		$data['process_completed'] = $this->account_model->get_filter_process_state_by_job_profile_id($job_profile_id);
		$data['process_completed'] = str_replace(' ','_', strtolower($data['process_completed']));
		$data['interview_scheduling_completed'] = count($data['candidates']) <= total_interview_schedules_for_job($job_profile_id) ? 1 : 0;
		$data['interview_call_feedback_count'] = $this->account_model->get_questions_completed_count_by_job_profile_id_and_type($job_profile_id,'interview_call');
		$data['structured_interview_feedback_count'] = $this->account_model->get_questions_completed_count_by_job_profile_id_and_type($job_profile_id,'structured_interview');
		$data['test_feedback_count'] = $this->account_model->get_test_selection_completed_count_by_job_profile_id_and_type($job_profile_id,'test');
		$data['selection_feedback_count'] = $this->account_model->get_test_selection_completed_count_by_job_profile_id_and_type($job_profile_id,'selection');
		// print_r($data['process_completed']);exit;
		$this->load->view('/portal/process_settings',$data);
	}

	public function schedule_interview($job_profile_id)
	{
		$interview_data = array(
			'job_profile_id' =>$job_profile_id,
			'candidate_profile_id' => $this->input->post('interview_candidate'),
			'message' => trim($this->input->post('interview_message')),
			'interview_date' => $this->input->post('interview_date_time'),
			'code' => rand(15000,100000).uniqid(),
		);
		$this->account_model->insert_data($interview_data,'interview_schedule_id','interview_schedule');

		$job_profile = $this->account_model->get_job_profile_by_id($job_profile_id);
		$email = $this->account_model->get_email_by_candidate_profile_id($interview_data['candidate_profile_id']);
		$mail_data = array(
						'from_email' => 'info@webnet-ally.com',
						'from_email_title' => 'RecruitementAlly',
						'to_email' => $email,
						'job_ref_no' => $job_profile->job_ref_no,
						'position' => $job_profile->position,
						'subject' => $job_profile->position.' - Interview Call',
						'is_interview' => true,
						'interview_date' => $interview_data['interview_date'],
						'interview_message' => $interview_data['message'],
						'interview_code' => $interview_data['code']
		);  
		$this->send_email($mail_data,'job_shortlisting_process');
		set_message('Interview has been scheduled for the selected candidate','alert-success');
		redirect(base_url().'employer/job_profile/process/'.$job_profile_id.'?process=question','refresh');
	}

	public function save_question_profile_answers($job_profile_id,$is_position_question=false)
	{
		$process = $this->input->get('process');
		$questions = $this->account_model->get_job_profile_questions_by_id_and_type($job_profile_id,$process);
		// print_r($questions);exit;
		$candidate_profile_id = $this->input->post('candidate_profile_id');
		foreach ($questions as $key => $question) {
			$question_arr = $this->input->post($question->job_profile_question_id);
			$choice_marks = '';
			if(isset($question_arr))
				$choice_marks = $question_arr[0];
			$choice_marks = explode('_',$choice_marks);
			// print_r($choice_marks);exit;
			$choice = $choice_marks[0];
			$points = $choice_marks[1];

			$question_answer_data = array(
				'job_profile_question_id' => $question->job_profile_question_id,
				'candidate_profile_id' => $candidate_profile_id,
				'choice' => $choice,
				'points' => $points
			);
			$this->account_model->insert_data($question_answer_data,'job_profile_question_answer_id','job_profile_question_answer');
		}
		if($process == 'interview_call' && !$is_position_question)
		{
			$interview_call_file = '';
			$interview_call_set = false;
			if(!empty($_FILES['interview_call_file']['tmp_name']))
			{
				$interview_call_file = $this->do_upload('1','1','interview_call_file','shortlisting_feedback_attachments');
				$interview_call_set = true;
			}
			if($interview_call_set)
			{
				$feedback_data = array(
					'interview_call' => $interview_call_file,
					'job_profile_id' => $job_profile_id,
					'candidate_profile_id' => $candidate_profile_id,
				);
				$this->account_model->insert_data($feedback_data,'shortlisting_feedback_attachment_id','shortlisting_feedback_attachment');
			}
		}
		//exit;
		if(!$is_position_question)
			redirect(base_url().'employer/job_profile/process_settings/'.$job_profile_id.'?process='.$process,'refresh');
	}

	public function save_test_selection_points($job_profile_id)
	{
		$process=$this->input->get('process');
		$candidate_profile_id=$this->input->post('candidate_profile_id');
		$points=$this->input->post('test_points');

		$test_selection_data = array(
			'job_profile_id' => $job_profile_id,
			'candidate_profile_id' => $candidate_profile_id,
			'points' => $points,
			'type' =>$process,
		);

		$this->account_model->insert_data($test_selection_data,'test_selection_result_id','test_selection_result');

		$results_file = '';
		$results_file_set = false;
		if(!empty($_FILES['results_file']['tmp_name']))
		{
			$results_file = $this->do_upload('1','1','results_file','shortlisting_feedback_attachments');
			$results_file_set = true;
		}
		if($results_file_set)
		{
			$shortlisting_feedback_attachment_id = $this->configuration_model->get_column_by_conditions('shortlisting_feedback_attachment','shortlisting_feedback_attachment_id',array('job_profile_id' => $job_profile_id,'candidate_profile_id' => $candidate_profile_id));
			$feedback_data = array(
				$process => $results_file,
				'job_profile_id' => $job_profile_id,
				'candidate_profile_id' => $candidate_profile_id,
				'shortlisting_feedback_attachment_id' => $shortlisting_feedback_attachment_id,
			);
			$this->account_model->insert_data($feedback_data,'shortlisting_feedback_attachment_id','shortlisting_feedback_attachment');
		}

		redirect(base_url().'employer/job_profile/process_settings/'.$job_profile_id.'?process='.$process,'refresh');
	}

	private function save_screening_qualification_points($points_data)
	{

		$screening_qualification_data = array(
			'job_profile_id' => $points_data['job_profile_id'],
			'candidate_profile_id' => $points_data['candidate_profile_id'],
			'points' => $points_data['points'],
			'type' => $points_data['type'],
		);

		$this->account_model->insert_data($screening_qualification_data,'screening_qualification_result_id','screening_qualification_result');
	}

	public function view_candidate($candidate_profile_id = 0)
	{
            $data['page_title'] = 'Public Profile View';
            //print $candidate_profile_id;exit;
            $user_profile_id = $this->account_model->get_user_profile_id_by_email($this->session->userdata('logged_email'));
            //print $user_profile_id;exit;
            //print get_user_type();exit;
            if(get_user_type() != 'candidate')
            {
                    $company_profile_id = $user_profile_id;
                    $user_profile_id = $this->account_model->get_user_profile_id_by_candidate_profile_id($candidate_profile_id);
                    $visibility_data = array(
                            'viewed_profile_id' => $user_profile_id,
                            'viewed_by' =>  $company_profile_id,
                            'viewed_by_type' => get_user_type(),
                    );
                    //$this->account_model->insert_data($visibility_data,'profile_view_id','profile_view');
                    //print $user_profile_id;exit;
            }

            $data['profile'] = $this->account_model->get_candidate_by_user_profile_id($user_profile_id);  //Candidate Profile, Salary and Notice Period
            $data['address'] = $this->account_model->get_address_by_user_profile_id($user_profile_id);
            //print_r($data['profile']);exit;
            $data['contact'] = $this->account_model->get_contact_by_user_profile_id($user_profile_id);
			if(isset($data['profile']->candidate_profile_id))
			{
					$data['salary_notice_period'] = $this->account_model->get_salary_notice_period_by_candidate_id($data['profile']->candidate_profile_id);

					$full_name = $data['profile']->first_name.' '. $data['profile']->last_name ;
					$data['public_profile_url'] = base_url().'people/'.$data['profile']->candidate_profile_id.'/'.strtolower($full_name) ;
			}
            // print_r($data['salary_notice_period']);exit;
            //print(empty($data['profile']));exit;
            $data['educations'] = $this->account_model->get_education_by_user_profile_id($user_profile_id); //Degree Table
            //print_r($data['educations']);exit;
            $data['experiences'] = $this->account_model->get_experience_by_user_profile_id($user_profile_id);

            $data['certificates'] = $this->account_model->get_certificate_by_user_profile_id($user_profile_id);
            $data['language_expertise'] = $this->account_model->get_language_expertise_by_user_profile_id($user_profile_id);
            $data['memberships'] = $this->account_model->get_membership_by_user_profile_id($user_profile_id);

            if(empty($data['profile']->industry_ids))
                    $data['profile']->industry_ids = 0;
            if(empty($data['profile']->competency_ids))
                    $data['profile']->competency_ids = 0;
            if(empty($data['profile']->driving_license_country_ids))
                    $data['profile']->driving_license_country_ids = 0; 

            $data['profile']->industry_ids = remove_trailing_commas($data['profile']->industry_ids);
            $data['profile']->competency_ids = remove_trailing_commas($data['profile']->competency_ids);
            $data['profile']->driving_license_country_ids = remove_trailing_commas($data['profile']->driving_license_country_ids);

            $data['industry_collection'] = $this->account_model->get_data_by_id_collection($data['profile']->industry_ids,'industry','industry_id','industry');
            $data['job_history_collection'] = $this->account_model->get_data_by_id_collection($data['profile']->job_history_category_ids,'job_history_category','job_history_category_id','history_category');
            $data['competency_collection'] = $this->account_model->get_data_by_id_collection($data['profile']->competency_ids,'competency','competency_id');
            $data['soft_skill_collection'] = $this->account_model->get_data_by_id_collection($data['profile']->soft_skill_type_ids,'soft_skill_type','soft_skill_type_id');
			$data['driving_license_collection'] = $this->account_model->get_data_by_id_collection($data['profile']->driving_license_country_ids,'country','country_id','country');
			
            $this->load->view('/portal/candidate_profile_view', $data);
	}

	public function candidate_message_list()
	{
            $data['page_title'] = 'Candidates Message List';
            $user_profile_id = $this->account_model->get_user_profile_id_by_email($this->session->userdata('logged_email'));
            
            $data['candidate_messages'] = $this->account_model->get_candidate_messages_by_sent_by($user_profile_id);
            
//            print_r($data['canditate_messages']);exit;

            $this->load->view('/portal/candidates_message_list', $data);
	}

	public function draft_candidate_message($candidate_profile_id = 0)
	{
            $data['page_title'] = 'Candidate Message';
            //print $candidate_profile_id;exit;
            $user_profile_id = $this->account_model->get_user_profile_id_by_email($this->session->userdata('logged_email'));
            //print $user_profile_id;exit;
            //print get_user_type();exit;
            if(get_user_type() != 'candidate')
            {
                    $company_profile_id = $user_profile_id;
                    $user_profile_id = $this->account_model->get_user_profile_id_by_candidate_profile_id($candidate_profile_id);
                    $visibility_data = array(
                            'viewed_profile_id' => $user_profile_id,
                            'viewed_by' =>  $company_profile_id,
                            'viewed_by_type' => get_user_type(),
                    );
                    //$this->account_model->insert_data($visibility_data,'profile_view_id','profile_view');
                    //print $user_profile_id;exit;
            }

            $data['profile'] = $this->account_model->get_candidate_by_user_profile_id($user_profile_id);  //Candidate Profile, Salary and Notice Period
            
            $data['contact'] = $this->account_model->get_contact_by_user_profile_id($user_profile_id);
            
            $this->load->view('/portal/draft_candidate_message', $data);
	}
        
        public function send_candidate_message()
        {
            $profile_id = $this->input->post('candidate_profile_id');
            $name = $this->input->post('candidate_name');
            $email = $this->input->post('candidate_email');
            $subject = $this->input->post('subject');
            $message = $this->input->post('message');
            
            $user_profile_id = $this->account_model->get_user_profile_id_by_email($this->session->userdata('logged_email'));
        
            $this->load->library('email');
            $config['mailtype'] = 'html';

            $this->email->initialize($config);
            $this->email->clear();
            $this->email->from('info@webnet-ally.com', 'Recruitment Ally');
            $this->email->to($email);
            $this->email->subject('Message from Recruitment Ally - '.$subject);
            $this->email->message($message);
            
            $message_data = [];
            
            $message_data["candidate_profile_id"] = $profile_id;
            $message_data["receiver_email"] = $email;
            $message_data["subject"] = $subject;
            $message_data["message"] = $message;
            $message_data["sent_on"] = date("Y-m-d H:i:s");
            $message_data["sent_by"] = $user_profile_id;
            //print $job_profile_data["job_profile_id"];exit;
            $this->account_model->insert_data($message_data,'candidate_message_id','candidate_message');

            set_message('Candidate Message has been successfully sent!','alert-success');
            
            // if ($this->email->send() == true) {
            //     $status = 1;
            // } else {
			// 	$status = 0;
            //    // print_r($this->email->print_debugger());
			// }
			
			redirect(base_url().'employer/job_profile','refresh');
        }

        //OLD
	public function search_candidate()
	{
		$data['page_title'] = 'Candidate Search';
		$search_options = array(
			'keyword' => ($this->input->get_post('keyword_s')) ? $this->input->get_post('keyword_s') : '',
			'industry' => $this->input->get_post('industry_s') ? $this->input->get_post('industry_s') : '',
			'experience_level' => $this->input->get_post('experience_level_s') ? $this->input->get_post('experience_level_s') : '',
			'country' => $this->input->get_post('country_s') ? $this->input->get_post('country_s') : '',
			// 'page' => $this->input->get_post('page') ? $this->input->get_post('page') : '0',
		);
		$data['candidates'] = $this->account_model->get_candidate_profiles_by_search_options($search_options);
		//print '<pre>';print_r($data['candidates']);exit;
		$this->load->view('/portal/candidate_search', $data);
	}

	public function search_candidate_ajax()
	{
		$data['page_title'] = 'Candidate Search';
		$is_ajax = $this->input->is_ajax_request();
		if($is_ajax)
		{
			$limit = $this->input->get('length');
			$offset = $this->input->get('start');
			$search_value = $this->input->get('search[value]');
			$search_options = array(
				'keyword' => ($this->input->get_post('keyword_s')) ? $this->input->get_post('keyword_s') : '',
				'industry' => $this->input->get_post('industry_s') ? $this->input->get_post('industry_s') : '',
				'experience_level' => $this->input->get_post('experience_level_s') ? $this->input->get_post('experience_level_s') : '',
				'country' => $this->input->get_post('country_s') ? $this->input->get_post('country_s') : '',
				'search_value' => $search_value,
			// 'page' => $this->input->get_post('page') ? $this->input->get_post('page') : '0',
			);

			$data['candidates'] = $this->account_model->get_candidate_profiles_by_search_options_ajax($search_options);
			$candidates_count = count($data['candidates']);
			$data['candidates'] = array_splice($data['candidates'], $offset,$limit);
			$total_records =$this->account_model->get_candidate_profiles_count();
			$candidates_data = array(
				'draw' => $this->input->get('draw'),
				'recordsTotal' => $total_records->total_records,
				'recordsFiltered' => $candidates_count,
				// 'data' => json_encode($data['candidates']),
			);
			$dt_data = [];
			foreach ($data['candidates'] as $key => $candidate) {
				$info_data = '';
				$image_path = !empty($candidate->profile_pic_name) ? base_url().'uploads/candidate_profiles/'.$candidate->profile_pic_name : base_url().'assets/portal/images/avatar.png';
				if(isset($candidate->career_level)){
					$info_data =  '<h6 style="margin-top:0px;margin-bottom:4px;">';
                    if(isset($candidate->career_level))
                    	$info_data.= $candidate->career_level.', ';
                     if(isset($candidate->department))
                     	$info_data.= $candidate->department;
                    $info_data.='</h6>';
				}
                if(isset($candidate->email))
                	$info_data.= '<a href="#">'.$candidate->email.'</a>';
                $info_data.= '<p class="desc">';
                if(!empty($candidate->about_you))
                	$info_data.=limit_words($candidate->about_you,60);
                $info_data.='</p>';
				array_push($dt_data, array(
						'<img width="120" class="img-responsive pro-img" src="'.$image_path.'">',
						$info_data,
						'<a href="'.base_url().'employer/view_candidate/'.$candidate->candidate_profile_id.'" target="_blank">View Profile</a>',
					)
				);
			}
			$candidates_data['data']= $dt_data;
			// print_r($dt_data);exit;
			echo json_encode($candidates_data);exit;
		}
		else		
			$this->load->view('/portal/search_candidate_ajax', $data);
		//print '<pre>';print_r($data['candidates']);exit;
	}

	public function view_candidates($job_profile_id=0,$candidate_type)
	{
		//print $candidate_type;exit;
		
		$data['page_title'] = 'Candidates List';
		$data['job_profile_id'] = $job_profile_id;
		$data['multiply_total'] = 1;
		$data['view_type'] = '';
		if($candidate_type == 'applied_candidates')
		{
			$data['candidate_profiles'] = $this->account_model->get_candidates_by_job_profile_id($job_profile_id);
		}
		//
		elseif($candidate_type == 'passed_screening')
		{
			$data['candidate_profiles'] = $this->account_model->get_candidates_by_job_profile_id_and_filter_status($job_profile_id,'Screening');
			$data['candidate_summaries'] = $this->account_model->get_candidate_screening_qualification_summary_by_job_profile_id_type($job_profile_id,'screening');
			$data['view_type'] = 'screening';
		}
		elseif($candidate_type == 'passed_qualification')
		{
			$data['candidate_profiles'] = $this->account_model->get_candidates_by_job_profile_id_and_filter_status($job_profile_id,'Qualification');
			$data['candidate_summaries'] = $this->account_model->get_candidate_screening_qualification_summary_by_job_profile_id_type($job_profile_id,'qualification');
			$data['view_type'] = 'qualification';
		}
		elseif($candidate_type == 'passed_question')
		{
			$data['candidate_profiles'] = $this->account_model->get_candidates_by_job_profile_id_and_filter_status($job_profile_id,'Question');
			$data['candidate_summaries'] = $this->account_model->get_candidate_question_profile_summary_by_job_profile_id_type($job_profile_id,'question');
			$data['multiply_total'] = 5;
			$data['view_type'] = 'question';
		}
		elseif($candidate_type == 'passed_interview_call')
		{
			$data['candidate_profiles'] = $this->account_model->get_candidates_by_job_profile_id_and_filter_status($job_profile_id,'Interview Call');
			$data['candidate_summaries'] = $this->account_model->get_candidate_question_profile_summary_by_job_profile_id_type($job_profile_id,'interview_call');
			$data['multiply_total'] = 4;
			$data['view_type'] = 'interview_call';
		}
		elseif($candidate_type == 'passed_structured_interview')
		{
			$data['candidate_profiles'] = $this->account_model->get_candidates_by_job_profile_id_and_filter_status($job_profile_id,'Structured Interview');
			$data['candidate_summaries'] = $this->account_model->get_candidate_question_profile_summary_by_job_profile_id_type($job_profile_id,'structured_interview');
			$data['multiply_total'] = 4;
			$data['view_type'] = 'structured_interview';
		}
		elseif($candidate_type == 'passed_test')
		{
			$data['candidate_profiles'] = $this->account_model->get_candidates_by_job_profile_id_and_filter_status($job_profile_id,'Test');
			$data['candidate_summaries'] = $this->account_model->get_candidate_test_selection_by_job_profile_id_type($job_profile_id,'test');
			$data['view_type'] = 'test';
		}
		elseif($candidate_type == 'passed_selection')
		{
			$data['candidate_profiles'] = $this->account_model->get_candidates_by_job_profile_id_and_filter_status($job_profile_id,'Selection');
			$data['candidate_summaries'] = $this->account_model->get_candidate_test_selection_by_job_profile_id_type($job_profile_id,'selection');
			$data['view_type'] = 'selection';
		}
		elseif($candidate_type == 'declined_candidates')
		{
			$data['candidate_profiles'] = $this->account_model->get_candidates_by_job_profile_id_and_filter_status($job_profile_id,'Declined');
			//print_r($data['candidate_profiles']);exit;
		}
		elseif($candidate_type == 'declined_qualification')
		{
			$data['candidate_profiles'] = $this->account_model->get_candidates_by_job_profile_id_and_filter_status($job_profile_id,'Declined');
		}
		elseif($candidate_type == 'interview_schedule')
		{
			$data['candidate_profiles'] = $this->account_model->get_candidate_interviews_by_job_profile_id($job_profile_id);
			$data['view_type'] = 'interview_schedule';
		}

		$data['industries'] = $this->configuration_model->get_all_records('industry');
		$data['countries'] = $this->configuration_model->get_all_records('country','country','ASC');
		$data['experience_levels'] = $this->configuration_model->get_all_records('experience_level');
	 	// print '<pre>';print_r($data['candidate_summaries'] );exit;
		$this->load->view('/portal/candidates_list', $data);
	}

	public function job_profile_listing()
	{
		$data['page_title'] = 'Job Profile Listings';
		$user_profile_id = $this->account_model->get_user_profile_id_by_email($this->session->userdata('logged_email'));
		$data['job_profiles'] = $this->account_model->get_job_profiles_by_user_profile_id($user_profile_id,true);
		// print_r($data['job_profiles']);exit;
		$this->load->view('/portal/job_profile_listing',$data);
	}

	public function update_position_filled_status($job_profile_id)
	{
		$process_completed = $this->account_model->get_filter_process_state_by_job_profile_id($job_profile_id);
		// print $process_completed;exit;
		if(strtolower($process_completed) == 'selection' && !empty($process_completed))
		{
			$status = $this->input->get('status');

			if(!isset($status))
				$status = 0;
			//print $status;
			$profile_data = array(
				'job_profile_id' => $job_profile_id,
				'is_position_filled' => ($status == 'true') ? 1 : 0,
			);
			//print_r($profile_data);exit;
			$this->account_model->insert_data($profile_data,'job_profile_id','job_profile');
			set_message('Job profile status has been successfully updated','alert-success');
		}
		else
			set_message('Position status cannot be updated without completing the recruitment process','alert-danger');
		redirect(base_url().'employer/job_profile','refresh');
	}

	public function job_profile($job_profile_id=false)
	{
		//print $job_profile_id;
		$data['page_title'] = 'Edit Job Profile';
		if($job_profile_id === false)
			redirect(base_url().'employer','refresh');
		$user_profile_id = $this->account_model->get_user_profile_id_by_email($this->session->userdata('logged_email'));
		$data['company_profile_id'] = $this->account_model->get_company_profile_id_user_profile_id($user_profile_id);
		//print $param;exit;
		$data['profile'] = $this->account_model->get_job_profile_by_id($job_profile_id);  //Candidate Profile, Salary and Notice Period
		// print_r($data['profile']);exit; 
		$data['company_profile'] = $this->account_model->get_company_by_user_profile_id($user_profile_id);
		$data['career_levels'] = $this->configuration_model->get_all_records('career_level');
		$data['languages'] = $this->configuration_model->get_all_records('language');
		$data['degree_types'] = $this->configuration_model->get_all_records('degree_type');
		$data['industries'] = $this->configuration_model->get_all_records('industry');
		$data['preferred_ages'] = $this->configuration_model->get_all_records('preferred_age');
		$data['employment_types'] = $this->configuration_model->get_all_records('employment_type');
		$data['employment_statuses'] = $this->configuration_model->get_all_records('employment_status');
		$data['departments'] = $this->configuration_model->get_all_records('department');
		$data['job_history_categories'] = $this->configuration_model->get_all_records('job_history_category');
		$data['competencies'] = $this->configuration_model->get_all_records('competency');
		$data['customer_competencies'] = $this->configuration_model->get_all_records_filter_by_type('competency','competency_type','customer');
		$data['people_competencies'] = $this->configuration_model->get_all_records_filter_by_type('competency','competency_type','people');
		$data['business_competencies'] = $this->configuration_model->get_all_records_filter_by_type('competency','competency_type','business');
		$data['self_management_competencies'] = $this->configuration_model->get_all_records_filter_by_type('competency','competency_type','self_management');
		$data['behavioral_competencies'] = $this->configuration_model->get_all_records_filter_by_type('competency','competency_type','behavioral');
		$data['soft_skill_types'] = $this->configuration_model->get_all_records('soft_skill_type');
		$data['countries'] = $this->configuration_model->get_all_records('country','country','ASC');
		$data['cities'] = $this->configuration_model->get_all_records('city','city','ASC');
		$data['nationalities'] = $this->configuration_model->get_all_records('nationality','nationality','ASC');
		$data['notice_periods'] = $this->configuration_model->get_all_records('notice_period');
		$data['salary_ranges'] = $this->configuration_model->get_all_records('salary_range');
		$data['experience_levels'] = $this->configuration_model->get_all_records('experience_level');
		$data['education_faculties'] = $this->configuration_model->get_all_records('education_faculty');
		$data['maritial_statuses'] = $this->configuration_model->get_all_records('maritial_status');
		$data['employee_benefits'] = $this->configuration_model->get_all_records('employee_benefit');
		$data['learning_resources'] = $this->configuration_model->get_all_records('learning_resource');
		$data['work_environments'] = $this->configuration_model->get_all_records('work_environment');
		$data['mobilities'] = $this->configuration_model->get_all_records('mobility');
		$data['position_activities'] = $this->configuration_model->get_all_records('position_activity');
		$data['skill_types'] = $this->configuration_model->get_all_records('skill_type');
		$data['visa_statuses'] = $this->configuration_model->get_all_records('visa_status');
		$data['locations'] = $data['countries'];

		$data['questions'] = $this->account_model->get_job_profile_questions_by_id_and_type($job_profile_id,'question');
		$data['interview_call_questions'] = $this->account_model->get_job_profile_questions_by_id_and_type($job_profile_id,'interview_call');
		$data['structured_questions'] = $this->account_model->get_job_profile_questions_by_id_and_type($job_profile_id,'structured_interview');
		// print_r($data['job_profile_questions'] );exit;
		//$data['learning_resources'] = $this->configuration_model->get_all_records('learning_resource');
		
		//json_encode(preg_replace('/\industry\b/', 'text', json_encode($new_arr)));
		$new_arr[] = '';
		foreach($data['industries']  as $category)
		{
			$new_arr[] = $category;
		}
		$data['industries'] = json_encode(str_replace('industry','text',str_replace('industry_id', 'id', str_replace('"",','',json_encode($new_arr)))));

		unset($new_arr);
		foreach($data['job_history_categories']  as $category)
		{
			$new_arr[] = $category;
		}
		$data['job_history_categories'] = json_encode(str_replace('history_category','text',str_replace('job_history_category_id', 'id', json_encode($new_arr))));
		unset($new_arr);
		foreach($data['languages']  as $category)
		{
			$new_arr[] = $category;
		}
		$data['languages'] = json_encode(str_replace('language','text',str_replace('language_id', 'id', json_encode($new_arr))));
		unset($new_arr);
		foreach($data['competencies']  as $category)
		{
			$new_arr[] = $category;
		}
		$data['competencies'] = json_encode(str_replace('competency','text',str_replace('competency_id', 'id', json_encode($new_arr))));
		unset($new_arr);
		foreach($data['customer_competencies']  as $category)
		{
			$new_arr[] = $category;
		}
		$data['customer_competencies'] = json_encode(str_replace('competency','text',str_replace('competency_id', 'id', json_encode($new_arr))));
		unset($new_arr);
		foreach($data['people_competencies']  as $category)
		{
			$new_arr[] = $category;
		}
		$data['people_competencies'] = json_encode(str_replace('competency','text',str_replace('competency_id', 'id', json_encode($new_arr))));
		unset($new_arr);
		foreach($data['business_competencies']  as $category)
		{
			$new_arr[] = $category;
		}
		$data['business_competencies'] = json_encode(str_replace('competency','text',str_replace('competency_id', 'id', json_encode($new_arr))));
		unset($new_arr);
		foreach($data['self_management_competencies']  as $category)
		{
			$new_arr[] = $category;
		}
		$data['self_management_competencies'] = json_encode(str_replace('competency','text',str_replace('competency_id', 'id', json_encode($new_arr))));
		unset($new_arr);
		foreach($data['behavioral_competencies']  as $category)
		{
			$new_arr[] = $category;
		}
		$data['behavioral_competencies'] = json_encode(str_replace('competency','text',str_replace('competency_id', 'id', json_encode($new_arr))));
		unset($new_arr);
		foreach($data['soft_skill_types']  as $category)
		{
			$new_arr[] = $category;
		}
		$data['soft_skill_types'] = json_encode(str_replace('skill_type','text',str_replace('soft_skill_type_id', 'id', json_encode($new_arr))));
		unset($new_arr);
		foreach($data['nationalities']  as $category)
		{
			$new_arr[] = $category;
		}
		$data['nationalities'] = json_encode(str_replace('nationality','text',str_replace('nationality_id', 'id', json_encode($new_arr))));
		unset($new_arr);
		foreach($data['countries']  as $category)
		{
			$new_arr[] = $category;
		}
		$data['countries'] = json_encode(str_replace('country','text',str_replace('country_id', 'id', json_encode($new_arr))));
		// unset($new_arr);
		// foreach($data['employee_benefits']  as $category)
		// {
		// 	$new_arr[] = $category;
		// }
		// $data['employee_benefits'] = json_encode(str_replace('benefit','text',str_replace('employee_benefit_id', 'id', json_encode($new_arr))));
		unset($new_arr);
		foreach($data['learning_resources']  as $category)
		{
			$new_arr[] = $category;
		}
		$data['learning_resources'] = json_encode(str_replace('resource','text',str_replace('learning_resource_id', 'id', json_encode($new_arr))));
		
		unset($new_arr);
		foreach($data['work_environments']  as $category)
		{
			$new_arr[] = $category;
		}

		$data['work_environments'] = json_encode(str_replace('environment','text',str_replace('work_environment_id', 'id', json_encode($new_arr))));
		
		unset($new_arr);
		foreach($data['mobilities']  as $category)
		{
			$new_arr[] = $category;
		}

		$data['mobilities'] = json_encode(str_replace('mobility','text',str_replace('mobility_id', 'id', json_encode($new_arr))));
		
		unset($new_arr);
		foreach($data['position_activities']  as $category)
		{
			$new_arr[] = $category;
		}

		$data['position_activities'] = json_encode(str_replace('activity','text',str_replace('position_activity_id', 'id', json_encode($new_arr))));
		
		unset($new_arr);
		foreach($data['skill_types']  as $category)
		{
			$new_arr[] = $category;
		}

		$data['skill_types'] = json_encode(str_replace('skill_type','text',str_replace('skill_type_id', 'id', json_encode($new_arr))));

        //print_r($data['employee_benefits']);exit;
		$this->load->view('portal/job_profile',$data);
	}

	public function question_profile()
	{
		$data['page_title'] = 'Question Profile';
		$this->load->view('portal/question_profile');
	}

	public function saved_jobs()
	{
		$data['page_title'] = 'Positions Saved';
		$user_profile_id = $this->account_model->get_user_profile_id_by_email($this->session->userdata('logged_email'));
		// $candidate_profile_id = $this->account_model->get_candidate_profile_id_by_user_profile_id($user_profile_id);
		$data['saved_jobs'] = $this->account_model->get_saved_jobs_by_candidate_profile_id($user_profile_id);
		//$this->account_model->insert_all_countries();
		//print_r($data['saved_jobs']);exit;
		$this->load->view('portal/saved_jobs',$data);
	}

	public function candidate_settings()
	{
		$data['page_title'] = 'Settings';
		$this->load->view('portal/candidate_settings',$data);
	}

	public function employer_settings()
	{
		$data['page_title'] = 'Settings';
		$this->load->view('portal/employer_settings',$data);
	}

	public function question_answers($job_profile_id,$type)
	{
		$data['questions'] = $this->account_model->get_job_profile_questions_by_id_and_type($job_profile_id,$type);
		$user_profile_id = $this->account_model->get_user_profile_id_by_email($this->session->userdata('logged_email'));
		// $candidate_profile_id = $this->account_model->get_candidate_profile_id_by_user_profile_id($user_profile_id);
		$data['saved_jobs'] = $this->account_model->get_saved_jobs_by_candidate_profile_id($user_profile_id);
		//print_r($data['saved_jobs']);exit;
		$this->load->view('portal/saved_jobs',$data);
	}

	public function position_questions($code='')
	{
		$data['page_title'] = 'Position Questions';
		$data['questions'] = $this->account_model->get_job_profile_questions_by_code_and_type($code,'question');
		$data['question_link'] = $this->account_model->position_question_link_data_by_code($code);
		$success = $this->input->get_post('save');
		$data['success'] = '';
		if(isset($success))
			$data['success'] = 'success';
		// $data['']
		//print_r($data);exit;
		$this->load->view('position_questions',$data);
	}

	public function save_position_questions($code)
	{

		$this->save_question_profile_answers($this->input->post('job_profile_id'),true);
		$this->account_model->remove_position_questions_code_by_code($code);
		redirect(base_url().'position_questions/'.$code.'?save=success','refresh');
	}

	public function update_interview_schedule($code)
	{
		//print $code;exit;
		$status = $this->input->get('status');
		$status = isset($status) ? strtolower($status) : '';
		$filtering_status_id = 0;
		
		if(!empty($code) && ($status == 'accept' || $status == 'reject'))
		{
			$interview_schedule = $this->account_model->get_interview_schedule_by_code($code); 
			if(isset($interview_schedule->code))
			{
				$interview_data = array(
					'code' => '',
					'status' => $status == 'accept' ? '1' : '0'
				);
				
				$job_profile_id = $interview_schedule->job_profile_id;
				$process_completed = $this->account_model->get_filter_process_state_by_job_profile_id($job_profile_id);
				//print $process_completed;exit;
				if(strtolower($process_completed) === 'question')
				{
					$job_profile = $this->account_model->get_job_profile_by_id($job_profile_id);
					$candidate = $this->account_model->get_candidate_by_candidate_profile_id($interview_schedule->candidate_profile_id);

					$mail_data = array(
						'from_email' => 'recruitment@recruitment-ally.com',
						'from_email_title' => 'RecruitmentAlly',
						'to_email' => $job_profile->email, 
						'job_ref_no' => $job_profile->job_ref_no,
						'position' => $job_profile->position,
						'candidate' => $candidate->first_name.' '.$candidate->last_name,
						'interview_date' => $interview_schedule->interview_date,
						'interview_status' => $status,
						'is_declined' => $interview_data['status'] == 1 ? false : true,
					);
					if($status == 'accept')
					{
						//print_r($job_profile);exit;
						$mail_data['subject'] = 'OnCall Interview Accepted - '.$job_profile->position;
						$this->send_email($mail_data,'interview_accept_reject');
						set_message('You have successfully accepted the interview','alert-success');
						$filtering_status_id = $this->account_model->get_filtering_status_id_by_status('Interview Call Request');
					}
					else
					{
						$mail_data['subject'] = 'OnCall Interview Rejected - '.$job_profile->position;
						$this->send_email($mail_data,'interview_accept_reject');
						set_message('You have rejected the interview','alert-danger');
						$filtering_status_id = $this->account_model->get_filtering_status_id_by_status('Declined');
						
						$email = $this->account_model->get_email_by_candidate_profile_id($candidate->candidate_profile_id);
						$mail_data['to_email'] = $email;
						$mail_data['subject'] = 'Shortlisting Process - '.$job_profile->position;
						$mail_data['process'] = 'Interview Call';
						$this->send_email($mail_data,'job_shortlisting_process');					
					}
					$application_id = $this->account_model->candidate_job_application_status_id($job_profile_id,$candidate->candidate_profile_id);	
					
					$job_data = array(
							'candidate_job_application_status_id' => $application_id,
							'filtering_status_id' => $filtering_status_id
					);
					$this->account_model->insert_data($job_data,'candidate_job_application_status_id','candidate_job_application_status');

					$history_data = array(
						'candidate_job_application_status_id' => $application_id,
						'filtering_status_id' => $filtering_status_id,
						'filtering_state' => $mail_data['is_declined'] == false ? 'interview_call_request' : 'declined',
					);
					$is_recorded = $this->account_model->is_application_history_recorded($history_data);
					if(!$is_recorded)
						$this->account_model->insert_data($history_data,'candidate_job_application_status_history_id','candidate_job_application_status_history');
				}
				else 
				{
					set_message('Sorry! On-Call Interview process has finished. Please contact recruiter for any further info','alert-danger');
					$interview_data['status'] = 0;
				}
				$this->account_model->update_schedule_interview_code($interview_data,$code);
			}
			else
			{
				set_message('The link has already been used. Please contact administrator.','alert-danger');
			}
		}
		else
		{
			set_message('The link appears to be invalid. Please contact administrator.','alert-danger');
		}
		redirect(base_url());		
	}
	public function update_website_clicked_count()
	{
		$company_profile_id = $this->input->get_post('id');	
		// print $company_profile_id;exit;
		if($company_profile_id != 0)
			$this->account_model->update_website_clicked_count($company_profile_id);
		print 'success';exit;		
	}

	public function delete_job_profile($job_profile_id)
	{
		$logged_in_user_profile_id = $this->account_model->get_user_profile_id_by_email($this->session->userdata('logged_email'));
		$job_profile_user_profile_id = $this->account_model->get_user_profile_id_by_job_profile_id($job_profile_id);
		$process_completed = $this->account_model->get_filter_process_state_by_job_profile_id($job_profile_id);
		
		$is_process_started = false;
		$is_users_job_profile = false;
		if(!empty($process_completed))
			$is_process_started = true;	
		if($logged_in_user_profile_id == $job_profile_user_profile_id)
			$is_users_job_profile = true;

		//print $logged_in_user_profile_id.'--'.$job_profile_user_profile_id.'--';exit;
		if($is_users_job_profile)
		{
			if(!$is_process_started)
			{
				$profile_data = array(
					'job_profile_id' => $job_profile_id,
					'is_active' => 0,
				);
				$this->account_model->updata_record('job_profile','job_profile_id',$profile_data);
				set_message('The job profile has been delete successfully','alert-success');
			}
			else
				set_message('Couldn\'t delete the job profile because the recruitment process has already started','alert-danger');
		}
		else
			set_message('The job profile doesn\'t seem to be belonging to you or doesn\'t exist','alert-danger');
		redirect(base_url().'employer/job_profile','refresh');
	}

	/* END EMPLOYER CONTROLLERS*/

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
		//$this->email->bcc('them@their-example.com'); 
		
		$this->email->subject($data['subject']);
		$this->email->message($this->load->view('/templates/'.$template_name,$data,true));	

		$this->email->send();
	}

	public function employer_service()
	{
		$services['page_title'] = 'Service Package';
		$user_profile_id = $this->account_model->get_user_profile_id_by_email($this->session->userdata('logged_email'));
		$services['service'] = $this->account_model->get_service_packages();
		$services['service_id'] = $this->account_model->get_company_serivce_package($user_profile_id);
	
		// if(empty($data['profile']->industry_ids))
		// 	$data['profile']->industry_ids = 0;

		$this->load->view('portal/employer_service',$services);
	}

	public function update_service($service_id)
	{
		$user_profile_id = $this->account_model->get_user_profile_id_by_email($this->session->userdata('logged_email'));
		$this->account_model->update_company_serivce_package($user_profile_id,$service_id);
		redirect(base_url().'employer/service','refresh');
		//$this->load->view('portal/employer_service',$services);
		
	}

	public function candidate_job_history()
	{
		$data['page_title'] = 'History';
		$user_profile_id = $this->account_model->get_user_profile_id_by_email($this->session->userdata('logged_email'));
		
		$data['jobs_profiles'] = $this->account_model->get_saved_jobs_by_candidate_profile_id($user_profile_id);
		//$this->account_model->insert_all_countries();
		//print_r($data['saved_jobs']);exit;
		$this->load->view('portal/candidate_job_history',$data);
	}

	public function reply_to_message()
	{    
            $message_data = [];
            
            $message_data["candidate_message_id"] = $this->input->post('candidate_message_id');
            $message_data["message"] = $this->input->post('message');
            $message_data["sent_on"] = date("Y-m-d H:i:s");
            //print $job_profile_data["job_profile_id"];exit;
            $this->account_model->insert_data($message_data,'candidate_sent_message_id','candidate_sent_message');

            set_message('Message has been successfully sent!','alert-success');
            
			redirect(base_url().'candidate/view_messages','refresh');
	}

	public function view_messages()
	{
		$data['received_messages'] = $this->account_model->get_candidate_messages_by_candidate_id($this->session->userdata('logged_email'));
            
        $this->load->view('/portal/candidate_received_message_list', $data);
	}

	public function sent_messages()
	{
		$data['sent_messages'] = $this->account_model->get_candidate_sent_messages_by_candidate_id($this->session->userdata('logged_email'));
            
        $this->load->view('/portal/candidate_sent_message_list', $data);
	}

	public function received_message_list()
	{
		$data['received_messages'] = $this->account_model->get_received_message_list($this->session->userdata('logged_email'));
            
        $this->load->view('/portal/employer_message_list', $data);
	}

	public function public_candidate_profile_view($candidate_id,$candidate_name)
	{
			$candidate_name = urldecode($candidate_name);
			$data['page_title'] = ucwords($candidate_name).' Public Profile View';
			$loggedin_profile_id = $this->account_model->get_user_profile_id_by_email($this->session->userdata('logged_email'));
			$full_name = "";
            
			if($loggedin_profile_id == 0)
			{
				$data['heading'] = '404 Page Not Found';
				$data['message'] = 'The page you requested was not found.';
				$this->load->view('/errors/html/error_404', $data);
				return;
			//	exit;
			}
			$user_profile_id = $this->account_model->get_user_profile_id_by_candidate_id($candidate_id);
			if($user_profile_id == 0)
			{
				$data['heading'] = '404 Page Not Found';
				$data['message'] = 'The page you requested was not found.';
				$this->load->view('/errors/html/error_404', $data);
				return;
				//exit;
			}
			$data['profile'] = $this->account_model->get_candidate_by_user_profile_id($user_profile_id);
			
			if( (isset($data['profile']->first_name)) && (isset($data['profile']->last_name)) )
			{
				$full_name = $data['profile']->first_name.' '.$data['profile']->last_name;
			}

			if(strtolower($full_name) != $candidate_name)
			{
				$data['heading'] = '404 Page Not Found';
				$data['message'] = 'The page you requested was not found.';
				$this->load->view('/errors/html/error_404', $data);
				return;
				//exit;
			}
			$data['title_header'] =  $full_name. ' Public Profile';
			//Candidate Profile, Salary and Notice Period
            $data['address'] = $this->account_model->get_address_by_user_profile_id($user_profile_id);
            //print_r($data['profile']);exit;
            $data['contact'] = $this->account_model->get_contact_by_user_profile_id($user_profile_id);
            if(isset($data['profile']->candidate_profile_id))
                    $data['salary_notice_period'] = $this->account_model->get_salary_notice_period_by_candidate_id($data['profile']->candidate_profile_id);
            // print_r($data['salary_notice_period']);exit;
            //print(empty($data['profile']));exit;
            $data['educations'] = $this->account_model->get_education_by_user_profile_id($user_profile_id); //Degree Table
            //print_r($data['educations']);exit;
            $data['experiences'] = $this->account_model->get_experience_by_user_profile_id($user_profile_id);

            $data['certificates'] = $this->account_model->get_certificate_by_user_profile_id($user_profile_id);
            $data['language_expertise'] = $this->account_model->get_language_expertise_by_user_profile_id($user_profile_id);
            $data['memberships'] = $this->account_model->get_membership_by_user_profile_id($user_profile_id);

            if(empty($data['profile']->industry_ids))
                    $data['profile']->industry_ids = 0;
            if(empty($data['profile']->competency_ids))
                    $data['profile']->competency_ids = 0;
            if(empty($data['profile']->driving_license_country_ids))
                    $data['profile']->driving_license_country_ids = 0; 

            $data['profile']->industry_ids = remove_trailing_commas($data['profile']->industry_ids);
            $data['profile']->competency_ids = remove_trailing_commas($data['profile']->competency_ids);
            $data['profile']->driving_license_country_ids = remove_trailing_commas($data['profile']->driving_license_country_ids);

            $data['industry_collection'] = $this->account_model->get_data_by_id_collection($data['profile']->industry_ids,'industry','industry_id','industry');
            $data['job_history_collection'] = $this->account_model->get_data_by_id_collection($data['profile']->job_history_category_ids,'job_history_category','job_history_category_id','history_category');
            $data['competency_collection'] = $this->account_model->get_data_by_id_collection($data['profile']->competency_ids,'competency','competency_id');
            $data['soft_skill_collection'] = $this->account_model->get_data_by_id_collection($data['profile']->soft_skill_type_ids,'soft_skill_type','soft_skill_type_id');
            $data['driving_license_collection'] = $this->account_model->get_data_by_id_collection($data['profile']->driving_license_country_ids,'country','country_id','country');

            $this->load->view('/portal/candidate_public_profile_view', $data);
	}
	
}

?>