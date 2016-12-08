<?php

defined('BASEPATH') OR exit('No direct script access allowed');


    include 'WebClientPrint.php';
    use Neodynamic\SDK\Web\WebClientPrint;
    use Neodynamic\SDK\Web\Utils;
    use Neodynamic\SDK\Web\DefaultPrinter;
    use Neodynamic\SDK\Web\InstalledPrinter;
    use Neodynamic\SDK\Web\ClientPrintJob;
	
class printreceipt extends CI_Controller {

    // Process request
    // Generate ClientPrintJob? only if clientPrint param is in the query string
	
	
	 public function align($mode="left",$max="0",$str){
		 $string="";
		 $length=0;
		 if($mode=="right")
		 {
			$length=strlen($str);
			$string= str_pad("", $max-$length, ' ', STR_PAD_LEFT);
			$str= str_pad($string, $max, $str, STR_PAD_RIGHT);
		 }
		 else if($mode=="center")
		 { 
			$length=strlen($str);
			if($length<$max)
			{
				$batas=$max-$length;
				$left=round($batas/2); 
				$string=str_pad("", $left, ' ', STR_PAD_LEFT);
				$str=$string.$str.str_pad("", $left-1, ' ', STR_PAD_RIGHT); 
			}
			else
			{
				$length=0;
				$arr=explode(" ",$str);
				for($i=0;$i<count($arr);$i++)
				{
					$length2=strlen($arr[$i])+1; 
					
					if($length2+$length<=$max)
					{
						$length+=$length2; 
						$string.=$arr[$i]." "; 
					} 
					else
					{ 
						$length=0;
						$string.="0x0A".$arr[$i]." "; 
					}
				} 
				$str=$string."0x0A";
			}
		 }
		 return $str;
	 }
	 
	 public function prints(){ 
		date_default_timezone_set("Asia/Jakarta");
        $this->load->model('data_user'); 
        $this->load->model('data_profile'); 
        // $this->load->model('data_lokasi'); 
        // $this->load->model('data_cabang'); 
		$urlParts = parse_url($_SERVER['REQUEST_URI']);
		
		if (isset($urlParts['query'])){
			$rawQuery = $urlParts['query'];
			parse_str($rawQuery, $qs);
			if(isset($qs['media']))
			{
				if(isset($qs[WebClientPrint::CLIENT_PRINT_JOB]))
				$this->rekap_harian($qs);
			}
			else
			{
			if(isset($qs[WebClientPrint::CLIENT_PRINT_JOB])){

				$useDefaultPrinter = ($qs['useDefaultPrinter'] === 'checked');
				$printerName = urldecode($qs['printerName']);
				$user_id = urldecode($qs['user_id']);
				//Nota 
				$temp=$this->db->query('SELECT * FROM transaksi_penjualan u
				left join konsumen a on a.konsumen_id=u.konsumen_id
				WHERE u.penjualan_id='.$qs['datamodel'])->row();
				$dataData = array(
					'penjualan_print' => urldecode($temp->penjualan_print+1), 
				);
				$this->db->where('penjualan_id', $qs['datamodel']);
				$this->db->update('transaksi_penjualan', $dataData); 
				$temp=$this->db->query('SELECT * FROM transaksi_penjualan u
				left join konsumen a on a.konsumen_id=u.konsumen_id
				WHERE u.penjualan_id='.$qs['datamodel'])->row();
				$setting_nota=$this->db->query('SELECT * FROM setting_nota limit 1')->row();
				//Detail
				$detail=$this->db->query('SELECT * FROM transaksi_penjualan_detail u 
				join barang e on e.barang_id = u.barang_id and e.is_delete=0
				join data_satuan f on f.satuan_id = e.satuan_id and f.is_delete=0 
				WHERE penjualan_id='.$qs['datamodel'])->result(); 
				//print header 
				$user = $this->data_user->get_row_by_id($user_id); 
				$profil = $this->data_profile->get_all();
				// $profil=$this->db->query('SELECT * FROM setting_profile  is_delete=0 limit 1 ')->row(); 
				
				// $profil = $this->data_cabang->get_row_detail_by_id($user->cabang_id);
				$header=""; 
				$profile_alamat=""; 
				$profile_telepon=""; 
				$nota_header=""; 
				if(count($profil))
				{  
					$header=$this->align("center",40,$profil->profile_title);
					$profile_alamat=$this->align("center",33,$profil->profile_alamat); 
					$profile_telepon=$this->align("center",33,$profil->profile_telepon);  
					$nota_header=$this->align("center",33,$setting_nota->nota_header);  
				}
			  
				//Create ESC/POS commands for sample receipt
				$esc = '0x1B'; //ESC byte in hex notation
				$newLine = '0x0A'; //LF byte in hex notation
				$Tab = '0x09'; //LF byte in hex notation 
				$Space = '0x20'; //LF byte in hex notation  
	
				$cmds = $esc . "@"; //Initializes the printer (ESC @)
				
				
				$cmds .= $esc . '!' . '0x00'; //Emphasized + Double-height + Double-width mode selected (ESC ! (8 + 16 + 32)) 56 dec => 38 hex
				 if($setting_nota->nota_header!="")
				 {
					$state="ASLI";
					 if($temp->penjualan_print>1)
					$state="COPY";
					$cmds .=$state;
					$cmds .= $newLine;
				 }
				 
				 
				$cmds .= $esc . '!' . '0x19'; //Emphasized + Double-height + Double-width mode selected (ESC ! (8 + 16 + 32)) 56 dec => 38 hex
				 if($header!="") //print profile lokasi kalau ada
				{ 
					$cmds .= ucfirst($header); //text to print
					$cmds .= $newLine; 
					// $cmds .= ucfirst($this->align("center",33,$nota_header));
				}
				
				$cmds .= $esc . '!' . '0x00'; //Emphasized + Double-height + Double-width mode selected (ESC ! (8 + 16 + 32)) 56 dec => 38 hex
				if($header!="") //print profile lokasi kalau ada
				{ 
					 $cmds .= $profile_alamat;
					$cmds .= $newLine;
					$cmds .= $profile_telepon;
					$cmds .= $newLine;
					// $cmds .= ucfirst($this->align("center",33,$nota_header));
				}
				// $cmds .= $newLine.$newLine;
				$cmds .= $esc . '!' . '0x00'; //Emphasized + Double-height + Double-width mode selected (ESC ! (8 + 16 + 32)) 56 dec => 38 hex
				 if($setting_nota->nota_header!="")
				 {
					$cmds .=$this->align("center",33,$setting_nota->nota_header); 
					$cmds .= $newLine.$newLine;
				 }
				$cmds .= $newLine;
				$cmds .= "No Trans : ".strtoupper($temp->penjualan_no); //text to print
				$cmds .= $newLine;
				$cmds .= "Waktu    : ".date("d M Y H:i:s"); //text to print
				$cmds .= $newLine;
				$cmds .= "Operator : ".$user->user_name; //text to print
				$cmds .= $newLine;
				$konsumen="Umum";
				if($temp->konsumen_id!=0)
				$konsumen=ucfirst($temp->konsumen_nama);
				$cmds .= "Pelanggan: ".$konsumen; //text to print 
				$cmds .= $newLine;
				
				$cmds .= str_pad("", 33, '=', STR_PAD_LEFT);
           
				
				$cmds .= $newLine;
				
				$cmds .= $esc . '!' . '0x00'; //Character font A selected (ESC ! 0)
				
				$cmds .= "Produk ".$Tab.$Tab."Qty".$Tab."Berat"; //text to print 
				$cmds .= $newLine;
				$cmds .= str_pad("", 33, '-', STR_PAD_LEFT);
				 foreach($detail as $dd)
				 {
						$produk_nama=$dd->barang_nama;
						$length=strlen($produk_nama);
						$satuan_nama=strlen($dd->penjualan_detail_jumlah.$dd->satuan_nama);
						$length_space=0;
						$index=0;
						$tes="";
						if($length>17) //membatasi panjang karakter nama produk 12 (supaya harganya g ke bawah)
						{
							$arr=explode(" ",$produk_nama);
							for($i=0;$i<count($arr);$i++)
							{
								$length2=strlen($arr[$i]);
								// echo "tes=".$length2.'+'.$length_space;
								
								if($length2+$length_space<=17)
								{
									$length_space+=$length2;
									$index++;
								}
							}
							$produk_nama="";
							for($i=0;$i<$index;$i++)
							{
								$produk_nama.=$arr[$i]." ";
								// $tes.=$i."?".$produk_nama;
							}
							
						}
						else
						{ 
							$produk_nama= str_pad($dd->barang_nama, 17, ' ', STR_PAD_RIGHT);
						}
						
					 	if($satuan_nama>6) //membatasi panjang karakter Satuan 5 (supaya harganya g ke bawah)
						{ 
							$length=strlen($dd->penjualan_detail_jumlah);
							$satuan_nama=substr($dd->satuan_nama,"0",6-$length);
						}
						else
							$satuan_nama= $dd->satuan_nama; 
						
						$length=strlen($dd->penjualan_detail_berat);
						$berat=str_replace(".",",",$dd->penjualan_detail_berat);
					 	if($length>6) //membatasi panjang karakter Satuan 6 (supaya harganya g ke bawah)
						{  
							$penjualan_detail_berat=substr($berat,"0",$length);
						}
						else
							$penjualan_detail_berat= $berat; 
						
						$harga=number_format(($dd->penjualan_detail_harga), 0, ',', '.');
						$harga=$this->align("right","7",$harga); 
						$penjualan_detail_berat=$this->align("right","6",$penjualan_detail_berat); 
						$cmds .= ucfirst($produk_nama).$Tab.$dd->penjualan_detail_jumlah.$satuan_nama.$Tab.$penjualan_detail_berat; 
						$cmds .= $newLine;
						$txt= str_pad("Harga @ :", 26, ' ', STR_PAD_LEFT);
						// $txt=$this->align("left","25","Harga :"); 
						$cmds .= $txt.$harga;
						
						$cmds .= $newLine;
				 }
				
				// $cmds .= $newLine;
				$cmds .= str_pad("", 22, ' ', STR_PAD_LEFT);
				$cmds .= str_pad("", 11, '-', STR_PAD_RIGHT);
				$cmds .= $newLine;
				$disc=abs($temp->penjualan_tagihan_bruto)-abs($temp->penjualan_tagihan);
				
				$cmds .= $esc . '!' . '0x00'; //Character font A selected (ESC ! 0) 
				if($disc>0) //kalau ada diskon
				{
					$cmds .= $Tab.'Total '.$Tab.$Tab.$this->align("right","13",number_format(($temp->penjualan_tagihan_bruto), 0, ',', '.')); 
					// $this->align("right","11",number_format(($temp->penjualan_tagihan), 0, ',', '.'))
					$cmds .= $newLine; 
					$cmds .= $Tab.'Disc '.$Tab.$Tab.$this->align("right","13",number_format(($disc), 0, ',', '.'));
					$cmds .= $newLine; 
				}
				$cmds .= $Tab.'Tagihan '.$Tab.$this->align("right","13",number_format(($temp->penjualan_tagihan), 0, ',', '.'));
				$cmds .= $newLine; 
				$cmds .= $Tab.'Bayar '.$Tab.$Tab.$this->align("right","13",number_format(($temp->penjualan_bayar), 0, ',', '.'));
				$cmds .= $newLine; 
				if($temp->penjualan_tagihan>$temp->penjualan_bayar)
				{
					$cmds .= $Tab.'Piutang '.$Tab.$this->align("right","13",number_format(($temp->penjualan_tagihan), 0, ',', '.'));
					$cmds .= $newLine;  
				}
				else
				{
					$cmds .= $Tab.'Kembalian '.$Tab.$this->align("right","13",number_format(($temp->penjualan_kembalian), 0, ',', '.')); 
					$cmds .= $newLine . $newLine;	
				}
				
				$cmds .= $esc . '!' . '0x00'; //Character font A selected (ESC ! 0) 
				if($setting_nota->nota_catatan!="")
				{
					$cmds .=$this->align("center",33,$setting_nota->nota_catatan); 
					$cmds .= $newLine;
				}
				if($setting_nota->nota_footer!="")
				{
					$cmds .=$this->align("center",33,$setting_nota->nota_footer);  
					$cmds .= $newLine . $newLine; 
				}
				$cmds .=$this->align("center",33,"NusantaraTechno.com");  
				$cmds .= $newLine . $newLine;  
				$cmds .= $newLine . $newLine;
				$cmds .= $newLine . $newLine;

				//Create a ClientPrintJob obj that will be processed at the client side by the WCPP
				$cpj = new ClientPrintJob();
				//set ESC/POS commands to print...
				$cpj->printerCommands = $cmds;
				$cpj->formatHexValues = true;
				//set client printer
				if ($useDefaultPrinter || $printerName === 'null'){
					$cpj->clientPrinter = new DefaultPrinter();
				}else{
					$cpj->clientPrinter = new InstalledPrinter($printerName);
				}

				//Send ClientPrintJob back to the client
				ob_start();
				ob_clean();
				echo $cpj->sendToClient();
				ob_end_flush(); 
				exit();
			}
			}
		}
	}

	  public function rekap_harian($qs) {
		$useDefaultPrinter = ($qs['useDefaultPrinter'] === 'checked');
		$printerName = urldecode($qs['printerName']);
		$user_id = urldecode($qs['user_id']);
		
        $filter_tanggal = date("Y-m-d");
        $rekap = $this->db->query("SELECT transaksi_jenis,keuangan_jenis,sum(keuangan_jumlah) as keuangan_jumlah FROM `keuangan` WHERE `transaksi_jenis`='POS' and date(keuangan_tanggal)=date('".$filter_tanggal."')
			group by `keuangan_jenis`  
		")->result(); 
		 
        $index = 0;
		$cash=$rekening=$giro=$kas_bon=0;
        foreach ($rekap as $tmp) {

			if($tmp->keuangan_jenis=="Cash Kecil"||$tmp->keuangan_jenis=="Cash Kecil")
				$cash+=$tmp->keuangan_jumlah;
			if($tmp->keuangan_jenis=="Rekening")
				$rekening+=$tmp->keuangan_jumlah;
			if($tmp->keuangan_jenis=="Giro")
				$giro+=$tmp->keuangan_jumlah;
          
		
        }
		 $trans = $this->db->query("SELECT count(*) as jml FROM `transaksi_penjualan` WHERE penjualan_tanggal like '%".$filter_tanggal."%'")->row(); 
		 $piutang = $this->db->query("SELECT sum(piutang_jumlah) as jml FROM `keuangan_piutang` WHERE piutang_tanggal like '%".$filter_tanggal."%'")->row(); 
			if(count($piutang)>0)
				$kas_bon=$piutang->jml;
			  $temp['index'] = $index;
			  $temp['rekap_tanggal'] = date("d M Y");
			  $temp['rekap_cash'] =  abs($cash);
			  $temp['rekap_rekening'] =  abs($rekening);
			  $temp['rekap_giro'] =  abs($giro);
			  $temp['rekap_piutang'] = abs($kas_bon);
			  $temp['rekap_transaksi'] = $trans->jml; 
			  $total=abs($cash)+abs($rekening)+abs($giro)+abs($kas_bon);
			  
			$esc = '0x1B'; //ESC byte in hex notation
			$newLine = '0x0A'; //LF byte in hex notation
			$tab = '0x09'; //LF byte in hex notation 
			$Space = '0x20'; //LF byte in hex notation  

			$cmds = $esc . "@"; //Initializes the printer (ESC @)
			$header=$this->align("center",40,"Rekap Transaksi Artomoro");
			$cmds .= $esc . '!' . '0x19';
			$cmds .= ucfirst($header); //text to print
			$cmds .= $esc . '!' . '0x00'; //Character font A selected (ESC ! 0) 
			$cmds .= $newLine;
			$cmds .= $newLine;
			$cmds .= "Tgl ".$tab.$tab.": ".date("d M Y"); //text to print
			$cmds .= $newLine;
			$cmds .= "Jml Trans".$tab.": ".$trans->jml; //text to print
			$cmds .= $newLine;
			$cmds .= "Cash".$tab.$tab.": Rp.".number_format(abs($cash), 0, ',', '.'); //
			$cmds .= $newLine;
			$cmds .= "Rekening".$tab.": Rp.".number_format(abs($rekening), 0, ',', '.'); //
			$cmds .= $newLine;
			$cmds .= "Giro".$tab.$tab.": Rp.".number_format(abs($giro), 0, ',', '.'); //
			$cmds .= $newLine;
			$cmds .= "Kas Bon".$tab.": Rp.".number_format(abs($kas_bon), 0, ',', '.'); //
			$cmds .= $newLine;
			$cmds .= str_pad("", 33, '-', STR_PAD_LEFT);
			$cmds .= $newLine;
			$cmds .= "Total".$tab.$tab.": Rp.".number_format(abs($total), 0, ',', '.'); //
			$cmds .= $newLine;
			$cmds .= $newLine;
			$cmds .= $newLine;
			$cmds .= $newLine;
			$cmds .= $newLine;
			$cmds .= $newLine;

			//Create a ClientPrintJob obj that will be processed at the client side by the WCPP
			$cpj = new ClientPrintJob();
			//set ESC/POS commands to print...
			$cpj->printerCommands = $cmds;
			$cpj->formatHexValues = true;
			//set client printer
			if ($useDefaultPrinter || $printerName === 'null'){
				$cpj->clientPrinter = new DefaultPrinter();
			}else{
				$cpj->clientPrinter = new InstalledPrinter($printerName);
			}

			//Send ClientPrintJob back to the client
			ob_start();
			ob_clean();
			echo $cpj->sendToClient();
			ob_end_flush(); 
			exit();
	}
	
	/* public function prints(){
		
		$urlParts = parse_url($_SERVER['REQUEST_URI']);
		
		if (isset($urlParts['query'])){
			$rawQuery = $urlParts['query'];
			parse_str($rawQuery, $qs);
			if(isset($qs[WebClientPrint::CLIENT_PRINT_JOB])){

				$useDefaultPrinter = ($qs['useDefaultPrinter'] === 'checked');
				$printerName = urldecode($qs['printerName']);
				
				$temp=$this->db->query('SELECT * FROM transaksi_penjualan WHERE penjualan_id='.$qs['datamodel'])->row();
				//Create ESC/POS commands for sample receipt
				$esc = '0x1B'; //ESC byte in hex notation
				$newLine = '0x0A'; //LF byte in hex notation

				$cmds = $esc . "@"; //Initializes the printer (ESC @)
				$cmds .= $esc . '!' . '0x10'; //Emphasized + Double-height + Double-width mode selected (ESC ! (8 + 16 + 32)) 56 dec => 38 hex
				
				$cmds .= $temp->penjualan_no; //text to print
				$cmds .= $newLine . $newLine;
				$cmds .= $esc . '!' . '0x00'; //Character font A selected (ESC ! 0)
				
				$cmds .= 'COOKIES                   5.00'; 
				$cmds .= $newLine;
				$cmds .= 'MILK 65 Fl oz             3.78';
				$cmds .= $newLine . $newLine;
				$cmds .= 'SUBTOTAL                  8.78';
				$cmds .= $newLine;
				$cmds .= 'TAX 5%                    0.44';
				$cmds .= $newLine;
				$cmds .= 'TOTAL                     9.22';
				$cmds .= $newLine;
				$cmds .= 'CASH TEND                10.00';
				$cmds .= $newLine;
				$cmds .= 'CASH DUE                  0.78';
				$cmds .= $newLine . $newLine;
				$cmds .= $esc . '!' . '0x18'; //Emphasized + Double-height mode selected (ESC ! (16 + 8)) 24 dec => 18 hex
				$cmds .= '# ITEMS SOLD 2';
				$cmds .= $esc . '!' . '0x00'; //Character font A selected (ESC ! 0)
				$cmds .= $newLine . $newLine;
				$cmds .= '11/03/13  19:53:17';

				//Create a ClientPrintJob obj that will be processed at the client side by the WCPP
				$cpj = new ClientPrintJob();
				//set ESC/POS commands to print...
				$cpj->printerCommands = $cmds;
				$cpj->formatHexValues = true;
				//set client printer
				if ($useDefaultPrinter || $printerName === 'null'){
					$cpj->clientPrinter = new DefaultPrinter();
				}else{
					$cpj->clientPrinter = new InstalledPrinter($printerName);
				}

				//Send ClientPrintJob back to the client
				ob_start();
				ob_clean();
				echo $cpj->sendToClient();
				ob_end_flush(); 
				exit();
			}
		}
	}
 */
	
/* 
	public function prints(){
	
	$urlParts = parse_url($_SERVER['REQUEST_URI']);
	
	if (isset($urlParts['query'])){
		$rawQuery = $urlParts['query'];
		parse_str($rawQuery, $qs);
		if(isset($qs[WebClientPrint::CLIENT_PRINT_JOB])){

			$useDefaultPrinter = ($qs['useDefaultPrinter'] === 'checked');
			$printerName = urldecode($qs['printerName']);
			
			$temp=$this->db->query('SELECT *,u.* FROM transaksi_penjualan u
			left join konsumen a on a.penjualan_id=u,penjualan_id
			WHERE penjualan_id='.$qs['datamodel'])->row();
			 // $detail=$this->db->query('SELECT * FROM transaksi_penjualan_detail u
			// join data_produk_detail_satuan a on a.detail_satuan_id = u.detail_satuan_id and a.is_delete=0
			// join data_produk_detail g on a.produk_detail_id = g.produk_detail_id and g.is_delete=0
			// join data_produk e on e.produk_id = g.produk_id and e.is_delete=0
			// join data_satuan f on f.satuan_id = a.satuan_id and f.is_delete=0 
			// WHERE penjualan_id='.$qs['datamodel'])->result(); 
			//Create ESC/POS commands for sample receipt
			$esc = '0x1B'; //ESC byte in hex notation
			$newLine = '0x0A'; //LF byte in hex notation
			// $Tab = '0x0b'; //LF byte in hex notation 

			$cmds = $esc . "@"; //Initializes the printer (ESC @)
			$cmds .= $esc . '!' . '0x00'; //Emphasized + Double-height + Double-width mode selected (ESC ! (8 + 16 + 32)) 56 dec => 38 hex
			 
			$cmds .= $temp->penjualan_no; //text to print
			$cmds .= $newLine . $newLine;
			$cmds .= $esc . '!' . '0x00'; //Character font A selected (ESC ! 0)
			
			$cmds .= 'COOKIES                   5.00'; 
			$cmds .= $newLine;
			$cmds .= 'MILK 65 Fl oz             3.78';
			$cmds .= $newLine . $newLine;
			$cmds .= 'SUBTOTAL                  8.78';
			$cmds .= $newLine;
			$cmds .= 'TAX 5%                    0.44';
			$cmds .= $newLine;
			$cmds .= 'TOTAL                     9.22';
			$cmds .= $newLine;
			$cmds .= 'CASH TEND                10.00';
			$cmds .= $newLine;
			$cmds .= 'CASH DUE                  0.78';
			$cmds .= $newLine . $newLine;
			$cmds .= $esc . '!' . '0x18'; //Emphasized + Double-height mode selected (ESC ! (16 + 8)) 24 dec => 18 hex
			$cmds .= '# ITEMS SOLD 2';
			$cmds .= $esc . '!' . '0x00'; //Character font A selected (ESC ! 0)
			$cmds .= $newLine . $newLine;
			$cmds .= '11/03/13  19:53:17';
			
			// $cmds .= $temp->penjualan_no; //text to print
			// $cmds .= strtoupper($temp->penjualan_no); //text to print
			// $cmds .= $newLine . $newLine;
			 // $cmds .= $newLine;
			// $konsumen="Pelanggan";
			// if($temp->konsumen_id!=0)
			// $konsumen=$temp->konsumen_nama;
			// $cmds .= 'Yth. '.$Tab.$konsumen."-".date("d M Y H:i:s"); 
			// $cmds .= $newLine . $newLine;
			// $cmds .= $esc . '!' . '0x00'; //Character font A selected (ESC ! 0)
		}
	}
	}
			//Create a ClientPrintJob obj that will be processed at the client side by the WCPP
			$cpj = new ClientPrintJob();
			//set ESC/POS commands to print...
			$cpj->printerCommands = $cmds;
			$cpj->formatHexValues = true;
			//set client printer
			if ($useDefaultPrinter || $printerName === 'null'){
				$cpj->clientPrinter = new DefaultPrinter();
			}else{
				$cpj->clientPrinter = new InstalledPrinter($printerName);
			}

			//Send ClientPrintJob back to the client
			ob_start();
			ob_clean();
			echo $cpj->sendToClient();
			ob_end_flush(); 
			exit();
		}
	}
}
 */

}
