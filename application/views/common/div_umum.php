<script>

    function enter(e)
    {
        if (e.keyCode == 13)
        {
            otorisasi();
        }
    } 
	
	function close_remodal_div_umum()
    {
       $("#form_popup_div_umum").hide();
       $("#overlay_div_umum").hide();
	   // $("#password_otorisasi1").val("");
    }

</script>
<div id="overlay_div_umum"></div>
<div id="form_popup_div_umum" class="pop" style="display:none;left: 25%;width: 60%;margin-top:1%;">
	<button class="btn pull-right btn-danger" style="font-size:16px; border-radius: 0px" no_loading onclick="close_remodal_div_umum()" title="Tutup">X</button> 
	
	<?php echo form_open('dashboard', 'id="form_div_umum"'); ?> 
	<div id="div_umum_content" style="margin-left:2%;margin-right:2%">
	</div>	
	<div id="div_umum_content2" style="margin-left:2%;margin-right:2%"> 
			<input style="margin-top:14px;" type="checkbox" name="checkbox_kosong" id="checkbox_kosong"></input> Kosongkan WO Beli/Gantung
			<br/>
			<input style="margin-top:14px;" type="checkbox" name="checkbox_disc" id="checkbox_disc"></input> Susut akan mengurangi tagihan Order Pembelian berupa disc susut 
			<input type="text" id="datamodel_div_umum" hidden name="datamodel"></input>
	</div>	
	<div id="div_umum_keterangan" style="margin-left:2%;margin-right:2%;margin-top:14px;"> 
	</div>	
	<br/>
	<div id="div_umum_button" style="margin-left:2%;margin-bottom:1%"> 
		 <center>
                <input type="submit" id="button_div_umum" name="simpan" value="Selesaikan"  class="btn btn-success" />
                <?php echo form_close(); ?>  
                <a type="submit" name="batal" value="Batal" onclick="close_remodal_div_umum()" class="btn btn-danger" >Batal</a> 
		 </center>
	</div>	
</div>	
