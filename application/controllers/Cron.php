<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('input');
        $this->load->model('cron_model');
    }
//    public function __construct()
//    {
//        parent::__construct();
//        $this->load->model('account_model');
//        $this->load->model('configuration_model');
//    }

    public function index()
    {
        $data['jobs'] = $this->account_model->get_job_profiles(1,'DESC',3,0);
        $data['companies'] = $this->account_model->get_companies(1,'DESC',3,0);
        $data['industries'] = $this->configuration_model->get_all_records('industry');
        $data['countries'] = $this->configuration_model->get_all_records('country');

        $this->load->view('header');
        $this->load->view('index', $data);
        $this->load->view('footer');
    }

    /**
     * This function is used to update the age of users automatically
     * This function is called by cron job once in a day at midnight 00:00
     */
    public function updateAge()
    {
        // is_cli_request() is provided by default input library of codeigniter
        if($this->input->is_cli_request())
        {
            $this->cron_model->updateAge();
        }
        else
        {
            echo "You dont have access";
        }
    }
}
