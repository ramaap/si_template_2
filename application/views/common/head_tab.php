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
<script src="<?php echo base_url(); ?>include/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>include/js/jquery-ui.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>include/css/remodal/remodal.css" media="all"> 
<link rel="stylesheet" href="<?php echo base_url(); ?>include/css/remodal/remodal-default-theme.css" media="all">
<!-- Scrool-->
 <link rel="stylesheet" href="<?php echo base_url(); ?>include/css/scroll/style.css" media="all">
 <link rel="stylesheet" href="<?php echo base_url(); ?>include/css/scroll/prettify.css" media="all">
<script src="<?php echo base_url(); ?>include/js/scroll/prettify.js"></script>
<!-- <script src="<?php echo base_url(); ?>include/js/cheklist/icheck.js"></script>-->
<script src="<?php echo base_url(); ?>include/js/scroll/jquery.scrollbar.js"></script>

 
 <link rel="stylesheet" href="<?php echo base_url(); ?>include/skins/all.css" media="all"> 
  

<!-- Remodal -->
<link rel="stylesheet" href="<?php echo base_url(); ?>include/css/remodal/popup.css">



<!-- Alertify -->
<script src="<?php echo base_url(); ?>include/js/alertify/alert_dialog.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>include/css/alertify/alert_dialog.css" media="all">
<link rel="stylesheet" href="<?php echo base_url(); ?>include/css/alertify/alert_dialog.core.css" media="all">

<!-- Autocomplete -->
<link rel="stylesheet" href="<?php echo base_url(); ?>include/css/autocomplete/jquery_autocomplete-ui.css" media="all"> 

<!-- Format Date -->
<script src="<?php echo base_url(); ?>include/js/format_date/date.js"></script>

<!-- TAB -->
<link rel="stylesheet" href="<?php echo base_url(); ?>include/css/tab/zozo.tabs.min.css" media="all">
<script src="<?php echo base_url(); ?>include/js/tab/zozo.tabs.min.js"></script>

<!-- chosen.jquery (Autocomplete combobox) -->
<link rel="stylesheet" href="<?php echo base_url(); ?>include/css/chosen/bootstrap-chosen.css" media="all">
<script src="<?php echo base_url(); ?>include/js/chosen/chosen.jquery.js"></script>






<!-- tooltip -->
<link rel="stylesheet" href="<?php echo base_url(); ?>include/css/tooltip/jquery.qtip.css" media="all">
<script src="<?php echo base_url(); ?>include/js/tooltip/jquery.qtip.js"></script>
<script src="<?php echo base_url(); ?>include/js/tooltip/imagesloaded.pkg.min.js"></script>
 
   


<?php
$this->load->view('common/javascript');
	
?>



<!-- Angular -->
<script src="<?php echo base_url(); ?>include/js/angular/angular.min.js"></script>
<script src="<?php echo base_url(); ?>include/js/angular/ng-table.js"></script>
<script src="<?php echo base_url(); ?>include/js/angular/angular-resource.js"></script>
<script src="<?php echo base_url(); ?>include/js/angular/angular-mocks.js"></script>
<script src="<?php echo base_url(); ?>include/js/angular/ng-table-export.src.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>include/js/angular/ng-table-kecil.css">
<script src="<?php echo base_url(); ?>include/js/angular-fontawesome.min.js"></script>

<!-- X-editable -->
<link rel="stylesheet" href="<?php echo base_url(); ?>include/css/xeditable.css">
<script type="text/javascript" src="<?php echo base_url(); ?>include/js/xeditable.min.js"></script> 

<!--Toolbar-->
<link href="<?php echo base_url(); ?>include/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
<script type="text/javascript" src="<?php echo base_url(); ?>include/js/jquery.toolbar.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>include/css/jquery.toolbar.css" />
   