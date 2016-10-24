<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    // This can be removed if you use __autoload() in config.php OR use Modular Extensions
    require 'MyRestController.php';

    /**
    * This is an example of a few basic user interaction methods you could use
    * all done with a hardcoded array
    *
    * @package         CodeIgniter
    * @subpackage      Rest Server
    * @category        Controller
    * @author          Phil Sturgeon, Chris Kacerguis
    * @license         MIT
    * @link            https://github.com/chriskacerguis/codeigniter-restserver
    */
    class RestaurantController extends MyRestController {
        function __construct()
        {
            // Construct the parent class
            parent::__construct();                  

            $this->load->model('RestaurantModel');
            $this->load->model('RatingModel'); 
            $this->load->model('RestroItemCategoryModel'); 
            $this->load->model('RestroItemModel'); 
            $this->load->model('RestroItemVariationModel'); 
        } 

        private function validate() {
            $this->messages = array();
            $valid = true;

            if(!$this->form_validation->required($this->post("mobile_no"))) {
                $this->messages[] = $this->lang->line("mobile_no_required");  
                $valid = false;
            }

            if(!$this->form_validation->required($this->post("f_name"))) {
                $this->messages[] = $this->lang->line("first_name_required");
                $valid = false;
            }

            if(!$this->form_validation->required($this->post("l_name"))) {
                $this->messages[] = $this->lang->line("last_name_required");  
                $valid = false;
            }

            if(!$this->form_validation->required($this->post("password"))) {
                $this->messages[] = $this->lang->line("password_required");  
                $valid = false;
            }

            if($this->post("email") && !$this->form_validation->valid_email($this->post("email"))) {
                $this->messages[] = $this->lang->line("email_invalid");  
                $valid = false;
            }

            return $valid;
        }

        public function index_get($id=null)
        {                 
            try {                
                $this->validateAccessToken();


                if ($id === NULL)
                {               
                    $params = array();
                    if($this->get('area')) $params["area"] = $this->get('area');                                    // Single Id
                    if($this->get('cuisines')) $params["cuisines"] = $this->get('cuisines');                           // Multiple Ids
                    if($this->get('food_types')) $params["food_types"] = $this->get('food_types');                     // Multiple Ids
                    if($this->get('restro_categories')) $params["restro_categories"] = $this->get('restro_categories');   // Multiple Ids                  
                    if($this->get('service_type')) $params["service_type"] = $this->get('service_type');   // Service Type

                    $resource = $this->RestaurantModel->find($params); 
                } else {                         
                    $resource = $this->RestaurantModel->findById($id); 
                }

                if(!$resource) {
                    throw new Exception($this->lang->line('resource_not_found'), RESULT_ERROR_RESOURCE_NOT_FOUND); 
                }  
                $this->response(array(
                    "code"=>RESULT_SUCCESS,    
                    "resource"=>$resource
                    ), REST_Controller::HTTP_OK);

            } catch (Exception $e) {
                $this->response(array(
                    "code"=>$e->getCode(),
                    "message"=>$e->getMessage()
                    ), REST_Controller::HTTP_OK);
            }
        }

        public function ratings_get()
        {                 
            try {                
                $this->validateAccessToken();

                $location_id = $this->input->get('location_id');
                if(!isset($location_id)) {
                    throw new Exception("location_id ".$this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                }

                $params = array();

                $params["user_id"] = $this->user->id;                    
                $params["location_id"] = $location_id;

                $resource = $this->RatingModel->find($params, array("r.id","r.restro_id","r.location_id","r.user_id","r.msg","r.star_value","r.date"));

                if(!$resource) {
                    throw new Exception($this->lang->line('resource_not_found'), RESULT_ERROR_RESOURCE_NOT_FOUND); 
                }  
                $this->response(array(
                    "code"=>RESULT_SUCCESS,    
                    "resource"=>$resource
                    ), REST_Controller::HTTP_OK);

            } catch (Exception $e) {
                $this->response(array(
                    "code"=>$e->getCode(),
                    "message"=>$e->getMessage()
                    ), REST_Controller::HTTP_OK);
            }
        }

        public function ratings_post()
        {                 
            try {                
                $this->validateAccessToken();

                $location_id = $this->post('location_id');
                if(!isset($location_id)) {
                    throw new Exception("location_id ".$this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                }
                $star_value = $this->post('star_value');
                if(!isset($star_value)) {
                    throw new Exception("star_value ".$this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                }
                $msg = $this->post('msg');
                if(!isset($msg)) {
                    throw new Exception("msg ".$this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                }

                $params = array();

                $params["user_id"] = $this->user->id;                                        
                $params["location_id"] = $location_id;

                $params["star_value"] = $star_value;
                $params["msg"] = $msg;
                $params["ip"] = $_SERVER['REMOTE_ADDR'];
                $params["date"] = date("Y-m-d");

                $insert_id = $this->RatingModel->create($params);
                $resource = $this->RatingModel->findById($insert_id);

                $this->response(array(
                    "code"=>RESULT_SUCCESS,    
                    "resource"=>$resource
                    ), REST_Controller::HTTP_OK);

            } catch (Exception $e) {
                $this->response(array(
                    "code"=>$e->getCode(),
                    "message"=>$e->getMessage()
                    ), REST_Controller::HTTP_OK);
            }
        } 

        public function item_categories_get()
        {                 
            try {                
                $this->validateAccessToken();

                $location_id = $this->input->get('location_id');
                if(!isset($location_id)) {
                    throw new Exception("location_id ".$this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                }

                $service_id = $this->input->get('service_id');
                if(!isset($service_id)) {
                    throw new Exception("service_id ".$this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                }

                $params = array();

                $params["location_id"] = $location_id;                    
                $params["service_id"] = $service_id;                    

                $resource = $this->RestroItemCategoryModel->find($params, array("id", "cat_name", "item_cat_description", "image", "status", "location_id", "service_id"));

                if(!$resource) {
                    throw new Exception($this->lang->line('resource_not_found'), RESULT_ERROR_RESOURCE_NOT_FOUND); 
                }  
                $this->response(array(
                    "code"=>RESULT_SUCCESS,    
                    "resource"=>$resource
                    ), REST_Controller::HTTP_OK);

            } catch (Exception $e) {
                $this->response(array(
                    "code"=>$e->getCode(),
                    "message"=>$e->getMessage()
                    ), REST_Controller::HTTP_OK);
            }
        }   

        public function items_get($id=null)
        {                 
            try {                
                $this->validateAccessToken();

                if($id) {
                    $item = $this->RestroItemModel->findById($id);
                    
                    $vlist = $this->RestroItemVariationModel->findByItemId($id);                    
                    $variations = array();
                    foreach($vlist as $v) {
                        if(!isset($variations[$v->variation_id])) {
                            $variations[$v->variation_id] = array("id"=>$v->variation_id, "name"=>$v->variation_name, "type"=>$v->variation_type, "details"=>array());                            
                        }
                        $variations[$v->variation_id]["details"][] = array("id"=>$v->id, "title"=>$v->title, "price"=>$v->price);
                    }
                    
                    $item->variations = array_values($variations);
                    $resource = $item;
                } else {
                    $category_id = $this->input->get('category_id');
                    if(!isset($category_id)) {
                        throw new Exception("category_id ".$this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                    }  
                    $params = array();  
                    $params["category_id"] = $category_id;                   
                    $resource = $this->RestroItemModel->find($params);

                }

                if(!$resource) {
                    throw new Exception($this->lang->line('resource_not_found'), RESULT_ERROR_RESOURCE_NOT_FOUND); 
                }  
                $this->response(array(
                    "code"=>RESULT_SUCCESS,    
                    "resource"=>$resource
                    ), REST_Controller::HTTP_OK);

            } catch (Exception $e) {
                $this->response(array(
                    "code"=>$e->getCode(),
                    "message"=>$e->getMessage()
                    ), REST_Controller::HTTP_OK);
            }
        }       

}