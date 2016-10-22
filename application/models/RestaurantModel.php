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
            $this->db->select('r.id AS restro_id, r.restro_name, l.id AS location_id, l.location_name, l.telephones, l.latitude, l.longitude, ct.city_name AS city, a.name AS area, l.block, l.street, l.building, s.open_status, s.open_from, s.open_to, p.method_type AS payments, w.min_order, (w.order_days*24*60+w.order_hour*60+w.order_minitue) AS order_time, w.monday_from, w.monday_to, w.tuesday_from, w.tuesday_to, w.wednesday_from, w.wednesday_to, w.thursday_from, w.thursday_to, w.friday_from, w.friday_to, w.saturday_from, w.saturday_to, w.sunday_from, w.sunday_to');
            $this->db->from('restro_info AS r');  
            $this->db->join('restro_location AS l', 'l.restro_id=r.id');   
            $this->db->join('restro_cuisine_ids AS c', 'c.restro_id=r.id');
            $this->db->join('food_type_restro_list AS f', 'f.restro_id=r.id');
            $this->db->join('restro_seo_category_list AS rc', 'rc.restro_id=r.id');
            $this->db->join('restro_services_commission AS s', 's.restro_id=r.id');
            $this->db->join('restro_working_hour AS w', 'w.location_id=l.id AND w.restro_id=r.id');
            $this->db->join('restro_payments_method AS p', 'p.location_id=l.id AND w.restro_id=r.id');
            $this->db->join('city AS ct', 'ct.id=l.city');
            $this->db->join('area AS a', 'a.id=l.area');
                                            
            if(isset($params["area"])) {
                $this->db->where('l.area', $params["area"]);
            }   
            if(isset($params["cuisines"])) {
                $this->db->where_in('c.cuisine_id', $params["cuisines"]);
            }   
            if(isset($params["food_types"])) {
                $this->db->where_in('f.food_type_id', $params["food_types"]);
            }    
            if(isset($params["restro_categories"])) {
                $this->db->where_in('rc.category_id', $params["restro_categories"]);
            } 
            if(isset($params["service_type"])) {
                $this->db->where_in('s.service_type', $params["service_type"]);
            }

            $this->db->group_by('l.id');
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