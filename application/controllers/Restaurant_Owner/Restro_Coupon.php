<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
@ob_start();
class Restro_Coupon extends CI_Controller
{

	function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		        $this->load->helper('security');
		$this->load->library('tank_auth');
		$this->lang->load('tank_auth');
		$this->load->model("Restaurant_Owner/Restro_Coupon_Model");
		$this->load->model("Customer/Home_site");
		$this->load->helper('restaurant_helper');
		$this->load->model("Administration/Promotion_management");

	}
	
	function index(){
	
	}

        
    public function restro_coupon_setup()
    {
 	
        $data['errors']=array();
        $userid = $this->tank_auth->get_user_id();
        if(isset($_POST['btnsave']))
                {
        	$this->form_validation->set_rules('coupon_code', 'Coupon Code', 'required');
			$this->form_validation->set_rules('from_date', 'From Date', 'required');
			$this->form_validation->set_rules('to_date', 'To Date', 'required'); 
			$this->form_validation->set_rules('coupon_type', 'Coupon Type', 'required');

			if ($this->form_validation->run() == FALSE)
			{
				
			}
			else
			{
				$coupon['user_id']=$this->tank_auth->get_user_id();
				$coupon['coupon_code']=$this->input->post('coupon_code');
				$coupon['from_date']=$this->input->post('from_date');
				$coupon['to_date']=$this->input->post('to_date');
				$coupon['discount']=$this->input->post('discount');
				$coupon['location_id']=$this->input->post('location_id');
				$coupon['coupon_type']=$this->input->post('coupon_type');


				$this->Restro_Coupon_Model->add_restro_coupon($coupon); 

				redirect('/restro_coupon_show/');
				
				
			}
			
        }
        
        $data['location'] = $this->Promotion_management->get_owner_all_location($userid);
        $this->load->view("Restaurant_Owner/restro_coupon_setup",$data);
    }
    public function restro_coupon_show(){
    	$data['errors']=array();
		$userid = $this->tank_auth->get_user_id();
    	$data['coupondata'] = $this->Restro_Coupon_Model->my_restro_coupon($userid); 

    	

    	$this->load->view("Restaurant_Owner/restro_coupon_list",$data);
    	

    }

    public function restro_coupon_edit($id)
    {

    	$userid = $this->tank_auth->get_user_id();
		$data['location'] = $this->Promotion_management->get_owner_all_location($userid);
 		$data['success_msg']="";
        $data['errors']=array();
        $coupon_id =$this->uri->segment('2');
        
        if(isset($_POST['btnsave']))
        {
        	$this->form_validation->set_rules('coupon_code', 'Coupon Code', 'required');
			$this->form_validation->set_rules('from_date', 'From Date', 'required');
			$this->form_validation->set_rules('to_date', 'To Date', 'required'); 	
		
			if ($this->form_validation->run() == FALSE)
			{
				
			}
			else
			{
				$coupon['user_id']=$this->tank_auth->get_user_id();
				$coupon['coupon_code']=$this->input->post('coupon_code');
				$coupon['from_date']=$this->input->post('from_date');
				$coupon['to_date']=$this->input->post('to_date');
				$coupon['discount']=$this->input->post('discount');
				$coupon['location_id']=$this->input->post('location_id');

				
				$this->Restro_Coupon_Model->edit_restro_coupon($coupon,$coupon_id); 
				
			}
			$data['success_msg']="Coupon Updated Successfully";
				
        }
        
        $data['coupondata'] = $this->Restro_Coupon_Model->view_restro_coupon($coupon_id); 
        $this->load->view("Restaurant_Owner/restro_coupon_edit",$data);
    }

    public function delete_my_coupon($id){
    	$data['errors']=array();
        $coupon_id =$this->uri->segment('2');
        $userid = $this->tank_auth->get_user_id();
        $this->Restro_Coupon_Model->delete_restro_coupon($coupon_id,$userid); 

        redirect('/restro_coupon_show/');
    }
}