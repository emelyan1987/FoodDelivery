<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
@ob_start();
class Promotion extends CI_Controller
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
		$this->load->model("Administration/Promotion_management"); 
		$this->load->model("Restaurant_Owner/Restro_Owner_Model");
		$this->load->model("Administration/Restaurant_management");
		
	}

	public function index()
	{
		
		
	}
	
	public function add_promotion(){
		$data['errors']=array();
		

		$data['owner_code_list']=$this->Restaurant_management->get_owner_code_list();

		$this->form_validation->set_rules('pro_location', 'Location', 'required');
		$this->form_validation->set_rules('pro_service', 'Service', 'required');
		$this->form_validation->set_rules('owner_id', 'Owner Id', 'required');
		$this->form_validation->set_rules('pro_name', 'Promotion Name', 'required');
		$this->form_validation->set_rules('pro_price', 'Promotion Price', 'required');
		$this->form_validation->set_rules('from_date', 'From Date', 'required');
		$this->form_validation->set_rules('to_date', 'To date', 'required');
		
		
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
			
			$promo['location_id']=$this->input->post('pro_location');
			$promo['service_id']=$this->input->post('pro_service');
			$promo['user_id']=$this->input->post('owner_id');
			$promo['name']=$this->input->post('pro_name');
			$promo['price']=$this->input->post('pro_price');
			$promo['from_date']=$this->input->post('from_date');
			$promo['to_date']=$this->input->post('to_date'); 
			$promo['description']=$this->input->post('pro_description');
			
			$ProId = $this->Promotion_management->add_promotion($promo);
			
			$pro_item_id = $this->input->post('pro_item_id');
			
			$variation_data1 = $this->input->post('variation_data1');
			$variation_data2 = $this->input->post('variation_data2');
			$variation_data3 = $this->input->post('variation_data3');
			$variation_data4 = $this->input->post('variation_data4');
			$variation_data5 = $this->input->post('variation_data5');
			
			$variation_price1 = $this->input->post('variation_price1');
			$variation_price2 = $this->input->post('variation_price2');
			$variation_price3 = $this->input->post('variation_price3');
			$variation_price4 = $this->input->post('variation_price4');
			$variation_price5 = $this->input->post('variation_price5');
			
			
			
			$promo1['promotion_id'] = $ProId;
			
			if($pro_item_id[0] != 0)
			{
				$promo1['item_id'] = $pro_item_id[0];
				$ProDetailId = $this->Promotion_management->add_promotion_detail($promo1);
				
				$pData['promotion_detail_id'] = $ProDetailId;
				$pData['item_id'] = $pro_item_id[0]; 
				$pData['promotion_id'] = $ProId;
				
				foreach($variation_data1 as $vD => $vDa):
				$pData['variation_id'] = $vDa;
				$pData['quantity'] = $variation_price1[$vD];
				
				$this->Promotion_management->add_promotion_variation($pData);
				endforeach;
				
			}
			
			if($pro_item_id[1] != 0)
			{
				$promo1['item_id'] = $pro_item_id[1];
				$ProDetailId = $this->Promotion_management->add_promotion_detail($promo1);
				
				$pData['promotion_detail_id'] = $ProDetailId;
				$pData['item_id'] = $pro_item_id[1]; 
				$pData['promotion_id'] = $ProId;
				
				foreach($variation_data2 as $vD => $vDa):
				$pData['variation_id'] = $vDa;
				$pData['quantity'] = $variation_price2[$vD];
				
				$this->Promotion_management->add_promotion_variation($pData);
				endforeach;
				
			}
			
			if($pro_item_id[2] != 0)
			{
				$promo1['item_id'] = $pro_item_id[2];
				$ProDetailId = $this->Promotion_management->add_promotion_detail($promo1);
				
				$pData['promotion_detail_id'] = $ProDetailId;
				$pData['item_id'] = $pro_item_id[2]; 
				$pData['promotion_id'] = $ProId;
				
				foreach($variation_data3 as $vD => $vDa):
				$pData['variation_id'] = $vDa;
				$pData['quantity'] = $variation_price3[$vD];
				
				$this->Promotion_management->add_promotion_variation($pData);
				endforeach;
				
			}
			
			if($pro_item_id[3] != 0)
			{
				$promo1['item_id'] = $pro_item_id[3];
				$ProDetailId = $this->Promotion_management->add_promotion_detail($promo1);
				
				$pData['promotion_detail_id'] = $ProDetailId;
				$pData['item_id'] = $pro_item_id[3]; 
				$pData['promotion_id'] = $ProId;
				
				foreach($variation_data4 as $vD => $vDa):
				$pData['variation_id'] = $vDa;
				$pData['quantity'] = $variation_price4[$vD];
				
				$this->Promotion_management->add_promotion_variation($pData);
				endforeach;
				
			}
			
			if($pro_item_id[4] != 0)
			{
				$promo1['item_id'] = $pro_item_id[4];
				$ProDetailId = $this->Promotion_management->add_promotion_detail($promo1);
				
				$pData['promotion_detail_id'] = $ProDetailId;
				$pData['item_id'] = $pro_item_id[4]; 
				$pData['promotion_id'] = $ProId;
				
				foreach($variation_data5 as $vD => $vDa):
				$pData['variation_id'] = $vDa;
				$pData['quantity'] = $variation_price5[$vD];
				
				$this->Promotion_management->add_promotion_variation($pData);
				endforeach;
				
			}
			
			redirect('/show_promotion/');
			
		}
		
		$this->load->view('Administration/add_promotion',$data);
	}
	
	public function promotion_owner_serach(){
		$data['errors']=array();
		$user_code=$this->input->post('user_code');
		$owner_id=$this->input->post('owner_id');
		$location_id=$this->input->post('location_id');
		
		$service_id=$this->input->post('service_id');

		
		


			$data['item_list'] = $this->Promotion_management->get_owner_all_item($owner_id,$location_id,$service_id);

			
			$this->load->view('Administration/promotion_owner_location',$data);
		
		
	}
	
	public function ajax_variation_show(){
		$data['errors']=array();
		
		$item_id =$this->input->post('item_id'); 
		$divid =$this->input->post('divid'); 
		
		$data['itemVariation'] = $this->Promotion_management->get_item_variation($item_id);
		$data['item_id'] = $item_id;
		$data['divid'] = $divid;
		
		$this->load->view('Administration/ajax_promotion_item_variation',$data);
		
	}
	
	public function show_promotion()
	{
		$data['owner_code_list']=$this->Restaurant_management->get_owner_code_list();
		$data['promotion'] = $this->Promotion_management->show_all_promotions();
		
		$this->load->view('Administration/show_all_promotion',$data);
		
	}
	
	
	public function edit_promotion($id){
		
		$promo_id = $this->uri->segment(2);
		$OwnerId = $this->Promotion_management->get_owner_id($promo_id);


		$owner_code = $this->Promotion_management->get_owner_code($OwnerId);
		$data['errors']=array();
		
		$this->form_validation->set_rules('pro_location', 'Location', 'required');
		$this->form_validation->set_rules('pro_service', 'Service', 'required');
		$this->form_validation->set_rules('owner_id', 'Owner Id', 'required');
		$this->form_validation->set_rules('pro_name', 'Promotion Name', 'required');
		$this->form_validation->set_rules('pro_price', 'Promotion Price', 'required');
		$this->form_validation->set_rules('from_date', 'From Date', 'required');
		$this->form_validation->set_rules('to_date', 'To date', 'required');
		
		

		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
			
			$promo['location_id']=$this->input->post('pro_location');
			$promo['service_id']=$this->input->post('pro_service');
			$promo['user_id']=$this->input->post('owner_id');
			$promo['name']=$this->input->post('pro_name');
			$promo['price']=$this->input->post('pro_price');
			$promo['from_date']=$this->input->post('from_date');
			$promo['to_date']=$this->input->post('to_date'); 
			$promo['description']=$this->input->post('pro_description');
			
			$this->Promotion_management->update_promotion($promo,$promo_id);
		
			redirect('/show_promotion/');
		}


		$data['promotion'] = $this->Promotion_management->get_promotions_details($promo_id);
		$data['pitems'] = $this->Promotion_management->get_promotions_items_details($promo_id);

		foreach($data['pitems'] as $pt => $pitm):
			$pro_loc = $pitm->location_id;
			$pro_ser = $pitm->service_id;
		endforeach;

		$data['location'] = $this->Promotion_management->get_owner_all_location($OwnerId);
		$data['item_list'] = $this->Promotion_management->get_owner_all_item($OwnerId,$pro_loc,$pro_ser);
		$data['owner_id'] = $OwnerId; 
		$data['owner_code'] = $owner_code;




		$this->load->view('Administration/edit_promotion',$data);	
	}

	public function delete_promotion($id,$url){
		
		$promo_id = $this->uri->segment(2);
		$return_url = $this->uri->segment(3);
		$this->Promotion_management->delete_promotion($promo_id);
		redirect("/".$return_url."/");
	}

	public function location_service_filter_promotion(){
			$location = $this->input->post('location');
			$owner_id = $this->input->post('owner_id');
			$service = $this->input->post('service');

			$data['promotion'] = $this->Promotion_management->location_service_filter_promotion($owner_id,$location,$service);


			$this->load->view('Administration/location_service_filter_promotion',$data);
	}
}
?>