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
							<h2>Login</h2>
							<p>Masuk untuk mempercepat proses pemeriksaan</p>
							<?php
							$attributes = array('class' => 'form-signin');
							echo form_open('front/login_customer', $attributes);
							?>
							<div class="username">
								<input type="text" name="username" class="form-control" placeholder="Username" required="" autofocus="">
							</div>
							<div class="password">
								 <input type="password" name="password" class="form-control" placeholder="Password" required="">
							</div>
							<div class="button-login" >
								<button type="submit">
									<span>
										<span>
											Login
										</span>
									</span>
								</button>
							</div>
							<div class="button-signup">
								 <a onclick="sign_up()" class="btn btn-lg btn-danger">
								 <span>
										<span>
											Sign Up
										</span>
									</span>
								 </a>
							</div>
							<div class="clear"></div>
						</div>
						<!--div class="facebook">
							<p>atau</p>
							<div class="button-facebook">
								<button>
									<span>
										<span>
											Masuk Melalui Facebook
										</span>
									</span>
								</button>
							</div>
							
						</div-->
					</div>
					<!--div class="separator"></div>
					<div class="right column">
						<div class="button-quick">
							<div>
								<button>
									<span>
										<span>
											Quick Order	
										</span>
									</span>
								</button>
							</div>
							<p>Atau clik bila tidak ingin membuat akun</p>
						</div>
					</div-->
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
		
		function sign_up()
		{
			window.location.replace("<?php echo site_url('front/sign_up'); ?>");
		}
    </script>

        <?php $this->load->view('front/slice/footer'); ?>
</body>
</html>