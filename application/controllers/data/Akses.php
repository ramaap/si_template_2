<?php

defined("BASEPATH") OR exit("No direct script access allowed");

class Akses extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Model template 
        $this->load->model("setting_akses");
        $this->load->model("data_profile");
        // Place your model here...
    }

    public function akses_password_otorisasi() {
		
        $pass = $this->lib->check_pass_javascript($_POST["akses"], md5($_POST['input_pass'])); 
		echo $pass;
	}
	
    public function index() {
        $data["akses"] = "dm_akses_menu";
        $this->session->set_userdata("akses_id", $data["akses"]);
        $this->lib->check_session();
        $this->lib->check_lokasi("Pengaturan Akses");

        $data["error"] = "";
        $data["status"] = "";
        // $this->session->set_userdata("error","");
        $this->load->view("data/akses_menu_view", $data);
    }

    public function show() {
        $this->lib->check_session();
        redirect("data/akses_menu/");
    }

    public function akses_menu_show_by_id() { //kirim data buat form edit
        $this->lib->check_session();
        $akses = $this->setting_akses->get_by_id($_POST["datamodel"]); //data_model = primary key
        $array = array();
        $index = 0;
      
		echo json_encode($akses);
		// echo $akses;
    }

    public function akses_menu_show() {
        $this->lib->check_session();
        $index = 0;
        $akses = $this->setting_akses->get_all();
        $array = array();
        foreach ($akses as $tmp) {

            $temp["index"] = $index;
            $temp["datamodel"] = $tmp->am_id;
            $temp["role_id"] = $tmp->role_id;
            $temp["role_nama"] = $tmp->role_nama;
            $temp["is_delete"] = $tmp->is_delete;
            array_push($array, $temp);
            $index++;
        }


        echo json_encode($array);
    }

    public function get_array() {
        $this->lib->check_session();
        $role_mn_dm = (isset($_POST["role_mn_dm"])) ? 1 : 0;
        $role_tb_dm = (isset($_POST["role_tb_dm"])) ? 1 : 0;
        $role_ed_dm = (isset($_POST["role_ed_dm"])) ? 1 : 0;
        $role_del_dm = (isset($_POST["role_del_dm"])) ? 1 : 0;
        $role_oto_dm = (isset($_POST["role_oto_dm"])) ? 1 : 0;

        $user_mn_dm = (isset($_POST["user_mn_dm"])) ? 1 : 0;
        $user_tb_dm = (isset($_POST["user_tb_dm"])) ? 1 : 0;
        $user_ed_dm = (isset($_POST["user_ed_dm"])) ? 1 : 0;
        $user_del_dm = (isset($_POST["user_del_dm"])) ? 1 : 0;
        $user_oto_dm = (isset($_POST["user_oto_dm"])) ? 1 : 0;

        $rekening_mn_dm = (isset($_POST["rekening_mn_dm"])) ? 1 : 0;
        $rekening_tb_dm = (isset($_POST["rekening_tb_dm"])) ? 1 : 0;
        $rekening_ed_dm = (isset($_POST["rekening_ed_dm"])) ? 1 : 0;
        $rekening_del_dm = (isset($_POST["rekening_del_dm"])) ? 1 : 0;
        $rekening_oto_dm = (isset($_POST["rekening_oto_dm"])) ? 1 : 0;

        $pegawai_mn_dm = (isset($_POST["pegawai_mn_dm"])) ? 1 : 0;
        $pegawai_tb_dm = (isset($_POST["pegawai_tb_dm"])) ? 1 : 0;
        $pegawai_ed_dm = (isset($_POST["pegawai_ed_dm"])) ? 1 : 0;
        $pegawai_del_dm = (isset($_POST["pegawai_del_dm"])) ? 1 : 0;
        $pegawai_oto_dm = (isset($_POST["pegawai_oto_dm"])) ? 1 : 0;

        $divisi_mn_dm = (isset($_POST["divisi_mn_dm"])) ? 1 : 0;
        $divisi_tb_dm = (isset($_POST["divisi_tb_dm"])) ? 1 : 0;
        $divisi_ed_dm = (isset($_POST["divisi_ed_dm"])) ? 1 : 0;
        $divisi_del_dm = (isset($_POST["divisi_del_dm"])) ? 1 : 0;
        $divisi_oto_dm = (isset($_POST["divisi_oto_dm"])) ? 1 : 0;

        $pemasok_kategori_mn_dm = (isset($_POST["kategoripemasok_mn_dm"])) ? 1 : 0;
        $pemasok_kategori_tb_dm = (isset($_POST["kategoripemasok_tb_dm"])) ? 1 : 0;
        $pemasok_kategori_ed_dm = (isset($_POST["kategoripemasok_ed_dm"])) ? 1 : 0;
        $pemasok_kategori_del_dm = (isset($_POST["kategoripemasok_del_dm"])) ? 1 : 0;
        $pemasok_kategori_oto_dm = (isset($_POST["kategoripemasok_oto_dm"])) ? 1 : 0;

        $pemasok_mn_dm = (isset($_POST["suuplier_mn_dm"])) ? 1 : 0;
        $pemasok_tb_dm = (isset($_POST["suuplier_tb_dm"])) ? 1 : 0;
        $pemasok_ed_dm = (isset($_POST["suuplier_ed_dm"])) ? 1 : 0;
        $pemasok_del_dm = (isset($_POST["suuplier_del_dm"])) ? 1 : 0;
        $pemasok_oto_dm = (isset($_POST["suuplier_oto_dm"])) ? 1 : 0;

        $pelanggan_mn_dm = (isset($_POST["konssumen_mn_dm"])) ? 1 : 0;
        $pelanggan_tb_dm = (isset($_POST["konssumen_tb_dm"])) ? 1 : 0;
        $pelanggan_ed_dm = (isset($_POST["konssumen_ed_dm"])) ? 1 : 0;
        $pelanggan_del_dm = (isset($_POST["konssumen_del_dm"])) ? 1 : 0;
        $pelanggan_oto_dm = (isset($_POST["konssumen_oto_dm"])) ? 1 : 0;

        $pelanggan_kategori_mn_dm = (isset($_POST["kategorpelanggan_mn_dm"])) ? 1 : 0;
        $pelanggan_kategori_tb_dm = (isset($_POST["kategorpelanggan_tb_dm"])) ? 1 : 0;
        $pelanggan_kategori_ed_dm = (isset($_POST["kategorpelanggan_ed_dm"])) ? 1 : 0;
        $pelanggan_kategori_del_dm = (isset($_POST["kategorpelanggan_del_dm"])) ? 1 : 0;
        $pelanggan_kategori_oto_dm = (isset($_POST["kategorpelanggan_oto_dm"])) ? 1 : 0;

        $produk_kategori_mn_dm = (isset($_POST["kategoriproduk_mn_dm"])) ? 1 : 0;
        $produk_kategori_tb_dm = (isset($_POST["kategoriproduk_tb_dm"])) ? 1 : 0;
        $produk_kategori_ed_dm = (isset($_POST["kategoriproduk_ed_dm"])) ? 1 : 0;
        $produk_kategori_del_dm = (isset($_POST["kategoriproduk_del_dm"])) ? 1 : 0;
        $produk_kategori_oto_dm = (isset($_POST["kategoriproduk_oto_dm"])) ? 1 : 0;

        $produk_mn_dm = (isset($_POST["prqoduqks_mn_dm"])) ? 1 : 0;
        $produk_tb_dm = (isset($_POST["prqoduqks_tb_dm"])) ? 1 : 0;
        $produk_ed_dm = (isset($_POST["prqoduqks_ed_dm"])) ? 1 : 0;
        $produk_del_dm = (isset($_POST["prqoduqks_del_dm"])) ? 1 : 0;
        $produk_oto_dm = (isset($_POST["prqoduqks_oto_dm"])) ? 1 : 0;

        $produk_promo_mn_dm = (isset($_POST["prqoduqkproqmo_mn_dm"])) ? 1 : 0;
        $produk_promo_tb_dm = (isset($_POST["prqoduqkproqmo_tb_dm"])) ? 1 : 0;
        $produk_promo_ed_dm = (isset($_POST["prqoduqkproqmo_ed_dm"])) ? 1 : 0;
        $produk_promo_del_dm = (isset($_POST["prqoduqkproqmo_del_dm"])) ? 1 : 0;
        $produk_promo_oto_dm = (isset($_POST["prqoduqkproqmo_oto_dm"])) ? 1 : 0;

        $produk_paket_mn_dm = (isset($_POST["prqoeduqkpaqket_mn_dm"])) ? 1 : 0;
        $produk_paket_tb_dm = (isset($_POST["prqoeduqkpaqket_tb_dm"])) ? 1 : 0;
        $produk_paket_ed_dm = (isset($_POST["prqoeduqkpaqket_ed_dm"])) ? 1 : 0;
        $produk_paket_del_dm = (isset($_POST["prqoeduqkpaqket_del_dm"])) ? 1 : 0;
        $produk_paket_oto_dm = (isset($_POST["prqoeduqkpaqket_oto_dm"])) ? 1 : 0;

        $paket_buat_mn_dm = (isset($_POST["paketbuat_mn_dm"])) ? 1 : 0;
        $paket_buat_tb_dm = (isset($_POST["paketbuat_tb_dm"])) ? 1 : 0;
        $paket_buat_ed_dm = (isset($_POST["paketbuat_ed_dm"])) ? 1 : 0;
        $paket_buat_del_dm = (isset($_POST["paketbuat_del_dm"])) ? 1 : 0;
        $paket_buat_oto_dm = (isset($_POST["paketbuat_oto_dm"])) ? 1 : 0;

        $paket_lepas_mn_dm = (isset($_POST["paketlepas_mn_dm"])) ? 1 : 0;
        $paket_lepas_tb_dm = (isset($_POST["paketlepas_tb_dm"])) ? 1 : 0;
        $paket_lepas_ed_dm = (isset($_POST["paketlepas_ed_dm"])) ? 1 : 0;
        $paket_lepas_del_dm = (isset($_POST["paketlepas_del_dm"])) ? 1 : 0;
        $paket_lepas_oto_dm = (isset($_POST["paketlepas_oto_dm"])) ? 1 : 0;

        $akun_mn_dm = (isset($_POST["akun_mn_dm"])) ? 1 : 0;
        $akun_tb_dm = (isset($_POST["akun_tb_dm"])) ? 1 : 0;
        $akun_ed_dm = (isset($_POST["akun_ed_dm"])) ? 1 : 0;
        $akun_del_dm = (isset($_POST["akun_del_dm"])) ? 1 : 0;
        $akun_oto_dm = (isset($_POST["akun_oto_dm"])) ? 1 : 0;

        $buku_besar_mn_dm = (isset($_POST["buktubestar_mn_dm"])) ? 1 : 0;
        $buku_besar_tb_dm = (isset($_POST["buktubestar_tb_dm"])) ? 1 : 0;
        $buku_besar_ed_dm = (isset($_POST["buktubestar_ed_dm"])) ? 1 : 0;
        $buku_besar_del_dm = (isset($_POST["buktubestar_del_dm"])) ? 1 : 0;
        $buku_besar_oto_dm = (isset($_POST["buktubestar_oto_dm"])) ? 1 : 0;

        $jurnal_mn_dm = (isset($_POST["jurnal_mn_dm"])) ? 1 : 0;
        $jurnal_tb_dm = (isset($_POST["jurnal_tb_dm"])) ? 1 : 0;
        $jurnal_ed_dm = (isset($_POST["jurnal_ed_dm"])) ? 1 : 0;
        $jurnal_del_dm = (isset($_POST["jurnal_del_dm"])) ? 1 : 0;
        $jurnal_oto_dm = (isset($_POST["jurnal_oto_dm"])) ? 1 : 0;

        $lokasi_mn_dm = (isset($_POST["lokasi_mn_dm"])) ? 1 : 0;
        $lokasi_tb_dm = (isset($_POST["lokasi_tb_dm"])) ? 1 : 0;
        $lokasi_ed_dm = (isset($_POST["lokasi_ed_dm"])) ? 1 : 0;
        $lokasi_del_dm = (isset($_POST["lokasi_del_dm"])) ? 1 : 0;
        $lokasi_oto_dm = (isset($_POST["lokasi_oto_dm"])) ? 1 : 0;

        $satuan_mn_dm = (isset($_POST["satuan_mn_dm"])) ? 1 : 0;
        $satuan_tb_dm = (isset($_POST["satuan_tb_dm"])) ? 1 : 0;
        $satuan_ed_dm = (isset($_POST["satuan_ed_dm"])) ? 1 : 0;
        $satuan_del_dm = (isset($_POST["satuan_del_dm"])) ? 1 : 0;
        $satuan_oto_dm = (isset($_POST["satuan_oto_dm"])) ? 1 : 0;

        $produk_harga_mn_dm = (isset($_POST["prqoeduqkhaqrga_mn_dm"])) ? 1 : 0;
        $produk_harga_tb_dm = (isset($_POST["prqoeduqkhaqrga_tb_dm"])) ? 1 : 0;
        $produk_harga_ed_dm = (isset($_POST["prqoeduqkhaqrga_ed_dm"])) ? 1 : 0;
        $produk_harga_del_dm = (isset($_POST["prqoeduqkhaqrga_del_dm"])) ? 1 : 0;
        $produk_harga_oto_dm = (isset($_POST["prqoeduqkhaqrga_oto_dm"])) ? 1 : 0;
 
        $kas_kecil_mn_dm = (isset($_POST["qkajskecil_mn_dm"])) ? 1 : 0;
        $kas_kecil_tb_dm = (isset($_POST["qkajskecil_tb_dm"])) ? 1 : 0;
        $kas_kecil_ed_dm = (isset($_POST["qkajskecil_ed_dm"])) ? 1 : 0;
        $kas_kecil_del_dm = (isset($_POST["qkajskecil_del_dm"])) ? 1 : 0;
        $kas_kecil_oto_dm = (isset($_POST["qkajskecil_oto_dm"])) ? 1 : 0;

        $kas_besar_mn_dm = (isset($_POST["qkajsbesar_mn_dm"])) ? 1 : 0;
        $kas_besar_tb_dm = (isset($_POST["qkajsbesar_tb_dm"])) ? 1 : 0;
        $kas_besar_ed_dm = (isset($_POST["qkajsbesar_ed_dm"])) ? 1 : 0;
        $kas_besar_del_dm = (isset($_POST["qkajsbesar_del_dm"])) ? 1 : 0;
        $kas_besar_oto_dm = (isset($_POST["qkajsbesar_oto_dm"])) ? 1 : 0;

        $cabang_mn_dm = (isset($_POST["cabang_mn_dm"])) ? 1 : 0;
        $cabang_tb_dm = (isset($_POST["cabang_tb_dm"])) ? 1 : 0;
        $cabang_ed_dm = (isset($_POST["cabang_ed_dm"])) ? 1 : 0;
        $cabang_del_dm = (isset($_POST["cabang_del_dm"])) ? 1 : 0;
        $cabang_oto_dm = (isset($_POST["cabang_oto_dm"])) ? 1 : 0;

        $coverage_mn_dm = (isset($_POST["coverage_mn_dm"])) ? 1 : 0;
        $coverage_tb_dm = (isset($_POST["coverage_tb_dm"])) ? 1 : 0;
        $coverage_ed_dm = (isset($_POST["coverage_ed_dm"])) ? 1 : 0;
        $coverage_del_dm = (isset($_POST["coverage_del_dm"])) ? 1 : 0;
        $coverage_oto_dm = (isset($_POST["coverage_oto_dm"])) ? 1 : 0;

        $merk_mn_dm = (isset($_POST["merk_mn_dm"])) ? 1 : 0;
        $merk_tb_dm = (isset($_POST["merk_tb_dm"])) ? 1 : 0;
        $merk_ed_dm = (isset($_POST["merk_ed_dm"])) ? 1 : 0;
        $merk_del_dm = (isset($_POST["merk_del_dm"])) ? 1 : 0;
        $merk_oto_dm = (isset($_POST["merk_oto_dm"])) ? 1 : 0;

        $rak_mn_dm = (isset($_POST["raak_mn_dm"])) ? 1 : 0;
        $rak_tb_dm = (isset($_POST["raak_tb_dm"])) ? 1 : 0;
        $rak_ed_dm = (isset($_POST["raak_ed_dm"])) ? 1 : 0;
        $rak_del_dm = (isset($_POST["raak_del_dm"])) ? 1 : 0;
        $rak_oto_dm = (isset($_POST["raak_oto_dm"])) ? 1 : 0;

        $rak_setting_mn_dm = (isset($_POST["raksetting_mn_dm"])) ? 1 : 0;
        $rak_setting_tb_dm = (isset($_POST["raksetting_tb_dm"])) ? 1 : 0;
        $rak_setting_ed_dm = (isset($_POST["raksetting_ed_dm"])) ? 1 : 0;
        $rak_setting_del_dm = (isset($_POST["raksetting_del_dm"])) ? 1 : 0;
        $rak_setting_oto_dm = (isset($_POST["raksetting_oto_dm"])) ? 1 : 0;

        $rak_setting_detail_mn_dm = (isset($_POST["raksetting_detail_mn_dm"])) ? 1 : 0;
        $rak_setting_detail_tb_dm = (isset($_POST["raksetting_detail_tb_dm"])) ? 1 : 0;
        $rak_setting_detail_ed_dm = (isset($_POST["raksetting_detail_ed_dm"])) ? 1 : 0;
        $rak_setting_detail_del_dm = (isset($_POST["raksetting_detail_del_dm"])) ? 1 : 0;
        $rak_setting_detail_oto_dm = (isset($_POST["raksetting_detail_oto_dm"])) ? 1 : 0;

        $display_mn_st = (isset($_POST["display_mn_st"])) ? 1 : 0;
        $display_tb_st = (isset($_POST["display_tb_st"])) ? 1 : 0;
        $display_ed_st = (isset($_POST["display_ed_st"])) ? 1 : 0;
        $display_del_st = (isset($_POST["display_del_st"])) ? 1 : 0;
        $display_oto_st = (isset($_POST["display_oto_st"])) ? 1 : 0;

        $opname_mn_st = (isset($_POST["opnama_mn_st"])) ? 1 : 0;
        $opname_tb_st = (isset($_POST["opnama_tb_st"])) ? 1 : 0;
        $opname_ed_st = (isset($_POST["opnama_ed_st"])) ? 1 : 0;
        $opname_del_st = (isset($_POST["opnama_del_st"])) ? 1 : 0;
        $opname_oto_st = (isset($_POST["opnama_oto_st"])) ? 1 : 0;

        $verifikasi_opname_mn_st = (isset($_POST["verifikasiopname_mn_st"])) ? 1 : 0;
        $verifikasi_opname_tb_st = (isset($_POST["verifikasiopname_tb_st"])) ? 1 : 0;
        $verifikasi_opname_ed_st = (isset($_POST["verifikasiopname_ed_st"])) ? 1 : 0;
        $verifikasi_opname_del_st = (isset($_POST["verifikasiopname_del_st"])) ? 1 : 0;
        $verifikasi_opname_oto_st = (isset($_POST["verifikasiopname_oto_st"])) ? 1 : 0;

        $history_mn_st = (isset($_POST["history_mn_st"])) ? 1 : 0;
        $history_tb_st = (isset($_POST["history_tb_st"])) ? 1 : 0;
        $history_ed_st = (isset($_POST["history_ed_st"])) ? 1 : 0;
        $history_del_st = (isset($_POST["history_del_st"])) ? 1 : 0;
        $history_oto_st = (isset($_POST["history_oto_st"])) ? 1 : 0;

        $rekening_mn_keu = (isset($_POST["rekening_mn_keu"])) ? 1 : 0;
        $rekening_tb_keu = (isset($_POST["rekening_tb_keu"])) ? 1 : 0;
        $rekening_ed_keu = (isset($_POST["rekening_ed_keu"])) ? 1 : 0;
        $rekening_del_keu = (isset($_POST["rekening_del_keu"])) ? 1 : 0;
        $rekening_oto_keu = (isset($_POST["rekening_oto_keu"])) ? 1 : 0;

        $giro_mn_keu = (isset($_POST["giro_mn_keu"])) ? 1 : 0;
        $giro_tb_keu = (isset($_POST["giro_tb_keu"])) ? 1 : 0;
        $giro_ed_keu = (isset($_POST["giro_ed_keu"])) ? 1 : 0;
        $giro_del_keu = (isset($_POST["giro_del_keu"])) ? 1 : 0;
        $giro_oto_keu = (isset($_POST["giro_oto_keu"])) ? 1 : 0;

        $keuangan_mn_keu = (isset($_POST["keuangan_mn_keu"])) ? 1 : 0;
        $keuangan_tb_keu = (isset($_POST["keuangan_tb_keu"])) ? 1 : 0;
        $keuangan_ed_keu = (isset($_POST["keuangan_ed_keu"])) ? 1 : 0;
        $keuangan_del_keu = (isset($_POST["keuangan_del_keu"])) ? 1 : 0;
        $keuangan_oto_keu = (isset($_POST["keuangan_oto_keu"])) ? 1 : 0;

        $hutang_mn_keu = (isset($_POST["hutang_mn_keu"])) ? 1 : 0;
        $hutang_tb_keu = (isset($_POST["hutang_tb_keu"])) ? 1 : 0;
        $hutang_ed_keu = (isset($_POST["hutang_ed_keu"])) ? 1 : 0;
        $hutang_del_keu = (isset($_POST["hutang_del_keu"])) ? 1 : 0;
        $hutang_oto_keu = (isset($_POST["hutang_oto_keu"])) ? 1 : 0;

        $piutang_mn_keu = (isset($_POST["piutang_mn_keu"])) ? 1 : 0;
        $piutang_tb_keu = (isset($_POST["piutang_tb_keu"])) ? 1 : 0;
        $piutang_ed_keu = (isset($_POST["piutang_ed_keu"])) ? 1 : 0;
        $piutang_del_keu = (isset($_POST["piutang_del_keu"])) ? 1 : 0;
        $piutang_oto_keu = (isset($_POST["piutang_oto_keu"])) ? 1 : 0;

        $cash_besar_mn_keu = (isset($_POST["cashbesar_mn_keu"])) ? 1 : 0;
        $cash_besar_tb_keu = (isset($_POST["cashbesar_tb_keu"])) ? 1 : 0;
        $cash_besar_ed_keu = (isset($_POST["cashbesar_ed_keu"])) ? 1 : 0;
        $cash_besar_del_keu = (isset($_POST["cashbesar_del_keu"])) ? 1 : 0;
        $cash_besar_oto_keu = (isset($_POST["cashbesar_oto_keu"])) ? 1 : 0;

        $cash_kecil_mn_keu = (isset($_POST["cashkecil_mn_keu"])) ? 1 : 0;
        $cash_kecil_tb_keu = (isset($_POST["cashkecil_tb_keu"])) ? 1 : 0;
        $cash_kecil_ed_keu = (isset($_POST["cashkecil_ed_keu"])) ? 1 : 0;
        $cash_kecil_del_keu = (isset($_POST["cashkecil_del_keu"])) ? 1 : 0;
        $cash_kecil_oto_keu = (isset($_POST["cashkecil_oto_keu"])) ? 1 : 0;

        $pembelian_pesanan_direct_mn_trs = (isset($_POST["pembeliianpeersediaandirect_mn_trs"])) ? 1 : 0;
        $pembelian_pesanan_direct_tb_trs = (isset($_POST["pembeliianpeersediaandirect_tb_trs"])) ? 1 : 0;
        $pembelian_pesanan_direct_ed_trs = (isset($_POST["pembeliianpeersediaandirect_ed_trs"])) ? 1 : 0;
        $pembelian_pesanan_direct_del_trs = (isset($_POST["pembeliianpeersediaandirect_del_trs"])) ? 1 : 0;
        $pembelian_pesanan_direct_oto_trs = (isset($_POST["pembeliianpeersediaandirect_oto_trs"])) ? 1 : 0;
 
        $in_delivery_mn_trs = (isset($_POST["inx_delivry_mn_trs"])) ? 1 : 0;
        $in_delivery_tb_trs = (isset($_POST["inx_delivry_tb_trs"])) ? 1 : 0;
        $in_delivery_ed_trs = (isset($_POST["inx_delivry_ed_trs"])) ? 1 : 0;
        $in_delivery_del_trs = (isset($_POST["inx_delivry_del_trs"])) ? 1 : 0;
        $in_delivery_oto_trs = (isset($_POST["inx_delivry_oto_trs"])) ? 1 : 0;

        $ex_delivery_mn_trs = (isset($_POST["ex_deliverry_mn_trs"])) ? 1 : 0;
        $ex_delivery_tb_trs = (isset($_POST["ex_deliverry_tb_trs"])) ? 1 : 0;
        $ex_delivery_ed_trs = (isset($_POST["ex_deliverry_ed_trs"])) ? 1 : 0;
        $ex_delivery_del_trs = (isset($_POST["ex_deliverry_del_trs"])) ? 1 : 0;
        $ex_delivery_oto_trs = (isset($_POST["ex_deliverry_oto_trs"])) ? 1 : 0;

        $deposit_mn_trs = (isset($_POST["deposit_mn_trs"])) ? 1 : 0;
        $deposit_tb_trs = (isset($_POST["deposit_tb_trs"])) ? 1 : 0;
        $deposit_ed_trs = (isset($_POST["deposit_ed_trs"])) ? 1 : 0;
        $deposit_del_trs = (isset($_POST["deposit_del_trs"])) ? 1 : 0;
        $deposit_oto_trs = (isset($_POST["deposit_oto_trs"])) ? 1 : 0;

        $pembelian_order_mn_trs = (isset($_POST["orderpembelian_mn_trs"])) ? 1 : 0;
        $pembelian_order_tb_trs = (isset($_POST["orderpembelian_tb_trs"])) ? 1 : 0;
        $pembelian_order_ed_trs = (isset($_POST["orderpembelian_ed_trs"])) ? 1 : 0;
        $pembelian_order_del_trs = (isset($_POST["orderpembelian_del_trs"])) ? 1 : 0;
        $pembelian_order_oto_trs = (isset($_POST["orderpembelian_oto_trs"])) ? 1 : 0;

        $piutang_mn_trs = (isset($_POST["piutang_mn_trs"])) ? 1 : 0;
        $piutang_tb_trs = (isset($_POST["piutang_tb_trs"])) ? 1 : 0;
        $piutang_ed_trs = (isset($_POST["piutang_ed_trs"])) ? 1 : 0;
        $piutang_del_trs = (isset($_POST["piutang_del_trs"])) ? 1 : 0;
        $piutang_oto_trs = (isset($_POST["piutang_oto_trs"])) ? 1 : 0;
  
        $pembelian_persediaan_mn_trs = (isset($_POST["pembelianpersediaan_mn_trs"])) ? 1 : 0;
        $pembelian_persediaan_tb_trs = (isset($_POST["pembelianpersediaan_tb_trs"])) ? 1 : 0;
        $pembelian_persediaan_ed_trs = (isset($_POST["pembelianpersediaan_ed_trs"])) ? 1 : 0;
        $pembelian_persediaan_del_trs = (isset($_POST["pembelianpersediaan_del_trs"])) ? 1 : 0;
        $pembelian_persediaan_oto_trs = (isset($_POST["pembelianpersediaan_oto_trs"])) ? 1 : 0;

        $pembelian_retur_mn_trs = (isset($_POST["returpembelian_mn_trs"])) ? 1 : 0;
        $pembelian_retur_tb_trs = (isset($_POST["returpembelian_tb_trs"])) ? 1 : 0;
        $pembelian_retur_ed_trs = (isset($_POST["returpembelian_ed_trs"])) ? 1 : 0;
        $pembelian_retur_del_trs = (isset($_POST["returpembelian_del_trs"])) ? 1 : 0;
        $pembelian_retur_oto_trs = (isset($_POST["returpembelian_oto_trs"])) ? 1 : 0;

        $penjualan_mn_trs = (isset($_POST["penjuaalan_mn_trs"])) ? 1 : 0;
        $penjualan_tb_trs = (isset($_POST["penjuaalan_tb_trs"])) ? 1 : 0;
        $penjualan_ed_trs = (isset($_POST["penjuaalan_ed_trs"])) ? 1 : 0;
        $penjualan_del_trs = (isset($_POST["penjuaalan_del_trs"])) ? 1 : 0;
        $penjualan_oto_trs = (isset($_POST["penjuaalan_oto_trs"])) ? 1 : 0;

        $penjualan_retur_mn_trs = (isset($_POST["penjualanretur_mn_trs"])) ? 1 : 0;
        $penjualan_retur_tb_trs = (isset($_POST["penjualanretur_tb_trs"])) ? 1 : 0;
        $penjualan_retur_ed_trs = (isset($_POST["penjualanretur_ed_trs"])) ? 1 : 0;
        $penjualan_retur_del_trs = (isset($_POST["penjualanretur_del_trs"])) ? 1 : 0;
        $penjualan_retur_oto_trs = (isset($_POST["penjualanretur_oto_trs"])) ? 1 : 0;

        $penjualan_managemen_mn_trs = (isset($_POST["orderpenjualan_mn_trs"])) ? 1 : 0;
        $penjualan_managemen_tb_trs = (isset($_POST["orderpenjualan_tb_trs"])) ? 1 : 0;
        $penjualan_managemen_ed_trs = (isset($_POST["orderpenjualan_ed_trs"])) ? 1 : 0;
        $penjualan_managemen_del_trs = (isset($_POST["orderpenjualan_del_trs"])) ? 1 : 0;
        $penjualan_managemen_oto_trs = (isset($_POST["orderpenjualan_oto_trs"])) ? 1 : 0;
 
        $akses_menu_mn_dm = (isset($_POST["aksesmenu_mn_dm"])) ? 1 : 0; 
        $akses_menu_ed_dm = (isset($_POST["aksesmenu_ed_dm"])) ? 1 : 0; 

        $akses_password_mn_dm = (isset($_POST["aksespass_mn_dm"])) ? 1 : 0; 
        $akses_password_ed_dm = (isset($_POST["aksespass_ed_dm"])) ? 1 : 0; 

        $restoredatabase_mn_dm = (isset($_POST["restoredatabase_mn_dm"])) ? 1 : 0;

        $backupdatabase_mn_dm = (isset($_POST["backupdatabase_mn_dm"])) ? 1 : 0;

        $profile_mn_dm = (isset($_POST["profile_mn_dm"])) ? 1 : 0;

        $log_mn_dm = (isset($_POST["lqoxg_mn_dm"])) ? 1 : 0;

		
        $lap_pembelian_ringkasan_mn_lap = (isset($_POST["pembeliannringkasan_mn_lap"])) ? 1 : 0;
        $lap_pembelian_ringkasan_tb_lap = (isset($_POST["pembeliannringkasan_tb_lap"])) ? 1 : 0;
        $lap_pembelian_ringkasan_ed_lap = (isset($_POST["pembeliannringkasan_ed_lap"])) ? 1 : 0;
        $lap_pembelian_ringkasan_del_lap = (isset($_POST["pembeliannringkasan_del_lap"])) ? 1 : 0;
        $lap_pembelian_ringkasan_oto_lap = (isset($_POST["pembeliannringkasan_oto_lap"])) ? 1 : 0;
  
        $lap_pembelian_rincian_mn_lap = (isset($_POST["pembelxianrincian_mn_lap"])) ? 1 : 0;
        $lap_pembelian_rincian_tb_lap = (isset($_POST["pembelxianrincian_tb_lap"])) ? 1 : 0;
        $lap_pembelian_rincian_ed_lap = (isset($_POST["pembelxianrincian_ed_lap"])) ? 1 : 0;
        $lap_pembelian_rincian_del_lap = (isset($_POST["pembelxianrincian_del_lap"])) ? 1 : 0;
        $lap_pembelian_rincian_oto_lap = (isset($_POST["pembelxianrincian_oto_lap"])) ? 1 : 0;
  
        $lap_pembelian_order_mn_lap = (isset($_POST["pembeliyanorxder_mn_lap"])) ? 1 : 0;
        $lap_pembelian_order_tb_lap = (isset($_POST["pembeliyanorxder_tb_lap"])) ? 1 : 0;
        $lap_pembelian_order_ed_lap = (isset($_POST["pembeliyanorxder_ed_lap"])) ? 1 : 0;
        $lap_pembelian_order_del_lap = (isset($_POST["pembeliyanorxder_del_lap"])) ? 1 : 0;
        $lap_pembelian_order_oto_lap = (isset($_POST["pembeliyanorxder_oto_lap"])) ? 1 : 0;
  
        $lap_pembelian_komparasi_mn_lap = (isset($_POST["pembreliankxomparasi_mn_lap"])) ? 1 : 0;
        $lap_pembelian_komparasi_tb_lap = (isset($_POST["pembreliankxomparasi_tb_lap"])) ? 1 : 0;
        $lap_pembelian_komparasi_ed_lap = (isset($_POST["pembreliankxomparasi_ed_lap"])) ? 1 : 0;
        $lap_pembelian_komparasi_del_lap = (isset($_POST["pembreliankxomparasi_del_lap"])) ? 1 : 0;
        $lap_pembelian_komparasi_oto_lap = (isset($_POST["pembreliankxomparasi_oto_lap"])) ? 1 : 0;
  
        $lap_pembelian_per_produk_mn_lap = (isset($_POST["peqmbelian_peqr_produqk_mn_lap"])) ? 1 : 0;
        $lap_pembelian_per_produk_tb_lap = (isset($_POST["peqmbelian_peqr_produqk_tb_lap"])) ? 1 : 0;
        $lap_pembelian_per_produk_ed_lap = (isset($_POST["peqmbelian_peqr_produqk_ed_lap"])) ? 1 : 0;
        $lap_pembelian_per_produk_del_lap = (isset($_POST["peqmbelian_peqr_produqk_del_lap"])) ? 1 : 0;
        $lap_pembelian_per_produk_oto_lap = (isset($_POST["peqmbelian_peqr_produqk_oto_lap"])) ? 1 : 0;
  
        $lap_pembelian_per_pemasok_mn_lap = (isset($_POST["pembfelianpferpfemasok_mn_lap"])) ? 1 : 0;
        $lap_pembelian_per_pemasok_tb_lap = (isset($_POST["pembfelianpferpfemasok_tb_lap"])) ? 1 : 0;
        $lap_pembelian_per_pemasok_ed_lap = (isset($_POST["pembfelianpferpfemasok_ed_lap"])) ? 1 : 0;
        $lap_pembelian_per_pemasok_del_lap = (isset($_POST["pembfelianpferpfemasok_del_lap"])) ? 1 : 0;
        $lap_pembelian_per_pemasok_oto_lap = (isset($_POST["pembfelianpferpfemasok_oto_lap"])) ? 1 : 0;
  
        $lap_pembelian_disc_mn_lap = (isset($_POST["pwembelian_dwisc_mn_lap"])) ? 1 : 0;
        $lap_pembelian_disc_tb_lap = (isset($_POST["pwembelian_dwisc_tb_lap"])) ? 1 : 0;
        $lap_pembelian_disc_ed_lap = (isset($_POST["pwembelian_dwisc_ed_lap"])) ? 1 : 0;
        $lap_pembelian_disc_del_lap = (isset($_POST["pwembelian_dwisc_del_lap"])) ? 1 : 0;
        $lap_pembelian_disc_oto_lap = (isset($_POST["pwembelian_dwisc_oto_lap"])) ? 1 : 0;
  
        $lap_pembelian_retur_mn_lap = (isset($_POST["permbelianrertur_mn_lap"])) ? 1 : 0;
        $lap_pembelian_retur_tb_lap = (isset($_POST["permbelianrertur_tb_lap"])) ? 1 : 0;
        $lap_pembelian_retur_ed_lap = (isset($_POST["permbelianrertur_ed_lap"])) ? 1 : 0;
        $lap_pembelian_retur_del_lap = (isset($_POST["permbelianrertur_del_lap"])) ? 1 : 0;
        $lap_pembelian_retur_oto_lap = (isset($_POST["permbelianrertur_oto_lap"])) ? 1 : 0;
  
        $lap_penjualan_ringkasan_mn_lap = (isset($_POST["penjutalanringktasan_mn_lap"])) ? 1 : 0;
        $lap_penjualan_ringkasan_tb_lap = (isset($_POST["penjutalanringktasan_tb_lap"])) ? 1 : 0;
        $lap_penjualan_ringkasan_ed_lap = (isset($_POST["penjutalanringktasan_ed_lap"])) ? 1 : 0;
        $lap_penjualan_ringkasan_del_lap = (isset($_POST["penjutalanringktasan_del_lap"])) ? 1 : 0;
        $lap_penjualan_ringkasan_oto_lap = (isset($_POST["penjutalanringktasan_oto_lap"])) ? 1 : 0;
  
        $lap_penjualan_rincian_mn_lap = (isset($_POST["pdenjualanrindcian_mn_lap"])) ? 1 : 0;
        $lap_penjualan_rincian_tb_lap = (isset($_POST["pdenjualanrindcian_tb_lap"])) ? 1 : 0;
        $lap_penjualan_rincian_ed_lap = (isset($_POST["pdenjualanrindcian_ed_lap"])) ? 1 : 0;
        $lap_penjualan_rincian_del_lap = (isset($_POST["pdenjualanrindcian_del_lap"])) ? 1 : 0;
        $lap_penjualan_rincian_oto_lap = (isset($_POST["pdenjualanrindcian_oto_lap"])) ? 1 : 0;
  
        $lap_penjualan_nota_mn_lap = (isset($_POST["penjuyalannoyta_mn_lap"])) ? 1 : 0;
        $lap_penjualan_nota_tb_lap = (isset($_POST["penjuyalannoyta_tb_lap"])) ? 1 : 0;
        $lap_penjualan_nota_ed_lap = (isset($_POST["penjuyalannoyta_ed_lap"])) ? 1 : 0;
        $lap_penjualan_nota_del_lap = (isset($_POST["penjuyalannoyta_del_lap"])) ? 1 : 0;
        $lap_penjualan_nota_oto_lap = (isset($_POST["penjuyalannoyta_oto_lap"])) ? 1 : 0;
  
        $lap_penjualan_order_mn_lap = (isset($_POST["peinjualanorider_mn_lap"])) ? 1 : 0;
        $lap_penjualan_order_tb_lap = (isset($_POST["peinjualanorider_tb_lap"])) ? 1 : 0;
        $lap_penjualan_order_ed_lap = (isset($_POST["peinjualanorider_ed_lap"])) ? 1 : 0;
        $lap_penjualan_order_del_lap = (isset($_POST["peinjualanorider_del_lap"])) ? 1 : 0;
        $lap_penjualan_order_oto_lap = (isset($_POST["peinjualanorider_oto_lap"])) ? 1 : 0;
  
        $lap_penjualan_komparasi_mn_lap = (isset($_POST["penjuoalankompaorasi_mn_lap"])) ? 1 : 0;
        $lap_penjualan_komparasi_tb_lap = (isset($_POST["penjuoalankompaorasi_tb_lap"])) ? 1 : 0;
        $lap_penjualan_komparasi_ed_lap = (isset($_POST["penjuoalankompaorasi_ed_lap"])) ? 1 : 0;
        $lap_penjualan_komparasi_del_lap = (isset($_POST["penjuoalankompaorasi_del_lap"])) ? 1 : 0;
        $lap_penjualan_komparasi_oto_lap = (isset($_POST["penjuoalankompaorasi_oto_lap"])) ? 1 : 0;
  
        $lap_penjualan_per_produk_mn_lap = (isset($_POST["penjudalanpedrprodduk_mn_lap"])) ? 1 : 0;
        $lap_penjualan_per_produk_tb_lap = (isset($_POST["penjudalanpedrprodduk_tb_lap"])) ? 1 : 0;
        $lap_penjualan_per_produk_ed_lap = (isset($_POST["penjudalanpedrprodduk_ed_lap"])) ? 1 : 0;
        $lap_penjualan_per_produk_del_lap = (isset($_POST["penjudalanpedrprodduk_del_lap"])) ? 1 : 0;
        $lap_penjualan_per_produk_oto_lap = (isset($_POST["penjudalanpedrprodduk_oto_lap"])) ? 1 : 0;
  
        $lap_penjualan_per_pelanggan_mn_lap = (isset($_POST["pefnjufalanpferpelafnggan_mn_lap"])) ? 1 : 0;
        $lap_penjualan_per_pelanggan_tb_lap = (isset($_POST["pefnjufalanpferpelafnggan_tb_lap"])) ? 1 : 0;
        $lap_penjualan_per_pelanggan_ed_lap = (isset($_POST["pefnjufalanpferpelafnggan_ed_lap"])) ? 1 : 0;
        $lap_penjualan_per_pelanggan_del_lap = (isset($_POST["pefnjufalanpferpelafnggan_del_lap"])) ? 1 : 0;
        $lap_penjualan_per_pelanggan_oto_lap = (isset($_POST["pefnjufalanpferpelafnggan_oto_lap"])) ? 1 : 0;
  
        $lap_penjualan_komparasi_mn_lap = (isset($_POST["penjuoalankompaorasi_mn_lap"])) ? 1 : 0;
        $lap_penjualan_komparasi_tb_lap = (isset($_POST["penjuoalankompaorasi_tb_lap"])) ? 1 : 0;
        $lap_penjualan_komparasi_ed_lap = (isset($_POST["penjuoalankompaorasi_ed_lap"])) ? 1 : 0;
        $lap_penjualan_komparasi_del_lap = (isset($_POST["penjuoalankompaorasi_del_lap"])) ? 1 : 0;
        $lap_penjualan_komparasi_oto_lap = (isset($_POST["penjuoalankompaorasi_oto_lap"])) ? 1 : 0;
  
        $lap_penjualan_per_produk_mn_lap = (isset($_POST["penjudalanpedrprodduk_mn_lap"])) ? 1 : 0;
        $lap_penjualan_per_produk_tb_lap = (isset($_POST["penjudalanpedrprodduk_tb_lap"])) ? 1 : 0;
        $lap_penjualan_per_produk_ed_lap = (isset($_POST["penjudalanpedrprodduk_ed_lap"])) ? 1 : 0;
        $lap_penjualan_per_produk_del_lap = (isset($_POST["penjudalanpedrprodduk_del_lap"])) ? 1 : 0;
        $lap_penjualan_per_produk_oto_lap = (isset($_POST["penjudalanpedrprodduk_oto_lap"])) ? 1 : 0;
  
        $lap_penjualan_per_pelanggan_mn_lap = (isset($_POST["pefnjufalanpferpelafnggan_mn_lap"])) ? 1 : 0;
        $lap_penjualan_per_pelanggan_tb_lap = (isset($_POST["pefnjufalanpferpelafnggan_tb_lap"])) ? 1 : 0;
        $lap_penjualan_per_pelanggan_ed_lap = (isset($_POST["pefnjufalanpferpelafnggan_ed_lap"])) ? 1 : 0;
        $lap_penjualan_per_pelanggan_del_lap = (isset($_POST["pefnjufalanpferpelafnggan_del_lap"])) ? 1 : 0;
        $lap_penjualan_per_pelanggan_oto_lap = (isset($_POST["pefnjufalanpferpelafnggan_oto_lap"])) ? 1 : 0;
  
        $lap_penjualan_harga_mn_lap = (isset($_POST["pgenjualanhagrga_mn_lap"])) ? 1 : 0;
        $lap_penjualan_harga_tb_lap = (isset($_POST["pgenjualanhagrga_tb_lap"])) ? 1 : 0;
        $lap_penjualan_harga_ed_lap = (isset($_POST["pgenjualanhagrga_ed_lap"])) ? 1 : 0;
        $lap_penjualan_harga_del_lap = (isset($_POST["pgenjualanhagrga_del_lap"])) ? 1 : 0;
        $lap_penjualan_harga_oto_lap = (isset($_POST["pgenjualanhagrga_oto_lap"])) ? 1 : 0;
  
        $lap_penjualan_giro_mn_lap = (isset($_POST["phenjualanghiro_mn_lap"])) ? 1 : 0;
        $lap_penjualan_giro_tb_lap = (isset($_POST["phenjualanghiro_tb_lap"])) ? 1 : 0;
        $lap_penjualan_giro_ed_lap = (isset($_POST["phenjualanghiro_ed_lap"])) ? 1 : 0;
        $lap_penjualan_giro_del_lap = (isset($_POST["phenjualanghiro_del_lap"])) ? 1 : 0;
        $lap_penjualan_giro_oto_lap = (isset($_POST["phenjualanghiro_oto_lap"])) ? 1 : 0;
  
        $lap_penjualan_disc_mn_lap = (isset($_POST["pjenjualandjisc_mn_lap"])) ? 1 : 0;
        $lap_penjualan_disc_tb_lap = (isset($_POST["pjenjualandjisc_tb_lap"])) ? 1 : 0;
        $lap_penjualan_disc_ed_lap = (isset($_POST["pjenjualandjisc_ed_lap"])) ? 1 : 0;
        $lap_penjualan_disc_del_lap = (isset($_POST["pjenjualandjisc_del_lap"])) ? 1 : 0;
        $lap_penjualan_disc_oto_lap = (isset($_POST["pjenjualandjisc_oto_lap"])) ? 1 : 0;
  
        $lap_penjualan_retur_mn_lap = (isset($_POST["pkenjualanrketur_mn_lap"])) ? 1 : 0;
        $lap_penjualan_retur_tb_lap = (isset($_POST["pkenjualanrketur_tb_lap"])) ? 1 : 0;
        $lap_penjualan_retur_ed_lap = (isset($_POST["pkenjualanrketur_ed_lap"])) ? 1 : 0;
        $lap_penjualan_retur_del_lap = (isset($_POST["pkenjualanrketur_del_lap"])) ? 1 : 0;
        $lap_penjualan_retur_oto_lap = (isset($_POST["pkenjualanrketur_oto_lap"])) ? 1 : 0;
  
        $lap_penjualan_margin_barang_mn_lap = (isset($_POST["plenjualanmlarginblarang_mn_lap"])) ? 1 : 0;
        $lap_penjualan_margin_barang_tb_lap = (isset($_POST["plenjualanmlarginblarang_tb_lap"])) ? 1 : 0;
        $lap_penjualan_margin_barang_ed_lap = (isset($_POST["plenjualanmlarginblarang_ed_lap"])) ? 1 : 0;
        $lap_penjualan_margin_barang_del_lap = (isset($_POST["plenjualanmlarginblarang_del_lap"])) ? 1 : 0;
        $lap_penjualan_margin_barang_oto_lap = (isset($_POST["plenjualanmlarginblarang_oto_lap"])) ? 1 : 0;
  
        $lap_penjualan_margin_penjualan_mn_lap = (isset($_POST["pzenjualanmzarginpeznjualan_mn_lap"])) ? 1 : 0;
        $lap_penjualan_margin_penjualan_tb_lap = (isset($_POST["pzenjualanmzarginpeznjualan_tb_lap"])) ? 1 : 0;
        $lap_penjualan_margin_penjualan_ed_lap = (isset($_POST["pzenjualanmzarginpeznjualan_ed_lap"])) ? 1 : 0;
        $lap_penjualan_margin_penjualan_del_lap = (isset($_POST["pzenjualanmzarginpeznjualan_del_lap"])) ? 1 : 0;
        $lap_penjualan_margin_penjualan_oto_lap = (isset($_POST["pzenjualanmzarginpeznjualan_oto_lap"])) ? 1 : 0;
  
        $lap_produk_mn_lap = (isset($_POST["prqoduqk_mn_lap"])) ? 1 : 0;
        $lap_produk_tb_lap = (isset($_POST["prqoduqk_tb_lap"])) ? 1 : 0;
        $lap_produk_ed_lap = (isset($_POST["prqoduqk_ed_lap"])) ? 1 : 0;
        $lap_produk_del_lap = (isset($_POST["prqoduqk_del_lap"])) ? 1 : 0;
        $lap_produk_oto_lap = (isset($_POST["prqoduqk_oto_lap"])) ? 1 : 0;
  
        $lap_harga_beli_mn_lap = (isset($_POST["hwargabewli_mn_lap"])) ? 1 : 0;
        $lap_harga_beli_tb_lap = (isset($_POST["hwargabewli_tb_lap"])) ? 1 : 0;
        $lap_harga_beli_ed_lap = (isset($_POST["hwargabewli_ed_lap"])) ? 1 : 0;
        $lap_harga_beli_del_lap = (isset($_POST["hwargabewli_del_lap"])) ? 1 : 0;
        $lap_harga_beli_oto_lap = (isset($_POST["hwargabewli_oto_lap"])) ? 1 : 0;
  
        $lap_harga_jual_mn_lap = (isset($_POST["haergajueal_mn_lap"])) ? 1 : 0;
        $lap_harga_jual_tb_lap = (isset($_POST["haergajueal_tb_lap"])) ? 1 : 0;
        $lap_harga_jual_ed_lap = (isset($_POST["haergajueal_ed_lap"])) ? 1 : 0;
        $lap_harga_jual_del_lap = (isset($_POST["haergajueal_del_lap"])) ? 1 : 0;
        $lap_harga_jual_oto_lap = (isset($_POST["haergajueal_oto_lap"])) ? 1 : 0;
  
        $lap_stok_mn_lap = (isset($_POST["qswtok_mn_lap"])) ? 1 : 0;
        $lap_stok_tb_lap = (isset($_POST["qswtok_tb_lap"])) ? 1 : 0;
        $lap_stok_ed_lap = (isset($_POST["qswtok_ed_lap"])) ? 1 : 0;
        $lap_stok_del_lap = (isset($_POST["qswtok_del_lap"])) ? 1 : 0;
        $lap_stok_oto_lap = (isset($_POST["qswtok_oto_lap"])) ? 1 : 0;
  
        $lap_history_piutang_mn_lap = (isset($_POST["histforypiutfang_mn_lap"])) ? 1 : 0;
        $lap_history_piutang_tb_lap = (isset($_POST["histforypiutfang_tb_lap"])) ? 1 : 0;
        $lap_history_piutang_ed_lap = (isset($_POST["histforypiutfang_ed_lap"])) ? 1 : 0;
        $lap_history_piutang_del_lap = (isset($_POST["histforypiutfang_del_lap"])) ? 1 : 0;
        $lap_history_piutang_oto_lap = (isset($_POST["histforypiutfang_oto_lap"])) ? 1 : 0;
  
        $lap_penerimaan_piutang_mn_lap = (isset($_POST["penqerimaanpiuqtang_mn_lap"])) ? 1 : 0;
        $lap_penerimaan_piutang_tb_lap = (isset($_POST["penqerimaanpiuqtang_tb_lap"])) ? 1 : 0;
        $lap_penerimaan_piutang_ed_lap = (isset($_POST["penqerimaanpiuqtang_ed_lap"])) ? 1 : 0;
        $lap_penerimaan_piutang_del_lap = (isset($_POST["penqerimaanpiuqtang_del_lap"])) ? 1 : 0;
        $lap_penerimaan_piutang_oto_lap = (isset($_POST["penqerimaanpiuqtang_oto_lap"])) ? 1 : 0;
  
        $lap_hutang_ringkas_mn_lap = (isset($_POST["huetangriengkas_mn_lap"])) ? 1 : 0;
        $lap_hutang_ringkas_tb_lap = (isset($_POST["huetangriengkas_tb_lap"])) ? 1 : 0;
        $lap_hutang_ringkas_ed_lap = (isset($_POST["huetangriengkas_ed_lap"])) ? 1 : 0;
        $lap_hutang_ringkas_del_lap = (isset($_POST["huetangriengkas_del_lap"])) ? 1 : 0;
        $lap_hutang_ringkas_oto_lap = (isset($_POST["huetangriengkas_oto_lap"])) ? 1 : 0;
  
        $lap_piutang_ringkas_mn_lap = (isset($_POST["piurtangrinrgkas_mn_lap"])) ? 1 : 0;
        $lap_piutang_ringkas_tb_lap = (isset($_POST["piurtangrinrgkas_tb_lap"])) ? 1 : 0;
        $lap_piutang_ringkas_ed_lap = (isset($_POST["piurtangrinrgkas_ed_lap"])) ? 1 : 0;
        $lap_piutang_ringkas_del_lap = (isset($_POST["piurtangrinrgkas_del_lap"])) ? 1 : 0;
        $lap_piutang_ringkas_oto_lap = (isset($_POST["piurtangrinrgkas_oto_lap"])) ? 1 : 0;
  
        $lap_hutang_rinci_mn_lap = (isset($_POST["huttangritnci_mn_lap"])) ? 1 : 0;
        $lap_hutang_rinci_tb_lap = (isset($_POST["huttangritnci_tb_lap"])) ? 1 : 0;
        $lap_hutang_rinci_ed_lap = (isset($_POST["huttangritnci_ed_lap"])) ? 1 : 0;
        $lap_hutang_rinci_del_lap = (isset($_POST["huttangritnci_del_lap"])) ? 1 : 0;
        $lap_hutang_rinci_oto_lap = (isset($_POST["huttangritnci_oto_lap"])) ? 1 : 0;
  
        $lap_piutang_rinci_mn_lap = (isset($_POST["piyutangriynci_mn_lap"])) ? 1 : 0;
        $lap_piutang_rinci_tb_lap = (isset($_POST["piyutangriynci_tb_lap"])) ? 1 : 0;
        $lap_piutang_rinci_ed_lap = (isset($_POST["piyutangriynci_ed_lap"])) ? 1 : 0;
        $lap_piutang_rinci_del_lap = (isset($_POST["piyutangriynci_del_lap"])) ? 1 : 0;
        $lap_piutang_rinci_oto_lap = (isset($_POST["piyutangriynci_oto_lap"])) ? 1 : 0;
  
        $lap_piutang_jt_mn_lap = (isset($_POST["piiutangjit_mn_lap"])) ? 1 : 0;
        $lap_piutang_jt_tb_lap = (isset($_POST["piiutangjit_tb_lap"])) ? 1 : 0;
        $lap_piutang_jt_ed_lap = (isset($_POST["piiutangjit_ed_lap"])) ? 1 : 0;
        $lap_piutang_jt_del_lap = (isset($_POST["piiutangjit_del_lap"])) ? 1 : 0;
        $lap_piutang_jt_oto_lap = (isset($_POST["piiutangjit_oto_lap"])) ? 1 : 0;
  
        $lap_piutang_pelanggan_saldo_mn_lap = (isset($_POST["pioutangpeolanggansaoldo_mn_lap"])) ? 1 : 0;
        $lap_piutang_pelanggan_saldo_tb_lap = (isset($_POST["pioutangpeolanggansaoldo_tb_lap"])) ? 1 : 0;
        $lap_piutang_pelanggan_saldo_ed_lap = (isset($_POST["pioutangpeolanggansaoldo_ed_lap"])) ? 1 : 0;
        $lap_piutang_pelanggan_saldo_del_lap = (isset($_POST["pioutangpeolanggansaoldo_del_lap"])) ? 1 : 0;
        $lap_piutang_pelanggan_saldo_oto_lap = (isset($_POST["pioutangpeolanggansaoldo_oto_lap"])) ? 1 : 0;
  
        $lap_hutang_jt_mn_lap = (isset($_POST["huptangjpt_mn_lap"])) ? 1 : 0;
        $lap_hutang_jt_tb_lap = (isset($_POST["huptangjpt_tb_lap"])) ? 1 : 0;
        $lap_hutang_jt_ed_lap = (isset($_POST["huptangjpt_ed_lap"])) ? 1 : 0;
        $lap_hutang_jt_del_lap = (isset($_POST["huptangjpt_del_lap"])) ? 1 : 0;
        $lap_hutang_jt_oto_lap = (isset($_POST["huptangjpt_oto_lap"])) ? 1 : 0;
  
        $lap_hutang_pemasok_saldo_mn_lap = (isset($_POST["huatangpeamasoksaaldo_mn_lap"])) ? 1 : 0;
        $lap_hutang_pemasok_saldo_tb_lap = (isset($_POST["huatangpeamasoksaaldo_tb_lap"])) ? 1 : 0;
        $lap_hutang_pemasok_saldo_ed_lap = (isset($_POST["huatangpeamasoksaaldo_ed_lap"])) ? 1 : 0;
        $lap_hutang_pemasok_saldo_del_lap = (isset($_POST["huatangpeamasoksaaldo_del_lap"])) ? 1 : 0;
        $lap_hutang_pemasok_saldo_oto_lap = (isset($_POST["huatangpeamasoksaaldo_oto_lap"])) ? 1 : 0;
  
        $lap_persediaan_mn_lap = (isset($_POST["pqerssediaan_mn_lap"])) ? 1 : 0;
        $lap_persediaan_tb_lap = (isset($_POST["pqerssediaan_tb_lap"])) ? 1 : 0;
        $lap_persediaan_ed_lap = (isset($_POST["pqerssediaan_ed_lap"])) ? 1 : 0;
        $lap_persediaan_del_lap = (isset($_POST["pqerssediaan_del_lap"])) ? 1 : 0;
        $lap_persediaan_oto_lap = (isset($_POST["pqerssediaan_oto_lap"])) ? 1 : 0;
  
        $lap_barang_masuk_gudang_mn_lap = (isset($_POST["badrangmadsukguddang_mn_lap"])) ? 1 : 0;
        $lap_barang_masuk_gudang_tb_lap = (isset($_POST["badrangmadsukguddang_tb_lap"])) ? 1 : 0;
        $lap_barang_masuk_gudang_ed_lap = (isset($_POST["badrangmadsukguddang_ed_lap"])) ? 1 : 0;
        $lap_barang_masuk_gudang_del_lap = (isset($_POST["badrangmadsukguddang_del_lap"])) ? 1 : 0;
        $lap_barang_masuk_gudang_oto_lap = (isset($_POST["badrangmadsukguddang_oto_lap"])) ? 1 : 0;
  
        $lap_mutasi_mn_lap = (isset($_POST["mquftasi_mn_lap"])) ? 1 : 0;
        $lap_mutasi_tb_lap = (isset($_POST["mquftasi_tb_lap"])) ? 1 : 0;
        $lap_mutasi_ed_lap = (isset($_POST["mquftasi_ed_lap"])) ? 1 : 0;
        $lap_mutasi_del_lap = (isset($_POST["mquftasi_del_lap"])) ? 1 : 0;
        $lap_mutasi_oto_lap = (isset($_POST["mquftasi_oto_lap"])) ? 1 : 0;
  
        $lap_produk_gabungan_mn_lap = (isset($_POST["pqrqoduqkgafbungan_mn_lap"])) ? 1 : 0;
        $lap_produk_gabungan_tb_lap = (isset($_POST["pqrqoduqkgafbungan_tb_lap"])) ? 1 : 0;
        $lap_produk_gabungan_ed_lap = (isset($_POST["pqrqoduqkgafbungan_ed_lap"])) ? 1 : 0;
        $lap_produk_gabungan_del_lap = (isset($_POST["pqrqoduqkgafbungan_del_lap"])) ? 1 : 0;
        $lap_produk_gabungan_oto_lap = (isset($_POST["pqrqoduqkgafbungan_oto_lap"])) ? 1 : 0;
  
        $lap_kuantitas_mn_lap = (isset($_POST["kquhantitas_mn_lap"])) ? 1 : 0;
        $lap_kuantitas_tb_lap = (isset($_POST["kquhantitas_tb_lap"])) ? 1 : 0;
        $lap_kuantitas_ed_lap = (isset($_POST["kquhantitas_ed_lap"])) ? 1 : 0;
        $lap_kuantitas_del_lap = (isset($_POST["kquhantitas_del_lap"])) ? 1 : 0;
        $lap_kuantitas_oto_lap = (isset($_POST["kquhantitas_oto_lap"])) ? 1 : 0;
  
        $lap_batas_kuantitas_mn_lap = (isset($_POST["bajtaskuajntitas_mn_lap"])) ? 1 : 0;
        $lap_batas_kuantitas_tb_lap = (isset($_POST["bajtaskuajntitas_tb_lap"])) ? 1 : 0;
        $lap_batas_kuantitas_ed_lap = (isset($_POST["bajtaskuajntitas_ed_lap"])) ? 1 : 0;
        $lap_batas_kuantitas_del_lap = (isset($_POST["bajtaskuajntitas_del_lap"])) ? 1 : 0;
        $lap_batas_kuantitas_oto_lap = (isset($_POST["bajtaskuajntitas_oto_lap"])) ? 1 : 0;
  
        $lap_penyesuaian_mn_lap = (isset($_POST["penkyeskuaian_mn_lap"])) ? 1 : 0;
        $lap_penyesuaian_tb_lap = (isset($_POST["penkyeskuaian_tb_lap"])) ? 1 : 0;
        $lap_penyesuaian_ed_lap = (isset($_POST["penkyeskuaian_ed_lap"])) ? 1 : 0;
        $lap_penyesuaian_del_lap = (isset($_POST["penkyeskuaian_del_lap"])) ? 1 : 0;
        $lap_penyesuaian_oto_lap = (isset($_POST["penkyeskuaian_oto_lap"])) ? 1 : 0;
  
        $lap_mutasi_per_produk_mn_lap = (isset($_POST["mwquftasplerprolduk_mn_lap"])) ? 1 : 0;
        $lap_mutasi_per_produk_tb_lap = (isset($_POST["mwquftasplerprolduk_tb_lap"])) ? 1 : 0;
        $lap_mutasi_per_produk_ed_lap = (isset($_POST["mwquftasplerprolduk_ed_lap"])) ? 1 : 0;
        $lap_mutasi_per_produk_del_lap = (isset($_POST["mwquftasplerprolduk_del_lap"])) ? 1 : 0;
        $lap_mutasi_per_produk_oto_lap = (isset($_POST["mwquftasplerprolduk_oto_lap"])) ? 1 : 0;
  
        $lap_saldo_awal_persediaan_mn_lap = (isset($_POST["sazldoawzalpezrsediaan_mn_lap"])) ? 1 : 0;
        $lap_saldo_awal_persediaan_tb_lap = (isset($_POST["sazldoawzalpezrsediaan_tb_lap"])) ? 1 : 0;
        $lap_saldo_awal_persediaan_ed_lap = (isset($_POST["sazldoawzalpezrsediaan_ed_lap"])) ? 1 : 0;
        $lap_saldo_awal_persediaan_del_lap = (isset($_POST["sazldoawzalpezrsediaan_del_lap"])) ? 1 : 0;
        $lap_saldo_awal_persediaan_oto_lap = (isset($_POST["sazldoawzalpezrsediaan_oto_lap"])) ? 1 : 0;
  
        $lap_saldo_persediaan_per_lokasi_mn_lap = (isset($_POST["saxldopexrsediaanpexrlokasi_mn_lap"])) ? 1 : 0;
        $lap_saldo_persediaan_per_lokasi_tb_lap = (isset($_POST["saxldopexrsediaanpexrlokasi_tb_lap"])) ? 1 : 0;
        $lap_saldo_persediaan_per_lokasi_ed_lap = (isset($_POST["saxldopexrsediaanpexrlokasi_ed_lap"])) ? 1 : 0;
        $lap_saldo_persediaan_per_lokasi_del_lap = (isset($_POST["saxldopexrsediaanpexrlokasi_del_lap"])) ? 1 : 0;
        $lap_saldo_persediaan_per_lokasi_oto_lap = (isset($_POST["saxldopexrsediaanpexrlokasi_oto_lap"])) ? 1 : 0;
  
        $lap_pelanggan_harga_mn_lap = (isset($_POST["peclangganhacrga_mn_lap"])) ? 1 : 0;
        $lap_pelanggan_harga_tb_lap = (isset($_POST["peclangganhacrga_tb_lap"])) ? 1 : 0;
        $lap_pelanggan_harga_ed_lap = (isset($_POST["peclangganhacrga_ed_lap"])) ? 1 : 0;
        $lap_pelanggan_harga_del_lap = (isset($_POST["peclangganhacrga_del_lap"])) ? 1 : 0;
        $lap_pelanggan_harga_oto_lap = (isset($_POST["peclangganhacrga_oto_lap"])) ? 1 : 0;
  
        $lap_barang_vendor_mn_lap = (isset($_POST["bavrangvevndor_mn_lap"])) ? 1 : 0;
        $lap_barang_vendor_tb_lap = (isset($_POST["bavrangvevndor_tb_lap"])) ? 1 : 0;
        $lap_barang_vendor_ed_lap = (isset($_POST["bavrangvevndor_ed_lap"])) ? 1 : 0;
        $lap_barang_vendor_del_lap = (isset($_POST["bavrangvevndor_del_lap"])) ? 1 : 0;
        $lap_barang_vendor_oto_lap = (isset($_POST["bavrangvevndor_oto_lap"])) ? 1 : 0;
  
        $lap_daftar_harga_mn_lap = (isset($_POST["dabftarhabrga_mn_lap"])) ? 1 : 0;
        $lap_daftar_harga_tb_lap = (isset($_POST["dabftarhabrga_tb_lap"])) ? 1 : 0;
        $lap_daftar_harga_ed_lap = (isset($_POST["dabftarhabrga_ed_lap"])) ? 1 : 0;
        $lap_daftar_harga_del_lap = (isset($_POST["dabftarhabrga_del_lap"])) ? 1 : 0;
        $lap_daftar_harga_oto_lap = (isset($_POST["dabftarhabrga_oto_lap"])) ? 1 : 0;
  
        $lap_saldo_persediaan_mn_lap = (isset($_POST["sanldopenrsediaan_mn_lap"])) ? 1 : 0;
        $lap_saldo_persediaan_tb_lap = (isset($_POST["sanldopenrsediaan_tb_lap"])) ? 1 : 0;
        $lap_saldo_persediaan_ed_lap = (isset($_POST["sanldopenrsediaan_ed_lap"])) ? 1 : 0;
        $lap_saldo_persediaan_del_lap = (isset($_POST["sanldopenrsediaan_del_lap"])) ? 1 : 0;
        $lap_saldo_persediaan_oto_lap = (isset($_POST["sanldopenrsediaan_oto_lap"])) ? 1 : 0;
  
        $lap_buku_stok_mn_lap = (isset($_POST["bumkustomk_mn_lap"])) ? 1 : 0;
        $lap_buku_stok_tb_lap = (isset($_POST["bumkustomk_tb_lap"])) ? 1 : 0;
        $lap_buku_stok_ed_lap = (isset($_POST["bumkustomk_ed_lap"])) ? 1 : 0;
        $lap_buku_stok_del_lap = (isset($_POST["bumkustomk_del_lap"])) ? 1 : 0;
        $lap_buku_stok_oto_lap = (isset($_POST["bumkustomk_oto_lap"])) ? 1 : 0;
   
        $lap_penerimaan_hutang_mn_lap = (isset($_POST["penwerimaanhutwang_mn_lap"])) ? 1 : 0;
        $lap_penerimaan_hutang_tb_lap = (isset($_POST["penwerimaanhutwang_tb_lap"])) ? 1 : 0;
        $lap_penerimaan_hutang_ed_lap = (isset($_POST["penwerimaanhutwang_ed_lap"])) ? 1 : 0;
        $lap_penerimaan_hutang_del_lap = (isset($_POST["penwerimaanhutwang_del_lap"])) ? 1 : 0;
        $lap_penerimaan_hutang_oto_lap = (isset($_POST["penwerimaanhutwang_oto_lap"])) ? 1 : 0;
  
        $lap_deposit_ringkas_mn_lap = (isset($_POST["depeositrinegkas_mn_lap"])) ? 1 : 0;
        $lap_deposit_ringkas_tb_lap = (isset($_POST["depeositrinegkas_tb_lap"])) ? 1 : 0;
        $lap_deposit_ringkas_ed_lap = (isset($_POST["depeositrinegkas_ed_lap"])) ? 1 : 0;
        $lap_deposit_ringkas_del_lap = (isset($_POST["depeositrinegkas_del_lap"])) ? 1 : 0;
        $lap_deposit_ringkas_oto_lap = (isset($_POST["depeositrinegkas_oto_lap"])) ? 1 : 0;
  
        $lap_deposit_rinci_mn_lap = (isset($_POST["deprositrirnci_mn_lap"])) ? 1 : 0;
        $lap_deposit_rinci_tb_lap = (isset($_POST["deprositrirnci_tb_lap"])) ? 1 : 0;
        $lap_deposit_rinci_ed_lap = (isset($_POST["deprositrirnci_ed_lap"])) ? 1 : 0;
        $lap_deposit_rinci_del_lap = (isset($_POST["deprositrirnci_del_lap"])) ? 1 : 0;
        $lap_deposit_rinci_oto_lap = (isset($_POST["deprositrirnci_oto_lap"])) ? 1 : 0;
  
        $lap_buku_besar_mn_lap = (isset($_POST["buktubestar_mn_lap"])) ? 1 : 0;
        $lap_buku_besar_tb_lap = (isset($_POST["buktubestar_tb_lap"])) ? 1 : 0;
        $lap_buku_besar_ed_lap = (isset($_POST["buktubestar_ed_lap"])) ? 1 : 0;
        $lap_buku_besar_del_lap = (isset($_POST["buktubestar_del_lap"])) ? 1 : 0;
        $lap_buku_besar_oto_lap = (isset($_POST["buktubestar_oto_lap"])) ? 1 : 0;
  
        $lap_kartu_persediaan_mn_lap = (isset($_POST["karytuperysediaan_mn_lap"])) ? 1 : 0;
        $lap_kartu_persediaan_tb_lap = (isset($_POST["karytuperysediaan_tb_lap"])) ? 1 : 0;
        $lap_kartu_persediaan_ed_lap = (isset($_POST["karytuperysediaan_ed_lap"])) ? 1 : 0;
        $lap_kartu_persediaan_del_lap = (isset($_POST["karytuperysediaan_del_lap"])) ? 1 : 0;
        $lap_kartu_persediaan_oto_lap = (isset($_POST["karytuperysediaan_oto_lap"])) ? 1 : 0;
  
        $lap_rincian_jual_beli_mn_lap = (isset($_POST["rinucianjuaulbelui_mn_lap"])) ? 1 : 0;
        $lap_rincian_jual_beli_tb_lap = (isset($_POST["rinucianjuaulbelui_tb_lap"])) ? 1 : 0;
        $lap_rincian_jual_beli_ed_lap = (isset($_POST["rinucianjuaulbelui_ed_lap"])) ? 1 : 0;
        $lap_rincian_jual_beli_del_lap = (isset($_POST["rinucianjuaulbelui_del_lap"])) ? 1 : 0;
        $lap_rincian_jual_beli_oto_lap = (isset($_POST["rinucianjuaulbelui_oto_lap"])) ? 1 : 0;
  
        $lap_neraca_mn_lap = (isset($_POST["nqeroaca_mn_lap"])) ? 1 : 0;
        $lap_neraca_tb_lap = (isset($_POST["nqeroaca_tb_lap"])) ? 1 : 0;
        $lap_neraca_ed_lap = (isset($_POST["nqeroaca_ed_lap"])) ? 1 : 0;
        $lap_neraca_del_lap = (isset($_POST["nqeroaca_del_lap"])) ? 1 : 0;
        $lap_neraca_oto_lap = (isset($_POST["nqeroaca_oto_lap"])) ? 1 : 0;
  
        $lap_laba_rugi_mn_lap = (isset($_POST["labaarugai_mn_lap"])) ? 1 : 0;
        $lap_laba_rugi_tb_lap = (isset($_POST["labaarugai_tb_lap"])) ? 1 : 0;
        $lap_laba_rugi_ed_lap = (isset($_POST["labaarugai_ed_lap"])) ? 1 : 0;
        $lap_laba_rugi_del_lap = (isset($_POST["labaarugai_del_lap"])) ? 1 : 0;
        $lap_laba_rugi_oto_lap = (isset($_POST["labaarugai_oto_lap"])) ? 1 : 0;
  
        $lap_ekuitas_mn_lap = (isset($_POST["eqkusitas_mn_lap"])) ? 1 : 0;
        $lap_ekuitas_tb_lap = (isset($_POST["eqkusitas_tb_lap"])) ? 1 : 0;
        $lap_ekuitas_ed_lap = (isset($_POST["eqkusitas_ed_lap"])) ? 1 : 0;
        $lap_ekuitas_del_lap = (isset($_POST["eqkusitas_del_lap"])) ? 1 : 0;
        $lap_ekuitas_oto_lap = (isset($_POST["eqkusitas_oto_lap"])) ? 1 : 0;
  
        $lap_saldo_awal_mn_lap = (isset($_POST["salddoawdal_mn_lap"])) ? 1 : 0;
        $lap_saldo_awal_tb_lap = (isset($_POST["salddoawdal_tb_lap"])) ? 1 : 0;
        $lap_saldo_awal_ed_lap = (isset($_POST["salddoawdal_ed_lap"])) ? 1 : 0;
        $lap_saldo_awal_del_lap = (isset($_POST["salddoawdal_del_lap"])) ? 1 : 0;
        $lap_saldo_awal_oto_lap = (isset($_POST["salddoawdal_oto_lap"])) ? 1 : 0;
  
        $lap_register_mn_lap = (isset($_POST["rqefgister_mn_lap"])) ? 1 : 0;
        $lap_register_tb_lap = (isset($_POST["rqefgister_tb_lap"])) ? 1 : 0;
        $lap_register_ed_lap = (isset($_POST["rqefgister_ed_lap"])) ? 1 : 0;
        $lap_register_del_lap = (isset($_POST["rqefgister_del_lap"])) ? 1 : 0;
        $lap_register_oto_lap = (isset($_POST["rqefgister_oto_lap"])) ? 1 : 0;
  
        $lap_kas_in_mn_lap = (isset($_POST["kqagsign_mn_lap"])) ? 1 : 0;
        $lap_kas_in_tb_lap = (isset($_POST["kqagsign_tb_lap"])) ? 1 : 0;
        $lap_kas_in_ed_lap = (isset($_POST["kqagsign_ed_lap"])) ? 1 : 0;
        $lap_kas_in_del_lap = (isset($_POST["kqagsign_del_lap"])) ? 1 : 0;
        $lap_kas_in_oto_lap = (isset($_POST["kqagsign_oto_lap"])) ? 1 : 0;
  
        $lap_kas_out_mn_lap = (isset($_POST["kqahsouht_mn_lap"])) ? 1 : 0;
        $lap_kas_out_tb_lap = (isset($_POST["kqahsouht_tb_lap"])) ? 1 : 0;
        $lap_kas_out_ed_lap = (isset($_POST["kqahsouht_ed_lap"])) ? 1 : 0;
        $lap_kas_out_del_lap = (isset($_POST["kqahsouht_del_lap"])) ? 1 : 0;
        $lap_kas_out_oto_lap = (isset($_POST["kqahsouht_oto_lap"])) ? 1 : 0;
  
        $lap_kas_mn_lap = (isset($_POST["qkajs_mn_lap"])) ? 1 : 0;
        $lap_kas_tb_lap = (isset($_POST["qkajs_tb_lap"])) ? 1 : 0;
        $lap_kas_ed_lap = (isset($_POST["qkajs_ed_lap"])) ? 1 : 0;
        $lap_kas_del_lap = (isset($_POST["qkajs_del_lap"])) ? 1 : 0;
        $lap_kas_oto_lap = (isset($_POST["qkajs_oto_lap"])) ? 1 : 0;
  
        $lap_relasi_pelanggan_mn_lap = (isset($_POST["relkaspelkanggan_mn_lap"])) ? 1 : 0;
        $lap_relasi_pelanggan_tb_lap = (isset($_POST["relkaspelkanggan_tb_lap"])) ? 1 : 0;
        $lap_relasi_pelanggan_ed_lap = (isset($_POST["relkaspelkanggan_ed_lap"])) ? 1 : 0;
        $lap_relasi_pelanggan_del_lap = (isset($_POST["relkaspelkanggan_del_lap"])) ? 1 : 0;
        $lap_relasi_pelanggan_oto_lap = (isset($_POST["relkaspelkanggan_oto_lap"])) ? 1 : 0;
  
        $lap_relasi_pemasok_mn_lap = (isset($_POST["rellasipemlasok_mn_lap"])) ? 1 : 0;
        $lap_relasi_pemasok_tb_lap = (isset($_POST["rellasipemlasok_tb_lap"])) ? 1 : 0;
        $lap_relasi_pemasok_ed_lap = (isset($_POST["rellasipemlasok_ed_lap"])) ? 1 : 0;
        $lap_relasi_pemasok_del_lap = (isset($_POST["rellasipemlasok_del_lap"])) ? 1 : 0;
        $lap_relasi_pemasok_oto_lap = (isset($_POST["rellasipemlasok_oto_lap"])) ? 1 : 0;
  
        $lap_input_akun_mn_lap = (isset($_POST["inpzutakuzn_mn_lap"])) ? 1 : 0;
        $lap_input_akun_tb_lap = (isset($_POST["inpzutakuzn_tb_lap"])) ? 1 : 0;
        $lap_input_akun_ed_lap = (isset($_POST["inpzutakuzn_ed_lap"])) ? 1 : 0;
        $lap_input_akun_del_lap = (isset($_POST["inpzutakuzn_del_lap"])) ? 1 : 0;
        $lap_input_akun_oto_lap = (isset($_POST["inpzutakuzn_oto_lap"])) ? 1 : 0;
  
        $lap_log_mn_lap = (isset($_POST["lqoxg_mn_lap"])) ? 1 : 0;
        $lap_log_tb_lap = (isset($_POST["lqoxg_tb_lap"])) ? 1 : 0;
        $lap_log_ed_lap = (isset($_POST["lqoxg_ed_lap"])) ? 1 : 0;
        $lap_log_del_lap = (isset($_POST["lqoxg_del_lap"])) ? 1 : 0;
        $lap_log_oto_lap = (isset($_POST["lqoxg_oto_lap"])) ? 1 : 0;
  
        $lap_analisi_proporsi_pembelian_mn_lap = (isset($_POST["anaclisiprocporspemcbelian_mn_lap"])) ? 1 : 0;
        $lap_analisi_proporsi_pembelian_tb_lap = (isset($_POST["anaclisiprocporspemcbelian_tb_lap"])) ? 1 : 0;
        $lap_analisi_proporsi_pembelian_ed_lap = (isset($_POST["anaclisiprocporspemcbelian_ed_lap"])) ? 1 : 0;
        $lap_analisi_proporsi_pembelian_del_lap = (isset($_POST["anaclisiprocporspemcbelian_del_lap"])) ? 1 : 0;
        $lap_analisi_proporsi_pembelian_oto_lap = (isset($_POST["anaclisiprocporspemcbelian_oto_lap"])) ? 1 : 0;
  
        $lap_analisis_ranking_pemasok_mn_lap = (isset($_POST["anavlisisravnkingpemvasok_mn_lap"])) ? 1 : 0;
        $lap_analisis_ranking_pemasok_tb_lap = (isset($_POST["anavlisisravnkingpemvasok_tb_lap"])) ? 1 : 0;
        $lap_analisis_ranking_pemasok_ed_lap = (isset($_POST["anavlisisravnkingpemvasok_ed_lap"])) ? 1 : 0;
        $lap_analisis_ranking_pemasok_del_lap = (isset($_POST["anavlisisravnkingpemvasok_del_lap"])) ? 1 : 0;
        $lap_analisis_ranking_pemasok_oto_lap = (isset($_POST["anavlisisravnkingpemvasok_oto_lap"])) ? 1 : 0;
  
        $lap_analisis_retur_pembelian_mn_lap = (isset($_POST["anablisisrebturpembbelian_mn_lap"])) ? 1 : 0;
        $lap_analisis_retur_pembelian_tb_lap = (isset($_POST["anablisisrebturpembbelian_tb_lap"])) ? 1 : 0;
        $lap_analisis_retur_pembelian_ed_lap = (isset($_POST["anablisisrebturpembbelian_ed_lap"])) ? 1 : 0;
        $lap_analisis_retur_pembelian_del_lap = (isset($_POST["anablisisrebturpembbelian_del_lap"])) ? 1 : 0;
        $lap_analisis_retur_pembelian_oto_lap = (isset($_POST["anablisisrebturpembbelian_oto_lap"])) ? 1 : 0;
  
        $lap_analisis_proporsi_penjualan_mn_lap = (isset($_POST["ananlisispronporsipennjualan_mn_lap"])) ? 1 : 0;
        $lap_analisis_proporsi_penjualan_tb_lap = (isset($_POST["ananlisispronporsipennjualan_tb_lap"])) ? 1 : 0;
        $lap_analisis_proporsi_penjualan_ed_lap = (isset($_POST["ananlisispronporsipennjualan_ed_lap"])) ? 1 : 0;
        $lap_analisis_proporsi_penjualan_del_lap = (isset($_POST["ananlisispronporsipennjualan_del_lap"])) ? 1 : 0;
        $lap_analisis_proporsi_penjualan_oto_lap = (isset($_POST["ananlisispronporsipennjualan_oto_lap"])) ? 1 : 0;
  
        $lap_analisis_ranking_pelanggan_mn_lap = (isset($_POST["anamlisisranmkingpelmanggan_mn_lap"])) ? 1 : 0;
        $lap_analisis_ranking_pelanggan_tb_lap = (isset($_POST["anamlisisranmkingpelmanggan_tb_lap"])) ? 1 : 0;
        $lap_analisis_ranking_pelanggan_ed_lap = (isset($_POST["anamlisisranmkingpelmanggan_ed_lap"])) ? 1 : 0;
        $lap_analisis_ranking_pelanggan_del_lap = (isset($_POST["anamlisisranmkingpelmanggan_del_lap"])) ? 1 : 0;
        $lap_analisis_ranking_pelanggan_oto_lap = (isset($_POST["anamlisisranmkingpelmanggan_oto_lap"])) ? 1 : 0;
  
        $lap_analisis_produk_terlaris_mn_lap = (isset($_POST["analqisisprodqukterlqaris_mn_lap"])) ? 1 : 0;
        $lap_analisis_produk_terlaris_tb_lap = (isset($_POST["analqisisprodqukterlqaris_tb_lap"])) ? 1 : 0;
        $lap_analisis_produk_terlaris_ed_lap = (isset($_POST["analqisisprodqukterlqaris_ed_lap"])) ? 1 : 0;
        $lap_analisis_produk_terlaris_del_lap = (isset($_POST["analqisisprodqukterlqaris_del_lap"])) ? 1 : 0;
        $lap_analisis_produk_terlaris_oto_lap = (isset($_POST["analqisisprodqukterlqaris_oto_lap"])) ? 1 : 0;
  
        $lap_analisis_retur_penjualan_mn_lap = (isset($_POST["anawlisisretwurpenjuwalan_mn_lap"])) ? 1 : 0;
        $lap_analisis_retur_penjualan_tb_lap = (isset($_POST["anawlisisretwurpenjuwalan_tb_lap"])) ? 1 : 0;
        $lap_analisis_retur_penjualan_ed_lap = (isset($_POST["anawlisisretwurpenjuwalan_ed_lap"])) ? 1 : 0;
        $lap_analisis_retur_penjualan_del_lap = (isset($_POST["anawlisisretwurpenjuwalan_del_lap"])) ? 1 : 0;
        $lap_analisis_retur_penjualan_oto_lap = (isset($_POST["anawlisisretwurpenjuwalan_oto_lap"])) ? 1 : 0;
  
        $lap_margin_penjualan_mn_lap = (isset($_POST["margeinpenjuealan_mn_lap"])) ? 1 : 0;
        $lap_margin_penjualan_tb_lap = (isset($_POST["margeinpenjuealan_tb_lap"])) ? 1 : 0;
        $lap_margin_penjualan_ed_lap = (isset($_POST["margeinpenjuealan_ed_lap"])) ? 1 : 0;
        $lap_margin_penjualan_del_lap = (isset($_POST["margeinpenjuealan_del_lap"])) ? 1 : 0;
        $lap_margin_penjualan_oto_lap = (isset($_POST["margeinpenjuealan_oto_lap"])) ? 1 : 0;
  
        $lap_analisis_perputaran_stok_mn_lap = (isset($_POST["analipsisperpuptaranstopk_mn_lap"])) ? 1 : 0;
        $lap_analisis_perputaran_stok_tb_lap = (isset($_POST["analipsisperpuptaranstopk_tb_lap"])) ? 1 : 0;
        $lap_analisis_perputaran_stok_ed_lap = (isset($_POST["analipsisperpuptaranstopk_ed_lap"])) ? 1 : 0;
        $lap_analisis_perputaran_stok_del_lap = (isset($_POST["analipsisperpuptaranstopk_del_lap"])) ? 1 : 0;
        $lap_analisis_perputaran_stok_oto_lap = (isset($_POST["analipsisperpuptaranstopk_oto_lap"])) ? 1 : 0;
  
        $lap_deviasi_produk_mn_lap = (isset($_POST["deqviaasiproaduk_mn_lap"])) ? 1 : 0;
        $lap_deviasi_produk_tb_lap = (isset($_POST["deqviaasiproaduk_tb_lap"])) ? 1 : 0;
        $lap_deviasi_produk_ed_lap = (isset($_POST["deqviaasiproaduk_ed_lap"])) ? 1 : 0;
        $lap_deviasi_produk_del_lap = (isset($_POST["deqviaasiproaduk_del_lap"])) ? 1 : 0;
        $lap_deviasi_produk_oto_lap = (isset($_POST["deqviaasiproaduk_oto_lap"])) ? 1 : 0;
  
        $lap_proporsi_stok_mn_lap = (isset($_POST["propsorsistosk_mn_lap"])) ? 1 : 0;
        $lap_proporsi_stok_tb_lap = (isset($_POST["propsorsistosk_tb_lap"])) ? 1 : 0;
        $lap_proporsi_stok_ed_lap = (isset($_POST["propsorsistosk_ed_lap"])) ? 1 : 0;
        $lap_proporsi_stok_del_lap = (isset($_POST["propsorsistosk_del_lap"])) ? 1 : 0;
        $lap_proporsi_stok_oto_lap = (isset($_POST["propsorsistosk_oto_lap"])) ? 1 : 0;
  
        $lap_history_hutang_mn_lap = (isset($_POST["histdoryhutadng_mn_lap"])) ? 1 : 0;
        $lap_history_hutang_tb_lap = (isset($_POST["histdoryhutadng_tb_lap"])) ? 1 : 0;
        $lap_history_hutang_ed_lap = (isset($_POST["histdoryhutadng_ed_lap"])) ? 1 : 0;
        $lap_history_hutang_del_lap = (isset($_POST["histdoryhutadng_del_lap"])) ? 1 : 0;
        $lap_history_hutang_oto_lap = (isset($_POST["histdoryhutadng_oto_lap"])) ? 1 : 0;
  
        $lap_history_lap_komparatif_laba_grafik_mn_lap = (isset($_POST["history_lap_komparatif_laba_grafik_mn_lap"])) ? 1 : 0;
        $lap_history_lap_komparatif_laba_grafik_tb_lap = (isset($_POST["history_lap_komparatif_laba_grafik_tb_lap"])) ? 1 : 0;
        $lap_history_lap_komparatif_laba_grafik_ed_lap = (isset($_POST["history_lap_komparatif_laba_grafik_ed_lap"])) ? 1 : 0;
        $lap_history_lap_komparatif_laba_grafik_del_lap = (isset($_POST["history_lap_komparatif_laba_grafik_del_lap"])) ? 1 : 0;
        $lap_history_lap_komparatif_laba_grafik_oto_lap = (isset($_POST["history_lap_komparatif_laba_grafik_oto_lap"])) ? 1 : 0;
  
        $lap_komparatif_laba_grafik_mn_lap = (isset($_POST["komgparatiflagbagragfik_mn_lap"])) ? 1 : 0;
        $lap_komparatif_laba_grafik_tb_lap = (isset($_POST["komgparatiflagbagragfik_tb_lap"])) ? 1 : 0;
        $lap_komparatif_laba_grafik_ed_lap = (isset($_POST["komgparatiflagbagragfik_ed_lap"])) ? 1 : 0;
        $lap_komparatif_laba_grafik_del_lap = (isset($_POST["komgparatiflagbagragfik_del_lap"])) ? 1 : 0;
        $lap_komparatif_laba_grafik_oto_lap = (isset($_POST["komgparatiflagbagragfik_oto_lap"])) ? 1 : 0;
  
        $lap_komparatif_laba_mn_lap = (isset($_POST["kompgaratiflabga_mn_lap"])) ? 1 : 0;
        $lap_komparatif_laba_tb_lap = (isset($_POST["kompgaratiflabga_tb_lap"])) ? 1 : 0;
        $lap_komparatif_laba_ed_lap = (isset($_POST["kompgaratiflabga_ed_lap"])) ? 1 : 0;
        $lap_komparatif_laba_del_lap = (isset($_POST["kompgaratiflabga_del_lap"])) ? 1 : 0;
        $lap_komparatif_laba_oto_lap = (isset($_POST["kompgaratiflabga_oto_lap"])) ? 1 : 0;
  
        $lap_komparatif_neraca_mn_lap = (isset($_POST["kompharatifnerhaca_mn_lap"])) ? 1 : 0;
        $lap_komparatif_neraca_tb_lap = (isset($_POST["kompharatifnerhaca_tb_lap"])) ? 1 : 0;
        $lap_komparatif_neraca_ed_lap = (isset($_POST["kompharatifnerhaca_ed_lap"])) ? 1 : 0;
        $lap_komparatif_neraca_del_lap = (isset($_POST["kompharatifnerhaca_del_lap"])) ? 1 : 0;
        $lap_komparatif_neraca_oto_lap = (isset($_POST["kompharatifnerhaca_oto_lap"])) ? 1 : 0;
  
        $lap_komparatif_neraca_mn_lap = (isset($_POST["kompharatifnerhaca_mn_lap"])) ? 1 : 0;
        $lap_komparatif_neraca_tb_lap = (isset($_POST["kompharatifnerhaca_tb_lap"])) ? 1 : 0;
        $lap_komparatif_neraca_ed_lap = (isset($_POST["kompharatifnerhaca_ed_lap"])) ? 1 : 0;
        $lap_komparatif_neraca_del_lap = (isset($_POST["kompharatifnerhaca_del_lap"])) ? 1 : 0;
        $lap_komparatif_neraca_oto_lap = (isset($_POST["kompharatifnerhaca_oto_lap"])) ? 1 : 0;
  
        $lap_komparatif_pendapatan_mn_lap = (isset($_POST["kompjaratifpendjapatan_mn_lap"])) ? 1 : 0;
        $lap_komparatif_pendapatan_tb_lap = (isset($_POST["kompjaratifpendjapatan_tb_lap"])) ? 1 : 0;
        $lap_komparatif_pendapatan_ed_lap = (isset($_POST["kompjaratifpendjapatan_ed_lap"])) ? 1 : 0;
        $lap_komparatif_pendapatan_del_lap = (isset($_POST["kompjaratifpendjapatan_del_lap"])) ? 1 : 0;
        $lap_komparatif_pendapatan_oto_lap = (isset($_POST["kompjaratifpendjapatan_oto_lap"])) ? 1 : 0;
  
        $lap_komparatif_hpp_mn_lap = (isset($_POST["kompkaratifhpkp_mn_lap"])) ? 1 : 0;
        $lap_komparatif_hpp_tb_lap = (isset($_POST["kompkaratifhpkp_tb_lap"])) ? 1 : 0;
        $lap_komparatif_hpp_ed_lap = (isset($_POST["kompkaratifhpkp_ed_lap"])) ? 1 : 0;
        $lap_komparatif_hpp_del_lap = (isset($_POST["kompkaratifhpkp_del_lap"])) ? 1 : 0;
        $lap_komparatif_hpp_oto_lap = (isset($_POST["kompkaratifhpkp_oto_lap"])) ? 1 : 0;
  
        $lap_komparatif_hpp_mn_lap = (isset($_POST["kompkaratifhpkp_mn_lap"])) ? 1 : 0;
        $lap_komparatif_hpp_tb_lap = (isset($_POST["kompkaratifhpkp_tb_lap"])) ? 1 : 0;
        $lap_komparatif_hpp_ed_lap = (isset($_POST["kompkaratifhpkp_ed_lap"])) ? 1 : 0;
        $lap_komparatif_hpp_del_lap = (isset($_POST["kompkaratifhpkp_del_lap"])) ? 1 : 0;
        $lap_komparatif_hpp_oto_lap = (isset($_POST["kompkaratifhpkp_oto_lap"])) ? 1 : 0;
  
        $lap_komparatif_beban_operasional_mn_lap = (isset($_POST["komplaratifbeblanoperlasional_mn_lap"])) ? 1 : 0;
        $lap_komparatif_beban_operasional_tb_lap = (isset($_POST["komplaratifbeblanoperlasional_tb_lap"])) ? 1 : 0;
        $lap_komparatif_beban_operasional_ed_lap = (isset($_POST["komplaratifbeblanoperlasional_ed_lap"])) ? 1 : 0;
        $lap_komparatif_beban_operasional_del_lap = (isset($_POST["komplaratifbeblanoperlasional_del_lap"])) ? 1 : 0;
        $lap_komparatif_beban_operasional_oto_lap = (isset($_POST["komplaratifbeblanoperlasional_oto_lap"])) ? 1 : 0;
  
        $lap_komparatif_aktiva_mn_lap = (isset($_POST["kompzaratifaktziva_mn_lap"])) ? 1 : 0;
        $lap_komparatif_aktiva_tb_lap = (isset($_POST["kompzaratifaktziva_tb_lap"])) ? 1 : 0;
        $lap_komparatif_aktiva_ed_lap = (isset($_POST["kompzaratifaktziva_ed_lap"])) ? 1 : 0;
        $lap_komparatif_aktiva_del_lap = (isset($_POST["kompzaratifaktziva_del_lap"])) ? 1 : 0;
        $lap_komparatif_aktiva_oto_lap = (isset($_POST["kompzaratifaktziva_oto_lap"])) ? 1 : 0;
  
        $lap_histori_buku_besar_mn_lap = (isset($_POST["histxorbuxkubesxar_mn_lap"])) ? 1 : 0;
        $lap_histori_buku_besar_tb_lap = (isset($_POST["histxorbuxkubesxar_tb_lap"])) ? 1 : 0;
        $lap_histori_buku_besar_ed_lap = (isset($_POST["histxorbuxkubesxar_ed_lap"])) ? 1 : 0;
        $lap_histori_buku_besar_del_lap = (isset($_POST["histxorbuxkubesxar_del_lap"])) ? 1 : 0;
        $lap_histori_buku_besar_oto_lap = (isset($_POST["histxorbuxkubesxar_oto_lap"])) ? 1 : 0;
  
        $lap_fokus_keuangan_mn_lap = (isset($_POST["fokucskeuacngan_mn_lap"])) ? 1 : 0;
        $lap_fokus_keuangan_tb_lap = (isset($_POST["fokucskeuacngan_tb_lap"])) ? 1 : 0;
        $lap_fokus_keuangan_ed_lap = (isset($_POST["fokucskeuacngan_ed_lap"])) ? 1 : 0;
        $lap_fokus_keuangan_del_lap = (isset($_POST["fokucskeuacngan_del_lap"])) ? 1 : 0;
        $lap_fokus_keuangan_oto_lap = (isset($_POST["fokucskeuacngan_oto_lap"])) ? 1 : 0;
   
			
        $dm_role = $role_mn_dm;
        $dm_role_aksi = $role_tb_dm . "~" . $role_ed_dm . "~" . $role_del_dm . "~" . $role_oto_dm;
		$dm_user = $user_mn_dm;
        $dm_user_aksi = $user_tb_dm . "~" . $user_ed_dm . "~" . $user_del_dm. "~" . $user_oto_dm;
        $dm_rekening = $rekening_mn_dm;
        $dm_rekening_aksi = $rekening_tb_dm . "~" . $rekening_ed_dm . "~" . $rekening_del_dm . "~" . $rekening_oto_dm;
        $dm_pegawai = $pegawai_mn_dm;
        $dm_pegawai_aksi = $pegawai_tb_dm . "~" . $pegawai_ed_dm . "~" . $pegawai_del_dm . "~" . $pegawai_oto_dm;
        $dm_akses_menu = $akses_menu_mn_dm;
        $dm_akses_menu_aksi = "0~" . $akses_menu_ed_dm . "~0";
		$dm_divisi = $divisi_mn_dm;
        $dm_divisi_aksi = $divisi_tb_dm . "~" . $divisi_ed_dm . "~" . $divisi_del_dm . "~" . $divisi_oto_dm;
        $dm_pemasok_kategori = $pemasok_kategori_mn_dm;
        $dm_pemasok_kategori_aksi = $pemasok_kategori_tb_dm . "~" . $pemasok_kategori_ed_dm . "~" . $pemasok_kategori_del_dm . "~" . $pemasok_kategori_oto_dm;
        $dm_pemasok = $pemasok_mn_dm;
        $dm_pemasok_aksi = $pemasok_tb_dm . "~" . $pemasok_ed_dm . "~" . $pemasok_del_dm . "~" . $pemasok_oto_dm;
        $dm_pelanggan_kategori = $pelanggan_kategori_mn_dm;
        $dm_pelanggan_kategori_aksi = $pelanggan_kategori_tb_dm . "~" . $pelanggan_kategori_ed_dm . "~" . $pelanggan_kategori_del_dm . "~" . $pelanggan_kategori_oto_dm;
        $dm_pelanggan = $pelanggan_mn_dm;
        $dm_pelanggan_aksi = $pelanggan_tb_dm . "~" . $pelanggan_ed_dm . "~" . $pelanggan_del_dm . "~" . $pelanggan_oto_dm;
        $dm_produk_kategori = $produk_kategori_mn_dm;
        $dm_produk_kategori_aksi = $produk_kategori_tb_dm . "~" . $produk_kategori_ed_dm . "~" . $produk_kategori_del_dm . "~" . $produk_kategori_oto_dm;
        $dm_produk = $produk_mn_dm;
        $dm_produk_aksi = $produk_tb_dm . "~" . $produk_ed_dm . "~" . $produk_del_dm . "~" . $produk_oto_dm;
        $dm_produk_promo = $produk_promo_mn_dm;
        $dm_produk_promo_aksi = $produk_promo_tb_dm . "~" . $produk_promo_ed_dm . "~" . $produk_promo_del_dm . "~" . $produk_promo_oto_dm;
        $dm_produk_paket = $produk_paket_mn_dm;
        $dm_produk_paket_aksi = $produk_paket_tb_dm . "~" . $produk_paket_ed_dm . "~" . $produk_paket_del_dm . "~" . $produk_paket_oto_dm;
        $dm_paket_buat = $paket_buat_mn_dm;
        $dm_paket_buat_aksi = $paket_buat_tb_dm . "~" . $paket_buat_ed_dm . "~" . $paket_buat_del_dm . "~" . $paket_buat_oto_dm;
        $dm_paket_lepas = $paket_lepas_mn_dm;
        $dm_paket_lepas_aksi = $paket_lepas_tb_dm . "~" . $paket_lepas_ed_dm . "~" . $paket_lepas_del_dm . "~" . $paket_lepas_oto_dm;
        $dm_akun = $akun_mn_dm;
        $dm_akun_aksi = $akun_tb_dm . "~" . $akun_ed_dm . "~" . $akun_del_dm . "~" . $akun_oto_dm;
		$dm_buku_besar = $buku_besar_mn_dm;
        $dm_buku_besar_aksi = $buku_besar_tb_dm . "~" . $buku_besar_ed_dm . "~" . $buku_besar_del_dm . "~" . $buku_besar_oto_dm;
		$dm_jurnal = $jurnal_mn_dm;
        $dm_jurnal_aksi = $jurnal_tb_dm . "~" . $jurnal_ed_dm . "~" . $jurnal_del_dm . "~" . $jurnal_oto_dm;
        $dm_lokasi = $lokasi_mn_dm;
        $dm_lokasi_aksi = $lokasi_tb_dm . "~" . $lokasi_ed_dm . "~" . $lokasi_del_dm . "~" . $lokasi_oto_dm;
		$dm_satuan = $satuan_mn_dm;
        $dm_satuan_aksi = $satuan_tb_dm . "~" . $satuan_ed_dm . "~" . $satuan_del_dm . "~" . $satuan_oto_dm;
        $dm_produk_harga = $produk_harga_mn_dm;
        $dm_produk_harga_aksi = $produk_harga_tb_dm . "~" . $produk_harga_ed_dm . "~" . $produk_harga_del_dm . "~" . $produk_harga_oto_dm;
        $dm_kas_besar = $kas_besar_mn_dm;
        $dm_kas_besar_aksi = $kas_besar_tb_dm . "~" . $kas_besar_ed_dm . "~" . $kas_besar_del_dm . "~" . $kas_besar_oto_dm;
        $dm_kas_kecil = $kas_kecil_mn_dm;
        $dm_kas_kecil_aksi = $kas_kecil_tb_dm . "~" . $kas_kecil_ed_dm . "~" . $kas_kecil_del_dm . "~" . $kas_kecil_oto_dm;
		$dm_cabang = $cabang_mn_dm;
        $dm_cabang_aksi = $cabang_tb_dm . "~" . $cabang_ed_dm . "~" . $cabang_del_dm . "~" . $cabang_oto_dm;
        $dm_coverage = $coverage_mn_dm;
        $dm_coverage_aksi = $coverage_tb_dm . "~" . $coverage_ed_dm . "~" . $coverage_del_dm . "~" . $coverage_oto_dm;
        $dm_merk = $merk_mn_dm;
        $dm_merk_aksi = $merk_tb_dm . "~" . $merk_ed_dm . "~" . $merk_del_dm . "~" . $merk_oto_dm;
        $dm_rak = $rak_mn_dm;
        $dm_rak_aksi = $rak_tb_dm . "~" . $rak_ed_dm . "~" . $rak_del_dm . "~" . $rak_oto_dm;
        $dm_rak_setting = $rak_setting_mn_dm;
        $dm_rak_setting_aksi = $rak_setting_tb_dm . "~" . $rak_setting_ed_dm . "~" . $rak_setting_del_dm . "~" . $rak_setting_oto_dm;
        $dm_rak_setting_detail = $dm_rak_setting;
        $dm_rak_setting_detail_aksi = $dm_rak_setting_aksi;
          
		$st_display = $display_mn_st;
        $st_display_aksi = $display_tb_st . "~" . $display_ed_st . "~" . $display_del_st . "~" . $display_oto_st;
		$st_opname = $opname_mn_st;
        $st_opname_aksi = $opname_tb_st . "~" . $opname_ed_st . "~" . $opname_del_st . "~" . $opname_oto_st;
		$st_verifikasi_opname = $verifikasi_opname_mn_st;
        $st_verifikasi_opname_aksi = $verifikasi_opname_tb_st . "~" . $verifikasi_opname_ed_st . "~" . $verifikasi_opname_del_st . "~" . $verifikasi_opname_oto_st;
		$st_history = $history_mn_st;
        $st_history_aksi = $history_tb_st . "~" . $history_ed_st . "~" . $history_del_st . "~" . $history_oto_st;
		 
		$keu_rekening = $rekening_mn_keu;
        $keu_rekening_aksi = $rekening_tb_keu . "~" . $rekening_ed_keu . "~" . $rekening_del_keu . "~" . $rekening_oto_keu;
		$keu_giro = $giro_mn_keu;
        $keu_giro_aksi = $giro_tb_keu . "~" . $giro_ed_keu . "~" . $giro_del_keu . "~" . $giro_oto_keu;
		$keu_keuangan = $keuangan_mn_keu;
        $keu_keuangan_aksi = $keuangan_tb_keu . "~" . $keuangan_ed_keu . "~" . $keuangan_del_keu . "~" . $keuangan_oto_keu;
		$keu_hutang = $hutang_mn_keu;
        $keu_hutang_aksi = $hutang_tb_keu . "~" . $hutang_ed_keu . "~" . $hutang_del_keu . "~" . $hutang_oto_keu;
		$keu_piutang = $piutang_mn_keu;
        $keu_piutang_aksi = $piutang_tb_keu . "~" . $piutang_ed_keu . "~" . $piutang_del_keu . "~" . $piutang_oto_keu;
		$keu_cash_besar = $cash_besar_mn_keu;
        $keu_cash_besar_aksi = $cash_besar_tb_keu . "~" . $cash_besar_ed_keu . "~" . $cash_besar_del_keu . "~" . $cash_besar_oto_keu;
		$keu_cash_kecil = $cash_kecil_mn_keu;
        $keu_cash_kecil_aksi = $cash_kecil_tb_keu . "~" . $cash_kecil_ed_keu . "~" . $cash_kecil_del_keu . "~" . $cash_kecil_oto_keu;
		
		$trs_pembelian_pesanan_direct = $pembelian_pesanan_direct_mn_trs;
        $trs_pembelian_pesanan_direct_aksi = $pembelian_pesanan_direct_tb_trs . "~" . $pembelian_pesanan_direct_ed_trs . "~" . $pembelian_pesanan_direct_del_trs . "~" . $pembelian_pesanan_direct_oto_trs;
		$trs_in_delivery = $in_delivery_mn_trs;
        $trs_in_delivery_aksi = $in_delivery_tb_trs . "~" . $in_delivery_ed_trs . "~" . $in_delivery_del_trs . "~" . $in_delivery_oto_trs;
		$trs_ex_delivery = $ex_delivery_mn_trs;
        $trs_ex_delivery_aksi = $ex_delivery_tb_trs . "~" . $ex_delivery_ed_trs . "~" . $ex_delivery_del_trs . "~" . $ex_delivery_oto_trs;
		$trs_pembelian_order = $pembelian_order_mn_trs;
        $trs_pembelian_order_aksi = $pembelian_order_tb_trs . "~" . $pembelian_order_ed_trs . "~" . $pembelian_order_del_trs . "~" . $pembelian_order_oto_trs;
		$trs_pembelian_persediaan = $pembelian_persediaan_mn_trs;
        $trs_pembelian_persediaan_aksi = $pembelian_persediaan_tb_trs . "~" . $pembelian_persediaan_ed_trs . "~" . $pembelian_persediaan_del_trs . "~" . $pembelian_persediaan_oto_trs;
		$trs_pembelian_retur = $pembelian_retur_mn_trs;
        $trs_pembelian_retur_aksi = $pembelian_retur_tb_trs . "~" . $pembelian_retur_ed_trs . "~" . $pembelian_retur_del_trs . "~" . $pembelian_retur_oto_trs;
		$trs_penjualan = $penjualan_mn_trs;
        $trs_penjualan_aksi = $penjualan_tb_trs . "~" . $penjualan_ed_trs . "~" . $penjualan_del_trs . "~" . $penjualan_oto_trs;
		$trs_penjualan_managemen = $penjualan_managemen_mn_trs;
        $trs_penjualan_managemen_aksi = $penjualan_managemen_tb_trs . "~" . $penjualan_managemen_ed_trs . "~" . $penjualan_managemen_del_trs . "~" . $penjualan_managemen_oto_trs;
		$trs_deposit = $deposit_mn_trs;
        $trs_deposit_aksi = $deposit_tb_trs . "~" . $deposit_ed_trs . "~" . $deposit_del_trs . "~" . $deposit_oto_trs;
		$trs_penjualan_retur = $penjualan_retur_mn_trs;
        $trs_penjualan_retur_aksi = $penjualan_retur_tb_trs . "~" . $penjualan_retur_ed_trs . "~" . $penjualan_retur_del_trs . "~" . $penjualan_retur_oto_trs;
        
		$lap_pembelian_ringkasan = $lap_pembelian_ringkasan_mn_lap; 
		$lap_pembelian_ringkasan_aksi = $lap_pembelian_ringkasan_tb_lap . "~" . $lap_pembelian_ringkasan_ed_lap . "~" . $lap_pembelian_ringkasan_del_lap . "~" . $lap_pembelian_ringkasan_oto_lap;
		$lap_pembelian_rincian = $lap_pembelian_rincian_mn_lap; 
		$lap_pembelian_rincian_aksi = $lap_pembelian_rincian_tb_lap . "~" . $lap_pembelian_rincian_ed_lap . "~" . $lap_pembelian_rincian_del_lap . "~" . $lap_pembelian_rincian_oto_lap;
		$lap_pembelian_order = $lap_pembelian_order_mn_lap; 
		$lap_pembelian_order_aksi = $lap_pembelian_order_tb_lap . "~" . $lap_pembelian_order_ed_lap . "~" . $lap_pembelian_order_del_lap . "~" . $lap_pembelian_order_oto_lap;
		$lap_pembelian_komparasi = $lap_pembelian_komparasi_mn_lap; 
		$lap_pembelian_komparasi_aksi = $lap_pembelian_komparasi_tb_lap . "~" . $lap_pembelian_komparasi_ed_lap . "~" . $lap_pembelian_komparasi_del_lap . "~" . $lap_pembelian_komparasi_oto_lap;
		$lap_pembelian_per_produk = $lap_pembelian_per_produk_mn_lap; 
		$lap_pembelian_per_produk_aksi = $lap_pembelian_per_produk_tb_lap . "~" . $lap_pembelian_per_produk_ed_lap . "~" . $lap_pembelian_per_produk_del_lap . "~" . $lap_pembelian_per_produk_oto_lap;
		$lap_pembelian_komparasi = $lap_pembelian_komparasi_mn_lap; 
		$lap_pembelian_komparasi_aksi = $lap_pembelian_komparasi_tb_lap . "~" . $lap_pembelian_komparasi_ed_lap . "~" . $lap_pembelian_komparasi_del_lap . "~" . $lap_pembelian_komparasi_oto_lap;
		$lap_pembelian_per_produk = $lap_pembelian_per_produk_mn_lap; 
		$lap_pembelian_per_produk_aksi = $lap_pembelian_per_produk_tb_lap . "~" . $lap_pembelian_per_produk_ed_lap . "~" . $lap_pembelian_per_produk_del_lap . "~" . $lap_pembelian_per_produk_oto_lap;
		$lap_pembelian_per_pemasok = $lap_pembelian_per_pemasok_mn_lap; 
		$lap_pembelian_per_pemasok_aksi = $lap_pembelian_per_pemasok_tb_lap . "~" . $lap_pembelian_per_pemasok_ed_lap . "~" . $lap_pembelian_per_pemasok_del_lap . "~" . $lap_pembelian_per_pemasok_oto_lap;
		$lap_pembelian_disc = $lap_pembelian_disc_mn_lap; 
		$lap_pembelian_disc_aksi = $lap_pembelian_disc_tb_lap . "~" . $lap_pembelian_disc_ed_lap . "~" . $lap_pembelian_disc_del_lap . "~" . $lap_pembelian_disc_oto_lap;
		$lap_pembelian_retur = $lap_pembelian_retur_mn_lap; 
		$lap_pembelian_retur_aksi = $lap_pembelian_retur_tb_lap . "~" . $lap_pembelian_retur_ed_lap . "~" . $lap_pembelian_retur_del_lap . "~" . $lap_pembelian_retur_oto_lap;
		$lap_penjualan_ringkasan = $lap_penjualan_ringkasan_mn_lap; 
		$lap_penjualan_ringkasan_aksi = $lap_penjualan_ringkasan_tb_lap . "~" . $lap_penjualan_ringkasan_ed_lap . "~" . $lap_penjualan_ringkasan_del_lap . "~" . $lap_penjualan_ringkasan_oto_lap;
		$lap_penjualan_rincian = $lap_penjualan_rincian_mn_lap; 
		$lap_penjualan_rincian_aksi = $lap_penjualan_rincian_tb_lap . "~" . $lap_penjualan_rincian_ed_lap . "~" . $lap_penjualan_rincian_del_lap . "~" . $lap_penjualan_rincian_oto_lap;
		$lap_penjualan_nota = $lap_penjualan_nota_mn_lap; 
		$lap_penjualan_nota_aksi = $lap_penjualan_nota_tb_lap . "~" . $lap_penjualan_nota_ed_lap . "~" . $lap_penjualan_nota_del_lap . "~" . $lap_penjualan_nota_oto_lap;
		$lap_penjualan_order = $lap_penjualan_order_mn_lap; 
		$lap_penjualan_order_aksi = $lap_penjualan_order_tb_lap . "~" . $lap_penjualan_order_ed_lap . "~" . $lap_penjualan_order_del_lap . "~" . $lap_penjualan_order_oto_lap;
		$lap_penjualan_komparasi = $lap_penjualan_komparasi_mn_lap; 
		$lap_penjualan_komparasi_aksi = $lap_penjualan_komparasi_tb_lap . "~" . $lap_penjualan_komparasi_ed_lap . "~" . $lap_penjualan_komparasi_del_lap . "~" . $lap_penjualan_komparasi_oto_lap;
		$lap_penjualan_per_produk = $lap_penjualan_per_produk_mn_lap; 
		$lap_penjualan_per_produk_aksi = $lap_penjualan_per_produk_tb_lap . "~" . $lap_penjualan_per_produk_ed_lap . "~" . $lap_penjualan_per_produk_del_lap . "~" . $lap_penjualan_per_produk_oto_lap;
		$lap_penjualan_per_pelanggan = $lap_penjualan_per_pelanggan_mn_lap; 
		$lap_penjualan_per_pelanggan_aksi = $lap_penjualan_per_pelanggan_tb_lap . "~" . $lap_penjualan_per_pelanggan_ed_lap . "~" . $lap_penjualan_per_pelanggan_del_lap . "~" . $lap_penjualan_per_pelanggan_oto_lap;
		$lap_penjualan_harga = $lap_penjualan_harga_mn_lap; 
		$lap_penjualan_harga_aksi = $lap_penjualan_harga_tb_lap . "~" . $lap_penjualan_harga_ed_lap . "~" . $lap_penjualan_harga_del_lap . "~" . $lap_penjualan_harga_oto_lap;
		$lap_penjualan_giro = $lap_penjualan_giro_mn_lap; 
		$lap_penjualan_giro_aksi = $lap_penjualan_giro_tb_lap . "~" . $lap_penjualan_giro_ed_lap . "~" . $lap_penjualan_giro_del_lap . "~" . $lap_penjualan_giro_oto_lap;
		$lap_penjualan_disc = $lap_penjualan_disc_mn_lap; 
		$lap_penjualan_disc_aksi = $lap_penjualan_disc_tb_lap . "~" . $lap_penjualan_disc_ed_lap . "~" . $lap_penjualan_disc_del_lap . "~" . $lap_penjualan_disc_oto_lap;
		$lap_lap_penjualan_margin_barang = $lap_penjualan_margin_barang_mn_lap; 
		$lap_lap_penjualan_margin_barang_aksi = $lap_penjualan_margin_barang_tb_lap . "~" . $lap_penjualan_margin_barang_ed_lap . "~" . $lap_penjualan_margin_barang_del_lap . "~" . $lap_penjualan_margin_barang_oto_lap;
		$lap_penjualan_margin_barang = $lap_penjualan_margin_barang_mn_lap; 
		$lap_penjualan_margin_barang_aksi = $lap_penjualan_margin_barang_tb_lap . "~" . $lap_penjualan_margin_barang_ed_lap . "~" . $lap_penjualan_margin_barang_del_lap . "~" . $lap_penjualan_margin_barang_oto_lap;
		$lap_penjualan_margin_penjualan = $lap_penjualan_margin_penjualan_mn_lap; 
		$lap_penjualan_margin_penjualan_aksi = $lap_penjualan_margin_penjualan_tb_lap . "~" . $lap_penjualan_margin_penjualan_ed_lap . "~" . $lap_penjualan_margin_penjualan_del_lap . "~" . $lap_penjualan_margin_penjualan_oto_lap;
		$lap_produk = $lap_produk_mn_lap; 
		$lap_produk_aksi = $lap_produk_tb_lap . "~" . $lap_produk_ed_lap . "~" . $lap_produk_del_lap . "~" . $lap_produk_oto_lap;
		$lap_harga_beli = $lap_harga_beli_mn_lap; 
		$lap_harga_beli_aksi = $lap_harga_beli_tb_lap . "~" . $lap_harga_beli_ed_lap . "~" . $lap_harga_beli_del_lap . "~" . $lap_harga_beli_oto_lap;
		$lap_harga_jual = $lap_harga_jual_mn_lap; 
		$lap_harga_jual_aksi = $lap_harga_jual_tb_lap . "~" . $lap_harga_jual_ed_lap . "~" . $lap_harga_jual_del_lap . "~" . $lap_harga_jual_oto_lap;
		$lap_stok = $lap_stok_mn_lap; 
		$lap_stok_aksi = $lap_stok_tb_lap . "~" . $lap_stok_ed_lap . "~" . $lap_stok_del_lap . "~" . $lap_stok_oto_lap;
		$lap_hutang_ringkas = $lap_hutang_ringkas_mn_lap; 
		$lap_hutang_ringkas_aksi = $lap_hutang_ringkas_tb_lap . "~" . $lap_hutang_ringkas_ed_lap . "~" . $lap_hutang_ringkas_del_lap . "~" . $lap_hutang_ringkas_oto_lap;
		$lap_piutang_ringkas = $lap_piutang_ringkas_mn_lap; 
		$lap_piutang_ringkas_aksi = $lap_piutang_ringkas_tb_lap . "~" . $lap_piutang_ringkas_ed_lap . "~" . $lap_piutang_ringkas_del_lap . "~" . $lap_piutang_ringkas_oto_lap;
		$lap_hutang_rinci = $lap_hutang_rinci_mn_lap; 
		$lap_hutang_rinci_aksi = $lap_hutang_rinci_tb_lap . "~" . $lap_hutang_rinci_ed_lap . "~" . $lap_hutang_rinci_del_lap . "~" . $lap_hutang_rinci_oto_lap;
		$lap_piutang_rinci = $lap_piutang_rinci_mn_lap; 
		$lap_piutang_rinci_aksi = $lap_piutang_rinci_tb_lap . "~" . $lap_piutang_rinci_ed_lap . "~" . $lap_piutang_rinci_del_lap . "~" . $lap_piutang_rinci_oto_lap;
		$lap_piutang_jt = $lap_piutang_jt_mn_lap; 
		$lap_piutang_jt_aksi = $lap_piutang_jt_tb_lap . "~" . $lap_piutang_jt_ed_lap . "~" . $lap_piutang_jt_del_lap . "~" . $lap_piutang_jt_oto_lap;
		$lap_piutang_pelanggan_saldo = $lap_piutang_pelanggan_saldo_mn_lap; 
		$lap_piutang_pelanggan_saldo_aksi = $lap_piutang_pelanggan_saldo_tb_lap . "~" . $lap_piutang_pelanggan_saldo_ed_lap . "~" . $lap_piutang_pelanggan_saldo_del_lap . "~" . $lap_piutang_pelanggan_saldo_oto_lap;
		$lap_hutang_jt = $lap_hutang_jt_mn_lap; 
		$lap_hutang_jt_aksi = $lap_hutang_jt_tb_lap . "~" . $lap_hutang_jt_ed_lap . "~" . $lap_hutang_jt_del_lap . "~" . $lap_hutang_jt_oto_lap;
		$lap_hutang_pemasok_saldo = $lap_hutang_pemasok_saldo_mn_lap; 
		$lap_hutang_pemasok_saldo_aksi = $lap_hutang_pemasok_saldo_tb_lap . "~" . $lap_hutang_pemasok_saldo_ed_lap . "~" . $lap_hutang_pemasok_saldo_del_lap . "~" . $lap_hutang_pemasok_saldo_oto_lap;
		$lap_persediaan = $lap_persediaan_mn_lap; 
		$lap_persediaan_aksi = $lap_persediaan_tb_lap . "~" . $lap_persediaan_ed_lap . "~" . $lap_persediaan_del_lap . "~" . $lap_persediaan_oto_lap;
		$lap_barang_masuk_gudang = $lap_barang_masuk_gudang_mn_lap; 
		$lap_barang_masuk_gudang_aksi = $lap_barang_masuk_gudang_tb_lap . "~" . $lap_barang_masuk_gudang_ed_lap . "~" . $lap_barang_masuk_gudang_del_lap . "~" . $lap_barang_masuk_gudang_oto_lap;
		$lap_mutasi = $lap_mutasi_mn_lap; 
		$lap_mutasi_aksi = $lap_mutasi_tb_lap . "~" . $lap_mutasi_ed_lap . "~" . $lap_mutasi_del_lap . "~" . $lap_mutasi_oto_lap;
		$lap_produk_gabungan = $lap_produk_gabungan_mn_lap; 
		$lap_produk_gabungan_aksi = $lap_produk_gabungan_tb_lap . "~" . $lap_produk_gabungan_ed_lap . "~" . $lap_produk_gabungan_del_lap . "~" . $lap_produk_gabungan_oto_lap;
		$lap_kuantitas = $lap_kuantitas_mn_lap; 
		$lap_kuantitas_aksi = $lap_kuantitas_tb_lap . "~" . $lap_kuantitas_ed_lap . "~" . $lap_kuantitas_del_lap . "~" . $lap_kuantitas_oto_lap;
		$lap_batas_kuantitas = $lap_batas_kuantitas_mn_lap; 
		$lap_batas_kuantitas_aksi = $lap_batas_kuantitas_tb_lap . "~" . $lap_batas_kuantitas_ed_lap . "~" . $lap_batas_kuantitas_del_lap . "~" . $lap_batas_kuantitas_oto_lap;
		$lap_penyesuaian = $lap_penyesuaian_mn_lap; 
		$lap_penyesuaian_aksi = $lap_penyesuaian_tb_lap . "~" . $lap_penyesuaian_ed_lap . "~" . $lap_penyesuaian_del_lap . "~" . $lap_penyesuaian_oto_lap;
		$lap_mutasi_per_produk = $lap_mutasi_per_produk_mn_lap; 
		$lap_mutasi_per_produk_aksi = $lap_mutasi_per_produk_tb_lap . "~" . $lap_mutasi_per_produk_ed_lap . "~" . $lap_mutasi_per_produk_del_lap . "~" . $lap_mutasi_per_produk_oto_lap;
		$lap_saldo_awal_persediaan = $lap_saldo_awal_persediaan_mn_lap; 
		$lap_saldo_awal_persediaan_aksi = $lap_saldo_awal_persediaan_tb_lap . "~" . $lap_saldo_awal_persediaan_ed_lap . "~" . $lap_saldo_awal_persediaan_del_lap . "~" . $lap_saldo_awal_persediaan_oto_lap;
		$lap_saldo_persediaan_per_lokasi = $lap_saldo_persediaan_per_lokasi_mn_lap; 
		$lap_saldo_persediaan_per_lokasi_aksi = $lap_saldo_persediaan_per_lokasi_tb_lap . "~" . $lap_saldo_persediaan_per_lokasi_ed_lap . "~" . $lap_saldo_persediaan_per_lokasi_del_lap . "~" . $lap_saldo_persediaan_per_lokasi_oto_lap;
		$lap_pelanggan_harga = $lap_pelanggan_harga_mn_lap; 
		$lap_pelanggan_harga_aksi = $lap_pelanggan_harga_tb_lap . "~" . $lap_pelanggan_harga_ed_lap . "~" . $lap_pelanggan_harga_del_lap . "~" . $lap_pelanggan_harga_oto_lap;
		$lap_barang_vendor = $lap_barang_vendor_mn_lap; 
		$lap_barang_vendor_aksi = $lap_barang_vendor_tb_lap . "~" . $lap_barang_vendor_ed_lap . "~" . $lap_barang_vendor_del_lap . "~" . $lap_barang_vendor_oto_lap;
		$lap_daftar_harga = $lap_daftar_harga_mn_lap; 
		$lap_daftar_harga_aksi = $lap_daftar_harga_tb_lap . "~" . $lap_daftar_harga_ed_lap . "~" . $lap_daftar_harga_del_lap . "~" . $lap_daftar_harga_oto_lap;
		$lap_saldo_persediaan = $lap_saldo_persediaan_mn_lap; 
		$lap_saldo_persediaan_aksi = $lap_saldo_persediaan_tb_lap . "~" . $lap_saldo_persediaan_ed_lap . "~" . $lap_saldo_persediaan_del_lap . "~" . $lap_saldo_persediaan_oto_lap;
		$lap_buku_stok = $lap_buku_stok_mn_lap; 
		$lap_buku_stok_aksi = $lap_buku_stok_tb_lap . "~" . $lap_buku_stok_ed_lap . "~" . $lap_buku_stok_del_lap . "~" . $lap_buku_stok_oto_lap;
		$lap_penerimaan_piutang = $lap_penerimaan_piutang_mn_lap; 
		$lap_penerimaan_piutang_aksi = $lap_penerimaan_piutang_tb_lap . "~" . $lap_penerimaan_piutang_ed_lap . "~" . $lap_penerimaan_piutang_del_lap . "~" . $lap_penerimaan_piutang_oto_lap;
		$lap_penerimaan_hutang = $lap_penerimaan_hutang_mn_lap; 
		$lap_penerimaan_hutang_aksi = $lap_penerimaan_hutang_tb_lap . "~" . $lap_penerimaan_hutang_ed_lap . "~" . $lap_penerimaan_hutang_del_lap . "~" . $lap_penerimaan_hutang_oto_lap;
		$lap_deposit_ringkas = $lap_deposit_ringkas_mn_lap; 
		$lap_deposit_ringkas_aksi = $lap_deposit_ringkas_tb_lap . "~" . $lap_deposit_ringkas_ed_lap . "~" . $lap_deposit_ringkas_del_lap . "~" . $lap_deposit_ringkas_oto_lap;
		$lap_deposit_rinci = $lap_deposit_rinci_mn_lap; 
		$lap_deposit_rinci_aksi = $lap_deposit_rinci_tb_lap . "~" . $lap_deposit_rinci_ed_lap . "~" . $lap_deposit_rinci_del_lap . "~" . $lap_deposit_rinci_oto_lap;
		$lap_buku_besar = $lap_buku_besar_mn_lap; 
		$lap_buku_besar_aksi = $lap_buku_besar_tb_lap . "~" . $lap_buku_besar_ed_lap . "~" . $lap_buku_besar_del_lap . "~" . $lap_buku_besar_oto_lap;
		$lap_kartu_persediaan = $lap_kartu_persediaan_mn_lap; 
		$lap_kartu_persediaan_aksi = $lap_kartu_persediaan_tb_lap . "~" . $lap_kartu_persediaan_ed_lap . "~" . $lap_kartu_persediaan_del_lap . "~" . $lap_kartu_persediaan_oto_lap;
		$lap_rincian_jual_beli = $lap_rincian_jual_beli_mn_lap; 
		$lap_rincian_jual_beli_aksi = $lap_rincian_jual_beli_tb_lap . "~" . $lap_rincian_jual_beli_ed_lap . "~" . $lap_rincian_jual_beli_del_lap . "~" . $lap_rincian_jual_beli_oto_lap;
		$lap_neraca = $lap_neraca_mn_lap; 
		$lap_neraca_aksi = $lap_neraca_tb_lap . "~" . $lap_neraca_ed_lap . "~" . $lap_neraca_del_lap . "~" . $lap_neraca_oto_lap;
		$lap_laba_rugi = $lap_laba_rugi_mn_lap; 
		$lap_laba_rugi_aksi = $lap_laba_rugi_tb_lap . "~" . $lap_laba_rugi_ed_lap . "~" . $lap_laba_rugi_del_lap . "~" . $lap_laba_rugi_oto_lap;
		$lap_ekuitas = $lap_ekuitas_mn_lap; 
		$lap_ekuitas_aksi = $lap_ekuitas_tb_lap . "~" . $lap_ekuitas_ed_lap . "~" . $lap_ekuitas_del_lap . "~" . $lap_ekuitas_oto_lap;
		$lap_saldo_awal = $lap_saldo_awal_mn_lap; 
		$lap_saldo_awal_aksi = $lap_saldo_awal_tb_lap . "~" . $lap_saldo_awal_ed_lap . "~" . $lap_saldo_awal_del_lap . "~" . $lap_saldo_awal_oto_lap;
		$lap_register = $lap_register_mn_lap; 
		$lap_register_aksi = $lap_register_tb_lap . "~" . $lap_register_ed_lap . "~" . $lap_register_del_lap . "~" . $lap_register_oto_lap;
		$lap_kas_in = $lap_kas_in_mn_lap; 
		$lap_kas_in_aksi = $lap_kas_in_tb_lap . "~" . $lap_kas_in_ed_lap . "~" . $lap_kas_in_del_lap . "~" . $lap_kas_in_oto_lap;
		$lap_kas_out = $lap_kas_out_mn_lap; 
		$lap_kas_out_aksi = $lap_kas_out_tb_lap . "~" . $lap_kas_out_ed_lap . "~" . $lap_kas_out_del_lap . "~" . $lap_kas_out_oto_lap;
		$lap_kas = $lap_kas_mn_lap; 
		$lap_kas_aksi = $lap_kas_tb_lap . "~" . $lap_kas_ed_lap . "~" . $lap_kas_del_lap . "~" . $lap_kas_oto_lap;
		$lap_relasi_pelanggan = $lap_relasi_pelanggan_mn_lap; 
		$lap_relasi_pelanggan_aksi = $lap_relasi_pelanggan_tb_lap . "~" . $lap_relasi_pelanggan_ed_lap . "~" . $lap_relasi_pelanggan_del_lap . "~" . $lap_relasi_pelanggan_oto_lap;
		$lap_relasi_pemasok = $lap_relasi_pemasok_mn_lap; 
		$lap_relasi_pemasok_aksi = $lap_relasi_pemasok_tb_lap . "~" . $lap_relasi_pemasok_ed_lap . "~" . $lap_relasi_pemasok_del_lap . "~" . $lap_relasi_pemasok_oto_lap;
		$lap_input_akun = $lap_input_akun_mn_lap; 
		$lap_input_akun_aksi = $lap_input_akun_tb_lap . "~" . $lap_input_akun_ed_lap . "~" . $lap_input_akun_del_lap . "~" . $lap_input_akun_oto_lap;
		$lap_log = $lap_log_mn_lap; 
		$lap_log_aksi = $lap_log_tb_lap . "~" . $lap_log_ed_lap . "~" . $lap_log_del_lap . "~" . $lap_log_oto_lap;
		$lap_analisi_proporsi_pembelian = $lap_analisi_proporsi_pembelian_mn_lap; 
		$lap_analisi_proporsi_pembelian_aksi = $lap_analisi_proporsi_pembelian_tb_lap . "~" . $lap_analisi_proporsi_pembelian_ed_lap . "~" . $lap_analisi_proporsi_pembelian_del_lap . "~" . $lap_analisi_proporsi_pembelian_oto_lap;
		$lap_analisis_ranking_pemasok = $lap_analisis_ranking_pemasok_mn_lap; 
		$lap_analisis_ranking_pemasok_aksi = $lap_analisis_ranking_pemasok_tb_lap . "~" . $lap_analisis_ranking_pemasok_ed_lap . "~" . $lap_analisis_ranking_pemasok_del_lap . "~" . $lap_analisis_ranking_pemasok_oto_lap;
		$lap_analisis_retur_pembelian = $lap_analisis_retur_pembelian_mn_lap; 
		$lap_analisis_retur_pembelian_aksi = $lap_analisis_retur_pembelian_tb_lap . "~" . $lap_analisis_retur_pembelian_ed_lap . "~" . $lap_analisis_retur_pembelian_del_lap . "~" . $lap_analisis_retur_pembelian_oto_lap;
		$lap_analisis_proporsi_penjualan = $lap_analisis_proporsi_penjualan_mn_lap; 
		$lap_analisis_proporsi_penjualan_aksi = $lap_analisis_proporsi_penjualan_tb_lap . "~" . $lap_analisis_proporsi_penjualan_ed_lap . "~" . $lap_analisis_proporsi_penjualan_del_lap . "~" . $lap_analisis_proporsi_penjualan_oto_lap;
		$lap_analisis_ranking_pelanggan = $lap_analisis_ranking_pelanggan_mn_lap; 
		$lap_analisis_ranking_pelanggan_aksi = $lap_analisis_ranking_pelanggan_tb_lap . "~" . $lap_analisis_ranking_pelanggan_ed_lap . "~" . $lap_analisis_ranking_pelanggan_del_lap . "~" . $lap_analisis_ranking_pelanggan_oto_lap;
		$lap_analisis_produk_terlaris = $lap_analisis_produk_terlaris_mn_lap; 
		$lap_analisis_produk_terlaris_aksi = $lap_analisis_produk_terlaris_tb_lap . "~" . $lap_analisis_produk_terlaris_ed_lap . "~" . $lap_analisis_produk_terlaris_del_lap . "~" . $lap_analisis_produk_terlaris_oto_lap;
		$lap_analisis_retur_penjualan = $lap_analisis_retur_penjualan_mn_lap; 
		$lap_analisis_retur_penjualan_aksi = $lap_analisis_retur_penjualan_tb_lap . "~" . $lap_analisis_retur_penjualan_ed_lap . "~" . $lap_analisis_retur_penjualan_del_lap . "~" . $lap_analisis_retur_penjualan_oto_lap;
		$lap_margin_penjualan = $lap_margin_penjualan_mn_lap; 
		$lap_margin_penjualan_aksi = $lap_margin_penjualan_tb_lap . "~" . $lap_margin_penjualan_ed_lap . "~" . $lap_margin_penjualan_del_lap . "~" . $lap_margin_penjualan_oto_lap;
		$lap_analisis_perputaran_stok	 = $lap_analisis_perputaran_stok_mn_lap; 
		$lap_analisis_perputaran_stok_aksi = $lap_analisis_perputaran_stok_tb_lap . "~" . $lap_analisis_perputaran_stok_ed_lap . "~" . $lap_analisis_perputaran_stok_del_lap . "~" . $lap_analisis_perputaran_stok_oto_lap;
		$lap_deviasi_produk = $lap_deviasi_produk_mn_lap; 
		$lap_deviasi_produk_aksi = $lap_deviasi_produk_tb_lap . "~" . $lap_deviasi_produk_ed_lap . "~" . $lap_deviasi_produk_del_lap . "~" . $lap_deviasi_produk_oto_lap;
		$lap_proporsi_stok = $lap_proporsi_stok_mn_lap; 
		$lap_proporsi_stok_aksi = $lap_proporsi_stok_tb_lap . "~" . $lap_proporsi_stok_ed_lap . "~" . $lap_proporsi_stok_del_lap . "~" . $lap_proporsi_stok_oto_lap;
		$lap_history_hutang = $lap_history_hutang_mn_lap; 
		$lap_history_hutang_aksi = $lap_history_hutang_tb_lap . "~" . $lap_history_hutang_ed_lap . "~" . $lap_history_hutang_del_lap . "~" . $lap_history_hutang_oto_lap;
		$lap_history_piutang = $lap_history_piutang_mn_lap; 
		$lap_history_piutang_aksi = $lap_history_piutang_tb_lap . "~" . $lap_history_piutang_ed_lap . "~" . $lap_history_piutang_del_lap . "~" . $lap_history_piutang_oto_lap;
		$lap_komparatif_laba_grafik = $lap_komparatif_laba_grafik_mn_lap; 
		$lap_komparatif_laba_grafik_aksi = $lap_komparatif_laba_grafik_tb_lap . "~" . $lap_komparatif_laba_grafik_ed_lap . "~" . $lap_komparatif_laba_grafik_del_lap . "~" . $lap_komparatif_laba_grafik_oto_lap;
		$lap_komparatif_laba = $lap_komparatif_laba_mn_lap; 
		$lap_komparatif_laba_aksi = $lap_komparatif_laba_tb_lap . "~" . $lap_komparatif_laba_ed_lap . "~" . $lap_komparatif_laba_del_lap . "~" . $lap_komparatif_laba_oto_lap;
		$lap_komparatif_neraca = $lap_komparatif_neraca_mn_lap; 
		$lap_komparatif_neraca_aksi = $lap_komparatif_neraca_tb_lap . "~" . $lap_komparatif_neraca_ed_lap . "~" . $lap_komparatif_neraca_del_lap . "~" . $lap_komparatif_neraca_oto_lap;
		$lap_komparatif_pendapatan = $lap_komparatif_pendapatan_mn_lap; 
		$lap_komparatif_pendapatan_aksi = $lap_komparatif_pendapatan_tb_lap . "~" . $lap_komparatif_pendapatan_ed_lap . "~" . $lap_komparatif_pendapatan_del_lap . "~" . $lap_komparatif_pendapatan_oto_lap;
		$lap_komparatif_hpp = $lap_komparatif_hpp_mn_lap; 
		$lap_komparatif_hpp_aksi = $lap_komparatif_hpp_tb_lap . "~" . $lap_komparatif_hpp_ed_lap . "~" . $lap_komparatif_hpp_del_lap . "~" . $lap_komparatif_hpp_oto_lap;
		$lap_komparatif_beban_operasional = $lap_komparatif_beban_operasional_mn_lap; 
		$lap_komparatif_beban_operasional_aksi = $lap_komparatif_beban_operasional_tb_lap . "~" . $lap_komparatif_beban_operasional_ed_lap . "~" . $lap_komparatif_beban_operasional_del_lap . "~" . $lap_komparatif_beban_operasional_oto_lap;
		$lap_komparatif_aktiva = $lap_komparatif_aktiva_mn_lap; 
		$lap_komparatif_aktiva_aksi = $lap_komparatif_aktiva_tb_lap . "~" . $lap_komparatif_aktiva_ed_lap . "~" . $lap_komparatif_aktiva_del_lap . "~" . $lap_komparatif_aktiva_oto_lap;
		$lap_histori_buku_besar = $lap_histori_buku_besar_mn_lap; 
		$lap_histori_buku_besar_aksi = $lap_histori_buku_besar_tb_lap . "~" . $lap_histori_buku_besar_ed_lap . "~" . $lap_histori_buku_besar_del_lap . "~" . $lap_histori_buku_besar_oto_lap;
		$lap_fokus_keuangan = $lap_fokus_keuangan_mn_lap; 
		$lap_fokus_keuangan_aksi = $lap_fokus_keuangan_tb_lap . "~" . $lap_fokus_keuangan_ed_lap . "~" . $lap_fokus_keuangan_del_lap . "~" . $lap_fokus_keuangan_oto_lap;
		
		$lap_penjualan_retur = $lap_penjualan_retur_mn_lap; 
		$lap_penjualan_retur_aksi = $lap_penjualan_retur_tb_lap . "~" . $lap_penjualan_retur_ed_lap . "~" . $lap_penjualan_retur_del_lap . "~" . $lap_penjualan_retur_oto_lap;
		
		
        $pg_restore = $restoredatabase_mn_dm;
        $pg_backup = $backupdatabase_mn_dm;
        $pg_profile = $profile_mn_dm;
        $pg_log = $log_mn_dm;

        $dataData = array(
            "role_id" => urldecode($_POST["role_id"]),
            "dm_role" => urldecode($dm_role),
            "dm_role_aksi" => urldecode($dm_role_aksi),
            "dm_user" => urldecode($dm_user),
            "dm_user_aksi" => urldecode($dm_user_aksi),
            "dm_rekening" => $dm_rekening,
            "dm_rekening_aksi" => $dm_rekening_aksi,
            "dm_pegawai" => urldecode($dm_pegawai),
            "dm_pegawai_aksi" => urldecode($dm_pegawai_aksi),
			"dm_akses_menu" => urldecode($dm_akses_menu),
            "dm_akses_menu_aksi" => urldecode($dm_akses_menu_aksi),
            "dm_divisi" => $dm_divisi,
            "dm_divisi_aksi" => $dm_divisi_aksi,
            "dm_pemasok_kategori" => $dm_pemasok_kategori,
            "dm_pemasok_kategori_aksi" => $dm_pemasok_kategori_aksi,
            "dm_pemasok" => $dm_pemasok,
            "dm_pemasok_aksi" => $dm_pemasok_aksi,
            "dm_pelanggan_kategori" => $dm_pelanggan_kategori,
            "dm_pelanggan_kategori_aksi" => $dm_pelanggan_kategori_aksi,
            "dm_pelanggan" => $dm_pelanggan,
            "dm_pelanggan_aksi" => $dm_pelanggan_aksi,
            "dm_produk_kategori" => $dm_produk_kategori,
            "dm_produk_kategori_aksi" => $dm_produk_kategori_aksi, 
            "dm_produk_promo" => $dm_produk_promo,
            "dm_produk_promo_aksi" => $dm_produk_promo_aksi,
            "dm_produk_paket" => $dm_produk_paket,
            "dm_produk_paket_aksi" => $dm_produk_paket_aksi,
            "dm_paket_buat" => $dm_paket_buat,
            "dm_paket_buat_aksi" => $dm_paket_buat_aksi,
            "dm_paket_lepas" => $dm_paket_lepas,
            "dm_paket_lepas_aksi" => $dm_paket_lepas_aksi,
            "dm_akun" => $dm_akun,
            "dm_akun_aksi" => $dm_akun_aksi,
            "dm_produk" => $dm_produk,
            "dm_produk_aksi" => $dm_produk_aksi,
            "dm_buku_besar" => $dm_buku_besar,
            "dm_buku_besar_aksi" => $dm_buku_besar_aksi,
            "dm_jurnal" => $dm_jurnal,
            "dm_jurnal_aksi" => $dm_jurnal_aksi,
            "dm_lokasi" => $dm_lokasi,
            "dm_lokasi_aksi" => $dm_lokasi_aksi,
            "dm_satuan" => $dm_satuan,
            "dm_satuan_aksi" => $dm_satuan_aksi,
            "dm_produk_harga" => $dm_produk_harga,
            "dm_produk_harga_aksi" => $dm_produk_harga_aksi,
            
			"dm_kas_besar" => $dm_kas_besar,
            "dm_kas_besar_aksi" => $dm_kas_besar_aksi,
			"dm_kas_kecil" => $dm_kas_kecil,
            "dm_kas_kecil_aksi" => $dm_kas_kecil_aksi,
            "dm_cabang" => $dm_cabang,
            "dm_cabang_aksi" => $dm_cabang_aksi,
            "dm_coverage" => $dm_coverage,
            "dm_coverage_aksi" => $dm_coverage_aksi,
            "dm_merk" => $dm_merk,
            "dm_merk_aksi" => $dm_merk_aksi,
            "dm_rak" => $dm_rak,
            "dm_rak_aksi" => $dm_rak_aksi,
            "dm_rak_setting" => $dm_rak_setting,
            "dm_rak_setting_aksi" => $dm_rak_setting_aksi,
            "dm_rak_setting_detail" => $dm_rak_setting_detail,
            "dm_rak_setting_detail_aksi" => $dm_rak_setting_detail_aksi,
             
			"st_display" => $st_display,
            "st_display_aksi" => $st_display_aksi,
			"st_opname" => $st_opname,
            "st_opname_aksi" => $st_opname_aksi,
			"st_verifikasi_opname" => $st_verifikasi_opname,
            "st_verifikasi_opname_aksi" => $st_verifikasi_opname_aksi,
			"st_history" => $st_history,
            "st_history_aksi" => $st_history_aksi,
			
			"keu_rekening" => $keu_rekening,
            "keu_rekening_aksi" => $keu_rekening_aksi,
			"keu_giro" => $keu_giro,
            "keu_giro_aksi" => $keu_giro_aksi,
			"keu_keuangan" => $keu_keuangan,
            "keu_keuangan_aksi" => $keu_keuangan_aksi, 
			"keu_hutang" => $keu_hutang,
            "keu_hutang_aksi" => $keu_hutang_aksi,
			"keu_piutang" => $keu_piutang,
            "keu_piutang_aksi" => $keu_piutang_aksi,
			"keu_cash_besar" => $keu_cash_besar,
            "keu_cash_besar_aksi" => $keu_cash_besar_aksi,
			"keu_cash_kecil" => $keu_cash_kecil,
            "keu_cash_kecil_aksi" => $keu_cash_kecil_aksi,
			
			"trs_pembelian_pesanan_direct" => $trs_pembelian_pesanan_direct,
            "trs_pembelian_pesanan_direct_aksi" => $trs_pembelian_pesanan_direct_aksi,
			"trs_pembelian_order" => $trs_pembelian_order,
            "trs_pembelian_order_aksi" => $trs_pembelian_order_aksi,
            "trs_pembelian_persediaan" => $trs_pembelian_persediaan,
            "trs_pembelian_persediaan_aksi" => $trs_pembelian_persediaan_aksi,
            "trs_pembelian_retur" => $trs_pembelian_retur,
            "trs_pembelian_retur_aksi" => $trs_pembelian_retur_aksi,
            "trs_penjualan" => $trs_penjualan,
            "trs_penjualan_aksi" => $trs_penjualan_aksi,
            "trs_penjualan_retur" => $trs_penjualan_retur,
            "trs_penjualan_retur_aksi" => $trs_penjualan_retur_aksi,
            "trs_penjualan_managemen" => $trs_penjualan_managemen,
            "trs_penjualan_managemen_aksi" => $trs_penjualan_managemen_aksi, 
			"trs_deposit" => $trs_deposit,
            "trs_deposit_aksi" => $trs_deposit_aksi,
			"trs_in_delivery" => $trs_in_delivery,
            "trs_in_delivery_aksi" => $trs_in_delivery_aksi,
			"trs_ex_delivery" => $trs_ex_delivery,
            "trs_ex_delivery_aksi" => $trs_ex_delivery_aksi,
			
			"lap_pembelian_ringkasan" => $lap_pembelian_ringkasan,
            "lap_pembelian_ringkasan_aksi" => $lap_pembelian_ringkasan_aksi, 
			"lap_pembelian_komparasi" => $lap_pembelian_komparasi,
            "lap_pembelian_komparasi_aksi" => $lap_pembelian_komparasi_aksi, 
			"lap_pembelian_per_produk" => $lap_pembelian_per_produk,
            "lap_pembelian_per_produk_aksi" => $lap_pembelian_per_produk_aksi, 
			"lap_pembelian_per_pemasok" => $lap_pembelian_per_pemasok,
            "lap_pembelian_per_pemasok_aksi" => $lap_pembelian_per_pemasok_aksi, 
			"lap_pembelian_komparasi" => $lap_pembelian_komparasi,
            "lap_pembelian_komparasi_aksi" => $lap_pembelian_komparasi_aksi, 
			"lap_pembelian_per_produk" => $lap_pembelian_per_produk,
            "lap_pembelian_per_produk_aksi" => $lap_pembelian_per_produk_aksi, 
			"lap_pembelian_per_pemasok" => $lap_pembelian_per_pemasok,
            "lap_pembelian_per_pemasok_aksi" => $lap_pembelian_per_pemasok_aksi, 
			"lap_pembelian_disc" => $lap_pembelian_disc,
            "lap_pembelian_disc_aksi" => $lap_pembelian_disc_aksi, 
			"lap_pembelian_disc" => $lap_pembelian_disc,
            "lap_pembelian_disc_aksi" => $lap_pembelian_disc_aksi,
			"lap_pembelian_retur" => $lap_pembelian_retur,
            "lap_pembelian_retur_aksi" => $lap_pembelian_retur_aksi, 
			"lap_penjualan_ringkasan" => $lap_penjualan_ringkasan,
            "lap_penjualan_ringkasan_aksi" => $lap_penjualan_ringkasan_aksi, 
			"lap_penjualan_rincian" => $lap_penjualan_rincian,
            "lap_penjualan_rincian_aksi" => $lap_penjualan_rincian_aksi, 
			"lap_penjualan_nota" => $lap_penjualan_nota,
            "lap_penjualan_nota_aksi" => $lap_penjualan_nota_aksi, 
			"lap_penjualan_order" => $lap_penjualan_order,
            "lap_penjualan_order_aksi" => $lap_penjualan_order_aksi, 
			"lap_penjualan_komparasi" => $lap_penjualan_komparasi,
            "lap_penjualan_komparasi_aksi" => $lap_penjualan_komparasi_aksi, 
			"lap_penjualan_per_produk" => $lap_penjualan_per_produk,
            "lap_penjualan_per_produk_aksi" => $lap_penjualan_per_produk_aksi, 
			"lap_penjualan_per_pelanggan" => $lap_penjualan_per_pelanggan,
            "lap_penjualan_per_pelanggan_aksi" => $lap_penjualan_per_pelanggan_aksi, 
			"lap_penjualan_harga" => $lap_penjualan_harga,
            "lap_penjualan_harga_aksi" => $lap_penjualan_harga_aksi,
			"lap_penjualan_giro" => $lap_penjualan_giro,
            "lap_penjualan_giro_aksi" => $lap_penjualan_giro_aksi, 
			"lap_penjualan_disc" => $lap_penjualan_disc,
            "lap_penjualan_disc_aksi" => $lap_penjualan_disc_aksi, 
			"lap_penjualan_retur" => $lap_penjualan_retur,
            "lap_penjualan_retur_aksi" => $lap_penjualan_retur_aksi, 
			"lap_penjualan_margin_barang" => $lap_penjualan_margin_barang,
            "lap_penjualan_margin_barang_aksi" => $lap_penjualan_margin_barang_aksi, 
			"lap_penjualan_margin_penjualan" => $lap_penjualan_margin_penjualan,
            "lap_penjualan_margin_penjualan_aksi" => $lap_penjualan_margin_penjualan_aksi, 
			"lap_produk" => $lap_produk,
            "lap_produk_aksi" => $lap_produk_aksi, 
			"lap_harga_beli" => $lap_harga_beli,
            "lap_harga_beli_aksi" => $lap_harga_beli_aksi, 
			"lap_harga_jual" => $lap_harga_jual,
            "lap_harga_jual_aksi" => $lap_harga_jual_aksi, 
			"lap_stok" => $lap_stok,
            "lap_stok_aksi" => $lap_stok_aksi,
			"lap_hutang_ringkas" => $lap_hutang_ringkas,
            "lap_hutang_ringkas_aksi" => $lap_hutang_ringkas_aksi, 
			"lap_piutang_ringkas" => $lap_piutang_ringkas,
            "lap_piutang_ringkas_aksi" => $lap_piutang_ringkas_aksi, 
			"lap_hutang_rinci" => $lap_hutang_rinci,
            "lap_hutang_rinci_aksi" => $lap_hutang_rinci_aksi, 
			"lap_piutang_rinci" => $lap_piutang_rinci,
            "lap_piutang_rinci_aksi" => $lap_piutang_rinci_aksi, 
			"lap_piutang_jt" => $lap_piutang_jt,
            "lap_piutang_jt_aksi" => $lap_piutang_jt_aksi, 
			"lap_piutang_pelanggan_saldo" => $lap_piutang_pelanggan_saldo,
            "lap_piutang_pelanggan_saldo_aksi" => $lap_piutang_pelanggan_saldo_aksi, 
			"lap_hutang_jt" => $lap_hutang_jt,
            "lap_hutang_jt_aksi" => $lap_hutang_jt_aksi, 
			"lap_hutang_pemasok_saldo" => $lap_hutang_pemasok_saldo,
            "lap_hutang_pemasok_saldo_aksi" => $lap_hutang_pemasok_saldo_aksi, 
			"lap_persediaan" => $lap_persediaan,
            "lap_persediaan_aksi" => $lap_persediaan_aksi,
			"lap_barang_masuk_gudang" => $lap_barang_masuk_gudang,
            "lap_barang_masuk_gudang_aksi" => $lap_barang_masuk_gudang_aksi, 
			"lap_mutasi" => $lap_mutasi,
            "lap_mutasi_aksi" => $lap_mutasi_aksi, 
			"lap_produk_gabungan" => $lap_produk_gabungan,
            "lap_produk_gabungan_aksi" => $lap_produk_gabungan_aksi, 
			"lap_kuantitas" => $lap_kuantitas,
            "lap_kuantitas_aksi" => $lap_kuantitas_aksi, 
			"lap_batas_kuantitas" => $lap_batas_kuantitas,
            "lap_batas_kuantitas_aksi" => $lap_batas_kuantitas_aksi, 
			"lap_penyesuaian" => $lap_penyesuaian,
            "lap_penyesuaian_aksi" => $lap_penyesuaian_aksi, 
			"lap_mutasi_per_produk" => $lap_mutasi_per_produk,
            "lap_mutasi_per_produk_aksi" => $lap_mutasi_per_produk_aksi, 
			"lap_saldo_awal_persediaan" => $lap_saldo_awal_persediaan,
            "lap_saldo_awal_persediaan_aksi" => $lap_saldo_awal_persediaan_aksi, 
			"lap_saldo_persediaan_per_lokasi" => $lap_saldo_persediaan_per_lokasi,
            "lap_saldo_persediaan_per_lokasi_aksi" => $lap_saldo_persediaan_per_lokasi_aksi,
			"lap_pelanggan_harga" => $lap_pelanggan_harga,
            "lap_pelanggan_harga_aksi" => $lap_pelanggan_harga_aksi, 
			"lap_barang_vendor" => $lap_barang_vendor,
            "lap_barang_vendor_aksi" => $lap_barang_vendor_aksi, 
			"lap_daftar_harga" => $lap_daftar_harga,
            "lap_daftar_harga_aksi" => $lap_daftar_harga_aksi, 
			"lap_saldo_persediaan" => $lap_saldo_persediaan,
            "lap_saldo_persediaan_aksi" => $lap_saldo_persediaan_aksi, 
			"lap_buku_stok" => $lap_buku_stok,
            "lap_buku_stok_aksi" => $lap_buku_stok_aksi, 
			"lap_penerimaan_piutang" => $lap_penerimaan_piutang,
            "lap_penerimaan_piutang_aksi" => $lap_penerimaan_piutang_aksi, 
			"lap_penerimaan_hutang" => $lap_penerimaan_hutang,
            "lap_penerimaan_hutang_aksi" => $lap_penerimaan_hutang_aksi, 
			"lap_deposit_ringkas" => $lap_deposit_ringkas,
            "lap_deposit_ringkas_aksi" => $lap_deposit_ringkas_aksi, 
			"lap_deposit_rinci" => $lap_deposit_rinci,
            "lap_deposit_rinci_aksi" => $lap_deposit_rinci_aksi,
			"lap_buku_besar" => $lap_buku_besar,
            "lap_buku_besar_aksi" => $lap_buku_besar_aksi, 
			"lap_kartu_persediaan" => $lap_kartu_persediaan,
            "lap_kartu_persediaan_aksi" => $lap_kartu_persediaan_aksi, 
			"lap_rincian_jual_beli" => $lap_rincian_jual_beli,
            "lap_rincian_jual_beli_aksi" => $lap_rincian_jual_beli_aksi, 
			"lap_neraca" => $lap_neraca,
            "lap_neraca_aksi" => $lap_neraca_aksi, 
			"lap_laba_rugi" => $lap_laba_rugi,
            "lap_laba_rugi_aksi" => $lap_laba_rugi_aksi, 
			"lap_ekuitas" => $lap_ekuitas,
            "lap_ekuitas_aksi" => $lap_ekuitas_aksi, 
			"lap_saldo_awal" => $lap_saldo_awal,
            "lap_saldo_awal_aksi" => $lap_saldo_awal_aksi, 
			"lap_register" => $lap_register,
            "lap_register_aksi" => $lap_register_aksi, 
			"lap_kas_in" => $lap_kas_in,
            "lap_kas_in_aksi" => $lap_kas_in_aksi,
			"lap_kas_out" => $lap_kas_out,
            "lap_kas_out_aksi" => $lap_kas_out_aksi, 
			"lap_kas" => $lap_kas,
            "lap_kas_aksi" => $lap_kas_aksi, 
			"lap_relasi_pelanggan" => $lap_relasi_pelanggan,
            "lap_relasi_pelanggan_aksi" => $lap_relasi_pelanggan_aksi, 
			"lap_relasi_pemasok" => $lap_relasi_pemasok,
            "lap_relasi_pemasok_aksi" => $lap_relasi_pemasok_aksi, 
			"lap_input_akun" => $lap_input_akun,
            "lap_input_akun_aksi" => $lap_input_akun_aksi, 
			"lap_log" => $lap_log,
            "lap_log_aksi" => $lap_log_aksi, 
			"lap_analisi_proporsi_pembelian" => $lap_analisi_proporsi_pembelian,
            "lap_analisi_proporsi_pembelian_aksi" => $lap_analisi_proporsi_pembelian_aksi, 
			"lap_analisis_ranking_pemasok" => $lap_analisis_ranking_pemasok,
            "lap_analisis_ranking_pemasok_aksi" => $lap_analisis_ranking_pemasok_aksi, 
			"lap_analisis_retur_pembelian" => $lap_analisis_retur_pembelian,
            "lap_analisis_retur_pembelian_aksi" => $lap_analisis_retur_pembelian_aksi,
			"lap_analisis_proporsi_penjualan" => $lap_analisis_proporsi_penjualan,
            "lap_analisis_proporsi_penjualan_aksi" => $lap_analisis_proporsi_penjualan_aksi, 
			"lap_analisis_ranking_pelanggan" => $lap_analisis_ranking_pelanggan,
            "lap_analisis_ranking_pelanggan_aksi" => $lap_analisis_ranking_pelanggan_aksi, 
			"lap_analisis_produk_terlaris" => $lap_analisis_produk_terlaris,
            "lap_analisis_produk_terlaris_aksi" => $lap_analisis_produk_terlaris_aksi, 
			"lap_analisis_retur_penjualan" => $lap_analisis_retur_penjualan,
            "lap_analisis_retur_penjualan_aksi" => $lap_analisis_retur_penjualan_aksi, 
			"lap_margin_penjualan" => $lap_margin_penjualan,
            "lap_margin_penjualan_aksi" => $lap_margin_penjualan_aksi, 
			"lap_analisis_perputaran_stok" => $lap_analisis_perputaran_stok,
            "lap_analisis_perputaran_stok_aksi" => $lap_analisis_perputaran_stok_aksi, 
			"lap_deviasi_produk" => $lap_deviasi_produk,
            "lap_deviasi_produk_aksi" => $lap_deviasi_produk_aksi, 
			"lap_proporsi_stok" => $lap_proporsi_stok,
            "lap_proporsi_stok_aksi" => $lap_proporsi_stok_aksi, 
			"lap_history_hutang" => $lap_history_hutang,
            "lap_history_hutang_aksi" => $lap_history_hutang_aksi,
			"lap_history_piutang" => $lap_history_piutang,
            "lap_history_piutang_aksi" => $lap_history_piutang_aksi, 
			"lap_komparatif_laba_grafik" => $lap_komparatif_laba_grafik,
            "lap_komparatif_laba_grafik_aksi" => $lap_komparatif_laba_grafik_aksi, 
			"lap_komparatif_laba" => $lap_komparatif_laba,
            "lap_komparatif_laba_aksi" => $lap_komparatif_laba_aksi, 
			"lap_komparatif_neraca" => $lap_komparatif_neraca,
            "lap_komparatif_neraca_aksi" => $lap_komparatif_neraca_aksi, 
			"lap_komparatif_pendapatan" => $lap_komparatif_pendapatan,
            "lap_komparatif_pendapatan_aksi" => $lap_komparatif_pendapatan_aksi, 
			"lap_komparatif_hpp" => $lap_komparatif_hpp,
            "lap_komparatif_hpp_aksi" => $lap_komparatif_hpp_aksi, 
			"lap_komparatif_beban_operasional" => $lap_komparatif_beban_operasional,
            "lap_komparatif_beban_operasional_aksi" => $lap_komparatif_beban_operasional_aksi, 
			"lap_komparatif_aktiva" => $lap_komparatif_aktiva,
            "lap_komparatif_aktiva_aksi" => $lap_komparatif_aktiva_aksi, 
			"lap_histori_buku_besar" => $lap_histori_buku_besar,
            "lap_histori_buku_besar_aksi" => $lap_histori_buku_besar_aksi,
			"lap_fokus_keuangan" => $lap_fokus_keuangan,
            "lap_fokus_keuangan_aksi" => $lap_fokus_keuangan_aksi, 
			"lap_pembelian_rincian" => $lap_pembelian_rincian,
            "lap_pembelian_rincian_aksi" => $lap_pembelian_rincian_aksi, 
			"lap_pembelian_order" => $lap_pembelian_order,
            "lap_pembelian_order_aksi" => $lap_pembelian_order_aksi,  
			"lap_fokus_keuangan" => $lap_fokus_keuangan,
            "lap_fokus_keuangan_aksi" => $lap_fokus_keuangan_aksi, 
			
			"pg_restore" => urldecode($pg_restore),
            "pg_backup" => urldecode($pg_backup),
            "pg_profile" => urldecode($pg_profile),
            "pg_log" => urldecode($pg_log),
            "last_update" => date("y-m-d h:i:s"),
            "last_user_id" => $this->session->userdata("user_id")
        );

        return $dataData;
    }

    public function add() {
        $this->lib->check_session();
        $temp = "0";
        // if( isset( $_POST["datamodel"] ) )
        // $role_id = $_POST["datamodel"]; 
        $this->form_validation->set_rules("role_id", "Role", "check_selected|max_length[30]|is_unique_custom[setting_akses.role_id]");
        $error = "";
        if (isset($_POST["simpan"])) {
            if ($this->form_validation->run() == FALSE) {
                $data["tambah"] = "tambah";
                $data["error"] = "error";
                $this->load->view("data/akses_menu", $data);
            } else {
                $dataData = $this->get_array();

                $temp = $this->setting_akses->insert($dataData);
                if ($temp == "1") {
                    $this->session->set_userdata("error", "Simpan Berhasil");
                    redirect("data/akses_menu/");
                } else
                    echo "insert Gagal";
            }
        }
    }

    public function edit() {
        $this->lib->check_session();
        $this->form_validation->set_rules("role_id", "Role", "check_selected|is_unique_edit_custom[setting_akses_menu.role_id.am_id." . $_POST["datamodel"] . "]");
        $error = "";
        if (isset($_POST["ubah"])) {
            if ($this->form_validation->run() == FALSE) {
                $data["ubah"] = "ubah";
                $data["error"] = "error";
                $this->load->view("data/akses_menu_view", $data);
            } else {
                $data["permanent"] = $this->lib->cek_permanent("setting_akses_menu", "am_id", $_POST["datamodel"]);
                if ($data["permanent"]->num_rows() == 1) {
                    $this->session->set_userdata("error", "Data Tidak Dapat Diedit");
                    redirect("data/akses_menu/");
                } else {
                    $dataData = $this->get_array();
                    $temp = $this->setting_akses->update($_POST["datamodel"], $dataData);

                    if ($temp == "1") {
                        $this->session->set_userdata("error", "Edit Berhasil");
                        redirect("data/akses_menu/");
                    } else {
                        $data["ubah"] = "ubah";
                        $data["error"] = "error";
                        $this->load->view("data/akses_menu_view", $data);
                    }
                }
            }
        }
    }

    public function delete_permanent() {
        $this->lib->check_session();
        $role_id = $_POST["datamodel"];
        //$role = $this->setting_akses->get_row_by_id($role_id); 
        $data["permanent"] = $this->lib->cek_permanent("setting_akses_menu", "am_id", $_POST["datamodel"]);
        if ($data["permanent"]->num_rows() == 1) {
            $temp = "2";
        } else {
            $this->lib->log("Hapus");
            $this->setting_akses->delete_permanent($role_id);
            $temp = "1";
        }
        echo $temp;
    }

//    public function index() {
//        $this->lib->check_session();
//        Place your code here...
//    }
}
