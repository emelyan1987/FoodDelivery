<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class User extends CI_Controller
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
	}
///////////////////////////////////////////////////////////////////////////customer register///////////////////////////////////////////////////////////////////////////////
  function  appCus_register()
  {
      
	               $hasher = new PasswordHash(
                                  	 $this->config->item('phpass_hash_strength', 'tank_auth'),
                                   	 $this->config->item('phpass_hash_portable', 'tank_auth'));
									
									  
      if($this->input->method(TRUE)=="GET")
	  { 
			  $userInfo=array();
			  $data['errors']=array();
		      if($this->User_Model->token_check($this->uri->segment(10)))
			  {
			       if($this->User_Model->checkUserExistance($this->uri->segment(4)))
				   {
				     $response["status"]="0";
				     $response["msg"]="Mobile No Already exists";
					 echo json_encode($response);
					 
				   }
				    else
					{
					  $userInfo['email']=$this->uri->segment(7);
					  $userInfo['mobile_no']=$this->uri->segment(4);
					  $userInfo['login_device']=$this->uri->segment(8);
					  $userInfo['device_id']=$this->uri->segment(9);
					  $userInfo['password']= $hasher->HashPassword($this->uri->segment(6));
					  $userInfo['user_role']=3;
					  $userId=$this->User_Model->add_user($userInfo);
					  
					    $userProfileInfo['user_id']=$userId;
					    $userInfo['f_name']=$this->uri->segment(5);
					    $userProfileInfo['mobile']=$this->uri->segment(4);
						  if($this->User_Model->addUserProfile($userProfileInfo))
						  {
							  $response["status"]="Account Is Created Successfully";
							  $data1[]=$this->User_Model->get_user_details($userId);
							  
							  $apiData = $this->Customer_management->getApiDetails(1);
							  $otp_gen=rand(23454,34096);
							  $otpMSG =urlencode("Your MATTAM OTP is $otp_gen");
			                  $usernameApi = $apiData['username'];
			                  $usernamePass = $apiData['password'];
							  $mobilenumber=$this->uri->segment(4);
			                  $usernameSource = $apiData['username_source'];
			                  $url = file_get_contents("http://103.16.101.52/sendsms/bulksms?username=$usernameApi&password=$usernamePass&destination=$mobilenumber&source=$usernameSource&message=$otpMSG");  
			                  $this->User_Model->updateOtp($userId,$otp_gen); 
							  $response['data']=$data1;
							  echo json_encode($response);	
						  }
						  else
						  {
							   $response["status"]=3;
							   $response["msg"]="May be server error or information error";
							   echo json_encode($response);
							 
						  }
				  
				  }
		  
		  }
		  else
		  {
		                 $response["status"]=2;
					     $response["msg"]="Authentication failed";
					     echo json_encode($response);		  
		  }
	  }
		exit;
  }
  //////////////////////////////////////////////////////////////////////customer registratin end/////////////////////////////////////////////////////////////////////

  
  function appCus_otp()
  {
          if($this->input->method(TRUE)=="GET")
	      { 
			  $userInfo=array();
			  $data['errors']=array();
		      if($this->User_Model->token_check($this->uri->segment(6)))
			  {
			      $userId=$this->uri->segment(4);
				  $otp=$this->uri->segment(5);
				  if($this->User_Model->checkOtp($userId,$otp))
				  {
				         $response["status"]=1;
					     $response["msg"]="Otp is matched successfully";
					     echo json_encode($response);						 
				  }
				  else
				  {
				         $response["status"]=0;
					     $response["msg"]="Otp does not matched successfully";
					     echo json_encode($response);						 
				  }
			      
			  }
			  else
			  {
			             $response["status"]=2;
					     $response["msg"]="Authentication failed";
					     echo json_encode($response);
			  }
		
		  }
		
  
        
  }
 
	public function changePassword()
	{
	     
		  if($this->input->method(TRUE)=="GET")
	      { 
			      $userInfo=array();
			      $data['errors']=array();
			      $hasher = new PasswordHash(
                                  	 $this->config->item('phpass_hash_strength', 'tank_auth'),
                                   	 $this->config->item('phpass_hash_portable', 'tank_auth'));
									
									
		      if($this->User_Model->token_check($this->uri->segment(7)))
			  {
			        $userId=$this->uri->segment(4);
				    $op=$this->uri->segment(5);
				    $np=$hasher->HashPassword($this->uri->segment(6));
                   $opdb=$this->User_Model->CheckOldPassword($userId,$op,$np); 
				   if($hasher->CheckPassword($op,$opdb['password']))
				   {
				       if($this->User_Model->changePassword($userId,$np))
					   {
							$response['status']="1";
							$response['msg']="Password Changed successfully";
							echo json_encode($response);
							
					   }
				   } 
				   else
				   {
				          $response['status']="0";
						  $response['msg']="Old password does not match";
						  echo json_encode($response);
				   }
				   
				   
				   
		      }
			  else
			  {
			             $response["status"]=2;
					     $response["msg"]="Authentication failed";
					     echo json_encode($response);
						 
			  }
			  
			  
		 }
		 
		
	   exit;
	}
	
	public function forgot_password_link($user_id=null,$user_email=null,$token=null)
	{
                  if($this->input->method(TRUE)=="GET")
	              { 
					  $userInfo=array();
					  $data['errors']=array();
					  if($this->User_Model->token_check($token))
					  {
						
					      if($this->User_Model->get_user_details($user_id))
						  {
						    $random=rand(23454,34096);
							$key=$random."_".$user_id;
						    $data['site_name'] = $this->config->item('website_name', 'tank_auth');
							$data['new_pass_key'] =$key;
							$data['user_id'] = $user_id;
							$data['email']=$user_email;
						    $this->_send_email1('mforgot_password', $data['email'], $data);
						      $response["status"]=1;
					          $response["msg"]="Forgot password link gas been sent successfully";
					          echo json_encode($response);
							
						  }
						  else
						  {
						      $response["status"]=0;
					          $response["msg"]="User Does not exists";
					          echo json_encode($response);
						  
						  }
						  
					  }
					  else
					  {
					     $response["status"]=2;
					     $response["msg"]="Authentication failed";
					     echo json_encode($response);
						 
					  }
		       } 
	
	}
	
	
	function profile_setting($user_id=null,$fname=null,$lname=null,$home_no=null,$mobile=null,$gender=null,$birthday=null,$user_email=null,$token=null)
	{
	     if($this->User_Model->token_check($token))
		 {			  
			 $user=array();
			 $user_profile=array();
			 $user['email']=$user_email;
			 $user['mobile_no']=$mobile;
			 $user_profile['f_name']=$fname;
			 $user_profile['l_name']=$lname;
			 $user_profile['mobile']=$mobile;
			 $user_profile['gender']=$gender;
			 $user_profile['home_number']=$home_no;
			 $user_profile['birthdate']=$birthday;
			 $this->User_Model->update_user($user_id,$user);
			 $this->User_Model->update_user_info($user_id,$user_profile);
			 $response['status']=1;
			 $response['msg']="updated Successfully";
			 echo json_encode($response);
			 }
			 else
			 {
							 $response["status"]=2;
							 $response["msg"]="Authentication failed";
							 echo json_encode($response);
							 
						  
			 }
			 
	
	  exit; 
	   }
	   
	 function customer_address($user_id=null,$address_name=null,$city=null,$area=null,$street=null,$block=null,$floor=null,$extra_dir=null,$house=null,$apartment=null,$token=null)
	 {
	     if($this->User_Model->token_check($token))
		 {
		        $profileAddress=array();
				$profileAddress['address']=$address_name;
				$profileAddress['city']=$city;
				$profileAddress['area']=$area;
				$profileAddress['street']=$street;
				$profileAddress['floor']=$floor;
				$profileAddress['appartment']=$apartment;
				$profileAddress['direction']=$extra_dir;
				$profileAddress['block']=$block;
				$profileAddress['house_name']=$house;
                if($this->User_Model->add_cus_address($user_id,$profileAddress))
				{
                   	         $response["status"]=1;
							 $response["msg"]="Address is added successfully";
							 echo json_encode($response);
							 
				}
				else
				{
				             $response["status"]=3;
							 $response["msg"]="faild!";
							 echo json_encode($response);
							 
				}
				
		 }
		 else
		 {
		                     $response["status"]=2;
							 $response["msg"]="Authentication failed";
							 echo json_encode($response);
							 
		 }
	      
	 }
	

   function  app_faq_cat_list($token=null)
   {
        if($this->User_Model->token_check($token))
		 {
		      $data=array();
			  $data['faq_category']=$this->User_Model->get_faq_category();
			  echo json_encode($data);
		 }
		 else
		 {
		                    $response["status"]=2;
							 $response["msg"]="Authentication failed";
							 echo json_encode($response);					 
		 }
            
   }
   function app_faq_list($token=null)
   {
         if($this->User_Model->token_check($token))
		 {
		      $data=array();
			  $data['faq']=$this->User_Model->get_faq_list();
			  echo json_encode($data);
		 }
		 else
		 {
		                     $response["status"]=2;
							 $response["msg"]="Authentication failed";
							 echo json_encode($response);					 
		 }
		 
		 
   }
   function app_faq_by_cat_id($cat_id=null,$token=null)
   {
       if($this->User_Model->token_check($token))
		 {
		      $data=array();
			  $data['faq_by_id']=$this->User_Model-> get_faq_by_cat($cat_id);
			  echo json_encode($data);
		 }
		 else
		 {
		                     $response["status"]=2;
							 $response["msg"]="Authentication failed";
							 echo json_encode($response);					 
		 }
		 
   }
   function  about_us_data($token=null)
   {
      if($this->User_Model->token_check($token))
		 {
		      $data=array();
			  $data=$this->User_Model->get_about_us();
			  echo json_encode($data);
		 }
		 else
		 {
		                     $response["status"]=2;
							 $response["msg"]="Authentication failed";
							 echo json_encode($response);					 
		 }
		  
   
   }
  
  




	function _send_email($type, $email, &$data)
	{
		$this->load->library('email');
		$this->email->from($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->reply_to($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->to($email);
		$this->email->subject(sprintf($this->lang->line('auth_subject_'.$type), $this->config->item('website_name', 'tank_auth')));
		
		$this->email->message($this->load->view('email/'.$type.'-html', $data, TRUE));
		$this->email->set_alt_message($this->load->view('email/'.$type.'-txt', $data, TRUE));
		$this->email->send();
		
	}
	function _send_email1($type, $email, &$data)
	{
		$this->load->library('email');
		$this->email->from($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->reply_to($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->to($email);
		$this->email->subject("Forgot Password");
		$this->email->message($this->load->view('email/'.$type.'-html', $data, TRUE));
		$this->email->set_alt_message($this->load->view('email/'.$type.'-txt', $data, TRUE));
		$this->email->send();
		
	}
	


}