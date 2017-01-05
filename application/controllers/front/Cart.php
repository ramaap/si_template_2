<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class cart extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Model template 
        $this->load->model('data_cart');
        $this->load->model('data_profile');
        // Place your model here...
    }

    public function index() {
        $this->lib->check_session_customer();
        $this->lib->check_lokasi("Keranjang Belanja");        
        $data['error'] = '';
        $data['status'] = '';
        $this->load->view('front/cart_view', $data);
    }

    public function show() {
        $this->lib->check_session_customer();
        redirect('front/cart');
    }

    public function cart_show_by_id() { //kirim data buat form edit	
        $this->lib->check_session_customer();
        $cart = $this->data_cart->get_by_id($_POST['datamodel']); //data_model = primary key
        $array = array();
        $index = 0;
        foreach ($cart as $tmp) {

            $temp['index'] = $index;
            $temp['datamodel'] = $tmp->cart_id;
            $temp['cart_nama'] = $tmp->cart_nama;
            $temp['user_id'] = $tmp->user_id;
            $temp['cart_keterangan'] = $tmp->cart_keterangan;
            $temp['is_delete'] = $tmp->is_delete;
            $temp['is_permanent'] = $tmp->is_permanent;
            array_push($array, $temp);
            $index++;
        }
        echo json_encode($array);
    }

    public function cart_show() {
        $this->lib->check_session_customer();
        $index = 0;
        $cart = $this->data_cart->get_all($this->session->userdata('user_customer_id'));
        $array = array();
        foreach ($cart as $tmp) {

            $temp['index'] = $index;
            $temp['datamodel'] = $tmp->cart_id;
            $temp['cart_nama'] = $tmp->cart_nama;
            $temp['user_nama'] = $tmp->user_nama;
            $temp['cart_keterangan'] = $tmp->cart_keterangan;
            $temp['is_delete'] = $tmp->is_delete;
            $temp['is_permanent'] = $tmp->is_permanent;
            array_push($array, $temp);
            $index++;
        }
        echo json_encode($array);
    }

    public function get_array($cart_nama = "", $cart_keterangan = "") {
        $dataData = array(
            'cart_nama' => urldecode($cart_nama),
            'cart_keterangan' => urldecode($cart_keterangan),
            'last_update' => date("y-m-d h:i:s"),
            'last_user_id' => $this->session->userdata("user_id")
        );
        return $dataData;
    }
    public function edit() {
        $this->lib->check_session_customer();
        $this->form_validation->set_rules('cart_nama', 'Nama kategori', 'required|max_length[30]|is_unique_edit_custom[cart.cart_nama.cart_id.' . $_POST['datamodel'] . ']');
        $error = '';
        if (isset($_POST['ubah'])) {
            if ($this->form_validation->run() == FALSE) {
                $data['ubah'] = 'ubah';
                $data['error'] = 'error';
                $this->load->view('front/cart_view', $data);
            } else {
                $data['permanent'] = $this->lib->cek_permanent("cart", "cart_id", $_POST['datamodel']);
                if ($data['permanent']->num_rows() == 1) {
                    $this->session->set_userdata("error", "Data Tidak Dapat Diedit");
                    redirect('data/cart/');
                } else {
                    $dataData = $this->get_array($_POST['cart_nama'], $_POST['cart_keterangan']);
                    $temp = $this->data_cart->update($_POST['datamodel'], $dataData);

                    if ($temp == '1') {
                        $this->session->set_userdata("error", "Edit Berhasil");
                        redirect('data/cart/');
                    } else {
                        $data['ubah'] = 'ubah';
                        $data['error'] = 'error';
                        $this->load->view('front/cart_view', $data);
                    }
                }
            }
        }
    }

    public function delete_permanent($cart_id) {
        $this->lib->check_session_customer();
        $temp = $this->data_cart->delete_permanent($cart_id);
        echo $temp;
    }

    public function delete() {
        $this->lib->check_session_customer();
        $cart_id = $_POST["datamodel"];
        $temp = "0";
        $this->data_cart->delete_permanent($cart_id);
        $temp = '1'; 
        echo $temp;
    }   
	
	
}
