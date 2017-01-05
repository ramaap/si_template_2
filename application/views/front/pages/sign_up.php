<!DOCTYPE html>
<html>
<?php $this->load->view('front/slice/head_checkout'); ?>
<body class="checkout-2">
<?php $this->load->view('front/slice/menu'); ?>

	<div class="main container">
		<div class="cart-checkout">
			<div>

				<div class="login">
					<div class="left column">
						<div class="login-container">
							<h2>Sign Up</h2>
							<p>Silahkan Daftar untuk dapat melakukan Order</p>
							<?php
							$attributes = array('class' => 'form-signin');
							echo form_open('front/sign_up/add', $attributes);
							?>
							<div class="email">
								<input type="text" name="customer_nama" class="form-control" placeholder="*Nama" required="">
							</div>
							<div class="email">
								<input type="text" name="customer_email" class="form-control" placeholder="*e-mail" required="" autofocus="">
							</div>
							<div class="password">
								 <input type="password" name="password1" class="form-control" placeholder="*Password" required="">
							</div>
							<div class="password">
								 <input type="password" name="password2" class="form-control" placeholder="*Ulang Password" required="">
							</div>
							<div class="email">
								<input type="text" name="customer_telp" class="form-control" placeholder="Telp/HP">
							</div>
							<div class="email">
								<textarea type="text" name="customer_alamat" class="form-control" placeholder="Alamat" ></textarea>
							</div>
							<div class="email">
								<input type="text" name="customer_provinsi" class="form-control" placeholder="Provinsi" >
							</div>
							<div class="email">
								<input type="text" name="customer_kota" class="form-control" placeholder="Kota">
							</div>
							<div class="email">
								<input type="text" name="customer_kecamatan" class="form-control" placeholder="Kecamatan">
							</div>
							<div class="email">
								<input type="number" name="customer_kode_pos" class="form-control" placeholder="Kode Pos">
							</div>
							<p><i>*) Wajib diisi</i></p>
							<div class="button-login" >
								<button type="submit">
									<span>
										<span>
											Sign Up
										</span>
									</span>
								</button>
							</div>
							<?php echo form_close(); ?>
							<div class="clear"></div>
						</div>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
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