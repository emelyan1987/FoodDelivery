<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

    class CityModel extends CI_Model
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
        }

        public function find($params){   
            $this->db->select('*');
            $this->db->from('city');   

            if(isset($params)) {
                if(isset($params["name"]) && $params["name"]!="") $this->db->like('city_name', $params["name"]);
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

            return $this->db->get('city')->row();
        }         



        public function delete($id){
            $this->db->trans_start();
            $ret = $this->db->delete('city', array('id' => $id));
            $this->db->trans_complete();

            return $ret;
        }

}