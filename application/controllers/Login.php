<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Model template 
        $this->load->model('data_role');
        $this->load->model('data_user');
        $this->load->model('data_profile');

        // Place your model here...
    }

	 public function get_all_password_manager() {
        $i = 1;
        $ptn = '[';
        $manager = $this->db->query('SELECT * FROM data_user u
		join data_role a on a.role_id=u.role_id
		WHERE role_nama ="Manager" and u.is_delete=0')->result();
        if ($manager != null) {
            foreach ($manager as $row) {
                if ($i != count($manager))
                    $ptn .= '"' . $row->user_password . '"' . ',';
                else {
                    $ptn .= '"' . $row->user_password . '"';
                }
                $i++;
            }
            $ptn .= ']';
			$this->session->set_userdata("otorisasi",$ptn);
			
            return $ptn;
        } else {
		   $this->session->set_userdata("otorisasi",'');
            return NULL;
        }
    }
	
    public function set_tab() {
		$this->session->set_userdata('tab',$_POST["tab"]);
	}
	
 	public function index() {
	$this->lib->check_lokasi("Login");          
		
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login');
        } else {
            if ($this->lib->check_login()) {
			
					$this->get_all_password_manager();
					$this->lib->check_lokasi("Dashboard");           
					$this->load->view('dashboard');
            } else {
                echo '<script>alert("Username dan Password salah atau tidak ada!")</script>';
                $this->load->view('login');
            }
        }
    } 

    public function logout() {
        $this->lib->logout();
	$this->lib->check_lokasi("Login");    
        $this->load->view('login');
    }

    public function pass() { 
                $this->lib->check_lokasi("Change Password");     
		$data["user_name"]=$this->session->userdata("user_name");
		$data["user_password"]=$this->session->userdata("user_password");
		$data["datamodel"]=$this->session->userdata("user_id");
        $this->load->view('change_password',$data);
    }
	
	  public function edit() { //change_password 
		$pass_lama=$this->db->query('select * from data_user where user_id="'.$_POST['datamodel'].'"')->row();
		
		$this->form_validation->set_rules('password_lama', 'Password Lama', 'required|same_custom['.md5($_POST['password_lama']).'.'.$pass_lama->user_password.']');
		$this->form_validation->set_rules('password_baru', 'Password Baru', 'required');
		$this->form_validation->set_rules('password_baru_konfirmasi', 'Konfirmasi Password Baru', 'required');
		
        $error=	'';
		if( isset( $_POST['simpan'] ) )
		{
			if( $this->form_validation->run() == FALSE )
			{
				$data['ubah'] = 'ubah';  
				$data['error'] = 'error';    
				$data["user_name"]=$this->session->userdata("user_name");
				$data["user_password"]=$this->session->userdata("user_password");
				$data["datamodel"]=$this->session->userdata("user_id");
				$this->load->view('change_password',$data);
			}
			else
			{ 
		
				 
				$this->form_validation->set_rules('password_baru_konfirmasi', 'Konfirmasi Password Baru', 'required|same['.$_POST['password_baru'].']');
				if( $this->form_validation->run() == FALSE )
				{
					$data['ubah'] = 'ubah';  
					$data['error'] = 'error';    
					$data["user_name"]=$this->session->userdata("user_name");
					$data["user_password"]=$this->session->userdata("user_password");
					$data["datamodel"]=$this->session->userdata("user_id");
					$this->load->view('change_password',$data);
				}
				else
				{
					 $dataData = array(
						'user_password' => md5($_POST['password_baru_konfirmasi']),
						'last_update' => date("y-m-d h:i:s"),
						'last_user_id' => $this->session->userdata("user_id")
					);
					  
					$this->db->where('user_id', $_POST['datamodel']);
					$temp=$this->db->update('data_user', $dataData);  
					
					 if($temp=='1')
					 {
						$this->session->set_userdata("error","Change Password Berhasil<br/>Silahkan login dengan password baru");
						redirect('login/logout/'); 
					 }
					 else
					 {   
						$data['ubah'] = 'ubah';  
						$data['error'] = 'error';   
						$this->load->view('data/role',$data);
					  }  
				}
			}
		}  
    }


}
