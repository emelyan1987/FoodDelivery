<?php 

    if (!defined('BASEPATH')) exit('No direct script access allowed');
    require APPPATH . '/libraries/CryptoLib.php';

    class Auth extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();

            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            //$this->load->library('security');
            $this->load->helper('security');
            $this->load->library('tank_auth');
            $this->load->model("Customer/Home_site");
            $this->lang->load('tank_auth');
            $this->load->helper('restaurant_helper');
            $this->load->model('Custom_function');
            $this->load->model("Administration/Cuisine_management"); 
            $this->load->model("Administration/Restaurant_management");
            //$this->load->model("Customer_management");
            $this->load->model("UserAccessTokenModel");
            $this->load->model("UserModel");

        }

        function index()
        {
            if ($message = $this->session->flashdata('message')) {
                $this->load->view('auth/general_message', array('message' => $message));
            } else {
                redirect('/Auth/login/');
            }
        }

        /**
        * Login user on the site
        *
        * @return void
        */
        function login()
        {

            if ($this->tank_auth->is_logged_in()) {
                // logged in

                $logined_role_id=$this->Custom_function->role_by_id($this->tank_auth->get_user_id());

                if($logined_role_id['user_role']==1)
                {
                    redirect('/Dashboard/');        
                }
                else if($logined_role_id['user_role']==2)
                {
                    redirect('/restro_dashboard/');  

                }
                else if($logined_role_id['user_role']==3)
                {
                    redirect('/customer_dashboard/');  

                }

            } elseif ($this->tank_auth->is_logged_in(FALSE)) {						// logged in, not activated
                redirect('/auth/send_again/');

            } else {
                $data['login_by_username'] = ($this->config->item('login_by_username', 'tank_auth') AND
                    $this->config->item('use_username', 'tank_auth'));
                $data['login_by_email'] = $this->config->item('login_by_email', 'tank_auth');

                $this->form_validation->set_rules('login', 'Login', 'trim|required');
                $this->form_validation->set_rules('password', 'Password', 'trim|required');
                $this->form_validation->set_rules('remember', 'Remember me', 'integer');


                // Get login for counting attempts to login
                if ($this->config->item('login_count_attempts', 'tank_auth') AND
                    ($login = $this->input->post('login'))) {
                    $login = $login;
                } else {
                    $login = '';
                }

                $data['use_recaptcha'] = $this->config->item('use_recaptcha', 'tank_auth');
                if ($this->tank_auth->is_max_login_attempts_exceeded($login)) {

                    if ($data['use_recaptcha'])
                        $this->form_validation->set_rules('recaptcha_response_field', 'Confirmation Code', 'trim|required|callback__check_recaptcha');
                    else
                        $this->form_validation->set_rules('captcha', 'Confirmation Code', 'trim|required|callback__check_captcha');
                }
                $data['errors'] = array();

                if ($this->form_validation->run()) {


                    // validation ok
                    if ($this->tank_auth->login(
                        $this->form_validation->set_value('login'),
                        $this->form_validation->set_value('password'),
                        $this->form_validation->set_value('remember'),
                        $data['login_by_username'],
                        $data['login_by_email'])) {

                        $role_id=$this->Custom_function->role_id($this->input->post("login"));
                        
                        $user_id = $this->tank_auth->get_user_id();
                        $user = $this->UserModel->findById($user_id);
                        $this->session->set_userdata(array('user_role'=>$user->user_role));
                        
                        $return_url= $this->input->post("return_url");

                        if($return_url != '')
                        {

                            redirect($return_url);
                        }


                        if($role_id['user_role']==1)
                        {


                            redirect('/Dashboard/');        
                        }
                        else if($role_id['user_role']==2)
                        {


                            redirect('/restro_dashboard/');  

                        }
                        else if($role_id['user_role']==3)
                        {
                            redirect('/customer_dashboard/');  

                        }


                        // success
                    } else {
                        $errors = $this->tank_auth->get_error_message();
                        if (isset($errors['banned'])) {								// banned user
                            $this->_show_message($this->lang->line('auth_message_banned').' '.$errors['banned']);

                        } elseif (isset($errors['not_activated'])) {				// not activated user
                            redirect('/auth/send_again/');

                        } else {													// fail
                            foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
                        }
                    }
                }
                $data['show_captcha'] = FALSE;
                if ($this->tank_auth->is_max_login_attempts_exceeded($login)) {
                    $data['show_captcha'] = TRUE;
                    if ($data['use_recaptcha']) {
                        $data['recaptcha_html'] = $this->_create_recaptcha();
                    } else {
                        $data['captcha_html'] = $this->_create_captcha();
                    }
                }
                $this->load->view('auth/login_form', $data);
            }
        }

        function welcome()
        {

            $data['errors']=array();

            $this->load->view("administration/welcome");

        }

        /**
        * Logout user
        *
        * @return void
        */
        function logout()
        {
            $this->tank_auth->logout();

            $this->_show_message($this->lang->line('auth_message_logged_out'));
            redirect("/login/");
        }

        /**
        * Register user on the site
        *
        * @return void
        */
        function register()
        {
            if ($this->tank_auth->is_logged_in()) {									// logged in
                redirect('');

            } elseif ($this->tank_auth->is_logged_in(FALSE)) {						// logged in, not activated
                redirect('/auth/send_again/');

            } elseif (!$this->config->item('allow_registration', 'tank_auth')) {	// registration is off
                $this->_show_message($this->lang->line('auth_message_registration_disabled'));

            } else {
                $use_username = $this->config->item('use_username', 'tank_auth');
                /*if ($use_username) {
                $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|min_length['.$this->config->item('username_min_length', 'tank_auth').']|max_length['.$this->config->item('username_max_length', 'tank_auth').']|alpha_dash');
                }*/
                $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
                $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'tank_auth').']|max_length['.$this->config->item('password_max_length', 'tank_auth').']|alpha_dash');
                $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|xss_clean|matches[password]');

                //$captcha_registration	= $this->config->item('captcha_registration', 'tank_auth');
                //$use_recaptcha			= $this->config->item('use_recaptcha', 'tank_auth');
                //if ($captcha_registration) {
                //if ($use_recaptcha) {
                //$this->form_validation->set_rules('recaptcha_response_field', 'Confirmation Code', 'trim|xss_clean|required|callback__check_recaptcha');
                //} else {
                //$this->form_validation->set_rules('captcha', 'Confirmation Code', 'trim|xss_clean|required|callback__check_captcha');
                //}
                //}
                $data['errors'] = array();

                $email_activation = $this->config->item('email_activation', 'tank_auth');

                if ($this->form_validation->run()) {								// validation ok
                    if (!is_null($data = $this->tank_auth->create_user(
                        $use_username ? $this->form_validation->set_value('username') : '',
                        $this->form_validation->set_value('email'),
                        $this->form_validation->set_value('password'),
                        $email_activation))) {									// success

                        $data['site_name'] = $this->config->item('website_name', 'tank_auth');

                        if ($email_activation) {									// send "activate" email
                            $data['activation_period'] = $this->config->item('email_activation_expire', 'tank_auth') / 3600;

                            $this->_send_email('activate', $data['email'], $data);

                            unset($data['password']); // Clear password (just for any case)

                            $this->_show_message($this->lang->line('auth_message_registration_completed_1'));

                        } else {
                            if ($this->config->item('email_account_details', 'tank_auth')) {	// send "welcome" email

                                $this->_send_email('welcome', $data['email'], $data);
                            }
                            unset($data['password']); // Clear password (just for any case)

                            $this->_show_message($this->lang->line('auth_message_registration_completed_2').' '.anchor('/auth/login/', 'Login'));
                        }
                    } else {
                        $errors = $this->tank_auth->get_error_message();
                        foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
                    }
                }
                //if ($captcha_registration) {
                //if ($use_recaptcha) {
                //$data['recaptcha_html'] = $this->_create_recaptcha();
                //} else {
                //$data['captcha_html'] = $this->_create_captcha();
                //}
                //}
                //$data['use_username'] = $use_username;
                //$data['captcha_registration'] = $captcha_registration;
                //$data['use_recaptcha'] = $use_recaptcha;
                $this->load->view('auth/register_form', $data);
            }
        }

        /**
        * Send activation email again, to the same or new email address
        *
        * @return void
        */
        function send_again()
        {
            if (!$this->tank_auth->is_logged_in(FALSE)) {							// not logged in or activated
                redirect('/auth/login/');

            } else {
                $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');

                $data['errors'] = array();

                if ($this->form_validation->run()) {								// validation ok
                    if (!is_null($data = $this->tank_auth->change_email(
                        $this->form_validation->set_value('email')))) {			// success

                        $data['site_name']	= $this->config->item('website_name', 'tank_auth');
                        $data['activation_period'] = $this->config->item('email_activation_expire', 'tank_auth') / 3600;

                        $this->_send_email('activate', $data['email'], $data);

                        $this->_show_message(sprintf($this->lang->line('auth_message_activation_email_sent'), $data['email']));

                    } else {
                        $errors = $this->tank_auth->get_error_message();
                        foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
                    }
                }
                $this->load->view('auth/send_again_form', $data);
            }
        }

        /**
        * Activate user account.
        * User is verified by user_id and authentication code in the URL.
        * Can be called by clicking on link in mail.
        *
        * @return void
        */
        function activate()
        {
            $user_id		= $this->uri->segment(3);
            $new_email_key	= $this->uri->segment(4);

            // Activate user
            if ($this->tank_auth->activate_user($user_id, $new_email_key)) {		// success
                $this->tank_auth->logout();
                $this->_show_message($this->lang->line('auth_message_activation_completed').' '.anchor('/auth/login/', 'Login'));

            } else {																// fail
                $this->_show_message($this->lang->line('auth_message_activation_failed'));
            }
        }

        /**
        * Generate reset code (to change password) and send it to user
        *
        * @return void
        */
        function forgot_password()
        {
            if ($this->tank_auth->is_logged_in()) {									// logged in
                redirect('');



            } elseif ($this->tank_auth->is_logged_in(FALSE)) {						// logged in, not activated
                redirect('/auth/send_again/');

            } else {
                $this->form_validation->set_rules('login', 'Email or login', 'trim|required|xss_clean');

                $data['errors'] = array();

                if ($this->form_validation->run()) {								// validation ok
                    if (!is_null($data = $this->tank_auth->forgot_password(
                        $this->form_validation->set_value('login')))) {

                        $data['site_name'] = $this->config->item('website_name', 'tank_auth');

                        // Send email with password activation link

                        $this->_send_email('forgot_password', $data['email'], $data);

                        $this->_show_message($this->lang->line('auth_message_new_password_sent'));



                    } else {
                        $errors = $this->tank_auth->get_error_message();
                        foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
                    }
                }
                $this->load->view('auth/forgot_password_form', $data);
            }
        }

        /**
        * Replace user password (forgotten) with a new one (set by user).
        * User is verified by user_id and authentication code in the URL.
        * Can be called by clicking on link in mail.
        *
        * @return void
        */
        function reset_password()
        {
            $user_id	= $this->uri->segment(3);
            $new_pass_key	= $this->uri->segment(4);

            $this->form_validation->set_rules('new_password', 'New Password', 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'tank_auth').']|max_length['.$this->config->item('password_max_length', 'tank_auth').']|alpha_dash');
            $this->form_validation->set_rules('confirm_new_password', 'Confirm new Password', 'trim|required|xss_clean|matches[new_password]');

            $data['errors'] = array();

            if ($this->form_validation->run()) {								// validation ok
                if (!is_null($data = $this->tank_auth->reset_password(
                    $user_id, $new_pass_key,
                    $this->form_validation->set_value('new_password')))) {	// success

                    $data['site_name'] = $this->config->item('website_name', 'tank_auth');

                    // Send email with new password
                    $this->_send_email('reset_password', $data['email'], $data);
                    $this->session->set_flashdata("change_pass_msg","Password Changed Successfully.Check Your Mail"); 
                    redirect('/login/');

                    $this->_show_message($this->lang->line('auth_message_new_password_activated').' '.anchor('/auth/login/', 'Login'));

                } else {														// fail
                    $this->_show_message($this->lang->line('auth_message_new_password_failed'));
                }
            } else {
                // Try to activate user by password key (if not activated yet)
                if ($this->config->item('email_activation', 'tank_auth')) {
                    $this->tank_auth->activate_user($user_id, $new_pass_key, FALSE);
                }

                if (!$this->tank_auth->can_reset_password($user_id, $new_pass_key)) {
                    $this->_show_message($this->lang->line('auth_message_new_password_failed'));
                }
            }
            $this->load->view('auth/reset_password_form', $data);
        }

        /**
        * Change user password
        *
        * @return void
        */
        function change_password()
        {
            if (!$this->tank_auth->is_logged_in()) {								// not logged in or not activated
                redirect('/auth/login/');
                //|alpha_dash
            } else {
                $this->form_validation->set_rules('old_password', 'Old Password', 'trim|required|xss_clean');
                $this->form_validation->set_rules('new_password', 'New Password', 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'tank_auth').']|max_length['.$this->config->item('password_max_length', 'tank_auth').']');
                $this->form_validation->set_rules('confirm_new_password', 'Confirm new Password', 'trim|required|xss_clean|matches[new_password]');

                $data['errors'] = array();

                if ($this->form_validation->run()) {								// validation ok
                    if ($this->tank_auth->change_password(
                        $this->form_validation->set_value('old_password'),
                        $this->form_validation->set_value('new_password'))) {	// success
                        $this->_show_message($this->lang->line('auth_message_password_changed'));

                    } else {														// fail
                        $errors = $this->tank_auth->get_error_message();
                        foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
                    }
                }
                $this->load->view('auth/change_password_form', $data);
            }
        }

        /**
        * Change user email
        *
        * @return void
        */
        function change_email()
        {
            if (!$this->tank_auth->is_logged_in()) {								// not logged in or not activated
                redirect('/auth/login/');

            } else {
                $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
                $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');

                $data['errors'] = array();

                if ($this->form_validation->run()) {								// validation ok
                    if (!is_null($data = $this->tank_auth->set_new_email(
                        $this->form_validation->set_value('email'),
                        $this->form_validation->set_value('password')))) {			// success

                        $data['site_name'] = $this->config->item('website_name', 'tank_auth');

                        // Send email with new email address and its activation link
                        $this->_send_email('change_email', $data['new_email'], $data);

                        $this->_show_message(sprintf($this->lang->line('auth_message_new_email_sent'), $data['new_email']));

                    } else {
                        $errors = $this->tank_auth->get_error_message();
                        foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
                    }
                }
                $this->load->view('auth/change_email_form', $data);
            }
        }

        /**
        * Replace user email with a new one.
        * User is verified by user_id and authentication code in the URL.
        * Can be called by clicking on link in mail.
        *
        * @return void
        */
        function reset_email()
        {
            $user_id		= $this->uri->segment(3);
            $new_email_key	= $this->uri->segment(4);

            // Reset email
            if ($this->tank_auth->activate_new_email($user_id, $new_email_key)) {	// success
                $this->tank_auth->logout();
                $this->_show_message($this->lang->line('auth_message_new_email_activated').' '.anchor('/auth/login/', 'Login'));

            } else {																// fail
                $this->_show_message($this->lang->line('auth_message_new_email_failed'));
            }
        }

        /**
        * Delete user from the site (only when user is logged in)
        *
        * @return void
        */
        function unregister()
        {
            if (!$this->tank_auth->is_logged_in()) {								// not logged in or not activated
                redirect('/auth/login/');

            } else {
                $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

                $data['errors'] = array();

                if ($this->form_validation->run()) {								// validation ok
                    if ($this->tank_auth->delete_user(
                        $this->form_validation->set_value('password'))) {		// success
                        $this->_show_message($this->lang->line('auth_message_unregistered'));

                    } else {														// fail
                        $errors = $this->tank_auth->get_error_message();
                        foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
                    }
                }
                $this->load->view('auth/unregister_form', $data);
            }
        }

        /**
        * Show info message
        *
        * @param	string
        * @return	void
        */
        function _show_message($message)
        {
            $this->session->set_flashdata('message', $message);
            //redirect('/forgot_password/');
        }

        /**
        * Send email message of given type (activate, forgot_password, etc.)
        *
        * @param	string
        * @param	string
        * @param	array
        * @return	void
        */
        function _send_email($type, $email, &$data)
        {
            $this->load->library('email');
            $this->email->from($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
            $this->email->reply_to($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
            $this->email->to($email);
            $this->email->subject(sprintf($this->lang->line('auth_subject_'.$type), $this->config->item('website_name', 'tank_auth')));
            $this->email->message($this->load->view('email/'.$type.'-html', $data, TRUE));
            $this->email->set_alt_message($this->load->view('email/'.$type.'-txt', $data, TRUE));
            $this->email->send();
        }

        /**
        * Create CAPTCHA image to verify user as a human
        *
        * @return	string
        */
        function _create_captcha()
        {
            $this->load->helper('captcha');

            $cap = create_captcha(array(
                'img_path'		=> './'.$this->config->item('captcha_path', 'tank_auth'),
                'img_url'		=> base_url().$this->config->item('captcha_path', 'tank_auth'),
                'font_path'		=> './'.$this->config->item('captcha_fonts_path', 'tank_auth'),
                'font_size'		=> $this->config->item('captcha_font_size', 'tank_auth'),
                'img_width'		=> $this->config->item('captcha_width', 'tank_auth'),
                'img_height'	=> $this->config->item('captcha_height', 'tank_auth'),
                'show_grid'		=> $this->config->item('captcha_grid', 'tank_auth'),
                'expiration'	=> $this->config->item('captcha_expire', 'tank_auth'),
            ));

            // Save captcha params in session
            $this->session->set_flashdata(array(
                'captcha_word' => $cap['word'],
                'captcha_time' => $cap['time'],
            ));

            return $cap['image'];
        }

        /**
        * Callback function. Check if CAPTCHA test is passed.
        *
        * @param	string
        * @return	bool
        */
        function _check_captcha($code)
        {
            $time = $this->session->flashdata('captcha_time');
            $word = $this->session->flashdata('captcha_word');

            list($usec, $sec) = explode(" ", microtime());
            $now = ((float)$usec + (float)$sec);

            if ($now - $time > $this->config->item('captcha_expire', 'tank_auth')) {
                $this->form_validation->set_message('_check_captcha', $this->lang->line('auth_captcha_expired'));
                return FALSE;

            } elseif (($this->config->item('captcha_case_sensitive', 'tank_auth') AND
                $code != $word) OR
                strtolower($code) != strtolower($word)) {
                $this->form_validation->set_message('_check_captcha', $this->lang->line('auth_incorrect_captcha'));
                return FALSE;
            }
            return TRUE;
        }

        /**
        * Create reCAPTCHA JS and non-JS HTML to verify user as a human
        *
        * @return	string
        */
        function _create_recaptcha()
        {
            $this->load->helper('recaptcha');

            // Add custom theme so we can get only image
            $options = "<script>var RecaptchaOptions = {theme: 'custom', custom_theme_widget: 'recaptcha_widget'};</script>\n";

            // Get reCAPTCHA JS and non-JS HTML
            $html = recaptcha_get_html($this->config->item('recaptcha_public_key', 'tank_auth'));

            return $options.$html;
        }

        /**
        * Callback function. Check if reCAPTCHA test is passed.
        *
        * @return	bool
        */
        function _check_recaptcha()
        {
            $this->load->helper('recaptcha');

            $resp = recaptcha_check_answer($this->config->item('recaptcha_private_key', 'tank_auth'),
                $_SERVER['REMOTE_ADDR'],
                $_POST['recaptcha_challenge_field'],
                $_POST['recaptcha_response_field']);

            if (!$resp->is_valid) {
                $this->form_validation->set_message('_check_recaptcha', $this->lang->line('auth_incorrect_captcha'));
                return FALSE;
            }
            return TRUE;
        }




        public function restro_owner_change_password()
        {
            $data['errors']=array();
            $hasher = new PasswordHash(
                $this->config->item('phpass_hash_strength', 'tank_auth'),
                $this->config->item('phpass_hash_portable', 'tank_auth'));
            //|alpha_dash
            $this->form_validation->set_rules('pass', 'Old Password', 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'tank_auth').']|max_length['.$this->config->item('password_max_length', 'tank_auth').']');
            $this->form_validation->set_rules('new_pass', 'New Password', 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'tank_auth').']|max_length['.$this->config->item('password_max_length', 'tank_auth').']');
            $this->form_validation->set_rules('confirm_pass', 'Confirm Password', 'trim|required|xss_clean|matches[new_pass]');


            if ($this->form_validation->run() == FALSE)
            {

            }
            else
            {
                $pass = $this->input->post('pass');
                $restroOwnerID =$this->tank_auth->get_user_id();

                $query = $this->Custom_function->checkOldPass();
                $password = $query['password'];
                $email = $query['email'];

                if($hasher->CheckPassword($pass, $password))
                {

                    $change['password'] = $hasher->HashPassword($this->input->post('new_pass'));
                    //print_r($change['password']); 
                    $query = $this->Custom_function->saveNewPass($change);

                    //$data['site_name'] = $this->config->item('website_name', 'tank_auth');

                    // Send email with new email address and its activation link
                    //$this->_send_email('change_email', $email, $data);
                }
            }

            $this->load->view("Restaurant_Owner/restro_owner_change_password",$data);
        }


        public function admin_change_password()
        {
            $data['errors']=array();


            $hasher = new PasswordHash(
                $this->config->item('phpass_hash_strength', 'tank_auth'),
                $this->config->item('phpass_hash_portable', 'tank_auth'));

            //$this->form_validation->set_rules('pass', 'Old Password', 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'tank_auth').']|max_length['.$this->config->item('password_max_length', 'tank_auth').']|alpha_dash');
            $this->form_validation->set_rules('new_pass', 'New Password', 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'tank_auth').']|max_length['.$this->config->item('password_max_length', 'tank_auth').']|alpha_dash');
            $this->form_validation->set_rules('confirm_pass', 'Confirm Password', 'trim|required|xss_clean|matches[new_pass]');


            if ($this->form_validation->run() == FALSE)
            {

            }
            else
            {
                $email=$this->Custom_function->get_user_email($this->tank_auth->get_user_id());
                $data['ownerCode']=$email['email'];
                $pass = $this->input->post('pass');
                $adminid =$this->tank_auth->get_user_id();

                //$query = $this->Custom_function->checkOldPass();
                //$password = $query['password'];
                //$email = $query['email'];

                //if($hasher->CheckPassword($pass, $password))
                if($this->input->post('new_pass')==$this->input->post('confirm_pass'))	
                {

                    $data['new_password']=$this->input->post('new_pass');
                    $data['em']="adminemail";
                    $change['password'] = $hasher->HashPassword($this->input->post('new_pass'));
                    $query = $this->Custom_function->saveNewPass($change);

                    $data['site_name'] = $this->config->item('website_name', 'tank_auth');

                    // Send email with new email address and its activation link
                    $this->_send_email('reset_password', $email['email'], $data);
                    $data['change_msg']="Password Changed Successfully.Check your Mail";

                }
                else
                {
                    $data['change_msg']="<span style='color:red'>New Password and Confirm Password does not match</span>";

                }
            }

            $this->load->view("Administration/admin_change_password",$data);
        }


        public function admin_reset_password()
        {


            $data['errors']=array();

            $data['owner_code_list']=$this->Restaurant_management->get_owner_code_list();


            $hasher = new PasswordHash(
                $this->config->item('phpass_hash_strength', 'tank_auth'),
                $this->config->item('phpass_hash_portable', 'tank_auth'));

            //$this->form_validation->set_rules('op', 'Old Password', 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'tank_auth').']|max_length['.$this->config->item('password_max_length', 'tank_auth').']|alpha_dash');
            $this->form_validation->set_rules('np', 'New Password', 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'tank_auth').']|max_length['.$this->config->item('password_max_length', 'tank_auth').']|alpha_dash');
            $this->form_validation->set_rules('cp', 'Confirm Password', 'trim|required|xss_clean|matches[cp]');
            $this->form_validation->set_rules('owner_id', 'Restaurant owner id', 'required');
            //$this->form_validation->set_rules('owner', 'Check User Type', 'required');


            if ($this->form_validation->run() == FALSE)
            {

            }
            else
            {
                $old_pass = $this->input->post('op');
                $new_pass = $this->input->post('np');
                $confirm_pass = $this->input->post('cp');
                //$owner_type = $this->input->post('owner');
                $owner_id = $this->input->post('owner_id');
                $data['ownerCode']=$owner_id;
                $password_from_db=$this->Custom_function->get_password_by_owner_id($owner_id);
                $db_pass=$password_from_db['password'];
                if($new_pass!=$confirm_pass)
                {
                    $data['not_msg']="New Password And Confirm Password Does Not Match";

                }
                else
                {
                    //if($hasher->CheckPassword($old_pass, $db_pass))
                    //{


                    $change['password'] = $hasher->HashPassword($this->input->post('np'));
                    //print_r($change['password']); 
                    if($this->Custom_function->Change_new_pass($change,$owner_id))
                    {
                        $data['new_password']=$new_pass;
                        $data['change_msg']="Password Changed Successfully.New Password Sent To Owner Email.";
                        $this->Custom_function->add_password_for_mail($owner_id,$new_pass);
                        $email=$this->Custom_function->get_email_by_owner_code($owner_id);

                        $data['site_name'] = $this->config->item('website_name', 'tank_auth');
                        $this->_send_email('reset_password', $email['email'], $data);
                    }

                    //}
                    //else
                    //{
                    //$data['change_msg']="Old Password Does not exists";	
                    //}
                }					
            }





            $this->load->view("Administration/admin_reset_password",$data);


        }



        public function customer_login(){

            if ($this->tank_auth->is_logged_in()) {
                // logged in

                $logined_role_id=$this->Custom_function->role_by_id($this->tank_auth->get_user_id());


                if($logined_role_id['user_role']==1)
                {
                    redirect('/Dashboard/');        
                }
                else if($logined_role_id['user_role']==2)
                {
                    redirect('/restro_dashboard/');  

                }
                else if($logined_role_id['user_role']==3)
                {
                    redirect('/customer_dashboard/');  

                }

            } elseif ($this->tank_auth->is_logged_in(FALSE)) {						// logged in, not activated
                redirect('/auth/send_again/');

            } else {
                $data['login_by_username'] = ($this->config->item('login_by_username', 'tank_auth') AND
                    $this->config->item('use_username', 'tank_auth'));
                $data['login_by_email'] = $this->config->item('login_by_email', 'tank_auth');

                $this->form_validation->set_rules('login', 'Login', 'trim|required');
                $this->form_validation->set_rules('password', 'Password', 'trim|required');
                $this->form_validation->set_rules('remember', 'Remember me', 'integer');


                // Get login for counting attempts to login
                if ($this->config->item('login_count_attempts', 'tank_auth') AND
                    ($login = $this->input->post('login'))) {
                    $login = $login;
                } else {
                    $login = '';
                }

                $data['use_recaptcha'] = $this->config->item('use_recaptcha', 'tank_auth');
                if ($this->tank_auth->is_max_login_attempts_exceeded($login)) {

                    if ($data['use_recaptcha'])
                        $this->form_validation->set_rules('recaptcha_response_field', 'Confirmation Code', 'trim|required|callback__check_recaptcha');
                    else
                        $this->form_validation->set_rules('captcha', 'Confirmation Code', 'trim|required|callback__check_captcha');
                }
                $data['errors'] = array();

                if ($this->form_validation->run()) {


                    // validation ok
                    if ($this->tank_auth->login(
                        $this->form_validation->set_value('login'),
                        $this->form_validation->set_value('password'),
                        $this->form_validation->set_value('remember'),
                        $data['login_by_username'],
                        $data['login_by_email'])) {

                        $role_id=$this->Custom_function->role_id($this->input->post("login"));
                        $return_url= $this->input->post("return_url");

                        //echo $this->tank_auth->get_user_id();die;

                        $user_id = $this->tank_auth->get_user_id();
                        $_SESSION['Customer_User_Id'] = $user_id;

                        // Set Access Token

                        $token_data["user_id"] = $user_id;   
                        $token = CryptoLib::randomString(50);
                        $token_data["access_token"] = $token;        

                        if(isset($_SERVER['HTTP_CLIENT_IP'])) $token_data['ip_address1'] = $_SERVER['HTTP_CLIENT_IP'];
                        if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) $token_data['ip_address2'] = $_SERVER['HTTP_X_FORWARDED_FOR'];
                        if(isset($_SERVER['HTTP_X_FORWARDED'])) $token_data['ip_address3'] = $_SERVER['HTTP_X_FORWARDED'];
                        if(isset($_SERVER['HTTP_FORWARDED_FOR'])) $token_data['ip_address4'] = $_SERVER['HTTP_FORWARDED_FOR'];
                        if(isset($_SERVER['HTTP_FORWARDED'])) $token_data['ip_address5'] = $_SERVER['HTTP_FORWARDED'];
                        if(isset($_SERVER['REMOTE_ADDR'])) $token_data['ip_address6'] = $_SERVER['REMOTE_ADDR'];

                        $this->UserAccessTokenModel->create($token_data);

                        $_SESSION['access_token'] = $token;
                        
                        $user = $this->UserModel->findById($user_id);
                        $this->session->set_userdata(array('user_role'=>$user->user_role));

                        redirect('/customer_login');

                        //redirect('/customer_otp/');
                        //$this->load->view('customer_otp');

                        /*
                        if($role_id['user_role']==1)
                        {


                        redirect('/Dashboard/');        
                        }
                        else if($role_id['user_role']==2)
                        {


                        redirect('/restro_dashboard/');  

                        }
                        else if($role_id['user_role']==3)
                        {
                        redirect('/customer_dashboard/');  

                        } */


                        // success
                    } else {
                        $errors = $this->tank_auth->get_error_message();
                        if (isset($errors['banned'])) {								// banned user
                            $this->_show_message($this->lang->line('auth_message_banned').' '.$errors['banned']);

                        } elseif (isset($errors['not_activated'])) {				// not activated user
                            redirect('/auth/send_again/');

                        } else {													// fail
                            foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
                        }
                    }
                }
                $data['show_captcha'] = FALSE;
                if ($this->tank_auth->is_max_login_attempts_exceeded($login)) {
                    $data['show_captcha'] = TRUE;
                    if ($data['use_recaptcha']) {
                        $data['recaptcha_html'] = $this->_create_recaptcha();
                    } else {
                        $data['captcha_html'] = $this->_create_captcha();
                    }
                }
                $this->load->view('login', $data);
            }
        }

        public function customer_register(){
            $data['errors']=array();
            $data['city'] = $this->Home_site->show_customer_city();
            $data['area'] = $this->Home_site->show_customer_area();

            $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'tank_auth').']|max_length['.$this->config->item('password_max_length', 'tank_auth').']|alpha_dash');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|xss_clean|matches[password]');



            $this->form_validation->set_rules('f_name', 'Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|xss_clean|regex_match[/^[0-9]{10}$/]');
            $this->form_validation->set_rules('gender', 'Gender', 'trim|required|xss_clean');

            $this->form_validation->set_rules('city', 'City', 'trim|required|xss_clean');
            $this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');

            $this->form_validation->set_rules('area', 'Area', 'trim|required|xss_clean');
            $this->form_validation->set_rules('block', 'Block', 'trim|required|xss_clean');

            $this->form_validation->set_rules('floor', 'floor', 'trim|required|xss_clean');
            $this->form_validation->set_rules('appartment', 'Appartment', 'trim|required|xss_clean');


            $this->form_validation->set_rules('house_name', 'House name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('street', 'Street', 'trim|required|xss_clean');

            $this->form_validation->set_rules('check', 'Policy', 'trim|required|xss_clean');
            $this->form_validation->set_rules('captcha_text', 'captcha', 'trim|required|xss_clean');

            $val1 = rand(0,9);
            $val2 = rand(0,9);
            $val3 = rand(0,9);
            $val4 = rand(0,9);

            $capcha_val = $val1.$val2.$val3.$val4;


            if ($this->form_validation->run() == FALSE)
            {
                $data['capctha_code'] = $capcha_val;
                $_SESSION['capcha_val'] = $capcha_val;
            }
            else
            {         
                $hasher = new PasswordHash(
                    $this->config->item('phpass_hash_strength', 'tank_auth'),
                    $this->config->item('phpass_hash_portable', 'tank_auth'));


                $user['email']=$this->input->post('email');
                $user['mobile_no']=$this->input->post('mobile');
                $cu_mail=$this->input->post('email');
                $cu_mob=$this->input->post('mobile');
                $cu_pass=$this->input->post('password');

                $user['password']= $hasher->HashPassword($this->input->post('password'));
                $user['user_role']=3;
                //$user['confirm_password']=$this->input->post('confirm_password');

                $customer['f_name']=$this->input->post('f_name');
                $customer['mobile']=$this->input->post('mobile');

                $customer['gender']=$this->input->post('gender');
                $customer['city']=$this->input->post('city');
                $customer['address']=$this->input->post('address');

                $customer['area']=$this->input->post('area');
                $customer['block']=$this->input->post('block');
                $month=$this->input->post('month');
                $day=$this->input->post('day');
                $year=$this->input->post('year');
                $customer['birthdate']=$year.'-'.$month.'-'.$day;

                $customer['floor']=$this->input->post('floor');
                $customer['appartment']=$this->input->post('appartment');

                $customer['house_name']=$this->input->post('house_name');
                $customer['street']=$this->input->post('street');
                $customer['direction']=$this->input->post('direction');
                $policy=$this->input->post('check'); 

                $captcha_text =$this->input->post('captcha_text'); 

                $emailcheck=$this->Custom_function->customer_email($cu_mail);
                $mobilecheck=$this->Custom_function->customer_mobile($cu_mob);



                if($emailcheck == 1)
                {
                    $data['EmailMsg'] = '<span style="color:red">Email already exist ! </span>';
                    $data['capctha_code'] = $capcha_val;
                }
                else { 


                    if($mobilecheck == 1)
                    {
                        $data['mobilelMsg'] = '<span style="color:red">Mobile already exist ! </span>';
                        $data['capctha_code'] = $capcha_val;
                    }
                    else { 


                        if($_SESSION['capcha_val'] != $captcha_text)
                        {
                            $data['successMsg'] = '<span style="color:red">Your Capctha Code Wrong ! , Please try again</span>';
                            $data['capctha_code'] = $capcha_val;
                            $this->load->view('auth/customer_register_form',$data);
                        }
                        else
                        {

                            $customer['user_id']=$this->Custom_function->customer_user($user);

                            $this->Custom_function->customer_profile($customer);
                            // $this->_send_email('customer_reg', $data['email'], $data);
                            /*
                            $this->load->library('email');
                            $this->email->from($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
                            $this->email->reply_to($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
                            $this->email->to($email);
                            $this->email->subject(sprintf($this->lang->line('auth_subject_'.$type), $this->config->item('website_name', 'tank_auth')));
                            $this->email->message($this->load->view('email/'.$type.'-html', $data, TRUE));
                            $this->email->set_alt_message($this->load->view('email/'.$type.'-txt', $data, TRUE));
                            $this->email->send();	


                            */	


                            $mess = "<head><title>Welcome to http://restro.powersoftware.in !</title></head>

                            <div style='max-width: 800px; margin: 0; padding: 30px 0;'>
                            <table width='80%' border='0' cellpadding='0' cellspacing='0'>
                            <tr>
                            <td width='5%'></td>
                            <td align='left' width='95%' style='font: 13px/18px Arial, Helvetica, sans-serif;'>
                            <h2 style='font: normal 20px/23px Arial, Helvetica, sans-serif; margin: 0; padding: 0 0 18px; color: black;'>Welcome to http://restro.powersoftware.in !</h2>
                            Thanks for joining http://restro.powersoftware.in <br />

                            <br />


                            Have fun!<br />
                            The http://restro.powersoftware.in Team
                            </td>
                            </tr>
                            </table>
                            </div>";

                            $ci = get_instance();
                            $ci->load->library('email');
                            $config['protocol'] = "smtp";
                            $config['smtp_host'] = "powersoftware.eu";
                            $config['smtp_port'] = "25";
                            $config['smtp_user'] = "enquiry@powersoftware.eu"; 
                            $config['smtp_pass'] = "powersoftware";
                            $config['charset'] = "utf-8";
                            $config['mailtype'] = "html";
                            $config['newline'] = "\r\n";

                            $ci->email->initialize($config);

                            $ci->email->from('enquiry@powersoftware.eu', 'Mataam');
                            //$list = array('xxx@gmail.com');
                            $ci->email->to($cu_mail);
                            //$this->email->reply_to('my-email@gmail.com', 'Explendid Videos');
                            $ci->email->subject('Login');
                            $ci->email->message($mess);
                            $ci->email->attach(""); // attach file
                            $ci->email->send();	






                            $data['successMsg'] = '<span style="color:green">Success</span>';

                            $data['capctha_code'] = $capcha_val;
                            $_SESSION['capcha_val'] = $capcha_val;

                        }

                        $this->session->set_flashdata('successMsg', '<span style="color:green">Thank You For Registration</span>');				
                        redirect("/customer_register/");

                    }
                }
            }
            //$data['regMsg'] = '<span style="color:green">Successfully Registered </span>';
            $this->load->view('auth/customer_register_form',$data);

        }


























    }






    /* End of file auth.php */
    /* Location: ./application/controllers/auth.php */