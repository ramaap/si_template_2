 <center><span>Verifikasi Transfer Stok</span></center>
<table class="table"> 
<tr>
	<td align="center"><b>Barang</b></td> 
	<td align="center"><b>Coly</b></td> 
	<td align="center"><b>Berat (Kg)</b></td> 
</tr> 
<?php 
$temp=0;

foreach ($list as $dd) {
	?>
			<tr> 
				<td style="vertical-align:middle"><?php echo '['.$dd->barang_kode.']'.' '.$dd->barang_nama.' ['.$dd->satuan_nama.']';?></td>
				<td style="vertical-align:middle">
					<div class="col-md-5">
						<input class="form-control" id="good_delivery" name="good_delivery[]" type="text" size="3"  tabindex="1" value="<?php echo set_value('good_delivery_'.$dd->transfer_stok_id, 0); ?>" />  
					</div>
					<div style="font-size:20px" class="col-md-2"><center>&nbsp;/&nbsp;</center></div>
					<div class="col-md-5">
						<input class="col-md-6 form-control" readonly name="good_max_delivery[]" type="text" size="3"  tabindex="1" value="<?php echo $dd->stok_good; ?>" />  
					</div>
					<span class="warning"><?php echo form_error('good_delivery'); ?> </span>
				</td> 
				<td style="vertical-align:middle">
					<div class="col-md-5">
						<input class="form-control" id="stok_good_berat" name="stok_good_berat[]" type="text" size="9"  tabindex="1" value="<?php echo set_value('stok_good_berat_'.$dd->transfer_stok_id, 0); ?>" />  
					</div>
					<div style="font-size:20px" class="col-md-2"><center>&nbsp;/&nbsp;</center></div>
					<div class="col-md-5">
						<input class="col-md-6 form-control" readonly name="stok_good_berat_max[]" type="text" size="9"  tabindex="1" value="<?php echo $dd->stok_good_berat; ?>" />  
					</div>
					<span class="warning"><?php echo form_error('bad_delivery[]'); ?> </span>
				</td>
				<td style="vertical-align:middle;display:none">
					<input hidden class="form-control" id="transfer_stok_detail_id" name="transfer_stok_detail_id[]" type="text" size="3"  tabindex="1" value="<?php echo $dd->transfer_stok_detail_id; ?>" />  
					<input hidden class="form-control" id="stok_good_hpp" name="stok_good_hpp[]" type="text" size="3"  tabindex="1" value="<?php echo $dd->stok_good_hpp; ?>" />  
					<input hidden class="form-control" id="barang_id" name="barang_id[]" type="text" size="3"  tabindex="1" value="<?php echo $dd->barang_id; ?>" />  					
				</td>
			</tr>
			 
<?php }?>
</table>