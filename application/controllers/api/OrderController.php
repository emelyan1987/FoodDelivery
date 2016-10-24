<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    // This can be removed if you use __autoload() in config.php OR use Modular Extensions
    require 'MyRestController.php';


    class OrderController extends MyRestController {
        function __construct()
        {
            // Construct the parent class
            parent::__construct();                  


            $this->load->model('RestroItemModel'); 
            $this->load->model('CartModel'); 
            $this->load->model('RestaurantModel');  
            $this->load->model('CouponModel'); 
            $this->load->model('LoyaltyPointModel'); 
            $this->load->model('MataamPointModel'); 
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

        public function index_post()
        {                 
            try {                
                $this->validateAccessToken();

                $service_type = $this->input->get('service_type');
                if(!isset($service_type)) {
                    throw new Exception("service_type ".$this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                }
                $product_id = $this->post('product_id');
                if(!isset($product_id)) {
                    throw new Exception("product_id ".$this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                }
                $quantity = $this->post('quantity');
                if(!isset($quantity) || $quantity<=0) {
                    throw new Exception("quantity ".$this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                } 

                $item = $this->RestroItemModel->findById($product_id);

                $params = array();


                $params["user_id"] = $this->user->id;                                                        
                $params["product_id"] = $product_id;
                $params["quantity"] = $quantity;
                $params["price"] = $item->price;
                $params["restro_id"] = $item->restro_id;

                $params["spacial_request"] = $this->post('spacial_request');
                $params["variation_ids"] = $this->post('variation_ids');    // variation ids string delimited by comma(,)
                $params["date"] = date("Y-m-d H:i:s");

                $insert_id = $this->CartModel->create($service_type, $params);
                $resource = $this->CartModel->findById($service_type, $insert_id);

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

        public function cart_post()
        {                 
            try {                
                $this->validateAccessToken();

                $service_type = $this->input->get('service_type');
                if(!isset($service_type)) {
                    throw new Exception("service_type ".$this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                }
                $product_id = $this->post('product_id');
                if(!isset($product_id)) {
                    throw new Exception("product_id ".$this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                }
                $quantity = $this->post('quantity');
                if(!isset($quantity) || $quantity<=0) {
                    throw new Exception("quantity ".$this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                } 
                $variation_ids = $this->post('variation_ids');
                
                $item = $this->RestroItemModel->findById($product_id);

                $params = array();


                $params["user_id"] = $this->user->id;                                                        
                $params["product_id"] = $product_id;
                $params["quantity"] = $quantity;
                $params["price"] = $item->price;
                $params["restro_id"] = $item->restro_id;

                $params["spacial_request"] = $this->post('spacial_request');
                $params["variation_ids"] = isset($variation_ids) ? $variation_ids : 0;    // variation ids string delimited by comma(,)
                $params["date"] = date("Y-m-d H:i:s");

                $insert_id = $this->CartModel->create($service_type, $params);
                $resource = $this->CartModel->findById($service_type, $insert_id);

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

        public function cart_put($id)
        {                 
            try {                
                $this->validateAccessToken();

                if(!isset($id)) {
                    throw new Exception("id ".$this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                }

                $service_type = $this->input->get('service_type');
                if(!isset($service_type)) {
                    throw new Exception("service_type ".$this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                }
                $product_id = $this->put('product_id');
                if(!isset($product_id)) {
                    throw new Exception("product_id ".$this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                }
                $quantity = $this->put('quantity');
                if(!isset($quantity) || $quantity<=0) {
                    throw new Exception("quantity ".$this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                } 

                $item = $this->RestroItemModel->findById($product_id);

                $params = array();


                $params["user_id"] = $this->user->id;                                                        
                $params["product_id"] = $product_id;
                $params["quantity"] = $quantity;
                $params["price"] = $item->price;
                $params["restro_id"] = $item->restro_id;

                $params["spacial_request"] = $this->put('spacial_request');
                $params["variation_ids"] = $this->put('variation_ids');    // variation ids string delimited by comma(,)
                $params["date"] = date("Y-m-d H:i:s");

                $this->CartModel->update($service_type, $id, $params);
                $resource = $this->CartModel->findById($service_type, $id);

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

        public function cart_delete($id)
        {                 
            try {                
                $this->validateAccessToken();

                if(!isset($id)) {
                    throw new Exception("id ".$this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                }

                $service_type = $this->input->get('service_type');
                if(!isset($service_type)) {
                    throw new Exception("service_type ".$this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                }

                $this->CartModel->delete($service_type, $id); 

                $this->response(array(
                    "code"=>RESULT_SUCCESS
                    ), REST_Controller::HTTP_OK);

            } catch (Exception $e) {
                $this->response(array(
                    "code"=>$e->getCode(),
                    "message"=>$e->getMessage()
                    ), REST_Controller::HTTP_OK);
            }
        } 

        public function cart_get($id=null)
        {                 
            try {                
                $this->validateAccessToken();

                $service_type = $this->get('service_type');

                if($id == null) {
                    $params = array();
                    $params["user_id"] = $this->user->id;

                    $restro_id = $this->get('restro_id');
                    if(isset($restro_id)) $params["restro_id"] = $restro_id;

                    if(isset($service_type)) {
                        $carts = $this->CartModel->find($service_type, $params);
                    } else {
                        $carts = array_merge($this->CartModel->find(1, $params), $this->CartModel->find(2, $params), $this->CartModel->find(3, $params), $this->CartModel->find(4, $params));                        
                    }       

                    if(!$carts) {
                        throw new Exception($this->lang->line('resource_not_found'), RESULT_ERROR_RESOURCE_NOT_FOUND); 
                    }

                    foreach($carts as $cart) {
                        $cart->item = $this->RestroItemModel->findById($cart->product_id);
                        $cart->restaurant = $this->RestaurantModel->findById($cart->restro_id);
                    }
                    $resource = $carts;  
                } else {
                    if(!isset($service_type)) {
                        throw new Exception("service_type ".$this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                    }
                    $cart = $this->CartModel->findById($service_type, $id);
                    if(!$cart) {
                        throw new Exception($this->lang->line('resource_not_found'), RESULT_ERROR_RESOURCE_NOT_FOUND); 
                    }

                    $cart->item = $this->RestroItemModel->findById($cart->product_id);
                    $cart->restaurant = $this->RestaurantModel->findById($cart->restro_id);

                    $resource = $cart;
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

        public function discount_get()
        {                 
            try {                
                $this->validateAccessToken();

                $service_type = $this->get('service_type');                 

                $restro_id = $this->get('restro_id');
                if(!isset($restro_id)) {
                    throw new Exception('restro_id ' . $this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                }

                $redeem_type = $this->get('redeem_type');
                if(!isset($redeem_type)) {
                    throw new Exception('redeem_type ' . $this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                }

                $params = array();
                $params["user_id"] = $this->user->id; 
                $params["restro_id"] = $restro_id;

                if(isset($service_type)) {
                    $carts = $this->CartModel->find($service_type, $params);
                } else {
                    $carts = array_merge($this->CartModel->find(1, $params), $this->CartModel->find(2, $params), $this->CartModel->find(3, $params), $this->CartModel->find(4, $params));                        
                }       

                if(!$carts) {
                    throw new Exception('Cart list ' . $this->lang->line('resource_not_found'), RESULT_ERROR_RESOURCE_NOT_FOUND); 
                }

                $total_price = 0; $total_point = 0;
                foreach($carts as $cart) {
                    $total_price += $cart->price * $cart->quantity;

                    $item = $this->RestroItemModel->findById($cart->product_id);    
                    $total_point += $item->redeem_point * $cart->quantity;
                }


                if($redeem_type == 1) { // Redeem Coupon
                    $coupon_code = $this->get('coupon_code');
                    if(!isset($coupon_code)) {
                        throw new Exception('coupon_code ' . $this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                    }

                    $coupon = $this->CouponModel->findOne(array("coupon_code"=>$coupon_code));
                    if(!$coupon) {
                        throw new Exception($this->lang->line('coupon_code_invalid'), RESULT_ERROR_PARAMS_INVALID);
                    }
                    if($coupon->from_date != '')
                    {
                        $today = date('Y-m-d');
                        if($today >= $coupon->from_date && $today <= $coupon->to_date)
                        {                                 
                            $resource = array("discount_amount"=>($total_price * $coupon->discount) / 100);
                        } else {
                            throw new Exception($this->lang->line('coupon_code_expired'), RESULT_ERROR_PARAMS_INVALID);
                        }
                    } else {
                        throw new Exception($this->lang->line('coupon_code_invalid'), RESULT_ERROR_PARAMS_INVALID);
                    } 
                } else if($redeem_type == 2) {  // Loyalty Points
                    if(!isset($service_type)) {
                        throw new Exception('service_type ' . $this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                    }
                    $params["service_id"] = $service_type;
                    $loyalty_point = $this->LoyaltyPointModel->findOne($params);
                    
                    if(!$loyalty_point) {
                        throw new Exception($this->lang->line('resource_not_found'), RESULT_ERROR_RESOURCE_NOT_FOUND);
                    }
                    
                    $discount = 0;
                    if($total_point >= $loyalty_point->from1 && $total_point <= $loyalty_point->to1) {
                        $discount = $loyalty_point->discount1;
                    } else if($total_point >= $loyalty_point->from2 && $total_point <= $loyalty_point->to2) {
                        $discount = $loyalty_point->discount2;
                    } else if($total_point >= $loyalty_point->from3 && $total_point <= $loyalty_point->to3) {
                        $discount = $loyalty_point->discount3;
                    }
                    
                    $resource = array("discount_amount"=>($total_price * $discount) / 100);
                } else if($redeem_type == 3) {  // Mataam Points
                    if(!isset($service_type)) {
                        throw new Exception('service_type ' . $this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                    }
                    $mataam_point = $this->MataamPointModel->findByServiceId($service_type);                    
                    
                    if(!$mataam_point) {
                        throw new Exception($this->lang->line('resource_not_found'), RESULT_ERROR_RESOURCE_NOT_FOUND);
                    } 
                    
                    $discount = 0;
                    if($total_point >= $mataam_point->from && $total_point <= $mataam_point->to) {
                        $discount = $mataam_point->discount;
                    }
                    
                    $resource = array("discount_amount"=>($total_price * $discount) / 100);
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