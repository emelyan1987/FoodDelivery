<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

    @ob_start();
    class Advertise extends CI_Controller
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
            $this->load->model("Administration/Advertise_management"); 
            $this->load->model("Restaurant_Owner/Restro_Owner_Model");

        }

        public function index()
        {


        }

        public function add_advertise()
        {
            $data['errors']=array();

            if(isset($_POST['btnupload'])){
                $this->form_validation->set_rules('advertise_type', 'Advertise Type', 'required');


                if ($this->form_validation->run() == FALSE)
                {

                }
                else
                {             
                    $advert['type_id']= $this->input->post('advertise_type');
                    $advert['system_status']= 1;       

                    $this->load->library('upload');
                    $files = $_FILES['advertise_imag'];

                    if($_FILES['advertise_imag']['error'] != 0)
                    {        
                        $data['image_errors']='Couldn\'t upload the file(s)';   
                    }

                    $config['upload_path'] = FCPATH . 'profile_images/';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';

                    $_FILES['advertise_imag']['name'] = $files['name'];
                    $_FILES['advertise_imag']['type'] = $files['type'];
                    $_FILES['advertise_imag']['tmp_name'] = $files['tmp_name'];
                    $_FILES['advertise_imag']['error'] = $files['error'];
                    $_FILES['advertise_imag']['size'] = $files['size'];

                    //now we initialize the upload library
                    $this->upload->initialize($config);
                    $advert['image'] = '';
                    if ($this->upload->do_upload('advertise_imag'))
                    {

                        $image_data = $this->upload->data();
                        $advert['image'] = $image_data['full_path'];
                    }
                    else
                    {
                        $data['image_errors']=$this->upload->display_errors();


                    }

                    if($advert['image'] != '')
                    {
                        if($this->Advertise_management->add_advertise($advert))
                        {
                            $data['success_msg'] = 'Advertisement Added Successfully done!';
                        }
                    }
                }
            }

            $data['AdvertiseType'] = $this->Advertise_management->all_Advertise_type(1);

            $this->load->view('Administration/add_advertise',$data);
        }

        public function delete_advertise($id)
        {
            $data['errors']=array();
            $type_id = $this->uri->segment("2");
            $this->Advertise_management->clear_adevrtise_by_type($type_id,2);
            $data['AdvertiseType'] = $this->Advertise_management->all_Advertise_type(2);

            redirect('/app_add_advertise');

        } 

        public function delete_advertise_img($id)
        {
            $data['errors']=array();
            $img_id = $this->uri->segment("2");
            $this->Advertise_management->delete_advertise_image($img_id,1);
            $data['AdvertiseType'] = $this->Advertise_management->all_Advertise_type(1);

            redirect('/add_advertise');

        }








        public function app_add_advertise()
        {
            $data['errors']=array();

            if(isset($_POST['btnupload'])){
                $this->form_validation->set_rules('advertise_type', 'Advertise Type', 'required');


                if ($this->form_validation->run() == FALSE)
                {

                }
                else
                {                    
                    $advert['type_id']= $this->input->post('advertise_type');
                    $advert['system_status']= 2;       

                    $this->load->library('upload');
                    $files = $_FILES['advertise_imag'];

                    if($_FILES['advertise_imag']['error'] != 0)
                    {

                        $data['image_errors']='Couldn\'t upload the file(s)';

                    }

                    $config['upload_path'] = FCPATH . 'profile_images/';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';

                    $_FILES['advertise_imag']['name'] = $files['name'];
                    $_FILES['advertise_imag']['type'] = $files['type'];
                    $_FILES['advertise_imag']['tmp_name'] = $files['tmp_name'];
                    $_FILES['advertise_imag']['error'] = $files['error'];
                    $_FILES['advertise_imag']['size'] = $files['size'];

                    //now we initialize the upload library
                    $this->upload->initialize($config);
                    $advert['image'] = '';
                    if ($this->upload->do_upload('advertise_imag'))
                    {

                        $image_data = $this->upload->data();
                        $advert['image'] = $image_data['full_path'];
                    }
                    else
                    {
                        $data['image_errors']=$this->upload->display_errors();


                    }

                    if($advert['image'] != '')
                    {
                        if($this->Advertise_management->add_advertise($advert))
                        {
                            $data['success_msg'] = 'Advertisement Added Successfully done!';
                        }
                    }
                }
            }

            $data['AdvertiseType'] = $this->Advertise_management->all_Advertise_type(2);

            $this->load->view('Administration/app_add_advertise',$data);
        }



        public function app_delete_advertise($id)
        {
            $data['errors']=array();
            $type_id = $this->uri->segment("2");
            $this->Advertise_management->clear_adevrtise_by_type($type_id,2);
            $data['AdvertiseType'] = $this->Advertise_management->all_Advertise_type(2);

            redirect('/app_add_advertise');

        } 

        public function app_delete_advertise_img($id)
        {
            $data['errors']=array();
            $img_id = $this->uri->segment("2");
            $this->Advertise_management->delete_advertise_image($img_id,2);
            $data['AdvertiseType'] = $this->Advertise_management->all_Advertise_type(2);

            redirect('/app_add_advertise');

        }
    }















?>