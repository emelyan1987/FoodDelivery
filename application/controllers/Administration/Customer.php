<?php 
    require 'AdminBaseController.php';

    class Customer extends AdminBaseController
    {
        function __construct()
        {
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
            $this->load->model('Administration/Customer_management');

            $this->load->library('email');

            //$this->load->model('Model');

        }
        ///////////////////////////////////////////////////////////////////////

        public function  web_customers_list()
        {
            $data['errors']=array();
            $data['cust_list']=$this->Customer_management->customer_list();
            $this->load->view("Administration/customer_list",$data);

        }

        public function deleteCust()
        {
            $id=$this->input->post("cid");
            if($this->Customer_management->deleteCust($id))
            {
                echo "done";
            }

        }


    }
?>