<?PHP
    $this->load->view("includes/Customer/header");
    date_default_timezone_set('Asia/Baghdad');
?>
<script>
    var ref = "DELIVERY";

    <?php if (isset($_GET['ref'])): ?>
        var ref = "<?=$_GET['ref']?>";
        <?php endif?>
</script>
<link href="/assets/Customer/plugins/datepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css"/>
<script src="/assets/Customer/plugins/datepicker/js/bootstrap-datetimepicker.min.js"></script>
<style>
    .ui-datepicker-week-end {
        position: absolute;
        /* top: 100%; */
        left: 0;
        z-index: 1000;
        display: none;
        float: left;
        min-width: 160px;
        padding: 5px 0;
        margin: 2px 0 0;
        font-size: 14px;
        text-align: left;
        list-style: none;
        background-color: #fff;
        -webkit-background-clip: padding-box;
        background-clip: padding-box;
        border: 1px solid #ccc;
        border: 1px solid rgba(0, 0, 0, .15);
        border-radius: 4px;
        -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
        box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
    }
    @media (max-width:499px){
    }
    @media only screen
    and (min-device-width : 375px)
    and (max-device-width : 667px) {.one_half:
        width: 100% !important;
    }
    @media (max-width: 768px){.fixoverlab{
        height: 660px !important;
    }}
</style>
<div class="container-fluid">
    <div class="myNewTemplate">
        <div class="row">
            <div class="col-md-12">
                <div class="one_half header_top_section">
                    <!--<div class="center-block">-->
                    <div class="drawingSection">
                        <div class="firstColumn">
                            <div class="insideFirstColumn" onclick="changeTab1()">
                                <img class="img-responsive myResImg center-block" src="/assets/Customer/img/icon/cock.png" alt=""/>
                                <span>Pickup</span>
                            </div>
                        </div>
                        <div class="secondColumn">
                            <div class="insideSecondColumn" onclick="changeTab2()">
                                <img class="img-responsive myResImg center-block" src="/assets/Customer/img/icon/car.png" alt=""/>
                                <span>Delivery</span>
                            </div>
                        </div>
                        <div class="thirdColumn">
                            <div class="insideThirdColumn" onclick="changeTab3()">
                                <img class="img-responsive myResImg center-block" src="/assets/Customer/img/icon/man.png" alt=""/>
                                <span>Catering</span>
                            </div>
                        </div>
                        <div class="fourthColumn">
                            <div class="insideFourthColumn" onclick="changeTab4()">
                                <img class="img-responsive myResImg center-block" src="/assets/Customer/img/icon/food.png" alt=""/>
                                <span>Reservation</span>
                            </div>
                        </div>
                    </div>
                    <!--</div>-->
                </div>
                <div class="one_half animated slideInRight pickupTab">
                    <div class="form-horizontal">
                        <form action="/filter?service=4" method="post">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Where Do You Eat?</label>
                                    <input type="hidden" name="filter_area" id="pickup_filter_city_id" required>
                                    <input class="form-control newInput text-center what_section" type="text" name="pickup_city"  onkeyup="pickup_cityFun(this.value)"  placeholder="Choose your Area" id="pickup_city" autocomplete="off" required>
                                    <div class="mySelectionDiv" id="cityShowpickup">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">What would you like?</label>
                                    <input class="form-control newInput text-center what_section"  onkeyup="showSuggesstion(this.value)" type="text" name="pickup_search_txt" id="pickup_search_txt" placeholder="Choose your Cuisine" autocomplete="off">
                                    <div class="mySelectionDiv" id="suggestionshow">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="hidden" name="filter_service" value="4">
                                    <button class="btn btn-primary btn-primary-new btn-block btn_new_section" type="submit">Find Restaurants</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="one_half animated slideInRight deliveryTab header_boxes_section" style="padding: 100px 108px 20px;">
                    <div class="form-horizontal">
                        <form action="/filter?service=1" method="post">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label class="control-label">Where do you eat?</label>
                                    <input type="hidden" name="filter_area" id="delivery_city_filter_id" required>
                                    <input class="form-control newInput what_section text-center" type="text" onkeyup="delivery_cityFun(this.value)"  placeholder="Choose your Area" id="delivery_city" autocomplete="off" required>
                                    <div class="mySelectionDiv" id="cityShow">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label class="control-label">What do you like?</label>
                                    <input class="form-control newInput text-center what_section" type="text" name="delivery_search_txt"  onkeyup="showSuggesstion1(this.value)"  placeholder="Choose your Cuisine" id="catering_search_txt" autocomplete="off">
                                    <div class="mySelectionDiv" id="suggestionshow1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="hidden" value="1" name="filter_service">
                                    <button type="submit" class="btn btn-success btn-success-new btn-block btn_new_section">Find Restaurant</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="one_half animated slideInRight cateringTab">
                    <div class="form-horizontal">
                        <form action="/filter?service=2" method="post">
                            <div class="col-md-11">
                                <div class="form-group">
                                    <label class="control-label">Catering date/time</label>
                                    <input class="form-control newInput text-center catering_outbox" type="text" name="cat_date" placeholder="13/03/2016" value="<?php echo date('d-m-Y');?>" id="catering_date" autocomplete="off" style="width: 50% !important;float: left !important;height: 50px;margin-left:32px; ">
                                    <input class="form-control newInput text-center openTimeController time_outbox" name="cat_time" id="catering_time" value="<?php echo date('h:m');?>" readonly="readonly" placeholder="hh:mm" style="float: left;width: 30% !important;height: 50px;">
                                    <div id="datetimepicker3" class="input-append">
                                        <!---Time Picker-->
                                        <div style="margin-top: 15px;">
                                            <span class="closeTimeInput">x</span>
                                            <select onchange="gettimevalue()" id="time1" style="height:30px;">
                                                <?php
                                                    for ($h = 1; $h <= 12; $h++) {
                                                    ?>
                                                    <option value="<?php if ($h < 10) {echo 0;}
                                                        ?><?php echo $h;?>"> <?php if ($h < 10) {echo 0;}
                                                    ?><?php echo $h;?></option>
                                                    <?php
                                                    }
                                                ?>
                                            </select>
                                            <select onchange="gettimevalue()" id="time2" style="height:30px;">
                                                <?php
                                                    for ($M = 1; $M <= 60; $M++) {
                                                    ?>
                                                    <option value="<?php if ($M < 10) {echo 0;}
                                                        ?><?php echo $M;?>"> <?php if ($M < 10) {echo 0;}
                                                    ?><?php echo $M;?></option>
                                                    <?php
                                                    }
                                                ?>
                                            </select>
                                            <select onchange="gettimevalue()" id="time3" style="height:30px;">
                                                <option value="AM">AM</option>
                                                <option value="PM">PM</option>
                                            </select>
                                        </div>
                                        <!---Time Picker-->
                                        <span class="add-on">
                                            <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                                            </i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-11">
                                <div class="form-group">
                                    <label class="control-label">Where Do You Eat?</label>
                                    <input type="hidden" name="filter_area" id="catering_filter_city_id" required>
                                    <input class="form-control what_section newInput text-center" type="text" name="catering_city"  onkeyup="delivery_cityFun1(this.value)"  placeholder="Choose your Area" id="catering_city" autocomplete="off" required>
                                    <div class="mySelectionDiv" id="cityShowcatering">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-11">
                                <div class="form-group">
                                    <label class="control-label">What would you like?</label>
                                    <input class="form-control newInput text-center what_section" type="text" name="catering_search_txt"  onkeyup="showSuggesstion1(this.value)"  placeholder="Choose your Cuisine" id="catering_search_txt" autocomplete="off">
                                    <div class="mySelectionDiv" id="suggestionshow1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-11">
                                <div class="form-group">
                                    <input type="hidden" value="2" name="filter_service">
                                    <button type="submit" class="btn btn-warning btn-warning-new btn-block btn_new_section">Find Restaurants</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="one_half animated red_section slideInRight reservationTab" style="margin-top: 0px;">
                    <div class="form-horizontal">
                        <form action="/filter?service=3" method="post">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-12">Reservation Date:</label>
                                    <div class="col-md-12" data-date-format="yyyy-mm-dd">
                                        <input class="newInput form-control text-center" type="text" placeholder="DD-MM-YYYY hh:mm" value="<?php echo date('Y-m-d h:i');?>" style="width: 64%;margin: 0 auto;height: 50px" id="reservation_date" name="reserve_time" required >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-12">Number Of Persons</label>
                                    <div class="col-md-12">
                                        <div class="center-block quantity">
                                            <button type="button" class="btn-minus-default" onclick="descrementval('res_user_limit')"><b><i class="fa fa-minus"></i></b></button>
                                            <input type="text" class="newInputQuantity light-bg text-center"  name="people_number" value="1" id="res_user_limit">
                                            <button type="button" class="btn-minus-red" onclick="incrementval('res_user_limit')"><b><i class="fa fa-plus"></i></b></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Where Do You Eat?</label>
                                    <input type="hidden" name="filter_area" id="reservation_filter_city_id" required>
                                    <input class="form-control newInput text-center what_section" type="text" name="reservation_city"  onkeyup="reservation_cityFun(this.value)"  placeholder="Choose your Area" id="reservation_city" autocomplete="off" required>
                                    <div class="mySelectionDiv" id="cityShowreservation">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">What would you like?</label>
                                    <input class="form-control newInput text-center what_section" type="text" placeholder="Choose your Cuisine"  name="reservation_search_txt" id="reservation_search_txt"  onkeyup="showSuggesstion2(this.value)" autocomplete="off">
                                    <div class="mySelectionDiv" id="suggestionshow2">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="hidden" value="3" name="filter_service">
                                    <button class="btn btn-danger btn-danger-new btn-block btn_new_section" type="submit">FIND RESTAURANT</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="mid_design_section">
            <a href="/Home_Restro_Filter/2">
                <div class="main_fourth">
                    <div class="upperLayer1">
                        <div class="innerLayer">
                            <h4>Featured Restaurant</h4>
                            <h5><?php echo $opening_soon_count;?> Places</h5>
                        </div>
                    </div>
                </div>
            </a>
            <a href="/Home_Restro_Filter/1">
                <div class="main_fourth">
                    <div class="upperLayer3">
                        <div class="innerLayer">
                            <h4>Newly Opened</h4>
                            <h5><?php echo $newly_count;?> Places</h5>
                        </div>
                    </div>
                </div>
            </a>
            <a href="/Home_Restro_Filter/3">
                <div class="main_fourth">
                    <div class="upperLayer2">
                        <div class="innerLayer">
                            <h4>Promotions</h4>
                            <h5><?php echo $luxury_count;?> Places</h5>
                        </div>
                    </div>
                </div>
            </a>
            <a href="/Home_Restro_Filter/4">
                <div class="main_fourth">
                    <div class="upperLayer4">
                        <div class="innerLayer">
                            <h4>Coupons </h4>
                            <h5><?php echo $trending_count;?> Places</h5>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
<!--<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<?php foreach ($advt as $ad => $adm): ?>
    <div class="main_fourth">
    <img class="img-responsive" src="<?php getImagePath($adm->image);?>">
    </div>
    <?php endforeach;?>
</div>
</div>
</div>-->
<div class="margin5"></div>
<div class="container fixoverlab">
    <div class="row">
        <div class="col-md-12">
            <div id="myCarousel" class="carousel fdi-Carousel slide homepagecarousel">
                <!-- Carousel items -->
                <div class="carousel fdi-Carousel slide" id="eventCarousel" data-interval="0">
                    <div class="carousel-inner onebyone-carosel">
                        <div class="item active">
                            <?php
                                $i1 = 0;
                                $i2 = 0;
                                $i3 = 0;
                                foreach ($advt1 as $ad => $adm): $i1 = 1;?>
                                <div class="col-md-4">
                                    <a href="#"><img src="<?php getImagePath($adm->image);?>" class="img-responsive center-block"></a>
                                </div>
                                <?php endforeach;?>
                        </div>
                        <div class="item">
                            <?php foreach ($advt2 as $ad => $adm): $i2 = 1;?>
                                <div class="col-md-4">
                                    <a href="#"><img src="<?php getImagePath($adm->image);?>" class="img-responsive center-block"></a>
                                </div>
                                <?php endforeach;?>
                        </div>
                        <div class="item">
                            <?php foreach ($advt3 as $ad => $adm): $i3 = 1;?>
                                <div class="col-md-4">
                                    <a href="#"><img src="<?php getImagePath($adm->image);?>" class="img-responsive center-block"></a>
                                </div>
                                <?php endforeach;?>
                        </div>
                    </div>
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <?php
                            if ($i1 == 1) {
                            ?>
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <?php
                            }
                            if ($i2 == 1) {
                            ?>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <?php
                            }
                            if ($i3 == 1) {
                            ?>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                            <?php
                            }
                        ?>
                    </ol>
                </div>
                <!--/carousel-inner-->
            </div><!--/myCarousel-->
        </div>
    </div>
</div>
<div class="bottomIconSection homebottomsection">
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="col-xs-12 col-sm-3 col-md-3 first_bottom_section">
                <img class="img-responsive center-block" alt="" src="/assets/Customer/img/icon/bottomIcon1.png"/>
                <h4 class="bottomIconTitle"><span>1</span> Choose Restaurant</h4>
            </div>
            <div class="col-xs-12 col-sm-3 col-md-3">
                <img class="img-responsive center-block" alt="" src="/assets/Customer/img/icon/bottomIcon2.png"/>
                <h4 class="bottomIconTitle"><span>2</span> Choose Food</h4>
            </div>
            <div class="col-xs-12 col-sm-3 col-md-3">
                <img class="img-responsive center-block" alt="" src="/assets/Customer/img/icon/bottomIcon3.png"/>
                <h4 class="bottomIconTitle"><span>3</span> Place Order</h4>
            </div>
            <div class="col-xs-12 col-sm-3 col-md-2">
                <img class="img-responsive center-block" alt="" src="/assets/Customer/img/icon/bottomIcon4.png"/>
                <h4 class="bottomIconTitle"><span>4</span> Enjoy</h4>
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
<?PHP
    $this->load->view("includes/Customer/footer");
?>
</body>
<script>
    function incrementval(str){
        var getval = document.getElementById(str).value;
        var newval = parseInt(getval)+1;
        document.getElementById(str).value = newval;
    }
    function descrementval(str){
        var getval = document.getElementById(str).value;
        if(getval > 1)
        {
            var newval = parseInt(getval)-1;
            document.getElementById(str).value = newval;
        }
    }
</script>
<script>
    $(document).ready(function(){
        $(".insideFirstColumn").css("opacity","0.5");
        $(".insideSecondColumn").css("opacity","1");
        $(".insideThirdColumn").css("opacity","0.5");
        $(".insideFourthColumn").css("opacity","0.5");
        $(".pickupTab").css("display","none");
        $(".deliveryTab").css("display","block");
        $(".cateringTab").css("display","none");
        $(".reservationTab").css("display","none");
    });
</script>
<script>
    //pickup
    function changeTab1(){
        $(".insideFirstColumn").css("opacity","1");
        $(".insideSecondColumn").css("opacity","0.5");
        $(".insideThirdColumn").css("opacity","0.5");
        $(".insideFourthColumn").css("opacity","0.5");
        $(".pickupTab").css("display","block");
        $(".deliveryTab").css("display","none");
        $(".cateringTab").css("display","none");
        $(".reservationTab").css("display","none");
    }
    //delivery
    function changeTab2(){
        $(".insideFirstColumn").css("opacity","0.5");
        $(".insideSecondColumn").css("opacity","1");
        $(".insideThirdColumn").css("opacity","0.5");
        $(".insideFourthColumn").css("opacity","0.5");
        $(".deliveryTab").css("display","block");
        $(".pickupTab").css("display","none");
        $(".cateringTab").css("display","none");
        $(".reservationTab").css("display","none");
    }
    // catering
    function changeTab3(){
        $(".insideFirstColumn").css("opacity","0.5");
        $(".insideSecondColumn").css("opacity","0.5");
        $(".insideThirdColumn").css("opacity","1");
        $(".insideFourthColumn").css("opacity","0.5");
        $(".deliveryTab").css("display","none");
        $(".pickupTab").css("display","none");
        $(".cateringTab").css("display","block");
        $(".reservationTab").css("display","none");
    }
    // reservation
    function changeTab4(){
        $(".insideFirstColumn").css("opacity","0.5");
        $(".insideSecondColumn").css("opacity","0.5");
        $(".insideThirdColumn").css("opacity","0.5");
        $(".insideFourthColumn").css("opacity","1");
        $(".deliveryTab").css("display","none");
        $(".pickupTab").css("display","none");
        $(".cateringTab").css("display","none");
        $(".reservationTab").css("display","block");
    }
</script>
<script type="text/javascript">
    function showSuggesstion(abc){
        if(abc != "")
        {
            $("#suggestionshow").show();
            $.ajax({
                url: "/ajax_suggestions/",
                type: "post",
                data: {textsearch:abc,divid:'pickup_search_txt'},
                success: function (response) {
                    $("#suggestionshow").html(response);
                }
            })
        }
        else
        {
            $("#suggestionshow").hide();
        }
    }
    function valuechangeintxt(txt,divid){
        if(divid == 'pickup_search_txt')
        {
            $("#suggestionshow").hide();
        }
        if(divid == 'catering_search_txt')
        {
            $("#suggestionshow1").hide();
        }
        if(divid == 'reservation_search_txt')
        {
            $("#suggestionshow2").hide();
        }
        document.getElementById(divid).value = txt;
    }
    function showSuggesstion1(abc){
        if(abc != "")
        {
            $("#suggestionshow1").show();
            $.ajax({
                url: "/ajax_suggestions/",
                type: "post",
                data: {textsearch:abc,divid:'catering_search_txt'},
                success: function (response) {
                    $("#suggestionshow1").html(response);
                }
            })
        }
        else
        {
            $("#suggestionshow1").hide();
        }
    }
    function showSuggesstion2(abc){
        if(abc != "")
        {
            $("#suggestionshow2").show();
            $.ajax({
                url: "/ajax_suggestions/",
                type: "post",
                data: {textsearch:abc,divid:'reservation_search_txt'},
                success: function (response) {
                    $("#suggestionshow2").html(response);
                }
            })
        }
        else
        {
            $("#suggestionshow2").hide();
        }
    }
</script>
<script>
    $(function() {
        var dateToday = new Date();
        var cDate = '<?=date("Y-m-d h:m")?>';
        $("#catering_date").datetimepicker({
            format: 'yyyy-mm-dd',
            linkField: "catering_time",
            linkFormat: "hh:ii",
            startDate: cDate,
            autoclose:true
        });
    });
    $(function() {
        var dateToday = new Date();
        var nowTemp = new Date();
        var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
        // console.log(now);
        // console.log(now.valueOf());
        // var checkin = $('#reservation_date').datepicker({
        // 	onRender: function(date) {
        // 		return date.valueOf() < now.valueOf() ? 'disabled' : '';
        // 	}
        // })
        var cDate = '<?=date("Y-m-d h:m")?>';
        $("#reservation_date").datetimepicker({
            format: 'yyyy-mm-dd hh:ii',
            linkFormat: "hh:ii",
            autoclose:true,
            startDate: cDate,
        });
        // var resDate = $( "#reservation_date" ).datepicker({
        // 	format: "dd-mm-yyyy",
        // 	todayHighlight: true,
        // 	setValue:now,
        // 	onRender: function(date) {
        // 		return date.valueOf() < now.valueOf() ? 'disabled' : '';
        // 	}
        // }).on('changeDate', function(ev){
        // 	$( "#reservation_date" ).datepicker('hide');
        // });
    });
    //$('#catering_time').timepicker();
</script>
<script>
    function delivery_cityFun(abc){
        if(abc != "")
        {
            $("#cityShow").show();
            $.ajax({
                url: "/search_area_by_name/",
                type: "post",
                data: {textsearch:abc,divid:'delivery_city'},
                success: function (response) {
                    $("#cityShow").html(response);
                }
            })
        }
        else
        {
            $("#cityShow").hide();
        }
    }
    function delivery_cityFun1(abc){
        if(abc != "")
        {
            $("#cityShowcatering").show();
            $.ajax({
                url: "/search_area_by_name/",
                type: "post",
                data: {textsearch:abc,divid:'catering_city'},
                success: function (response) {
                    $("#cityShowcatering").html(response);
                }
            })
        }
        else
        {
            $("#cityShowcatering").hide();
        }
    }
    function reservation_cityFun(abc){
        if(abc != "")
        {
            $("#cityShowreservation").show();
            $.ajax({
                url: "/search_area_by_name/",
                type: "post",
                data: {textsearch:abc,divid:'reservation_city'},
                success: function (response) {
                    $("#cityShowreservation").html(response);
                }
            })
        }
        else
        {
            $("#cityShowreservation").hide();
        }
    }
    function pickup_cityFun(abc){
        if(abc != "")
        {
            $("#cityShowpickup").show();
            $.ajax({
                url: "/search_area_by_name/",
                type: "post",
                data: {textsearch:abc,divid:'pickup_city'},
                success: function (response) {
                    $("#cityShowpickup").html(response);
                }
            })
        }
        else
        {
            $("#cityShowpickup").hide();
        }
    }
    function citychangeintxt(txt,divid,dataid){
        if(divid == 'delivery_city')
        {
            $("#cityShow").hide();
            document.getElementById('delivery_city_filter_id').value = dataid;
        }
        if(divid == 'catering_city')
        {
            $("#cityShowcatering").hide();
            document.getElementById('catering_filter_city_id').value = dataid;
        }
        if(divid == 'reservation_city')
        {
            $("#cityShowreservation").hide();
            document.getElementById('reservation_filter_city_id').value = dataid;
        }
        if(divid == 'pickup_city')
        {
            $("#cityShowpickup").hide();
            document.getElementById('pickup_filter_city_id').value = dataid;
        }
        document.getElementById(divid).value = txt;
    }
</script>
<script>
    function gettimevalue(){
        var t1 = document.getElementById('time1').value;
        var t2 = document.getElementById('time2').value;
        var t3 = document.getElementById('time3').value;
        var t4 = t1+':'+t2+' '+t3;
        // document.getElementById('catering_time').value = t4;
    }
</script>
<script>
    // $(".openTimeController").click(function (){
    //     $("#datetimepicker3").css('display','block');
    // });
    // $(".closeTimeInput").click(function (){
    //     $("#datetimepicker3").css('display','none');
    // });
    jQuery(document).ready(function($) {
        // if(ref == "DELIVERY")
        // {
        // 	changeTab2();
        // }
        // if(ref == "CATERING");
        // {
        // 	changeTab3();
        // }
        // if(ref == "TABLE");
        // {
        // 	changeTab4();
        // }
        // if(ref == "PICKUP")
        // {
        // 	changeTab1();
        // }
        switch(ref) {
            case "DELIVERY":
                changeTab2();
                break;
            case "CATERING":
                changeTab3();
                break;
            case "TABLE":
                changeTab4();
                break;
            case "PICKUP":
                changeTab1();
                break;
        }
    });
</script>
</html>