<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

    class OrderDetailModel extends CI_Model
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
        public function tableName($service_type) {
            switch($service_type) {
                case 1:
                    return 'restro_order_details';
                case 2:
                    return 'restro_catering_order_details';
                case 3:
                    return 'restro_table_order_details';
                case 4:
                    return 'restro_pickup_order_details';
                default:
                    return null;
            }
        }

        public function create($service_type, $data)
        {   
            $table_name = $this->tableName($service_type);            
            if($table_name == null) return null;

            $insert_id = null;
            $this->db->trans_start();
            if($this->db->insert($table_name, $data)) {
                $insert_id = $this->db->insert_id();
            }
            $this->db->trans_complete();

            return $insert_id;                

        }

        public function update($service_type, $id, $data){
            $table_name = $this->tableName($service_type);            
            if($table_name == null) return;

            $this->db->trans_start();
            $this->db->where('id',  $id);
            $this->db->update($table_name, $data);
            $this->db->trans_complete();
        }

        public function find($service_type, $params=null, $fields=array()){   
            $table_name = $this->tableName($service_type);            
            if($table_name == null) return null;

            $this->db->select(empty($fields)?'*':implode(',',$fields));
            $this->db->from($table_name);   

            if(isset($params)) {
                if(isset($params["user_id"]) && $params["user_id"]!="") $this->db->where('user_id', $params["user_id"]);
                if(isset($params["product_id"]) && $params["product_id"]!="") $this->db->where('product_id', $params["product_id"]);   
                if(isset($params["restro_id"]) && $params["restro_id"]!="") $this->db->where('restro_id', $params["restro_id"]);   
                if(isset($params["order_id"]) && $params["order_id"]!="") $this->db->where('order_id', $params["order_id"]);   
                
            }  
            $result = $this->db->get()->result();

            foreach($result as $item) {
                $item->service_type=$service_type;    
            }
            return $result;
        }

        public function findOne($service_type, $params=null, $fields=array()) {               
            $result = $this->find($service_type, $params, $fields);
            return $result&&count($result)>0?$result[0]:null;
        }
        public function findById($service_type, $id){
            $table_name = $this->tableName($service_type);            
            if($table_name == null) return null;

            $this->db->select('*');
            $this->db->where('id', $id);

            $item = $this->db->get($table_name)->row();
            if($item) $item->service_type = $service_type;
            return $item; 
        }         



        public function delete($service_type, $id){
            $table_name = $this->tableName($service_type);            
            if($table_name == null) return null;

            $this->db->trans_start();
            $ret = $this->db->delete($table_name, array('id' => $id));
            $this->db->trans_complete();

            return $ret;
        }

}