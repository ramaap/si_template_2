<!DOCTYPE html>
<html>
<?php $this->load->view('front/slice/head_checkout'); ?>
<body class="checkout-2">
<?php $this->load->view('front/slice/menu'); ?>

 <script type="text/javascript">
			function deleted(index)
			{
				var x;
				if (confirm("Menghapus data cart ini?") == true) {
					 $.ajax({
                    type: "POST",
                            url: "<?php echo site_url('front/checkout/checkout_pembayaran/delete_permanent') ?>",
                            timeout: 20000,
                            data:
                            'datamodel=' + index

                            , success: function(result) {
								// alert(result);
                            if (result == "1")
                            {
								alert('Hapus sukses');
                                    location.reload();
                                    window.location.replace("<?php echo site_url('front/checkout/checkout_pembayaran/'); ?>");
                            }
                            else
                                alert("Kode Eror [100] : Terjadi kesalahan saat eksekusi permintaan<br/><br/>Status: gagal menerima data dari server");
                            },
                            error: function(html) {
								alert("Kode Eror [" + html.status + "]<br/><br/>Status:" + html.statusText);
                            }

                    });
				} else {
					alert("Batal Menghapus data");
				}
            }
 </script>


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
			<div>
				<div class="head">
					<span>Your Cart</span>
				</div>
				<div class="cart-container">
				<?php
				foreach($cart as $val)
				{
				?>
					<center><img style="width:400px;height:200px;" src="<?php echo base_url(); ?>include/order/<?php echo $val->foto_front; ?>"></center>
					<div class="items">
						<h3 class="item-name"><?php echo $val->nama; ?></h3>
						<div class="detailed">
							<ul>
								<li>
									<label>Ukuran</label>
									<span>:<?php echo $val->ukuran; ?></span>
								</li>
								<li>
									<label>Tipe Kertas</label>
									<span>: <?php echo $val->kertas_nama; ?></span>
								</li>
								<li>
									<label>Sisi Cetak</label>
									<span>: <?php echo $val->sisi_cetak; ?> Muka</span>
								</li>
								<li>
									<label>Finishing</label>
									<span>: <?php echo $val->tambahan_ket; ?></span>
								</li>
								<li>
									<label>Jumlah Order</label>
									<span>: <?php echo $val->jumlah; ?></span>
								</li>
								<li>
									 <a title="Hapus Data" id="datamodel_<?php echo $val->cart_id; ?>" value="<?php echo $val->cart_id; ?>"  onclick="deleted(<?php echo $val->cart_id; ?>)">hapus</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="separator"></div>
					<div class="total">
						<label>Total</label>
						<strong>IDR <?php echo number_format($val->harga_total,0,",","."); ?>,-</strong>
					</div>
					<br/>
				<?php } ?>
					<div class="total" align="right">
						<label>TOTAL ORDER : </label>
						<strong>IDR <?php echo number_format($total->total,0,",","."); ?>,-</strong>
					</div>
					<div class="lanjutkan">
						<span>Lanjutkan</span>
					</div>
				</div>

				<div class="shipping">
					<h2>Informasi Pengiriman</h2>
					<p>
						Lorem ipsum dolor sit amet, mei sint concludaturque ea. An nam nostrum disputando, mea ei agam qualisque cotidieque, ne dolores intellegebat ius. Dicit nonumes vim cu, ad vix imperdiet assentior.
					</p>
					<form>
						<ul>
							<li>
								<label>Nama Lengkap</label>
								<input placeholder="Nama Lengkap">
							</li>
							<li>
								<label>Email</label>
								<input placeholder="Email">
							</li>
							<li>
								<label>No Telp</label>
								<input placeholder="No Telpon">
							</li>
							<li>
								<label>Alamat</label>
								<textarea placeholder="Alamat"></textarea>
							</li>
							<li>
								<label>Provinsi</label>
								<select>
									<option>Provinsi</option>
									<option>Yogyakarta</option>
									<option>Jakarta</option>
								</select>
							</li>
							<li>
								<label>Kota</label>
								<select>
									<option>Kota</option>
									<option>Yogyakarta</option>
									<option>Jakarta</option>
								</select>
							</li>
							<li>
								<label>Kecamatan</label>
								<select>
									<option>kecamatan</option>
									<option>Yogyakarta</option>
									<option>Jakarta</option>
								</select>
							</li>
							<li>
								<label>Kodepos</label>
								<input placeholder="Kodepos">
							</li>
						</ul>
					</form>
					<div class="lanjutkan">
						<span>Lanjutkan</span>
					</div>
				</div>
				<div class="billing">
					<h2>Informasi Pengiriman</h2>
					<input class="checkbox" type="checkbox" name="same" value="same">Sama dengan Shipping Address<br>
					<form>
						<ul>
							<li>
								<label>Nama Lengkap</label>
								<input placeholder="Nama Lengkap">
							</li>
							<li>
								<label>Email</label>
								<input placeholder="Email">
							</li>
							<li>
								<label>No Telp</label>
								<input placeholder="No Telpon">
							</li>
							<li>
								<label>Alamat</label>
								<textarea placeholder="Alamat"></textarea>
							</li>
							<li>
								<label>Provinsi</label>
								<select>
									<option>Provinsi</option>
									<option>Yogyakarta</option>
									<option>Jakarta</option>
								</select>
							</li>
							<li>
								<label>Kota</label>
								<select>
									<option>Kota</option>
									<option>Yogyakarta</option>
									<option>Jakarta</option>
								</select>
							</li>
							<li>
								<label>Kecamatan</label>
								<select>
									<option>kecamatan</option>
									<option>Yogyakarta</option>
									<option>Jakarta</option>
								</select>
							</li>
							<li>
								<label>Kodepos</label>
								<input placeholder="Kodepos">
							</li>
						</ul>
					</form>
					<a href="<?php echo site_url("front/checkout/checkout_confirm/"); ?>">
						<div class="lanjutkan">
							<span>Lanjutkan Pemesanan</span>
						</div>
					</a>
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