<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

    class RestroItemModel extends CI_Model
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
            $this->db->select('i.id, i.item_name AS name, i.item_description AS description, i.item_price AS price, i.image, i.loyalty_points AS redeem_point, i.order_point_amount AS redeem_amount, i.variation AS has_variation, i.price_type, i.service_id, p.id AS promo_id, l.id AS location_id, l.restro_id');
            $this->db->from('resto_items_category_list AS c'); 
            $this->db->join('tbl_item AS i', 'i.id=c.item_id');
            $this->db->join('restro_promotion_item AS p', 'p.item_id=i.id', 'left');
            $this->db->join('tbl_item_category AS ic', 'ic.id=c.category_id', 'left');
            $this->db->join('restro_location AS l', 'l.id=i.location_id', 'left');
            
            if(isset($params)) { 
                if(isset($params["category_id"]) && $params["category_id"]!="") $this->db->where('c.category_id', $params["category_id"]);          
                if(isset($params["location_id"]) && $params["location_id"]!="") $this->db->where('ic.location_id', $params["location_id"]);          
                if(isset($params["service_id"]) && $params["service_id"]!="") $this->db->where('ic.service_id', $params["service_id"]);          
                if(isset($params["status"]) && $params["status"]!="") $this->db->where('i.status', $params["status"]);          
            }  
            
            $this->db->group_by('i.id');
            $result = $this->db->get()->result();

            return $result;
        }
        
        public function findById($id){   
            $this->db->select('i.id, i.item_name AS name, i.item_description AS description, i.item_price AS price, i.image, i.loyalty_points AS redeem_point, i.order_point_amount AS redeem_amount, i.variation AS has_variation, i.price_type, i.service_id, p.id AS promo_id, l.restro_id, l.id AS location_id');
            $this->db->from('tbl_item AS i');
            $this->db->join('restro_promotion_item AS p', 'p.item_id=i.id', 'left');
            $this->db->join('restro_location AS l', 'l.id=i.location_id', 'left');
            $this->db->where('i.id', $id);
            $this->db->group_by('i.id');
            
            return $this->db->get()->row();
        }

        public function findOne($params) {
            $result = $this->find($params);
            return $result&&count($result)>0?$result[0]:null;
        }   

}