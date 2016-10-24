<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

    class RestroCustomerAddressModel extends CI_Model
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
            $this->db->trans_start();
            if($this->db->insert('restro_customer_address', $data)) {
                $insert_id = $this->db->insert_id();
            }
            $this->db->trans_complete();

            return $insert_id;                

        }
        public function update($id, $data){
            $this->db->trans_start();
            $this->db->where('id',  $id);
            $this->db->update('restro_customer_address', $data);
            $this->db->trans_complete();
        }

        public function find($params=null, $fields=array()){   
            $this->db->select(empty($fields)?'*':implode(',',$fields));
            $this->db->from('restro_customer_address');   
            if(isset($params)) {
                if(isset($params["user_id"]) && $params["user_id"]!="") $this->db->where('user_id', $params["user_id"]);
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

            return $this->db->get('restro_customer_address')->row();
        }         



        public function delete($id){
            $this->db->trans_start();
            $ret = $this->db->delete('restro_customer_address', array('id' => $id));
            $this->db->trans_complete();

            return $ret;
        }

}