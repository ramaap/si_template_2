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
       $("#form_popup_table_umum").hide();
       $("#overlay_table_umum").hide();
	   // $("#password_otorisasi1").val("");
    }

</script>
<div id="overlay_table_umum"></div>
<div id="form_popup_table_umum" class="pop" style="display:none;left: 25%;width: 60%;margin-top:1%;">
	<button class="btn pull-right btn-danger" style="font-size:16px; border-radius: 0px" no_loading onclick="close_remodal_div_umum()" title="Tutup">X</button> 
	<center><h3 id="title_table_umum"></h3>
	<table id="table_umum_" style="margin-left:2%;margin-right:2%;margin-top:14px;"> 
	</table>	</center>
	<br/> 
</div>	
