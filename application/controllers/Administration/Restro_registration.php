<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}
@ob_start();
class Restro_registration extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		//$this->load->library('security');
		$this->load->helper('security');
		$this->load->helper('restaurant_helper');
		$this->load->library('tank_auth');
		$this->lang->load('tank_auth');
		$this->load->model("Administration/Restaurant_management");
		$this->load->model("Administration/Plan_management");
		$this->load->model("Administration/Area_management");
		$this->load->model('Administration/Smtp_management');
		$this->load->model('Administration/Customer_management');
		$this->load->model('Administration/Restro_register');
		$this->load->model("Customer/Home_Restro");
		$this->load->model("Customer/Home_site");
		$this->load->library('email');
		//$this->load->model('Model');
	}
///////////////////////////////////////////////////////////////////////
	public function restro_register() {
		$data['errors'] = array();
		$data['restro_register_list'] = $this->Restro_register->restro_registration_list();
		$this->load->view("Administration/restro_register", $data);
	}public function add_restro_register() {
		$data['errors'] = array();
		$data['restro_register_list'] = $this->Restro_register->restro_registration_list();
		$this->load->view("Administration/restro_register", $data);
	}
	/*public function delete_restro_register()
	{
	$id=$this->input->post("cid");
	if($this->Restro_register->deleteRestro_registration($id))
	{
	echo "done";
	}
	}*/
	function edit_restro_register() {
		$data['errors'] = array();
		$id = $this->uri->segment(2);
		$data['edit_restro_reg'] = $this->Restro_register->edit_restro_registration($id);
		$data['cuisin_list'] = $this->Home_Restro->all_cuisin();
		$data['city'] = $this->Home_site->show_all_city();
		if (isset($_POST['edit_restro_reg'])) {
			$this->form_validation->set_rules('restro_name', 'Restro Name', 'required');
			$this->form_validation->set_rules('contact_name', 'Contact Name', 'required');
			$this->form_validation->set_rules('restro_phone', 'Restro Phone', 'required');
			$this->form_validation->set_rules('cell_phone', 'Cell Phone', 'required');
			$this->form_validation->set_rules('restro_address', 'Restro Address', 'required');
			$this->form_validation->set_rules('contact_email', 'Contact Email', 'required|valid_email');
			$this->form_validation->set_rules('restro_email', 'Restro Email', 'required|valid_email');
			$this->form_validation->set_rules('main_cuisine', 'Main_Cuisine', 'required');
			$this->form_validation->set_rules('secondary_cuisine', 'Secondary Cuisine', 'required');
			$this->form_validation->set_rules('about_us', 'About Us', 'required');
			$this->form_validation->set_rules('pickup_min_order', 'Min Order', 'required');
			$this->form_validation->set_rules('delivery_min_order', 'Min Order', 'required');
			$this->form_validation->set_rules('delivery_charge', 'Delivery Charge', 'required');
			$this->form_validation->set_rules('catering_min_order', 'Min Order', 'required');
			$this->form_validation->set_rules('menu_link', 'Menu Link', 'required');
			$this->form_validation->set_rules('message', 'Message', 'required');
			$this->form_validation->set_rules('time_from', 'From Time', 'required');
			$this->form_validation->set_rules('time_to', 'To Time', 'required');
			if ($this->form_validation->run() == FALSE) {
			} else {
				$restro_email = $this->input->post('restro_email');
				$restoREG['restro_name'] = $this->input->post('restro_name');
				$restoREG['contact_name'] = $this->input->post('contact_name');
				$restoREG['restro_phone'] = $this->input->post('restro_phone');
				$restoREG['cell_phone'] = $this->input->post('cell_phone');
				$restoREG['restro_address'] = $this->input->post('restro_address');
				$restoREG['contact_email'] = $this->input->post('contact_email');
				$restoREG['restro_email'] = $this->input->post('restro_email');
				$restoREG['main_cuisine'] = $this->input->post('main_cuisine');
				$restoREG['secondary_cuisine'] = $this->input->post('secondary_cuisine');
				$restoREG['about_us'] = $this->input->post('about_us');
				$restoREG['pickup_min_order'] = $this->input->post('pickup_min_order');
				$restoREG['delivery_min_order'] = $this->input->post('delivery_min_order');
				$restoREG['delivery_charge'] = $this->input->post('delivery_charge');
				$restoREG['catering_min_order'] = $this->input->post('catering_min_order');
				$restoREG['work_time'] = $this->input->post('work_time');
				$restoREG['menu_link'] = $this->input->post('menu_link');
				$restoREG['message'] = $this->input->post('message');
				$restoREG['time_from'] = $this->input->post('time_from');
				$restoREG['time_to'] = $this->input->post('time_to');
				$restoREG['services'] = $this->input->post('services');
				$cuid = $this->input->post('cuid');
				//$restoREG['reg_date']= date("Y-m-d");
				//$work=implode($this->input->post('work_time'),',');
				//$restoREG['work_time']=$work;
				//$a=implode($this->input->post('services'),',');
				//$restoREG['services']=  str_replace(",,",",",trim($a,","));
				$this->load->library('upload');
				$files = $_FILES['restro_logo'];
				if ($_FILES['restro_logo']['error'] != 0) {
					$data['image_errors'] = 'Couldn\'t upload the file(s)';
				}
				$config['upload_path'] = FCPATH . 'images/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$_FILES['restro_logo']['name'] = $files['name'];
				$_FILES['restro_logo']['type'] = $files['type'];
				$_FILES['restro_logo']['tmp_name'] = $files['tmp_name'];
				$_FILES['restro_logo']['error'] = $files['error'];
				$_FILES['restro_logo']['size'] = $files['size'];
				$this->upload->initialize($config);
				if ($this->upload->do_upload('restro_logo')) {
					$this->_uploaded = $this->upload->data();
					$restoREG['image'] = $this->_uploaded['full_path'];
				} else {
					$data['image_errors'] = $this->upload->display_errors();
				}
				//print_r($restoREG);die;
				$this->Restro_register->update_restro_registration($restoREG, $cuid);
				$this->session->set_flashdata('successMsg', '<span style="color:green">Thank You For Registration</span>');
				redirect("/restro_register/");
			}
		}
		$this->load->view('Administration/edit_restro_register', $data);
	}
	public function delete_restro_register($id) {
		$data['errors'] = array();
		$userId['id'] = $this->uri->segment(2);
		$this->Restro_register->delete_restro_registration($id, $userId);
		redirect('/restro_register/');
	}
}
?>