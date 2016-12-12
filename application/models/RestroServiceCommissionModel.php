<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

    class RestroServiceCommissionModel extends CI_Model
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
            if($this->db->insert('restro_services_commission', $data)) {
                $insert_id = $this->db->insert_id();
            }
            $this->db->trans_complete();

            return $insert_id;                

        }
        public function update($id, $data){
            $this->db->trans_start();
            $this->db->where('id',  $id);
            $this->db->update('restro_services_commission', $data);
            $this->db->trans_complete();
        }

        public function find($params){   
            $this->db->select('*');
            $this->db->from('restro_services_commission');   

            if(isset($params)) {
                if(isset($params["name"]) && $params["name"]!="") $this->db->like('name', $params["name"]);
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

            return $this->db->get('restro_services_commission')->row();
        } 
        
        public function delete($id){
            $this->db->trans_start();
            $ret = $this->db->delete('restro_services_commission', array('id' => $id));
            $this->db->trans_complete();

            return $ret;
        }

        public function findByRestroLocationId($restro_id, $location_id) {
            $this->db->select('a.id, a.cat_name AS name');
            
            $this->db->from('restro_services AS a');
            $this->db->join('restro_services_commission AS b', 'b.service_type=a.id', 'left');
            $this->db->where('b.restro_id', $restro_id);
            $this->db->where('b.location_id', $location_id);
            
            return $this->db->get()->result();
        }

}