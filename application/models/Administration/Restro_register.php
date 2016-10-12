<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Restro_register extends CI_Model
{

	function __construct()
	{
		parent::__construct();	
	}

	public function restro_registration_list()
	{
		$this->db->select("*");
		$this->db->from("restro_registration");
       
        	return $this->db->get()->result();
	}
      public function delete_restro_register($id)
      {
         $this->db->delete('restro_registration', array('id' => $id));
         
         return true;

      }
      
      public function edit_restro_registration($id)
	    	{

		$this->db->select('*');
		$this->db->from('restro_registration');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->row_array();
				
	    	}
	    	
	    	 public function update_restro_registration($restoREG,$cuid)
		{
		
		$this->db->where('id',$cuid);
    
		$this->db->update('restro_registration',$restoREG);
		}
		
		
	public function delete_restro_registration($id,$userId)
		{

		 $this->db->delete('restro_registration',$userId);
		}
      


}

?>	