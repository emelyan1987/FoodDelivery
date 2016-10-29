<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes with
| underscores in the controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';


$route['app_login/(:num)'] = 'Mattam_API/User/app_login/$i';
$route['app_login_otp/(:num)/(:num)'] = 'Mattam_API/User/app_login_otp/$i/$i';
$route['app_signup'] = 'Mattam_API/User/app_signup'; 


$route['add_chatname'] = 'Administration/Chat_controll/add_chatname'; 
$route['add_chatmsg'] = 'Administration/Chat_controll/add_chatmsg'; 
$route['chat'] = 'Administration/Chat_controll/chatAdmin';
$route['ajax_userid'] = 'Administration/Chat_controll/ajax_userid';
$route['ajax_userGETmessage'] = 'Administration/Chat_controll/ajax_userGETmessage';



$route['ajax_resrvation_booking_time'] = 'home/ajax_resrvation_booking_time';




$route['restaurants'] = 'home/restaurant_list';
$route['ajax_restaurants_fetch'] = 'home/ajax_restaurants_fetch'; 
$route['ajax_restaurants_fetch_cuisine'] = 'home/ajax_restaurants_fetch_cuisine'; 
$route['ajax_show_all_restro'] = 'home/ajax_show_all_restro';
$route['restaurant_view/(:num)'] = 'home/restaurant_view/$i';  
$route['ajax_show_item_by_cat'] = 'home/ajax_show_item_by_cat';
$route['Home_Restro_Filter/(:num)'] = 'home/Home_Restro_Filter/$i';

$route['Home_coupon_filter'] = 'home/Home_coupon_filter';

$route['career'] = 'home/career'; 
$route['contact'] = 'home/contact'; 
$route['filter'] = 'home/Home_filter'; 
$route['reservation_filter'] = 'home/Home_reservation_filter';  
$route['pickup_filter'] = 'home/Home_pickup_filter'; 
$route['catering_filter'] = 'home/Home_catering_filter';
$route['reservation_tabel/(:num)'] = 'home/reservation_restaurant_view/$i'; 
$route['pickup_restaurant/(:num)'] = 'home/pickup_restaurant_view/$i'; 
$route['catering_restaurant/(:num)'] = 'home/catering_restaurant_view/$i';
$route['view_reservation_restro_table/(:num)/(:num)'] = 'home/view_reservation_restro_table/$i/$i';
$route['reservation_checkout/(:num)/(:num)'] = 'home/reservation_checkout/$i/$i';
$route['view_restro_item/(:num)/(:num)'] = 'home/view_restro_item/$i/$i'; 
$route['checkout'] = 'home/checkout'; 
$route['about_us'] = 'home/about_us';
$route['citychange'] = 'home/citychange';
$route['restaurant_registration'] = 'home/restaurant_registration';
$route['ajax_cart_item_remove/(:num)'] = 'home/ajax_cart_item_remove/$i'; 
$route['ajax_cart_table_remove/(:num)'] = 'home/ajax_cart_table_remove/$i';  
$route['ajax_cart_pickup_remove'] = 'home/ajax_cart_pickup_remove';
$route['view_restro_pickup/(:num)/(:num)'] = 'home/view_restro_pickup/$i/$i'; 
$route['view_restro_catering/(:num)/(:num)'] = 'home/view_restro_catering/$i/$i'; 
$route['pickup_checkout'] = 'home/pickup_checkout'; 
$route['catering_checkout'] = 'home/catering_checkout'; 
$route['ajaxaddressFetch'] = 'home/ajaxaddressFetch'; 
$route['restaurant_rating/(:num)'] = 'Rating/restaurant_rating/$i';

$route['customer_otp'] = 'home/customer_otp/';
$route['check_otp'] = 'home/check_otp/';
$route['login'] = 'home/login';
$route['forgot_pass'] = 'home/forgot_pass/';
$route['reset_pass'] = 'home/reset_pass/';
$route['restaurant_profile/(:num)'] = 'home/restaurant_profile/$i'; 


$route['customer_register'] = 'Auth/customer_register/';
$route['customer_login'] = 'Auth/customer_login/';


$route['delivery_cart_item_remove'] = 'home/delivery_cart_item_remove/';  
$route['pickup_cart_item_remove'] = 'home/pickup_cart_item_remove/'; 
$route['catering_cart_item_remove'] = 'home/catering_cart_item_remove/'; 

$route['ajax_suggestions'] = 'home/ajax_suggestions/'; 
$route['search_area_by_name'] = 'home/search_area_by_name/'; 
$route['search_restro_by_name'] = 'home/search_restro_by_name/';

$route['add_faq'] = 'Administration/Dashboard/add_faq';
$route['add_faq_category'] = 'Administration/Dashboard/add_faq_category'; 
$route['faq_category_list'] = 'Administration/Dashboard/faq_category_list';
$route['faq_list'] = 'Administratration/Dashboard/faq_list';
$route['tearms_conditions'] = 'Administration/Dashboard/tearms_conditions';




$route['get_location_for_notification'] = 'Administration/Order/get_location_for_notification';
$route['delete_order'] = 'Administration/Order/delete_order';

$route['paymentdone_order'] = 'Administration/Order/paymentdone_order';


$route['customer_dashboard'] = 'Customer/customer_dashboard';
$route['customer_dashboard/(:any)'] = 'Customer/customer_dashboard/$i';
$route['mycart'] = 'Customer/mycart'; 
$route['ajax_customer_login'] = 'Customer/ajax_customer_login'; 
$route['ajax_customer_otp_login'] = 'Customer/ajax_customer_otp_login'; 
$route['order_coupon'] = 'Customer/order_coupon'; 
$route['order_used_points'] = 'Customer/order_used_points'; 
$route['customer_address_add'] = 'Customer/ajax_customer_address_add'; 
$route['login_otp_resend'] = 'Customer/login_otp_resend';


$route['loyalty_point'] = 'Loyalty/loyalty_point';

$route['faq_home'] = 'Faq/faq_home';


$route['update_city/(:num)'] = 'Administration/Area/update_city/$i';
$route['delete_city'] = 'Administration/Area/delete_city';
$route['delete_area'] = 'Administration/Area/delete_area';

$route['update_area/(:num)'] = 'Administration/Area/update_area/$i';

$route['web_notification_list'] = 'Administration/Push_Notification/web_notification_list'; 
$route['app_notification_list'] = 'Administration/Push_Notification/app_notification_list'; 

$route['restore_restaurant'] = 'Administration/Restaurant/restore_restaurant'; 
$route['restaurant_tables'] = 'Administration/Restaurant/restaurant_tables';
$route['admin_edit_restro_table/(:num)/(:num)/(:num)'] = 'Administration/Restaurant/admin_edit_restro_table/$i/$i/$i'; 
$route['delete_restro_table/(:num)'] = 'Administration/Restaurant/delete_restro_table/$i';

  
$route['coupon'] = 'CouponController'; 
$route['coupon/(:num)'] = 'CouponController'; 
$route['coupon_list'] = 'CouponController/list_view';   
$route['coupon_edit'] = 'CouponController/edit_view';
$route['coupon_edit/(:num)'] = 'CouponController/edit_view';
  
$route['loyalty_point'] = 'LoyaltyPointController'; 
$route['loyalty_point/(:num)'] = 'LoyaltyPointController'; 
$route['loyalty_point_list'] = 'LoyaltyPointController/list_view';   
$route['loyalty_point_edit'] = 'LoyaltyPointController/edit_view';
$route['loyalty_point_edit/(:num)'] = 'LoyaltyPointController/edit_view';


$route['mataam_point_edit'] = 'MataamPointController/edit_view';
$route['mataam_point'] = 'MataamPointController';


$route['trash_delete_restaurant/(:num)'] = 'Administration/Restaurant/trash_delete_restaurant/$i'; 
$route['sent_mail_restaurant/(:num)'] = 'Administration/Restaurant/sent_mail_restaurant/$i';
$route['update_web_notification'] = 'Administration/Push_Notification/update_web_notification';
$route['update_app_notification'] = 'Administration/Push_Notification/update_app_notification';
$route['delete_web_notification'] = 'Administration/Push_Notification/delete_web_notification';
$route['delete_app_notification'] = 'Administration/Push_Notification/delete_app_notification'; 

$route['careers_list'] = 'Administration/Contact_us/careers_list';
$route['contact_us_list'] = 'Administration/Contact_us/contact_us_list';
$route['add_job_type'] = 'Administration/Contact_us/add_job_type';

$route['view_carrer/(:num)'] = 'Administration/Contact_us/view_carrer/$i';
$route['view_contact/(:num)'] = 'Administration/Contact_us/view_contact/$i'; 

$route['delete_carrer'] = ' Administration/Contact_us/delete_carrer/';
$route['delete_contact'] = 'Administration/Contact_us/delete_contact/';

$route['faq_category_update/(:num)'] = 'Administration/Dashboard/faq_category_update/$i'; 
$route['web_customers'] = 'Administration/Customer/web_customers_list';

$route['ajax_customer_edit_address'] = 'Customer/ajax_customer_edit_address';



$route['ajax_item_variation_price'] = 'home/ajax_item_variation_price';

$route['home_policy'] = 'home/home_policy';
$route['home_terms'] = 'home/home_terms';
$route['opening-soon'] = 'home/home_opening_soon';



$route['restro_register'] = 'Administration/Restro_registration/restro_register/';
$route['add_restro_register'] = 'Administration/Restro_registration/add_restro_register/';
$route['edit_restro_register/(:num)'] = 'Administration/Restro_registration/edit_restro_register/$i';
$route['delete_restro_register/(:num)'] = 'Administration/Restro_registration/delete_restro_register/$i';




$route['ajax_food_type_add'] = 'Administration/Restaurant/ajax_food_type_add'; 

$route['restro_trash'] = 'Administration/Restaurant/get_restro_trash_list'; 

$route['delete_advertise_img/(:num)'] = 'Administration/Advertise/delete_advertise_img/$i'; 
$route['delete_advertise/(:num)'] = 'Administration/Advertise/delete_advertise/$i'; 
$route['delete_restaurant/(:num)'] = 'Administration/Restaurant/delete_restaurant/$i'; 
$route['reports'] = 'Administration/Dashboard/reports'; 
$route['catring_reports'] = 'Administration/Dashboard/catring_reports';
$route['reservation_reports'] = 'Administration/Dashboard/reservation_reports';
$route['pickup_reports'] = 'Administration/Dashboard/pickup_reports'; 

$route['delete_restaurant_location'] = 'Administration/Restaurant/delete_restaurant_location'; 


$route['commission_reports'] = 'Administration/Order/commission_reports'; 
$route['catering_commission_reports'] = 'Administration/Order/catering_commission_reports';  
$route['pickup_commission_reports'] = 'Administration/Order/pickup_commission_reports';
$route['reservation_commission_reports'] = 'Administration/Order/reservation_commission_reports';


$route['delivery_orders'] = 'Administration/Order/delivery_orders'; 
$route['catering_orders'] = 'Administration/Order/catering_orders';
$route['reservation_orders'] = 'Administration/Order/reservation_orders';
$route['pickup_orders'] = 'Administration/Order/pickup_orders';
$route['update_location_service_status'] = 'Administration/Order/update_location_service_status';
$route['filter_order_ajax'] = 'Administration/Order/filter_order_ajax';

$route['update_restro_service_status'] = 'Administration/Order/update_restro_service_status';
$route['filter_restro_order_ajax'] = 'Administration/Order/filter_restro_order_ajax';




$route['restro_delivery_notification'] = 'Restaurant_Owner/Restro_Owner/restro_delivery_notification'; 
$route['restro_reservation_notification'] = 'Restaurant_Owner/Restro_Owner/restro_reservation_notification';
$route['restro_pickup_notification'] = 'Restaurant_Owner/Restro_Owner/restro_pickup_notification';
$route['restro_catering_notification'] = 'Restaurant_Owner/Restro_Owner/restro_catering_notification';
$route['restro_item_category_show'] = 'Restaurant_Owner/Restro_Owner/restro_item_category_show';
$route['status_change_table_details'] = 'Restaurant_Owner/Restro_Owner/status_change_table_details';




$route['add_new_area'] = 'Administration/Area/add_new_area';
$route['add_new_city'] = 'Administration/Area/add_new_city'; 
$route['add_services'] = 'Administration/Restaurant/add_services'; 
$route['admin_reset_password'] = 'Auth/admin_reset_password';
$route['add_pickup_service'] = 'Administration/Restaurant/add_pickup_service'; 
$route['add_reservation_service'] = 'Administration/Restaurant/add_reservation_service'; 
$route['add_catering_services'] = 'Administration/Restaurant/add_catering_services';

$route['add_delivery_service'] = 'Administration/Restaurant/add_delivery_service';
$route['ajax_category_show_chk'] = 'Administration/Restaurant/ajax_category_show_chk';

$route['show_item_list'] = 'Administration/Cuisine/show_item_list';  
$route['edit_item_category/(:num)'] = 'Administration/Cuisine/edit_item_category/$i';





$route['add_advertise'] = 'Administration/Advertise/add_advertise';  
$route['app_add_advertise'] = 'Administration/Advertise/app_add_advertise'; 

$route['add_promotion'] = 'Administration/Promotion/add_promotion'; 
$route['promotion_owner_serach'] = 'Administration/Promotion/promotion_owner_serach'; 
$route['ajax_variation_show'] = 'Administration/Promotion/ajax_variation_show';
$route['show_promotion'] = 'Administration/Promotion/show_promotion'; 
$route['edit_promotion/(:num)'] = 'Administration/Promotion/edit_promotion/$i'; 
$route['delete_promotion/(:num)/(:any)'] = 'Administration/Promotion/delete_promotion/$i/$i';
$route['location_service_filter_promotion'] = 'Administration/Promotion/location_service_filter_promotion';
 



$route['smtp_setup'] = 'Administration/Smtp_Email/smtp_setup'; 
$route['email_templates'] = 'Administration/Smtp_Email/email_templates'; 
$route['edit_email_templates/(:num)'] = 'Administration/Smtp_Email/edit_email_templates/$i'; 

$route['sms_setup'] = 'Administration/Smtp_Email/sms_setup';



$route['restro_add_promotion'] = 'Restaurant_Owner/Restro_Promotion/restro_add_promotion'; 
$route['restro_show_promotion'] = 'Restaurant_Owner/Restro_Promotion/restro_show_promotion'; 
$route['restro_edit_promotion/(:num)'] = 'Restaurant_Owner/Restro_Promotion/restro_edit_promotion/$i'; 
$route['restro_ajax_variation_show'] = 'Restaurant_Owner/Restro_Promotion/restro_ajax_variation_show'; 







//$route['area_list'] = 'Administration/Restaurant/ajax_food_type_add'; 

$route['show_state/(:num)'] = 'Site/show_state/$i'; 
$route['show_city/(:num)'] = 'Site/show_city/$i';

$route['login'] = 'Auth/login';
$route['logout'] = 'Auth/logout';
$route['register'] = 'Auth/register';
$route['forgot_password'] = 'Auth/forgot_password/';
$route['Dashboard'] = 'Administration/Dashboard';
$route['admin_profile'] = 'Administration/Dashboard/admin_profile';
$route['restaurant_list'] = 'Administration/Restaurant/restaurant_list';
$route['add_new_restaurant'] = 'Administration/Restaurant/restaurant_new';

$route['policys'] = 'Administration/Dashboard/policys';
$route['reports'] = 'Administration/Dashboard/reports'; 

$route['add_notification'] = 'Administration/Push_Notification/add_notification';
$route['add_notification/(:any)'] = 'Administration/Push_Notification/add_notification/$i';

$route['ajax_area_get_by_city'] = 'Administration/Area/ajax_area_get_by_city'; 
$route['ajax_add_item_category'] = 'Administration/Cuisine/ajax_add_item_category'; 
$route['ajax_category_add'] = 'Administration/Cuisine/ajax_category_add'; 
$route['get_location_service_filter_item'] = 'Administration/Cuisine/get_location_service_filter_item'; 
$route['get_location_service_filter_category'] = 'Administration/Cuisine/get_location_service_filter_category';
$route['restro_location_service_filter_category'] = 'Administration/Cuisine/restro_location_service_filter_category';
$route['restro_location_service_filter_item'] = 'Administration/Cuisine/restro_location_service_filter_item'; 
$route['restro_location_filter_item_list'] = 'Administration/Cuisine/restro_location_filter_item_list'; 



$route['restaurant_new_location'] = 'Administration/Restaurant/restaurant_new_location'; 
$route['get_location_for_restro_owner'] = 'Administration/Restaurant/get_location_for_restro_owner'; 
$route['get_locations_for_restro'] = 'Administration/Restaurant/get_locations_for_restro'; 
$route['get_service_for_restro_owner'] = 'Administration/Restaurant/get_service_for_restro_owner';
$route['get_service_for_restro_location'] = 'Administration/Restaurant/get_service_for_restro_location';


$route['new_customer'] = 'Customer/add_new_customer';
$route['customer_list'] = 'Customer/customer_list';
$route['new_plan'] = 'Administration/Plan/add_new_plan';
$route['plan_list'] = 'Administration/Plan/plan_list';
$route['edit_plan/(:num)'] = 'Administration/Plan/edit_plan/$i'; 
$route['cuisine_setup'] = 'Administration/Cuisine/cuisine_setup'; 
$route['delete_cuisine/(:num)'] = 'Administration/Cuisine/delete_cuisine/$i';  
$route['delete_foodtype/(:num)'] = 'Administration/Cuisine/delete_foodtype/$i'; 
$route['delete_seo_category/(:num)'] = 'Administration/Cuisine/delete_seo_category/$i';
$route['item_category_setup'] = 'Administration/Cuisine/item_category_setup';
$route['item_category_show'] = 'Administration/Cuisine/item_category_show'; 
$route['ajax_get_location_category'] = 'Administration/Cuisine/ajax_get_location_category';

$route['delete_item_category/(:num)'] = 'Administration/Cuisine/delete_item_category/$i'; 
$route['ajax_item_category_add'] = 'Administration/Restaurant/ajax_item_category_add';
$route['restaurant_edit/(:num)'] = 'Administration/Restaurant/restaurant_edit/$i'; 
$route['restaurant_locations/(:num)'] = 'Administration/Restaurant/restaurant_locations/$i';
$route['add_restro_location/(:num)'] = 'Administration/Restaurant/add_restro_location/$i'; 
$route['restaurant_edit_location/(:num)/(:num)'] = 'Administration/Restaurant/restaurant_edit_location/$i/$i';
$route['admin_change_password'] = 'Auth/admin_change_password';
$route['all_item_category'] = 'Administration/Cuisine/all_item_category';  
$route['add_item'] = 'Administration/Cuisine/add_item'; 
$route['edit_menu_item/(:num)'] = 'Administration/Cuisine/edit_menu_item/$i'; 
$route['delete_item/(:num)'] = 'Administration/Cuisine/delete_item/$i';

$route['delivery_order_view/(:num)'] = 'Administration/Order/delivery_order_view/$i'; 
$route['catering_order_view/(:num)'] = 'Administration/Order/catering_order_view/$i'; 
$route['reservation_order_view/(:num)'] = 'Administration/Order/reservation_order_view/$i'; 
$route['pickup_order_view/(:num)'] = 'Administration/Order/pickup_order_view/$i';

$route['delivery_orders_notification'] = 'Administration/Order/delivery_orders_notification';
$route['catering_orders_notification'] = 'Administration/Order/catering_orders_notification';
$route['reservation_orders_notification'] = 'Administration/Order/reservation_orders_notification';
$route['pickup_orders_notification'] = 'Administration/Order/pickup_orders_notification';



$route['edit_restaurant_owner/(:num)'] = 'Customer/edit_restaurant_owner/$i'; 
$route['delivery_order_details/(:num)'] = 'Customer/delivery_order_details/$i';

$route['edit_web_constomer/(:num)'] = 'Customer/edit_web_constomer/$i';
$route['view_web_constomer/(:num)'] = 'Customer/view_web_constomer/$i';


$route['customer_logout'] = 'Customer/customer_logout';

$route['put_rating'] = 'Rating/put_rating';

$route['restro_dashboard'] = 'Restaurant_Owner/Restro_Owner/dashboard';
$route['restro_logout'] = 'Auth/logout';
$route['restro_owner_profile'] = 'Restaurant_Owner/Restro_Owner/profile';
$route['restro_owner_restaurants_list'] = 'Restaurant_Owner/Restro_Owner/restaurant_list'; 
$route['edit_owner_restro/(:num)'] = 'Restaurant_Owner/Restro_Owner/edit_my_restaurant/$i';
$route['add_owner_restaurant'] = 'Restaurant_Owner/Restro_Owner/add_owner_restaurant';
$route['restro_owner_change_password'] = 'Auth/restro_owner_change_password';
$route['restro_add_item_category'] = 'Restaurant_Owner/Restro_Owner/restro_add_item_category'; 
$route['restro_item_category_list'] = 'Restaurant_Owner/Restro_Owner/restro_item_category_list';
$route['manage_my_restro_list'] = 'Restaurant_Owner/Restro_Owner/manage_my_restro_list'; 
$route['restro_add_item'] = 'Restaurant_Owner/Restro_Owner/restro_add_item';
$route['restro_item_list'] = 'Restaurant_Owner/Restro_Owner/restro_item_list';
$route['restro_add_menu/(:num)'] = 'Restaurant_Owner/Restro_Owner/restro_add_menu/$i';
$route['view_my_restro/(:num)'] = 'Restaurant_Owner/Restro_Owner/view_my_restro/$i'; 
$route['manage_restro_table/(:num)/(:num)'] = 'Restaurant_Owner/Restro_Owner/manage_restro_table/$i/$i'; 
$route['ajax_edit_restro_table/(:num)/(:num)'] = 'Restaurant_Owner/Restro_Owner/ajax_edit_restro_table/$i/$i'; 
$route['restro_tables_booking/(:num)/(:num)'] = 'Restaurant_Owner/Restro_Owner/restro_tables_booking/$i/$i';
$route['tables_booking/(:num)/(:num)'] = 'Restaurant_Owner/Restro_Owner/tables_booking/$i/$i';

$route['restro_delivery_order'] = 'Restaurant_Owner/Restro_Owner/restro_delivery_order'; 
$route['restro_reservation_order'] = 'Restaurant_Owner/Restro_Owner/restro_reservation_order';
$route['restro_pickup_order'] = 'Restaurant_Owner/Restro_Owner/restro_pickup_order'; 
$route['restro_catering_order'] = 'Restaurant_Owner/Restro_Owner/restro_catering_order'; 
$route['restro_delivery_order_view/(:num)'] = 'Restaurant_Owner/Restro_Owner/restro_delivery_order_view/$i'; 
$route['restro_catering_order_view/(:num)'] = 'Restaurant_Owner/Restro_Owner/restro_catering_order_view/$i';
$route['restro_reservation_order_view/(:num)'] = 'Restaurant_Owner/Restro_Owner/restro_reservation_order_view/$i';
$route['restro_pickup_order_view/(:num)'] = 'Restaurant_Owner/Restro_Owner/restro_pickup_order_view/$i'; 
$route['my_restro_location/(:num)'] = 'Restaurant_Owner/Restro_Owner/my_restro_location/$i'; 
$route['edit_menu_category/(:num)'] = 'Restaurant_Owner/Restro_Owner/edit_menu_category/$i'; 
$route['delete_my_item_cat/(:num)'] = 'Restaurant_Owner/Restro_Owner/delete_my_item_cat/$i';
$route['edit_restro_item/(:num)'] = 'Restaurant_Owner/Restro_Owner/edit_restro_item/$i'; 
$route['delete_my_item/(:num)'] = 'Restaurant_Owner/Restro_Owner/delete_my_item/$i';
$route['my_serviec_setup/(:num)/(:num)'] = 'Restaurant_Owner/Restro_Owner/my_serviec_setup/$i/$i'; 



$route['ajax_cuisine_add'] = 'Restaurant_Owner/Restro_Owner/ajax_cuisine_add'; 
$route['restro_coupon_setup'] = 'Restaurant_Owner/Restro_Coupon/restro_coupon_setup';
$route['restro_coupon_show'] = 'Restaurant_Owner/Restro_Coupon/restro_coupon_show';
$route['restro_coupon_edit/(:num)'] = 'Restaurant_Owner/Restro_Coupon/restro_coupon_edit/$i'; 
$route['delete_my_coupon/(:num)'] = 'Restaurant_Owner/Restro_Coupon/delete_my_coupon/$i'; 
$route['restro_item_category_setup'] = 'Restaurant_Owner/Restro_Owner/restro_item_category_setup';
$route['restro_delete_item_category/(:num)'] = 'Restaurant_Owner/Restro_Owner/restro_delete_item_category/$i'; 
$route['restro_item_category_edit/(:num)'] = 'Restaurant_Owner/Restro_Owner/restro_item_category_edit/$i';


$route['ServiceSetupCatering/(:num)/(:num)'] = 'Restaurant_Owner/Restro_Owner/ServiceSetupCatering/$i/$i';
$route['ServiceSetupReservation/(:num)/(:num)'] = 'Restaurant_Owner/Restro_Owner/ServiceSetupReservation/$i/$i'; 
$route['ServiceSetupPickup/(:num)/(:num)'] = 'Restaurant_Owner/Restro_Owner/ServiceSetupPickup/$i/$i';
$route['manage_restro_location/(:num)'] = 'Restaurant_Owner/Restro_Location/manage_restro_location/$i'; 
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE; 
$route['faq_list'] = 'Administration/Dashboard/faq_list'; 
$route['add_about'] = 'Administration/Dashboard/add_about'; 


/* ====================== API URI ========================*/
$route['api/users'] = '/api/UserController'; 
$route['api/users/(:num)'] = '/api/UserController/index/$1'; 
$route['api/users/(:num)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'api/UserController/$1/format/$3$4'; 
$route['api/users/(:num)/send_sms_code'] = '/api/UserController/sendSmsCode/$1'; 
$route['api/users/(:num)/verify_sms_code'] = '/api/UserController/verifySmsCode/$1'; 
$route['api/login'] = '/api/UserController/login'; 
$route['api/check_token'] = '/api/UserController/check_token'; 
$route['api/users/me'] = '/api/UserController/me'; 
$route['api/users/profile'] = '/api/UserController/profile'; 
$route['api/users/address'] = '/api/UserController/address'; 
$route['api/users/sub_address'] = '/api/UserController/sub_address'; 
$route['api/users/language'] = '/api/UserController/language'; 
$route['api/users/subscription'] = '/api/UserController/subscription';         
$route['api/users/change_mobile_no'] = '/api/UserController/change_mobile_no'; 
$route['api/users/change_password'] = '/api/UserController/change_password'; 
$route['api/users/upload_image'] = '/api/UserController/upload_image'; 

$route['api/data/cities'] = '/api/DataController/cities'; 
$route['api/data/areas'] = '/api/DataController/areas';    
$route['api/data/cuisines'] = '/api/DataController/cuisines'; 
$route['api/data/food_types'] = '/api/DataController/food_types'; 
$route['api/data/restro_categories'] = '/api/DataController/restro_categories'; 

$route['api/restaurants'] = '/api/RestaurantController'; 
$route['api/restaurants/(:num)'] = '/api/RestaurantController/index/$1'; 
$route['api/restaurants/ratings'] = '/api/RestaurantController/ratings'; 
$route['api/restaurants/item_categories'] = '/api/RestaurantController/item_categories'; 
$route['api/restaurants/items'] = '/api/RestaurantController/items'; 
$route['api/restaurants/items/(:num)'] = '/api/RestaurantController/items/$1'; 


$route['api/orders'] = '/api/OrderController'; 
$route['api/orders/(:num)/details'] = '/api/OrderController/details/$1'; 
$route['api/orders/cart'] = '/api/OrderController/cart'; 
$route['api/orders/cart/(:num)'] = '/api/OrderController/cart/$1'; 
$route['api/orders/sum'] = '/api/OrderController/sum'; 
$route['api/orders/point'] = '/api/OrderController/point'; 
$route['api/orders/discount'] = '/api/OrderController/discount'; 
$route['api/orders/times'] = '/api/OrderController/times'; 
$route['api/orders/reserve'] = '/api/OrderController/reserve'; 




