<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Restaurant_management_app extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		//$this->load->library('security');
        $this->load->helper('security');
		$this->load->library('tank_auth');
		$this->lang->load('tank_auth');
		$this->load->model("Customer_management");
		$this->load->model('Custom_function');
		$this->load->model('Mattam_API/User_Model');
		$this->load->model('Administration/Cuisine_management');
		$this->load->model('Administration/Advertise_management');
		$this->load->model('Administration/Notification_management');
		$this->load->model('Administration/Area_management');
		
		$this->load->model("Customer/Home_site");
		
		
		
		
		
	}
	
	function Cuisine_list($token=null)
	{
	       if($this->User_Model->token_check($token))
		   {
		       $data=array();
			   $data['cuisine_list']=$this->Cuisine_management->all_cuisine();
			   echo json_encode($data);
			   
			   
		   }
		   else
		   {
		                     $response["status"]=2;
							 $response["msg"]="Authentication failed";
							 echo json_encode($response);
							 
							 
		   }
	exit;	   
	}
	function all_food_type($token=null)
	{
	 if($this->User_Model->token_check($token))
		   {
		       $data=array();
			   $data['food_type_list']=$this->Cuisine_management->all_foodtype();
			   echo json_encode($data);
			   
		   }
		   else
		   {
		                     $response["status"]=2;
							 $response["msg"]="Authentication failed";
							 echo json_encode($response);
							 
							 
		   }
		 
	  
	  exit;
	}
	
	function item_category_list($token=null)
	{
	 if($this->User_Model->token_check($token))
		   {
		       $data=array();
			   $data['item_category_list']=$this->Cuisine_management->all_item_category();
			   echo json_encode($data);
			   
		   }
		   else
		   {
		                     $response["status"]=2;
							 $response["msg"]="Authentication failed";
							 echo json_encode($response);
							 
						 
		   }
		 
	  
	  exit;
	}
	
		   function all_city($token=null)
		   {
			 
			  if($this->User_Model->token_check($token))
		      {
		       $data=array();
			   $data['city_list']=$this->Home_site->show_all_city();
			   echo json_encode($data); 
		      }
		   else
		      {
		                     $response["status"]=2;
							 $response["msg"]="Authentication failed";
							 echo json_encode($response);
							 
							 
		      }
		 
		  exit;
		   }
		   
		   function advertisement_type($token=null)
		   {
		       if($this->User_Model->token_check($token))
		       {
		           $data=array();
			       $data['advertise_type']=$this->Advertise_management->all_Advertise_type();
			       echo json_encode($data); 
		      }
		     else
		      {
		                     $response["status"]=2;
							 $response["msg"]="Authentication failed";
							 echo json_encode($response);
							 
							 
		      }
			  
           exit;     
		   }
		   
		   function restro_advertise_data($type=null,$status=null,$token=null)
		   {
		       if($this->User_Model->token_check($token))
		       {
		           $data=array();
			       $data['advertise_list']=$this->Advertise_management->getAdvertData($type,$status);
			       echo json_encode($data); 
		      }
		     else
		      {
		                     $response["status"]=2;
							 $response["msg"]="Authentication failed";
							 echo json_encode($response);
							 
							 
		      }
			exit;  
		   }
		   
		   function app_notification($token=null)
		   {
		       if($this->User_Model->token_check($token))
		       {
		           $data=array();
			       $data['notification_list']=$this->Notification_management->get_ap_notification();
			       echo json_encode($data); 
		      }
		     else
		      {
		                     $response["status"]=2;
							 $response["msg"]="Authentication failed";
							 echo json_encode($response);
							 
							 
		      }
			exit; 
			
		   }
		   
		  
		   
		   
		   function  get_area_list($token=null)
		   {
		     if($this->User_Model->token_check($token))
		       {
		           $data=array();
			       $data['area_list']=$this->Area_management->get_area_list();
			       echo json_encode($data); 
		       }
		       else
		       {
		                     $response["status"]=2;
							 $response["msg"]="Authentication failed";
							 echo json_encode($response);
							 
							 
		       }
			
		   exit;
		   }
		   
		   

}


