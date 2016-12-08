<?php
$this->load->view('common/header');
$this->load->view('common/head_no_menu');
	
	$keyword = $this->session->userdata('keyword_search');
	$popup=$this->session->userdata('popup');
	if($popup!="")
	{
			$message="".$this->session->userdata('popup')." data berhasil!!";
				echo "<script type='text/javascript'>alert('$message');</script>";
		$this->session->set_userdata('popup', '');
	}
?>

	<script type="text/javascript">
		window.onload = function() {
			
			javascript:refreshParent()
			window.close();
		}
		function simpan()
		{
			
			 
			
		}
	</script>
	
<?php
$this->load->view('common/footer');
?>