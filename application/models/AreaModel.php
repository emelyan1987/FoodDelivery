<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

    class AreaModel extends CI_Model
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
            if($this->db->insert('area', $data)) {
                $insert_id = $this->db->insert_id();
            }
            $this->db->trans_complete();

            return $insert_id;                

        }
        public function update($id, $data){
            $this->db->trans_start();
            $this->db->where('id',  $id);
            $this->db->update('area', $data);
            $this->db->trans_complete();
        }

        public function find($params){   
            $this->db->select('a.*, c.city_name');
            $this->db->from('area AS a');   
            $this->db->join('city AS c', 'c.id=a.city_id', 'left');
            if(isset($params)) {
                if(isset($params["name"]) && $params["name"]!="") $this->db->like('a.name', $params["name"]);
                if(isset($params["city_id"])) $this->db->where('a.city_id', $params["city_id"]);
                if(isset($params["ids"]) && is_array($params['ids'])) $this->db->where_in('a.id', $params['ids']);
                if(isset($params["id"])) $this->db->where('a.id', $params['id']);
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

            return $this->db->get('area')->row();
        }         



        public function delete($id){
            $this->db->trans_start();
            $ret = $this->db->delete('area', array('id' => $id));
            $this->db->trans_complete();

            return $ret;
        }

}