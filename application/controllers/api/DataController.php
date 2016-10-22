<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    // This can be removed if you use __autoload() in config.php OR use Modular Extensions
    require 'MyRestController.php';
    
    class DataController extends MyRestController {
        function __construct()
        {
            // Construct the parent class
            parent::__construct();
            // Configure limits on our controller methods
            // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
            $this->methods['areas_get']['limit'] = 500; // 500 requests per hour per user/key
            $this->methods['areas_post']['limit'] = 100; // 100 requests per hour per user/key
            $this->methods['areas_delete']['limit'] = 50; // 50 requests per hour per user/key  

            $this->load->model('CityModel'); 
            $this->load->model('AreaModel'); 
            $this->load->model('CuisineModel'); 
            $this->load->model('FoodTypeModel'); 
            $this->load->model('RestroCategoryModel'); 
        } 
             

        public function cities_get()
        {                 
            try {                
                $this->validateAccessToken();

                $keyword = $this->get('keyword');
                $resource = $this->CityModel->find(array("name"=>$keyword));

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
         
        public function areas_get()
        {                 
            try {                
                $this->validateAccessToken();

                $city_id = $this->get('city_id');
                $keyword = $this->get('keyword');
                $resource = $this->AreaModel->find(array("city_id"=>$city_id,"name"=>$keyword));

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
        public function cuisines_get()
        {                 
            try {                
                $this->validateAccessToken();

                $keyword = $this->get('keyword');
                $resource = $this->CuisineModel->find(array("name"=>$keyword));

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
         
        public function food_types_get()
        {                 
            try {                
                $this->validateAccessToken();

                $keyword = $this->get('keyword');
                $resource = $this->FoodTypeModel->find(array("name"=>$keyword));

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
         
        public function restro_categories_get()
        {                 
            try {                
                $this->validateAccessToken();

                $keyword = $this->get('keyword');
                $resource = $this->RestroCategoryModel->find(array("name"=>$keyword));

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