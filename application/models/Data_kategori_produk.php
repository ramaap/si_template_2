<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class data_kategori_produk extends CI_Model {
    public function __construct()
	{
		parent::__construct();
		$this->load->library('script_sql');
	}
	
	public function get_all()
	{
		 $this->db->select();
        $this->db->from('kategori_produk');
        $this->db->where('is_delete', '0');
		$query = $this->db->get();
		return $query->result() ;
	}
	
	public function get_by_id($kategori_produk_id)
	{
		 $this->db->select();
        $this->db->from('kategori_produk');
        $this->db->where('is_delete', '0');
        $this->db->where('kategori_produk_id', $kategori_produk_id);
		$query = $this->db->get();
		return $query->result() ;
	}
	
	public function get_row_by_id($kategori_produk_id)
	{
		 $this->db->select();
        $this->db->from('kategori_produk');
        $this->db->where('is_delete', '0');
        $this->db->where('kategori_produk_id', $kategori_produk_id);
		$query = $this->db->get();
		return $query->row() ;
	}
	
	public function show()
	{
		 $this->db->select();
        $this->db->from('kategori_produk');
        $this->db->where('is_delete', '0');
		$query = $this->db->get();
		return $query->result() ;
	}
	 
	public function insert($data)
	{  
		$temp=$this->db->insert('kategori_produk', $data); 
		$this->session->set_userdata("last_id",$this->db->insert_id()); 
		return $temp;
		
	}
	 
	public function delete_permanent($kategori_produk_id)
	{  
		$data = array('kategori_produk_id' => $kategori_produk_id);
		$this->db->delete('kategori_produk', $data);
		$temp=$this->session->set_userdata("last_id",$kategori_produk_id); 
	    return $temp;
		
	}
	
	public function delete_semu($kategori_produk_id)
	{
		$data_lama=$this->db->query('select * from kategori_produk where kategori_produk_id="'.$kategori_produk_id.'"')->num_rows();
		
	   $data = array(
			'is_delete' => '1',
		); 
        $this->db->where('kategori_produk_id', $kategori_produk_id);
       $temp= $this->db->update('kategori_produk', $data); 
		
		if($temp==0&&$data_lama>0) //kalau tidak ada perubahan cek data dengan id itu ada g. kalau ada dianggap ada perubahan data
		$temp=1; 
		
		$this->session->set_userdata("last_id",$kategori_produk_id);
		
	   return $temp;
	} 
	
	public function update($kategori_produk_id, $data)
	{
		$data_lama=$this->db->query('select * from kategori_produk where kategori_produk_id="'.$kategori_produk_id.'"')->num_rows();
		
        /* $this->script_sql->update($data,"kategori_produk","kategori_produk_id",$kategori_produk_id); */
	   
        $this->db->where('kategori_produk_id', $kategori_produk_id);
        $temp=$this->db->update('kategori_produk', $data); 
		$this->session->set_userdata("last_id",$kategori_produk_id);
	   
		if($temp==0&&$data_lama>0) //kalau tidak ada perubahan cek data dengan id itu ada g. kalau ada dianggap ada perubahan data
		$temp=1;
		
	   return $temp;
	} 
	
}