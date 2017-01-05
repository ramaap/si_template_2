<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class data_cart extends CI_Model {
    public function __construct()
	{
		parent::__construct();
		$this->load->library('script_sql');
	}
	
	public function get_all($user_id)
	{
		 $this->db->select('*,u.user_id as user_id,u.is_permanent as is_permanent');
        $this->db->from('data_cart u');
        $this->db->join('data_user_customer a', 'a.user_id=u.user_id and a.is_delete=0');
        $this->db->where('u.is_delete', '0');
        $this->db->where('u.user_id', $user_id);
		$query = $this->db->get();
		return $query->result() ;
	}
	
	public function get_by_id($cart_id)
	{
		 $this->db->select();
        $this->db->from('data_cart');
        $this->db->where('is_delete', '0');
        $this->db->where('cart_id', $cart_id);
		$query = $this->db->get();
		return $query->result() ;
	}
	
	public function get_row_by_id($cart_id)
	{
		 $this->db->select();
        $this->db->from('data_cart');
        $this->db->where('is_delete', '0');
        $this->db->where('cart_id', $cart_id);
		$query = $this->db->get();
		return $query->row() ;
	}
	
	public function show()
	{
		 $this->db->select();
        $this->db->from('data_cart');
        $this->db->where('is_delete', '0');
		$query = $this->db->get();
		return $query->result() ;
	}
	 
	public function insert($data)
	{  
		$temp=$this->db->insert('data_cart', $data); 
		$this->session->set_userdata("last_id",$this->db->insert_id()); 
		return $temp;
		
	}
	 
	public function delete_permanent($cart_id)
	{  
		$data_lama=$this->db->query('select * from data_cart where cart_id="'.$cart_id.'"')->num_rows();
		$temp = 0;
		$data = array('cart_id' => $cart_id);
		$this->db->delete('data_cart', $data);
		if($temp==0&&$data_lama>0) //kalau tidak ada perubahan cek data dengan id itu ada g. kalau ada dianggap ada perubahan data
		$temp=1; 
		
	    return $temp;
		
	}
	
	public function delete_semu($cart_id)
	{
		$data_lama=$this->db->query('select * from data_cart where cart_id="'.$cart_id.'"')->num_rows();
		
	   $data = array(
			'is_delete' => '1',
		); 
        $this->db->where('cart_id', $cart_id);
       $temp= $this->db->update('data_cart', $data); 
		
		if($temp==0&&$data_lama>0) //kalau tidak ada perubahan cek data dengan id itu ada g. kalau ada dianggap ada perubahan data
		$temp=1; 
		
		$this->session->set_userdata("last_id",$cart_id);
		
	   return $temp;
	} 
	
	public function update($cart_id, $data)
	{
		$data_lama=$this->db->query('select * from data_cart where cart_id="'.$cart_id.'"')->num_rows();
		
        /* $this->script_sql->update($data,"cart","cart_id",$cart_id); */
	   
        $this->db->where('cart_id', $cart_id);
        $temp=$this->db->update('data_cart', $data); 
		$this->session->set_userdata("last_id",$cart_id);
	   
		if($temp==0&&$data_lama>0) //kalau tidak ada perubahan cek data dengan id itu ada g. kalau ada dianggap ada perubahan data
		$temp=1;
		
	   return $temp;
	} 
	
}