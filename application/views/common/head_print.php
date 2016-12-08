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
			<table width="100%"  border=0 style="padding-left:10px;border-left:solid 1px black;border-right:solid 1px black;border-top:solid 1px black;border-collapse:collapse;margin-top:9px">
					<tr > 
						<!--<td width="10%">
							<img style="margin-bottom:0px;" width="100%" class="logo_header" src="<?php echo base_url(); ?>include/img/logo.png">
						</td>-->
						<td align="left" >
						<?php $profile = $this->db->query('SELECT * FROM setting_profile')->row(); ?>

						<span style="font-size:20px"><b><?php echo strtoupper($profile->profile_title); ?></span>
						<br/>
						<?php echo $profile->profile_alamat; ?>
						<br/>
						<span style="font-size:12px">Phone: <?php echo $profile->profile_telepon; ?></span>
						<br/>
						<span style="font-size:12px">Fax: <?php echo $profile->profile_fax; ?></span>
						</td>
						<td align="right" style="padding-right:10px">
						<h2><?php echo $this->session->userdata("subtitle_print"); ?></h2> 
						</td>
					</tr>
					
				</table>
          
		
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