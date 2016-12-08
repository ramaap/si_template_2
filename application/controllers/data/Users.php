<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Model template 
        $this->load->model('data_user');
        $this->load->model('setting_akses_menu');
        $this->load->model('data_role');
        $this->load->model('data_profile');
        // Place your model here...
    }

    public function index() {
 		$data['akses']='dm_user';
        $this->session->set_userdata("akses_id", $data['akses']);
        $this->session->set_userdata("akses_pass_id",'user');
        $this->lib->check_session();
        $this->lib->check_pass();
        $this->lib->check_lokasi("Data User");     
        $data['error'] = '';
        $data['status'] = '';
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
		if($user_password!="")
		{
			$dataData = array(
				'user_name' => urldecode($user_name),
				'user_password' => urldecode(md5($user_password)),
				'role_id' => urldecode($role_id),
				'last_update' => date("y-m-d h:i:s"),
				'last_user_id' => $this->session->userdata("user_id")
			);
		}
		else
		{
			$dataData = array(
				'user_name' => urldecode($user_name),
				// 'user_password' => urldecode(md5($user_password)),
				'role_id' => urldecode($role_id),
				'last_update' => date("y-m-d h:i:s"),
				'last_user_id' => $this->session->userdata("user_id")
			);
		}
        return $dataData;
    }

    public function add() {
        $this->lib->check_session();
        $temp = '0';
       
        if (isset($_POST['datamodel']))
            $user_id = $_POST['datamodel'];
        $this->form_validation->set_rules('user_name', 'Username', 'required|max_length[10]|is_unique_custom[data_user.user_name]');
        $this->form_validation->set_rules('user_password', 'Password', 'required|max_length[100]');
        $this->form_validation->set_rules('role_id', 'role', 'check_selected');
        $error = '';
        if (isset($_POST['simpan'])) {
            if ($this->form_validation->run() == FALSE) {
                $data['tambah'] = 'tambah';
                $data['error'] = 'error';
                $this->load->view('data/user_view', $data);
            } else {
                $this->lib->log("Tambah");
				if ($_POST["role_id"] == "xxxxx") {
                    $temp = $this->add_role($_POST["role_baru"]);
                    if ($temp == '1')
                        $_POST["role_id"] = $this->session->userdata("last_id");
                }
				 $dataData = $this->get_array($_POST['user_name'], $_POST['user_password'], $_POST['role_id']);
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
        $this->form_validation->set_rules('user_name', 'Username', 'required|max_length[10]|is_unique_edit_custom[data_user.user_name.' . $_POST['datamodel'] . ']');
        $this->form_validation->set_rules('user_password', 'Password', 'required|max_length[100]');
        $this->form_validation->set_rules('role_id', 'role', 'check_selected');
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
			else
			$temp="3";
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
	 public function add_role($role_nama = "") {
        $this->lib->check_session();
        $dataData = array(
            'role_nama' => urldecode($role_nama),
            'last_update' => date("y-m-d h:i:s"),
            'last_user_id' => $this->session->userdata("user_id")
        );

        $temp = $this->data_role->insert($dataData);
		$id = $this->session->userdata('last_id');
		// $dateDate = $this->get_array_akses($id);
		// $this->setting_akses_menu->insert($dateDate);
        
		return $temp;
    }
	/*  public function get_array_akses($id="") {
        $this->lib->check_session();
        $role_mn_dm = (isset($_POST['role_mn_dm'])) ? 1 : 0;
        $role_tb_dm = (isset($_POST['role_tb_dm'])) ? 1 : 0;
        $role_ed_dm = (isset($_POST['role_ed_dm'])) ? 1 : 0;
        $role_del_dm = (isset($_POST['role_del_dm'])) ? 1 : 0;

        $user_mn_dm = (isset($_POST['user_mn_dm'])) ? 1 : 0;
        $user_tb_dm = (isset($_POST['user_tb_dm'])) ? 1 : 0;
        $user_ed_dm = (isset($_POST['user_ed_dm'])) ? 1 : 0;
        $user_del_dm = (isset($_POST['user_del_dm'])) ? 1 : 0;

        $rekening_mn_dm = (isset($_POST['rekening_mn_dm'])) ? 1 : 0;
        $rekening_tb_dm = (isset($_POST['rekening_tb_dm'])) ? 1 : 0;
        $rekening_ed_dm = (isset($_POST['rekening_ed_dm'])) ? 1 : 0;
        $rekening_del_dm = (isset($_POST['rekening_del_dm'])) ? 1 : 0;
		
		 $kas_mn_dm = (isset($_POST['kas_mn_dm'])) ? 1 : 0;
        $kas_tb_dm = (isset($_POST['kas_tb_dm'])) ? 1 : 0;
        $kas_ed_dm = (isset($_POST['kas_ed_dm'])) ? 1 : 0;
        $kas_del_dm = (isset($_POST['kas_del_dm'])) ? 1 : 0;
		
		$pegawai_mn_dm = (isset($_POST['pegawai_mn_dm'])) ? 1 : 0;
        $pegawai_tb_dm = (isset($_POST['pegawai_tb_dm'])) ? 1 : 0;
        $pegawai_ed_dm = (isset($_POST['pegawai_ed_dm'])) ? 1 : 0;
        $pegawai_del_dm = (isset($_POST['pegawai_del_dm'])) ? 1 : 0;
		
		$pegawai_gaji_mn_dm = (isset($_POST['pegawai_gaji_mn_dm'])) ? 1 : 0;
        $pegawai_gaji_tb_dm = (isset($_POST['pegawai_gaji_tb_dm'])) ? 1 : 0;
        $pegawai_gaji_ed_dm = (isset($_POST['pegawai_gaji_ed_dm'])) ? 1 : 0;
        $pegawai_gaji_del_dm = (isset($_POST['pegawai_gaji_del_dm'])) ? 1 : 0;
		
		$absensi_mn_dm = (isset($_POST['absensi_mn_dm'])) ? 1 : 0;
        $absensi_tb_dm = (isset($_POST['absensi_tb_dm'])) ? 1 : 0;
        $absensi_ed_dm = (isset($_POST['absensi_ed_dm'])) ? 1 : 0;
        $absensi_del_dm = (isset($_POST['absensi_del_dm'])) ? 1 : 0;

		$akses_menu_mn_dm = (isset($_POST['akses_menu_mn_dm'])) ? 1 : 0;
        $akses_menu_tb_dm = (isset($_POST['akses_menu_tb_dm'])) ? 1 : 0;
        $akses_menu_ed_dm = (isset($_POST['akses_menu_ed_dm'])) ? 1 : 0;
        $akses_menu_del_dm = (isset($_POST['akses_menu_del_dm'])) ? 1 : 0;
		
		$akses_password_mn_dm = (isset($_POST['akses_password_mn_dm'])) ? 1 : 0;
        $akses_password_tb_dm = (isset($_POST['akses_password_tb_dm'])) ? 1 : 0;
        $akses_password_ed_dm = (isset($_POST['akses_password_ed_dm'])) ? 1 : 0;
        $akses_password_del_dm = (isset($_POST['akses_password_del_dm'])) ? 1 : 0;

        $divisi_mn_dm = (isset($_POST['divisi_mn_dm'])) ? 1 : 0;
        $divisi_tb_dm = (isset($_POST['divisi_tb_dm'])) ? 1 : 0;
        $divisi_ed_dm = (isset($_POST['divisi_ed_dm'])) ? 1 : 0;
        $divisi_del_dm = (isset($_POST['divisi_del_dm'])) ? 1 : 0;

        $supplier_kategori_mn_dm = (isset($_POST['kategorisupplier_mn_dm'])) ? 1 : 0;
        $supplier_kategori_tb_dm = (isset($_POST['kategorisupplier_tb_dm'])) ? 1 : 0;
        $supplier_kategori_ed_dm = (isset($_POST['kategorisupplier_ed_dm'])) ? 1 : 0;
        $supplier_kategori_del_dm = (isset($_POST['kategorisupplier_del_dm'])) ? 1 : 0;

        $supplier_mn_dm = (isset($_POST['supplier_mn_dm'])) ? 1 : 0;
        $supplier_tb_dm = (isset($_POST['supplier_tb_dm'])) ? 1 : 0;
        $supplier_ed_dm = (isset($_POST['supplier_ed_dm'])) ? 1 : 0;
        $supplier_del_dm = (isset($_POST['supplier_del_dm'])) ? 1 : 0;

        $pelanggan_kategori_mn_dm = (isset($_POST['kategoripelanggan_mn_dm'])) ? 1 : 0;
        $pelanggan_kategori_tb_dm = (isset($_POST['kategoripelanggan_tb_dm'])) ? 1 : 0;
        $pelanggan_kategori_ed_dm = (isset($_POST['kategoripelanggan_ed_dm'])) ? 1 : 0;
        $pelanggan_kategori_del_dm = (isset($_POST['kategoripelanggan_del_dm'])) ? 1 : 0;

        $pelanggan_mn_dm = (isset($_POST['pelanggan_mn_dm'])) ? 1 : 0;
        $pelanggan_tb_dm = (isset($_POST['pelanggan_tb_dm'])) ? 1 : 0;
        $pelanggan_ed_dm = (isset($_POST['pelanggan_ed_dm'])) ? 1 : 0;
        $pelanggan_del_dm = (isset($_POST['pelanggan_del_dm'])) ? 1 : 0;

		 $pajak_kategori_mn_dm = (isset($_POST['kategoripajak_mn_dm'])) ? 1 : 0;
        $pajak_kategori_tb_dm = (isset($_POST['kategoripajak_tb_dm'])) ? 1 : 0;
        $pajak_kategori_ed_dm = (isset($_POST['kategoripajak_ed_dm'])) ? 1 : 0;
        $pajak_kategori_del_dm = (isset($_POST['kategoripajak_del_dm'])) ? 1 : 0;

        $produk_kategori_mn_dm = (isset($_POST['kategoriproduk_mn_dm'])) ? 1 : 0;
        $produk_kategori_tb_dm = (isset($_POST['kategoriproduk_tb_dm'])) ? 1 : 0;
        $produk_kategori_ed_dm = (isset($_POST['kategoriproduk_ed_dm'])) ? 1 : 0;
        $produk_kategori_del_dm = (isset($_POST['kategoriproduk_del_dm'])) ? 1 : 0;

        $produk_mn_dm = (isset($_POST['produk_mn_dm'])) ? 1 : 0;
        $produk_tb_dm = (isset($_POST['produk_tb_dm'])) ? 1 : 0;
        $produk_ed_dm = (isset($_POST['produk_ed_dm'])) ? 1 : 0;
        $produk_del_dm = (isset($_POST['produk_del_dm'])) ? 1 : 0;
		
		  $akun_mn_dm = (isset($_POST['akun_mn_dm'])) ? 1 : 0;
        $akun_tb_dm = (isset($_POST['akun_tb_dm'])) ? 1 : 0;
        $akun_ed_dm = (isset($_POST['akun_ed_dm'])) ? 1 : 0;
        $akun_del_dm = (isset($_POST['akun_del_dm'])) ? 1 : 0;
		
		  $buku_besar_mn_dm = (isset($_POST['buku_besar_mn_dm'])) ? 1 : 0;
        $buku_besar_tb_dm = (isset($_POST['buku_besar_tb_dm'])) ? 1 : 0;
        $buku_besar_ed_dm = (isset($_POST['buku_besar_ed_dm'])) ? 1 : 0;
        $buku_besar_del_dm = (isset($_POST['buku_besar_del_dm'])) ? 1 : 0;

		 $jurnal_mn_dm = (isset($_POST['jurnal_mn_dm'])) ? 1 : 0;
        $jurnal_tb_dm = (isset($_POST['jurnal_tb_dm'])) ? 1 : 0;
        $jurnal_ed_dm = (isset($_POST['jurnal_ed_dm'])) ? 1 : 0;
        $jurnal_del_dm = (isset($_POST['jurnal_del_dm'])) ? 1 : 0;
		
		 $satuan_mn_dm = (isset($_POST['satuan_mn_dm'])) ? 1 : 0;
        $satuan_tb_dm = (isset($_POST['satuan_tb_dm'])) ? 1 : 0;
        $satuan_ed_dm = (isset($_POST['satuan_ed_dm'])) ? 1 : 0;
        $satuan_del_dm = (isset($_POST['satuan_del_dm'])) ? 1 : 0;
		
        $produk_harga_mn_dm = (isset($_POST['harga_mn_dm'])) ? 1 : 0;
        $produk_harga_tb_dm = (isset($_POST['harga_tb_dm'])) ? 1 : 0;
        $produk_harga_ed_dm = (isset($_POST['harga_ed_dm'])) ? 1 : 0;
        $produk_harga_del_dm = (isset($_POST['harga_del_dm'])) ? 1 : 0;

		 $cabang_mn_dm = (isset($_POST['cabang_mn_dm'])) ? 1 : 0;
        $cabang_tb_dm = (isset($_POST['cabang_tb_dm'])) ? 1 : 0;
        $cabang_ed_dm = (isset($_POST['cabang_ed_dm'])) ? 1 : 0;
        $cabang_del_dm = (isset($_POST['cabang_del_dm'])) ? 1 : 0;
		
		 $mobil_mn_dm = (isset($_POST['mobil_mn_dm'])) ? 1 : 0;
        $mobil_tb_dm = (isset($_POST['mobil_tb_dm'])) ? 1 : 0;
        $mobil_ed_dm = (isset($_POST['mobil_ed_dm'])) ? 1 : 0;
        $mobil_del_dm = (isset($_POST['mobil_del_dm'])) ? 1 : 0;
		
		 $coverage_mn_dm = (isset($_POST['coverage_mn_dm'])) ? 1 : 0;
        $coverage_tb_dm = (isset($_POST['coverage_tb_dm'])) ? 1 : 0;
        $coverage_ed_dm = (isset($_POST['coverage_ed_dm'])) ? 1 : 0;
        $coverage_del_dm = (isset($_POST['coverage_del_dm'])) ? 1 : 0;
	
     
        //stok
        $st_display = (isset($_POST['disstok_mn_stk'])) ? 1 : 0;
        $st_opname = (isset($_POST['opstok_mn_stk'])) ? 1 : 0;
        $st_verifikasi_opname = (isset($_POST['verstok_mn_stk'])) ? 1 : 0;
        $st_history = (isset($_POST['history_stok_mn_stk'])) ? 1 : 0;

        //KEUANGAN 

        $keu_cash_kecil_mn_keu = (isset($_POST['keuangancashkecil_mn_keu'])) ? 1 : 0;
        $keu_cash_kecil_tb_keu = (isset($_POST['keuangancashkecil_tb_keu'])) ? 1 : 0;
        $keu_cash_kecil_ed_keu = (isset($_POST['keuangancashkecil_ed_keu'])) ? 1 : 0;
        $keu_cash_kecil_del_keu = (isset($_POST['keuangancashkecil_del_keu'])) ? 1 : 0;
		
		 $keu_cash_besar_mn_keu = (isset($_POST['keuangancashbesar_mn_keu'])) ? 1 : 0;
        $keu_cash_besar_tb_keu = (isset($_POST['keuangancashbesar_tb_keu'])) ? 1 : 0;
        $keu_cash_besar_ed_keu = (isset($_POST['keuangancashbesar_ed_keu'])) ? 1 : 0;
        $keu_cash_besar_del_keu = (isset($_POST['keuangancashbesar_del_keu'])) ? 1 : 0;

        $keu_rekening_mn_keu = (isset($_POST['keuanganrekening_mn_keu'])) ? 1 : 0;
        $keu_rekening_tb_keu = (isset($_POST['keuanganrekening_tb_keu'])) ? 1 : 0;
        $keu_rekening_ed_keu = (isset($_POST['keuanganrekening_ed_keu'])) ? 1 : 0;
        $keu_rekening_del_keu = (isset($_POST['keuanganrekening_del_keu'])) ? 1 : 0;

        $keu_giro_mn_keu = (isset($_POST['giro_mn_keu'])) ? 1 : 0;
        $keu_giro_tb_keu = (isset($_POST['giro_tb_keu'])) ? 1 : 0;
        $keu_giro_ed_keu = (isset($_POST['giro_ed_keu'])) ? 1 : 0;
        $keu_giro_del_keu = (isset($_POST['giro_del_keu'])) ? 1 : 0;

		 $keu_hutang_mn_keu = (isset($_POST['hutang_mn_keu'])) ? 1 : 0;
        $keu_hutang_tb_keu = (isset($_POST['hutang_tb_keu'])) ? 1 : 0;
        $keu_hutang_ed_keu = (isset($_POST['hutang_ed_keu'])) ? 1 : 0;
        $keu_hutang_del_keu = (isset($_POST['hutang_del_keu'])) ? 1 : 0;
		
		$keu_piutang_mn_keu = (isset($_POST['piutang_mn_keu'])) ? 1 : 0;
        $keu_piutang_tb_keu = (isset($_POST['piutang_tb_keu'])) ? 1 : 0;
        $keu_piutang_ed_keu = (isset($_POST['piutang_ed_keu'])) ? 1 : 0;
        $keu_piutang_del_keu = (isset($_POST['piutang_del_keu'])) ? 1 : 0;

        $keuangan_mn_keu = (isset($_POST['keuangan_mn_keu'])) ? 1 : 0;
        $keuangan_tb_keu = (isset($_POST['keuangan_tb_keu'])) ? 1 : 0;
        $keuangan_ed_keu = (isset($_POST['keuangan_ed_keu'])) ? 1 : 0;
        $keuangan_del_keu = (isset($_POST['keuangan_del_keu'])) ? 1 : 0;

		 $keu_pelanggan_deposit_mn_keu = (isset($_POST['pelanggan_deposit_mn_keu'])) ? 1 : 0;
        $keu_pelanggan_deposit_tb_keu = (isset($_POST['pelanggan_deposit_tb_keu'])) ? 1 : 0;
        $keu_pelanggan_deposit_ed_keu = (isset($_POST['pelanggan_deposit_ed_keu'])) ? 1 : 0;
        $keu_pelanggan_deposit_del_keu = (isset($_POST['pelanggan_deposit_del_keu'])) ? 1 : 0;

		 $keu_supplier_deposit_mn_keu = (isset($_POST['supplier_deposit_mn_keu'])) ? 1 : 0;
        $keu_supplier_deposit_tb_keu = (isset($_POST['supplier_deposit_tb_keu'])) ? 1 : 0;
        $keu_supplier_deposit_ed_keu = (isset($_POST['supplier_deposit_ed_keu'])) ? 1 : 0;
        $keu_supplier_deposit_del_keu = (isset($_POST['supplier_deposit_del_keu'])) ? 1 : 0;

		 $keu_pengeluaran_mn_keu = (isset($_POST['pengeluaran_mn_keu'])) ? 1 : 0;
        $keu_pengeluaran_tb_keu = (isset($_POST['pengeluaran_tb_keu'])) ? 1 : 0;
        $keu_pengeluaran_ed_keu = (isset($_POST['pengeluaran_ed_keu'])) ? 1 : 0;
        $keu_pengeluaran_del_keu = (isset($_POST['pengeluaran_del_keu'])) ? 1 : 0;

		 $keu_budgeting_mn_keu = (isset($_POST['budgeting_mn_keu'])) ? 1 : 0;
        $keu_budgeting_tb_keu = (isset($_POST['budgeting_tb_keu'])) ? 1 : 0;
        $keu_budgeting_ed_keu = (isset($_POST['budgeting_ed_keu'])) ? 1 : 0;
        $keu_budgeting_del_keu = (isset($_POST['budgeting_del_keu'])) ? 1 : 0;

		 $keu_pengeluaranbudgeting_mn_keu = (isset($_POST['pengeluaranbudgeting_mn_keu'])) ? 1 : 0;
        $keu_pengeluaranbudgeting_tb_keu = (isset($_POST['pengeluaranbudgeting_tb_keu'])) ? 1 : 0;
        $keu_pengeluaranbudgeting_ed_keu = (isset($_POST['pengeluaranbudgeting_ed_keu'])) ? 1 : 0;
        $keu_pengeluaranbudgeting_del_keu = (isset($_POST['pengeluaranbudgeting_del_keu'])) ? 1 : 0;

        //TRANSAKSI 

        $trs_in_produksi_mn_trs = (isset($_POST['in_produksi_mn_trs'])) ? 1 : 0;
        $trs_in_produksi_tb_trs = (isset($_POST['in_produksi_tb_trs'])) ? 1 : 0;
        $trs_in_produksi_ed_trs = (isset($_POST['in_produksi_ed_trs'])) ? 1 : 0;
        $trs_in_produksi_del_trs = (isset($_POST['in_produksi_del_trs'])) ? 1 : 0;

		$trs_out_produksi_mn_trs = (isset($_POST['out_produksi_mn_trs'])) ? 1 : 0;
        $trs_out_produksi_tb_trs = (isset($_POST['out_produksi_tb_trs'])) ? 1 : 0;
        $trs_out_produksi_ed_trs = (isset($_POST['out_produksi_ed_trs'])) ? 1 : 0;
        $trs_out_produksi_del_trs = (isset($_POST['out_produksi_del_trs'])) ? 1 : 0;
		
        $trs_pembelian_persediaan_mn_trs = (isset($_POST['penerimaan_mn_trs'])) ? 1 : 0;
        $trs_pembelian_persediaan_tb_trs = (isset($_POST['penerimaan_tb_trs'])) ? 1 : 0;
        $trs_pembelian_persediaan_ed_trs = (isset($_POST['penerimaan_ed_trs'])) ? 1 : 0;
        $trs_pembelian_persediaan_del_trs = (isset($_POST['penerimaan_del_trs'])) ? 1 : 0;

		 $trs_order_pembelian_mn_trs = (isset($_POST['order_pembelian_mn_trs'])) ? 1 : 0;
        $trs_order_pembelian_tb_trs = (isset($_POST['order_pembelian_tb_trs'])) ? 1 : 0;
        $trs_order_pembelian_ed_trs = (isset($_POST['order_pembelian_ed_trs'])) ? 1 : 0;
        $trs_order_pembelian_del_trs = (isset($_POST['order_pembelian_del_trs'])) ? 1 : 0;

        $trs_pembelian_retur_mn_trs = (isset($_POST['returpembelian_mn_trs'])) ? 1 : 0;
        $trs_pembelian_retur_tb_trs = (isset($_POST['returpembelian_tb_trs'])) ? 1 : 0;
        $trs_pembelian_retur_ed_trs = (isset($_POST['returpembelian_ed_trs'])) ? 1 : 0;
        $trs_pembelian_retur_del_trs = (isset($_POST['returpembelian_del_trs'])) ? 1 : 0;

		$trs_ex_delivery_mn_trs = (isset($_POST['ex_delivery_mn_trs'])) ? 1 : 0;
        $trs_ex_delivery_tb_trs = (isset($_POST['ex_delivery_tb_trs'])) ? 1 : 0;
        $trs_ex_delivery_ed_trs = (isset($_POST['ex_delivery_ed_trs'])) ? 1 : 0;
        $trs_ex_delivery_del_trs = (isset($_POST['ex_delivery_del_trs'])) ? 1 : 0;
		
        $trs_penjualan_mn_trs = (isset($_POST['penjualan_mn_trs'])) ? 1 : 0;
        $trs_penjualan_tb_trs = (isset($_POST['penjualan_tb_trs'])) ? 1 : 0;
        $trs_penjualan_ed_trs = (isset($_POST['penjualan_ed_trs'])) ? 1 : 0;
        $trs_penjualan_del_trs = (isset($_POST['penjualan_del_trs'])) ? 1 : 0;

		$trs_order_penjualan_mn_trs = (isset($_POST['order_penjualan_mn_trs'])) ? 1 : 0;
        $trs_order_penjualan_tb_trs = (isset($_POST['order_penjualan_tb_trs'])) ? 1 : 0;
        $trs_order_penjualan_ed_trs = (isset($_POST['order_penjualan_ed_trs'])) ? 1 : 0;
        $trs_order_penjualan_del_trs = (isset($_POST['order_penjualan_del_trs'])) ? 1 : 0;

        $trs_penjualan_retur_mn_trs = (isset($_POST['returpenjualan_mn_trs'])) ? 1 : 0;
        $trs_penjualan_retur_tb_trs = (isset($_POST['returpenjualan_tb_trs'])) ? 1 : 0;
        $trs_penjualan_retur_ed_trs = (isset($_POST['returpenjualan_ed_trs'])) ? 1 : 0;
        $trs_penjualan_retur_del_trs = (isset($_POST['returpenjualan_del_trs'])) ? 1 : 0;

		$trs_tagihan_mn_trs = (isset($_POST['tagihan_mn_trs'])) ? 1 : 0;
        $trs_tagihan_tb_trs = (isset($_POST['tagihan_tb_trs'])) ? 1 : 0;
        $trs_tagihan_ed_trs = (isset($_POST['tagihan_ed_trs'])) ? 1 : 0;
        $trs_tagihan_del_trs = (isset($_POST['tagihan_del_trs'])) ? 1 : 0;

		//LAPORAN
		$daftar_harga_mn_lap = (isset($_POST['daftar_harga_mn_lap'])) ? 1 : 0;
        $daftar_harga_tb_lap = (isset($_POST['daftar_harga_tb_lap'])) ? 1 : 0;
        $daftar_harga_ed_lap = (isset($_POST['daftar_harga_ed_lap'])) ? 1 : 0;
        $daftar_harga_del_lap = (isset($_POST['daftar_harga_del_lap'])) ? 1 : 0;

		$saldo_stok_mn_lap = (isset($_POST['saldo_stok_mn_lap'])) ? 1 : 0;
        $saldo_stok_tb_lap = (isset($_POST['saldo_stok_tb_lap'])) ? 1 : 0;
        $saldo_stok_ed_lap = (isset($_POST['saldo_stok_ed_lap'])) ? 1 : 0;
        $saldo_stok_del_lap = (isset($_POST['saldo_stok_del_lap'])) ? 1 : 0;

		$mutasi_mn_lap = (isset($_POST['mutasi_mn_lap'])) ? 1 : 0;
        $mutasi_tb_lap = (isset($_POST['mutasi_tb_lap'])) ? 1 : 0;
        $mutasi_ed_lap = (isset($_POST['mutasi_ed_lap'])) ? 1 : 0;
        $mutasi_del_lap = (isset($_POST['mutasi_del_lap'])) ? 1 : 0;

		$kekuatan_stok_mn_lap = (isset($_POST['kekuatan_stok_mn_lap'])) ? 1 : 0;
        $kekuatan_stok_tb_lap = (isset($_POST['kekuatan_stok_tb_lap'])) ? 1 : 0;
        $kekuatan_stok_ed_lap = (isset($_POST['kekuatan_stok_ed_lap'])) ? 1 : 0;
        $kekuatan_stok_del_lap = (isset($_POST['kekuatan_stok_del_lap'])) ? 1 : 0;

		$umur_barang_mn_lap = (isset($_POST['umur_barang_mn_lap'])) ? 1 : 0;
        $umur_barang_tb_lap = (isset($_POST['umur_barang_tb_lap'])) ? 1 : 0;
        $umur_barang_ed_lap = (isset($_POST['umur_barang_ed_lap'])) ? 1 : 0;
        $umur_barang_del_lap = (isset($_POST['umur_barang_del_lap'])) ? 1 : 0;

		$cash_mn_lap = (isset($_POST['cash_mn_lap'])) ? 1 : 0;
        $cash_tb_lap = (isset($_POST['cash_tb_lap'])) ? 1 : 0;
        $cash_ed_lap = (isset($_POST['cash_ed_lap'])) ? 1 : 0;
        $cash_del_lap = (isset($_POST['cash_del_lap'])) ? 1 : 0;

		$rekening_mn_lap = (isset($_POST['rekening_mn_lap'])) ? 1 : 0;
        $rekening_tb_lap = (isset($_POST['rekening_tb_lap'])) ? 1 : 0;
        $rekening_ed_lap = (isset($_POST['rekening_ed_lap'])) ? 1 : 0;
        $rekening_del_lap = (isset($_POST['rekening_del_lap'])) ? 1 : 0;

		$giro_mn_lap = (isset($_POST['giro_mn_lap'])) ? 1 : 0;
        $giro_tb_lap = (isset($_POST['giro_tb_lap'])) ? 1 : 0;
        $giro_ed_lap = (isset($_POST['giro_ed_lap'])) ? 1 : 0;
        $giro_del_lap = (isset($_POST['giro_del_lap'])) ? 1 : 0;

		$pelanggan_deposit_mn_lap = (isset($_POST['pelanggan_deposit_mn_lap'])) ? 1 : 0;
        $pelanggan_deposit_tb_lap = (isset($_POST['pelanggan_deposit_tb_lap'])) ? 1 : 0;
        $pelanggan_deposit_ed_lap = (isset($_POST['pelanggan_deposit_ed_lap'])) ? 1 : 0;
        $pelanggan_deposit_del_lap = (isset($_POST['pelanggan_deposit_del_lap'])) ? 1 : 0;

		$supplier_deposit_mn_lap = (isset($_POST['supplier_deposit_mn_lap'])) ? 1 : 0;
        $supplier_deposit_tb_lap = (isset($_POST['supplier_deposit_tb_lap'])) ? 1 : 0;
        $supplier_deposit_ed_lap = (isset($_POST['supplier_deposit_ed_lap'])) ? 1 : 0;
        $supplier_deposit_del_lap = (isset($_POST['supplier_deposit_del_lap'])) ? 1 : 0;

		$penjualan_order_mn_lap = (isset($_POST['penjualan_order_mn_lap'])) ? 1 : 0;
        $penjualan_order_tb_lap = (isset($_POST['penjualan_order_tb_lap'])) ? 1 : 0;
        $penjualan_order_ed_lap = (isset($_POST['penjualan_order_ed_lap'])) ? 1 : 0;
        $penjualan_order_del_lap = (isset($_POST['penjualan_order_del_lap'])) ? 1 : 0;

		$penjualan_komparasi_mn_lap = (isset($_POST['penjualan_komparasi_mn_lap'])) ? 1 : 0;
        $penjualan_komparasi_tb_lap = (isset($_POST['penjualan_komparasi_tb_lap'])) ? 1 : 0;
        $penjualan_komparasi_ed_lap = (isset($_POST['penjualan_komparasi_ed_lap'])) ? 1 : 0;
        $penjualan_komparasi_del_lap = (isset($_POST['penjualan_komparasi_del_lap'])) ? 1 : 0;

		$penjualan_retur_mn_lap = (isset($_POST['penjualan_retur_mn_lap'])) ? 1 : 0;
        $penjualan_retur_tb_lap = (isset($_POST['penjualan_retur_tb_lap'])) ? 1 : 0;
        $penjualan_retur_ed_lap = (isset($_POST['penjualan_retur_ed_lap'])) ? 1 : 0;
        $penjualan_retur_del_lap = (isset($_POST['penjualan_retur_del_lap'])) ? 1 : 0;

		$penjualan_ringkas_mn_lap = (isset($_POST['penjualan_ringkas_mn_lap'])) ? 1 : 0;
        $penjualan_ringkas_tb_lap = (isset($_POST['penjualan_ringkas_tb_lap'])) ? 1 : 0;
        $penjualan_ringkas_ed_lap = (isset($_POST['penjualan_ringkas_ed_lap'])) ? 1 : 0;
        $penjualan_ringkas_del_lap = (isset($_POST['penjualan_ringkas_del_lap'])) ? 1 : 0;

		$penjualan_rinci_mn_lap = (isset($_POST['penjualan_rinci_mn_lap'])) ? 1 : 0;
        $penjualan_rinci_tb_lap = (isset($_POST['penjualan_rinci_tb_lap'])) ? 1 : 0;
        $penjualan_rinci_ed_lap = (isset($_POST['penjualan_rinci_ed_lap'])) ? 1 : 0;
        $penjualan_rinci_del_lap = (isset($_POST['penjualan_rinci_del_lap'])) ? 1 : 0;

		$pembelian_order_mn_lap = (isset($_POST['pembelian_order_mn_lap'])) ? 1 : 0;
        $pembelian_order_tb_lap = (isset($_POST['pembelian_order_tb_lap'])) ? 1 : 0;
        $pembelian_order_ed_lap = (isset($_POST['pembelian_order_ed_lap'])) ? 1 : 0;
        $pembelian_order_del_lap = (isset($_POST['pembelian_order_del_lap'])) ? 1 : 0;

		$pembelian_komparasi_mn_lap = (isset($_POST['pembelian_komparasi_mn_lap'])) ? 1 : 0;
        $pembelian_komparasi_tb_lap = (isset($_POST['pembelian_komparasi_tb_lap'])) ? 1 : 0;
        $pembelian_komparasi_ed_lap = (isset($_POST['pembelian_komparasi_ed_lap'])) ? 1 : 0;
        $pembelian_komparasi_del_lap = (isset($_POST['pembelian_komparasi_del_lap'])) ? 1 : 0;

		$pembelian_retur_mn_lap = (isset($_POST['pembelian_retur_mn_lap'])) ? 1 : 0;
        $pembelian_retur_tb_lap = (isset($_POST['pembelian_retur_tb_lap'])) ? 1 : 0;
        $pembelian_retur_ed_lap = (isset($_POST['pembelian_retur_ed_lap'])) ? 1 : 0;
        $pembelian_retur_del_lap = (isset($_POST['pembelian_retur_del_lap'])) ? 1 : 0;

		$pembelian_ringkas_mn_lap = (isset($_POST['pembelian_ringkas_mn_lap'])) ? 1 : 0;
        $pembelian_ringkas_tb_lap = (isset($_POST['pembelian_ringkas_tb_lap'])) ? 1 : 0;
        $pembelian_ringkas_ed_lap = (isset($_POST['pembelian_ringkas_ed_lap'])) ? 1 : 0;
        $pembelian_ringkas_del_lap = (isset($_POST['pembelian_ringkas_del_lap'])) ? 1 : 0;

		$pembelian_rinci_mn_lap = (isset($_POST['pembelian_rinci_mn_lap'])) ? 1 : 0;
        $pembelian_rinci_tb_lap = (isset($_POST['pembelian_rinci_tb_lap'])) ? 1 : 0;
        $pembelian_rinci_ed_lap = (isset($_POST['pembelian_rinci_ed_lap'])) ? 1 : 0;
        $pembelian_rinci_del_lap = (isset($_POST['pembelian_rinci_del_lap'])) ? 1 : 0;

		$rangking_pelanggan_mn_lap = (isset($_POST['rangking_pelanggan_mn_lap'])) ? 1 : 0;
        $rangking_pelanggan_tb_lap = (isset($_POST['rangking_pelanggan_tb_lap'])) ? 1 : 0;
        $rangking_pelanggan_ed_lap = (isset($_POST['rangking_pelanggan_ed_lap'])) ? 1 : 0;
        $rangking_pelanggan_del_lap = (isset($_POST['rangking_pelanggan_del_lap'])) ? 1 : 0;

		$barang_retur_mn_lap = (isset($_POST['barang_retur_mn_lap'])) ? 1 : 0;
        $barang_retur_tb_lap = (isset($_POST['barang_retur_tb_lap'])) ? 1 : 0;
        $barang_retur_ed_lap = (isset($_POST['barang_retur_ed_lap'])) ? 1 : 0;
        $barang_retur_del_lap = (isset($_POST['barang_retur_del_lap'])) ? 1 : 0;

		$moving_mn_lap = (isset($_POST['moving_mn_lap'])) ? 1 : 0;
        $moving_tb_lap = (isset($_POST['moving_tb_lap'])) ? 1 : 0;
        $moving_ed_lap = (isset($_POST['moving_ed_lap'])) ? 1 : 0;
        $moving_del_lap = (isset($_POST['moving_del_lap'])) ? 1 : 0;

		$keuntungan_penjualan_mn_lap = (isset($_POST['keuntungan_penjualan_mn_lap'])) ? 1 : 0;
        $keuntungan_penjualan_tb_lap = (isset($_POST['keuntungan_penjualan_tb_lap'])) ? 1 : 0;
        $keuntungan_penjualan_ed_lap = (isset($_POST['keuntungan_penjualan_ed_lap'])) ? 1 : 0;
        $keuntungan_penjualan_del_lap = (isset($_POST['keuntungan_penjualan_del_lap'])) ? 1 : 0;

		$laba_rugi_mn_lap = (isset($_POST['laba_rugi_mn_lap'])) ? 1 : 0;
        $laba_rugi_tb_lap = (isset($_POST['laba_rugi_tb_lap'])) ? 1 : 0;
        $laba_rugi_ed_lap = (isset($_POST['laba_rugi_ed_lap'])) ? 1 : 0;
        $laba_rugi_del_lap = (isset($_POST['laba_rugi_del_lap'])) ? 1 : 0;

		$penggajian_mn_lap = (isset($_POST['penggajian_mn_lap'])) ? 1 : 0;
        $penggajian_tb_lap = (isset($_POST['penggajian_tb_lap'])) ? 1 : 0;
        $penggajian_ed_lap = (isset($_POST['penggajian_ed_lap'])) ? 1 : 0;
        $penggajian_del_lap = (isset($_POST['penggajian_del_lap'])) ? 1 : 0;

		$neraca_mn_lap = (isset($_POST['neraca_mn_lap'])) ? 1 : 0;
        $neraca_tb_lap = (isset($_POST['neraca_tb_lap'])) ? 1 : 0;
        $neraca_ed_lap = (isset($_POST['neraca_ed_lap'])) ? 1 : 0;
        $neraca_del_lap = (isset($_POST['neraca_del_lap'])) ? 1 : 0;

		$laba_rugi_akun_mn_lap = (isset($_POST['laba_rugi_akun_mn_lap'])) ? 1 : 0;
        $laba_rugi_akun_tb_lap = (isset($_POST['laba_rugi_akun_tb_lap'])) ? 1 : 0;
        $laba_rugi_akun_ed_lap = (isset($_POST['laba_rugi_akun_ed_lap'])) ? 1 : 0;
        $laba_rugi_akun_del_lap = (isset($_POST['laba_rugi_akun_del_lap'])) ? 1 : 0;

		$jurnal_mn_lap = (isset($_POST['jurnal_mn_lap'])) ? 1 : 0;
        $jurnal_tb_lap = (isset($_POST['jurnal_tb_lap'])) ? 1 : 0;
        $jurnal_ed_lap = (isset($_POST['jurnal_ed_lap'])) ? 1 : 0;
        $jurnal_del_lap = (isset($_POST['jurnal_del_lap'])) ? 1 : 0;
		
		$hutang_ringkasan_mn_lap = (isset($_POST['hutang_ringkasan_mn_lap'])) ? 1 : 0;
        $hutang_ringkasan_tb_lap = (isset($_POST['hutang_ringkasan_tb_lap'])) ? 1 : 0;
        $hutang_ringkasan_ed_lap = (isset($_POST['hutang_ringkasan_ed_lap'])) ? 1 : 0;
        $hutang_ringkasan_del_lap = (isset($_POST['hutang_ringkasan_del_lap'])) ? 1 : 0;

		$hutang_rinci_mn_lap = (isset($_POST['hutang_rinci_mn_lap'])) ? 1 : 0;
        $hutang_rinci_tb_lap = (isset($_POST['hutang_rinci_tb_lap'])) ? 1 : 0;
        $hutang_rinci_ed_lap = (isset($_POST['hutang_rinci_ed_lap'])) ? 1 : 0;
        $hutang_rinci_del_lap = (isset($_POST['hutang_rinci_del_lap'])) ? 1 : 0;

		$piutang_ringkasan_mn_lap = (isset($_POST['piutang_ringkasan_mn_lap'])) ? 1 : 0;
        $piutang_ringkasan_tb_lap = (isset($_POST['piutang_ringkasan_tb_lap'])) ? 1 : 0;
        $piutang_ringkasan_ed_lap = (isset($_POST['piutang_ringkasan_ed_lap'])) ? 1 : 0;
        $piutang_ringkasan_del_lap = (isset($_POST['piutang_ringkasan_del_lap'])) ? 1 : 0;

		$piutang_rinci_mn_lap = (isset($_POST['piutang_rinci_mn_lap'])) ? 1 : 0;
        $piutang_rinci_tb_lap = (isset($_POST['piutang_rinci_tb_lap'])) ? 1 : 0;
        $piutang_rinci_ed_lap = (isset($_POST['piutang_rinci_ed_lap'])) ? 1 : 0;
        $piutang_rinci_del_lap = (isset($_POST['piutang_rinci_del_lap'])) ? 1 : 0;

		$rekap_harian_mn_lap = (isset($_POST['rekap_harian_mn_lap'])) ? 1 : 0;
        $rekap_harian_tb_lap = (isset($_POST['rekap_harian_tb_lap'])) ? 1 : 0;
        $rekap_harian_ed_lap = (isset($_POST['rekap_harian_ed_lap'])) ? 1 : 0;
        $rekap_harian_del_lap = (isset($_POST['rekap_harian_del_lap'])) ? 1 : 0;

		$kunjungan_sales_mn_lap = (isset($_POST['kunjungan_sales_mn_lap'])) ? 1 : 0;
        $kunjungan_sales_tb_lap = (isset($_POST['kunjungan_sales_tb_lap'])) ? 1 : 0;
        $kunjungan_sales_ed_lap = (isset($_POST['kunjungan_sales_ed_lap'])) ? 1 : 0;
        $kunjungan_sales_del_lap = (isset($_POST['kunjungan_sales_del_lap'])) ? 1 : 0;

		//ELSE
        $restoredatabase_mn_dm = (isset($_POST['restoredatabase_mn_dm'])) ? 1 : 0;

        $backupdatabase_mn_dm = (isset($_POST['backupdatabase_mn_dm'])) ? 1 : 0;

        $profile_mn_dm = (isset($_POST['profile_mn_dm'])) ? 1 : 0;

        $pg_log = (isset($_POST['lqoxg_mn_dm'])) ? 1 : 0;


        $dm_role = $role_mn_dm;
        $dm_role_aksi = $role_tb_dm . "~" . $role_ed_dm . "~" . $role_del_dm;
        $dm_user = $user_mn_dm;
        $dm_user_aksi = $user_tb_dm . "~" . $user_ed_dm . "~" . $user_del_dm;
        $dm_rekening = $rekening_mn_dm;
        $dm_rekening_aksi = $rekening_tb_dm . "~" . $rekening_ed_dm . "~" . $rekening_del_dm;
		$dm_kas = $kas_mn_dm;
        $dm_kas_aksi = $kas_tb_dm . "~" . $kas_ed_dm . "~" . $kas_del_dm;
		$dm_pegawai = $pegawai_mn_dm;
        $dm_pegawai_aksi = $pegawai_tb_dm . "~" . $pegawai_ed_dm . "~" . $pegawai_del_dm;
		$dm_pegawai_gaji = $pegawai_gaji_mn_dm;
        $dm_pegawai_gaji_aksi = $pegawai_gaji_tb_dm . "~" . $pegawai_gaji_ed_dm . "~" . $pegawai_gaji_del_dm;
		$dm_absensi = $absensi_mn_dm;
        $dm_absensi_aksi = $absensi_tb_dm . "~" . $absensi_ed_dm . "~" . $absensi_del_dm;
		$dm_akses_menu = $akses_menu_mn_dm;
        $dm_akses_menu_aksi = $akses_menu_tb_dm . "~" . $akses_menu_ed_dm . "~" . $akses_menu_del_dm;
		$dm_akses_password = $akses_password_mn_dm;
        $dm_akses_password_aksi = $akses_password_tb_dm . "~" . $akses_password_ed_dm . "~" . $akses_password_del_dm;
		$dm_divisi = $divisi_mn_dm;
        $dm_divisi_aksi = $divisi_tb_dm . "~" . $divisi_ed_dm . "~" . $divisi_del_dm;
		$dm_supplier_kategori = $supplier_kategori_mn_dm;
        $dm_supplier_kategori_aksi = $supplier_kategori_tb_dm . "~" . $supplier_kategori_ed_dm . "~" . $supplier_kategori_del_dm;
		$dm_supplier = $supplier_mn_dm;
        $dm_supplier_aksi = $supplier_tb_dm . "~" . $supplier_ed_dm . "~" . $supplier_del_dm;
		$dm_pelanggan_kategori = $pelanggan_kategori_mn_dm;
        $dm_pelanggan_kategori_aksi = $pelanggan_kategori_tb_dm . "~" . $pelanggan_kategori_ed_dm . "~" . $pelanggan_kategori_del_dm;
		$dm_pelanggan = $pelanggan_mn_dm;
        $dm_pelanggan_aksi = $pelanggan_tb_dm . "~" . $pelanggan_ed_dm . "~" . $pelanggan_del_dm;
		$dm_pajak_kategori = $pajak_kategori_mn_dm;
        $dm_pajak_kategori_aksi = $pajak_kategori_tb_dm . "~" . $pajak_kategori_ed_dm . "~" . $pajak_kategori_del_dm;
		$dm_produk_kategori = $produk_kategori_mn_dm;
        $dm_produk_kategori_aksi = $produk_kategori_tb_dm . "~" . $produk_kategori_ed_dm . "~" . $produk_kategori_del_dm;
		$dm_produk = $produk_mn_dm;
        $dm_produk_aksi = $produk_tb_dm . "~" . $produk_ed_dm . "~" . $produk_del_dm;
		$dm_akun = $akun_mn_dm;
        $dm_akun_aksi = $akun_tb_dm . "~" . $akun_ed_dm . "~" . $akun_del_dm;
		$dm_buku_besar = $buku_besar_mn_dm;
        $dm_buku_besar_aksi = $buku_besar_tb_dm . "~" . $buku_besar_ed_dm . "~" . $buku_besar_del_dm;
		$dm_jurnal = $jurnal_mn_dm;
        $dm_jurnal_aksi = $jurnal_tb_dm . "~" . $jurnal_ed_dm . "~" . $jurnal_del_dm;
		$dm_satuan = $satuan_mn_dm;
        $dm_satuan_aksi = $satuan_tb_dm . "~" . $satuan_ed_dm . "~" . $satuan_del_dm;
		$dm_produk_harga = $produk_harga_mn_dm;
        $dm_produk_harga_aksi = $produk_harga_tb_dm . "~" . $produk_harga_ed_dm . "~" . $produk_harga_del_dm;
		$dm_cabang = $cabang_mn_dm;
        $dm_cabang_aksi = $cabang_tb_dm . "~" . $cabang_ed_dm . "~" . $cabang_del_dm;
		$dm_mobil = $mobil_mn_dm;
        $dm_mobil_aksi = $mobil_tb_dm . "~" . $mobil_ed_dm . "~" . $mobil_del_dm;
		$dm_coverage = $coverage_mn_dm;
        $dm_coverage_aksi = $coverage_tb_dm . "~" . $coverage_ed_dm . "~" . $coverage_del_dm;
		//====
       
        //STOK
        $st_display = $st_display;
        $st_display_aksi = $st_display . "~" . $st_display . "~" . $st_display;
        $st_opname = $st_opname;
        $st_opname_aksi = $st_opname . "~" . $st_opname . "~" . $st_opname;
        $st_verifikasi_opname = $st_verifikasi_opname;
        $st_verifikasi_opname_aksi = $st_verifikasi_opname . "~" . $st_verifikasi_opname . "~" . $st_verifikasi_opname;
        $st_history = $st_history;
        $st_history_aksi = $st_history . "~" . $st_history . "~" . $st_history;

        //keuangan
        $keu_cash_besar = $keu_cash_besar_mn_keu;
        $keu_cash_besar_aksi = $keu_cash_besar_tb_keu . "~" . $keu_cash_besar_ed_keu . "~" . $keu_cash_besar_del_keu;
		  $keu_cash_kecil = $keu_cash_kecil_mn_keu;
        $keu_cash_kecil_aksi = $keu_cash_kecil_tb_keu . "~" . $keu_cash_kecil_ed_keu . "~" . $keu_cash_kecil_del_keu;
        $keu_rekening = $keu_rekening_mn_keu;
        $keu_rekening_aksi = $keu_rekening_tb_keu . "~" . $keu_rekening_ed_keu . "~" . $keu_rekening_del_keu;
        $keu_giro = $keu_giro_mn_keu;
        $keu_giro_aksi = $keu_giro_tb_keu . "~" . $keu_giro_ed_keu . "~" . $keu_giro_del_keu;
        $keu_pengeluaranbudgeting = $keu_pengeluaranbudgeting_mn_keu;
        $keu_pengeluaranbudgeting_aksi = $keu_pengeluaranbudgeting_tb_keu . "~" . $keu_pengeluaranbudgeting_ed_keu . "~" . $keu_pengeluaranbudgeting_del_keu;
		 $keu_hutang = $keu_hutang_mn_keu;
        $keu_hutang_aksi = $keu_hutang_tb_keu . "~" . $keu_hutang_ed_keu . "~" . $keu_hutang_del_keu;
		 $keu_piutang = $keu_piutang_mn_keu;
        $keu_piutang_aksi = $keu_piutang_tb_keu . "~" . $keu_piutang_ed_keu . "~" . $keu_piutang_del_keu;
        $keu_keuangan = $keuangan_mn_keu;
        $keu_keuangan_aksi = $keuangan_tb_keu . "~" . $keuangan_ed_keu . "~" . $keuangan_del_keu;
		 $keu_pelanggan_deposit = $keu_pelanggan_deposit_mn_keu;
        $keu_pelanggan_deposit_aksi = $keu_pelanggan_deposit_tb_keu . "~" . $keu_pelanggan_deposit_ed_keu . "~" . $keu_pelanggan_deposit_del_keu;
		 $keu_supplier_deposit = $keu_supplier_deposit_mn_keu;
        $keu_supplier_deposit_aksi = $keu_supplier_deposit_tb_keu . "~" . $keu_supplier_deposit_ed_keu . "~" . $keu_supplier_deposit_del_keu;
		 $keu_pengeluaran = $keu_pengeluaran_mn_keu;
        $keu_pengeluaran_aksi = $keu_pengeluaran_tb_keu . "~" . $keu_pengeluaran_ed_keu . "~" . $keu_pengeluaran_del_keu;
		 $keu_budgeting = $keu_budgeting_mn_keu;
        $keu_budgeting_aksi = $keu_budgeting_tb_keu . "~" . $keu_budgeting_ed_keu . "~" . $keu_budgeting_del_keu;
		 $keu_pengeluaran_budgeting = $keu_pengeluaranbudgeting_mn_keu;
        $keu_pengeluaran_budgeting_aksi = $keu_pengeluaranbudgeting_tb_keu . "~" . $keu_pengeluaranbudgeting_ed_keu . "~" . $keu_pengeluaranbudgeting_del_keu;
//sampai sini
        //transaksi
        $trs_in_produksi = $trs_in_produksi_mn_trs;
        $trs_in_produksi_aksi = $trs_in_produksi_tb_trs . "~" . $trs_in_produksi_ed_trs . "~" . $trs_in_produksi_del_trs;
		$trs_out_produksi = $trs_out_produksi_mn_trs;
        $trs_out_produksi_aksi = $trs_out_produksi_tb_trs . "~" . $trs_out_produksi_ed_trs . "~" . $trs_out_produksi_del_trs;
        $trs_pembelian_persediaan = $trs_pembelian_persediaan_mn_trs;
        $trs_pembelian_persediaan_aksi = $trs_pembelian_persediaan_tb_trs . "~" . $trs_pembelian_persediaan_ed_trs . "~" . $trs_pembelian_persediaan_del_trs;
         $trs_pembelian_order = $trs_order_pembelian_mn_trs;
        $trs_pembelian_order_aksi = $trs_order_pembelian_tb_trs . "~" . $trs_order_pembelian_ed_trs . "~" . $trs_order_pembelian_del_trs;
		$trs_pembelian_retur = $trs_pembelian_retur_mn_trs;
        $trs_pembelian_retur_aksi = $trs_pembelian_retur_tb_trs . "~" . $trs_pembelian_retur_ed_trs . "~" . $trs_pembelian_retur_del_trs;
		$trs_ex_delivery = $trs_ex_delivery_mn_trs;
        $trs_ex_delivery_aksi = $trs_ex_delivery_tb_trs . "~" . $trs_ex_delivery_ed_trs . "~" . $trs_ex_delivery_del_trs;
		 $trs_penjualan = $trs_penjualan_mn_trs;
        $trs_penjualan_aksi = $trs_penjualan_tb_trs . "~" . $trs_penjualan_ed_trs . "~" . $trs_penjualan_del_trs;
		 $trs_penjualan_order = $trs_order_penjualan_mn_trs;
        $trs_penjualan_order_aksi = $trs_order_penjualan_tb_trs . "~" . $trs_order_penjualan_ed_trs . "~" . $trs_order_penjualan_del_trs;
        $trs_penjualan_retur = $trs_penjualan_retur_mn_trs;
        $trs_penjualan_retur_aksi = $trs_penjualan_retur_tb_trs . "~" . $trs_penjualan_retur_ed_trs . "~" . $trs_penjualan_retur_del_trs;
		 $trs_tagihan = $trs_tagihan_mn_trs;
        $trs_tagihan_aksi = $trs_tagihan_tb_trs . "~" . $trs_tagihan_ed_trs . "~" . $trs_tagihan_del_trs;
		//LAPORAN
		 $lap_daftar_harga = $daftar_harga_mn_lap;
        $lap_daftar_harga_aksi = $daftar_harga_tb_lap . "~" . $daftar_harga_ed_lap . "~" . $daftar_harga_del_lap;
		 $lap_saldo_stok = $saldo_stok_mn_lap;
        $lap_saldo_stok_aksi = $saldo_stok_tb_lap . "~" . $saldo_stok_ed_lap . "~" . $saldo_stok_del_lap;
		 $lap_mutasi = $mutasi_mn_lap;
        $lap_mutasi_aksi = $mutasi_tb_lap . "~" . $mutasi_ed_lap . "~" . $mutasi_del_lap;
		 $lap_kekuatan_stok = $kekuatan_stok_mn_lap;
        $lap_kekuatan_stok_aksi = $kekuatan_stok_tb_lap . "~" . $kekuatan_stok_ed_lap . "~" . $kekuatan_stok_del_lap;
		 $lap_kekuatan_stok = $kekuatan_stok_mn_lap;
        $lap_kekuatan_stok_aksi = $kekuatan_stok_tb_lap . "~" . $kekuatan_stok_ed_lap . "~" . $kekuatan_stok_del_lap;
		 $lap_umur_barang = $umur_barang_mn_lap;
        $lap_umur_barang_aksi = $umur_barang_tb_lap . "~" . $umur_barang_ed_lap . "~" . $umur_barang_del_lap;
		 $lap_cash = $cash_mn_lap;
        $lap_cash_aksi = $cash_tb_lap . "~" . $cash_ed_lap . "~" . $cash_del_lap;
		 $lap_rekening = $rekening_mn_lap;
        $lap_rekening_aksi = $rekening_tb_lap . "~" . $rekening_ed_lap . "~" . $rekening_del_lap;
		 $lap_giro = $giro_mn_lap;
        $lap_giro_aksi = $giro_tb_lap . "~" . $giro_ed_lap . "~" . $giro_del_lap;
		 $lap_deposit_pelanggan = $pelanggan_deposit_mn_lap;
        $lap_deposit_pelanggan_aksi = $pelanggan_deposit_tb_lap . "~" . $pelanggan_deposit_ed_lap . "~" . $pelanggan_deposit_del_lap;
		 $lap_deposit_supplier = $supplier_deposit_mn_lap;
        $lap_deposit_supplier_aksi = $supplier_deposit_tb_lap . "~" . $supplier_deposit_ed_lap . "~" . $supplier_deposit_del_lap;
		 $lap_order_penjualan = $penjualan_order_mn_lap;
        $lap_order_penjualan_aksi = $penjualan_order_tb_lap . "~" . $penjualan_order_ed_lap . "~" . $penjualan_order_del_lap;
		 $lap_komparasi_penjualan = $penjualan_komparasi_mn_lap;
        $lap_komparasi_penjualan_aksi = $penjualan_komparasi_tb_lap . "~" . $penjualan_komparasi_ed_lap . "~" . $penjualan_komparasi_del_lap;
		 $lap_retur_penjualan = $penjualan_retur_mn_lap;
        $lap_retur_penjualan_aksi = $penjualan_retur_tb_lap . "~" . $penjualan_retur_ed_lap . "~" . $penjualan_retur_del_lap;
		 $lap_penjualan_ringkas = $penjualan_ringkas_mn_lap;
        $lap_penjualan_ringkas_aksi = $penjualan_ringkas_tb_lap . "~" . $penjualan_ringkas_ed_lap . "~" . $penjualan_ringkas_del_lap;
		 $lap_penjualan_rinci = $penjualan_rinci_mn_lap;
        $lap_penjualan_rinci_aksi = $penjualan_rinci_tb_lap . "~" . $penjualan_rinci_ed_lap . "~" . $penjualan_rinci_del_lap;
		 $lap_order_pembelian = $pembelian_order_mn_lap;
        $lap_order_pembelian_aksi = $pembelian_order_tb_lap . "~" . $pembelian_order_ed_lap . "~" . $pembelian_order_del_lap;
		 $lap_komparasi_pembelian = $pembelian_komparasi_mn_lap;
        $lap_komparasi_pembelian_aksi = $pembelian_komparasi_tb_lap . "~" . $pembelian_komparasi_ed_lap . "~" . $pembelian_komparasi_del_lap;
		 $lap_retur_pembelian = $pembelian_retur_mn_lap;
        $lap_retur_pembelian_aksi = $pembelian_retur_tb_lap . "~" . $pembelian_retur_ed_lap . "~" . $pembelian_retur_del_lap;
		 $lap_pembelian_ringkas = $pembelian_ringkas_mn_lap;
        $lap_pembelian_ringkas_aksi = $pembelian_ringkas_tb_lap . "~" . $pembelian_ringkas_ed_lap . "~" . $pembelian_ringkas_del_lap;
		 $lap_pembelian_rinci = $pembelian_rinci_mn_lap;
        $lap_pembelian_rinci_aksi = $pembelian_rinci_tb_lap . "~" . $pembelian_rinci_ed_lap . "~" . $pembelian_rinci_del_lap;
		 $lap_rangking_pelanggan = $rangking_pelanggan_mn_lap;
        $lap_rangking_pelanggan_aksi = $rangking_pelanggan_tb_lap . "~" . $rangking_pelanggan_ed_lap . "~" . $rangking_pelanggan_del_lap;
		 $lap_barang_retur = $barang_retur_mn_lap;
        $lap_barang_retur_aksi = $barang_retur_tb_lap . "~" . $barang_retur_ed_lap . "~" . $barang_retur_del_lap;
		 $lap_moving = $moving_mn_lap;
        $lap_moving_aksi = $moving_tb_lap . "~" . $moving_ed_lap . "~" . $moving_del_lap;
		 $lap_keuntungan_penjualan = $keuntungan_penjualan_mn_lap;
        $lap_keuntungan_penjualan_aksi = $keuntungan_penjualan_tb_lap . "~" . $keuntungan_penjualan_ed_lap . "~" . $keuntungan_penjualan_del_lap;
		 $lap_laba_rugi = $laba_rugi_mn_lap;
        $lap_laba_rugi_aksi = $laba_rugi_tb_lap . "~" . $laba_rugi_ed_lap . "~" . $laba_rugi_del_lap;
		 $lap_penggajian = $penggajian_mn_lap;
        $lap_penggajian_aksi = $penggajian_tb_lap . "~" . $penggajian_ed_lap . "~" . $penggajian_del_lap;
		 $lap_neraca = $neraca_mn_lap;
        $lap_neraca_aksi = $neraca_tb_lap . "~" . $neraca_ed_lap . "~" . $neraca_del_lap;
		 $lap_laba_rugi_akun = $laba_rugi_akun_mn_lap;
        $lap_laba_rugi_akun_aksi = $laba_rugi_akun_tb_lap . "~" . $laba_rugi_akun_ed_lap . "~" . $laba_rugi_akun_del_lap;
		 $lap_jurnal = $jurnal_mn_lap;
        $lap_jurnal_aksi = $jurnal_tb_lap . "~" . $jurnal_ed_lap . "~" . $jurnal_del_lap;
		 $lap_piutang_ringkasan = $piutang_ringkasan_mn_lap;
        $lap_piutang_ringkasan_aksi = $piutang_ringkasan_tb_lap . "~" . $piutang_ringkasan_ed_lap . "~" . $piutang_ringkasan_del_lap;
		 $lap_piutang_rinci = $piutang_rinci_mn_lap;
        $lap_piutang_rinci_aksi = $piutang_rinci_tb_lap . "~" . $piutang_rinci_ed_lap . "~" . $piutang_rinci_del_lap;
		
		 $lap_hutang_ringkasan = $hutang_ringkasan_mn_lap;
        $lap_hutang_ringkasan_aksi = $hutang_ringkasan_tb_lap . "~" . $hutang_ringkasan_ed_lap . "~" . $hutang_ringkasan_del_lap;
		 $lap_hutang_rinci = $hutang_rinci_mn_lap;
        $lap_hutang_rinci_aksi = $hutang_rinci_tb_lap . "~" . $hutang_rinci_ed_lap . "~" . $hutang_rinci_del_lap;
		 $lap_rekap_harian = $rekap_harian_mn_lap;
        $lap_rekap_harian_aksi = $rekap_harian_tb_lap . "~" . $rekap_harian_ed_lap . "~" . $rekap_harian_del_lap;
		 $lap_kunjungan_sales = $kunjungan_sales_mn_lap;
        $lap_kunjungan_sales_aksi = $kunjungan_sales_tb_lap . "~" . $kunjungan_sales_ed_lap . "~" . $kunjungan_sales_del_lap;
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
            'role_id' => $id,
            'dm_role' => urldecode($dm_role),
            'dm_role_aksi' => urldecode($dm_role_aksi),
            'dm_user' => urldecode($dm_user),
            'dm_user_aksi' => urldecode($dm_user_aksi),
            'dm_rekening' => urldecode($dm_rekening),
            'dm_rekening_aksi' => urldecode($dm_rekening_aksi),
			'dm_kas' => urldecode($dm_kas),
            'dm_kas_aksi' => urldecode($dm_kas_aksi),
			'dm_pegawai' => urldecode($dm_pegawai),
            'dm_pegawai_aksi' => urldecode($dm_pegawai_aksi),
			'dm_pegawai_gaji' => urldecode($dm_pegawai_gaji),
            'dm_pegawai_gaji_aksi' => urldecode($dm_pegawai_gaji_aksi),
			'dm_absensi' => urldecode($dm_absensi),
            'dm_absensi_aksi' => urldecode($dm_absensi_aksi),
			'dm_akses_menu' => urldecode($dm_akses_menu),
            'dm_akses_menu_aksi' => urldecode($dm_akses_menu_aksi),
			'dm_akses_password' => urldecode($dm_akses_password),
            'dm_akses_password_aksi' => urldecode($dm_akses_password_aksi),
            'dm_divisi' => urldecode($dm_divisi),
            'dm_divisi_aksi' => urldecode($dm_divisi_aksi),
            'dm_supplier' => urldecode($dm_supplier),
            'dm_supplier_aksi' => urldecode($dm_supplier_aksi),
            'dm_supplier_kategori' => urldecode($dm_supplier_kategori),
            'dm_supplier_kategori_aksi' => urldecode($dm_supplier_kategori_aksi),
            'dm_pelanggan_kategori' => urldecode($dm_pelanggan_kategori),
            'dm_pelanggan_kategori_aksi' => urldecode($dm_pelanggan_kategori_aksi),
            'dm_pelanggan' => urldecode($dm_pelanggan),
            'dm_pelanggan_aksi' => urldecode($dm_pelanggan_aksi),
            'dm_pajak_kategori' => urldecode($dm_pajak_kategori),
            'dm_pajak_kategori_aksi' => urldecode($dm_pajak_kategori_aksi),
			'dm_produk_kategori' => urldecode($dm_produk_kategori),
            'dm_produk_kategori_aksi' => urldecode($dm_produk_kategori_aksi),
            'dm_produk' => urldecode($dm_produk),
            'dm_produk_aksi' => urldecode($dm_produk_aksi),
			'dm_akun' => urldecode($dm_akun),
            'dm_akun_aksi' => urldecode($dm_akun_aksi),
            'dm_buku_besar' => urldecode($dm_buku_besar),
            'dm_buku_besar_aksi' => urldecode($dm_buku_besar_aksi),
            'dm_jurnal' => urldecode($dm_jurnal),
            'dm_jurnal_aksi' => urldecode($dm_jurnal_aksi),
            'dm_satuan' => urldecode($dm_satuan),
            'dm_satuan_aksi' => urldecode($dm_satuan_aksi),
            'dm_produk_harga' => urldecode($dm_produk_harga),
            'dm_produk_harga_aksi' => urldecode($dm_produk_harga_aksi),
            'dm_cabang' => urldecode($dm_cabang),
            'dm_cabang_aksi' => urldecode($dm_cabang_aksi),
			'dm_mobil' => urldecode($dm_mobil),
            'dm_mobil_aksi' => urldecode($dm_mobil_aksi),
			'dm_coverage' => urldecode($dm_coverage),
            'dm_coverage_aksi' => urldecode($dm_coverage_aksi),
            
            'st_display' => urldecode($st_display),
            'st_display_aksi' => urldecode($st_display_aksi),
            'st_opname' => urldecode($st_opname),
            'st_opname_aksi' => urldecode($st_opname_aksi),
            'st_verifikasi_opname' => urldecode($st_verifikasi_opname),
            'st_verifikasi_opname_aksi' => urldecode($st_verifikasi_opname_aksi),
            'st_history' => urldecode($st_history),
            'st_history_aksi' => urldecode($st_history_aksi),
			
			 'keu_hutang' => urldecode($keu_hutang),
            'keu_hutang_aksi' => urldecode($keu_hutang_aksi),
			 'keu_piutang' => urldecode($keu_piutang),
            'keu_piutang_aksi' => urldecode($keu_piutang_aksi),
            'keu_cash_kecil' => urldecode($keu_cash_kecil),
            'keu_cash_kecil_aksi' => urldecode($keu_cash_kecil_aksi),
			 'keu_cash_besar' => urldecode($keu_cash_besar),
            'keu_cash_besar_aksi' => urldecode($keu_cash_besar_aksi),
            'keu_rekening' => urldecode($keu_rekening),
            'keu_rekening_aksi' => urldecode($keu_rekening_aksi),
            'keu_giro' => urldecode($keu_giro),
            'keu_giro_aksi' => urldecode($keu_giro_aksi),
			 'keu_pengeluaran' => urldecode($keu_pengeluaran),
            'keu_pengeluaran_aksi' => urldecode($keu_pengeluaran_aksi),
			 'keu_budgeting' => urldecode($keu_budgeting),
            'keu_budgeting_aksi' => urldecode($keu_budgeting_aksi),
            'keu_pengeluaran_budgeting' => urldecode($keu_pengeluaran_budgeting),
            'keu_pengeluaran_budgeting_aksi' => urldecode($keu_pengeluaran_budgeting_aksi),
            'keu_keuangan' => urldecode($keu_keuangan),
            'keu_keuangan_aksi' => urldecode($keu_keuangan_aksi),
			
            'trs_in_produksi' => urldecode($trs_in_produksi),
            'trs_in_produksi_aksi' => urldecode($trs_in_produksi_aksi),
            'trs_out_produksi' => urldecode($trs_out_produksi),
            'trs_out_produksi_aksi' => urldecode($trs_out_produksi_aksi),            
			'trs_pembelian_persediaan' => urldecode($trs_pembelian_persediaan),
            'trs_pembelian_persediaan_aksi' => urldecode($trs_pembelian_persediaan_aksi),
			'trs_pembelian_order' => urldecode($trs_pembelian_order),
            'trs_pembelian_order_aksi' => urldecode($trs_pembelian_order_aksi),
		    'trs_pembelian_retur' => urldecode($trs_pembelian_retur),
            'trs_pembelian_retur_aksi' => urldecode($trs_pembelian_retur_aksi),
			 'trs_ex_delivery' => urldecode($trs_ex_delivery),
            'trs_ex_delivery_aksi' => urldecode($trs_ex_delivery_aksi), 
            'trs_penjualan' => urldecode($trs_penjualan),
            'trs_penjualan_aksi' => urldecode($trs_penjualan_aksi),
            'trs_penjualan_order' => urldecode($trs_penjualan_order),
            'trs_penjualan_order_aksi' => urldecode($trs_penjualan_order_aksi),
            'trs_penjualan_retur' => urldecode($trs_penjualan_retur),
            'trs_penjualan_retur_aksi' => urldecode($trs_penjualan_retur_aksi),
			 'trs_tagihan' => urldecode($trs_tagihan),
            'trs_tagihan_aksi' => urldecode($trs_tagihan_aksi), 
			
			 'lap_daftar_harga' => urldecode($lap_daftar_harga),
            'lap_daftar_harga_aksi' => urldecode($lap_daftar_harga_aksi), 
			 'lap_saldo_stok' => urldecode($lap_saldo_stok),
            'lap_saldo_stok_aksi' => urldecode($lap_saldo_stok_aksi), 
			 'lap_mutasi' => urldecode($lap_mutasi),
            'lap_mutasi_aksi' => urldecode($lap_mutasi_aksi), 
			 'lap_kekuatan_stok' => urldecode($lap_kekuatan_stok),
            'lap_kekuatan_stok_aksi' => urldecode($lap_kekuatan_stok_aksi), 
			 'lap_umur_barang' => urldecode($lap_umur_barang),
            'lap_umur_barang_aksi' => urldecode($lap_umur_barang_aksi), 
			 'lap_cash' => urldecode($lap_cash),
            'lap_cash_aksi' => urldecode($lap_cash_aksi), 
			 'lap_rekening' => urldecode($lap_rekening),
            'lap_rekening_aksi' => urldecode($lap_rekening_aksi), 
			 'lap_giro' => urldecode($lap_giro),
            'lap_giro_aksi' => urldecode($lap_giro_aksi), 
			 'lap_deposit_pelanggan' => urldecode($lap_deposit_pelanggan),
            'lap_deposit_pelanggan_aksi' => urldecode($lap_deposit_pelanggan_aksi), 
			 'lap_deposit_supplier' => urldecode($lap_deposit_supplier),
            'lap_deposit_supplier_aksi' => urldecode($lap_deposit_supplier_aksi), 
			 'lap_order_penjualan' => urldecode($lap_order_penjualan),
            'lap_order_penjualan_aksi' => urldecode($lap_order_penjualan_aksi), 
			 'lap_komparasi_penjualan' => urldecode($lap_komparasi_penjualan),
            'lap_komparasi_penjualan_aksi' => urldecode($lap_komparasi_penjualan_aksi), 
			 'lap_retur_penjualan' => urldecode($lap_retur_penjualan),
            'lap_retur_penjualan_aksi' => urldecode($lap_retur_penjualan_aksi), 
			 'lap_penjualan_ringkas' => urldecode($lap_penjualan_ringkas),
            'lap_penjualan_ringkas_aksi' => urldecode($lap_penjualan_ringkas_aksi), 
			 'lap_penjualan_rinci' => urldecode($lap_penjualan_rinci),
            'lap_penjualan_rinci_aksi' => urldecode($lap_penjualan_rinci_aksi), 
			 'lap_order_pembelian' => urldecode($lap_order_pembelian),
            'lap_order_pembelian_aksi' => urldecode($lap_order_pembelian_aksi), 
			 'lap_komparasi_pembelian' => urldecode($lap_komparasi_pembelian), 
            'lap_komparasi_pembelian_aksi' => urldecode($lap_komparasi_pembelian_aksi), 
			'lap_retur_pembelian' => urldecode($lap_retur_pembelian),
            'lap_retur_pembelian_aksi' => urldecode($lap_retur_pembelian_aksi), 
			'lap_pembelian_ringkas' => urldecode($lap_pembelian_ringkas),
            'lap_pembelian_ringkas_aksi' => urldecode($lap_pembelian_ringkas_aksi), 
			'lap_pembelian_rinci' => urldecode($lap_pembelian_rinci),
            'lap_pembelian_rinci_aksi' => urldecode($lap_pembelian_rinci_aksi), 
			'lap_rangking_pelanggan' => urldecode($lap_rangking_pelanggan),
            'lap_rangking_pelanggan_aksi' => urldecode($lap_rangking_pelanggan_aksi), 
			'lap_barang_retur' => urldecode($lap_barang_retur),
            'lap_barang_retur_aksi' => urldecode($lap_barang_retur_aksi), 
			'lap_moving' => urldecode($lap_moving),
            'lap_moving_aksi' => urldecode($lap_moving_aksi), 
			'lap_keuntungan_penjualan' => urldecode($lap_keuntungan_penjualan),
            'lap_keuntungan_penjualan_aksi' => urldecode($lap_keuntungan_penjualan_aksi), 
			'lap_laba_rugi' => urldecode($lap_laba_rugi),
            'lap_laba_rugi_aksi' => urldecode($lap_laba_rugi_aksi), 
			'lap_penggajian' => urldecode($lap_penggajian),
            'lap_penggajian_aksi' => urldecode($lap_penggajian_aksi), 
			'lap_neraca' => urldecode($lap_neraca),
            'lap_neraca_aksi' => urldecode($lap_neraca_aksi), 
			'lap_laba_rugi_akun' => urldecode($lap_laba_rugi_akun),
            'lap_laba_rugi_akun_aksi' => urldecode($lap_laba_rugi_akun_aksi), 
			'lap_jurnal' => urldecode($lap_jurnal),
            'lap_jurnal_aksi' => urldecode($lap_jurnal_aksi), 
			'lap_hutang_ringkasan' => urldecode($lap_hutang_ringkasan),
            'lap_hutang_ringkasan_aksi' => urldecode($lap_hutang_ringkasan_aksi), 
			'lap_hutang_rinci' => urldecode($lap_hutang_rinci),
            'lap_hutang_rinci_aksi' => urldecode($lap_hutang_rinci_aksi), 
			'lap_piutang_ringkasan' => urldecode($lap_piutang_ringkasan),
            'lap_piutang_ringkasan_aksi' => urldecode($lap_piutang_ringkasan_aksi), 
			'lap_piutang_rinci' => urldecode($lap_piutang_rinci),
            'lap_piutang_rinci_aksi' => urldecode($lap_piutang_rinci_aksi), 
			'lap_rekap_harian' => urldecode($lap_rekap_harian),
            'lap_rekap_harian_aksi' => urldecode($lap_rekap_harian_aksi), 
			'lap_kunjungan_sales' => urldecode($lap_kunjungan_sales),
            'lap_kunjungan_sales_aksi' => urldecode($lap_kunjungan_sales_aksi), 
			
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
    } */
}
