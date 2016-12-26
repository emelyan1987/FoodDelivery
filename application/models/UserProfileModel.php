<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

    class UserProfileModel extends CI_Model
    {

        protected $publicFields = array('id', 'mobile_no', 'first_name', 'last_name', 'email', 'created', 'modified');

        function __construct()
        {
            parent::__construct();

            $this->load->library('tank_auth');
            $this->lang->load('tank_auth');

        }

        public function getPublicFields($model) {
            foreach ($model as $key => $value) {

                if(!in_array($key, $this->publicFields)) {
                    unset($model->{$key});
                }

            }
            
            
            return $model;
        }
        
        public function save($user_id, $data)
        {
            $profile = $this->findByUserId($user_id);
            
            $this->db->trans_start();
            if($profile!==null) {
                $this->db->where('user_id', $user_id);
                $this->db->update('user_profiles', $data);
            } else {
                $data['user_id'] = $user_id;
                 $this->db->insert('user_profiles', $data);
            }
            $this->db->trans_complete();           

        }       

       
        
        public function findByUserId($user_id){
            $this->db->select('*');
            $this->db->where('user_id',$user_id);

            return $this->db->get('user_profiles')->row();
        } 

}