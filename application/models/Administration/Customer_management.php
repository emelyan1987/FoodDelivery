<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

    class Customer_management extends CI_Model
    {

        function __construct()
        {
            parent::__construct();	
        }

        public function customer_list()
        {
            $this->db->select("*");
            $this->db->from("users");
            $this->db->join('user_profiles', 'users.id = user_profiles.user_id');
            $this->db->where("users.user_role",3);
            $this->db->where("users.activated",1);
            return $this->db->get()->result();
        }
        public function deleteCust($id)
        {
            $this->db->delete('users', array('users.id' => $id));
            $this->db->delete('user_profiles', array('user_profiles.user_id' =>$id));
            return true;

        } 
    }  
?>	