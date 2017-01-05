<!DOCTYPE html>
<html>

<?php $this->load->view('front/slice/head_home'); ?>
<body class="index">
<?php $this->load->view('front/slice/menu'); ?>

	<div class="main container">
	<?php $this->load->view('front/slice/carousel'); ?>

		<div class="middle">
			<div class="row middle-container">
				<div class="col-sm-6 pixaprint">
					<div class="image-container">
						<a href="<?php echo site_url("front/catalog/"); ?>">
							<img src="<?php echo base_url(); ?>include/front/images/index/pixaprint.png">
						</a>
					</div>
				</div>
				<div class="col-sm-6 pixadesign">
					<div class="image-container">
						<a href="">
							<img src="<?php echo base_url(); ?>include/front/images/index/pixadesign.png">
						</a>
					</div>
				</div>
			</div>
			<div id="question">
				<h3>Apa yang anda butuhkan?</h3>
			</div>
		</div>

		<div class="below">
			<div class="pixaprint container">
				<div class="title">
					<img src="<?php echo base_url(); ?>include/front/images/index/pixaprint/logo.png">
				</div>
				<ul class="bxslider">
					<li>
						<img src="<?php echo base_url(); ?>include/front/images/index/pixaprint/1.png" />
						<h2>Kartu Nama</h2>
						<span>
							<p>Mulai dari IDR1600/box</p>
						</span>
					</li>
					<li>
						<img src="<?php echo base_url(); ?>include/front/images/index/pixaprint/2.png" />
						<h2>Kartu Nama</h2>
						<span>
							<p>Mulai dari IDR1600/box</p>
						</span>
					</li>
					<li>
						<img src="<?php echo base_url(); ?>include/front/images/index/pixaprint/3.png" />
						<h2>Kartu Nama</h2>
						<span>
							<p>Mulai dari IDR1600/box</p>
						</span>
					</li>
					<li>
						<img src="<?php echo base_url(); ?>include/front/images/index/pixaprint/4.png" />
						<h2>Kartu Nama</h2>
						<span>
							<p>Mulai dari IDR1600/box</p>
						</span>
					</li>
					<li>
						<img src="<?php echo base_url(); ?>include/front/images/index/pixaprint/1.png" />
						<h2>Kartu Nama</h2>
						<span>
							<p>Mulai dari IDR1600/box</p>
						</span>
					</li>
					<li>
						<img src="<?php echo base_url(); ?>include/front/images/index/pixaprint/2.png" />
						<h2>Kartu Nama</h2>
						<span>
							<p>Mulai dari IDR1600/box</p>
						</span>
					</li>
					<li>
						<img src="<?php echo base_url(); ?>include/front/images/index/pixaprint/3.png" />
						<h2>Kartu Nama</h2>
						<span>
							<p>Mulai dari IDR1600/box</p>
						</span>
					</li>
					<li>
						<img src="<?php echo base_url(); ?>include/front/images/index/pixaprint/4.png" />
						<h2>Kartu Nama</h2>
						<span>
							<p>Mulai dari IDR1600/box</p>
						</span>
					</li>
				</ul>
			</div>
			<div class="pixadesign container">
				<div class="title">
					<img src="<?php echo base_url(); ?>include/front/images/index/pixadesign/logo.png">
				</div>
				<ul class="bxslider">
					<li>
						<img src="<?php echo base_url(); ?>include/front/images/index/pixadesign/1.png" />
						<h2>Kartu Nama</h2>
						<span>
							<p>Mulai dari IDR1600/box</p>
						</span>
					</li>
					<li>
						<img src="<?php echo base_url(); ?>include/front/images/index/pixadesign/2.png" />
						<h2>Kartu Nama</h2>
						<span>
							<p>Mulai dari IDR1600/box</p>
						</span>
					</li>
					<li>
						<img src="<?php echo base_url(); ?>include/front/images/index/pixadesign/3.png" />
						<h2>Kartu Nama</h2>
						<span>
							<p>Mulai dari IDR1600/box</p>
						</span>
					</li>
					<li>
						<img src="<?php echo base_url(); ?>include/front/images/index/pixadesign/4.png" />
						<h2>Kartu Nama</h2>
						<span>
							<p>Mulai dari IDR1600/box</p>
						</span>
					</li>
					<li>
						<img src="<?php echo base_url(); ?>include/front/images/index/pixadesign/1.png" />
						<h2>Kartu Nama</h2>
						<span>
							<p>Mulai dari IDR1600/box</p>
						</span>
					</li>
					<li>
						<img src="<?php echo base_url(); ?>include/front/images/index/pixadesign/2.png" />
						<h2>Kartu Nama</h2>
						<span>
							<p>Mulai dari IDR1600/box</p>
						</span>
					</li>
					<li>
						<img src="<?php echo base_url(); ?>include/front/images/index/pixadesign/3.png" />
						<h2>Kartu Nama</h2>
						<span>
							<p>Mulai dari IDR1600/box</p>
						</span>
					</li>
					<li>
						<img src="<?php echo base_url(); ?>include/front/images/index/pixadesign/4.png" />
						<h2>Kartu Nama</h2>
						<span>
							<p>Mulai dari IDR1600/box</p>
						</span>
					</li>
				</ul>
			</div>
		</div>
	</div>


	<script type="text/javascript">
		$(document).ready(function(){
		  $('.pixaprint .bxslider').bxSlider({
		  	    slideWidth: 1000,
			    minSlides: 4,
			    maxSlides: 4,
			    slideMargin: 10,
				pager:false
		  });
		});
		$(document).ready(function(){
		  $('.pixadesign .bxslider').bxSlider({
		  	    slideWidth: 1000,
			    minSlides: 4,
			    maxSlides: 4,
			    slideMargin: 10,
				pager:false
		  });
		});
	</script>
        <?php $this->load->view('front/slice/footer'); ?>
</body>
</html>