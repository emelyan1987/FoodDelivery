<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paypal extends CI_Controller 
{
	 
	 public function __construct()
	 {
          parent::__construct();
          $this->load->library('session');
          $this->load->model("Customer/Home_Restro");
   }

      
    function index()
    {
          if(($_SESSION['pay_method'] != 4) || ($_SESSION['pay_amount'] == 0) || ($_SESSION['pay_order_no'] == ''))
          {
              redirect('/');
          }
          else
          {
            $this->load->view('paypal_payment');
          }
          

    }

    function success()
    {
        $data[] = array();
          $payData = $_GET;
          if($payData['st'] == 'Completed')
          {

                $data['amount'] = $payData['amt'];
                $data['trans'] = $payData['tx'];
                $payNum = $this->Home_Restro->check_order_payment($_SESSION['pay_order_id'],$_SESSION['pay_type']);
                if($payNum == 0)
                {


                    $payD['order_type'] = $_SESSION['pay_type'];
                    $payD['order_id'] = $_SESSION['pay_order_id'];
                    $payD['amount'] = $payData['amt'];
                    $payD['payment_method'] = $_SESSION['pay_method'];
                    $payD['date'] = date('Y-m-d');
                    $payD['time'] = date('H:i:s');
                    $payD['transaction_id'] = $payData['tx'];
                    
                    
                    if($this->Home_Restro->add_payment($payD))
                    {
                        $payUp['pay_done'] = 1;
                        if($payD['order_type'] == 1)
                        {
                            $this->Home_Restro->delivery_order_update($payUp,$payD['order_id']);
                        }
                        elseif($payD['order_type'] == 2)
                        {
                            $this->Home_Restro->catering_order_update($payUp,$payD['order_id']);
                        }
                        elseif($payD['order_type'] == 4)
                        {
                            $this->Home_Restro->pickup_order_update($payUp,$payD['order_id']);
                        }
                        
                    }
                }


                $this->load->view('/paypal_success',$data);


                
          }
          //[tx] => 2WP79687DY5603906 [st] => Completed [amt] => 29.00 

    }

}