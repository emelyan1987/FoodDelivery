<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

    class UserModel extends CI_Model
    {

        protected $publicFields = array('id', 'mobile_no', 'first_name', 'last_name', 'email', 'created', 'modified');

        function __construct()
        {
            parent::__construct();

            $this->load->library('tank_auth');
            $this->lang->load('tank_auth');

        }

        public function getPublicFields($model) {
            foreach ($model as $key => $value) {

                if(!in_array($key, $this->publicFields)) {
                    unset($model->{$key});
                }

            }
            
            
            return $model;
        }
        public function create($data)
        {
            $data["created"] = date("Y-m-d H:i:s");
            $data["modified"] = date("Y-m-d H:i:s");

            $insert_id = null;
            $this->db->trans_start();
            if($this->db->insert('users', $data)) {
                $insert_id = $this->db->insert_id();
            }
            $this->db->trans_complete();

            return $insert_id;                

        }
        public function update($id, $data){
            $data["modified"] = date("Y-m-d H:i:s");
            $this->db->trans_start();
            $this->db->where('id',  $id);
            $this->db->update('users', $data);
            $this->db->trans_complete();
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

        public function findOne($params) {
            $result = $this->find($params);
            return $result&&count($result)>0?$result[0]:null;
        }
        public function findById($id){
            $this->db->select('*');
            $this->db->where('id',$id);

            return $this->db->get('users')->row();
        }         



        public function delete($id){
            $this->db->trans_start();
            $ret = $this->db->delete('users', array('id' => $id));
            $this->db->trans_complete();

            return $ret;
        }

}