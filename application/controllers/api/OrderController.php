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
            $this->load->model('RestroCityAreaModel'); 
            $this->load->model('OrderModel'); 
            $this->load->model('OrderDetailModel'); 
            $this->load->model('RestroSeatingHourModel'); 
            $this->load->model('RestroTableOrderModel'); 
            $this->load->model('PointLogModel'); 
            $this->load->helper('utils');
            $this->load->helper('order');
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
                $service_type = $this->get('service_type');
                if ($id === NULL)
                {               
                    $offset = $this->get('offset') ? $this->get('offset') : 0;
                    $limit = $this->get('limit') ? $this->get('limit') : 50;
                    $params = array();
                    $params["user_id"] = $this->user->id;
                    $params["offset"] = $offset;
                    $params["limit"] = $limit;
                    if(isset($service_type)) {                     
                        $orders = $this->OrderModel->find($service_type, $params);    
                    } else {
                        $orders = array_merge($this->OrderModel->find(1, $params), $this->OrderModel->find(2, $params), $this->OrderModel->find(4, $params)); 
                    }
                    foreach($orders as $order) {                       
                        $restaurant = $order->restaurant = $this->RestaurantModel->findByRestroLocationService($order->restro_id, $order->location_id, $order->service_type);
                        /*if($order->status == ORDER_STATUS_UNDER_PROCESS) {   
                            $now = time();
                            $order_time = strtotime($order->date." ".$order->time);
                            if($restaurant && $now - $order_time >= $restaurant->order_time) {
                                $order->status = 3; //Completed
                            } else {
                                $order->status = 1; //Under Process
                            }
                        }*/
                    }
                    
                    object_array_sort_by_column($orders, 'created_time', SORT_DESC);
                    $resource = $orders;
                } else {                         
                    $order = $this->OrderModel->findById($service_type, $id); 
                    $order->restaurant = $this->RestaurantModel->findById($order->restro_id);
                    $resource = $order;
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
        public function my_points_get()
        {                 
            try {                
                $this->validateAccessToken();
                $service_type = $this->get('service_type');
                $offset = $this->get('offset') ? $this->get('offset') : 0;
                $limit = $this->get('limit') ? $this->get('limit') : 50;
                $params = array();
                $params["user_id"] = $this->user->id;
                if(isset($service_type)) $params["service_id"] = $service_type;
                $params["offset"] = $offset;
                $params["limit"] = $limit;


                $points = $this->PointLogModel->find($params);
                foreach($points as $point) {
                    $order = $point->order = $this->OrderModel->findById($point->service_id, $point->order_id);
                    if($order) $point->restaurant = $this->RestaurantModel->findByRestroLocationService($order->restro_id, $order->location_id, $order->service_type);
                }
                $resource = $points;
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
        public function details_get($id)
        {                 
            try {                
                $this->validateAccessToken();
                $service_type = $this->get('service_type');
                if(!isset($service_type)) {
                    throw new Exception('service_type '.$this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                }
                if(!isset($id)) {
                    throw new Exception('id '.$this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                }
                $resource = $this->OrderDetailModel->find($service_type, array('order_id'=>$id));
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
                $area_id = $this->input->get('area_id');
                if(!isset($area_id)) {
                    throw new Exception("area_id ".$this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                }
                $restro_id = $this->input->get('restro_id');
                if(!isset($restro_id)) {
                    throw new Exception("restro_id ".$this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                }
                $location_id = $this->input->get('location_id');
                if(!isset($location_id)) {
                    throw new Exception("location_id ".$this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                }
                $order['restro_id'] = $restro_id;
                $order['location_id'] = $location_id;
                $redeem_type = $this->post('redeem_type');
                $coupon_code = $this->post('coupon_code');
                $sum = getSum($this->user->id, $service_type, $restro_id, $location_id, $area_id);
                $order['total'] = $sum['total_amount'];
                $order['delivery_charges'] = $sum['charge_amount'];            

                $point = getPoint($this->user->id, $service_type, $restro_id, $location_id); 
                if(isset($redeem_type)) {
                    $discount = getDiscount($redeem_type, $this->user->id, $service_type, $restro_id, $location_id, $coupon_code);
                    $order['discount_amount'] = $discount['discount_amount'];
                    $order['coupon_point_apply'] = $redeem_type;                   
                    if($redeem_type == 1) { //  Redeem Coupon
                        if(!isset($coupon_code)) {
                            throw new Exception('coupon_code '.$this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                        }
                        $order['coupon_code'] = $coupon_code;
                    } else if($redeem_type == 2) {  // Loyalty Point
                        $order['used_points'] = $point['loyalty']['used_points'];
                    } else if($redeem_type == 3) {  // Mataam Point
                        $order['used_points'] = $point['mataam']['used_points'];
                    }   
                }  
                $order['order_points'] = $point['loyalty']['gained_points'];       
                $order['mataam_order_points'] = $point['mataam']['gained_points'];       
                $schedule_date = $this->post('schedule_date');
                if(!isset($schedule_date)) {
                    throw new Exception('schedule_date '.$this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                }
                $schedule_time = $this->post('schedule_time');
                if(!isset($schedule_time)) {
                    throw new Exception('schedule_time '.$this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                }
                if($service_type==1 || $service_type==4) {                    
                    $order['delivery_date'] = $schedule_date;  // Y-m-d
                    $order['delivery_time'] = $schedule_time;  // H:i:s
                }
                $order['date'] = $schedule_date;  // Y-m-d
                $order['time'] = $schedule_time;  // H:i:s
                $order['user_id'] = $this->user->id;
                $payment_method = $this->post('payment_method');
                if(!isset($payment_method)) {
                    throw new Exception('payment_method '.$this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                } 
                $order['payment_method'] = $payment_method;
                $order['status'] = 1; 
                $address_id = $this->post('address_id');
                if(!isset($address_id)) {
                    throw new Exception('address_id '.$this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                }
                $order['address_id'] = $address_id;
                $order['extra_direction'] = $this->post('extra_direction'); 
                $order['restro_location_id'] = $area_id;
                $order['created_time'] = $order['updated_time'] = date('Y-m-d H:i:s');
                $order_id = $this->OrderModel->create($service_type, $order);

                // Update Order No
                $this->OrderModel->update($service_type, $order_id, array("order_no"=>$this->config->item('Start_order_id').$order_id));

                // Create Order Details
                $order_details['order_id'] = $order_id;
                $carts = $this->CartModel->find($service_type, array("user_id"=>$this->user->id, "restro_id"=>$restro_id, "location_id"=>$location_id));
                foreach($carts as $cart){
                    $order_details['product_id'] = $cart->product_id;
                    $order_details['price'] = $cart->price;
                    $order_details['quantity'] = $cart->quantity;
                    $order_details['restro_id'] = $cart->restro_id;
                    $order_details['location_id'] = $cart->location_id;
                    $order_details['notes'] = $cart->notes;
                    $order_details['user_id'] = $cart->user_id;
                    $order_details['variation_ids'] = $cart->variation_ids;
                    $this->OrderDetailModel->create($service_type, $order_details);
                }

                // Delete Cart List
                $this->CartModel->deleteAll($service_type, array('user_id'=>$this->user->id,'restro_id'=>$restro_id, 'location_id'=>$location_id));
                $params = array();
                $order = $this->OrderModel->findById($service_type, $order_id);
                $order->details = $this->OrderDetailModel->find($service_type, array('order_id'=>$order_id));

                // Update user points on profile
                $user_loyalty_points = $this->user->profile->points; $user_mataam_points = $this->user->profile->mataam_points;
                if($redeem_type == 2) {
                    $user_loyalty_points -= $point['loyalty']['used_points'];
                } else if ($redeem_type == 3) {
                    $user_mataam_points -= $point['mataam']['used_points'];
                }
                $user_loyalty_points += $point['loyalty']['gained_points'];
                $user_mataam_points += $point['mataam']['gained_points'];
                $this->UserProfileModel->save($this->user->id, array(
                    'points'=>$user_loyalty_points,
                    'mataam_points'=>$user_mataam_points
                ));

                // Create Points Log
                $this->PointLogModel->create(array(
                    'user_id'=>$this->user->id,
                    'service_id'=>$service_type,
                    'order_id'=>$order_id,
                    'gained_loyalty_point'=>$point['loyalty']['gained_points'],
                    'used_loyalty_point'=>$redeem_type==2 ? $point['loyalty']['used_points'] : 0,
                    'balance_loyalty_point'=>$user_loyalty_points,
                    'gained_mataam_point'=>$point['mataam']['gained_points'],
                    'used_mataam_point'=>$redeem_type==3 ? $point['mataam']['used_points'] : 0,
                    'balance_mataam_point'=>$user_mataam_points
                ));

                $this->response(array(
                    "code"=>RESULT_SUCCESS,    
                    "resource"=>$order
                    ), REST_Controller::HTTP_OK);
            } catch (Exception $e) {
                $this->response(array(
                    "code"=>$e->getCode(),
                    "message"=>$e->getMessage()
                    ), REST_Controller::HTTP_OK);
            }
        } 
        public function cancel_post($id)
        {                 
            try {                
                $this->validateAccessToken();
                $service_type = $this->input->get('service_type');
                if(!isset($service_type)) {
                    throw new Exception("service_type ".$this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                }
                $order = $this->OrderModel->findById($service_type, $id);
                if(!$order) {
                    throw new Exception($this->lang->line('resource_not_found'), RESULT_ERROR_RESOURCE_NOT_FOUND); 
                }
                $now = time();
                $order_time = strtotime($order->date." ".$order->time);
                if($order->user_id == $this->user->id) {
                    if($now-$order_time > 120) {
                        throw new Exception($this->lang->line('time_expired'), RESULT_ERROR); 
                    }
                } else {
                    $restaurant = $this->RestaurantModel->findById($order->restro_id);
                    if($this->user->id == $restaurant->user_id && $now-$order_time > 300) {
                        throw new Exception($this->lang->line('time_expired'), RESULT_ERROR); 
                    }
                }
                $this->OrderModel->update($service_type, $id, array("status"=>-1));
                $order = $this->OrderModel->findById($service_type, $id);
                $this->response(array(
                    "code"=>RESULT_SUCCESS,    
                    "resource"=>$order
                    ), REST_Controller::HTTP_OK);
            } catch (Exception $e) {
                $this->response(array(
                    "code"=>$e->getCode(),
                    "message"=>$e->getMessage()
                    ), REST_Controller::HTTP_OK);
            }
        } 
        // Accept customer's reservation
        public function accept_post($id)
        {                 
            try {                
                $this->validateAccessToken();
                $service_type = $this->input->get('service_type');
                if(!isset($service_type)) {
                    throw new Exception("service_type ".$this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                }
                $order = $this->OrderModel->findById($service_type, $id);
                if(!$order) {
                    throw new Exception($this->lang->line('resource_not_found'), RESULT_ERROR_RESOURCE_NOT_FOUND); 
                }
                $restaurant = $this->RestaurantModel->findById($order->restro_id);
                if($this->user->id != $restaurant->user_id) {
                    throw new Exception($this->lang->line('user_invalid'), RESULT_ERROR_ACCESS_TOKEN_INVALID); 
                }
                $this->OrderModel->update($service_type, $id, array("status"=>2));
                $order = $this->OrderModel->findById($service_type, $id);
                $this->response(array(
                    "code"=>RESULT_SUCCESS,    
                    "resource"=>$order
                    ), REST_Controller::HTTP_OK);
            } catch (Exception $e) {
                $this->response(array(
                    "code"=>$e->getCode(),
                    "message"=>$e->getMessage()
                    ), REST_Controller::HTTP_OK);
            }
        } 
        public function reserve_post()
        {                 
            try {                
                $this->validateAccessToken();
                $restro_id = $this->post('restro_id');
                if(!isset($restro_id)) {
                    throw new Exception("restro_id ".$this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                }
                $location_id = $this->post('location_id');
                if(!isset($location_id)) {
                    throw new Exception("location_id ".$this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                }
                $people_number = $this->post('people_number');
                if(!isset($people_number)) {
                    throw new Exception("people_number ".$this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                }
                $reserve_date = $this->post('reserve_date');
                if(!isset($reserve_date)) {
                    throw new Exception("reserve_date ".$this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                }
                $reserve_time = $this->post('reserve_time');
                if(!isset($reserve_time)) {
                    throw new Exception("reserve_time ".$this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                }
                $weekday = strtolower(date('l', strtotime($reserve_date)));
                $seating_info = getSeatingInfo($restro_id, $location_id, $weekday, $reserve_time);
                if($seating_info === null || !isAvailableTime($reserve_date, $reserve_time, $seating_info, $people_number, $restro_id, $location_id))  {
                    throw new Exception($this->lang->line('time_invalid'), RESULT_ERROR_PARAMS_INVALID);
                }
                $largest_party_size = $seating_info['largest_party_size'];
                if($largest_party_size > 0) {             
                    $order_table_count = floor($people_number / $largest_party_size) + 1;   
                } else {
                    $order_table_count = 1;
                }
                $order['table_count'] = $order_table_count;
                $order['number_of_people'] = $people_number;
                $order['restro_id'] = $restro_id;
                $order['location_id'] = $location_id;
                $order['date'] = $reserve_date;  // Y-m-d
                $order['time'] = $reserve_time;  // H:i
                $order['user_id'] = $this->user->id;
                $order['order_points'] = $seating_info['point'];
                $order['total'] = $seating_info['deposit'];
                /*$payment_method = $this->post('payment_method');
                if(!isset($payment_method)) {
                throw new Exception('payment_method '.$this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                } 
                $order['payment_method'] = $payment_method;*/
                $order['status'] = 1;                  
                $order['created_time'] = $order['updated_time'] = date('Y-m-d H:i:s');
                $order_id = $this->RestroTableOrderModel->create($order);
                $this->RestroTableOrderModel->update($order_id, array("order_no"=>$this->config->item('Start_order_id').$order_id));
                $order_details['order_id'] = $order_id;
                $order = $this->RestroTableOrderModel->findById($order_id);

                // Update user points on profile                    
                $user_loyalty_points = $this->user->profile->points; $user_mataam_points = $this->user->profile->mataam_points;
                $user_loyalty_points += $seating_info['point'];

                $mataam_point = getMataamPoint($this->user->id, 3, $restro_id, $location_id, $seating_info['deposit']);
                $user_mataam_points += $mataam_point['gained_points'];
                $this->UserProfileModel->save($this->user->id, array(
                    'points'=>$user_loyalty_points,
                    'mataam_points'=>$user_mataam_points
                ));
                // Create Points Log
                $this->PointLogModel->create(array(
                    'user_id'=>$this->user->id,
                    'service_id'=>3,
                    'order_id'=>$order_id,
                    'gained_loyalty_point'=>$seating_info['point'],
                    'used_loyalty_point'=>0,
                    'balance_loyalty_point'=>$user_loyalty_points,
                    'gained_mataam_point'=>$mataam_point['gained_points'],
                    'used_mataam_point'=>0,
                    'balance_mataam_point'=>$user_mataam_points
                ));

                $this->response(array(
                    "code"=>RESULT_SUCCESS,    
                    "resource"=>$order
                    ), REST_Controller::HTTP_OK);
            } catch (Exception $e) {
                $this->response(array(
                    "code"=>$e->getCode(),
                    "message"=>$e->getMessage()
                    ), REST_Controller::HTTP_OK);
            }
        }
        public function reserve_get($id=null)
        {                 
            try {                
                $this->validateAccessToken();
                if($id == null) {                 
                    $restro_id = $this->get('restro_id');
                    $location_id = $this->get('location_id');
                    $params = array();
                    $params['user_id'] = $this->user->id;
                    if(isset($restro_id)) $params['restro_id'] = $restro_id;
                    if(isset($location_id)) $params['location_id'] = $location_id;
                    $orders = $this->RestroTableOrderModel->find($params);
                    foreach($orders as $order) {                       
                        $restaurant = $order->restaurant = $this->RestaurantModel->findByRestroLocationService($order->restro_id, $order->location_id, 3);
                        /*if($order->status == 2) {   // Accepted or Waiting Payment
                            $weekday = strtolower(date('l', strtotime($order->date)));
                            $seating_info = getSeatingInfo($order->restro_id, $order->location_id, $weekday, $order->time);

                            if($seating_info['deposit']==0 || ($seating_info['deposit']>0&&$order->pay_done)) {
                                $order->status = 3;
                            }
                        }*/
                    }   
                    $resource = $orders;
                } else {
                    $order = $this->RestroTableOrderModel->findById($id);
                    $restaurant = $order->restaurant = $this->RestaurantModel->findByRestroLocationService($order->restro_id, $order->location_id, 3);
                    $resource = $order;
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
                if(!$item) {
                    throw new Exception("Product ".$this->lang->line('resource_not_found'), RESULT_ERROR_RESOURCE_NOT_FOUND);
                }
                $params = array();
                $params["user_id"] = $this->user->id;                                                        
                $params["product_id"] = $product_id;
                $params["quantity"] = $quantity;
                $params["price"] = $item->price;
                $params["restro_id"] = $item->restro_id;
                $params["location_id"] = $item->restro_id;
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
                if(!isset($service_type)) {
                    throw new Exception("service_type ".$this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                }

                if($id == null) {
                    $params = array();
                    $params["user_id"] = $this->user->id;
                    $restro_id = $this->get('restro_id');
                    $location_id = $this->get('location_id');
                    if(isset($restro_id)) $params["restro_id"] = $restro_id;
                    if(isset($location_id)) $params["location_id"] = $location_id;

                    $carts = $this->CartModel->find($service_type, $params);

                    if(!$carts) {
                        throw new Exception($this->lang->line('resource_not_found'), RESULT_ERROR_RESOURCE_NOT_FOUND); 
                    }
                    foreach($carts as $cart) {
                        $cart->item = $this->RestroItemModel->findById($cart->product_id);
                        $cart->restaurant = $this->RestaurantModel->findById($cart->restro_id);
                    }
                    $resource = $carts;  
                } else {
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
        public function sum_get()
        {                 
            try {                
                $this->validateAccessToken();
                $service_type = $this->get('service_type');                 
                if(!isset($service_type)) {
                    throw new Exception('service_type ' . $this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                }
                $restro_id = $this->get('restro_id');
                if(!isset($restro_id)) {
                    throw new Exception('restro_id ' . $this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                }
                $location_id = $this->get('location_id');
                if(!isset($location_id)) {
                    throw new Exception('location_id ' . $this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                }
                $area_id = $this->get('area_id');
                if(!isset($area_id)) {
                    throw new Exception('area_id ' . $this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                }
                $this->response(array(
                    "code"=>RESULT_SUCCESS,    
                    "resource"=>getSum($this->user->id, $service_type, $restro_id, $location_id, $area_id)
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
                $redeem_type = $this->get('redeem_type');                 
                if(!isset($redeem_type)) {
                    throw new Exception('redeem_type ' . $this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                }
                $service_type = $this->get('service_type');                 
                if(!isset($service_type)) {
                    throw new Exception('service_type ' . $this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                }
                $restro_id = $this->get('restro_id');
                if(!isset($restro_id)) {
                    throw new Exception('restro_id ' . $this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                }
                $location_id = $this->get('location_id');
                if(!isset($restro_id)) {
                    throw new Exception('location_id ' . $this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                }
                $coupon_code = $this->get('coupon_code');
                $this->response(array(
                    "code"=>RESULT_SUCCESS,    
                    "resource"=>getDiscount($redeem_type, $this->user->id, $service_type, $restro_id, $location_id, $coupon_code)
                    ), REST_Controller::HTTP_OK);
            } catch (Exception $e) {
                $this->response(array(
                    "code"=>$e->getCode(),
                    "message"=>$e->getMessage()
                    ), REST_Controller::HTTP_OK);
            }
        } 
        public function point_get()
        {                 
            try {                
                $this->validateAccessToken();
                $service_type = $this->get('service_type');                 
                if(!isset($service_type)) {
                    throw new Exception('service_type ' . $this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                }
                $restro_id = $this->get('restro_id');
                if(!isset($restro_id)) {
                    throw new Exception('restro_id ' . $this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                }
                $location_id = $this->get('location_id');
                if(!isset($location_id)) {
                    throw new Exception('location_id ' . $this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                }
                $this->response(array(
                    "code"=>RESULT_SUCCESS,    
                    "resource"=>getPoint($this->user->id, $service_type, $restro_id, $location_id)
                    ), REST_Controller::HTTP_OK);
            } catch (Exception $e) {
                $this->response(array(
                    "code"=>$e->getCode(),
                    "message"=>$e->getMessage()
                    ), REST_Controller::HTTP_OK);
            }
        } 
        public function times_get()
        {                 
            try {                
                $this->validateAccessToken();
                $restro_id = $this->get('restro_id');
                if(!isset($restro_id)) {
                    throw new Exception('restro_id ' . $this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                }
                $location_id = $this->get('location_id');
                if(!isset($restro_id)) {
                    throw new Exception('location_id ' . $this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                }
                $people_number = $this->get('people_number');
                if(!isset($people_number)) {
                    throw new Exception('people_number ' . $this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                }
                $reserve_time = $this->get('reserve_time');
                if(!isset($reserve_time)) {
                    throw new Exception('reserve_time ' . $this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_INVALID);
                }
                $reserve_time = strtotime($reserve_time);

                $time_slots = getTimeSlots($restro_id, $location_id, $reserve_time, $people_number);
                $this->response(array(
                    "code"=>RESULT_SUCCESS,    
                    "resource"=>array(
                        'weekday'=>strtolower(date('l', $reserve_time)), 
                        'reservation_date'=>date('Y-m-d', $reserve_time), 
                        'reservation_time'=>date('H:i', $reserve_time), 
                        //'index'=>$index, 
                        'slots'=>$time_slots, 
                        //'closest'=>$closest
                    )), REST_Controller::HTTP_OK);
            } catch (Exception $e) {
                $this->response(array(
                    "code"=>$e->getCode(),
                    "message"=>$e->getMessage()
                    ), REST_Controller::HTTP_OK);
            }
        }

        public function cart_count_get()
        {                 
            try {                
                $this->validateAccessToken();

                $service_type = $this->get('service_type');

                $params = array();
                $params["user_id"] = $this->user->id;

                $restro_id = $this->get('restro_id');
                if(isset($restro_id)) $params["restro_id"] = $restro_id;

                $location_id = $this->get('location_id');
                if(isset($location_id)) $params["location_id"] = $location_id;

                if(isset($service_type)) {
                    $carts = $this->CartModel->find($service_type, $params);
                } else {
                    $carts = array_merge($this->CartModel->find(1, $params), $this->CartModel->find(2, $params), $this->CartModel->find(3, $params), $this->CartModel->find(4, $params));                        
                }       

                if(!$carts) {
                    throw new Exception($this->lang->line('resource_not_found'), RESULT_ERROR_RESOURCE_NOT_FOUND); 
                }

                $resource = count($carts);

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