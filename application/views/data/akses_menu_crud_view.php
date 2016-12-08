<script>
    function cek_akses()
    {
    }
    function cekclick(click)
    {
        data = arr = click.name.split("_");
        group = $('*[id*=' + data[0] + ']:checked').length;

        if (click.name == 'all')
        {
			// alert("dm_all")
			// $(this).prop('checked', click.checked);
			$('input:checkbox').prop('checked', click.checked);
		}
        if (click.name == 'mn_all')
        {
            cek(click.checked, data[0]);
            cek(click.checked, 'all');
            cek(click.checked, 'tb');
            cek(click.checked, 'ed');
            cek(click.checked, 'del');
        }
        else if (click.name.indexOf('all') !== -1)
        {
            cek(click.checked, data[0]);
        }
        else if (click.name.indexOf('mn') !== -1)
        {
            cek(click.checked, data[0]);
        }
    }

    function cek(checked, menu)
    {

        $('*[id*=' + menu + ']:visible').each(function() {
            this.checked = checked;

        });
    }
	
	function cekshow(click)
    {
			$('*[id*=_tab]').attr("class","remodal-bayar");
			menu=click.name.split("_");
			$('*[id*=div_]').hide();
			// if(click.checked)
			$('*[id*=div_' + menu[0] + ']').show();
			// else
			// $('*[id*=div_' + menu[0] + ']').hide();
		
			$('*[id*='+click.id+']').attr("class","bayarklik");
			// $('#'+click.id).show();
	}
</script>
<div id="form-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" onclick="hide_modal_bootstrap()">&times;</button>
                <center><h2 class="modal-title">Setting Akses</h2></center>
            </div>
            <div class="modal-body">
			
        <?php echo form_open('data/akses_menu/add', 'id="form_akses_menu"'); ?> 
		<div class="row">
            <div class="col-md-2">Role</div>
            <div hidden class="col-md-10"> 
                <?php
                $query = "SELECT * FROM data_role where is_delete=0 ORDER BY role_nama asc ";
                $result = mysql_query($query);
                ?>
                <select class="form-control" id="role_id" name="role_id">
                    <?php
                    echo "<option value='0'>Silahkan Pilih</option>";
                    while ($row = mysql_fetch_array($result)) {
                        echo "<option value=" . $row['role_id'] . ">" . $row['role_nama'] . "</option>";
                    }
                    ?>        
                </select>
                <span class="warning"><?php echo form_error('role_id'); ?> </span>
            </div>  
			<div  class="col-md-6"> 
                <input readonly class="form-control" id="role_nama" name="role_nama" type="text" size="28"  value="<?php echo set_value('role_nama', ''); ?>" /> 
			</div>   
        </div> 
		<div style="margin:10px">
        </div>		
        <div class="row">
            <div class="col-md-6" style="text-align:right;padding-right:10px">Semua Menu</div>
            <div class="col-md-6">  
                <input id="all"  name="all" type="checkbox" onclick="cekclick(this)"/> All			
            </div> 
        </div> 
		
		<div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-2"><a style="text-decoration: none" name="dm_tab" id="idm_tab" no_loading onclick="cekshow(this)" class="bayarklik">Data Master</a> </div>
            <div class="col-md-2"><a style="text-decoration: none" name="st_tab" id="st_tab" no_loading onclick="cekshow(this)" class="remodal-bayar">Stok</a></div>
            <div class="col-md-2"><a style="text-decoration: none" name="keu_tab" id="keu_tab" no_loading onclick="cekshow(this)" class="remodal-bayar">Keuangan</a></div>
            <div class="col-md-2"><a style="text-decoration: none" name="trs_tab" id="trs_tab" no_loading onclick="cekshow(this)" class="remodal-bayar">Transaksi</a></div>
            <div class="col-md-2"><a style="text-decoration: none" name="lap_tab" id="lap_tab" no_loading onclick="cekshow(this)" class="remodal-bayar">Laporan</a> </div>
            <div class="col-md-1"></div>
		</div>
		<div id="div_dm" name="div_dm"><!--Data Master-->
			
			<div style="margin:10px">
			</div>
			<div class="row">
				<div class="col-md-6"><b>Data Master</b></div>
				<div class="col-md-6">  			
				</div> 
			</div>
			<div class="row">
				<div class="col-md-3">  
					<input id="role_mn_dm"  name="role_mn_dm" type="checkbox" onclick="cekclick(this)"/> Role 
				</div> 
				<div class="col-md-2">  
					<input id="role_tb_dm"  name="role_tb_dm" type="checkbox" onclick="cekclick(this)"/> Tambah
				</div> 
				<div class="col-md-2">  
					<input id="role_ed_dm"  name="role_ed_dm" type="checkbox" onclick="cekclick(this)"/> Edit
				</div> 
				<div class="col-md-2">  
					<input id="role_del_dm"  name="role_del_dm" type="checkbox" onclick="cekclick(this)"/> Delete
				</div> 
			</div> 

			<div class="row">
				<div class="col-md-3">
					<input id="user_mn_dm"  name="user_mn_dm" type="checkbox" onclick="cekclick(this)"/> User
				</div> 
				<div class="col-md-2">  
					<input id="user_tb_dm"  name="user_tb_dm" type="checkbox" onclick="cekclick(this)"/> Tambah
				</div> 
				<div class="col-md-2">  
					<input id="user_ed_dm"  name="user_ed_dm" type="checkbox" onclick="cekclick(this)"/> Edit
				</div> 
				<div class="col-md-2">  
					<input id="user_del_dm"  name="user_del_dm" type="checkbox" onclick="cekclick(this)"/> Delete	
				</div> 
			</div> 

			<div class="row">
				<div class="col-md-3">
					<input id="akses_menu_mn_dm"  name="akses_menu_mn_dm" type="checkbox" onclick="cekclick(this)"/> Akses Menu
				</div> 
				<div class="col-md-2">  
				</div> 
				<div class="col-md-2">  
					<input id="akses_menu_ed_dm"  name="akses_menu_ed_dm" type="checkbox" onclick="cekclick(this)"/> Edit
				</div> 
			</div> 
	  </div>
		
		<div style="margin:10px"> <!--Pengaturan-->
        </div>
		<div class="row">
           <div class="col-md-6"><b>Pengaturan</b></div>
            <div class="col-md-6">  			
            </div> 
        </div>
		<div class="row">
            <div class="col-md-3">
                <input id="restoredatabase_mn_dm"  name="restoredatabase_mn_dm" type="checkbox" onclick="cekclick(this)"/> Restore Database
            </div> 
            <div class="col-md-3">
                <input id="backupdatabase_mn_dm"  name="backupdatabase_mn_dm" type="checkbox" onclick="cekclick(this)"/> Backup Database
            </div> 
			<div class="col-md-3">
                <input id="profile_mn_dm"  name="profile_mn_dm" type="checkbox" onclick="cekclick(this)"/> Setting Profile
            </div> 
			  <div class="col-md-3">
                <input id="lqoxg_mn_dm"  name="lqoxg_mn_dm" type="checkbox" onclick="cekclick(this)"/> Log
            </div> 
        </div> 
		<div class="row">
          
            
        </div>

        <div hidden> 
        <div class="row" hidden> 
            <div class="col-md-12">  
                <input id="datamodel" name="datamodel" type="text" size="28" value="<?php echo set_value('datamodel', ''); ?>" />  
                <span class="warning"><?php echo form_error('datamodel'); ?> </span>

            </div> 
        </div> 
        </div> 

        <br/>
        <div class="row">
            <div class="col-md-12" style="text-align:center"> 
                <input type="submit" id="button" name="simpan" value="Simpan"  class="btn btn-success" /> 


                 

                <a type="submit" name="batal" value="Batal" data-dismiss="modal" onclick="hide_modal_bootstrap()" class="btn btn-danger" >Batal</a>
            </div>
        </div> 
		<?php echo form_close(); ?> 
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
            </div>
        </div>
    </div>
</div>	
