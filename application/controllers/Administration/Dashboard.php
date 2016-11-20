<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
@ob_start();
class Dashboard extends CI_Controller
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
		$this->load->model('Administration/Dashboard_management');
		$this->load->model("Administration/Restaurant_management");
		$this->load->model("Administration/Area_management");
        $this->load->model("Administration/Cuisine_management"); 
        $this->load->model("OrderModel"); 
		$this->load->model("RestroTableOrderModel"); 
	}

	function index()
	{

		$data['area_list']=$this->Area_management->get_area_list();

		$data['restro_list']=$this->Restaurant_management->get_all_restro_list();
        
        $delivery_orders = $this->OrderModel->find(1, array('date'=>date('Y-m-d')));
        $delivery_amount = 0;
        foreach($delivery_orders as $order) {
            $delivery_amount += $order->total;
        }
        $data['delivery_info'] = array(
            "today_amount"=>$delivery_amount,
            "today_orders"=>count($delivery_orders),
            "completed_percentage"=>$this->OrderModel->getCompletedPercentage(1)
        );
        
        $catering_orders = $this->OrderModel->find(2, array('date'=>date('Y-m-d')));
        $catering_amount = 0;
        foreach($catering_orders as $order) {
            $catering_amount += $order->total;
        }
        $data['catering_info'] = array(
            "today_amount"=>$catering_amount,
            "today_orders"=>count($catering_orders),
            "completed_percentage"=>$this->OrderModel->getCompletedPercentage(2)
        );
        
        $reservation_orders = $this->RestroTableOrderModel->find(array('date'=>date('Y-m-d')));
        $data['reservation_info'] = array(
            "today_amount"=>2500,
            "today_orders"=>count($reservation_orders),
            "completed_percentage"=>$this->RestroTableOrderModel->getCompletedPercentage()
        );
        
        $pickup_orders = $this->OrderModel->find(4, array('date'=>date('Y-m-d')));
        $pickup_amount = 0;
        foreach($pickup_orders as $order) {
            $pickup_amount += $order->total;
        }
        $data['pickup_info'] = array(
            "today_amount"=>$pickup_amount,
            "today_orders"=>count($pickup_orders),
            "completed_percentage"=>$this->OrderModel->getCompletedPercentage(4)
        );
        
		$this->load->view("Administration/dashboard.php",$data);
	}

	function admin_profile()
	{


		$data['errors']=array();

		$adminId =$this->tank_auth->get_user_id();

		$this->form_validation->set_rules('f_name', 'First Name', 'required');
		$this->form_validation->set_rules('l_name', 'Last Name', 'required');
		$this->form_validation->set_rules('email', 'Email Address', 'required');
		

			if ($this->form_validation->run() == FALSE)
			{
				
			}
			else
			{
			    $profile['f_name']=$this->input->post('f_name');
	            $profile['l_name']=$this->input->post('l_name');
			    $profile1['email']=$this->input->post('email');
			    $profile['mobile']=$this->input->post('mobile');
                $profile['address']=$this->input->post('address');
			    

			   
			    
			    
			                $this->load->library('upload');
						    $files = $_FILES['uploadedimages'];
						     
						      if($_FILES['uploadedimages']['error'] != 0)
						      {
						        
						      $data['image_errors']='Couldn\'t upload the file(s)';
                           
					        
						      }

						    $config['upload_path'] = FCPATH . 'profile_images/';
						    $config['allowed_types'] = 'gif|jpg|png|jpeg';
						    
						      $_FILES['uploadedimage']['name'] = $files['name'];
						      $_FILES['uploadedimage']['type'] = $files['type'];
						      $_FILES['uploadedimage']['tmp_name'] = $files['tmp_name'];
						      $_FILES['uploadedimage']['error'] = $files['error'];
						      $_FILES['uploadedimage']['size'] = $files['size'];
						      
						      //now we initialize the upload library
						      $this->upload->initialize($config);
						      if ($this->upload->do_upload('uploadedimage'))
						      {
						       
						        
						        $image_data = $this->upload->data();
							$profile['image'] = $image_data['full_path'];
						      }
						      else
						      {
						        $data['image_errors']=$this->upload->display_errors();
						        
			 
			    
						      }
						      
						$this->Dashboard_management->edit_profile($profile,$adminId);
			      		$this->Dashboard_management->edit_profile1($profile1,$adminId);
			      			
			      			
		
			}
            

			$data['pro'] = $this->Dashboard_management->show_my_profile($adminId);
             //$this->session->set_flashdata("updatemsg","Profile Updated Succcessfully");

		 $this->load->view("Administration/edit_profile",$data);


	}


	function policys()
	{
		$data['errors']=array();
         
         $data['privacy_data']=$this->Dashboard_management->get_privacy();

		   if($this->input->post("privacy"))
		   {
		   	    $privacyInfo['text']=$this->input->post("privacy");
               if($this->Dashboard_management->add_privacy($privacyInfo))
               {
               	    $this->session->set_flashdata("msg","Updated Succcessfully");
               	    redirect("/policys/");
               }

		   }

                 
		$this->load->view("Administration/policys",$data);
	}
	function add_about()
	{
		$data['errors']=array();
         
         $data['about_data']=$this->Dashboard_management->get_about_us();

		   if($this->input->post("privacy"))
		   {
		   	    $privacyInfo['text']=$this->input->post("privacy");
               if($this->Dashboard_management->add_about_us($privacyInfo))
               {
               	    $this->session->set_flashdata("msg","Updated Succcessfully");
               	    redirect("/add_about/");
               }

		   }

                 
		$this->load->view("Administration/add_about",$data);
	}

	


	function tearms_conditions()
	{
		 $data['errors']=array();
         
         $data['tearms_data']=$this->Dashboard_management->get_tearms();

		   if($this->input->post("tearms"))
		   {
		   	    $tearmsInfo['text']= $this->input->post("tearms");
		   	   
               if($this->Dashboard_management->add_tearms($tearmsInfo))
               {
               	    $this->session->set_flashdata("msg","Updated Succcessfully");
               	    redirect("/tearms_conditions/");
               }

		   }

                 
		$this->load->view("Administration/tearms",$data);
	}



	function reports()
	{
		$data['errors']=array();

		$data['orders'] = $this->Dashboard_management->delivery_reports();
		$data['area_list']=$this->Area_management->get_area_list();
		$data['item_list']=$this->Cuisine_management->get_all_item_list();

		$this->load->view("Administration/delivery_reports",$data);
	}

	function catring_reports()
	{
		$data['errors']=array();

		$data['orders'] = $this->Dashboard_management->catring_reports();
		$data['area_list']=$this->Area_management->get_area_list();
		$data['item_list']=$this->Cuisine_management->get_all_item_list();

		$this->load->view("Administration/catering_reports",$data);
	}
	function reservation_reports()
	{
		$data['errors']=array();

		$data['orders'] = $this->Dashboard_management->reservation_reports();
		$data['area_list']=$this->Area_management->get_area_list();
		$data['item_list']=$this->Cuisine_management->get_all_item_list();

		$this->load->view("Administration/reservation_reports",$data);
	}
	function pickup_reports()
	{
		$data['errors']=array();

		$data['orders'] = $this->Dashboard_management->pickup_reports();
		$data['area_list']=$this->Area_management->get_area_list();
		$data['item_list']=$this->Cuisine_management->get_all_item_list();

		$this->load->view("Administration/pickup_reports",$data);
	}

	public function add_faq()
	{
		  
		  $data['errors']=array();
		  $data['faq_category_list']=$this->Dashboard_management->get_all_restro_faq_category(); 
          $this->form_validation->set_rules('faq_cat', 'FAQ Category', 'required');
		  $this->form_validation->set_rules('faq_title', 'FAQ Title', 'required');
	      $this->form_validation->set_rules('faq_description', 'FAQ Description', 'required');
		  if ($this->form_validation->run() == FALSE)
			{
				 
			}
			else
			{
                  $faqInfo['cat_id']=$this->input->post("faq_cat");
                  $faqInfo['title']=$this->input->post("faq_title");
                  $faqInfo['description']=$this->input->post("faq_description");
                  $faqInfo['date']=date("Y-m-d");
                  if($this->Dashboard_management->add_faq($faqInfo))
                  {
                  	  $this->session->set_flashdata("msg","Added Successfully");

                  }

                  
			}	  
	


		  $this->load->view("Administration/add_faq",$data);
	}



	public function faq_list()
	{

		

		   $data['errors']=array();
		   $data['faq_list']=$this->Dashboard_management->get_faq();
		   $this->load->view("Administration/faq_list",$data);

	}


  public function add_faq_category()
	{
		  $data['errors']=array();
		  $data['faq_category_list']=$this->Dashboard_management->get_all_restro_faq_category();
           $this->form_validation->set_rules('faq_cat', 'FAQ Category', 'required|is_unique[restro_faq_category.name]');
           if ($this->form_validation->run() == FALSE)
			{
				
			}
			else
			{
				$faqInfo['name']=$this->input->post("faq_cat");
                $faqInfo['date']=date("Y-m-d");
                if($this->Dashboard_management->add_faq_category($faqInfo))
                {
                	 $this->session->set_flashdata("msg","Category Added Successfully");
                	 redirect("/add_faq_category/");


                }


			}
           

           $this->load->view("Administration/add_faq_category",$data);


	}


	public function faq_category_update()
	{
		   $data['errors']=array();
		    $id=$this->input->post("id");
		    $updateCat['name']= $this->input->post("cat_name");
		  
			if($this->Dashboard_management->update_faq_cat($id,$updateCat))
				{
					echo "Updated Successfully";
				}
		   
   
	}

	public function faq_category_delete()
	{
          $id=$this->input->post("id");
          if($this->Dashboard_management->delete_faq_cat($id))
          {
          	echo "done";
          	
          }

	}

   public function faq_update_get_category_list()
	{
		  $data['errors']=array();
           $id=$this->input->post("id");
		   
		  $data['faq_category_list']=$this->Dashboard_management->get_all_restro_faq_category();
          $data['one_cat']=$this->Dashboard_management->faq_update_get_category_by_id($id);
		  $this->load->view("ajax_faq_list_cat",$data);	  
	}
	public function update_faq()
	{
		$data['errors']=array();
		$id=$this->input->post("id");
		$faqInfo['cat_id']=$this->input->post("faq_cat");
		$faqInfo['description']=$this->input->post("description");
		$faqInfo['title']=$this->input->post("title");
		$faqInfo['status']=$this->input->post("faq_status");
		if($this->Dashboard_management->update_faq($id,$faqInfo))
		{
		    echo "yes";
			$this->session->set_flashdata("msg","FAQ Updated Successfully");
	    }
		
	}
	public function delete_faq()
	{
		$id=$this->input->post("id");
		if($this->Dashboard_management->delete_faq($id))
		{
			echo "done";
		}
	}
	
		
}