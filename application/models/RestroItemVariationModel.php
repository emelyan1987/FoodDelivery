<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

    class RestroItemVariationModel extends CI_Model
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

        public function findByItemId($item_id){   
            $this->db->select('d.*, v.variation_name, v.mandatory, v.multi_item, v.variation_type');
            $this->db->from('restro_item_variation_data AS d');
            $this->db->join('restro_item_variation AS v', 'v.id=d.variation_id');
            $this->db->where('d.item_id', $item_id);

            $result = $this->db->get()->result();

            return $result;
        }    

        public function findById($id){   
            $this->db->select('d.*, v.variation_name, v.variation_type');
            $this->db->from('restro_item_variation_data AS d');
            $this->db->join('restro_item_variation AS v', 'v.id=d.variation_id');
            $this->db->where('d.id', $id);

            $result = $this->db->get()->row();

            return $result;
        }    
        
        public function findByIds($ids){   
            $this->db->select('d.*, v.variation_name, v.variation_type');
            $this->db->from('restro_item_variation_data AS d');
            $this->db->join('restro_item_variation AS v', 'v.id=d.variation_id');
            $this->db->where_in('d.id', $ids);

            $result = $this->db->get()->result();

            return $result;
        }    

}