<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class MyCron_model extends CI_Model
{


	function __construct()
	{
		parent::__construct();

		
	}

	public function order_get_time($service)
	{	
		$this->db->select('restro_order.id,restro_order.delivery_time,restro_working_hour.order_days,restro_working_hour.order_hour,restro_working_hour.order_minitue');
		$this->db->from('restro_order');
		$this->db->join('restro_working_hour','restro_working_hour.location_id = restro_order.restro_location_id');
		$this->db->where('restro_order.status !=',3);
		$this->db->where('restro_working_hour.service_id',$service);
		return $this->db->get()->result();
	}

	public function order_delivery_time($newTime,$nowtime1,$nowtime2,$order_id)
	{

		$nowDate = date('Y-m-d');
		$data['status'] = 2;
		
		$where1 = "TIME_FORMAT(delivery_time, '%H:%i:%s') < '".$nowtime1."'";
		$where2 = "TIME_FORMAT(delivery_time, '%H:%i:%s') < '".$nowtime2."'";
		  


		  $data['status'] = 2;
		  $this->db->where('status',1);
		  $this->db->where('delivery_date',$nowDate);
		  $this->db->where($where1);
		  $this->db->where('id',$order_id);
		  $this->db->update('restro_order',$data);
		  
		  $data1['status'] = 3;
		  $this->db->where('status',2);
		  $this->db->where('delivery_date',$nowDate);
		  $this->db->where($where2);
		  $this->db->where('id',$order_id);
		  $this->db->update('restro_order',$data1);

		  

		  
	}


	public function order_get_time2($service)
	{	
		$this->db->select('restro_catering_order.id,restro_catering_order.time,restro_working_hour.order_days,restro_working_hour.order_hour,restro_working_hour.order_minitue');
		$this->db->from('restro_catering_order');
		$this->db->join('restro_working_hour','restro_working_hour.location_id = restro_catering_order.restro_location_id');
		$this->db->where('restro_catering_order.status !=',3);
		$this->db->where('restro_working_hour.service_id',$service);
		return $this->db->get()->result();
	}


	public function order_delivery_time2($newTime,$nowtime1,$nowtime2,$order_id)
	{

		$nowDate = date('Y-m-d');
		$data['status'] = 2;
		
		$where1 = "DATE_FORMAT(time, '%H:%i:%s') < '".$nowtime1."'";
		$where2 = "DATE_FORMAT(time, '%H:%i:%s') < '".$nowtime2."'";
		  


		  $data['status'] = 2;
		  $this->db->where('status',1);
		  $this->db->where('date',$nowDate);
		  $this->db->where($where1);
		  $this->db->where('id',$order_id);
		  $this->db->update('restro_catering_order',$data);


		  $data1['status'] = 3;
		  $this->db->where('status',2);
		  $this->db->where('date',$nowDate);
		  $this->db->where($where2);
		  $this->db->where('id',$order_id);
		  $this->db->update('restro_catering_order',$data1);

		  

		  
	}

	public function order_get_time3($service)
	{	
		$this->db->select('restro_pickup_order.id,restro_pickup_order.delivery_time,restro_working_hour.order_days,restro_working_hour.order_hour,restro_working_hour.order_minitue');
		$this->db->from('restro_pickup_order');
		$this->db->join('restro_working_hour','restro_working_hour.location_id = restro_pickup_order.restro_location_id');
		$this->db->where('restro_pickup_order.status !=',3);
		$this->db->where('restro_working_hour.service_id',$service);
		return $this->db->get()->result();
	}

	public function order_delivery_time3($newTime,$nowtime1,$nowtime2,$order_id)
	{

		$nowDate = date('Y-m-d');
		$data['status'] = 2;
		
		$where1 = "DATE_FORMAT(delivery_time, '%H:%i:%s') < '".$nowtime1."'";
		$where2 = "DATE_FORMAT(delivery_time, '%H:%i:%s') < '".$nowtime2."'";
		  


		  $data['status'] = 2;
		  $this->db->where('status',1);
		  $this->db->where('delivery_date',$nowDate);
		  $this->db->where($where1);
		  $this->db->where('id',$order_id);
		  $this->db->update(' restro_pickup_order',$data);


		  $data1['status'] = 3;
		  $this->db->where('status',2);
		  $this->db->where('delivery_date',$nowDate);
		  $this->db->where($where2);
		  $this->db->where('id',$order_id);
		  $this->db->update(' restro_pickup_order',$data1);

		  

		  
	}

	
}

?>

