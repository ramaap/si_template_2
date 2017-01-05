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
	
	function cek_dl()//harga kertas tipe DL
	{
			if(jenis_kertas == 7) // art paper
			{
				if(jumlah == '100 pcs')
				{
					if(sisi_cetak == 1)
						harga = 59000;
					else
						harga = 118000;
				}
				else if(jumlah == '250 pcs')
				{
					if(sisi_cetak == 1)
						harga = 115000;
					else
						harga = 225000;
				}
				else if(jumlah == '500 pcs')
				{
					if(sisi_cetak == 1)
						harga = 222500;
					else
						harga = 435000;
				}
				else if(jumlah == '1000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 384600;
					else
						harga = 754000;
				}
				else if(jumlah == '2000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 539000;
					else
						harga = 958000;
				}
				else if(jumlah == '3000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 720000;
					else
						harga = 1270000;
				}
				else if(jumlah == '5000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 1026000;
					else
						harga = 1776000;
				}
			}
			else if(jenis_kertas == 8) // matte paper
			{
				if(jumlah == '100 pcs')
				{
					if(sisi_cetak == 1)
						harga = 59000;
					else
						harga = 118000;
				}
				else if(jumlah == '250 pcs')
				{
					if(sisi_cetak == 1)
						harga = 115000;
					else
						harga = 225000;
				}
				else if(jumlah == '500 pcs')
				{
					if(sisi_cetak == 1)
						harga = 222500;
					else
						harga = 435000;
				}
				else if(jumlah == '1000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 384600;
					else
						harga = 754000;
				}
				else if(jumlah == '2000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 539000;
					else
						harga = 958000;
				}
				else if(jumlah == '3000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 720000;
					else
						harga = 1270000;
				}
				else if(jumlah == '5000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 1026000;
					else
						harga = 1776000;
				}
			}
			else if(jenis_kertas == 9) // art cartoon 20gr
			{
				if(jumlah == '100 pcs')
				{
					if(sisi_cetak == 1)
						harga = 68000;
					else
						harga = 131000;
				}
				else if(jumlah == '250 pcs')
				{
					if(sisi_cetak == 1)
						harga = 137000;
					else
						harga = 266000;
				}
				else if(jumlah == '500 pcs')
				{
					if(sisi_cetak == 1)
						harga = 243750;
					else
						harga = 477500;
				}
				else if(jumlah == '1000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 451800;
					else
						harga = 888600;
				}
				else if(jumlah == '2000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 554500;
					else
						harga = 888500;
				}
				else if(jumlah == '3000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 770000;
					else
						harga = 1220000;
				}
				else if(jumlah == '5000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 1109000;
					else
						harga = 1693000;
				}
			}
			else if(jenis_kertas == 10) // art cartoon laminasi
			{
				if(jumlah == '100 pcs')
				{
					if(sisi_cetak == 1)
						harga = 122000;
					else
						harga = 239000;
				}
				else if(jumlah == '250 pcs')
				{
					if(sisi_cetak == 1)
						harga = 266000;
					else
						harga = 524000;
				}
				else if(jumlah == '500 pcs')
				{
					if(sisi_cetak == 1)
						harga = 413750;
					else
						harga = 817500;
				}
				else if(jumlah == '1000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 787800;
					else
						harga = 1560600;
				}
				else if(jumlah == '2000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 1055500;
					else
						harga = 1890500;
				}
				else if(jumlah == '3000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 1520000;
					else
						harga = 2720000;
				}
				else if(jumlah == '5000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 2360000;
					else
						harga = 4195000;
				}
			}
			else if(jenis_kertas == 11) // art cartoon 260gr
			{
				if(jumlah == '100 pcs')
				{
					if(sisi_cetak == 1)
						harga = 71600;
					else
						harga = 138500;
				}
				else if(jumlah == '250 pcs')
				{
					if(sisi_cetak == 1)
						harga = 145600;
					else
						harga = 283500;
				}
				else if(jumlah == '500 pcs')
				{
					if(sisi_cetak == 1)
						harga = 252250;
					else
						harga = 494500;
				}
				else if(jumlah == '1000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 468600;
					else
						harga = 922500;
				}
				else if(jumlah == '2000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 688000;
					else
						harga = 1122500;
				}
				else if(jumlah == '3000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 945000;
					else
						harga = 1520000;
				}
				else if(jumlah == '5000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 1401000;
					else
						harga = 2193000;
				}
			}
			else if(jenis_kertas == 12) // art cartoon 260gr laminasi
			{
				if(jumlah == '100 pcs')
				{
					if(sisi_cetak == 1)
						harga = 125600;
					else
						harga = 246500;
				}
				else if(jumlah == '250 pcs')
				{
					if(sisi_cetak == 1)
						harga = 274600;
					else
						harga = 541500;
				}
				else if(jumlah == '500 pcs')
				{
					if(sisi_cetak == 1)
						harga = 422250;
					else
						harga = 834500;
				}
				else if(jumlah == '1000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 804600;
					else
						harga = 1594500;
				}
				else if(jumlah == '2000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 1189000;
					else
						harga = 2124500;
				}
				else if(jumlah == '3000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 1695000;
					else
						harga = 3020000;
				}
				else if(jumlah == '5000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 2652000;
					else
						harga = 4695000;
				}
			}
	}
	
	function cek_a5()//harga kertas tipe A5
	{
			if(jenis_kertas == 7) // art paper
			{
				if(jumlah == '100 pcs')
				{
					if(sisi_cetak == 1)
						harga = 83000;
					else
						harga = 158000;
				}
				else if(jumlah == '250 pcs')
				{
					if(sisi_cetak == 1)
						harga = 167500;
					else
						harga = 325000;
				}
				else if(jumlah == '500 pcs')
				{
					if(sisi_cetak == 1)
						harga = 290000;
					else
						harga = 565000;
				}
				else if(jumlah == '1000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 445000;
					else
						harga = 795000;
				}
				else if(jumlah == '2000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 720000;
					else
						harga = 1270000;
				}
				else if(jumlah == '3000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 925000;
					else
						harga = 1600000;
				}
				else if(jumlah == '5000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 1425000;
					else
						harga = 2425000;
				}
			}
			else if(jenis_kertas == 8) // matte paper
			{
				if(jumlah == '100 pcs')
				{
					if(sisi_cetak == 1)
						harga = 83000;
					else
						harga = 158000;
				}
				else if(jumlah == '250 pcs')
				{
					if(sisi_cetak == 1)
						harga = 167500;
					else
						harga = 325000;
				}
				else if(jumlah == '500 pcs')
				{
					if(sisi_cetak == 1)
						harga = 290000;
					else
						harga = 565000;
				}
				else if(jumlah == '1000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 445000;
					else
						harga = 795000;
				}
				else if(jumlah == '2000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 720000;
					else
						harga = 1270000;
				}
				else if(jumlah == '3000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 925000;
					else
						harga = 1600000;
				}
				else if(jumlah == '5000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 1425000;
					else
						harga = 2425000;
				}
			}
			else if(jenis_kertas == 9) // art cartoon 20gr
			{
				if(jumlah == '100 pcs')
				{
					if(sisi_cetak == 1)
						harga = 95500;
					else
						harga = 183000;
				}
				else if(jumlah == '250 pcs')
				{
					if(sisi_cetak == 1)
						harga = 183250;
					else
						harga = 356500;
				}
				else if(jumlah == '500 pcs')
				{
					if(sisi_cetak == 1)
						harga = 340000;
					else
						harga = 665000;
				}
				else if(jumlah == '1000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 470000;
					else
						harga = 770000;
				}
				else if(jumlah == '2000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 770000;
					else
						harga = 1220000;
				}
				else if(jumlah == '3000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 1000000;
					else
						harga = 1525000;
				}
				else if(jumlah == '5000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 1425000;
					else
						harga = 2050000;
				}
			}
			else if(jenis_kertas == 10) // art cartoon laminasi
			{
				if(jumlah == '100 pcs')
				{
					if(sisi_cetak == 1)
						harga = 170500;
					else
						harga = 333000;
				}
				else if(jumlah == '250 pcs')
				{
					if(sisi_cetak == 1)
						harga = 309250;
					else
						harga = 608500;
				}
				else if(jumlah == '500 pcs')
				{
					if(sisi_cetak == 1)
						harga = 590000;
					else
						harga = 1165000;
				}
				else if(jumlah == '1000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 845000;
					else
						harga = 1520000;
				}
				else if(jumlah == '2000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 1520000;
					else
						harga = 2720000;
				}
				else if(jumlah == '3000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 2125000;
					else
						harga = 3775000;
				}
				else if(jumlah == '5000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 3300000;
					else
						harga = 5800000;
				}
			}
			else if(jenis_kertas == 11) // art cartoon 260gr
			{
				if(jumlah == '100 pcs')
				{
					if(sisi_cetak == 1)
						harga = 100500;
					else
						harga = 193000;
				}
				else if(jumlah == '250 pcs')
				{
					if(sisi_cetak == 1)
						harga = 189550;
					else
						harga = 369100;
				}
				else if(jumlah == '500 pcs')
				{
					if(sisi_cetak == 1)
						harga = 352500;
					else
						harga = 690000;
				}
				else if(jumlah == '1000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 570000;
					else
						harga = 945000;
				}
				else if(jumlah == '2000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 945000;
					else
						harga = 1520000;
				}
				else if(jumlah == '3000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 1262500;
					else
						harga = 1975000;
				}
				else if(jumlah == '5000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 1987500;
					else
						harga = 3050000;
				}
			}
			else if(jenis_kertas == 12) // art cartoon 260gr laminasi
			{
				if(jumlah == '100 pcs')
				{
					if(sisi_cetak == 1)
						harga = 175500;
					else
						harga = 343000;
				}
				else if(jumlah == '250 pcs')
				{
					if(sisi_cetak == 1)
						harga = 315550;
					else
						harga = 621100;
				}
				else if(jumlah == '500 pcs')
				{
					if(sisi_cetak == 1)
						harga = 602500;
					else
						harga = 1190000;
				}
				else if(jumlah == '1000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 945000;
					else
						harga = 1695000;
				}
				else if(jumlah == '2000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 1695000;
					else
						harga = 3020000;
				}
				else if(jumlah == '3000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 2387500;
					else
						harga = 4225000;
				}
				else if(jumlah == '5000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 3862500;
					else
						harga = 6800000;
				}
			}
	}
	
	function cek_a4()//harga kertas tipe A4
	{
			if(jenis_kertas == 7) // art paper
			{
				if(jumlah == '100 pcs')
				{
					if(sisi_cetak == 1)
						harga = 133000;
					else
						harga = 258000;
				}
				else if(jumlah == '250 pcs')
				{
					if(sisi_cetak == 1)
						harga = 285000;
					else
						harga = 560000;
				}
				else if(jumlah == '500 pcs')
				{
					if(sisi_cetak == 1)
						harga = 445000;
					else
						harga = 795000;
				}
				else if(jumlah == '1000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 720000;
					else
						harga = 1270000;
				}
				else if(jumlah == '2000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 1225000;
					else
						harga = 2125000;
				}
				else if(jumlah == '3000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 1700000;
					else
						harga = 2900000;
				}
				else if(jumlah == '5000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 2800000;
					else
						harga = 4800000;
				}
			}
			else if(jenis_kertas == 8) // matte paper
			{
				if(jumlah == '100 pcs')
				{
					if(sisi_cetak == 1)
						harga = 133000;
					else
						harga = 258000;
				}
				else if(jumlah == '250 pcs')
				{
					if(sisi_cetak == 1)
						harga = 285000;
					else
						harga = 560000;
				}
				else if(jumlah == '500 pcs')
				{
					if(sisi_cetak == 1)
						harga = 445000;
					else
						harga = 795000;
				}
				else if(jumlah == '1000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 720000;
					else
						harga = 1270000;
				}
				else if(jumlah == '2000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 1225000;
					else
						harga = 2125000;
				}
				else if(jumlah == '3000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 1700000;
					else
						harga = 2900000;
				}
				else if(jumlah == '5000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 2800000;
					else
						harga = 4800000;
				}
			}
			else if(jenis_kertas == 9) // art cartoon 20gr
			{
				if(jumlah == '100 pcs')
				{
					if(sisi_cetak == 1)
						harga = 158000;
					else
						harga = 308000;
				}
				else if(jumlah == '250 pcs')
				{
					if(sisi_cetak == 1)
						harga = 340000;
					else
						harga = 665000;
				}
				else if(jumlah == '500 pcs')
				{
					if(sisi_cetak == 1)
						harga = 470000;
					else
						harga = 770000;
				}
				else if(jumlah == '1000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 770000;
					else
						harga = 1220000;
				}
				else if(jumlah == '2000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 1325000;
					else
						harga = 2025000;
				}
				else if(jumlah == '3000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 1700000;
					else
						harga = 2450000;
				}
				else if(jumlah == '5000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 2800000;
					else
						harga = 4050000;
				}
			}
			else if(jenis_kertas == 10) // art cartoon laminasi
			{
				if(jumlah == '100 pcs')
				{
					if(sisi_cetak == 1)
						harga = 308000;
					else
						harga = 608000;
				}
				else if(jumlah == '250 pcs')
				{
					if(sisi_cetak == 1)
						harga = 590000;
					else
						harga = 1165000;
				}
				else if(jumlah == '500 pcs')
				{
					if(sisi_cetak == 1)
						harga = 845000;
					else
						harga = 1520000;
				}
				else if(jumlah == '1000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 1520000;
					else
						harga = 2720000;
				}
				else if(jumlah == '2000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 2825000;
					else
						harga = 5025000;
				}
				else if(jumlah == '3000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 3950000;
					else
						harga = 6950000;
				}
				else if(jumlah == '5000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 6550000;
					else
						harga = 11550000;
				}
			}
			else if(jenis_kertas == 11) // art cartoon 260gr
			{
				if(jumlah == '100 pcs')
				{
					if(sisi_cetak == 1)
						harga = 168000;
					else
						harga = 328000;
				}
				else if(jumlah == '250 pcs')
				{
					if(sisi_cetak == 1)
						harga = 352500;
					else
						harga = 690000;
				}
				else if(jumlah == '500 pcs')
				{
					if(sisi_cetak == 1)
						harga = 570000;
					else
						harga = 945000;
				}
				else if(jumlah == '1000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 945000;
					else
						harga = 1520000;
				}
				else if(jumlah == '2000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 1675000;
					else
						harga = 2625000;
				}
				else if(jumlah == '3000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 2375000;
					else
						harga = 3650000;
				}
				else if(jumlah == '5000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 3925000;
					else
						harga = 6050000;
				}
			}
			else if(jenis_kertas == 12) // art cartoon 260gr laminasi
			{
				if(jumlah == '100 pcs')
				{
					if(sisi_cetak == 1)
						harga = 318000;
					else
						harga = 628000;
				}
				else if(jumlah == '250 pcs')
				{
					if(sisi_cetak == 1)
						harga = 602500;
					else
						harga = 1190000;
				}
				else if(jumlah == '500 pcs')
				{
					if(sisi_cetak == 1)
						harga = 945000;
					else
						harga = 1695000;
				}
				else if(jumlah == '1000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 1695000;
					else
						harga = 3020000;
				}
				else if(jumlah == '2000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 3175000;
					else
						harga = 5625000;
				}
				else if(jumlah == '3000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 4625000;
					else
						harga = 8150000;
				}
				else if(jumlah == '5000 pcs')
				{
					if(sisi_cetak == 1)
						harga = 7675000;
					else
						harga = 13550000;
				}
			}
	}
	
	function cek_harga()
	{
		ukuran = $("#ukuran").val();
		jenis_kertas = $("#jenis_kertas").val();
		sisi_cetak = $("#sisi_cetak").val();
		tambahan_ket = $("#tambahan_ket").val();
		jumlah = $("#jumlah").val();
		harga = 0;
		tambahan = 0;
		if(ukuran = "DL 100x210mm")
		{
			cek_dl();
		}
		else if(ukuran = "A5 148x210mm")
		{
			cek_a5();
		}
		else if(ukuran = "A4 210x297mm")
		{
			cek_a4();
		}
		
		harga_satuan = harga;
		
		$('#total').html(currency_format(harga));
		$('#harga').val(harga_satuan);
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
			<?php echo form_open_multipart('front/checkout/checkout_flyer/add', 'id="form_checkout"'); ?>	
				<h3>Original Flyer</h3>
				<p>Lorem ipsum dolor sit amet, sed no melius intellegebat, viris admodum ancillae sea ea. Dicam dicunt sea ne, no vivendum appellantur eam. Ocurreret complectitur necessitatibus qui in. Facilis detraxit patrioque duo te. Vis vocibus sensibus voluptatum ut, cu meis illud graeco has. Appellantur suscipiantur eos in, qui an phaedrum consequuntur.</p>
				<div class="selects">
					<div class="items">
						<label>Ukuran</label>
						<select name="ukuran" onchange="cek_harga(this)" id="ukuran">
							<option <?php echo set_select('ukuran', 'DL 100x210mm'); ?> value="DL 100x210mm">DL 100x210mm</option> 
							<option <?php echo set_select('ukuran', 'A5 148x210mm'); ?> value="A5 148x210mm">A5 148x210mm</option> 
							<option <?php echo set_select('ukuran', 'A4 210x297mm'); ?> value="A4 210x297mm">A4 210x297mm</option> 
						</select> 
						<span class="warning"><?php echo form_error('ukuran'); ?> </span>
					</div>
					<div class="items">
						<label>Jenis Kertas</label>
							<?php
							$query = "SELECT * FROM jenis_kertas where tipe=2 and is_delete=0 ORDER BY id_kertas asc ";
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
						<label>Jumlah</label>
						<select name="jumlah" onchange="cek_harga(this)" id="jumlah">
							<option <?php echo set_select('jumlah', '100 pcs'); ?> value="100 pcs">100 pcs</option>   
							<option <?php echo set_select('jumlah', '250 pcs'); ?> value="250 pcs">250 pcs</option>   
							<option <?php echo set_select('jumlah', '500 pcs'); ?> value="500 pcs">500 pcs</option>   
							<option <?php echo set_select('jumlah', '1000 pcs'); ?> value="1000 pcs">1000 pcs</option>   
							<option <?php echo set_select('jumlah', '2000 pcs'); ?> value="2000 pcs">2000 pcs</option>   
							<option <?php echo set_select('jumlah', '3000 pcs'); ?> value="3000 pcs">3000 pcs</option>   
							<option <?php echo set_select('jumlah', '5000 pcs'); ?> value="5000 pcs">5000 pcs</option>   
						</select> 
						<span class="warning"><?php echo form_error('jumlah'); ?> </span>
					</div>
					<div class="items">
						<label>Harga</label>
						<strong>IDR <b id="total" >0</b></strong>
						<input hidden readonly id="harga" name="harga" type="number" />                     
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
				        <input type="file" name="back" />
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