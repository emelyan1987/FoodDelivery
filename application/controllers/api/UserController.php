<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    // This can be removed if you use __autoload() in config.php OR use Modular Extensions
    require APPPATH . '/libraries/REST_Controller.php';

    require APPPATH . '/libraries/Twilio/autoload.php';

    // Use the REST API Client to make requests to the Twilio REST API
    use Twilio\Rest\Client;

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
    class UserController extends REST_Controller {
        function __construct()
        {
            // Construct the parent class
            parent::__construct();
            // Configure limits on our controller methods
            // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
            $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
            $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
            $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key  

            $this->load->library('form_validation');
            $this->load->model('UserModel');
            $this->load->model('UserSmsModel');
            $this->lang->load('api');

            $this->load->helper("http");
            $this->load->helper("utils");

            $this->load->config('twilio');
        } 

        private function validate() {
            $this->messages = array();
            $valid = true;

            if(!$this->form_validation->required($this->post("mobile_no"))) {
                $this->messages[] = $this->lang->line("mobile_no_required");  
                $valid = false;
            }

            if(!$this->form_validation->required($this->post("first_name"))) {
                $this->messages[] = $this->lang->line("first_name_required");
                $valid = false;
            }

            if(!$this->form_validation->required($this->post("last_name"))) {
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
                if ($id === NULL)
                {
                    $users = $this->UserModel->find(null);                     

                    $resource = array();
                    foreach($users as $user) {
                        $resource[] = $this->UserModel->getPublicFields($user);    
                    }
                } else {                         
                    $user = $this->UserModel->findById($id);                    
                    if($user) {
                        $resource = $this->UserModel->getPublicFields($user);
                    }
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
                    ), getHttpErrorStatus($e->getCode()));
            }
        }


        public function index_post()
        {
            try { 
                if(!$this->validate()) {
                    throw new Exception(implode(",", $this->messages), RESULT_ERROR_PARAMS_INVALID);
                }

                // Check duplicate
                if($this->post('email')) {
                    $users = $this->UserModel->find(array("email"=>$this->post('email')));
                    if(count($users)) {
                        throw new Exception($this->lang->line('email_duplicated'), RESULT_ERROR_PARAMS_INVALID);
                    }
                }  

                $users = $this->UserModel->find(array("mobile_no"=>$this->post('mobile_no')));
                if(count($users)) {
                    throw new Exception($this->lang->line('mobile_no_duplicated'), RESULT_ERROR_PARAMS_INVALID);
                }


                $data = array();

                $hasher = new PasswordHash(
                    $this->config->item('phpass_hash_strength', 'tank_auth'),
                    $this->config->item('phpass_hash_portable', 'tank_auth'));

                $data["mobile_no"] = $this->post('mobile_no');
                $data["first_name"] = $this->post('first_name');
                $data["last_name"] = $this->post('last_name');
                $data["password"] = $hasher->HashPassword($this->post('password'));
                if($this->post('email')) {                                        
                    $data["email"] = $this->post('email');
                }

                $id = $this->UserModel->create($data);

                $user = $this->UserModel->findById($id);

                $this->response(array(
                    "code"=>RESULT_SUCCESS,
                    "resource"=>$this->UserModel->getPublicFields($user)   
                    ), REST_Controller::HTTP_CREATED); 

            } catch (Exception $e) {
                $this->response(array(
                    "code"=>$e->getCode(),
                    "message"=>$e->getMessage()
                    ), getHttpErrorStatus($e->getCode()));
            }                 
        }


        public function index_put($id=null)
        {
            try{

                if($id == null) {
                    throw new Exception($this->lang->line('id_required'), RESULT_ERROR_ID_REQUIRED);
                }

                $data = array();

                if($this->put("mobile_no")) $data["mobile_no"] = $this->put("mobile_no");
                if($this->put("first_name")) $data["first_name"] = $this->put("first_name");
                if($this->put("last_name")) $data["last_name"] = $this->put("last_name");
                if($this->put("email")) $data["email"] = $this->put("email");

                // Check duplicate
                if(isset($data["email"])) {
                    $users = $this->UserModel->find(array("email"=>$data["email"]));
                    if(count($users) && $users[0]->id!=$id) {
                        throw new Exception($this->lang->line('email_duplicated'), RESULT_ERROR_PARAMS_INVALID);
                    }
                }  

                if(isset($data["mobile_no"])) {
                    $users = $this->UserModel->find(array("mobile_no"=>$data["mobile_no"]));
                    if(count($users) && $users[0]->id!=$id) {                        
                        throw new Exception($this->lang->line('mobile_no_duplicated'), RESULT_ERROR_PARAMS_INVALID);
                    }
                }

                if(!empty($data)) { 
                    $this->UserModel->update($id, $data);
                }

                $user = $this->UserModel->findById($id);
                $this->response(array(
                    "code"=>RESULT_SUCCESS,
                    "resource"=>$this->UserModel->getPublicFields($user)
                    ), REST_Controller::HTTP_ACCEPTED); 
            } catch (Exception $e) {
                $this->response(array(
                    "code"=>$e->getCode(),
                    "message"=>$e->getMessage()
                    ), getHttpErrorStatus($e->getCode()));
            } 



        }

        public function index_delete($id=null)
        {
            try{
                if($id == null) {
                    throw new Exception($this->lang->line('id_required'), RESULT_ERROR_ID_REQUIRED);
                }

                $user = $this->UserModel->findById($id);
                if(!$user) {
                    throw new Exception($this->lang->line('resource_not_found'), RESULT_ERROR_RESOURCE_NOT_FOUND);
                }
                $this->UserModel->delete($id);

                $this->response(array("code"=>RESULT_SUCCESS), REST_Controller::HTTP_ACCEPTED);
            } catch (Exception $e) {
                $this->response(array(
                    "code"=>$e->getCode(),
                    "message"=>$e->getMessage()
                    ), getHttpErrorStatus($e->getCode()));
            } 
        }

        public function sendSmsCode_post($user_id) {
            try { 
                $mobile_no = $this->post('mobile_no');
                if(!$user_id || !isset($mobile_no)) {
                    throw new Exception($this->lang->line('parameter_incorrect'), RESULT_ERROR_PARAMS_INVALID);
                }

                $user = $this->UserModel->find(array(
                    'id'=>$user_id,
                    'mobile_no'=>$mobile_no
                ));        

                if(!$user) {
                    throw new Exception($this->lang->line('resource_not_found'), RESULT_ERROR_RESOURCE_NOT_FOUND);
                }

                $code = generateRandomCode(6);
                $client = new Client($this->config->item('twilio_account_sid'), $this->config->item('twilio_auth_token'));
                $client->messages->create(
                    $mobile_no,
                    array(
                        'from' => $this->config->item('twilio_phone_number'),
                        'body' => "Mataam register verification code! ".$code
                    )
                );


                $data["user_id"] = $user_id;
                $data["mobile_no"] = $mobile_no;
                $data["code"] = $code;


                $id = $this->UserSmsModel->create($data);

                $this->response(array("code"=>RESULT_SUCCESS), REST_Controller::HTTP_CREATED); 

            } catch (Exception $e) {
                $this->response(array(
                    "code"=>$e->getCode(),
                    "message"=>$e->getMessage()
                    ), getHttpErrorStatus($e->getCode()));
            } 
        }

        public function verifySmsCode_post($user_id) {
            try { 
                $mobile_no = $this->post('mobile_no');
                $code = $this->post('code');
                if(!$user_id || !isset($mobile_no) || !isset($code)) {
                    throw new Exception($this->lang->line('parameter_incorrect'), RESULT_ERROR_PARAMS_INVALID);
                }

                $user = $this->UserSmsModel->findOne(array(
                    'user_id'=>$user_id,
                    'mobile_no'=>$mobile_no
                ));        

                if(!$user) {
                    throw new Exception($this->lang->line('resource_not_found'), RESULT_ERROR_RESOURCE_NOT_FOUND);
                }
                
                if($user->code != $code) {
                    throw new Exception($this->lang->line('code_invalid'), RESULT_ERROR_PARAMS_INVALID);
                }

                if(strtotime($user->expires_at) < time()) {
                    throw new Exception($this->lang->line('code_expired'), RESULT_ERROR_PARAMS_INVALID);
                }

                $data["sms_verified"] = true;
                $this->UserModel->update($user_id, $data);

                $this->response(array("code"=>RESULT_SUCCESS), REST_Controller::HTTP_ACCEPTED); 

            } catch (Exception $e) {
                $this->response(array(
                    "code"=>$e->getCode(),
                    "message"=>$e->getMessage()
                    ), getHttpErrorStatus($e->getCode()));
            } 
        }
}