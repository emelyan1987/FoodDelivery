<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
    @ob_start();
    class Push_Notification extends CI_Controller
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
            $this->load->model("Administration/Notification_management"); 
            $this->load->model("Restaurant_Owner/Restro_Owner_Model");

            $this->load->library('codeigniter-library-notification/Notification');

            $this->load->model('UserDeviceModel');

        }

        public function index()
        {


        }

        public function add_notification()
        {
            $data['errors']=array();

            if(isset($_POST['btnweb'])){
                $this->form_validation->set_rules('notification', 'Notification', 'required');
                $this->form_validation->set_rules('date', 'Date', 'required');
                $this->form_validation->set_rules('type', 'Notification Type', 'required');
                if ($this->form_validation->run() == FALSE)
                {

                }
                else
                {
                    $not['message']=$this->input->post('notification');
                    $not['date']=$this->input->post('date');
                    $not['time']=$this->input->post('time');
                    $not['type']=$this->input->post('type');

                    if($this->Notification_management->add_notification($not))
                    {
                        $data['success_web_msg'] = 'Push Notification Added Successfully done!';
                    }
                }
            }

            if(isset($_POST['btnapp'])){
                $this->form_validation->set_rules('notification1', 'Notification', 'required');
                $this->form_validation->set_rules('date1', 'Date', 'required');
                $this->form_validation->set_rules('type1', 'Notification Type', 'required');
                if ($this->form_validation->run() == FALSE)
                {

                }
                else
                {

                    $not['message']=$this->input->post('notification1');
                    $not['date']=$this->input->post('date1');
                    $not['time']=$this->input->post('time1');
                    $not['type']=$this->input->post('type1');

                    if($this->Notification_management->add_notification($not))
                    {
                        $data['success_app_msg'] = 'Push Notification Added Successfully done!';

                        $devices = $this->UserDeviceModel->find();

                        foreach($devices as $device){
                            if($device->device_type == 'android') {
                                $this->Notification->google_cloud_messaging(
                                    'AIzaSyAN15FTczeZkWR4FayERTxaVyYlYta35eY',
                                    $device->device_token,
                                    array(
                                        // With your payload format
                                        'data' => array(
                                            'title' => 'Notification',
                                            'message' => $not['message']
                                        )
                                    )
                                );                                
                            } else if($device->device_type == 'ios') {
                                $result = $this->Notification->apple_push_notification(
                                    file_get_contents(APPPATH.'/credentials/MataamPushKeyProd.pem'),
                                    $device->device_token,
                                    array(
                                        // apn payload format
                                        'aps' => array(
                                            'alert' => array(
                                                'title' => 'Notification',
                                                'body' => $not['message'],
                                            )
                                        )
                                    )
                                );                                
                                //echo json_encode($result);
                            }
                        }

                    }
                }
            }


            $this->load->view('Administration/add_push_notification',$data);
        }

        public function  web_notification_list()
        {

            $data['web_list']=$this->Notification_management->get_wp_notification();
            $this->load->view("Administration/web_notification_list",$data);


        }

        public function update_web_notification()
        {
            $id=$this->input->post("note_id");
            $data['message']=$this->input->post("note_msg");
            $data['date']=$this->input->post("note_date");
            $data['time']=$this->input->post("note_time");
            $data['status']=$this->input->post("status");

            if($this->Notification_management->update_web_notification($id,$data))
            {
                echo "Done";

            }

        }

        public function  delete_web_notification()
        {

            $id=$this->input->post("id");
            if($this->Notification_management->delete_web_notification($id))
            {
                echo "Done";

            }

        }



        public function  app_notification_list()
        {

            $data['app_list']=$this->Notification_management->get_ap_notification();
            $this->load->view("Administration/app_notification_list",$data);


        }

        public function update_app_notification()
        {
            $id=$this->input->post("note_id");
            $data['message']=$this->input->post("note_msg");
            $data['date']=$this->input->post("note_date");
            $data['time']=$this->input->post("note_time");
            $data['status']=$this->input->post("status");
            if($this->Notification_management->update_app_notification($id,$data))
            {
                echo "Done";
                //$this->session->set_flashdata("msg","Updated successfully");
            }

        }

        public function  delete_app_notification()
        {

            $id=$this->input->post("id");
            if($this->Notification_management->delete_app_notification($id))
            {
                echo "Done";

            }

        }
    }

?>