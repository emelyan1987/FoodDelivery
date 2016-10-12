<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cron extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url','date'));
		$this->load->library('form_validation');
		$this->load->model("MyCron_model");
		$this->load->database();
		
	}

	public function index()
	{
        $data['errors']=array();	 
        
        
         
        $dataarray = $this->MyCron_model->order_get_time(1);

        //var_dump($dataarray);

        foreach($dataarray as $Dta)
        {
        		
        		$hour = (24*$Dta->order_days)+$Dta->order_hour;
        		$minitue = $Dta->order_minitue;
        		
        		$newTime = date("H:i:s",strtotime($Dta->delivery_time." +".$hour." hours"));
				$newTime = date("H:i:s",strtotime($newTime." +".$minitue." minutes"));

				$tm = explode(':',$newTime);
				$h = $tm['0'];
				$i = $tm['1'];
				$s = $tm['2'];
        		//$time_now=mktime(date($h)+5,date($i)+30,date($s));
				//$nowtime = date('H:i:s', $time_now);

				$time_now1=mktime(date($h)+5,date($i)+33,date($s));
				$nowtime1 = date('H:i:s', $time_now1);
				
				$nowtime1 = date("H:i:s",strtotime($newTime." +3 minutes"));

				$nowtime2 = date("H:i:s",strtotime($nowtime1." +15 minutes"));
				
				

        		$this->MyCron_model->order_delivery_time($newTime,$nowtime1,$nowtime2,$Dta->id);
        }
        

        
        $dataarray2 = $this->MyCron_model->order_get_time2(2);

        foreach($dataarray2 as $Dta)
        {
        		
        		$hour = (24*$Dta->order_days)+$Dta->order_hour;
        		$minitue = $Dta->order_minitue;
        		
        		$newTime = date("H:i:s",strtotime($Dta->time." +".$hour." hours"));
				$newTime = date("H:i:s",strtotime($newTime." +".$minitue." minutes"));

				$tm = explode(':',$newTime);
				$h = $tm['0'];
				$i = $tm['1'];
				$s = $tm['2'];
        		//$time_now=mktime(date($h)+5,date($i)+30,date($s));
				//$nowtime = date('H:i:s', $time_now);

				$time_now1=mktime(date($h)+5,date($i)+33,date($s));
				$nowtime1 = date('H:i:s', $time_now1);
				
				$nowtime1 = date("H:i:s",strtotime($newTime." +3 minutes"));

				$nowtime2 = date("H:i:s",strtotime($nowtime1." +15 minutes"));
				
				

        		$this->MyCron_model->order_delivery_time2($newTime,$nowtime1,$nowtime2,$Dta->id);
        }



        $dataarray3 = $this->MyCron_model->order_get_time3(4);

        foreach($dataarray3 as $Dta)
        {
        		
        		$hour = (24*$Dta->order_days)+$Dta->order_hour;
        		$minitue = $Dta->order_minitue;
        		
        		$newTime = date("H:i:s",strtotime($Dta->delivery_time." +".$hour." hours"));
				$newTime = date("H:i:s",strtotime($newTime." +".$minitue." minutes"));

				$tm = explode(':',$newTime);
				$h = $tm['0'];
				$i = $tm['1'];
				$s = $tm['2'];
        		//$time_now=mktime(date($h)+5,date($i)+30,date($s));
				//$nowtime = date('H:i:s', $time_now);

				$time_now1=mktime(date($h)+5,date($i)+33,date($s));
				$nowtime1 = date('H:i:s', $time_now1);
				
				$nowtime1 = date("H:i:s",strtotime($newTime." +3 minutes"));

				$nowtime2 = date("H:i:s",strtotime($nowtime1." +15 minutes"));
				
				

        		$this->MyCron_model->order_delivery_time3($newTime,$nowtime1,$nowtime2,$Dta->id);
        }
        



	}

	

	
}
