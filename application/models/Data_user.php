<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class data_user extends CI_Model {

    public function get_by_username_password($username, $password) {
        $this->db->select();
        $this->db->from('data_user u');
        // $this->db->join('data_lokasi a', 'a.lokasi_id=u.lokasi_id');
        $this->db->join('data_role b', 'b.role_id=u.role_id');
        $this->db->where('u.user_name', $username);
        $this->db->where('u.user_password', $password);
        $query = $this->db->get();
        return $query->row();
    }

    public function update_last_login($user_id) {
        $data = array(
            'last_login' => date('Y/m/d h:i:s'),
            'last_update' => date('Y/m/d h:i:s'),
            'last_user_id' => $user_id
        );
        $this->db->where('user_id', $user_id);
        $this->db->update('data_user', $data);
    }

    public function update_last_logout($user_id) {
        $data = array(
            'last_logout' => date('Y/m/d h:i:s'),
            'last_update' => date('Y/m/d h:i:s'),
            'last_user_id' => $user_id
        );
        $this->db->where('user_id', $user_id);
        $this->db->update('data_user', $data);
    }

	public function get_all()
	{
		$this->db->select("*,u.is_permanent as is_permanent");
        $this->db->from('data_user u');
		$this->db->join('data_role a', 'u.role_id = a.role_id');
        $this->db->where('u.is_delete', '0');
		$query = $this->db->get();
		return $query->result() ;
	} 
	
	public function get_by_id($user_id)
	{
		$this->db->select();
        $this->db->from('data_user u');
		$this->db->join('data_role a', 'u.role_id = a.role_id');
        $this->db->where('u.is_delete', '0');
        $this->db->where('u.user_id', $user_id);
		$query = $this->db->get();
		return $query->result() ;
	}
	
	public function get_row_by_id($user_id)
	{
		$this->db->select();
        $this->db->from('data_user u');
		$this->db->join('data_role a', 'u.role_id = a.role_id');
        $this->db->where('u.is_delete', '0');
        $this->db->where('u.user_id', $user_id);
		$query = $this->db->get();
		return $query->row() ;
	}
	
	public function show()
	{
		 $this->db->select();
        $this->db->from('data_user u');
		$this->db->join('data_role a','u.role_id = a.role_id');
        $this->db->where('u.is_delete', '0');
		$query = $this->db->get();
		return $query->result() ;
	}
	 
	public function insert($data)
	{  
		$temp=$this->db->insert('data_user', $data); 
		$this->session->set_userdata("last_id",$this->db->insert_id()); 
		return $temp;
		
	}
	 
	public function delete_permanent($user_id)
	{  
		$data = array('user_id' => $user_id);
		$this->db->delete('data_user', $data);
		$temp=$this->session->set_userdata("last_id",$user_id); 
	    return $temp;
		
	}
	
	public function delete_semu($user_id)
	{
		$data_lama=$this->db->query('select * from data_user where user_id="'.$user_id.'"')->num_rows();
		
	   $data = array(
			'is_delete' => '1',
		); 
        $this->db->where('user_id', $user_id);
       $temp= $this->db->update('data_user', $data); 
		
		if($temp==0&&$data_lama>0) //kalau tidak ada perubahan cek data dengan id itu ada g. kalau ada dianggap ada perubahan data
		$temp=1; 
		
		$this->session->set_userdata("last_id",$user_id);
		return $temp;
	} 
	
	public function update($user_id, $data)
	{
		$data_lama=$this->db->query('select * from data_user where user_id="'.$user_id.'"')->num_rows();
	   
        $this->db->where('user_id', $user_id);
        $temp=$this->db->update('data_user', $data); 
		$this->session->set_userdata("last_id",$user_id);
	   
		if($temp==0&&$data_lama>0) //kalau tidak ada perubahan cek data dengan id itu ada g. kalau ada dianggap ada perubahan data
		$temp=1;
		
	   return $temp;
	}
	
}
