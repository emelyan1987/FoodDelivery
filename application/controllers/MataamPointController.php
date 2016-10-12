<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
    @ob_start();
    class MataamPointController extends CI_Controller
    { 
        function __construct()
        {
            parent::__construct();

            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->helper('security');
            $this->load->library('tank_auth');
            $this->lang->load('tank_auth');
            $this->load->model("MataamPointModel");                      
            $this->load->helper('restaurant_helper');                        
        }

        function index(){
            $method = $this->input->method();
            
            if($method == 'post') {
                try {
                    $data = $this->input->post('data');
                    
                    foreach($data as $item) {
                        $this->MataamPointModel->save($item);
                    }
                    $response = array("success"=>true, "data"=>$data);
                } catch(Exception $e) {
                    $response = array("success"=>false, "message"=>$e->getMessage());
                }
            }
            
            echo json_encode($response);
        } 

        public function edit_view()
        {      
            $data['data'] = $this->MataamPointModel->read();
            $this->load->view("Administration/mataam_point/edit", $data); 
        }   
}