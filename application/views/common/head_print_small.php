<head>
 <!--link rel="stylesheet" href="<?php echo base_url(); ?>include/script/col.css" media="all">
    <link rel="stylesheet" href="<?php echo base_url(); ?>include/script/2cols.css" media="all">
    <link rel="stylesheet" href="<?php echo base_url(); ?>include/script/3cols.css" media="all">
    <link rel="stylesheet" href="<?php echo base_url(); ?>include/script/4cols.css" media="all">
    <link rel="stylesheet" href="<?php echo base_url(); ?>include/script/5cols.css" media="all">
    <link rel="stylesheet" href="<?php echo base_url(); ?>include/script/6cols.css" media="all">
    <link rel="stylesheet" href="<?php echo base_url(); ?>include/script/7cols.css" media="all">
    <link rel="stylesheet" href="<?php echo base_url(); ?>include/script/8cols.css" media="all">
    <link rel="stylesheet" href="<?php echo base_url(); ?>include/script/9cols.css" media="all">
    <link rel="stylesheet" href="<?php echo base_url(); ?>include/script/10cols.css" media="all">
    <link rel="stylesheet" href="<?php echo base_url(); ?>include/script/11cols.css" media="all">
    <link rel="stylesheet" href="<?php echo base_url(); ?>include/script/12cols.css" media="all"-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>include/script/style_print.css" media="all">
 
	
	<a href="javascript:window.print();" class="cetar" style="border:1px solid black;text-decoration:none;padding:10px;margin-bottom:10px; margin-left:50%">Cetak</a><br/> 
			<div class="header">
		 
			<div class="main" style="margin-bottom:3px">
				<div style="float:left">
				<?php $profile = $this->db->query('SELECT * FROM setting_profile')->row(); ?>

						<span style="font-size:20px"><b><?php echo strtoupper($profile->profile_title); ?></span>
				</div>
				
				<div style="float:right">
				<h2><?php echo $this->session->userdata("subtitle_print"); ?></h2> 
				</div>
			</div>
			<br/>
          <div class="main" style="margin-bottom:3px">
				<div style="text-align:left; float:left">
				 <?php echo $profile->profile_alamat; ?>
				</div>
				
				<div style="float:right">
				&nbsp;
				</div>
			</div>
			<br/>
          <div class="main" style="margin-bottom:3px">
				<div style="float:left">
				Phone : <?php echo $profile->profile_telepon; ?>
				</div>
				   
				<div style="float:right">
				&nbsp;
				</div>
			</div>
			<br/>
          <div class="main" style="margin-bottom:3px">
				<div style="float:left">
				Fax&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $profile->profile_fax; ?>
				</div>
				
				<div style="float:right">
				&nbsp;
				</div>
			</div>
          <br/>
          <br/>
		
		</div>
	<style>  
	@page 
	{
		size: auto;   /* auto is the current printer page size */
		margin: 0mm;  /* this affects the margin in the printer settings */
		margin-top: 20px ;   /* this affects the margin in the printer settings */
		margin-bottom: 20px ;  /* this affects the margin in the printer settings */
		margin-left: 40px ;   /* this affects the margin in the printer settings */
		margin-right: 40px ;   /* this affects the margin in the printer settings */ 
	}
	@media print { 
		.cetar{display: none;}
	}
</style>
</head>
<body> 
	<div >
		<center> 