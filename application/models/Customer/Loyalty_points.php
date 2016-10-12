<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Loyalty_points extends CI_Model
{


	function __construct()
	{
		parent::__construct();

		$this->load->library('tank_auth');
		$this->lang->load('tank_auth');

	}
	
	
	public function finduserBYid($user_id){
		$this->db->select('user_id');
		$this->db->from('restro_settings'); 
		$this->db->where('user_id',$user_id);
        $query = $this->db->get();
	        if ($query->num_rows() > 0)
	        {  return 1; }
	          else 
	           { return 0; }

	}
	

	public function getloyalty_point($user_id){
		$this->db->select('*');
		$this->db->from('restro_settings'); 
		$this->db->where('user_id',$user_id);
        $query = $this->db->get();
        return $query = $query->row_array();

	}
	
	public function add_loyalty($pvalue){
		$this->db->insert('restro_settings',$pvalue);
	}
	
	public function edit_loyalty($pvalue,$user_id){
			$this->db->where('user_id',$user_id);
   			$this->db->update('restro_settings',$pvalue);
	}




	
	



	
}