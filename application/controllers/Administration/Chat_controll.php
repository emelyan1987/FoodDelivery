<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
@ob_start();
class Chat_controll extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		//$this->load->library('security');
		$this->load->library('session');
        $this->load->helper('security');
        $this->load->helper('restaurant_helper');
		$this->load->library('tank_auth');
		$this->lang->load('tank_auth');
		
	 $this->load->model('Administration/Chat_manage_model');
		
		
		

	}
///////////////////////////////////////////////////////////////////////
public function index()
	{
		
		
	}
	
	public function add_chatname()
	{
		
		 $data['errors']=array();
		 
		  if(isset($_POST['chat']))
				{
					
					
					$this->form_validation->set_rules('chatname', 'Chat Name', 'trim|required');
					
										
					if ($this->form_validation->run() == FALSE)
					{
						
						
					}
					else
					{
					
						 
						$chatname=$this->input->post("chatname");
			                        $alluser['chatname']=$chatname;
			                        
			                        $alluser['chatdate']=date("Y-m-d");
			                        $alluser['chattime']=date("H:i:s");
			                         if($this->Chat_manage_model->check_chatname($chatname,$alluser)==0)
			                         {
					                  
			                        
			                       
			                      
			           		                        		                    		
			                        $chatId = $this->Chat_manage_model->add_chatnam($alluser);
			                        
			                        $session_id = $this->session->set_userdata('chat_id',$chatId); 
			                     
			                     	$session_chatname = $this->session->set_userdata('chatname',$alluser['chatname']);
			                       redirect('/add_chatmsg/');
			                        }
			                        else
			                        {
			                        	 $data['chatname_msg']="ChatName Aready exists";
			                        }
					}
				} 
			 
			 
			 
			 
			
			  
			
			    $this->load->view("Administration/add_chatename",$data);
			     
			}
			
			
		public function add_chatmsg()
			{
			
			$sesId = $this->session->userdata('chat_id');
			$data['chat_list']=$this->Chat_manage_model->all_chat($sesId);
			
			  	 $data['errors']=array();
		
				 if(isset($_POST['add_msg']))
				{
					
					
					
					$this->form_validation->set_rules('message', 'Input Message', 'required');
					
										
					if ($this->form_validation->run() == FALSE)
					{
						
						
					}
					else
					{
		                        $alluser['message']=$this->input->post('message');
		                        $alluser['msgdate']=date("Y-m-d");
			                $alluser['msgtime']=date("H:i:s"); 
		                        $alluser['sender_type']=2;
		                        $alluser['admin_id']=1;
		                       
		                        $session_id = $this->session->userdata('chat_id');
					$alluser['user_id']=$session_id;                 
								                        
	
		                        
		                        
		                    		
		                        $this->Chat_manage_model->add_chatmsg($alluser);
		                        redirect('/add_chatmsg/');
					}
				} 
			 
			 
			 
			 
			
			  
			
			   $this->load->view("Administration/chate_user",$data);
			     
			}	
		 
		 
		 
		 public function chatAdmin()
			{
			
			
			$data['chatuser']=$this->Chat_manage_model->Alladminchat();
			
			
			  	 $data['errors']=array();
		
				 if(isset($_POST['add_msg']))
				{
					
					
					
					$this->form_validation->set_rules('message', 'Input Message', 'required');
					
										
					if ($this->form_validation->run() == FALSE)
					{
						
						
					}
					else
					{
		                        $alluser['message']=$this->input->post('message');
		                        $alluser['msgdate']=date("Y-m-d");
			                $alluser['msgtime']=date("H:i:s"); 
		                        $alluser['sender_type']=1;
		                        $alluser['admin_id']=1;
		                       
		                        
		                    		
		                        $this->Chat_manage_model->chatadmin($alluser);
		                        //redirect('/add_chatmsg/');
					}
				} 
			 
			 
			 
			 		  
			
			  	 $this->load->view("Administration/chat",$data);
			     
				}	
			
			 public function ajax_userid()
			 {
		        	$data['errors']=array();
		
		        	
		        	 $userid = $this->input->post("uid");
		        			        	
				$data['chatMsg'] = $this->Chat_manage_model->getUSERid($userid);
		           
		             $this->load->view("Administration/ajax_userid",$data);
      			  }
		 
		 
		 
		 
		  public function ajax_userGETmessage()
			{
			$uid=$this->input->post('user_id');
		       
			 $data['errors']=array();
			
					$this->form_validation->set_rules('message', 'Input Message', 'required');
					
										
					if ($this->form_validation->run() == FALSE)
					{
					
						
					}
					else
					{
		                        $alluser['message']=$this->input->post('message');
		                        $alluser['user_id']=$this->input->post('user_id');
		                        $alluser['msgdate']=date("Y-m-d");
			                $alluser['msgtime']=date("H:i:s"); 
		                        $alluser['sender_type']="1";
		                        $alluser['admin_id']=1;
		                    
		                       
		                        $this->Chat_manage_model->insertMSG($alluser);
		                       	$data['allmsg'] = $this->Chat_manage_model->getadminmsg($uid);				
					} 
			  	
			 
			 		$this->load->view("Administration/ajax_userGETmessage",$data);	  	 
			  	
			     
				}	
		 
		 
		
		
	
 
}