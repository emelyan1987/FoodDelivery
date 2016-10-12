<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
@ob_start();
class Cuisine extends CI_Controller
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
		$this->load->model("Administration/Cuisine_management"); 
        $this->load->model("Restaurant_Owner/Restro_Owner_Model");
        $this->load->model("Administration/Restaurant_management");
		
	}

	public function index()
	{
		
		
	}
	public function cuisine_setup(){
		$data['errors']=array();

		if(isset($_POST['btncuisine']))
		{
			$this->form_validation->set_rules('cuisineName', 'Cuisine Name', 'required');

			if ($this->form_validation->run() == FALSE)
			{
				
			}
			else
			{
						       
			                    $cuisine['name']=$this->input->post('cuisineName');
			                    $cuisine['admin_id']= $this->tank_auth->get_user_id();

			                    $this->Cuisine_management->add_cuisine($cuisine);
			}

		}

		if(isset($_POST['btnfood']))
		{
			$this->form_validation->set_rules('foodtype', 'Food Type', 'required');
			if ($this->form_validation->run() == FALSE)
			{
				
			}
			else
			{
						       
			                    $food['food_title']=$this->input->post('foodtype');
			                    $food['admin_id']= $this->tank_auth->get_user_id();

			                    $this->Cuisine_management->add_foodtype($food);
			}

		} 

		if(isset($_POST['btncat']))
		{
			$this->form_validation->set_rules('category', 'Category', 'required');
			if ($this->form_validation->run() == FALSE)
			{
				
			}
			else
			{
						       
			                    $category['name']=$this->input->post('category');
			                    $category['admin_id']= $this->tank_auth->get_user_id();

			                    $this->Cuisine_management->add_seo_category($category);
			}

		}


		$data['cuisine_list']=$this->Cuisine_management->all_cuisine();
		$data['foodtype']=$this->Cuisine_management->all_foodtype();
		$data['seocategory']=$this->Cuisine_management->all_seocategory();
		$this->load->view("Administration/cuisine_setup",$data);
	}

	public function delete_cuisine($id){
		$data['errors']=array();

		 $cuisine_id = $this->uri->segment("2");
		 if($cuisine_id != ''){
		 		$this->Cuisine_management->delete_cuisine($cuisine_id);
		 		redirect('/cuisine_setup/');
		 }

	}
	public function delete_foodtype($id){
		$data['errors']=array();

		 $foodtype = $this->uri->segment("2");
		 if($foodtype != ''){
		 		$this->Cuisine_management->delete_foodtype($foodtype);
		 		redirect('/cuisine_setup/');
		 }

	}
	public function delete_seo_category($id){
		$data['errors']=array();

		 $category = $this->uri->segment("2");
		 if($category != ''){
		 		$this->Cuisine_management->delete_seo_category($category);
		 		redirect('/cuisine_setup/');
		 }

	}

    public function item_category_show(){
    	$data['errors']=array();

	$data['owner_code_list']=$this->Restaurant_management->get_owner_code_list();
		$data['category']=$this->Cuisine_management->all_item_category();

    	$this->load->view("Administration/item_category_show",$data);

    }
	public function item_category_setup(){
		$data['errors']=array();

		$data['owner_code_list']=$this->Restaurant_management->get_owner_code_list();

		if(isset($_POST['btncategory']))
		{
			
			$this->form_validation->set_rules('item_category', 'Item Category', 'required');
			$this->form_validation->set_rules('owner_id', 'Owner Code', 'required');
			$this->form_validation->set_rules('location_id', 'Location', 'required');
			$this->form_validation->set_rules('service_id', 'Service', 'required'); 
			if ($this->form_validation->run() == FALSE)
			{
				
			}
			else
			{
						       
			                    $category['cat_name']=$this->input->post('item_category');
			                    $category['admin_id']= $this->tank_auth->get_user_id();
			                    $category['user_id']=$this->input->post('owner_id');
			                    $category['location_id']=$this->input->post('location_id');
			                    $category['service_id']=$this->input->post('service_id');

			                 $category_id = $this->Cuisine_management->add_item_category($category);

			                 $menuData['category_id'] = $category_id;
			                 $menuData['user_id'] = $this->input->post('owner_id');
			                 $menuData['location_id'] = $this->input->post('location_id');
			                 $menuData['service_id'] = $this->input->post('service_id');


			                 $this->Cuisine_management->add_item_menu($menuData);

			                 $data['success_msg'] = "Item Category Added Successfully done!";
			}
		}
		//$data['category']=$this->Cuisine_management->all_item_category();

		$this->load->view("Administration/item_category_setup",$data);
	}

	public function edit_item_category(){
		$data['errors']=array();

		$data['owner_code_list']=$this->Restaurant_management->get_owner_code_list();
		$category_id = $this->uri->segment("2");

		$data['cusineData'] = $this->Cuisine_management->get_item_category_data($category_id);

		if(isset($_POST['btncategory']))
		{
			
			$this->form_validation->set_rules('item_category', 'Item Category', 'required');
			$this->form_validation->set_rules('owner_id', 'Owner Code', 'required');
			$this->form_validation->set_rules('location_id', 'Location', 'required');
			$this->form_validation->set_rules('service_id', 'Service', 'required'); 
			if ($this->form_validation->run() == FALSE)
			{
				
			}
			else
			{
						       
			                    $category['cat_name']=$this->input->post('item_category');
			                    $category['admin_id']= $this->tank_auth->get_user_id();
			                    $category['user_id']=$this->input->post('owner_id');
			                    $category['location_id']=$this->input->post('location_id');
			                    $category['service_id']=$this->input->post('service_id');

			                 $this->Cuisine_management->edit_item_category($category,$category_id);

			                
			                 $menuData['user_id'] = $this->input->post('owner_id');
			                 $menuData['location_id'] = $this->input->post('location_id');
			                 $menuData['service_id'] = $this->input->post('service_id');


			                 $this->Cuisine_management->edit_item_menu($menuData,$category_id);

			                 $data['success_msg'] = "Item Category Edit Successfully done!";
			}
		}

		$this->load->view("Administration/edit_item_category",$data);
	}

	

	/*public function all_item_category(){
		$data['errors']=array();

		if(isset($_POST['btncategory']))
		{
			
			$this->form_validation->set_rules('item_category', 'Item Category', 'required');
			if ($this->form_validation->run() == FALSE)
			{
				
			}
			else
			{
						       
			                    $category['cat_name']=$this->input->post('item_category');
			                    $category['admin_id']= $this->tank_auth->get_user_id();

			                    $this->Cuisine_management->add_item_category($category);
			}
		}
		$data['category']=$this->Cuisine_management->all_item_category();

		$this->load->view("Administration/all_item_category",$data);
	}
	*/
	public function delete_item_category($id){
		$data['errors']=array();

		 $category = $this->uri->segment("2");
		 if($category != ''){
		 		$this->Cuisine_management->delete_item_category($category);
		 		redirect('/item_category_show/');
		 }
	}

	public function show_item_list(){
		$data['errors']=array();
		$data['item_list']=$this->Cuisine_management->get_all_item_list();

		$data['owner_code_list']=$this->Restaurant_management->get_owner_code_list();

		$this->load->view("Administration/show_item_list",$data);
	}


	public function add_item(){
		$data['errors']=array();

		$data['cat_list'] = $this->Restro_Owner_Model->restro_all_item_category_view();

		$data['owner_code_list']=$this->Restaurant_management->get_owner_code_list();

		
		$this->form_validation->set_rules('item_name', 'Item Name', 'required');
		$this->form_validation->set_rules('item_cat[]', 'Item Category', 'required');
		
		$this->form_validation->set_rules('price_type', 'Price Type', 'required');
		$this->form_validation->set_rules('owner_id', 'Owner Code', 'required');
		$this->form_validation->set_rules('location_id', 'Location', 'required');
		$this->form_validation->set_rules('service_id', 'Service', 'required');

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
				
				$item['item_description']=$this->input->post('item_description');
				$item['status']=$this->input->post('status'); 
				$item['loyalty_points']=$this->input->post('loyalty_points');
				//$item['show_size']=$this->input->post('show_size');
				//$item['show_add_topping']=$this->input->post('show_add_topping');
				//$item['show_remove_topping']=$this->input->post('show_remove_topping');
				//$item['show_spacial_request']=$this->input->post('show_spacial_request');
				$item['variation']=$this->input->post('variation');
				$item['order_point_amount']=$this->input->post('order_point_amount');
				$item['user_id']=$this->input->post('owner_id');
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


				$item['admin_id'] = $this->tank_auth->get_user_id();




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
				$multCat['admin_id'] = $this->tank_auth->get_user_id();
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
                             $data['success_msg']="Item Added Successfully";
			}
		$this->load->view("Administration/add_item",$data);
	}


	public function edit_menu_item($id){
		$data['errors']=array();
		$admin_id =$this->tank_auth->get_user_id();
		$item_id =$this->uri->segment('2');

		$owner_id = $this->Restro_Owner_Model->get_item_owner_id($item_id);
		//$data['cat_list'] = $this->Restro_Owner_Model->restro_all_item_category_admin($owner_id['user_id']);
		$data['itemDetails'] = $this->Cuisine_management->item_details($item_id);
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
			$item['item_price']= 0;
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
			

				$item['admin_id'] = $this->tank_auth->get_user_id();


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
				$multCat['admin_id'] = $this->tank_auth->get_user_id();
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


				redirect('/edit_menu_item/'.$item_id);
			}

		$data['varData1'] = $this->Cuisine_management->get_item_variation_data($item_id,1);
		$data['varData2'] = $this->Cuisine_management->get_item_variation_data($item_id,2);
		$data['varData3'] = $this->Cuisine_management->get_item_variation_data($item_id,3);

		$this->load->view("Administration/edit_menu_item",$data);

	}

	public function delete_item(){
		$data['errors']=array();
		
		$itemid = $this->uri->segment('2');

		$this->Cuisine_management->delete_item($itemid);
		redirect('/show_item_list/');
	}

	public function ajax_add_item_category(){
		$data['errors']=array();
		
		$category['cat_name'] = $this->input->post('cName'); 
		$category['admin_id']= $this->tank_auth->get_user_id();

		$this->Cuisine_management->add_item_category($category);

		$data['item_catlist']=$this->Cuisine_management->all_item_category();

		$this->load->view("Administration/ajax_add_item_category",$data);
		
	} 

	public function ajax_category_add(){
		$data['errors']=array();
		
		$category['name']=$this->input->post('cName');
		$category['admin_id']= $this->input->post('adminid');
		

		$this->Cuisine_management->add_seo_category($category);

		$data['get_seo_category_list']=$this->Cuisine_management->all_seocategory();

		$this->load->view("Restaurant_Owner/ajax_category_add",$data);
		
	}

	public function ajax_get_location_category(){
		$data['errors']=array();
		
		$location = $this->input->post('location');
		$owner_id = $this->input->post('owner_id');
		$service = $this->input->post('service');


		$data['data_list']=$this->Cuisine_management->all_item_category_by_location($location,$owner_id,$service);

		
		$this->load->view("Administration/ajax_get_location_category",$data);
	}
	
	

	public function get_location_service_filter_item(){
		$data['errors']=array();
		
		$location = $this->input->post('location');
		$owner_id = $this->input->post('owner_id');
		$service = $this->input->post('service');


		$data['item_list']=$this->Cuisine_management->get_location_service_filter_item($location,$owner_id,$service);

		
		$this->load->view("Administration/get_location_service_filter_item",$data);
	}
	
	
	public function restro_location_service_filter_item(){
		$data['errors']=array();
		
		$location = $this->input->post('location');
		$owner_id = $this->input->post('owner_id');
		$service = $this->input->post('service');


		$data['item_list']=$this->Cuisine_management->get_location_service_filter_item($location,$owner_id,$service);

		
		$this->load->view("Restaurant_Owner/restro_location_service_filter_item",$data);
	}
	
	
	
	public function get_location_service_filter_category(){
		$data['errors']=array();
		
		$location = $this->input->post('location');
		$owner_id = $this->input->post('owner_id');
		$service = $this->input->post('service');


		$data['category']=$this->Cuisine_management->get_location_service_filter_category($location,$owner_id,$service);

		
		$this->load->view("Administration/get_location_service_filter_category",$data);
	}

	
	
	public function restro_location_service_filter_category(){
		$data['errors']=array();
		
		$location = $this->input->post('location');
		$owner_id = $this->input->post('owner_id');
		$service = $this->input->post('service');


		$data['category']=$this->Cuisine_management->get_location_service_filter_category($location,$owner_id,$service);

		
		$this->load->view("Restaurant_Owner/restro_location_service_filter_category",$data);
	}



	public function restro_location_filter_item_list(){
		$data['errors']=array();
		
		$location = $this->input->post('location');
		$owner_id = $this->input->post('owner_id');
		$service = $this->input->post('service');


		$data['item_list']=$this->Cuisine_management->get_location_service_filter_item($location,$owner_id,$service);

		$this->load->view("Restaurant_Owner/restro_item_option_list",$data);
	}


}
?>