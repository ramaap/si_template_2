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
			
			function sign_up()
			{
				window.location.replace("<?php echo site_url('front/sign_up'); ?>");
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
            echo form_open('login_customer', $attributes);
            ?>
			LOGIN CUSTOMER
            <center><img style="margin-bottom:20px;" width="70%" id="preview_image" src="<?php echo set_value('userfile', base_url() . "include/img/" . $profile->profile_logo); ?>">
                <!--h2 class="form-signin-heading">LOGO SI</h2--></center>
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="text" name="username" class="form-control" placeholder="Username" required="" autofocus="">
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Password" required="">
            <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
            <a onclick="sign_up()" class="btn btn-lg btn-danger btn-block">Sign Up</a>
            <?php echo form_close(); ?>
        </div>
        <?php $this->load->view('common/footer'); ?>
        <script src="<?php echo base_url(); ?>include/js/bootstrap.min.js"></script>
    </body>
</html>