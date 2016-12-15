<?php if (!defined('BASEPATH')) {
        exit('No direct script access allowed');
    }

    ob_start();
    class Customer extends CI_Controller {
        function __construct() {
            parent::__construct();

            $this->load->helper(array('form', 'url'));
            $this->load->helper("customer_helper");
            $this->load->helper("restaurant_helper");
            $this->load->library('session');

            $this->load->library('form_validation');
            //$this->load->library('security');
            $this->load->helper('security');
            $this->load->library('tank_auth');
            $this->lang->load('tank_auth');
            $this->load->model("Customer_management");
            $this->load->model("Customer/Home_Restro");
            $this->load->model('Administration/Order_Management');
            $this->load->model('Administration/Dashboard_management');
            $this->load->model("Administration/Notification_management");
            $this->load->model("UserModel");
            $this->load->model("UserProfileModel");
            $this->load->model("UserAddressModel");
            $this->load->model("OrderModel");
            $this->load->model("OrderDetailModel");
            $this->load->model("RestaurantModel");
            $this->load->model("RestroTableOrderModel");
            $this->load->model("RestroSeatingHourModel");
            $this->load->model("PointLogModel");
            $this->load->model("RatingModel");
            $this->load->model("RestroItemVariationModel");
            $this->load->model("AreaModel");
            //$this->load->helper('phpass');
            $this->load->helper('order');
            $this->load->helper('utils');
        }

        public function ajax_customer_login() {
            $data['errors'] = array();
            $mobileNumber = $this->input->post('mobile_no');

            $alphabet = '1234567890';
            $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
            $number = '';
            for ($i = 0; $i < 6; $i++) {
                $n = rand(0, $alphaLength);
                $number = $number . "" . $alphabet[$n];
            }
            $number;

            $otp_gen = $number;
            $otpMSG = urlencode("MATTAM OTP is $otp_gen");

            $apiData = $this->Customer_management->getApiDetails(1);

            $usernameApi = $apiData['username'];
            $usernamePass = $apiData['password'];
            $mobilenumber = @$mobileNumber;
            $usernameSource = $apiData['username_source'];

            $url = file_get_contents("http://103.16.101.52/sendsms/bulksms?username=$usernameApi&password=$usernamePass&destination=$mobilenumber&source=$usernameSource&message=$otpMSG");

            $Mobile_Status = $this->Customer_management->check_user_mobileNo($mobilenumber);

            if ($Mobile_Status == 0) {
                $user['mobile_no'] = $mobilenumber;
                $user['otp'] = $otp_gen;
                $user['otp_status'] = 1;
                $user['user_role'] = 3;
                $user['activated'] = 0;

                $this->Customer_management->insert_user_with_mobile($user);

                $_SESSION['UserMobileNo'] = $mobilenumber;

                echo $msg = 1;
            } else {

                $user['otp'] = $otp_gen;
                $user['otp_status'] = 1;

                $this->Customer_management->update_user_with_mobile($user, $mobilenumber);
                $_SESSION['UserMobileNo'] = $mobilenumber;

                echo $msg = 1;
            }

            if ($url == 1701) {
                $response['status'] = "1";
                $response['Mobile No.'] = $mobilenumber;

            } elseif ($url == 1706) {
                $response['status'] = "0";
                $response['message'] = "Please enter correct mobile no";

                //echo $msg = 0;

            }

        }

        public function ajax_customer_otp_login() {
            $data['errors'] = array();
            $login_otp = $this->input->post('login_otp');

            $mobilenumber = $_SESSION['UserMobileNo'];
            $otpStatus = $this->Customer_management->user_otp_check($login_otp, $mobilenumber);

            if ($otpStatus != 0) {
                $user['otp_status'] = 0;
                $user['otp'] = $otp_gen;
                $user['activated'] = 1;
                $this->Customer_management->update_user_with_mobile($user, $mobilenumber);

                $getUserid = $this->Customer_management->getUserIdByMobile($mobilenumber);

                $_SESSION['Customer_User_Id'] = $getUserid;
                echo $msg = 1;
            } else {

                echo $msg = 0;
            }
        }

        public function login_otp_resend() {
            $data['errors'] = array();

            if ($_SESSION['UserMobileNo'] != '') {

                $alphabet = '1234567890';
                $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
                $number = '';
                for ($i = 0; $i < 6; $i++) {
                    $n = rand(0, $alphaLength);
                    $number = $number . "" . $alphabet[$n];
                }
                $number;

                $otp_gen = $number;
                $otpMSG = urlencode("MATTAM OTP is $otp_gen");

                $apiData = $this->Customer_management->getApiDetails(1);

                $usernameApi = $apiData['username'];
                $usernamePass = $apiData['password'];
                $mobilenumber = @$mobileNumber;
                $usernameSource = $apiData['username_source'];

                $url = file_get_contents("http://103.16.101.52/sendsms/bulksms?username=$usernameApi&password=$usernamePass&destination=$mobilenumber&source=$usernameSource&message=$otpMSG");

                $Mobile_Status = $this->Customer_management->check_user_mobileNo($mobilenumber);

                if ($Mobile_Status == 0) {
                    $user['mobile_no'] = $mobilenumber;
                    $user['otp'] = $otp_gen;
                    $user['otp_status'] = 1;
                    $user['user_role'] = 3;

                    $this->Customer_management->insert_user_with_mobile($user);

                    $_SESSION['UserMobileNo'] = $mobilenumber;

                } else {

                    $user['otp'] = $otp_gen;
                    $user['otp_status'] = 1;

                    $this->Customer_management->update_user_with_mobile($user, $mobilenumber);
                    $_SESSION['UserMobileNo'] = $mobilenumber;

                }

                if ($url == 1701) {
                    $response['status'] = "1";
                    $response['Mobile No.'] = $mobilenumber;

                } elseif ($url == 1706) {
                    $response['status'] = "0";
                    $response['message'] = "Please enter correct mobile no";

                }

                echo '<span style="color: #00B738">OTP Send Successfully done!</span>';
            } else {
                echo '<span style="color: #F73333">Error! Please try again</span>';
            }
        }

        public function add_new_customer() {

            $this->load->library('upload');
            $data['errors'] = array();
            $this->form_validation->set_rules('f_name', 'First Name', 'required');
            $this->form_validation->set_rules('l_name', 'Fast Name', 'required');
            $this->form_validation->set_rules('website', 'Fast Name', 'required');
            $this->form_validation->set_rules('email', 'Email Address', 'required');
            $this->form_validation->set_rules('address', 'Address', 'required');
            //$this->form_validation->set_rules('ownerId', 'Owner Id', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('rpassword', 'Retype Password', 'required');
            $this->form_validation->set_rules('mobile', 'Mobile ', 'required');

            if ($this->form_validation->run() == FALSE) {

            } else {

                $customerInfo1['f_name'] = $this->input->post('f_name');
                $customerInfo1['l_name'] = $this->input->post('l_name');

                $customerInfo['email'] = $this->input->post('email');
                $customerInfo['mail_password'] = $this->input->post('password');

                $data['email'] = $this->input->post('email');

                $customerInfo1['website'] = $this->input->post('website');
                $customerInfo1['address'] = $this->input->post('address');
                $customerInfo1['mobile'] = $this->input->post('mobile');
                $data['site_name'] = $this->config->item('website_name', 'tank_auth');
                $customerInfo['user_role'] = 3;
                if ($this->input->post('password') != $this->input->post('rpassword')) {
                    $data["msg"] = "Password  and confirm password 	does not match";

                } else {
                    $number_of_files = sizeof($_FILES['profile_pic']['tmp_name']);
                    $files = $_FILES['profile_pic'];
                    $data['image_errors'] = 'Couldn\'t upload the file(s)';
                    $config['upload_path'] = FCPATH . 'profile_images/';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $_FILES['profile_pic']['name'] = $files['name'];
                    $_FILES['profile_pic']['type'] = $files['type'];
                    $_FILES['profile_pic']['tmp_name'] = $files['tmp_name'];
                    $_FILES['profile_pic']['error'] = $files['error'];
                    $_FILES['profile_pic']['size'] = $files['size'];
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload('profile_pic')) {
                        $data['image'] = $this->upload->data();
                        $customerInfo1['image'] = $data['image']['full_path'];

                    } else {
                        $data['image_errors'] = $this->upload->display_errors();

                    }

                    $hasher = new PasswordHash(
                        $this->config->item('phpass_hash_strength', 'tank_auth'),
                        $this->config->item('phpass_hash_portable', 'tank_auth'));
                    $customerInfo['password'] = $hasher->HashPassword($this->input->post('password'));

                    $data['mailCheck'] = $this->Customer_management->check_user_email($customerInfo['email']);
                    if ($data['mailCheck'] == 1) {
                        $data['mailCheck1'] = "Email addresss is not available";
                    } else {
                        $data['username'] = $this->Customer_management->add_customer($customerInfo, $customerInfo1);
                        if ($data['username']) {
                            //$this->_send_email('welcome', $data['email'], $data);
                            $data['success'] = "Restaurant Owner Added successfully";

                        }

                    }
                }

                redirect('/customer_list/');
            }

            $this->load->view("Customer/new_customer", $data);

        }

        public function edit_restaurant_owner() {
            $data['error'] = array();
            $restro_owner_id = $this->uri->segment(2);
            $this->load->library('upload');
            $data['owner_detail'] = $this->Customer_management->getCustomerDetails($restro_owner_id);
            if ($this->input->post('id')) {
                $customerInfo2['f_name'] = $this->input->post('f_name');
                $customerInfo2['l_name'] = $this->input->post('l_name');
                $customerInfo1['email'] = $this->input->post('email');
                $customerInfo1['banned'] = $this->input->post('status');

                $customerInfo1['password'] = $this->input->post('password');
                $customerInfo2['website'] = $this->input->post('website');
                $customerInfo2['address'] = $this->input->post('address');
                $customerInfo2['mobile'] = $this->input->post('mobile');

                $number_of_files = sizeof($_FILES['profile_pic']['tmp_name']);
                if ($number_of_files > 0) {

                    $files = $_FILES['profile_pic'];

                    $data['image_errors'] = 'Couldn\'t upload the file(s)';
                    $config['upload_path'] = FCPATH . 'profile_images/';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $_FILES['profile_pic']['name'] = $files['name'];
                    $_FILES['profile_pic']['type'] = $files['type'];
                    $_FILES['profile_pic']['tmp_name'] = $files['tmp_name'];
                    $_FILES['profile_pic']['error'] = $files['error'];
                    $_FILES['profile_pic']['size'] = $files['size'];
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload('profile_pic')) {
                        $data['image'] = $this->upload->data();
                        $customerInfo2['image'] = $data['image']['full_path'];

                    } else {
                        $data['image_errors'] = $this->upload->display_errors();

                    }

                }

                $hasher = new PasswordHash(
                    $this->config->item('phpass_hash_strength', 'tank_auth'),
                    $this->config->item('phpass_hash_portable', 'tank_auth'));
                $customerInfo1['password'] = $hasher->HashPassword($this->input->post('password'));

                if ($this->Customer_management->updateCustomerDetails($customerInfo1, $customerInfo2, $this->input->post('id'))) {

                    $this->session->set_flashdata('updateMsg', 'Updated Successfully');
                    redirect("/customer_list/");

                }

            }

            $this->load->view("Customer/edit_restro_owner", $data);

        }

        public function deleteOwner() {

            echo $this->Customer_management->deleteOwner($this->input->post('oid'));

        }

        public function customer_list() {
            $data['errors'] = array();

            $data['cust_list'] = $this->Customer_management->getCustomers();

            $this->load->view("Customer/customer_list", $data);

        }

        function check_owner_id() {

            $this->Customer_management->check_owner_id($this->input->post("oid"));
            //echo $this->$this->input->post("oid");

        }

        function check_email() {

            if ($this->Customer_management->check_user_email($this->input->post("email"))) {
                echo "Email Address not available";

            } else {
                echo "Email Address Available";

            }

        }
        function customer_dashboard($page = "") {

            $data['errors'] = array();
            $user_id = $this->session->userdata('user_id');
            //$UserMobileNo = $_SESSION['UserMobileNo'];
            $data['customer_maindata'] = $this->Customer_management->getCustomersDetails($user_id);
            $data['customer_profile'] = $this->Customer_management->getCustomersProfileDetails($user_id);

            $data['areas'] = $this->AreaModel->find(); //echo json_encode($data['areas']);
            //  ======================= Get Order Data ======================
            $offset = 0;
            $limit = 50;
            $params = array();
            $params["user_id"] = $user_id;
            $params["offset"] = $offset;
            $params["limit"] = $limit;
            $orders = array_merge($this->OrderModel->find(1, $params), $this->OrderModel->find(2, $params), $this->OrderModel->find(4, $params)); 

            foreach($orders as $order) {                       
                $restaurant = $order->restaurant = $this->RestaurantModel->findByRestroLocationService($order->restro_id, $order->location_id, $order->service_type);
                if($order->status != -1) {   // Cancelled
                    $now = time();
                    $order_time = strtotime($order->date." ".$order->time);
                    if($restaurant && $now - $order_time >= $restaurant->order_time) {
                        $order->status = 3; //Completed
                    } else {
                        $order->status = 1; //Under Process
                    }
                }
            }
            object_array_sort_by_column($orders, 'created_time', SORT_DESC);
            $data['orderData'] = $orders;

            // ======================= Get Reservation Data ====================            
            $orders = $this->RestroTableOrderModel->find(array('user_id'=>$user_id));
            foreach($orders as $order) {                       
                $restaurant = $order->restaurant = $this->RestaurantModel->findByRestroLocationService($order->restro_id, $order->location_id, 3);
                if($order->status == 2) {   // Accepted or Waiting Payment
                    $weekday = strtolower(date('l', strtotime($order->date)));
                    $seating_info = getSeatingInfo($order->restro_id, $order->location_id, $weekday, $order->time);

                    if($seating_info['deposit']==0 || ($seating_info['deposit']>0&&$order->pay_done)) {
                        $order->status = 3;
                    }
                }
            }   
            $data['ReservationData'] = $orders; 

            // ====================== Get My Points Data ======================
            $points = $this->PointLogModel->find(array('user_id'=>$user_id));
            foreach($points as $point) {
                $order = $point->order = $this->OrderModel->findById($point->service_id, $point->order_id);
                    if($order) $point->restaurant = $this->RestaurantModel->findByRestroLocationService($order->restro_id, $order->location_id, $order->service_type);
            }
            $data['PointData'] = $points;


            $data['promotions'] = $this->Customer_management->all_promotions();     
            $data['customer_address'] = $this->Home_Restro->get_customer_address_data($user_id);
            $data['web_list'] = $this->Notification_management->get_wp_notification();

            $data['privacy_data'] = $this->Dashboard_management->get_privacy();
            $data['tearms_data'] = $this->Dashboard_management->get_tearms();

            $data['page'] = $this->uri->segment(2);

            if (isset($_POST['orderratIt'])) {
                $restro_id = $this->input->post('hidden_pop_restro');
                $location_id = $this->input->post('hidden_pop_location');
                $star_value = $this->input->post('star_value');
                $msg = $this->input->post('message');
                
                $this->RatingModel->delete(array('user_id'=>$user_id, 'restro_id'=>$restro_id, 'location_id'=>$location_id));
                                
                $this->RatingModel->create(array('user_id'=>$user_id,'restro_id'=>$restro_id, 'location_id'=>$location_id, 'star_value'=>$star_value, 'msg'=>$msg, 'ip'=>$_SERVER['REMOTE_ADDR']));

                redirect('/customer_dashboard/orders');

            }

            if (isset($_POST['new_pass']) && $_POST['new_pass'] != "") {

                $hasher = new PasswordHash(
                    $this->config->item('phpass_hash_strength', 'tank_auth'),
                    $this->config->item('phpass_hash_portable', 'tank_auth'));

                $this->form_validation->set_rules('old_pass', 'Old Password', 'trim|required|xss_clean|min_length[' . $this->config->item('password_min_length', 'tank_auth') . ']|max_length[' . $this->config->item('password_max_length', 'tank_auth') . ']|alpha_dash');
                $this->form_validation->set_rules('new_pass', 'New Password', 'trim|required|xss_clean|min_length[' . $this->config->item('password_min_length', 'tank_auth') . ']|max_length[' . $this->config->item('password_max_length', 'tank_auth') . ']|alpha_dash');
                $this->form_validation->set_rules('confirm_pass', 'Confirm Password', 'trim|required|xss_clean|matches[new_pass]');

                if ($this->form_validation->run() == FALSE) {

                } else {
                    $old_pass = $this->input->post('old_pass');

                    $query = $this->Customer_management->checkOldPass($user_id);
                    $password = $query['password'];
                    $email = $query['email'];

                    if ($hasher->CheckPassword($old_pass, $password)) {

                        $change['password'] = $hasher->HashPassword($this->input->post('new_pass'));
                        $query = $this->Customer_management->saveNewPass($change, $user_id);

                        //$data['site_name'] = $this->config->item('website_name', 'tank_auth');

                        // Send email with new email address and its activation link
                        //$this->_send_email('change_email', $email, $data);

                        $data['successMsg'] = '<span style="color:green">Password Changed Successfully done!</span>';
                    } else {
                        $data['successMsg'] = '<span style="color:red">Something is Error!</span>';
                    }
                }

            }

            if (isset($_POST['btnaddressave'])) {
                $this->form_validation->set_rules('billing_full_name', 'Billing Full Name', 'required');
                $this->form_validation->set_rules('billing_addres_1', 'Billing Address 1', 'required');
                $this->form_validation->set_rules('billing_city', 'Billing City', 'required');
                $this->form_validation->set_rules('billing_state', 'Billing State', 'required');
                $this->form_validation->set_rules('billing_zip_code', 'Billing Zip Code', 'required');
                $this->form_validation->set_rules('billing_phoneno', 'Billing Phone No.', 'required');
                $this->form_validation->set_rules('shipping_full_name', 'Shipping Full Name', 'required');
                $this->form_validation->set_rules('shipping_address_1', 'Shipping Address 1', 'required');
                $this->form_validation->set_rules('shipping_city', 'Shipping City', 'required');
                $this->form_validation->set_rules('shipping_state', 'Shipping State', 'required');
                $this->form_validation->set_rules('shipping_zip_code', 'Shipping Zip Code', 'required');
                $this->form_validation->set_rules('shipping_phoneno', 'Shipping Phone No.', 'required');

                if ($this->form_validation->run() == FALSE) {

                } else {

                    $addressData['billing_full_name'] = $this->input->post('billing_full_name');
                    $addressData['billing_addres_1'] = $this->input->post('billing_addres_1');
                    $addressData['billing_address_2'] = $this->input->post('billing_address_2');
                    $addressData['billing_city'] = $this->input->post('billing_city');
                    $addressData['billing_state'] = $this->input->post('billing_state');
                    $addressData['billing_zip_code'] = $this->input->post('billing_zip_code');
                    $addressData['billing_phoneno'] = $this->input->post('billing_phoneno');

                    $addressData['shipping_full_name'] = $this->input->post('shipping_full_name');
                    $addressData['shipping_address_1'] = $this->input->post('shipping_address_1');
                    $addressData['shipping_address_2'] = $this->input->post('shipping_address_2');
                    $addressData['shipping_city'] = $this->input->post('shipping_city');
                    $addressData['shipping_state'] = $this->input->post('shipping_state');
                    $addressData['shipping_zip_code'] = $this->input->post('shipping_zip_code');
                    $addressData['shipping_phoneno'] = $this->input->post('shipping_phoneno');
                    $addressData['user_id'] = $user_id;

                    $this->Customer_management->address_add($addressData);

                }
            }

            if (isset($_POST['btnaddresEdit'])) {
                $this->form_validation->set_rules('billing_full_namee', 'Billing Full Name', 'required');
                $this->form_validation->set_rules('billing_addres_1e', 'Billing Address 1', 'required');
                $this->form_validation->set_rules('billing_citye', 'Billing City', 'required');
                $this->form_validation->set_rules('billing_statee', 'Billing State', 'required');
                $this->form_validation->set_rules('billing_zip_codee', 'Billing Zip Code', 'required');
                $this->form_validation->set_rules('billing_phonenoe', 'Billing Phone No.', 'required');
                $this->form_validation->set_rules('shipping_full_namee', 'Shipping Full Name', 'required');
                $this->form_validation->set_rules('shipping_address_1e', 'Shipping Address 1', 'required');
                $this->form_validation->set_rules('shipping_citye', 'Shipping City', 'required');
                $this->form_validation->set_rules('shipping_statee', 'Shipping State', 'required');
                $this->form_validation->set_rules('shipping_zip_codee', 'Shipping Zip Code', 'required');
                $this->form_validation->set_rules('shipping_phonenoe', 'Shipping Phone No.', 'required');

                if ($this->form_validation->run() == FALSE) {

                } else {

                    $addressData['billing_full_name'] = $this->input->post('billing_full_namee');
                    $addressData['billing_addres_1'] = $this->input->post('billing_addres_1e');
                    $addressData['billing_address_2'] = $this->input->post('billing_address_2e');
                    $addressData['billing_city'] = $this->input->post('billing_citye');
                    $addressData['billing_state'] = $this->input->post('billing_statee');
                    $addressData['billing_zip_code'] = $this->input->post('billing_zip_codee');
                    $addressData['billing_phoneno'] = $this->input->post('billing_phonenoe');

                    $addressData['shipping_full_name'] = $this->input->post('shipping_full_namee');
                    $addressData['shipping_address_1'] = $this->input->post('shipping_address_1e');
                    $addressData['shipping_address_2'] = $this->input->post('shipping_address_2e');
                    $addressData['shipping_city'] = $this->input->post('shipping_citye');
                    $addressData['shipping_state'] = $this->input->post('shipping_statee');
                    $addressData['shipping_zip_code'] = $this->input->post('shipping_zip_codee');
                    $addressData['shipping_phoneno'] = $this->input->post('shipping_phonenoe');

                    $address_id = $this->input->post('address_id');

                    $this->Customer_management->edit_customer_address($addressData, $address_id, $user_id);

                    redirect('/customer_dashboard/settings');
                }
            }

            if (isset($_POST['btnAddressEdit'])) {
                $editprofile = array();
                $editprofile['area'] = $this->input->post('cus_area');
                $editprofile['city'] = $this->input->post('cus_city');
                $editprofile['street'] = $this->input->post('street');
                $editprofile['block'] = $this->input->post('cus_block');
                $editprofile['appartment'] = $this->input->post('appartment');
                $editprofile['floor'] = $this->input->post('floor');
                $editprofile['direction'] = $this->input->post('direction');
                $editprofile['house_name'] = $this->input->post('house_name_no');
                $editprofile['address'] = $this->input->post('address');
                $editprofile['user_id'] = $this->input->post('user_id');
                #if customer profile has data means update case
                if (count($data['customer_profile']) > 0) {
                    $this->db->where('user_id', $user_id);
                    $this->db->update('user_profiles', $editprofile);
                } else {
                    // you can also write queries here its valid if not ci will not allowed it by default
                    $editprofile['user_id'] = $user_id;
                    $this->db->insert('user_profiles', $editprofile);
                }
            }
            if (isset($_POST['btnprofileEdit'])) {

                $editprofile['f_name'] = $this->input->post('cust_f_name');
                $editprofile['l_name'] = $this->input->post('cust_l_name');
                $editprofile1['email'] = $this->input->post('cust_email');
                $UserMobileNo = $this->input->post('new_mobile_no');
                $m_c_password = $this->input->post('m_c_password');
                #if user change mobile number let update db
                if ($UserMobileNo != "") {
                    $confirm_mobile = $this->input->post('confirm_mobile_no');

                    if ($confirm_mobile === $UserMobileNo) {
                        $query = $this->Customer_management->checkOldPass($user_id);
                        $password = $query['password'];
                        $hasher = new PasswordHash(
                            $this->config->item('phpass_hash_strength', 'tank_auth'),
                            $this->config->item('phpass_hash_portable', 'tank_auth'));
                        if ($hasher->CheckPassword($m_c_password, $password)) {
                            $editprofile1['mobile_no'] = $UserMobileNo;
                            $editprofile['mobile'] = $UserMobileNo;
                        } else {
                            $data['successMsg'] = '<span style="color:red">Something is Error!</span>';
                        }
                    }

                }
                $editprofile['gender'] = $this->input->post('cust_gender');
                $editprofile['birthdate'] = $this->input->post('cust_birth');

                $this->load->library('upload');
                $files = $_FILES['cust_img'];

                if ($_FILES['cust_img']['error'] != 0) {

                    $data['image_errors'] = 'Couldn\'t upload the file(s)';

                }

                $config['upload_path'] = FCPATH . 'images/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';

                $_FILES['cust_img']['name'] = $files['name'];
                $_FILES['cust_img']['type'] = $files['type'];
                $_FILES['cust_img']['tmp_name'] = $files['tmp_name'];
                $_FILES['cust_img']['error'] = $files['error'];
                $_FILES['cust_img']['size'] = $files['size'];

                //now we initialize the upload library
                $this->upload->initialize($config);
                if ($this->upload->do_upload('cust_img')) {

                    $image_data = $this->upload->data();
                    $editprofile['image'] = $image_data['full_path'];
                } else {
                    $data['image_errors'] = $this->upload->display_errors();

                }
                #if customer profile has data means update case
                if (count($data['customer_profile']) > 0) {
                    $this->Customer_management->edit_customer_profile($editprofile1, $editprofile, $user_id);
                } else {
                    // you can also write queries here its valid if not ci will not allowed it by default
                    $editprofile['user_id'] = $user_id;
                    $this->db->insert('user_profiles', $editprofile);
                    $this->db->where('id', $user_id);
                    $this->db->update('users', $editprofile1);
                }

                redirect('/customer_dashboard/settings');

            }
            // echo "<pre>";
            // print_r($data);die;
            if ($data['page'] == "addresses") {
                $data['city'] = $this->get_city();
            }
            $this->load->view("Customer/customer_dashboard", $data);
        }

        function _send_email($type, $email, &$data) {
            $this->load->library('email');
            $this->email->from($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
            $this->email->reply_to($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
            $this->email->to($email);
            $this->email->subject(sprintf($this->lang->line('auth_subject_' . $type), $this->config->item('website_name', 'tank_auth')));
            $this->email->message($this->load->view('email/' . $type . '-html', $data, TRUE));
            $this->email->set_alt_message($this->load->view('email/' . $type . '-txt', $data, TRUE));
            $this->email->send();
        }

        public function mycart() {
            $data['errors'] = array();
            $user_id = $_SESSION['Customer_User_Id'];
            if ($user_id == '') {
                redirect('/');
            }

            if (isset($_POST['delivery_checkout'])) {
                $_SESSION['order_restro_id'] = $this->input->post('delivery_restro_id');
                redirect('/checkout');
            }
            if (isset($_POST['catering_checkout'])) {
                $_SESSION['order_restro_id'] = $this->input->post('catering_restro_id');
                redirect('/catering_checkout');
            }
            if (isset($_POST['pickup_checkout'])) {
                $_SESSION['order_restro_id'] = $this->input->post('pickup_restro_id');
                redirect('/pickup_checkout');
            }
            if (isset($_POST['reservation_checkout'])) {
                $_SESSION['order_restro_id'] = $this->input->post('reservation_restro_id');
                redirect('/reservation_checkout');
            }
            $data['DcartData'] = $this->Home_Restro->view_my_cart($user_id);
            $data['PcartData'] = $this->Home_Restro->view_my_pickup_cart($user_id);
            $data['CcartData'] = $this->Home_Restro->view_my_catering_cart($user_id);
            $data['RcartData'] = $this->Home_Restro->view_my_table_cart($user_id);

            $this->load->view("Customer/mycart", $data);
        }

        public function order_coupon() {

            $coupon_code = $this->input->post('coupon_code');
            $total = $this->input->post('total');

            $coupon_data = $this->Customer_management->get_coupon_value($coupon_code);

            if ($coupon_data['from_date'] != '') {
                if (date('Y-m-d') > $coupon_data['from_date']) {
                    echo ($total * $coupon_data['discount']) / 100;
                } else {
                    echo "EXPIRE";
                }
            } else {
                echo "INVALID";
            }

        }

        function order_used_points() {
            $data['errors'] = array();

            $points = $this->input->post('points');
            $order_amount = $this->input->post('total');

            $restro_id = $_SESSION['order_restro_id'];

            $owner = $this->Customer_management->get_restro_owner_id($restro_id);
            $owner_id = $owner['user_id'];
            $get_point = $this->Customer_management->get_restro_point_value($owner_id);
            $get_point_value = $get_point['points_value'];

            $points_amount = $points * $get_point_value;

            if ($order_amount > $points_amount) {
                //discount_amount,less_points

                echo $points_amount . ',' . $points;
            } else {
                $less_point = $order_amount / $get_point_value;
                //discount_amount,less_points
                echo $order_amount . ',' . round($less_point);
            }
        }

        function customer_logout() {
            if (session_destroy()) {
                redirect('/');
            }
        }

        function order_details($id) {
            $orderid = $this->uri->segment('2');
            $service_id = $this->input->get('service_id');
            if (isset($_POST['updatestatus'])) {
                $status['status'] = $this->input->post('status');
                $status['reject_reson'] = $this->input->post('reject_reson');

                $this->Order_Management->order_status_change($status, $orderid);
            }
            $order = $data['order_data'] = $this->OrderModel->findById($service_id, $orderid);
            $user_id = $this->session->userdata('user_id');
            $customer_data = $this->UserModel->findById($user_id);
            $customer_data->profile = $this->UserProfileModel->findByUserId($user_id);
            $data['customer_data'] = $customer_data;
            $data['customer_address'] = $this->UserAddressModel->findById($data['order_data']->address_id);
            $order_details = $this->OrderDetailModel->find($service_id, array('order_id'=>$orderid));
            
            foreach($order_details as $detail){
                if(isset($detail->variation_ids) && $detail->variation_ids!="") {
                    $variation_ids = explode(",", $detail->variation_ids);
                    $detail->variations = $this->RestroItemVariationModel->findByIds($variation_ids);
                }
            }
            
            $data['order_details'] = $order_details;
            
            

            $this->load->view("Customer/order_details", $data);
        }

        function ajax_customer_address_add() {
            $data['errors'] = array();
            $addressData['billing_full_name'] = $this->input->post('full_name');
            $addressData['billing_addres_1'] = $this->input->post('billing_addres_1');
            $addressData['billing_address_2'] = $this->input->post('billing_address_2');
            $addressData['billing_city'] = $this->input->post('billing_city');
            $addressData['billing_state'] = $this->input->post('billing_state');
            $addressData['billing_zip_code'] = $this->input->post('billing_zip_code');
            $addressData['billing_phoneno'] = $this->input->post('phoneno');

            $addressData['shipping_full_name'] = $this->input->post('shipping_full_name');
            $addressData['shipping_address_1'] = $this->input->post('shipping_address_1');
            $addressData['shipping_address_2'] = $this->input->post('shipping_address_2');
            $addressData['shipping_city'] = $this->input->post('shipping_city');
            $addressData['shipping_state'] = $this->input->post('shipping_state');
            $addressData['shipping_zip_code'] = $this->input->post('shipping_zip_code');
            $addressData['shipping_phoneno'] = $this->input->post('shipping_phoneno');
            $addressData['user_id'] = $_SESSION['Customer_User_Id'];

            $this->Customer_management->address_add($addressData);

            $data['addressData'] = $this->Home_Restro->get_customer_address_data($_SESSION['Customer_User_Id']);

            $this->load->view('ajax_customer_address_show', $data);
        }

        function edit_web_constomer() {
            $data['errors'] = array();
            $user_id = $this->uri->segment('2');
            $data['customer_maindata'] = $this->Customer_management->getCustomersDetails($user_id);
            $data['customer_profile'] = $this->Customer_management->getCustomersProfileDetails($user_id);

            if (isset($_POST['btnsave'])) {

                $profile['email'] = $this->input->post('email');
                $profile['mobile_no'] = $this->input->post('mobile');
                $profile['banned'] = $this->input->post('status');

                $profile1['f_name'] = $this->input->post('f_name');
                $profile1['l_name'] = $this->input->post('l_name');

                $this->load->library('upload');
                $files = $_FILES['cust_img'];

                if ($_FILES['cust_img']['error'] != 0) {

                    $data['image_errors'] = 'Couldn\'t upload the file(s)';

                }

                $config['upload_path'] = FCPATH . 'images/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';

                $_FILES['cust_img']['name'] = $files['name'];
                $_FILES['cust_img']['type'] = $files['type'];
                $_FILES['cust_img']['tmp_name'] = $files['tmp_name'];
                $_FILES['cust_img']['error'] = $files['error'];
                $_FILES['cust_img']['size'] = $files['size'];

                //now we initialize the upload library
                $this->upload->initialize($config);
                if ($this->upload->do_upload('cust_img')) {

                    $image_data = $this->upload->data();
                    $profile1['image'] = $image_data['full_path'];
                } else {
                    $data['image_errors'] = $this->upload->display_errors();

                }

                $this->Customer_management->edit_customer_profile($profile, $profile1, $user_id);

                $data['success_msg'] = 'Web Customer Profile Edit Successfully done!';
            }

            $this->load->view('Administration/edit_web_constomer', $data);

        }

        function view_web_constomer() {
            $data['errors'] = array();
            $user_id = $this->uri->segment('2');
            $data['customer_maindata'] = $this->Customer_management->getCustomersDetails($user_id);
            $data['customer_profile'] = $this->Customer_management->getCustomersProfileDetails($user_id);
            $data['customer_address'] = $this->Home_Restro->get_customer_address_data($user_id);

            $data['customer_orders'] = $this->Customer_management->getCustomersOrderData($user_id);
            $data['customer_catering'] = $this->Customer_management->getCustomersCateringOrderData($user_id);
            $data['customer_reservation'] = $this->Customer_management->getCustomersReservationData($user_id);
            $data['customer_pickup'] = $this->Customer_management->getCustomersPickupData($user_id);

            $this->load->view('Administration/view_web_constomer', $data);

        }

        public function ajax_customer_edit_address() {
            $data['errors'] = array();

            $address_id = $this->input->post('Aid');

            $user_id = $_SESSION['Customer_User_Id'];

            $data['addressData'] = $this->Home_Restro->ajaxaddressFetch_checkout($user_id, $address_id);

            $this->load->view('Customer/ajax_customer_edit_address', $data);

        }
        public function get_area($city_id) {
            $this->db->select('area.id,area.name,city.city_name');
            $this->db->from('area');
            $this->db->join('city', 'city.id = area.city_id');
            $this->db->like('area.city_id', $city_id);
            $area = $this->db->get()->result_array();
            $select = "";
            foreach ($area as $key => $val) {
                $select .= "<option value=" . $val['id'] . ">" . $val['name'] . "</option>";
            }
            echo $select;
        }
        public function get_city() {
            $this->db->select('*');
            $this->db->from('city');
            $city = $this->db->get()->result();
            return $city;
        }
    }

?>