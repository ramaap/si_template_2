<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class catalog extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Model template
        $this->load->model('data_profile');

        // Place your model here...
    }

	public function index() {
        // $this->lib->check_session_customer();
        $this->lib->check_lokasi("Order");     
        $this->load->view('front/pages/catalog_print');
    }
}
