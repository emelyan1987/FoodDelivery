<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

    class Restro_Location extends CI_Controller
    {

        function __construct()
        {
            parent::__construct();

            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');

            $this->load->helper('security');
            $this->load->library('tank_auth');
            $this->lang->load('tank_auth');
            $this->load->model("Restaurant_Owner/Restro_Owner_Model");
            $this->load->model("Customer/Home_site");
            $this->load->helper('restaurant_helper');
            //$this->load->model("Administration/Cuisine_management");
            $this->load->model("Administration/Restaurant_management");

        }

        public function manage_restro_location($id){
            $data['errors']=array();

            $restro_id = $this->uri->segment(2);
            $data['restro_location'] = $this->Restaurant_management->restro_locations_having_services($restro_id);
            $data['restro_id'] = $restro_id;

            $this->load->view("Restaurant_Owner/show_restro_location",$data);

        }

    }
?>