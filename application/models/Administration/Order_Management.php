<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Order_Management extends CI_Model
{

	function __construct()
	{
		parent::__construct();

		
	}

                                                

    public function delivery_orders(){
    	$this->db->select('restro_info.restro_name,restro_order.*');
    	$this->db->from('restro_info');
        $this->db->join('restro_order_details', 'restro_order_details.restro_id = restro_info.id');
        $this->db->join('restro_order', 'restro_order.id = restro_order_details.order_id');
        $this->db->where('restro_order.status !=',1); 
        $this->db->where('restro_order.status !=',0);  
        $this->db->group_by('restro_order.id');
        return $query = $this->db->get()->result();
    }
    public function delivery_orders_filter($id){
        $this->db->select('restro_info.restro_name,restro_order.*');
        $this->db->from('restro_info');
        $this->db->join('restro_order_details', 'restro_order_details.restro_id = restro_info.id');
        $this->db->join('restro_order', 'restro_order.id = restro_order_details.order_id');
        $this->db->where('restro_order_details.restro_id',$id);  
        $this->db->where('restro_order.status !=',1); 
        $this->db->where('restro_order.status !=',0); 
        $this->db->group_by('restro_order.id');
        return $query = $this->db->get()->result();
    }
    
    public function pending_delivery_orders(){
        $this->db->select('restro_info.restro_name,restro_order.*');
        $this->db->from('restro_info');
        $this->db->join('restro_order_details', 'restro_order_details.restro_id = restro_info.id');
        $this->db->join('restro_order', 'restro_order.id = restro_order_details.order_id');  
        $this->db->where('restro_order.status',1);
        $this->db->group_by('restro_order.id');
        return $query = $this->db->get()->result();
    }
    public function pending_delivery_orders_filter($id){
        $this->db->select('restro_info.restro_name,restro_order.*');
        $this->db->from('restro_info');
        $this->db->join('restro_order_details', 'restro_order_details.restro_id = restro_info.id');
        $this->db->join('restro_order', 'restro_order.id = restro_order_details.order_id');
        $this->db->where('restro_order_details.restro_id',$id);
        $this->db->where('restro_order.status',1);  
        $this->db->group_by('restro_order.id');
        return $query = $this->db->get()->result();
    }

    public function delivery_orders_search($restro_id,$location_id){
        $this->db->select('restro_info.restro_name,restro_order.*');
        $this->db->from('restro_info');
        $this->db->join('restro_order_details', 'restro_order_details.restro_id = restro_info.id');
        $this->db->join('restro_order', 'restro_order.id = restro_order_details.order_id');
        $this->db->where('restro_order_details.restro_id',$restro_id);  
        $this->db->where('restro_order.restro_location_id',$location_id);
        $this->db->where('restro_order.status !=',1); 
        $this->db->where('restro_order.status !=',0);   
        $this->db->group_by('restro_order.id');
        return $query = $this->db->get()->result();
    }

    public function catring_orders(){
    	$this->db->select('restro_info.restro_name,restro_catering_order.*');
    	$this->db->from('restro_info');
        $this->db->join('restro_catering_order_details', 'restro_catering_order_details.restro_id = restro_info.id');
        $this->db->join('restro_catering_order', 'restro_catering_order.id = restro_catering_order_details.order_id');
        $this->db->where('restro_catering_order.status !=',1); 
        $this->db->where('restro_catering_order.status !=',0);   
        $this->db->group_by('restro_catering_order.id');
        return $query = $this->db->get()->result();
    }
    
    public function catring_orders_filter($id){
        $this->db->select('restro_info.restro_name,restro_catering_order.*');
        $this->db->from('restro_info');
        $this->db->join('restro_catering_order_details', 'restro_catering_order_details.restro_id = restro_info.id');
        $this->db->join('restro_catering_order', 'restro_catering_order.id = restro_catering_order_details.order_id');
        $this->db->where('restro_catering_order_details.restro_id',$id);
        $this->db->where('restro_catering_order.status !=',1); 
        $this->db->where('restro_catering_order.status !=',0);   
        $this->db->group_by('restro_catering_order.id');
        return $query = $this->db->get()->result();
    }
    
    public function pending_catring_orders(){
        $this->db->select('restro_info.restro_name,restro_catering_order.*');
        $this->db->from('restro_info');
        $this->db->join('restro_catering_order_details', 'restro_catering_order_details.restro_id = restro_info.id');
        $this->db->join('restro_catering_order', 'restro_catering_order.id = restro_catering_order_details.order_id');
        $this->db->where('restro_catering_order.status',1); 
        $this->db->group_by('restro_catering_order.id');
        return $query = $this->db->get()->result();
    }
    
    public function pending_catring_orders_filter($id){
        $this->db->select('restro_info.restro_name,restro_catering_order.*');
        $this->db->from('restro_info');
        $this->db->join('restro_catering_order_details', 'restro_catering_order_details.restro_id = restro_info.id');
        $this->db->join('restro_catering_order', 'restro_catering_order.id = restro_catering_order_details.order_id');
        $this->db->where('restro_catering_order_details.restro_id',$id);
        $this->db->where('restro_catering_order.status',1);   
        $this->db->group_by('restro_catering_order.id');
        return $query = $this->db->get()->result();
    }

    public function catring_orders_search($restro_id,$location_id){
        $this->db->select('restro_info.restro_name,restro_catering_order.*');
        $this->db->from('restro_info');
        $this->db->join('restro_catering_order_details', 'restro_catering_order_details.restro_id = restro_info.id');
        $this->db->join('restro_catering_order', 'restro_catering_order.id = restro_catering_order_details.order_id');
        $this->db->where('restro_catering_order_details.restro_id',$restro_id);  
        $this->db->where('restro_catering_order.restro_location_id',$location_id);   
        $this->db->group_by('restro_catering_order.id');
        return $query = $this->db->get()->result();
    }
    public function reservation_orders(){
    	$this->db->select('restro_info.restro_name,restro_table_order.*');
    	$this->db->from('restro_info');
        $this->db->join('restro_booked_table', 'restro_booked_table.restro_id = restro_info.id');
        $this->db->join('restro_table_order', 'restro_table_order.id = restro_booked_table.order_id');
        $this->db->where('restro_table_order.status !=',1); 
        $this->db->where('restro_table_order.status !=',0);   
        $this->db->group_by('restro_table_order.id');
        return $query = $this->db->get()->result();
    }
    
    public function reservation_orders_filter($id){
        $this->db->select('restro_info.restro_name,restro_table_order.*');
        $this->db->from('restro_info');
        $this->db->join('restro_booked_table', 'restro_booked_table.restro_id = restro_info.id');
        $this->db->join('restro_table_order', 'restro_table_order.id = restro_booked_table.order_id');
        $this->db->where('restro_table_order.status !=',1); 
        $this->db->where('restro_table_order.status !=',0);  
        $this->db->where('restro_booked_table.restro_id',$id); 
        $this->db->group_by('restro_table_order.id');
        return $query = $this->db->get()->result();
    }


    public function pending_reservation_orders(){
        $this->db->select('restro_info.restro_name,restro_table_order.*');
        $this->db->from('restro_info');
        $this->db->join('restro_booked_table', 'restro_booked_table.restro_id = restro_info.id');
        $this->db->join('restro_table_order', 'restro_table_order.id = restro_booked_table.order_id');
        $this->db->where('restro_table_order.status',1); 
        $this->db->group_by('restro_table_order.id');
        return $query = $this->db->get()->result();
    }
    
    public function pending_reservation_orders_filter($id){
        $this->db->select('restro_info.restro_name,restro_table_order.*');
        $this->db->from('restro_info');
        $this->db->join('restro_booked_table', 'restro_booked_table.restro_id = restro_info.id');
        $this->db->join('restro_table_order', 'restro_table_order.id = restro_booked_table.order_id'); 
        $this->db->where('restro_booked_table.restro_id',$id);
        $this->db->where('restro_table_order.status',1); 
        $this->db->group_by('restro_table_order.id');
        return $query = $this->db->get()->result();
    }

    public function reservation_orders_search($restro_id,$location_id){
        $this->db->select('restro_info.restro_name,restro_table_order.*');
        $this->db->from('restro_info');
        $this->db->join('restro_booked_table', 'restro_booked_table.restro_id = restro_info.id');
        $this->db->join('restro_table_order', 'restro_table_order.id = restro_booked_table.order_id'); 
        $this->db->where('restro_booked_table.restro_id',$restro_id); 
        $this->db->where('restro_table_order.restro_location_id',$location_id); 
        $this->db->group_by('restro_table_order.id');
        return $query = $this->db->get()->result();
    }

    public function pickup_orders(){
    	$this->db->select('restro_info.restro_name,restro_pickup_order.*');
    	$this->db->from('restro_info');
        $this->db->join('restro_pickup_order_details', 'restro_pickup_order_details.restro_id = restro_info.id');
        $this->db->join('restro_pickup_order', 'restro_pickup_order.id = restro_pickup_order_details.order_id');
        $this->db->where('restro_pickup_order.status !=',1); 
        $this->db->where('restro_pickup_order.status !=',0);   
        $this->db->group_by('restro_pickup_order.id');
        return $query = $this->db->get()->result();
    }

    public function pickup_orders_filter($id){
        $this->db->select('restro_info.restro_name,restro_pickup_order.*');
        $this->db->from('restro_info');
        $this->db->join('restro_pickup_order_details', 'restro_pickup_order_details.restro_id = restro_info.id');
        $this->db->join('restro_pickup_order', 'restro_pickup_order.id = restro_pickup_order_details.order_id'); 
        $this->db->where('restro_pickup_order_details.restro_id',$id);
        $this->db->where('restro_pickup_order.status !=',1); 
        $this->db->where('restro_pickup_order.status !=',0);  
        $this->db->group_by('restro_pickup_order.id');
        return $query = $this->db->get()->result();
    }


    public function pending_pickup_orders(){
        $this->db->select('restro_info.restro_name,restro_pickup_order.*');
        $this->db->from('restro_info');
        $this->db->join('restro_pickup_order_details', 'restro_pickup_order_details.restro_id = restro_info.id');
        $this->db->join('restro_pickup_order', 'restro_pickup_order.id = restro_pickup_order_details.order_id');
        $this->db->where('restro_pickup_order.status',1); 
        $this->db->group_by('restro_pickup_order.id');
        return $query = $this->db->get()->result();
    }

    public function pending_pickup_orders_filter($id){
        $this->db->select('restro_info.restro_name,restro_pickup_order.*');
        $this->db->from('restro_info');
        $this->db->join('restro_pickup_order_details', 'restro_pickup_order_details.restro_id = restro_info.id');
        $this->db->join('restro_pickup_order', 'restro_pickup_order.id = restro_pickup_order_details.order_id'); 
        $this->db->where('restro_pickup_order_details.restro_id',$id);
        $this->db->where('restro_pickup_order.status',1); 
        $this->db->group_by('restro_pickup_order.id');
        return $query = $this->db->get()->result();
    }

    public function pickup_orders_search($restro_id,$location_id){
        $this->db->select('restro_info.restro_name,restro_pickup_order.*');
        $this->db->from('restro_info');
        $this->db->join('restro_pickup_order_details', 'restro_pickup_order_details.restro_id = restro_info.id');
        $this->db->join('restro_pickup_order', 'restro_pickup_order.id = restro_pickup_order_details.order_id'); 
        $this->db->where('restro_pickup_order_details.restro_id',$restro_id); 
        $this->db->where('restro_pickup_order.restro_location_id',$location_id);  
        $this->db->group_by('restro_pickup_order.id');
        return $query = $this->db->get()->result();
    }


    public function view_delivery_order($orderid){
        $this->db->select('a.restro_name,d.*,b.email,g.email as Cust_email,f.f_name,f.l_name, concat(i.city_name," ", h.name) as address_area,e.address_name as address_building,e.block as address_block,e.floor as address_floor,e.street as address_street,e.appartment as address_apartment,e.extra_directions as address_direction');
        $this->db->from('restro_info a');
        $this->db->join('users b', 'b.id = a.user_id');
        $this->db->join('restro_order_details c', 'c.restro_id = a.id'); 
        $this->db->join('restro_order d', 'd.id = c.order_id');
        $this->db->join('user_addresses e', 'e.user_id = d.user_id and e.id = d.address_id'); 
        $this->db->join('user_profiles f', 'f.user_id = d.user_id'); 
        $this->db->join('users g', 'g.id = d.user_id'); 
        $this->db->join('area h', 'h.id = e.area_id'); 
        $this->db->join('city i', 'i.id = e.city_id'); 
        $this->db->where('d.status !=',0);
        $this->db->where('d.id',$orderid);
        $this->db->group_by("d.id");
        return $this->db->get()->result();
        //$this->db->get();
        //echo $this->db->last_query();
    } 

    public function delivery_order_details($orderid){
        $this->db->select('a.*,b.image,b.item_name');
        $this->db->from('restro_order_details a');
        $this->db->join('tbl_item b', 'b.id = a.product_id');
        $this->db->where('a.order_id',$orderid);
        return $this->db->get()->result();
    }

    public function order_status_change($status,$orderid){
            $this->db->where('id',  $orderid);
            $this->db->update('restro_order', $status);
    }

   public function view_catering_order($orderid){
        $this->db->select('a.restro_name,d.*,b.email,g.email as Cust_email,f.f_name,f.l_name,e.billing_full_name,e.billing_addres_1,e.billing_address_2,e.billing_city,e.billing_state,e.billing_zip_code,e.billing_phoneno,e.shipping_full_name,e.shipping_address_1,e.shipping_address_2,e.shipping_city,e.shipping_state,e.shipping_zip_code,e.shipping_phoneno');
        $this->db->from('restro_info a');
        $this->db->join('users b', 'b.id = a.user_id','left');
        $this->db->join('restro_catering_order_details c', 'c.restro_id = a.id','left'); 
        $this->db->join('restro_catering_order d', 'd.id = c.order_id','left');
        $this->db->join('restro_customer_address e', 'e.user_id = d.user_id and e.id = d.address_id','left'); 
        $this->db->join('user_profiles f', 'f.user_id = d.user_id','left'); 
        $this->db->join('users g', 'g.id = d.user_id','left'); 
        $this->db->where('d.status !=',0);
        $this->db->where('d.id',$orderid);
        $this->db->group_by("d.id");
        return $this->db->get()->result();
    }  

    public function catering_order_details($orderid){
        $this->db->select('a.*,b.image,b.item_name');
        $this->db->from('restro_catering_order_details a');
        $this->db->join('tbl_item b', 'b.id = a.product_id');
        $this->db->where('a.order_id',$orderid);
        return $this->db->get()->result();
    }

    
    public function catering_order_status_change($status,$orderid){
            $this->db->where('id',  $orderid);
            $this->db->update('restro_catering_order', $status);
    } 

    public function view_reservation_order($orderid){
        $this->db->select('a.restro_name,d.*,b.email,g.email as Cust_email,f.f_name,f.l_name');
        $this->db->from('restro_info a');
        $this->db->join('users b', 'b.id = a.user_id');
        $this->db->join('restro_booked_table c', 'c.restro_id = a.id'); 
        $this->db->join('restro_table_order d', 'd.id = c.order_id');
        //$this->db->join('restro_customer_address e', 'e.user_id = d.user_id and e.id = d.address_id'); 
        $this->db->join('user_profiles f', 'f.user_id = d.user_id'); 
        $this->db->join('users g', 'g.id = d.user_id'); 
        $this->db->where('d.status !=',0);
        $this->db->where('d.id',$orderid);
        $this->db->group_by("d.id");
        return $this->db->get()->result();
        //$this->db->get();
        //echo $this->db->last_query();
    } 

    public function reservation_order_details($orderid){
        $this->db->select('a.*,b.table_no');
        $this->db->from('restro_booked_table a');
        $this->db->join('restro_tables b', 'b.id = a.table_id');
        $this->db->where('a.order_id',$orderid);
        return $this->db->get()->result();
    }
    
    public function reservation_order_status_change($status,$orderid){
            $this->db->where('id',  $orderid);
            $this->db->update('restro_table_order', $status);
    } 

    public function view_pickup_order($orderid){
        $this->db->select('a.restro_name,d.*,b.email,g.email as Cust_email,f.f_name,f.l_name,e.billing_full_name,e.billing_addres_1,e.billing_address_2,e.billing_city,e.billing_state,e.billing_zip_code,e.billing_phoneno,e.shipping_full_name,e.shipping_address_1,e.shipping_address_2,e.shipping_city,e.shipping_state,e.shipping_zip_code,e.shipping_phoneno');
        $this->db->from('restro_info a');
        $this->db->join('users b', 'b.id = a.user_id');
        $this->db->join('restro_pickup_order_details c', 'c.restro_id = a.id'); 
        $this->db->join('restro_pickup_order d', 'd.id = c.order_id');
        $this->db->join('restro_customer_address e', 'e.user_id = d.user_id and e.id = d.address_id'); 
        $this->db->join('user_profiles f', 'f.user_id = d.user_id'); 
        $this->db->join('users g', 'g.id = d.user_id'); 
        $this->db->where('d.status !=',0);
        $this->db->where('d.id',$orderid);
        $this->db->group_by("d.id");
        return $this->db->get()->result();
    }

    public function pickup_order_details($orderid){
        $this->db->select('a.*,b.image,b.item_name');
        $this->db->from('restro_pickup_order_details a');
        $this->db->join('tbl_item b', 'b.id = a.product_id');
        $this->db->where('a.order_id',$orderid);
        return $this->db->get()->result();
    }

    public function pickup_order_status_change($status,$orderid){
            $this->db->where('id',  $orderid);
            $this->db->update('restro_pickup_order', $status);
    }

    public function  get_restro_list()
    {
          $this->db->select("*");
          $this->db->from("restro_info");
          $this->db->where("status !=",0);
          $this->db->where("trash",0);
          $this->db->order_by("restro_name","asc");
          return $this->db->get()->result();


    }
    public function get_restro_location_by_id($id)
    {
         
            $this->db->select("id,location_name");
            $this->db->from("restro_location");
            $this->db->where("restro_id",$id);
            $this->db->where("blank_upload",0);
            $this->db->order_by("location_name","asc");
            return $this->db->get()->result();

    }

    public function get_delivery_orders_count(){
            $this->db->select("restro_order.id");
            $this->db->from("restro_order"); 
            $this->db->join("restro_order_details","restro_order.id = restro_order_details.order_id");
            $this->db->where("restro_order.status !=",1);
            $this->db->where("restro_order.status !=",0);
            $this->db->group_by("restro_order.id"); 
            $query = $this->db->get();
            return $query->num_rows();
    }

    public function get_catering_orders_count(){
            $this->db->select("restro_catering_order.id");
            $this->db->from("restro_catering_order");
            $this->db->join("restro_catering_order_details",'restro_catering_order.id = restro_catering_order_details.order_id');
            $this->db->where("restro_catering_order.status !=",1);
            $this->db->where("restro_catering_order.status !=",0);
            $this->db->group_by("restro_catering_order.id");
            $query = $this->db->get();
            return $query->num_rows();
    }

    public function get_pickup_orders_count(){
            $this->db->select("restro_pickup_order.id");
            $this->db->from("restro_pickup_order");
            $this->db->join("restro_pickup_order_details",'restro_pickup_order.id = restro_pickup_order_details.order_id');
            $this->db->where("restro_pickup_order.status !=",1);
            $this->db->where("restro_pickup_order.status !=",0);
            $this->db->group_by("restro_pickup_order.id");
            $query = $this->db->get();
            return $query->num_rows();
    }

    public function get_reservation_orders_count(){
            $this->db->select("restro_table_order.id");
            $this->db->from("restro_table_order");
            $this->db->join("restro_booked_table",'restro_table_order.id = restro_booked_table.order_id');
            $this->db->where("restro_table_order.status !=",1);
            $this->db->where("restro_table_order.status !=",0);
            $this->db->group_by("restro_table_order.id");
            $query = $this->db->get();
            return $query->num_rows();
    }




    public function get_delivery_pending_count(){
            $this->db->select("restro_order.id");
            $this->db->from("restro_order"); 
            $this->db->join("restro_order_details","restro_order.id = restro_order_details.order_id");
            $this->db->where("restro_order.status",1);
            $this->db->group_by("restro_order.id"); 
            $query = $this->db->get();
            return $query->num_rows();
    }

    public function get_catering_pending_count(){
            $this->db->select("restro_catering_order.id");
            $this->db->from("restro_catering_order");
            $this->db->join("restro_catering_order_details",'restro_catering_order.id = restro_catering_order_details.order_id');
            $this->db->where("restro_catering_order.status",1);
            $this->db->group_by("restro_catering_order.id");
            $query = $this->db->get();
            return $query->num_rows();
    }

    public function get_pickup_pending_count(){
            $this->db->select("restro_pickup_order.id");
            $this->db->from("restro_pickup_order");
            $this->db->join("restro_pickup_order_details",'restro_pickup_order.id = restro_pickup_order_details.order_id');
            $this->db->where("restro_pickup_order.status",1);
            $this->db->group_by("restro_pickup_order.id");
            $query = $this->db->get();
            return $query->num_rows();
    }

    public function get_reservation_pending_count(){
            $this->db->select("restro_table_order.id");
            $this->db->from("restro_table_order");
            $this->db->join("restro_booked_table",'restro_table_order.id = restro_booked_table.order_id');
            $this->db->where("restro_table_order.status",1);
            $this->db->group_by("restro_table_order.id");
            $query = $this->db->get();
            return $query->num_rows();
    }



    public function get_delivery_orders_count_filter($restro_id,$location_id){
            $this->db->select("restro_order.id");
            $this->db->from("restro_order"); 
            $this->db->join("restro_order_details","restro_order.id = restro_order_details.order_id");
            $this->db->where("restro_order_details.restro_id",$restro_id);
            $this->db->where("restro_order.restro_location_id",$location_id);
            $this->db->group_by("restro_order.id"); 
            $query = $this->db->get();
            return $query->num_rows();
    }

    public function get_catering_orders_count_filter($restro_id,$location_id){
            $this->db->select("restro_catering_order.id");
            $this->db->from("restro_catering_order");
            $this->db->join("restro_catering_order_details",'restro_catering_order.id = restro_catering_order_details.order_id');
            $this->db->where("restro_catering_order_details.restro_id",$restro_id);
            $this->db->where("restro_catering_order.restro_location_id",$location_id);
            $this->db->group_by("restro_catering_order.id");
            $query = $this->db->get();
            return $query->num_rows();
    }

    public function get_pickup_orders_count_filter($restro_id,$location_id){
            $this->db->select("restro_pickup_order.id");
            $this->db->from("restro_pickup_order");
            $this->db->join("restro_pickup_order_details",'restro_pickup_order.id = restro_pickup_order_details.order_id');
            $this->db->where("restro_pickup_order_details.restro_id",$restro_id);
            $this->db->where("restro_pickup_order.restro_location_id",$location_id);
            $this->db->group_by("restro_pickup_order.id");
            $query = $this->db->get();
            return $query->num_rows();
    }

    public function get_reservation_orders_count_filter($restro_id,$location_id){
            $this->db->select("restro_table_order.id");
            $this->db->from("restro_table_order");
            $this->db->join("restro_booked_table",'restro_table_order.id = restro_booked_table.order_id');
            $this->db->where("restro_booked_table.restro_id",$restro_id);
            $this->db->where("restro_table_order.restro_location_id",$location_id);
            $this->db->group_by("restro_table_order.id");
            $query = $this->db->get();
            return $query->num_rows();
    }


    public function get_owner_delivery_orders_count(){
            $OwnerId = $this->tank_auth->get_user_id();
            $this->db->select("restro_order.id");
            $this->db->from("restro_order"); 
            $this->db->join("restro_order_details","restro_order.id = restro_order_details.order_id");
            $this->db->join("restro_info","restro_info.id = restro_order_details.restro_id");
            $this->db->join("users","users.id = restro_info.user_id");
            $this->db->where("users.id",$OwnerId);
            $this->db->where("restro_order.status !=",0);
            $this->db->where("restro_order.status !=",1);
            $this->db->group_by("restro_order.id"); 
            $query = $this->db->get();
            return $query->num_rows();
    }

    public function get_owner_catering_orders_count(){
            $OwnerId = $this->tank_auth->get_user_id();

            $this->db->select("restro_catering_order.id");
            $this->db->from("restro_catering_order");
            $this->db->join("restro_catering_order_details",'restro_catering_order.id = restro_catering_order_details.order_id');
            $this->db->join("restro_info","restro_info.id = restro_catering_order_details.restro_id");
            $this->db->join("users","users.id = restro_info.user_id");
            $this->db->where("users.id",$OwnerId);
            $this->db->where("restro_catering_order.status !=",0);
            $this->db->where("restro_catering_order.status !=",1);
            $this->db->group_by("restro_catering_order.id");
            $query = $this->db->get();
            return $query->num_rows();
    }

    public function get_owner_pickup_orders_count(){
            $OwnerId = $this->tank_auth->get_user_id();

            $this->db->select("restro_pickup_order.id");
            $this->db->from("restro_pickup_order");
            $this->db->join("restro_pickup_order_details",'restro_pickup_order.id = restro_pickup_order_details.order_id');
            $this->db->join("restro_info","restro_info.id = restro_pickup_order_details.restro_id");
            $this->db->join("users","users.id = restro_info.user_id");
            $this->db->where("users.id",$OwnerId);
            $this->db->where("restro_pickup_order.status !=",0);
            $this->db->where("restro_pickup_order.status !=",1);
            $this->db->group_by("restro_pickup_order.id");
            $query = $this->db->get();
            return $query->num_rows();
    }

    public function get_owner_reservation_orders_count(){
            $OwnerId = $this->tank_auth->get_user_id();

            $this->db->select("restro_table_order.id");
            $this->db->from("restro_table_order");
            $this->db->join("restro_booked_table",'restro_table_order.id = restro_booked_table.order_id');
            $this->db->join("restro_info","restro_info.id = restro_booked_table.restro_id");
            $this->db->join("users","users.id = restro_info.user_id");
            $this->db->where("users.id",$OwnerId);
            $this->db->where("restro_table_order.status !=",0);
            $this->db->where("restro_table_order.status !=",1);
            $this->db->group_by("restro_table_order.id");
            $query = $this->db->get();
            return $query->num_rows();
    }





    public function get_owner_delivery_orders_countP(){
            $OwnerId = $this->tank_auth->get_user_id();
            $this->db->select("restro_order.id");
            $this->db->from("restro_order"); 
            $this->db->join("restro_order_details","restro_order.id = restro_order_details.order_id");
            $this->db->join("restro_info","restro_info.id = restro_order_details.restro_id");
            $this->db->join("users","users.id = restro_info.user_id");
            $this->db->where("users.id",$OwnerId);
            $this->db->where("restro_order.status",1);
            $this->db->group_by("restro_order.id"); 
            $query = $this->db->get();
            return $query->num_rows();
    }

    public function get_owner_catering_orders_countP(){
            $OwnerId = $this->tank_auth->get_user_id();

            $this->db->select("restro_catering_order.id");
            $this->db->from("restro_catering_order");
            $this->db->join("restro_catering_order_details",'restro_catering_order.id = restro_catering_order_details.order_id');
            $this->db->join("restro_info","restro_info.id = restro_catering_order_details.restro_id");
            $this->db->join("users","users.id = restro_info.user_id");
            $this->db->where("users.id",$OwnerId);
            $this->db->where("restro_catering_order.status",1);
            $this->db->group_by("restro_catering_order.id");
            $query = $this->db->get();
            return $query->num_rows();
    }

    public function get_owner_pickup_orders_countP(){
            $OwnerId = $this->tank_auth->get_user_id();

            $this->db->select("restro_pickup_order.id");
            $this->db->from("restro_pickup_order");
            $this->db->join("restro_pickup_order_details",'restro_pickup_order.id = restro_pickup_order_details.order_id');
            $this->db->join("restro_info","restro_info.id = restro_pickup_order_details.restro_id");
            $this->db->join("users","users.id = restro_info.user_id");
            $this->db->where("users.id",$OwnerId);
            $this->db->where("restro_pickup_order.status",1);
            $this->db->group_by("restro_pickup_order.id");
            $query = $this->db->get();
            return $query->num_rows();
    }

    public function get_owner_reservation_orders_countP(){
            $OwnerId = $this->tank_auth->get_user_id();

            $this->db->select("restro_table_order.id");
            $this->db->from("restro_table_order");
            $this->db->join("restro_booked_table",'restro_table_order.id = restro_booked_table.order_id');
            $this->db->join("restro_info","restro_info.id = restro_booked_table.restro_id");
            $this->db->join("users","users.id = restro_info.user_id");
            $this->db->where("users.id",$OwnerId);
            $this->db->where("restro_table_order.status",1);
            $this->db->group_by("restro_table_order.id");
            $query = $this->db->get();
            return $query->num_rows();
    }


    public function delivery_commission_reports(){
        $this->db->select('restro_info.restro_name,restro_order.*,(SELECT SUM(restro_order.total)) as order_total,(SELECT SUM(restro_order.delivery_charges)) as order_charges,(SELECT SUM(restro_order.discount_amount)) as order_discount,restro_order_details.restro_id as order_restro_id');
        $this->db->from('restro_info');
        $this->db->join('restro_order_details', 'restro_order_details.restro_id = restro_info.id');
        $this->db->join('restro_order', 'restro_order.id = restro_order_details.order_id');
        $this->db->join('restro_working_hour', 'restro_working_hour.location_id = restro_order.restro_location_id and restro_working_hour.restro_id = restro_order_details.restro_id');  
        $this->db->where('restro_working_hour.service_id',1);
        $this->db->group_by('restro_order.restro_location_id');
        return $query = $this->db->get()->result();
        //$this->db->get();
        //echo $this->db->last_query();
    }
    

    public function delivery_commission_reports_filter($from_date,$to_date){
        $this->db->select('restro_info.restro_name,restro_order.*,(SELECT SUM(restro_order.total)) as order_total,(SELECT SUM(restro_order.delivery_charges)) as order_charges,(SELECT SUM(restro_order.discount_amount)) as order_discount,restro_order_details.restro_id as order_restro_id');
        $this->db->from('restro_info');
        $this->db->join('restro_order_details', 'restro_order_details.restro_id = restro_info.id');
        $this->db->join('restro_order', 'restro_order.id = restro_order_details.order_id');
        $this->db->join('restro_working_hour', 'restro_working_hour.location_id = restro_order.restro_location_id and restro_working_hour.restro_id = restro_order_details.restro_id');  
        $this->db->where('restro_working_hour.service_id',1);
        $this->db->where('date >=', $from_date);
        $this->db->where('date <=', $to_date);
        $this->db->group_by('restro_order.restro_location_id');
        return $query = $this->db->get()->result();
        //$this->db->get();
        //echo $this->db->last_query();
    }

    public function catering_commission_reports(){
        $this->db->select('restro_info.restro_name,restro_catering_order.*,(SELECT SUM(restro_catering_order.total)) as order_total,(SELECT SUM(restro_catering_order.delivery_charges)) as order_charges,(SELECT SUM(restro_catering_order.discount_amount)) as order_discount,restro_catering_order_details.restro_id as order_restro_id');
        $this->db->from('restro_info');
        $this->db->join('restro_catering_order_details', 'restro_catering_order_details.restro_id = restro_info.id');
        $this->db->join('restro_catering_order', 'restro_catering_order.id = restro_catering_order_details.order_id');  
        $this->db->join('restro_working_hour', 'restro_working_hour.location_id = restro_catering_order.restro_location_id and restro_working_hour.restro_id = restro_catering_order_details.restro_id');  
        $this->db->where('restro_working_hour.service_id',2);
        $this->db->group_by('restro_catering_order.restro_location_id');
        return $query = $this->db->get()->result();
    }

    public function catering_commission_reports_filter($from_date,$to_date){
        $this->db->select('restro_info.restro_name,restro_catering_order.*,(SELECT SUM(restro_catering_order.total)) as order_total,(SELECT SUM(restro_catering_order.delivery_charges)) as order_charges,(SELECT SUM(restro_catering_order.discount_amount)) as order_discount,restro_catering_order_details.restro_id as order_restro_id');
        $this->db->from('restro_info');
        $this->db->join('restro_catering_order_details', 'restro_catering_order_details.restro_id = restro_info.id');
        $this->db->join('restro_catering_order', 'restro_catering_order.id = restro_catering_order_details.order_id');  
        $this->db->join('restro_working_hour', 'restro_working_hour.location_id = restro_catering_order.restro_location_id and restro_working_hour.restro_id = restro_catering_order_details.restro_id');  
        $this->db->where('restro_working_hour.service_id',2);
        $this->db->where('date >=', $from_date);
        $this->db->where('date <=', $to_date);
        $this->db->group_by('restro_catering_order.restro_location_id');
        return $query = $this->db->get()->result();
    }
    

    public function pickup_commission_reports(){
        $this->db->select('restro_info.restro_name,restro_pickup_order.*,(SELECT SUM(restro_pickup_order.total)) as order_total,(SELECT SUM(restro_pickup_order.delivery_charges)) as order_charges,(SELECT SUM(restro_pickup_order.discount_amount)) as order_discount,restro_pickup_order_details.restro_id as order_restro_id,restro_working_hour.location_id');
        $this->db->from('restro_info');
        $this->db->join('restro_pickup_order_details', 'restro_pickup_order_details.restro_id = restro_info.id');
        $this->db->join('restro_pickup_order', 'restro_pickup_order.id = restro_pickup_order_details.order_id');  
        $this->db->join('restro_working_hour', 'restro_working_hour.restro_id = restro_pickup_order_details.restro_id');  
        $this->db->where('restro_working_hour.service_id',4);
        $this->db->group_by('restro_pickup_order.restro_location_id');
        return $query = $this->db->get()->result();
    }
        public function pickup_commission_reports_filter($from_date,$to_date){
        $this->db->select('restro_info.restro_name,restro_pickup_order.*,(SELECT SUM(restro_pickup_order.total)) as order_total,(SELECT SUM(restro_pickup_order.delivery_charges)) as order_charges,(SELECT SUM(restro_pickup_order.discount_amount)) as order_discount,restro_pickup_order_details.restro_id as order_restro_id,restro_working_hour.location_id');
        $this->db->from('restro_info');
        $this->db->join('restro_pickup_order_details', 'restro_pickup_order_details.restro_id = restro_info.id');
        $this->db->join('restro_pickup_order', 'restro_pickup_order.id = restro_pickup_order_details.order_id');  
        $this->db->join('restro_working_hour', 'restro_working_hour.restro_id = restro_pickup_order_details.restro_id');  
        $this->db->where('restro_working_hour.service_id',4);
        $this->db->where('date >=', $from_date);
        $this->db->where('date <=', $to_date);
        $this->db->group_by('restro_pickup_order.restro_location_id');
        return $query = $this->db->get()->result();
    }

    public function reservation_commission_reports(){
        $this->db->select('restro_info.restro_name,restro_table_order.*,(SELECT count(restro_table_order.id)) as order_count,restro_booked_table.restro_id as order_restro_id,restro_working_hour.location_id');
        $this->db->from('restro_info');
        $this->db->join('restro_booked_table', 'restro_booked_table.restro_id = restro_info.id');
        $this->db->join('restro_table_order', 'restro_table_order.id = restro_booked_table.order_id');  
        $this->db->join('restro_working_hour', 'restro_working_hour.restro_id = restro_booked_table.restro_id and restro_working_hour.location_id = restro_table_order.restro_location_id');  
        $this->db->where('restro_working_hour.service_id',4);
        $this->db->group_by('restro_table_order.id');
        return $query = $this->db->get()->result();
    }
    

    public function reservation_commission_reports_filter($from_date,$to_date){
        $this->db->select('restro_info.restro_name,restro_table_order.*,(SELECT count(restro_table_order.id)) as order_count,restro_booked_table.restro_id as order_restro_id,restro_working_hour.location_id');
        $this->db->from('restro_info');
        $this->db->join('restro_booked_table', 'restro_booked_table.restro_id = restro_info.id');
        $this->db->join('restro_table_order', 'restro_table_order.id = restro_booked_table.order_id');  
        $this->db->join('restro_working_hour', 'restro_working_hour.restro_id = restro_booked_table.restro_id and restro_working_hour.location_id = restro_table_order.restro_location_id');  
        $this->db->where('restro_working_hour.service_id',3);
        $this->db->where('restro_table_order.date >=', $from_date);
        $this->db->where('restro_table_order.date <=', $to_date);
        $this->db->group_by('restro_table_order.id');
        return $query = $this->db->get()->result();
    }


    public function delivery_orders_item_details($order_id){
        $this->db->select('tbl_item.*');
        $this->db->from('tbl_item');
        $this->db->join('restro_order_details', 'restro_order_details.product_id = tbl_item.id');
        $this->db->where('restro_order_details.order_id',$order_id);
        $this->db->group_by('tbl_item.id');
        return $query = $this->db->get()->result();
    }

    public function catering_orders_item_details($order_id){
        $this->db->select('tbl_item.*');
        $this->db->from('tbl_item');
        $this->db->join('restro_catering_order_details', 'restro_catering_order_details.product_id = tbl_item.id');
        $this->db->where('restro_catering_order_details.order_id',$order_id);
        $this->db->group_by('tbl_item.id');
        return $query = $this->db->get()->result();
    }
   public function pickup_orders_item_details($order_id){
        $this->db->select('tbl_item.*');
        $this->db->from('tbl_item');
        $this->db->join('restro_pickup_order_details','restro_pickup_order_details.product_id = tbl_item.id');
        $this->db->where('restro_pickup_order_details.order_id',$order_id);
        $this->db->group_by('tbl_item.id');
        return $query = $this->db->get()->result();
    }  

    function delivery_delete_order($id){
        $this->db->delete('restro_order', array('id' => $id));
        return true; 
    }
    
    function catering_delete_order($id){
        $this->db->delete('restro_catering_order', array('id' => $id));
        return true; 
    }
    
    function reservation_delete_order($id){
        $this->db->delete('restro_table_order', array('id' => $id));
        return true; 
    }

    function pickup_delete_order($id){
        $this->db->delete('restro_pickup_order', array('id' => $id));
        return true; 
    }


    public function get_restro_order_service_list($restro_id,$location_id){
        $this->db->select('*');
        $this->db->from('restro_services_commission');
        $this->db->where('restro_services_commission.restro_id',$restro_id);
        $this->db->where('restro_services_commission.location_id',$location_id);
        $this->db->where('restro_services_commission.status',1);
        $this->db->group_by('restro_services_commission.service_type');
        return $query = $this->db->get()->result();
        //$this->db->get();
        //echo $this->db->last_query();
    }

    public function restro_get_order_service_list($location_id){
        $this->db->select('*');
        $this->db->from('restro_services_commission');
        $this->db->where('restro_services_commission.location_id',$location_id);
        $this->db->where('restro_services_commission.status',1);
        $this->db->group_by('restro_services_commission.service_type');
        return $query = $this->db->get()->result();
        //$this->db->get();
        //echo $this->db->last_query();
    }



    
    public function update_location_service_status($data,$restro_id,$location_id,$service_id){

        $where = array('restro_id' => $restro_id , 'location_id' => $location_id , 'service_type' => $service_id);
        $this->db->where($where);
        $this->db->update('restro_services_commission', $data);
        
           
        return true;
    }

    
    public function update_restro_service_status($data,$location_id,$service_id){

        $where = array('location_id' => $location_id , 'service_type' => $service_id);
        $this->db->where($where);
        $this->db->update('restro_services_commission', $data);
        
           
        return true;
    }

    public function getlocationAllDetails($location_id){
        $this->db->select('restro_location.*,city.city_name,area.name');
        $this->db->from('restro_location');
        $this->db->join('city','city.id = restro_location.city');
        $this->db->join('area','area.id = restro_location.area');
        $this->db->where('restro_location.id',$location_id);
        return $query = $this->db->get()->row_array();
    }




    public function delivery_pay_done($id,$data){
        $this->db->where('id',$id);
        $this->db->update('restro_order', $data);
        return true;
    }

    public function catering_pay_done($id,$data){
        $this->db->where('id',$id);
        $this->db->update('restro_catering_order', $data);
        return true;
    }

    public function reservation_pay_done($id,$data){
        $this->db->where('id',$id);
        $this->db->update('restro_table_order', $data);
        return true;
    }

    public function pickup_pay_done($id,$data){
        $this->db->where('id',$id);
        $this->db->update('restro_pickup_order', $data);
        return true;
    }
}
?>