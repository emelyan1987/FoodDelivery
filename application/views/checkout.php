<?PHP
    $this->load->view("includes/Customer/header");
    $this->load->helper('customer_helper');

    $payMethod = explode(',', $restroInfo->payment_method);

    if($_SESSION['filter_service'] == 1) {
        $borderClass = "greenBorder";
        $bulletinIcon = "/assets/Customer/img/icon/smallLogo.png";
        $color = "#73B720";
    } else if($_SESSION['filter_service'] == 2) {
        $borderClass = "orangeBorder";
        $bulletinIcon = "/assets/Customer/img/icon/smallLogoOrange.png";
        $color = "#FF8205";
    } else if($_SESSION['filter_service'] == 3) {
        $borderClass = "redBorder";
        $bulletinIcon = "/assets/Customer/img/icon/smallLogoRed.png";
        $color = "#D31E03";
    } else if($_SESSION['filter_service'] == 4) {
        $borderClass = "blueBorder";
        $bulletinIcon = "/assets/Customer/img/icon/smallLogoBlue.png";
        $color = "#2793FF";
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
    .pos-abs{
        position: absolute;
        right: 0;
        bottom:0;
    }
    .wall{
        background: #f1f1f1;
    }
    .itemCheck {
        padding: 20px;
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
    .label-color {
        color: <?php echo $color;?>;
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
    .roundedOne label:after{
        background: <?php echo $color;?>;
    }
    .btn-yellow-new-sm {
        box-shadow: 0px -31px 0px rgba(0, 0, 0, 0.18) inset !important;
    }
    .quantity {
        width: 132px !important;
    }
    @media (min-width: 1200px){
        .icon-field {
        width: 92%;
    }
    }
</style>
<form action="" method="post" >
    <div class="container-fluid">
        <div class="margin20"></div>
        <div class="row">
            <div class="col-md-3 col-sm-12">

                <a href="/restaurant_view/<?php echo $_SESSION['order_restro_id'];?>/<?php echo $_SESSION['order_location_id'];?>"><h4><i class="fa fa-angle-left"></i> Back to restaurant</h4></a>

                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="bottomIconSection">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-xs-6 col-sm-3 col-md-3">
                        <img class="img-responsive center-block" alt="" src="/assets/Customer/img/icon/bottomIcon1.png">
                        <h4 class="bottomIconTitle"><span>1</span> Choose Restaurant</h4>
                    </div>
                    <div class="col-xs-6 col-sm-3 col-md-3">
                        <img class="img-responsive center-block" alt="" src="/assets/Customer/img/icon/bottomIcon2.png">
                        <h4 class="bottomIconTitle"><span>2</span> Choose Food</h4>
                    </div>
                    <div class="col-xs-6 col-sm-3 col-md-3">
                        <img class="img-responsive center-block" alt="" src="/assets/Customer/img/icon/bottomIcon3.png">
                        <h4 class="bottomIconTitle"><span>3</span> Place Order</h4>
                    </div>
                    <div class="col-xs-6 col-sm-3 col-md-3">
                        <img class="img-responsive center-block" alt="" src="/assets/Customer/img/icon/bottomIcon4.png">
                        <h4 class="bottomIconTitle"><span>4</span> Enjoy</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-3">
                <div class="row">
                    <div class="col-sm-3 pull-right">
                        <?php
                            if ($restroInfo->status == 1) {
                                $stl = 'class="opened"';
                                $status_title = "Open";
                            } elseif ($restroInfo->status == 2) {
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
                        <img class="img-responsive res-logo" alt="" src="<?php if ($restroInfo->restro_logo != '') {getImagePath($restroInfo->restro_logo);}
                            ?>">
                    </div>
                    <br>
                    <div class="col-sm-12">
                        <?php
                            $restro_imgs = get_restro_allImage($restroInfo->restro_id);
                            foreach ($restro_imgs as $ResImg => $resimg):
                            ?>
                            <div class="col-xs-<?php echo 12/count($restro_imgs);?>">
                                <br>
                                <img class="img-responsive" alt="" src="<?php if ($resimg->restro_images != '') {getImagePath($resimg->restro_images);}
                                    ?>" >
                            </div>
                            <?php
                                endforeach;
                        ?>
                    </div>
                    <div class="col-sm-12">
                        <h4 class="text-center"><?php echo ucwords($restroInfo->restro_name);?></h4>
                    </div>
                    <div class="col-sm-12">
                        <div class="row">
                            <label class="list-label">Min. Order:</label>
                            <label class="list-data">&nbsp;KD <?php echo number_format($restroInfo->min_order, 3);?></label>
                        </div>
                        <div class="row">
                            <label class="list-label">Date/Time(Planned Order):</label>
                            <label class="list-data">&nbsp;<?php echo $restroInfo->order_time . " Min. ";?></label>
                        </div>
                        <div class="row">
                            <label class="list-label">Payment:</label>
                            <label class="list-data">&nbsp;<?php
                                    $payArray = explode(',', $restroInfo->payment_method);
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
                        </div>
                        <div>
                            <div id="rating-view" style="display:inline-block;"></div>
                            <label><?php echo count($restroInfo->reviews);?> reviews</label>
                        </div>
                        <a href="/restaurant_rating/<?php echo $restroInfo->restro_id?>/<?php echo $restroInfo->location_id?>">Put Your Review</a>
                        <div>
                            <?php if ($restroInfo->restro_state == 1): ?>
                                <img src="/assets/Customer/img/icon/love.png" alt="">
                                <?php endif?>
                            <?php if ($restroInfo->promo_id != ""): ?>
                                <img src="/assets/Customer/img/icon/bow.png" alt="">
                                <?php endif?>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label class="list-label">Address:</label>
                        <label>&nbsp;<?php echo $restroInfo->street." ".$restroInfo->building." ".$restroInfo->block." ".$restroInfo->area." ".$restroInfo->city;?></label>                    
                    </div>
                    <?php if($_SESSION['filter_service']==SERVICE_DELIVERY || $_SESSION['filter_service']==SERVICE_CATERING){?>

                        <div class="col-sm-12">
                            <div class="list-label">Service Areas:</div>
                            <div><?php foreach($restroInfo->areas as $area){echo $area->name." ".$area->city_name.", ";}?></div>                    
                        </div>
                        <?php }?>
                </div>
            </div>
            <div class="col-md-5">
                <div class="itemCheck" id="show_cartdata">                                                                        
                    <div class="margin20"></div>
                    <div class="wall">
                        <?php
                            foreach ($cartData as $ca => $CD):
                            ?>
                            <div class="row cart-item" data-id="<?php echo $CD['id'];?>">
                                <div class="col-md-12">
                                    <div class="col-md-12" style="padding:0px 3px 0 3px">
                                        <div class="border pos-rel">
                                            <a href="/view_restro_item/<?php echo $CD["restro_id"]?>/<?php echo $CD["location_id"]?>/<?php echo $CD["product_id"]?>?cart_item_id=<?php echo $CD["id"]?>" class="editItem">Edit  <i class="fa fa-pencil"></i></a>
                                            <div class="col-md-4" style="padding-right:0;margin-left: 18px;">
                                                <a href="javascript:removeCartItem(<?php echo $CD['id'];?>)" class="removeItem"><i class="fa fa-times-circle" style="color: #cbcbcb;"></i></a>
                                                <img class="itemCheckImg" src="<?php if ($CD['item_image'] != '') {getImagePath($CD['item_image']);} else {echo '/assets/Customer/img/default_item.png';}?>" alt=""/>
                                            </div>
                                            <div class="col-md-4" style="padding-left:0;">
                                                <h4 style="margin-bottom: 0px;"><?php echo $CD['item_name'];?></h4>
                                                <span>Qty : <?php echo $CD['quantity'];?> </span><br>
                                                <!-- <span>Price : KD&nbsp;<?php echo number_format($CD['item_price'], 3);?> </span> -->
                                            </div>
                                            <div class="col-md-4 pos-abs">
                                                <h5 style="font-weight: bold">Total</h5>
                                                <h5>KD&nbsp;<?php echo number_format($CD['subtotal'], 3);?></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <?php
                                endforeach;
                        ?>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-sm-6" style="padding: 0px 0px 0 3px;">
                                    <div class="border">
                                        <div class="form-horizontal">
                                            <div class="col-sm-12">
                                                <div class="roundedOne">
                                                    <input type="checkbox" value="1" id="redeem-type-coupon-checkbox" name="redeem_type" onchange="changeRedeemType()">
                                                    <label for="redeem-type-coupon-checkbox"><span>Redeem Coupon</span></label>
                                                </div>
                                                <div class="roundedOne" style="margin: 11px 0;">
                                                    <input type="checkbox" value="2" id="redeem-type-loyalty-point-checkbox" name="redeem_type" onchange="changeRedeemType()">
                                                    <label for="redeem-type-loyalty-point-checkbox"><span>Loyalty Points</span></label>
                                                </div>
                                                <div class="roundedOne">
                                                    <input type="checkbox" value="3" id="redeem-type-mataam-point-checkbox" name="redeem_type" onchange="changeRedeemType()">
                                                    <label for="redeem-type-mataam-point-checkbox"><span>Mataam Points</span></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6" style="padding:0px 3px 0px 2px;">
                                    <div class="border" style="padding: 10px 0;">
                                        <div class="form-horizontal">
                                            <div class="col-sm-12">
                                                <input id="coupon-code-input" type="text" style="font-size: 12px !important" class="form-control" placeholder="Insert Coupon Code Here" name="coupon_code">
                                                <div class="">
                                                    <a id="coupon-apply-btn" href="javascript:applyCoupon()" class="btn-warning-shade btn-block btn">Apply</a>
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
                                            <div class="label-color">Gained/Used: <span id="loyalty-gained-points-display">16</span>pt/<span id="loyalty-used-points-display">16</span>pt</div>
                                            <div class="label-color">Balance: <span id="loyalty-balance-points-display">16</span>pt</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6" style="padding:0px 3px 0px 2px">
                                    <div class="border">
                                        <div class="col-sm-12" style="padding: 0 5px;">
                                            <p>Mataam Points</p>
                                            <div class="label-color">Gained/Used: <span id="mataam-gained-points-display">16</span>pt/<span id="mataam-used-points-display">16</span>pt</div>
                                            <div class="label-color">Balance: <span id="mataam-balance-points-display">16</span>pt</div>
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
                                            <div>Subtotal: <span class="label-color pull-right">KD&nbsp;<span id="subtotal-display">0.000</span></span></div>
                                            <div>Discount: <span class="label-color pull-right">KD&nbsp;<span id="discount-display">0.000</span></span></div>
                                            <div>Delivery Charges: <span class="label-color pull-right">KD&nbsp;<span id="charge-display">0.000</span></span></div>
                                            <div>Grand Total: <span class="label-color pull-right">KD&nbsp;<span id="grandtotal-display">0.000</span>
                                                </span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <div class="margin20"></div>
                                <textarea class="form-control" rows="3" placeholder="Order Notes" name="order_notes"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="margin20"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <h4 class="text-uppercase">Address</h4>
                                <span class="red"><?php echo form_error('address_id');?><?php echo isset($errors['address_not_exist'])?$errors['address_not_exist']:"";?></span>
                            </div>
                            <div class="col-md-6">
                                <input type="hidden" name="area_id" id="checkout_area_id_hidden" value="<?php echo $_SESSION['order_area_id'];?>"/>
                                <select class="addressSelection" name="address_id" onchange="changeAddress(this.value)" id="CustomerAddressData">
                                    <option value="">-Select Address-</option>
                                    <?php foreach ($addressData as $add => $address):?>
                                        <option value="<?php echo $address->id;?>"><?php echo $address->address_name;?></option>
                                        <?php endforeach; ?>
                                </select>
                                <div class="pull-right">
                                    <a data-toggle="modal" data-target="#new-address-modal" style="cursor: pointer;"><i class="fa fa-home"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12" >
                            <div id="addressdata" class="margin20">

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <div class="margin20"></div>
                                <textarea class="form-control" rows="3" placeholder="Please enter extra direction." name="extra_direction"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="margin20"></div>
                    <div class="row">
                        <div class="col-sm-12 col-sm-12 col-md-12">
                            <div class="col-sm-3 col-sm-3 col-md-3">
                                <h4>Delivery Time: </h4>
                            </div>
                            <div class="col-sm-3 col-sm-3 col-md-3">
                                <div class="form-horizontal">
                                    <div class="col-sm-12">
                                        <div class="padTB10">


                                            <div class="roundedOne">
                                                <input type="radio" value="1" onClick="selectTimeType(1)"  id="time-type-now-radio" class="" name="hd_orderTime" />
                                                <label for="time-type-now-radio"><span>Order Now</span></label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <span class="red"><?php echo form_error('hd_orderTime');?></span>
                            </div>
                            <div class="col-sm-6 col-sm-6 col-md-6">
                                <div class="form-horizontal">
                                    <div class="col-sm-12">
                                        <div class="padTB10">
                                            <div class="roundedOne">

                                                <div class="roundedOne">
                                                    <input type="radio" value="2" onClick="selectTimeType(2)"  id="time-type-schedule-radio" class="myCheckBox1" name="hd_orderTime" />
                                                    <label for="time-type-schedule-radio"><span>Scheduled for : </span></label>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="padTB10" id="sheduledate" style="display:none;">
                                            <div class="col-md-6">
                                                <input type="text" name="schedule_date" value="<?php echo date('Y-m-d');?>" id="scheduled_date" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="schedule_time" value="<?php echo date('H:i');?>" class="form-control text-center openTimeController" id="scheduled_time">
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
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="margin20"></div>
                            <div class="line"></div>


                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-sm-12 col-md-12">
                            <div class="col-sm-3 col-sm-3 col-md-3">
                                <h4>Payment option: </h4>
                            </div>
                            <div class="col-sm-9 col-sm-9 col-md-9">
                                <div class="form-horizontal">
                                    <div class="col-sm-12">

                                        <?php
                                            if (in_array(1, $payMethod)) {
                                            ?>
                                            <div class="paymentMethod">

                                                <div class="roundedOne">
                                                    <input type="radio" value="1" id="payment-type-cash-radio" class="myCheckBox1" name="hd_paymentType" />
                                                    <label for="payment-type-cash-radio"><span><img class="" alt="" src="/assets/Customer/img/cash.png"> cash</span></label>
                                                </div>
                                            </div>
                                            <?php
                                            }
                                        ?>
                                        <?php
                                            if (in_array(2, $payMethod)) {
                                            ?>
                                            <div class="paymentMethod">

                                                <div class="roundedOne">
                                                    <input type="radio" value="2" id="payment-type-knet-radio" class="myCheckBox1" name="hd_paymentType" />
                                                    <label for="payment-type-knet-radio"><span><img class="" alt="" src="/assets/Customer/img/knet.png"> Knet</span></label>
                                                </div>
                                            </div>
                                            <?php
                                            }
                                        ?>
                                        <?php
                                            if (in_array(3, $payMethod)) {
                                            ?>
                                            <div class="paymentMethod">
                                                <div class="roundedOne">
                                                    <input type="radio" value="3" id="payment-type-card-radio" class="myCheckBox1" name="hd_paymentType" />
                                                    <label for="payment-type-card-radio"><span><img class="" alt="" src="/assets/Customer/img/card.png"> Credit Card</span></label>
                                                </div>
                                            </div>
                                            <?php
                                            }
                                        ?>
                                        <?php
                                            if (in_array(4, $payMethod)) {
                                            ?>
                                            <div class="paymentMethod">

                                                <div class="roundedOne">
                                                    <input type="radio" value="4" id="payment-type-paypal-radio" class="myCheckBox1" name="hd_paymentType" />
                                                    <label for="payment-type-paypal-radio"><span><img class="" alt="" src="/assets/Customer/img/paypal.png"> Paypal</span></label>
                                                </div>
                                            </div>
                                            <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                                <span class="red"><?php echo form_error('hd_paymentType');?></span>
                            </div>
                            <div class="clearfix"></div>
                            <div class="line"></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="margin20"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-offset-4 col-md-4">
                                <button style="width: 100%" type="submit" name="btncheckout" class="btn btn-yellow btn-yellow-new btn-block"><img src="/assets/Administration/images/icon/cartIcon.png" alt=""> CHECKOUT</button>
                            </div>
                        </div>
                    </div>
                    <div class="margin20"></div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>

    <div class="container-fluid"></div>
</form>
<?php
    $this->load->view("includes/Customer/footer");
?>

<div id="new-address-modal" class="modal fade" role="dialog" data-backdrop="static" >
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <form action="" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Address</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="msgadress">

                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="user-address-area-select" class="col-xs-3 col-form-label">Area</label>
                                    <div class="col-xs-9">
                                        <select class="form-control" name="area_id" id="user-address-area-select" required>
                                            <option value="">-Select Area-</option>
                                            <?php foreach ($restroInfo->areas as $index => $area):?>
                                                <option value="<?php echo $area->id;?>"><?php echo $area->name;?>, <?php echo $area->city_name;?></option>
                                                <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="user-address-name-input" class="col-xs-3 col-form-label">Address Name</label>
                                    <div class="col-xs-9">
                                        <input class="form-control" type="text" id="user-address-name-input" name="address_name" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="user-address-street-input" class="col-xs-3 col-form-label">Street</label>
                                    <div class="col-xs-9">
                                        <input class="form-control" type="text" id="user-address-street-input" name="street" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="user-address-appartment-input" class="col-xs-3 col-form-label">Appartment</label>
                                    <div class="col-xs-9">
                                        <input class="form-control" type="text" id="user-address-appartment-input" name="appartment" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="user-address-block-input" class="col-xs-3 col-form-label">Block</label>
                                    <div class="col-xs-9">
                                        <input class="form-control" type="text" id="user-address-block-input" name="block" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="user-address-floor-input" class="col-xs-3 col-form-label">Floor</label>
                                    <div class="col-xs-9">
                                        <input class="form-control" type="text" id="user-address-floor-input" name="floor" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="user-address-house-input" class="col-xs-3 col-form-label">House Number</label>
                                    <div class="col-xs-9">
                                        <input class="form-control" type="text" id="user-address-house-input" name="house" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="user-address-direction-textarea" class="col-xs-3 col-form-label">Extra Direction</label>
                                    <div class="col-xs-9">
                                        <textarea type="textarea" class="form-control" id="user-address-direction-textarea" name="extra_directions"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="user-address-primary-checkbox" class="col-xs-3 col-form-label">Set as Primary</label>
                                    <div class="col-xs-9">
                                        <input type="checkbox" id="user-address-primary-checkbox" name="is_primary" class="form-control">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="btnUserAddressSave">Save</button>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- Modal -->
<script src="/assets/common/plugins/rating/jquery.rateyo.js" type="text/javascript"></script>
<script> 
    $(document).ready(function(){
        $("#rating-view").rateYo({rating:<?php echo $restroInfo->rating; ?>, starWidth:'24px', ratedFill:'#f1c40f'}); 
    });
    function selectTimeType(time_type)
    {
        if(time_type == 1)
        {
            $("#sheduledate").css("display", "none");
        } else if(time_type == 2) {
            $("#sheduledate").css("display", "block");
        }

    }
</script>

<script>
    $("input:checkbox").click(function(){
        var self = $(this);
        if (self.is(':checked')) {
            // self.
            $('input:checkbox').not(this).prop('checked', false);
        }
    });
</script>

<script>
    function order_time(str){
        document.getElementById('hd_orderTime').value = str;
    }
    function paymentget(str){
        document.getElementById('hd_paymentType').value = str;
    }
</script>

<script>
    function removeItem(item){

        if (item == "") {
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
            xmlhttp.open("GET","/ajax_cart_item_remove/"+item,true);
            xmlhttp.send();
        }



    }
</script>


<script>
    $(function() {
        var dateToday = new Date();
        $( "#scheduled_date" ).datepicker({dateFormat: 'yy-mm-dd',minDate: dateToday });
    });
</script>





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

        document.getElementById('scheduled_time').value = t4;

    }
</script>
<script>
    $(".openTimeController").click(function (){
        $("#datetimepicker3").css('display','block');
    });
    $(".closeTimeInput").click(function (){
        $("#datetimepicker3").css('display','none');
    });
</script>

<script>
    function changeAddress(address_id){ console.log(address_id);
        if(address_id != '')
        {
            $.ajax({
                url: "/api/users/address/"+address_id,
                type: "GET",
                success: function (response) {
                    console.log("getAddress response", response);
                    if(response.code == 0) {                     
                        var address = response.resource;
                        var html = "<div>Area: "+address.area_name+"</div>" +
                        "<div>Block: "+address.block+" | Street: "+address.street+" | Building no: "+address.house+" | Floor: "+address.floor+" | Apartment: "+address.appartment+"</div>";

                        $("#addressdata").html(html);  


                        $.ajax({
                            url: "/api/orders/sum?service_type=<?php echo $_SESSION['filter_service'];?>&restro_id=<?php echo $_SESSION['order_restro_id'];?>&location_id=<?php echo $_SESSION['order_location_id'];?>&area_id="+address.area_id,
                            type: "GET",
                            success: function(response) {
                                console.log('getSum response', response);
                                if(response.code == 0) {
                                    var subtotal = response.resource.total_amount,
                                    charge = response.resource.charge_amount;

                                    $("#subtotal-display").text(subtotal.toFixed(3));
                                    $("#charge-display").text(charge.toFixed(3));

                                    var discount = $("#discount-display").text();

                                    $("#grandtotal-display").text((subtotal-discount+charge).toFixed(3));
                                }
                            }
                        }); 
                        
                        $('#checkout_area_id_hidden').val(address.area_id);
                    }
                }
            })
        }
    }
</script>
<script>
    function removeCartItem(itemId){
        bootbox.confirm({
            title: "Delete cart item?",
            message: "Are you sure to delete this cart item?",
            buttons: {
                cancel: {
                    label: 'Cancel',
                    className: 'btn-secondary'
                },
                confirm: {
                    label: 'Confirm',
                    className: 'btn-primary'
                }
            },
            callback: function (result) {
                if(result == true) {
                    $.ajax({
                        url: "/api/orders/cart/"+itemId+"?service_type=<?php echo $_SESSION['filter_service'];?>",
                        type: "DELETE",
                        success: function(response) {
                            console.log('cart delete response', response);
                            if(response.code == 0) {
                                $("div.cart-item[data-id="+itemId+"]").slideUp("slow", function() { $(this).remove();});  

                                updateCartData();                              
                            }
                        }
                    });
                }                  
            }
        });
    }

    function updateCartData() {
        /*$.ajax({
        url: "/api/orders/cart/count?service_type=<?php echo $_SESSION['filter_service'];?>",
        type: "GET",
        success: function(response) {
        console.log('getCartCount response', response);
        if(response.code == 0) {
        $("#cart-count-display").html(response.resource);
        }
        }
        });*/
        $.ajax({
            url: "/api/orders/point?service_type=<?php echo $_SESSION['filter_service'];?>&restro_id=<?php echo $_SESSION['order_restro_id'];?>&location_id=<?php echo $_SESSION['order_location_id'];?>",
            type: "GET",
            success: function(response) {
                console.log('getPoint response', response);
                if(response.code == 0) {
                    $("#loyalty-gained-points-display").html(response.resource.loyalty.gained_points);
                    $("#loyalty-used-points-display").html(response.resource.loyalty.used_points);
                    $("#loyalty-balance-points-display").html(response.resource.loyalty.balance);

                    $("#mataam-gained-points-display").html(response.resource.mataam.gained_points);
                    $("#mataam-used-points-display").html(response.resource.mataam.used_points);
                    $("#mataam-balance-points-display").html(response.resource.mataam.balance);
                }
            }
        });
        $.ajax({
            url: "/api/orders/sum?service_type=<?php echo $_SESSION['filter_service'];?>&restro_id=<?php echo $_SESSION['order_restro_id'];?>&location_id=<?php echo $_SESSION['order_location_id'];?>&area_id=<?php echo $_SESSION['order_area_id']?>",
            type: "GET",
            success: function(response) {
                console.log('getSum response', response);
                if(response.code == 0) {
                    var subtotal = response.resource.total_amount,
                    charge = response.resource.charge_amount;

                    $("#subtotal-display").text(subtotal.toFixed(3));
                    $("#charge-display").text(charge.toFixed(3));

                    var discount = $("#discount-display").text();

                    $("#grandtotal-display").text((subtotal-discount+charge).toFixed(3));
                }
            }
        });

        var redeem_type = 0;

        if($("#redeem-type-coupon-checkbox").prop("checked")) redeem_type = 1;
        else if($("#redeem-type-loyalty-point-checkbox").prop("checked")) redeem_type = 2;
            else if($("#redeem-type-mataam-point-checkbox").prop("checked")) redeem_type = 3;


        $.ajax({
            url: "/api/orders/discount?service_type=<?php echo $_SESSION['filter_service'];?>&restro_id=<?php echo $_SESSION['order_restro_id'];?>&location_id=<?php echo $_SESSION['order_location_id'];?>&redeem_type="+redeem_type,
            type: "GET",
            success: function(response) {
                console.log('getDiscount response', response);
                if(response.code == 0) {
                    var discount = response.resource.discount_amount;

                    $("#discount-display").text(discount.toFixed(3));

                    var subtotal = Number($("#subtotal-display").text()),
                    charge = Number($("#charge-display").text()),
                    grandtotal = subtotal-discount+charge;

                    $("#grandtotal-display").text(grandtotal.toFixed(3));
                }
            }
        });
    }

    function changeRedeemType() {
        var redeem_type;

        if($("#redeem-type-coupon-checkbox").prop("checked")) redeem_type = 1;
        else if($("#redeem-type-loyalty-point-checkbox").prop("checked")) redeem_type = 2;
            else if($("#redeem-type-mataam-point-checkbox").prop("checked")) redeem_type = 3;

        if(redeem_type==2 || redeem_type==3) {// Loyalty Points or Mataam Points
            $.ajax({
                url: "/api/orders/discount?service_type=<?php echo $_SESSION['filter_service'];?>&restro_id=<?php echo $_SESSION['order_restro_id'];?>&location_id=<?php echo $_SESSION['order_location_id'];?>&redeem_type="+redeem_type,
                type: "GET",
                success: function(response) {
                    console.log('getDiscount response', response);
                    if(response.code == 0) {
                        var discount = response.resource.discount_amount;

                        $("#discount-display").text(discount.toFixed(3));

                        var subtotal = Number($("#subtotal-display").text()),
                        charge = Number($("#charge-display").text()),
                        grandtotal = subtotal-discount+charge;

                        $("#grandtotal-display").text(grandtotal.toFixed(3));
                    }
                }
            });            
        } else {
            var discount = 0;

            $("#discount-display").text(discount.toFixed(3));

            var subtotal = Number($("#subtotal-display").text()),
            charge = Number($("#charge-display").text()),
            grandtotal = subtotal-discount+charge;

            $("#grandtotal-display").text(grandtotal.toFixed(3));
        }
    }

    function applyCoupon() {
        var isCouponChecked = $("#redeem-type-coupon-checkbox").prop("checked"); console.log("Selected redeem type", isCouponChecked);

        if(isCouponChecked) {                 
            var coupon_code = $("#coupon-code-input").val();  console.log("Coupon code", coupon_code);
            $.ajax({
                url: "/api/orders/discount?service_type=<?php echo $_SESSION['filter_service'];?>&restro_id=<?php echo $_SESSION['order_restro_id'];?>&location_id=<?php echo $_SESSION['order_location_id'];?>&redeem_type=1&coupon_code="+coupon_code,
                type: "GET",
                success: function(response) {
                    console.log('getDiscount response', response);
                    if(response.code == 0) {
                        var discount = response.resource.discount_amount;

                        $("#discount-display").text(discount.toFixed(3));

                        var subtotal = Number($("#subtotal-display").text()),
                        charge = Number($("#charge-display").text()),
                        grandtotal = subtotal-discount+charge;

                        $("#grandtotal-display").text(grandtotal.toFixed(3));
                    } else {
                        bootbox.alert({
                            message: response.message,
                            className: 'bb-alternate-modal',
                            size: 'small'
                        });
                    }
                }
            });
        }   
    }

    $(document).ready(function(){
        updateCartData();
    });
</script>