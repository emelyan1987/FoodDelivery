<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cuisine_management extends CI_Model
{

	// cuisine function start here 
	function __construct()
	{
		parent::__construct();	
	}

	public function  all_cuisine()
	{
		 $this->db->select("*");
          $this->db->from("restro_cuisine");
          return $this->db->get()->result();
	}
	public function add_cuisine($data){
		$this->db->insert('restro_cuisine',$data);
	}
	public function delete_cuisine($id){
		$this->db->delete('restro_cuisine', array('id' => $id)); 
	}
	// cuisine function end here 

	// food type function start here 
	public function all_foodtype(){
		$this->db->select("*");
          $this->db->from("restro_food_type");
          return $this->db->get()->result();
	}
	public function add_foodtype($data){
		$this->db->insert('restro_food_type',$data);
	}
	
	public function delete_foodtype($id){
		$this->db->delete('restro_food_type', array('id' => $id)); 
	}

	// food type function end here 

	// seo category  function start here 

	public function all_seocategory(){
		 $this->db->select("*");
          $this->db->from("restro_seo_category");
          return $this->db->get()->result();
	}
	public function add_seo_category($data){
		$this->db->insert('restro_seo_category',$data);
	} 
	public function delete_seo_category($id){
		$this->db->delete('restro_seo_category', array('id' => $id)); 
	}
	

	// seo category  function end here 


	//item category function start here

	public function all_item_category(){
		$this->db->select("*");
          $this->db->from("tbl_item_category");
          return $this->db->get()->result();
	}
	
	
	public function owner_all_item_category($id){
		$this->db->select("*");
          $this->db->from("tbl_item_category");
	  $this->db->where("user_id",$id);
          return $this->db->get()->result();
	}

	public function add_item_category($data){
		$this->db->insert('tbl_item_category',$data);
		return $this->db->insert_id(); 
	}

	public function delete_item_category($id){
		$this->db->delete('tbl_item_category', array('id' => $id)); 
	}

	public function add_item_menu($data){
		$this->db->insert('tbl_restro_menu',$data);
		 
	}

	public function all_item_category_by_location($location,$owner_id,$service){
		$this->db->select("*");
        $this->db->from("tbl_item_category");
        $this->db->where("location_id",$location);
        $this->db->where("user_id",$owner_id);
        $this->db->where("service_id",$service);
        return $this->db->get()->result();
	}

	
	//item category function start here


	//item function start here

	public function get_all_item_list(){
		$id = $this->tank_auth->get_user_id();
        $this->db->select('*');
        $query = $this->db->get('tbl_item');
        return $query = $query->result();
	}

	public function item_details($id){
		$this->db->select('*');
		$this->db->where('id',$id);
        $query = $this->db->get('tbl_item');
        return $query = $query->result();
	}
	public function delete_item($id){
        $this->db->delete('tbl_item', array('id' => $id));
    }
	// item function end here



	//item variations all functions start here

	public function add_item_variations($data){
		$this->db->insert('restro_item_variation',$data);
		return $this->db->insert_id();
	}

	public function add_item_variations_data($data){
		$this->db->insert('restro_item_variation_data',$data);

	}

	public function get_item_variation_data($item_id,$variation_type){
			$this->db->select('*');
			$this->db->where('item_id',$item_id);
			$this->db->where('variation_type',$variation_type);
	        $query = $this->db->get('restro_item_variation');
	        return $query = $query->row_array();
	}

	public function get_All_Variation_Data($variation_id,$item_id){
			$this->db->select('*');
			$this->db->where('variation_id',$variation_id);
			$this->db->where('item_id',$item_id);
	        $query = $this->db->get('restro_item_variation_data');
	        return $query = $query->result();
	}

	public function update_item_variations($data,$id){
			$this->db->where('id',$id);
            $this->db->update('restro_item_variation',$data);
	}
	public function update_item_variations_data($data,$id){
			$this->db->where('id',$id);
            $this->db->update('restro_item_variation_data',$data);	
	}

	
	
	public function get_location_service_filter_item($location,$owner_id,$service){
		$this->db->select('*');
		$this->db->where('location_id',$location);
		$this->db->where('user_id',$owner_id);
		$this->db->where('service_id',$service);
	        $query = $this->db->get('tbl_item');
	        return $query = $query->result();
	}
	public function get_location_service_filter_category($location,$owner_id,$service){
		$this->db->select('*');
		$this->db->where('location_id',$location);
		$this->db->where('user_id',$owner_id);
		$this->db->where('service_id',$service);
	        $query = $this->db->get('tbl_item_category');
	        return $query = $query->result();
	}

	public function get_item_category_data($id){
		$this->db->select('*');
		$this->db->where('id',$id);
		$query = $this->db->get('tbl_item_category');
        return $query = $query->row_array();
	}

	public function edit_item_category($data,$id){
		$this->db->where('id',$id);
        $this->db->update('tbl_item_category',$data);
	}

	
	public function edit_item_menu($data,$id){
		$this->db->where('category_id',$id);
        $this->db->update('tbl_restro_menu',$data);
	}
	
	//item variations all functions end here
	
	

}