<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Faq_management extends CI_Model {

	function __construct() {
		parent::__construct();

	}
	public function get() {
		$this->db->select("*");
		$this->db->from("restro_faq");
		$this->db->where('status', 1);
		return $this->db->get()->result();
	}
	public function get_faq_category() {

		$this->db->select("*");
		$this->db->from("restro_faq");
		$this->db->join('restro_faq_category', 'restro_faq.cat_id = restro_faq_category.id', "left");
		$this->db->group_by("restro_faq.status", 1);
		$this->db->group_by("restro_faq_category.name");

		return $this->db->get()->result();

	}
	public function get_faq_by_id($id) {
		$this->db->where("cat_id", $id);
		$this->db->where("status", 1);
		$this->db->order_by("date", "desc");

		return $this->db->get("restro_faq")->result();
	}

}

?>