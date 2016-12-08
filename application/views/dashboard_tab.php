  <?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"> 

        <?php $this->load->view('common/head'); ?>
        <?php
        $ubah = (isset($ubah)) ? $ubah : '';
        $alert = $this->session->userdata("error");
        $this->session->unset_userdata("error");
        ?>
        <?php $this->load->view('common/menu'); ?>

		
    </head>
    <body >
    <!--div id="ribbon"></div-->
	<!-- Zozo Tabs Start-->
	<br/>
	<div class="container-fluid">
		<style>
			.tabs {
			position: relative;
			margin: -10px auto;
			width: 100%;
			}
			section {
			text-align: center;
			padding: 0px 0px 0px 0px;
			}
			.tabs label{
				width:11%
			}
			iframe{
				border-color:white;
			}
			.content{
				height:500px;
				width:1370px;
			}
			.tab-selector-1{
				    width: 190px;
			}
			.tab-selector-2{
				    width: 190px;
			}
			.tab-label-1{
				    width: 190px;
			}
			.tab-label-2{
				    width: 190px;
			}
			
		</style>
	 <section class="tabs">
	            <input style="  width: 190px;" id="tab-1" type="radio" name="radio-set" class="tab-selector-1" checked="checked" />
		        <label style="  width: 190px;" for="tab-1" class="tab-label-1">TAB 1</label>
		
	            <input style="  width: 190px;left: 190px" id="tab-2" type="radio" name="radio-set" class="tab-selector-2" />
		        <label style="  width: 190px;" for="tab-2" class="tab-label-2">TAB 2</label>
	            <input style="   width: 190px; left: 393px;" id="tab-3" type="radio" name="radio-set" class="tab-selector-3" />
		        <label style="  width: 190px;" for="tab-3" class="tab-label-3">TAB 3</label>
				
				<input style="    left: 538px;" id="tab-4" type="radio" name="radio-set" class="tab-selector-4" />
		        <label for="tab-4" class="tab-label-4">TAB 4</label>
            
			    <div class="clear-shadow"></div>
				
		        <div class="content">
			        <div class="content-1">
						<iframe   style="    margin-left: -28px;" frameborder="0" height="470px" width="1300px" src="<?php echo site_url('reminder/piutang/show') ?>"></iframe>
					</div>
					
			        <div class="content-2">
						<iframe  style="    margin-left: -28px;" frameborder="0" height="470px" width="1300px" src="<?php echo site_url('reminder/hutang/show') ?>"></iframe>
					</div>
					
			        <div class="content-3">
						<iframe style="    margin-left: -28px;" frameborder="0" height="470px" width="1300px" src="<?php echo site_url('reminder/giro/show') ?>"></iframe>								
					</div>
					
					 <div class="content-4">
						<iframe style="    margin-left: -28px;" frameborder="0" height="470px" width="1300px" src="<?php echo site_url('reminder/stok/show') ?>"></iframe>								
					</div>
			        
		        </div>
			</section>
        </div>
     
  
        <?php $this->load->view('common/footer'); ?>
		<script src="<?php echo base_url(); ?>include/js/bootstrap.min.js"></script>
	</body>
	</html>