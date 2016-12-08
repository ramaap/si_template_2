<script>

    function enter(e)
    {
        if (e.keyCode == 13)
        {
            otorisasi();
        }
    } 
	
	function close_remodal_()
    {
       $("#overlay_otorisasis").hide();
       $("#form_popup_otorisasis").hide();
	   $("#edit_tgl").val("");
    }

</script>
<div id="overlay_otorisasis"></div>
<div id="form_popup_otorisasis" class="pop" style="display:none;left:32.3%;width:35%;padding-bottom: 20px;">
    <button class="btn pull-right btn-danger" style="font-size:16px; border-radius: 0px" onclick="close_remodal_()" no_loading title="Tutup">X</button> 
	<form>
    <div class="pdiv"> 
        <div class="row">
            <div class="col-md-12">Silahkan Pilih Tanggal :</div> 
        </div>  
        <div class="row">
            
			<div class="row">
            <div class="col-md-12"> 
				<input type="text" class="form-control tanggal" onkeydown="enter(event)" id="edit_tgl" name="edit_tgl"  size="28" value="<?php echo set_value('edit_tgl', date('d M Y'))?>" readonly /> 
                <span class="warning"><?php echo form_error('edit_tgl'); ?> </span>
            </div> 
        </div> 
			<div class="col-md-12"> 
                <input class="form-control" id="indexx" name="indexx" type="text" size="28" style="display:none" value="<?php echo set_value('indexx', ''); ?>" />  
            </div> 
        </div>    
        <div class="row">
            <div class="col-md-12" style="text-align: center">
                <a type="submit" id="button_otorisasi" name="ok" onclick="otorisasi()" class="btn btn-success" > Ok</a>
                <a type="submit" name="batal" value="Batal" onclick="close_remodal_()" class="btn btn-danger" >Batal</a>
            </div>
        </div> 
    </div>	  
	</form>
</div>	
