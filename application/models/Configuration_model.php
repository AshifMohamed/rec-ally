<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuration_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function get_all_records($table_name,$order_by_column='',$order_by='ASC',$status=false)
	{
		if(!empty($order_by_column))
			$this->db->order_by($order_by_column,$order_by);
		$query = $this->db->get($table_name);
		return $this->db_results_fn($query);
	}
	public function get_all_records_filter_by_type($table_name,$column=false,$value=false,$is_one_row=false)
	{
		if($column !== false && $value !== false)
			$this->db->where($column,$value);
		$query = $this->db->get($table_name);
		return $this->db_results_fn($query,$is_one_row);
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

	public function get_value_by_id($table_name,$required_column,$db_column,$value)
	{
		$this->db->select($required_column);
		$this->db->from($table_name);
		$this->db->where($db_column,$value);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			$result = $query->result_array();
			return $result[0][$required_column];
		}
		else
			return '';

	}
	public function get_column_by_conditions($table_name,$required_column,$conditions)
	{
		$this->db->select($required_column);
		$query = $this->db->get_where($table_name,$conditions);
		if($query->num_rows() > 0)
		{
			$result = $query->result_array();
			return $result[0][$required_column];
		}
		else
			return '';

	}

	private function db_results_fn($query,$is_one_row = false)
	{
		$result = $query->result();
		if($query->num_rows() > 0)
		{
			if($is_one_row)
				return $result[0];
			return $result;
		}

		return array();
	}	
}

/* End of file configurations.php */
/* Location: ./application/models/configurations.php */