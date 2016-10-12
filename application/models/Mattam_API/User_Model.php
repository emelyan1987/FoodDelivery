<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_Model extends CI_Model
{


	function __construct()
	{
		parent::__construct();	
	}

	public function  token_check($token)
	{
           
           $this->db->select("*");
	       $this->db->from("restro_api_token");
	       $this->db->where("token",$token);
	       $query = $this->db->get();

	        if ($query->num_rows() > 0)
	        {
	           	  return 1;
	        }
	        else
	        {
	              return 0;
	        }
           
	}
	
	public function addUserProfile($userProfileInfo)
	{
	      $this->db->insert("user_profiles",$userProfileInfo);
		  return $this->db->insert_id();
		  
	     
	}
	
	public function get_user_details($userId)
	{
	   $this->db->select('*');
       $this->db->from('users', 'user_profiles');
       $this->db->join('user_profiles', 'users.id = user_profiles.user_id');
       $this->db->where("users.id",$userId);
	   return $this->db->get()->row_array();
	}
		public function checkUserExistance($user_email)
		{
           	$this->db->where('mobile_no',$user_email);
            if($this->db->get("users")->result())
			{
			  return 1;
			}
			else
			{
			
			return 0;
			
			}
			
		  
		}
	
	public function add_user($data)
	{
	      $this->db->insert("users",$data);
		  return $this->db->insert_id();
		  
	}
	
	public function get_user_data($id){
		   $this->db->select("users.username,users.email,user_profiles.*");
	       $this->db->from("users");
	       $this->db->from("user_profiles","users.id = user_profiles.user_id");
	       $this->db->where("users.id",$id);
	       return $query = $this->db->get()->row_array();
	}
	public function updateOtp($userId,$otp_gen)
	{
	    $data['otp']=$otp_gen;
	    $this->db->where("users.id",$userId);
		$this->db->update("users",$data);
		return 1;
	}
	public function checkOtp($userId,$otp)
	{
	   $this->db->select('*');
	   $this->db->from("users");
	   $this->db->where("id",$userId);
	   $this->db->where("otp",$otp);
	   return $this->db->get()->num_rows();

	}
	
	public function CheckOldPassword($userId,$op,$np)
	{
	     $this->db->select("password");
		 $this->db->from("users");
		 $this->db->where("id",$userId);
		 return $this->db->get()->row_array();	 
	}
	
	public function changePassword($userId,$np)
	{
	      $data['password']=$np;
	      $this->db->where("users.id",$userId);
		  $this->db->update("users",$data);
		  return 1;
		  
	}
	public function update_user($user_id,$user)
	{
	     $this->db->where("id",$user_id);
		 $this->db->update("users",$user);
		 return 1;
 
	}
	public function update_user_info($user_id,$userProfile)
	{
	     $this->db->where("user_id",$user_id);
		 $this->db->update("user_profiles",$userProfile);
		 return 1;
	}
	public function add_cus_address($user_id,$profileAddress)
	{
	     $this->db->where('user_id',$user_id);
	     $this->db->update('user_profiles',$profileAddress);
		 return 1;
		 
		 
	}
	public function get_faq_category()
	{
	     return $this->db->get("restro_faq_category")->result();
	}
	public function get_faq_list()
	{
	     return $this->db->get("restro_faq")->result();
	}
	public function get_faq_by_cat($id)
	{
	          $this->db->where("cat_id",$id);
	     return $this->db->get("restro_faq")->result(); 
 
	}
	public function get_about_us()
	{
	    return $this->db->get("restro_about_us")->row_array();
		
	}
	
	
	
	
}