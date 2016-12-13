<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

    class RestroPromotionItemModel extends CI_Model
    {

        protected $publicFields = array();

        private $tableName = 'restro_promotion_item';
        
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
            $this->db->select('*');
            $this->db->from($this->tableName);
            
            if(isset($params)) { 
                if(isset($params["promotion_id"]) && $params["promotion_id"]!="") $this->db->where('promotion_id', $params["promotion_id"]);        
            }  
            
            $result = $this->db->get()->result();

            return $result;
        }

        public function findByPromoId($promo_id){   
            $this->db->select('*');
            $this->db->from($this->tableName);
            
            $this->db->where('promotion_id', $promo_id);   
            
            $result = $this->db->get()->result();

            return $result;
        }
        
        public function findById($id){   
            $this->db->select('*');
            $this->db->from($this->tableName);
            
            $this->db->where('id', $id);
            
            return $this->db->get()->row();
        }

        public function findOne($params) {
            $result = $this->find($params);
            return $result&&count($result)>0?$result[0]:null;
        }   

}