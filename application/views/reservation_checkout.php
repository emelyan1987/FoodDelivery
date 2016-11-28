<?PHP
error_reporting(-1);
$this->load->view("includes/Customer/header");
$this->load->helper('customer_helper');
$happyTime = $restroInfo['happy_from'];
$happyTimeto = $restroInfo['happy_to'];
$happyTimestr = strtotime($restroInfo['happy_to']);
$Htimestamp1 = strtotime($happyTime);
if ($happyTimestr > $Htimestamp1) {
    $happyTime1 = date('h:i A', $Htimestamp1);
} else {
    $happyTime1 = '';
}
$Htimestamp2 = strtotime($happyTime) + 60 * 60;
if ($happyTimestr > $Htimestamp2) {
    $happyTime2 = date('h:i A', $Htimestamp2);
} else {
    $happyTime2 = '';
}
$Htimestamp3 = strtotime($happyTime) + 60 * 60 + 60 * 60;
if ($happyTimestr > $Htimestamp3) {
    $happyTime3 = date('h:i A', $Htimestamp3);
} else {
    $happyTime3 = '';
}
$Htimestamp4 = strtotime($happyTime) + 60 * 60 + 60 * 60 + 60 * 60;
if ($happyTimestr > $Htimestamp4) {
    $happyTime4 = date('h:i A', $Htimestamp4);
} else {
    $happyTime4 = '';
}
?>
<style>
    body{
        font-family: "Ubuntu","Ubuntu Beta",UbuntuBeta,Ubuntu,"Bitstream Vera Sans","DejaVu Sans",Tahoma,sans-serif;
        font-weight: normal;
    }
    .pos-rel{
        position: relative;
    }
    button.submit {
        -webkit-appearance: none;
        padding: 0;
        cursor: pointer;
        color: #d31e03 !important;
        border: 0;
        opacity: 1 !important;
        background: transparent !important;
        font-size: 21px;
        font-weight: bold;
        line-height: 1;
    }
    .bParent{
        margin: 0 5px;
        text-align: right;
    }
    .pos-abs{
        position: absolute;
        right: 0;
        bottom:0;
    }
    .label-val{
        margin-left: 20px;color: #d31e03;
    }
    .res-logo{
        margin: 0 auto;
    }
    .btn-custom_res{
        padding: 3px 7px;
        color: #d31e03;
        background-color: #f9f9f9 !important;
        border-color: #ccc !important;
        border-radius: 9px;
        width: 60px;
    }
    .newInputQuantity{
        padding-bottom: 5px !important;
        border: 1px solid #fec707;
    }
    .btn-minus-default {
        height: 35px;
    }
    .btn-minus-green {
        height: 35px;
    }
    .editItem {
        padding:2px 7px;
        position: absolute;
        top: 4px;
        right: 3px;
        border: 1px solid #e0e0e0;
        border-radius: 16px;
        color: #62b102;
        background-color: #f1f1f1 !important;
    }
    .removeItem {
        font-size: 17px;
        float: left;
        position: absolute;
        top: 24%;
        left: -8px;
        padding:0;
    }
    .border{
        background: #fff;
        border-radius: 6px !important;
    }
    .btn-default {
        padding: 3px 7px;
        color: #62b102;
        background-color: #f9f9f9 !important;
        border-color: #ccc !important;
        border-radius: 9px;
        width: 136px;
    }
    .green {
        color: #73b720;
    }
    .btn-warning-shade{
        background-color: #fec707;
        border-color: #fec707;
        border-radius: 0 !important;
        padding: 7px 0;
        box-shadow: 0px -18px 0px rgba(0, 0, 0, 0.1) inset;
        width: 60%;
        text-align: center;
        color: #fff;
        margin: 12px auto;
    }
    .editItem i {
        font-size: 12px;
    }
    .iconInput {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        padding-left: 40px;
    }
    .icon-field {
        border-top-right-radius: 4px !important;
        -webkit-border-top-right-radius: 4px !important;
        -moz-border-top-right-radius: 4px !important;
        border-bottom-right-radius: 4px !important;
        -webkit-border-bottom-right-radius: 4px !important;
        -moz-border-bottom-right-radius: 4px !important;
        display: block;
        width: 90%;
        height: 34px;
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.42857143;
        color: #555;
        background-color: #fff;
        background-image: none;
        border: 1px solid #ccc;
        border-left: none;
        -webkit-border-left: none;
    }
    .icon-left{
        border-top-left-radius: 4px;
        -webkit-border-top-left-radius: 4px;
        -moz-border-top-left-radius: 4px;
        border-bottom-left-radius: 4px;
        -webkit-border-bottom-left-radius: 4px;
        -moz-border-bottom-left-radius: 4px;
        height: 34px;
        border: 1px solid #ccc;
        float: left;
        border-right: none;
        -webkit-border-right: none;
    }
    .roundedOne {
        border-radius: 50px;
        box-shadow: 0 1px 1px white inset, 0 1px 2px rgba(0, 0, 0, 0.5);
        height: 24px;
        position: relative;
        width: 23px;
    }
    .roundedOne input {
        margin: 6px;
    }
    .roundedOne label {
        background: #fff none repeat scroll 0 0;
        border-radius: 50px;
        cursor: pointer;
        height: 17px;
        left: 2px;
        position: absolute;
        top: 2px;
        width: 21px;
    }
    .roundedOne > label > span {
        padding-left: 34px;
    }
    .btn-yellow-new-sm {
        box-shadow: 0px -31px 0px rgba(0, 0, 0, 0.18) inset !important;
    }
    .wall-section{
        padding: 13px 2px;
        border-radius: 10px;
        border: 2px solid #dadada;
        background-color: #fcfcfc;
    }
    .quantity {
        width: 132px !important;
    }
    @media (min-width: 1200px){
        .icon-field {
            width: 92%;
        }
    }
    .clist {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .clist li {
        /* background: #eee; */
        padding: 10px;
        border-bottom: 1px solid #3a3a3a;
    }
    .tabBorderBottom{
        border-bottom: 2px solid #ccc;
    }
    .clist-heading{
        background-color: #73b720;
        border-bottom: none !important;
        font-weight: bold;
        color: #fff;
        font-size: 16px;
        text-align: center;
    }
    .noneborderradius{
        border-radius: 0px;
    }
    .mytext{
        border-radius: 0px;
    }
    .nav-pills > li.active > a > .menuListImg {
        margin: -8px 8px -8px -8px;
        background: #D31E03;
    }
    .menuTitle{
        background: #D31E03;
    }
    .menuListIcon{
        color: #D31E03;
    }
    .roundedOneRed label:after{
        background: #D31E03;
    }
    .blueBorder{
        border-bottom: 4px solid #D31E03;
    }
    .selectLocation {
        border-color: #D31E03 !important;
        color: #D31E03;
    }
    .list-button {
        background: #fff;
        color: #D31E03;
        border: 2px solid #D31E03;
    }
    .carousel-inner .item .col-md-4 a {
        padding: 0px;
        display: inline-block;
        width: 60%;
        padding-left: 15px;
    }
</style>
<?php
$ES = new stdClass();
foreach ($restroInfo as $key => $value) {
    $ES->$key = $value;
}
?>
<div class="container-fluid">
    <div class="margin20"></div>
    <div class="row">
        <div class="col-md-3 col-sm-12">
            <div class="searchBox">
                <a href="/reservation_filter/"><h4><i class="fa fa-angle-left"></i> Back to restaurant list</h4></a>
            </div>
            <div class="row">
                <div class="col-sm-3 pull-right">
                    <?php
                    if ($ES->status == 1) {
                        $stl = 'class="opened"';
                        $status_title = "Open";
                    } elseif ($ES->status == 2) {
                        $stl = 'class="busy"';
                        $status_title = "Busy";
                    } else {
                        $stl = 'class="close"';
                        $status_title = "Close";
                    }
                    ?>
                    <span <?php echo $stl;?>></span> <?php echo $status_title;?>
                </div>
                <div class="col-sm-12">
                    <img class="img-responsive res-logo" alt="" src="<?php if ($ES->restaurant_logo != '') {getImagePath($ES->restaurant_logo);}
                    ?>">
                </div>
                <br>
                <div class="col-sm-12 col-md-12">
                    <?php
                    $restro_img = get_restro_allImage($ES->id);
                    foreach ($restro_img as $ResImg => $resimg):
                        ?>
                    <div class="col-xs-3">
                        <br>
                        <img style="margin: 0 auto;" class="img-responsive" alt="" src="<?php if ($resimg->restro_images != '') {getImagePath($resimg->restro_images);}
                        ?>" >
                    </div>
                    <?php
                    endforeach;
                    ?>
                </div>
                <div class="col-sm-12">
                    <h4 class="text-center"><?php echo ucwords($ES->restro_name);?></h4>
                </div>
                <div class="col-sm-12">
                    <labe><?php echo $ES->restro_description;?></label>
                        <h4>Working Time:</h4>
                        <h5>Mon-Fri: <?php echo $restroInfo['monday_from'];?>-<?php echo $restroInfo['friday_to'];?> </h5>
                        <h5>Sat-Sun: <?php echo $restroInfo['saturday_from'];?>-<?php echo $restroInfo['sunday_to'];?> </h5>
                        <label class="list-label">Payment:</label>
                        <label class="list-data">&nbsp;<?php
                            $payArray = explode(',', $ES->method_type);
                            if (in_array(1, $payArray)) {
                                echo '<img class="" alt="" src="/assets/Customer/img/cash.png">';
                            }
                            if (in_array(2, $payArray)) {
                                echo '<img class="" alt="" src="/assets/Customer/img/knet.png">';
                            }
                            if (in_array(3, $payArray)) {
                                echo '<img class="" alt="" src="/assets/Customer/img/card.png">';
                            }
                            if (in_array(4, $payArray)) {
                                echo '<img class="" alt="" src="/assets/Customer/img/paypal.png">';
                            }
                            ?>
                        </label>
                        <div class="ratings">
                            <?php
                            $ratArray = getRestroRatingValues($ES->id);
                            if ($ratArray['rating_num'] != 0) {
                                $getR = $ratArray['rating_value'] / $ratArray['rating_num'];
                                $getR = round($getR);
                                ?>
                                <span>
                                    <?php
                                    if ($getR == 5) {
                                        ?>
                                        <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                        <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                        <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                        <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                        <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                        <?php
                                    } elseif ($getR == 4) {
                                        ?>
                                        <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                        <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                        <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                        <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                        <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                        <?php
                                    } elseif ($getR == 3) {
                                        ?>
                                        <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                        <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                        <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                        <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                        <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                        <?php
                                    } elseif ($getR == 2) {
                                        ?>
                                        <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                        <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                        <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                        <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                        <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                        <?php
                                    } elseif ($getR == 1) {
                                        ?>
                                        <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                        <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                        <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                        <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                        <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                        <?php
                                    } else {
                                        ?>
                                        <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                        <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                        <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                        <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                        <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                    <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                    <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                    <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                    <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                    <?php
                                }
                                ?>
                            </span>
                            <label><?php echo $ratArray['rating_num'];?> reviews</label>
                        </div>
                        <a href="/restaurant_rating/<?php echo $ES->id?>">Put Your Review</a>
                        <div>
                            <?php if ($ES->restro_status == 1): ?>
                                <img src="/assets/Customer/img/icon/love.png" alt="">
                            <?php endif?>
                            <?php if ($ES->promotion != ""): ?>
                                <img src="/assets/Customer/img/icon/bow.png" alt="">
                            <?php endif?>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <ul class="clist">
                            <li class="clist-heading">Restaurant Location</li>
                            <li>
                                <strong>Address: </strong> <?php echo $locationData['street'] . ' ,Block No. ' . $locationData['block'];?>
                                <?php echo $locationData['name'] . ' , ' . $locationData['city_name'];?>
                            </li>
                            <li>
                                <strong>Phone: </strong> <?=$locationData['telephones']?><?=($locationData['telephones2'] != '') ? ' , ' . $locationData['telephones2'] : "";?><?=($locationData['telephones3'] != '') ? ' , ' . $locationData['telephones3'] : ""?>
                            </li>
                            <li>
                                <strong>Reservation for Person: </strong>KD&nbsp;<?=$restroTable->price * $_SESSION['res_user']?>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="margin20"></div>
                <div class="row">
                    <input type="hidden" id="restroID" value="<?php echo $ES->id;?>">
                </div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div id="myCarousel" class="carousel fdi-Carousel slide">
                        <!-- Carousel items -->
                        <div class="carousel fdi-Carousel slide" id="eventCarousel" data-interval="0">
                            <div class="carousel-inner onebyone-carosel">
                                <div class="item active">
                                    <?php
                                    $i1 = 0;
                                    $i2 = 0;
                                    $i3 = 0;
                                    foreach ($advt1 as $ad => $adm): $i1 = 1;?>
                                    <div class="col-md-4 text-center">
                                        <a href="#"><img src="<?php getImagePath($adm->image);?>" class="img-responsive center-block"></a>
                                    </div>
                                <?php endforeach;?>
                            </div>
                            <div class="item">
                                <?php foreach ($advt2 as $ad => $adm): $i2 = 1;?>
                                    <div class="col-md-4 text-center">
                                        <a href="#"><img src="<?php getImagePath($adm->image);?>" class="img-responsive center-block"></a>
                                    </div>
                                <?php endforeach;?>
                            </div>
                            <div class="item">
                                <?php foreach ($advt3 as $ad => $adm): $i3 = 1;?>
                                    <div class="col-md-4 text-center">
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
            <div class="row">
                <div class="col-md-12">
                    <h4 class="text-center"><span class="bg-white">Changed your Mind ? Just click a different category</span></h4>
                    <div class="tabBorderTop"></div>
                    <ul class="nav nav-tabs nav-justified myTabs">
                        <?php
                        $k = 1;
                        foreach ($service_list as $a => $b) {
                            if ($k == 1) {
                                $cls_service = 'class="tab-icon"';
                            }
                            if ($k == 2) {
                                $cls_service = 'class="tab-icon1"';
                            }
                            if ($k == 3) {
                                $cls_service = 'class="tab-icon3"';
                            }
                            if ($k == 4) {
                                $cls_service = 'class="tab-icon2"';
                            }
                            ?>
                            <li <?php if ($k == 3) {?>class="active" <?php }
                                ?> ><a data-toggle="tab" href="#tab1" onclick='myservicefun("<?php echo $b->id;?>");'>
                                <span <?php echo $cls_service;?>></span> <?php echo $b->cat_name;?></a></li>
                                <?php
                                $k++;
                            }
                            ?>
                        </ul>
                        <div class="tabBorderBottom"></div>
                        <div class="margin20"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="tab-content">
                                    <div id="tab1" class="tab-pane fade in active">

                                        <div class="col-md-8 col-md-offset-2">
                                            <div class="wall-section" id="show_cartdata">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="col-sm-12" style="padding:0px 3px">
                                                                    <div class="border" style="">
                                                                        <div class="col-sm-12" style="padding: 0 20px;">
                                                                            <div><?php echo date('jS M Y g:mA', strtotime($_SESSION['res_date']));?><span class="pull-right"><strong>Total</strong></span></div>
                                                                            <div><?=$_SESSION['res_user'] > 1 ? $_SESSION['res_user'] . " Persons" : $_SESSION['res_user'] . " Person"?> <span class="pull-right"><strong>KD&nbsp;<?=$restroTable->price * $_SESSION['res_user']?></strong></span></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6" style="padding: 0px 0px 0 3px;">
                                                            <div class="border">
                                                                <div class="form-horizontal">
                                                                    <div class="col-sm-12">
                                            <!--  <p>
                                                <span class="custom-radio"><span class="custom-radio selected"><input type="radio" id="roundedOne1" value="1" name="check"></span></span> Redeem Coupon
                                            </p>
                                            <p>
                                                <span class="custom-radio selected"><span class="custom-radio selected"><input type="radio" id="roundedOne2" value="2" name="check"></span></span> Loyalty Points
                                            </p>
                                            <p>
                                                <span class="custom-radio selected"><span class="custom-radio selected"><input type="radio" id="roundedOne3" value="3" name="check"></span></span> Mataam Points
                                            </p> -->
                                            <div class="roundedOne">
                                                <input type="checkbox" value="1" id="roundedOne1" name="check">
                                                <label for="roundedOne1"><span>Redeem Coupon</span></label>
                                            </div>
                                            <div class="roundedOne" style="margin: 11px 0;">
                                                <input type="checkbox" value="2" id="roundedOne2" name="check">
                                                <label for="roundedOne2"><span>Loyalty Points</span></label>
                                            </div>
                                            <div class="roundedOne">
                                                <input type="checkbox" value="3" id="roundedOne3" name="check">
                                                <label for="roundedOne3"><span>Mataam Points</span></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6" style="padding:0px 3px 0px 2px;">
                                <div class="border" style="padding: 10px 0;">
                                    <div class="form-horizontal">
                                        <div class="col-sm-12">
                                            <input type="text" style="font-size: 12px !important" class="form-control" placeholder="Insert Coupon Code Here">
                                            <div class="">
                                                <a href="#" class="btn-warning-shade btn-block btn">Apply</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-sm-6" style="padding: 0px 0px 0 3px">
                                <div class="border">
                                    <div class="col-sm-12" style="padding: 0 5px;">
                                        <p>Loyalty Points</p>
                                        <div class="green">Gained/Used: <span class="pull-right">16pt</span></div>
                                        <div class="green">Balance: <span class="pull-right">16pt</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6" style="padding:0px 3px 0px 2px">
                                <div class="border">
                                    <div class="col-sm-12" style="padding: 0 5px;">
                                        <p>Mataam Points</p>
                                        <div class="green">Gained/Used: <span class="pull-right">16pt</span></div>
                                        <div class="green">Balance: <span class="pull-right">16pt</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-sm-12" style="padding:0px 3px">
                                <div class="border" style="">
                                    <div class="col-sm-12" style="padding: 0 5px;">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                Payment&nbsp;:&nbsp;&nbsp;
                                            </div>
                                            <?php
                                            $payArray = explode(',', $ES->method_type);
                                            if (in_array(1, $payArray)) {
                                                echo '<div class="col-sm-2"><span class="custom-radio-container"><span class="custom-radio"><input type="radio" id="pItem1" value="1" name="item"></span></span>&nbsp;<img class="" alt="" src="/assets/Customer/img/cash.png" style="    margin-bottom: 8px;"></div>';
                                            }
                                            if (in_array(2, $payArray)) {
                                                echo '<div class="col-sm-2"><span class="custom-radio-container"><span class="custom-radio"><input type="radio" id="pItem2" value="2" name="item"></span></span>&nbsp;<img class="" alt="" src="/assets/Customer/img/knet.png" style="    margin-bottom: 8px;"></div>';
                                            }
                                            if (in_array(3, $payArray)) {
                                                echo '<div class="col-sm-2"><span class="custom-radio-container"><span class="custom-radio"><input type="radio" id="pItem3" value="3" name="item"></span></span>&nbsp;<img class="" alt="" src="/assets/Customer/img/card.png" style="    margin-bottom: 8px;"></div>';
                                            }
                                            if (in_array(4, $payArray)) {
                                                echo '<div class="col-sm-2"><span class="custom-radio-container"><span class="custom-radio"><input type="radio" id="pItem4" value="4" name="item"></span></span>&nbsp;<img class="" alt="" src="/assets/Customer/img/paypal.png" style="    margin-bottom: 8px;"></div>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-sm-12" style="padding:0px 3px">
                                <div class="border" style="">
                                    <div class="col-sm-12" style="padding: 0 5px;">
                                        <div>Subtotal: <span class="green pull-right">KD&nbsp;0.000</span></div>
                                        <div>Discount: <span class="green pull-right">KD&nbsp;0.000</span></div>
                                        <div>Grand Total: <span class="green pull-right">KD&nbsp;0.000                                                          </span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-sm-12" style="padding:0px 3px">
                                    <div class="border" style="padding: 2px">
                                        <div class="col-sm-12" style="padding: 2px">
                                            <textarea class="form-control" placeholder="Order Notes" name="order_notes" style="background: #f9f9f9;height: 60px;border-color:#f9f9f9;"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="margin20"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-offset-4 col-md-4">
                        <?php
                        if (@$_SESSION['Customer_User_Id'] != '') {
                            ?>
                            <button type="submit" name="btncheckout" class="btn btn-danger btn-danger-new btn-block">MAKE RESERVATION</button>
                            <?php
                        } else {
                            ?>
                            <a class="btn btn-danger btn-danger-new btn-block" id="login_toggle2">MAKE RESERVATION</a>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div id="tab2" class="tab-pane fade">
            hello
        </div>
        <div id="tab3" class="tab-pane fade">
            hello
        </div>
        <div id="tab4" class="tab-pane fade">
            hello
        </div>
    </div>
    <div class="margin20"></div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="container-fluid"></div>
<div class="advert">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <img class="img-responsive center-block" alt="" src="/assets/Customer/img/add.jpg">
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div id="mdlResEdit" class="modal fade" role="dialog" data-backdrop="static" >
    <div class="modal-dialog   modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body" style="overflow: hidden;text-align: center;">
                <div class="row">
                    <div class="col-sm-6">
                        <button type="button" style="color: #aaa !important;" class="close pull-left" data-dismiss="modal"><i class="fa fa-times-circle"></i></button>
                    </div>
                    <div class="col-sm-6">
                        <button type="button" class="submit pull-right" data-dismiss="modal"><i class="fa fa-check-circle"></i></button>
                    </div>
                </div>
                <br>
                <div class="login-box-body" >
                   <!--  <a href="#">
                        <img src="/assets/Administration/images/logo2.png" class="center-block" alt="">
                    </a> -->
                    <!-- <br/> -->
                    <form action="" method="post" accept-charset="utf-8">
                        <div class="col-sm-12">
                         <div class="form-group">
                            <label for="reservationDateTime"><strong>Reservation Date/Time</strong></label>
                            <input class="newInput form-control text-center" type="text" placeholder="DD-MM-YYYY hh:mm" name="res_date" value="18-10-2016" style="width: 64%;
                            margin: 0 auto;height: 40px" id="reservation_date">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <strong>Number of Persons</strong>
                        <div class="center-block quantity">
                            <button type="button" class="btn-minus-default" onclick="descrementval('quantity_user')"><b><i class="fa fa-minus"></i></b></button>
                            <input style="background-color: #e0dddd;border-color: #aaa" class="newInputQuantity text-center" name="quantity" type="text" value="1" id="quantity_user">
                            <button type="button" class="btn-minus-green" onclick="incrementval('quantity_user')"><b><i class="fa fa-plus"></i></b></button>
                        </div>
                    </div>
                </form>
                <br/>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Modal -->
<?php
$this->load->view("includes/Customer/footer");
?>
<script>
    function addressFun(str){
        if(str != '')
        {
            $.ajax({
                url: "/ajaxaddressFetch/",
                type: "post",
                data: {address:str} ,
                success: function (response) {
                    $("#addressdata").html(response);
                }
            })
        }
    }
</script>
<script>
    function removeItem(table){
        if (table == "") {
            document.getElementById("show_cartdata").innerHTML = "";
            return;
        } else {
            if (window.XMLHttpRequest) {
// code for IE7+, Firefox, Chrome, Opera, Safari
xmlhttp = new XMLHttpRequest();
} else {
// code for IE6, IE5
xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        document.getElementById("show_cartdata").innerHTML = xmlhttp.responseText;
    }
};
xmlhttp.open("GET","/ajax_cart_table_remove/"+table,true);
xmlhttp.send();
}
}
</script>
<!-- Modal -->
<div id="customerAddress" class="modal fade" role="dialog" data-backdrop="static" >
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Address</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="msgadress">
                        </div>
                        <form action="" method="post">
                            <div class="col-md-6">
                                <h3>Billing Address</h3>
                                <div class="form-group">
                                    <label for="email">Full Name:</label>
                                    <input type="text" class="form-control" id="billing_full_name" name="billing_full_name">
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Address line 1:</label>
                                    <input type="text" class="form-control" id="billing_addres_1" name="billing_addres_1">
                                </div>
                                <div class="form-group">
                                    <label for="email">Address line 2:</label>
                                    <input type="text" class="form-control" id="billing_address_2" name="billing_address_2">
                                </div>
                                <div class="form-group">
                                    <label for="pwd">City:</label>
                                    <input type="text" class="form-control" id="billing_city" name="billing_city">
                                </div>
                                <div class="form-group">
                                    <label for="email">State:</label>
                                    <input type="text" class="form-control" id="billing_state" name="billing_state">
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Zip Code:</label>
                                    <input type="text" class="form-control" id="billing_zip_code" name="billing_zip_code">
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Phone Number:</label>
                                    <input type="text" class="form-control" id="billing_phoneno" name="billing_phoneno">
                                </div>
                                <div class="checkbox">
                                    <label><input type="checkbox" value="1" onchange="toggleCheckbox(this)"> Shipping Address Same as billing </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h3>Shipping Address</h3>
                                <div class="form-group">
                                    <label for="email">Full Name:</label>
                                    <input type="text" class="form-control" id="shipping_full_name" name="shipping_full_name">
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Address line 1:</label>
                                    <input type="text" class="form-control" id="shipping_address_1" name="shipping_address_1">
                                </div>
                                <div class="form-group">
                                    <label for="email">Address line 2:</label>
                                    <input type="text" class="form-control" id="shipping_address_2" name="shipping_address_2">
                                </div>
                                <div class="form-group">
                                    <label for="pwd">City:</label>
                                    <input type="text" class="form-control" id="shipping_city" name="shipping_city">
                                </div>
                                <div class="form-group">
                                    <label for="email">State:</label>
                                    <input type="text" class="form-control" id="shipping_state" name="shipping_state">
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Zip Code:</label>
                                    <input type="text" class="form-control" id="shipping_zip_code" name="shipping_zip_code">
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Phone Number:</label>
                                    <input type="text" class="form-control" id="shipping_phoneno" name="shipping_phoneno">
                                </div>
                                <button type="button" class="btn btn-success" name="btnaddressave" onclick="saveAddress()">Save</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<script>
    function toggleCheckbox(element)
    {
        if(element.checked)
        {
            var full_name = document.getElementById("billing_full_name").value;
            var billing_addres_1 = document.getElementById("billing_addres_1").value;
            var billing_address_2 = document.getElementById("billing_address_2").value;
            var billing_city = document.getElementById("billing_city").value;
            var billing_state = document.getElementById("billing_state").value;
            var billing_zip_code = document.getElementById("billing_zip_code").value;
            var phoneno = document.getElementById("billing_phoneno").value;
            document.getElementById("shipping_full_name").value = full_name;
            document.getElementById("shipping_address_1").value = billing_addres_1;
            document.getElementById("shipping_address_2").value = billing_address_2;
            document.getElementById("shipping_city").value = billing_city;
            document.getElementById("shipping_state").value = billing_state;
            document.getElementById("shipping_zip_code").value = billing_zip_code;
            document.getElementById("shipping_phoneno").value = phoneno;
        }
    }
</script>
<script>
    function saveAddress(){
        var full_name = document.getElementById("billing_full_name").value;
        var billing_addres_1 = document.getElementById("billing_addres_1").value;
        var billing_address_2 = document.getElementById("billing_address_2").value;
        var billing_city = document.getElementById("billing_city").value;
        var billing_state = document.getElementById("billing_state").value;
        var billing_zip_code = document.getElementById("billing_zip_code").value;
        var phoneno = document.getElementById("billing_phoneno").value;
        var shipping_full_name = document.getElementById("shipping_full_name").value;
        var shipping_address_1 = document.getElementById("shipping_address_1").value;
        var shipping_address_2 = document.getElementById("shipping_address_2").value;
        var shipping_city = document.getElementById("shipping_city").value;
        var shipping_state = document.getElementById("shipping_state").value;
        var shipping_zip_code = document.getElementById("shipping_zip_code").value;
        var shipping_phoneno = document.getElementById("shipping_phoneno").value;
        $.ajax({
            url: "/customer_address_add/",
            type: "post",
            data: {full_name:full_name,billing_addres_1:billing_addres_1,billing_address_2:billing_address_2,billing_city:billing_city,billing_state:billing_state,
                billing_zip_code:billing_zip_code,phoneno:phoneno,shipping_full_name:shipping_full_name,shipping_address_1:shipping_address_1,shipping_address_2:shipping_address_2,
                shipping_city:shipping_city,shipping_state:shipping_state,shipping_zip_code:shipping_zip_code,shipping_phoneno:shipping_phoneno} ,
                success: function (response) {
                    $("#CustomerAddressData").html(response);
                    $("#msgadress").html('<div class="alert alert-success"><strong>Success!</strong> Address added successfully done!</div>');
                    $('#customerAddress').modal('hide');
                }
            })
    }
</script>
<script>
    function gettimevalue(){
        var t1 = document.getElementById('time1').value;
        var t2 = document.getElementById('time2').value;
        var t3 = document.getElementById('time3').value;
        var t4 = t1+':'+t2+' '+t3;
        document.getElementById('booking_time').value = t4;
    }
</script>
<script>
    $(".openTimeController").click(function (){
        $("#datetimepicker3").css('display','block');
    });
    $(".closeTimeInput").click(function (){
        $("#datetimepicker3").css('display','none');
    });
    function myservicefun(str){
        var act = '';
        if(str == 1)
        {
            act = "DELIVERY";
        }
        if(str == 2)
        {
            act = "CATERING";
        }
        if(str == 3)
        {
            act = "TABLE";
        }
        if(str == 4)
        {
            act = "PICKUP";
        }
        window.location.href = "http://mataam.net/home?ref="+act;
    }
</script>
<script>
    function timeShowFun(){
        var res_time = $("#booking_time").val();
        $("#datetimepicker3").css('display','none');
        if(res_time != '')
        {
            $.ajax({
                url: "/ajax_resrvation_booking_time/",
                type: "post",
                data: {res_time:res_time} ,
                success: function (response) {
                    $("#timeshow").html(response);
                }
            })
        }
    }
</script>
<script>
    $('#login_toggle2').click(function (){
        $('#myLogin').toggleClass('login');
        $('.login-dropdown').toggleClass('blockedContent');
    });
    $("input:checkbox").click(function(){
        var self = $(this);
        if (self.is(':checked')) {
        $('input:checkbox').not(this).prop('checked', false);
        }
    });
    $('.custom-radio').click(function(event) {
        var self = $(this);
        var check = self.find('input:radio');
        if (self.hasClass('selected')) {
            self.removeClass('selected');
            check.attr('checked', false);
        }else{
            $('.custom-radio').removeClass('selected');
            // self.siblings().removeClass('selected');
            check.attr('checked', true);
            self.addClass('selected');
        }
    });
</script>