<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class sign_up extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Model template 
        $this->load->model('data_role');
        $this->load->model('data_user_customer');
        $this->load->model('data_customer');
        $this->load->model('data_profile');

        // Place your model here...
    }
	
 	public function index() {
		$this->lib->check_lokasi("Sign Up");     
        $this->load->view('front/pages/sign_up');
    } 
	public function add(){
		// $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password1', 'Password', 'required');
        $this->form_validation->set_rules('password2', 'Ulang Password', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('front/pages/sign_up');
        } else {
			$pass_1 = $_POST['password1'];
			$pass_2 = $_POST['password2'];
            if ($pass_1 == $pass_2) {   
				$dataData = array(
					'user_name' => urldecode($_POST['customer_email']),
					'user_password' => urldecode(md5($_POST['password2'])),
					'role_id' => '2',
					'last_update' => date("y-m-d h:i:s")
				);
				$this->data_user_customer->insert($dataData); 
				
				$customerCustomer = array(
					'user_id' => $this->session->userdata('last_id'),
					'customer_nama' => urldecode($_POST['customer_nama']),
					'customer_email' => urldecode($_POST['customer_email']),
					'customer_telp' => urldecode($_POST['customer_telp']),
					'customer_alamat' => urldecode($_POST['customer_alamat']),
					'customer_provinsi' => urldecode($_POST['customer_provinsi']),
					'customer_kota' => urldecode($_POST['customer_kota']),
					'customer_kecamatan' => urldecode($_POST['customer_kecamatan']),
					'customer_kode_pos' => urldecode($_POST['customer_kode_pos']),
					'last_update' => date("y-m-d h:i:s")
				);
				$this->data_customer->insert($customerCustomer);
				
                echo '<script>alert("Sign-Up Sukses, Silahkan melakukan Login")</script>';  		
					 redirect('front/login_customer');
            } else {
                echo '<script>alert("Konfirmasi Password gagal,silahkan cek kembali inputan")</script>';
                $this->load->view('front/pages/sign_up');
            }
        }
	}

}
