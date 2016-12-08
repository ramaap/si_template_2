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
<?php
$this->load->view('common/javascript');
	$this->load->view('common/time');

?>

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
					.sub_judul{
						    padding-top: 10px;
							padding-bottom: 10px;
					}
                </style>
               <li>
				<div class="sub_judul"><?php echo $this->session->userdata("subtitle"); ?></div>
               </li>
                <!--<li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-fw fa-thumb-tack"></i>&nbsp;&nbsp;Transaksi&nbsp;<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
							 </ul>
                </li>  -->
				<?php
							$hidden = 'hidden';
							if ($akses->result() != null)
							$hidden = ($akses->row()->trs_penjualan_order == 0) ? 'hidden' : '';
							?>
							<li <?php echo $hidden; ?>><a class="menu" href="<?php echo site_url("transaksi/penjualan/mobile/order_penjualan_mobile/show") ?>" ><i class="fa fa-fw fa-file"></i>&nbsp;&nbsp;Order Penjualan</a></li>                   												
                  
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <strong>&nbsp;&nbsp;Welcome, <?php echo $this->session->userdata('user_name'); ?>&nbsp;</strong><span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                       <li><a class="menu" href="<?php echo site_url('login/logout') ?>" ><i class="fa fa-fw fa-sign-out"></i>&nbsp;&nbsp;Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>