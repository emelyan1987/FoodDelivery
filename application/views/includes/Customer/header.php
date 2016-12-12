<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
    <title>Mataam</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/assets/Customer/dist/css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <script src="/assets/Customer/dist/js/jQuery-2.2.1.js" type="text/javascript"></script>
    <script src="/assets/Customer/dist/js/bootstrap.js" type="text/javascript"></script>
    <link href="/assets/Customer/dist/css1/roxWeb1.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/Customer/dist/css/animate.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/common/plugins/rating/jquery.rateyo.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/Customer/dist/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css"/>
    <script src="/assets/Customer/dist/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <script src="/assets/common/bootbox.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <!-- <link rel="stylesheet" href="https://fgelinas.com/code/timepicker/jquery.ui.timepicker.css?v=0.3.3"> -->
    <!-- <script src="https://fgelinas.com/code/timepicker/jquery.ui.timepicker.js?v=0.3.3"></script> -->

    <script type="text/javascript" src="/assets/Administration/dist/js/jquery.timepicker.js"></script>
    <script src="<?PHP echo base_url();  ?>assets/Administration/plugins/daterangepicker/daterangepicker.js"></script>
    <script src="<?PHP echo base_url();  ?>assets/Administration/plugins/datepicker/bootstrap-datepicker.js"></script>

    <style>
        .goog-te-banner-frame.skiptranslate {
            display: none !important;
        }
        body {
            position: static !important;
            top: 0px !important;
        }
        ul.translation-links {
            list-style: none;
            position: relative;
            display: inline-block;
            padding: 0px;
        }
        .mySearchBoxIcon
        {
            position: absolute;
            top: 20px;
            left: 30px;
            font-size: 20px;
            color: #888;
        }
        a{
            color: #222;
        }
        .cartBtnNew {
            background: #73b720 !important;
            color: #fff !important;
        }
    </style>
    <!--added by vakeel-->
    <link rel="stylesheet" href="/assets/Customer/dist/css/default.css"  type="text/css" >
    <link rel="stylesheet" href="/assets/common/dist/css/main.css"  type="text/css" >
    <link rel="stylesheet" href="/assets/Customer/dist/css/responsivevk.css" type="text/css">
    <!--added by vakeel-->
</head>
<body>
<header>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="row">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-controls="navbar">
                        <!--<span class="sr-only"></span>-->
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href=""><i class="fa fa-globe"></i> العربية</a></li>
                        <li>
                        <?php $user_id = $this->session->userdata('user_id');?>
                        <?php if ($user_id != '') {?>
                            <ul class="nav navbar-nav navbar-left">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <span class="fa fa-bars"></span>
                                        <span class="iglyphicon glyphicon-chevron-down2">Menu</span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="/customer_dashboard/orders">My Orders</a>
                                            <a href="/customer_dashboard/reservations">My Reservation</a>
                                            <a href="/customer_dashboard/points">My Points</a>
                                            <a href="/customer_dashboard/settings">My Settings</a>
                                            <a href="/customer_dashboard/promotions">Promotions</a>
                                            <a href="/customer_dashboard/addresses">My Address</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                        </li>
                                        <li>
                                            <a href="/customer_logout/"><i class="fa fa-sign-out"></i>
                                                Logout</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            <?php }?>
                        <li>
                            <?php
                                if (@$_SESSION['Customer_User_Id'] == '') {
                                ?>
                                <?php
                                    if ($user_id != "") {?>
                                    <!-- <a href="/logout/">Logout</a> -->
                                    <?php } else {?>
                                    <a href="/customer_login/">Log In</a>
                                    <?php }
                                ?>
                                <div class="login-dropdown">
                                    <form>
                                        <?php
                                            if (@$_SESSION['UserMobileNo'] == '') {
                                                $disStyle1 = 'style="display:block"';
                                                $disStyle2 = 'style="display:none"';
                                                $disStyle3 = 'style="display:none"';
                                            } else {
                                                $disStyle1 = 'style="display:none"';
                                                $disStyle2 = 'style="display:block"';
                                                $disStyle3 = 'style="display:none"';
                                            }
                                        ?>
                                        <div <?php echo $disStyle1;?> id="login_div1">
                                            <h4  id="mobile_text">Insert your mobile number</h4>
                                            <span class="mobileFixDigits">+965</span>
                                            <input type="text" class="login-input" id="login1" maxlength="80" size="10" onKeyUp="is_mobile_valid12(this.value)" autocomplete="off" >
                                            <div id="msgDiv12" class="input-group" ></div>
                                            <span id="mobile_msg12" style="color:red;"></span>
                                            <button type="button" class="btn btn-success-new-sm" onClick="cust_login1()">SEND CODE</button>
                                        </div>
                                        <div <?php echo $disStyle2;?> id="login_div2">
                                            <h4  id="mobile_text">Insert Code</h4>
                                            <input type="text" class="otp-input" name="login_otp1" id="login_otp1" placeholder="Enter Your OTP" autocomplete="off">
                                            <div id="msgDiv123" class="input-group" ></div>
                                            <span id="mobile_msg123" style="color:red;"></span>
                                            <p class="text-center" >Haven't received code yet?</p>
                                            <p class="text-center" id="resend_msg"></p>
                                            <button type="button" class="btn btn-default center-block" onClick="code_resend()">Re-send</button>
                                            <br>
                                            <button  type="button" class="btn btn-success-new-sm" onClick="cust_login2()">SUBMIT</button>
                                        </div>
                                        <div <?php echo $disStyle3;?> id="login_div3">
                                            <h4  id="mobile_text">Success</h4>
                                            <br>
                                            <p class="text-center" >You have been successfully verified! </p>
                                            <br>
                                            <button type="button" class="btn btn-default center-block" id="btnok">OK</button>
                                        </div>
                                    </form>
                                </div>
                                <?php
                                }
                            ?>
                        </li>
                        </li>
                        <?php
                            if (@$_SESSION['Customer_User_Id'] != '') {
                            ?>
                            <li><a href="/mycart/" class="cartBtnNew"><span id="cart-count-display"><?php mycartValue($_SESSION['Customer_User_Id']);?></span><i class="fa fa-shopping-cart"></i> My Cart</a></li>
                            <?php
                            } else {
                            ?>
                            <li><a href="#" class="cartBtnNew"><i class="fa fa-shopping-cart"></i> My Cart</a></li>
                            <?php
                            }
                        ?>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </div>
    </nav>
    <div class="themeHeader bg-green-light">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="logoSection">
                        <a href="<?php echo base_url();?>"><img class="img-responsive center-block" src="/assets/Customer/img/logo.png" alt="companyLogo"/></a>
                    </div>
                </div>
                <!--<div class="col-md-offset-6 col-md-3">
                <div class="liveChatSection">
                <a href="http://restro.powersoftware.eu/add_chatname/"><img class="liveChatImg" alt="" src="/assets/Customer/img/livechat.png"/></a>
                <span>
                Live Chat
                </span>
                </div>
                </div>-->
            </div>
        </div>
    </div>
</header>
<script>
    $('.login-toggle').click(function (){
        $('#myLogin').toggleClass('login');
        $('.login-dropdown').toggleClass('blockedContent');
    });
    $('#btnok').click(function (){
        window.location.reload(true);
    });
</script>
<script>
    function is_mobile_valid12(txtPhone) {
        var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
        if (filter.test(txtPhone) && txtPhone.length==10) {
            $("#mobile_msg12").text("");
        }
        else {
            $("#mobile_msg12").text("Please enter correct mobile no");
            $("#mobile_msg12").css("color","red");
        }
    }
</script>
<script>
    function cust_login1(){
        var mobile_no = document.getElementById('login1').value;
        $.ajax({
            url: "/ajax_customer_login/",
            type: "post",
            data: {mobile_no:mobile_no},
            success: function (response) {
                if(response == 1)
                {
                    $("#msgDiv12").html('<span class="text-green">Your Login OTP Code Sent on Your Mobile , Please Check</span>');
                    document.getElementById('login_div1').style.display = "none";
                    document.getElementById('login_div2').style.display = "block";
                }
                else
                {
                    $("#msgDiv12").html('<span class="text-red">Please enter correct mobile no</span>');
                }
            }
        })
    }
    function cust_login2(){
        var login_otp = document.getElementById('login_otp1').value;
        $.ajax({
            url: "/ajax_customer_otp_login/",
            type: "post",
            data: {login_otp:login_otp},
            success: function (response) {
                document.getElementById('login_div1').style.display = "none";
                document.getElementById('login_div2').style.display = "none";
                document.getElementById('login_div3').style.display = "block";
            }
        })
    }
    function code_resend(){
        $.ajax({
            url: "/login_otp_resend/",
            type: "post",
            data: {},
            success: function (response) {
                $("#resend_msg").html(response);
            }
        })
    }
</script>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/5734cb59ea1b02160f843dea/default';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
    })();
            </script>
            <!--End of Tawk.to Script-->