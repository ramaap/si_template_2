<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class lib {

    var $CI;

	 function check_login() {
        $CI = & get_instance();
        if ($CI->session->userdata('user_id') == "") {
			$user = $CI->data_user->get_by_username_password($_POST['username'], md5($_POST['password']));
            if ($user != null) {
                $this->set_session($user);
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return TRUE;
        }
    }
	
	 function check_login_customer() {
        $CI = & get_instance();
        if ($CI->session->userdata('user_customer_id') == "") {
			$user = $CI->data_user_customer->get_by_username_password($_POST['username'], md5($_POST['password']));
            if ($user != null) {
                $this->set_session_customer($user);
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return TRUE;
        }
    }

    function set_session($user) {
        $CI = & get_instance();
        $CI->session->set_userdata('user_id', $user->user_id);
        $CI->session->set_userdata('role_id', $user->role_id);
        $CI->session->set_userdata('role_nama', $user->role_nama);
        $CI->session->set_userdata('user_name', $user->user_name);
        $CI->load->model('data_user');
        
        $CI->data_user->update_last_login($user->user_id);
    }
	
    function set_session_customer($user) {
        $CI = & get_instance();
        $CI->session->set_userdata('user_customer_id', $user->user_id);
        $CI->session->set_userdata('role_id', $user->role_id);
        $CI->session->set_userdata('role_nama', $user->role_nama);
        $CI->session->set_userdata('user_name', $user->customer_nama);
        $CI->load->model('data_user_customer');
        
        $CI->data_user_customer->update_last_login($user->user_id);
    }
	
    function check_lokasi($akses,$menu="") {
		if($menu=="")
			$menu=$akses;
        $CI = & get_instance();
        $CI->load->model('data_profile');
		$profil = $CI->data_profile->get_all();
		if(count($profil))
		{
			$CI->session->set_userdata("title", $profil->profile_title);
			$CI->session->set_userdata("logo_website", $profil->profile_logo);
		}
		
        $CI->session->set_userdata("subtitle", $menu); 
    }

    function check_session() {
        $CI = & get_instance();
        $CI->load->model('setting_akses_menu');
		
        if($CI->session->userdata('user_id') == '') {
            redirect('login');
        }
		// $akses = $CI->setting_akses_menu->get_by_user_id();
		$akses = $CI->setting_akses_menu->get_by_role_id();
		if($akses!=null)
		{
			if($CI->session->userdata('akses_id')!=''){
				$temp=$CI->session->userdata('akses_id');
				$CI->session->set_userdata('akses_id','');
				if($akses->$temp=='0'){
					redirect('dashboard');
				}
			}
		}	
    }
	function check_session_customer() {
        $CI = & get_instance();
        if($CI->session->userdata('user_customer_id') == '') {
            redirect('front/login_customer');
        }
    }

	function check_pass($akses_password_menu='',$akses_password_fungsi='',$input_pass='') {
        $CI = & get_instance();
        $CI->load->model('setting_akses_password');
		$temp="";
        if($CI->session->userdata('user_id') == '') {
            redirect('login');
        }
		
        $akses_pass = $CI->db->query('SELECT * FROM data_user u
		join data_role a on a.role_id=u.role_id
		WHERE role_nama ="Manager" and u.is_delete=0')->result();
		// $akses_pass = $CI->setting_akses_password->get_pass_by_id($akses_password_menu,$akses_password_fungsi);
		$pass="";
		if($akses_pass!=null)
		{	
			foreach($akses_pass as $ap){ 
				// $pass=$ap->user_password."==".$input_pass;
				if($ap->user_password==$input_pass)
					return true;
			}
		}
		return false;		 		
		// return $pass;		 		
    }

    function logout() {
        $CI = & get_instance();
        $CI->load->model('data_user');
        $CI->data_user->update_last_logout($CI->session->userdata('user_id'));
        $CI->session->sess_destroy();
    }
    function logout_customer() {
        $CI = & get_instance();
        $CI->load->model('data_user_customer');
        $CI->data_user_customer->update_last_logout($CI->session->userdata('user_customer_id'));
        $CI->session->sess_destroy();
    }
	
	 function log($log_action="") {
		  $CI = & get_instance();
		  if($CI->session->userdata("user_id")!="")
		  { 
			$CI->load->model('data_log');
			$CI->data_log->insert($log_action, "User ".$CI->session->userdata("user_name")." ".$log_action." data menu ".$CI->session->userdata("subtitle"));
			
		  }
		  else
		  {
			redirect('login_cont/logout');
		  }
	  }
	
	 function cek_permanent($tabel="",$primary="",$id="")
	 {
        $CI = & get_instance();
		$var='SELECT * FROM '.$tabel.' where '.$primary.'='.$id.' and is_permanent=1';
		
        $user=$CI->db->query($var);
        return $user;    
    }
	
	
	 function _float($num) {
		 
		$num=($num);
		if(is_numeric($num))
		{
			$length=0;
			$num=$num*1; 
			$arr=explode(".",$num);
			if(count($arr)>1)
			$length=strlen($arr[1]);
			if($length>2)
			$length=2;	
			$num=number_format($num, $length, ',', '.');
			return $num;
		}
		else
			return 0;
		// return $num;
	 }  
	 
}

?>