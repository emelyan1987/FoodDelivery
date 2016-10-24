<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

    class CouponModel extends CI_Model
    {


        function __construct()
        {
            parent::__construct();

            $this->load->library('tank_auth');
            $this->lang->load('tank_auth');

        }

        public function create($data)
        {
            if($this->db->insert('restro_coupons',$data))
                return $this->db->insert_id();
            else
                return null;            
        }
        public function update($id, $data){
            $this->db->where('id',  $id);
            $this->db->update('restro_coupons', $data);
        }

        public function find($params=null){   
            $this->db->select('restro_coupons.*, restro_info.restro_name as restro, restro_location.location_name as location');
            $this->db->from('restro_coupons');
            $this->db->join('restro_info', 'restro_info.id = restro_coupons.restro_id', 'left');
            $this->db->join('restro_location', 'restro_location.id = restro_coupons.location_id', 'left');

            if(isset($params)) {
                if(isset($params["restro_id"]) && $params["restro_id"]!="") $this->db->where('restro_coupons.restro_id', $params["restro_id"]);                
                if(isset($params["location_id"])) $this->db->where('restro_coupons.location_id', $params["location_id"]);                
                if(isset($params["coupon_code"])) $this->db->where('restro_coupons.coupon_code', $params["coupon_code"]);                
            }           

            $this->db->order_by('id', 'desc');
            $result = $this->db->get()->result();

            return $result;
        }
        
        public function findOne($params=null) {
            $result = $this->find($params);
            
            return $result && count($result) ? $result[0] : null;
        }

        public function findById($id){
            $this->db->select('*');
            $this->db->where('id',$id);

            return $this->db->get('restro_coupons')->row();
        }         



        public function delete($id){
            return $this->db->delete('restro_coupons', array('id' => $id));
        }


}