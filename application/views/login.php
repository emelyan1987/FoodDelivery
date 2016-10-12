<?PHP

    $this->load->view("includes/Customer/header");
  
?>

<?php
$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'value' => set_value('login'),
	'maxlength'	=> 80,
	'color'=>"#888",
	'size'	=> 30,
	'placeholder'=>"",
	'class'=>"form-control inputAlt",


);


if ($login_by_username AND $login_by_email) {
	$login_label = 'Email or login';
} else if ($login_by_username) {
	$login_label = 'Login';
} else {
	$login_label = 'Email';
}

$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'size'	=> 30,
	'type'=>"password",
	'color'=>"#888",
	'placeholder'=>"",
	'class'=>"form-control inputAlt"
);
$check = array(
	'name'	=> 'check',
	'id'	=> 'roundedOne',
	'value'	=> 1,
	'checked'	=> set_value('check'),
	'type'=>"checkbox",


);
$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'maxlength'	=> 8,
);
?>


 <style>

            .loginArea {
                padding: 0 20px;
                margin: 10px;
                border: 1px solid #eee;
                border-radius: 10px;
            }
            .signText{
                font-weight: normal;
                text-transform: capitalize;
              
            }
            .text-forgot{
                text-decoration: underline;
                color: #888 !important;
                font-size: 18px;
            }
            .text-new-user{
                text-decoration: underline;
                color: #73B720 !important;
                font-size: 18px;
            }
            .new-lable{
                font-size: 17px;
                font-weight: normal;
            }
            input.form-control{
                border: 1px solid #333;
                border-radius: 10px;
            }
            .new-lable
            {
            color: #888 !important;
            }
            /*.mobile-txt h4{
           color: #888 !important;
            }*/
            .text-red p
            {
             color: red !important;
            }
            
            .text-red 
            {
             color: red !important;
            }
            
        </style>
 <script type="text/javascript">
    function customRadio(radioName){
        var radioButton = $('input[name="'+ radioName +'"]');
        $(radioButton).each(function(){
            $(this).wrap( "" );
            if($(this).is(':checked')){
                $(this).parent().addClass("selected");
            }
        });
        $(radioButton).click(function(){
            if($(this).is(':checked')){
                $(this).parent().addClass("selected");
            }
            $(radioButton).not(this).each(function(){
                $(this).parent().removeClass("selected");
            });
        });
    }
    $(document).ready(function (){
        customRadio("check");
        customRadio("policy");
        customRadio("search-engine");            
        customRadio("confirm");
    })
</script>    



<div class="container">
            <div class="row">
                <div class="col-sm-offset-3 col-sm-6">
                <?PHP echo $this->session->flashdata("change_pass_msg"); ?>
                    <h3 class="signText">Sign in</h3>
                   <?php echo form_open($this->uri->uri_string()); ?>
                        <div class="loginArea">
                            <div class="form-group mobile-txt">
                                <h4>Mobile/Email</h4>
                                 <?php echo form_input($login); ?>
            
            <span class="text-red"><?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?></span>
                            </div>
                            <div class="form-group mobile-txt">
                                <h4>Password</h4>
                                 <?php echo form_password($password); ?>

          <span class="text-red"> <?php echo form_error($password['name']); ?><?php echo isset($errors[$password['name']])?$errors[$password['name']]:''; ?></span>
                            </div>
                        </div>
                        <div class="col-xs-12 have-txtoutbox">
                            <div class="form-group">
                                <div class="roundedOne">
                                
                                     
                                    <?php echo form_checkbox($check); ?>
                                      
                                    <label for="roundedOne"><span class="new-lable"> Keep me logged in.</span></label>
                               
                                
</div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">    
                                <a href="/forgot_pass/" class="text-forgot">Forgot Password?</a>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group text-right">    
                                <a href="/customer_register/" class="text-new-user">New User</a>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="margin20"></div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="col-xs-6">
                                    <div class="form-group">    
                                        <button type="submit" class="btn btn-block btn-success-new login_button">LOG IN</button>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                  <?php echo form_close(); ?>
                </div>
            </div>
        </div>

 <div class="advert">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <img class="img-responsive center-block" alt="" src="<?PHP echo base_url(); ?>/assets/Customer/img/add.jpg"/>
                    </div>
                </div>
            </div>
        </div>




<?PHP
   $this->load->view("includes/Customer/footer");
?>
 