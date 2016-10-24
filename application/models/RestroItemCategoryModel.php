<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

    class RestroItemCategoryModel extends CI_Model
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
            if($this->db->insert('tbl_item_category', $data)) {
                $insert_id = $this->db->insert_id();
            }
            $this->db->trans_complete();

            return $insert_id;                

        }
        public function update($id, $data){
            $this->db->trans_start();
            $this->db->where('id',  $id);
            $this->db->update('tbl_item_category', $data);
            $this->db->trans_complete();
        }

        public function find($params=null, $fields=array()){   
            $this->db->select(empty($fields)?'*':implode(',',$fields));
            $this->db->from('tbl_item_category'); 
            
            if(isset($params)) { 
                if(isset($params["location_id"]) && $params["location_id"]!="") $this->db->where('location_id', $params["location_id"]);
                if(isset($params["service_id"]) && $params["service_id"]!="") $this->db->where('service_id', $params["service_id"]);                
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

            return $this->db->get('tbl_item_category')->row();
        }         



        public function delete($id){
            $this->db->trans_start();
            $ret = $this->db->delete('tbl_item_category', array('id' => $id));
            $this->db->trans_complete();

            return $ret;
        }

}