<!DOCTYPE html>
<html>
<?php $this->load->view('front/slice/head_checkout'); ?>
<body class="checkout-1">
<?php $this->load->view('front/slice/menu'); ?>

    <script type="text/javascript">
	
	function str_replace(str,replace,join)	//daftar lib
		{
			replace = typeof replace !== 'undefined' ? replace : "";
			join = typeof join !== 'undefined' ? join : "";
			return str.split(replace).join(join).trim(" ");
		}
	function currency_format(jumlah)
	{
		var x = +jumlah + +0;
		 n = x.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
		 n=str_replace(n,".","~");
		 n=str_replace(n,",",".");
		 n=str_replace(n,"~",",");
		 return n;
	}
	
	function cek_harga()
	{
		jenis_kertas = $("#jenis_kertas").val();
		sisi_cetak = $("#sisi_cetak").val();
		tambahan_ket = $("#tambahan_ket").val();
		jumlah = $("#jumlah").val();
		harga = 0;
		tambahan = 0;
		if(jenis_kertas == 1) // art carton
		{
			if(jumlah == '1-5 Box')
			{
				if(sisi_cetak == 1)
					harga = 18000;
				else
					harga = 36000;
			}
			else if(jumlah == '6-9 Box')
			{
				if(sisi_cetak == 1)
					harga = 15000;
				else
					harga = 30000;
			}
			else
			{
				if(sisi_cetak == 1)
					harga = 13000;
				else
					harga = 26000;
			}
		}
		else if(jenis_kertas == 2)// art carton laminasi
		{
			if(jumlah == '1-5 Box')
			{
				if(sisi_cetak == 1)
					harga = 30000;
				else
					harga = 60000;
			}
			else if(jumlah == '6-9 Box')
			{
				if(sisi_cetak == 1)
					harga = 27000;
				else
					harga = 54000;
			}
			else
			{
				if(sisi_cetak == 1)
					harga = 25000;
				else
					harga = 50000;
			}
		}
		else if(jenis_kertas == 3)// coronado
		{
			if(jumlah == '1-5 Box')
			{
				if(sisi_cetak == 1)
					harga = 40000;
				else
					harga = 80000;
			}
			else if(jumlah == '6-9 Box')
			{
				if(sisi_cetak == 1)
					harga = 36000;
				else
					harga = 72000;
			}
			else
			{
				if(sisi_cetak == 1)
					harga = 32000;
				else
					harga = 64000;
			}
		}
		else if(jenis_kertas == 4) //cougar opaque
		{
			if(jumlah == '1-5 Box')
			{
				if(sisi_cetak == 1)
					harga = 40000;
				else
					harga = 80000;
			}
			else if(jumlah == '6-9 Box')
			{
				if(sisi_cetak == 1)
					harga = 38000;
				else
					harga = 76000;
			}
			else
			{
				if(sisi_cetak == 1)
					harga = 36000;
				else
					harga = 72000;
			}
		}
		else if(jenis_kertas == 5) // cougar opaque laminasi
		{
			if(jumlah == '1-5 Box')
			{
				if(sisi_cetak == 1)
					harga = 52000;
				else
					harga = 104000;
			}
			else if(jumlah == '6-9 Box')
			{
				if(sisi_cetak == 1)
					harga = 50000;
				else
					harga = 100000;
			}
			else
			{
				if(sisi_cetak == 1)
					harga = 48000;
				else
					harga = 96000;
			}
		}
		else if(jenis_kertas == 6) //jasmine gold dust
		{
			if(jumlah == '1-5 Box')
			{
				if(sisi_cetak == 1)
					harga = 26000;
				else
					harga = 42000;
			}
			else if(jumlah == '6-9 Box')
			{
				if(sisi_cetak == 1)
					harga = 24000;
				else
					harga = 48000;
			}
			else
			{
				if(sisi_cetak == 1)
					harga = 22000;
				else
					harga = 44000;
			}
		}
		harga_satuan = harga;
		if(tambahan_ket == "Rounded")
		{
			tambahan = 5000;
			harga = harga+tambahan;
		}
		// alert(harga);
		$('#total').html(currency_format(harga));
		$('#harga').val(harga_satuan);
		$('#harga_tambahan').val(tambahan);
		$('#total_db').val(harga);
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
		<div class="detail-product">
			<div class="image">
				<img src="<?php echo base_url(); ?>include/front/images/checkout/kartu-nama.jpg">
			</div>
			<div class="detail">
			<?php echo form_open_multipart('front/checkout/checkout_business_card/add', 'id="form_checkout"'); ?>	
				<h3>Original Business Card</h3>
				<p>Lorem ipsum dolor sit amet, sed no melius intellegebat, viris admodum ancillae sea ea. Dicam dicunt sea ne, no vivendum appellantur eam. Ocurreret complectitur necessitatibus qui in. Facilis detraxit patrioque duo te. Vis vocibus sensibus voluptatum ut, cu meis illud graeco has. Appellantur suscipiantur eos in, qui an phaedrum consequuntur.</p>
				<div class="selects">
					<div class="items">
						<label>Ukuran</label>
						<select name="ukuran" id="ukuran">
							<option <?php echo set_select('ukuran', '95x50mm'); ?> value="95x50mm">95x50mm</option> 
						</select> 
						<span class="warning"><?php echo form_error('ukuran'); ?> </span>
					</div>
					<div class="items">
						<label>Jenis Kertas</label>
							<?php
							$query = "SELECT * FROM jenis_kertas where tipe=1 and is_delete=0 ORDER BY id_kertas asc ";
							$result = mysql_query($query);
							?>
							<select id="jenis_kertas" onchange="cek_harga(this)" name="jenis_kertas"> 
								<?php
								echo "<option value='0'>Silahkan Pilih</option>";
								while ($row = mysql_fetch_array($result)) {
									echo "<option value=" . $row['id_kertas'] . " ".set_select('id_kertas',  $row['id_kertas']).">" . $row['kertas_nama'] . "</option>";
								}
								?>        
							</select>
							<span class="warning"><?php echo form_error('jenis_kertas'); ?> </span>
					</div>
					<div class="items">
						<label>Sisi Cetak</label>
						<select name="sisi_cetak" onchange="cek_harga(this)" id="sisi_cetak">
							<option <?php echo set_select('sisi_cetak', '1'); ?> value="1">1 Muka</option> 
							<option <?php echo set_select('sisi_cetak', '2'); ?> value="2">2 Muka</option> 
						</select> 
						<span class="warning"><?php echo form_error('sisi_cetak'); ?> </span>
					</div>
					<div class="items">
						<label>Finishing</label>
						<select name="tambahan_ket" onchange="cek_harga(this)" id="tambahan_ket">
							<option <?php echo set_select('tambahan_ket', 'Rounded'); ?> value="Rounded">Rounded</option>  
							<option <?php echo set_select('tambahan_ket', 'Tidak'); ?> value="Tidak">Tidak</option>  
						</select> 
						<span class="warning"><?php echo form_error('tambahan_ket'); ?> </span>
					</div>
					<div class="items">
						<label>Jumlah</label>
						<select name="jumlah" onchange="cek_harga(this)" id="jumlah">
							<option <?php echo set_select('jumlah', '1-5 Box'); ?> value="1-5 Box">1-5 Box</option>  
							<option <?php echo set_select('jumlah', '6-9 Box'); ?> value="6-9 Box">6-9 Box</option>  
							<option <?php echo set_select('jumlah', '10-dst Box'); ?> value="10-dst Box">10-dst Box</option>  
						</select> 
						<span class="warning"><?php echo form_error('jumlah'); ?> </span>
					</div>
					<div class="items">
						<label>Harga</label>
						<strong>IDR <b id="total" >0</b></strong>
						<input hidden readonly id="harga" name="harga" type="number" />           
						<input hidden readonly id="harga_tambahan" name="harga_tambahan" type="number" />           
						<input hidden readonly id="total_db" name="total_db" type="number" />           
					</div>
				</div>
				<div class="upload">
					<div class="front-design">
						<label>Front Design</label>
				        <input type="file" name="front" required />
						<div class="clear"></div>
					</div>
					<div class="back-design">
						<label>Back Design</label>
				        <input type="file" name="back" required />
						<div class="clear"></div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="button">
					<button type="submit" id="button" name="simpan" value="Simpan">
						<span>
							<span>
								Lanjutkan >
							</span>
						</span>
					</button>
				</div>
			 <?php echo form_close(); ?>  
			</div>
			<div class="clear"></div>
		</div>
	</div>

        <?php $this->load->view('front/slice/footer'); ?>
</body>
</html>