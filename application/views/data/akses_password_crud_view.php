<div id="overlay"></div>
<div id="form_popup" class="pop" style="left:27.3%;width:50%;padding-bottom: 20px;">
    <button class="btn pull-right btn-danger" style="font-size:16px; border-radius: 0px" onclick="close_remodal()" title="Tutup">&Chi;</button>
    <center><h2>Data Akses Password</h2></center>
    <br/>
    <div class="pdiv">
        <?php echo form_open('data/akses_password/add', 'id="form_akses_password"'); ?> 
        <div class="row">
            <div class="col-md-2">Menu</div>
            <div class="col-md-10"> 
                <input readonly class="form-control" id="akses_password_menu" name="akses_password_menu"  type="text" size="28"  value="<?php echo set_value('akses_password_menu', ''); ?>" /> 
                <span class="warning"><?php echo form_error('akses_password_menu'); ?> </span>
            </div> 
        </div>  
		<div class="row">
            <div class="col-md-2">Aksi</div>
            <div class="col-md-10"> 
                <input readonly class="form-control" id="akses_password_fungsi" name="akses_password_fungsi"  type="text" size="28"  value="<?php echo set_value('akses_password_fungsi', ''); ?>" /> 
                <span class="warning"><?php echo form_error('akses_password_fungsi'); ?> </span>
            </div> 
        </div>  
        <div class="row">
            <div class="col-md-2">Role</div>
            <div class="col-md-10">  
                <?php
                $query = "SELECT * FROM data_role where is_delete=0 ORDER BY role_nama asc ";
                $result = mysql_query($query);
                ?>
                <select class="form-control" id="role_id"   attribute="is_selected" name="role_id">
                    <?php
                    echo "<option value='0'>Silahkan Pilih</option>";
                    while ($row = mysql_fetch_array($result)) {
                        echo "<option value=" . $row['role_id'] . ">" . $row['role_nama'] . "</option>";
                    }
                    ?>        
                </select>
                <span class="warning"><?php echo form_error('role_id'); ?> </span>
            </div> 
        </div> 
        <div class="row" hidden> 
            <div class="col-md-12">  
                <input id="datamodel" name="datamodel" type="text" size="28" value="<?php echo set_value('datamodel', ''); ?>" />  
                <span class="warning"><?php echo form_error('datamodel'); ?> </span>

            </div> 
        </div> 
        <br/>
        <div class="row">
            <div class="col-md-12" style="text-align: center">
                <input type="submit" onclick="" id="button" name="simpan" value="Simpan"  class="btn btn-success" />
                <a name="batal" onclick="close_remodal()" class="btn btn-danger">Batal</a>
            </div>
        </div> 
        <?php echo form_close(); ?>  
    </div>
</div>	
