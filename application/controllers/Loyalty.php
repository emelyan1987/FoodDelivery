<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Loyalty extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		        $this->load->helper('security');
		$this->load->library('tank_auth');
		$this->lang->load('tank_auth');
		$this->load->model("Restaurant_Owner/Restro_Owner_Model");
		$this->load->model("Customer/Home_site");
		$this->load->helper('restaurant_helper');
		$this->load->model("Administration/Cuisine_management");
		$this->load->model("Administration/Area_management");

	
		$this->load->model("Customer/Loyalty_points");
	}
	public function loyalty_point()
	{
	 $data['errors']=array();
	 $data['lo_message']="";
	 $user_id = $restroInfo['admin_id']= $this->tank_auth->get_user_id(); 
	 $uID= $this->Loyalty_points->finduserBYid($user_id); 
	 
	 if($uID==0)
	 {
	 	
	 $this->form_validation->set_rules('points_value', 'Value', 'required');
		
		

		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
			
			$pvalue['points_value']=$this->input->post('points_value');
			$pvalue['user_id']=$user_id;
			$this->Loyalty_points->add_loyalty($pvalue);
			}
			}else {
			
			 $this->form_validation->set_rules('points_value', 'Value', 'required');
		
		

		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
			
			$pvalue['points_value']=$this->input->post('points_value');
			$pvalue['user_id']=$user_id;
			$this->Loyalty_points->edit_loyalty($pvalue,$user_id);
			$data['lo_message']="Loyalty Point Successfully Updated";
			}
			
			
			}
	
	 $data['point']=$this->Loyalty_points->getloyalty_point($user_id);
	$this->load->view("Customer/loyalty_point",$data);
	}
		


}