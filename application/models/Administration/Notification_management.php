<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Notification_management extends CI_Model
{

	// cuisine function start here 
	function __construct()
	{
		parent::__construct();	
	}

	public function  add_notification($data)
	{
	    $this->db->insert('restro_notifications',$data);
		
		return true;
	}

	public function get_wp_notification()
	{
		    $this->db->select("*");
	        $this->db->from("restro_notifications");
	        $this->db->where("type",1);
	        return $this->db->get()->result();

	        
		    	    
	}
	public function update_web_notification($id,$data)
	{
             $this->db->where("id",$id);
             $this->db->update("restro_notifications",$data);
             return true;

	}

	public function delete_web_notification($id)
	{
             $this->db->where("id",$id);
             $this->db->delete("restro_notifications");
             return true;

             
	}



	public function get_ap_notification()
	{
		    $this->db->select("*");
	        $this->db->from("restro_notifications");
	        $this->db->where("type",2);
	        return $this->db->get()->result();

	        
		    	    
	}
	public function update_app_notification($id,$data)
	{
             $this->db->where("id",$id);
             $this->db->update("restro_notifications",$data);
             return true;

	}

	public function delete_app_notification($id)
	{
             $this->db->where("id",$id);
             $this->db->delete("restro_notifications");
             return true;
             
             
	}

}