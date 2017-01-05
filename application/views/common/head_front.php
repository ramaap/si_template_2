<?php  if (file_exists('./include/lokasi/'.$this->session->userdata("logo_website"))&&$this->session->userdata("logo_website")!="") { ?>
<link rel="SHORTCUT ICON" href="<?php echo base_url(); ?>include/lokasi/<?php echo $this->session->userdata("logo_website"); ?>">
 <?php }else{ ?>
<link rel="SHORTCUT ICON" href="<?php echo base_url(); ?>include/img/logo.png">
 <?php } ?>    
<title><?php echo $this->session->userdata("title"); ?> | <?php echo $this->session->userdata("subtitle"); ?></title>
<link rel="stylesheet" href="<?php echo base_url(); ?>include/css/bootstrap-theme.min.css" media="all">
<link rel="stylesheet" href="<?php echo base_url(); ?>include/css/bootstrap.min.css" media="all">
<link rel="stylesheet" href="<?php echo base_url(); ?>include/css/sticky-footer.css" media="all">
<link rel="stylesheet" href="<?php echo base_url(); ?>include/css/style.css" media="all">
<link rel="stylesheet" href="<?php echo base_url(); ?>include/css/jquery-ui.css" media="all">
<link rel="stylesheet" href="<?php echo base_url(); ?>include/css/remodal/remodal.css" media="all"> 
<link rel="stylesheet" href="<?php echo base_url(); ?>include/css/remodal/remodal-default-theme.css" media="all">
 <link rel="stylesheet" href="<?php echo base_url(); ?>include/skins/all.css" media="all">
 <link rel="stylesheet" href="<?php echo base_url(); ?>include/css/scroll/prettify.css" media="all">
<script src="<?php echo base_url(); ?>include/js/scroll/prettify.js"></script>
<script src="<?php echo base_url(); ?>include/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>include/js/scroll/jquery.scrollbar.js"></script>
<script src="<?php echo base_url(); ?>include/js/jquery-ui.js"></script>


<script type="text/javascript" src="<?php echo base_url();?>include/js/md5.js"></script>

<!-- Remodal -->
<link rel="stylesheet" href="<?php echo base_url(); ?>include/css/remodal/popup.css">


<!-- Alertify -->
<script src="<?php echo base_url(); ?>include/js/alertify/alert_dialog.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>include/css/alertify/alert_dialog.css" media="all">
<link rel="stylesheet" href="<?php echo base_url(); ?>include/css/alertify/alert_dialog.core.css" media="all">

<!-- Format Date -->
<script src="<?php echo base_url(); ?>include/js/format_date/date.js"></script>

<!-- chosen.jquery (Autocomplete combobox) -->
<link rel="stylesheet" href="<?php echo base_url(); ?>include/css/chosen/bootstrap-chosen.css" media="all">
<script src="<?php echo base_url(); ?>include/js/chosen/chosen.jquery.js"></script>

<!-- export xls -->
<script src="<?php echo base_url(); ?>include/js/filesavers.js"></script>


<!-- Angular -->
<script src="<?php echo base_url(); ?>include/js/angular/angular.min.js"></script>
<script src="<?php echo base_url(); ?>include/js/angular/ng-table.js"></script>
<script src="<?php echo base_url(); ?>include/js/angular/angular-resource.js"></script>
<script src="<?php echo base_url(); ?>include/js/angular/angular-mocks.js"></script>
<script src="<?php echo base_url(); ?>include/js/angular/ng-table-export.src.js"></script>
<script src="<?php echo base_url(); ?>include/js/angular/angular-locale_id.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>include/js/angular/ng-table-kecil.css">
<script src="<?php echo base_url(); ?>include/js/angular-fontawesome.min.js"></script>

<!--Toolbar-->
<link href="<?php echo base_url(); ?>include/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
<script type="text/javascript" src="<?php echo base_url(); ?>include/js/jquery.toolbar.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>include/css/jquery.toolbar.css" />
<div class="container-fluid">
<div class="row">
   
    <div class="col-md-6 ">
        <div class="judul"><?php echo $this->session->userdata("title"); ?></div>
        <div class="sub_judul head-print"><?php echo $this->session->userdata("subtitle"); ?></div>
    </div>
</div>
</div>