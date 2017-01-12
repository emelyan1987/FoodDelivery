<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    // This can be removed if you use __autoload() in config.php OR use Modular Extensions
    require APPPATH . '/libraries/REST_Controller.php';  

    require 'ApiException.php';
    
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
            
            $this->load->model('UserModel');
            $this->load->model('UserAccessTokenModel');      
            $this->load->model('UserProfileModel');      
        } 
        
        function validateAccessToken() {
            $token = isset($_SESSION['access_token']) ? $_SESSION['access_token'] : $this->input->get('access_token');
            
            if(!isset($token)) {
                throw new ApiException($this->lang->line('access_token_required'), RESULT_ERROR_ACCESS_TOKEN_REQUIRED, 'access_token');
            }
            
            $accessToken = $this->UserAccessTokenModel->findByToken($token);
            
            if(!$accessToken) {
                throw new ApiException($this->lang->line('access_token_invalid'), RESULT_ERROR_ACCESS_TOKEN_INVALID, 'access_token');
            } else {
                if(strtotime($accessToken->created_at)+$accessToken->ttl < time()) {
                    throw new Exception($this->lang->line('access_token_expired'), RESULT_ERROR_ACCESS_TOKEN_EXPIRED)  ;
                }
            }
            
            $user = $this->UserModel->findById($accessToken->user_id);
            
            if(!$user) {
                throw new ApiException($this->lang->line('user_invalid'), RESULT_ERROR_USER_INVALID);
            }
            
            $user->profile = $this->UserProfileModel->findByUserId($user->id);
            $this->user = $user;
        }                     
                       
}