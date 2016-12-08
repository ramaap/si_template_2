<?php
$this->load->view('common/header');
$this->load->view('common/head');
?>

<script type="text/javascript">
function ceklama()
		{
			belanja = document.getElementById("password_lama").value;
			konfirm=document.getElementById("password_konfirm").value;
			status = document.getElementById("eror_konfirm").style.visibility;
			

			if( window.XMLHttpRequest ) // code for IE7+, Firefox, Chrome, Opera, Safari
			{
				xmlhttp = new XMLHttpRequest();
			}
			else // code for IE6, IE5
			{
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}

			xmlhttp.onreadystatechange=function()
			{
				if( xmlhttp.readyState == 4 && xmlhttp.status == 200 )
				{
					hasil=xmlhttp.responseText;
					if(hasil=="Salah")
						document.getElementById("eror_lama").style.visibility = "visible";
					else
					document.getElementById("eror_lama").style.visibility = "hidden";
				
					if(status=="hidden"&&hasil=="Benar"&&konfirm!="")
					document.getElementById("simpan").type="submit";
					else
					document.getElementById("simpan").type="hidden";
				}
			}
			xmlhttp.open("GET", "<?php echo $this->mine->my_url() . 'welcome/ceklama/'; ?>"+belanja, true);
			xmlhttp.send();
		}
	</script>
<script type="text/javascript">	
	function cekkonfirm()
		{
			baru = document.getElementById("password_baru").value;
			konfirm = document.getElementById("password_konfirm").value;
			lama = document.getElementById("password_lama").value;
			status=document.getElementById("eror_lama").style.visibility;
			if(konfirm=="")
			{
				document.getElementById("status_baru").innerHTML = "?";
			}
			else{
				if(baru==konfirm)
				document.getElementById("eror_konfirm").style.visibility = "hidden";
				else
				document.getElementById("eror_konfirm").style.visibility = "visible";
				
				if(status=="hidden"&&baru==konfirm&&lama!="")
					document.getElementById("simpan").type="submit";
				else
				document.getElementById("simpan").type="hidden";
			}
			
			
		}
	</script>
	
	<?php echo form_open('welcome/change_password/'); ?>
	
		<table width="550px" cellpadding="3px">
		<thead>
		<tr>
			<th colspan="2"  onClick="showHide(this)">Form Ganti Password</th>
			</tr>
</thead>	
<tbody>
				<input name="user_id" type="hidden" size="40" value="<?php echo set_value('user_id',$this->session->userdata('user_id')); ?>" />
				
				<tr class="form">
					<td>Username</td>
					<td><input name="user_nama" type="text" size="40" value="<?php echo set_value('user_nama',$this->session->userdata('user_nama')); ?>" /> <?php echo form_error('user_nama'); ?></td>
				</tr>
				<tr class="form">
					<td>Password Lama</td>
					<td><input id="password_lama" name="password_lama"  type="password" size="40" value="<?php echo set_value('password_lama',''); ?>" /> <?php echo form_error('password_lama'); ?>
					<?php
					echo '<a id="eror_lama" style=" visibility: hidden;" ><img src="' . base_url() . 'images/error.png" border="0" title="Password Lama Salah "/></a>';
					?>
					</td>
					
				</tr>
				
				<tr class="form">
					<td>Password Baru</td>
					<td><input id="password_baru"  name="password_baru" type="password" size="40" value="<?php echo set_value('password_baru',''); ?>" /> <?php echo form_error('password_baru'); ?></td>
				</tr>
				<tr class="form">
					<td>Konfirmasi Password Baru</td>
					<td><input id="password_konfirm"  name="password_konfirm" type="password" size="40" value="<?php echo set_value('password_konfirm',''); ?>" /> <?php echo form_error('password_konfirm'); ?>
					<?php
					echo '<a id="eror_konfirm" style=" visibility: hidden;" ><img src="' . base_url() . 'images/error.png" border="0" title="Password Konfirmasi Tidak Sama "/></a>';
					?>
					</td>
				</tr>
				
				<tr class="button">
					<td colspan="2" align="center">
						<input type="submit" id="simpan" name="simpan" value="simpan" class="btn" />
						<input type="submit" name="batal" value="batal" class="btn" />
					</td>
				</tr>
				</tbody>
		</table>
	</form>

	<script>
	
	</script>

	
<?php
$this->load->view('common/footer');
?>