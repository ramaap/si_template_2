<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class data_customer extends CI_Model {
    public function __construct()
	{
		parent::__construct();
		$this->load->library('script_sql');
	}
	
	public function get_all()
	{
		 $this->db->select('*,u.user_id as user_id,u.is_permanent as is_permanent');
        $this->db->from('customer u');
        $this->db->join('data_user_customer a', 'a.user_id=u.user_id and a.is_delete=0');
        $this->db->where('u.is_delete', '0');
		$query = $this->db->get();
		return $query->result() ;
	}
	
	public function get_by_id($customer_id)
	{
		 $this->db->select();
        $this->db->from('customer');
        $this->db->where('is_delete', '0');
        $this->db->where('customer_id', $customer_id);
		$query = $this->db->get();
		return $query->result() ;
	}
	
	public function get_row_by_id($customer_id)
	{
		 $this->db->select();
        $this->db->from('customer');
        $this->db->where('is_delete', '0');
        $this->db->where('customer_id', $customer_id);
		$query = $this->db->get();
		return $query->row() ;
	}
	
	public function show()
	{
		 $this->db->select();
        $this->db->from('customer');
        $this->db->where('is_delete', '0');
		$query = $this->db->get();
		return $query->result() ;
	}
	 
	public function insert($data)
	{  
		$temp=$this->db->insert('customer', $data); 
		$this->session->set_userdata("last_id",$this->db->insert_id()); 
		return $temp;
		
	}
	 
	public function delete_permanent($customer_id)
	{  
		$data = array('customer_id' => $customer_id);
		$this->db->delete('customer', $data);
		$temp=$this->session->set_userdata("last_id",$customer_id); 
	    return $temp;
		
	}
	
	public function delete_semu($customer_id)
	{
		$data_lama=$this->db->query('select * from customer where customer_id="'.$customer_id.'"')->num_rows();
		
	   $data = array(
			'is_delete' => '1',
		); 
        $this->db->where('customer_id', $customer_id);
       $temp= $this->db->update('customer', $data); 
		
		if($temp==0&&$data_lama>0) //kalau tidak ada perubahan cek data dengan id itu ada g. kalau ada dianggap ada perubahan data
		$temp=1; 
		
		$this->session->set_userdata("last_id",$customer_id);
		
	   return $temp;
	} 
	
	public function update($customer_id, $data)
	{
		$data_lama=$this->db->query('select * from customer where customer_id="'.$customer_id.'"')->num_rows();
		
        /* $this->script_sql->update($data,"customer","customer_id",$customer_id); */
	   
        $this->db->where('customer_id', $customer_id);
        $temp=$this->db->update('customer', $data); 
		$this->session->set_userdata("last_id",$customer_id);
	   
		if($temp==0&&$data_lama>0) //kalau tidak ada perubahan cek data dengan id itu ada g. kalau ada dianggap ada perubahan data
		$temp=1;
		
	   return $temp;
	} 
	
}