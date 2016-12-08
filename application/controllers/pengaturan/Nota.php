<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class nota extends CI_Controller {

    public function __construct() {
        parent::__construct(); 
        $this->load->model('data_profile');
    }

    public function index() {
        $data['akses'] = 'pg_printer';
        $this->session->set_userdata("akses_id", $data['akses']);
        $this->lib->check_session();
        $this->lib->check_lokasi($data['akses'], "Pengaturan Nota");
		$sql=$this->db->query("select * from setting_nota limit 1")->row();
        $data['sql'] = $sql;
        $data['error'] = '';
        $data['status'] = '';
        $this->lib->log("Lihat");
        $this->load->view('pengaturan/nota_view', $data);
    }

    public function show() {
        $this->lib->check_session();
        redirect('pengaturan/nota/');
    }
 
    public function get_array() {
        $this->lib->check_session();
        $dataData = array(
            'nota_header' => urldecode($_POST["nota_header"]),
            'nota_catatan' => urldecode($_POST["nota_catatan"]),
            'nota_footer' => urldecode($_POST["nota_footer"]), 
            'last_update' => date("y-m-d h:i:s"),
            'last_user_id' => $this->session->userdata("user_id")
        );
        return $dataData;
    }

    public function add() {
        $this->lib->check_session();
        $temp = '0';
        $dataData = $this->get_array();
        if (isset($_POST['datamodel']))
            $nota_id = $_POST['datamodel'];
        $this->form_validation->set_rules('nota_header', 'Nama Role', 'required|max_length[30]|is_unique[data_nota.nota_header]');
        $error = '';
        if (isset($_POST['simpan'])) {
            if ($this->form_validation->run() == FALSE) {
                $data['tambah'] = 'tambah';
                $data['error'] = 'error';
                $this->load->view('data/nota_view', $data);
            } else {
                $this->lib->log("Tambah");
                $temp = $this->data_nota->insert($dataData);
                if ($temp == '1') {
                    $this->session->set_userdata("error", "Simpan Berhasil");
                    redirect('data/nota/');
                } else
                    echo "insert Gagal";
            }
        }
    }

    public function edit() {
        $this->lib->check_session();
        $error = '';
		$temp=0; 
		$dataData = $this->get_array(); 
		$this->db->where('nota_id', $_POST['datamodel']);
		$temp=$this->db->update('setting_nota', $dataData); 
		$this->lib->log("Ubah");

			echo $temp;
    }

    public function delete() {
        $this->lib->check_session();
        $nota_id = $_POST["datamodel"];
        $temp = "0";
        $data['permanent'] = $this->lib->cek_permanent("data_nota", "nota_id", $_POST['datamodel']);
        if ($data['permanent']->num_rows() == 1) {
            $temp = "2";
        } else {
            $this->lib->log("Hapus");
            // $this->data_nota->delete_semu($nota_id);
            $temp = '1';
        }
        echo $temp;
    }

//    public function index() {
//        $this->lib->check_session();
//        Place your code here...
//    }
}
