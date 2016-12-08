<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class setting_printer extends CI_Model {
    public function __construct()
	{
		parent::__construct(); 
	}
	
	public function get_all()
	{
		 $this->db->select();
        $this->db->from('setting_printer');
        $this->db->where('is_delete', '0');
		$query = $this->db->get();
		return $query->result() ;
	}
	
	public function get_by_id($setting_printer_id)
	{
		 $this->db->select();
        $this->db->from('setting_printer'); 
        $this->db->where('setting_printer_id', $setting_printer_id);
		$query = $this->db->get();
		return $query->result() ;
	}
	
	public function get_row_by_id($setting_printer_id)
	{
		 $this->db->select();
        $this->db->from('setting_printer');
        $this->db->where('is_delete', '0');
        $this->db->where('setting_printer_id', $setting_printer_id);
		$query = $this->db->get();
		return $query->row() ;
	}
	
	public function show()
	{
		 $this->db->select();
        $this->db->from('setting_printer');
        $this->db->where('is_delete', '0');
		$query = $this->db->get();
		return $query->result() ;
	}
	 
	public function insert($data)
	{  
		$temp=$this->db->insert('setting_printer', $data); 
		$this->session->set_userdata("last_id",$this->db->insert_id()); 
		return $temp;
		
	}
	 
	public function delete_permanent($setting_printer_id)
	{  
		$data = array('setting_printer_id' => $setting_printer_id);
		$this->db->delete('setting_printer', $data);
		$temp=$this->session->set_userdata("last_id",$setting_printer_id); 
	    return $temp;
		
	}
	
	public function delete_semu($setting_printer_id)
	{
		$data_lama=$this->db->query('select * from setting_printer where setting_printer_id="'.$setting_printer_id.'"')->num_rows();
		
	   $data = array(
			'is_delete' => '1',
		); 
        $this->db->where('setting_printer_id', $setting_printer_id);
       $temp= $this->db->update('setting_printer', $data); 
		
		if($temp==0&&$data_lama>0) //kalau tidak ada perubahan cek data dengan id itu ada g. kalau ada dianggap ada perubahan data
		$temp=1; 
		
		$this->session->set_userdata("last_id",$setting_printer_id);
		
	   return $temp;
	} 
	
	public function update($setting_printer_id, $data)
	{
		$data_lama=$this->db->query('select * from setting_printer where setting_printer_id="'.$setting_printer_id.'"')->num_rows();
		
        /* $this->script_sql->update($data,"setting_printer","setting_printer_id",$setting_printer_id); */
	   
        $this->db->where('setting_printer_id', $setting_printer_id);
        $temp=$this->db->update('setting_printer', $data); 
		$this->session->set_userdata("last_id",$setting_printer_id);
	   
		if($temp==0&&$data_lama>0) //kalau tidak ada perubahan cek data dengan id itu ada g. kalau ada dianggap ada perubahan data
		$temp=1;
		
	   return $temp;
	} 
	
}