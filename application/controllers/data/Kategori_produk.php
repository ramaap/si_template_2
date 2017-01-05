<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class kategori_produk extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Model template 
        $this->load->model('data_kategori_produk');
        $this->load->model('data_profile');
        // Place your model here...
    }

    public function index() {
		// $data['akses']='dm_kategori_produk';
        // $this->session->set_userdata("akses_id", $data['akses']);
        $this->lib->check_session();
        $this->lib->check_lokasi("Data Kategori Produk");        
        $data['error'] = '';
        $data['status'] = '';
        $this->lib->log("Lihat");
        $this->load->view('data/kategori_produk_view', $data);
    }

    public function show() {
        $this->lib->check_session();
        redirect('data/kategori_produk');
    }

    public function kategori_produk_show_by_id() { //kirim data buat form edit	
        $this->lib->check_session();
        $kategori_produk = $this->data_kategori_produk->get_by_id($_POST['datamodel']); //data_model = primary key
        $array = array();
        $index = 0;
        foreach ($kategori_produk as $tmp) {

            $temp['index'] = $index;
            $temp['datamodel'] = $tmp->kategori_produk_id;
            $temp['kategori_produk_nama'] = $tmp->kategori_produk_nama;
            $temp['kategori_produk_keterangan'] = $tmp->kategori_produk_keterangan;
            $temp['is_delete'] = $tmp->is_delete;
            $temp['is_permanent'] = $tmp->is_permanent;
            array_push($array, $temp);
            $index++;
        }
        echo json_encode($array);
    }

    public function kategori_produk_show() {
        $this->lib->check_session();
        $index = 0;
        $kategori_produk = $this->data_kategori_produk->get_all();
        $array = array();
        foreach ($kategori_produk as $tmp) {

            $temp['index'] = $index;
            $temp['datamodel'] = $tmp->kategori_produk_id;
            $temp['kategori_produk_nama'] = $tmp->kategori_produk_nama;
            $temp['kategori_produk_keterangan'] = $tmp->kategori_produk_keterangan;
            $temp['is_delete'] = $tmp->is_delete;
            $temp['is_permanent'] = $tmp->is_permanent;
            array_push($array, $temp);
            $index++;
        }
        echo json_encode($array);
    }

    public function get_array($kategori_produk_nama = "", $kategori_produk_keterangan = "") {
        $this->lib->check_session();
        $dataData = array(
            'kategori_produk_nama' => urldecode($kategori_produk_nama),
            'kategori_produk_keterangan' => urldecode($kategori_produk_keterangan),
            'last_update' => date("y-m-d h:i:s"),
            'last_user_id' => $this->session->userdata("user_id")
        );
        return $dataData;
    }

    public function add() {
        $this->lib->check_session();
        $temp = '0';
        $dataData = $this->get_array($_POST['kategori_produk_nama'], $_POST['kategori_produk_keterangan']); 
        $this->form_validation->set_rules('kategori_produk_nama', 'Nama kategori', 'required|max_length[30]|is_unique_custom[kategori_produk.kategori_produk_nama]');
        $error = '';
        if (isset($_POST['simpan'])) {
            if ($this->form_validation->run() == FALSE) {
                $data['tambah'] = 'tambah';
                $data['error'] = 'error';
                $this->load->view('data/kategori_produk_view', $data);
            } else {
                $this->lib->log("Tambah");
                $temp = $this->data_kategori_produk->insert($dataData);
                if ($temp == '1') {
                    $this->session->set_userdata("error", "Simpan Berhasil");
                    redirect('data/kategori_produk/');
                } else
                    echo "insert Gagal";
            }
        }
    }

    public function edit() {
        $this->lib->check_session();
        $this->form_validation->set_rules('kategori_produk_nama', 'Nama kategori', 'required|max_length[30]|is_unique_edit_custom[kategori_produk.kategori_produk_nama.kategori_produk_id.' . $_POST['datamodel'] . ']');
        $error = '';
        if (isset($_POST['ubah'])) {
            if ($this->form_validation->run() == FALSE) {
                $data['ubah'] = 'ubah';
                $data['error'] = 'error';
                $this->load->view('data/kategori_produk_view', $data);
            } else {
                $data['permanent'] = $this->lib->cek_permanent("kategori_produk", "kategori_produk_id", $_POST['datamodel']);
                if ($data['permanent']->num_rows() == 1) {
                    $this->session->set_userdata("error", "Data Tidak Dapat Diedit");
                    redirect('data/kategori_produk/');
                } else {
                    $dataData = $this->get_array($_POST['kategori_produk_nama'], $_POST['kategori_produk_keterangan']);
                    $temp = $this->data_kategori_produk->update($_POST['datamodel'], $dataData);
                    $this->lib->log("Ubah");

                    if ($temp == '1') {
                        $this->session->set_userdata("error", "Edit Berhasil");
                        redirect('data/kategori_produk/');
                    } else {
                        $data['ubah'] = 'ubah';
                        $data['error'] = 'error';
                        $this->load->view('data/kategori_produk_view', $data);
                    }
                }
            }
        }
    }

    public function delete_permanent($kategori_produk_id) {
        $this->lib->check_session();
        $temp = $this->data_kategori_produk->delete_permanent($kategori_produk_id);
        echo $temp;
    }

    public function delete() {
        $this->lib->check_session();
        $kategori_produk_id = $_POST["datamodel"];
        $temp = "0";
        $data['permanent'] = $this->lib->cek_permanent("kategori_produk", "kategori_produk_id", $_POST['datamodel']);
        if ($data['permanent']->num_rows() == 1) {
            $temp = "2";
        } else {
            $this->lib->log("Hapus");
            $this->data_kategori_produk->delete_semu($kategori_produk_id);
            $temp = '1'; 
        }
        echo $temp;
    }   
	
	
}
