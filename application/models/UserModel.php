<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

    class UserModel extends CI_Model
    {


        function __construct()
        {
            parent::__construct();

            $this->load->library('tank_auth');
            $this->lang->load('tank_auth');

        }

        public function create($data)
        {
            $data["created"] = date("Y-m-d H:i:s");
            $data["modified"] = date("Y-m-d H:i:s");
            if($this->db->insert('users', $data))
                return $this->db->insert_id();
            else
                return null;            
        }
        public function update($id, $data){
            $data["modified"] = date("Y-m-d H:i:s");
            $this->db->where('id',  $id);
            $this->db->update('users', $data);
        }

        public function find($params){   
            $this->db->select('*');
            $this->db->from('users');   

            if(isset($params)) {
                if(isset($params["mobile_no"]) && $params["mobile_no"]!="") $this->db->where('mobile_no', $params["mobile_no"]);              
                if(isset($params["email"]) && $params["email"]!="") $this->db->where('email', $params["email"]);              
                if(isset($params["first_name"]) && $params["first_name"]!="") $this->db->like('first_name', $params["first_name"]);              
                if(isset($params["last_name"]) && $params["last_name"]!="") $this->db->like('last_name', $params["last_name"]);              
            }  
            $result = $this->db->get()->result();

            return $result;
        }

        public function findById($id){
            $this->db->select('*');
            $this->db->where('id',$id);

            return $this->db->get('users')->row();
        }         



        public function delete($id){
            return $this->db->delete('users', array('id' => $id));
        }

}