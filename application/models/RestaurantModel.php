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
            if(!$params || !isset($params["service_type"])) return null;              

            $service_type = $params["service_type"];

            $where = 'r.trash = 0 AND s.status=1';                      
            if(isset($params["area"])) { 
                if($service_type == 1 || $service_type == 2) {
                    $where .= " AND FIND_IN_SET('" . $params["area"] . "', ca.area)";
                } else if($service_type == 3 || $service_type == 4) {
                    $where .= " AND l.area=" . $params["area"];
                }
            }   
            if(isset($params["cuisines"])) {       
                $where .= " AND c.cuisine_id IN (" . $params["cuisines"] . ")";
            }   
            if(isset($params["food_types"])) {      
                $where .= " AND f.food_type_id IN (" . $params["food_types"] . ")";
            }    
            if(isset($params["restro_categories"])) {        
                $where .= " AND rc.category_id IN (" . $params["restro_categories"] . ")";
            } 
            if(isset($params["kind"])) {
                $where .= " AND r.restro_state&" . $params["kind"] . "!=0";
            }
            

            $query = "SELECT a.*, AVG(rt.star_value) AS rating, COUNT(rt.id) AS reviews, pt.id AS promo_id, $service_type AS service_type FROM 
            (
            SELECT r.id AS restro_id, r.restro_name, r.restro_description, r.restaurant_logo AS restro_logo, r.assign_featured, r.status, r.restro_status, l.id AS location_id, l.location_name, l.telephones, l.latitude, l.longitude, ct.city_name AS city, a.name AS area, l.block, l.street, l.building, s.open_status, s.open_from, s.open_to, p.method_type AS payment_method, w.min_order, w.order_days*24*60+w.order_hour*60+w.order_minitue AS order_time, w.monday_from, w.monday_to, w.tuesday_from, w.tuesday_to, w.wednesday_from, w.wednesday_to, w.thursday_from, w.thursday_to, w.friday_from, w.friday_to, w.saturday_from, w.saturday_to, w.sunday_from, w.sunday_to 
            FROM restro_info AS r 
            INNER JOIN restro_location AS l ON l.restro_id=r.id
            INNER JOIN restro_cuisine_ids AS c ON c.restro_id=r.id
            INNER JOIN food_type_restro_list AS f ON f.restro_id=r.id
            INNER JOIN restro_seo_category_list AS rc ON rc.restro_id=r.id
            JOIN restro_services_commission AS s ON s.location_id=l.id AND s.restro_id=r.id AND s.service_type=$service_type
            LEFT JOIN restro_working_hour AS w ON w.location_id=l.id AND w.restro_id=r.id AND w.service_id=$service_type
            LEFT JOIN restro_payments_method AS p ON p.location_id=l.id AND p.restro_id=r.id AND p.service_type=$service_type
            JOIN users AS u ON u.id=r.user_id";
            
            if($service_type == 1 || $service_type == 2) {
                $query .= " LEFT JOIN restro_city_area AS ca ON ca.restro_id=r.id AND ca.location_id=l.id AND ca.service_id=$service_type";   
            }
            
            $query .= "
            LEFT JOIN city AS ct ON ct.id=l.city
            LEFT JOIN area AS a ON a.id=l.area
            WHERE $where
            GROUP BY l.id
            ) AS a 
            LEFT JOIN restro_rating AS rt ON rt.location_id=a.location_id AND rt.restro_id=a.restro_id
            LEFT JOIN restro_promotion AS pt ON pt.location_id=a.location_id AND pt.service_id=$service_type AND pt.from_date<=CURDATE() AND pt.to_date>=CURDATE()
            GROUP BY a.location_id";

            $result = $this->db->query($query)->result();

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

        public function findByRestroLocationService($restro_id, $location_id, $service_type) {
            if($location_id==null || $service_type==null) return null;
            
            $query = "SELECT a.*, AVG(rt.star_value) AS rating, pt.id AS promo_id FROM 
            (SELECT r.id AS restro_id, r.restro_name, r.restro_description, r.restaurant_logo AS restro_logo, r.assign_featured, r.status, r.restro_state, l.id AS location_id, l.location_name, l.telephones, l.latitude, l.longitude, ct.city_name AS city, a.name AS area, l.block, l.street, l.building, p.method_type AS payment_method, s.open_status, s.open_from, s.open_to, w.min_order, w.order_days*24*60+w.order_hour*60+w.order_minitue AS order_time, w.monday_from, w.monday_to, w.tuesday_from, w.tuesday_to, w.wednesday_from, w.wednesday_to, w.thursday_from, w.thursday_to, w.friday_from, w.friday_to, w.saturday_from, w.saturday_to, w.sunday_from, w.sunday_to
            FROM restro_location AS l
            JOIN restro_info AS r ON r.id=l.restro_id
            LEFT JOIN restro_payments_method AS p ON p.location_id=l.id AND service_type=$service_type
            LEFT JOIN restro_services_commission AS s ON s.location_id=l.id AND s.restro_id=r.id AND s.service_type=$service_type
            LEFT JOIN restro_working_hour AS w ON w.location_id=l.id AND w.restro_id=r.id AND w.service_id=$service_type
            LEFT JOIN city AS ct ON ct.id=l.city
            LEFT JOIN area AS a ON a.id=l.area
            WHERE r.id=$restro_id AND l.id=$location_id
            ORDER BY p.id DESC, s.id DESC, w.id DESC
            LIMIT 0,1
            ) AS a 
            LEFT JOIN restro_rating AS rt ON rt.location_id=a.location_id AND rt.restro_id=a.restro_id
            LEFT JOIN restro_promotion AS pt ON pt.location_id=a.location_id AND pt.service_id=$service_type
            GROUP BY a.location_id";
            $row = $this->db->query($query)->row();
            return $row;

        }

        public function findByOwnerId($user_id){
            $this->db->select('*');
            $this->db->where('user_id',$user_id);

            return $this->db->get('restro_info')->result();
        } 

        /*public function delete($id){
        $this->db->trans_start();
        $ret = $this->db->delete('city', array('id' => $id));
        $this->db->trans_complete();

        return $ret;
        }*/

}