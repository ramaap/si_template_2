<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"> 
		<?php $this->load->view('common/head'); ?>
    </head>
	<?php
	$profile = $this->data_profile->get_all();
				?>
    <body style="background:#dcf8c6;background-repeat: no-repeat;background-position: center;">
        <?php $this->load->view('common/menu'); ?>
       
        <div id="container">
            <!-- Place your html code here-->
        </div>
        <?php $this->load->view('common/footer'); ?>
        <script src="<?php echo base_url(); ?>include/js/bootstrap.min.js"></script>
    </body>
</html>