<?php
class Model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function getCountry(){
		$this->db->select('id,country_name');
		$this->db->from('country');
		$this->db->order_by('country_name', 'asc'); 
		$query=$this->db->get();
		return $query; 
	}
	
	function getData($loadType,$loadId){
		if($loadType=="state"){
			$fieldList='id,state_name as name';
			$table='state';
			$fieldName='country_id';
			$orderByField='state_name';						
		}else{
			$fieldList='id,city_name as name';
			$table='city';
			$fieldName='state_id';
			$orderByField='city_name';	
		}
		
		$this->db->select($fieldList);
		$this->db->from($table);
		$this->db->where($fieldName, $loadId);
		$this->db->order_by($orderByField, 'asc');
		$query=$this->db->get();
		return $query; 
	}
}
?>