<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Restro_Owner_Model extends CI_Model
{


	function __construct()
	{
		parent::__construct();

		$this->load->library('tank_auth');
		$this->lang->load('tank_auth');

	}

   public function getAdminName($id)
   {
       $this->db->select("f_name");
       $this->db->from("user_profiles");
       $this->db->where("user_id",$id);
       return $this->db->get()->row_array();

          
   }
	public function  edit_profile($data,$restroOwnerID)
	{

            $id = $restroOwnerID;
           
            
             $this->db->where('user_id',  $id);
             $this->db->update('user_profiles', $data);
    }
	public function  edit_profile1($data,$restroOwnerID)
	{

             $id = $restroOwnerID;
           
            
             $this->db->where('id',  $id);
             $this->db->update('users', $data);
    }
    public function get_all_owner_restro()
	{
        $id = $this->tank_auth->get_user_id();
	    $this->db->select('*');
        $this->db->from('users');
        $this->db->join('restro_info', 'users.id = restro_info.user_id');  
        $this->db->where('restro_info.trash',0);
        $this->db->where('restro_info.userid',$id);
        return $query = $this->db->get()->result();
        //echo "<pre>"; print_r($query);
        //die;


	}
	public function add_restro_info($restroInfo){
		$this->db->insert('restro_info',$restroInfo);
	}

	public function add_restro_item_cat($itemcat){
		$this->db->insert('tbl_item_category',$itemcat);

	}
	
	public function restro_all_item_category(){

		$id = $this->tank_auth->get_user_id();
        $this->db->select('*');
        $this->db->where('user_id',$id);
		$query = $this->db->get('tbl_item_category');
        return $query = $query->result();
	}

	public function get_my_all_restro(){

		$id = $this->tank_auth->get_user_id();
		$this->db->select('*');
        $this->db->where('user_id',$id);
        $this->db->where('trash',0);
		$query = $this->db->get('restro_info');
        return $query = $query->result();
	}

	public function restro_all_item_category_view(){
		$id = $this->tank_auth->get_user_id();
        $this->db->select('*');
        $this->db->where('user_id',$id);
		$query = $this->db->get('tbl_item_category');
        return $query = $query->result();
	}
    
    public function get_item_owner_id($id){
        
        $this->db->select('user_id');
        $this->db->where('id',$id);
        $query = $this->db->get('tbl_item');
        return $query = $query->row_array();
    }
    
    public function restro_all_item_category_admin($id){
        
        $this->db->select('*');
        $this->db->where('user_id',$id);
        $query = $this->db->get('tbl_item_category');
        return $query = $query->result();
    }

    public function restro_all_item_category_onEdit($owner_id,$location_id,$service_id){
        
        $this->db->select('*');
        $this->db->where('user_id',$owner_id);
        $this->db->where('location_id',$location_id);
        $this->db->where('service_id',$service_id);
        $query = $this->db->get('tbl_item_category');
        return $query = $query->result();
    }

	public function add_restro_item($item){
		$this->db->insert('tbl_item',$item);
        $insert_id = $this->db->insert_id();
        return $insert_id;
	}

	public function get_owner_all_item(){
		$id = $this->tank_auth->get_user_id();
        $this->db->select('*');
        $this->db->where('user_id',$id);
		$query = $this->db->get('tbl_item');
        return $query = $query->result();
	}
	public function add_restro_menu($restromenu){
		$this->db->insert('tbl_restro_menu',$restromenu);
	}
	public function get_my_selected_menu($restroID){
		$id = $this->tank_auth->get_user_id();
        $this->db->select('category_id');
        $this->db->where('user_id',$id);
        $this->db->where('id',$restroID);
		$query = $this->db->get('restro_info');
        return $query = $query->row_array();

	}
	public function view_my_restro($restro_id){
		$id = $this->tank_auth->get_user_id();
        $this->db->select('*');
        $this->db->where('user_id',$id);
        $this->db->where('id',$restro_id);
		$query = $this->db->get('restro_info');
        return $query = $query->result();
	}

	public function view_my_restro_img($restro_id){
		$this->db->select('*');
        $this->db->where('restro_id',$restro_id);
        $this->db->order_by("id", "asc");
		$query = $this->db->get('restro_images');
        return $query = $query->result();
	}

	//public function restro_service_form(){
		
        //$query = $this->db->get('services');
        //return $query = $query->result();
	//}
	public function  edit_my_restro($data,$restro_id)
	{
			$Uid = $this->tank_auth->get_user_id();
            $id = $restro_id;
           
            
             $this->db->where('id',  $id);
             $this->db->where('user_id',  $Uid);
             $this->db->update('restro_info', $data);
    }
    public function add_restro_image($restroInfoImage){
    	$this->db->insert('restro_images',$restroInfoImage);
    }

    public function view_all_cuisin(){
    	$this->db->select('*');
		//$this->db->where('status',1);
		$query = $this->db->get("restro_cuisine");
		return $query = $query->result();
    }

    public function delete_my_restro_cuisine($restro_id){

    		$this->db->where('restro_id', $restro_id);
			$this->db->delete('restro_cuisine_ids'); 
    }
    public function add_my_restro_cuisine($data){

    		$this->db->insert('restro_cuisine_ids',$data);
    }

    public function check_cuisine($cID,$rID){
    	$this->db->select('*');
		$this->db->where('cuisine_id',$cID);
		$this->db->where('restro_id',$rID);
		$query = $this->db->get("restro_cuisine_ids");
        if($query->num_rows() > 0)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function view_my_restro_tables($id){
        $this->db->select('*');
        $this->db->where('restro_id',$id);
        $query = $this->db->get("restro_tables");
        return $query = $query->result();
    }

    public function restro_tables_by_location($location_id){
    	$this->db->select('*');
		$this->db->where('location_id',$location_id);
		$query = $this->db->get("restro_tables");
		return $query = $query->result();
    }
     
    public function add_restro_table($table){
    	$this->db->insert('restro_tables',$table);
    }
    public function edit_restro_table($table,$table_id,$restro_id){
    		$this->db->where('id',  $table_id);
            $this->db->where('restro_id',  $restro_id);
            $this->db->update('restro_tables', $table);
    }
    
    public function restro_table_details($table_id,$restro_id){
    	$this->db->select('*');
		$this->db->where('restro_id',$restro_id);
		$this->db->where('id',$table_id);
		$query = $this->db->get("restro_tables");
		return $query = $query->result();
    }

    public function restro_tables_booking($table_id,$restro_id){
    	$this->db->select('a.*,c.email,b.user_id as customer_id');
        $this->db->from('restro_booked_table a');
        $this->db->join('restro_table_order b', 'b.id = a.order_id');
        $this->db->join('users c', 'c.id = b.user_id'); 
        $this->db->where('a.restro_id',$restro_id);
        $this->db->where('a.table_id',$table_id);
        return $this->db->get()->result();
    }
    public function all_delivery_restro_order($user_id){
    	$this->db->select('a.restro_name,d.*,b.email');
    	$this->db->from('restro_info a');
        $this->db->join('users b', 'b.id = a.user_id');
        $this->db->join('restro_order_details c', 'c.restro_id = a.id'); 
        $this->db->join('restro_order d', 'd.id = c.order_id'); 
		$this->db->where('b.id',$user_id);
		$this->db->where('d.status !=',0);
        $this->db->where('d.status !=',1);
		$this->db->order_by("d.id", "desc");
		$this->db->group_by("d.id");
		return $this->db->get()->result();
    }
    public function all_delivery_restro_order_pending($user_id){
        $this->db->select('a.restro_name,d.*,b.email');
        $this->db->from('restro_info a');
        $this->db->join('users b', 'b.id = a.user_id');
        $this->db->join('restro_order_details c', 'c.restro_id = a.id'); 
        $this->db->join('restro_order d', 'd.id = c.order_id'); 
        $this->db->where('b.id',$user_id);
        $this->db->where('d.status',1);
        $this->db->order_by("d.id", "desc");
        $this->db->group_by("d.id");
        return $this->db->get()->result();
    }
    
    public function all_delivery_restro_order_filter($user_id,$location_id){
        $this->db->select('a.restro_name,d.*,b.email');
        $this->db->from('restro_info a');
        $this->db->join('users b', 'b.id = a.user_id');
        $this->db->join('restro_order_details c', 'c.restro_id = a.id'); 
        $this->db->join('restro_order d', 'd.id = c.order_id'); 
        $this->db->where('b.id',$user_id);
        $this->db->where('d.status !=',0);
        $this->db->where('d.status !=',1);
        $this->db->where('d.restro_location_id',$location_id);
        $this->db->order_by("d.id", "desc");
        $this->db->group_by("d.id");
        return $this->db->get()->result();
    }
    public function getuserename($id){
    	$this->db->select('f_name,l_name');
		$this->db->where('user_id',$id);
		$query = $this->db->get("user_profiles");
		return $query = $query->row_array();
    }
    public function all_reservation_restro_order($user_id){
    	$this->db->select('a.restro_name,d.*,b.email');
    	$this->db->from('restro_info a');
        $this->db->join('users b', 'b.id = a.user_id');
        $this->db->join('restro_booked_table c', 'c.restro_id = a.id'); 
        $this->db->join('restro_table_order d', 'd.id = c.order_id'); 
		$this->db->where('b.id',$user_id);
		$this->db->where('d.status !=',0);
        $this->db->where('d.status !=',1);
		$this->db->order_by("d.id", "desc");
		$this->db->group_by("d.id");
		return $this->db->get()->result();
    }

    public function all_reservation_restro_order_pendding($user_id){
        $this->db->select('a.restro_name,d.*,b.email');
        $this->db->from('restro_info a');
        $this->db->join('users b', 'b.id = a.user_id');
        $this->db->join('restro_booked_table c', 'c.restro_id = a.id'); 
        $this->db->join('restro_table_order d', 'd.id = c.order_id'); 
        $this->db->where('b.id',$user_id);
        $this->db->where('d.status',1);
        $this->db->order_by("d.id", "desc");
        $this->db->group_by("d.id");
        return $this->db->get()->result();
    }
    

    public function all_reservation_restro_order_filter($user_id,$location_id){
        $this->db->select('a.restro_name,d.*,b.email');
        $this->db->from('restro_info a');
        $this->db->join('users b', 'b.id = a.user_id');
        $this->db->join('restro_booked_table c', 'c.restro_id = a.id'); 
        $this->db->join('restro_table_order d', 'd.id = c.order_id'); 
        $this->db->where('b.id',$user_id);
        $this->db->where('d.status !=',0);
        $this->db->where('d.status !=',1);
        $this->db->where('d.restro_location_id',$location_id);
        $this->db->order_by("d.id", "desc");
        $this->db->group_by("d.id");
        return $this->db->get()->result();
    }

    public function all_pickup_restro_order($user_id){
    	$this->db->select('a.restro_name,d.*,b.email');
    	$this->db->from('restro_info a');
        $this->db->join('users b', 'b.id = a.user_id');
        $this->db->join('restro_pickup_order_details c', 'c.restro_id = a.id'); 
        $this->db->join('restro_pickup_order d', 'd.id = c.order_id'); 
		$this->db->where('b.id',$user_id);
		$this->db->where('d.status !=',0);
        $this->db->where('d.status !=',1);
		$this->db->order_by("d.id", "desc");
		$this->db->group_by("d.id");
		return $this->db->get()->result();
    }

    public function all_pickup_restro_order_pendding($user_id){
        $this->db->select('a.restro_name,d.*,b.email');
        $this->db->from('restro_info a');
        $this->db->join('users b', 'b.id = a.user_id');
        $this->db->join('restro_pickup_order_details c', 'c.restro_id = a.id'); 
        $this->db->join('restro_pickup_order d', 'd.id = c.order_id'); 
        $this->db->where('b.id',$user_id);
        $this->db->where('d.status',1);
        $this->db->order_by("d.id", "desc");
        $this->db->group_by("d.id");
        return $this->db->get()->result();
    }

    
    public function all_pickup_restro_order_filter($user_id,$location_id){
        $this->db->select('a.restro_name,d.*,b.email');
        $this->db->from('restro_info a');
        $this->db->join('users b', 'b.id = a.user_id');
        $this->db->join('restro_pickup_order_details c', 'c.restro_id = a.id'); 
        $this->db->join('restro_pickup_order d', 'd.id = c.order_id'); 
        $this->db->where('b.id',$user_id);
        $this->db->where('d.status !=',0);
        $this->db->where('d.status !=',1);
        $this->db->where('d.restro_location_id',$location_id);
        $this->db->order_by("d.id", "desc");
        $this->db->group_by("d.id");
        return $this->db->get()->result();
    }

    public function all_catering_restro_order($user_id){
        $this->db->select('a.restro_name,d.*,b.email');
        $this->db->from('restro_info a');
        $this->db->join('users b', 'b.id = a.user_id');
        $this->db->join('restro_catering_order_details c', 'c.restro_id = a.id'); 
        $this->db->join('restro_catering_order d', 'd.id = c.order_id'); 
        $this->db->where('b.id',$user_id);
        $this->db->where('d.status !=',0);
        $this->db->where('d.status !=',1);
        $this->db->order_by("d.id", "desc");
        $this->db->group_by("d.id");
        return $this->db->get()->result();
    }

    public function all_catering_restro_order_pendding($user_id){
        $this->db->select('a.restro_name,d.*,b.email');
        $this->db->from('restro_info a');
        $this->db->join('users b', 'b.id = a.user_id');
        $this->db->join('restro_catering_order_details c', 'c.restro_id = a.id'); 
        $this->db->join('restro_catering_order d', 'd.id = c.order_id'); 
        $this->db->where('b.id',$user_id);
        $this->db->where('d.status',1);
        $this->db->order_by("d.id", "desc");
        $this->db->group_by("d.id");
        return $this->db->get()->result();
    }
    public function all_catering_restro_order_filter($user_id,$location_id){
        $this->db->select('a.restro_name,d.*,b.email');
        $this->db->from('restro_info a');
        $this->db->join('users b', 'b.id = a.user_id');
        $this->db->join('restro_catering_order_details c', 'c.restro_id = a.id'); 
        $this->db->join('restro_catering_order d', 'd.id = c.order_id'); 
        $this->db->where('b.id',$user_id);
        $this->db->where('d.status !=',0);
        $this->db->where('d.status !=',1);
        $this->db->where('d.restro_location_id',$location_id);
        $this->db->order_by("d.id", "desc");
        $this->db->group_by("d.id");
        return $this->db->get()->result();
    }

    

    

    public function view_delivery_restro_order($orderid,$user_id){
    	$this->db->select('a.restro_name,d.*,b.email,g.email as Cust_email,f.f_name,f.l_name,e.billing_full_name,e.billing_addres_1,e.billing_address_2,e.billing_city,e.billing_state,e.billing_zip_code,e.billing_phoneno,e.shipping_full_name,e.shipping_address_1,e.shipping_address_2,e.shipping_city,e.shipping_state,e.shipping_zip_code,e.shipping_phoneno');
    	$this->db->from('restro_info a');
        $this->db->join('users b', 'b.id = a.user_id');
        $this->db->join('restro_order_details c', 'c.restro_id = a.id'); 
        $this->db->join('restro_order d', 'd.id = c.order_id');
        $this->db->join('restro_customer_address e', 'e.user_id = d.user_id and e.id = d.address_id'); 
        $this->db->join('user_profiles f', 'f.user_id = d.user_id'); 
        $this->db->join('users g', 'g.id = d.user_id'); 
        $this->db->where('b.id',$user_id);
		$this->db->where('d.status !=',0);
		$this->db->where('d.id',$orderid);
        $this->db->group_by("d.id");
		return $this->db->get()->result();
    } 

    public function restro_delivery_order_details($orderid){
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

    public function view_catering_restro_order($orderid,$user_id){
        $this->db->select('a.restro_name,d.*,b.email,g.email as Cust_email,f.f_name,f.l_name,e.billing_full_name,e.billing_addres_1,e.billing_address_2,e.billing_city,e.billing_state,e.billing_zip_code,e.billing_phoneno,e.shipping_full_name,e.shipping_address_1,e.shipping_address_2,e.shipping_city,e.shipping_state,e.shipping_zip_code,e.shipping_phoneno');
        $this->db->from('restro_info a');
        $this->db->join('users b', 'b.id = a.user_id');
        $this->db->join('restro_catering_order_details c', 'c.restro_id = a.id'); 
        $this->db->join('restro_catering_order d', 'd.id = c.order_id');
        $this->db->join('restro_customer_address e', 'e.user_id = d.user_id and e.id = d.address_id'); 
        $this->db->join('user_profiles f', 'f.user_id = d.user_id'); 
        $this->db->join('users g', 'g.id = d.user_id'); 
        $this->db->where('b.id',$user_id);
        $this->db->where('d.status !=',0);
        $this->db->where('d.id',$orderid);
        $this->db->group_by("d.id");
        return $this->db->get()->result();
    } 

    public function restro_catering_order_details($orderid){
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

    public function view_reservation_restro_order($orderid,$user_id){
        $this->db->select('a.restro_name,d.*,b.email,g.email as Cust_email,f.f_name,f.l_name');
        $this->db->from('restro_info a');
        $this->db->join('users b', 'b.id = a.user_id');
        $this->db->join('restro_booked_table c', 'c.restro_id = a.id'); 
        $this->db->join('restro_table_order d', 'd.id = c.order_id');
        //$this->db->join('restro_customer_address e', 'e.user_id = d.user_id and e.id = d.address_id'); 
        $this->db->join('user_profiles f', 'f.user_id = d.user_id'); 
        $this->db->join('users g', 'g.id = d.user_id'); 
        $this->db->where('b.id',$user_id);
        $this->db->where('d.status !=',0);
        $this->db->where('d.id',$orderid);
        $this->db->group_by("d.id");
        return $this->db->get()->result();
    } 

    public function restro_reservation_order_details($orderid){
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

    public function view_pickup_restro_order($orderid,$user_id){
        $this->db->select('a.restro_name,d.*,b.email,g.email as Cust_email,f.f_name,f.l_name,e.billing_full_name,e.billing_addres_1,e.billing_address_2,e.billing_city,e.billing_state,e.billing_zip_code,e.billing_phoneno,e.shipping_full_name,e.shipping_address_1,e.shipping_address_2,e.shipping_city,e.shipping_state,e.shipping_zip_code,e.shipping_phoneno');
        $this->db->from('restro_info a');
        $this->db->join('users b', 'b.id = a.user_id');
        $this->db->join('restro_pickup_order_details c', 'c.restro_id = a.id'); 
        $this->db->join('restro_pickup_order d', 'd.id = c.order_id');
        $this->db->join('restro_customer_address e', 'e.user_id = d.user_id and e.id = d.address_id'); 
        $this->db->join('user_profiles f', 'f.user_id = d.user_id'); 
        $this->db->join('users g', 'g.id = d.user_id'); 
        $this->db->where('b.id',$user_id);
        $this->db->where('d.status !=',0);
        $this->db->where('d.id',$orderid);
        $this->db->group_by("d.id");
        return $this->db->get()->result();
    }

    public function restro_pickup_order_details($orderid){
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
    public function delete_my_restro_menu($restro_id,$restroOwnerID){
            $this->db->where('restro_id', $restro_id);
            $this->db->where('user_id', $restroOwnerID);
            $this->db->delete('tbl_restro_menu'); 
    }
    public function restroseoCatChk($cID,$rID){
        $this->db->select('*');
        $this->db->where('category_id',$cID);
        $this->db->where('restro_id',$rID);
        $query = $this->db->get("restro_seo_category_list");
        if($query->num_rows() > 0)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }
    public function get_item_category_details($categoryId,$userid){
        $this->db->select('*');
        $this->db->where('id',$categoryId);
        $this->db->where('user_id',$userid);
        $query = $this->db->get("tbl_item_category");
        return $query = $query->result();
    }

    public function edit_restro_item_cat($itemcat,$cat_id)
    {
        $this->db->where('id',  $cat_id);
        $this->db->update('tbl_item_category', $itemcat);
    }
    public function delete_my_item_cat($categoryid,$user_id){
        $this->db->delete('tbl_item_category', array('id' => $categoryid,'user_id' => $user_id));
    }
    public function restro_item_details($item_id,$restroOwnerID){
        $this->db->select('*');
        $this->db->where('id',$item_id);
        $this->db->where('user_id',$restroOwnerID);
        $query = $this->db->get("tbl_item");
        return $query = $query->result();
    }
    public function edit_restro_item($item,$item_id){
        $this->db->where('id',  $item_id);
        $this->db->update('tbl_item', $item);
    }

    public function getCategoryName($id){
        $this->db->select('cat_name');
        $this->db->where('id',$id);
        $query = $this->db->get("tbl_item_category");
        return $query = $query->row_array();
    }
    public function delete_my_item($itemid,$user_id){
        $this->db->delete('tbl_item', array('id' => $itemid,'user_id' => $user_id));
    }
    public function updaterestro_setup($restroinfo,$restroid){
        $this->db->where('id',  $restroid);
        $this->db->update('restro_info', $restroinfo);
    }
    public function insert_restro_payMethod($data){
        $this->db->insert('restro_payments_method',$data);
    }

    public function update_restro_working($data,$restro_id,$service,$location_id){
        $this->db->where('restro_id',  $restro_id);
        $this->db->where('service_id',  $service);
        $this->db->where('location_id',  $location_id);
        $this->db->update('restro_working_hour', $data);
    }

    public function delete_restro_payMethod($restroid,$user_id){
        $this->db->delete('restro_payments_method', array('restro_id' => $restroid,'user_id' => $user_id));
    }

    public function delete_restro_working($restroid,$user_id){
        $this->db->delete('restro_working_hour', array('restro_id' => $restroid,'user_id' => $user_id));
    }
    public function view_my_restro_working($restroid,$service,$location_id){
        $this->db->select('*');
        $this->db->where('restro_id',$restroid);
        $this->db->where('service_id',$service); 
        $this->db->where('location_id',$location_id); 
        $query = $this->db->get("restro_working_hour");
        return $query = $query->row_array();
    }

    public function chkRestropaymethod($method,$restroid){
        $this->db->select('*');
        $this->db->where('method_type',$method);
        $this->db->where('restro_id',$restroid);
        $query = $this->db->get("restro_payments_method");
        if($query->num_rows() > 0)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }
    public function add_restro_cuisine($data){
         $this->db->insert('restro_cuisine',$data);
    }

    public function view_all_food_type(){
        $this->db->select('*');
        $query = $this->db->get("restro_food_type");
        return $query = $query->result();
    }

    public function add_restro_food_type($data){
        $this->db->insert('food_type_restro_list',$data);
    }

    public function delete_my_restro_foodType($restro_id){
        $this->db->delete('food_type_restro_list', array('restro_id' => $restro_id));
    }

    public function chk_restro_food_type($foodtype,$restroid){
        $this->db->select('*');
        $this->db->where('food_type_id',$foodtype);
        $this->db->where('restro_id',$restroid);
        $query = $this->db->get("food_type_restro_list");
        if($query->num_rows() > 0)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function add_restro_item_multi_cat($multCat){
        $this->db->insert('resto_items_category_list',$multCat);
        
    }
    public function getcatByItem($id){
        $this->db->select('category_id');
        $this->db->where('item_id',$id);
        $query = $this->db->get("resto_items_category_list");
        return $query = $query->result();
    }
    public function delete_restro_item_multi_cat($id){
        $this->db->delete('resto_items_category_list', array('item_id' => $id));
    }
    
    public function chkitemcategory($catid,$itemid){
        $this->db->select('*');
        $this->db->where('category_id',$catid);
        $this->db->where('item_id',$itemid);
        $query = $this->db->get("resto_items_category_list");
        if($query->num_rows() > 0)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function all_seo_category(){
        $this->db->select('*');
        $query = $this->db->get("restro_seo_category");
        return $query = $query->result();
    }
    public function delete_my_restro_seocat($restro_id,$restroOwnerID){
         $this->db->delete('restro_seo_category_list', array('restro_id' => $restro_id,'user_id' => $restroOwnerID));
    }

    public function add_restro_seocat($data){
        $this->db->insert('restro_seo_category_list',$data);
    }
    public function categoryCountByService($service,$restro,$location_id){
        $this->db->select('*');
        $this->db->where('service_id',$service);
        $this->db->where('restro_id',$restro);
        $this->db->where('location_id',$location_id);
        $query = $this->db->get("tbl_restro_menu");
        echo $query->num_rows();
    }

    public function chckrestroService($restro_id,$service,$location_id){
        $this->db->select('*');
        $this->db->where('restro_id',$restro_id);
        $this->db->where('service_id',$service);
        $this->db->where('location_id',$location_id);
        $query = $this->db->get("restro_working_hour");
        if($query->num_rows() > 0)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function getCityName($id){
        $this->db->select('city_name');
        $this->db->where('id',$id);
        $query = $this->db->get("city");
        return $query->row_array();
    }

    public function getAreaName($id){
        $this->db->select('name');
        $this->db->where('id',$id);
        $query = $this->db->get("area");
        return $query->row_array();
    }

    
    public function restroCateChkByLocation($cat_id,$restro_id,$location_id,$service_id){
        $this->db->select('*');
        $this->db->where('restro_id',$restro_id);
        $this->db->where('service_id',$service_id);
        $this->db->where('category_id',$cat_id);
        $this->db->where('location_id',$location_id);
        $query = $this->db->get("tbl_restro_menu");
        if($query->num_rows() > 0)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function getAreaPrice($area_id,$restro_id,$location_id,$service_id){
        $this->db->select('area,delivery_price');
        $this->db->where('restro_id',$restro_id);
        $this->db->where('location_id',$location_id);
        $this->db->where('service_id',$service_id);
        $query = $this->db->get("restro_city_area");
        return $query->row_array();
    }


    

   public function getUserMobileNo($id){
        $this->db->select('mobile_no');
        $this->db->where('id',$id);
        $query = $this->db->get("users");
        return $query = $query->row_array();
    }

    
    public function getAdminImage($id){
        $this->db->select('image');
        $this->db->where('user_id',$id);
        $query = $this->db->get("user_profiles");
        return $query = $query->row_array();
    }

    public function getTableName($id){
        $this->db->select('table_no');
        $this->db->where('id',$id);
        $query = $this->db->get("restro_tables");
        return $query = $query->row_array();
    }

    

    public function status_change_table_details($data,$id)
    {
        $this->db->where('id',  $id);
        $this->db->update('restro_booked_table', $data);
        //return true;
        echo $this->db->last_query();
    }
    
}
?>