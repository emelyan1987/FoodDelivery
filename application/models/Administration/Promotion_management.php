<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Promotion_management extends CI_Model
{

	// cuisine function start here 
	function __construct()
	{
		parent::__construct();	
	}

	public function  promotion_owner_serach($code)
	{
	       $this->db->select("*");
	       $this->db->from("users");
	       $this->db->where("owner_id",$code);
	       $query = $this->db->get();

		if ($query->num_rows() > 0)
		{
		   foreach ($query->result() as $row)
		   {
		      return $row->id;
		   }
		}
		else
		{
		      return 0;
		}
	}
	public function get_owner_all_location($id){
	       $this->db->select("*");
	       $this->db->from("restro_location");
	       $this->db->where("user_id",$id);
	       $this->db->where("blank_upload",0);
	       return $this->db->get()->result();
	} 
	public function get_owner_all_item($id,$location_id,$service_id){
	       $this->db->select("item_name,id");
	       $this->db->from("tbl_item");
	       $this->db->where("user_id",$id);
	       $this->db->where("location_id",$location_id);
	       $this->db->where("service_id",$service_id);
	       return $this->db->get()->result();
	}

	public function get_owner_all_item1($id){
	       $this->db->select("item_name,id");
	       $this->db->from("tbl_item");
	       $this->db->where("user_id",$id);
	       return $this->db->get()->result();
	}	
	public function get_item_variation($id){
	       $this->db->select("*");
	       $this->db->from("restro_item_variation");
	       $this->db->where("item_id",$id);
	       return $this->db->get()->result();
	}
	
	public function add_promotion($data){
		$this->db->insert('restro_promotion',$data);
		return $this->db->insert_id();
	} 
	
	public function add_promotion_detail($data){
		$this->db->insert('restro_promotion_item',$data);
		return $this->db->insert_id();
	}
	
	public function add_promotion_variation($data){
		$this->db->insert('restro_promotion_item_variation',$data);
		return $this->db->insert_id();
	}
	
	public function show_all_promotions(){
		$this->db->select("restro_promotion.*");
	    $this->db->from("restro_promotion");
	    $this->db->join("users","users.id = restro_promotion.user_id");
	    $this->db->group_by("restro_promotion.id");
	    return $this->db->get()->result();
	}

	public function show_my_all_promotions($id){
		$this->db->select("*");
	       $this->db->from("restro_promotion");
	       $this->db->where("user_id",$id);
	       return $this->db->get()->result();
	}

	public function get_promotions_details($id){
		   $this->db->select("*");
	       $this->db->from("restro_promotion");
	       $this->db->where("id",$id);
	       return $this->db->get()->row_array();
	} 
	public function get_promotions_items_details($id){
		   $this->db->select("*,restro_promotion.location_id,restro_promotion.service_id");
	       $this->db->from("restro_promotion_item");
	       $this->db->join("restro_promotion","restro_promotion.id = restro_promotion_item.promotion_id");
	       $this->db->where("promotion_id",$id);
	       return $this->db->get()->result();
	}

	


public function get_data_item_variation($promotion_id,$item_id){
		   $this->db->select("restro_item_variation.id,restro_item_variation.variation_name");
	       $this->db->from("restro_promotion_item_variation");
	       $this->db->join("restro_item_variation","restro_item_variation.item_id = restro_promotion_item_variation.item_id");
	       $this->db->where("restro_promotion_item_variation.promotion_id",$promotion_id);
	       $this->db->where("restro_promotion_item_variation.item_id",$item_id);
	       $this->db->group_by("restro_item_variation.id");
	       return $this->db->get()->result();
	}

	public function getvarAllData($promotion_id,$item_id,$variation_id){
		   $this->db->select("restro_promotion_item_variation.*,restro_item_variation_data.title");
	       $this->db->from("restro_promotion_item_variation");
	       $this->db->join("restro_item_variation_data","restro_item_variation_data.id = restro_promotion_item_variation.variation_id");
	       $this->db->join("restro_item_variation","restro_item_variation.id = restro_item_variation_data.variation_id");
	       $this->db->where("restro_promotion_item_variation.promotion_id",$promotion_id);
	       $this->db->where("restro_promotion_item_variation.item_id",$item_id);
	       $this->db->where("restro_item_variation.id",$variation_id);
	       return $this->db->get()->result();
	}
	public function getvarAllData12($promotion_id,$item_id,$variation_id){
		   $this->db->select("*");
	       $this->db->from("restro_promotion_item_variation");
	       $this->db->where("promotion_id",$promotion_id);
	       $this->db->where("item_id",$item_id);
	       $this->db->where("variation_id",$variation_id);
	       return $this->db->get()->row_array();
	}
	

	public function update_promotion($data,$id){
			$this->db->where('id',$id);
   			$this->db->update('restro_promotion',$data);
	}

	public function get_owner_id($id){
		   $this->db->select("user_id");
	       $this->db->from("restro_promotion");
	       $this->db->where("id",$id);
	       $query = $this->db->get();

			if ($query->num_rows() > 0)
			{
			   foreach ($query->result() as $row)
			   {
			      return $row->user_id;
			   }
			}
			else
			{
			      return 0;
			}
	}

	public function delete_promotion($id){
		$this->db->delete('restro_promotion', array('id' => $id));
	}
	

	public function  get_owner_code($id)
	{
	       $this->db->select("owner_id");
	       $this->db->from("users");
	       $this->db->where("id",$id);
	       $query = $this->db->get();

		if ($query->num_rows() > 0)
		{
		   foreach ($query->result() as $row)
		   {
		      return $row->owner_id;
		   }
		}
		else
		{
		      return 0;
		}
	}

	public function location_service_filter_promotion($owner_id,$location,$service){
		   $this->db->select("restro_promotion.*");
	       $this->db->from("restro_promotion");
	       $this->db->join("users","users.id = restro_promotion.user_id");
	       $this->db->where("restro_promotion.user_id",$owner_id);
	       $this->db->where("restro_promotion.location_id",$location);
	       $this->db->where("restro_promotion.service_id",$service);
	       $this->db->group_by("restro_promotion.id");
	       return $this->db->get()->result();
	}
	
	
}
?>