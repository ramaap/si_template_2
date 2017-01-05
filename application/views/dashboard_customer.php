<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"> 
		<?php $this->load->view('common/head_front'); ?>
    </head>
	<?php
	$profile = $this->data_profile->get_all();
				?>
    <body style="background:#ffffff;background-repeat: no-repeat;background-position: center;">
        <div id="container">
			_____________________________________________________________________________
			</br>
			USER ID CUSTOMER : <?php echo $this->session->userdata('user_customer_id');?>
			</br>
			NAMA CUSTOMER :<?php echo $this->session->userdata('user_name');?>
			</br>
			<a class="menu" href="<?php echo site_url('front/cart/') ?>" >Cart</a>
			</br>
			<a class="menu" href="<?php echo site_url('login_customer/logout') ?>" >Logout</a>
        </div>
        <?php //$this->load->view('common/footer'); ?>
        <script src="<?php echo base_url(); ?>include/js/bootstrap.min.js"></script>
    </body>
</html>