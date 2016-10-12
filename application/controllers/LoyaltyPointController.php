<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
    @ob_start();
    class LoyaltyPointController extends CI_Controller
    {

        function __construct()
        {
            parent::__construct();

            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->helper('security');
            $this->load->library('tank_auth');
            $this->lang->load('tank_auth');
            $this->load->model("LoyaltyPointModel");
            $this->load->model("Administration/Restaurant_management");
            $this->load->helper('restaurant_helper');


            $this->form_validation->set_rules('restro_id', 'Restaurant', 'required');
            $this->form_validation->set_rules('location_id', 'Location', 'required');
            $this->form_validation->set_rules('service_id', 'Service', 'required');  

        }

        function index(){
            $method = $this->input->method();
            $id = $this->uri->segment(2);

            try {         
                if($method=="get") {
                    if($id) {
                        $data = $this->LoyaltyPointModel->findById($id);
                    } else {
                        $params = array();
                        $params["restro_id"] = $this->input->get("restro_id");
                        $params["location_id"] = $this->input->get("location_id");
                        $params["service_id"] = $this->input->get("service_id");
                        $data = $this->LoyaltyPointModel->find($params);
                    }
                } else if($method=="post") {
                    if ($this->form_validation->run() == TRUE)
                    {
                        $item['restro_id']=$this->input->post('restro_id');
                        $item['location_id']=$this->input->post('location_id');
                        $item['service_id']=$this->input->post('service_id');
                        $item['from1']=$this->input->post('from1');
                        $item['to1']=$this->input->post('to1');
                        $item['discount1']=$this->input->post('discount1'); 
                        $item['from2']=$this->input->post('from2');
                        $item['to2']=$this->input->post('to2');
                        $item['discount2']=$this->input->post('discount2'); 
                        $item['from3']=$this->input->post('from3');
                        $item['to3']=$this->input->post('to3');
                        $item['discount3']=$this->input->post('discount3'); 

                        $item['updated_time'] = date('Y-m-d H:i:s');
                        if(!$id) {  
                            $item['created_time'] = date('Y-m-d H:i:s');
                            $id = $this->LoyaltyPointModel->create($item);                     
                        } else {
                            $this->LoyaltyPointModel->update($id, $item); 
                        }  
                        $data = $this->LoyaltyPointModel->findById($id);
                    } else {
                        throw new Exception(validation_errors());
                    }
                } else if($method=="delete") {
                    if(!$id) throw new Exception("Must provide :id to delete");
                    if($this->LoyaltyPointModel->delete($id)) $data = "Deleted successfully";
                }

                if(!isset($data)) throw new Exception("Could not get data");

                $response = array("success"=>true, "data"=>$data);
            } catch(Exception $e) {
                $response = array("success"=>false, "message"=>$e->getMessage());
            } 

            echo json_encode($response);   
        }  


        public function list_view(){
            $params = array();
            if(isset($_GET["restro_id"])) $params["restro_id"] = $_GET["restro_id"];
            if(isset($_GET["location_id"])) $params["location_id"] = $_GET["location_id"];
            if(isset($_GET["service_id"])) $params["service_id"] = $_GET["service_id"];
            $data['data'] = $this->LoyaltyPointModel->find($params); 

            $data['restro_list'] = $this->Restaurant_management->get_all_restro_list();
            $this->load->view("Administration/loyalty_point/list", $data);             
        } 

        public function edit_view()
        {

            $id = $this->uri->segment('2');

            $data['restro_list'] = $this->Restaurant_management->get_all_restro_list(); 

            if($id) {                                                                                                                           
                $data['data'] = $item = $this->LoyaltyPointModel->findById($id);
                $data['location_list'] = $this->Restaurant_management->getLocationsForRestro($item->restro_id);                           
                $data['service_list'] = $this->Restaurant_management->getServicesForRestroLocation($item->restro_id, $item->location_id);                           
            }
            $this->load->view("Administration/loyalty_point/edit", $data); 
        }   
}