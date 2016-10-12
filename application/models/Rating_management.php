<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Rating_management extends CI_Model
{


	function __construct()
	{
		parent::__construct();

		
	}

	public function put_rating($data)
	{

		  $this->db->insert("restro_rating",$data);
		  
	}

	public function getRestroRatingValues($restro_id){
		$this->db->select('*');
		$this->db->from('restro_rating');
		$this->db->where('restro_id',$restro_id);
		return $this->db->get()->result();
	}
}

?>

