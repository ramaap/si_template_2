<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
// echo $this->session->userdata('user_id');
$table = 'setting_akses_menu';
$join = "";
$where = "where user_id=" . $this->session->userdata('user_id');
$order_by = '';
$group_by = '';
$akses = $this->script_sql->get_data_row($table, $join, $where, $order_by, $group_by);
?>


<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div hidden class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <style>
                    .sub{
                        font-size:14px;line-height:1.2em;
                    }
                    .smenu{
                        font-size:14px;line-height:1.2em
                    }
                </style>
                <li class=""><a  class="menu" href="<?php echo site_url("dashboard"); ?>"><i class="fa fa-fw fa-home"></i>&nbsp;&nbsp;Home</a></li>
                <li class="dropdown">
                    <a href="#"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-fw fa-folder-open"></i>&nbsp;&nbsp;Data Master&nbsp;<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-header"><strong>Data Master</strong></li>
                        <?php
                        $hidden = 'hidden';
                        if ($akses->result() != null)
                            $hidden = ($akses->row()->dm_pegawai == 0) ? 'hidden' : '';
                        ?>
                        <li <?php echo $hidden; ?>><a title="<b style='font-size:14px;line-height:1.2em'>Data User</b><br/><span class='smenu'>User<br/>Divisi Pegawai<br/>Pegawai<br/>Hak Akses Menu<br/>Hak Akses Password</span>"class="menu" href="<?php echo site_url("data/pegawai/show"); ?>"><i class="fa fa-user fa-fw"></i>&nbsp;&nbsp;Data User</a></li>
                        <?php
                        $hidden = 'hidden';
                        if ($akses->result() != null)
                            $hidden = ($akses->row()->dm_produk == 0) ? 'hidden' : '';
                        ?>
                        <li <?php echo $hidden; ?>><a class="menu" title="<b style='font-size:14px;line-height:1.2em'>Data Produk</b><br/><span class='smenu'>Satuan<br/>Kategori Produk<br/>Produk<br/>Harga</span>" href="<?php echo site_url("data/produk/produk/show"); ?>"><i class="fa fa-tag fa-fw"></i>&nbsp;&nbsp;Data Produk</a></li>
                        <?php
                        $hidden = 'hidden';
                        if ($akses->result() != null)
                            $hidden = ($akses->row()->dm_pelanggan == 0) ? 'hidden' : '';
                        ?>
                        <li <?php echo $hidden; ?>><a title="<b style='font-size:14px;line-height:1.2em'>Data Supplier</b><br/><span class='smenu'>Kategori Supplier<br/>Supplier</span>" class="menu" href="<?php echo site_url("supplier/supplier/tab"); ?>"><i class="fa fa-chain fa-fw"></i>&nbsp;&nbsp;Data Supplier</a></li><?php
                        $hidden = 'hidden';
                        if ($akses->result() != null)
                            $hidden = ($akses->row()->dm_pelanggan == 0) ? 'hidden' : '';
                        ?>
                        <li <?php echo $hidden; ?>><a title="<b style='font-size:14px;line-height:1.2em'>Data Pelanggan</b><br/><span class='smenu'>Kategori Pelanggan<br/>Pelanggan<br/>Kategori Pajak</span>" class="menu" href="<?php echo site_url("data/pelanggan/pelanggan/relasi/show"); ?>"><i class="fa fa-user-plus fa-fw"></i>&nbsp;&nbsp;Data Pelanggan</a></li>
                        <?php
                        $hidden = 'hidden';
                        // if($akses->result()!=null)
                        // $hidden = ($akses->row()->dm_produk_diskon == 0) ? 'hidden' : ''; 
                        ?>
                        <li <?php echo $hidden; ?>><a class="menu" title="<b style='font-size:14px;line-height:1.2em'>Diskon By Qty</b>" href="<?php echo site_url("data/produk/diskon/show"); ?>"><img src="<?php echo base_url(); ?>include/img/diskon.png"/>&nbsp;&nbsp;Diskon By Qty</a></li>
                        <?php
                        $hidden = 'hidden';
                        // if($akses->result()!=null)
                        // $hidden = ($akses->row()->dm_produk_kategori == 0) ? 'hidden' : ''; 
                        ?>
                        <li <?php echo $hidden; ?>><a class="menu" href="<?php echo site_url("data/produk/kategori/show"); ?>"><img src="<?php echo base_url(); ?>include/img/produk.png"/>&nbsp;&nbsp;Kategori</a></li>
                        <?php
                        $hidden = 'hidden';
// if($akses->result()!=null)
// $hidden = ($akses->row()->dm_produk_paket == 0) ? 'hidden' : ''; 
                        ?>
                        <li <?php echo $hidden; ?>><a class="menu" title="<b style='font-size:14px;line-height:1.2em'>Paket Item</b>" href="<?php echo site_url("data/produk/paket/paket/show"); ?>"><img src="<?php echo base_url(); ?>include/img/paket.png"/>&nbsp;&nbsp;Paket Item</a></li>
                        <?php
                        $hidden = 'hidden';
                        // if($akses->result()!=null)
                        // $hidden = ($akses->row()->dm_pegawai == 0) ? 'hidden' : ''; 
                        ?>
                        <li <?php echo $hidden; ?>><a class="menu" href="<?php echo site_url("data/pegawai/show"); ?>" title="<b style='font-size:14px;line-height:1.2em'>Diskon Penjualan</b>"><img src="<?php echo base_url(); ?>include/img/diskon.png"/>&nbsp;&nbsp;Diskon Penjualan</a></li>
                        <?php
                        $hidden = 'hidden';

                        if ($akses->result() != null)
                            $hidden = ($akses->row()->dm_coverage == 0) ? 'hidden' : '';
                        ?>
                        <?php
                        $hidden = 'hidden';
                        if ($akses->result() != null)
                            $hidden = ($akses->row()->dm_cabang == 0) ? 'hidden' : '';
                        ?>
                        <li <?php echo $hidden; ?>><a class="menu" href="<?php echo site_url("data/coverage/show"); ?>" title="<b style='font-size:14px;line-height:1.2em'>Data Lokasi</b><br/><span class='smenu'>Cabang<br/>Lokasi<br/>Coverage Area</span>"><i class="fa fa-location-arrow fa-fw"></i>&nbsp;&nbsp;Data Lokasi</a></li>
                        <?php
                        $hidden = 'hidden';
                        if ($akses->result() != null)
                            $hidden = ($akses->row()->dm_cabang == 0) ? 'hidden' : '';
                        ?>
                        <li <?php echo $hidden; ?>><a title="<b style='font-size:14px;line-height:1.2em'>Data Kas, Rekening, & Deposit</b><br/><span class='smenu'>Kas Besar<br/>Kas Kecil<br/>Rekening<br/>Deposit Pelanggan</span>" class="menu" href="<?php echo site_url("data/cabang/profil"); ?>"><i class="fa fa-credit-card fa-fw"></i>&nbsp;&nbsp;Data Kas, Rekening, & Deposit</a></li>
                        <li <?php echo $hidden; ?>><a title="<b style='font-size:14px;line-height:1.2em'>Data Mobil</b>" class="menu" href="<?php echo site_url("data/mobil/show"); ?>"><i class="fa fa-car fa-fw"></i>&nbsp;&nbsp;Data Mobil</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#">
                        <i class="fa fa-fw fa-cubes"></i>&nbsp;&nbsp;Stok & Produksi&nbsp;<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-header"><strong>Stok</strong></li>
                        <?php
                        $hidden = 'hidden';
                        if ($akses->result() != null)
                            $hidden = ($akses->row()->dm_role == 0) ? 'hidden' : '';
                        ?>
                        <li <?php echo $hidden; ?>><a class="menu" href="<?php echo site_url("stok/display_stok/show") ?>" title="<b style='font-size:14px;line-height:1.2em'>Display Stok</b><br/><span class='smenu'>Display Stok<br/>Min & Max Stok<br/>Stok Opname<br/>Verifikasi Stok Opname<br/>History Stok</span>"><i class="fa fa-fw fa-desktop"></i>&nbsp;&nbsp;Display Stok</a></li>
                        <?php
                        $hidden = 'hidden';
                        if ($akses->result() != null)
                            $hidden = ($akses->row()->dm_role == 0) ? 'hidden' : '';
                        ?>
                        <li <?php echo $hidden; ?>><a class="menu" href="<?php echo site_url("stok/display_stok/delivery") ?>" title="<b style='font-size:14px;line-height:1.2em'>Delivery Stok</b><br/><span class='smenu'>Internal Delivery<br/>Eksternal Delivery</span>"><i class="fa fa-fw fa-exchange"></i>&nbsp;&nbsp;Delivery Stok</a></li>
                        <li style="display: none" role="separator" class="divider"></li>
                        <li style="display: none" class="dropdown-header"><strong>Produksi</strong></li>
                        <?php
                        $hidden = 'hidden';
                        if ($akses->result() != null)
                            $hidden = ($akses->row()->dm_role == 0) ? 'hidden' : '';
                        ?>
                        <li style="display: none" <?php echo $hidden; ?>><a class="menu" href="#" title="<b style='font-size:14px;line-height:1.2em'>Input Produksi</b>"><i class="fa fa-sort-amount-asc fa-fw"></i>&nbsp;&nbsp;Input Produksi</a></li>
                        <li style="display: none" <?php echo $hidden; ?>><a class="menu" href="#" title="<b style='font-size:14px;line-height:1.2em'>Output Produksi</b>"><i class="fa fa-sort-amount-desc fa-fw"></i>&nbsp;&nbsp;Output Produksi</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-fw fa-money"></i>&nbsp;&nbsp;Keuangan&nbsp;<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-header"><strong>Keuangan</strong></li>
                        <?php
                        $hidden = 'hidden';
                        if ($akses->result() != null)
                            $hidden = ($akses->row()->keu_keuangan == 0) ? 'hidden' : '';
                        ?>
                        <li <?php echo $hidden; ?>><a class="menu" title="<b style='font-size:14px;line-height:1.2em'>Manajemen Keuangan</b>" href="<?php echo site_url("keuangan/keuangan/show") ?>"><i class="fa fa-fw fa-desktop"></i>&nbsp;&nbsp;Manajemen Keuangan</a></li>
                        <?php
                        $hidden = 'hidden';
                        if ($akses->result() != null)
                            $hidden = ($akses->row()->keu_cash == 0) ? 'hidden' : '';
                        ?>
                        <li <?php echo $hidden; ?>><a class="menu" href="<?php echo site_url("keuangan/cash_besar/show") ?>"title="<b style='font-size:14px;line-height:1.2em'>Transaksi Kas Besar</b>"><i class="fa fa-fw fa-credit-card"></i>&nbsp;&nbsp;Kas Besar</a></li>
                        <?php
                        $hidden = 'hidden';
                        if ($akses->result() != null)
                            $hidden = ($akses->row()->keu_cash == 0) ? 'hidden' : '';
                        ?>
                        <li <?php echo $hidden; ?>><a class="menu" href="<?php echo site_url("keuangan/cash_kecil/show") ?>" title="<b style='font-size:14px;line-height:1.2em'>Transaksi Kas Kecil</b>"><i class="fa fa-fw fa-credit-card"></i>&nbsp;&nbsp;Kas Kecil</a></li>
                        <?php
                        $hidden = 'hidden';
                        if ($akses->result() != null)
                            $hidden = ($akses->row()->dm_user == 0) ? 'hidden' : '';
                        ?>
                        <li <?php echo $hidden; ?>><a class="menu" href="<?php echo site_url("keuangan/rekening/rekening/show") ?>"title="<b style='font-size:14px;line-height:1.2em'>Transaksi Rekening</b>"><i class="fa fa-fw fa-cc"></i>&nbsp;&nbsp;Rekening</a></li>
                        <?php
                        $hidden = 'hidden';
                        if ($akses->result() != null)
                            $hidden = ($akses->row()->dm_akses_menu == 0) ? 'hidden' : '';
                        ?>
                        <li <?php echo $hidden; ?>><a class="menu" href="<?php echo site_url("keuangan/rekening/giro/show") ?>"title="<b style='font-size:14px;line-height:1.2em'>Transaksi Giro</b>"><i class="fa fa-fw fa-ticket"></i>&nbsp;&nbsp;Giro</a></li>
                        <li  role="separator" class="divider"></li> 
                        <li  class="dropdown-header"><strong>Budgeting & Pengeluaran</strong></li>
                        <?php
                        $hidden = 'hidden';
                        if ($akses->result() != null)
                            $hidden = ($akses->row()->dm_role == 0) ? 'hidden' : '';
                        ?>
                        <li <?php echo $hidden; ?>><a class="menu" href="<?php echo site_url("data/role/show") ?>" title="<b style='font-size:14px;line-height:1.2em'>Perencanaan Pengeluraan</b>"><i class="fa fa-fw fa-calendar"></i>&nbsp;&nbsp;Perencanaan Pengeluaran</a></li>
                        <?php
                        $hidden = 'hidden';
                        if ($akses->result() != null)
                            $hidden = ($akses->row()->dm_user == 0) ? 'hidden' : '';
                        ?>
                        <li style="display:none" <?php echo $hidden; ?>><a class="menu" href="<?php echo site_url("data/users/show") ?>" title="<b style='font-size:14px;line-height:1.2em'>Kategori Pengeluaran</b>"><i class="fa fa-fw fa-calendar-plus-o"></i>&nbsp;&nbsp;Kategori Pengeluaran</a></li>
                        <?php
                        $hidden = 'hidden';
                        if ($akses->result() != null)
                            $hidden = ($akses->row()->dm_akses_menu == 0) ? 'hidden' : '';
                        ?>
                        <li style="display:none" <?php echo $hidden; ?>><a class="menu" href="<?php echo site_url("data/akses_menu/show") ?>" title="<b style='font-size:14px;line-height:1.2em'>Perencanaan Vs Realisasi Pengeluaran</b>"><i class="fa fa-fw fa-calendar-check-o"></i>&nbsp;&nbsp;Perencanaan vs Realisasi Pengeluaran</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-fw fa-thumb-tack"></i>&nbsp;&nbsp;Transaksi&nbsp;<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu multi-column columns-2">
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="multi-column-dropdown">
                                    <li class="dropdown-header"><strong>Transaksi Pembelian</strong></li>
                                    <?php
                                    $hidden = 'hidden';
                                    if ($akses->result() != null)
                                        $hidden = ($akses->row()->dm_role == 0) ? 'hidden' : '';
                                    ?>
                                    <li <?php echo $hidden; ?>><a class="menu" href="<?php echo site_url("transaksi/pembelian/order_pembelian/show") ?>" title="<b style='font-size:14px;line-height:1.2em'>Order Pembelian</b>"><i class="fa fa-fw fa-file"></i>&nbsp;&nbsp;Order Pembelian</a></li>
                                    <?php
                                    $hidden = 'hidden';
                                    if ($akses->result() != null)
                                        $hidden = ($akses->row()->dm_user == 0) ? 'hidden' : '';
                                    ?>
                                    <li <?php echo $hidden; ?>><a class="menu" href="<?php echo site_url("transaksi/pembelian/pembelian/show") ?>" title="<b style='font-size:14px;line-height:1.2em'>Data Penerimaan</b>"><i class="fa fa-fw fa-file-text"></i>&nbsp;&nbsp;Penerimaan Barang</a></li>
                                    <?php
                                    $hidden = 'hidden';
                                    if ($akses->result() != null)
                                        $hidden = ($akses->row()->dm_akses_menu == 0) ? 'hidden' : '';
                                    ?>
                                    <li style="display: none;" <?php echo $hidden; ?>><a class="menu" href="<?php echo site_url("data/akses_menu/show") ?>" title="<b style='font-size:14px;line-height:1.2em'>Retur Pembelian</b>"><i class="fa fa-fw fa-reply"></i>&nbsp;&nbsp;Retur Pembelian</a></li>
                                    <?php
                                    $hidden = 'hidden';
                                    if ($akses->result() != null)
                                        $hidden = ($akses->row()->dm_role == 0) ? 'hidden' : '';
                                    ?>
                                    <li <?php echo $hidden; ?>><a class="menu" href="<?php echo site_url("data/hutang/show") ?>" title="<b style='font-size:14px;line-height:1.2em'>Data Hutang</b>"><i class="fa fa-fw fa-minus-circle"></i>&nbsp;&nbsp;Hutang</a></li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="multi-column-dropdown">
                                    <li class="dropdown-header"><strong>Transaksi Penjualan</strong></li>
									 <?php
                                    $hidden = 'hidden';
                                    if ($akses->result() != null)
                                        $hidden = ($akses->row()->trs_penjualan_order == 0) ? 'hidden' : '';
                                    ?>
                                    <li <?php echo $hidden; ?>><a class="menu" href="<?php echo site_url("transaksi/penjualan/order_penjualan/show") ?>" title="<b style='font-size:14px;line-height:1.2em'>Order Penjualan</b>"><i class="fa fa-fw fa-file"></i>&nbsp;&nbsp;Order Penjualan</a></li>                   
                                    
									<?php
                                    $hidden = 'hidden';
                                    if ($akses->result() != null)
                                        $hidden = ($akses->row()->dm_role == 0) ? 'hidden' : '';
                                    ?>
                                    <li style="display: none;" <?php echo $hidden; ?>><a class="menu" href="<?php echo site_url("transaksi/penjualan/order_penjualan/show") ?>" title="<b style='font-size:14px;line-height:1.2em'>Order Penjualan</b>"><i class="fa fa-fw fa-file"></i>&nbsp;&nbsp;Order Penjualan</a></li>
                                    <?php
                                    $hidden = 'hidden';
                                    if ($akses->result() != null)
                                        $hidden = ($akses->row()->dm_role == 0) ? 'hidden' : '';
                                    ?>
                                    <li  <?php echo $hidden; ?>><a class="menu" href="<?php echo site_url("transaksi/penjualan/surat_jalan/show") ?>" title="<b style='font-size:14px;line-height:1.2em'>Surat Jalan</b>"><i class="fa fa-fw fa-file-pdf-o"></i>&nbsp;&nbsp;Surat Jalan</a></li>
                                    <?php
                                    $hidden = 'hidden';
                                    if ($akses->result() != null)
                                        $hidden = ($akses->row()->dm_role == 0) ? 'hidden' : '';
                                    ?>
                                    <li <?php echo $hidden; ?>><a class="menu" href="<?php echo site_url("transaksi/penjualan/faktur/show") ?>" title="<b style='font-size:14px;line-height:1.2em'>Faktur Penjualan</b>"><i class="fa fa-fw fa-file-text"></i>&nbsp;&nbsp;Faktur Penjualan</a></li>
                                    <?php
                                    $hidden = 'hidden';
                                    if ($akses->result() != null)
                                        $hidden = ($akses->row()->dm_role == 0) ? 'hidden' : '';
                                    ?>
                                    <li style="display: none;" <?php echo $hidden; ?>><a class="menu" href="<?php echo site_url("transaksi/penjualan/penjualan/show") ?>"title="<b style='font-size:14px;line-height:1.2em'>Penjualan POS</b>"><i class="fa fa-fw fa-file"></i>&nbsp;&nbsp;Penjualan POS</a></li>
                                    <?php
                                    $hidden = 'hidden';
                                    if ($akses->result() != null)
                                        $hidden = ($akses->row()->dm_akses_menu == 0) ? 'hidden' : '';
                                    ?>
                                    <li style="display: none;" <?php echo $hidden; ?>><a class="menu" href="<?php echo site_url("data/akses_menu/show") ?>" title="<b style='font-size:14px;line-height:1.2em'>Retur Penjualan</b>"><i class="fa fa-fw fa-reply"></i>&nbsp;&nbsp;Retur Penjualan</a></li>
                                    <?php
                                    $hidden = 'hidden';
                                    if ($akses->result() != null)
                                        $hidden = ($akses->row()->dm_user == 0) ? 'hidden' : '';
                                    ?>
                                    <li <?php echo $hidden; ?>><a class="menu" href="<?php echo site_url("data/piutang/show") ?>" title="<b style='font-size:14px;line-height:1.2em'>Data Piutang</b>"><i class="fa fa-fw fa-plus-circle"></i>&nbsp;&nbsp;Piutang</a></li>
                                </ul>
                            </div>
                        </div>
                    </ul>
                </li>
                <li style="display: none;" class="dropdown" >
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-fw fa-line-chart"></i>&nbsp;&nbsp;Laporan&nbsp;<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu multi-column columns-2">
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="multi-column-dropdown">
                                    <li class="dropdown-header"><strong>Laporan ...</strong></li>
                                    <?php
                                    $hidden = 'hidden';
                                    if ($akses->result() != null)
                                        $hidden = ($akses->row()->dm_akses_menu == 0) ? 'hidden' : '';
                                    ?>
                                    <li <?php echo $hidden; ?>><a class="menu" href="<?php echo site_url("data/akses_menu/show") ?>" title="<b style='font-size:14px;line-height:1.2em'>Rekap Harian Penjualan</b>"><i class="fa fa-fw fa-line-chart"></i>&nbsp;&nbsp;Rekap Harian Penjualan</a></li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="multi-column-dropdown">
                                    <li class="dropdown-header"><strong>Laporan Akuntasi</strong></li>
                                </ul>
                            </div>
                        </div>
                    </ul>
                </li>
                <li style="display: none;" class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-street-view fa-fw"></i>&nbsp;&nbsp;Lain-Lain&nbsp;<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu multi-column columns-2">
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="multi-column-dropdown">
                                    <li class="dropdown-header"><strong>Presensi</strong></li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="multi-column-dropdown">
                                    <li class="dropdown-header"><strong>Reminder</strong></li>
                                    <li <?php echo $hidden; ?>><a class="menu" href="<?php echo site_url("pengaturan/profile/show") ?>" title="<b style='font-size:14px;line-height:1.2em'>Jatuh Tempo Hutang</b>"><i class="fa fa-bell fa-fw"></i>&nbsp;&nbsp;Jatuh Tempo Hutang</a></li>
                                    <li <?php echo $hidden; ?>><a class="menu" href="<?php echo site_url("pengaturan/profile/show") ?>"title="<b style='font-size:14px;line-height:1.2em'>Jatuh Tempo Piutang</b>"><i class="fa fa-bell fa-fw"></i>&nbsp;&nbsp;Jatuh Tempo Piutang </a></li>
                                </ul>
                            </div>
                        </div>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-fw fa-gear"></i>&nbsp;&nbsp;Pengaturan&nbsp;<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-header"><strong>Database</strong></li>
                        <?php
                        $hidden = 'hidden';
                        if ($akses->result() != null)
                            $hidden = ($akses->row()->pg_backup == 0) ? 'hidden' : '';
                        ?>
                        <li <?php echo $hidden; ?>><a class="menu" href="<?php echo site_url("pengaturan/databased/backup") ?>" title="<b style='font-size:14px;line-height:1.2em'>Backup</b>"><i class="fa fa-fw fa-database"></i>&nbsp;&nbsp;Backup Database</a></li>
                        <?php
                        $hidden = 'hidden';
                        if ($akses->result() != null)
                            $hidden = ($akses->row()->pg_restore == 0) ? 'hidden' : '';
                        ?>
                        <li <?php echo $hidden; ?>><a class="menu" href="<?php echo site_url("pengaturan/databased/restore") ?>" title="<b style='font-size:14px;line-height:1.2em'>Restore</b>"><i class="fa fa-fw fa-database"></i>&nbsp;&nbsp;Restore Database</a></li>
                        <li role="separator" class="divider"></li>
                        <li class="dropdown-header"><strong>Sistem</strong></li>
                        <?php
                        $hidden = 'hidden';
                        if ($akses->result() != null)
                            $hidden = ($akses->row()->pg_profile == 0) ? 'hidden' : '';
                        ?>
                        <li <?php echo $hidden; ?>><a class="menu" href="<?php echo site_url("pengaturan/profile/show") ?>" title="<b style='font-size:14px;line-height:1.2em'>Profile</b>"><i class="fa fa-fw fa-briefcase"></i>&nbsp;&nbsp;Profile</a></li>
                        <?php
                        $hidden = 'hidden';
                        if ($akses->result() != null)
                            $hidden = ($akses->row()->pg_log == 0) ? 'hidden' : '';
                        ?>
                        <li <?php echo $hidden; ?>><a href="<?php echo site_url("lainnya/log") ?>" title="<b style='font-size:14px;line-height:1.2em'>Log</b>"><i class="fa fa-fw fa-clock-o"></i>&nbsp;&nbsp;Log</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <strong>&nbsp;&nbsp;Welcome, <?php echo $this->session->userdata('user_name'); ?>&nbsp;</strong><span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="menu" href="<?php echo site_url("login/pass"); ?>" title="<b style='font-size:14px;line-height:1.2em'>Change Password</b>"><i class="fa fa-fw fa-key"></i>&nbsp;&nbsp;Change Password</a></li>
                        <li><a class="menu" href="<?php echo site_url('login/logout') ?>" title="<b style='font-size:14px;line-height:1.2em'>Logout</b>"><i class="fa fa-fw fa-sign-out"></i>&nbsp;&nbsp;Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>