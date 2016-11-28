<style>
    .choose_btn_gray{font-size:16px; box-shadow:0 -27px 0 rgba(0, 0, 0, 0.18) inset;  height:50px; padding-top:10px; font-weight:bold; margin-top:15px; width:90% !important;}
    .choose_btn{font-size:16px; box-shadow:0 -27px 0 rgba(0, 0, 0, 0.18) inset;  height:50px; padding-top:10px; font-weight:bold; margin-top:15px; width:90% !important;}
    .roundedOne{margin-left:3px;}
    .succ { padding-left: 15px; font-size: 28px; font-family: "Trebuchet MS", Arial, Helvetica, sans-serif; }
    .get-outbox h1{padding-left:144px !important;}
    .time_out_box_new{margin-left:-84px !important;}
    .pick_leftsection{margin-left:130px !important;}
    .input-group.bootstrap-timepicker.timepicker{margin-left:20px;}
    .col-md-10.enter_section{margin-left:-11px;}
    .white_bg textarea{
        width:100% !important;
    max-width: 100%;
    max-height: 100%;
    }
    .white_bg {
        width: 100% !important;
          padding: 17px 13px !important;
    }
    select {
        appearance:normal;
        -moz-appearance:normal; /* Firefox */
        -webkit-appearance:normal; /* Safari and Chrome */
        padding: 0 0 0 36%;
    }
</style>
<script type="application/javascript">
    /** After windod Load */
    $(window).bind("load", function() {
        window.setTimeout(function() {
            $(".succ").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
            });
        }, 4000);
    });
</script>
<script type="text/javascript">
    function customRadio(radioName){
        var radioButton = $('input[name="'+ radioName +'"]');
        $(radioButton).each(function(){
            $(this).wrap( "<span class='custom-radio'></span>" );
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
        customRadio("work_time");
        customRadio("search-engine");
        customRadio("confirm");
    })
</script>
<?PHP
$this->load->view("includes/Customer/header");
$this->load->helper('customer_helper');
?>
<?php echo form_open_multipart('')?>
<div class="container-fluid">
    <div class="myNewTemplate">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-12 get-outbox">
                    <h1>Get started</h1>
                    <h3 class="succ"> <?php if ($this->session->flashdata('successMsg') != '') {
	echo $this->session->flashdata('successMsg');}
?></h3>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-1"></div>
                        <div class="col-md-5">
                            <div class="resturant_box">
                                <input type="text" name="restro_name" id="restro_name" placeholder="Restaurant Name" value="<?php echo set_value('restro_name');?>" class="resInput">
                                <?php echo form_error('restro_name', '<p style="color:#F83A18">', '</p>');?>
                            </div>
                            <div class="resturant_box">
                                <input type="text" name="restro_phone" id="restro_phone" placeholder="Restaurant Phone Number" value="<?php echo set_value('restro_phone');?>" class="resInput">
                                <?php echo form_error('restro_phone', '<p style="color:#F83A18">', '</p>');?>
                            </div>
                            <div class="resturant_box">
                                <select class="selectpicker btn_bg" name="restro_address" id="restro_address" data-style="btn-primary">
                                    <option value="">Resturant Address</option>
                                    <?php foreach ($city as $ks => $it): ?>
                                        <option value="<?php echo $it->id;?>" ><?php echo ucwords($it->name) . " , " . ucwords($it->city_name);?></option>
                                    <?php endforeach;?>
                                    `                                   </select>
                                    <?php echo form_error('restro_address', '<p style="color:#F83A18">', '</p>');?>
                                </div>
                                <div class="resturant_box">
                                    <select class="selectpicker btn_bg" name="main_cuisine" id="main_cuisine" data-style="btn-primary">
                                        <option value="">Main Cuisine</option>
                                        <?php foreach ($cuisin_list as $ks => $cuis): ?>
                                            <option value="<?php echo $cuis->id;?>"><?php echo $cuis->name;?></option>
                                        <?php endforeach;?>
                                        `                                   </select>
                                        <?php echo form_error('main_cuisine', '<p style="color:#F83A18">', '</p>');?>
                                    </div>
                                    <div class="resturant_box">
                                        <input type="email" name="restro_email" id="restro_email" placeholder="Restaurant Email" value="<?php echo set_value('restro_email');?>" class="resInput">
                                        <?php echo form_error('restro_email', '<p style="color:#F83A18">', '</p>');?>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="resturant_box">
                                        <input type="text"  name="contact_name" id="contact_name" placeholder="Contact Name" value="<?php echo set_value('contact_name');?>" class="resInput">
                                        <?php echo form_error('contact_name', '<p style="color:#F83A18">', '</p>');?>
                                    </div>
                                    <div class="resturant_box">
                                        <input type="text"  name="cell_phone" id="cell_phone" placeholder="Cell Phone Number" value="<?php echo set_value('cell_phone');?>" class="resInput">
                                        <?php echo form_error('cell_phone', '<p style="color:#F83A18">', '</p>');?>
                                    </div>
                                    <div class="resturant_box">
                                        <input type="text"  name="contact_email" id="contact_email" placeholder="Contact Email Address" value="<?php echo set_value('contact_email');?>" class="resInput">
                                        <?php echo form_error('contact_email', '<p style="color:#F83A18">', '</p>');?>
                                    </div>
                                    <div class="resturant_box">
                                        <input type="text"  name="secondary_cuisine" id="secondary_cuisine" placeholder="Secondary Cuisines" value="<?php echo set_value('secondary_cuisine');?>" class="resInput">
                                        <?php echo form_error('secondary_cuisine', '<p style="color:#F83A18">', '</p>');?>
                                    </div>
                                    <div class="resturant_box">
                                        <input type="text"  name="about_us" id="about_us" placeholder="How did you hear about us" value="<?php echo set_value('about_us');?>" class="resInput">
                                        <?php echo form_error('about_us', '<p style="color:#F83A18">', '</p>');?>
                                    </div>
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-10 choose-outbox">
                                <h1>Choose the services you are intrested in</h1>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-12">
                                <div class="col-md-1"></div>
                                <div class="col-md-10">
                                    <div class="col-md-3">
                                        <div class="pickup-outbox">
                                            <div class="image_pickup text-center"><img src="/assets/Customer/img/pick_up_img.png" alt="" border="0"></div>
                                        </div>
                                        <div class="form-group">
                                            <a href="javascript:void(0);" onclick="showhide1()" id="pick_up_img" class="btn btn-block btn-success-new choose_btn gray_bg">CHOOSE</a>
                                            <div id="pick_up_img1" style="display:none;">
                                                <a href="javascript:void(0);" onclick="showhide8()" class="btn btn-block btn-success-new choose_btn">CHOOSE
                                                    <span class="right_sectionimg"><img src="/assets/Customer/img/right_arrow_img.png" alt="" border="0"></span></a>
                                                </div>
                                                <input type="hidden"  name="services[]" id="pick_up_img2" value="">
                                                <?php if (isset($servicesMsg)) {echo $servicesMsg;}
?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="pickup-outbox">
                                                <div class="image_pickup text-center"><img src="/assets/Customer/img/delivery_img.png" alt="" border="0"></div>
                                            </div>
                                            <div class="form-group">
                                                <a href="javascript:void(0);" onclick="showhide2()" id="delivery_img" class="btn btn-block btn-success-new choose_btn gray_bg">CHOOSE</a>
                                                <div id="delivery_img1" style="display:none;">
                                                    <a href="javascript:void(0);" onclick="showhide7()" class="btn btn-block btn-success-new choose_btn">CHOOSE
                                                        <span class="right_sectionimg"><img src="/assets/Customer/img/right_arrow_img.png" alt="" border="0"></span></a>
                                                    </div>
                                                    <input type="hidden"  name="services[]" id="delivery_img2" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="pickup-outbox">
                                                    <div class="image_pickup text-center"><img src="/assets/Customer/img/res_img.png" alt="" border="0"></div>
                                                </div>
                                                <div class="form-group">
                                                    <a href="javascript:void(0);" onclick="showhide3()" id="res_img" class="btn btn-block btn-success-new choose_btn gray_bg">CHOOSE</a>
                                                    <div id="res_img1" style="display:none;">
                                                        <a href="javascript:void(0);" onclick="showhide6()" class="btn btn-block btn-success-new choose_btn">CHOOSE
                                                            <span class="right_sectionimg"><img src="/assets/Customer/img/right_arrow_img.png" alt="" border="0"></span></a>
                                                        </div>
                                                        <input type="hidden"  name="services[]" id="res_img2" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="pickup-outbox">
                                                        <div class="image_pickup text-center"><img src="/assets/Customer/img/cat_img.png" alt="" border="0"></div>
                                                    </div>
                                                    <div class="form-group">
                                                        <a href="javascript:void(0);" onclick="showhide4()" id="cat_img" class="btn btn-block btn-success-new choose_btn gray_bg">CHOOSE</a>
                                                        <div id="cat_img1" style="display:none;">
                                                            <a href="javascript:void(0);" onclick="showhide5()" class="btn btn-block btn-success-new choose_btn">CHOOSE
                                                                <span class="right_sectionimg"><img src="/assets/Customer/img/right_arrow_img.png" alt="" border="0"></span></a>
                                                            </div>
                                                            <input type="hidden"  name="services[]" id="cat_img2" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <link href="https://cdn.jsdelivr.net/bootstrap.timepicker/0.2.6/css/bootstrap-timepicker.min.css" rel="stylesheet" />
                                        <script src="https://code.jquery.com/jquery-1.9.1.js"></script>
                                        <script src="https://cdn.jsdelivr.net/bootstrap.timepicker/0.2.6/js/bootstrap-timepicker.min.js"></script>
                                        <script type="text/javascript">
                                            $('#timepicker1').timepicker({
                                                showInputs: false
                                            });
                                        </script>
                                        <script type="text/javascript">
                                            $('#timepicker2').timepicker({
                                                showInputs: false
                                            });
                                        </script>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10 line_sectionpadding">
                                            <hr/>
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10 gray_sectionoutbox">
                                            <div class="col-md-8">
                                                <div class="gray_textbox">
                                                    <div class="white_bg">
                                                        <textarea  name="message" id="message" cols="45" rows="8" placeholder="Enter Your Message Here"><?php echo set_value('message');?></textarea>
                                                        <?php echo form_error('message', '<p style="color:#F83A18">', '</p>');?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1"></div>
                                            <div class="col-md-2 submit_btn">
                                                <div class="form-group">
                                                    <button type="submit" name="restro_reg" class="btn btn-block btn-success-new choose_btn sub">SUMBIT</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php echo form_close();?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="advert">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <img class="img-responsive center-block" alt="" src="/assets/Customer/img/add.jpg"/>
                        </div>
                    </div>
                </div>
            </div>
            <?php
//$this->load->view("includes/Customer/advertise");
$this->load->view("includes/Customer/footer");
?>
            <script>
                function showhide1()
                {
                    var div = document.getElementById("pick_up_img");
                    var div1 = document.getElementById("pick_up_img1");
                    if (div.style.display !== "none") {
                        div.style.display = "none";
                        div1.style.display = "block";
                        document.getElementById("pick_up_img2").value="Pickup";
                    }
                    else {
                        div.style.display = "block";
                        div1.style.display = "none";
                    }
                }
            </script>
            <script>
                function showhide2()
                {
                    var div = document.getElementById("delivery_img");
                    var div1 = document.getElementById("delivery_img1");
                    if (div.style.display !== "none") {
                        div.style.display = "none";
                        div1.style.display = "block";
                        document.getElementById("delivery_img2").value="Delivery";
                    }
                    else {
                        div.style.display = "block";
                        div1.style.display = "none";
                    }
                }
            </script>
            <script>
                function showhide3()
                {
                    var div = document.getElementById("res_img");
                    var div1 = document.getElementById("res_img1");
                    if (div.style.display !== "none") {
                        div.style.display = "none";
                        div1.style.display = "block";
                        document.getElementById("res_img2").value="Reservation";
                    }
                    else {
                        div.style.display = "block";
                        div1.style.display = "none";
                    }
                }
            </script>
            <script>
                function showhide4()
                {
                    var div = document.getElementById("cat_img");
                    var div1 = document.getElementById("cat_img1");
                    if (div.style.display !== "none") {
                        div.style.display = "none";
                        div1.style.display = "block";
                        document.getElementById("cat_img2").value="Catering";
                    }
                    else
                    {
                        $("#div1").hide("fast");
                        $("#div").show("fast");
                    }
                }
            </script>
            <script>
                function showhide5()
                {
                    var div = document.getElementById("cat_img");
                    var div1 = document.getElementById("cat_img1");
                    div1.style.display = "none";
                    div.style.display = "block";
                    document.getElementById("cat_img2").value="";
                }
            </script>
            <script>
                function showhide6()
                {
                    var div = document.getElementById("res_img");
                    var div1 = document.getElementById("res_img1");
                    div1.style.display = "none";
                    div.style.display = "block";
                    document.getElementById("res_img2").value="";
                }
            </script>
            <script>
                function showhide7()
                {
                    var div = document.getElementById("delivery_img");
                    var div1 = document.getElementById("delivery_img1");
                    div1.style.display = "none";
                    div.style.display = "block";
                    document.getElementById("delivery_img2").value="";
                }
            </script>
            <script>
                function showhide8()
                {
                    var div = document.getElementById("pick_up_img");
                    var div1 = document.getElementById("pick_up_img1");
                    div1.style.display = "none";
                    div.style.display = "block";
                    document.getElementById("pick_up_img2").value="";
                }
            </script>