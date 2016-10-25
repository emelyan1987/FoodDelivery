<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

    class RatingModel extends CI_Model
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
            if($this->db->insert('restro_rating', $data)) {
                $insert_id = $this->db->insert_id();
            }
            $this->db->trans_complete();

            return $insert_id;                

        }
        public function update($id, $data){
            $this->db->trans_start();
            $this->db->where('id',  $id);
            $this->db->update('restro_rating', $data);
            $this->db->trans_complete();
        }

        public function find($params=null, $fields=array()){   
            $this->db->select((empty($fields)?'r.*':implode(',',$fields)).', CONCAT(p.f_name," ", p.l_name) AS user_name');
            $this->db->from('restro_rating AS r');   
            $this->db->join('user_profiles AS p', 'r.user_id=p.user_id', 'left');
            if(isset($params)) {
                if(isset($params["user_id"]) && $params["user_id"]!="") $this->db->where('r.user_id', $params["user_id"]);
                if(isset($params["restro_id"]) && $params["restro_id"]!="") $this->db->where('r.restro_id', $params["restro_id"]);
                if(isset($params["location_id"]) && $params["location_id"]!="") $this->db->where('r.location_id', $params["location_id"]);
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

            return $this->db->get('restro_rating')->row();
        }         



        public function delete($id){
            $this->db->trans_start();
            $ret = $this->db->delete('restro_rating', array('id' => $id));
            $this->db->trans_complete();

            return $ret;
        }

}