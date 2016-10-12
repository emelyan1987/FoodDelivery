<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

    class MataamPointModel extends CI_Model
    {


        function __construct()
        {
            parent::__construct();

            $this->load->library('tank_auth');
            $this->lang->load('tank_auth');

        }

        public function save($item)
        {
            
            $service_id = $item["service_id"];
            if(!$service_id) return null;
            
            $row = $this->findByServiceId($service_id);
            
            if(!$row) {
               return $this->db->insert('restro_mataam_points',$item); 
            } else {
                $this->db->where('id', $row->id);
                return $this->db->update('restro_mataam_points', $item);
            }
        }                                                           
        

        public function read(){   
            $this->db->select('s.id AS service_id, s.cat_name AS service_name, m.point, m.amount, m.from, m.to, m.discount');
            $this->db->from('restro_services AS s');
            $this->db->join('restro_mataam_points AS m', 'm.service_id = s.id', 'left');
                        
            //$this->db->order_by('s.id', 'desc');
            $result = $this->db->get()->result();

            return $result;
        }

        public function findByServiceId($service_id){
            $this->db->select('*');
            $this->db->where('service_id',$service_id);

            return $this->db->get('restro_mataam_points')->row();
        }                                       

        public function delete($id){
            return $this->db->delete('restro_mataam_points', array('id' => $id));
        }


}