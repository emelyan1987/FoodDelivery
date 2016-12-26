<?php 
    require 'AdminBaseController.php';

    class ChatController extends AdminBaseController
    {
        function __construct()
        {
            parent::__construct();

            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->helper('security');
            $this->load->library('tank_auth');
            $this->lang->load('tank_auth');

            $this->load->model('MessageModel');
            $this->load->helper('utils');
        }

        public function index()
        {


        }

        public function chat_list(){
            $data['errors']=array();

            $params = array();
            $threads = $this->MessageModel->getLastMessagesGroupByFrom();

            foreach($threads as $thread) {
                $thread->unread_cnt = $this->MessageModel->getUnreadCount($thread->from_id);
            }

            $data['threads'] = $threads;

            $this->load->view("Administration/chat_list", $data);
        }

        public function chat_window() {

            $data['errors'] = array();

            $threads = $this->MessageModel->getLastMessagesGroupByFrom();

            foreach($threads as $thread) {
                $thread->unread_cnt = $this->MessageModel->getUnreadCount($thread->from_id);
            }

            $data['threads'] = $threads; 

            $data['from'] = $from = $this->input->get('from');
            if(isset($from)) {
                $messages = $this->MessageModel->getMessagesWith($from, $this->session->userdata('user_id'));   
                foreach($messages as $msg) {
                    $msg->user_image = getImageRealPath($msg->user_image, 'user');
                    $msg->arrow = $msg->from_id==$this->session->userdata('user_id')?'right':'left';
                }

                $data['messages'] = $messages;
            } 
            $this->load->view("Administration/chat_window", $data);
        }

        public function chat_messages_ajax() {
            $data['from'] = $from = $this->input->get('from');
            $messages = $this->MessageModel->getMessagesWith($from, $this->session->userdata('user_id'));   
            foreach($messages as $msg) {
                $msg->user_image = getImageRealPath($msg->user_image, 'user');
                $msg->arrow = $msg->from_id==$this->session->userdata('user_id')?'right':'left';
            }

            $data['messages'] = $messages;

            echo json_encode($data);
        }
    }
?>