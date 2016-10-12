<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Site extends CI_Controller
{

	function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		        $this->load->helper('security');
		$this->load->library('tank_auth');
		$this->lang->load('tank_auth');
		
		$this->load->model("Customer/Home_site");
	}

	function show_state(){
		$data['errors']=array();

		$country_id =$this->uri->segment('2');

		$data['state'] = $this->Home_site->fetch_all_state_bt_country($country_id);
		
		$this->load->view("ajax_state_fetch",$data);
	}
	function show_city(){
		$data['errors']=array();

		$state_id = $this->uri->segment('2');

		$data['city'] = $this->Home_site->fetch_all_city_by_state($state_id);
		
		$this->load->view("ajax_city_fetch",$data);
	}

}