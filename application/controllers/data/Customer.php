<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class customer extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Model template 
        $this->load->model('data_customer');
        $this->load->model('data_profile');
		$this->load->library('upload');
        // Place your model here...
    }

    public function index() {
		// $data['akses']='dm_customer';
        // $this->session->set_userdata("akses_id", $data['akses']);
        $this->lib->check_session();
        $this->lib->check_lokasi("Data Customer");        
        $data['error'] = '';
        $data['status'] = '';
        $this->lib->log("Lihat");
        $this->load->view('data/customer_view', $data);
    }

    public function show() {
        $this->lib->check_session();
        redirect('data/customer');
    }

    public function customer_show_by_id() { //kirim data buat form edit	
        $this->lib->check_session();
        $customer = $this->data_customer->get_by_id($_POST['datamodel']); //data_model = primary key
        $array = array();
        $index = 0;
        foreach ($customer as $tmp) {

            $temp['index'] = $index;
            $temp['datamodel'] = $tmp->customer_id;
            $temp['customer_nama'] = $tmp->customer_nama;
            $temp['customer_email'] = $tmp->customer_email;
            $temp['customer_telp'] = $tmp->customer_telp;
            $temp['customer_alamat'] = $tmp->customer_alamat;
            $temp['customer_provinsi'] = $tmp->customer_provinsi;
            $temp['customer_kecamatan'] = $tmp->customer_kecamatan;
            $temp['customer_kota'] = $tmp->customer_kota;
            $temp['customer_kode_pos'] = $tmp->customer_kode_pos;
            $temp['is_delete'] = $tmp->is_delete;
            $temp['is_permanent'] = $tmp->is_permanent;
            array_push($array, $temp);
            $index++;
        }
        echo json_encode($array);
    }

    public function customer_show() {
        $this->lib->check_session();
        $index = 0;
        $customer = $this->data_customer->get_all();
        $array = array();
        foreach ($customer as $tmp) {

            $temp['index'] = $index;
            $temp['datamodel'] = $tmp->customer_id;
            $temp['customer_nama'] = $tmp->customer_nama;
            $temp['username'] = $tmp->user_name;
            $temp['customer_email'] = $tmp->customer_email;
            $temp['customer_telp'] = $tmp->customer_telp;
            $temp['customer_alamat'] = $tmp->customer_alamat;
            $temp['customer_provinsi'] = $tmp->customer_provinsi;
            $temp['customer_kecamatan'] = $tmp->customer_kecamatan;
            $temp['customer_kota'] = $tmp->customer_kota;
            $temp['customer_kode_pos'] = $tmp->customer_kode_pos;
            $temp['is_delete'] = $tmp->is_delete;
            $temp['is_permanent'] = $tmp->is_permanent;
            array_push($array, $temp);
            $index++;
        }
        echo json_encode($array);
    }
    public function delete_permanent($customer_id) {
        $this->lib->check_session();
        $temp = $this->data_customer->delete_permanent($customer_id);
        echo $temp;
    }

    public function delete() {
        $this->lib->check_session();
        $customer_id = $_POST["datamodel"];
        $temp = "0";
        $data['permanent'] = $this->lib->cek_permanent("data_customer", "customer_id", $_POST['datamodel']);
        if ($data['permanent']->num_rows() == 1) {
            $temp = "2";
        } else {
            $this->lib->log("Hapus");
            $this->data_customer->delete_semu($customer_id);
            $temp = '1'; 
        }
        echo $temp;
    }   
	
	
}
