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
       $("#overlay_otorisasi").hide();
       $("#form_popup_otorisasi").hide();
	   $("#password_otorisasi1").val("");
    }

</script>
<div id="overlay_otorisasi"></div>
<div id="form_popup_otorisasi" class="pop" style="display:none;left:32.3%;width:35%;padding-bottom: 20px;">
    <button class="btn pull-right btn-danger" style="font-size:16px; border-radius: 0px" onclick="close_remodal_()" no_loading title="Tutup">X</button> 
	<form>
    <div class="pdiv"> 
        <div class="row">
            <div class="col-md-12">Aksi Harus melalui Otorisasi Manager</div> 
            <div class="col-md-12">Masukkan Password :</div> 
        </div>  
        <div class="row">
            
            <div class="col-md-12"> 
                <input class="form-control" onkeydown="enter(event)" id="password_otorisasi1" name="password_otorisasi1" type="password" size="28"  value="<?php echo set_value('password_otorisasi1', ''); ?>" />  
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
