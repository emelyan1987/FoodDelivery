<?php 
    require 'AdminBaseController.php';

    class Plan extends AdminBaseController
    {
        function __construct()
        {
            parent::__construct();

            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            //$this->load->library('security');
            $this->load->helper('security');
            $this->load->library('tank_auth');
            $this->lang->load('tank_auth');
            $this->load->model("Administration/Plan_management");
            //$this->load->helper('phpass');
        }

        function index()
        {

        }
        public function add_new_plan()
        {
            $data['errors']=array();

            $this->form_validation->set_rules('plan_name', 'Plan Name', 'required');
            $this->form_validation->set_rules('plan_amount', 'Plan Amount', 'required');
            $this->form_validation->set_rules('plan_detail', 'Plan Detail', 'required');
            if($this->form_validation->run() == FALSE)
            {

            }
            else
            {
                $planInfo['plan_name']=$this->input->post('plan_name');
                $planInfo['plan_price']=$this->input->post('plan_amount');
                $planInfo['plan_detail']=$this->input->post('plan_detail');
                $planInfo['admin_id']=$this->tank_auth->get_user_id();
                $planInfo['plan_date'] = date('Y-m-d H:i:s');

                if($this->Plan_management->add_plan($planInfo))
                {
                    $data['success']="Plan added successfully";
                }




            }

            $this->load->view("Administration/add_new_plan",$data);


        }

        public function plan_list()
        {

            $data['errors']=array();

            $data['plan_list']=$this->Plan_management->plan_list();

            $this->load->view("Administration/plan_list",$data);



        }

        public function edit_plan()
        { 
            $data['errors']=array();

            $plan_id=$this->uri->segment(2);
            $this->Plan_management->edit_plan($plan_id);


        }
    }	
?>