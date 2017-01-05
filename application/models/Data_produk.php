<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class data_produk extends CI_Model {
    public function __construct()
	{
		parent::__construct();
		$this->load->library('script_sql');
	}
	
	public function get_all()
	{
		 $this->db->select();
        $this->db->from('data_produk u');
		$this->db->join('kategori_produk a', 'a.kategori_produk_id=u.kategori_produk_id');
        $this->db->where('u.is_delete', '0');
		$query = $this->db->get();
		return $query->result() ;
	}
	
	public function get_by_id($produk_id)
	{
		 $this->db->select('*,u.kategori_produk_id as kategori_produk_id');
        $this->db->from('data_produk u');
		$this->db->join('kategori_produk a', 'a.kategori_produk_id=u.kategori_produk_id');
        $this->db->where('u.is_delete', '0');
        $this->db->where('u.produk_id', $produk_id);
		$query = $this->db->get();
		return $query->result() ;
	}
	
	public function get_row_by_id($produk_id)
	{
		 $this->db->select('*,u.kategori_produk_id as kategori_produk_id');
        $this->db->from('data_produk u');
		$this->db->join('kategori_produk a', 'a.kategori_produk_id=u.kategori_produk_id');
        $this->db->where('u.is_delete', '0');
        $this->db->where('u.produk_id', $produk_id);
		$query = $this->db->get();
		return $query->row() ;
	}
	
	public function show()
	{
		 $this->db->select();
        $this->db->from('data_produk u');
		$this->db->join('kategori_produk a', 'a.kategori_produk_id=u.kategori_produk_id');
        $this->db->where('u.is_delete', '0');
		$query = $this->db->get();
		return $query->result() ;
	}
	 
	public function insert($data)
	{  
		$temp=$this->db->insert('data_produk', $data); 
		$this->session->set_userdata("last_id",$this->db->insert_id()); 
		return $temp;
		
	}
	 
	public function delete_permanent($produk_id)
	{  
		$data = array('produk_id' => $produk_id);
		$this->db->delete('data_produk', $data);
		$temp=$this->session->set_userdata("last_id",$produk_id); 
	    return $temp;
		
	}
	
	public function delete_semu($produk_id)
	{
		$data_lama=$this->db->query('select * from data_produk where produk_id="'.$produk_id.'"')->num_rows();
		
	   $data = array(
			'is_delete' => '1',
		); 
        $this->db->where('produk_id', $produk_id);
       $temp= $this->db->update('data_produk', $data); 
		
		if($temp==0&&$data_lama>0) //kalau tidak ada perubahan cek data dengan id itu ada g. kalau ada dianggap ada perubahan data
		$temp=1; 
		
		$this->session->set_userdata("last_id",$produk_id);
		
	   return $temp;
	} 
	
	public function update($produk_id, $data)
	{
		$data_lama=$this->db->query('select * from data_produk where produk_id="'.$produk_id.'"')->num_rows();
		
        /* $this->script_sql->update($data,"produk","produk_id",$produk_id); */
	   
        $this->db->where('produk_id', $produk_id);
        $temp=$this->db->update('data_produk', $data); 
		$this->session->set_userdata("last_id",$produk_id);
	   
		if($temp==0&&$data_lama>0) //kalau tidak ada perubahan cek data dengan id itu ada g. kalau ada dianggap ada perubahan data
		$temp=1;
		
	   return $temp;
	} 
	
}