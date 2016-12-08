<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
    <head>        
        <?php $this->load->view('common/head'); ?>
        <?php
        $this->load->view('common/time');

        $ubah = (isset($ubah)) ? $ubah : '';
        $alert = $this->session->userdata("error");
        $this->session->unset_userdata("error");
        ?>
        <?php $this->load->view('common/menu'); ?>
        <script>
            function previewFile() {

                document.getElementById("preview_image").style.display = '';
                var preview = document.getElementById('preview_image'); //selects the query named img
                var file = document.getElementById('userfile').files[0]; //selects the query named img
                //var file    = document.querySelector('input[type=file]').files[0]; //sames as here
                var reader = new FileReader();
                //alert(document.getElementById('us_file').files[0]['type']);
                reader.onloadend = function () {
                    preview.src = reader.result;
                }

                if (file) {
                    reader.readAsDataURL(file); //reads the data as a URL
                    //upload_file();
                } else {
                    preview.src = "";
                    alert("bukan gambar");
                }
            }

            function edited_jquery()
            {
 
                    //reader.readAsDataURL(file); //reads the data as a URL
                   
                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('pengaturan/nota/edit') ?>",
                        timeout: 20000,
                        data: {
                            datamodel: $("#datamodel").val(),
                            nota_header: $("#nota_header").val(),
                            nota_catatan: $("#nota_catatan").val(),
                            nota_footer: $("#nota_footer").val() 
                        },
                        success: function (result) {
							// alert(result);
                            location.reload();
                        },
                        error: function (html) {
                            alertify.error("Kode Eror [" + html.status + "]<br/><br/>Status:" + html.statusText);
                        }
                    });
               

            }

        </script>
    </head>
    <body ng-app="main" class="no_angular">
        <br/><br/>
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                </div>
                <div class="col-md-2">Header</div>
                <div class="col-md-4"> 
                    <input class="form-control" id="nota_header" name="nota_header" type="text" size="28" required="" value="<?php echo set_value('user_name', $sql->nota_header); ?>" /> 
                    <span class="warning"><?php echo form_error('nota_header'); ?> </span>
                </div> 
                <div class="col-md-3">
                </div>
            </div>  				
            <div class="row">
                <div class="col-md-3">
                </div>
                <div class="col-md-2">Catatan sebelum footer</div>
                <div class="col-md-4"> 
                    <input class="form-control" id="nota_catatan" name="nota_catatan" type="text" autocomplete="off" size="28" required="" value="<?php echo set_value('password_lama', $sql->nota_catatan); ?>" /> 
                    <span class="warning"><?php echo form_error('nota_catatan'); ?> </span>
                </div> 
                <div class="col-md-3">
                </div>
            </div>  
            <div class="row">
                <div class="col-md-3">
                </div>
                <div class="col-md-2">Footer</div>
                <div class="col-md-4"> 
                    <input class="form-control" id="nota_footer" name="nota_footer" type="text" size="28" required="" value="<?php echo set_value('password_baru', $sql->nota_footer); ?>" /> 
                    <span class="warning"><?php echo form_error('nota_footer'); ?> </span>
                </div> 
                <div class="col-md-3">
                </div>
            </div> 
            <div class="row">
                <div class="col-md-3">
                </div>
                <div class="col-md-6">
				<span class="red">Direkomendasikan max 33 karakter</span>
                </div> 
            </div>   
            <div class="row" > 
                <div class="col-md-12" hidden>  
                    <input id="datamodel" name="datamodel" type="text" size="28" value="<?php echo set_value('datamodel', $sql->nota_id); ?>" />  
                    <span class="warning"><?php echo form_error('datamodel'); ?> </span>

                </div> 
            </div> 
            <br/>
            <div class="row">
                <div class="col-md-5">
                </div>

                <div class="col-md-2">
                    <center><input type="submit" id="button" name="simpan" onclick="edited_jquery()" value="Simpan"  class="btn btn-success" /></center>
                </div> 
                <div class="col-md-5">
                </div>
            </div>   
        </div>
        <?php $this->load->view('common/footer'); ?>
        <script src="<?php echo base_url(); ?>include/js/bootstrap.min.js"></script> 
    </body>
</html>