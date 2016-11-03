<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

    class UserAddressModel extends CI_Model
    {

        protected $publicFields = array();

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
            $insert_id = null;
            
            $data['created_time'] = $data['updated_time'] = date('Y-m-d H:i:s');
            $this->db->trans_start();
            if($this->db->insert('user_addresses', $data)) {
                $insert_id = $this->db->insert_id();
            }
            $this->db->trans_complete();

            return $insert_id;                

        }
        public function update($id, $data){
            $data['updated_time'] = date('Y-m-d H:i:s');
            $this->db->trans_start();
            $this->db->where('id',  $id);
            $this->db->update('user_addresses', $data);
            $this->db->trans_complete();
        }

        public function find($params=null, $fields=array()){   
            $this->db->select(empty($fields)?'*':implode(',',$fields));
            $this->db->from('user_addresses');   
            if(isset($params)) {
                if(isset($params["user_id"]) && $params["user_id"]!="") $this->db->where('user_id', $params["user_id"]);
                if(isset($params["city_id"]) && $params["city_id"]!="") $this->db->where('city_id', $params["city_id"]);
                if(isset($params["area_id"]) && $params["area_id"]!="") $this->db->where('area_id', $params["area_id"]);
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

            return $this->db->get('user_addresses')->row();
        }         



        public function delete($id){
            $this->db->trans_start();
            $ret = $this->db->delete('user_addresses', array('id' => $id));
            $this->db->trans_complete();

            return $ret;
        }

}