 <center><span>Data Detail</span></center>
<table class="table"> 
<tr>
	<td align="center"><b>Barang</b></td> 
	<td align="center"><b>Jml</b></td> 
	<td align="center"><b>Berat</b></td> 
	<td align="center"><b>Harga</b></td> 
	<td align="center"><b>Total</b></td> 
</tr> 
<?php 
$temp=0;

foreach ($list as $dd) {
	?>
			<tr> 
				<td style="vertical-align:middle">
					<?php echo '['.$dd->barang_kode.']'.' '.$dd->barang_nama.' ['.$dd->satuan_nama.']';?>
				</td>
				<td style="vertical-align:middle">
					<?php echo $dd->order_pembelian_detail_jumlah;?>
				</td> 
				<td style="vertical-align:middle">
					<?php echo $dd->order_pembelian_detail_berat_total.' Kg';?>
				</td> 
				<td style="vertical-align:middle">
					<?php echo "Rp ".number_format($dd->order_pembelian_detail_harga,0,',','.');?>
				</td> 
				<?php
				if($dd->barang_jenis=="Satuan")
					$total= $dd->order_pembelian_detail_jumlah*$dd->order_pembelian_detail_harga;
				else
					$total= $dd->order_pembelian_detail_berat_total*$dd->order_pembelian_detail_harga;
				?>
				<td style="vertical-align:middle">
					<?php echo "Rp ".number_format($total,0,',','.');?>
				</td> 
			</tr>
			 
<?php }?>
</table>