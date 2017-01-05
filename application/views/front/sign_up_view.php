<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        $profile = $this->data_profile->get_all();
        ?>
        <link rel="SHORTCUT ICON" href="<?php echo set_value('userfile', base_url() . "include/img/" . $profile->profile_logo); ?>">
        <title><?php echo $this->session->userdata("subtitle"); ?> | <?php echo $this->session->userdata("title"); ?></title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>include/css/bootstrap-theme.min.css" media="all">
        <link rel="stylesheet" href="<?php echo base_url(); ?>include/css/bootstrap.min.css" media="all">
        <link rel="stylesheet" href="<?php echo base_url(); ?>include/css/sticky-footer.css" media="all">
        <link rel="stylesheet" href="<?php echo base_url(); ?>include/css/style.css" media="all">
        <link rel="stylesheet" href="<?php echo base_url(); ?>include/css/login.css" media="all">
        <script src="<?php echo base_url(); ?>include/js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>include/js/jquery-ui.js"></script>
        <?php
        $alert = $this->session->userdata("error");
        $this->session->unset_userdata("error");
        $this->load->view("common/time");
        ?>
        <script type="text/javascript">
            _alert = '<?php echo $alert; ?>';

            window.onload = function () {
                if (_alert != "")
                    alertify.success(_alert);
            }
			
        </script>

    </head>
    <body style="background:#ffffff;background-repeat: no-repeat;background-position: center;">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-1"></div>
        </div>
        <div id="container">
            <?php
            $attributes = array('class' => 'form-signin');
            echo form_open('front/sign_up/add', $attributes);
            ?>
			MASUKKAN USERNAME DAN PASSWORD :
            <input type="text" name="username" class="form-control" placeholder="Username" required="" autofocus="">
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" name="password1" class="form-control" placeholder="Password" required="">
            <input type="password" name="password2" class="form-control" placeholder="Ulang Password" required="">
            <input type="text" name="customer_nama" class="form-control" placeholder="Nama" required="">
            <input type="email" name="customer_email" class="form-control" placeholder="e-mail" required="">
            <input type="text" name="customer_telp" class="form-control" placeholder="Telepon/HP" required="">
            <textarea type="text" name="customer_alamat" class="form-control" placeholder="Alamat" required=""></textarea>
            <input type="text" name="customer_provinsi" class="form-control" placeholder="Provinsi" required="">
            <input type="text" name="customer_kota" class="form-control" placeholder="Kota" required="">
            <input type="text" name="customer_kecamatan" class="form-control" placeholder="Kecamatan" required="">
            <input type="number" name="customer_kode_pos" class="form-control" placeholder="Kode Pos" required="">
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign Up</button>
            <?php echo form_close(); ?>
        </div>
        <?php $this->load->view('common/footer'); ?>
        <script src="<?php echo base_url(); ?>include/js/bootstrap.min.js"></script>
    </body>
</html>