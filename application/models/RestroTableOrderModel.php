<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

    class RestroTableOrderModel extends CI_Model
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
            if($this->db->insert('restro_table_order', $data)) {
                $insert_id = $this->db->insert_id();
            }
            $this->db->trans_complete();

            return $insert_id;                

        }
        public function update($id, $data){
            $this->db->trans_start();
            $this->db->where('id',  $id);
            $this->db->update('restro_table_order', $data);
            $this->db->trans_complete();
        }

        public function find($params){   
            $this->db->select('*');
            $this->db->from('restro_table_order');   

            if(isset($params)) {
                if(isset($params["user_id"]) && $params["user_id"]!="") $this->db->where('user_id', $params["user_id"]);
                if(isset($params["restro_id"]) && $params["restro_id"]!="") $this->db->where('restro_id', $params["restro_id"]);
                if(isset($params["location_id"]) && $params["location_id"]!="") $this->db->where('location_id', $params["location_id"]);
                if(isset($params["date"]) && $params["date"]!="") $this->db->where('date', $params["date"]);
                if(isset($params["time"]) && $params["time"]!="") $this->db->where('time', $params["time"]);
                if(isset($params["from_time"]) && $params["from_time"]!="") $this->db->where('time >=', $params["from_time"]);
                if(isset($params["to_time"]) && $params["to_time"]!="") $this->db->where('time <=', $params["to_time"]);
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

            return $this->db->get('restro_table_order')->row();
        }  

        public function delete($id){
            $this->db->trans_start();
            $ret = $this->db->delete('restro_table_order', array('id' => $id));
            $this->db->trans_complete();

            return $ret;
        }

}