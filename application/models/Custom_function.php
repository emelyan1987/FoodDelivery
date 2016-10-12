<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Custom_function extends CI_Model
{

	function __construct()
	{
		parent::__construct();

		
	}

	public function role_id($user_email)
	{  
          
          $where = "username='$user_email' OR email='$user_email'";

		$this->db->select('user_role');
		$this->db->where($where);
	 	return $query = $this->db->get("users")->row_array();
        	
	}
	function add_password_for_mail($oid,$np)
	{
		 $data['mail_password']=$np;
		 $this->db->where("owner_id",$oid);
		 $this->db->update("users",$data);
		 return true;
	}
	
	public function role_by_id($user_id)
	{  

		$this->db->select('user_role');
		
		$this->db->where('id',$user_id);

	 	return $query = $this->db->get("users")->row_array();
       
		
	}
	public function checkOldPass(){
		
		$ID =$this->tank_auth->get_user_id();
		$this->db->select('password,email');
		$this->db->where('id', $ID);
    	$query = $this->db->get('users');
    	
    	if($query->num_rows() > 0)
        	return $query->row_array();
    	else
        	return 0;

	}
	public function saveNewPass($data){
			
			$id =$this->tank_auth->get_user_id();
           	$this->db->where('id',  $id);
            $this->db->update('users', $data);
	}
	public function get_password_by_owner_id($owner_id)
	{
		$this->db->select("password");
	    $this->db->from("users");
	    $this->db->where("owner_id",$owner_id);
	    return 	$this->db->get()->row_array();
       

	    
	    	
	}
	public function Change_new_pass($change,$owner_id)
	{
        
	   
	    $this->db->where("owner_id",$owner_id);
	     $this->db->update("users",$change);

	    return 	true;
	    
	}
	public function  get_email_by_owner_code($OwnCode)
	{
          $this->db->select("email");
          $this->db->from("users");
          $this->db->where("owner_id",$OwnCode);
          return $this->db->get()->row_array();
	}
	public function get_user_email($id)
	{
		  $this->db->select("email");
          $this->db->from("users");
          $this->db->where("id",$id);
          return $this->db->get()->row_array();
	}
	
	
		
	public function  customer_email($email)
	     	 {
		  		  
			$this->db->select('*');
			$this->db->from('users');
			$this->db->where('email',$email);
			$query = $this->db->get();
			$ret = $query->row();
			if ($query->num_rows() > 0)
			{
			return 1;
			}else
			{
			return 0;
			}
	      	 }
	
		
	
	public function customer_user($user)
	{
	 $this->db->insert('users', $user);
	$user_id = $this->db->insert_id();
	
	 return $user_id;
	}
	
	
	
	public function customer_profile($customer)
	{
	 $this->db->insert('user_profiles', $customer);
	}
	
	public function  customer_mobile($mob)
	     	 {
		  		  
			$this->db->select('*');
			$this->db->from('users');
			$this->db->where('mobile_no',$mob);
			$query = $this->db->get();
			$ret = $query->row();
			if ($query->num_rows() > 0)
			{
			return 1;
			}else
			{
			return 0;
			}
	      	 }
	      	 
	      	 
	      	 
	
	
	
}	