<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class checkout_pembayaran extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Model template
        $this->load->model('data_profile');
        $this->load->model('data_cart');

        // Place your model here...
    }

	public function index() {
        $this->lib->check_session_customer();
        $this->lib->check_lokasi("Checkout");  
		$data['cart'] = $this->db->query("select * from data_cart u
								  join jenis_kertas x on x.id_kertas = u.jenis_kertas
								  where u.is_delete=0 
								  and u.user_id = ".$this->session->userdata('user_customer_id')."
								  ")->result();
		$data['total'] = $this->db->query("select sum(harga_total) as total from data_cart u
								  where u.is_delete=0 
								  and u.user_id = ".$this->session->userdata('user_customer_id')."
								  ")->row();
        $this->load->view('front/pages/checkout/checkout_pembayaran',$data);
    }
    public function delete_permanent() {
        $this->lib->check_session_customer();
        $temp=$this->data_cart->delete_permanent($_POST["datamodel"]);
        echo $temp;
    }
}
