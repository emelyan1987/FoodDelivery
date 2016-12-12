<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

    class RestroLocationModel extends CI_Model
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
            if($this->db->insert('restro_location', $data)) {
                $insert_id = $this->db->insert_id();
            }
            $this->db->trans_complete();

            return $insert_id;                

        }
        public function update($id, $data){
            $this->db->trans_start();
            $this->db->where('id',  $id);
            $this->db->update('restro_location', $data);
            $this->db->trans_complete();
        }

        public function find($params){   
            $this->db->select('*');
            $this->db->from('restro_location');   

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
            $this->db->select('a.*, b.name AS area_name, c.city_name AS city_name');
            
            $this->db->from('restro_location AS a');
            $this->db->join('area AS b', 'b.id=a.area', 'left');
            $this->db->join('city AS c', 'c.id=a.city', 'left');
            $this->db->where('a.id', $id);
            
            return $this->db->get('restro_location')->row();
        }         



        public function delete($id){
            $this->db->trans_start();
            $ret = $this->db->delete('restro_location', array('id' => $id));
            $this->db->trans_complete();

            return $ret;
        }

        public function findByRestroId($restro_id) {
            $this->db->select('a.*, b.name AS area, c.city_name AS city');
            
            $this->db->from('restro_location AS a');
            $this->db->join('area AS b', 'b.id=a.area', 'left');
            $this->db->join('city AS c', 'c.id=a.city', 'left');
            $this->db->where('a.restro_id', $restro_id);
            
            return $this->db->get()->result();
        }

}