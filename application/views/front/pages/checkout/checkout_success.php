<!DOCTYPE html>
<html>
<?php $this->load->view('front/slice/head_checkout'); ?>
<body class="checkout-4">
<?php $this->load->view('front/slice/menu'); ?>

	<div class="main container">
		<div class="stages">
			<div class="stage one">
				<div class="round-container">
					<a href="#">
						<span class="round">1</span>
					</a>
				</div>
				<span>Pilih Produk</span>
			</div>
			<div class="stage two">
				<div class="round-container">
					<a href="#">
						<span class="round">2</span>
					</a>
				</div>
				<span>Pembayaran</span>
			</div>
			<div class="stage three">
				<div class="round-container">
					<a href="#">
						<span class="round">3</span>
					</a>
				</div>
				<span>Konfirmasi Pembayaran</span>
			</div>
			<div class="stage four">
				<div class="round-container">
					<a href="#">
						<span class="round">4</span>
					</a>
				</div>
				<span>Selesai!</span>
			</div>
			<div class="clear"></div>
		</div>
		<div class="cart-checkout">
			<div class="image">
				<h3>Voila Selesai!</h3>
				<div class="image-container">
					<img src="<?php echo base_url(); ?>include/front/images/checkout/success.jpg">
				</div>
				<h3>Terima kasih sudah memesan</h3>
				<h3>Pesanan anda dengan kode <strong>PX-09128309</strong> segera kami proses</h3>
				<div class="attention">
					<p>*Lorem ipsum dolor sit amet, mei sint concludaturque ea. An nam nostrum disputando, mea ei agam</p>
					<p>*Lorem ipsum dolor sit amet, mei sint concludaturque ea. An nam nostrum disputando, mea ei agam</p>
					<p>*Lorem ipsum dolor sit amet, mei sint concludaturque ea. An nam nostrum disputando, mea ei agam</p>
				</div>
			</div>
			<div class="pembayaran">
				<div class="head">
					<p>Silakan Lengkapi pembayaran anda dengan transfer sejumlah:</p>
				</div>
				<div class="container">
					<div class="left column">
						<strong>IDR 34.000,-</strong>
						<p>ke</p>
					</div>
					<div class="right column">
						<div class="bank">
							<div class="bca">
								<img src="<?php echo base_url(); ?>include/front/images/checkout/bca.png">
								<strong>
									<p>Lorem ipsum dolor</p>
									<p>0912 0912 0912 0912</p>
									<p>Loremdolor Koasjdo</p>
								</strong>
							</div>
						</div>
					</div>
					
				</div>
				<div class="clear"></div>
			</div>

			<div class="confirm-alert">
				<p>Lorem ipsum dolor sit amet, mei sint concludaturque ea. An nam nostrum disputando, mea ei agam</p>
				<p>Lorem ipsum dolor sit amet, mei sint concludaturque ea. An nam nostrum </p>
				<p>Lorem ipsum dolor sit amet, mei sint concludaturque ea.</p>
			</div>
			<div class="etc">
				<h3>Sudah Melakukan Pembayaran?</h3>
				<div class="payed">
					<div class="button-payed">
						<a href="../index.html">
								<span>
									Konfirmasi Pembayaran
								</span>
						</a>
					</div>
				</div>
				<div class="back">
					<div class="button-back">
						<a href="<?php echo site_url("home"); ?>">
								<span>
									Kembali ke Beranda
								</span>
						</a>
					</div>
				</div>
				<div>
					
				<h3>Sudah Melengkapi Bussiness Kit Anda?</h3>
				<ul class="bxslider">
					<li>
						<img src="<?php echo base_url(); ?>include/front/images/index/pixaprint/1.png" />
						<h2>Kartu Nama</h2>
						<span>
							<p>Mulai dari IDR1600/box</p>
						</span>
					</li>
					<li>
						<img src="../images/index/pixaprint/2.png" />
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
			</div>
		</div>
	</div>


	<script type="text/javascript">
		$(document).ready(function(){
		  $('.bxslider').bxSlider({
		  	    slideWidth: 1000,
			    minSlides: 4,
			    maxSlides: 4,
			    slideMargin: 10,
				pager:false
		  });
		});

		var $toEqualize = $('.column');
		$toEqualize.css('height', (function(){
		return Math.max.apply(null, $toEqualize.map(function(){
		return $(this).height();
		}).get());
		})());
	</script>

        <?php $this->load->view('front/slice/footer'); ?>
</body>
</html>