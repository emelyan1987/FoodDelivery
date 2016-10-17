<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

    class UserSmsModel extends CI_Model
    {

        protected $publicFields = array('id', 'user_id', 'mobile_no', 'code', 'created_at');

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
            $data["created_at"] = date("Y-m-d H:i:s");
            $data["expires_at"] = date("Y-m-d H:i:s", time()+120);

            $insert_id = null;
            $this->db->trans_start();
            if($this->db->insert('user_sms', $data)) {
                $insert_id = $this->db->insert_id();
            }
            $this->db->trans_complete();

            return $insert_id;               

        }   

        public function find($params){   
            $this->db->select('*');
            $this->db->from('user_sms');   

            if(isset($params)) {
                if(isset($params["mobile_no"]) && $params["mobile_no"]!="") $this->db->where('mobile_no', $params["mobile_no"]);              
                if(isset($params["user_id"]) && $params["user_id"]!="") $this->db->where('user_id', $params["user_id"]);                    
            }  
            $result = $this->db->get()->result();

            return $result;
        }

        public function findOne($params){   
            $this->db->select('*');
            $this->db->from('user_sms');   

            if(isset($params)) {
                if(isset($params["mobile_no"]) && $params["mobile_no"]!="") $this->db->where('mobile_no', $params["mobile_no"]);              
                if(isset($params["user_id"]) && $params["user_id"]!="") $this->db->where('user_id', $params["user_id"]);                    
            }  
            $this->db->order_by('created_at', 'desc');
            $result = $this->db->get()->result();

            return $result&&count($result)>0? $result[0] : null;
        }

        public function findById($id){
            $this->db->select('*');
            $this->db->where('id',$id);

            return $this->db->get('user_sms')->row();
        }         



        public function delete($id){
            $this->db->trans_start();
            $ret = $this->db->delete('user_sms', array('id' => $id));
            $this->db->trans_complete();

            return $ret;
        }   
       
}