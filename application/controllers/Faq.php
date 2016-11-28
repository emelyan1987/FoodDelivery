<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

ob_start();
class Faq extends CI_Controller {
	function __construct() {
		parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->helper("customer_helper");
		$this->load->helper("restaurant_helper");

		$this->load->library('form_validation');
		//$this->load->library('security');
		$this->load->helper('security');
		$this->load->library('tank_auth');
		$this->lang->load('tank_auth');
		$this->load->model("Customer_management");
		$this->load->model("Faq_management");

		//$this->load->helper('phpass');
	}

	public function faq_home() {

		$data['errors'] = array();

		$data['faq_cat_list'] = $this->Faq_management->get();
		// print_r($data);die;
		$this->load->view("faq", $data);

	}
	public function get_faq_by_category() {
		$data['errors'] = array();
		$id = $this->input->post("id");
		$data['faq_list'] = $this->Faq_management->get_faq_by_id($id);
		$this->load->view("ajax_faq", $data);

	}

}