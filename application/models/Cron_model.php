<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
        parent::__construct();

    }


    public function is_user_exist($login_data, $is_active = null)
    {
        $query = $this->db->get_where('login', $login_data);
        return $query->num_rows();
    }

    public function insert_login($login_data)
    {
        if ($login_data['login_id'] == 0) {
            $this->db->insert('login', $login_data);
            return $this->db->insert_id();
        } else
            $this->db->update('login', $login_data, array('login_id' => $login_data['login_id']));
    }
}
