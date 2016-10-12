<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
@ob_start();
class Contact_us extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		//$this->load->library('security');
		$this->load->helper('security');
		$this->load->helper('restaurant_helper');
		$this->load->library('tank_auth');
		$this->lang->load('tank_auth');
		$this->load->model("Administration/Notification_management");
		$this->load->model("Administration/Contact_us_management"); 
		$this->load->model("Restaurant_Owner/Restro_Owner_Model");
		
	}

	public function  careers_list()
	{
            $data['c_list']=$this->Contact_us_management->get_carreers_list();
           
            $this->load->view("Administration/carreer_list",$data);

	}
	public function  contact_us_list()
	{   
           
            $data['c_list']=$this->Contact_us_management->get_contact_us_list();
            $this->load->view("Administration/contact_us_list",$data);


	}
	public function  view_carrer()
	{   
            $id=$this->uri->segment(2);
            $data['c_view']=$this->Contact_us_management->get_view_carrer_by_id($id);
            $this->load->view("Administration/carrer_view",$data);


	}
	public function  view_contact()
	{   
            $id=$this->uri->segment(2);
            $data['c_view']=$this->Contact_us_management->get_contact_by_id($id);
            $this->load->view("Administration/contact_us_view",$data);


	}
	function  delete_contact()
	{
		$id=$this->input->post("v");
		$this->Contact_us_management->delete_contact($id);
		
	}

	public function  add_job_type()
	{   
            
            if(isset($_POST['btnsave']))
            {
            	$Job['title'] = $this->input->post("title");
            	$Job['description'] = $this->input->post("description");

            	$this->Contact_us_management->add_job_type($Job);
            }

            $data['type']=$this->Contact_us_management->get_job_type();
            $this->load->view("Administration/add_job_type",$data);


	}
	function  delete_job_type()
	{
		$id=$this->input->post("id");
		$this->Contact_us_management->delete_job_type($id);
		echo "yes";
		
	}
	



  }	
?>