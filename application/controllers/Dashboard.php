<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Model template
        $this->load->model('data_role');
        $this->load->model('data_user');
        $this->load->model('setting_akses_menu');
        $this->load->model('setting_akses_password');
        $this->load->model('setting_profile');
        $this->load->model('log_manajemen');
        $this->load->model('data_profile');

        // Place your model here...
    }

	public function index() {
		$data['akses']='dm_role';
        $this->session->set_userdata("akses_id", $data['akses']);
        $this->lib->check_session();
        $this->lib->check_lokasi("Dashboard");     
        $data['error'] = '';
        $data['status'] = '';
        $this->lib->log("Lihat");
        // $this->load->view('dashboard', $data);
        $this->load->view('dashboard_tab', $data);
    }
}
