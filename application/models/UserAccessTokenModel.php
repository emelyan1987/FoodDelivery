<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

    class UserAccessTokenModel extends CI_Model
    {

        protected $publicFields = array('id', 'user_id', 'access_token', 'ttl', 'created_at');

        function __construct()
        {
            parent::__construct();     

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

            $insert_id = null;
            $this->db->trans_start();
            if($this->db->insert('user_access_tokens', $data)) {
                $insert_id = $this->db->insert_id();
            }
            $this->db->trans_complete();

            return $insert_id;               

        }   

        public function find($params){   
            $this->db->select('*');
            $this->db->from('user_access_tokens');   

            if(isset($params)) {
                if(isset($params["user_id"]) && $params["user_id"]!="") $this->db->where('user_id', $params["user_id"]);                    
                if(isset($params["access_token"]) && $params["access_token"]!="") $this->db->where('access_token', $params["access_token"]);                    
            }  
            $result = $this->db->get()->result();

            return $result;
        }

        public function findOne($params){   
            $this->db->select('*');
            $this->db->from('user_access_tokens');   

            if(isset($params)) {
                if(isset($params["user_id"]) && $params["user_id"]!="") $this->db->where('user_id', $params["user_id"]);                    
                if(isset($params["access_token"]) && $params["access_token"]!="") $this->db->where('access_token', $params["access_token"]);                    
            }  
            $this->db->order_by('created_at', 'desc');
            $result = $this->db->get()->result();

            return $result&&count($result)>0? $result[0] : null;
        }

        public function findById($id){
            $this->db->select('*');
            $this->db->where('id',$id);

            return $this->db->get('user_access_tokens')->row();
        }         



        public function delete($id){
            $this->db->trans_start();
            $ret = $this->db->delete('user_access_tokens', array('id' => $id));
            $this->db->trans_complete();

            return $ret;
        }   
       
}