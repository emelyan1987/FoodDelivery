<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

    class Restaurant_management extends CI_Model
    {


        function __construct()
        {
            parent::__construct();	
        }

        public function  add_restro_user($userInfo)
        {

            $this->db->insert('users',$userInfo);
            return $id = $this->db->insert_id();

        }
        public function  add_restro1_info($restroInfo)
        {
            $this->db->insert('restro_info',$restroInfo);
            return $this->db->insert_id();

        }
        public function  add_restro_location($locationInfo)
        {
            $this->db->insert('restro_location',$locationInfo);

            return $this->db->insert_id(); 

        }
        public function add_restro($restroInfo)
        {
            $this->db->insert('restro_info',$restroInfo);
            return $this->db->insert_id();
        }

        public function add_restro_seo_cat($tbl_restro_menu)
        {

            $this->db->insert('restro_seo_category_list',$tbl_restro_menu);
            return true;

        }

        public function add_restro_cuisine($data)
        {
            $this->db->insert('restro_cuisine_ids',$data);

        }
        public function add_restro_food_type($data)
        {
            $this->db->insert('food_type_restro_list',$data);

        }

        public function get_all_restro_list()
        {

            $this->db->select('restro_info.*');
            $this->db->from('restro_info');
            $this->db->join('users','users.id = restro_info.user_id');
            $this->db->where("status",'1'); 
            $this->db->where("trash",'0'); 
            $this->db->group_by("restro_info.id"); 
            return $query = $this->db->get()->result();
        }

        public function  get_all_trash_restro_list()
        {
            $this->db->select('*');
            $this->db->from('restro_info');
            $this->db->where("trash",'1'); 
            return $query = $this->db->get()->result();
        }
        public function get_seo_category_list()
        { 
            $this->db->select("*");
            $this->db->from("restro_seo_category");
            $this->db->order_by("name",'asc');
            return $this->db->get()->result();




        }
        public function get_all_restro()
        {

            $this->db->select('*');
            $this->db->from('users');
            $this->db->join('restro_info', 'users.id = restro_info.user_id') ;
            $this->db->join('restro_services_commission', 'restro_info.id=restro_services_commission.restro_id') ;

            $this->db->where("restro_info.trash",'0');	
            return $query = $this->db->get()->result();
            //echo "<pre>"; print_r($query);
            //die;

        }

        public function getOwnerCode($restro_id)
        {
            $this->db->select("owner_id");
            $this->db->from("users");
            $this->db->where("id",$restro_id);
            $this->db->where("user_role",2);


            return $query = $this->db->get()->row_array();

        }

        public function getCuisine($restro_id)
        {

            $this->db->select("restro_cuisine.name");

            $this->db->from("restro_cuisine_ids");

            $this->db->join('restro_cuisine', 'restro_cuisine_ids.cuisine_id = restro_cuisine.id'); 
            $this->db->where("restro_cuisine_ids.restro_id",$restro_id);
            return $query = $this->db->get()->result();


        }
        public function  get_food_type_list()
        { 

            $this->db->select("*");
            $this->db->from("restro_food_type");
            return $this->db->get()->result();



        }

        public function  get_item_category_list()
        {
            $this->db->select("*");
            $this->db->from("tbl_item_category");
            return $this->db->get()->result();

        }
        public function add_food_type($title,$user_id,$admin_id,$food_type_desc)
        { 
            $data['food_title']=$title;
            $data['user_id']=$user_id;
            $data['admin_id']=$admin_id;
            $data['food_description']=$food_type_desc;


            $this->db->insert("restro_food_type",$data);

            return true;




        }

        public function resro_item_category_list()
        {
            $this->db->select("*");
            $this->db->from("tbl_item_category");
            $this->db->order_by("cat_name", "asc");
            return $this->db->get()->result();





        }
        public function  cuisine_list()
        {
            $this->db->select("*");
            $this->db->from("restro_cuisine");
            $this->db->order_by("name", "asc");
            return $this->db->get()->result();



        }

        public function  getall_owner_id($oid)
        {
            if($oid)
            {
                $this->db->select('owner_id');
                $this->db->from('users');
                $this->db->like('owner_id', $oid);
                return $this->db->get()->result_array();
                //print_r($res);
            }

        }
        public function add_restro_image($restroImages)
        {
            $this->db->insert("restro_images",$restroImages);

        }
        public function get_restro_user_id($ownerId)
        {
            $this->db->select("id");
            $this->db->from("users");
            $this->db->where('owner_id',$ownerId);
            return $this->db->get()->row_array();



        }
        public function  add_restro_type($restroType)
        {

            $this->db->insert('restro_type',$restroType);


        }
        public function add_type_service($restroTypeService)
        {
            $this->db->insert("restro_services_commission",$restroTypeService);

        }


        public function getServices($restroId)
        {

            $this->db->select("restro_services.cat_name");
            $this->db->from("restro_services");
            $this->db->join('restro_services_commission', 'restro_services.id = restro_services_commission.service_type');
            $this->db->where("restro_services_commission.restro_id",$restroId);
            return $res=$this->db->get()->result();


        }

        public function getRestaurantType($restroId)
        {
            $this->db->select("restro_facility_type");
            $this->db->from("restro_type");
            $this->db->where("restro_id",$restroId);
            return $this->db->get()->result();

        }

        public function add_service($data,$workingInfo)
        {


            $this->db->insert("restro_payments_method",$data);
            if($workingInfo)
            {
                $this->db->insert("restro_working_hour",$workingInfo);  
            }
            return 1;
        }

        public function  add_delivery_service($data,$workingInfo)
        {
            $this->db->insert("restro_payments_method",$data);

            $this->db->insert("restro_working_hour",$workingInfo);  
            return true;

        }

        public function  add_restro_delivery_service_info($user_id,$restro_id, $restro_info)
        {
            $this->db->where('user_id',$user_id);
            $this->db->where('id',$restro_id);
            $this->db->update('restro_info',$restro_info);
            return true;

        }

        public function   add_reservation_service($payment, $workingInfo, $seatingInfos=null)
        {

            $this->db->insert("restro_payments_method",$payment);
            $this->db->insert("restro_working_hour",$workingInfo);  

            if(isset($seatingInfos)) {
                foreach($seatingInfos as $info) {
                    $this->db->insert("restro_seating_hours", $info);
                }   
            }
            return "yes";


        }

        public function  add_restro_reservation_service_info($user_id,$restro_id, $restro_info)
        {
            $this->db->where('user_id',$user_id);
            $this->db->where('id',$restro_id);
            $this->db->update('restro_info',$restro_info);
            return true;

        }

        public function  add_catering_service($data,$workingInfo)
        {
            $this->db->insert("restro_payments_method",$data);

            $this->db->insert("restro_working_hour",$workingInfo);  
            return true;

        }

        public function  add_restro_catering_service_info($user_id,$restro_id, $restro_info)
        {
            $this->db->where('user_id',$user_id);
            $this->db->where('id',$restro_id);
            $this->db->update('restro_info',$restro_info);
            return true;

        }
        public function  add_delivery_area($areaInfo)
        {

            $this->db->insert("restro_city_area",$areaInfo);
            return "yes";


        }
        public function  add_catering_area($areaInfo)
        {

            $this->db->insert("restro_city_area",$areaInfo);
            return "yes";


        }

        public function clear_restro_item_category($restro_id,$service_id,$location_id){
            $this->db->delete('tbl_restro_menu', array('restro_id' => $restro_id,'service_id' => $service_id,'location_id' => $location_id)); 
        }

        public function add_restro_item_category($data){
            $this->db->insert("tbl_restro_menu",$data);
        }

        public function clear_restro_commision($service_id,$restro_id,$location_id){
            $this->db->delete('restro_services_commission', array('restro_id' => $restro_id,'service_type' => $service_id,'location_id' => $location_id)); 
        }

        public function add_restro_commision($data){
            $this->db->insert("restro_services_commission",$data);
        }

        public function getRestroData($restroId)
        {
            $this->db->select("*");
            $this->db->from("restro_info");
            $this->db->where("id",$restroId);
            return $this->db->get()->result();

        }
        public function getRestroImages($restroId){
            $this->db->select("*");
            $this->db->from("restro_images");
            $this->db->where("restro_id",$restroId);
            return $this->db->get()->result();
        }

        public function edit_restro($restro_info,$restro_id){
            $this->db->where('id',$restro_id);
            $this->db->update('restro_info',$restro_info);
        }
        public function clear_restro_seo_cat($restro_id,$user_id){
            $this->db->delete('restro_seo_category_list', array('restro_id' => $restro_id,'user_id' => $user_id)); 
        } 
        public function clear_restro_cuisine($restro_id){
            $this->db->delete('restro_cuisine_ids', array('restro_id' => $restro_id)); 
        }

        public function clear_restro_food_type($restro_id){
            $this->db->delete('food_type_restro_list', array('restro_id' => $restro_id)); 
        }

        public function show_restro_location($restro_id){
            $this->db->select("*");
            $this->db->from("restro_location");
            $this->db->where("restro_id",$restro_id);
            $this->db->where("blank_upload !=",1);
            return $this->db->get()->result();
        }

        public function restro_locations_having_services($restro_id){
            $this->db->select("l.*, GROUP_CONCAT(c.service_type) AS services");
            $this->db->from("restro_location AS l");
            $this->db->join("restro_services_commission AS c", "c.restro_id=l.restro_id AND c.location_id=l.id", "left");
            $this->db->where("l.restro_id",$restro_id);
            $this->db->where("blank_upload !=",1);
            $this->db->group_by("l.id");
            return $this->db->get()->result();
        }

        public function getRestroOwnerId($restro_id){
            $this->db->select("user_id");
            $this->db->from("restro_info");
            $this->db->where("id",$restro_id);
            return $this->db->get()->row_array();
        }

        public function chkBlankUpload($restro_id,$user_id){
            $this->db->select("id");
            $this->db->from("restro_location");
            $this->db->where("blank_upload",1);
            $this->db->where("restro_id",$restro_id);
            $this->db->where("user_id",$user_id);
            $query = $this->db->get();

            if ($query->num_rows() > 0)
            {
                foreach ($query->result() as $row)
                {
                    return $row->id;
                }
            }
            else
            {
                return 0;
            }
        }
        public function inserBlankLocation($data){
            $this->db->insert('restro_location',$data);
            return $this->db->insert_id();
        }

        public function RestroItemCategoryLocationCount($location_id,$restro_id,$service_id){
            $this->db->select("id");
            $this->db->from("tbl_restro_menu");
            $this->db->where("location_id",$location_id);
            $this->db->where("restro_id",$restro_id);
            $this->db->where("service_id",$service_id);
            $query = $this->db->get();
            return $query->num_rows();
        }

        public function edit_restro_location($data,$location_id){
            $this->db->where('id',$location_id);
            $this->db->update('restro_location',$data);
        }

        public function getLocationData($restro_id,$location_id){
            $this->db->select("*");
            $this->db->from("restro_location");
            $this->db->where("restro_id",$restro_id);
            $this->db->where("id",$location_id);
            $this->db->where("blank_upload",0);
            return $this->db->get()->result();
        }

        public function getCommisionData($restro_id,$location_id,$service_id){
            $this->db->select("restro_services_commission.service_commision,restro_services_commission.status,restro_services_commission.service_amount,restro_working_hour.*,restro_payments_method.method_type");
            $this->db->from("restro_services_commission");
            $this->db->join('restro_working_hour', 'restro_working_hour.location_id = restro_services_commission.location_id');
            $this->db->join('restro_payments_method', 'restro_payments_method.location_id = restro_services_commission.location_id');
            $this->db->where("restro_services_commission.restro_id",$restro_id); 
            $this->db->where("restro_services_commission.service_type",$service_id);
            $this->db->where("restro_services_commission.location_id",$location_id);
            $this->db->where("restro_working_hour.service_id",$service_id);
            $this->db->where("restro_working_hour.restro_id",$restro_id);  
            $this->db->where("restro_payments_method.service_type",$service_id);
            $this->db->where("restro_payments_method.restro_id",$restro_id);
            return $res=$this->db->get()->row_array();
        }

        public function getReservationCommisionData($restro_id,$location_id,$service_id){
            $this->db->select("restro_services_commission.service_commision,restro_services_commission.status,restro_services_commission.service_amount,restro_working_hour.*");
            $this->db->from("restro_services_commission");
            $this->db->join('restro_working_hour', 'restro_working_hour.location_id = restro_services_commission.location_id');
            $this->db->where("restro_services_commission.restro_id",$restro_id); 
            $this->db->where("restro_services_commission.service_type",$service_id);
            $this->db->where("restro_services_commission.location_id",$location_id);
            $this->db->where("restro_working_hour.service_id",$service_id);
            $this->db->where("restro_working_hour.restro_id",$restro_id);  
            return $res=$this->db->get()->row_array();
        }

        public function clear_pickup_payment($restro_id,$location_id,$service_id){
            $this->db->delete('restro_payments_method', array('restro_id' => $restro_id,'location_id' => $location_id,'service_type' => $service_id)); 
        }
        public function clear_pickup_working_hour($restro_id,$location_id,$service_id){
            $this->db->delete('restro_working_hour', array('restro_id' => $restro_id,'location_id' => $location_id,'service_id' => $service_id)); 
        }
        public function clear_seating_hours($restro_id, $location_id){
            $this->db->delete('restro_seating_hours', array('restro_id' => $restro_id,'location_id' => $location_id)); 
        }
        public function clear_restroCityArea($restro_id,$location_id,$service_id){
            $this->db->delete('restro_city_area', array('restro_id' => $restro_id,'location_id' => $location_id,'service_id' => $service_id)); 
        }

        public function getRestroCityArea($restro_id,$location_id,$service_id){
            $this->db->select("*");
            $this->db->from("restro_city_area");
            $this->db->where("restro_id",$restro_id);
            $this->db->where("service_id",$service_id);
            $this->db->where("location_id",$location_id);
            return $this->db->get()->row_array();
        }

        public function delete_restaurant($restaurant_id,$resdata){
            $this->db->where('id',$restaurant_id);
            $this->db->update('restro_info',$resdata);
            return true;

        }

        public function trash_delete_restaurant($restaurant_id,$resdata)
        {
            $this->db->where('id',$restaurant_id);
            $this->db->update('restro_info',$resdata);
            return true;
        }

        public function restore_restaurant($vs)
        {

            $data['trash']=0;
            $this->db->where("id",$vs);
            $this->db->update("restro_info",$data);

            return true;
        }
        public function get_required_details_by_id($id)
        {
            $this->db->select('users.email,users.mail_password,restro_info.owner_code,restro_info.restro_name');
            $this->db->from('users');
            $this->db->join('restro_info', 'users.id = restro_info.user_id');
            $this->db->where("restro_info.id",$id);
            return $this->db->get()->row_array();


        }
        public function restro_activation_status($id)
        {
            $data['activation_status']=1;
            $this->db->where("id",$id);
            $this->db->update("restro_info",$data);
            return true;     
        }

        public function  get_owner_code_list()
        {
            $this->db->select("owner_id");
            $this->db->from("users");
            $this->db->where("user_role",2);
            $this->db->order_by("id","desc");
            return $this->db->get()->result();

        }

        public function check_owner_id_info($oid)
        {
            $this->db->select("*");
            $this->db->from("restro_info");
            $this->db->where("owner_code",$oid);
            if($this->db->get()->result())
            {
                return 1;

            }
            else
            {
                return 0;

            }
        }

        public function getOwnerIdByCode($code){
            $this->db->select("id");
            $this->db->from("users");
            $this->db->where("owner_id",$code);
            return $this->db->get()->row_array();
        }

        public function get_all_owner_location($id){
            $this->db->select("restro_location.id,restro_location.location_name");
            $this->db->from("restro_location");
            $this->db->join("restro_info","restro_info.id = restro_location.restro_id");
            $this->db->join("users","users.id = restro_info.user_id");
            $this->db->where("users.id",$id);
            $this->db->where("restro_location.blank_upload",0);
            $this->db->where("restro_info.trash",0);
            $this->db->group_by("restro_location.id");
            return $this->db->get()->result();
        }

        public function getLocationsForRestro($restroid){
            $this->db->select("*");
            $this->db->from("restro_location");  
            $this->db->where("restro_id", $restroid);   
            return $this->db->get()->result();
        }

        public function get_service_for_restro_owner($id, $location){
            $this->db->select("restro_services.id,restro_services.cat_name");
            $this->db->from("restro_working_hour");
            $this->db->join("restro_info","restro_info.id = restro_working_hour.restro_id");
            $this->db->join("restro_services","restro_services.id = restro_working_hour.service_id");
            $this->db->join("restro_services_commission","restro_services_commission.service_type = restro_working_hour.service_id");
            $this->db->where("restro_info.user_id",$id);
            $this->db->where("restro_services_commission.status",1);
            $this->db->where("restro_working_hour.location_id",$location);
            $this->db->where("restro_services_commission.location_id",$location);
            $this->db->group_by("restro_services.id");
            return $this->db->get()->result();
        }
        public function getServicesForRestroLocation($restro_id, $location_id){
            $this->db->select("restro_services.id, restro_services.cat_name");
            $this->db->from("restro_working_hour");
            $this->db->join("restro_info","restro_info.id = restro_working_hour.restro_id");
            $this->db->join("restro_services","restro_services.id = restro_working_hour.service_id");
            $this->db->join("restro_services_commission","restro_services_commission.service_type = restro_working_hour.service_id");
            $this->db->where("restro_info.id",$restro_id);
            $this->db->where("restro_services_commission.status",1);
            $this->db->where("restro_working_hour.location_id",$location_id);
            $this->db->where("restro_services_commission.location_id",$location_id);
            $this->db->group_by("restro_services.id");
            return $this->db->get()->result();
        }


        public function getOwnerCodeById($id){
            $this->db->select("owner_id");
            $this->db->from("users");
            $this->db->where("id",$id);
            return $this->db->get()->row_array();  
        }

        public function getOwnerlocationByLId($id){
            $this->db->select("location_name");
            $this->db->from("restro_location");
            $this->db->where("id",$id);
            return $this->db->get()->row_array();  
        }
        public function getLocationCityArea($id){
            $this->db->select("*");
            $this->db->from("restro_location");
            $this->db->where("id",$id);
            return $this->db->get()->row_array();  
        }

        public function getRestroCommissionData($restro_id,$location_id,$service_id){
            $this->db->select("*");
            $this->db->from("restro_services_commission");
            $this->db->where("restro_id",$restro_id);
            $this->db->where("service_type",$service_id);
            $this->db->where("location_id",$location_id);
            return $this->db->get()->row_array();  
        }

        public function delete_restaurant_location($location_id){
            $this->db->delete('restro_location', array('id' => $location_id)); 
        }

        public function getAllRestroLocationServiceName($restro_id,$location_id){

            $this->db->select('restro_working_hour.service_id');
            $this->db->from('restro_working_hour');
            $this->db->join('restro_services_commission','restro_services_commission.restro_id = restro_working_hour.restro_id and restro_services_commission.service_type = restro_working_hour.service_id and restro_services_commission.location_id = restro_working_hour.location_id');
            $this->db->where('restro_working_hour.restro_id',$restro_id);
            $this->db->where('restro_working_hour.location_id',$location_id);
            $this->db->where('restro_services_commission.restro_id',$restro_id);
            $this->db->where('restro_services_commission.location_id',$location_id);
            $this->db->where('restro_services_commission.status',1);
            $this->db->group_by('restro_working_hour.service_id');
            return $this->db->get()->result();
            //this->db->get();
            //echo $this->db->last_query();
        }

        public function CityExistWithRestro($id){
            $this->db->select('*');
            $this->db->from('restro_location');
            $this->db->join('restro_info','restro_info.id = restro_location.restro_id');
            $this->db->where('restro_location.city',$id);
            $query = $this->db->get();
            return $query->num_rows();
        }

        public function AreaExistWithRestro($id){
            $this->db->select('*');
            $this->db->from('restro_location');
            $this->db->join('restro_info','restro_info.id = restro_location.restro_id');
            $this->db->where('restro_location.area',$id);
            $query = $this->db->get();
            return $query->num_rows();
        }
        function get_all_restro_tables(){
            $this->db->select('restro_tables.*');
            $this->db->from('restro_tables');
            $this->db->join('restro_info','restro_info.id = restro_tables.restro_id');
            $this->db->join('users','users.id = restro_info.user_id and users.id = restro_tables.user_id ');
            $this->db->where('restro_info.status !=',0);
            $this->db->where('restro_info.trash',0);
            $this->db->group_by('restro_tables.id');
            return $query = $this->db->get()->result();

        }
        public function get_owner_restro_id($id){
            $this->db->select('id');
            $this->db->from('restro_info');
            $this->db->where('user_id',$id);
            $this->db->where('status !=',0);
            $this->db->where('trash',0);
            $this->db->group_by('user_id');
            return $query = $this->db->get()->row_array();

        }

        public function delete_restro_table($id){
            $this->db->delete('restro_tables', array('id' => $id)); 
            return true;
        }



        function get_all_restro_tables_location($user_id,$location_id){
            $this->db->select('restro_tables.*');
            $this->db->from('restro_tables');
            $this->db->join('restro_info','restro_info.id = restro_tables.restro_id');
            $this->db->join('users','users.id = restro_info.user_id and users.id = restro_tables.user_id ');
            $this->db->where('restro_info.status !=',0);
            $this->db->where('restro_info.trash',0);
            $this->db->where('restro_tables.user_id',$user_id);
            $this->db->where('restro_tables.location_id',$location_id);
            $this->db->group_by('restro_tables.id');
            return $query = $this->db->get()->result();

        }

        public function getRestroName($id){
            $this->db->select('restro_name');
            $this->db->from('restro_info');
            $this->db->where('id',$id);
            return $query = $this->db->get()->row_array();


        }

        public function get_variation_Data($id){
            $this->db->select('restro_item_variation_data.*,restro_item_variation.variation_name');
            $this->db->from('restro_item_variation_data');
            $this->db->from('restro_item_variation','restro_item_variation.id = restro_item_variation_data.variation_id');
            $this->db->where('restro_item_variation_data.id',$id);
            return $query = $this->db->get()->row_array();
        }

        public function getRestroNameByOwnerCode($owner_code){
            $this->db->select('restro_name');
            $this->db->from('restro_info');
            $this->db->where('owner_code',$owner_code);
            $this->db->where('status !=',0);
            $this->db->where('trash',0);
            return $query = $this->db->get()->row_array();
        }
    }
?>