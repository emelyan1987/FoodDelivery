<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_management extends CI_Model
{

	function __construct()
	{
		parent::__construct();

		
	}

	public function  edit_profile($data,$id)
	{
			$this->db->where('user_id',  $id);
            $this->db->update('user_profiles', $data);
    }
	public function  edit_profile1($data,$id)
	{
			$this->db->where('id',  $id);
            $this->db->update('users', $data);
    }
    public function show_my_profile($id){
    	$this->db->select('users.email,user_profiles.*');
    	$this->db->from('users');
        $this->db->join('user_profiles', 'users.id = user_profiles.user_id');  
        $this->db->where('users.id',$id);
        return $query = $this->db->get()->row_array();
    }

    public function delivery_reports(){
    	$this->db->select('restro_info.restro_name,restro_order.*');
    	$this->db->from('restro_info');
        $this->db->join('restro_order_details', 'restro_order_details.restro_id = restro_info.id');
        $this->db->join('restro_order', 'restro_order.id = restro_order_details.order_id');  
        $this->db->group_by('restro_order.id');
        return $query = $this->db->get()->result();
    }
        public function catring_reports(){
    	$this->db->select('restro_info.restro_name,restro_catering_order.*');
    	$this->db->from('restro_info');
        $this->db->join('restro_catering_order_details', 'restro_catering_order_details.restro_id = restro_info.id');
        $this->db->join('restro_catering_order', 'restro_catering_order.id = restro_catering_order_details.order_id');  
        $this->db->group_by('restro_catering_order.id');
        return $query = $this->db->get()->result();
    }
        public function reservation_reports(){
    	$this->db->select('restro_info.restro_name,restro_table_order.*');
    	$this->db->from('restro_info');
        $this->db->join('restro_booked_table', 'restro_booked_table.restro_id = restro_info.id');
        $this->db->join('restro_table_order', 'restro_table_order.id = restro_booked_table.order_id');  
        $this->db->group_by('restro_table_order.id');
        return $query = $this->db->get()->result();
    }
        public function pickup_reports(){
    	$this->db->select('restro_info.restro_name,restro_pickup_order.*');
    	$this->db->from('restro_info');
        $this->db->join('restro_pickup_order_details', 'restro_pickup_order_details.restro_id = restro_info.id');
        $this->db->join('restro_pickup_order', 'restro_pickup_order.id = restro_pickup_order_details.order_id');  
        $this->db->group_by('restro_pickup_order.id');
        return $query = $this->db->get()->result();
    }

    public function add_privacy($data)
    {
          $this->db->update("restro_privacy",$data);
          return true;

    }
     public function add_about_us($data)
    {
          $this->db->update("restro_about_us",$data);
          return true;

    }
    
    
    public function add_tearms($data)
    {
          $this->db->update("restro_terms",$data);
          return true;

    }
    public function  get_privacy()
    {
          return $this->db->get("restro_privacy")->row_array();

    }
    public function  get_about_us()
    {
          return $this->db->get("restro_about_us")->row_array();

    }
    
    public function  get_tearms()
    {
          return $this->db->get("restro_terms")->row_array();

    }

    public function  get_all_restro_faq_category()
    {
         return $this->db->get("restro_faq_category")->result();
    }
    public function add_faq_category($data)
    {
         $this->db->insert("restro_faq_category",$data);
         return true;

    } 
    public function update_faq_cat($id,$data)
    {
		
		   $this->db->where('name', $data['name']);
			$query = $this->db->get('restro_faq_category');
			$count_row = $query->num_rows();
				if ($count_row > 0) {
					echo 0;					  		
				 } else {
				      $this->db->where("id",$id);
					   $this->db->update("restro_faq_category",$data);
					   echo 1;
					  
				  
				 }
		
 
    }
	public function faq_update_get_category_by_id($id)
	{
	
		 $this->db->select("*");
		 $this->db->from("restro_faq_category");
		 $this->db->where("id",$id);
         return $this->db->get()->row_array();
	   
	}
	function update_faq($id,$faqInfo)
	{
		   $this->db->where("fid",$id);
           $this->db->update("restro_faq",$faqInfo);
           return true;
		
	}
    public function delete_faq_cat($id)
    {
          $this->db->where("id",$id);
          $this->db->delete("restro_faq_category");
          return true;
          
    }
    public function add_faq($faqInfo)
    {
          $this->db->insert("restro_faq",$faqInfo);
          return true;

    }
	function delete_faq($id)
	{
		$this->db->where("fid",$id);
		$this->db->delete("restro_faq");
		return true;
	}
    public function get_faq()
    {
      
      return $this->db->get("restro_faq")->result();



    }
    public function getFaqCat($id)
    {
        $this->db->select("name");
        $this->db->from("restro_faq_category");
        $this->db->where("id",$id);
        return $this->db->get()->row_array();

    }
}
?>