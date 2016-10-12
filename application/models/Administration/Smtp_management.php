<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Smtp_management extends CI_Model
{

	// cuisine function start here 
	function __construct()
	{
		parent::__construct();	
	}



	public function update_smtp($data,$id){
			$this->db->where('id',$id);
   			$this->db->update('restro_smtp',$data);
   			return true;
	}
	
	public function get_smtp_data($id){
		$this->db->select('*');
		$this->db->where('id',$id);
		$this->db->from('restro_smtp');
		return $query = $this->db->get()->row_array();

	}

	public function show_all_email_templates(){
		$this->db->select('*');
		$this->db->from('restro_email_templates');
		return $query = $this->db->get()->result();
	}

	
	public function get_email_templates($id){
		$this->db->select('*');
		$this->db->where('id',$id);
		$this->db->from('restro_email_templates');
		return $query = $this->db->get()->row_array();

	} 
	public function update_template($data,$id){
			$this->db->where('id',$id);
   			$this->db->update('restro_email_templates',$data);
   			return true;
	}

	public function show_all_sms(){
		$this->db->select('*');
		$this->db->from('restro_sms_table');
		$this->db->order_by('id','ASC');
		return $query = $this->db->get()->result();
	}

	
	public function edit_sms_message($data,$id){
			$this->db->where('id',$id);
   			$this->db->update('restro_sms_table',$data);
   			return true;
	}

	


}
?>