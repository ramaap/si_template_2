<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Model template 
        $this->load->model('data_user');
        $this->load->model('data_profile');
        // Place your model here...
    }

    public function index() {
 		$data['akses']='dm_user';
        $this->session->set_userdata("akses_id", $data['akses']);
        $this->session->set_userdata("akses_pass_id",'user');
		$this->lib->check_session();
        $this->lib->check_lokasi("Data User");         
        $data['error'] = '';
        $data['status'] = '';
        // $this->session->set_userdata("error","");
        $this->lib->log("Lihat");
        $this->load->view('data/user_view', $data);
    }

    public function show() {
        $this->lib->check_session();
        redirect('data/users/');
    }

    public function user_show_by_id() { //kirim data buat form edit
        $this->lib->check_session();
        $users = $this->data_user->get_by_id($_POST['datamodel']); //data_model = primary key
        $array = array();
        $index = 0;
        foreach ($users as $tmp) {
            $temp['index'] = $index;
            $temp['datamodel'] = $tmp->user_id;
            $temp['role_nama'] = $tmp->role_nama;
            $temp['role_id'] = $tmp->role_id;
            $temp['user_name'] = $tmp->user_name;
            $temp['user_password'] = $tmp->user_password;
            $temp['is_permanent'] = $tmp->is_permanent;
            $temp['is_delete'] = $tmp->is_delete;
            array_push($array, $temp);
            $index++;
        }
        echo json_encode($array);
    }

    public function user_show() {
        $this->lib->check_session();
        $index = 0;
        $users = $this->data_user->get_all();
        $array = array();
        foreach ($users as $tmp) {

            $temp['index'] = $index;
            $temp['datamodel'] = $tmp->user_id;
            $temp['role_nama'] = $tmp->role_nama;
            $temp['role_id'] = $tmp->role_id;
            $temp['user_name'] = $tmp->user_name;
            $temp['user_password'] = $tmp->user_password;
            $temp['is_permanent'] = $tmp->is_permanent;
            $temp['is_delete'] = $tmp->is_delete;
            array_push($array, $temp);
            $index++;
        }
        echo json_encode($array);
    }

    public function get_array($user_name = "", $user_password = "", $role_id = "") {
        $this->lib->check_session();
        $dataData = array(
            'user_name' => urldecode($user_name),
            'user_password' => urldecode(md5($user_password)),
            'role_id' => urldecode($role_id),
            'last_update' => date("y-m-d h:i:s"),
            'last_user_id' => $this->session->userdata("user_id")
        );
        return $dataData;
    }

    public function add() {
        $this->lib->check_session();
        $temp = '0';
        $dataData = $this->get_array($_POST['user_name'], $_POST['user_password'], $_POST['role_id']);
        if (isset($_POST['datamodel']))
            $user_id = $_POST['datamodel'];
        $this->form_validation->set_rules('user_name', 'Username', 'required|max_length[10]|is_unique_custom[data_user.user_name]');
        $this->form_validation->set_rules('user_password', 'Password', 'required|max_length[100]');
        $this->form_validation->set_rules('role_id', 'Role', 'check_selected');
        $error = '';
        if (isset($_POST['simpan'])) {
            if ($this->form_validation->run() == FALSE) {
                $data['tambah'] = 'tambah';
                $data['error'] = 'error';
                $this->load->view('data/user_view', $data);
            } else {
                $this->lib->log("Tambah");
                $temp = $this->data_user->insert($dataData);
                if ($temp == '1') {
                    $this->session->set_userdata("error", "Simpan Berhasil");
                    redirect('data/users/');
                } else
                    echo "Insert Gagal";
            }
        }
    }

    public function edit() {
        $this->lib->check_session();
        $this->form_validation->set_rules('user_name', 'Username', 'required|max_length[10]|is_unique_edit_custom[data_user.user_name.user_id.' . $_POST['datamodel'] . ']');
        $this->form_validation->set_rules('user_password', 'Password', 'required|max_length[100]');
        $this->form_validation->set_rules('role_id', 'Role', 'check_selected');
        $error = '';
        if (isset($_POST['ubah'])) {
            if ($this->form_validation->run() == FALSE) {
                $data['ubah'] = 'ubah';
                $data['error'] = 'error';
                $this->load->view('data/user_view', $data);
            } else {
                $data['permanent'] = $this->lib->cek_permanent("data_user", "user_id", $_POST['datamodel']);
                if ($data ['permanent']->num_rows() == 1) {
                    $this->session->set_userdata("error", "Data Tidak Dapat Diedit");
                    redirect('data/users/');
                } else {
                    $dataData = $this->get_array($_POST['user_name'], $_POST['user_password'], $_POST['role_id']);

                    $temp = $this->data_user->update($_POST['datamodel'], $dataData);
                    $this->lib->log("Edit");

                    if ($temp == '1') {
                        $this->session->set_userdata("error", "Edit Berhasil");
                        redirect('data/users/');
                    } else {
                        $data['ubah'] = 'ubah';
                        $data['error'] = 'error';
                        $this->load->view('data/user_view', $data);
                    }
                }
            }
        }
    }

    public function delete_permanent($user_id) {
        $this->lib->check_session();
        $temp = $this->data_user->delete_permanent($user_id);

        $this->lib->log("Hapus");
        echo $temp;
    }

    public function delete() {
        $this->lib->check_session();
        $pass=$this->lib->check_pass('user','delete',md5($_POST['input_pass']));
        $user_id = $_POST["datamodel"];
        $temp = "0";
        $data['permanent'] = $this->lib->cek_permanent("data_user", "user_id", $_POST['datamodel']);
        if ($data['permanent']->num_rows() == 1) {
            $temp = "2";
        } else {
			 if($pass){
				$this->lib->log("Hapus");
				$this->data_user->delete_semu($user_id);
				$temp = "1";
			}  
			// else
			// $temp=$pass.'='.md5($_POST['input_pass']);
        }
        echo $temp;
    }

    public function user_delete_semu($user_id) {
        $this->lib->check_session();
        $dataData = array('is_delete' => '1',
        );
        $this->script_sql->update($dataData, "data_user", "user_id", $user_id);
        echo $user_id;
    }

}
