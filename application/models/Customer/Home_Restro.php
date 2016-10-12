<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home_Restro extends CI_Model
{


	function __construct()
	{
		parent::__construct();

		$this->load->library('tank_auth');
		$this->lang->load('tank_auth');

	}


	public function all_restro(){
		$service_id = $_SESSION['filter_service'];
		$area = $_SESSION['filter_city'];
		$where = "FIND_IN_SET('".$area."',restro_city_area.area) and restro_payments_method.service_type = '".$service_id."'";
		
		$this->db->select('restro_info.*,restro_working_hour.min_order as RestroMin,restro_working_hour.location_id,restro_working_hour.order_days,restro_working_hour.order_hour,restro_working_hour.order_minitue,restro_working_hour.order_second,restro_payments_method.method_type');
        $this->db->from('restro_info');
		$this->db->join('restro_services_commission', 'restro_info.id = restro_services_commission.restro_id');
		$this->db->join('restro_city_area', 'restro_info.id = restro_city_area.restro_id');
		$this->db->join('restro_working_hour', 'restro_info.id = restro_working_hour.restro_id');
		$this->db->join('restro_payments_method', 'restro_info.id = restro_payments_method.restro_id');
		$this->db->join('restro_location', 'restro_location.id = restro_working_hour.location_id and restro_location.id = restro_payments_method.location_id');
		$this->db->where('restro_info.status !=',0);
		$this->db->where('restro_info.trash',0);
		$this->db->where('restro_working_hour.service_id',$service_id); 
		$this->db->where('restro_services_commission.service_type',$service_id);
		$this->db->where($where);
		$this->db->group_by("restro_info.id");  
		$this->db->order_by("restro_info.id", "desc"); 
        return $query = $this->db->get()->result();
        //$this->db->get();
        //echo $this->db->last_query();
	}

	
	public function all_restro_pick(){
		$service_id = $_SESSION['filter_service'];
		$area = $_SESSION['filter_city'];
		
		
		$this->db->select('restro_info.*,restro_working_hour.min_order as RestroMin,restro_working_hour.location_id,restro_working_hour.order_days,restro_working_hour.order_hour,restro_working_hour.order_minitue,restro_working_hour.order_second,restro_payments_method.method_type');
        $this->db->from('restro_info');
		$this->db->join('restro_services_commission', 'restro_info.id = restro_services_commission.restro_id');
		$this->db->join('restro_working_hour', 'restro_info.id = restro_working_hour.restro_id');
		$this->db->join('restro_payments_method', 'restro_info.id = restro_payments_method.restro_id');
		$this->db->join('restro_location', 'restro_location.id = restro_working_hour.location_id and restro_location.id = restro_payments_method.location_id');
		$this->db->where('restro_info.status !=',0);
		$this->db->where('restro_info.trash',0);
		$this->db->where('restro_working_hour.service_id',$service_id); 
		$this->db->where('restro_services_commission.service_type',$service_id);
		$this->db->where('restro_payments_method.service_type',$service_id);
		$this->db->where('restro_location.area',$area);
		$this->db->group_by("restro_info.id");  
		$this->db->order_by("restro_info.id", "desc"); 
        return $query = $this->db->get()->result();
        //$this->db->get();
        //echo $this->db->last_query();
	}



	public function all_restro_tables(){
		$service_id = $_SESSION['filter_service'];
		$area = $_SESSION['filter_city'];
		
		$this->db->select('restro_info.*,restro_working_hour.min_order as RestroMin,restro_working_hour.monday_from,restro_working_hour.friday_to,restro_working_hour.saturday_from,restro_working_hour.sunday_to');
        $this->db->from('restro_info');
		$this->db->join('restro_services_commission', 'restro_info.id = restro_services_commission.restro_id');
		$this->db->join('restro_working_hour', 'restro_info.id = restro_working_hour.restro_id');
		$this->db->join('restro_tables', 'restro_info.id = restro_tables.restro_id');
		$this->db->join('restro_location', 'restro_location.id = restro_working_hour.location_id and restro_location.id = restro_services_commission.location_id and restro_location.restro_id = restro_info.id');
		$this->db->where('restro_info.status !=',0);
		$this->db->where('restro_info.trash',0);
		$this->db->where('restro_working_hour.service_id',$service_id); 
		$this->db->where('restro_services_commission.service_type',$service_id);
		$this->db->where('restro_location.area',$area);
		$this->db->group_by("restro_info.id");  
		$this->db->order_by("restro_info.id", "desc"); 
        return $query = $this->db->get()->result();
	}



		public function all_restro_fetured(){
		$service_id = $_SESSION['filter_service'];
		$area = $_SESSION['filter_city'];
		
		
		$where = "FIND_IN_SET('".$area."',restro_city_area.area) and restro_payments_method.service_type = '".$service_id."'";
		
		$this->db->select('restro_info.*,restro_working_hour.min_order as RestroMin,restro_working_hour.location_id,restro_working_hour.order_days,restro_working_hour.order_hour,restro_working_hour.order_minitue,restro_working_hour.order_second,restro_payments_method.method_type');
        $this->db->from('restro_info');
		$this->db->join('restro_services_commission', 'restro_info.id = restro_services_commission.restro_id');
		$this->db->join('restro_city_area', 'restro_info.id = restro_city_area.restro_id');
		$this->db->join('restro_working_hour', 'restro_info.id = restro_working_hour.restro_id');
		$this->db->join('restro_payments_method', 'restro_info.id = restro_payments_method.restro_id');
		$this->db->join('restro_location', 'restro_location.id = restro_working_hour.location_id and restro_location.id = restro_payments_method.location_id');
		$this->db->where('restro_info.status !=',0);
		$this->db->where('restro_info.trash',0);
		$this->db->where('restro_info.restro_status',1);
		$this->db->where('restro_working_hour.service_id',$service_id); 
		$this->db->where('restro_services_commission.service_type',$service_id);
		if($_SESSION['filter_city'] != '')
		{
			$this->db->where($where);
		}
		$this->db->group_by("restro_info.id");  
		$this->db->order_by("restro_info.id", "desc"); 
        return $query = $this->db->get()->result();
        //$this->db->get();
        //echo $this->db->last_query();
	}

	
	public function all_restro_pick_fetured(){
		$service_id = $_SESSION['filter_service'];
		$area = $_SESSION['filter_city'];
		
		
		$this->db->select('restro_info.*,restro_working_hour.min_order as RestroMin,restro_working_hour.location_id,restro_working_hour.order_days,restro_working_hour.order_hour,restro_working_hour.order_minitue,restro_working_hour.order_second,restro_payments_method.method_type');
        $this->db->from('restro_info');
		$this->db->join('restro_services_commission', 'restro_info.id = restro_services_commission.restro_id');
		$this->db->join('restro_working_hour', 'restro_info.id = restro_working_hour.restro_id');
		$this->db->join('restro_payments_method', 'restro_info.id = restro_payments_method.restro_id');
		$this->db->join('restro_location', 'restro_location.id = restro_working_hour.location_id and restro_location.id = restro_payments_method.location_id');
		$this->db->where('restro_info.status !=',0);
		$this->db->where('restro_info.trash',0);
		$this->db->where('restro_info.restro_status',1);
		$this->db->where('restro_working_hour.service_id',$service_id); 
		$this->db->where('restro_services_commission.service_type',$service_id);
		$this->db->where('restro_payments_method.service_type',$service_id);
		$this->db->where('restro_location.area',$area);
		$this->db->group_by("restro_info.id");  
		$this->db->order_by("restro_info.id", "desc"); 
        return $query = $this->db->get()->result();
        //$this->db->get();
        //echo $this->db->last_query();
	}



	public function all_restro_tables_fetured(){
		$service_id = $_SESSION['filter_service'];
		$area = $_SESSION['filter_city'];
		
		$this->db->select('restro_info.*,restro_working_hour.min_order as RestroMin,restro_working_hour.monday_from,restro_working_hour.friday_to,restro_working_hour.saturday_from,restro_working_hour.sunday_to');
        $this->db->from('restro_info');
		$this->db->join('restro_services_commission', 'restro_info.id = restro_services_commission.restro_id');
		$this->db->join('restro_working_hour', 'restro_info.id = restro_working_hour.restro_id');
		$this->db->join('restro_tables', 'restro_info.id = restro_tables.restro_id');
		$this->db->join('restro_location', 'restro_location.id = restro_working_hour.location_id and restro_location.id = restro_services_commission.location_id and restro_location.restro_id = restro_info.id');
		$this->db->where('restro_info.status !=',0);
		$this->db->where('restro_info.trash',0);
		$this->db->where('restro_info.restro_status',1);
		$this->db->where('restro_working_hour.service_id',$service_id); 
		$this->db->where('restro_services_commission.service_type',$service_id);
		$this->db->where('restro_location.area',$area);
		$this->db->group_by("restro_info.id");  
		$this->db->order_by("restro_info.id", "desc"); 
        return $query = $this->db->get()->result();
	}



		public function all_restro_promo(){
		$service_id = $_SESSION['filter_service'];
		$area = $_SESSION['filter_city'];
		$where = "FIND_IN_SET('".$area."',restro_city_area.area) and restro_payments_method.service_type = '".$service_id."'";
		
		$this->db->select('restro_info.*,restro_working_hour.min_order as RestroMin,restro_working_hour.location_id,restro_working_hour.order_days,restro_working_hour.order_hour,restro_working_hour.order_minitue,restro_working_hour.order_second,restro_payments_method.method_type');
        $this->db->from('restro_info');
		$this->db->join('restro_services_commission', 'restro_info.id = restro_services_commission.restro_id');
		$this->db->join('restro_city_area', 'restro_info.id = restro_city_area.restro_id');
		$this->db->join('restro_working_hour', 'restro_info.id = restro_working_hour.restro_id');
		$this->db->join('restro_payments_method', 'restro_info.id = restro_payments_method.restro_id');
		$this->db->join('restro_location', 'restro_location.id = restro_working_hour.location_id and restro_location.id = restro_payments_method.location_id');
		$this->db->where('restro_info.status !=',0);
		$this->db->where('restro_info.trash',0);
		$this->db->where('restro_info.restro_status',2);
		$this->db->where('restro_working_hour.service_id',$service_id); 
		$this->db->where('restro_services_commission.service_type',$service_id);
		if($area != '')
		{
			$this->db->where($where);
		}
		
		$this->db->group_by("restro_info.id");  
		$this->db->order_by("restro_info.id", "desc"); 
        return $query = $this->db->get()->result();
        //$this->db->get();
        //echo $this->db->last_query();
	}

	
	public function all_restro_pick_promo(){
		$service_id = $_SESSION['filter_service'];
		$area = $_SESSION['filter_city'];
		
		
		$this->db->select('restro_info.*,restro_working_hour.min_order as RestroMin,restro_working_hour.location_id,restro_working_hour.order_days,restro_working_hour.order_hour,restro_working_hour.order_minitue,restro_working_hour.order_second,restro_payments_method.method_type');
        $this->db->from('restro_info');
		$this->db->join('restro_services_commission', 'restro_info.id = restro_services_commission.restro_id');
		$this->db->join('restro_working_hour', 'restro_info.id = restro_working_hour.restro_id');
		$this->db->join('restro_payments_method', 'restro_info.id = restro_payments_method.restro_id');
		$this->db->join('restro_location', 'restro_location.id = restro_working_hour.location_id and restro_location.id = restro_payments_method.location_id');
		$this->db->where('restro_info.status !=',0);
		$this->db->where('restro_info.trash',0);
		$this->db->where('restro_info.restro_status',2);
		$this->db->where('restro_working_hour.service_id',$service_id); 
		$this->db->where('restro_services_commission.service_type',$service_id);
		$this->db->where('restro_payments_method.service_type',$service_id);
		$this->db->where('restro_location.area',$area);
		$this->db->group_by("restro_info.id");  
		$this->db->order_by("restro_info.id", "desc"); 
        return $query = $this->db->get()->result();
        //$this->db->get();
        //echo $this->db->last_query();
	}



	public function all_restro_tables_promo(){
		$service_id = $_SESSION['filter_service'];
		$area = $_SESSION['filter_city'];
		
		$this->db->select('restro_info.*,restro_working_hour.min_order as RestroMin,restro_working_hour.monday_from,restro_working_hour.friday_to,restro_working_hour.saturday_from,restro_working_hour.sunday_to');
        $this->db->from('restro_info');
		$this->db->join('restro_services_commission', 'restro_info.id = restro_services_commission.restro_id');
		$this->db->join('restro_working_hour', 'restro_info.id = restro_working_hour.restro_id');
		$this->db->join('restro_tables', 'restro_info.id = restro_tables.restro_id');
		$this->db->join('restro_location', 'restro_location.id = restro_working_hour.location_id and restro_location.id = restro_services_commission.location_id and restro_location.restro_id = restro_info.id');
		$this->db->where('restro_info.status !=',0);
		$this->db->where('restro_info.trash',0);
		$this->db->where('restro_info.restro_status',2);
		$this->db->where('restro_working_hour.service_id',$service_id); 
		$this->db->where('restro_services_commission.service_type',$service_id);
		$this->db->where('restro_location.area',$area);
		$this->db->group_by("restro_info.id");  
		$this->db->order_by("restro_info.id", "desc"); 
        return $query = $this->db->get()->result();
	}




	public function all_service(){
		$this->db->select('*');
		$query = $this->db->get("restro_services");
		return $query = $query->result();
	}
	public function all_restro_by_service($service_id,$cus,$city_id){
		if($cus != 0)
		{
			$arr = explode(',',$cus);
		}
		

		$this->db->select('restro_info.*,restro_working_hour.min_order as RestroMin,restro_working_hour.order_days,restro_working_hour.order_hour,restro_working_hour.order_minitue,restro_working_hour.order_second,restro_payments_method.method_type');
        $this->db->from('restro_info');
		$this->db->join('restro_services_commission', 'restro_info.id = restro_services_commission.restro_id');
		$this->db->join('restro_cuisine_ids', 'restro_info.id = restro_cuisine_ids.restro_id');
		$this->db->join('restro_working_hour', 'restro_info.id = restro_working_hour.restro_id');
		$this->db->join('restro_payments_method', 'restro_info.id = restro_payments_method.restro_id');
		$this->db->join('restro_location', 'restro_location.id = restro_payments_method.location_id and restro_location.id = restro_working_hour.location_id ');
		$this->db->where('restro_info.status !=',0);
		$this->db->where('restro_info.trash',0);
		$this->db->where('restro_working_hour.service_id',$service_id); 
		$this->db->where('restro_services_commission.service_type',$service_id);
		$this->db->where('restro_payments_method.service_type',$service_id);
		if($city_id != '')
		{
			$this->db->where('restro_location.area',$city_id);
		}
		
		$this->db->where('restro_payments_method.location_id = restro_working_hour.location_id');
		$this->db->where('restro_payments_method.location_id = restro_services_commission.location_id');
		if($cus != 0)
		{
			$this->db->where_in('restro_cuisine_ids.cuisine_id', $arr);
		}
		$this->db->group_by("restro_info.id");  
		$this->db->order_by("restro_info.id", "desc"); 
        return $query = $this->db->get()->result();
		

	}
	public function all_restro_table_by_service($service_id,$cus,$city_id){
		if($cus != 0)
		{
			$arr = explode(',',$cus);
		}
		

		$this->db->select('restro_info.*,restro_working_hour.min_order as RestroMin,restro_working_hour.monday_from,restro_working_hour.friday_to,restro_working_hour.saturday_from,restro_working_hour.sunday_to');
        $this->db->from('restro_info');
		$this->db->join('restro_services_commission', 'restro_info.id = restro_services_commission.restro_id');
		$this->db->join('restro_working_hour', 'restro_info.id = restro_working_hour.restro_id');
		$this->db->join('restro_tables', 'restro_info.id = restro_tables.restro_id');
		$this->db->join('restro_cuisine_ids', 'restro_info.id = restro_cuisine_ids.restro_id');
		$this->db->join('restro_location', 'restro_location.id = restro_services_commission.location_id and restro_location.id = restro_working_hour.location_id ');
		$this->db->where('restro_info.status !=',0);
		$this->db->where('restro_info.trash',0);
		$this->db->where('restro_working_hour.service_id',$service_id); 
		$this->db->where('restro_services_commission.service_type',$service_id);
		if($city_id != '')
		{
			$this->db->where('restro_location.area',$city_id);
		}
		
		if($cus != 0)
		{
			$this->db->where_in('restro_cuisine_ids.cuisine_id', $arr);
		}
		$this->db->group_by("restro_info.id");  
		$this->db->order_by("restro_info.id", "desc"); 
        return $query = $this->db->get()->result();
        //$query = $this->db->get();
        //echo $this->db->last_query();
		

	}

	

	public function all_restro_by_service_city($service_id,$cus,$area){
		if($cus != 0)
		{
			$arr = explode(',',$cus);
		}
		if($area != '')
		{
			$where = "FIND_IN_SET('".$area."', restro_city_area.area)";
		}
		

		$this->db->select('restro_info.*,restro_working_hour.min_order as RestroMin,restro_working_hour.order_days,restro_working_hour.order_hour,restro_working_hour.order_minitue,restro_working_hour.order_second,restro_payments_method.method_type');
        $this->db->from('restro_info');
		$this->db->join('restro_services_commission', 'restro_info.id = restro_services_commission.restro_id');
		$this->db->join('restro_city_area', 'restro_info.id = restro_city_area.restro_id');
		$this->db->join('restro_cuisine_ids', 'restro_info.id = restro_cuisine_ids.restro_id');
		$this->db->join('restro_working_hour', 'restro_info.id = restro_working_hour.restro_id and restro_city_area.location_id = restro_working_hour.location_id');
		$this->db->join('restro_location', 'restro_location.id = restro_city_area.location_id');
		$this->db->join('restro_payments_method', 'restro_info.id = restro_payments_method.restro_id');
		$this->db->where('restro_info.status !=',0);
		$this->db->where('restro_info.trash',0);
		$this->db->where('restro_working_hour.service_id',$service_id); 
		$this->db->where('restro_services_commission.service_type',$service_id);
		$this->db->where('restro_payments_method.service_type',$service_id);
		$this->db->where('restro_city_area.service_id',$service_id);
		$this->db->where('restro_payments_method.location_id = restro_working_hour.location_id');
		$this->db->where('restro_payments_method.location_id = restro_services_commission.location_id');
		if($cus != 0)
		{
			$this->db->where_in('restro_cuisine_ids.cuisine_id', $arr);
		}

		if($area != '')
		{
			$this->db->where($where);
		}
		$this->db->where('restro_city_area.location_id = restro_services_commission.location_id');
		$this->db->where('restro_city_area.location_id = restro_payments_method.location_id');
		$this->db->group_by("restro_info.id");  
		$this->db->order_by("restro_info.id", "desc"); 
        return $query = $this->db->get()->result();
        //$this->db->get();
        //echo $this->db->last_query();
		

	}

	
	public function all_cuisin(){
		$this->db->select('*');
		$this->db->where('status',1);
		$query = $this->db->get("restro_cuisine");
		return $query = $query->result();
	}

	public function all_restro_by_cuisine($id){
		$service_id = $_SESSION['filter_service'];
		
		$arr = explode('-',$id);
		$this->db->select('restro_info.*,restro_working_hour.min_order as RestroMin');
        $this->db->from('restro_info');
		$this->db->join('restro_services_commission', 'restro_info.id = restro_services_commission.restro_id');
		$this->db->join('restro_working_hour', 'restro_info.id = restro_working_hour.restro_id');
		$this->db->join('restro_cuisine_ids', 'restro_info.id = restro_cuisine_ids.restro_id');
		$this->db->where('restro_info.status !=',0);
		$this->db->where('restro_working_hour.service_id',$service_id); 
		$this->db->where('restro_services_commission.service_type',$service_id);
		$this->db->where_in('restro_cuisine_ids.cuisine_id', $arr);
		$this->db->group_by("restro_info.id");  
		$this->db->order_by("restro_info.id", "desc"); 
        return $query = $this->db->get()->result();
    }

    public function catering_all_restro_by_cuisine($id){
		$service_id = $_SESSION['filter_service'];
		$area = $_SESSION['filter_city'];

		$arr = explode('-',$id);
		$this->db->select('restro_info.*,restro_working_hour.min_order as RestroMin,restro_working_hour.location_id,restro_working_hour.order_days,restro_working_hour.order_hour,restro_working_hour.order_minitue,restro_working_hour.order_second,restro_payments_method.method_type');
        $this->db->from('restro_info');
		$this->db->join('restro_services_commission', 'restro_info.id = restro_services_commission.restro_id');
		$this->db->join('restro_working_hour', 'restro_info.id = restro_working_hour.restro_id');
		$this->db->join('restro_cuisine_ids', 'restro_info.id = restro_cuisine_ids.restro_id'); 
		$this->db->join('restro_payments_method', 'restro_info.id = restro_payments_method.restro_id');
		$this->db->join('restro_location', 'restro_location.id = restro_services_commission.location_id and restro_location.id = restro_working_hour.location_id and restro_location.id = restro_payments_method.location_id and restro_location.restro_id = restro_info.id');
		$this->db->where('restro_info.status !=',0);
		$this->db->where('restro_info.trash',0);
		$this->db->where('restro_working_hour.service_id',$service_id); 
		$this->db->where('restro_services_commission.service_type',$service_id);
		$this->db->where('restro_payments_method.service_type',$service_id);
		if($area != '')
		{
			$this->db->where('restro_location.area',$area);
		}
		
		$this->db->where_in('restro_cuisine_ids.cuisine_id', $arr);
		$this->db->group_by("restro_info.id");  
		$this->db->order_by("restro_info.id", "desc"); 
        return $query = $this->db->get()->result();
    }

    public function catering_all_restro_by_cuisine1($id){
		$service_id = $_SESSION['filter_service'];
		$area = $_SESSION['filter_city'];
		$where = "FIND_IN_SET('".$area."', restro_city_area.area)";


		$arr = explode('-',$id);
		$this->db->select('restro_info.*,restro_working_hour.min_order as RestroMin,restro_working_hour.location_id,restro_working_hour.order_days,restro_working_hour.order_hour,restro_working_hour.order_minitue,restro_working_hour.order_second,restro_payments_method.method_type');
        $this->db->from('restro_info');
		$this->db->join('restro_services_commission', 'restro_info.id = restro_services_commission.restro_id');
		$this->db->join('restro_city_area', 'restro_info.id = restro_city_area.restro_id');
		$this->db->join('restro_working_hour', 'restro_info.id = restro_working_hour.restro_id');
		$this->db->join('restro_cuisine_ids', 'restro_info.id = restro_cuisine_ids.restro_id'); 
		$this->db->join('restro_payments_method', 'restro_info.id = restro_payments_method.restro_id');
		$this->db->join('restro_location', 'restro_location.id = restro_city_area.location_id');
		$this->db->where('restro_info.status !=',0);
		$this->db->where('restro_info.trash',0);
		$this->db->where('restro_working_hour.service_id',$service_id); 
		$this->db->where('restro_services_commission.service_type',$service_id);
		$this->db->where('restro_payments_method.service_type',$service_id);
		$this->db->where('restro_city_area.service_id',$service_id);
		$this->db->where_in('restro_cuisine_ids.cuisine_id', $arr);
		$this->db->where($where);
		$this->db->where('restro_city_area.location_id = restro_working_hour.location_id');
		$this->db->where('restro_city_area.location_id = restro_services_commission.location_id');
		$this->db->where('restro_city_area.location_id = restro_payments_method.location_id');
		$this->db->group_by("restro_info.id");  
		$this->db->order_by("restro_info.id", "desc"); 
        return $query = $this->db->get()->result();
         //$this->db->get();
         //echo  $this->db->last_query();
    }

    public function catering_all_restro_by_cuisine2($id){
		$service_id = $_SESSION['filter_service'];
		$area = $_SESSION['filter_city'];

		$arr = explode('-',$id);
		$this->db->select('restro_info.*,restro_working_hour.min_order as RestroMin,restro_working_hour.monday_from,restro_working_hour.friday_to,restro_working_hour.saturday_from,restro_working_hour.sunday_to');
        $this->db->from('restro_info');
		$this->db->join('restro_services_commission', 'restro_info.id = restro_services_commission.restro_id');
		$this->db->join('restro_working_hour', 'restro_info.id = restro_working_hour.restro_id');
		$this->db->join('restro_tables', 'restro_info.id = restro_tables.restro_id');
		$this->db->join('restro_cuisine_ids', 'restro_info.id = restro_cuisine_ids.restro_id'); 
		$this->db->join('restro_location', 'restro_location.id = restro_services_commission.location_id and restro_location.id = restro_working_hour.location_id and restro_location.restro_id = restro_info.id');
		$this->db->where('restro_info.status !=',0);
		$this->db->where('restro_info.trash',0);
		$this->db->where('restro_working_hour.service_id',$service_id); 
		$this->db->where('restro_services_commission.service_type',$service_id);
		if($area != '')
		{
			$this->db->where('restro_location.area',$area);
		}
		
		$this->db->where_in('restro_cuisine_ids.cuisine_id', $arr);
		$this->db->group_by("restro_info.id");  
		$this->db->order_by("restro_info.id", "desc"); 
        return $query = $this->db->get()->result();
    }

    public function view_restro_details($id){
    	
		$service_id = $_SESSION['filter_service'];
		$this->db->select('restro_info.*,restro_working_hour.min_order as RestroMin');
        $this->db->from('restro_info');
		$this->db->join('restro_services_commission', 'restro_info.id = restro_services_commission.restro_id');
		$this->db->join('restro_working_hour', 'restro_info.id = restro_working_hour.restro_id');
		$this->db->where('restro_info.status !=',0);
		$this->db->where('restro_working_hour.service_id',$service_id); 
		$this->db->where('restro_services_commission.service_type',$service_id);
		$this->db->where('restro_info.id',$id);
		$this->db->group_by("restro_info.id");  
		$this->db->order_by("restro_info.id", "desc"); 
        return $query = $this->db->get()->result();
    } 
    

   public function view_pickup_restro_details($id){
    	$area = $_SESSION['filter_city'];
		$service_id = $_SESSION['filter_service'];
		$this->db->select('restro_info.*,restro_working_hour.min_order as RestroMin,restro_working_hour.order_days,restro_working_hour.order_hour,restro_working_hour.order_minitue,restro_working_hour.order_second,restro_payments_method.method_type');
        $this->db->from('restro_info');
		$this->db->join('restro_services_commission', 'restro_info.id = restro_services_commission.restro_id');
		$this->db->join('restro_working_hour', 'restro_info.id = restro_working_hour.restro_id');
		$this->db->join('restro_payments_method', 'restro_info.id = restro_payments_method.restro_id');
		$this->db->join('restro_location', 'restro_location.id = restro_services_commission.location_id and restro_location.id = restro_working_hour.location_id and restro_location.id = restro_payments_method.location_id and restro_location.restro_id = restro_info.id');
		$this->db->where('restro_info.status !=',0);
		$this->db->where('restro_info.trash',0);
		$this->db->where('restro_working_hour.service_id',$service_id); 
		$this->db->where('restro_services_commission.service_type',$service_id);
		$this->db->where('restro_payments_method.service_type',$service_id);
		$this->db->where('restro_location.area',$area);
		$this->db->where('restro_info.id',$id);
		$this->db->group_by("restro_info.id");  
		$this->db->order_by("restro_info.id", "desc"); 
        return $query = $this->db->get()->result();
    }

    public function restro_table_checkout_details($id){
    	$area = $_SESSION['filter_city'];
		$service_id = $_SESSION['filter_service'];
		$this->db->select('restro_info.*,restro_working_hour.min_order as RestroMin,restro_working_hour.monday_from,restro_working_hour.friday_to,restro_working_hour.sunday_to,restro_working_hour.saturday_from,restro_working_hour.happy_from,restro_working_hour.happy_to');
        $this->db->from('restro_info');
		$this->db->join('restro_services_commission', 'restro_info.id = restro_services_commission.restro_id');
		$this->db->join('restro_working_hour', 'restro_info.id = restro_working_hour.restro_id');
		$this->db->join('restro_location', 'restro_location.id = restro_services_commission.location_id and restro_location.id = restro_working_hour.location_id and restro_location.restro_id = restro_info.id');
		$this->db->where('restro_info.status !=',0);
		$this->db->where('restro_info.trash',0);
		$this->db->where('restro_working_hour.service_id',$service_id); 
		$this->db->where('restro_services_commission.service_type',$service_id);
		$this->db->where('restro_location.area',$area);
		$this->db->where('restro_info.id',$id);
		$this->db->group_by("restro_info.id");  
		$this->db->order_by("restro_info.id", "desc"); 
        return $query = $this->db->get()->row_array();
    }
    
    public function view_delivery_restro_details($id){
    	
		//$area = $_SESSION['filter_city'];
		$service_id = $_SESSION['filter_service'];
		
		//$where = "FIND_IN_SET('".$area."', restro_city_area.area)";
		$this->db->select('restro_info.*,restro_working_hour.min_order as RestroMin,restro_working_hour.order_days,restro_working_hour.order_hour,restro_working_hour.order_minitue,restro_working_hour.order_second,restro_payments_method.method_type');
        $this->db->from('restro_info');
		$this->db->join('restro_services_commission', 'restro_info.id = restro_services_commission.restro_id');
		$this->db->join('restro_city_area', 'restro_info.id = restro_city_area.restro_id');
		$this->db->join('restro_working_hour', 'restro_info.id = restro_working_hour.restro_id');
		$this->db->join('restro_payments_method', 'restro_info.id = restro_payments_method.restro_id');
		$this->db->where('restro_info.status !=',0);
		$this->db->where('restro_working_hour.service_id',$service_id); 
		$this->db->where('restro_services_commission.service_type',$service_id);
		$this->db->where('restro_city_area.service_id',$service_id);
		$this->db->where('restro_payments_method.service_type',$service_id);
		$this->db->where('restro_info.id',$id);
		//$this->db->where($where);
		$this->db->where('restro_city_area.location_id = restro_working_hour.location_id');
		$this->db->where('restro_city_area.location_id = restro_services_commission.location_id');
		$this->db->where('restro_city_area.location_id = restro_payments_method.location_id');
		$this->db->group_by("restro_info.id");  
		$this->db->order_by("restro_info.id", "desc"); 
        return $query = $this->db->get()->result();
        //$this->db->get();
        //echo $this->db->last_query();
    }

    public function view_catering_restro_details($id){
    	
		//$area = $_SESSION['filter_city'];
		$service_id = $_SESSION['filter_service'];
		
		//$where = "FIND_IN_SET('".$area."', restro_city_area.area)";
		$this->db->select('restro_info.*,restro_working_hour.min_order as RestroMin,restro_working_hour.order_days,restro_working_hour.order_hour,restro_working_hour.order_minitue,restro_working_hour.order_second,restro_payments_method.method_type');
        $this->db->from('restro_info');
		$this->db->join('restro_services_commission', 'restro_info.id = restro_services_commission.restro_id');
		$this->db->join('restro_city_area', 'restro_info.id = restro_city_area.restro_id');
		$this->db->join('restro_working_hour', 'restro_info.id = restro_working_hour.restro_id');
		$this->db->join('restro_payments_method', 'restro_info.id = restro_payments_method.restro_id');
		$this->db->join('restro_location', 'restro_location.id = restro_city_area.location_id');
		$this->db->where('restro_info.status !=',0);
		$this->db->where('restro_info.trash',0);
		$this->db->where('restro_working_hour.service_id',$service_id); 
		$this->db->where('restro_services_commission.service_type',$service_id);
		$this->db->where('restro_city_area.service_id',$service_id);
		$this->db->where('restro_payments_method.service_type',$service_id);
		$this->db->where('restro_info.id',$id);
		//$this->db->where($where);
		$this->db->where('restro_city_area.location_id = restro_working_hour.location_id');
		$this->db->where('restro_city_area.location_id = restro_services_commission.location_id');
		$this->db->where('restro_city_area.location_id = restro_payments_method.location_id');
		$this->db->group_by("restro_info.id");  
		$this->db->order_by("restro_info.id", "desc"); 
        return $query = $this->db->get()->result();
    }
    public function restro_item_list($id){

    	$service_id = $_SESSION['filter_service'];

    	$this->db->select('tbl_item.*');
    	$this->db->from('tbl_item'); 
    	$this->db->join('resto_items_category_list', 'tbl_item.id = resto_items_category_list.item_id');
		$this->db->join('tbl_restro_menu', 'resto_items_category_list.category_id = tbl_restro_menu.category_id');
		$this->db->join('users','users.id = tbl_item.user_id');
		$this->db->join('restro_info','restro_info.user_id = users.id');
    	$this->db->where('restro_info.id',$id);
    	$this->db->where('tbl_restro_menu.service_id',$service_id);
    	$this->db->group_by("tbl_item.id");  
		$this->db->order_by("tbl_item.id", "desc");
    	return $query = $this->db->get()->result();
    	//$this->db->get();
    	//echo $this->db->last_query();
    }
    public function restro_item_cat_Name($id){
    	$this->db->select('cat_name');
    	$this->db->where('id',$id);
		$query = $this->db->get("tbl_item_category");
		return $query = $query->row_array();
    }
    public function ajax_show_item_by_cat($restrouserid,$item_cat){
    	$this->db->select('a.*');
    	//$this->db->where('user_id',$restrouserid);
    	$this->db->from('tbl_item a');
    	$this->db->join('resto_items_category_list b', 'a.id = b.item_id');
    	$this->db->where('b.category_id',$item_cat);
    	return $query = $this->db->get()->result();

    }

    public function add_contact($contactInfo){

		$this->db->insert('contact',$contactInfo);
	} 
	public function add_career($carrer){

		$this->db->insert('career',$carrer);
	}
	public function all_restro_by_city($area,$service_id){
		$where = "FIND_IN_SET('".$area."', restro_city_area.area)";
		$this->db->select('restro_info.*,restro_working_hour.min_order as RestroMin,restro_working_hour.order_days,restro_working_hour.order_hour,restro_working_hour.order_minitue,restro_working_hour.order_second,restro_payments_method.method_type,restro_working_hour.service_id,restro_working_hour.location_id');
        $this->db->from('restro_info');
		$this->db->join('restro_services_commission', 'restro_info.id = restro_services_commission.restro_id');
		$this->db->join('restro_city_area', 'restro_info.id = restro_city_area.restro_id');
		$this->db->join('restro_working_hour', 'restro_info.id = restro_working_hour.restro_id and restro_city_area.location_id = restro_working_hour.location_id');
		$this->db->join('restro_payments_method', 'restro_info.id = restro_payments_method.restro_id and restro_city_area.location_id = restro_payments_method.location_id');
		$this->db->join('restro_location', 'restro_location.id = restro_city_area.location_id');
		$this->db->where('restro_info.status !=',0);
		$this->db->where('restro_info.trash',0);
		$this->db->where('restro_working_hour.service_id',$service_id); 
		$this->db->where('restro_services_commission.service_type',$service_id);
		$this->db->where('restro_city_area.service_id',$service_id);
		$this->db->where('restro_payments_method.service_type',$service_id);
		$this->db->where($where);
		$this->db->where('restro_city_area.location_id = restro_services_commission.location_id');
		$this->db->group_by("restro_info.id");  
		$this->db->order_by("restro_info.id", "desc"); 
        return $query = $this->db->get()->result();
        //$query = $this->db->get();
        //echo $query = $this->db->last_query();
	}

	public function all_restro_by_filter($service_id){
		$this->db->select('restro_info.*,restro_working_hour.min_order as RestroMin,restro_working_hour.order_days,restro_working_hour.order_hour,restro_working_hour.order_minitue,restro_working_hour.order_second,restro_payments_method.method_type,restro_working_hour.service_id,restro_working_hour.location_id');
        $this->db->from('restro_info');
		$this->db->join('restro_services_commission', 'restro_info.id = restro_services_commission.restro_id');
		$this->db->join('restro_city_area', 'restro_info.id = restro_city_area.restro_id');
		$this->db->join('restro_working_hour', 'restro_info.id = restro_working_hour.restro_id and restro_city_area.location_id = restro_working_hour.location_id');
		$this->db->join('restro_payments_method', 'restro_info.id = restro_payments_method.restro_id and restro_city_area.location_id = restro_payments_method.location_id');
		$this->db->join('restro_location', 'restro_location.id = restro_city_area.location_id');
		$this->db->where('restro_info.status !=',0);
		$this->db->where('restro_info.trash',0);
		$this->db->where('restro_working_hour.service_id',$service_id); 
		$this->db->where('restro_services_commission.service_type',$service_id);
		$this->db->where('restro_city_area.service_id',$service_id);
		$this->db->where('restro_payments_method.service_type',$service_id);
		$this->db->where('restro_city_area.location_id = restro_services_commission.location_id');
		$this->db->group_by("restro_info.id");  
		$this->db->order_by("restro_info.id", "desc"); 
        return $query = $this->db->get()->result();
        //$query = $this->db->get();
        //echo $query = $this->db->last_query();
	}


	public function all_restro_by_location_city($area,$service_id){
		$this->db->select('restro_info.*,restro_working_hour.min_order as RestroMin,restro_working_hour.order_days,restro_working_hour.order_hour,restro_working_hour.order_minitue,restro_working_hour.order_second,restro_payments_method.method_type,restro_working_hour.service_id,restro_working_hour.location_id');
        $this->db->from('restro_info');
		$this->db->join('restro_services_commission', 'restro_info.id = restro_services_commission.restro_id');
		$this->db->join('restro_working_hour', 'restro_info.id = restro_working_hour.restro_id');
		$this->db->join('restro_payments_method', 'restro_info.id = restro_payments_method.restro_id');
		$this->db->join('restro_location', 'restro_location.id = restro_working_hour.location_id and restro_location.id = restro_payments_method.location_id and restro_location.id = restro_services_commission.location_id and restro_location.restro_id = restro_info.id');
		$this->db->where('restro_info.status !=',0);
		$this->db->where('restro_info.trash',0);
		$this->db->where('restro_working_hour.service_id',$service_id); 
		$this->db->where('restro_services_commission.service_type',$service_id);
		$this->db->where('restro_payments_method.service_type',$service_id);
		$this->db->where('restro_location.area',$area);
		$this->db->group_by("restro_info.id");  
		$this->db->order_by("restro_info.id", "desc"); 
        return $query = $this->db->get()->result();
        //$query = $this->db->get();
        //echo $query = $this->db->last_query();
	}

	public function all_tables_by_location_city($area,$service_id){
		$this->db->select('restro_info.*,restro_working_hour.min_order as RestroMin,restro_working_hour.monday_from,restro_working_hour.friday_to,restro_working_hour.saturday_from,restro_working_hour.sunday_to');
        $this->db->from('restro_info');
		$this->db->join('restro_services_commission', 'restro_info.id = restro_services_commission.restro_id');
		$this->db->join('restro_working_hour', 'restro_info.id = restro_working_hour.restro_id');
		$this->db->join('restro_tables', 'restro_info.id = restro_tables.restro_id');
		$this->db->join('restro_location', 'restro_location.id = restro_working_hour.location_id and restro_location.id = restro_services_commission.location_id and restro_location.restro_id = restro_info.id');
		$this->db->where('restro_info.status !=',0);
		$this->db->where('restro_info.trash',0);
		$this->db->where('restro_working_hour.service_id',$service_id); 
		$this->db->where('restro_services_commission.service_type',$service_id);
		$this->db->where('restro_location.area',$area);
		$this->db->group_by("restro_info.id");  
		$this->db->order_by("restro_info.id", "desc"); 
        return $query = $this->db->get()->result();
        //$query = $this->db->get();
        //echo $query = $this->db->last_query();
	}

	public function restro_item_details($userid,$item_id){
		$this->db->select('*');
    	$this->db->where('user_id',$userid);
    	$this->db->where('id',$item_id);
		$query = $this->db->get("tbl_item");
		
		return $query = $query->result();
	}
	public function insert_cart($CartArray){
		$this->db->insert('restro_cart',$CartArray);
	}
	public function view_my_cart($user_id){
			$this->db->select('*');
	    	$this->db->where('user_id',$user_id);
	    	$query = $this->db->get("restro_cart");
			
			return $query = $query->result();
	}
	public function get_item_name($id){
		$this->db->select('item_name');
    	$this->db->where('id',$id);
    	$query = $this->db->get("tbl_item");
		
		return $query = $query->row_array();
	}
	public function get_item_image($id){
		$this->db->select('image');
    	$this->db->where('id',$id);
    	$query = $this->db->get("tbl_item");
		
		return $query = $query->row_array();
	}
	public function ajax_cart_item_remove($id){
		$this->db->delete('restro_cart', array('id' => $id)); 
	}
	public function add_order($orderData){
		$this->db->insert('restro_order',$orderData);

		 $insert_id = $this->db->insert_id();

   		return  $insert_id;
	}

	public function add_order_details($data){
		$this->db->insert('restro_order_details',$data);
	}

	public function empty_my_cart($user_id){
		$this->db->delete('restro_cart', array('user_id' => $user_id));
	}
	public function orderNo_update($data,$getId){
		$this->db->where('id', $getId);
		$this->db->update('restro_order', $data); 
	}
	public function all_restro_table($service_id,$searchtxt){
		$area = $_SESSION['filter_city'];
		$this->db->select('restro_info.*,restro_working_hour.min_order as RestroMin,restro_working_hour.monday_from,restro_working_hour.friday_to,restro_working_hour.saturday_from,restro_working_hour.sunday_to');
        $this->db->from('restro_info');
		$this->db->join('restro_services_commission', 'restro_info.id = restro_services_commission.restro_id');
		$this->db->join('restro_working_hour', 'restro_info.id = restro_working_hour.restro_id');
		$this->db->join('restro_tables', 'restro_info.id = restro_tables.restro_id');
		$this->db->join('restro_cuisine_ids', 'restro_info.id = restro_cuisine_ids.restro_id');
		$this->db->join('restro_cuisine', 'restro_cuisine_ids.cuisine_id = restro_cuisine.id');
		$this->db->join('food_type_restro_list', 'restro_info.id = food_type_restro_list.restro_id');
		$this->db->join('restro_food_type', 'food_type_restro_list.food_type_id = restro_food_type.id');
		$this->db->join('restro_location', 'restro_location.id = restro_services_commission.location_id and restro_location.id = restro_working_hour.location_id and restro_location.restro_id = restro_info.id');
		$this->db->where('restro_info.status !=',0);
		$this->db->where('restro_info.trash',0);
		$this->db->where('restro_working_hour.service_id',$service_id); 
		$this->db->where('restro_services_commission.service_type',$service_id);
		$this->db->where('restro_location.area',$area);
		$this->db->where("(restro_cuisine.name LIKE '%$searchtxt%' or restro_info.restro_name LIKE '%$searchtxt%'  or restro_food_type.food_title LIKE '%$searchtxt%')");
		$this->db->group_by("restro_info.id");  
		$this->db->order_by("restro_info.id", "desc");
        return $query = $this->db->get()->result();
        //$query = $this->db->get();
        //echo $query = $this->db->last_query();
	}

	public function restro_table_list($id){
		$area = $_SESSION['filter_city'];
		$this->db->select('restro_tables.*');
		$this->db->from("restro_tables");
		$this->db->join("restro_location","restro_location.id = restro_tables.location_id");
    	$this->db->where('restro_tables.restro_id',$id);
    	$this->db->where('restro_tables.status !=',0);
    	$this->db->where('restro_location.area',$area);
    	$this->db->group_by('restro_tables.id');
    	$query = $this->db->get();
    	return $query = $query->result();
	}

	public function get_tableBookedOrNot($tid,$date,$rid){
		$this->db->select('id');
    	$this->db->where('restro_id',$rid);
    	$this->db->where('table_id',$tid);
    	$this->db->where('booking_date',$date);
    	$query = $this->db->get("restro_booked_table");
    	return $query->num_rows();
	}

	public function restro_table_details($rid,$tid){
		$this->db->select('*');
    	$this->db->where('restro_id',$rid);
    	$this->db->where('id',$tid);
    	$query = $this->db->get("restro_tables");
    	return $query = $query->result();
	}
	public function insert_table_cart($data){
		$this->db->insert('restro_table_cart',$data);
	}

	public function view_my_table_cart($user_id){
			$this->db->select('*');
	    	$this->db->where('user_id',$user_id);
	    	$query = $this->db->get("restro_table_cart");
			
			return $query = $query->result();
	}
	public function add_table_order($data){
		$this->db->insert('restro_table_order',$data);

		$insert_id = $this->db->insert_id();

   		return  $insert_id;
	}
	public function empty_my_table_cart($user_id){
		$this->db->delete('restro_table_cart', array('user_id' => $user_id));
	}

	public function get_tableData($tid){
			$this->db->select('*');
	    	$this->db->where('id',$tid);
	    	$query = $this->db->get("restro_tables");
			return $query = $query->row_array();
	}
	public function ajax_cart_table_remove($id){
		$this->db->delete('restro_table_cart', array('id' => $id)); 
	}

	public function add_table_order_data($data){
		$this->db->insert('restro_booked_table',$data);
	}
	public function orderNo_update_reservation($data,$getId){
		$this->db->where('id', $getId);
		$this->db->update('restro_table_order', $data); 
	}
	public function getRestroAllImages($id){
			$this->db->select('restro_images');
	    	$this->db->where('restro_id',$id);
	    	$this->db->order_by("id", "desc"); 
	    	$this->db->limit(4);
	    	$query = $this->db->get("restro_images");
	    	return $query = $query->result();
	}
	public function all_restro_pickup($service_id,$searchtxt,$city_id){
		$this->db->select('restro_info.*,restro_working_hour.min_order as RestroMin,restro_working_hour.order_days,restro_working_hour.order_hour,restro_working_hour.order_minitue,restro_working_hour.order_second,restro_payments_method.method_type');
        $this->db->from('restro_info');
		$this->db->join('restro_services_commission', 'restro_info.id = restro_services_commission.restro_id');
		$this->db->join('restro_working_hour', 'restro_info.id = restro_working_hour.restro_id');
		$this->db->join('restro_cuisine_ids', 'restro_info.id = restro_cuisine_ids.restro_id');
		$this->db->join('restro_cuisine', 'restro_cuisine_ids.cuisine_id = restro_cuisine.id');
		$this->db->join('food_type_restro_list', 'restro_info.id = food_type_restro_list.restro_id');
		$this->db->join('restro_food_type', 'food_type_restro_list.food_type_id = restro_food_type.id');
		$this->db->join('restro_payments_method', 'restro_info.id = restro_payments_method.restro_id');
		$this->db->join('restro_location', 'restro_location.id = restro_working_hour.location_id and restro_location.id = restro_payments_method.location_id and restro_location.restro_id = restro_info.id');
		$this->db->where('restro_info.status !=',0);
		$this->db->where('restro_info.trash',0);
		$this->db->where('restro_working_hour.service_id',$service_id); 
		$this->db->where('restro_services_commission.service_type',$service_id);
		$this->db->where('restro_payments_method.service_type',$service_id);
		$this->db->where('restro_location.area',$city_id);
		$this->db->where("(restro_cuisine.name LIKE '%$searchtxt%' or restro_info.restro_name LIKE '%$searchtxt%'  or restro_food_type.food_title LIKE '%$searchtxt%')");
		$this->db->group_by("restro_info.id");  
		$this->db->order_by("restro_info.id", "desc"); 
        return $query = $this->db->get()->result();
	}


	public function insert_picup_cart($CartArray){
		$this->db->insert('restro_pickup_cart',$CartArray);
	}

	public function view_my_pickup_cart($user_id){
		$this->db->select('*');
    	$this->db->where('user_id',$user_id);
    	$query = $this->db->get("restro_pickup_cart");
		
		return $query = $query->result();
	}

	public function ajax_cart_pickup_remove($id){
		$this->db->delete('restro_pickup_cart', array('id' => $id)); 
	}

	public function add_pickup_order($orderData){
		$this->db->insert('restro_pickup_order',$orderData);

		 $insert_id = $this->db->insert_id();

   		return  $insert_id;
	}
	public function orderNo_update_pickup($data,$getId){
		$this->db->where('id', $getId);
		$this->db->update('restro_pickup_order', $data); 
	}

	public function add_order_details_pickup($data){
		$this->db->insert('restro_pickup_order_details',$data);
	}

	public function empty_my_cart_pickup($user_id){
		$this->db->delete('restro_pickup_cart', array('user_id' => $user_id));
	}

	public function get_customer_address_data($user_id){
			$this->db->select('*');
	    	$this->db->where('user_id',$user_id);
	    	$query = $this->db->get("restro_customer_address");
	    	return $query = $query->result();
	}

	public function ajaxaddressFetch_checkout($user_id,$address_id){
			$this->db->select('*');
	    	$this->db->where('user_id',$user_id);
	    	$this->db->where('id',$address_id);
	    	$query = $this->db->get("restro_customer_address");
	    	return $query = $query->result();

	}
	public function view_restro_cat_filter($restro_id){
			$service_id = $_SESSION['filter_service'];

			$this->db->select('tbl_restro_menu.*');
			$this->db->from('tbl_restro_menu');
			$this->db->join('restro_info','tbl_restro_menu.user_id = restro_info.user_id');
			$this->db->join('tbl_item_category','tbl_item_category.id = tbl_restro_menu.category_id');
	    	$this->db->where('restro_info.id',$restro_id);
	    	$this->db->where('tbl_restro_menu.service_id',$service_id);
	    	$this->db->group_by('tbl_restro_menu.category_id');
	    	$query = $this->db->get();
	    	return $query = $query->result();
	}
	public function getRestroUserId($restro_id){
			$this->db->select('user_id');
	    	$this->db->where('id',$restro_id);
	    	$query = $this->db->get("restro_info");
	    	$query = $query->row_array();
	    	return $query['user_id'];
	}

	//all catering functions start here

	public function all_restro_catering($service_id,$searchtxt,$cityid){

	
		$where = "FIND_IN_SET('".$cityid."', restro_city_area.area)";
        $this->db->select('restro_info.*,restro_working_hour.min_order as RestroMin,restro_working_hour.location_id,restro_working_hour.order_days,restro_working_hour.order_hour,restro_working_hour.order_minitue,restro_working_hour.order_second,restro_payments_method.method_type');
        $this->db->from('restro_info');
		$this->db->join('restro_services_commission', 'restro_info.id = restro_services_commission.restro_id');
		$this->db->join('restro_working_hour', 'restro_info.id = restro_working_hour.restro_id');
		$this->db->join('restro_cuisine_ids', 'restro_info.id = restro_cuisine_ids.restro_id');
		$this->db->join('restro_cuisine', 'restro_cuisine_ids.cuisine_id = restro_cuisine.id');
		$this->db->join('food_type_restro_list', 'restro_info.id = food_type_restro_list.restro_id');
		$this->db->join('restro_food_type', 'food_type_restro_list.food_type_id = restro_food_type.id');
		$this->db->join('restro_city_area', 'restro_info.id = restro_city_area.restro_id');
		$this->db->join('restro_payments_method', 'restro_info.id = restro_payments_method.restro_id');
		$this->db->join('restro_location', 'restro_location.id = restro_city_area.location_id');
		$this->db->where('restro_info.status !=',0);
		$this->db->where('restro_info.trash',0);
		$this->db->where('restro_working_hour.service_id',$service_id); 
		$this->db->where('restro_services_commission.service_type',$service_id);
		$this->db->where('restro_city_area.service_id',$service_id);
		$this->db->where('restro_payments_method.service_type',$service_id);
		$this->db->where($where);
		$this->db->where('restro_city_area.location_id = restro_working_hour.location_id');
		$this->db->where('restro_city_area.location_id = restro_services_commission.location_id');
		$this->db->where('restro_city_area.location_id = restro_payments_method.location_id');
		if($searchtxt != '')
		{
			$this->db->where("(restro_cuisine.name LIKE '%$searchtxt%' or restro_info.restro_name LIKE '%$searchtxt%'  or restro_food_type.food_title LIKE '%$searchtxt%')");
		}
		
		$this->db->group_by("restro_info.id");  
		$this->db->order_by("restro_info.id", "desc"); 
		//$this->db->get();
		//echo $this->db->last_query();
		return $query = $this->db->get()->result();
	}

	public function insert_catering_cart($CartArray){
		$this->db->insert('restro_catering_cart',$CartArray);
	}
	public function view_my_catering_cart($user_id){
		$this->db->select('*');
    	$this->db->where('user_id',$user_id);
    	$query = $this->db->get("restro_catering_cart");
		
		return $query = $query->result();
	}

	public function add_catering_order($orderData){
		 $this->db->insert('restro_catering_order',$orderData);

		 $insert_id = $this->db->insert_id();

   		 return  $insert_id;
	}
	public function orderNo_update_catering($data,$getId){
		$this->db->where('id', $getId);
		$this->db->update('restro_catering_order', $data); 
	}
	public function add_order_details_catering($data){
		$this->db->insert('restro_catering_order_details',$data);
	}
	public function empty_my_cart_catering($user_id){
		$this->db->delete('restro_catering_cart', array('user_id' => $user_id));
	}
	//all catering functions end here

	public function getPaymentgatewaysByService($restro_id,$service_id){
		$this->db->select('method_type');
    	$this->db->where('restro_id',$restro_id);
    	$this->db->where('service_type',$service_id);
    	$query = $this->db->get("restro_payments_method");
		
		return $query = $query->row_array();
	}


	public function getItemVariation($itemid,$variation_type){

		$this->db->select('restro_item_variation.variation_name,restro_item_variation_data.*'); 
        $this->db->from('restro_item_variation');
		$this->db->join('restro_item_variation_data', 'restro_item_variation_data.variation_id = restro_item_variation.id');
    	$this->db->where('restro_item_variation.variation_type',$variation_type);
    	$this->db->where('restro_item_variation.item_id',$itemid);
    	$query = $this->db->get();

    	if($query->num_rows() > 0)
    	{
    		return $query->result();

    	}
	}

	public function ajax_item_variation_price($variation_id,$item_id){
		$this->db->select('price');
    	$this->db->where('id',$variation_id);
    	$this->db->where('item_id',$item_id);
    	$query = $this->db->get("restro_item_variation_data");
		$query = $query->result();
		foreach($query as $qu => $qr)
		{
			return $qr->price;
		}
	}

	public function getitemPoint($id){
		$this->db->select('loyalty_points,order_point_amount');
		$this->db->from('tbl_item'); 
		$this->db->where('id',$id);
        $query = $this->db->get();
        return $query = $query->row_array();
	}

	public function getDeliveryChargesbyrestrolocation($restro_id,$service_id,$location_id){
		$where = "FIND_IN_SET('".$location_id."',restro_city_area.area) and service_id = '".$service_id."'";

		$this->db->select('area,delivery_price');
		$this->db->from('restro_city_area'); 
		$this->db->where($where);
		$this->db->where('restro_id',$restro_id);  
		$this->db->group_by("id");  
		$this->db->order_by("id", "desc"); 
        $query = $this->db->get();
        //echo $this->db->last_query();
        if($query->num_rows() > 0)
        {
        	$query = $query->result();
        	foreach($query as $qr => $qm){
        				$ex_arr = explode(',',$qm->area); 
    					$exprice = explode(',',$qm->delivery_price); 
    
    
    					$indexId = array_search($location_id,$ex_arr);
  
    					return $myPrice =  $exprice[$indexId];
        				}
        }
        else
        {
        	return 0;
        }
        
	}

	public function getpickupChargesbyrestro($restro_id,$service_id){
		$area = $_SESSION['filter_city'];

		$this->db->select('restro_working_hour.delivery_charges');
		$this->db->from('restro_working_hour');
		$this->db->join('restro_info','restro_info.id = restro_working_hour.restro_id');
		$this->db->join('restro_location','restro_location.id = restro_working_hour.location_id'); 
		$this->db->where('restro_working_hour.restro_id',$restro_id);  
		$this->db->where('restro_working_hour.service_id',$service_id);
		$this->db->where('restro_location.restro_id',$restro_id);
		$this->db->where('restro_info.id',$restro_id); 
		$this->db->where('restro_location.area',$area);  
		$this->db->group_by("restro_working_hour.id");  
		$this->db->order_by("restro_working_hour.id", "desc"); 
        $query = $this->db->get();
        //echo $this->db->last_query();
        if($query->num_rows() > 0)
        {
        	$query = $query->result();
        	foreach($query as $qr => $qm){
        				return $qm->delivery_charges;
        				}
        }
        else
        {
        	return 0;
        }
        
	}

	    public function view_rating_restro_details($id){
    	
		
		$this->db->select('restro_info.*,restro_working_hour.min_order as RestroMin');
        $this->db->from('restro_info');
		$this->db->join('restro_services_commission', 'restro_info.id = restro_services_commission.restro_id');
		$this->db->join('restro_working_hour', 'restro_info.id = restro_working_hour.restro_id');
		$this->db->where('restro_info.status !=',0);
		$this->db->where('restro_info.id',$id);
		$this->db->group_by("restro_info.id");  
		$this->db->order_by("restro_info.id", "desc"); 
        return $query = $this->db->get()->result();
    } 
     public function view_rating_restro($id){
    	$this->db->select('*');
        $this->db->from('restro_rating');
		$this->db->where('restro_rating.restro_id',$id);
		return $query = $this->db->get()->result();
    } 

    public function find_cuisine_by_name($txt){
    	$this->db->select('id,name');
        $this->db->from('restro_cuisine');
		$this->db->like('name', $txt);
		return $query = $this->db->get()->result();
    }
    public function find_restaurant_by_name($txt){
    	$this->db->select('id,restro_name');
        $this->db->from('restro_info');
		$this->db->like('restro_name', $txt);
		return $query = $this->db->get()->result();
    }

    public function find_food_by_name($txt){
    	$this->db->select('id,food_title');
        $this->db->from('restro_food_type');
		$this->db->like('food_title', $txt);
		return $query = $this->db->get()->result();
    }

    public function search_area_by_name($txt){
    	$this->db->select('area.id,area.name,city.city_name');
        $this->db->from('area');
        $this->db->join('city','city.id = area.city_id');
		$this->db->like('name', $txt);
		$this->db->or_like('city_name', $txt);
		return $query = $this->db->get()->result();
    }

    

    public function search_restro_by_name($txt){
    	$this->db->select('id,status,restaurant_logo,restro_name');
        $this->db->from('restro_info');
        $this->db->where('status !=',0);
        $this->db->where('trash',0);
        $this->db->like('restro_name', $txt);
		return $query = $this->db->get()->result();
    }

    
    public function getrestroOrderLocationId($restro_id,$service_id,$area_id){

    	$where = "FIND_IN_SET('".$area_id."',restro_city_area.area) and restro_city_area.restro_id = '".$restro_id."'";

    	$this->db->select('restro_city_area.location_id');
        $this->db->from('restro_city_area');
        $this->db->join('restro_location','restro_location.id = restro_city_area.location_id');
        $this->db->where($where);
        $this->db->where('service_id',$service_id);
        $this->db->order_by('restro_city_area.id','DESC');
        return $query = $this->db->get()->row_array();
		//$this->db->get();
		//echo $this->db->last_query();
    }

    public function getrestroOrderLocationId2($restro_id,$service_id,$area_id){

    	$this->db->select('restro_working_hour.location_id');
        $this->db->from('restro_info'); 
        $this->db->join('restro_working_hour','restro_working_hour.restro_id = restro_info.id');
        $this->db->join('restro_services_commission','restro_services_commission.restro_id = restro_info.id');
        $this->db->join('restro_location','restro_location.id = restro_working_hour.location_id and restro_location.id = restro_services_commission.location_id');
        $this->db->where('restro_working_hour.service_id',$service_id);
        $this->db->where('restro_services_commission.service_type',$service_id);
        $this->db->where('restro_location.area',$area_id);
        $this->db->where('restro_info.id',$restro_id);
        $this->db->order_by('restro_info.id','DESC');
        return $query = $this->db->get()->row_array();
		//$this->db->get();
		//echo $this->db->last_query();
    }

    public function front_restro_count_by_type($type){
    	$this->db->select('id');
        $this->db->from('restro_info');
        $this->db->where('restro_status', $type);
		$query = $this->db->get();
		return $query->num_rows();
    }

    public function chkTableBooedOnTime($restro_id,$table_id,$res_date,$from_time,$to_time){
    	$this->db->select('*');
        $this->db->from('restro_booked_table');
        $this->db->where('restro_id', $restro_id);
        $this->db->where('table_id', $table_id);
        $this->db->where('status', 1);
        $this->db->where('booking_date', $res_date);
        $this->db->where('booking_time >=', $from_time);
		$this->db->where('booking_time <=', $to_time);
		$query = $this->db->get();
		return $query->num_rows();
    }

    public function getLocationAll_Details($restro_id,$location_id){
    	$this->db->select('restro_location.location_name,restro_location.telephones,restro_location.street,restro_location.block,restro_location.telephones2,restro_location.telephones3,area.name,city.city_name');
        $this->db->from('restro_location');
        $this->db->join('area','restro_location.area = area.id');
        $this->db->join('city','restro_location.city = city.id');
        $this->db->where('restro_location.id', $location_id);
        $this->db->where('restro_location.restro_id', $restro_id);
        $this->db->group_by('restro_location.id');
		$query = $this->db->get();
		return $query->row_array();
    }
    
    
    public function all_restro_coupons(){
		
		
	$this->db->select('*');
	$this->db->from('restro_coupons');
	//$this->db->join('restro_coupons','restro_location.id = restro_coupons.location_id');
                
		
        return $query = $this->db->get()->result();
        //$this->db->get();
        //echo $this->db->last_query();
	}

    
    
    

    public function add_payment($data){
		 $this->db->insert('tbl_payment_transactions',$data);
		 return  true;
	}

	public function delivery_order_update($data,$getId){
		$this->db->where('id', $getId);
		$this->db->update('restro_order', $data); 
	}

	public function pickup_order_update($data,$getId){
		$this->db->where('id', $getId);
		$this->db->update('restro_pickup_order', $data); 
	}
	
	public function catering_order_update($data,$getId){
		$this->db->where('id', $getId);
		$this->db->update('restro_catering_order', $data); 
	}

	public function check_order_payment($id,$type){
		$this->db->select('*');
		$this->db->where('order_id', $id);
		$this->db->where('order_type', $type);
		$this->db->from('tbl_payment_transactions');
		$query = $this->db->get(); 
		return $query->num_rows();
	}
	
	public function restro_service_list($id){
		$this->db->select('*');
		$this->db->where('restro_id', $id);
		//$this->db->where('order_type', $type);
		$this->db->from('restro_services_commission');

		//$query = $this->db->get(); 
		return $query = $this->db->get()->result();
	}
	public function restro_cuisin_list($id){
		$this->db->select('*');
		$this->db->where('restro_id', $id);
		//$this->db->where('order_type', $type);
		$this->db->from('restro_cuisine_ids');

		//$query = $this->db->get(); 
		return $query = $this->db->get()->result();
	}
	
	public function getCuisineRES($id){
		$this->db->select('name');
		
		$this->db->where('id', $id);
		//$this->db->where('order_type', $type);
		$this->db->from('restro_cuisine');
			$query = $this->db->get();
			return $query->row_array();
	}
	
	public function restro_registrotion($restroREG){

		$this->db->insert('restro_registration',$restroREG);
	} 
	
	
	
	

    
    
}

?>