<?php
    if (!defined('BASEPATH')) exit('No direct script access allowed');
    @ob_start();
    class AdminBaseController extends CI_Controller {

        public function __construct() 
        {
            parent::__construct();

        $this->load->helper('form');
        $this->load->helper('url');
            $this->load->library('tank_auth');
            $this->lang->load('tank_auth');

            // Check that the user is logged in
            if ($this->session->userdata('user_id') == null || $this->session->userdata('user_id') < 1 || $this->session->userdata('user_role')!=1) {
                redirect(base_url());
            }   
        }
    }
?>
