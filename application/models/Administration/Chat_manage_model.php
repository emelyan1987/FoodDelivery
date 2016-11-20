<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

    class Chat_manage_model extends CI_Model
    {

        // cuisine function start here 
        function __construct()
        {
            parent::__construct();	
        }


        public function  add_chatnam($data)
        {
            $this->db->insert('restro_chatname',$data);
            $insert_id = $this->db->insert_id();
            return  $insert_id;
        }

        public function check_chatname($chatname,$alluser)
        {

            $this->db->select('chatname');
            $this->db->from('restro_chatname');
            $this->db->where('chatname',$chatname);
            $query = $this->db->get();
            if($query->num_rows() > 0)
            {
                return 1;

            }
            else
            {

                return 0;

            }

        }

        public function  add_chatmsg($data)
        {
            $this->db->insert('restro_chatmessage',$data);
        }





        public function  all_chat($sesId)
        {
            $this->db->select('*');
            $this->db->from('restro_chatmessage');
            $this->db->where('user_id',$sesId);
            $query = $this->db->get();
            return $query->result();

        } 


        public function  Alladminchat()
        {
            $this->db->select('*');
            $this->db->from('restro_chatname');

            $query = $this->db->get();
            return $query->result();

        }  

        public function  getUSERid($userid)
        {
            $this->db->select('*');
            $this->db->from('restro_chatmessage');
            $this->db->where('user_id',$userid);
            $query = $this->db->get();
            return $query->result();

        } 

        public function  insertMSG($data)
        {
            $this->db->insert('restro_chatmessage',$data);
        } 

        public function  getadminmsg($uid)
        {
            $this->db->select('*');
            $this->db->from('restro_chatmessage');
            $this->db->where('user_id',$uid );
            $query = $this->db->get();
            return $query->result();	
        }





}