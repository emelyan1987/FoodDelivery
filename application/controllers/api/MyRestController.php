<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    // This can be removed if you use __autoload() in config.php OR use Modular Extensions
    require APPPATH . '/libraries/REST_Controller.php';  



    class MyRestController extends REST_Controller {
        const ACCESS_TOKEN_INVALID = -1;
        const ACCESS_TOKEN_EXPIRED = -2;
        
        function __construct()
        {
            // Construct the parent class
            parent::__construct();              

            $this->load->library('form_validation');  
            $this->lang->load('api');

            $this->load->helper("http");
            $this->load->helper("utils");
            $this->load->helper("acl");  
            
            $this->load->model('UserModel');
            $this->load->model('UserAccessTokenModel');      
        } 
        
        function validateAccessToken() {
            $token = $this->input->get('access_token');
            
            if(!isset($token)) {
                throw new Exception($this->lang->line('access_token_required'), RESULT_ERROR_ACCESS_TOKEN_REQUIRED);
            }
            
            $accessToken = $this->UserAccessTokenModel->findByToken($token);
            
            if(!$accessToken) {
                throw new Exception($this->lang->line('access_token_invalid'), RESULT_ERROR_ACCESS_TOKEN_INVALID);
            } else {
                if(strtotime($accessToken->created_at)+$accessToken->ttl < time()) {
                    throw new Exception($this->lang->line('access_token_expired'), RESULT_ERROR_ACCESS_TOKEN_EXPIRED)  ;
                }
            }
            
            $user = $this->UserModel->findById($accessToken->user_id);
            
            if(!$user) {
                throw new Exception($this->lang->line('user_invalid'), RESULT_ERROR_USER_INVALID);
            }
            
            $this->user = $user;
        }                     
                       
}