<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Rating extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url','date'));
		$this->load->library('form_validation');
		$this->load->model("Customer/Home_Restro");
		$this->load->library('cart');
		$this->load->model("Customer/Home_site");
		$this->load->library('session');
	    $this->load->model("Rating_management");

		
	}

	public function put_rating()
	{
          $data['errors']=array();	 
          $ratingInfo['name']=$this->input->post("name");
          $ratingInfo['restro_id']=$this->input->post("restro_id");
          $ratingInfo['email']=$this->input->post("email");
          $ratingInfo['msg']=$this->input->post("msg");
          $ratingInfo['star_value']=$this->input->post("star_value");
          $ratingInfo['date']= date("Y-m-d");        
          $ratingInfo['ip']=$_SERVER['REMOTE_ADDR'];
          $this->Rating_management->put_rating($ratingInfo);

	}

	function restaurant_rating($i){
		$data['errors']=array();
		$restro_id =$this->uri->segment('2');

		$data['restroInfo'] = $this->Home_Restro->view_rating_restro_details($restro_id); 
		$data['ratingdata'] = $this->Home_Restro->view_rating_restro($restro_id);
		$this->load->view('restaurant_rating',$data);	
	}

	
}
