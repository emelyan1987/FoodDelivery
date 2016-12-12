<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

    class RestroPaymentMethodModel extends CI_Model
    {

        protected $publicFields = array();

        private $tableName = 'restro_payments_method';
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
            if($this->db->insert($this->tableName, $data)) {
                $insert_id = $this->db->insert_id();
            }
            $this->db->trans_complete();

            return $insert_id;                

        }
        public function update($id, $data){
            $this->db->trans_start();
            $this->db->where('id',  $id);
            $this->db->update($this->tableName, $data);
            $this->db->trans_complete();
        }

        public function find($params, $toArray=false){   
            $this->db->select('*');
            $this->db->from($this->tableName);   

            if(isset($params)) {
                if(isset($params["restro_id"]) && $params["restro_id"]!="") $this->db->where('restro_id', $params["restro_id"]);
                if(isset($params["location_id"]) && $params["location_id"]!="") $this->db->where('location_id', $params["location_id"]);
                if(isset($params["service_id"]) && $params["service_id"]!="") $this->db->where('service_type', $params["service_id"]);
            }  

            if($toArray) {
                $result = $this->db->get()->result_array();
            } else {
                $result = $this->db->get()->result();    
            }

            return $result;
        }

        public function findOne($params) {
            $result = $this->find($params);
            return $result&&count($result)>0?$result[0]:null;
        }
        public function findById($id){
            $this->db->select('*');
            $this->db->where('id',$id);

            return $this->db->get($this->tableName)->row();
        }         



        public function delete($id){
            $this->db->trans_start();
            $ret = $this->db->delete($this->tableName, array('id' => $id));
            $this->db->trans_complete();

            return $ret;
        }

}