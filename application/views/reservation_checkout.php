<?PHP
    $this->load->view("includes/Customer/header");
    $this->load->helper('customer_helper');

    $payMethod = explode(',', $restroInfo->payment_method);

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
    .quantity {
        width: 132px !important;
    }
    @media (min-width: 1200px){
        .icon-field {
        width: 92%;
    }
    }
    .list-value {
        color: #D31E03;
        font-weight: bold;
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

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-3" style="border-right:1px solid #ddd;padding:20px;margin:20px;">
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
                        <img class="img-responsive" style="margin:0 auto;width:150px;height:120px;" alt="" src="<?php if ($restroInfo->restro_logo != '') {getImagePath($restroInfo->restro_logo);}?>">
                    </div>
                </div>
                <div class="row">
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
                <div class="row">
                    <h4 class="text-center"><?php echo ucwords($restroInfo->restro_name);?></h4>
                </div>
                <div class="row">
                    <div class="col-md-3"><label class="list-label">Payment:</label></div>
                    <div class="col-md-9">
                        <?php
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
                    </div>
                </div>
                <div class="row">
                    <div>
                        <div id="rating-view" style="display:inline-block;"></div>
                        <label><?php echo count($restroInfo->reviews);?> reviews</label>
                    </div>
                    <a href="/restaurant_rating/<?php echo $restroInfo->restro_id?>/<?php echo $restroInfo->location_id?>">Put Your Review</a>
                </div>
                <div class="row">
                    <div>
                        <?php if ($restroInfo->restro_state == 1): ?>
                            <img src="/assets/Customer/img/icon/love.png" alt="">
                            <?php endif?>
                        <?php if ($restroInfo->promo_id != ""): ?>
                            <img src="/assets/Customer/img/icon/bow.png" alt="">
                            <?php endif?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3"><label class="list-label">Address:</label></div>
                    <div class="col-md-9"><label>&nbsp;<?php echo $restroInfo->street." ".$restroInfo->building." ".$restroInfo->block." ".$restroInfo->area." ".$restroInfo->city;?></label></div>                    
                </div> 
            </div>  
            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-3">
                        <label class="list-label">Deposit amount:</label>
                    </div>
                    <div class="col-md-3">
                        <span class="list-value">KD&nbsp;<?php echo number_format($seating_info['deposit'], 3); ?></span>
                    </div>
                    <div class="col-md-3">
                        <label class="list-label">Points:</label>
                    </div>
                    <div class="col-md-3">
                        <span class="list-value">&nbsp;<?php echo $seating_info['point']; ?>&nbsp;pt</span>
                    </div>
                </div>
                <div style="border: 2px solid #D31E03; padding:20px;">
                    <div class="row">
                        <div class="col-md-5">
                            <label class="list-label">Number of people:</label>
                        </div>
                        <div class="col-md-7">
                            <span class="list-value"><?php echo $people_number; ?></span>
                            <input type="hidden" name="people_number" value="<?php echo $people_number; ?>"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <label class="list-label">Reservation date: </label>
                        </div>
                        <div class="col-md-7">
                            <span class="list-value"><?php echo date('jS M Y', strtotime($reserve_date)); ?></span>
                            <input type="hidden" name="reserve_date" value="<?php echo $reserve_date; ?>"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <label class="list-label">Reservation time: </label>
                        </div>
                        <div class="col-md-7">
                            <span class="list-value"><?php echo $reserve_time; ?></span>
                            <input type="hidden" name="reserve_time" value="<?php echo $reserve_time; ?>"/>                        
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="list-label">Payment option: </label>
                        </div>
                        <div class="col-md-12">
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
                    <div class="clearfix"></div>
                    <div class="margin20"></div>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <button style="width: 100%" type="submit" name="btncheckout" class="btn btn-red btn-block">MAKE RESERVATION</button>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
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

<script src="/assets/common/plugins/rating/jquery.rateyo.js" type="text/javascript"></script>

<script>
    $(document).ready(function(){
        $("#rating-view").rateYo({rating:<?php echo $restroInfo->rating?$restroInfo->rating:0; ?>, starWidth:'24px', ratedFill:'#f1c40f'}); 
    });
    $("input:checkbox").click(function(){
        var self = $(this);
        if (self.is(':checked')) {
            // self.
            $('input:checkbox').not(this).prop('checked', false);
        }
    });
</script>