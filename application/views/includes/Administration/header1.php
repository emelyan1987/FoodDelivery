<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Admin | Dashboard</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="<?PHP echo base_url();  ?>assets/Administration/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">     
        <link rel="stylesheet" href="<?PHP echo base_url();  ?>assets/Administration/dist/css/roxApp.css">
        <link rel="stylesheet" href="<?PHP echo base_url();  ?>assets/Administration/dist/css/skins/_all-skins.css">
        <link rel="stylesheet" href="<?PHP echo base_url();  ?>assets/Administration/plugins/iCheck/flat/blue.css">
        <link rel="stylesheet" href="<?PHP echo base_url();  ?>assets/Administration/plugins/morris/morris.css">
        <link rel="stylesheet" href="<?PHP echo base_url();  ?>assets/Administration/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
        <link rel="stylesheet" href="<?PHP echo base_url();  ?>assets/Administration/plugins/datepicker/datepicker3.css">
        <link rel="stylesheet" href="<?PHP echo base_url();  ?>assets/Administration/plugins/daterangepicker/daterangepicker-bs3.css">
        <link rel="stylesheet" href="<?PHP echo base_url();  ?>assets/Administration/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    </head>
    <body class="hold-transition skin-green">
        <div class="wrapper">
          <header class="main-header">
            <!-- Logo -->
            <a href='/Dashboard/' class="logo">
                <img class="logoImg" src="<?PHP echo base_url();  ?>assets/Administration/images/logo.png">
            </a>
            <nav class="navbar navbar-static-top" role="navigation">
              <!-- Sidebar toggle button-->
              <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
              </a>
              <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                  <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <img src="<?PHP echo base_url();  ?>assets/Administration/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                      <span class="hidden-xs"><?PHP  
                            if($this->tank_auth->is_logged_in()) 
                            {

                            echo $this->tank_auth->get_username();
                                    }
                                   else
                                  {

                           redirect('/login/');
                                 }

                       ?></span>
                    </a>
                    <ul class="dropdown-menu">
                      <!-- User image -->
                      <li class="user-header">
                        <img src="<?PHP echo base_url();  ?>assets/Administration/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                        <p>
                          <?PHP  echo $this->tank_auth->get_username(); ?>
                          <small>Member since Nov. 2012</small>
                        </p>
                      </li>
                      <!-- Menu Body -->
                      <li class="user-body">
                        <div class="col-xs-4 text-center">
                          <a href="#">Followers</a>
                        </div>
                        <div class="col-xs-4 text-center">
                          <a href="#">Sales</a>
                        </div>
                        <div class="col-xs-4 text-center">
                          <a href="#">Friends</a>
                        </div>
                      </li>
                      <!-- Menu Footer-->
                      <li class="user-footer">
                        <div class="pull-left">
                          <a href="/admin_profile/" class="btn btn-default btn-flat">Profile</a>
                        </div>
                        <div class="pull-right">
                          <a href="/logout/" class="btn btn-default btn-flat">Sign out</a>
                        </div>
                      </li>
                    </ul>
                  </li>
                  <!-- Control Sidebar Toggle Button -->
<!--                  <li>
                    <a href="#">Login <i class="fa fa-sign-in"></i></a>
                  </li>-->
                </ul>
              </div>
            </nav>
          </header>