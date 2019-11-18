<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_model extends CI_Model
{
	public function __construct()
	{
                $this->load->database();
                parent::__construct();
                
	}


	public function is_user_exist($login_data,$is_active=null)
	{
		$query = $this->db->get_where('login',$login_data);
		return $query->num_rows();
	}

	public function insert_login($login_data)
	{
		if($login_data['login_id'] == 0)
		{
			$this->db->insert('login', $login_data);
			return $this->db->insert_id();
		}
		else
			$this->db->update('login', $login_data,array('login_id'=>$login_data['login_id']));		
	}

	public function insert_user_profile($user_profile_data)
	{
		if($user_profile_data['user_profile_id'] == 0)
		{
			$this->db->insert('user_profile', $user_profile_data);
			return $this->db->insert_id();
		}
		else
			$this->db->update('user_profile', $user_profile_data,array('user_profile_id'=>$user_profile_data['user_profile_id']));		
	}

	public function insert_data($data,$id,$table_name)
	{
		//print_r($data);exit;
		if(!isset($data[$id]))
			$data[$id] = 0;
		if($data[$id] == 0)
		{
			//print 'insert';
			$this->db->insert($table_name, $data);
			return $this->db->insert_id();
		}
		else
		{
			//print 'update'.$id;
			$this->db->update($table_name, $data,array($id=>$data[$id]));		
		}
		return 0;
	}

	public function update_profile_score($candidate_profile_id)
	{
		print $candidate_profile_id;
		$this->db->where('candidate_profile_id',$candidate_profile_id);
		$this->db->where('profile_completeness',0);
		$this->db->set('profile_completeness','(profile_completeness+20)',false);
		$this->db->update('candidate_profile');
	}
	public function delete_data($table_name,$data)
	{
		$this->db->delete($table_name, $data);		
		return true;
	}

	public function updata_record($table_name,$id,$data)
	{
		$this->db->update($table_name, $data,array($id=>$data[$id]));	
	}


	public function get_login($login_data,$status=false)
	{
	    $this->db->select('l.*,ut.*,up.*');
	    $this->db->from('login l');
	    $this->db->join('user_type ut', 'ut.user_type_id = l.user_type_id');
	    $this->db->join('user_profile up', 'up.login_id = l.login_id');
            $this->db->where('l.email', $login_data['email']);
            $this->db->where('l.password', $login_data['password']);
            if($status)
            {
                $this->db->where('up.is_active',$status);
                $this->db->where('up.is_deleted',0);
            }
	    $query = $this->db->get();
	    return $this->db_results_fn($query,true);
	}

	public function get_login_info_by_type_email($email,$method=false)
	{
	    $this->db->select('l.*,ut.*,up.*');
	    $this->db->from('login l');
	    $this->db->join('user_type ut', 'ut.user_type_id = l.user_type_id');
	    $this->db->join('user_profile up', 'up.login_id = l.login_id');
		$this->db->where('l.email', $email);
		$this->db->where('l.method', $method);
	    $query = $this->db->get();
	    return $this->db_results_fn($query,true);
	}

	public function get_user_profile_id_by_email($email)
	{
		$this->db->select('up.user_profile_id');
	    $this->db->from('user_profile up');
	    $this->db->join('login l', 'l.login_id = up.login_id');
		$this->db->where('l.email', $email);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			$result = $query->result();
			return $result[0]->user_profile_id;
		}
		else
			return 0;
	}

	public function get_user_profile_id_by_job_profile_id($job_profile_id)
	{
		$this->db->select('cp.user_profile_id');
	    $this->db->from('company_profile cp ');
	    $this->db->join('job_profile jp', 'jp.company_profile_id = cp.company_profile_id');
	    $this->db->join('user_profile up', 'up.user_profile_id = cp.user_profile_id');
		$this->db->where('jp.job_profile_id', $job_profile_id);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			$result = $query->result();
			return $result[0]->user_profile_id;
		}
		else
			return 0;
	}

	public function get_company_profile_id_user_profile_id($user_profile_id)
	{
		$this->db->select('cp.company_profile_id');
	    $this->db->from('company_profile cp');
	    $this->db->join('user_profile up', 'up.user_profile_id = cp.user_profile_id');
		$this->db->where('cp.user_profile_id', $user_profile_id);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			$result = $query->result();
			return $result[0]->company_profile_id;
		}
		else
			return 0;
	}

	public function get_login_by_id($login_id)
	{
	    //print $this->session->userdata('confirmation_code');
	    $query = $this->db->query('SELECT * from login WHERE login_id='.$login_id);
	    $query = $this->db->get();
	    return $this->db_results_fn($query);
	}


	// public function get_login_id_by_code($code,$type)
	// {
	//     //print $this->session->userdata('confirmation_code');
	// 	$this->db->select('login_id');
	// 	$this->db->from('login');
	// 	if($type == 'registration')
	// 		$this->db->where('registration_code',$code);
	// 	else
	// 		$this->db->where('reset_password_code',$code);
	// 	$query = $this->db->get();
	//     return $this->db_results_fn($query);
	// }

	public function get_login_id_by_code($code,$type)
	{
	    //print $this->session->userdata('confirmation_code');
		$this->db->select('login_id');
		$this->db->from('login');
		if($type == 'registration')
			$this->db->where('registration_code',$code);
		else
			$this->db->where('reset_password_code',$code);
		$query = $this->db->get();
	    $result = $query->result();
	    //print_r($result);exit;
	    if($query->num_rows() > 0)
	    {
	      return $result[0]->login_id;
	    }
	    else
	      return false;
	}

	public function get_user_type_id_by_type($user_type)
	{
	    //print $this->session->userdata('confirmation_code');
		$this->db->select('user_type_id');
		$this->db->where('type',$user_type);
		$query = $this->db->get('user_type');
	    if($query->num_rows() > 0)
		{
			$result = $query->result();
			return $result[0]->user_type_id;
		}
		else
		 return 0;
	}
	public function get_user_type_by_type_id($user_type_id)
	{
	    //print $this->session->userdata('confirmation_code');
		$this->db->select('type');
		$this->db->where('user_type_id',$user_type_id);
		$query = $this->db->get('user_type');
	    if($query->num_rows() > 0)
		{
			$result = $query->result();
			return $result[0]->type;
		}
		else
		 return '';
	}
	public function get_email_by_candidate_profile_id($candidate_profile_id)
	{
	    //print $this->session->userdata('confirmation_code');
		$this->db->select('l.email');
		$this->db->from('login l');
		$this->db->join('user_profile up', 'up.login_id = l.login_id');
		$this->db->join('candidate_profile cp', 'cp.user_profile_id = up.user_profile_id');
		$this->db->where('cp.candidate_profile_id',$candidate_profile_id);
		$query = $this->db->get();
	    if($query->num_rows() > 0)
		{
			$result = $query->result();
			return $result[0]->email;
		}
		else
		 return '';
	}

	public function get_email_by_user_profile_id($user_profile_id)
	{
	    //print $this->session->userdata('confirmation_code');
		$this->db->select('l.email');
		$this->db->from('login l');
		$this->db->join('user_profile up', 'up.login_id = l.login_id');
		$this->db->where('up.user_profile_id',$user_profile_id);
		$query = $this->db->get();
	    if($query->num_rows() > 0)
		{
			$result = $query->result();
			return $result[0]->email;
		}
		else
		 return '';
	}

	public function get_average_logins_per_today()
	{
		$query = $this->db->query("SELECT AVG(rowsPerDay) as average_per_day FROM (SELECT COUNT(*) as rowsPerDay FROM login_history GROUP BY CONVERT(DATE,date)) as a");
		if($query->num_rows() > 0)
		{
			$result = $query->result();
			// print_r($result[0]->average_per_day);exit;
			return $result[0]->average_per_day;
		}
		return 0;
	}

	public function update_last_logged_in($last_logged_data)
	{
		$this->db->insert('login_history',$last_logged_data); 
		return true;
	}

	public function update_profile_status($user_profile_id=0,$status)
	{
		$this->db->update('user_profile', array('is_active'=>$status), array('user_profile_id'=>$user_profile_id));
	}

	public function set_company_featured_status($user_profile_id=0,$status)
	{
		$this->db->update('company_profile', array('is_featured'=>$status), array('user_profile_id'=>$user_profile_id));
	}

	public function activate_user_by_code($code,$type)
	{
		 $column = '';
		 if($type == 'registration') 
			$column = 'registration_code';
		 else if($type == 'reset_password') 
			$column = 'reset_password_code';

		  $this->db->query('UPDATE user_profile up INNER JOIN login l ON up.login_id=l.login_id SET up.is_active=1,l.'.$column.'="" WHERE l.'.$column.'="'.$code.'"');
		  return $this->db->affected_rows();
	}

	public function insert_change_password($login_data)
	{

		$this->db->update('login',$login_data,array('email'=>$login_data['email']));
		return true;
	}

	public function get_employers_count($is_active=null)
	{
		$this->db->query("set sql_big_selects=1");
		$this->db->select('co.*,a.*,c.*,up.*,l.email as login_email');
		$this->db->from('company_profile co');
		$this->db->join('user_profile up', 'up.user_profile_id = co.user_profile_id');
		$this->db->join('login l', 'l.login_id = up.login_id');
		$this->db->join('address_profile_map apm', 'apm.user_profile_id = co.user_profile_id','left');
		$this->db->join('address a', 'a.address_id = apm.address_id','left');
		$this->db->join('contact_profile_map cpm', ' cpm.user_profile_id = co.user_profile_id','left');
		$this->db->join('contact c', 'c.contact_id = cpm.contact_id','left');
		$this->db->where('up.is_deleted',0);
		if($is_active != null)
			$this->db->where('up.is_active', $is_active);
		$this->db->group_by('co.company_profile_id');
		//print $this->db->get_compiled_select();exit;
		$query = $this->db->get();
		return $this->db_results_fn($query);
	}

	public function get_employers($is_active=null)
	{
		$this->db->query("set sql_big_selects=1");
		$this->db->select('co.*,a.*,c.*,up.*,l.email as login_email');
		$this->db->from('company_profile co');
		$this->db->join('user_profile up', 'up.user_profile_id = co.user_profile_id');
		$this->db->join('login l', 'l.login_id = up.login_id');
		$this->db->join('address_profile_map apm', 'apm.user_profile_id = co.user_profile_id','left');
		$this->db->join('address a', 'a.address_id = apm.address_id','left');
		$this->db->join('contact_profile_map cpm', ' cpm.user_profile_id = co.user_profile_id','left');
		$this->db->join('contact c', 'c.contact_id = cpm.contact_id','left');
		$this->db->where('up.is_deleted',0);
		if($is_active != null)
			$this->db->where('up.is_active', $is_active);
		$this->db->group_by('co.company_profile_id');
		$query = $this->db->get();
		return $this->db_results_fn($query);
	}

	public function get_candidates($is_active=null,$limit=0,$offset=0)
	{
		$this->db->query("set sql_big_selects=1");
		$this->db->select('ca.*,up.is_active,up.registered_date,l.email as login_email,cy.country'); //a.*,c.*,cy.country,
		$this->db->from('candidate_profile ca');
		$this->db->join('user_profile up', 'up.user_profile_id = ca.user_profile_id');
		$this->db->join('login l', 'l.login_id = up.login_id');
		$this->db->join('address_profile_map apm', 'apm.user_profile_id = ca.user_profile_id','left');
		$this->db->join('address a', 'a.address_id = apm.address_id','left');
		//$this->db->join('contact_profile_map cpm', ' cpm.user_profile_id = ca.user_profile_id','left');
		//$this->db->join('contact c', 'c.contact_id = cpm.contact_id','left');
		$this->db->join('country cy', 'cy.country_id = a.country_id','left');
		$this->db->where('up.is_deleted',0);
		if($is_active != null)
			$this->db->where('up.is_active', $is_active);
		if($limit!=0)
			$this->db->limit($limit,$offset);
		$this->db->group_by('ca.candidate_profile_id');
		$query = $this->db->get();
		return $this->db_results_fn($query);
	}

	public function get_candidates_count($is_active=null,$limit=0,$offset=0)
	{
		$this->db->query("set sql_big_selects=1");
		$this->db->select('ca.*,up.is_active,up.registered_date,l.email as login_email,cy.country'); //a.*,c.*,cy.country,
		$this->db->from('candidate_profile ca');
		$this->db->join('user_profile up', 'up.user_profile_id = ca.user_profile_id');
		$this->db->join('login l', 'l.login_id = up.login_id');
		$this->db->join('address_profile_map apm', 'apm.user_profile_id = ca.user_profile_id','left');
		$this->db->join('address a', 'a.address_id = apm.address_id','left');
		//$this->db->join('contact_profile_map cpm', ' cpm.user_profile_id = ca.user_profile_id','left');
		//$this->db->join('contact c', 'c.contact_id = cpm.contact_id','left');
		$this->db->join('country cy', 'cy.country_id = a.country_id','left');
		$this->db->where('up.is_deleted',0);
		if($is_active != null)
			$this->db->where('up.is_active', $is_active);
		if($limit!=0)
			$this->db->limit($limit,$offset);
		$this->db->group_by('ca.candidate_profile_id');
		//$query = $this->db->get();
		//$row = $query->row();
		//print_r($query->result());exit;
		$query = $this->db->get();
		return $this->db_results_fn($query);
	}

	public function get_administrators($is_active=null)
	{
		$this->db->query("set sql_big_selects=1");
		$this->db->select('at.*,l.email,l.password,up.is_active');
		$this->db->from('admin_team at');
		$this->db->join('user_profile up', 'up.user_profile_id = at.user_profile_id');
		$this->db->join('login l', 'l.login_id = up.login_id');
		if($is_active != null)
			$this->db->where('up.is_active', $is_active);
		$query = $this->db->get();
		return $this->db_results_fn($query);
	}

	public function get_candidate_profiles_by_search_options($search_options)
	{
		$query = "SELECT d.department, c.country, cl.career_level, cp.*,l.email FROM candidate_profile cp JOIN user_profile up ON up.user_profile_id=cp.user_profile_id JOIN login l ON l.login_id=up.login_id LEFT JOIN department d ON d.department_id=cp.department_id LEFT JOIN address_profile_map apm ON apm.user_profile_id = cp.user_profile_id LEFT JOIN address a ON a.address_id = apm.address_id LEFT JOIN country c ON c.country_id=a.country_id LEFT JOIN career_level cl ON cl.career_level_id=cp.career_level_id LEFT JOIN cv_experience ce ON ce.candidate_profile_id = cp.candidate_profile_id WHERE up.is_active=1 AND up.is_deleted=0";
		if (!empty($search_options['keyword'])){
			$query .=" AND (cp.first_name LIKE '%{$search_options['keyword']}%'";
			$query .=" OR cp.last_name LIKE '%{$search_options['keyword']}%'";
			$query .=" OR cp.gender LIKE '%{$search_options['keyword']}%'";
			$query .=" OR cp.about_you LIKE '%{$search_options['keyword']}%'";
			$query .=" OR cp.passport_number LIKE '%{$search_options['keyword']}%'";
			$query .=" OR cl.career_level LIKE '%{$search_options['keyword']}%'";
			$query .=" OR d.department LIKE '%{$search_options['keyword']}%')";
		}
		if (!empty($search_options['country'])){
			$query .=" AND a.country_id IN ({$search_options['country']})";
		}
		if (!empty($search_options['experience_level'])){
			$query .=" AND ce.experience_level_id = {$search_options['experience_level']}";
		}	
		if (!empty($search_options['industry'])){
			$query .=" AND (cp.industry_ids LIKE '{$search_options['industry']}' OR cp.industry_ids LIKE '{$search_options['industry']},%' OR cp.industry_ids LIKE '%,{$search_options['industry']}%' OR cp.industry_ids LIKE '%,{$search_options['industry']},%') ";
		}	

		$query .=" GROUP BY cp.candidate_profile_id";
		$query .=" ORDER BY cp.candidate_profile_id DESC";
		//print_r($this->db->get_compiled_select());
		//print_r($query);exit;
		// $query = $this->db->get();
		$this->db->query("set sql_big_selects=1");
		$query = $this->db->query($query);

		return $this->db_results_fn($query);
	}
	public function get_candidate_profiles_by_search_options_ajax($search_options)
	{
		$query = "SELECT d.department, c.country, cl.career_level, cp.*,l.email FROM candidate_profile cp JOIN user_profile up ON up.user_profile_id=cp.user_profile_id JOIN login l ON l.login_id=up.login_id LEFT JOIN department d ON d.department_id=cp.department_id LEFT JOIN address_profile_map apm ON apm.user_profile_id = cp.user_profile_id LEFT JOIN address a ON a.address_id = apm.address_id LEFT JOIN country c ON c.country_id=a.country_id LEFT JOIN career_level cl ON cl.career_level_id=cp.career_level_id LEFT JOIN cv_experience ce ON ce.candidate_profile_id = cp.candidate_profile_id WHERE up.is_active=1 AND up.is_deleted=0";
		if (!empty($search_options['keyword'])){
			$query .=" AND (cp.first_name LIKE '%{$search_options['keyword']}%'";
			$query .=" OR cp.last_name LIKE '%{$search_options['keyword']}%'";
			$query .=" OR cp.gender LIKE '%{$search_options['keyword']}%'";
			$query .=" OR cp.about_you LIKE '%{$search_options['keyword']}%'";
			$query .=" OR cp.passport_number LIKE '%{$search_options['keyword']}%'";
			$query .=" OR cl.career_level LIKE '%{$search_options['keyword']}%'";
			$query .=" OR d.department LIKE '%{$search_options['keyword']}%')";
		}
		if (!empty($search_options['search_value'])){
			$query .=" AND (cp.first_name LIKE '%{$search_options['search_value']}%'";
			$query .=" OR cp.last_name LIKE '%{$search_options['search_value']}%'";
			$query .=" OR cp.gender LIKE '%{$search_options['search_value']}%'";
			$query .=" OR cp.about_you LIKE '%{$search_options['search_value']}%'";
			$query .=" OR cp.passport_number LIKE '%{$search_options['search_value']}%'";
			$query .=" OR cl.career_level LIKE '%{$search_options['search_value']}%'";
			$query .=" OR d.department LIKE '%{$search_options['search_value']}%')";
		}
		if (!empty($search_options['country'])){
			$query .=" AND a.country_id IN ({$search_options['country']})";
		}
		if (!empty($search_options['experience_level'])){
			$query .=" AND ce.experience_level_id = {$search_options['experience_level']}";
		}	
		if (!empty($search_options['industry'])){
			$query .=" AND (cp.industry_ids LIKE '{$search_options['industry']}' OR cp.industry_ids LIKE '{$search_options['industry']},%' OR cp.industry_ids LIKE '%,{$search_options['industry']}%' OR cp.industry_ids LIKE '%,{$search_options['industry']},%') ";
		}	

		$query .=" GROUP BY cp.candidate_profile_id";
		$query .=" ORDER BY cp.candidate_profile_id DESC";
		// $query .=" LIMIT {$search_options['limit']} OFFSET {$search_options['offset']}";
		//print_r($this->db->get_compiled_select());
		//print_r($query);exit;
		// $query = $this->db->get();
		$this->db->query("set sql_big_selects=1");
		$query = $this->db->query($query);

		return $this->db_results_fn($query);
	}

	public function get_candidate_profiles_count()
		{
			$query = "SELECT count(*) as total_records FROM candidate_profile cp JOIN user_profile up ON up.user_profile_id=cp.user_profile_id JOIN login l ON l.login_id=up.login_id LEFT JOIN department d ON d.department_id=cp.department_id LEFT JOIN address_profile_map apm ON apm.user_profile_id = cp.user_profile_id LEFT JOIN address a ON a.address_id = apm.address_id LEFT JOIN country c ON c.country_id=a.country_id LEFT JOIN career_level cl ON cl.career_level_id=cp.career_level_id LEFT JOIN cv_experience ce ON ce.candidate_profile_id = cp.candidate_profile_id WHERE up.is_active=1 AND up.is_deleted=0";
			//print_r($this->db->get_compiled_select());
			//print_r($query);exit;
			// $query = $this->db->get();
			$this->db->query("set sql_big_selects=1");
			$query = $this->db->query($query);

			return $this->db_results_fn($query,true);
		}

	public function get_candidate_by_candidate_profile_id($candidate_profile_id)
	{
		$this->db->query("set sql_big_selects=1");
		$this->db->distinct('cp.*,cp.candidate_profile_id as cppp,up.*,n.*,ms.*,n.*,vs.*,cl.*,d.*'); //,a.*
		$this->db->from('candidate_profile cp');
		// $this->db->join('candidate_job_application_status cjas', 'cjas.candidate_profile_id = cp.candidate_profile_id','left');
		$this->db->join('user_profile up', 'up.user_profile_id = cp.user_profile_id');
		$this->db->join('nationality n', 'n.nationality_id = cp.nationality_id','left');
		$this->db->join('maritial_status ms', 'ms.maritial_status_id = cp.maritial_status_id','left');
		$this->db->join('visa_status vs', 'vs.visa_status_id = cp.visa_status_id','left');
		$this->db->join('career_level cl', 'cl.career_level_id = cp.career_level_id','left');
		//$this->db->join('address_profile_map amp', 'amp.user_profile_id = cp.user_profile_id','left');
		//$this->db->join('address a', 'a.address_id = a.address_id','left');
		//$this->db->join('country cy', 'cy.country_id = a.country_id','left');
		$this->db->join('department d', 'd.department_id = cp.department_id','left');
		// $this->db->group_by('cjas.candidate_job_application_status_id');
		$this->db->where('cp.candidate_profile_id',$candidate_profile_id);

		$query = $this->db->get();
		return $this->db_results_fn($query,true);
	}

	public function get_candidate_by_user_profile_id($user_profile_id)
	{
		$this->db->query("SET SQL_BIG_SELECTS=1");
		// $this->db->query("SET MAX_JOIN_SIZE=15");
		$this->db->distinct('cp.*,cp.candidate_profile_id as cppp,up.*,n.*,ms.*,n.*,vs.*,cl.*,d.*');//,a.*
		$this->db->from('candidate_profile cp');
		// $this->db->join('candidate_job_application_status cjas', 'cjas.candidate_profile_id = cp.candidate_profile_id','left');
		$this->db->join('user_profile up', 'up.user_profile_id = cp.user_profile_id');
		$this->db->join('nationality n', 'n.nationality_id = cp.nationality_id','left');
		$this->db->join('maritial_status ms', 'ms.maritial_status_id = cp.maritial_status_id','left');
		$this->db->join('visa_status vs', 'vs.visa_status_id = cp.visa_status_id','left');
		$this->db->join('career_level cl', 'cl.career_level_id = cp.career_level_id','left');
		//$this->db->join('address_profile_map amp', 'amp.user_profile_id = cp.user_profile_id','left');
		//$this->db->join('address a', 'a.address_id = a.address_id','left');
		//$this->db->join('country cy', 'cy.country_id = a.country_id','left');
		$this->db->join('department d', 'd.department_id = cp.department_id','left');
		// $this->db->group_by('cjas.candidate_job_application_status_id');
		$this->db->where('cp.user_profile_id',$user_profile_id);
		//print $this->db->get_compiled_select();exit;
		$query = $this->db->get();
		return $this->db_results_fn($query,true);
	}

	public function get_candidates_by_job_profile_id($job_profile_id)
	{
		$this->db->query("set sql_big_selects=1");
		$this->db->distinct('cp.*,cp.candidate_profile_id as cppp,up.*,cl.*,a.*,csnp.*');//n.*,ms.status as maritial_status,vs.*,d.*
		$this->db->from('candidate_profile cp');
		$this->db->join('candidate_job_application_status cjas', 'cjas.candidate_profile_id = cp.candidate_profile_id');
		$this->db->join('user_profile up', 'up.user_profile_id = cp.user_profile_id','left');
		//$this->db->join('nationality n', 'n.nationality_id = cp.nationality_id','left');
		//$this->db->join('maritial_status ms', 'ms.maritial_status_id = cp.maritial_status_id','left');
		//$this->db->join('visa_status vs', 'vs.visa_status_id = cp.visa_status_id','left');
		$this->db->join('career_level cl', 'cl.career_level_id = cp.career_level_id','left');
		$this->db->join('address_profile_map amp', 'amp.user_profile_id = cp.user_profile_id','left');
		$this->db->join('address a', 'a.address_id = amp.address_id','left');
		$this->db->join('country cy', 'cy.country_id = a.country_id','left');
		//$this->db->join('department d', 'd.department_id = cp.department_id','left');
		$this->db->group_by('cjas.candidate_job_application_status_id');
		$this->db->where('cjas.job_profile_id',$job_profile_id);

		$query = $this->db->get();
		return $this->db_results_fn($query);
	}
	
	public function get_candidates_by_job_profile_id_and_filter_status($job_profile_id,$filtering_status)
	{
		$this->db->query("set sql_big_selects=1");
		$this->db->distinct('cp.*,cp.candidate_profile_id as cppp,up.*,cl.*,a.*'); //n.*,ms.status as maritial_status,vs.*,d.*
		$this->db->from('candidate_profile cp');
		$this->db->join('candidate_job_application_status cjas', 'cjas.candidate_profile_id = cp.candidate_profile_id');
		$this->db->join('user_profile up', 'up.user_profile_id = cp.user_profile_id','left');
		//$this->db->join('nationality n', 'n.nationality_id = cp.nationality_id','left');
		//$this->db->join('maritial_status ms', 'ms.maritial_status_id = cp.maritial_status_id','left');
		//$this->db->join('visa_status vs', 'vs.visa_status_id = cp.visa_status_id','left');
		$this->db->join('career_level cl', 'cl.career_level_id = cp.career_level_id','left');
		$this->db->join('address_profile_map amp', 'amp.user_profile_id = cp.user_profile_id','left');
		$this->db->join('address a', 'a.address_id = amp.address_id','left');
		$this->db->join('country cy', 'cy.country_id = a.country_id','left'); 
		//$this->db->join('department d', 'd.department_id = cp.department_id','left');
		$this->db->join('candidate_job_application_status_history cjash', 'cjash.candidate_job_application_status_id = cjas.candidate_job_application_status_id','left');
		$this->db->join('filtering_status fs', 'fs.filtering_status_id = cjash.filtering_status_id','left');
		$this->db->where('cjas.job_profile_id',$job_profile_id);
		$this->db->where('fs.status',$filtering_status);
		$this->db->group_by('cjas.candidate_job_application_status_id');

		$query = $this->db->get();
		return $this->db_results_fn($query);
	}	

	public function get_in_process_candidates_by_job_profile_id($job_profile_id)
	{
		$this->db->query("set sql_big_selects=1");
		$this->db->distinct('cp.*,cp.candidate_profile_id as cppp,up.*,n.*,ms.status as maritial_status,vs.*,cl.*,d.*,l.email as login_email'); //a.*,
		$this->db->from('candidate_profile cp');
		$this->db->join('candidate_job_application_status cjas', 'cjas.candidate_profile_id = cp.candidate_profile_id');
		$this->db->join('user_profile up', 'up.user_profile_id = cp.user_profile_id','left');
		$this->db->join('login l', 'l.login_id = up.login_id','left');
		$this->db->join('nationality n', 'n.nationality_id = cp.nationality_id','left');
		$this->db->join('maritial_status ms', 'ms.maritial_status_id = cp.maritial_status_id','left');
		$this->db->join('visa_status vs', 'vs.visa_status_id = cp.visa_status_id','left');
		$this->db->join('career_level cl', 'cl.career_level_id = cp.career_level_id','left');
		//$this->db->join('address_profile_map amp', 'amp.user_profile_id = cp.user_profile_id','left');
		//$this->db->join('address a', 'a.address_id = a.address_id','left');
		//$this->db->join('country cy', 'cy.country_id = a.country_id','left');
		$this->db->join('department d', 'd.department_id = cp.department_id','left');
		$this->db->group_by('cjas.candidate_job_application_status_id');
		$this->db->where('cjas.job_profile_id',$job_profile_id);
		$this->db->where('cjas.filtering_status_id !=',11);
		//print $this->db->get_compiled_select();exit;
		$query = $this->db->get();
		return $this->db_results_fn($query);
	}
	public function get_candidate_profile_visibility_count_by_type($user_profile_id,$type)
	{
		$query = '';
		if($type=='employer_views')
			$query = $this->db->query("SELECT viewed_by FROM profile_view WHERE viewed_profile_id ={$user_profile_id} AND viewed_by_type='employer' GROUP BY viewed_by");
		else
			$query = $this->db->query("SELECT viewed_profile_id FROM profile_view WHERE viewed_profile_id ={$user_profile_id} AND viewed_by_type='employer'");
		//print $query->num_rows();exit;
		return $query->num_rows();
	}

	public function get_candidate_profile_visibility($user_profile_id)
	{
		$this->db->select('*');
		$this->db->where('viewed_profile_id',$user_profile_id);
		$query = $this->db->get('profile_view');
		return $this->db_results_fn($query);
	}

	public function get_in_process_candidates_summary_by_job_profile_id_($job_profile_id)
	{
		$this->db->distinct('cp.*');
		$this->db->from('candidate_profile cp');
		$this->db->join('candidate_job_application_status cjas', 'cjas.candidate_profile_id = cp.candidate_profile_id');
		$this->db->join('test_selection_result tsr', 'tlr.candidate_profile_id = cp.candidate_profile_id');
		$this->db->join('job_profile_question_answer jpqa', 'jpqa.job_profile_id = tsr.job_profile_id');
		$this->db->group_by('cjas.candidate_job_application_status_id');

		$this->db->where('cjas.job_profile_id',$job_profile_id);
		$this->db->where('cjas.filtering_status_id !=',11);

		$query = $this->db->get();
		return $this->db_results_fn($query);
	}

	public function get_candidate_question_profiles_by_job_profile_id($job_profile_id)
	{
		$this->db->select('jpqa.*');
		$this->db->from('job_profile_question_answer jpqa');
		$this->db->join('job_profile_question jpq', 'jpq.job_profile_question_id = jpqa.job_profile_question_id');
		$this->db->where('jpq.job_profile_id', $job_profile_id);

		$query = $this->db->get();
		return $this->db_results_fn($query);
	}

	public function get_candidate_question_profile_summary_by_job_profile_id($job_profile_id)
	{
		$this->db->select('SUM(jpqa.points) as total_points,COUNT(jpqa.job_profile_question_id) as total_questions,jpqa.candidate_profile_id');
		$this->db->from('job_profile_question_answer jpqa');
		$this->db->join('job_profile_question jpq', 'jpq.job_profile_question_id = jpqa.job_profile_question_id');
		//$this->db->group_by('jpqa.candidate_profile_id');
		$this->db->where('jpq.job_profile_id', $job_profile_id);
		$this->db->order_by('total_points', 'DESC');

		$query = $this->db->get();
		return $this->db_results_fn($query);
	}

	public function get_candidate_screening_qualification_summary_by_job_profile_id_type($job_profile_id,$type)
	{
		$this->db->select('cqr.points,cqr.candidate_profile_id');
		$this->db->from('screening_qualification_result cqr');
		$this->db->where('cqr.job_profile_id', $job_profile_id);
		$this->db->where('cqr.type', $type);
		$this->db->order_by('cqr.points', 'DESC');
		// print_r($this->db->get_compiled_select());exit;
		$query = $this->db->get();
		return $this->db_results_fn($query);
	}
	public function get_candidate_question_profile_summary_by_job_profile_id_type($job_profile_id,$question_type)
	{
		$this->db->select('SUM(jpqa.points) as points,COUNT(jpqa.job_profile_question_id) as total_questions,jpqa.candidate_profile_id');
		$this->db->from('job_profile_question_answer jpqa');
		$this->db->join('job_profile_question jpq', 'jpq.job_profile_question_id = jpqa.job_profile_question_id');
		$this->db->group_by('jpqa.candidate_profile_id');
		$this->db->where('jpq.job_profile_id', $job_profile_id);
		$this->db->where('jpq.type', $question_type);
		$this->db->order_by('points', 'DESC');
		// print_r($this->db->get_compiled_select());exit;
		$query = $this->db->get();
		return $this->db_results_fn($query);
	}

	public function get_candidate_test_selection_by_job_profile_id_type($job_profile_id,$type)
	{
		$this->db->select('tsr.*');
		$this->db->from('test_selection_result tsr');
		//$this->db->group_by('jpqa.candidate_profile_id');
		$this->db->where('tsr.job_profile_id', $job_profile_id);
		$this->db->where('tsr.type', $type);
		$this->db->order_by('tsr.points', 'DESC');

		$query = $this->db->get();
		return $this->db_results_fn($query);
	}

	public function get_candidate_screening_qualification_by_job_profile_id_type($job_profile_id,$type)
	{
		$this->db->select('sqr.*');
		$this->db->from('screening_qualification_result sqr');
		//$this->db->group_by('jpqa.candidate_profile_id');
		$this->db->where('sqr.job_profile_id', $job_profile_id);
		$this->db->where('sqr.type', $type);
		$this->db->order_by('sqr.points', 'DESC');

		$query = $this->db->get();
		return $this->db_results_fn($query);
	}

	public function get_salary_notice_period_by_candidate_id($candidate_profile_id)
	{
		$this->db->select('snp.*,sr.salary_range as expected_salary,src.salary_range as current_salary,np.period');
		$this->db->from('candidate_salary_notice_period snp');
		$this->db->join('salary_range sr','sr.salary_range_id = snp.expected_salary_id','left');
		$this->db->join('salary_range src','src.salary_range_id = snp.current_salary_id','left');
		$this->db->join('notice_period np','np.notice_period_id = snp.notice_period_id','left');
		$this->db->where('snp.candidate_profile_id',$candidate_profile_id);

		$query = $this->db->get();
		return $this->db_results_fn($query,true);
	}

	public function get_candidate_job_applications_by_user_profile_id($user_profile_id)
	{
		$this->db->select('cp.*,jp.*,up.*,c.country,cmp.name as company_name,fs.*,cjash.date');
		$this->db->from('candidate_job_application_status cjas');
		$this->db->join('candidate_job_application_status_history cjash', 'cjash.candidate_job_application_status_id = cjas.candidate_job_application_status_id');
		$this->db->join('candidate_profile cp', 'cp.candidate_profile_id = cjas.candidate_profile_id');
		$this->db->join('job_profile jp', 'jp.job_profile_id = cjas.job_profile_id');
		$this->db->join('company_profile cmp', 'cmp.company_profile_id = jp.company_profile_id');
		$this->db->join('user_profile up', 'up.user_profile_id = cp.user_profile_id');
		$this->db->join('filtering_status fs', 'fs.filtering_status_id = cjas.filtering_status_id');
		$this->db->join('country c', 'c.country_id = jp.country_id');
		$this->db->where('up.user_profile_id',$user_profile_id);
		$this->db->group_by('cjash.candidate_job_application_status_id');
		$query = $this->db->get();
		return $this->db_results_fn($query);
	}

	public function get_candidate_job_application_history_by_user_profile_id($user_profile_id)
	{
		//jp.is_active, is_position_filled,fs.status, 

		$this->db->select('cp.*,jp.*,up.*,c.country,cmp.name as company_name,fs.*,cjash.date as status_date,GROUP_CONCAT(DISTINCT sr.`type`) AS screen_types,
		GROUP_CONCAT(DISTINCT sr.`points`) AS qual_screen_point, 
		GROUP_CONCAT(DISTINCT ts.`type`) AS test_types,
		GROUP_CONCAT(DISTINCT ts.`points`) AS test_selc_point');
		$this->db->from('candidate_job_application_status cjas');
		$this->db->join('candidate_job_application_status_history cjash', 'cjash.candidate_job_application_status_id = cjas.candidate_job_application_status_id');
		$this->db->join('candidate_profile cp', 'cp.candidate_profile_id = cjas.candidate_profile_id');
		$this->db->join('job_profile jp', 'jp.job_profile_id = cjas.job_profile_id');
		$this->db->join('company_profile cmp', 'cmp.company_profile_id = jp.company_profile_id');
		$this->db->join('user_profile up', 'up.user_profile_id = cp.user_profile_id');
		$this->db->join('filtering_status fs', 'fs.filtering_status_id = cjash.filtering_status_id');
		$this->db->join('country c', 'c.country_id = jp.country_id');
		$this->db->join('screening_qualification_result sr', 'cjas.candidate_profile_id = sr.candidate_profile_id AND cjas.job_profile_id = sr.job_profile_id','left');
		$this->db->join('test_selection_result ts', 'cjas.candidate_profile_id = ts.candidate_profile_id AND cjas.job_profile_id = ts.job_profile_id','left');
		$this->db->where('up.user_profile_id',$user_profile_id);
		$this->db->group_by('cjas.candidate_profile_id,cjas.job_profile_id');

		$query = $this->db->get();
		return $this->db_results_fn($query);
	}

	public function get_candidate_job_application_history_count_by_user_profile_id($user_profile_id)
	{
		$this->db->select('cp.*,jp.*,up.*,c.country,cmp.name as company_name,fs.*,cjash.date as status_date,cjas.*');
		$this->db->from('candidate_job_application_status cjas');
		$this->db->join('candidate_job_application_status_history cjash', 'cjash.candidate_job_application_status_id = cjas.candidate_job_application_status_id');
		$this->db->join('candidate_profile cp', 'cp.candidate_profile_id = cjas.candidate_profile_id');
		$this->db->join('job_profile jp', 'jp.job_profile_id = cjas.job_profile_id');
		$this->db->join('company_profile cmp', 'cmp.company_profile_id = jp.company_profile_id');
		$this->db->join('user_profile up', 'up.user_profile_id = cp.user_profile_id');
		$this->db->join('filtering_status fs', 'fs.filtering_status_id = cjash.filtering_status_id');
		$this->db->join('country c', 'c.country_id = jp.country_id');
		$this->db->where('up.user_profile_id',$user_profile_id);
		$this->db->group_by('cjas.job_profile_id');

		return $this->db->get()->num_rows();
	}

	public function get_candidate_job_count_by_user_profile_id_and_status($user_profile_id,$status=false)
	{
		$this->db->select('jp.*');
		$this->db->from('candidate_job_application_status cjas');
		$this->db->join('candidate_profile cp', 'cp.candidate_profile_id = cjas.candidate_profile_id');
		$this->db->join('job_profile jp', 'jp.job_profile_id = cjas.job_profile_id');
		$this->db->join('user_profile up', 'up.user_profile_id = cp.user_profile_id');
		$this->db->join('filtering_status fs', 'fs.filtering_status_id = cjas.filtering_status_id');
		$this->db->where('up.user_profile_id',$user_profile_id);
		if($status !== false)
			$this->db->where('fs.status !=',$status);

		return $this->db->get()->num_rows();
	}

	public function get_candidate_profile_views_count_by_user_profile_id($user_profile_id)
	{
			$this->db->select('cp.*');
			$this->db->from('candidate_profile_view cpv');
			$this->db->join('candidate_profile cp', 'cp.candidate_profile_id = cpv.candidate_profile_id');
			$this->db->join('user_profile up', 'up.user_profile_id = cp.user_profile_id');
			$this->db->where('up.user_profile_id',$user_profile_id);

			return $this->db->count_all_results();
	}

	public function get_candidate_profile_id_by_user_profile_id($user_profile_id)
	{
		$this->db->select('cp.candidate_profile_id');
		$this->db->where('cp.user_profile_id',$user_profile_id);

		$query = $this->db->get('candidate_profile cp');
		// print_r($job_ref_no);exit;
		if($query->num_rows() > 0)
		{

			$result = $query->result();
			return $result[0]->candidate_profile_id;
		}
		else
			return 0;
	}

	public function get_user_profile_id_by_candidate_profile_id($candidate_profile_id)
	{
		$this->db->select('cp.user_profile_id');
		$this->db->where('cp.candidate_profile_id',$candidate_profile_id);

		$query = $this->db->get('candidate_profile cp');
		// print_r($job_ref_no);exit;
		if($query->num_rows() > 0)
		{
			$result = $query->result();
			return $result[0]->user_profile_id;
		}
		else
			return 0;
	}

	public function get_company_by_user_profile_id($user_profile_id)
	{
		$this->db->select('cp.*,ct.*,er.*');
		$this->db->from('company_profile cp');
		$this->db->join('user_profile up', 'up.user_profile_id = cp.user_profile_id','left');
		$this->db->join('company_type ct', 'ct.company_type_id = cp.company_type_id','left');
		$this->db->join('employee_range er', 'er.employee_range_id = cp.employee_range_id','left');
		$this->db->where('up.user_profile_id',$user_profile_id);

		$query = $this->db->get();
		return $this->db_results_fn($query,true);
	}

	public function get_companies($status=0,$order_by_id_asc='ASC',$limit=false,$offset=0)
	{
		$this->db->query("set sql_big_selects=1");
		$this->db->distinct('cp.*,ct.*,er.*,cy.*,c.*,a.*,l.email as login_email,up.is_active');
		$this->db->from('company_profile cp');
		$this->db->join('user_profile up', 'up.user_profile_id = cp.user_profile_id');
		$this->db->join('login l', 'l.login_id = up.login_id');
		$this->db->join('company_type ct', 'ct.company_type_id = cp.company_type_id','left');
		$this->db->join('address_profile_map apm', 'apm.user_profile_id = up.user_profile_id','left');
		$this->db->join('address a', 'a.address_id = apm.address_id','left');
		$this->db->join('city c', 'c.city_id = a.city_id','left');
		$this->db->join('country cy', 'cy.country_id = a.country_id','left');
		$this->db->join('employee_range er', 'er.employee_range_id = cp.employee_range_id','left');
		$this->db->join('job_profile jp', 'jp.company_profile_id = cp.company_profile_id','left');
		$this->db->order_by('jp.job_profile_id','DESC');
		$this->db->group_by('cp.company_profile_id');
		$this->db->where('up.is_deleted',0);
		if($limit!=0)
			$this->db->limit($limit,$offset);
		if($status !== 0)
			$this->db->where('up.is_active',$status);
		// print_r($this->db->get_compiled_select());
		$query = $this->db->get();
		return $this->db_results_fn($query);
	}

	public function get_featured_companies($status=0)
	{
		$this->db->query("set sql_big_selects=1");
		$this->db->distinct('cp.*,ct.*,er.*,cy.*,c.*,a.*,l.email as login_email,up.is_active,con.*');
		$this->db->from('company_profile cp');
		$this->db->join('user_profile up', 'up.user_profile_id = cp.user_profile_id');
		$this->db->join('login l', 'l.login_id = up.login_id');
		$this->db->join('company_type ct', 'ct.company_type_id = cp.company_type_id','left');
		$this->db->join('address_profile_map apm', 'apm.user_profile_id = up.user_profile_id','left');
		$this->db->join('address a', 'a.address_id = apm.address_id','left');
		$this->db->join('contact_profile_map cpm', 'cpm.user_profile_id = up.user_profile_id','left');
		$this->db->join('contact con', 'con.contact_id = cpm.contact_id','left');
		$this->db->join('city c', 'c.city_id = a.city_id','left');
		$this->db->join('country cy', 'cy.country_id = a.country_id','left');
		$this->db->join('employee_range er', 'er.employee_range_id = cp.employee_range_id','left');
		$this->db->join('job_profile jp', 'jp.company_profile_id = cp.company_profile_id','left');
		$this->db->order_by('jp.job_profile_id','ASC');
		$this->db->group_by('cp.company_profile_id');
		$this->db->where('cp.is_featured',1);
		if($status !== 0)
			$this->db->where('up.is_active',$status);
		// print_r($this->db->get_compiled_select());
		$query = $this->db->get();
		return $this->db_results_fn($query);
	}

	public function get_companies_pending_approval()
	{
		$this->db->query("set sql_big_selects=1");
		$this->db->select('cp.*,l.email as login_email,up.*'); 
		$this->db->from('company_profile cp');
		$this->db->join('user_profile up', 'up.user_profile_id = cp.user_profile_id');
		$this->db->join('login l', 'l.login_id = up.login_id');
		$this->db->group_by('cp.company_profile_id');
		$this->db->where('up.is_active',0);
		// print_r($this->db->get_compiled_select());
		$query = $this->db->get();
		return $this->db_results_fn($query);
	}

	public function get_job_profiles($status=0,$order_by='ASC',$limit=0,$offset=0)
	{
		$this->db->query("set sql_big_selects=1");
		$this->db->select('jp.*,d.department,c.country,cl.career_level,cp.*,cp.name as company_name');
		$this->db->from('job_profile jp');
		$this->db->join('company_profile cp','jp.company_profile_id=cp.company_profile_id');
		$this->db->join('department d','d.department_id=jp.department_id');
		$this->db->join('country c','c.country_id=jp.country_id');
		$this->db->join('career_level cl','cl.career_level_id=jp.career_level_id');
		$this->db->order_by('jp.job_profile_id', $order_by);
		if($limit!=0)
			$this->db->limit($limit,$offset);
		if($status != 0) 
			$this->db->where('jp.is_active',$status);
		// print_r($this->db->get_compiled_select());
		$query = $this->db->get();
		return $this->db_results_fn($query);
	}
	public function get_job_profiles_by_search_options($search_options,$status=-1)
	{
		/*$this->db->select('jp.*,d.department,c.country,cl.career_level,cp.*,cp.name as company_name');
		$this->db->from('job_profile jp');
		$this->db->join('company_profile cp','jp.company_profile_id=cp.company_profile_id');
		$this->db->join('department d','d.department_id=jp.department_id');
		$this->db->join('country c','c.country_id=jp.country_id');
		$this->db->join('career_level cl','cl.career_level_id=jp.career_level_id');
		$this->db->where('jp.is_active', true);*/
		$query = "SELECT jp.*, d.department, c.country, cl.career_level, cp.*, cp.name as company_name FROM job_profile jp JOIN company_profile cp ON jp.company_profile_id=cp.company_profile_id LEFT JOIN department d ON d.department_id=jp.department_id JOIN country c ON c.country_id=jp.country_id JOIN career_level cl ON cl.career_level_id=jp.career_level_id WHERE jp.is_active=1";
		if (!empty($search_options['keyword'])){
			$query .=" AND (cp.name LIKE '%{$search_options['keyword']}%'";
			$query .=" OR jp.position LIKE '%{$search_options['keyword']}%'"; 
			$query .=" OR jp.job_ref_no LIKE '%{$search_options['keyword']}%'"; 
			$query .=" OR cp.company_ref_no LIKE '%{$search_options['keyword']}%')"; 
		}
		if (!empty($search_options['keyword_s']) && (empty($search_options['keyword']) || ($search_options['keyword'] == $search_options['keyword_s']))){
			$query .=" AND (cp.name LIKE '%{$search_options['keyword_s']}%'";
			$query .=" OR jp.position LIKE '%{$search_options['keyword_s']}%'"; 
			$query .=" OR jp.job_ref_no LIKE '%{$search_options['keyword_s']}%'"; 
			$query .=" OR cp.company_ref_no LIKE '%{$search_options['keyword_s']}%')"; 
		}
		if (!empty($search_options['salary_range'])){
			$query .=" AND jp.salary_range_id IN ({$search_options['salary_range']})";
		}
		if (!empty($search_options['employment_status'])){
			$query .=" AND jp.employment_status_id IN ({$search_options['employment_status']})";
		}
		if (!empty($search_options['country'])){
			$query .=" AND jp.country_id IN ({$search_options['country']})";
		}
		if (!empty($search_options['country_s'])){
			$query .=" AND jp.country_id = {$search_options['country_s']}";
		}
		if (!empty($search_options['career_level'])){
			$query .=" AND jp.career_level_id IN ({$search_options['career_level']})";
		}
		if (!empty($search_options['experience_level'])){
			$query .=" AND jp.experience_level_id = {$search_options['experience_level']}";
		}
		if (!empty($search_options['experience_level_s'])){
			$query .=" AND jp.experience_level_id = {$search_options['experience_level_s']}";
		}		
		if (!empty($search_options['industry'])){
			$query .=" AND (jp.industry_ids LIKE '%{$search_options['industry']},%' OR jp.industry_ids LIKE '%,{$search_options['industry']}%') AND jp.industry_ids NOT LIKE '%{$search_options['industry']}_,%' AND jp.industry_ids NOT LIKE '%,{$search_options['industry']}_%'";
		}
		if (!empty($search_options['industry_s'])){
			$query .=" AND (jp.industry_ids LIKE '{$search_options['industry_s']}' OR jp.industry_ids LIKE '{$search_options['industry_s']},%' OR jp.industry_ids LIKE '%,{$search_options['industry_s']}%' OR jp.industry_ids LIKE '%,{$search_options['industry_s']},%') ";
		}
		if($status === false || $status === true)
			$query .=" AND jp.is_active = {$status}";

		$query .=" ORDER BY jp.posted_date DESC ";

		if(isset($search_options['page']) && $search_options['page'] == 0)
			$query .=" LIMIT ".JOBS_LISTED_PER_PAGE;
		else if(isset($search_options['page']))
			$query .=" LIMIT ".JOBS_LISTED_PER_PAGE." OFFSET ".JOBS_LISTED_PER_PAGE * ($search_options['page']-1);
	
		//
		//print_r($this->db->get_compiled_select());
		// print_r($query);exit;
		// $query = $this->db->get();
		$this->db->query("set sql_big_selects=1");
		$query = $this->db->query($query);

		return $this->db_results_fn($query);
	}

	public function get_job_profile_by_id($job_profile_id)
	{
		$this->db->select('jp.*,d.department,cy.country,c.city,cl.career_level,cp.company_logo,cp.company_profile_id,cp.company_ref_no,cp.name as company_name,cp.about_company as about_company,el.level as experience_level,dt.type as degree_type,np.period as notice_period,pa.age,es.status as employment_status,sr.salary_range,vs.type as visa_status,ms.status as maritial_status,ct.*');
		$this->db->from('job_profile jp');
		$this->db->join('company_profile cp','jp.company_profile_id=cp.company_profile_id');
		$this->db->join('contact_profile_map cpm','cpm.user_profile_id=cp.user_profile_id','left');
		$this->db->join('contact ct','ct.contact_id=cpm.contact_id','left');
		$this->db->join('department d','d.department_id=jp.department_id','left');
		$this->db->join('country cy','cy.country_id=jp.country_id','left');
		$this->db->join('city c','c.city_id=jp.city_id','left');
		$this->db->join('career_level cl','cl.career_level_id=jp.career_level_id','left');
		$this->db->join('experience_level el','el.experience_level_id=jp.experience_level_id','left');
		$this->db->join('degree_type dt','dt.degree_type_id=jp.degree_type_id','left');
		$this->db->join('notice_period np','np.notice_period_id=jp.notice_period_id','left');
		$this->db->join('preferred_age pa','pa.preferred_age_id=jp.preferred_age_id','left');
		$this->db->join('maritial_status ms','ms.maritial_status_id=jp.maritial_status_id','left');
		$this->db->join('employment_status es','es.employment_status_id=jp.employment_status_id','left');
		$this->db->join('salary_range sr','sr.salary_range_id=jp.salary_range_id','left');
		$this->db->join('visa_status vs','vs.visa_status_id=jp.visa_status_id','left');
		$this->db->where('jp.job_profile_id',$job_profile_id);
		//print_r($this->db->get_compiled_select());
		$query = $this->db->get();
		return $this->db_results_fn($query,true);
	}

	public function get_job_count_with_countries()
	{
		$this->db->select('COUNT(jp.job_profile_id) as job_count,c.country');
		$this->db->from('job_profile jp');
		$this->db->join('country c', 'c.country_id = jp.country_id', 'left');
		$this->db->group_by('jp.country_id');
		$this->db->order_by('job_count', 'DESC');
		$query = $this->db->get();
		return $this->db_results_fn($query);
	}

	public function get_candidates_count_with_countries()
	{
		$this->db->select('COUNT(cp.candidate_profile_id) as candidate_count,c.country');
		$this->db->from('candidate_profile cp');
		$this->db->join('country c', 'c.country_id = cp.nationality_id', 'left');
		$this->db->group_by('cp.nationality_id');
		$this->db->order_by('candidate_count', 'DESC');
		$query = $this->db->get();
		return $this->db_results_fn($query);
	}

	public function get_candidates_count_with_industries($industry_id)
	{
		$this->db->select('COUNT(cp.candidate_profile_id) as candidate_count, cp.industry_ids, i.industry');
		$this->db->join('industry i', 'i.industry_id = cp.industry_ids', 'left');
		$this->db->from('candidate_profile cp');
                $this->db->having('i.industry_id = cp.industry_ids');
		$this->db->where('i.industry_id = '.$industry_id);
		$this->db->group_by('i.industry_id');
//		$this->db->order_by('candidate_count', 'DESC');
		$query = $this->db->get();
		return $this->db_results_fn($query);
	}
        
	public function get_candidates_count_with_experience()
	{
		$this->db->select('COUNT(cp.candidate_profile_id) as candidate_count, ex.level');
		$this->db->join('cv_experience cv_ex', 'cv_ex.candidate_profile_id = cp.candidate_profile_id', 'left');
		$this->db->join('experience_level ex', 'ex.experience_level_id = cv_ex.experience_level_id', 'left');
		$this->db->from('candidate_profile cp');
		$this->db->group_by('ex.experience_level_id');
		$this->db->order_by('candidate_count', 'DESC');
		$query = $this->db->get();
		return $this->db_results_fn($query);
	}

	public function get_candidate_counts_by_job_profile_id_status_process($job_profile_id,$status,$process)
	{
		$this->db->select('cjash.*');
		$this->db->from('candidate_job_application_status_history cjash');
		$this->db->join('candidate_job_application_status cjas', 'cjas.candidate_job_application_status_id = cjash.candidate_job_application_status_id');
		$this->db->join('filtering_status fs', 'fs.filtering_status_id = cjash.filtering_status_id');
		$this->db->where('fs.status',$status);
		$this->db->where('cjas.job_profile_id',$job_profile_id);
		$this->db->where('cjash.filtering_state',$process);
		// $this->db->group_by('cjash.candidate_job_application_status_id');
		// print_r($this->db->get_compiled_select());exit;
		return $this->db->get()->num_rows();
	}

	public function get_candidate_declined_by_job_profile_id_status_process($job_profile_id,$process)
	{
		$this->db->select('cjash.*');
		$this->db->from('candidate_job_application_status_history cjash');
		$this->db->join('candidate_job_application_status cjas', 'cjas.candidate_job_application_status_id = cjash.candidate_job_application_status_id');
		$this->db->join('filtering_status fs', 'fs.filtering_status_id = cjash.filtering_status_id');
		$this->db->where('cjas.job_profile_id',$job_profile_id);
		$this->db->where('cjash.filtering_status_id',11);
		$this->db->where('cjash.filtering_state',$process);
		// $this->db->group_by('cjash.candidate_job_application_status_id');
		// print_r($this->db->get_compiled_select());exit;
		return $this->db->get()->num_rows();
	}
	public function get_candidates_application_counts_by_job_profile_id($job_profile_id)
	{
		$this->db->select('cjas.*');
		$this->db->from('candidate_job_application_status cjas');
		$this->db->where('cjas.job_profile_id',$job_profile_id);
		// get_candidates_application_counts_by_job_profile_id
		// print_r($this->db->get_compiled_select());exit;
		return $this->db->count_all_results();
	}
	public function is_application_history_recorded($history_data)
	{
		$this->db->select('cjash.*');
		$this->db->from('candidate_job_application_status_history cjash');
		$this->db->where($history_data);
		// get_candidates_application_counts_by_job_profile_id
		if($this->db->count_all_results())
			return 1;
		return 0;
	}

	public function get_filter_process_state_by_job_profile_id($job_profile_id)
	{
		$this->db->select('fs.status');
		$this->db->from('job_profile_filtering_status jpfs');
		$this->db->join('filtering_status  fs','fs.filtering_status_id=jpfs.filtering_status_id');
		$this->db->where('jpfs.job_profile_id',$job_profile_id);
		$query = $this->db->get();
		// print_r($job_ref_no);exit;
		if($query->num_rows() > 0)
		{
			$result = $query->result();
			return $result[0]->status;
		}
		else
			return '';
	}

	public function get_data_by_id_collection($ids,$table_name,$primary_key,$column='*')
	{

		if(empty($ids))
			$ids = "0";
		$query = "SELECT {$column} FROM {$table_name} WHERE {$primary_key} IN ({$ids})";
		// print_r($query);
		$query = $this->db->query($query);
		return $this->db_results_fn($query);
	}

	public function get_job_profile_id_by_ref($job_ref_no)
	{
		$this->db->select('jp.job_profile_id');
		$this->db->where('jp.job_ref_no',$job_ref_no);

		$query = $this->db->get('job_profile jp');
		// print_r($job_ref_no);exit;
		if($query->num_rows() > 0)
		{
			$result = $query->result();
			return $result[0]->job_profile_id;
		}
		else
			return 0;
	}

	public function get_job_profiles_by_user_profile_id($user_profile_id=-1,$status=-1,$user_type='employer')
	{
		$this->db->select('jp.*,d.department,c.country,cl.career_level,cp.*');
		$this->db->from('job_profile jp');
		if($user_type == 'employer')
		{
			$this->db->join('company_profile cp','jp.company_profile_id=cp.company_profile_id');
		}
		else
		{
			$this->db->join('candidate_job_application_status cjas','cjas.job_profile_id=jp.job_profile_id');
			$this->db->join('candidate_profile cp','cp.candidate_profile_id=cjas.candidate_profile_id');
		}
		$this->db->join('department d','d.department_id=jp.department_id','left');
		$this->db->join('country c','c.country_id=jp.country_id','left');
		$this->db->join('career_level cl','cl.career_level_id=jp.career_level_id','left');
		if($user_profile_id != -1)
			$this->db->where('cp.user_profile_id',$user_profile_id);
		if($status === false || $status === true)
			$this->db->where('jp.is_active',$status);
		$this->db->order_by('jp.is_position_filled');
		$query = $this->db->get();
		return $this->db_results_fn($query);
	}

	public function get_job_profile_questions_by_id($job_profile_id)
	{
		$this->db->select('qp.*');
		$this->db->from('job_profile_question qp');
		$this->db->where('qp.job_profile_id',$job_profile_id);

		$query = $this->db->get();
		return $this->db_results_fn($query);
	}
	
	public function get_job_profile_questions_by_id_and_type($job_profile_id,$type)
	{
		$this->db->select('qp.*');
		$this->db->from('job_profile_question qp');
		$this->db->where('qp.job_profile_id',$job_profile_id);
		$this->db->where('qp.type',$type);

		$query = $this->db->get();
		return $this->db_results_fn($query);
	}

	public function get_job_profile_questions_by_job_profile_candidate_profile_and_type($job_profile_id,$candidate_profile_id,$type)
	{
		$this->db->select('jpq.*jpqa.*');
		$this->db->from('job_profile_question jqp');
		$this->db->join('job_profile_question_answers jqpa','jpq.job_profile_question_id = jpqa.job_profile_question_id');
		$this->db->where('jpq.job_profile_id',$job_profile_id);
		$this->db->where('jpqa.candidate_profile_id',$candidate_profile_id);
		$this->db->where('jpq.type',$type);

		$query = $this->db->get();
		return $this->db_results_fn($query);
	}

	public function get_job_profile_questions_count_by_id_and_type($job_profile_id,$type)
	{
		$this->db->select('qp.*');
		$this->db->from('job_profile_question qp');
		$this->db->where('qp.job_profile_id',$job_profile_id);
		$this->db->where('qp.type',$type);

		return $this->db->get()->num_rows();
	}

	public function position_question_link_data_by_code($code)
	{
		$this->db->select('jpql.*');
		$this->db->from('job_profile_question_link jpql');
		$this->db->where('jpql.code',$code);

		$query = $this->db->get();
		return $this->db_results_fn($query,true);
	}
	public function get_job_profile_questions_by_code_and_type($code,$type)
	{
		$this->db->select('qp.*');
		$this->db->from('job_profile_question qp');
		$this->db->join('job_profile_question_link jpql', 'jpql.job_profile_id = qp.job_profile_id');
		$this->db->where('jpql.code',$code);
		$this->db->where('qp.type',$type);

		$query = $this->db->get();
		return $this->db_results_fn($query);
	}

	public function get_candidate_interviews_by_job_profile_id($job_profile_id)
	{
		$this->db->select('cp.*,c.*,is.*');
		$this->db->from('candidate_profile cp');
		$this->db->join('interview_schedule is', 'is.candidate_profile_id = cp.candidate_profile_id');
		$this->db->join('address_profile_map amp', 'amp.user_profile_id = cp.user_profile_id','left');
		$this->db->join('address a', 'a.address_id = amp.address_id','left');
		$this->db->join('country c', 'c.country_id = a.country_id','left');
		$this->db->where('is.job_profile_id',$job_profile_id);
		$this->db->group_by('cp.candidate_profile_id');
		$this->db->order_by('is.status', 'DESC');
		$this->db->order_by('is.interview_date', 'ASC');
		// print_r($this->db->get_compiled_select());exit;
		$query = $this->db->get();
		return $this->db_results_fn($query);
	}
	public function get_interview_schedule_by_code($code)
	{
		$this->db->where('code',$code);
		$this->db->where('code !=','');
		$query = $this->db->get('interview_schedule');
		return $this->db_results_fn($query,true);
	}

	public function is_interview_schedule_code_used($code)
	{
		$this->db->where('code',$code);
		$query = $this->db->get('interview_schedule');

		if($query->num_rows() > 0)
		{
			0;
		}
		else
			return 1;
	}

	public function remove_position_questions_code_by_code($code)
	{
		$this->db->update('job_profile_question_link',array('code'=>''),array('code'=>$code));
	}

	public function update_schedule_interview_code($interview_data,$code)
	{
		$this->db->update('interview_schedule',$interview_data,array('code'=>$code));
	}

	public function update_website_clicked_count($company_profile_id)
	{
		$this->db->query("UPDATE company_profile SET website_clicked_count=(website_clicked_count+1) WHERE company_profile_id={$company_profile_id}");
		return true;
	}

	public function update_job_appearance_count($job_profile_id)
	{
		$this->db->query("UPDATE job_profile SET appearance_count=(appearance_count+1) WHERE job_profile_id={$job_profile_id}");
		return true;
	}
 

	public function remove_position_questions_code_by_candidate_job_profile_id($candidate_profile_id,$job_profile_id)
	{
		$this->db->update('job_profile_question_link',array('code'=>''),array('candidate_profile_id'=>$candidate_profile_id,'job_profile_id'=>$job_profile_id));
	}

	public function get_unanswered_questions_count_by_job_profile_id($job_profile_id)
	{
		$this->db->select('*');
		$this->db->from('job_profile_question_link');
		$this->db->where('job_profile_id',$job_profile_id);
		$this->db->where('code !=','');
		return $this->db->count_all_results();
	}
	
	public function get_answered_questions_count_by_job_profile_id($job_profile_id)
	{
		$this->db->select('*');
		$this->db->from('job_profile_question_link');
		$this->db->where('job_profile_id',$job_profile_id);
		$this->db->where('code =','');
		return $this->db->count_all_results();
	}
	public function has_candidate_answered_questions($job_profile_id,$candidate_profile_id)
	{
		$this->db->select('*');
		$this->db->from('job_profile_question_link');
		$this->db->where('job_profile_id',$job_profile_id);
		$this->db->where('candidate_profile_id',$candidate_profile_id);
		$this->db->where('code =','');
		return $this->db->get()->num_rows();
	}
	
	public function has_candidate_applied($job_profile_id,$candidate_profile_id)
	{
		$this->db->select('cjas.*');
		$this->db->from('candidate_job_application_status cjas');
		$this->db->where('cjas.job_profile_id',$job_profile_id);
		$this->db->where('cjas.candidate_profile_id',$candidate_profile_id);

		$query = $this->db->get();
		// print $candidate_profile_id;exit;
		if($query->num_rows())
			return 1;
		return 0;
	}	
	public function candidate_job_application_status_id($job_profile_id,$candidate_profile_id)
	{
		$this->db->select('cjas.*');
		$this->db->from('candidate_job_application_status cjas');
		$this->db->where('cjas.job_profile_id',$job_profile_id);
		$this->db->where('cjas.candidate_profile_id',$candidate_profile_id);

		$query = $this->db->get();
		// print $candidate_profile_id;exit;
		if($query->num_rows())
		{
			$result = $query->result();
			return $result[0]->candidate_job_application_status_id;
		}
		return 0;
	}
	public function get_reperesentative_by_user_profile_id($user_profile_id)
	{
		$this->db->select('cr.*');
		$this->db->from('company_representative cr');
		$this->db->join('company_profile cp', 'cp.company_profile_id = cr.company_profile_id','left');
		$this->db->where('cp.user_profile_id',$user_profile_id);

		$query = $this->db->get();
		return $this->db_results_fn($query,true);
	}

	public function get_address_by_user_profile_id($user_profile_id)
	{
		$this->db->select('a.*,apm.*,c.city,cy.country');
		$this->db->from('address_profile_map apm');
		$this->db->join('address a', 'a.address_id = apm.address_id');
		$this->db->join('city c', 'c.city_id = a.city_id','left');
		$this->db->join('country cy', 'cy.country_id = a.country_id','left');
		$this->db->where('apm.user_profile_id',$user_profile_id);

		$query = $this->db->get();
		return $this->db_results_fn($query,true);
	}
	public function get_contact_by_user_profile_id($user_profile_id)
	{
		$this->db->select('c.*,cpm.*');
		$this->db->from('contact_profile_map cpm');
		$this->db->join('contact  c', 'c.contact_id = cpm.contact_id');
		$this->db->where('cpm.user_profile_id',$user_profile_id);

		$query = $this->db->get();
		return $this->db_results_fn($query,true);
	}

	public function get_education_by_user_profile_id($user_profile_id)
	{
		$this->db->select('d.*,dt.type as degree_type,c.*,ef.*');
		$this->db->from('cv_degree d');
		$this->db->join('candidate_profile  cp', 'cp.candidate_profile_id = d.candidate_profile_id');
		$this->db->join('degree_type  dt', 'dt.degree_type_id = d.degree_type_id');
		$this->db->join('education_faculty  ef', 'ef.education_faculty_id = d.education_faculty_id');
		$this->db->join('country  c', 'c.country_id = d.country_id');
		$this->db->where('cp.user_profile_id',$user_profile_id);

		$query = $this->db->get();
		return $this->db_results_fn($query);
	}

	public function get_education_faculties_by_user_profile_id($user_profile_id)
	{
		$this->db->select('ef.education_faculty_id');
		$this->db->from('education_faculty ef');
		$this->db->join('cv_degree  d', 'd.education_faculty_id = ef.education_faculty_id');
		$this->db->join('candidate_profile  cp', 'cp.candidate_profile_id = d.candidate_profile_id');
		$this->db->where('cp.user_profile_id',$user_profile_id);

		$query = $this->db->get();
		return $this->db_results_fn($query);
	}
	public function get_experience_by_user_profile_id($user_profile_id)
	{
		$this->db->select('e.*,el.level as experience_level,c.country,cer.name as reference_name,cer.position as reference_position,cer.mobile as reference_mobile,cer.experience_reference_id,i.industry');
		$this->db->from('cv_experience e');
		$this->db->join('candidate_profile  cp', 'cp.candidate_profile_id = e.candidate_profile_id');
		$this->db->join('cv_experience_reference  cer', 'cer.experience_id = e.experience_id');
		$this->db->join('experience_level  el', 'el.experience_level_id = e.experience_level_id');
		$this->db->join('country  c', 'c.country_id = e.country_id','left');
		$this->db->join('industry  i', 'i.industry_id = e.industry_id','left');
		$this->db->where('cp.user_profile_id',$user_profile_id);

		$query = $this->db->get();
		return $this->db_results_fn($query);
	}

	public function get_certificate_by_user_profile_id($user_profile_id)
	{
		$this->db->select('c.*');
		$this->db->from('cv_certificate c');
		$this->db->join('candidate_profile  cp', 'cp.candidate_profile_id = c.candidate_profile_id');
		$this->db->where('cp.user_profile_id',$user_profile_id);

		$query = $this->db->get();
		return $this->db_results_fn($query);
	}
	public function get_language_expertise_by_user_profile_id($user_profile_id)
	{
		$this->db->select('le.*,l.*');
		$this->db->from('cv_language_expertise le');
		$this->db->join('candidate_profile  cp', 'cp.candidate_profile_id = le.candidate_profile_id');
		$this->db->join('language  l', 'l.language_id = le.language_id');
		$this->db->where('cp.user_profile_id',$user_profile_id);

		$query = $this->db->get();
		return $this->db_results_fn($query);
	}
	public function get_membership_by_user_profile_id($user_profile_id)
	{
		$this->db->select('m.*');
		$this->db->from('cv_membership m');
		$this->db->join('candidate_profile  cp', 'cp.candidate_profile_id = m.candidate_profile_id');
		$this->db->where('cp.user_profile_id',$user_profile_id);

		$query = $this->db->get();
		return $this->db_results_fn($query);
	}

	public function get_filtering_status_id_by_status($status)
	{
		$this->db->select('fs.filtering_status_id');
		$this->db->where('fs.status',$status);

		$query = $this->db->get('filtering_status fs');
		// print_r($job_ref_no);exit;
		if($query->num_rows() > 0)
		{
			$result = $query->result();
			return $result[0]->filtering_status_id;
		}
		else
			return 0;
	}
	public function get_job_profile_filtering_status_id_by_job_profile_id($job_profile_id)
	{
		$this->db->select('jbfs.job_profile_filtering_status_id');
		$this->db->where('jbfs.job_profile_id',$job_profile_id);

		$query = $this->db->get('job_profile_filtering_status jbfs');
		// print_r($job_ref_no);exit;
		if($query->num_rows() > 0)
		{
			$result = $query->result();
			return $result[0]->job_profile_filtering_status_id;
		}
		else
			return 0;
	}

	public function get_saved_jobs_by_candidate_profile_id($user_profile_id)
	{
		$this->db->select('cp.name as company_name,jp.job_ref_no,jp.position,sj.date as saved_date');
		$this->db->from('saved_job sj');
		$this->db->join('job_profile jp', 'jp.job_profile_id = sj.job_profile_id');
		$this->db->join('company_profile cp', 'cp.company_profile_id = jp.company_profile_id');
		$this->db->where('sj.user_profile_id',$user_profile_id);

		$query = $this->db->get();
		return $this->db_results_fn($query);

	}
	public function is_newsletter_subscribed($email)
	{
		$this->db->select('ns.date');
		$this->db->where('ns.email',$email);

		$query = $this->db->get('newsletter_subscription ns');
		// print_r($job_ref_no);exit;
		if($query->num_rows() > 0)
		{
			return 1;
		}
		else
			return 0;
	}

	private function db_results_fn($query,$is_one_row = false,$return_array=false)
	{
		$result = new stdClass();
		if($return_array)
			$result = $query->result_array();
		else	
			$result = $query->result();
		if($query->num_rows() > 0)
		{
			if($is_one_row)
				return $result[0];
			return $result;
		}
			
		return array();
	}

	public function get_all_jobs_by_type($type="open")
	{
		$this->db->select('jp.*,cp.name as company_name,c.country');
		$this->db->from('job_profile jp');
		$this->db->join('company_profile cp','cp.company_profile_id=jp.company_profile_id');
		$this->db->join('country c','c.country_id=jp.country_id','left');
		if($type == 'open')
		{
			$this->db->where('is_position_filled',0);
			$this->db->where('close_date > ', date('Y-m-d'));
		}
		elseif($type == 'close')
		{
			// $this->db->where('is_position_filled',1);
			$this->db->where('close_date < ', date('Y-m-d'));
		}

		// print_r($this->db->get_compiled_select());exit;
		$query = $this->db->get();
		return $this->db_results_fn($query);
	}

	public function get_all_jobs_by_type_and_user_profile_id($type="open",$user_profile_id)
	{
		$this->db->select('jp.*,cp.name as company_name,c.country');
		$this->db->from('job_profile jp');
		$this->db->join('company_profile cp','cp.company_profile_id=jp.company_profile_id');
		$this->db->join('country c','c.country_id=jp.country_id','left');
		$this->db->where('cp.user_profile_id',$user_profile_id);
		if($type == 'open')
		{
			// $this->db->where('is_position_filled',0);
			$this->db->where('close_date > ', date('Y-m-d'));
		}
		elseif($type == 'close')
		{
			// $this->db->where('is_position_filled',1);
			$this->db->where('close_date < ', date('Y-m-d'));
		}
		//print_r($this->db->get_compiled_select());exit;
		$query = $this->db->get();
		return $this->db_results_fn($query);
	}

	public function get_all_opened_jobs()
	{
		$this->db->select('jp.*,cp.name as company_name,c.country');
		$this->db->from('job_profile jp');
		$this->db->join('company_profile cp','cp.company_profile_id=jp.company_profile_id');
		$this->db->join('country c','c.country_id=jp.country_id','left');
		// $this->db->where('is_position_filled',0);
		$this->db->where('close_date > ', date('Y-m-d'));

		// print_r($this->db->get_compiled_select());exit;
		$query = $this->db->get();
		return $this->db_results_fn($query);
	}
	public function get_all_closed_jobs()
	{
		$this->db->select('jp.*,cp.name as company_name,c.country');
		$this->db->from('job_profile jp');
		$this->db->join('company_profile cp','cp.company_profile_id=jp.company_profile_id');
		$this->db->join('country c','c.country_id=jp.country_id','left');
		$this->db->where('is_position_filled',1);
		$this->db->where('close_date < ', date('Y-m-d'));
		// print_r($this->db->get_compiled_select());exit;
		$query = $this->db->get();
		return $this->db_results_fn($query);
	}
	public function get_company_jobs_liked_by_user_profile_id($user_profile_id)
	{
		$this->db->select('COUNT(lj.job_profile_id) as total_likes,jp.job_ref_no');
		$this->db->from('liked_job lj');
		$this->db->join('job_profile jp','jp.job_profile_id=lj.job_profile_id');
		$this->db->join('company_profile cp','cp.company_profile_id=jp.company_profile_id');
		$this->db->join('user_profile up','up.user_profile_id=cp.user_profile_id');
		$this->db->where('up.user_profile_id',$user_profile_id);
		$this->db->group_by('lj.job_profile_id');
		$this->db->order_by('total_likes','DESC');
		// print_r($this->db->get_compiled_select());exit;
		$query = $this->db->get();
		return $this->db_results_fn($query);
	}

	public function get_job_appearance_by_user_profile_id($user_profile_id)
	{
		$this->db->select('jp.job_ref_no,jp.appearance_count');
		$this->db->from('job_profile jp');
		$this->db->join('company_profile cp','cp.company_profile_id=jp.company_profile_id');
		$this->db->join('user_profile up','up.user_profile_id=cp.user_profile_id');
		$this->db->where('up.user_profile_id',$user_profile_id);
		$this->db->group_by('jp.job_profile_id');
		$this->db->order_by('jp.appearance_count','DESC');
		// print_r($this->db->get_compiled_select());exit;
		$query = $this->db->get();
		return $this->db_results_fn($query);
	}

	public function get_questions_completed_count_by_job_profile_id_and_type($job_profile_id=0,$question_type)
	{
		$this->db->select('jpqa.candidate_profile_id');
		$this->db->from('job_profile_question_answer jpqa');
		$this->db->join('job_profile_question jpq','jpq.job_profile_question_id = jpqa.job_profile_question_id');
		$this->db->join('candidate_job_application_status cjas','jpqa.candidate_profile_id = cjas.candidate_profile_id');
		$this->db->where('jpq.job_profile_id', $job_profile_id);
		$this->db->where('jpq.type',$question_type);
		$this->db->group_by('jpqa.candidate_profile_id');
		$query = $this->db->get();
		return $query->num_rows();	
		//print_r($this->db->count_all_results());exit;
	}
	public function get_rejected_interview_request_count_by_job_profile_id($job_profile_id=0)
	{
		$this->db->select('is.candidate_profile_id');
		$this->db->from('interview_schedule is');
		$this->db->where('is.job_profile_id',$job_profile_id);
		$this->db->where('is.status','0');

		$query = $this->db->get();
		return $query->num_rows();	
		//print_r($this->db->count_all_results());exit;
	}
	public function get_test_selection_completed_count_by_job_profile_id_and_type($job_profile_id=0,$type)
	{
		$this->db->select('tsr.candidate_profile_id');
		$this->db->from('test_selection_result tsr');
		$this->db->join('candidate_job_application_status cjas','tsr.candidate_profile_id = cjas.candidate_profile_id');
		$this->db->where('tsr.job_profile_id', $job_profile_id);
		$this->db->where('tsr.type',$type);
		$this->db->group_by('tsr.candidate_profile_id');
		$query = $this->db->get();
		return $query->num_rows();	
		//print_r($this->db->count_all_results());exit;
	}

	public function get_structured_interview_completed_count_by_job_profile_id($job_profile_id=0)
	{
		$this->db->select('jpqa.candidate_profile_id');
		$this->db->from('job_profile_question_answer jpqa');
		$this->db->join('job_profile_question jpq','jpq.job_profile_question_id = jpqa.job_profile_question_id');
		$this->db->join('candidate_job_application_status cjas','jpqa.candidate_profile_id = cjas.candidate_profile_id');
		$this->db->where('jpq.job_profile_id', $job_profile_id);
		$this->db->where('jpq.type','structured_interview');
		$this->db->group_by('jpqa.candidate_profile_id');
		$query = $this->db->get();
		return $query->num_rows();	
		//print_r($this->db->count_all_results());exit;
	}

	public function get_name_by_user_profile_id_and_type($user_profile_id,$user_type)
	{
		if($user_type == 'candidate')
		{
			$this->db->select('(cp.first_name) as name');
			$this->db->from('candidate_profile cp');
		}
		else
		{
			$this->db->select('cp.name');
			$this->db->from('company_profile cp');
		}
		$this->db->join('user_profile up', 'up.user_profile_id = cp.user_profile_id');
		$this->db->where('up.user_profile_id',$user_profile_id);

		// print_r($this->db->get_compiled_select());exit;
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			$result = $query->result();
			return $result[0]->name;
		}
		else
			return '';
	}

	public function get_contact_us_requests()
	{
		$this->db->select('ce.*,c.*');
		$this->db->from('contact_email ce');
		$this->db->where('ce.is_deleted',0);
		$this->db->join('country c', 'c.country_id = ce.country_id', 'left');
		$this->db->order_by('ce.contact_email_id', 'DESC');
		$query = $this->db->get();
		return $this->db_results_fn($query);

	}
	public function activate_company_profile_by_user_profile_id($user_profile_id)
	{
		$this->db->query("UPDATE user_profile SET is_active=1 WHERE user_profile_id={$user_profile_id}");
	}

	public function get_polls($order_by_id=false)
	{
		$this->db->select('p.*');
		$this->db->from('poll p');
		$this->db->order_by('is_published', 'DESC');
		if($order_by_id)
			$this->db->order_by('date_created ', 'DESC');
		$query = $this->db->get();
		return $this->db_results_fn($query);
	}

	public function get_running_poll()
	{
		$this->db->select('*');
		$this->db->from('poll');
		$this->db->where('is_published',1);
		// $this->db->where('end_date >=NOW()');
		$query = $this->db->get();
		return $this->db_results_fn($query,true);
	}

	public function is_poll_answered($poll_id,$user_profile_id=-1)
	{
		$this->db->select('pc.*');
		$this->db->from('poll_choice pc');
		$this->db->join('poll_option po', 'po.poll_option_id = pc.poll_option_id');
		$this->db->where('po.poll_id', $poll_id);
		if($user_profile_id != -1)
			$this->db->where('pc.user_profile_id', $user_profile_id);
		// print_r($this->db->get_compiled_select());exit;
		$query = $this->db->get();
		return $query->num_rows();

	}

	public function unverified_candidates()
	{
		$this->db->select('cp.*,l.email,l.method,l.last_reminded,up.registered_date');
		$this->db->from('candidate_profile cp');
		$this->db->join('user_profile up', 'up.user_profile_id = cp.user_profile_id');
		$this->db->join('login l', 'l.login_id = up.login_id');
		// $this->db->where('up.is_active',0);
		$this->db->where("l.registration_code !=''");
		$query = $this->db->get();
		return $this->db_results_fn($query);
	}

	public function update_reminder_date_by_email($email)
	{
		$this->db->query("UPDATE login SET last_reminded=NOW() WHERE email='{$email}'");
	}

	public function set_forgot_password_code($code,$email)
	{
		if(isset($email))
		{
			$this->db->update('login',array('reset_password_code'=>$code),array('email'=>$email));
		}
		return true;
	}
	
	public function change_password($login_data)
	{

		$this->db->update('login',$login_data,array('login_id'=>$login_data['login_id']));
		return true;
	}

	public function insert_all_countries()
	{
		$countries = explode(',','Afghanistan,Akrotiri,Albania,Algeria,American Samoa,Andorra,Angola,Anguilla,Antarctica,Antigua and Barbuda,Argentina,Armenia,Aruba,Ashmore and Cartier Islands,Australia,Austria,Azerbaijan,The Bahamas,Bahrain,Bangladesh,Barbados,Belarus,Belgium,Belize,Benin,Bermuda,Bhutan,Bolivia,Bosnia and Herzegovina,Botswana,Bouvet Island,Brazil,,British Virgin Islands,Brunei,Bulgaria,Burkina Faso,Burma,Burundi,Cabo Verde,Cambodia,Cameroon,Canada,Cayman Islands,,Chad,Chile,China,Christmas Island,Clipperton Island,Cocos (Keeling) Islands,Colombia,Comoros,DRC,Congo,Cook Islands,Coral Sea Islands,Costa Rica,Cote dIvoire,Croatia,Cuba,,Cyprus,Czech Republic,Denmark,Dhekelia,Djibouti,Dominica,The Dominican,Ecuador,Egypt,El Salvador,Equatorial Guinea,Eritrea,Estonia,Ethiopia,Falkland Islands,Faroe Islands,Fiji,Finland,France,French Polynesia,French Southern and Antarctic Lands,Gabon,The Gambia,Gaza Strip,Georgia,Germany,Ghana,Gibraltar,Greece,Greenland,Grenada,Guam,Guatemala,Guernsey,Guinea,Guinea-Bissau,Guyana,Haiti,Heard Island and McDonald Islands,Vatican City,Honduras,Hong Kong,Howland Island,Hungary,Iceland,India,Indonesia,Iran,Iraq,Ireland,Isle of Man,Israel,Italy,Jamaica,Jan Mayen,Japan,Jarvis Island,Jersey,Johnston Atoll,Jordan,Kazakhstan,Kenya,Kingman Reef,Kiribati,North Korea,South Korea,Kosovo,Kuwait,Kyrgyzstan,Laos,Latvia,Lebanon,Lesotho,Liberia,Libya,Liechtenstein,Lithuania,Luxembourg,Macau,Macedonia,Madagascar,Malawi,Malaysia,Maldives,Mali,Malta,Marshall Islands,Mauritania,Mauritius,Mexico,,Midway Islands,Moldova,Monaco,Mongolia,Montenegro,Montserrat,Morocco,Mozambique,Namibia,Nauru,Navassa Island,Nepal,Netherlands,New Caledonia,New Zealand,Nicaragua,Niger,Nigeria,Niue,Norfolk Island,Northern Mariana Islands,Norway,Oman,Pakistan,Palau,Palmyra Atoll,Panama,Papua New Guinea,Paracel Islands,Paraguay,Peru,Philippines,Pitcairn Islands,Poland,Portugal,Puerto Rico,Qatar,Romania,Russia,Rwanda,Saint Barthelemy,,Saint Kitts and Nevis,Saint Lucia,Saint Martin,Saint Pierre and Miquelon,Saint Vincent and the Grenadines,Samoa,San Marino,Sao Tome and Principe,Saudi Arabia,Senegal,Serbia,Seychelles,Sierra Leone,Singapore,,Slovakia,Slovenia,Solomon Islands,Somalia,South Africa,South Georgia and South Sandwich Islands,South Sudan,Spain,Spratly Islands,Sri Lanka,Sudan,Suriname,Svalbard,Swaziland,Sweden,Switzerland,Syria,Taiwan,Tajikistan,Tanzania,Thailand,Timor-Leste,Togo,Tokelau,Tonga,Trinidad and Tobago,Tunisia,Turkey,Turkmenistan,Turks and Caicos Islands,Tuvalu,Uganda,Ukraine,,United Kingdom,United States,Baker Island,Uruguay,Uzbekistan,Vanuatu,Venezuela,Vietnam,Virgin Islands,Wake Island,Wallis and Futuna,West Bank,Western Sahara,Yemen,Zambia,Zimbabwe');
		foreach ($countries as $key => $country) {
			$this->insert_data(array('country' => $country),'country_id','country');
		}

	}

	public function get_candidate_messages_by_sent_by($job_profile_id)
	{
		$this->db->select('cp.first_name, cp.last_name, cm.*');
		$this->db->from('candidate_message cm');
		$this->db->join('candidate_profile cp','cp.candidate_profile_id = cm.candidate_profile_id');
		$this->db->where('cm.sent_by',$job_profile_id);
		$this->db->order_by('cm.sent_on', 'DESC');
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
                    return $query->result_array();
		}
		else
                    return array();
	}

    public function get_all_advertisements()
    {
        $this->db->select('*');
        $this->db->from('advertisement');
        $query = $this->db->get();
        return $this->db_results_fn($query);
    }

    public function get_dashboard_advertisements()
    {
        $this->db->select('*');
        $this->db->from('advertisement');
        $this->db->where('is_dashboard_space',true);
        $query = $this->db->get();
        return $this->db_results_fn($query);
    }

    public function get_profile_advertisements()
    {
        $this->db->select('*');
        $this->db->from('advertisement');
        $this->db->where('is_dashboard_space',false);
        $query = $this->db->get();
        return $this->db_results_fn($query);
	}
	
	public function get_service_packages()
	{
		$this->db->select('*');
		$this->db->from('employer_service');
		$query = $this->db->get();
		return $this->db_results_fn($query);
	}

	public function get_company_serivce_package($company_id)
	{
		$this->db->select('service_id');
		$this->db->from('company_profile cp');
		$this->db->where('user_profile_id',$company_id);
		$query = $this->db->get();
		return $this->db_results_fn($query,true);
	}

	public function update_company_serivce_package($company_id,$service_id)
	{
		$this->db->set('service_id',$service_id,false);
		$this->db->where('user_profile_id',$company_id);
		$this->db->update('company_profile');
	}

	public function get_candidates_register_count_for_months()
	{
	// 	$sql = "SELECT
	// 	YEAR(`registered_date`),
	// 	MONTH(`registered_date`) AS registered_month,
	// 	COUNT(*) AS no_of_candidates
	// FROM
	// 	`user_profile` u, `candidate_profile` c
	// WHERE
	// 	YEAR(`registered_date`) = YEAR(CURDATE()) AND u.`user_profile_id` = c.`user_profile_id`
	// GROUP BY
	// 	YEAR(`registered_date`),
	// 	MONTH(`registered_date`)";

		$sql = "SELECT
		YEAR(`registered_date`) AS registered_year,
		MONTH(`registered_date`) AS registered_month,
		registered_date,
		COUNT(*) AS no_of_candidates
		FROM
		`user_profile` u,
		`candidate_profile` c
		WHERE
		YEAR(`registered_date`) = YEAR(CURDATE()) AND u.`user_profile_id` = c.`user_profile_id`
		GROUP BY
		YEAR(`registered_date`),
		MONTH(`registered_date`)
		UNION ALL
		SELECT
		YEAR(`registered_date`) AS registered_year,
		MONTH(`registered_date`) AS registered_month,
		registered_date,
		COUNT(*) AS no_of_candidates
		FROM
		`user_profile` u,
		`candidate_profile` c
		WHERE
		(
			registered_date BETWEEN DATE_SUB(
				CONCAT(YEAR(CURDATE()),
				'-',
				'01',
				'-',
				'01'),
				INTERVAL 6 MONTH) AND CONCAT(YEAR(CURDATE()),
				'-',
				'01',
				'-',
				'01')) AND u.`user_profile_id` = c.`user_profile_id`
			GROUP BY
				YEAR(`registered_date`),
				MONTH(`registered_date`)";

		$query = $this->db->query($sql);
		// $query = $this->db->query($sql, array(array(3, 6), 'live', 'Rick'));
		return $this->db_results_fn($query);
	}

	public function get_job_profiles_for_admin($status = true)
	{
		$this->db->select('jp.job_profile_id,jp.job_ref_no,jp.position,jp.close_date,d.department');
		$this->db->from('job_profile jp');
	//	$this->db->join('company_profile cp','jp.company_profile_id=cp.company_profile_id');
		// }
		// else
		// {
		// 	$this->db->join('candidate_job_application_status cjas','cjas.job_profile_id=jp.job_profile_id');
		// 	$this->db->join('candidate_profile cp','cp.candidate_profile_id=cjas.candidate_profile_id');
		// }
		$this->db->join('department d','d.department_id=jp.department_id','left');
	//	$this->db->join('country c','c.country_id=jp.country_id','left');
	//	$this->db->join('career_level cl','cl.career_level_id=jp.career_level_id','left');
		// if($user_profile_id != -1)
		// 	$this->db->where('cp.user_profile_id',$user_profile_id);
		// if($status === false || $status === true)
			$this->db->where('jp.is_active',$status);
	//	$this->db->order_by('jp.is_position_filled');
		$query = $this->db->get();
		return $this->db_results_fn($query);
	}

	public function getCurrentPoll($user_profile_id = 0)
	{
		$this->db->select('p.poll_id,p.name,po.poll_option_id,po.option,pc.poll_choice_id');
		$this->db->from('poll p');
		$this->db->join('poll_option po', 'p.poll_id = po.poll_id','left');
		$this->db->join('poll_choice pc', 'po.poll_option_id = pc.poll_option_id and pc.user_profile_id ='.$user_profile_id ,'left');
		$this->db->where('is_published',1);
		$query = $this->db->get();
		return $this->db_results_fn($query);

	}

	public function get_candidates_register_count_for_days()
	{
		$sql = "SELECT
		YEAR(`registered_date`),
		MONTH(`registered_date`) AS registered_month,
		DAYOFMONTH(`registered_date`) AS registered_day,
		COUNT(*) AS no_of_candidates
	FROM
		`user_profile` u, `candidate_profile` c
	WHERE
		YEAR(`registered_date`) = YEAR(CURDATE()) AND MONTH(`registered_date`) = MONTH(CURDATE()) AND u.`user_profile_id` = c.`user_profile_id`
	GROUP BY
		YEAR(`registered_date`),
		MONTH(`registered_date`),
		DAYOFMONTH(`registered_date`)";
		$query = $this->db->query($sql);
		// $query = $this->db->query($sql, array(array(3, 6), 'live', 'Rick'));
		return $this->db_results_fn($query);
	}

	public function get_candidates_count_with_age()
	{
		$this->db->select('COUNT(cp.candidate_profile_id) as candidate_count, TIMESTAMPDIFF(YEAR,date_of_birth,CURDATE()) AS age');
		$this->db->from('candidate_profile cp');
		$this->db->where('cp.date_of_birth !=','0000-00-00');
		$this->db->group_by('age');
		$this->db->order_by('candidate_count', 'DESC');
		$query = $this->db->get();
		return $this->db_results_fn($query);
	}

	public function get_candidates_count_of_industries()
	{
// 		SELECT i.industry_id,i.industry, COUNT(*) as count
// FROM `candidate_profile` cp, industry i
// WHERE FIND_IN_SET(i.industry_id, cp.`industry_ids`) > 0
// GROUP BY i.industry_id


		$sql = "SELECT
		ind.industry_id,ind.industry,subtable.candidate_count
	FROM
		industry ind
	LEFT JOIN(
		SELECT
			i.industry_id AS ids,
			i.industry,
			COUNT(*) AS candidate_count
		FROM
			`candidate_profile` cp,
			industry i
		WHERE
			FIND_IN_SET(i.industry_id, cp.`industry_ids`) > 0
		GROUP BY
			i.industry_id
	) AS subtable
	ON
		ind.industry_id = subtable.ids";

		$query = $this->db->query($sql);	
		return $this->db_results_fn($query);
	}

	public function get_candidate_messages_by_candidate_id($email)
	{
		$this->db->select('cm.*');
		$this->db->from('candidate_message cm');
		$this->db->join('candidate_profile cp','cp.candidate_profile_id = cm.candidate_profile_id');
		$this->db->join('user_profile up','up.user_profile_id = cp.user_profile_id');
		$this->db->join('login l', 'l.login_id = up.login_id');
		// $this->db->where('cm.candidate_profile_id',$candidate_profile_id);
		$this->db->where('l.email', $email);
		$this->db->order_by('cm.sent_on', 'DESC');
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
                    return $query->result_array();
		}
		else
                    return array();
	}

	public function get_candidate_sent_messages_by_candidate_id($email)
	{
		$this->db->select('csm.*');
		$this->db->from('candidate_sent_message csm');
		$this->db->join('candidate_message cm','cm.candidate_message_id = csm.candidate_message_id');
		$this->db->join('candidate_profile cp','cp.candidate_profile_id = cm.candidate_profile_id');
		$this->db->join('user_profile up','up.user_profile_id = cp.user_profile_id');
		$this->db->join('login l', 'l.login_id = up.login_id');
		// $this->db->where('cm.candidate_profile_id',$candidate_profile_id);
		$this->db->where('l.email', $email);
		$this->db->order_by('csm.sent_on', 'DESC');
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
                    return $query->result_array();
		}
		else
                    return array();
	}

	public function get_received_message_list($email)
	{
		$this->db->select('csm.*');
		$this->db->from('candidate_sent_message csm');
		$this->db->join('candidate_message cm','cm.candidate_message_id = csm.candidate_message_id');
		// $this->db->join('candidate_profile cp','cp.candidate_profile_id = cm.candidate_profile_id');
		$this->db->join('user_profile up','up.user_profile_id = cm.sent_by');
		$this->db->join('login l', 'l.login_id = up.login_id');
		// $this->db->where('cm.candidate_profile_id',$candidate_profile_id);
		$this->db->where('l.email', $email);
		$this->db->order_by('csm.sent_on', 'DESC');
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
                    return $query->result_array();
		}
		else
                    return array();
	}
	
	public function get_loggedin_id_email_from_email($email)
	{
		$this->db->select('l.login_id,l.email');
	    $this->db->from('login l');
		$this->db->where('l.email', $email);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			$result = $query->result();
			return $result[0];
		}
		else
			return 0;
	}

	public function get_loggedin_id_password_from_email($email)
	{
		$this->db->select('l.login_id,l.password');
	    $this->db->from('login l');
		$this->db->where('l.email', $email);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			$result = $query->result();
			return $result[0];
		}
		else
			return 0;
	}

	public function change_login_email($login_data)
	{
		return $this->db->update('login',$login_data,array('login_id'=>$login_data['login_id']));
		//return true;
	}

	public function change_login_password($login_data)
	{
		return $this->db->update('login',$login_data,array('login_id'=>$login_data['login_id']));
		//return true;
	}

	public function get_user_profile_id_by_candidate_id($candidate_id)
	{
		$this->db->select('up.user_profile_id');
	    $this->db->from('user_profile up');
	    $this->db->join('candidate_profile cp', 'cp.user_profile_id = up.user_profile_id');
		$this->db->where('cp.candidate_profile_id', $candidate_id);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			$result = $query->result();
			return $result[0]->user_profile_id;
		}
		else
			return 0;
	}
}

?>