<?php
$new_password = array(
	'name'	=> 'new_password',
	'id'	=> 'new_password',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
	'placeholder'=>"New Password",
	'class'=>"form-control",
);
$confirm_new_password = array(
	'name'	=> 'confirm_new_password',
	'id'	=> 'confirm_new_password',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size' 	=> 30,
	'placeholder'=>"Confirm New Password",
	'class'=>"form-control",
);
$btn = array(
	'class' => 'btn btn-success btn-block btn-flat',
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
    <link rel="stylesheet" href="<?PHP echo base_url(); ?>assets/Administration/plugins/iCheck/square/blue.css">
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
          <a href="#">
              <img src="<?PHP echo base_url(); ?>assets/Administration/images/logo.png" alt="" />
          </a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <!--<p class="login-box-msg">Sign in to start your session</p>-->





        <?php echo form_open($this->uri->uri_string()); ?>
          <div class="form-group">
            	<?php echo form_label('New Password', $new_password['id']); ?>
				<?php echo form_password($new_password); ?>
				<?php echo form_error($new_password['name']); ?><?php echo isset($errors[$new_password['name']])?$errors[$new_password['name']]:''; ?>
			</div>
		  <div class="form-group">
				<?php echo form_label('Confirm New Password', $confirm_new_password['id']); ?>
				<?php echo form_password($confirm_new_password); ?>
				<?php echo form_error($confirm_new_password['name']); ?><?php echo isset($errors[$confirm_new_password['name']])?$errors[$confirm_new_password['name']]:''; ?>
			
          </div>
          
          <div class="row">
            
            <div class="col-md-12">
                <?php echo form_submit('change', 'Change Password',$btn); ?>

            </div>
          </div>
        <?php echo form_close(); ?>
        <br/>
        <h4 class="text-center">Download Our app at</h4>
        <div class="mobile-app-links text-center">
            <div class="row">
                <div class="col-md-6">
                    <a href="#">
                        <img class="img-responsive" src="<?PHP echo base_url(); ?>assets/Administration/images/app.png">
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
    <script src="<?PHP echo base_url(); ?>assets/Administration/plugins/iCheck/icheck.min.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>









