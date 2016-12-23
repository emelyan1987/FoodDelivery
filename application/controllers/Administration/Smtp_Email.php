<?php 
    require 'AdminBaseController.php';

    class Smtp_Email extends AdminBaseController
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
            $this->load->helper('restaurant_helper');
            $this->load->model('Administration/Smtp_management');
        }

        function index()
        {

            $this->load->view("Administration/dashboard.php");
        }

        function smtp_setup()
        {
            $data['errors']=array();

            $smtp_id = 1;
            if(isset($_POST['btnsave']))
            {
                $this->form_validation->set_rules('host_name', 'Hostname', 'required');
                $this->form_validation->set_rules('username', 'Username', 'required');
                $this->form_validation->set_rules('password', 'Password', 'required');
                $this->form_validation->set_rules('smtp_secure', 'SMTP Secure', 'required');
                $this->form_validation->set_rules('smtp_port', 'SMTP Port', 'required');
                $this->form_validation->set_rules('email_from', 'Email From', 'required'); 
                $this->form_validation->set_rules('from_name', 'From From', 'required');


                if ($this->form_validation->run() == FALSE)
                {

                }
                else
                {
                    $SMTPData['host_name']=$this->input->post('host_name');
                    $SMTPData['username']=$this->input->post('username');
                    $SMTPData['password']=$this->input->post('password');
                    $SMTPData['smtp_secure']=$this->input->post('smtp_secure');
                    $SMTPData['smtp_port']=$this->input->post('smtp_port');
                    $SMTPData['email_from']=$this->input->post('email_from');
                    $SMTPData['from_name']=$this->input->post('from_name');

                    if($this->Smtp_management->update_smtp($SMTPData,$smtp_id))
                    {
                        $data['success_msg'] = "SMTP Setup Updated Successfully done!";
                    }

                }

            }

            $data['smtp_data'] = $this->Smtp_management->get_smtp_data($smtp_id);
            $this->load->view("Administration/smtp_setup",$data);
        }

        function email_templates()
        {
            $data['errors']=array();

            $data['template'] = $this->Smtp_management->show_all_email_templates();

            $this->load->view("Administration/show_email_templates",$data);
        }

        function edit_email_templates(){
            $data['errors']=array();
            $temp_id = $this->uri->segment(2);

            if(isset($_POST['btnsave']))
            {
                $this->form_validation->set_rules('subject', 'Subject', 'required');
                $this->form_validation->set_rules('message', 'Email Message', 'required');


                if ($this->form_validation->run() == FALSE)
                {

                }
                else
                {
                    $tempData['subject']=$this->input->post('subject');
                    $tempData['message']=$this->input->post('message');

                    if($this->Smtp_management->update_template($tempData,$temp_id))
                    {
                        $data['success_msg'] = "Template Updated Successfully done!";
                    }

                }

            }


            $data['template'] = $this->Smtp_management->get_email_templates($temp_id);
            $this->load->view("Administration/edit_email_templates",$data);
        }


        function sms_setup()
        {
            $data['errors']=array();

            if(isset($_POST['btnsave']))
            {
                $SmsData['message']=$this->input->post('message');
                $sms_id =$this->input->post('sms_id');

                $this->Smtp_management->edit_sms_message($SmsData,$sms_id);
            }
            $data['template'] = $this->Smtp_management->show_all_sms();

            $this->load->view("Administration/show_all_sms",$data);
        }

    }
?>