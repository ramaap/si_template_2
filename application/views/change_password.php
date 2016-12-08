<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"> 

        <?php $this->load->view('common/head'); ?>
        <?php
        $this->load->view('common/time');

        $ubah = (isset($ubah)) ? $ubah : '';
        $alert = $this->session->userdata("error");
        $this->session->unset_userdata("error");
        ?>
        <?php $this->load->view('common/menu'); ?>

    </head>
    <body ng-app="main">
            <br/><br/><br/><br/>
            <div id="container">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                                    <?php echo form_open('login/edit', 'id="form_change"'); ?> 

                                    <div class="row">
                                        <div class="col-md-3">
                                        </div>
                                        <div class="col-md-2">Username</div>
                                        <div class="col-md-4"> 
                                            <input class="form-control" id="user_name" name="user_name" readonly type="text" size="28" required="" value="<?php echo set_value('user_name', $user_name); ?>" /> 
                                            <span class="warning"><?php echo form_error('user_name'); ?> </span>
                                        </div> 
                                        <div class="col-md-3">
                                        </div>
                                    </div>					
                                    <div class="row">
                                        <div class="col-md-3">
                                        </div>
                                        <div class="col-md-2">Password Lama</div>
                                        <div class="col-md-4"> 
                                            <input class="form-control" id="password_lama" name="password_lama" type="password" autocomplete="off" size="28" required="" value="<?php echo set_value('password_lama', ""); ?>" /> 
                                            <span class="warning"><?php echo form_error('password_lama'); ?> </span>
                                        </div> 
                                        <div class="col-md-3">
                                        </div>
                                    </div> 
                                    <div class="row">
                                        <div class="col-md-3">
                                        </div>
                                        <div class="col-md-2">Password Baru</div>
                                        <div class="col-md-4"> 
                                            <input class="form-control" id="password_baru" name="password_baru" type="password" size="28" required="" value="<?php echo set_value('password_baru', ""); ?>" /> 
                                            <span class="warning"><?php echo form_error('password_baru'); ?> </span>
                                        </div> 
                                        <div class="col-md-3">
                                        </div>
                                    </div>    
                                    <div class="row">
                                        <div class="col-md-3">
                                        </div>
                                        <div class="col-md-2">Konfirmasi Password Baru</div>
                                        <div class="col-md-4"> 
                                            <input class="form-control" id="password_baru_konfirmasi" name="password_baru_konfirmasi" type="password" size="28" required="" value="<?php echo set_value('password_baru_konfirmasi', ""); ?>" /> 
                                            <span class="warning"><?php echo form_error('password_baru_konfirmasi'); ?> </span>
                                        </div> 
                                        <div class="col-md-3">
                                        </div>
                                    </div>    
                                    <div class="row" hidden> 
                                        <div class="col-md-12">  
                                            <input id="datamodel" name="datamodel" type="text" size="28" value="<?php echo set_value('datamodel', $datamodel); ?>" />  
                                            <span class="warning"><?php echo form_error('datamodel'); ?> </span>

                                        </div> 
                                    </div> 	 
                            <br/>
                            <div class="row">
                                <div class="col-md-12">
                                    <center><input type="submit" id="button" name="simpan" value="Simpan"  class="btn btn-success" /></center>
                                </div>
                                <?php echo form_close(); ?>   
                            </div>   
                        </div>
                        <div class="col-md-1"></div>
                    </div>
            </div>
        <?php $this->load->view('common/footer'); ?>
        <script src="<?php echo base_url(); ?>include/js/bootstrap.min.js"></script> 
    </body>
</html>