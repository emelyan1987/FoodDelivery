<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    // This can be removed if you use __autoload() in config.php OR use Modular Extensions
    require 'MyRestController.php';

    class PromotionController extends MyRestController {
        function __construct()
        {
            // Construct the parent class
            parent::__construct();                  

            $this->load->model('RestaurantModel');                        
            $this->load->model('RestroItemModel');                        
            $this->load->model('RestroItemVariationModel');                        
            $this->load->model('RestroPromotionModel'); 
            $this->load->model('RestroPromotionItemModel'); 
            $this->load->model('CartModel'); 
        } 


        public function index_get()
        {                 
            try {                
                $this->validateAccessToken();

                $restro_id = $this->input->get('restro_id');
                $location_id = $this->input->get('location_id');


                $params = array();

                if(isset($restro_id))$params["restro_id"] = $restro_id;                    
                if(isset($location_id))$params["location_id"] = $location_id;    

                $params['date'] = date('Y-m-d');
                $promotions = $this->RestroPromotionModel->find($params);

                foreach($promotions as $promotion) {
                    $promotion->items = $this->RestroPromotionItemModel->findByPromoId($promotion->id);
                    foreach($promotion->items as $promo_item) {
                        $promo_item->variations = $this->RestroPromotionItemModel->findVariationItemsByPromoItemId($promo_item->id);
                    }
                    $promotion->restaurant = $this->RestaurantModel->findById($promotion->restro_id);
                }

                $resource = $promotions;
                if(!$resource) {
                    throw new ApiException($this->lang->line('resource_not_found'), RESULT_ERROR_RESOURCE_NOT_FOUND); 
                }  
                $this->response(array(
                    "code"=>RESULT_SUCCESS,    
                    "resource"=>$resource
                    ), REST_Controller::HTTP_OK);

            } catch (ApiException $e) {
                $this->response(array(
                    "code"=>$e->getCode(),
                    "message"=>$e->getMessage(),
                    "parameter"=>$e->getParameter()
                    ), REST_Controller::HTTP_OK);
            }
        }        
         

        public function add_to_cart_post($promotion_id)
        {                 
            try {                
                $this->validateAccessToken();

                if(!isset($promotion_id)) {
                    throw new ApiException($this->lang->line('parameter_required'), RESULT_ERROR_PARAMS_REQUIRED, "promotion_id");
                }

                $promo_items = $this->RestroPromotionItemModel->findByPromoId($promotion_id);

                $resource = array();
                foreach($promo_items as $promo_item) {
                    $item = $this->RestroItemModel->findById($promo_item->item_id);
                    if($item) {

                        $cart = array();
                        $cart["user_id"] = $this->user->id;                                                        
                        $cart["product_id"] = $item->id;
                        $cart["quantity"] = 1;
                        $cart["restro_id"] = $item->restro_id;
                        $cart["location_id"] = $item->location_id;
                        $cart["spacial_request"] = 'Promotion items';

                        $variations = $this->RestroPromotionItemModel->findVariationItemsByPromoItemId($promo_item->id);
                        
                        $variation_ids = array();
                        foreach($variations as $variation) {
                            $variation_ids[] = $variation->variation_id;
                        }
                        
                        if(count($variation_ids)) {
                            $cart["variation_ids"] = implode(',',$variation_ids);                            

                            $variations = $this->RestroItemVariationModel->findByIds($variation_ids);

                            $price = 0;
                            if($item->price_type == ITEM_PRICE_TYPE_BY_MAIN) $price = $item->price;

                            foreach($variations as $v) {
                                $price += $v->price;
                            }
                            $cart["price"] = $price;
                        } else {
                            $cart["price"] = $item->price;   
                        }
                        $cart["date"] = date("Y-m-d H:i:s");
                        $cart["status"] = CART_STATUS_ACTIVE;
                        $insert_id = $this->CartModel->create($item->service_id, $cart);
                        $cart_item = $this->CartModel->findById($item->service_id, $insert_id);
                        
                        $resource[] = $cart_item;
                    }
                }
                



                $this->response(array(
                    "code"=>RESULT_SUCCESS,    
                    "resource"=>$resource
                    ), REST_Controller::HTTP_OK);

            } catch (ApiException $e) {
                $this->response(array(
                    "code"=>$e->getCode(),
                    "message"=>$e->getMessage(),
                    "parameter"=>$e->getParameter()
                    ), REST_Controller::HTTP_OK);
            }
        } 
}