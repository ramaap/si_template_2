<!DOCTYPE html>
<html>
<?php $this->load->view('front/slice/head_catalog'); ?>
<body class="catalog">
<?php $this->load->view('front/slice/menu'); ?>

	<div class="main container">
	<?php $this->load->view('front/slice/carousel'); ?>
		<div id="ourproduct">
			<h2>OUR PRODUCT</h2>
			<div class="ourproduct-container">
				<div class="row">
				  <div class="col-sm-4">
					<div class="image-container">
						<a href="<?php echo site_url("front/checkout/product_detail_business_card/"); ?>">
							<img src="<?php echo base_url(); ?>include/front/images/index/pixaprint.png">
						</a>
							<div><p>Business Card</p></div>
					</div>
				  </div>
				  <div class="col-sm-4">
					<div class="image-container">
						<a href="<?php echo site_url("front/checkout/product_detail_flyer/"); ?>">
							<img src="<?php echo base_url(); ?>include/front/images/index/pixaprint.png">
						</a>
							<div><p>Flyer</p></div>
					</div>
				  </div>
				  <div class="col-sm-4">
					<div class="image-container">
						<a href="#">
							<img src="<?php echo base_url(); ?>include/front/images/index/pixaprint.png">
						</a>
							<div><p>Title</p></div>
					</div>
				  </div>
				</div>
				<div class="row">
				  <div class="col-sm-4">
					<div class="image-container">
						<a href="#">
							<img src="<?php echo base_url(); ?>include/front/images/index/pixaprint.png">
						</a>
							<div><p>Title</p></div>
					</div>
				  </div>
				  <div class="col-sm-4">
					<div class="image-container">
						<a href="#">
							<img src="<?php echo base_url(); ?>include/front/images/index/pixaprint.png">
						</a>
							<div><p>Title</p></div>
					</div>
				  </div>
				  <div class="col-sm-4">
					<div class="image-container">
						<a href="#">
							<img src="<?php echo base_url(); ?>include/front/images/index/pixaprint.png">
						</a>
							<div><p>Title</p></div>
					</div>
				  </div>
				</div>
			</div>
		</div> 
	</div>

        <?php $this->load->view('front/slice/footer'); ?>
</body>
</html>