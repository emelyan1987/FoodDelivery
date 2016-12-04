<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    // This can be removed if you use __autoload() in config.php OR use Modular Extensions
    require 'MyRestController.php';

    class DeviceController extends MyRestController {
        function __construct()
        {
            // Construct the parent class
            parent::__construct();                  

            $this->load->model('UserDeviceModel');
        } 
        
        public function index_get($id=null)
        {                 
            try {                
                $this->validateAccessToken();

                if ($id === NULL)
                {               
                    $resource = $this->UserDeviceModel->find(array("user_id"=>$this->user->id)); 
                } else {     
                    $resource = $this->UserDeviceModel->findById($id);
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

        public function index_post()
        {                 
            try {                
                $this->validateAccessToken();
                
                $device_id = $this->post('device_id');
                if(!isset($device_id)) {
                    throw new Exception("device_id ".$this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                }
                $device_type = $this->post('device_type');
                if(!isset($device_type)) {
                    throw new Exception("device_type ".$this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                }
                $device_token = $this->post('device_token');
                if(!isset($device_token)) {
                    throw new Exception("device_token ".$this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                }
                $dev_mode = $this->post('dev_mode');
                if(!isset($dev_mode)) {
                    throw new Exception("dev_mode ".$this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                }

                $insert_id = $this->UserDeviceModel->create(array(
                    "user_id"=>$this->user->id,
                    "device_id"=>$this->post('device_id'),
                    "device_type"=>$this->post('device_type'),
                    "device_token"=>$this->post('device_token'),
                    "dev_mode"=>$this->post('dev_mode')
                ));
                $resource = $this->UserDeviceModel->findById($insert_id);

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