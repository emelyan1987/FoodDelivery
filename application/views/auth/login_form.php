<?php
$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'value' => set_value('login'),
	'maxlength'	=> 80,
	'size'	=> 30,
	'placeholder'=>"Email/Owner Code",
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
	'placeholder'=>"Password",
	'class'=>"form-control inputAlt"
);
$remember = array(
	'name'	=> 'remember',
	'id'	=> 'remember',
	'value'	=> 1,
	'checked'	=> set_value('remember'),
	'type'=>"checkbox",


);
$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'maxlength'	=> 8,
);
?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Log in</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?PHP echo base_url(); ?>assets/Administration/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="<?PHP echo base_url(); ?>assets/Administration/dist/css/roxApp.css">
    

    <style>
        
/* ROUNDED ONE CHECKBOX*/
.roundedOne input{
    margin: 8px;
}
.roundedOne>label>span{
    padding-left: 40px;
    min-width: 200px;
    display: inline-block;
}
.roundedOne {
  width: 28px;
  height: 28px;
  background: #fcfff4;
        
  background: -webkit-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
  background: -moz-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
  background: -o-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
  background: -ms-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
  background: linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fcfff4', endColorstr='#b3bead',GradientType=0 );
  /*margin: 20px auto;*/

  -webkit-border-radius: 50px;
  -moz-border-radius: 50px;
  border-radius: 50px;

  -webkit-box-shadow: inset 0px 1px 1px white, 0px 1px 3px rgba(0,0,0,0.5);
  -moz-box-shadow: inset 0px 1px 1px white, 0px 1px 3px rgba(0,0,0,0.5);
  box-shadow: inset 0px 1px 1px white, 0px 1px 3px rgba(0,0,0,0.5);
  position: relative;
}

.roundedOne label {
    cursor: pointer;
    position: absolute;
    width: 20px;
    height: 20px;
    -webkit-border-radius: 50px;
    -moz-border-radius: 50px;
    border-radius: 50px;
    left: 4px;
    top: 4px;
    background: #fff;
}

.roundedOne label:after {
    opacity: 0;
    content: '';
    position: absolute;
    width: 16px;
    height: 16px;
    background: #73B720;
    -webkit-border-radius: 50px;
    -moz-border-radius: 50px;
    border-radius: 50px;
    top: 2px;
    left: 2px;
}

.roundedOne label:hover::after {
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=30)";
  filter: alpha(opacity=30);
  opacity: 0.3;
}

.roundedOne input[type=checkbox]:checked + label:after {
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
  filter: alpha(opacity=100);
  opacity: 1;
}

.roundedOne input[type=radio]:checked + label:after {
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
  filter: alpha(opacity=100);
  opacity: 1;
}
    </style>
  </head>




  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-box-body">
          <a href="#">
              <img src="<?PHP echo base_url(); ?>assets/Administration/images/logo2.png" class="center-block" alt="" />

          </a>
           <?PHP echo $this->session->flashdata("change_pass_msg"); ?>
          <h3 class="text-center">LOGIN</h3>
        <?php echo form_open($this->uri->uri_string()); ?>
          <div class="form-group">
            <?php echo form_input($login); ?>
            
            <span class="text-red"><?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?></span>
          </div>
          <div class="form-group">

            <?php echo form_password($password); ?>

          <span class="text-red"> <?php echo form_error($password['name']); ?><?php echo isset($errors[$password['name']])?$errors[$password['name']]:''; ?></span>

          </div>
          <div class="row">
            <div class="col-xs-6">
               <div class="roundedOne">
                <?php echo form_checkbox($remember); ?>
                <label for="remember"><span> Remember Me </span></label>
                </div>
            </div><!-- /.col -->
            <div class="col-xs-6">
                <a class="forgotPass" href="/forgot_password/">Forgot password ?</a>
            </div><!-- /.col -->
            <div class="col-md-12">
                <button type="submit" class="btn btn-success btn-block btn-flat btn-alt">Login</button>
            </div>
          </div>
        <?php echo form_close(); ?>
        <br/>
        <hr/>
        <h4 class="text-center">Download our App at</h4>
        <br/>
        <div class="mobile-app-links text-center">
            <div class="row">
                <div class="col-md-6">
                    <a href="#">
                        <img class="img-responsive" src="<?PHP echo base_url(); ?>assets/Administration/images/app.png" alt="">
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="#">
                        <img class="img-responsive" src="<?PHP echo base_url(); ?>assets/Administration/images/play.png">
                    </a>
                </div>
            </div>
        </div><!-- /.social-auth-links -->
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
    <!-- jQuery 2.1.4 -->
    <script src="<?PHP echo base_url(); ?>assets/Administration/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?PHP echo base_url(); ?>assets/Administration/bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    




  </body>
</html>



