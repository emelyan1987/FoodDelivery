<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
@ob_start();
class Restro_Owner extends CI_Controller
{

	function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		        $this->load->helper('security');
		$this->load->library('tank_auth');
		$this->lang->load('tank_auth');
		$this->load->model("Restaurant_Owner/Restro_Owner_Model");
		$this->load->model("Customer/Home_site");
		$this->load->helper('restaurant_helper');
		$this->load->model("Administration/Cuisine_management");
		$this->load->model("Administration/Area_management"); 
		$this->load->model("Administration/Dashboard_management");
		$this->load->model("Administration/Restaurant_management");
		$this->load->model("Administration/Order_Management");
		$this->load->model("Customer_management");
        
        $this->load->model('RestaurantModel');
        $this->load->model('OrderModel');
        $this->load->model('RestroTableOrderModel');
	}
	
	function dashboard(){

		$data['area_list']=$this->Area_management->get_area_list();
        
        $data = array_merge($data, $this->getOrderInfo());
        
	    $this->load->view("Restaurant_Owner/restro_owner_dashboard",$data);
	
	}

    
        function profile()
        {

        $data['errors']=array();

        $RestroOwnerId =$this->tank_auth->get_user_id();
        $data['country'] = $this->Home_site->fetch_all_country();


		$this->form_validation->set_rules('f_name', 'First Name', 'required');
		$this->form_validation->set_rules('l_name', 'Last Name', 'required');
		
		$this->form_validation->set_rules('email', 'Email Address', 'required');
		$this->form_validation->set_rules('country', 'Country Name', 'required');
		$this->form_validation->set_rules('state', 'State Name', 'required');
		$this->form_validation->set_rules('city', 'city', 'required');

		
			if ($this->form_validation->run() == FALSE)
			{
				
			}
			else
			{
			    $restroOwner['f_name']=$this->input->post('f_name');
	            	    $restroOwner['l_name']=$this->input->post('l_name');
			    
			    $restroOwner1['email']=$this->input->post('email');
			    $restroOwner['mobile']=$this->input->post('mobile');
                    	    
			    $restroOwner['country']=$this->input->post('country');
			    $restroOwner['state']=$this->input->post('state');
			    $restroOwner['city']=$this->input->post('city');
			    $restroOwner['address']=$this->input->post('address');
			    $restroOwnerID =$this->tank_auth->get_user_id();

			   
			    
			    
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
							$restroOwner['image'] = $image_data['full_path'];
						      }
						      else
						      {
						        $data['image_errors']=$this->upload->display_errors();
						        
			 
			    
						      }
						      
						$this->Restro_Owner_Model->edit_profile($restroOwner,$restroOwnerID);
			      		$this->Restro_Owner_Model->edit_profile1($restroOwner1,$restroOwnerID);
			      			
			      			
		
			}

			$data['pro'] = $this->Dashboard_management->show_my_profile($RestroOwnerId);

        		$this->load->view("Restaurant_Owner/restro_owner_profile",$data);

	}



	public function restaurant_list(){

	   $data['errors']=array();
       
       $data['owner_restro_list']=$this->Restro_Owner_Model->get_all_owner_restro();
       

	   $this->load->view("Restaurant_Owner/restro_owner_restaurants_list",$data);
	}
	

	public function add_owner_restaurant(){

		$data['errors']=array();

		$this->form_validation->set_rules('restro_name', 'Restaurant Name', 'required');
		$this->form_validation->set_rules('restro_country', 'Restaurant Country Name', 'required');
		$this->form_validation->set_rules('restro_state', 'Restaurant State Name', 'required');
		$this->form_validation->set_rules('restro_city', 'Restaurant city', 'required');
		$this->form_validation->set_rules('restro_latitude', 'Restaurant latitude', 'required');
		$this->form_validation->set_rules('restro_longitude', 'Restaurant longitude', 'required');
		$this->form_validation->set_rules('restro_type', 'Restaurant type', 'required');
		$this->form_validation->set_rules('restro_food_type', 'Restaurant Food', 'required');
		//$this->form_validation->set_rules('uploadedimages[]','Upload image','callback_fileupload_check');
			if ($this->form_validation->run() == FALSE)
			{
				
			}
			else
			{
				
                $restroInfo['user_id']=$this->tank_auth->get_user_id();

                $restroInfo['restro_services']=implode($this->input->post('restro_services'),",");
				$restroInfo['restro_name']=$this->input->post('restro_name');
				$restroInfo['restro_country']=$this->input->post('restro_country');
				$restroInfo['restro_state']=$this->input->post('restro_state');
				$restroInfo['restro_city']=$this->input->post('restro_city');
				$restroInfo['restro_latitude']=$this->input->post('restro_latitude');
				$restroInfo['restro_longitude']=$this->input->post('restro_longitude');
				$restroInfo['restro_type']=$this->input->post('restro_type');
				$restroInfo['restro_food_type']=$this->input->post('restro_food_type');
				$restroInfo['restro_near_by']=$this->input->post('restro_near_by');
	            $restroInfo['restro_address']=$this->input->post('restro_address');
	            $restroInfo['restro_address']=0;

	                       
						/*    $this->load->library('upload');
                            $number_of_files = sizeof($_FILES['uploadedimages']['tmp_name']);
						    $files = $_FILES['uploadedimages'];
						    for($i=0;$i<$number_of_files;$i++)
						    {
						      if($_FILES['uploadedimages']['error'][$i] != 0)
						      {
						        
						      $data['image_errors']='Couldn\'t upload the file(s)';
                           
					          }
						    }

						    $config['upload_path'] = FCPATH . 'images/';
						    $config['allowed_types'] = 'gif|jpg|png|jpeg';
						    for ($i = 0; $i < $number_of_files; $i++)
						    {
						      $_FILES['uploadedimage']['name'] = $files['name'][$i];
						      $_FILES['uploadedimage']['type'] = $files['type'][$i];
						      $_FILES['uploadedimage']['tmp_name'] = $files['tmp_name'][$i];
						      $_FILES['uploadedimage']['error'] = $files['error'][$i];
						      $_FILES['uploadedimage']['size'] = $files['size'][$i];
						      
						      //now we initialize the upload library
						      $this->upload->initialize($config);
						      if ($this->upload->do_upload('uploadedimage'))
						      {
						        $this->_uploaded[$i] = $this->upload->data();
						      }
						      else
						      {
						        $data['image_errors']=$this->upload->display_errors();
						        
						      }

						    }
						   */
				$this->Restro_Owner_Model->add_restro_info($restroInfo); 
						


			 }

		$this->load->view("Restaurant_Owner/add_owner_restaurant",$data);
	}

	public function edit_my_restaurant(){
		$data['errors']=array();
		$data['success_msg'] = '';
		$restroOwnerID =$this->tank_auth->get_user_id();
		$restro_id =$this->uri->segment('2');

		$data['country'] = $this->Home_site->fetch_all_country();
		
		$data['cat_list'] = $this->Restro_Owner_Model->restro_all_item_category_view();
		$data['restroinfo'] = $this->Restro_Owner_Model->view_my_restro($restro_id);
		$data['restroimg'] = $this->Restro_Owner_Model->view_my_restro_img($restro_id);
		//$data['services'] = $this->Restro_Owner_Model->restro_service_form();
		$data['cuisin'] = $this->Restro_Owner_Model->view_all_cuisin();
		$data['food_type'] = $this->Restro_Owner_Model->view_all_food_type();
		$data['seo_category'] = $this->Restro_Owner_Model->all_seo_category();


		//$this->form_validation->set_rules('Restroid', 'Restaurant', 'required');
		$this->form_validation->set_rules('restro_name', 'Restaurant Name', 'required');
		//$this->form_validation->set_rules('restro_country', 'Restaurant Country Name', 'required');
		//$this->form_validation->set_rules('restro_state', 'Restaurant State Name', 'required');
		//$this->form_validation->set_rules('restro_city', 'Restaurant city', 'required');
		//$this->form_validation->set_rules('restro_latitude', 'Restaurant latitude', 'required');
		//$this->form_validation->set_rules('restro_longitude', 'Restaurant longitude', 'required');
		//$this->form_validation->set_rules('restro_type', 'Restaurant type', 'required');
		$this->form_validation->set_rules('food_type[]', 'Restaurant Food', 'required'); 
		$this->form_validation->set_rules('seo_cat[]', 'Category','required');
		
		//$this->form_validation->set_rules('service_type', 'Service Type', 'required');
		
			if ($this->form_validation->run() == FALSE)
			{
				
			}
			else
			{

				$restroInfo['restro_name']=trim($this->input->post('restro_name'));
				$restroInfo['restro_country']=$this->input->post('restro_country');
				$restroInfo['restro_state']=$this->input->post('restro_state');
				//$restroInfo['restro_city']=$this->input->post('restro_city');
				$restroInfo['restro_latitude']=$this->input->post('restro_latitude');
				$restroInfo['restro_longitude']=$this->input->post('restro_longitude');
				$restroInfo['restro_type']=$this->input->post('restro_type');
				
				$restroInfo['restro_near_by']=$this->input->post('restro_near_by');
	            $restroInfo['restro_address']=$this->input->post('restro_address'); 
	            $restroInfo['status']=$this->input->post('restro_status');
	            $restroInfo['restro_description']=$this->input->post('restro_description'); 
	            $restroInfo['restro_address']=$this->input->post('restro_address'); 
	            $restroInfo['contact_person']=$this->input->post('contact_person'); 
	            $restroInfo['telephones']=$this->input->post('telephones');  
	           
	            $resto_cuisi = $this->input->post('resto_cuisine'); 
	            $catID =$this->input->post('seo_cat');
	            $restro_food_type = $this->input->post('food_type');

	            
	            //$restroService=$this->input->post('restro_services');
	            //$restroInfo['restro_services'] = implode(',',$restroService);
	            $cuisine['restro_id'] = $restro_id;
	            $this->Restro_Owner_Model->delete_my_restro_cuisine($restro_id);
	            foreach($resto_cuisi as $RS)
	            {
	            	$cuisine['cuisine_id'] = $RS;
	            	
	            	$this->Restro_Owner_Model->add_my_restro_cuisine($cuisine); 
	            }

	            /*$query = $this->Restro_Owner_Model->delete_my_restro_menu($restro_id,$restroOwnerID);
	            foreach($catID as $categoryId)
				{
					$restromenu['category_id'] = $categoryId;
					$restromenu['restro_id'] = $restro_id; 
					$restromenu['user_id'] = $restroOwnerID;

					$query = $this->Restro_Owner_Model->add_restro_menu($restromenu);
				}
				*/

				$this->Restro_Owner_Model->delete_my_restro_seocat($restro_id,$restroOwnerID);
	            foreach($catID as $categoryId)
				{
					$restromenu['category_id'] = $categoryId;
					$restromenu['restro_id'] = $restro_id; 
					$restromenu['user_id'] = $restroOwnerID;

					$query = $this->Restro_Owner_Model->add_restro_seocat($restromenu);
				}


				$this->Restro_Owner_Model->delete_my_restro_foodType($restro_id);
				foreach($restro_food_type as $FooD)
				{
					$restrofood['food_type_id'] = $FooD;
					$restrofood['restro_id'] = $restro_id; 
					

					$query = $this->Restro_Owner_Model->add_restro_food_type($restrofood);
				}





	            $this->load->library('upload');
						    $files = $_FILES['logo'];
						     
						      if($_FILES['logo']['error'] != 0)
						      {
						        
						      $data['image_errors']='Couldn\'t upload the file(s)';
                           
					        
						      }

						    $config['upload_path'] = FCPATH . 'images/';
						    $config['allowed_types'] = 'gif|jpg|png|jpeg';
						    
						      $_FILES['logo']['name'] = $files['name'];
						      $_FILES['logo']['type'] = $files['type'];
						      $_FILES['logo']['tmp_name'] = $files['tmp_name'];
						      $_FILES['logo']['error'] = $files['error'];
						      $_FILES['logo']['size'] = $files['size'];
						      
						      //now we initialize the upload library
						      $this->upload->initialize($config);
						      if ($this->upload->do_upload('logo'))
						      {
						       
						        
						        $image_data1 = $this->upload->data();
								$restroInfo['restaurant_logo'] = $image_data1['full_path'];
						      }
						      else
						      {
						        $data['image_errors']=$this->upload->display_errors();
						        
			 
			    
						      }

	            $this->Restro_Owner_Model->edit_my_restro($restroInfo,$restro_id); 


	            			
                            $number_of_files = sizeof($_FILES['uploadedimages']['tmp_name']);
						    $files = $_FILES['uploadedimages'];

						    for($i=0;$i<$number_of_files;$i++)
						    {
						      if($_FILES['uploadedimages']['error'][$i] != 0)
						      {
						        
						      $data['image_errors']='Couldn\'t upload the file(s)';
                           
					          }
						    }

						    $config['upload_path'] = FCPATH . 'images/';
						    $config['allowed_types'] = 'gif|jpg|png|jpeg';

						    $restroInfoImage['restro_id']=$restro_id;
						    for ($i = 0; $i < $number_of_files; $i++)
						    {
						    	 
						      $_FILES['uploadedimage']['name'] = $files['name'][$i];
						      $_FILES['uploadedimage']['type'] = $files['type'][$i];
						      $_FILES['uploadedimage']['tmp_name'] = $files['tmp_name'][$i];
						      $_FILES['uploadedimage']['error'] = $files['error'][$i];
						      $_FILES['uploadedimage']['size'] = $files['size'][$i];
						      $this->upload->initialize($config);
						      if ($this->upload->do_upload('uploadedimage'))
						      {
						                $this->_uploaded[$i] = $this->upload->data();
                                        $restroInfoImage['restro_images']=$this->_uploaded[$i]['full_path'];
						    	        $this->Restro_Owner_Model->add_restro_image($restroInfoImage);
						      }
						      else
						      {
						        $data['image_errors']=$this->upload->display_errors();
						        
						      }

						    }

						    $data['success_msg'] = "Restaurant Edit Successfully done!";
			}
		
		$this->load->view("Restaurant_Owner/edit_my_restaurant",$data);
	}

	public function my_restro_location(){
		$data['errors']=array();

		$this->load->view("Restaurant_Owner/my_restro_location",$data);
	}

	public function restro_add_item_category(){

		$data['errors']=array();

		$this->form_validation->set_rules('cat_name', 'Menu Category Name', 'required');
			
			if ($this->form_validation->run() == FALSE)
			{
				
			}
			else
			{
				$itemcat['cat_name']=$this->input->post('cat_name');
				$itemcat['item_cat_description']=$this->input->post('item_cat_description');
				$itemcat['status']=$this->input->post('status');
				if($itemcat['status'] == '')
				{
					$itemcat['status'] = 0;
				}

				$itemcat['user_id'] = $this->tank_auth->get_user_id();


				$this->load->library('upload');
						    $files = $_FILES['uploadedimages'];
						     
						      if($_FILES['uploadedimages']['error'] != 0)
						      {
						        
						      $data['image_errors']='Couldn\'t upload the file(s)';
                           
					        
						      }

						    $config['upload_path'] = FCPATH . 'item_images/';
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
								$itemcat['image'] = $image_data['full_path'];
						      }
						      else
						      {
						        $data['image_errors']=$this->upload->display_errors();
						        
			 
			    
						      }

				$this->Restro_Owner_Model->add_restro_item_cat($itemcat); 
			}
		$this->load->view("Restaurant_Owner/restro_add_item_category",$data);
	}

	public function restro_item_category_list(){

		$data['errors']=array();
       
        $data['item_list']=$this->Restro_Owner_Model->restro_all_item_category();

		$this->load->view("Restaurant_Owner/restro_item_category_list",$data);
	}

	public function edit_menu_category(){
		$data['errors']=array();
		$restroOwnerID =$this->tank_auth->get_user_id();
		$cat_id =$this->uri->segment('2');
		$data['category_data']=$this->Restro_Owner_Model->get_item_category_details($cat_id,$restroOwnerID);

			$this->form_validation->set_rules('cat_name', 'Menu Category Name', 'required');
			
			if ($this->form_validation->run() == FALSE)
			{
				
			}
			else
			{
				$itemcat['cat_name']=$this->input->post('cat_name');
				$itemcat['item_cat_description']=$this->input->post('item_cat_description');
				$itemcat['status']=$this->input->post('status');
				if($itemcat['status'] == '')
				{
					$itemcat['status'] = 0;
				}

				$itemcat['user_id'] = $restroOwnerID;


				$this->load->library('upload');
						    $files = $_FILES['uploadedimages'];
						     
						      if($_FILES['uploadedimages']['error'] != 0)
						      {
						        
						      $data['image_errors']='Couldn\'t upload the file(s)';
                           
					        
						      }

						    $config['upload_path'] = FCPATH . 'item_images/';
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
								$itemcat['image'] = $image_data['full_path'];
						      }
						      else
						      {
						        $data['image_errors']=$this->upload->display_errors();
						        
			 
			    
						      }

				$this->Restro_Owner_Model->edit_restro_item_cat($itemcat,$cat_id); 
			}

		$this->load->view("Restaurant_Owner/edit_menu_category",$data);
	}

	public function manage_my_restro_list(){
		$data['errors']=array();
		$data['retro_list']=$this->Restro_Owner_Model->get_my_all_restro();


		$this->load->view("Restaurant_Owner/manage_my_restro_list",$data);
	}
	public function restro_add_item(){
		$data['errors']=array();

		$data['cat_list'] = $this->Restro_Owner_Model->restro_all_item_category_view();
		
		$user_id = $this->tank_auth->get_user_id();
		$data['Locations'] = $this->Restaurant_management->get_all_owner_location($user_id);
		
		$this->form_validation->set_rules('item_name', 'Item Name', 'required');
		$this->form_validation->set_rules('item_cat[]', 'Item Category', 'required');
		$this->form_validation->set_rules('location_id', 'Location', 'required');
		$this->form_validation->set_rules('service_id', 'Service', 'required');

		$this->form_validation->set_rules('price_type', 'Price Type', 'required');

		if($this->input->post('price_type') == 2)
		{
			$this->form_validation->set_rules('item_price', 'Item Price', 'required'); 
			$item['item_price']=$this->input->post('item_price');
			$item['price_type'] = $this->input->post('price_type');
		}
		else
		{
			$item['item_price']=0;
			$item['price_type'] = $this->input->post('price_type');
		}
			
			if ($this->form_validation->run() == FALSE)
			{
				
			}
			else
			{
				$item['item_name']=$this->input->post('item_name');
				$item_cat =$this->input->post('item_cat');
				$item['item_price']=$this->input->post('item_price');
				$item['item_description']=$this->input->post('item_description');
				$item['status']=$this->input->post('status'); 
				$item['loyalty_points']=$this->input->post('loyalty_points');
				//$item['show_size']=$this->input->post('show_size');
				//$item['show_add_topping']=$this->input->post('show_add_topping');
				//$item['show_remove_topping']=$this->input->post('show_remove_topping');
				//$item['show_spacial_request']=$this->input->post('show_spacial_request');
				$item['variation']=$this->input->post('variation');
				$item['order_point_amount']=$this->input->post('order_point_amount');
				$item['location_id']=$this->input->post('location_id');
				$item['service_id']=$this->input->post('service_id');
				$item['setup_requirements']=$this->input->post('setup_requirements');
				
				

				if($item['status'] == '')
				{
					$item['status'] = 0;
				}
				/*if($item['loyalty_points'] == '')
				{
					$item['loyalty_points'] = 0;
				}
				if($item['show_size'] == '')
				{
					$item['show_size'] = 0;
				}
				if($item['show_add_topping'] == '')
				{
					$item['show_add_topping'] = 0;
				}
				if($item['show_remove_topping'] == '')
				{
					$item['show_remove_topping'] = 0;
				}
				if($item['show_spacial_request'] == '')
				{
					$item['show_spacial_request'] = 0;
				}*/


				$item['user_id'] = $this->tank_auth->get_user_id();




				$this->load->library('upload');
						    $files = $_FILES['uploadedimages'];
						     
						      if($_FILES['uploadedimages']['error'] != 0)
						      {
						        
						      $data['image_errors']='Couldn\'t upload the file(s)';
                           
					        
						      }

						    $config['upload_path'] = FCPATH . 'item_images/';
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
								$item['image'] = $image_data['full_path'];
						      }
						      else
						      {
						        $data['image_errors']=$this->upload->display_errors();
						        
			 
			    
						      }

				$queryId = $this->Restro_Owner_Model->add_restro_item($item); 

				$multCat['item_id'] = $queryId;
				$multCat['user_id'] = $this->tank_auth->get_user_id();
				foreach($item_cat as $Itm)
				{
					$multCat['category_id'] = $Itm;

					$this->Restro_Owner_Model->add_restro_item_multi_cat($multCat); 
				}



				//variation data start here

				//variation 1 data function start here
				$variation_name1 = $this->input->post('variation_name1');
				if(trim($variation_name1) != '')
				{
					$variation['variation_name'] = $variation_name1;
					$variation['mandatory'] = $this->input->post('v_mandatory1');
					$variation['multi_item'] = $this->input->post('v_multi_item1');
					$variation['item_id'] = $queryId;
					$variation['variation_type'] = 1;

					$variation_id = $this->Cuisine_management->add_item_variations($variation); 


					$item_name_variation = $this->input->post('item_name_variation1');
					$price_variation = $this->input->post('price_variation1');

					foreach($item_name_variation as $key => $name_variation)
					{
						if($name_variation != '')
						{
							$variationData['title'] = $name_variation;
							$variationData['price'] = $price_variation[$key];
							$variationData['variation_id'] = $variation_id;
							$variationData['item_id'] = $queryId;

							$this->Cuisine_management->add_item_variations_data($variationData);
						}
					}
					
					

				}
				

				//variation 2 data function start here
				$variation_name2 = $this->input->post('variation_name2');
				if(trim($variation_name2) != '')
				{
					$variation['variation_name'] = $variation_name2;
					$variation['mandatory'] = $this->input->post('v_mandatory2');
					$variation['multi_item'] = $this->input->post('v_multi_item2');
					$variation['item_id'] = $queryId;
					$variation['variation_type'] = 2;

					$variation_id = $this->Cuisine_management->add_item_variations($variation); 


					$item_name_variation = $this->input->post('item_name_variation2');
					$price_variation = $this->input->post('price_variation2');

					foreach($item_name_variation as $key => $name_variation)
					{
						if($name_variation != '')
						{
							$variationData['title'] = $name_variation;
							$variationData['price'] = $price_variation[$key];
							$variationData['variation_id'] = $variation_id;
							$variationData['item_id'] = $queryId;

							$this->Cuisine_management->add_item_variations_data($variationData);
						}
					}
					
					

				}


				//variation 3 data function start here
				$variation_name3 = $this->input->post('variation_name3');
				if(trim($variation_name3) != '')
				{
					$variation['variation_name'] = $variation_name3;
					$variation['mandatory'] = $this->input->post('v_mandatory3');
					$variation['multi_item'] = $this->input->post('v_multi_item3');
					$variation['item_id'] = $queryId;
					$variation['variation_type'] = 3;

					$variation_id = $this->Cuisine_management->add_item_variations($variation); 


					$item_name_variation = $this->input->post('item_name_variation3');
					$price_variation = $this->input->post('price_variation3');

					foreach($item_name_variation as $key => $name_variation)
					{
						if($name_variation != '')
						{
							$variationData['title'] = $name_variation;
							$variationData['price'] = $price_variation[$key];
							$variationData['variation_id'] = $variation_id;
							$variationData['item_id'] = $queryId;

							$this->Cuisine_management->add_item_variations_data($variationData);
						}
					}
					
					

				}

				//variation data end here
				redirect('/restro_item_list/');

			}
		$this->load->view("Restaurant_Owner/restro_add_item",$data);
	}

	public function restro_item_list(){
		$data['errors']=array();
		
		$user_id = $this->tank_auth->get_user_id();
		$data['Locations'] = $this->Restaurant_management->get_all_owner_location($user_id);
		$data['item_list']=$this->Restro_Owner_Model->get_owner_all_item();

		$this->load->view("Restaurant_Owner/restro_item_list",$data);
	}

	public function edit_restro_item(){
		$data['errors']=array();
		$restroOwnerID =$this->tank_auth->get_user_id();
		$item_id =$this->uri->segment('2');
		$data['success_msg'] = '';

		$this->form_validation->set_rules('item_name', 'Item Name', 'required');
		$this->form_validation->set_rules('item_cat[]', 'Item Category', 'required');
		
		if($this->input->post('price_type') == 2)
		{
			$this->form_validation->set_rules('item_price', 'Item Price', 'required'); 
			$item['item_price']=$this->input->post('item_price');
			$item['price_type'] = $this->input->post('price_type');
		}
		else
		{
			$item['item_price']=0;
			$item['price_type'] = $this->input->post('price_type');
		}

			
			if ($this->form_validation->run() == FALSE)
			{
				
			}
			else
			{
				$item['item_name']=$this->input->post('item_name');
				$item_cat =$this->input->post('item_cat');
				$item['item_price']=$this->input->post('item_price');
				$item['item_description']=$this->input->post('item_description');
				$item['status']=$this->input->post('status'); 
				$item['loyalty_points']=$this->input->post('loyalty_points');
				$item['variation']=$this->input->post('variation');
				$item['order_point_amount']=$this->input->post('order_point_amount');
				$item['setup_requirements']=$this->input->post('setup_requirements');

				if($item['status'] == '')
				{
					$item['status'] = 0;
				}
			

				$item['user_id'] = $this->tank_auth->get_user_id();


				$this->load->library('upload');
						    $files = $_FILES['uploadedimages'];
						     
						      if($_FILES['uploadedimages']['error'] != 0)
						      {
						        
						      $data['image_errors']='Couldn\'t upload the file(s)';
                           
					        
						      }

						    $config['upload_path'] = FCPATH . 'item_images/';
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
								$item['image'] = $image_data['full_path'];
						      }
						      else
						      {
						        $data['image_errors']=$this->upload->display_errors();
						        
			 
			    
						      }

				$this->Restro_Owner_Model->edit_restro_item($item,$item_id); 

				$this->Restro_Owner_Model->delete_restro_item_multi_cat($item_id); 
				$multCat['item_id'] = $item_id;
				$multCat['user_id'] = $this->tank_auth->get_user_id();
				foreach($item_cat as $Itm)
				{
					$multCat['category_id'] = $Itm;

					$this->Restro_Owner_Model->add_restro_item_multi_cat($multCat); 
				}


				//variation data start here

				//variation 1 data function start here
				$variation_name1 = $this->input->post('variation_name1');
				if(trim($variation_name1) != '')
				{

					$variation['variation_name'] = $variation_name1;
					$variation['mandatory'] = $this->input->post('v_mandatory1');
					$variation['multi_item'] = $this->input->post('v_multi_item1');
					$variation['item_id'] = $item_id;
					$variation['variation_type'] = 1;
					$up_id = $this->input->post('variation_id1');

					$this->Cuisine_management->update_item_variations($variation,$up_id); 


					$item_name_variation = $this->input->post('item_name_variation1');
					$price_variation = $this->input->post('price_variation1');
					$id_variation = $this->input->post('id_variation1');

					foreach($item_name_variation as $key => $name_variation)
					{
						if($name_variation != '')
						{
							$variationData['title'] = $name_variation;
							$variationData['price'] = $price_variation[$key];
							$variationData['item_id'] = $item_id;
							$varDataId = $id_variation[$key];

							$this->Cuisine_management->update_item_variations_data($variationData,$varDataId);
						}
					}
					
					

				}
				

				//variation 2 data function start here
				$variation_name2 = $this->input->post('variation_name2');
				if(trim($variation_name2) != '')
				{
					$variation['variation_name'] = $variation_name2;
					$variation['mandatory'] = $this->input->post('v_mandatory2');
					$variation['multi_item'] = $this->input->post('v_multi_item2');
					$variation['item_id'] = $item_id;
					$variation['variation_type'] = 2;
					$up_id = $this->input->post('variation_id2');

					$this->Cuisine_management->update_item_variations($variation,$up_id); 


					$item_name_variation = $this->input->post('item_name_variation2');
					$price_variation = $this->input->post('price_variation2');
					$id_variation = $this->input->post('id_variation2');

					foreach($item_name_variation as $key => $name_variation)
					{
						if($name_variation != '')
						{
							$variationData['title'] = $name_variation;
							$variationData['price'] = $price_variation[$key];
							$variationData['item_id'] = $item_id;
							$varDataId = $id_variation[$key];

							$this->Cuisine_management->update_item_variations_data($variationData,$varDataId);
						}
					}
					
					

				}


				//variation 3 data function start here
				$variation_name3 = $this->input->post('variation_name3');
				if(trim($variation_name3) != '')
				{
					$variation['variation_name'] = $variation_name3;
					$variation['mandatory'] = $this->input->post('v_mandatory3');
					$variation['multi_item'] = $this->input->post('v_multi_item3');
					$variation['item_id'] = $item_id;
					$variation['variation_type'] = 3;
					$up_id = $this->input->post('variation_id3');

					$this->Cuisine_management->update_item_variations($variation,$up_id);


					$item_name_variation = $this->input->post('item_name_variation3');
					$price_variation = $this->input->post('price_variation3');
					$id_variation = $this->input->post('id_variation3');

					foreach($item_name_variation as $key => $name_variation)
					{
						if($name_variation != '')
						{
							$variationData['title'] = $name_variation;
							$variationData['price'] = $price_variation[$key];
							$variationData['item_id'] = $item_id;
							$varDataId = $id_variation[$key];

							$this->Cuisine_management->update_item_variations_data($variationData,$varDataId);
						}
					}
					
					

				}

				//variation data end here
				$data['success_msg'] = "Item Edit Successfully done!";


			}

		$data['cat_list'] = $this->Restro_Owner_Model->restro_all_item_category_view();
		$data['itemDetails'] = $this->Restro_Owner_Model->restro_item_details($item_id,$restroOwnerID);
		$data['varData1'] = $this->Cuisine_management->get_item_variation_data($item_id,1);
		$data['varData2'] = $this->Cuisine_management->get_item_variation_data($item_id,2);
		$data['varData3'] = $this->Cuisine_management->get_item_variation_data($item_id,3);


		$this->load->view("Restaurant_Owner/edit_restro_item",$data);

	}

	/*public function restro_add_menu($id){
		$data['errors']=array();
		$userid = $this->tank_auth->get_user_id();
		$data['restro_id']=$this->uri->segment('2');
		

		$data['cat_list'] = $this->Restro_Owner_Model->restro_all_item_category_view();
		
		$this->form_validation->set_rules('item_cat[]', 'Category', 'required');
		
			$query = $this->Restro_Owner_Model->get_my_selected_menu($data['restro_id']);

			$data['slect_val'] = $query['category_id'];

			if ($this->form_validation->run() == FALSE)
			{
				
			}
			else
			{
				$catID =$this->input->post('item_cat');

				foreach($catID as $categoryId)
				{
					$restromenu['category_id'] = $categoryId;
					$restromenu['restro_id'] = $data['restro_id']; 
					$restromenu['user_id'] = $userid;

					$query = $this->Restro_Owner_Model->add_restro_menu($restromenu);
				}
				
			}

		$this->load->view("Restaurant_Owner/restro_add_menu",$data);
	}*/

	public function view_my_restro(){
		$data['errors']=array();
		$restro_id =$this->uri->segment('2');
		$data['restroinfo'] = $this->Restro_Owner_Model->view_my_restro($restro_id);
		
		$this->load->view("Restaurant_Owner/view_my_restro",$data);
	}

	public function manage_restro_table(){
		
		$data['errors']=array();
        $restro_id =$this->uri->segment('2');
		$location_id =$this->uri->segment('3');
		$user_id = $this->tank_auth->get_user_id();
		$data['restrotables'] = $this->Restro_Owner_Model->restro_tables_by_location($location_id); 
		$data['Locations'] = $this->Restaurant_management->get_all_owner_location($user_id);


		if(isset($_POST['btnsavetable']))
		{	
			$this->form_validation->set_rules('table_no', 'Table No. / Name', 'required');
			$this->form_validation->set_rules('user_limit', 'User Limit', 'required');
			$this->form_validation->set_rules('status', 'Table Status', 'required');
			//$this->form_validation->set_rules('price', 'Table Price', 'required');
			//$this->form_validation->set_rules('location_id', 'Location', 'required');
			

			if ($this->form_validation->run() == FALSE)
			{
				
			}
			else
			{
				$table['restro_id']=$restro_id;
				$table['table_no']=$this->input->post('table_no');
				$table['user_limit']=$this->input->post('user_limit');
				$table['status']=$this->input->post('status');
				//$table['price']=$this->input->post('price');
				$table['description']=$this->input->post('description');
				$table['location_id']=$location_id ;
				$table['user_id']=$user_id;


				$this->Restro_Owner_Model->add_restro_table($table);
			}

			redirect('/manage_restro_table/'.$restro_id.'/'.$location_id);
		}

		if(isset($_POST['btnEditTable']))
		{
			$this->form_validation->set_rules('table_no', 'Table No. / Name', 'required');
			$this->form_validation->set_rules('user_limit', 'User Limit', 'required');
			$this->form_validation->set_rules('status', 'Table Status', 'required');
			$this->form_validation->set_rules('tbleID', 'Table ID', 'required');
			//$this->form_validation->set_rules('price', 'Table Price', 'required');
			//$this->form_validation->set_rules('location_id', 'Location', 'required');

			if ($this->form_validation->run() == FALSE)
			{
				
			}
			else
			{  			
				$table_id = $this->input->post('tbleID');
				$table['table_no']=$this->input->post('table_no');
				$table['user_limit']=$this->input->post('user_limit');
				$table['status']=$this->input->post('status');
				//$table['price']=$this->input->post('price');
				$table['description']=$this->input->post('description');
                $table['location_id']=$location_id;
				$table['restro_id']=$restro_id;
				$table['user_id']=$user_id;

				$this->Restro_Owner_Model->edit_restro_table($table,$table_id,$restro_id);

				redirect('/manage_restro_table/'.$restro_id.'/'.$location_id);
			}
		}
		$this->load->view("Restaurant_Owner/manage_restro_table",$data);
	}

	public function ajax_edit_restro_table(){
		 $restro_id =$this->uri->segment('2');

		 $table_id =$this->uri->segment('3');
		 $user_id = $this->tank_auth->get_user_id();

		 $table['Locations'] = $this->Restaurant_management->get_all_owner_location($user_id);
		 $table['tableinfo'] = $this->Restro_Owner_Model->restro_table_details($table_id,$restro_id);

		 $this->load->view("Restaurant_Owner/ajax_edit_restro_table",$table);

	}

	public function restro_tables_booking(){
		 $restro_id =$this->uri->segment('2');

		 $table_id =$this->uri->segment('3');

		 $table['tablebooking'] = $this->Restro_Owner_Model->restro_tables_booking($table_id,$restro_id);
		 
		 $this->load->view("Restaurant_Owner/restro_tables_booking",$table);
	}
	public function tables_booking(){
		 $restro_id =$this->uri->segment('2');

		 $table_id =$this->uri->segment('3');

		 $table['tablebooking'] = $this->Restro_Owner_Model->restro_tables_booking($table_id,$restro_id);
		 
		 $this->load->view("Administration/table_booking",$table);
	}

	public function restro_delivery_order(){
		$data['errors']=array();
		$user_id = $this->tank_auth->get_user_id();
		$data['order'] = $this->Restro_Owner_Model->all_delivery_restro_order_pending($user_id);

        $data = array_merge($data, $this->getOrderInfo());
		$this->load->view("Restaurant_Owner/restro_delivery_order",$data);
	}
	public function restro_reservation_order(){
		$data['errors']=array();
		$user_id = $this->tank_auth->get_user_id();
		$data['order'] = $this->Restro_Owner_Model->all_reservation_restro_order_pendding($user_id);
        $data = array_merge($data, $this->getOrderInfo());
		$this->load->view("Restaurant_Owner/restro_reservation_order",$data);
	}
	public function restro_pickup_order(){
		$data['errors']=array();
		$user_id = $this->tank_auth->get_user_id();
		$data['order'] = $this->Restro_Owner_Model->all_pickup_restro_order_pendding($user_id);
		$data = array_merge($data, $this->getOrderInfo());
		$this->load->view("Restaurant_Owner/restro_pickup_order",$data);
	}
	public function restro_catering_order(){
		$data['errors']=array();
		$user_id = $this->tank_auth->get_user_id();
		$data['order'] = $this->Restro_Owner_Model->all_catering_restro_order_pendding($user_id);
		$data = array_merge($data, $this->getOrderInfo());
		$this->load->view("Restaurant_Owner/restro_catering_order",$data);
	}

	public function restro_delivery_order_view($orderid){
		$data['errors']=array();
		$user_id = $this->tank_auth->get_user_id();
		$orderid = $this->uri->segment('2');

		if(isset($_POST['updatestatus']))
		{
				$status['status']= $this->input->post('status');
				$status['reject_reson']=$this->input->post('reject_reson');

				$this->Restro_Owner_Model->order_status_change($status,$orderid);
		}

		$data['orderdata'] = $this->Restro_Owner_Model->view_delivery_restro_order($orderid,$user_id);
		$data['orderdetails'] = $this->Restro_Owner_Model->restro_delivery_order_details($orderid);
		$this->load->view("Restaurant_Owner/restro_delivery_order_details",$data);
	}



	public function restro_catering_order_view($orderid){
		$data['errors']=array();
		$user_id = $this->tank_auth->get_user_id();
		$orderid = $this->uri->segment('2');

		if(isset($_POST['updatestatus']))
		{
				$status['status']= $this->input->post('status');
				$status['reject_reson']=$this->input->post('reject_reson');

				$this->Restro_Owner_Model->catering_order_status_change($status,$orderid);
		}

		$data['orderdata'] = $this->Restro_Owner_Model->view_catering_restro_order($orderid,$user_id);
		$data['orderdetails'] = $this->Restro_Owner_Model->restro_catering_order_details($orderid);
		$this->load->view("Restaurant_Owner/restro_catering_order_details",$data);
	} 

	public function restro_reservation_order_view($orderid){
		$data['errors']=array();
		$user_id = $this->tank_auth->get_user_id();
		$orderid = $this->uri->segment('2');

		if(isset($_POST['updatestatus']))
		{
				$status['status']= $this->input->post('status');
				$status['reject_reson']=$this->input->post('reject_reson');

				$this->Restro_Owner_Model->reservation_order_status_change($status,$orderid);
		}

		$data['orderdata'] = $this->Restro_Owner_Model->view_reservation_restro_order($orderid,$user_id);
		$data['orderdetails'] = $this->Restro_Owner_Model->restro_reservation_order_details($orderid);
		$this->load->view("Restaurant_Owner/restro_reservation_order_details",$data);
	}

 

    public function restro_pickup_order_view($orderid){
		$data['errors']=array();
		$user_id = $this->tank_auth->get_user_id();
		$orderid = $this->uri->segment('2');

		if(isset($_POST['updatestatus']))
		{
				$status['status']= $this->input->post('status');
				$status['reject_reson']=$this->input->post('reject_reson');

				$this->Restro_Owner_Model->pickup_order_status_change($status,$orderid);
		}

		$data['orderdata'] = $this->Restro_Owner_Model->view_pickup_restro_order($orderid,$user_id);
		$data['orderdetails'] = $this->Restro_Owner_Model->restro_pickup_order_details($orderid);
		$this->load->view("Restaurant_Owner/restro_pickup_order_details",$data);
	}

	public function delete_my_item_cat(){
		$data['errors']=array();
		$user_id = $this->tank_auth->get_user_id();
		$categoryid = $this->uri->segment('2');

		$this->Restro_Owner_Model->delete_my_item_cat($categoryid,$user_id);
		redirect('/restro_item_category_list/');
	}

	public function delete_my_item(){
		$data['errors']=array();
		$user_id = $this->tank_auth->get_user_id();
		$itemid = $this->uri->segment('2');

		$this->Restro_Owner_Model->delete_my_item($itemid,$user_id);
		redirect('/restro_item_list/');
	}

	public function my_serviec_setup(){
		$data['errors']=array();
		$user_id = $this->tank_auth->get_user_id();
		$restroid = $this->uri->segment('2');
		$location_id = $this->uri->segment('3');
		

		if(isset($_POST['btnsave']))
		{
			$this->form_validation->set_rules('min_order', 'Min. Order', 'required');
			//$this->form_validation->set_rules('order_delivery_time', 'Order Time', 'required');
			//$this->form_validation->set_rules('delivery_charges', 'Delivery Charges', 'required');

			if ($this->form_validation->run() == FALSE)
			{
				
			}
			else
			{
			
				
				
				//$this->Restro_Owner_Model->updaterestro_setup($restroinfo,$restroid);

				/*$payments =$this->input->post('payment');
				
				$this->Restro_Owner_Model->delete_restro_payMethod($restroid,$user_id);
				foreach($payments as $paymentsAR)
				{
					$pMethod['user_id'] = $user_id;
					$pMethod['restro_id'] = $restroid;
					$pMethod['method_type'] = $paymentsAR;

					$this->Restro_Owner_Model->insert_restro_payMethod($pMethod);
				}*/

				

				$work['monday_status']=$this->input->post('monday');
				$work['monday_from']=$this->input->post('monday_from');
				$work['monday_to']=$this->input->post('monday_to');

				$work['tuesday_status']=$this->input->post('tuesday');
				$work['tuesday_from']=$this->input->post('tuesday_from');
				$work['tuesday_to']=$this->input->post('tuesday_to');

				$work['wednesday_status']=$this->input->post('wednesday');
				$work['wednesday_from']=$this->input->post('wednesday_from');
				$work['wednesday_to']=$this->input->post('wednesday_to');

				$work['thursday_status']=$this->input->post('thursday');
				$work['thursday_from']=$this->input->post('thursday_from');
				$work['thursday_to']=$this->input->post('thursday_to'); 

				$work['friday_status']=$this->input->post('friday');
				$work['friday_from']=$this->input->post('friday_from');
				$work['friday_to']=$this->input->post('friday_to');

				$work['saturday_status']=$this->input->post('saturday');
				$work['saturday_from']=$this->input->post('saturday_from');
				$work['saturday_to']=$this->input->post('saturday_to');

				$work['sunday_status']=$this->input->post('sunday');
				$work['sunday_from']=$this->input->post('sunday_from');
				$work['sunday_to']=$this->input->post('sunday_to');

				$work['user_id']= $user_id;

				$work['min_order']=$this->input->post('min_order');
				$work['order_time']=$this->input->post('order_delivery_time');
				$work['delivery_charges']=$this->input->post('delivery_charges'); 

				$work['order_days']=$this->input->post('dordert_days');
				$work['order_hour']=$this->input->post('dordert_hour');
				$work['order_minitue']=$this->input->post('dordert_minitue');
				$work['order_second']=$this->input->post('dordert_second'); 
				
				

				$this->Restro_Owner_Model->update_restro_working($work,$restroid,1,$location_id);
			}
		}

		//$data['restrodata'] = $this->Restro_Owner_Model->view_my_restro($restroid);
		$data['restroWork'] = $this->Restro_Owner_Model->view_my_restro_working($restroid,1,$location_id);

		//$this->Restro_Owner_Model->delete_my_item($itemid,$user_id);
		$this->load->view("Restaurant_Owner/my_service_setup",$data);
	}

	public function ServiceSetupCatering(){
		$data['errors']=array();
		$user_id = $this->tank_auth->get_user_id();
		$restroid = $this->uri->segment('2');
		$location_id = $this->uri->segment('3');

		if(isset($_POST['btnsave']))
		{
			$this->form_validation->set_rules('min_order', 'Min. Order', 'required');
			//$this->form_validation->set_rules('order_delivery_time', 'Order Time', 'required');
			//$this->form_validation->set_rules('delivery_charges', 'Delivery Charges', 'required');

			if ($this->form_validation->run() == FALSE)
			{
				
			}
			else
			{
			
				
				
				//$this->Restro_Owner_Model->updaterestro_setup($restroinfo,$restroid);

				/*$payments =$this->input->post('payment');
				
				$this->Restro_Owner_Model->delete_restro_payMethod($restroid,$user_id);
				foreach($payments as $paymentsAR)
				{
					$pMethod['user_id'] = $user_id;
					$pMethod['restro_id'] = $restroid;
					$pMethod['method_type'] = $paymentsAR;

					$this->Restro_Owner_Model->insert_restro_payMethod($pMethod);
				}*/

				$work['monday_status']=$this->input->post('monday');
				$work['monday_from']=$this->input->post('monday_from');
				$work['monday_to']=$this->input->post('monday_to');

				$work['tuesday_status']=$this->input->post('tuesday');
				$work['tuesday_from']=$this->input->post('tuesday_from');
				$work['tuesday_to']=$this->input->post('tuesday_to');

				$work['wednesday_status']=$this->input->post('wednesday');
				$work['wednesday_from']=$this->input->post('wednesday_from');
				$work['wednesday_to']=$this->input->post('wednesday_to');

				$work['thursday_status']=$this->input->post('thursday');
				$work['thursday_from']=$this->input->post('thursday_from');
				$work['thursday_to']=$this->input->post('thursday_to'); 

				$work['friday_status']=$this->input->post('friday');
				$work['friday_from']=$this->input->post('friday_from');
				$work['friday_to']=$this->input->post('friday_to');

				$work['saturday_status']=$this->input->post('saturday');
				$work['saturday_from']=$this->input->post('saturday_from');
				$work['saturday_to']=$this->input->post('saturday_to');

				$work['sunday_status']=$this->input->post('sunday');
				$work['sunday_from']=$this->input->post('sunday_from');
				$work['sunday_to']=$this->input->post('sunday_to');

				$work['user_id']= $user_id;

				$work['min_order']=$this->input->post('min_order');
				$work['order_time']=$this->input->post('order_delivery_time');
				$work['delivery_charges']=$this->input->post('delivery_charges');

				$work['order_days']=$this->input->post('dordert_days');
				$work['order_hour']=$this->input->post('dordert_hour');
				$work['order_minitue']=$this->input->post('dordert_minitue');
				$work['order_second']=$this->input->post('dordert_second'); 
				

				

				$this->Restro_Owner_Model->update_restro_working($work,$restroid,2,$location_id);
			}
		}


		$data['restroWork'] = $this->Restro_Owner_Model->view_my_restro_working($restroid,2,$location_id);
		$this->load->view("Restaurant_Owner/ServiceSetupCatering",$data);
	}

	public function ServiceSetupReservation(){
		$data['errors']=array();
		$user_id = $this->tank_auth->get_user_id();
		$restroid = $this->uri->segment('2');
		$location_id = $this->uri->segment('3');

		if(isset($_POST['btnsave']))
		{
			
				$work['monday_status']=$this->input->post('monday');
				$work['monday_from']=$this->input->post('monday_from');
				$work['monday_to']=$this->input->post('monday_to');

				$work['tuesday_status']=$this->input->post('tuesday');
				$work['tuesday_from']=$this->input->post('tuesday_from');
				$work['tuesday_to']=$this->input->post('tuesday_to');

				$work['wednesday_status']=$this->input->post('wednesday');
				$work['wednesday_from']=$this->input->post('wednesday_from');
				$work['wednesday_to']=$this->input->post('wednesday_to');

				$work['thursday_status']=$this->input->post('thursday');
				$work['thursday_from']=$this->input->post('thursday_from');
				$work['thursday_to']=$this->input->post('thursday_to'); 

				$work['friday_status']=$this->input->post('friday');
				$work['friday_from']=$this->input->post('friday_from');
				$work['friday_to']=$this->input->post('friday_to');

				$work['saturday_status']=$this->input->post('saturday');
				$work['saturday_from']=$this->input->post('saturday_from');
				$work['saturday_to']=$this->input->post('saturday_to');

				$work['sunday_status']=$this->input->post('sunday');
				$work['sunday_from']=$this->input->post('sunday_from');
				$work['sunday_to']=$this->input->post('sunday_to');

				$work['happy_from']=$this->input->post('happy_from');
				$work['happy_to']=$this->input->post('happy_to');

				$work['user_id']= $user_id;


				$this->Restro_Owner_Model->update_restro_working($work,$restroid,3,$location_id);
			
		}


		$data['restroWork'] = $this->Restro_Owner_Model->view_my_restro_working($restroid,3,$location_id);
		$this->load->view("Restaurant_Owner/ServiceSetupReservation",$data);
	}

	public function ServiceSetupPickup(){
		$data['errors']=array();
		$user_id = $this->tank_auth->get_user_id();
		$restroid = $this->uri->segment('2');
		$location_id = $this->uri->segment('3');

		if(isset($_POST['btnsave']))
		{
			//$this->form_validation->set_rules('order_delivery_time', 'Order Time', 'required');
			
			/*if ($this->form_validation->run() == FALSE)
			{
				
			}
			else
			{*/
			
				
				
				//$this->Restro_Owner_Model->updaterestro_setup($restroinfo,$restroid);

				/*$payments =$this->input->post('payment');
				
				$this->Restro_Owner_Model->delete_restro_payMethod($restroid,$user_id);
				foreach($payments as $paymentsAR)
				{
					$pMethod['user_id'] = $user_id;
					$pMethod['restro_id'] = $restroid;
					$pMethod['method_type'] = $paymentsAR;

					$this->Restro_Owner_Model->insert_restro_payMethod($pMethod);
				}*/

				$work['monday_status']=$this->input->post('monday');
				$work['monday_from']=$this->input->post('monday_from');
				$work['monday_to']=$this->input->post('monday_to');

				$work['tuesday_status']=$this->input->post('tuesday');
				$work['tuesday_from']=$this->input->post('tuesday_from');
				$work['tuesday_to']=$this->input->post('tuesday_to');

				$work['wednesday_status']=$this->input->post('wednesday');
				$work['wednesday_from']=$this->input->post('wednesday_from');
				$work['wednesday_to']=$this->input->post('wednesday_to');

				$work['thursday_status']=$this->input->post('thursday');
				$work['thursday_from']=$this->input->post('thursday_from');
				$work['thursday_to']=$this->input->post('thursday_to'); 

				$work['friday_status']=$this->input->post('friday');
				$work['friday_from']=$this->input->post('friday_from');
				$work['friday_to']=$this->input->post('friday_to');

				$work['saturday_status']=$this->input->post('saturday');
				$work['saturday_from']=$this->input->post('saturday_from');
				$work['saturday_to']=$this->input->post('saturday_to');

				$work['sunday_status']=$this->input->post('sunday');
				$work['sunday_from']=$this->input->post('sunday_from');
				$work['sunday_to']=$this->input->post('sunday_to');

				$work['user_id']= $user_id;

				$work['order_time']=$this->input->post('order_delivery_time');


				$work['order_days']=$this->input->post('dordert_days');
				$work['order_hour']=$this->input->post('dordert_hour');
				$work['order_minitue']=$this->input->post('dordert_minitue');
				$work['order_second']=$this->input->post('dordert_second'); 
				

				$this->Restro_Owner_Model->update_restro_working($work,$restroid,4,$location_id);
			//}
		}


		$data['restroWork'] = $this->Restro_Owner_Model->view_my_restro_working($restroid,4,$location_id);
		$this->load->view("Restaurant_Owner/ServiceSetupPickup",$data);

	}
 	public function ajax_cuisine_add(){
 		$data['errors']=array();
 		$user_id = $this->tank_auth->get_user_id();
 		$cuisinedata['name']=$this->input->post('cName');
 		$cuisinedata['status']=1;
 		$cuisinedata['user_id']=$this->input->post('userid');
 		$cuisinedata['admin_id']=$this->input->post('adminid'); 
 		$cuisinedata['cuisine_description']=$this->input->post('cuisine_desc');
 		
 		$this->Restro_Owner_Model->add_restro_cuisine($cuisinedata);

 		$data['cuisin'] = $this->Restro_Owner_Model->view_all_cuisin();
 		$this->load->view("Restaurant_Owner/ajax_cuisine_add",$data);
 	}

	
   public function restro_item_category_show(){
    	$data['errors']=array();

	$user_id = $this->tank_auth->get_user_id();
	$data['Locations'] = $this->Restaurant_management->get_all_owner_location($user_id);
		
	$data['category']=$this->Cuisine_management->owner_all_item_category($user_id);
	
	

    	$this->load->view("Restaurant_Owner/restro_item_category_show",$data);

    }
    
    
 	public function restro_item_category_setup(){
 		$data['errors']=array();
		$user_id = $this->tank_auth->get_user_id();
		$data['Locations'] = $this->Restaurant_management->get_all_owner_location($user_id);
		
		if(isset($_POST['btncategory']))
		{
			
			$this->form_validation->set_rules('item_category', 'Item Category', 'required');
			$this->form_validation->set_rules('location_id', 'Location', 'required');
			$this->form_validation->set_rules('service_id', 'Service', 'required');

			if ($this->form_validation->run() == FALSE)
			{
				
			}
			else
			{
						       
			                    $category['cat_name']=$this->input->post('item_category');
			                    $category['user_id']= $this->tank_auth->get_user_id();
					    $category['location_id']=$this->input->post('location_id');
					    $category['service_id']=$this->input->post('service_id');

			                    $insert_ID = $this->Cuisine_management->add_item_category($category);
					    
					 $menuData['category_id'] = $insert_ID;
			                 $menuData['user_id'] = $user_id;
			                 $menuData['location_id'] = $this->input->post('location_id');
			                 $menuData['service_id'] = $this->input->post('service_id');


			                 $this->Cuisine_management->add_item_menu($menuData);
					 
					 $data['success_msg'] = "Item Category Added Successfully done!";
			}
		}
		$data['category']=$this->Cuisine_management->all_item_category();

		$this->load->view("Restaurant_Owner/restro_item_category_setup",$data);
 	}



 	public function restro_item_category_edit(){
 		$data['errors']=array();
		$user_id = $this->tank_auth->get_user_id();
		$data['Locations'] = $this->Restaurant_management->get_all_owner_location($user_id);

		$category_id = $this->uri->segment("2");

		$data['cusineData'] = $this->Cuisine_management->get_item_category_data($category_id);
		
		if(isset($_POST['btncategory']))
		{
			
			$this->form_validation->set_rules('item_category', 'Item Category', 'required');
			$this->form_validation->set_rules('location_id', 'Location', 'required');
			$this->form_validation->set_rules('service_id', 'Service', 'required');

			if ($this->form_validation->run() == FALSE)
			{
				
			}
			else
			{
						       
			                    $category['cat_name']=$this->input->post('item_category');
			                    $category['location_id']=$this->input->post('location_id');
					            $category['service_id']=$this->input->post('service_id');

			                    $this->Cuisine_management->edit_item_category($category,$category_id);
					    
					 
			                 $menuData['user_id'] = $user_id;
			                 $menuData['location_id'] = $this->input->post('location_id');
			                 $menuData['service_id'] = $this->input->post('service_id');

			                 $this->Cuisine_management->edit_item_menu($menuData,$category_id);

			                 
					 
					 $data['success_msg'] = "Item Category Added Successfully done!";
			}
		}
		$data['category']=$this->Cuisine_management->all_item_category();

		$this->load->view("Restaurant_Owner/restro_item_category_edit",$data);
 	}


 	public function restro_delete_item_category($id){
		$data['errors']=array();

		 $category = $this->uri->segment("2");
		 if($category != ''){
		 		$this->Cuisine_management->delete_item_category($category);
		 		redirect('/restro_item_category_setup/');
		 }
	}



	public function restro_delivery_notification(){
		$data['errors']=array();
		$user_id = $this->tank_auth->get_user_id();
		$data['showStatus'] = 0;
		//$data['order'] = $this->Order_Management->delivery_orders();
		$data['restro_id'] = '';
     	$data['location_id'] = '';
		
     	$data['Locations'] = $this->Restaurant_management->get_all_owner_location($user_id);

     	if(isset($_POST['btnsearch']))
     	{
     		$data['showStatus'] = 1;
     		$location_id = $this->input->post('location_id');

     		$data['servicedata'] = $this->Order_Management->restro_get_order_service_list($location_id);

     		$data['location_id'] = $location_id;
     		

     		$data['order'] = $this->Restro_Owner_Model->all_delivery_restro_order_filter($user_id,$location_id);
     		

     	}
     	else
     	{
     		$data['order'] = $this->Restro_Owner_Model->all_delivery_restro_order($user_id);
     	}



		

		$this->load->view("Restaurant_Owner/restro_delivery_notification",$data);
	}
	public function restro_reservation_notification(){
		$data['errors']=array();
		$user_id = $this->tank_auth->get_user_id();

		$data['showStatus'] = 0;
		$data['restro_id'] = '';
     	$data['location_id'] = '';
		
     	$data['Locations'] = $this->Restaurant_management->get_all_owner_location($user_id);

     	if(isset($_POST['btnsearch']))
     	{
     		$data['showStatus'] = 1;
     		$location_id = $this->input->post('location_id');

     		$data['servicedata'] = $this->Order_Management->restro_get_order_service_list($location_id);

     		$data['location_id'] = $location_id;
     		

     		$data['order'] = $this->Restro_Owner_Model->all_reservation_restro_order_filter($user_id,$location_id);
     		

     	}
     	else
     	{
     		$data['order'] = $this->Restro_Owner_Model->all_reservation_restro_order($user_id);
     	}


		

		

		$this->load->view("Restaurant_Owner/restro_reservation_notification",$data);
	}
	public function restro_pickup_notification(){
		$data['errors']=array();
		$user_id = $this->tank_auth->get_user_id();

		$data['showStatus'] = 0;
		$data['restro_id'] = '';
     	$data['location_id'] = '';
		
     	$data['Locations'] = $this->Restaurant_management->get_all_owner_location($user_id);

     	if(isset($_POST['btnsearch']))
     	{
     		$data['showStatus'] = 1;
     		$location_id = $this->input->post('location_id');

     		$data['servicedata'] = $this->Order_Management->restro_get_order_service_list($location_id);

     		$data['location_id'] = $location_id;
     		

     		$data['order'] = $this->Restro_Owner_Model->all_pickup_restro_order_filter($user_id,$location_id);
     		

     	}
     	else
     	{
     		$data['order'] = $this->Restro_Owner_Model->all_pickup_restro_order($user_id);
     	}

		
		$this->load->view("Restaurant_Owner/restro_pickup_notification",$data);
	}
	public function restro_catering_notification(){
		$data['errors']=array();
		$user_id = $this->tank_auth->get_user_id();

		$data['showStatus'] = 0;
		//$data['order'] = $this->Order_Management->delivery_orders();
		$data['restro_id'] = '';
     	$data['location_id'] = '';
		
     	$data['Locations'] = $this->Restaurant_management->get_all_owner_location($user_id);

     	if(isset($_POST['btnsearch']))
     	{
     		$data['showStatus'] = 1;
     		$location_id = $this->input->post('location_id');

     		$data['servicedata'] = $this->Order_Management->restro_get_order_service_list($location_id);

     		$data['location_id'] = $location_id;
     		

     		$data['order'] = $this->Restro_Owner_Model->all_catering_restro_order_filter($user_id,$location_id);
     		

     	}
     	else
     	{
     		$data['order'] = $this->Restro_Owner_Model->all_catering_restro_order($user_id);
     	}

		

		
		
		$this->load->view("Restaurant_Owner/restro_catering_notification",$data);
	}

	public function status_change_table_details(){
		$data['errors']=array();
		$id = $this->input->post('order_detail_id');
		$mobileNumber = $this->input->post('mobile');
		$booking_date = $this->input->post('booking_date');
		$booking_time = $this->input->post('booking_time');
		
		$UpdateData['status'] = 1;
		if($this->Restro_Owner_Model->status_change_table_details($UpdateData,$id))
		{
			echo "yes";

			// msg send here

			   $orderNumber = $updatedata['order_no'];
			   $SmsData = $this->Customer_management->getSmsMessage(6);
			   $messageData = $SmsData['message'];
			   $messageData = str_replace("{TableNo}",$id,$messageData);
			   $messageData = str_replace("{BookingDate}",$booking_date,$messageData);
			   $messageData = str_replace("{BookingTime}",$booking_time,$messageData);

			   $otpMSG =urlencode($messageData);
			  	
			   $apiData = $this->Customer_management->getApiDetails(1);

			   $usernameApi = $apiData['username'];
			   $usernamePass = $apiData['password'];
			   $mobilenumber = @$mobileNumber;
			   $usernameSource = $apiData['username_source'];

			   $url = file_get_contents("http://103.16.101.52/sendsms/bulksms?username=$usernameApi&password=$usernamePass&destination=$mobilenumber&source=$usernameSource&message=$otpMSG");  
			   

			// msg send here

		}
	}
    
    function getOrderInfo() {
        $ownerId =$this->tank_auth->get_user_id();
        
        $restaurants = $this->RestaurantModel->findByOwnerId($ownerId);
        
        $restroIds = array();
        foreach($restaurants as $restro) {
            $restroIds[] = $restro->id;
        }
        
        $delivery_orders = $this->OrderModel->find(1, array('restro_ids'=>$restroIds, 'date'=>date('Y-m-d')));
        $delivery_amount = 0;
        foreach($delivery_orders as $order) {
            $delivery_amount += $order->total;
        }
        $data['delivery_info'] = array(
            "today_amount"=>$delivery_amount,
            "today_orders"=>count($delivery_orders),
            "completed_percentage"=>$this->OrderModel->getCompletedPercentage(1 ,array('restro_ids'=>$restroIds))
        );
        
        $catering_orders = $this->OrderModel->find(2, array('restro_ids'=>$restroIds, 'date'=>date('Y-m-d')));
        $catering_amount = 0;
        foreach($catering_orders as $order) {
            $catering_amount += $order->total;
        }
        $data['catering_info'] = array(
            "today_amount"=>$catering_amount,
            "today_orders"=>count($catering_orders),
            "completed_percentage"=>$this->OrderModel->getCompletedPercentage(2 ,array('restro_ids'=>$restroIds))
        );
        
        $reservation_orders = $this->RestroTableOrderModel->find(array('restro_ids'=>$restroIds, 'date'=>date('Y-m-d')));
        $data['reservation_info'] = array(
            "today_amount"=>2500,
            "today_orders"=>count($reservation_orders),
            "completed_percentage"=>$this->RestroTableOrderModel->getCompletedPercentage(array('restro_ids'=>$restroIds))
        );
        
        $pickup_orders = $this->OrderModel->find(4, array('restro_ids'=>$restroIds, 'date'=>date('Y-m-d')));
        $pickup_amount = 0;
        foreach($pickup_orders as $order) {
            $pickup_amount += $order->total;
        }
        $data['pickup_info'] = array(
            "today_amount"=>$pickup_amount,
            "today_orders"=>count($pickup_orders),
            "completed_percentage"=>$this->OrderModel->getCompletedPercentage(4 ,array('restro_ids'=>$restroIds))
        );
        
        return $data;
    }

}
?>