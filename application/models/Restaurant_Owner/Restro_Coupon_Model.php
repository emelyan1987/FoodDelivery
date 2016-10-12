<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Restro_Coupon_Model extends CI_Model
{


	function __construct()
	{
		parent::__construct();

		$this->load->library('tank_auth');
		$this->lang->load('tank_auth');

	}

	public function  add_restro_coupon($data)
	{
		$this->db->insert('restro_coupons',$data);
	}

	public function my_restro_coupon($userid){
		
		$this->db->select('*');
        $this->db->where('user_id',$userid);
		$query = $this->db->get('restro_coupons');
        return $query = $query->result();
	}

	public function view_restro_coupon($id){
		$this->db->select('*');
        $this->db->where('id',$id);
		$query = $this->db->get('restro_coupons');
        return $query = $query->result();
	}

	public function edit_restro_coupon($coupon,$coupon_id){
		$this->db->where('id',  $coupon_id);
        $this->db->update('restro_coupons', $coupon);
	}
	public function delete_restro_coupon($coupon_id,$userid){
		$this->db->delete('restro_coupons', array('id' => $coupon_id,'user_id' => $userid));
	}

}