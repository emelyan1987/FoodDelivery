<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

    class LoyaltyPointModel extends CI_Model
    {


        function __construct()
        {
            parent::__construct();

            $this->load->library('tank_auth');
            $this->lang->load('tank_auth');

        }

        public function create($data)
        {
            if($this->db->insert('restro_loyalty_points',$data))
                return $this->db->insert_id();
            else
                return null;            
        }
        public function update($id, $data){
            $this->db->where('id',  $id);
            $this->db->update('restro_loyalty_points', $data);
        }

        public function find($params){   
            $this->db->select('restro_loyalty_points.*, restro_info.restro_name as restro, restro_location.location_name as location, restro_services.cat_name as service');
            $this->db->from('restro_loyalty_points');
            $this->db->join('restro_info', 'restro_info.id = restro_loyalty_points.restro_id');
            $this->db->join('restro_location', 'restro_location.id = restro_loyalty_points.location_id');
            $this->db->join('restro_services', 'restro_services.id = restro_loyalty_points.service_id');

            if(isset($params)) {
                if(isset($params["restro_id"]) && $params["restro_id"]!="") $this->db->where('restro_loyalty_points.restro_id', $params["restro_id"]);                
                if(isset($params["location_id"])) $this->db->where('restro_loyalty_points.location_id', $params["location_id"]);                
                if(isset($params["service_id"])) $this->db->where('restro_loyalty_points.service_id', $params["service_id"]);                
            }           

            $this->db->order_by('id', 'desc');
            $result = $this->db->get()->result();

            return $result;
        }

        public function findById($id){
            $this->db->select('*');
            $this->db->where('id',$id);

            return $this->db->get('restro_loyalty_points')->row();
        }         



        public function delete($id){
            return $this->db->delete('restro_loyalty_points', array('id' => $id));
        }


}