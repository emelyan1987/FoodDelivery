<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Area_management extends CI_Model
{

	function __construct()
	{
		parent::__construct();	
	}

	public function add_area($area,$areaInfo)
	{
         $this->db->select("name");
         $this->db->from("area");
         $this->db->where("name",$area);
         if($this->db->get()->result())
         {
         	return 0;

         }
         else
         {
         	$this->db->insert("area",$areaInfo);
         	return 1;

         }

         

             
	}

	public function add_city($city,$cityInfo)
	{
         $this->db->select("city_name");
         $this->db->from("city");
         $this->db->where("city_name",$city);
         if($this->db->get()->result())
         {
         	return 0;

         }
         else
         {
         	$this->db->insert("city",$cityInfo);
         	return 1;

         }
             
	}
	public function get_area_list()
	{

		    $this->db->select("area.*,city.city_name");
		    $this->db->from("area");
        $this->db->join("city","city.id = area.city_id");
		    $this->db->order_by("area.name");
		    return $this->db->get()->result();


	}

	public function get_city_list()
	{
             $this->db->select("*");
		    $this->db->from("city");
		    $this->db->order_by("city_name");
		    return $this->db->get()->result();
	}

   
   public function get_area_list_by_city($id)
   {
          $this->db->select("*");
          $this->db->where("city_id",$id);
          $this->db->from("area");
          return $this->db->get()->result();
   }

   public function  update_city($id,$data)
   {
        $this->db->where("id",$id);
        $this->db->update("city",$data);
        return true;
        
   }
   
   public function update_area($id,$data)
   {
        $this->db->where("id",$id);
        $this->db->update("area",$data);
        return true;
        
   }
   public function  delete_city($id)
   {
        $this->db->where("id",$id);
        $this->db->delete("city");
        return true;
        
   }
   public function  delete_area($id)
   {
        $this->db->where("id",$id);
        $this->db->delete("area");
        return true;
        
   }

   

   

}

?>