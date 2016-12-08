<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Akses_menu extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Model template 
        $this->load->model('setting_akses_menu');
        $this->load->model('data_profile');
        // Place your model here...
    }

    public function index() {
        $data['akses'] = 'dm_akses_menu';
        $this->session->set_userdata("akses_id", $data['akses']);
        $this->lib->check_session();
        $this->lib->check_lokasi("Setting Akses Menu");

        $data['error'] = '';
        $data['status'] = '';
        // $this->session->set_userdata("error","");
        $this->load->view('data/akses_menu_view', $data);
    }

    public function show() {
        $this->lib->check_session();
        redirect('data/akses_menu/');
    }

    public function akses_menu_show_by_id() { //kirim data buat form edit
        $this->lib->check_session();
        $akses = $this->setting_akses_menu->get_by_id($_POST['datamodel']); //data_model = primary key
        $array = array();
        $index = 0;
        foreach ($akses as $tmp) {

            $temp['index'] = $index;
            $temp['datamodel'] = $tmp->am_id;
            $temp['dm_role'] = $tmp->dm_role;
            $temp['dm_role_aksi'] = $tmp->dm_role_aksi;
            $temp['dm_user'] = $tmp->dm_user;
            $temp['dm_user_aksi'] = $tmp->dm_user_aksi;
            $temp['dm_akses_menu'] = $tmp->dm_akses_menu;
            $temp['dm_akses_menu_aksi'] = $tmp->dm_akses_menu_aksi;
            $temp['dm_akses_password'] = $tmp->dm_akses_password;
            $temp['dm_akses_password_aksi'] = $tmp->dm_akses_password_aksi;
            $temp['pg_backup'] = $tmp->pg_backup;
            $temp['pg_backup_aksi'] = $tmp->pg_backup_aksi;
            $temp['pg_restore'] = $tmp->pg_restore;
            $temp['pg_restore_aksi'] = $tmp->pg_restore_aksi;
            $temp['pg_profile'] = $tmp->pg_profile;
            $temp['pg_profile_aksi'] = $tmp->pg_profile_aksi;
            $temp['pg_log'] = $tmp->pg_log;
            $temp['role_id'] = $tmp->role_id;
            $temp['role_nama'] = $tmp->role_nama;
            $temp['is_delete'] = $tmp->is_delete;
            array_push($array, $temp);
            $index++;
        }
        echo json_encode($array);
    }

    public function akses_menu_show() {
        $this->lib->check_session();
        $index = 0;
        $akses = $this->setting_akses_menu->get_all();
        $array = array();
        foreach ($akses as $tmp) {

            $temp['index'] = $index;
            $temp['datamodel'] = $tmp->am_id;
            $temp['role_id'] = $tmp->role_id;
            $temp['role_nama'] = $tmp->role_nama;
            $temp['is_delete'] = $tmp->is_delete;
            array_push($array, $temp);
            $index++;
        }


        echo json_encode($array);
    }

    public function get_array() {
        $this->lib->check_session();
        $role_mn_dm = (isset($_POST['role_mn_dm'])) ? 1 : 0;
        $role_tb_dm = (isset($_POST['role_tb_dm'])) ? 1 : 0;
        $role_ed_dm = (isset($_POST['role_ed_dm'])) ? 1 : 0;
        $role_del_dm = (isset($_POST['role_del_dm'])) ? 1 : 0;

        $user_mn_dm = (isset($_POST['user_mn_dm'])) ? 1 : 0;
        $user_tb_dm = (isset($_POST['user_tb_dm'])) ? 1 : 0;
        $user_ed_dm = (isset($_POST['user_ed_dm'])) ? 1 : 0;
        $user_del_dm = (isset($_POST['user_del_dm'])) ? 1 : 0;

		$akses_menu_mn_dm = (isset($_POST['akses_menu_mn_dm'])) ? 1 : 0;
        $akses_menu_tb_dm = (isset($_POST['akses_menu_tb_dm'])) ? 1 : 0;
        $akses_menu_ed_dm = (isset($_POST['akses_menu_ed_dm'])) ? 1 : 0;
        $akses_menu_del_dm = (isset($_POST['akses_menu_del_dm'])) ? 1 : 0;
		
		$akses_password_mn_dm = (isset($_POST['akses_password_mn_dm'])) ? 1 : 0;
        $akses_password_tb_dm = (isset($_POST['akses_password_tb_dm'])) ? 1 : 0;
        $akses_password_ed_dm = (isset($_POST['akses_password_ed_dm'])) ? 1 : 0;
        $akses_password_del_dm = (isset($_POST['akses_password_del_dm'])) ? 1 : 0;

      
		//ELSE
        $restoredatabase_mn_dm = (isset($_POST['restoredatabase_mn_dm'])) ? 1 : 0;

        $backupdatabase_mn_dm = (isset($_POST['backupdatabase_mn_dm'])) ? 1 : 0;

        $profile_mn_dm = (isset($_POST['profile_mn_dm'])) ? 1 : 0;

        $pg_log = (isset($_POST['lqoxg_mn_dm'])) ? 1 : 0;


        $dm_role = $role_mn_dm;
        $dm_role_aksi = $role_tb_dm . "~" . $role_ed_dm . "~" . $role_del_dm;
        $dm_user = $user_mn_dm;
        $dm_user_aksi = $user_tb_dm . "~" . $user_ed_dm . "~" . $user_del_dm;
      
		$dm_akses_menu = $akses_menu_mn_dm;
        $dm_akses_menu_aksi = $akses_menu_tb_dm . "~" . $akses_menu_ed_dm . "~" . $akses_menu_del_dm;
		$dm_akses_password = $akses_password_mn_dm;
        $dm_akses_password_aksi = $akses_password_tb_dm . "~" . $akses_password_ed_dm . "~" . $akses_password_del_dm;
		
		//==
        $dm_akses_menu = $akses_menu_mn_dm;
        $dm_akses_menu_aksi = $akses_menu_tb_dm . "~" . $akses_menu_ed_dm . "~" . $akses_menu_del_dm;
        $dm_akses_password = $akses_password_mn_dm;
        $dm_akses_password_aksi = $akses_password_tb_dm . "~" . $akses_password_ed_dm . "~" . $akses_password_del_dm;
        $pg_restore = $restoredatabase_mn_dm;
        $pg_backup = $backupdatabase_mn_dm;
        $pg_profile = $profile_mn_dm;
        $pg_log = $pg_log;

        $dataData = array(
            'role_id' => urldecode($_POST['role_id']),
            'dm_role' => urldecode($dm_role),
            'dm_role_aksi' => urldecode($dm_role_aksi),
            'dm_user' => urldecode($dm_user),
            'dm_user_aksi' => urldecode($dm_user_aksi),
           
            'dm_akses_menu' => urldecode($dm_akses_menu),
            'dm_akses_menu_aksi' => urldecode($dm_akses_menu_aksi),
            'dm_akses_password' => urldecode($dm_akses_password),
            'dm_akses_password_aksi' => urldecode($dm_akses_password_aksi),
            'pg_restore' => urldecode($pg_restore),
            'pg_backup' => urldecode($pg_backup),
            'pg_profile' => urldecode($pg_profile),
            'pg_log' => urldecode($pg_log),
            'last_update' => date("y-m-d h:i:s"),
            'last_user_id' => $this->session->userdata("user_id")
        );

        return $dataData;
    }

    public function add() {
        $this->lib->check_session();
        $temp = '0';
        $this->form_validation->set_rules('role_id', 'User Name', 'check_selected|max_length[30]|is_unique[setting_akses_menu.role_id]');
        $error = '';
        if (isset($_POST['simpan'])) {
            if ($this->form_validation->run() == FALSE) {
                $data['tambah'] = 'tambah';
                $data['error'] = 'error';
                $this->load->view('data/akses_menu', $data);
            } else {
                $dataData = $this->get_array();

                $temp = $this->setting_akses_menu->insert($dataData);
                if ($temp == '1') {
                    $this->session->set_userdata("error", "Simpan Berhasil");
                    redirect('data/akses_menu/');
                } else
                    echo "insert Gagal";
            }
        }
    }

    public function edit() {
        $this->lib->check_session();
        $this->form_validation->set_rules('role_id', 'Username', 'check_selected|is_unique_edit_custom[setting_akses_menu.role_id.am_id.' . $_POST['datamodel'] . ']');
        $error = '';
        if (isset($_POST['ubah'])) {
            if ($this->form_validation->run() == FALSE) {
                $data['ubah'] = 'ubah';
                $data['error'] = 'error';
                $this->load->view('data/akses_menu_view', $data);
            } else {
                $data['permanent'] = $this->lib->cek_permanent("setting_akses_menu", "am_id", $_POST['datamodel']);
                if ($data['permanent']->num_rows() == 1) {
                    $this->session->set_userdata("error", "Data Tidak Dapat Diedit");
                    redirect('data/akses_menu/');
                } else {
                    $dataData = $this->get_array();
                    $temp = $this->setting_akses_menu->update($_POST['datamodel'], $dataData);

                    if ($temp == '1') {
                        $this->session->set_userdata("error", "Edit Berhasil");
                        redirect('data/akses_menu/');
                    } else {
                        $data['ubah'] = 'ubah';
                        $data['error'] = 'error';
                        $this->load->view('data/akses_menu_view', $data);
                    }
                }
            }
        }
    }

    public function delete_permanent() {
        $this->lib->check_session();
        $role_id = $_POST["datamodel"];
        //$role = $this->setting_akses_menu->get_row_by_id($role_id); 
        $data['permanent'] = $this->lib->cek_permanent("setting_akses_menu", "am_id", $_POST['datamodel']);
        if ($data['permanent']->num_rows() == 1) {
            $temp = "2";
        } else {
            $this->lib->log("Hapus");
            $this->setting_akses_menu->delete_permanent($role_id);
            $temp = "1";
        }
        echo $temp;
    }

//    public function index() {
//        $this->lib->check_session();
//        Place your code here...
//    }
}
