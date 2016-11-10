<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

    class RestroPromotionModel extends CI_Model
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

        public function find($params=null){   
            $this->db->select('p.*, l.restro_id');
            $this->db->from('restro_promotion AS p'); 
            $this->db->join('restro_location AS l', 'l.id=p.location_id', 'left');
            
            if(isset($params)) { 
                if(isset($params["restro_id"]) && $params["restro_id"]!="") $this->db->where('l.restro_id', $params["restro_id"]);          
                if(isset($params["location_id"]) && $params["location_id"]!="") $this->db->where('p.location_id', $params["location_id"]);          
            }  
            
            $result = $this->db->get()->result();

            return $result;
        }
        
        public function findById($id){   
            $this->db->select('p.*, l.restro_id');
            $this->db->from('restro_promotion AS p'); 
            $this->db->join('restro_location AS l', 'l.id=p.location_id', 'left');
            
            $this->db->where('p.id', $id);
            
            return $this->db->get()->row();
        }

        public function findOne($params) {
            $result = $this->find($params);
            return $result&&count($result)>0?$result[0]:null;
        }   

}