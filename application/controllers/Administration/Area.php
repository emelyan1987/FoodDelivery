<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
@ob_start();
class Area extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		//$this->load->library('security');
        $this->load->helper('security');
        $this->load->helper('restaurant_helper');
		$this->load->library('tank_auth');
		$this->lang->load('tank_auth');
		$this->load->model("Administration/Restaurant_management");
		$this->load->model("Administration/Plan_management");
		$this->load->model("Administration/Area_management");		
		//$this->load->model('Model');

	}

	function  index()
	{

	}
	public function  add_new_area()
	{
		   $data['errors']=array();
		   
                $data['area_list']=$this->Area_management->get_area_list();

                $data['city_list']=$this->Area_management->get_city_list();
               
               $this->form_validation->set_rules('area', 'Area Name', 'required');
               $this->form_validation->set_rules('city_id', 'City Name', 'required');
               
                if($this->form_validation->run() == FALSE)
					{
					    	
					}
					else
					{

							   $area=$this->input->post("area");
                               $city_id=$this->input->post("city_id");


							   $areaInfo['name']=$area;
					           $areaInfo['city_id']=$city_id;
							   if($this->Area_management->add_area($area,$areaInfo))
							   {
					                   $data['area_msg']="Added successfully";

							   }   
							   else
							   {
					                   $data['area_msg1']="Aready exists";

							   }
							   redirect('/add_new_area/');
                 }

		   
		   $this->load->view("Administration/add_new_area",$data);


	}

	public function add_new_city()
	{
           
            $data['errors']=array();
		   
                $data['city_list']=$this->Area_management->get_city_list();
               $this->form_validation->set_rules('city', 'City Name', 'required');
                if($this->form_validation->run() == FALSE)
					{
					    	
					}
					else
					{

							   $city=$this->input->post("city");

							   $cityInfo['city_name']=$city;
					         
							   if($this->Area_management->add_city($city,$cityInfo))
							   {
					                   $data['city_msg']="Added successfully";

							   }   
							   else
							   {
					                   $data['city_msg1']="Aready exists";

							   }
							   redirect('/add_new_city/');
                 }

		   

             $this->load->view("Administration/add_new_city",$data);

	}

	function ajax_area_get_by_city(){
		 $data['error']=array();

		$city_id = $this->input->post("city_id");
		$type = $this->input->post("type");

		$data['type']= $type;
		$data['area_list'] = $this->Area_management->get_area_list_by_city($city_id);

		
		 $this->load->view("Administration/ajax_area_by_city",$data);
	}

	public function update_city()
	{
		  $id=$this->uri->segment(2);
          $data['city_name']=$this->input->post("city_name");
          if($this->Area_management->update_city($id,$data))
           {
           	   echo "yes";
           }



	}
	public function update_area()
	{
		  $id=$this->uri->segment(2);
          $data['name']=$this->input->post("area_name");
          if($this->Area_management->update_area($id,$data))
           {
           	   echo "yes";
           }



	}

	public function delete_city(){

          $city_id=$this->input->post("cid");
          if($this->Area_management->delete_city($city_id))
           {
           	   echo "yes";
           }
	}
	

	public function delete_area(){

          $aid = $this->input->post("aid");
          if($this->Area_management->delete_area($aid))
           {
           	   echo "yes";
           }
	}
}
