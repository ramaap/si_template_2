<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class role extends CI_Controller {

    public function __construct() {
        parent::__construct(); 
        $this->load->model('data_role');
        $this->load->model('data_profile'); 
    }

    public function index() {
		$data['akses']='dm_role';
        $this->session->set_userdata("akses_id", $data['akses']);
        $this->lib->check_session();
        $this->lib->check_lokasi("Data Role");      
        $data['error'] = '';
        $data['status'] = '';
        $this->lib->log("Lihat");
        $this->load->view('data/role_view', $data);
    }

    public function show() {
        $this->lib->check_session();
        redirect('data/role/');
    }

    public function role_show_by_id() { //kirim data buat form edit	
        $this->lib->check_session();
        $role = $this->data_role->get_by_id($_POST['datamodel']); //data_model = primary key
        $array = array();
        $index = 0;
        foreach ($role as $tmp) {

            $temp['index'] = $index;
            $temp['datamodel'] = $tmp->role_id;
            $temp['role_nama'] = $tmp->role_nama;
            $temp['role_keterangan'] = $tmp->role_keterangan;
            $temp['is_delete'] = $tmp->is_delete;
            $temp['is_permanent'] = $tmp->is_permanent;
            array_push($array, $temp);
            $index++;
        }
        echo json_encode($array);
    }

    public function role_show() {
        $this->lib->check_session();
        $index = 0;
        $role = $this->data_role->get_all();
        $array = array();
        foreach ($role as $tmp) {

            $temp['index'] = $index;
            $temp['datamodel'] = $tmp->role_id;
            $temp['role_nama'] = $tmp->role_nama;
            $temp['role_keterangan'] = $tmp->role_keterangan;
            $temp['is_delete'] = $tmp->is_delete;
            $temp['is_permanent'] = $tmp->is_permanent;
            array_push($array, $temp);
            $index++;
        }
        echo json_encode($array);
    }

    public function get_array($role_nama = "", $role_keterangan = "") {
        $this->lib->check_session();
        $dataData = array(
            'role_nama' => urldecode($role_nama),
            'role_keterangan' => urldecode($role_keterangan),
            'last_update' => date("y-m-d h:i:s"),
            'last_user_id' => $this->session->userdata("user_id")
        );
        return $dataData;
    }

    public function add() {
        $this->lib->check_session();
        $temp = '0';
        $dataData = $this->get_array($_POST['role_nama'], $_POST['role_keterangan']);
        if (isset($_POST['datamodel']))
            $role_id = $_POST['datamodel'];
        $this->form_validation->set_rules('role_nama', 'Nama Role', 'required|max_length[30]|is_unique[data_role.role_nama]');
        $error = '';
        if (isset($_POST['simpan'])) {
            if ($this->form_validation->run() == FALSE) {
                $data['tambah'] = 'tambah';
                $data['error'] = 'error';
                $this->load->view('data/role_view', $data);
            } else {
                $this->lib->log("Tambah");
                $temp = $this->data_role->insert($dataData);
                if ($temp == '1') {
                    $this->session->set_userdata("error", "Simpan Berhasil");
                    redirect('data/role/');
                } else
                    echo "insert Gagal";
            }
        }
    }

    public function edit() {
        $this->lib->check_session();
        $this->form_validation->set_rules('role_nama', 'Nama Role', 'required|max_length[30]|is_unique_edit_custom[data_role.role_nama.role_id.' . $_POST['datamodel'] . ']');
        $error = '';
        if (isset($_POST['ubah'])) {
            if ($this->form_validation->run() == FALSE) {
                $data['ubah'] = 'ubah';
                $data['error'] = 'error';
                $this->load->view('data/role_view', $data);
            } else {
                //$data['permanent']=$this->data_role->cek_permanent($_POST['datamodel']);
                $data['permanent'] = $this->lib->cek_permanent("data_role", "role_id", $_POST['datamodel']);
                if ($data['permanent']->num_rows() == 1) {
                    $this->session->set_userdata("error", "Data Tidak Dapat Diedit");
                    redirect('data/role/');
                } else {
                    $dataData = $this->get_array($_POST['role_nama'], $_POST['role_keterangan']);
                    $temp = $this->data_role->update($_POST['datamodel'], $dataData);
                    $this->lib->log("Ubah");

                    if ($temp == '1') {
                        $this->session->set_userdata("error", "Edit Berhasil");
                        redirect('data/role/');
                    } else {
                        $data['ubah'] = 'ubah';
                        $data['error'] = 'error';
                        $this->load->view('data/role_view', $data);
                    }
                }
            }
        }
    } 
	
    public function delete() {
        $this->lib->check_session();
        $role_id = $_POST["datamodel"];
        $temp = "0";
        $data['permanent'] = $this->lib->cek_permanent("data_role", "role_id", $_POST['datamodel']);
        if ($data['permanent']->num_rows() == 1) {
            $temp = "2";
        } else {
            $this->lib->log("Hapus");
            $this->data_role->delete_semu($role_id);
            $temp = '1'; 
        }
        echo $temp;
    }
 
//    public function index() {
//        $this->lib->check_session();
//        Place your code here...
//    }
}
