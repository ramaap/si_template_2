 <center><span>Data Detail</span></center>
<table class="table"> 
<tr>
	<td align="center"><b>Barang</b></td> 
	<td align="center"><b>Jml</b></td> 
	<td align="center"><b>Berat</b></td> 
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
					<?php echo $dd->order_penjualan_detail_jml.''.$dd->satuan_nama;?>
				</td> 
				<td style="vertical-align:middle">
					<?php echo $dd->order_penjualan_detail_berat.' Kg';?>
				</td> 
			</tr>
			 
<?php }?>
</table>