<?php
defined('BASEPATH') OR exit('No direct access is allowed');
include_once(APPPATH."libraries/google/src/Google_Client.php");
include_once(APPPATH."libraries/google/src/contrib/Google_Oauth2Service.php");
//include_once(APPPATH."libraries/linkedin/config.php");
//include_once(APPPATH."libraries/linkedin/http.php");
//include_once(APPPATH."libraries/linkedin/oauth_client.php");


function get_page_title()
{
	$CI =& get_instance();
	$page = $CI->uri->segment(1);
	return ucwords(str_replace('_',' ',$page));
}

function is_value_one_greater($value1,$value2)
{
	$value1 = explode('-', $value1);
	$value2 = explode('-', $value2);

	$value1[0] = intval(str_replace(',','',$value1[0]));
	$value2[0] = intval(str_replace(',','',$value2[0]));
	//print_r($value2);
	if($value1[0] <= $value2[0])
		return 1;
	return 0;
}

function get_percentage_value($value1,$value2)
{
	if($value1 <= $value2)
		return number_format(($value1 / $value2)*100,2);
	return number_format(($value2 / $value1)*100,2);
	
}

function get_class_by_score($profile_score)
{
	if($profile_score <= 20)
		return 'progress-bar-red';
	elseif($profile_score <= 40)
		return 'progress-bar-orange';
	elseif($profile_score <= 60)
		return 'progress-bar-yellow';
	elseif($profile_score <= 90)
		return 'progress-bar-yellow';
	else
		return 'progress-bar-green';

}

function check_session()
{

	$ci=& get_instance();
	$logged_email = $ci->session->userdata('logged_email');
	$segment = $ci->uri->segment(1);
	if($segment != 'position_questions' && $segment != 'save_position_questions' && $segment != 'update_interview_schedule')
	{
		if(!isset($logged_email))
		{
			set_message('Your session has expired. Please login','alert-danger');
			redirect(base_url(),'refresh');
		}
	}
}



function get_client_ip() {
		$ci=& get_instance();
		$ci->load->database(); 
		$ipaddress = '';
		if (!(empty($_SERVER['HTTP_CLIENT_IP'])))
			$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		else if(!(empty($_SERVER['HTTP_X_FORWARDED_FOR'])))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else if(!(empty($_SERVER['HTTP_X_FORWARDED'])))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		else if(!(empty($_SERVER['HTTP_FORWARDED_FOR'])))
			$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		else if(!(empty($_SERVER['HTTP_FORWARDED'])))
			$ipaddress = $_SERVER['HTTP_FORWARDED'];
		else if(!(empty($_SERVER['REMOTE_ADDR'])))
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		else
			$ipaddress = '0.0.0.0';
	
		if($ipaddress == '127.0.0.1')
			$ipaddress = '0.0.0.0';
		//return '2.103.255.255'; //UK
		//return '23.17.255.255'; //Canada
		//return '2.15.255.255'; // France
        //return '1.43.255.255'; //Australia
		return $ipaddress;
}

function get_google_client()
{
		$gClient = new Google_Client();
		$gClient->setApplicationName('Login to RecruitementAlly');
		$gClient->setClientId(GOOGLE_CLIENT_ID);
		$gClient->setClientSecret(GOOGLE_CLIENT_SECRET);
		$gClient->setRedirectUri(GOOGLE_REDIRECT_URL);
		return $gClient;
}

function get_google_oauth_service($gClient)
{
	$google_oauthV2 = new Google_Oauth2Service($gClient);
	return $google_oauthV2;
}

function get_google_auth_url()
{
		$gClient = get_google_client();
		$google_oauthV2 = new Google_Oauth2Service($gClient);
		return $gClient->createAuthUrl();
}

function get_fb_info()
{
	include_once(APPPATH."libraries/afacebook/config.php");
	$loginUrl = "#";
	if(!$fbuser){
		$fbuser = null;
		$loginUrl = $facebook->getLoginUrl(array('redirect_uri'=>$fb_homeurl,'scope'=>$fbPermissions));
	}
	return $loginUrl;
}

function set_user_session($login_type,$session_data)
{
	$session_array = array(
		'is_logged_in' => true,
		'logged_email' =>'',
		'logged_name' => '',
		'logout_url' =>'',
		'logged_user_type' => ''
	);
	if(isset($session_data['is_admin']))
		$session_array['is_admin'] = 1;
	if(isset($session_data['access_type']))
		$session_array['access_type'] = $session_data['access_type'];


	$session_array['logout_url']= 'logout';
	if($login_type != '')
		$session_array['logout_url'].= '_'.$login_type;
	if($login_type == 'google' || $login_type == 'twiiter')
	{
		$session_array['logged_name'] = $session_data['name'];
		$session_array['logged_email'] = $session_data['email'];
		//print_r($ci->session->userdata('logged_email'));exit;
	}
	else if($login_type == 'facebook' || $login_type == 'linkedin')
	{
		$session_array['logged_name'] = $session_data['first_name'].' '.$session_data['last_name'];
		$session_array['logged_email'] = $session_data['email'];
		//print_r($ci->session->userdata('logged_email'));exit;
	}
	else
	{
		$session_array['logged_name'] = $session_data['name'];
		$session_array['logged_email'] = $session_data['email'];
	}
	//print_r($session_data);exit;
	$session_array['logged_user_type'] = $session_data['logged_user_type'];
	$ci=& get_instance();
	$ci->session->set_userdata($session_array);
}

function update_session_email($email)
{
	$ci=& get_instance();
	$session_array = $ci->session->userdata();
	$session_array['logged_email'] = $email;
	$ci->session->set_userdata($session_array);
}

function is_admin()
{
	$ci =& get_instance();
	$is_admin = $ci->session->userdata('is_admin');
	if(isset($is_admin))
	{
		if($is_admin)
			return 1;
		return 0;
	}
	return 0;


}

function get_user_type()
{
	$ci =& get_instance();
	$user_type = $ci->session->userdata('logged_user_type');
	return $user_type;
}

function get_age_by_date($date)
{

	$is_match_found = strrpos($date, '0000');
	if($is_match_found === false)
	{
		//date in mm/dd/yyyy format; or it can be in other formats as well
	  $birthDate = $date;
	  //explode the date to get month, day and year
	  $birthDate = explode("-", $birthDate);
	  //get age from date or birthdate
	  $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[1], $birthDate[2],$birthDate[0]))) > date("md")
	    ? ((date("Y") - $birthDate[0]) - 1)
	    : (date("Y") - $birthDate[0]));
	  return $age;
	}
	return 0;
}

function get_job_count_by_company_id($company_profile_id,$status=-1)
{
	$CI =& get_instance();
	$CI->db->select('jp.*');
	$CI->db->from('job_profile jp');
	$CI->db->where('jp.company_profile_id',$company_profile_id);
	if($status === false || $status === true)
		$CI->db->where('jp.is_active',$status);

	return $CI->db->get()->num_rows();
}

function is_job_already_save($job_profile_id)
{
	$CI =& get_instance();
	$email = $CI->session->userdata('logged_email'); 
	$CI->db->select('sj.*');
	$CI->db->from('saved_job sj');
	$CI->db->join('user_profile up','up.user_profile_id = sj.user_profile_id');
	$CI->db->join('login l','l.login_id = up.login_id');
	$CI->db->where('sj.job_profile_id',$job_profile_id);
	$CI->db->where('l.email',$email);

	return $CI->db->get()->num_rows();
}
function is_job_liked($job_profile_id)
{
	$CI =& get_instance();
	$email = $CI->session->userdata('logged_email'); 
	$CI->db->select('lj.*');
	$CI->db->from('liked_job lj');
	$CI->db->join('user_profile up','up.user_profile_id = lj.user_profile_id');
	$CI->db->join('login l','l.login_id = up.login_id');
	$CI->db->where('lj.job_profile_id',$job_profile_id);
	$CI->db->where('l.email',$email);

	return $CI->db->get()->num_rows();
}

function is_user_logged_in()
{
	$CI =& get_instance();
	if($CI->session->userdata('is_logged_in'))
		return true;
	return false;
}

function is_passport_saved()
{
	$CI =& get_instance();
	$email = $CI->session->userdata('logged_email'); 
	$CI->db->select('l.login_id');
	$CI->db->from('login l');
	$CI->db->join('user_profile up','up.login_id = l.login_id');
	$CI->db->join('candidate_profile cp','cp.user_profile_id = up.user_profile_id');
	$CI->db->where('cp.passport_number !=','');
	$CI->db->where('l.email',$email);

	return $CI->db->get()->num_rows();
} 

function get_profile_picture()
{
	$CI =& get_instance();
	$email = $CI->session->userdata('logged_email'); 
	$user_type = get_user_type();
	if($user_type == 'candidate')
	{
		$CI->db->select('cp.profile_pic_name');
		$CI->db->from('candidate_profile cp');
		$CI->db->join('user_profile up','up.user_profile_id = cp.user_profile_id');
		$CI->db->join('login l','l.login_id = up.login_id');
		$CI->db->where('l.email',$email);

		$query = $CI->db->get();
		if($query->num_rows() > 0)
		{
			$results = $query->result();
			return base_url().'uploads/candidate_profiles/'.$results[0]->profile_pic_name;
		}
		
	}
	elseif($user_type == 'employer')
	{
		$CI->db->select('cp.company_logo');
		$CI->db->from('company_profile cp');
		$CI->db->join('user_profile up','up.user_profile_id = cp.user_profile_id');
		$CI->db->join('login l','l.login_id = up.login_id');
		$CI->db->where('l.email',$email);

		$query = $CI->db->get();
		if($query->num_rows() > 0)
		{
			$results = $query->result();
			return base_url().'uploads/company_logos/'.$results[0]->company_logo;
		}
	}
	return '';
}

function get_candidates_applied_count_by_job_profile_id($job_profile_id)
{
	$CI =& get_instance();
	$CI->db->select('candidate_profile_id');
	$CI->db->where('job_profile_id',$job_profile_id);

	return $CI->db->get('candidate_job_application_status')->num_rows();
}

function get_candidates_liked_count_by_job_profile_id($job_profile_id)
{
	$CI =& get_instance();
	$CI->db->select('up.user_profile_id');
	$CI->db->from('liked_job lj');
	$CI->db->join('user_profile up', 'up.user_profile_id = lj.user_profile_id');
	$CI->db->where('lj.job_profile_id',$job_profile_id);

	return $CI->db->get()->num_rows();
}

function is_candidate_interview_set($candidate_profile_id)
{
	$CI =& get_instance();
	$CI->db->where('candidate_profile_id',$candidate_profile_id);

	return $CI->db->get('interview_schedule')->num_rows();
}

function is_question_feedback_set($candidate_profile_id,$job_profile_id,$type)
{
	$CI =& get_instance();
	$CI->db->select('jpqa.candidate_profile_id');
	$CI->db->from('job_profile_question_answer jpqa');
	$CI->db->join('job_profile_question jpq','jpq.job_profile_question_id=jpqa.job_profile_question_id');

	$CI->db->where('jpq.job_profile_id',$job_profile_id);
	$CI->db->where('jpqa.candidate_profile_id',$candidate_profile_id);
	$CI->db->where('jpq.type',$type);
	$CI->db->group_by('jpqa.candidate_profile_id');
	//print $CI->db->count_all_results();
	return $CI->db->get()->num_rows();
}
function is_test_selection_feedback_set($candidate_profile_id,$job_profile_id,$type)
{
	$CI =& get_instance();
	$CI->db->select('tsr.candidate_profile_id');
	$CI->db->from('test_selection_result tsr');

	$CI->db->where('tsr.job_profile_id',$job_profile_id);
	$CI->db->where('tsr.candidate_profile_id',$candidate_profile_id);
	$CI->db->where('tsr.type',$type);
	$CI->db->group_by('tsr.candidate_profile_id');
	//print $CI->db->count_all_results();
	return $CI->db->get()->num_rows();
}

function is_structured_interview_feedback_set($candidate_profile_id,$job_profile_id)
{
	$CI =& get_instance();
	$CI->db->select('jpqa.candidate_profile_id');
	$CI->db->from('job_profile_question_answer jpqa');
	$CI->db->join('job_profile_question jpq','jpq.job_profile_question_id=jpqa.job_profile_question_id');

	$CI->db->where('jpq.job_profile_id',$job_profile_id);
	$CI->db->where('jpqa.candidate_profile_id',$candidate_profile_id);
	$CI->db->where('jpq.type','structured_interview');
	$CI->db->group_by('jpqa.candidate_profile_id');
	//print $CI->db->count_all_results();
	return $CI->db->get()->num_rows();
}

function get_job_profile_questions_by_job_profile_candidate_profile_and_type($job_profile_id,$candidate_profile_id,$type)
{
	$CI =& get_instance();
	$CI->db->select('jpq.*,jpqa.*');
	$CI->db->from('job_profile_question jpq');
	$CI->db->join('job_profile_question_answer jpqa','jpq.job_profile_question_id = jpqa.job_profile_question_id');
	$CI->db->where('jpq.job_profile_id',$job_profile_id);
	$CI->db->where('jpqa.candidate_profile_id',$candidate_profile_id);
	$CI->db->where('jpq.type',$type);

	$query = $CI->db->get();
	if($query->num_rows() > 0)
		return $query->result();
	else
		return array();
}

function get_test_selection_by_job_profile_candidate_profile_and_type($job_profile_id,$candidate_profile_id,$type)
{
	$CI =& get_instance();
	$CI->db->select('tsr.*');
	$CI->db->from('test_selection_result tsr');
	$CI->db->where('tsr.job_profile_id',$job_profile_id);
	$CI->db->where('tsr.candidate_profile_id',$candidate_profile_id);
	$CI->db->where('tsr.type',$type);

	$query = $CI->db->get();
	if($query->num_rows() > 0)
	{
		$results = $query->result();
		return $results[0];
	}
	else
		return array();
}
function get_attachment_by_job_profile_candidate_profile_and($job_profile_id,$candidate_profile_id)
{
	$CI =& get_instance();
	$CI->db->select('sfa.*');
	$CI->db->from('shortlisting_feedback_attachment sfa');
	$CI->db->where('sfa.job_profile_id',$job_profile_id);
	$CI->db->where('sfa.candidate_profile_id',$candidate_profile_id);

	$query = $CI->db->get();
	if($query->num_rows() > 0)
	{
		$results = $query->result();
		return $results[0];
	}
	else
		return array();
}


function total_interview_schedules_for_job($job_profile_id)
{
	$CI =& get_instance();
	$CI->db->where('job_profile_id',$job_profile_id);

	return $CI->db->get('interview_schedule')->num_rows();
}


function is_employee_benefits_selected($job_profile_id,$employee_benefit_id)
{
	$CI =& get_instance();
	$CI->db->where('job_profile_id',$job_profile_id);
	$CI->db->where('employee_benefit_id',$employee_benefit_id);

	return $CI->db->get('job_profile_employee_benefits_map')->num_rows();
}

function get_employee_benefit_amount($job_profile_id,$employee_benefit_id)
{
	$CI =& get_instance();
	$CI->db->select('amount');
	$CI->db->from('job_profile_employee_benefits_map');
	$CI->db->where('job_profile_id',$job_profile_id);
	$CI->db->where('employee_benefit_id',$employee_benefit_id);

	$query = $CI->db->get();
	if($query->num_rows() > 0)	
	{
		$result = $query->result();
		return $result[0]->amount;
	}
	else
		return '';
}

function get_profile_score($profile_data,$experiences,$educations,$certificates,$address)
{
	$score = 0;
	if(!empty($profile_data->industry_ids) && !empty($profile_data->competency_ids) && !empty($profile_data->soft_skill_type_ids))
		$score+= 20;
	// if(!empty($profile_data->passport_number))
	// 	$score+= 10;
	if(!empty($profile_data->first_name) && !empty($profile_data->last_name) && !empty($address))
		$score+= 20;
	if(count($experiences) >= 1)
		$score+=20;
	if(count($educations) >= 1)
		$score+=20;
	if(count($certificates) >= 1)
		$score+=20;
	return $score;
}

function filter_competency_by_type($competencies,$type)
{
	$filtered_competencies = array();
	foreach ($competencies as $key => $competency) {
		if($competency->competency_type == $type)
		{
			array_push($filtered_competencies, $competency);
		}
	}
	return $filtered_competencies;
}

function get_competency_ids_by_type($competencies,$type)
{
	$filtered_competencies = array();
	foreach ($competencies as $key => $competency) {
		if($competency->competency_type == $type)
		{
			array_push($filtered_competencies, $competency->competency_id);
		}
	}
	return $filtered_competencies;
}

function has_job_expired($close_date)
{
	$curdate=strtotime(date('Y-m-d'));
	$end_date = new DateTime($close_date);
	$end_date = $end_date->format('Y-m-d');
	$end_date=strtotime($end_date);
	if($curdate > $end_date && $end_date != -62169966000)
		return 1;
	else
		return 0;
}

function get_poll_options_by_poll_id($poll_id)
{
	$CI =& get_instance();
	$CI->db->select('*');
	$CI->db->from('poll_option');
	$CI->db->where('poll_id',$poll_id);
	$query = $CI->db->get();
	if($query->num_rows() > 0)	
	{
		$result = $query->result();
		return $result;
	}
	else
		return array();
}

function get_poll_option_count($poll_id,$poll_option_id)
{
	$CI =& get_instance();
	$CI->db->select('pc.user_profile_id');
	$CI->db->from('poll_choice pc');
	$CI->db->join('poll_option po','po.poll_option_id=pc.poll_option_id');
	$CI->db->where('po.poll_id',$poll_id);
	$CI->db->where('po.poll_option_id',$poll_option_id);
	$query = $CI->db->get();
	return $query->num_rows();
}

function get_industries_list()
{
	$CI =& get_instance();
	$CI->load->model('configuration_model');
	$industry = $CI->configuration_model->get_all_records('industry');
	return $industry;
}

function get_countries_list()
{
	$CI =& get_instance();
	$CI->load->model('configuration_model');
	$countries = $CI->configuration_model->get_all_records('country','country','ASC');
	return $countries;
}

function get_experince_list()
{
	$CI =& get_instance();
	$CI->load->model('configuration_model');
	$experience_levels = $CI->configuration_model->get_all_records('experience_level');
	return $experience_levels;
}

function get_last_posted_job($company_profile_id)
{
	$CI =& get_instance();
	$CI->db->select('jp.position,jp.job_ref_no');
	$CI->db->from('job_profile jp');
	$CI->db->where('jp.company_profile_id',$company_profile_id);
	$CI->db->order_by('jp.job_profile_id', 'DESC');
	$query = $CI->db->get();
	if($query->num_rows() > 0)
	{
		$result = $query->result();
		return $result[0];
	}
	else
		return array();

}

// function limit_words($str,$length)
// {
//     return preg_replace('/((\w+\W*){'.$length.'}(\w+))(.*)/', '${1}', $str);    
// }

function limit_words($string, $word_limit)
{
    $words = explode(" ",$string);
    $spliced_words =  implode(" ",array_splice($words,0,$word_limit));
    if(str_word_count($string,0) > $word_limit)
    	$spliced_words.='... ';
    return $spliced_words;
}

function get_filter_status($status)
{
	if($status == 'Not Viewed')
		return 'Process Not Started';
	return $status;
}
 
function keep_flashmessage()
{
 	$CI =& get_instance();
 	$CI->session->keep_flashdata('message');
 	$CI->session->keep_flashdata('status');
}

function set_message($message,$status)
{
	$CI =& get_instance();
  	$CI->session->set_tempdata('message',$message,5);
 	$CI->session->set_tempdata('status',$status,5);
}

function remove_trailing_commas($str)
{
	return remove_trailing_leading_commas($str);
}

function remove_trailing_leading_commas($str)
{
	return trim($str, ',');
}

function get_point_by_test_type($types,$points,$type)
{
	$types_arr = explode(",",$types);
	$points_arr = explode(",",$points);

	if($types_arr[0] == $type){
		return $points_arr[0];
	}
	
	if(count($types_arr) > 1) {
		return $points_arr[1] ;
	}

	return '-';
}

// function get_test_selection_point($types,$points,$type)
// {
// 	if($status == 'Not Viewed')
// 		return 'Process Not Started';
// 	return $status;
// }

?>