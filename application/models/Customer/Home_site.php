<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home_site extends CI_Model
{


	function __construct()
	{
		parent::__construct();

		$this->load->library('tank_auth');
		$this->lang->load('tank_auth');

	}

	public function fetch_all_country(){

        $this->db->select('*');
        $query = $this->db->get('country');
        return $query = $query->result();
	}

	public function fetch_all_state_bt_country($country_id){
		$this->db->select('*');
		$this->db->where('country_id',$country_id);
        $query = $this->db->get('state');
        return $query = $query->result();

	}

	
	public function fetch_all_city_by_state($state_id){
		$this->db->select('*');
		$this->db->where('state_id',$state_id);
        $query = $this->db->get('city');
        return $query = $query->result();

	}

	public function show_all_city(){
		$this->db->select('a.*,b.city_name');
		$this->db->from('area a'); 
        $this->db->join('city b', 'b.id=a.city_id', 'left');
        $query = $this->db->get();
        return $query = $query->result();
	}
	
	public function show_customer_city(){
		$this->db->select('*');
		$this->db->from('city'); 
        
        $query = $this->db->get();
        return $query = $query->result();
	}
	
	public function show_customer_area(){
		$this->db->select('*');
		$this->db->from('area'); 
        
        $query = $this->db->get();
        return $query = $query->result();
	}
	
	

	
}