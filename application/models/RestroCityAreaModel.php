<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

    class RestroCityAreaModel extends CI_Model
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
            if($this->db->insert('restro_city_area', $data)) {
                $insert_id = $this->db->insert_id();
            }
            $this->db->trans_complete();

            return $insert_id;                

        }
        public function update($id, $data){
            $this->db->trans_start();
            $this->db->where('id',  $id);
            $this->db->update('restro_city_area', $data);
            $this->db->trans_complete();
        }

        public function find($params=null, $fields=array()){   
            $this->db->select(empty($fields)?'*':implode(',',$fields));
            $this->db->from('restro_city_area');   
            if(isset($params)) {
                if(isset($params["user_id"]) && $params["user_id"]!="") $this->db->where('user_id', $params["user_id"]);
                if(isset($params["restro_id"]) && $params["restro_id"]!="") $this->db->where('restro_id', $params["restro_id"]);
                if(isset($params["service_id"]) && $params["service_id"]!="") $this->db->where('service_id', $params["service_id"]);
                if(isset($params["location_id"]) && $params["location_id"]!="") $this->db->where('location_id', $params["location_id"]);
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

            return $this->db->get('restro_city_area')->row();
        }         



        public function delete($id){
            $this->db->trans_start();
            $ret = $this->db->delete('restro_city_area', array('id' => $id));
            $this->db->trans_complete();

            return $ret;
        }

        public function getRestroOrderLocation($restro_id,$service_id,$area_id){

            $where = "FIND_IN_SET('".$area_id."',restro_city_area.area) and restro_city_area.restro_id = '".$restro_id."'";

            $this->db->select('restro_city_area.location_id');
            $this->db->from('restro_city_area');
            $this->db->join('restro_location','restro_location.id = restro_city_area.location_id');
            $this->db->where($where);
            $this->db->where('service_id',$service_id);
            $this->db->order_by('restro_city_area.id','DESC');
            return $query = $this->db->get()->row_array();
            //$this->db->get();
            //echo $this->db->last_query();
        }

        public function getCharge($restro_id, $area_id, $service_id){
            $where = "FIND_IN_SET('".$area_id."',area) AND service_id = '".$service_id."'";

            $this->db->select('area, delivery_price');
            $this->db->from('restro_city_area'); 
            $this->db->where($where);
            $this->db->where('restro_id', $restro_id);  
            $this->db->group_by("id");  
            $this->db->order_by("id", "desc"); 
            $query = $this->db->get();
            //echo $this->db->last_query();
            if($query->num_rows() > 0)
            {
                $query = $query->result();
                foreach($query as $qr => $qm){
                    $ex_arr = explode(',',$qm->area); 
                    $exprice = explode(',',$qm->delivery_price); 


                    $indexId = array_search($location_id,$ex_arr);

                    return $myPrice =  $exprice[$indexId];
                }
            }
            else
            {
                return 0;
            }

        }


}