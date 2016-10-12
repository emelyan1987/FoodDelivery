<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
    @ob_start();
    class CouponController extends CI_Controller
    {

        function __construct()
        {
            parent::__construct();

            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->helper('security');
            $this->load->library('tank_auth');
            $this->lang->load('tank_auth');
            $this->load->model("CouponModel");
            $this->load->model("Administration/Restaurant_management");
            $this->load->helper('restaurant_helper');


            $this->form_validation->set_rules('restro_id', 'Restaurant', 'required');
            $this->form_validation->set_rules('location_id', 'Location', 'required');
            $this->form_validation->set_rules('coupon_code', 'Coupon Code', 'required');
            $this->form_validation->set_rules('from_date', 'From Date', 'required');
            $this->form_validation->set_rules('to_date', 'To Date', 'required');
            $this->form_validation->set_rules('discount', 'Discount', 'required');

        }

        function index(){
            $method = $this->input->method();
            $id = $this->uri->segment(2);

            try {         
                if($method=="get") {
                    if($id) {
                        $data = $this->CouponModel->findById($id);
                    } else {
                        $params = array();
                        $params["restro_id"] = $this->input->get("restro_id");
                        $params["location_id"] = $this->input->get("location_id");
                        $data = $this->CouponModel->find($params);
                    }
                } else if($method=="post") {
                    if ($this->form_validation->run() == TRUE)
                    {
                        $coupon['restro_id']=$this->input->post('restro_id');
                        $coupon['location_id']=$this->input->post('location_id');
                        $coupon['coupon_code']=$this->input->post('coupon_code');
                        $coupon['from_date']=$this->input->post('from_date');
                        $coupon['to_date']=$this->input->post('to_date');
                        $coupon['discount']=$this->input->post('discount'); 

                        if(!$id) {                                                                                               
                            $id = $this->CouponModel->create($coupon);                     
                        } else {
                            $this->CouponModel->update($id, $coupon); 
                        }  

                        $data = $this->CouponModel->findById($id);
                    } else {
                        throw new Exception(validation_errors());
                    }
                } else if($method=="delete") {
                    if(!$id) throw new Exception("Must provide :id to delete");
                    if($this->CouponModel->delete($id)) $data = "Deleted successfully";
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
            $data['data'] = $this->CouponModel->find($params); 

            $data['restro_list'] = $this->Restaurant_management->get_all_restro_list();
            $this->load->view("Administration/coupon/list", $data);             
        } 

        public function edit_view()
        {

            $id = $this->uri->segment('2');

            $data['restro_list'] = $this->Restaurant_management->get_all_restro_list(); 
            
            if($id) {                                                                                                                           
            $data['data'] = $item = $this->CouponModel->findById($id);
            $data['location_list'] = $this->Restaurant_management->getLocationsForRestro($item->restro_id);                           
            }
            $this->load->view("Administration/coupon/edit", $data); 
        }   
}