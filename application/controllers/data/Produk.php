<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class produk extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Model template 
        $this->load->model('data_produk');
        $this->load->model('data_profile');
		$this->load->library('upload');
        // Place your model here...
    }

    public function index() {
		// $data['akses']='dm_produk';
        // $this->session->set_userdata("akses_id", $data['akses']);
        $this->lib->check_session();
        $this->lib->check_lokasi("Data Produk");        
        $data['error'] = '';
        $data['status'] = '';
        $this->lib->log("Lihat");
        $this->load->view('data/produk_view', $data);
    }

    public function show() {
        $this->lib->check_session();
        redirect('data/produk');
    }

    public function produk_show_by_id() { //kirim data buat form edit	
        $this->lib->check_session();
        $produk = $this->data_produk->get_by_id($_POST['datamodel']); //data_model = primary key
        $array = array();
        $index = 0;
        foreach ($produk as $tmp) {

            $temp['index'] = $index;
            $temp['datamodel'] = $tmp->produk_id;
            // $temp['kategori_produk_nama'] = $tmp->kategori_produk_nama;
            $temp['kategori_produk_id'] = $tmp->kategori_produk_id;
            $temp['produk_nama'] = $tmp->produk_nama;
            $temp['produk_biaya'] = $tmp->produk_biaya;
			$temp['produk_gambar'] = base_url().'/include/produk/'.$tmp->produk_gambar;
            $temp['produk_keterangan'] = $tmp->produk_keterangan;
            $temp['is_delete'] = $tmp->is_delete;
            $temp['is_permanent'] = $tmp->is_permanent;
            array_push($array, $temp);
            $index++;
        }
        echo json_encode($array);
    }

    public function produk_show() {
        $this->lib->check_session();
        $index = 0;
        $produk = $this->data_produk->get_all();
        $array = array();
        foreach ($produk as $tmp) {

            $temp['index'] = $index;
            $temp['datamodel'] = $tmp->produk_id;
            $temp['kategori_produk_nama'] = $tmp->kategori_produk_nama;
            $temp['produk_nama'] = $tmp->produk_nama;
            $temp['produk_biaya'] = $tmp->produk_biaya;
			$temp['produk_gambar'] = "xxx";
			if (file_exists('./include/produk/'.$tmp->produk_gambar)&&$tmp->produk_gambar!="") {
				$temp['produk_gambar'] = $tmp->produk_gambar;
			}
            $temp['produk_keterangan'] = $tmp->produk_keterangan;
            $temp['is_delete'] = $tmp->is_delete;
            $temp['is_permanent'] = $tmp->is_permanent;
            array_push($array, $temp);
            $index++;
        }
        echo json_encode($array);
    }

    public function get_array($produk_nama = "", $kategori_produk_id = "", $produk_biaya = "", $produk_gambar = "", $produk_keterangan = "") {
        $this->lib->check_session();
        $dataData = array(
            'produk_nama' => urldecode($produk_nama),
            'kategori_produk_id' => urldecode($kategori_produk_id),
            'produk_biaya' => urldecode($produk_biaya),
            'produk_gambar' => urldecode($produk_gambar),
            'produk_keterangan' => urldecode($produk_keterangan),
            'last_update' => date("y-m-d h:i:s"),
            'last_user_id' => $this->session->userdata("user_id")
        );
        return $dataData;
    }
    public function get_array_non_foto($produk_nama = "", $kategori_produk_id = "", $produk_biaya = "", $produk_keterangan = "") {
        $this->lib->check_session();
        $dataData = array(
            'produk_nama' => urldecode($produk_nama),
            'kategori_produk_id' => urldecode($kategori_produk_id),
            'produk_biaya' => urldecode($produk_biaya),
            'produk_keterangan' => urldecode($produk_keterangan),
            'last_update' => date("y-m-d h:i:s"),
            'last_user_id' => $this->session->userdata("user_id")
        );
        return $dataData;
    }
	public function get_array_edit($produk_gambar="") {
        $this->lib->check_session();
		if($produk_gambar!="")//kalau ubah gambar-
		{
			$dataData = array(
				'produk_nama' => urldecode($_POST["produk_nama"]),
				'kategori_produk_id' => urldecode($_POST["kategori_produk_id"]),
				'produk_biaya' => urldecode($_POST["produk_biaya"]),
				'produk_keterangan' => urldecode($_POST["produk_keterangan"]),
				'produk_gambar' => urldecode($produk_gambar),
				'last_update' => date("y-m-d h:i:s"),
				'last_user_id' => $this->session->userdata("user_id")
			);
		}
		else
		{
			$dataData = array(
				'produk_nama' => urldecode($_POST["produk_nama"]),
				'kategori_produk_id' => urldecode($_POST["kategori_produk_id"]),
				'produk_biaya' => urldecode($_POST["produk_biaya"]),
				'produk_keterangan' => urldecode($_POST["produk_keterangan"]), 
				'last_update' => date("y-m-d h:i:s"),
				'last_user_id' => $this->session->userdata("user_id")
			);
		}
		return $dataData;
    }
	

    public function add() {
        $this->lib->check_session();
        $temp = '0';
        $this->form_validation->set_rules('produk_nama', 'Nama Produk', 'required|max_length[100]');
        $this->form_validation->set_rules('kategori_produk_id', 'Nama kategori', 'check_selected');
        $error = '';
			if (isset($_POST['simpan'])) {
            if ($this->form_validation->run() == FALSE) {
                $data['tambah'] = 'tambah';
                $data['error'] = 'error';
                $this->load->view('data/produk_view', $data);
            } else {
				
				if (empty($_FILES['userfile']['name']))
					{
						$dataData = $this->get_array_non_foto($_POST["produk_nama"],$_POST["kategori_produk_id"],$_POST["produk_biaya"],$_POST["produk_keterangan"]);
							$this->lib->log("Tambah");
							$temp = $this->data_produk->insert($dataData);
							if ($temp == '1') {
								$this->session->set_userdata("error", "Simpan Berhasil");
								redirect('data/produk/');
							} else
								echo "insert Gagal";
					}else
					{
						 $config['upload_path']    = dirname(BASEPATH).'/include/produk/';
						 $config['allowed_types']  = 'gif|jpg|png|jpeg';
						 // $config['max_size']       = '2000';
						 // $config['max_width']      = '2000';
						 // $config['max_height']     = '2000';
						 // $config['file_name']      = 'gambar-'.trim(str_replace(" ","",date('dmYHis')));
						 // $file_name     = 'gambar-'.trim(str_replace(" ","",date('dmYHis')));
						 
						 $this->load->library('upload');
						$this->upload->initialize($config);
						if (!$this->upload->do_upload("userfile")) {
							 echo "Error";
						}else{
							$datafoto=$this->upload->data();
							$nm_file = trim(str_replace(" ","",date('dmYHis'))).$datafoto['orig_name'];
							copy('include/produk/'.$datafoto['orig_name'], 'include/produk/'.$nm_file);
							
							$dataData = $this->get_array($_POST["produk_nama"],$_POST["kategori_produk_id"],$_POST["produk_biaya"],$nm_file,$_POST["produk_keterangan"]);
							$this->lib->log("Tambah");
							$temp = $this->data_produk->insert($dataData);
							if ($temp == '1') {
								$this->session->set_userdata("error", "Simpan Berhasil");
								redirect('data/produk/');
							} else
								echo "insert Gagal";
						}
				
					}
			}
		}
	}

    public function edit() {
        $this->lib->check_session();
        $this->form_validation->set_rules('produk_nama', 'Nama Produk', 'required|max_length[100]');
        $this->form_validation->set_rules('kategori_produk_id', 'Nama kategori', 'check_selected');
        $error = '';
        if (isset($_POST['ubah'])) {
            if ($this->form_validation->run() == FALSE) {
                $data['ubah'] = 'ubah';
                $data['error'] = 'error';
                $this->load->view('data/produk_view', $data);
            } else {
                // $data['permanent'] = $this->lib->cek_permanent("data_produk", "produk_id", $_POST['datamodel']);
                // if ($data['permanent']->num_rows() == 1) {
                    // $this->session->set_userdata("error", "Data Tidak Dapat Diedit");
                    // redirect('data/produk/');
                // } else {
					
					
					$true = true;
					if (!empty($_FILES['userfile']['name']))
					{
						 $config['upload_path']    = dirname(BASEPATH).'/include/produk/';
						 $config['allowed_types']  = 'gif|jpg|png|jpeg';
						 // $config['max_size']       = '2000';
						 // $config['max_width']      = '2000';
						 // $config['max_height']     = '2000';
						 // $config['file_name']      = 'gambar-'.trim(str_replace(" ","",date('dmYHis')));
						 // $file_name     = 'gambar-'.trim(str_replace(" ","",date('dmYHis')));
						 
						$this->load->library('upload');
						$this->upload->initialize($config);
						if (!$this->upload->do_upload("userfile")) {
							 //echo "Error";
							 $true = false;
						}else{
							$datafoto=$this->upload->data();
							$nm_file = trim(str_replace(" ","",date('dmYHis'))).$datafoto['orig_name'];
							copy('include/produk/'.$datafoto['orig_name'], 'include/produk/'.$nm_file);
							}
					}
					else
						$true = false;
						
						$dataData = $this->get_array_edit();
						
					if ($true){  
							$this->delete_images('./include/produk',$_POST['datamodel']); //gak semua hosting support document_root
							// $this->delete_images($_SERVER['DOCUMENT_ROOT'].'/sisarifood/include/foto_pegawai',$_POST['datamodel']);
							$dataData = $this->get_array_edit($nm_file);								
						}								
						$temp = $this->data_produk->update($_POST['datamodel'], $dataData);
						$this->lib->log("Ubah");

						if ($temp == '1') {
                        $this->session->set_userdata("error", "Edit Berhasil");
                        redirect('data/produk/');
						} else {
							$data['ubah'] = 'ubah';
							$data['error'] = 'error';
							$this->load->view('data/produk_view', $data);
						}
                // }
            }
        }
    }
	function delete_images($paths,$produk_id)
	{ 
		$data_produk = $this->db->query('SELECT * FROM data_produk
					where produk_id='.$produk_id.'')->row();
		if($data_produk->pegawai_foto!="")
		{
		 $path = $paths.'/'.$data_produk->produk_gambar;
				$files = glob($path . '*'); // get all file names
				foreach ($files as $file): { // iterate files
						if (is_file($file))
							unlink($file); // delete file
					}
				endforeach;
		}
		// echo $path;
		return "1";
	}

    public function delete_permanent($produk_id) {
        $this->lib->check_session();
        $temp = $this->data_produk->delete_permanent($produk_id);
        echo $temp;
    }

    public function delete() {
        $this->lib->check_session();
        $produk_id = $_POST["datamodel"];
        $temp = "0";
        $data['permanent'] = $this->lib->cek_permanent("data_produk", "produk_id", $_POST['datamodel']);
        if ($data['permanent']->num_rows() == 1) {
            $temp = "2";
        } else {
            $this->lib->log("Hapus");
            $this->data_produk->delete_semu($produk_id);
            $temp = '1'; 
        }
        echo $temp;
    }   
	
	
}
