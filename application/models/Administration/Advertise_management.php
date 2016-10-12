<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
@ob_start();
class Advertise_management extends CI_Model
{

	// cuisine function start here 
	function __construct()
	{
		parent::__construct();	
	}

	public function all_Advertise_type()
	{
		$this->db->select('*');
		$this->db->from('restro_advertise_type');
		$this->db->order_by('order','ASC');
		return $query = $this->db->get()->result();
		
	}
	public function  add_advertise($data)
	{
		$this->db->insert('restro_advertise_data',$data);
		
		
	}
	public function  getAdvertData($type_id,$system_id)
	{
		$this->db->select('*');
		$this->db->where('type_id',$type_id);
		$this->db->where('system_status',$system_id);
		$this->db->from('restro_advertise_data'); 
		$this->db->order_by('id','DESC');
		return $query = $this->db->get()->result();
		
	}
	public function clear_adevrtise_by_type($type_id,$system_id){
		$this->db->delete('restro_advertise_data', array('id' => $type_id,'system_status' => $system_id)); 
	}

	public function delete_advertise_image($id,$system_id){
		$this->db->delete('restro_advertise_data', array('id' => $id,'system_status' => $system_id)); 
	}
	
	public function  GetAdevrtise_limit($start,$limit)
	{
		$this->db->select('*');
		$this->db->where('type_id',12);
		$this->db->where('system_status',1);
		$this->db->limit($limit,$start);
		$this->db->from('restro_advertise_data'); 
		$this->db->order_by('id','ASC');
		return $query = $this->db->get()->result();
		
	}
	
	public function  GetAdevrtise_limit2($start,$limit)
	{
		$this->db->select('*');
		$this->db->where('type_id',13);
		$this->db->where('system_status',1);
		$this->db->limit($limit,$start);
		$this->db->from('restro_advertise_data'); 
		$this->db->order_by('id','ASC');
		return $query = $this->db->get()->result();
		
	}
	
	public function  GetAdevrtise_limit3($start,$limit)
	{
		$this->db->select('*');
		$this->db->where('type_id',14);
		$this->db->where('system_status',1);
		$this->db->limit($limit,$start);
		$this->db->from('restro_advertise_data'); 
		$this->db->order_by('id','ASC');
		return $query = $this->db->get()->result();
		//$query = $this->db->get();
		//echo $this->db->last_query();
	}
	
	
	
	

}