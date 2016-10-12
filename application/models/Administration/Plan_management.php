<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Plan_management extends CI_Model
{


	function __construct()
	{
		parent::__construct();

		
	}

	public function  add_plan($planInfo)
	{
		$this->db->insert('restro_plan',$planInfo);
		return true;

	}

	public function  plan_list()
	{
             
         return $this->db->get('restro_plan')->result();


	}
}

?>