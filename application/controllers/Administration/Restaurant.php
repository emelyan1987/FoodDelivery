<?php if (!defined('BASEPATH')) {
        exit('No direct script access allowed');
    }

    @ob_start();
    class Restaurant extends CI_Controller {
        function __construct() {
            parent::__construct();

            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            //$this->load->library('security');
            $this->load->helper('security');
            $this->load->helper('restaurant_helper');
            $this->load->library('tank_auth');
            $this->lang->load('tank_auth');
            $this->load->model("Administration/Restaurant_management");
            $this->load->model("Administration/Plan_management");
            $this->load->model("Administration/Area_management");
            $this->load->model('Administration/Smtp_management');
            $this->load->library('email');
            $this->load->model("Restaurant_Owner/Restro_Owner_Model");

            //$this->load->model('Model');

        }
        ///////////////////////////////////////////////////////////////////////
        public function index() {

        }

        public function loadData() {
            $loadType = $_POST['loadType'];
            $loadId = $_POST['loadId'];

            $this->load->model('model');
            $result = $this->model->getData($loadType, $loadId);
            $HTML = "";

            if ($result->num_rows() > 0) {
                foreach ($result->result() as $list) {
                    $HTML .= "<option value='" . $list->id . "'>" . $list->name . "</option>";
                }
            }
            echo $HTML;
        }

        ////////////////////////////////////////////////////////////
        function restaurant_list() {

            $data['errors'] = array();
            $data['restro_list'] = $this->Restaurant_management->get_all_restro_list();
            $this->load->view("Administration/restaurant_list", $data);
        }

        public function ajax_food_type_add() {

            $this->Restaurant_management->add_food_type($this->input->post("food_type"), $this->input->post("user_id"), $this->input->post("admin_id"), $this->input->post("food_type_desc"));

            $data['food_type_list'] = $this->Restaurant_management->get_food_type_list();
            $this->load->view("Administration/ajax_food_type_add", $data);

        }

        function restaurant_new() {
            $data['errors'] = array();
            $data['admin_id'] = $this->tank_auth->get_user_id();
            $data['food_type_list'] = $this->Restaurant_management->get_food_type_list();
            $data['resro_item_category'] = $this->Restaurant_management->resro_item_category_list();
            $data['cuisine_list'] = $this->Restaurant_management->cuisine_list();
            $data['get_item_category_list'] = $this->Restaurant_management->get_item_category_list();
            $data['owner_code_list'] = $this->Restaurant_management->get_owner_code_list();
            //print_r($data['owner_code_list']);

            $data['get_seo_category_list'] = $this->Restaurant_management->get_seo_category_list();

            $this->form_validation->set_rules('restro_name', 'Restaurant Name', 'required');
            $this->form_validation->set_rules('restro_info', 'Restaurant Information', 'required');
            $this->form_validation->set_rules('contact_person', 'Restaurant Contact Person', 'required');
            $this->form_validation->set_rules('telephones', 'Restaurant Telehone', 'required');
            $this->form_validation->set_rules('yearly_fee', 'Restaurant Yearly Fee', 'required');
            // $this->form_validation->set_rules('feature', 'Restaurant Featured', 'required');
            $this->form_validation->set_rules('owner_code', 'Restaurant Owner Code', 'required');
            $this->form_validation->set_rules('restro_status', 'Restaurant Status', 'required');

            if ($this->form_validation->run() == FALSE) {

                // echo "<pre>";
                // print_r($this->input->post());die;
            } else {

                $restroInfo['admin_id'] = $this->tank_auth->get_user_id();

                $restroInfo['restro_name'] = $this->input->post('restro_name');
                $restroInfo['restro_description'] = $this->input->post('restro_info');

                $restroInfo['telephones'] = $this->input->post('telephones');
                $restroInfo['yearly_fee'] = $this->input->post('yearly_fee');
                $restroInfo['owner_code'] = $this->input->post('owner_code');

                $restroInfo['contact_person'] = $this->input->post('contact_person');
                $restroInfo['yearly_fee'] = $this->input->post('yearly_fee');
                $restroInfo['assign_featured'] = 0;

                $restroInfo['restro_status'] = $this->input->post('restro_status');

                //$restro_item_cat=$this->input->post('restro_item_cat');

                $restro_seo_cat = $this->input->post('restro_seo_cat');

                // print_r($restro_item_cat);
                //die;

                $food_type = $this->input->post('food_type');
                $cuisine = $this->input->post('cuisine');

                $res = $this->Restaurant_management->get_restro_user_id($this->input->post('owner_code'));
                $restroInfo['user_id'] = $res['id'];
                $restro_data['owner_id'] = $res['id'];
                $this->load->library('upload');

                $restro_seo_cat1['user_id'] = $res['id'];

                $files = $_FILES['restro_logo'];

                if ($_FILES['restro_logo']['error'] != 0) {

                    $data['image_errors'] = 'Couldn\'t upload the file(s)';

                }

                $config['upload_path'] = FCPATH . 'images/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';

                $_FILES['restro_logo']['name'] = $files['name'];
                $_FILES['restro_logo']['type'] = $files['type'];
                $_FILES['restro_logo']['tmp_name'] = $files['tmp_name'];
                $_FILES['restro_logo']['error'] = $files['error'];
                $_FILES['restro_logo']['size'] = $files['size'];
                $this->upload->initialize($config);
                if ($this->upload->do_upload('restro_logo')) {

                    $this->_uploaded = $this->upload->data();
                    $restroInfo['restaurant_logo'] = $this->_uploaded['full_path'];

                } else {
                    $data['image_errors'] = $this->upload->display_errors();

                }

                $restro_id = $this->Restaurant_management->add_restro($restroInfo);
                $restro_data['restro_id'] = $restro_id;
                $restroInfoImage['restro_id'] = $restro_id;

                if ($restro_id) {

                    foreach ($restro_seo_cat as $ks => $vs) {

                        $restro_seo_cat1['category_id'] = $vs;
                        $restro_seo_cat1['restro_id'] = $restro_id;

                        $this->Restaurant_management->add_restro_seo_cat($restro_seo_cat1);

                    }

                    foreach ($cuisine as $vs) {
                        $cuisine1['cuisine_id'] = $vs;
                        $cuisine1['restro_id'] = $restro_id;
                        $this->Restaurant_management->add_restro_cuisine($cuisine1);
                    }

                    foreach ($food_type as $vs) {
                        $food_type1['food_type_id'] = $vs;
                        $food_type1['restro_id'] = $restro_id;
                        $this->Restaurant_management->add_restro_food_type($food_type1);
                    }

                    $this->session->set_userdata("restro_session", $restro_data);

                }

                ////add gallery image..................

                $number_of_files = sizeof($_FILES['gallery_image']['tmp_name']);
                $files = $_FILES['gallery_image'];

                for ($i = 0; $i < $number_of_files; $i++) {
                    if ($_FILES['gallery_image']['error'][$i] != 0) {

                        $data['image_errors'] = 'Couldn\'t upload the file(s)';

                    }
                }

                $config['upload_path'] = FCPATH . 'images/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                for ($i = 0; $i < $number_of_files; $i++) {

                    $_FILES['gallery_image']['name'] = $files['name'][$i];
                    $_FILES['gallery_image']['type'] = $files['type'][$i];
                    $_FILES['gallery_image']['tmp_name'] = $files['tmp_name'][$i];
                    $_FILES['gallery_image']['error'] = $files['error'][$i];
                    $_FILES['gallery_image']['size'] = $files['size'][$i];
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload('gallery_image')) {

                        $this->_uploaded[$i] = $this->upload->data();
                        $restroInfoImage['restro_images'] = $this->_uploaded[$i]['full_path'];
                        $this->Restaurant_management->add_restro_image($restroInfoImage);
                    } else {
                        $data['image_errors2'] = $this->upload->display_errors();

                    }

                }

                redirect("/restaurant_new_location/");

            }
            $data['planData'] = $this->Plan_management->plan_list();

            $this->load->view("Administration/add_new_restaurant", $data);

        }

        function restaurant_edit($id) {

            $restro_id = $this->uri->slash_segment(2);
            $data['errors'] = array();
            $data['admin_id'] = $this->tank_auth->get_user_id();
            $data['food_type_list'] = $this->Restaurant_management->get_food_type_list();
            $data['resro_item_category'] = $this->Restaurant_management->resro_item_category_list();
            $data['cuisine_list'] = $this->Restaurant_management->cuisine_list();
            $data['get_item_category_list'] = $this->Restaurant_management->get_item_category_list();

            $data['get_seo_category_list'] = $this->Restaurant_management->get_seo_category_list();

            $this->form_validation->set_rules('restro_name', 'Restaurant Name', 'required');
            $this->form_validation->set_rules('restro_info', 'Restaurant Information', 'required');
            $this->form_validation->set_rules('contact_person', 'Restaurant Contact Person', 'required');
            $this->form_validation->set_rules('telephones', 'Restaurant Telehone', 'required');
            $this->form_validation->set_rules('yearly_fee', 'Restaurant Yearly Fee', 'required');
            $this->form_validation->set_rules('feature', 'Restaurant Featured', 'required');
            $this->form_validation->set_rules('owner_code', 'Restaurant Owner Code', 'required');
            $this->form_validation->set_rules('restro_status', 'Restaurant Status', 'required');

            if ($this->form_validation->run() == FALSE) {

            } else {
                $restroInfo['admin_id'] = $this->tank_auth->get_user_id();

                $restroInfo['restro_name'] = $this->input->post('restro_name');
                $restroInfo['restro_description'] = $this->input->post('restro_info');

                $restroInfo['telephones'] = $this->input->post('telephones');
                $restroInfo['yearly_fee'] = $this->input->post('yearly_fee');
                $restroInfo['owner_code'] = $this->input->post('owner_code');

                $restroInfo['contact_person'] = $this->input->post('contact_person');
                $restroInfo['yearly_fee'] = $this->input->post('yearly_fee');
                $restroInfo['assign_featured'] = $this->input->post('feature');

                $restroInfo['restro_status'] = $this->input->post('restro_status');

                //$restro_item_cat=$this->input->post('restro_item_cat');

                $restro_seo_cat = $this->input->post('restro_seo_cat');

                // print_r($restro_item_cat);
                //die;

                $food_type = $this->input->post('food_type');
                $cuisine = $this->input->post('cuisine');

                $res = $this->Restaurant_management->get_restro_user_id($this->input->post('owner_code'));

                $this->load->library('upload');

                $restro_seo_cat1['user_id'] = $res['id'];

                $files = $_FILES['restro_logo'];

                if ($_FILES['restro_logo']['error'] != 0) {

                    $data['image_errors'] = 'Couldn\'t upload the file(s)';

                }

                $config['upload_path'] = FCPATH . 'images/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';

                $_FILES['restro_logo']['name'] = $files['name'];
                $_FILES['restro_logo']['type'] = $files['type'];
                $_FILES['restro_logo']['tmp_name'] = $files['tmp_name'];
                $_FILES['restro_logo']['error'] = $files['error'];
                $_FILES['restro_logo']['size'] = $files['size'];
                $this->upload->initialize($config);
                if ($this->upload->do_upload('restro_logo')) {

                    $this->_uploaded = $this->upload->data();
                    $restroInfo['restaurant_logo'] = $this->_uploaded['full_path'];

                } else {
                    $data['image_errors'] = $this->upload->display_errors();

                }

                $this->Restaurant_management->edit_restro($restroInfo, $restro_id);
                $restro_data['restro_id'] = $restro_id;
                $restroInfoImage['restro_id'] = $restro_id;

                if ($restro_id) {
                    $this->Restaurant_management->clear_restro_seo_cat($restro_id, $restro_seo_cat1['user_id']);
                    if (count($restro_seo_cat) > 0) {
                        foreach ($restro_seo_cat as $ks => $vs) {

                            $restro_seo_cat1['category_id'] = $vs;
                            $restro_seo_cat1['restro_id'] = $restro_id;

                            $this->Restaurant_management->add_restro_seo_cat($restro_seo_cat1);

                        }
                    }

                    $this->Restaurant_management->clear_restro_cuisine($restro_id);
                    if ($cuisine != '') {
                        foreach ($cuisine as $vs) {
                            $cuisine1['cuisine_id'] = $vs;
                            $cuisine1['restro_id'] = $restro_id;
                            $this->Restaurant_management->add_restro_cuisine($cuisine1);
                        }
                    }

                    $this->Restaurant_management->clear_restro_food_type($restro_id);

                    if (count($food_type) > 0) {
                        foreach ($food_type as $vs) {
                            $food_type1['food_type_id'] = $vs;
                            $food_type1['restro_id'] = $restro_id;
                            $this->Restaurant_management->add_restro_food_type($food_type1);
                        }
                    }
                    //$this->session->set_userdata("restro_session",$restro_data);

                }

                ////add gallery image..................

                $number_of_files = sizeof($_FILES['gallery_image']['tmp_name']);
                $files = $_FILES['gallery_image'];

                for ($i = 0; $i < $number_of_files; $i++) {
                    if ($_FILES['gallery_image']['error'][$i] != 0) {

                        $data['image_errors'] = 'Couldn\'t upload the file(s)';

                    }
                }

                $config['upload_path'] = FCPATH . 'images/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                for ($i = 0; $i < $number_of_files; $i++) {

                    $_FILES['gallery_image']['name'] = $files['name'][$i];
                    $_FILES['gallery_image']['type'] = $files['type'][$i];
                    $_FILES['gallery_image']['tmp_name'] = $files['tmp_name'][$i];
                    $_FILES['gallery_image']['error'] = $files['error'][$i];
                    $_FILES['gallery_image']['size'] = $files['size'][$i];
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload('gallery_image')) {

                        $this->_uploaded[$i] = $this->upload->data();
                        $restroInfoImage['restro_images'] = $this->_uploaded[$i]['full_path'];
                        $this->Restaurant_management->add_restro_image($restroInfoImage);
                    } else {
                        $data['image_errors2'] = $this->upload->display_errors();

                    }

                }
                $this->session->set_flashdata("success_emsg", "Restaurant Edit Successfully done");
                redirect("/restaurant_list/");

            }

            $data['restroData'] = $this->Restaurant_management->getRestroData($restro_id);
            $data['restroimg'] = $this->Restaurant_management->getRestroImages($restro_id);
            $this->load->view("Administration/edit_restaurant", $data);

        }

        public function restaurant_new_location() {
            $data['errors'] = array();

            $restro_data = $this->session->userdata("restro_session");

            $data['city_list'] = $this->Area_management->get_city_list();
            $data['area_list'] = $this->Area_management->get_area_list();
            $data['item_catlist'] = $this->Restaurant_management->get_item_category_list();

            if (($restro_data['restro_id'] != '') && ($restro_data['owner_id'] != '')) {
                $count = $this->Restaurant_management->chkBlankUpload($restro_data['restro_id'], $restro_data['owner_id']);
                if ($count != 0) {
                    $location_id = $count;
                } else {
                    $datablank['restro_id'] = $restro_data['restro_id'];
                    $datablank['user_id'] = $restro_data['owner_id'];
                    $datablank['blank_upload'] = 1;

                    $location_id = $this->Restaurant_management->inserBlankLocation($datablank);
                }
                $data['location_id'] = $location_id;
            }

            $this->form_validation->set_rules('location_name', 'Restaurant Location Name', 'required');
            $this->form_validation->set_rules('contact_name', 'Restaurant Contact Persion Name', 'required');
            $this->form_validation->set_rules('telephones', 'Restaurant Telephones Name', 'required');
            $this->form_validation->set_rules('latitude', 'Restaurant Latitude Name', 'required');
            $this->form_validation->set_rules('longitude', 'Restaurant Lontitude Name', 'required');
            //$this->form_validation->set_rules('featured', 'Restaurant Featured', 'required');
            $this->form_validation->set_rules('block', 'Restaurant Block', 'required');
            $this->form_validation->set_rules('street', 'Restaurant Street', 'required');
            $this->form_validation->set_rules('building', 'Restaurant Building', 'required');
            $this->form_validation->set_rules('restro_area', 'Restaurant Area', 'required');
            $this->form_validation->set_rules('restro_city', 'Restaurant City ', 'required');

            if ($this->form_validation->run() == FALSE) {

            } else {
                $locationInfo['location_name'] = $this->input->post('location_name');
                $locationInfo['location_contact_person'] = $this->input->post('contact_name');
                $locationInfo['telephones'] = $this->input->post('telephones');
                $locationInfo['telephones2'] = $this->input->post('telephones2');
                $locationInfo['telephones3'] = $this->input->post('telephones3');
                $locationInfo['latitude'] = $this->input->post('latitude');
                $locationInfo['longitude'] = $this->input->post('longitude');
                $locationInfo['featured'] = $this->input->post('featured');
                $locationInfo['block'] = $this->input->post('block');
                $locationInfo['street'] = $this->input->post('street');
                $locationInfo['building'] = $this->input->post('building');
                $locationInfo['area'] = $this->input->post('restro_area');
                $locationInfo['city'] = $this->input->post('restro_city');
                $locationInfo['user_id'] = $restro_data['owner_id'];
                $locationInfo['restro_id'] = $restro_data['restro_id'];
                $locationInfo['blank_upload'] = 0;

                $service_pickup = $this->input->post('service_pickup');
                $service_delivery = $this->input->post('service_delivery');
                $service_reservation = $this->input->post('service_reservation');
                $service_catering = $this->input->post('service_catering');
                if ($service_pickup == 1) {
                    $insertData['service_type'] = 4;

                    if ($this->input->post('C_percent_pickup') != '') {
                        $insertData['service_commision'] = $this->input->post('C_percent_pickup');
                    } else {
                        $insertData['service_commision'] = '';
                    }

                    if ($this->input->post('C_amount_pickup') != '') {
                        $insertData['service_amount'] = $this->input->post('C_amount_pickup');
                    } else {
                        $insertData['service_amount'] = '';
                    }

                    $insertData['status'] = $this->input->post('pickup_status');
                    $insertData['restro_id'] = $restro_data['restro_id'];
                    $insertData['user_id'] = $restro_data['owner_id'];
                    $insertData['location_id'] = $location_id;

                    $this->Restaurant_management->clear_restro_commision($insertData['service_type'], $insertData['restro_id'], $insertData['location_id']);
                    $this->Restaurant_management->add_restro_commision($insertData);

                }
                if ($service_delivery == 1) {
                    $insertData['service_type'] = 1;

                    if ($this->input->post('C_percent_delivery') != '') {
                        $insertData['service_commision'] = $this->input->post('C_percent_delivery');
                    } else {
                        $insertData['service_commision'] = '';
                    }

                    if ($this->input->post('C_amount_delivery') != '') {
                        $insertData['service_amount'] = $this->input->post('C_amount_delivery');
                    } else {
                        $insertData['service_amount'] = '';
                    }

                    $insertData['status'] = $this->input->post('delivery_status');
                    $insertData['restro_id'] = $restro_data['restro_id'];
                    $insertData['user_id'] = $restro_data['owner_id'];
                    $insertData['location_id'] = $location_id;

                    $this->Restaurant_management->clear_restro_commision($insertData['service_type'], $insertData['restro_id'], $insertData['location_id']);
                    $this->Restaurant_management->add_restro_commision($insertData);

                }
                if ($service_reservation == 1) {
                    $insertData['service_type'] = 3;

                    if ($this->input->post('C_percent_reservation') != '') {
                        $insertData['service_commision'] = $this->input->post('C_percent_reservation');
                    } else {
                        $insertData['service_commision'] = '';
                    }

                    if ($this->input->post('C_amount_reservation') != '') {
                        $insertData['service_amount'] = $this->input->post('C_amount_reservation');
                    } else {
                        $insertData['service_amount'] = '';
                    }

                    $insertData['status'] = $this->input->post('reservation_status');
                    $insertData['restro_id'] = $restro_data['restro_id'];
                    $insertData['user_id'] = $restro_data['owner_id'];
                    $insertData['location_id'] = $location_id;

                    $this->Restaurant_management->clear_restro_commision($insertData['service_type'], $insertData['restro_id'], $insertData['location_id']);
                    $this->Restaurant_management->add_restro_commision($insertData);

                }
                if ($service_catering == 1) {
                    $insertData['service_type'] = 2;

                    if ($this->input->post('C_percent_catering') != '') {
                        $insertData['service_commision'] = $this->input->post('C_percent_catering');
                    } else {
                        $insertData['service_commision'] = '';
                    }

                    if ($this->input->post('C_amount_catering') != '') {
                        $insertData['service_amount'] = $this->input->post('C_amount_catering');
                    } else {
                        $insertData['service_amount'] = '';
                    }

                    $insertData['status'] = $this->input->post('catering_status');
                    $insertData['restro_id'] = $restro_data['restro_id'];
                    $insertData['user_id'] = $restro_data['owner_id'];
                    $insertData['location_id'] = $location_id;

                    $this->Restaurant_management->clear_restro_commision($insertData['service_type'], $insertData['restro_id'], $insertData['location_id']);
                    $this->Restaurant_management->add_restro_commision($insertData);

                }

                if ($this->Restaurant_management->edit_restro_location($locationInfo, $location_id)) {

                    $data['success_msg'] = "Location added successfully";

                }

                redirect('/restaurant_list/');

            }

            $data['user_id'] = $restro_data['owner_id'];
            $data['restro_id'] = $restro_data['restro_id'];

            $this->load->view("Administration/add_location", $data);
        }

        public function restaurant_locations($id) {
            $data['errors'] = array();

            $restro_id = $this->uri->slash_segment(2);
            $data['restro_location'] = $this->Restaurant_management->show_restro_location($restro_id);
            $data['restro_id'] = $restro_id;

            $this->load->view("Administration/show_restro_location", $data);
        }

        public function add_pickup_service() {
            $user_id = $this->input->post("user_id_pickup");
            $restro_id = $this->input->post("restro_id_pickup");
            $payment['service_type'] = $this->input->post("pickup_id");
            $payment['method_type'] = implode($this->input->post("pickup_payment"), ",");
            $payment['user_id'] = $user_id;
            $payment['restro_id'] = $restro_id;
            $payment['location_id'] = $this->input->post("location_id");

            $workingInfo['monday_from'] = $this->input->post("pickup_monday_from");
            $workingInfo['monday_to'] = $this->input->post("pickup_monday_to");
            $workingInfo['tuesday_from'] = $this->input->post("pickup_tuesday_from");
            $workingInfo['tuesday_to'] = $this->input->post("pickup_tuesday_to");
            $workingInfo['wednesday_from'] = $this->input->post("pickup_wednesday_from");
            $workingInfo['wednesday_to'] = $this->input->post("pickup_wednesday_to");
            $workingInfo['thursday_from'] = $this->input->post("pickup_thursday_from");
            $workingInfo['thursday_to'] = $this->input->post("pickup_thursday_to");
            $workingInfo['friday_from'] = $this->input->post("pickup_friday_from");
            $workingInfo['friday_to'] = $this->input->post("pickup_friday_to");
            $workingInfo['saturday_from'] = $this->input->post("pickup_saturday_from");
            $workingInfo['saturday_to'] = $this->input->post("pickup_saturday_to");
            $workingInfo['sunday_from'] = $this->input->post("pickup_sunday_from");
            $workingInfo['sunday_to'] = $this->input->post("pickup_sunday_to");
            $workingInfo['user_id'] = $user_id;
            $workingInfo['restro_id'] = $restro_id;
            $workingInfo['service_id'] = $this->input->post("pickup_id");

            //$workingInfo['order_time']= $this->input->post("pickup_order_time");
            $workingInfo['order_days'] = $this->input->post("pordert_days");
            $workingInfo['order_hour'] = $this->input->post("pordert_hour");
            $workingInfo['order_minitue'] = $this->input->post("pordert_minitue");
            $workingInfo['order_second'] = $this->input->post("pordert_second");

            $workingInfo['location_id'] = $this->input->post("location_id");

            $this->Restaurant_management->clear_pickup_payment($payment['restro_id'], $payment['location_id'], $payment['service_type']);
            $this->Restaurant_management->clear_pickup_working_hour($workingInfo['restro_id'], $workingInfo['location_id'], $workingInfo['service_id']);

            echo $this->Restaurant_management->add_service($payment, $workingInfo);

        }
        public function add_delivery_service() {

            $restro_id = $this->input->post("delivery_user_id");
            $user_id = $this->input->post("delivery_restro_id");
            //-----------------------------------------------------------------------------------------------
            $payment['method_type'] = implode($this->input->post("delivery_payment"), ",");

            $payment['service_type'] = $this->input->post("delivery_id");
            $payment['user_id'] = $user_id;
            $payment['restro_id'] = $restro_id;
            $payment['location_id'] = $this->input->post("location_id");

            //-----------------------------------------------------------------------------------------------

            $areaInfo['city'] = implode($this->input->post("delivery_city"), ",");
            $areaInfo['area'] = implode($this->input->post("delivery_area"), ",");
            $areaInfo['delivery_price'] = implode($this->input->post("delivery_price"), ",");
            $areaInfo['service_id'] = $this->input->post("delivery_id");
            $areaInfo['user_id'] = $user_id;
            $areaInfo['restro_id'] = $restro_id;
            $areaInfo['location_id'] = $this->input->post("location_id");

            $workingInfo['monday_from'] = $this->input->post("delivery_monday_from");
            $workingInfo['monday_to'] = $this->input->post("delivery_monday_to");
            $workingInfo['tuesday_from'] = $this->input->post("delivery_tuesday_from");
            $workingInfo['tuesday_to'] = $this->input->post("delivery_tuesday_to");
            $workingInfo['wednesday_from'] = $this->input->post("delivery_wednesday_from");
            $workingInfo['wednesday_to'] = $this->input->post("delivery_wednesday_to");
            $workingInfo['thursday_from'] = $this->input->post("delivery_thursday_from");
            $workingInfo['thursday_to'] = $this->input->post("delivery_thursday_to");
            $workingInfo['friday_from'] = $this->input->post("delivery_friday_from");
            $workingInfo['friday_to'] = $this->input->post("delivery_friday_to");
            $workingInfo['saturday_from'] = $this->input->post("delivery_saturday_from");
            $workingInfo['saturday_to'] = $this->input->post("delivery_saturday_to");
            $workingInfo['sunday_from'] = $this->input->post("delivery_sunday_from");
            $workingInfo['sunday_to'] = $this->input->post("delivery_sunday_to");
            $workingInfo['user_id'] = $user_id;
            $workingInfo['restro_id'] = $restro_id;

            $workingInfo['min_order'] = $this->input->post("delivery_min_order");
            //$workingInfo['delivery_charges']=$this->input->post("delivery_delivery_charge");

            $workingInfo['service_id'] = $this->input->post("delivery_id");
            //$workingInfo['order_time']= $this->input->post("delivery_order_time");

            $workingInfo['order_days'] = $this->input->post("dordert_days");
            $workingInfo['order_hour'] = $this->input->post("dordert_hour");
            $workingInfo['order_minitue'] = $this->input->post("dordert_minitue");
            $workingInfo['order_second'] = $this->input->post("dordert_second");

            $workingInfo['location_id'] = $this->input->post("location_id");

            //-----------------------------------------------------------------------------------------------
            $this->Restaurant_management->clear_pickup_payment($payment['restro_id'], $payment['location_id'], $payment['service_type']);
            $this->Restaurant_management->clear_pickup_working_hour($workingInfo['restro_id'], $workingInfo['location_id'], $workingInfo['service_id']);
            $this->Restaurant_management->clear_restroCityArea($areaInfo['restro_id'], $areaInfo['location_id'], $areaInfo['service_id']);

            $this->Restaurant_management->add_delivery_service($payment, $workingInfo);

            echo $this->Restaurant_management->add_delivery_area($areaInfo);
            
        }

        public function add_reservation_service() {

            $user_id = $this->input->post("reservation_user_id");
            $restro_id = $this->input->post("reservation_restro_id");
            //-----------------------------------------------------------------------------------------------
            $payment['method_type'] = implode($this->input->post("reservation_payment"), ",");

            $payment['service_type'] = $this->input->post("reservation_id");
            $payment['user_id'] = $user_id;
            $payment['restro_id'] = $restro_id;
            $payment['location_id'] = $this->input->post("location_id");

            //-----------------------------------------------------------------------------------------------
            $workingInfo['service_id'] = $this->input->post("reservation_id");
            $workingInfo['monday_from'] = $this->input->post("reservation_monday_from");
            $workingInfo['monday_to'] = $this->input->post("reservation_monday_to");
            $workingInfo['tuesday_from'] = $this->input->post("reservation_tuesday_from");
            $workingInfo['tuesday_to'] = $this->input->post("reservation_tuesday_to");
            $workingInfo['wednesday_from'] = $this->input->post("reservation_wednesday_from");
            $workingInfo['wednesday_to'] = $this->input->post("reservation_wednesday_to");
            $workingInfo['thursday_from'] = $this->input->post("reservation_thursday_from");
            $workingInfo['thursday_to'] = $this->input->post("reservation_thursday_to");
            $workingInfo['friday_from'] = $this->input->post("reservation_friday_from");
            $workingInfo['friday_to'] = $this->input->post("reservation_friday_to");
            $workingInfo['saturday_from'] = $this->input->post("reservation_saturday_from");
            $workingInfo['saturday_to'] = $this->input->post("reservation_saturday_to");
            $workingInfo['sunday_from'] = $this->input->post("reservation_sunday_from");
            $workingInfo['sunday_to'] = $this->input->post("reservation_sunday_to");
            $workingInfo['location_id'] = $this->input->post("location_id");
            $workingInfo['user_id'] = $user_id;
            $workingInfo['restro_id'] = $restro_id;
            $workingInfo['happy_from'] = $this->input->post("happy_from");
            $workingInfo['happy_to'] = $this->input->post("happy_to");

            $this->Restaurant_management->clear_pickup_payment($payment['restro_id'], $payment['location_id'], $payment['service_type']);
            $this->Restaurant_management->clear_pickup_working_hour($workingInfo['restro_id'], $workingInfo['location_id'], $workingInfo['service_id']);
            //-----------------------------------------------------------------------------------------------
            echo $this->Restaurant_management->add_reservation_service($payment, $workingInfo);

        }

        public function add_catering_services() {

            $user_id = $this->input->post("catering_user_id");
            $restro_id = $this->input->post("catering_restro_id");
            //-----------------------------------------------------------------------------------------------
            $payment['method_type'] = implode($this->input->post("catering_payment"), ",");
            $payment['service_type'] = $this->input->post("catering_id");
            $payment['user_id'] = $user_id;
            $payment['restro_id'] = $restro_id;
            $payment['location_id'] = $this->input->post("location_id");
            //-----------------------------------------------------------------------------------------------
            //$workingInfo['delivery_charges']=$this->input->post("catering_delivery_charge");
            //$workingInfo['order_time']=$this->input->post("catering_order_time");

            $workingInfo['order_days'] = $this->input->post("cordert_days");
            $workingInfo['order_hour'] = $this->input->post("cordert_hour");
            $workingInfo['order_minitue'] = $this->input->post("cordert_minitue");
            $workingInfo['order_second'] = $this->input->post("cordert_second");

            $workingInfo['min_order'] = $this->input->post("catering_min_order");
            $workingInfo['service_id'] = $this->input->post("catering_id");
            $workingInfo['location_id'] = $this->input->post("location_id");

            //-----------------------------------------------------------------------------------------------

            $areaInfo['city'] = implode($this->input->post("catering_city"), ",");
            $areaInfo['area'] = implode($this->input->post("catering_area"), ",");
            $areaInfo['delivery_price'] = implode($this->input->post("catering_price"), ",");
            $areaInfo['service_id'] = $this->input->post("catering_id");
            $areaInfo['user_id'] = $user_id;
            $areaInfo['restro_id'] = $restro_id;
            $areaInfo['location_id'] = $this->input->post("location_id");

            $workingInfo['monday_from'] = $this->input->post("catering_monday_from");
            $workingInfo['monday_to'] = $this->input->post("catering_monday_to");
            $workingInfo['tuesday_from'] = $this->input->post("catering_tuesday_from");
            $workingInfo['tuesday_to'] = $this->input->post("catering_tuesday_to");
            $workingInfo['wednesday_from'] = $this->input->post("catering_wednesday_from");
            $workingInfo['wednesday_to'] = $this->input->post("catering_wednesday_to");
            $workingInfo['thursday_from'] = $this->input->post("catering_thursday_from");
            $workingInfo['thursday_to'] = $this->input->post("catering_thursday_to");
            $workingInfo['friday_from'] = $this->input->post("catering_friday_from");
            $workingInfo['friday_to'] = $this->input->post("catering_friday_to");
            $workingInfo['saturday_from'] = $this->input->post("catering_saturday_from");
            $workingInfo['saturday_to'] = $this->input->post("catering_saturday_to");
            $workingInfo['sunday_from'] = $this->input->post("catering_sunday_from");
            $workingInfo['sunday_to'] = $this->input->post("catering_sunday_to");
            $workingInfo['user_id'] = $user_id;
            $workingInfo['restro_id'] = $restro_id;
            //-----------------------------------------------------------------------------------------------

            $this->Restaurant_management->clear_pickup_payment($payment['restro_id'], $payment['location_id'], $payment['service_type']);
            $this->Restaurant_management->clear_pickup_working_hour($workingInfo['restro_id'], $workingInfo['location_id'], $workingInfo['service_id']);
            $this->Restaurant_management->clear_restroCityArea($areaInfo['restro_id'], $areaInfo['location_id'], $areaInfo['service_id']);

            $this->Restaurant_management->add_catering_service($payment, $workingInfo);
            echo $this->Restaurant_management->add_catering_area($areaInfo);

        }

        public function getall_owner_id() {
            $data['error'] = array();

            if ($this->input->post('oid') !== "") {
                $data['owner_list'] = $this->Restaurant_management->getall_owner_id($this->input->post('oid'));
                $this->load->view("Administration/getall_owner", $data);

            }

        }

        public function ajax_item_category_add() {
            $data['error'] = array();

            $category_id = $this->input->post("category_id");
            $categoryData['service_id'] = $this->input->post("service_id");
            $categoryData['user_id'] = $this->input->post("user_id");
            $categoryData['restro_id'] = $this->input->post("restro_id");
            $categoryData['location_id'] = $this->input->post("location_id");

            if (($categoryData['restro_id'] != '') && ($categoryData['service_id'] != '') && ($categoryData['user_id'] != '')) {
                $this->Restaurant_management->clear_restro_item_category($categoryData['restro_id'], $categoryData['service_id'], $categoryData['location_id']);

                $catArray = explode(',', $category_id);
                foreach ($catArray as $cat) {
                    $categoryData['category_id'] = $cat;
                    $this->Restaurant_management->add_restro_item_category($categoryData);
                }

                echo $this->Restaurant_management->RestroItemCategoryLocationCount($categoryData['location_id'], $categoryData['restro_id'], $categoryData['service_id']);

            }

        }

        public function add_restro_location($id) {
            $data['errors'] = array();

            //$restro_data=$this->session->userdata("restro_session");
            $restro_id = $this->uri->slash_segment(2);

            $ownerid = $this->Restaurant_management->getRestroOwnerId($restro_id);
            $owner_id = $ownerid['user_id'];

            $count = $this->Restaurant_management->chkBlankUpload($restro_id, $owner_id);
            if ($count != 0) {
                $location_id = $count;
            } else {
                $datablank['restro_id'] = $restro_id;
                $datablank['user_id'] = $owner_id;
                $datablank['blank_upload'] = 1;

                $location_id = $this->Restaurant_management->inserBlankLocation($datablank);
            }

            $data['city_list'] = $this->Area_management->get_city_list();
            $data['area_list'] = $this->Area_management->get_area_list();
            $data['item_catlist'] = $this->Restaurant_management->get_item_category_list();

            $this->form_validation->set_rules('location_name', 'Restaurant Location Name', 'required');
            $this->form_validation->set_rules('contact_name', 'Restaurant Contact Persion Name', 'required');
            $this->form_validation->set_rules('telephones', 'Restaurant Telephones Name', 'required');
            $this->form_validation->set_rules('latitude', 'Restaurant Latitude Name', 'required');
            $this->form_validation->set_rules('longitude', 'Restaurant Lontitude Name', 'required');
            //$this->form_validation->set_rules('featured', 'Restaurant Featured', 'required');
            $this->form_validation->set_rules('block', 'Restaurant Block', 'required');
            $this->form_validation->set_rules('street', 'Restaurant Street', 'required');
            $this->form_validation->set_rules('building', 'Restaurant Building', 'required');
            $this->form_validation->set_rules('restro_area', 'Restaurant Area', 'required');
            $this->form_validation->set_rules('restro_city', 'Restaurant City ', 'required');

            if ($this->form_validation->run() == FALSE) {

            } else {
                $locationInfo['location_name'] = $this->input->post('location_name');
                $locationInfo['location_contact_person'] = $this->input->post('contact_name');
                $locationInfo['telephones'] = $this->input->post('telephones');
                $locationInfo['telephones2'] = $this->input->post('telephones2');
                $locationInfo['telephones3'] = $this->input->post('telephones3');
                $locationInfo['latitude'] = $this->input->post('latitude');
                $locationInfo['longitude'] = $this->input->post('longitude');
                $locationInfo['featured'] = $this->input->post('featured');
                $locationInfo['block'] = $this->input->post('block');
                $locationInfo['street'] = $this->input->post('street');
                $locationInfo['building'] = $this->input->post('building');
                $locationInfo['area'] = $this->input->post('restro_area');
                $locationInfo['city'] = $this->input->post('restro_city');
                $locationInfo['user_id'] = $owner_id;
                $locationInfo['restro_id'] = $restro_id;
                $locationInfo['blank_upload'] = 0;

                $service_pickup = $this->input->post('service_pickup');
                $service_delivery = $this->input->post('service_delivery');
                $service_reservation = $this->input->post('service_reservation');
                $service_catering = $this->input->post('service_catering');
                if ($service_pickup == 1) {
                    $insertData['service_type'] = 4;
                    if ($this->input->post('C_percent_pickup') != '') {
                        $insertData['service_commision'] = $this->input->post('C_percent_pickup');
                    } else {
                        $insertData['service_commision'] = '';
                    }

                    if ($this->input->post('C_amount_pickup') != '') {
                        $insertData['service_amount'] = $this->input->post('C_amount_pickup');
                    } else {
                        $insertData['service_amount'] = '';
                    }

                    $insertData['status'] = $this->input->post('pickup_status');
                    $insertData['restro_id'] = $restro_id;
                    $insertData['user_id'] = $owner_id;
                    $insertData['location_id'] = $location_id;

                    $this->Restaurant_management->clear_restro_commision($insertData['service_type'], $insertData['restro_id'], $insertData['location_id']);
                    $this->Restaurant_management->add_restro_commision($insertData);

                }
                if ($service_delivery == 1) {
                    $insertData['service_type'] = 1;

                    if ($this->input->post('C_percent_delivery') != '') {
                        $insertData['service_commision'] = $this->input->post('C_percent_delivery');
                    } else {
                        $insertData['service_commision'] = '';
                    }

                    if ($this->input->post('C_amount_delivery') != '') {
                        $insertData['service_amount'] = $this->input->post('C_amount_delivery');
                    } else {
                        $insertData['service_amount'] = '';
                    }

                    $insertData['status'] = $this->input->post('delivery_status');
                    $insertData['restro_id'] = $restro_id;
                    $insertData['user_id'] = $owner_id;
                    $insertData['location_id'] = $location_id;

                    $this->Restaurant_management->clear_restro_commision($insertData['service_type'], $insertData['restro_id'], $insertData['location_id']);
                    $this->Restaurant_management->add_restro_commision($insertData);

                }
                if ($service_reservation == 1) {
                    $insertData['service_type'] = 3;

                    if ($this->input->post('C_percent_reservation') != '') {
                        $insertData['service_commision'] = $this->input->post('C_percent_reservation');
                    } else {
                        $insertData['service_commision'] = '';
                    }

                    if ($this->input->post('C_amount_reservation') != '') {
                        $insertData['service_amount'] = $this->input->post('C_amount_reservation');
                    } else {
                        $insertData['service_amount'] = '';
                    }

                    $insertData['status'] = $this->input->post('reservation_status');
                    $insertData['restro_id'] = $restro_id;
                    $insertData['user_id'] = $owner_id;
                    $insertData['location_id'] = $location_id;

                    $this->Restaurant_management->clear_restro_commision($insertData['service_type'], $insertData['restro_id'], $insertData['location_id']);
                    $this->Restaurant_management->add_restro_commision($insertData);

                }
                if ($service_catering == 1) {
                    $insertData['service_type'] = 2;

                    if ($this->input->post('C_percent_catering') != '') {
                        $insertData['service_commision'] = $this->input->post('C_percent_catering');
                    } else {
                        $insertData['service_commision'] = '';
                    }

                    if ($this->input->post('C_amount_catering') != '') {
                        $insertData['service_amount'] = $this->input->post('C_amount_catering');
                    } else {
                        $insertData['service_amount'] = '';
                    }

                    $insertData['status'] = $this->input->post('catering_status');
                    $insertData['restro_id'] = $restro_id;
                    $insertData['user_id'] = $owner_id;
                    $insertData['location_id'] = $location_id;

                    $this->Restaurant_management->clear_restro_commision($insertData['service_type'], $insertData['restro_id'], $insertData['location_id']);
                    $this->Restaurant_management->add_restro_commision($insertData);

                }

                $this->Restaurant_management->edit_restro_location($locationInfo, $location_id);

                $data['success_msg'] = "Location added successfully";

                redirect('restaurant_locations/' . $restro_id);

            }

            $data['user_id'] = $owner_id;
            $data['restro_id'] = $restro_id;
            $data['location_id'] = $location_id;

            $this->load->view("Administration/add_restro_location", $data);
        }

        public function restaurant_edit_location($id) {
            $data['errors'] = array();

            //$restro_data=$this->session->userdata("restro_session");
            $restro_id = $this->uri->segment(2);
            $location_id = $this->uri->segment(3);

            $ownerid = $this->Restaurant_management->getRestroOwnerId($restro_id);
            $owner_id = $ownerid['user_id'];

            $data['city_list'] = $this->Area_management->get_city_list();
            $data['area_list'] = $this->Area_management->get_area_list();
            $data['item_catlist'] = $this->Restaurant_management->get_item_category_list();

            $this->form_validation->set_rules('location_name', 'Restaurant Location Name', 'required');
            $this->form_validation->set_rules('contact_name', 'Restaurant Contact Persion Name', 'required');
            $this->form_validation->set_rules('telephones', 'Restaurant Telephones Name', 'required');
            $this->form_validation->set_rules('latitude', 'Restaurant Latitude Name', 'required');
            $this->form_validation->set_rules('longitude', 'Restaurant Lontitude Name', 'required');
            //$this->form_validation->set_rules('featured', 'Restaurant Featured', 'required');
            $this->form_validation->set_rules('block', 'Restaurant Block', 'required');
            $this->form_validation->set_rules('street', 'Restaurant Street', 'required');
            $this->form_validation->set_rules('building', 'Restaurant Building', 'required');
            $this->form_validation->set_rules('restro_area', 'Restaurant Area', 'required');
            $this->form_validation->set_rules('restro_city', 'Restaurant City ', 'required');

            if ($this->form_validation->run() == FALSE) {

            } else {
                $locationInfo['location_name'] = $this->input->post('location_name');
                $locationInfo['location_contact_person'] = $this->input->post('contact_name');
                $locationInfo['telephones'] = $this->input->post('telephones');
                $locationInfo['telephones2'] = $this->input->post('telephones2');
                $locationInfo['telephones3'] = $this->input->post('telephones3');
                $locationInfo['latitude'] = $this->input->post('latitude');
                $locationInfo['longitude'] = $this->input->post('longitude');
                $locationInfo['featured'] = $this->input->post('featured');
                $locationInfo['block'] = $this->input->post('block');
                $locationInfo['street'] = $this->input->post('street');
                $locationInfo['building'] = $this->input->post('building');
                $locationInfo['area'] = $this->input->post('restro_area');
                $locationInfo['city'] = $this->input->post('restro_city');
                $locationInfo['user_id'] = $owner_id;
                $locationInfo['restro_id'] = $restro_id;
                $locationInfo['blank_upload'] = 0;

                $service_pickup = $this->input->post('service_pickup');
                $service_delivery = $this->input->post('service_delivery');
                $service_reservation = $this->input->post('service_reservation');  echo "<script>console.log('ServiceReservation Checked Status=$service_reservation')</script>";
                $service_catering = $this->input->post('service_catering');
                if ($service_pickup == 1) {
                    $insertData['service_type'] = 4;

                    if ($this->input->post('C_percent_pickup') != '') {
                        $insertData['service_commision'] = $this->input->post('C_percent_pickup');
                    } else {
                        $insertData['service_commision'] = '';
                    }

                    if ($this->input->post('C_amount_pickup') != '') {
                        $insertData['service_amount'] = $this->input->post('C_amount_pickup');
                    } else {
                        $insertData['service_amount'] = '';
                    }

                    $insertData['status'] = $this->input->post('pickup_status');
                    $insertData['restro_id'] = $restro_id;
                    $insertData['user_id'] = $owner_id;
                    $insertData['location_id'] = $location_id;

                    $this->Restaurant_management->clear_restro_commision($insertData['service_type'], $insertData['restro_id'], $insertData['location_id']);
                    $this->Restaurant_management->add_restro_commision($insertData);

                } else {
                    $this->Restaurant_management->clear_restro_commision(4, $restro_id, $location_id);
                }

                if ($service_delivery == 1) {
                    $insertData['service_type'] = 1;

                    if ($this->input->post('C_percent_delivery') != '') {
                        $insertData['service_commision'] = $this->input->post('C_percent_delivery');
                    } else {
                        $insertData['service_commision'] = '';
                    }

                    if ($this->input->post('C_amount_delivery') != '') {
                        $insertData['service_amount'] = $this->input->post('C_amount_delivery');
                    } else {
                        $insertData['service_amount'] = '';
                    }

                    $insertData['status'] = $this->input->post('delivery_status');
                    $insertData['restro_id'] = $restro_id;
                    $insertData['user_id'] = $owner_id;
                    $insertData['location_id'] = $location_id;

                    $this->Restaurant_management->clear_restro_commision($insertData['service_type'], $insertData['restro_id'], $insertData['location_id']);
                    $this->Restaurant_management->add_restro_commision($insertData);

                } else {
                    $this->Restaurant_management->clear_restro_commision(1, $restro_id, $location_id);
                }

                if ($service_reservation == 1) {
                    $insertData['service_type'] = 3;

                    if ($this->input->post('C_percent_reservation') != '') {
                        $insertData['service_commision'] = $this->input->post('C_percent_reservation');
                    } else {
                        $insertData['service_commision'] = '';
                    }

                    if ($this->input->post('C_amount_reservation') != '') {
                        $insertData['service_amount'] = $this->input->post('C_amount_reservation');
                    } else {
                        $insertData['service_amount'] = '';
                    }

                    $insertData['status'] = $this->input->post('reservation_status');
                    $insertData['restro_id'] = $restro_id;
                    $insertData['user_id'] = $owner_id;
                    $insertData['location_id'] = $location_id;

                    $this->Restaurant_management->clear_restro_commision($insertData['service_type'], $insertData['restro_id'], $insertData['location_id']);
                    $this->Restaurant_management->add_restro_commision($insertData);

                } else {
                    $this->Restaurant_management->clear_restro_commision(3, $restro_id, $location_id);
                }

                if ($service_catering == 1) {
                    $insertData['service_type'] = 2;

                    if ($this->input->post('C_percent_catering') != '') {
                        $insertData['service_commision'] = $this->input->post('C_percent_catering');
                    } else {
                        $insertData['service_commision'] = '';
                    }

                    if ($this->input->post('C_amount_catering') != '') {
                        $insertData['service_amount'] = $this->input->post('C_amount_catering');
                    } else {
                        $insertData['service_amount'] = '';
                    }

                    $insertData['status'] = $this->input->post('catering_status');
                    $insertData['restro_id'] = $restro_id;
                    $insertData['user_id'] = $owner_id;
                    $insertData['location_id'] = $location_id;

                    $this->Restaurant_management->clear_restro_commision($insertData['service_type'], $insertData['restro_id'], $insertData['location_id']);
                    $this->Restaurant_management->add_restro_commision($insertData);

                } else {
                    $this->Restaurant_management->clear_restro_commision(2, $restro_id, $location_id);
                }

                if ($this->Restaurant_management->edit_restro_location($locationInfo, $location_id)) {

                    $data['success_msg'] = "Location added successfully";

                }

                redirect('/restaurant_locations/' . $restro_id);
            }

            $data['user_id'] = $owner_id;
            $data['restro_id'] = $restro_id;
            $data['location_id'] = $location_id;

            $data['LocationData'] = $this->Restaurant_management->getLocationData($restro_id, $location_id);
            $data['PickupCommisionData'] = $this->Restaurant_management->getCommisionData($restro_id, $location_id, 4);
            $data['DeliveryCommisionData'] = $this->Restaurant_management->getCommisionData($restro_id, $location_id, 1);
            $data['DeliveryCityArea'] = $this->Restaurant_management->getRestroCityArea($restro_id, $location_id, 1);

            $data['ReservationCommisionData'] = $this->Restaurant_management->getCommisionData($restro_id, $location_id, 3);
            $data['CateringCommisionData'] = $this->Restaurant_management->getCommisionData($restro_id, $location_id, 2);
            $data['CateringCityArea'] = $this->Restaurant_management->getRestroCityArea($restro_id, $location_id, 2);

            $this->load->view("Administration/restaurant_edit_location", $data);
        }

        public function ajax_category_show_chk() {
            $data['errors'] = array();

            $data['item_catlist'] = $this->Restaurant_management->get_item_category_list();
            $data['service_id'] = $this->input->post("service_id");
            $data['restro_id'] = $this->input->post("restro_id");
            $data['location_id'] = $this->input->post("location_id");

            $this->load->view("Administration/ajax_cat_checked_location", $data);
        }

        public function restro_confirmed_mail() {
            $data['errors'] = array();

            $email_temp_id = 2;
            $smtp_id = 1;
            $email_Data = $this->Smtp_management->get_email_templates($email_temp_id);
            $smtp_Data = $this->Smtp_management->get_smtp_data($smtp_id);
            $msg = $email_Data['message'];
            $subject = $email_Data['subject'];
            $restro_id = $this->input->post("restro_id");

            $config = Array(
                'protocol' => 'smtp',
                'smtp_host' => $smtp_Data['host_name'],
                'smtp_port' => $smtp_Data['smtp_port'],
                'smtp_user' => $smtp_Data['username'],
                'smtp_pass' => $smtp_Data['password'],
                'mailtype' => 'html',
                'charset' => 'iso-8859-1',
            );
            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");

            $this->email->from($smtp_Data['email_from'], $smtp_Data['from_name']);
            $this->email->to('gshrimali21@gmail.com');

            $this->email->subject($subject);
            $this->email->message($msg);

            $this->email->send();

            $this->email->print_debugger();

        }

        public function delete_restaurant($id) {
            $data['errors'] = array();
            $restaurant_id = $this->uri->segment(2);
            $resdata['trash'] = 1;
            if ($this->Restaurant_management->delete_restaurant($restaurant_id, $resdata)) {
                echo "yes";
            }

            //redirect('/restaurant_list/');
        }

        public function get_restro_trash_list() {

            $data['errors'] = array();
            $data['restro_list'] = $this->Restaurant_management->get_all_trash_restro_list();
            $this->load->view("Administration/trash_restaurant_list", $data);

        }

        public function restore_restaurant() {

            $data['errors'] = array();
            $restro_list = $this->input->post("trash_restro");
            foreach ($restro_list as $vs) {
                $this->Restaurant_management->restore_restaurant($vs);

            }

            $this->session->set_flashdata("msg", "Restored Successfully");
            redirect('/restro_trash/');
        }

        Public function trash_delete_restaurant() {
            $data['errors'] = array();
            $restaurant_id = $this->uri->segment(2);
            $resdata['trash'] = 2;
            if ($this->Restaurant_management->trash_delete_restaurant($restaurant_id, $resdata)) {
                echo "yes";
            }

        }

        public function sent_mail_restaurant() {
            $id = $this->uri->segment(2);
            $data = $this->Restaurant_management->get_required_details_by_id($id);
            $data['site_name'] = $this->config->item('website_name', 'tank_auth');
            //echo $data['owner_code']
            //echo $data['restro_name']."<br>";
            $this->_send_email('welcome', $data['email'], $data);
            if ($this->Restaurant_management->restro_activation_status($id)) {
                echo "Done";

            }

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

        public function check_owner_id() {
            $oid = $this->input->post("oid");
            echo $this->Restaurant_management->check_owner_id_info($oid);

        }

        public function get_location_for_restro_owner() {

            $ownerid = $this->input->post("id");

            $data['location_list'] = $this->Restaurant_management->get_all_owner_location($ownerid);

            $this->load->view("Administration/ajax_owner_all_location", $data);

        }

        public function get_locations_for_restro() {

            try{ 
                $restroid = $this->input->post("restro_id");            
                $data = $this->Restaurant_management->getLocationsForRestro($restroid);
                $response = array("success"=>true, "data"=>$data);
            } catch(Exception $e) {
                $response = array("success"=>false, "message"=>$e->getMessage());    
            }                                                                  

            echo json_encode($response);
        }

        public function get_service_for_restro_owner() {
            $ownerid = $this->input->post("owner_id");
            $location_id = $this->input->post("location");

            @$res = $this->input->post("res");

            $data['service_list'] = $this->Restaurant_management->get_service_for_restro_owner($ownerid, $location_id);

            if (isset($res)) {
                $this->load->view("Administration/ajax_owner_all_service1", $data);
            } else {
                $this->load->view("Administration/ajax_owner_all_service", $data);
            }

        }

        public function get_service_for_restro_location() {
            try{ 
                $restro_id = $this->input->post("restro_id");
                $location_id = $this->input->post("location_id");


                $data = $this->Restaurant_management->getServicesForRestroLocation($restro_id, $location_id);
                $response = array("success"=>true, "data"=>$data);
            } catch(Exception $e) {
                $response = array("success"=>false, "message"=>$e->getMessage());    
            }                                                                  

            echo json_encode($response);  

        }

        public function delete_restaurant_location() {
            $location_id = $this->input->post("lid");

            $this->Restaurant_management->delete_restaurant_location($location_id);

            echo "yes";
        }

        public function restaurant_tables() {

            $data['owner_code_list'] = $this->Restaurant_management->get_owner_code_list();

            if (isset($_POST['btnsavetable'])) {
                $this->form_validation->set_rules('owner_id1', 'Owner Code', 'required');
                $this->form_validation->set_rules('location_id1', 'Location', 'required');
                $this->form_validation->set_rules('table_no', 'Table No.', 'required');
                $this->form_validation->set_rules('user_limit', 'User Limit ', 'required');

                if ($this->form_validation->run() == FALSE) {

                } else {
                    $owner_id = $this->input->post("owner_id1");
                    $restro_id = $this->Restaurant_management->get_owner_restro_id($owner_id);
                    $TableAdd['location_id'] = $this->input->post("location_id1");
                    $TableAdd['table_no'] = $this->input->post("table_no");
                    $TableAdd['user_limit'] = $this->input->post("user_limit");
                    $TableAdd['description'] = $this->input->post("description");
                    $TableAdd['price'] = $this->input->post("price");
                    $TableAdd['sms'] = $this->input->post("msg");
                    $TableAdd['status'] = $this->input->post("status");
                    $TableAdd['user_id'] = $owner_id;
                    $TableAdd['restro_id'] = $restro_id['id'];

                    $this->Restro_Owner_Model->add_restro_table($TableAdd);
                }
            }

            if (isset($_POST['btnEditTable'])) {
                $this->form_validation->set_rules('table_no', 'Table No. / Name', 'required');
                $this->form_validation->set_rules('user_limit', 'User Limit', 'required');
                $this->form_validation->set_rules('status', 'Table Status', 'required');
                $this->form_validation->set_rules('tbleID', 'Table ID', 'required');
                //$this->form_validation->set_rules('price', 'Table Price', 'required');

                if ($this->form_validation->run() == FALSE) {

                } else {
                    //$owner_id = $this->input->post("owner_id2");

                    //$restro_id = $this->Restaurant_management->get_owner_restro_id($owner_id);
                    $table_id = $this->input->post('tbleID');
                    $table['table_no'] = $this->input->post('table_no');
                    $table['user_limit'] = $this->input->post('user_limit');
                    $table['status'] = $this->input->post('status');
                    //$table['price']=$this->input->post('price');
                    $table['description'] = $this->input->post('description');
                    //$table['location_id']=$this->input->post('location_id2');
                    //$table['user_id']=$owner_id;
                    $restro_id = $this->input->post('restro_id');

                    $this->Restro_Owner_Model->edit_restro_table($table, $table_id, $restro_id);

                }
            }

            if (isset($_POST['btnsearch'])) {
                $search_owner_id = $this->input->post('search_owner_id');
                $search_location_id = $this->input->post('search_location_id');

                if (($search_owner_id != '') && ($search_location_id != '')) {
                    $data['TablesData'] = $this->Restaurant_management->get_all_restro_tables_location($search_owner_id, $search_location_id);
                }

            } else {
                $data['TablesData'] = $this->Restaurant_management->get_all_restro_tables();
            }

            $this->load->view("Administration/restaurant_tables", $data);
        }

        public function admin_edit_restro_table() {
            $restro_id = $this->uri->segment('2');

            $table_id = $this->uri->segment('3');
            $user_id = $this->uri->segment('4');

            $table['Locations'] = $this->Restaurant_management->get_all_owner_location($user_id);
            $table['tableinfo'] = $this->Restro_Owner_Model->restro_table_details($table_id, $restro_id);
            $table['user_id'] = $user_id;
            $table['owner_code_list'] = $this->Restaurant_management->get_owner_code_list();

            $this->load->view("Administration/admin_edit_restro_table", $table);

        }

        public function delete_restro_table() {

            $table_id = $this->uri->segment('2');

            if ($this->Restaurant_management->delete_restro_table($table_id)) {
                redirect('/restaurant_tables');
            }
        }

}