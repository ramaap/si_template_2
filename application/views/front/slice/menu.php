	<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	?>
	<header>
		<div class="page-header-container">
			<div class="logo">
				<a href="<?php echo site_url('front/home') ?>"><img src="<?php echo base_url(); ?>include/front/images/header/logo.png"></a>
			</div>
			<div class="menu-nav">
				<ul>
					<li><a href="#">Who we are</a></li>
					<li><a href="#">What we make</a></li>
					<li><a href="#">Contact</a></li>
					<li><a href="#">Question?</a></li>
				</ul>
			</div>
			<div class="menu-action">
				<?php
				if($this->session->userdata('user_customer_id') != "")
				{
					$counter = $this->db->query("select count(u.nama) as jml_cart from data_cart u
								  where u.is_delete=0 
								  and u.user_id = ".$this->session->userdata('user_customer_id')."
								  ")->row();
				?>
					<div class="login">
						Welcome, <?php echo $this->session->userdata('user_name')?><br/>
						<a href="<?php echo site_url('front/login_customer/logout')?>">Log out</a>
					</div>
					<div class="separator"></div>
					<div class="cart">
						<a href="<?php echo site_url('front/checkout/checkout_pembayaran')?>">
							<img src="<?php echo base_url(); ?>include/front/images/header/cart.png">
							<div class="counter"><?php echo $counter->jml_cart ?></div>
						</a>
					</div>
				<?php
				}else{
				?>
					<div class="login"><a href="<?php echo site_url('front/login_customer')?>">Login</a></div>
				<?php }?>
			</div>
			<div class="clear"></div>
		</div>
	</header>