<div id="overlay_diskon"></div>
<div id="form_popup_diskon" class="pop" style="left:32.3%;width:35%;padding-bottom: 20px;">
    <button class="btn pull-right btn-danger" style="font-size:16px; border-radius: 0px" onclick="close_remodal()" title="Tutup">X</button> 
	<form>
	<center><h2>Edit Diskon</h2></center>
    <br/>
    <div class="pdiv"> 
		<div class="row">
            <div class="col-md-3">Total Diskon</div>
            <div class="col-md-9"> 
                <input class="form-control" id="diskon_totals" name="diskon_totals" type="number" size="28"  value="<?php echo set_value('diskon_totals', $diskon_total); ?>" /> 
                <span class="warning"><?php echo form_error('diskon_totals'); ?> </span>
            </div> 
        </div> 
        <div class="row" hidden> 
            <div class="col-md-12">  
                <input id="jenis_trans" name="jenis_trans" type="text" size="28" value="<?php echo set_value('jenis_trans', $transaksi_jenis); ?>" />  
                <span class="warning"><?php echo form_error('jenis_trans'); ?> </span>
            </div> 
        </div> 
        <div class="row" >
            <div class="col-md-12" style="text-align: center">
                <a type="submit" id="button_mobil" name="ok" onclick="ubah_diskon()" class="btn btn-success" > Ok</a>
                <a type="submit" name="batal" value="Batal" onclick="close_remodal()" class="btn btn-danger" >Batal</a>
            </div>
        </div> 
    </div>	  
	</form>
</div>	
