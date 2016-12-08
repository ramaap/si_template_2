<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class akses_password extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Model template 
        $this->load->model('setting_akses_password');
        $this->load->model('data_profile');
        // Place your model here...
    }

    public function index() {
        $data['akses']='dm_akses_password';
        $this->session->set_userdata("akses_id", $data['akses']);
		$this->lib->check_session();
	$this->lib->check_lokasi("Setting Akses Password");     
        $data['error'] = '';
        $data['status'] = '';
        // $this->session->set_userdata("error","");
        $this->load->view('data/akses_password_view', $data);
    }

    public function show() {
        $this->lib->check_session();
        redirect('data/akses_password/');
    }

    public function akses_password_show_by_id() { //kirim data buat form edit
        $this->lib->check_session();
        $akses = $this->setting_akses_password->get_by_id($_POST['datamodel']); //data_model = primary key
        $array = array();
        $index = 0;
        foreach ($akses as $tmp) {
            $temp['index'] = $index;
            $temp['datamodel'] = $tmp->akses_password_id;
            $temp['akses_password_menu'] = $tmp->akses_password_menu;
            $temp['akses_password_fungsi'] = $tmp->akses_password_fungsi;
            $temp['role_id'] = $tmp->role_id;
            $temp['role_nama'] = $tmp->role_nama;
            $temp['is_delete'] = $tmp->is_delete;
            array_push($array, $temp);
            $index++;
        }
        echo json_encode($array);
    }

    public function akses_password_show() {
        $this->lib->check_session();
        $index = 0;
        $akses = $this->setting_akses_password->get_all();
        $array = array();
        foreach ($akses as $tmp) {

            $temp['index'] = $index;
            $temp['datamodel'] = $tmp->akses_password_id;
            $temp['akses_password_menu'] = $tmp->akses_password_menu;
            $temp['akses_password_fungsi'] = $tmp->akses_password_fungsi;
            $temp['role_id'] = $tmp->role_id;
            $temp['role_nama'] = $tmp->role_nama;
            $temp['is_delete'] = $tmp->is_delete;
            array_push($array, $temp);
            $index++;
        }


        echo json_encode($array);
    }

    public function get_array($akses_password_menu = "",$akses_password_fungsi="", $role_id = "") {
        $this->lib->check_session();
        $dataData = array(
            'akses_password_menu' => urldecode($akses_password_menu),
            'akses_password_fungsi' => urldecode($akses_password_fungsi),
            'role_id' => urldecode($role_id),
            'last_update' => date("y-m-d h:i:s"),
            'last_user_id' => $this->session->userdata("user_id"),
        );
        return $dataData;
    }

    public function add() {
        $this->lib->check_session();
        $temp = '0';
        $this->form_validation->set_rules('akses_password_menu', 'Menu', 'required|max_length[40]|is_unique[setting_akses_password.akses_password_menu]');
        $this->form_validation->set_rules('akses_password_fungsi', 'Fungsionalitas', 'required|max_length[40]|is_unique[setting_akses_password.akses_password_fungsi]');
        $this->form_validation->set_rules('role_id', 'Role', 'required|check_selected');
        $error = '';
        if (isset($_POST['simpan'])) {
            if ($this->form_validation->run() == FALSE) {
                $data['tambah'] = 'tambah';
                $data['error'] = 'error';
                $this->load->view('data/akses_password_view', $data);
            } else {
                $dataData = $this->get_array($_POST['akses_password_menu'], $_POST['role_id']);

                $temp = $this->setting_akses_password->insert($dataData);
                if ($temp == '1') {
                    $this->session->set_userdata("error", "Simpan Berhasil");
                    redirect('data/akses_password/');
                } else
                    echo "insert Gagal";
            }
        }
    }

    public function edit() {
        $this->lib->check_session();
        $this->form_validation->set_rules('akses_password_menu', 'Menu', 'required|max_length[40]|is_unique_edit[setting_akses_password.akses_password_menu.' . $_POST['datamodel'] . ']');
        $this->form_validation->set_rules('role_id', 'Role', 'required|check_selected');
        $error = '';
        if (isset($_POST['ubah'])) {
            if ($this->form_validation->run() == FALSE) {
                $data['ubah'] = 'ubah';
                $data['error'] = 'error';
                $this->load->view('data/akses_password_view', $data);
            } else {
                $data['permanent'] = $this->lib->cek_permanent("setting_akses_password", "akses_password_id", $_POST['datamodel']);
                if ($data['permanent']->num_rows() == 1) {
                    $this->session->set_userdata("error", "Data Tidak Dapat Diedit");
                    redirect('data/akses_password/');
                } else {
                    $dataData = $this->get_array($_POST['akses_password_menu'],$_POST['akses_password_fungsi'], $_POST['role_id']);

                    $temp = $this->setting_akses_password->update($_POST['datamodel'], $dataData);

                    if ($temp == '1') {
                        $this->session->set_userdata("error", "Edit Berhasil");
                        redirect('data/akses_password/');
                    } else {
                        $data['ubah'] = 'ubah';
                        $data['error'] = 'error';
                        $this->load->view('data/akses_password_view', $data);
                    }
                }
            }
        }
    }

    public function delete_permanent() {
        $this->lib->check_session();
        $akses_password_id = $_POST["datamodel"];
        $temp = $this->setting_akses_password->delete_permanent($akses_password_id);
        echo $temp;
    }

    public function delete() {
        $this->lib->check_session();
        $akses_password_id = $_POST["datamodel"];
        $data['permanent'] = $this->lib->cek_permanent("setting_akses_password", "akses_password_id", $_POST['datamodel']);
        if ($data['permanent']->num_rows() == 1) {
            $temp = "2";
        } else {
            $this->lib->log("Hapus");
            $this->setting_akses_password->delete_semu($akses_password_id);
            $temp = "1";
        }
        echo $temp;
    }

    public function user_delete_semu($akses_password_id) {
        $this->lib->check_session();
        $dataData = array(
            'is_delete' => '1',
        );
        $this->script_sql->update($dataData, "setting_akses_password", "akses_password_id", $akses_password_id);
        echo $akses_password_id;
    }

}
