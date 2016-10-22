<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

    class RestaurantModel extends CI_Model
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
        /*public function create($data)
        {
            $insert_id = null;
            $this->db->trans_start();
            if($this->db->insert('city', $data)) {
                $insert_id = $this->db->insert_id();
            }
            $this->db->trans_complete();

            return $insert_id;                

        }
        public function update($id, $data){
            $this->db->trans_start();
            $this->db->where('id',  $id);
            $this->db->update('city', $data);
            $this->db->trans_complete();
        }*/

        public function find($params){ 
            $this->db->select('r.*');
            $this->db->from('restro_info AS r');  
            if(isset($params["area"])) {
                $this->db->join('restro_location AS l', 'l.restro_id=r.id');
                $this->db->where('l.area', $params["area"]);
            }   
            if(isset($params["cuisine"])) {
                $this->db->join('restro_cuisine_ids AS c', 'c.restro_id=r.id');
                $this->db->where('c.cuisine_id', $params["cuisine"]);
            }   
            if(isset($params["food_type"])) {
                $this->db->join('food_type_restro_list AS f', 'f.restro_id=r.id');
                $this->db->where('f.food_type_id', $params["food_type"]);
            }    
            if(isset($params["restro_category"])) {
                $this->db->join('restro_seo_category_list AS rc', 'rc.restro_id=r.id');
                $this->db->where('rc.category_id', $params["restro_category"]);
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

            return $this->db->get('restro_info')->row();
        }         



        /*public function delete($id){
            $this->db->trans_start();
            $ret = $this->db->delete('city', array('id' => $id));
            $this->db->trans_complete();

            return $ret;
        }*/

}