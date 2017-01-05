<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
// echo $this->session->userdata('user_id');
$table = 'setting_akses_menu';
$join = "";
$where = "where role_id=" . $this->session->userdata('role_id');
$order_by = '';
$group_by = '';
$akses = $this->script_sql->get_data_row($table, $join, $where, $order_by, $group_by);
?>

<script type="text/javascript">
function pembayaran () {
    // window.location.replace("<?php echo site_url('keuangan/piutang/'); ?>");
    javascript:popup_full("<?php echo site_url('keuangan/piutang_massal/') ?>");
}
</script>

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
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
						<li class="dropdown-submenu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" ><i class="fa fa-fw fa-user"></i>&nbsp;&nbsp;Data User</a>
								<ul class="dropdown-menu">
									
									<?php
									$hidden = 'hidden';
									if ($akses->result() != null)
										$hidden = ($akses->row()->dm_user == 0) ? 'hidden' : '';
									?>
									<li <?php echo $hidden; ?>><a class="menu" href="<?php echo site_url("data/users/show"); ?>"><i class="fa fa-user fa-fw"></i>&nbsp;&nbsp;Data User</a></li>
									<?php
									// $hidden = 'hidden';
									// if ($akses->result() != null)
										// $hidden = ($akses->row()->dm_akses_menu == 0) ? 'hidden' : '';
									?>
									<!--li <?php //echo $hidden; ?>><a class="menu" href="<?php //echo site_url("data/akses_menu/show"); ?>"><i class="fa fa-user-times fa-fw"></i>&nbsp;&nbsp;Setting Akses Menu</a></li-->
									
								</ul>
						</li>
						<li class="dropdown-submenu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" ><i class="fa fa-fw fa-tags"></i>&nbsp;&nbsp;Data Produk</a>
								<ul class="dropdown-menu">
									<li><a class="menu" href="<?php echo site_url("data/kategori_produk/show"); ?>"><i class="fa fa-list-ul fa-fw"></i>&nbsp;&nbsp;Kategori Produk</a></li>
							
									<li><a class="menu" href="<?php echo site_url("data/produk/show"); ?>"><i class="fa fa-tags fa-fw"></i>&nbsp;&nbsp;Produk</a></li>
								</ul>
						</li>
                    </ul>
                </li>
                <li class=""><a  class="menu" href="<?php echo site_url("data/customer/show"); ?>"><i class="fa fa-fw fa-users"></i>&nbsp;&nbsp;Pengelolaan Member</a></li>
                <li class=""><a  class="menu" href="<?php echo site_url("data/customer/show"); ?>"><i class="fa fa-fw fa-list-ol"></i>&nbsp;&nbsp;Pengelolaan Order</a></li>
                <li class=""><a  class="menu" href="<?php echo site_url("data/customer/show"); ?>"><i class="fa fa-fw fa-list-ol"></i>&nbsp;&nbsp;Pengelolaan Custom Order</a></li>
                <li class=""><a  class="menu" href="<?php echo site_url("data/customer/show"); ?>"><i class="fa fa-fw fa-file"></i>&nbsp;&nbsp;Laporan</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-fw fa-gear"></i>&nbsp;&nbsp;Pengaturan&nbsp;<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
						
                                    
						<li class="dropdown-submenu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" ><i class="fa fa-fw fa-database"></i>&nbsp;&nbsp;Database</a>
								<ul class="dropdown-menu">
									
									<?php
									$hidden = 'hidden';
									if ($akses->result() != null)
										$hidden = ($akses->row()->pg_backup == 0) ? 'hidden' : '';
									?>
									<li <?php echo $hidden; ?>><a class="menu" href="<?php echo site_url("pengaturan/databased/backup") ?>" ><i class="fa fa-fw fa-database"></i>&nbsp;&nbsp;Backup Database</a></li>
									<?php
									$hidden = 'hidden';
									if ($akses->result() != null)
										$hidden = ($akses->row()->pg_restore == 0) ? 'hidden' : '';
									?>
									<li <?php echo $hidden; ?>><a class="menu" href="<?php echo site_url("pengaturan/databased/restore") ?>" ><i class="fa fa-fw fa-database"></i>&nbsp;&nbsp;Restore Database</a></li>
								</ul>
						</li>
						
						<li role="separator" class="divider"></li>
						<li class="dropdown-submenu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" ><i class="fa fa-fw fa-gear"></i>&nbsp;&nbsp;Sistem</a>
								<ul class="dropdown-menu">
									
									<?php
									$hidden = 'hidden';
									if ($akses->result() != null)
										$hidden = ($akses->row()->pg_profile == 0) ? 'hidden' : '';
									?>
									<li <?php echo $hidden; ?>><a class="menu" href="<?php echo site_url("pengaturan/profile/show") ?>" ><i class="fa fa-fw fa-briefcase"></i>&nbsp;&nbsp;Pengaturan Profil</a></li>
									
									<?php
									$hidden = 'hidden';
									if ($akses->result() != null)
										$hidden = ($akses->row()->pg_log == 0) ? 'hidden' : '';
									?>
									<li <?php echo $hidden; ?>><a href="<?php echo site_url("lainnya/log") ?>" ><i class="fa fa-fw fa-clock-o"></i>&nbsp;&nbsp;Log</a></li>
								</ul>
						</li>
								
					</ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <strong>&nbsp;&nbsp;Welcome, <?php echo $this->session->userdata('user_name'); ?>&nbsp;</strong><span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="menu" href="<?php echo site_url("login/pass"); ?>" ><i class="fa fa-fw fa-key"></i>&nbsp;&nbsp;Change Password</a></li>
                        <li style="" role="separator" class="divider"></li>
						<li><a class="menu" href="<?php echo site_url('login/logout') ?>" ><i class="fa fa-fw fa-sign-out"></i>&nbsp;&nbsp;Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>