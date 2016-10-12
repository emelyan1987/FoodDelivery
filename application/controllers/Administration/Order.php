<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
@ob_start();
class Order extends CI_Controller
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
		$this->load->helper("customer_helper");
		$this->load->helper('restaurant_helper');
		$this->load->model('Administration/Order_Management');
		$this->load->model("Administration/Restaurant_management");
		$this->load->model("Administration/Area_management");
		$this->load->model("Administration/Cuisine_management"); 
        $this->load->model("Restaurant_Owner/Restro_Owner_Model");
	}

	function index()
	{
         
	}
	              
	function delivery_orders()
	{

		$data['errors']=array();
		
		$data['restro_list']=$this->Order_Management->get_restro_list();

		if(isset($_POST['btnorderSearch']))
		{
			$restro_id = $this->input->post('restro_id');

			$data['order'] = $this->Order_Management->pending_delivery_orders_filter($restro_id);
		}
		else
		{
			$data['order'] = $this->Order_Management->pending_delivery_orders();
		}  

		$this->load->view("Administration/delivery_orders",$data);
	}
	function catering_orders()
	{
		$data['errors']=array();
		$data['restro_list']=$this->Order_Management->get_restro_list();
		
		if(isset($_POST['btnorderSearch']))
		{
			$restro_id = $this->input->post('restro_id');

			$data['order'] = $this->Order_Management->pending_catring_orders_filter($restro_id);
		}
		else
		{
			$data['order'] = $this->Order_Management->pending_catring_orders();
		}

		$this->load->view("Administration/catring_orders",$data);
	}
	function reservation_orders()
	{
		$data['errors']=array();
		$data['restro_list']=$this->Order_Management->get_restro_list();
		

		if(isset($_POST['btnorderSearch']))
		{
			$restro_id = $this->input->post('restro_id');

			$data['order'] = $this->Order_Management->pending_reservation_orders_filter($restro_id);
		}
		else
		{
			$data['order'] = $this->Order_Management->pending_reservation_orders();
		}


		$this->load->view("Administration/reservation_orders",$data);
	}
	function pickup_orders()
	{
		$data['errors']=array();
		$data['restro_list']=$this->Order_Management->get_restro_list();

		if(isset($_POST['btnorderSearch']))
		{
			$restro_id = $this->input->post('restro_id');

			$data['order'] = $this->Order_Management->pending_pickup_orders_filter($restro_id);
		}
		else
		{
			$data['order'] = $this->Order_Management->pending_pickup_orders();
		}
		


		$this->load->view("Administration/pickup_orders",$data);
	}


	public function delivery_order_view($orderid){
        $data['errors']=array();
        //$user_id = $this->tank_auth->get_user_id();
        $orderid = $this->uri->segment('2');

        if(isset($_POST['updatestatus']))
        {
                $status['status']= $this->input->post('status');
                $status['reject_reson']=$this->input->post('reject_reson');

                $this->Order_Management->order_status_change($status,$orderid);
        }

        
        $data['orderdata'] = $this->Order_Management->view_delivery_order($orderid);
        $data['orderdetails'] = $this->Order_Management->delivery_order_details($orderid);
        $this->load->view("Administration/delivery_order_details",$data);
    }



    public function catering_order_view($orderid){
        $data['errors']=array();
        //$user_id = $this->tank_auth->get_user_id();
        $orderid = $this->uri->segment('2');

        if(isset($_POST['updatestatus']))
        {
                $status['status']= $this->input->post('status');
                $status['reject_reson']=$this->input->post('reject_reson');

                $this->Order_Management->catering_order_status_change($status,$orderid);
        }

        $data['orderdata'] = $this->Order_Management->view_catering_order($orderid);
        $data['orderdetails'] = $this->Order_Management->catering_order_details($orderid);
        $this->load->view("Administration/catering_order_details",$data);
    } 

    public function reservation_order_view($orderid){
        $data['errors']=array();
        $user_id = $this->tank_auth->get_user_id();
        $orderid = $this->uri->segment('2');

        if(isset($_POST['updatestatus']))
        {
                $status['status']= $this->input->post('status');
                $status['reject_reson']=$this->input->post('reject_reson');

                $this->Order_Management->reservation_order_status_change($status,$orderid);
        }

        $data['orderdata'] = $this->Order_Management->view_reservation_order($orderid);
        $data['orderdetails'] = $this->Order_Management->reservation_order_details($orderid);
        $this->load->view("Administration/reservation_order_details",$data);
    }

 

    public function pickup_order_view($orderid){
        $data['errors']=array();
        $user_id = $this->tank_auth->get_user_id();
        $orderid = $this->uri->segment('2');

        if(isset($_POST['updatestatus']))
        {
                $status['status']= $this->input->post('status');
                $status['reject_reson']=$this->input->post('reject_reson');

                $this->Order_Management->pickup_order_status_change($status,$orderid);
        }

        $data['orderdata'] = $this->Order_Management->view_pickup_order($orderid);
        $data['orderdetails'] = $this->Order_Management->pickup_order_details($orderid);
        $this->load->view("Administration/pickup_order_details",$data);
    }


    function delivery_orders_notification()
	{
		$data['errors']=array();
		$data['showStatus'] = 0;
		//$data['order'] = $this->Order_Management->delivery_orders();
		$data['restro_id'] = '';
     	$data['location_id'] = '';
		
     	$data['restro_list']=$this->Order_Management->get_restro_list();

     	if(isset($_POST['btnsearch']))
     	{
     		$data['showStatus'] = 1;
     		$restro_id = $this->input->post('restro_id');
     		$location_id = $this->input->post('location_id');

     		$data['servicedata'] = $this->Order_Management->get_restro_order_service_list($restro_id,$location_id);

     		$data['restro_id'] = $restro_id;
     		$data['location_id'] = $location_id;
     		

     		$data['order'] = $this->Order_Management->delivery_orders_search($restro_id,$location_id);

     	}
     	else
     	{
     		$data['order'] = $this->Order_Management->delivery_orders();
     	}


     	
        

		$this->load->view("Administration/delivery_orders_notification",$data);
	}
	function catering_orders_notification()
	{
		$data['errors']=array();

		$data['showStatus'] = 0;
		$data['restro_id'] = '';
     	$data['location_id'] = '';
		
     	$data['restro_list']=$this->Order_Management->get_restro_list();

     	if(isset($_POST['btnsearch']))
     	{
     		$data['showStatus'] = 1;
     		$restro_id = $this->input->post('restro_id');
     		$location_id = $this->input->post('location_id');

     		$data['servicedata'] = $this->Order_Management->get_restro_order_service_list($restro_id,$location_id);

     		$data['restro_id'] = $restro_id;
     		$data['location_id'] = $location_id;
     		

     		$data['order'] = $this->Order_Management->catring_orders_search($restro_id,$location_id);

     	}
     	else
     	{
     		$data['order'] = $this->Order_Management->catring_orders();
     	}


		
       

		$this->load->view("Administration/catering_orders_notification",$data);
	}
	function reservation_orders_notification()
	{
		$data['errors']=array();
		
		$data['showStatus'] = 0;
		$data['restro_id'] = '';
     	$data['location_id'] = '';
		
     	$data['restro_list']=$this->Order_Management->get_restro_list();

     	if(isset($_POST['btnsearch']))
     	{
     		$data['showStatus'] = 1;
     		$restro_id = $this->input->post('restro_id');
     		$location_id = $this->input->post('location_id');

     		$data['servicedata'] = $this->Order_Management->get_restro_order_service_list($restro_id,$location_id);

     		$data['restro_id'] = $restro_id;
     		$data['location_id'] = $location_id;
     		

     		$data['order'] = $this->Order_Management->reservation_orders_search($restro_id,$location_id);

     	}
     	else
     	{
     		$data['order'] = $this->Order_Management->reservation_orders();
     	}


		$this->load->view("Administration/reservation_orders_notification",$data);
	}
	function pickup_orders_notification()
	{
		$data['errors']=array();

	
		$data['showStatus'] = 0;
		$data['restro_id'] = '';
     	$data['location_id'] = '';
		
     	$data['restro_list']=$this->Order_Management->get_restro_list();

     	if(isset($_POST['btnsearch']))
     	{
     		$data['showStatus'] = 1;
     		$restro_id = $this->input->post('restro_id');
     		$location_id = $this->input->post('location_id');

     		$data['servicedata'] = $this->Order_Management->get_restro_order_service_list($restro_id,$location_id);

     		$data['restro_id'] = $restro_id;
     		$data['location_id'] = $location_id;
     		

     		$data['order'] = $this->Order_Management->pickup_orders_search($restro_id,$location_id);

     	}
     	else
     	{
     		$data['order'] = $this->Order_Management->pickup_orders();
     	}


		$this->load->view("Administration/pickup_orders_notification",$data);
	}

    public function  get_location_for_notification()
    {
    	  $data['errors']=array();
    	   $id=$this->input->post("id");
           $data['location_list']=$this->Order_Management->get_restro_location_by_id($id);
          
           $this->load->view("includes/Administration/restro_location_list_order_info",$data);

    }

    public function commission_reports(){
    	$data['errors']=array();
		
		$data['restro_list']=$this->Order_Management->get_restro_list();

		if(isset($_POST['btnsearch']))
		{
			$from_date = $this->input->post("from_date");
			$to_date = $this->input->post("to_date");

			$data['order'] = $this->Order_Management->delivery_commission_reports_filter($from_date,$to_date);
		}
		else
		{
			$data['order'] = $this->Order_Management->delivery_commission_reports();
		}
		


		$this->load->view("Administration/delivery_commission_reports",$data);
    }

    
    public function catering_commission_reports(){
    	$data['errors']=array();
		
		$data['restro_list']=$this->Order_Management->get_restro_list();


		if(isset($_POST['btnsearch']))
		{
			$from_date = $this->input->post("from_date");
			$to_date = $this->input->post("to_date");

			$data['order'] = $this->Order_Management->catering_commission_reports_filter($from_date,$to_date);
		}
		else
		{
			$data['order'] = $this->Order_Management->catering_commission_reports();
		}
		


		$this->load->view("Administration/catering_commission_reports",$data);
    }

    public function pickup_commission_reports(){
    	$data['errors']=array();
		
		$data['restro_list']=$this->Order_Management->get_restro_list();

		if(isset($_POST['btnsearch']))
		{
			$from_date = $this->input->post("from_date");
			$to_date = $this->input->post("to_date");

			$data['order'] = $this->Order_Management->pickup_commission_reports_filter($from_date,$to_date);
		}
		else
		{
			$data['order'] = $this->Order_Management->pickup_commission_reports();
		}
		


		$this->load->view("Administration/pickup_commission_reports",$data);
    }

    public function reservation_commission_reports(){
    	$data['errors']=array();
		
		$data['restro_list']=$this->Order_Management->get_restro_list();

		if(isset($_POST['btnsearch']))
		{
			$from_date = $this->input->post("from_date");
			$to_date = $this->input->post("to_date");

			$data['order'] = $this->Order_Management->reservation_commission_reports_filter($from_date,$to_date);
		}
		else
		{
			$data['order'] = $this->Order_Management->reservation_commission_reports();
		}
		


		$this->load->view("Administration/reservation_commission_reports",$data);
    }

    

    public function delete_order(){
    	$data['errors']=array();

    	$order_id = $this->input->post("Oid");
    	$order_type = $this->input->post("type");

    	if($order_type == 1)
    	{
    		if($this->Order_Management->delivery_delete_order($order_id))
	    	{
	    		echo "yes";
	    	}
    	}
    	elseif($order_type == 2)
    	{
    		if($this->Order_Management->catering_delete_order($order_id))
	    	{
	    		echo "yes";
	    	}
    	}
    	elseif($order_type == 3)
    	{
    		if($this->Order_Management->reservation_delete_order($order_id))
	    	{
	    		echo "yes";
	    	}
    	}
    	elseif($order_type == 4)
    	{
    		if($this->Order_Management->pickup_delete_order($order_id))
	    	{
	    		echo "yes";
	    	}
    	}
    	
    	
    }


	public function update_location_service_status(){
		$data['errors']=array();

    	$restro_id = $this->input->post("restro_id");
    	$location_id = $this->input->post("location_id");
    	$service_id = $this->input->post("service_id");
    	$data1['open_from'] = $this->input->post("from");
    	$data1['open_to'] = $this->input->post("to");
    	$data1['open_status'] = $this->input->post("status");

    	if($this->Order_Management->update_location_service_status($data1,$restro_id,$location_id,$service_id))
    	{
    		echo "yes";
    	}

	}

    public function update_restro_service_status(){
        $data['errors']=array();

        $location_id = $this->input->post("location_id");
        $service_id = $this->input->post("service_id");
        $data1['open_from'] = $this->input->post("from");
        $data1['open_to'] = $this->input->post("to");
        $data1['open_status'] = $this->input->post("status");

        if($this->Order_Management->update_restro_service_status($data1,$location_id,$service_id))
        {
            echo "yes";
        }

    }    

	public function filter_order_ajax(){
		$data['errors']=array();

    	$restro_id = $this->input->post("restro_id");
    	$location_id = $this->input->post("location_id");
    	$service_id = $this->input->post("service_id");

    	if($service_id == 1)
    	{
    		$data['order'] = $this->Order_Management->delivery_orders_search($restro_id,$location_id);

    		$this->load->view("Administration/ajax_delivery_order_notification",$data);
    	}
    	elseif($service_id == 2)
    	{
    		$data['order'] = $this->Order_Management->catring_orders_search($restro_id,$location_id);

    		$this->load->view("Administration/ajax_catering_order_notification",$data);
    	}
    	elseif($service_id == 3)
    	{
    		$data['order'] = $this->Order_Management->reservation_orders_search($restro_id,$location_id);

    		$this->load->view("Administration/ajax_reservation_order_notification",$data);
    	}
    	elseif($service_id == 4)
    	{
    		$data['order'] = $this->Order_Management->pickup_orders_search($restro_id,$location_id);

    		$this->load->view("Administration/ajax_pickup_order_notification",$data);
    	}
	}

    
    public function filter_restro_order_ajax(){
        $data['errors']=array();
        $user_id = $this->tank_auth->get_user_id();
        $location_id = $this->input->post("location_id");
        $service_id = $this->input->post("service_id");

        if($service_id == 1)
        {
            $data['order'] = $this->Restro_Owner_Model->all_delivery_restro_order_filter($user_id,$location_id);

            $this->load->view("Restaurant_Owner/ajax_delivery_order_notification",$data);
        }
        elseif($service_id == 2)
        {
            $data['order'] = $this->Restro_Owner_Model->all_catering_restro_order_filter($user_id,$location_id);

            $this->load->view("Restaurant_Owner/ajax_catering_order_notification",$data);
        }
        elseif($service_id == 3)
        {
            $data['order'] = $this->Restro_Owner_Model->all_reservation_restro_order_filter($user_id,$location_id);

            $this->load->view("Restaurant_Owner/ajax_reservation_order_notification",$data);
        }
        elseif($service_id == 4)
        {
            $data['order'] = $this->Restro_Owner_Model->all_pickup_restro_order_filter($user_id,$location_id);

            $this->load->view("Restaurant_Owner/ajax_pickup_order_notification",$data);
        }
    }


    public function paymentdone_order(){
        $data['errors']=array();

        $order_id = $this->input->post("Oid");
        $service_id = $this->input->post("type");
        $status = $this->input->post("status");

        if($status == 1)
        {
            $dataOrder['status'] = 3;
        }
        $dataOrder['pay_done'] = $status;
        

        if($service_id == 1)
        {
            if($this->Order_Management->delivery_pay_done($order_id,$dataOrder))
            {
                echo "yes";
            }

            
        }
        elseif($service_id == 2)
        {
            if($this->Order_Management->catering_pay_done($order_id,$dataOrder))
            {
                echo "yes";
            }

            
        }
        elseif($service_id == 3)
        {
            if($this->Order_Management->reservation_pay_done($order_id,$dataOrder))
            {
                echo "yes";
            }

            
        }
        elseif($service_id == 4)
        {
            if($this->Order_Management->pickup_pay_done($order_id,$dataOrder))
            {
                echo "yes";
            }

            
        }

    }


}
?>