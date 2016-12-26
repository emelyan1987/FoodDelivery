<?php
    $this->load->helper('restaurant_helper');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Dashboard</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?PHP echo base_url();?>assets/Administration/bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"/>
    <link rel="stylesheet" href="<?PHP echo base_url();?>assets/Administration/dist/css/roxApp.css"/>
    <link rel="stylesheet" href="<?PHP echo base_url();?>assets/Administration/dist/css/skins/_all-skins.css"/>
    <!--<link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">-->
    <link rel="stylesheet" href="<?PHP echo base_url();?>assets/Administration/plugins/iCheck/flat/blue.css"/>
    <link rel="stylesheet" href="<?PHP echo base_url();?>assets/Administration/plugins/morris/morris.css"/>
    <link rel="stylesheet" href="<?PHP echo base_url();?>assets/Administration/plugins/jvectormap/jquery-jvectormap-1.2.2.css"/>
    <link rel="stylesheet" href="<?PHP echo base_url();?>assets/Administration/plugins/datepicker/datepicker3.css"/>
    <link rel="stylesheet" href="<?PHP echo base_url();?>assets/Administration/plugins/daterangepicker/daterangepicker-bs3.css"/>
    <link rel="stylesheet" href="<?PHP echo base_url();?>assets/Administration/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css"/>
    <link href="<?PHP echo base_url();?>assets/Administration/dist/css/main.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" type="text/css" href="/assets/Administration/dist/css/jquery.timepicker.css" />
    <link rel="stylesheet" type="text/css" href="/css/main.css" />


    <style>

        div#google_translate_element { display: inline-block; max-width: 150px; }
        .goog-te-menu2-item-selected>span.text:first-child{display:none}
        .goog-te-menu-frame skiptranslate { display:none; }
        .goog-te-banner-frame { display:none; }
        .goog-te-gadget-icon{ background:none !important; }
        .goog-te-gadget-simple
        { padding: 15px 0px !important; border: none !important; margin: 0px !important; position: relative; background: #73b720; box-shadow: 0 1px 1px rgba(50,50,50,0.1);
        cursor: pointer; outline: none; font-weight: bold;  }

        .goog-te-gadget { font-family: arial; font-size: 11px; color: #666; white-space: nowrap; }
        .goog-te-gadget img { display:none; }
        .goog-te-gadget-simple img{ background-image:hide; background-image:NONE; }
        body{ position: inherit !important; min-height: 100%; top: 0px; }
        .goog-te-gadget-simple span { color: #fff !important; }
        .goog-te-gadget-simple { background-color:transparent !important; }
        @media (max-width: 991px) {
            div#google_translate_element{
            position: fixed;
            z-index: 444;
            right: 0px;
            top: 0px;
        }
        .main-header .logo {
            text-align : left;
        }

        }

        .languageOption{
            display: block;
            float: left;
            height: 50px;
            line-height: 50px;
            color: #fff;
        }

        .languageOption img{
            margin: 0 5px;
            max-width: 30px;
        }
        @media (max-width: 991px){
            .languageOption{
            position: absolute;
            z-index: 444;
            right: 0px;
            top: -50px;
        }
        }
    </style>


    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'ar,en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
        }
    </script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script>

</head>
<body class="hold-transition skin-green">
<div class="wrapper">
<header class="main-header">
    <!-- Logo -->
    <a href="/Dashboard/" class="logo">
        <img class="logoImg" src="<?PHP echo base_url();?>assets/Administration/images/logo.png">
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="languageOption"><!--Language <img src="http://restro.powersoftware.eu/assets/Administration/images/icon/languageIcon1.png" alt=""><img src="http://restro.powersoftware.eu/assets/Administration/images/icon/languageIcon2.png" alt="">--></div>
        <!--<div id="google_translate_element"></div>-->
        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <li class="dropdown user user-menu">

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?PHP echo getAdminImage($this->tank_auth->get_user_id());?>" class="user-image">
                        <span class="hidden-xs"><?PHP
                            if ($this->tank_auth->is_logged_in()) {

                                echo "Welcome " . getAdminName($this->tank_auth->get_user_id());
                            } else {

                                redirect('/login/');
                            }

                        ?></span>
                    </a>

                    <ul class="dropdown-menu">


                        <!-- User image -->
                        <li class="user-header">

                            <img src="<?PHP echo getAdminImage($this->tank_auth->get_user_id());?>" class="img-circle">
                            <p>
                                <?PHP echo getAdminName($this->tank_auth->get_user_id()); //echo $this->tank_auth->get_username(); ?>
                                <!--<small>Member since Nov. 2012</small>-->
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <!--<li class="user-body">
                        <div class="col-xs-4 text-center">
                        <a href="#">Followers</a>
                        </div>
                        <div class="col-xs-4 text-center">
                        <a href="#">Sales</a>
                        </div>
                        <div class="col-xs-4 text-center">
                        <a href="#">Friends</a>
                        </div>
                        </li>-->
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="/admin_profile/" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="/admin_change_password/" class="btn btn-default btn-flat">Password</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <li><a href="/logout/">Log out</a></li>
                <!-- Control Sidebar Toggle Button -->
                <!--                  <li>
                <a href="#">Login <i class="fa fa-sign-in"></i></a>
                </li>-->
            </ul>
        </div>
    </nav>
          </header>