<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
    class Customer_management extends CI_Model
    {


        function __construct()
        {
            parent::__construct();


        }

        function  add_customer($userInfo,$userInfo1)
        {       
            $this->db->insert('users',$userInfo);
            $last_id=$this->db->insert_id();
            $userInfo1['user_id']=$last_id;
            $ownerID="R#00".$last_id;
            $ownerUsername = $ownerID;
            $data=array("owner_id"=>$ownerID,"username"=>$ownerUsername);

            $this->db->where('id',$userInfo1['user_id']);
            $this->db->update('users',$data);

            $this->db->insert('user_profiles',$userInfo1);

            return $ownerID;

        }

        function  check_user_email($email)
        {

            $this->db->select("*");
            $this->db->from("users");
            $this->db->where('email',$email);

            if($this->db->get()->result())
            {
                return 1;
            }
            else
            {
                return 0;
            }



        }
        public function  getCustomers()
        {

            $this->db->select('*');
            $this->db->from('users');
            $this->db->join('user_profiles', 'users.id = user_profiles.user_id') ;
            $this->db->where('users.user_role', 3);
            //$this->db->where('user_profiles.status',1);
            return $query = $this->db->get()->result();

        }
        public function check_owner_id($oid)
        {

            //echo $oid;

            $this->db->where('owner_id',$oid);
            $this->db->select("*");
            $this->db->from('users');
            //$res=$this->db->get()->result();
            //print_r($res);            
            if($this->db->get()->result())
            {
                echo "Owner id is not available";

            }
            else
            {

                echo "Owner id is  available";
            }

        }

        function getCustomersProfileDetails($id){
            $this->db->select("*");
            $this->db->from("user_profiles");
            $this->db->where('user_id',$id);

            return $this->db->get()->result();
        }

        function getCustomerDetails($id)
        {
            $this->db->select("*");
            $this->db->from('users');
            $this->db->join('user_profiles', 'users.id = user_profiles.user_id');
            $this->db->where('users.id',$id);
            return $this->db->get()->row_array();

        }

        public function updateCustomerDetails($ownerInfo1,$ownerInfo2,$id)
        {
            $this->db->where('id',$id);
            $this->db->update('users',$ownerInfo1);
            $this->db->where('user_id',$id);
            $this->db->update('user_profiles',$ownerInfo2);      
            return true;
        }

        public function deleteOwner($oid)
        { 


            $this->db->delete('users', array('users.id' => $oid));
            $this->db->delete('user_profiles', array('user_profiles.user_id' =>$oid));
            return true;

        }

        function getCustomersDetails($id){
            $this->db->select("*");
            $this->db->from("users");
            $this->db->where('id',$id);

            return $this->db->get()->result();
        }

        function checkOldPass($id){

            $this->db->select('password,email');
            $this->db->where('id', $id);
            $query = $this->db->get('users');

            if($query->num_rows() > 0)
                return $query->row_array();
            else
                return 0;

        }

        public function saveNewPass($data,$id){


            $this->db->where('id',  $id);
            $this->db->update('users', $data);
        }

        public function getCustomersOrderData($id){
            $this->db->select("`restro_order`.*, `restro_info`.`restro_name`,`restro_info`.`id` as `restro_id` FROM `restro_order` inner join `restro_order_details` on `restro_order`.`id` = `restro_order_details`.`order_id` inner join `restro_info` on `restro_order_details`.`restro_id` = `restro_info`.`id` where `restro_order`.`user_id` = '".$id."' group by `restro_order`.`id`");
            return $this->db->get()->result();
        }
        public function getCustomersCateringOrderData($id){
            $this->db->select("`restro_catering_order`.*, `restro_info`.`restro_name`,`restro_info`.`id` as `restro_id` FROM `restro_catering_order` inner join `restro_catering_order_details` on `restro_catering_order`.`id` = `restro_catering_order_details`.`order_id` inner join `restro_info` on `restro_catering_order_details`.`restro_id` = `restro_info`.`id` where `restro_catering_order`.`user_id` = '".$id."' group by `restro_catering_order`.`id`");
            return $this->db->get()->result();
        }

        public function getCustomersReservationData($id){
            $this->db->select("`restro_table_order`.*, `restro_info`.`restro_name`,`restro_info`.`id` as `restro_id` FROM `restro_table_order` inner join `restro_booked_table` on `restro_table_order`.`id` = `restro_booked_table`.`order_id` inner join `restro_info` on `restro_booked_table`.`restro_id` = `restro_info`.`id` where `restro_table_order`.`user_id` = '".$id."' group by `restro_table_order`.`id`");
            return $this->db->get()->result();
        }

        public function getCustomersPickupData($id){
            $this->db->select("`restro_pickup_order`.*, `restro_info`.`restro_name`,`restro_info`.`id` as `restro_id` FROM `restro_pickup_order` inner join `restro_pickup_order_details` on `restro_pickup_order`.`id` = `restro_pickup_order_details`.`order_id` inner join `restro_info` on `restro_pickup_order_details`.`restro_id` = `restro_info`.`id` where `restro_pickup_order`.`user_id` = '".$id."' group by `restro_pickup_order`.`id`");
            return $this->db->get()->result();
        }

        public function address_add($addressData){
            $this->db->insert('restro_customer_address',$addressData);
        }

        /*
        function getCARTDetails()
        {
        $this->db->select("*");
        $this->db->from('cart');
        $this->db->join('user_profiles', 'users.id = user_profiles.user_id');
        $this->db->where('users.id',$id);
        return $this->db->get()->row_array();

        } */ 

        public function check_user_mobileNo($mobile){
            $this->db->select('id,email');
            $this->db->where('mobile_no', $mobile);
            $this->db->where('banned !=',1);
            $query = $this->db->get('users');

            if($query->num_rows() > 0)
                return $query->row_array();
            else
                return 0;
        }

        public function insert_user_with_mobile($data){
            $this->db->insert('users',$data);
            $last_id=$this->db->insert_id();
            $userInfo1['user_id']=$last_id;
            $this->db->insert('user_profiles',$userInfo1);
        }

        public function update_user_with_mobile($user,$mobilenumber)
        { 
            $this->db->where('mobile_no',$mobilenumber);
            $this->db->update('users',$user);
            return true;

        }


        public function user_otp_check($login_otp,$mobilenumber){
            $this->db->select('id');
            $this->db->where('otp', $login_otp);
            $this->db->where('mobile_no', $mobilenumber);
            $this->db->where('otp_status', 1);
            $query = $this->db->get('users');

            if($query->num_rows() > 0)
            {
                $res = $query->result();
                foreach($res as $re => $result):
                    return $result->id;
                    endforeach;
            }
            else
            {
                return 0;
            }

        }
        public function getUserIdByMobile($mobilenumber){
            $this->db->select('id');
            $this->db->where('mobile_no',$mobilenumber);
            $this->db->where('otp_status',0);
            $query = $this->db->get('users');

            $res = $query->result();
            foreach($res as $re => $result):
                return $result->id;
                endforeach;
        }

        public function get_customer_points($id){
            $this->db->select('points');
            $this->db->where('user_id',$id);
            $query = $this->db->get('user_profiles');
            $query = $query->result();

            foreach($query as $re => $result):
                return $result->points;
                endforeach;
        }

        public function update_customer_points($user,$data)
        { 
            $this->db->where('user_id',$user);
            $this->db->update('user_profiles',$data);
            return true;

        }

        public function get_coupon_value($code){
            $this->db->select('*');
            $this->db->where('coupon_code',$code);
            $query = $this->db->get('restro_coupons');
            return $query = $query->row_array();

        }

        public function get_restro_owner_id($restro_id){

            $this->db->select('user_id');
            $this->db->where('id',$restro_id);
            $query = $this->db->get('restro_info');
            return $query = $query->row_array();
        } 


        public function get_restro_point_value($owner_id){

            $this->db->select('points_value');
            $this->db->where('user_id',$owner_id);
            $query = $this->db->get('restro_settings');
            return $query = $query->row_array();
        } 
        public function less_points_user_profile($user_id,$points){

        }

        public function edit_customer_profile($data1,$data2,$user_id){
            $this->db->where('id',$user_id);
            $this->db->update('users',$data1);

            $this->db->where('user_id',$user_id);
            $this->db->update('user_profiles',$data2);      
            return true;
        }

        public function all_promotions(){
            $date = date('Y-m-d');
            $this->db->select('restro_promotion.*,restro_info.restro_name,restro_info.status,restro_info.restaurant_logo');
            $this->db->from('restro_promotion');
            $this->db->join('restro_info','restro_info.user_id = restro_promotion.user_id');
            //$this->db->where('restro_promotion.from_date <=', $date);
            //$this->db->where('restro_promotion.to_date >=', $date);
            $this->db->group_by('restro_promotion.id');
            $query = $this->db->get();
            return $query = $query->result();
        }

        public function get_user_mobile_number($id){

            $this->db->select('mobile_no');
            $this->db->where('id',$id);
            $query = $this->db->get('users');
            return $query = $query->row_array();
        }

        public function add_order_rating($data){
            $this->db->insert('restro_order_rating',$data);
        }

        public function getApiDetails($id){
            $this->db->select('*');
            $this->db->where('id',$id);
            $query = $this->db->get('restro_api_access');
            return $query = $query->row_array();
        }

        public function edit_customer_address($data,$id,$user_id){
            $this->db->where('id',$id);
            $this->db->where('user_id',$user_id);
            $this->db->update('restro_customer_address',$data);
        }

        public function getSmsMessage($id){
            $this->db->select('*');
            $this->db->where('id',$id);
            $query = $this->db->get('restro_sms_table');
            return $query = $query->row_array();
        }

        public function get_mobile($uid){
            $this->db->select('mobile_no');
            $this->db->where('id',$uid);

            $query = $this->db->get('users');

            $res = $query->result();
            foreach($res as $re => $result):
                return $result->mobile_no;
                endforeach;
        }

        public function update_otp($otp,$mobilenumber)
        { 
            $this->db->where('mobile_no',$mobilenumber);
            $this->db->update('users',$otp);
            return true;

        }

        public function get_otp($mob){

            $this->db->select('otp');
            $this->db->where('mobile_no',$mob);

            $query = $this->db->get('users');

            $res = $query->result();
            foreach($res as $re => $result):
                return $result->otp;
                endforeach;
        }




    }

?>	