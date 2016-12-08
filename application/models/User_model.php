<?php

class user_model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('script_sql');
	}
	
	public function get_all()
	{
		$table="data_user"; 
		$query = $this->script_sql->get_data($table); 
		return $query ;
	}
	public function show()
	{
		$table="data_user"; 
		$query = $this->script_sql->get_data($table); 
		return $query ;
	}
	
	public function get($user_id)
	{ 
		$table="data_user"; $join=""; $where="user_id=".$user_id; $order_by=""; $order_by=""; $group_by=""; 
		$query = $this->script_sql->get_data($table,$join,$where,$order_by,$group_by); 
		
		return $query->result();
	}
	
	public function delete($user_id)
	{ 
		$this->script_sql->delete("data_user","user_id",$user_id);
	}
	
	public function update($user_id, $data)
	{
       $this->script_sql->update($data,"data_user","user_id",$user_id);
	   // return $temp;
	} 
}