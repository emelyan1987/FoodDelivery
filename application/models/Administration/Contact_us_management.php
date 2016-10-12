<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Contact_us_management extends CI_Model
{

	function __construct()
	{
		parent::__construct();	
	}


  public function get_carreers_list()
  {
  	   
  	     return $this->db->get("career")->result();

         
  }
  public function get_contact_us_list()
  {
        return $this->db->get("contact")->result();

  }
  public function get_contact_by_id($id)
  {
  	             $this->db->where("id",$id);
  	      return $this->db->get("contact")->row_array();
  }
  public function get_view_carrer_by_id($id)
  {
           $this->db->where("id",$id);
  	      return $this->db->get("career")->row_array();
  } 
  function delete_contact($id)
  {
	   $this->db->where("id",$id);
	   $this->db->delete("contact");
	   return true;
	   
  }

  function get_job_type(){

      $this->db->select("*");
     $this->db->from("restro_job_type");
     return $query = $this->db->get()->result();
  }
  function add_job_type($data){
    $this->db->insert('restro_job_type', $data);
  } 
  function delete_job_type($id){
    $this->db->where("id",$id);
    $this->db->delete("restro_job_type");
  }
}

?>