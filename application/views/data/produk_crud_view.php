<div id="overlay"></div>
<div id="form_popup" class="pop" style="left:27.3%;width:50%;padding-bottom: 20px;">
    <button class="btn pull-right btn-danger" style="font-size:16px; border-radius: 0px" onclick="close_remodal()" title="Tutup">X</button>
    <center><h2>Data Produk</h2></center>
    <br/>
    <div class="pdiv">
        <?php echo form_open_multipart('data/produk/add', 'id="form_produk"'); ?>	
        <div class="row">
            <div class="col-md-3">Nama Produk</div>
            <div class="col-md-9"> 
                <input class="form-control" tabindex="1" id="produk_nama" name="produk_nama" type="text" size="28"  value="<?php echo set_value('produk_nama', ''); ?>" /> 
                <span class="warning"><?php echo form_error('produk_nama'); ?> </span>
            </div> 
        </div> 
		<div class="row">
            <div class="col-md-3">Kategori Produk</div>
            <div style="padding-bottom:10px" class="col-md-9">  
                <?php
                $query = "SELECT * FROM kategori_produk where is_delete=0 ORDER BY kategori_produk_nama asc ";
                $result = mysql_query($query);
                ?>
				<select  class="chosen-select form-control" tabindex="2" id="kategori_produk_id" name="kategori_produk_id"> 
                    <?php
                    echo "<option value='0'>Silahkan Pilih</option>";
                    while ($row = mysql_fetch_array($result)) {
                        echo "<option value=" . $row['kategori_produk_id'] . " ".set_select('kategori_produk_id',  $row['kategori_produk_id']).">" . $row['kategori_produk_nama'] . "</option>";
                    }
                    ?>        
                </select>
                <span class="warning"><?php echo form_error('kategori_produk_id'); ?> </span>
            </div> 
        </div>  
        <div class="row">
            <div class="col-md-3">Biaya</div>
            <div class="col-md-9"> 
                <input class="form-control" id="produk_biaya" tabindex="3" name="produk_biaya" type="number" size="28"  value="<?php echo set_value('produk_biaya', ''); ?>" /> 
                <span class="warning"><?php echo form_error('produk_biaya'); ?> </span>
            </div> 
        </div>    
        <div class="row">
            <div class="col-md-3">Keterangan</div>
            <div class="col-md-9">  
                <textarea class="form-control" id="produk_keterangan" tabindex="4" name="produk_keterangan" cols="40" rows="4"><?php echo set_value('produk_keterangan', ''); ?></textarea>  
                <span class="warning"><?php echo form_error('produk_keterangan'); ?> </span>
            </div> 
        </div> 
		<div class="row">
            <div class="col-md-3 padding_top">Foto</div>
            <div class="col-md-9"> 
			 <input type="file" name="userfile"/>
			 <span class="warning"><?php echo form_error('userfile'); ?> </span>
			 <img width="30%" id="prev" name="prev" src='' />
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
                <input type="submit" id="button" name="simpan" value="Simpan"  class="btn btn-success" />
                <?php echo form_close(); ?>  
                <a type="submit" name="batal" value="Batal" onclick="close_remodal()" class="btn btn-danger" >Batal</a>
            </div>
        </div> 
    </div>	  
</div>	
