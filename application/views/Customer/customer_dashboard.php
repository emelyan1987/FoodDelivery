<?PHP
    foreach ($customer_maindata as $main => $cuManin):
        $Cu_Email = $cuManin->email;
        $Cu_Mobile_no = $cuManin->mobile_no;
        endforeach;
    $this->load->view("includes/Customer/header");
    $this->load->helper('customer_helper');
    if ($this->session->userdata('user_id') != '') {
    } else {
        //redirect('/login/');
    ?>
    <script>window.location.href="/customer_login"; </script>
    <?php
    }
?>
<style>
    body{
        font-family: "Ubuntu","Ubuntu Beta",UbuntuBeta,Ubuntu,"Bitstream Vera Sans","DejaVu Sans",Tahoma,sans-serif;
        font-weight: normal;
    }
    .btn-default{

        padding: 2px;
        color: #62b102;
        background-color: #f9f9f9 !important;
        border-color: #ccc !important;
        border-radius: 9px;
        width: 136px;
    }
    .btn-icon-right{
        float: right;
        font-size: 20px;
    }
    .detail{
        margin-left: 100px;
        /*margin-bottom: 45px;*/
    }
    .border-right{
        border-right: 2px solid #aaa;
    }
    .actions{
        position: absolute;
        right: 0;
        bottom: 0px;
    }
    .serviceLabel .lable{
        border-radius: 20px !important;
        padding: 6px !important;
    }
    .serviceLabel{
        text-align: center;
    }
    .small-text{
        margin-top: 5px;
        margin-bottom: 10px;
        color: #737373;
        font-size: 11px;
    }
    .fileUpload {
        position: relative;
        overflow: hidden;
        margin: 10px;
        border-radius: 15px !important;
        color: #73b720 !important;
        background-color: #f5f5f5 !important;
    }
    .fileUpload input.upload {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
        padding: 0;
        font-size: 20px;
        cursor: pointer;
        opacity: 0;
        filter: alpha(opacity=0);
    }
    .res-logo{
        width: 150px;
        height: 150px;
        text-align: center;
        margin: 10px auto;
    }
</style>
<div class="container-fluid">
    <div class="margin20"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="border">
                <div class="row">
                    <div class="col-md-3">
                        <h3 class="text-center">Menu</h3>
                    </div>
                </div>
                <div class="col-md-3 border-right">
                    <div class="margin20"></div>
                    <ul class="nav nav-pills nav-stacked newTabStyle1">
                        <li  <?php if ($page == 'orders') {echo 'class="active"';}
                            ?>>
                            <a href="/customer_dashboard/orders">
                                <span class="menuListTitle">My Orders</span>
                                <span class="menuListIcon"><i class="fa fa-angle-right"></i></span>
                            </a>
                        </li>
                        <li <?php if ($page == 'reservations') {echo 'class="active"';}
                            ?>>
                            <a href="/customer_dashboard/reservations">
                                <span class="menuListTitle">My Reservations</span>
                                <span class="menuListIcon"><i class="fa fa-angle-right"></i></span>
                            </a>
                        </li>
                        <li <?php if ($page == 'points') {echo 'class="active"';}
                            ?>>
                            <a href="/customer_dashboard/points">
                                <span class="menuListTitle">My Points</span>
                                <span class="menuListIcon"><i class="fa fa-angle-right"></i></span>
                            </a>
                        </li>
                        <li <?php if ($page == 'settings') {echo 'class="active"';}
                            ?>>
                            <a href="/customer_dashboard/settings">
                                <span class="menuListTitle">My Settings</span>
                                <span class="menuListIcon"><i class="fa fa-angle-right"></i></span>
                            </a>
                        </li>
                        <li <?php if ($page == 'promotions') {echo 'class="active"';}
                            ?>>
                            <a href="/customer_dashboard/promotions">
                                <span class="menuListTitle">Promotions</span>
                                <span class="menuListIcon"><i class="fa fa-angle-right"></i></span>
                            </a>
                        </li>
                        <!-- 		<li  <?php if ($page == 'notifications') {echo 'class="active"';}
                        ?>>
                        <a href="/customer_dashboard/notifications">
                        <span class="menuListTitle">Notifications</span>
                        <span class="menuListIcon"><i class="fa fa-angle-right"></i></span>
                        </a>
                        </li>
                        <li <?php if ($page == 'policies') {echo 'class="active"';}
                        ?>>
                        <a href="/customer_dashboard/policies">
                        <span class="menuListTitle">Policies</span>
                        <span class="menuListIcon"><i class="fa fa-angle-right"></i></span>
                        </a>
                        </li>
                        <li <?php if ($page == 'terms') {echo 'class="active"';}
                        ?>>
                        <a href="/customer_dashboard/terms">
                        <span class="menuListTitle">Terms and conditions</span>
                        <span class="menuListIcon"><i class="fa fa-angle-right"></i></span>
                        </a>
                        </li>-->
                        <li <?php if ($page == 'address') {echo 'class="active"';}
                            ?>>
                            <a href="/customer_dashboard/addresses">
                                <span class="menuListTitle">My Address</span>
                                <span class="menuListIcon"><i class="fa fa-angle-right"></i></span>
                            </a>
                        </li>
                    </ul>
                </div>
                <?php
                    if (count($customer_profile) > 0) {
                        foreach ($customer_profile as $CP => $cust):
                            $Customer_country = $cust->country;
                            $Customer_website = $cust->website;
                            $Customer_f_name = $cust->f_name;
                            $Customer_l_name = $cust->l_name;
                            $Customer_state = $cust->state;
                            $Customer_city = $cust->city;
                            $Customer_address = $cust->address;
                            $Customer_image = $cust->image;
                            $Customer_birthdate = $cust->birthdate;
                            $Customer_gender = $cust->gender;
                            endforeach;
                    } else {
                        $Customer_country = "";
                        $Customer_website = "";
                        $Customer_f_name = "";
                        $Customer_l_name = "";
                        $Customer_state = "";
                        $Customer_city = "";
                        $Customer_address = "";
                        $Customer_image = "";
                        $Customer_birthdate = "";
                        $Customer_gender = "";
                    }
                ?>
                <div class="col-md-9">
                    <div class="tab-content">
                        <?php if ($page == 'orders') {
                            ?>
                            <div>
                                <div class="b">
                                    <?php
                                        foreach ($orderData as $or => $ord):
                                            if ($ord->service_type == 1) {
                                                $service_title = 'Delivery';
                                                $service = "<p class='label label-success'>DELIVERY</p>";
                                            } elseif ($ord->service_type == 2) {
                                                $service_title = 'Catering';
                                                $service = "<p class='label label-warning'>CATERING</p>";
                                            } elseif ($ord->service_type == 4) {
                                                $service_title = 'Pickup';
                                                $service = "<p class='label label-info'>PICKUP</p>";
                                            }

                                            if ($ord->status == 1) {
                                                $cls_status = 'class="blue"';
                                                $title_status = 'UNDER PROCESS';
                                            } elseif ($ord->status == 3) {
                                                $cls_status = 'class="green"';
                                                $title_status = 'COMPLETED';
                                            } elseif ($ord->status == -1) {
                                                $cls_status = 'class="red"';
                                                $title_status = 'CANCELLED';
                                            }

                                            if ($ord->payment_method == 1) {
                                                $payment_method = 'Cash';
                                                $payment_img = '<img class="" alt="" src="/assets/Customer/img/cash.png">';
                                            } elseif ($ord->payment_method == 2) {
                                                $payment_method = 'Knet';
                                                $payment_img = '<img class="" alt="" src="/assets/Customer/img/knet.png">';
                                            } elseif ($ord->payment_method == 3) {
                                                $payment_method = 'Credit Card';
                                                $payment_img = '<img class="" alt="" src="/assets/Customer/img/card.png">';
                                            } elseif ($ord->payment_method == 4) {
                                                $payment_method = 'Paypal';
                                                $payment_img = '<img class="" alt="" src="/assets/Customer/img/paypal.png">';
                                            } else {
                                                $payment_method = "";
                                                $payment_img = "";
                                            }
                                        ?>
                                        <div>                                            

                                            <div class="col-md-12">
                                                <div class="col-md-3 col-sm-12">
                                                    <div style="text-align:center;"> Status: <label <?php echo $cls_status;?>><?php echo $title_status;?></label></div>
                                                    <?php if(isset($ord->restaurant)) { ?>                        
                                                        <img class="img-responsive res-logo" alt="" src="<?php getImagePath($ord->restaurant->restro_logo);?>"/>
                                                        <?php } else { ?>
                                                        <img class="img-responsive res-logo" alt="" src="/assets/Customer/img/default_item.png"/>
                                                        <?php } ?>

                                                    <div style="text-align:center;">
                                                        <?php echo $service?>
                                                    </div>

                                                </div>
                                                <div class="col-md-3 col-sm-12">
                                                    <h4><?php echo isset($ord->restaurant) ? ucwords($ord->restaurant->restro_name) : "";?></h4>
                                                    <h6><?php echo isset($ord->restaurant) ? ucwords($ord->restaurant->location_name) : "";?></h6>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="col-md-12">
                                                        <span class="col-sm-5"><label class="list-label">Order No. :</label></span>
                                                        <span><label class="list-data"><a href="/delivery_order_details/<?php echo $ord->id;?>" class="gray">#<?php echo $ord->order_no;?></a></label></span>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <span class="col-sm-5"><label class="list-label">Amount :</label></span>
                                                        <span><label class="list-data">KD <?php echo $ord->total + $ord->delivery_charges - $ord->discount_amount;?></label></span>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <span class="col-sm-5"><label class="list-label">Date Time :</label></span>
                                                        <span><label class="list-data"><?php echo $ord->date . " " . $ord->time;?></label></span>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <span class="col-sm-5"><label class="list-label">Point Gain/Used :</label></span>
                                                        <span><a href="/customer_dashboard/points"> <label class="list-data"><i class="green"><?php echo $ord->order_points;?></i> pt/<i class="red"><?php echo $ord->used_points;?></i> pt</label></a></span>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <span class="col-sm-5"><label class="list-label">Payment :</label></span>
                                                        <span><label class="list-data"><?php echo $payment_img;?><?php echo $payment_method;?></label>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div style="text-align: right;">
                                                <a href="/order_details/<?php echo $ord->id;?>?service_id=<?php echo $ord->service_type;?>" class="btn btn-default" style="color:#FF8205;">Order Details</a>                                                
                                                <a href="#" class="btn btn-default<?php echo ($ord->status == 3)?"":" disabled";?>" data-toggle="modal" data-target="#areaSelectModal" onclick="onClickReOrder(<?php echo $ord->id;?>, <?php echo $ord->restro_id;?>, <?php echo $ord->location_id;?>, <?php echo $ord->service_type;?>)">RE-ORDER <i class="fa  fa-rotate-left btn-icon-right"></i></a>
                                                <a class="btn btn-default<?php echo ($ord->status == 3)?"":" disabled";?>" style="color:#dcc300;" data-toggle="modal" data-target="#myModal2" onclick="ratPop(<?php echo $ord->id;?>,<?php echo $ord->location_id;?>,<?php echo $ord->restro_id;?>);">Rate it <i class="fa fa-star btn-icon-right"></i></a>
                                            </div>
                                            <div style="margin-bottom:20px;border-bottom:1px solid #ddd;">&nbsp;</div>
                                        </div>
                                        <?php
                                            endforeach;
                                    ?>
                                </div>
                            </div>
                            <?php }
                        ?>
                        <?php if ($page == "addresses"): ?>
                            <div class="col-md-9">
                                <div class="tab-content">
                                    <div class="b">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h2 style="margin-left: 10px">My Addresses</h2>
                                                <div class="margin20"></div>
                                                <div class="row">                                                        
                                                    <div class="col-md-6 form-group">
                                                        <label for="address">Select Address</label>
                                                        <select id="addess_name" class="form-control" onchange="onChangeAddress(this.value)">
                                                            <?php foreach ($addresses as $index => $address): ?>
                                                                <option value="<?=$address->id?>" <?php echo $address->id==$selected_address->id?"selected":"";?>><?=$address->address_name?></option>
                                                                <?php endforeach ?>
                                                            <option value="">== New Address ==</option>
                                                        </select>
                                                        <script>
                                                            function onChangeAddress(val){
                                                                if(val==="") {alert('form reset');
                                                                    //document.getElementById("address-edit-form").reset();
                                                                    $('#address-edit-form')[0].reset();
                                                                } else {
                                                                    location.href="/customer_dashboard/addresses?address_id="+val;
                                                                }
                                                            }
                                                        </script>
                                                    </div>
                                                </div>
                                                <form id="address-edit-form" name="addressEditForm" action="" method="post">
                                                    <input type="hidden" name="address_id" value="<?php echo $selected_address->id;?>"/>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label for="cus_block">Address Name*</label>
                                                            <input type="text" class="form-control" name="address_name" value="<?php echo $selected_address->address_name;?>">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="street">&nbsp;</label>
                                                            <input type="checkbox" name="is_primary" <?php echo $selected_address->is_primary?"checked":"";?>>&nbsp;Set as Primary
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label for="email">Choose your City*</label>
                                                            <select id="cusCity" name="city_id" class="form-control">
                                                                <?php foreach ($cities as $key => $city): ?>
                                                                    <option <?=$city->id == $selected_address->city_id ? "selected='selected'" : ""?> value="<?=$city->id?>"><?=$city->city_name?></option>
                                                                    <?php endforeach?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="cus_area">Choose your Area*</label>
                                                            <select id="cusArea" name="area_id" class="form-control">
                                                                <?php foreach ($areas as $key => $area): ?>
                                                                    <option <?=$area->id == $selected_address->area_id ? "selected='selected'" : ""?> value="<?=$area->id?>"><?=$area->name?></option>
                                                                    <?php endforeach?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label for="cus_block">Block*</label>
                                                            <input type="text" class="form-control" name="block" value="<?php echo $selected_address->block;?>">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="street">Street*</label>
                                                            <input type="text" class="form-control" name="street" value="<?php echo $selected_address->street;?>">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label for="house_name_no">House Name/Number*</label>
                                                            <input type="text" class="form-control" id="house_name_no" name="house" value="<?php echo $selected_address->house;?>">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="floor">Floor*</label>
                                                            <input type="text" class="form-control" id="floor" name="floor" value="<?php echo $selected_address->floor;?>">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label for="appartment">Appartment*</label>
                                                            <input type="text" class="form-control" id="appartment" name="appartment" value="<?php echo $selected_address->appartment;?>">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <label for="direction">Extra Direction <span class="small-text">(add more details for the restaurant's driver to find you faster)</span></label>
                                                            <textarea type="textarea" class="form-control" id="direction" name="extra_directions" value="<?php echo $selected_address->extra_directions;?>"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="com-md-4">
                                                        <button type="submit" class="btn btn-default btn-default-new btn-block btn_new_section pull-left" name="btndelAddress" style="margin-right: 15px;    margin-left: 15px;color: gray">Delete</button>

                                                    </div>
                                                    <div class="col-md-offset-8 com-md-4">
                                                        <button type="submit" class="btn btn-success btn-success-new btn-block btn_new_section pull-right" name="btnAddressEdit" style="margin-right: 15px;">Confirm</button>
                                                    </div>

                                                    <div class="clearfix"></div>
                                                    <div class="col-md-12">
                                                        <div class="margin20"></div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif?>
                        <?php if ($page == 'reservations') {
                            ?>
                            <div>
                                <div class="b">
                                    <?php
                                        foreach ($ReservationData as $res => $ResData):
                                            if ($ResData->status == 2) {
                                                $cls_status = 'class="orange"';
                                                $title_status = 'WAITING PAYMENT';
                                            } elseif ($ResData->status == 1) {
                                                $cls_status = 'class="blue"';
                                                $title_status = 'UNDER PROCESS';
                                            } elseif ($ResData->status == 3) {
                                                $cls_status = 'class="green"';
                                                $title_status = 'COMPLETED';
                                            } elseif ($ResData->status == -1) {
                                                $cls_status = 'class="red"';
                                                $title_status = 'CANCEL';
                                            }
                                        ?>
                                        <div>
                                            <div class="col-md-12">
                                                <div class="col-md-3 col-sm-12">
                                                    <div style="text-align: center;">Status: <label <?php echo $cls_status;?>><?php echo $title_status;?></label></div>
                                                    <?php if(isset($ResData->restaurant)) { ?>                        
                                                        <img class="img-responsive res-logo" alt="" src="<?php getImagePath($ResData->restaurant->restro_logo);?>"/>
                                                        <?php } else { ?>
                                                        <img class="img-responsive res-logo" alt="" src="/assets/Customer/img/default_item.png"/>
                                                        <?php } ?>
                                                </div>
                                                <div class="col-md-3 col-sm-12">
                                                    <h4><?php echo isset($ResData->restaurant) ? ucwords($ResData->restaurant->restro_name) : "";?></h4>
                                                    <h6><?php echo isset($ResData->restaurant) ? ucwords($ResData->restaurant->location_name) : "";?></h6>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="col-md-12">
                                                        <span class="col-sm-5"><label class="list-label">Reservation No. :</label></span>
                                                        <span><label class="list-data"><a href="/delivery_order_details/<?php echo $ResData->id;?>" class="gray">#<?php echo $ResData->order_no;?></a></label></span>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <span class="col-sm-5"><label class="list-label">Date Time :</label></span>
                                                        <span><label class="list-data"><?php echo $ResData->date . " " . $ResData->time;?></label></span>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <span class="col-sm-5"><label class="list-label">Point Gain :</label></span>
                                                        <span><a href="/customer_dashboard/points"> <label class="list-data"><i class="green"><?php echo $ResData->order_points;?></i> pt</label></a></span>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div style="text-align:right;">
                                                <a class="btn btn-default<?php echo ($ResData->status == 3)?"":" disabled";?>" style="color:#dcc300" data-toggle="modal" data-target="#myModal2" onclick="ratPop(<?php echo $ResData->id;?>,<?php echo $ResData->location_id;?>,<?php echo $ResData->restro_id;?>);" href="/restaurant_rating/<?php echo $ResData->restro_id;?>">Rate it <i class="fa fa-star btn-icon-right"></i></a>
                                                <a href="#" class="btn btn-default<?php echo ($ResData->status == 1)?"":" disabled";?>" style="color:#f00">CANCEL</a>
                                                <a href="#" class="btn btn-default" style="color:#FF8205" data-toggle="modal" data-target="#reserveDetailModal" onclick="openReserveDetailModal(<?php echo $ResData->restaurant->status;?>,'<?php echo $ResData->restaurant->restro_logo;?>','<?php echo $ResData->restaurant->restro_name;?>','<?php echo $ResData->restaurant->restro_description;?>','<?php echo $ResData->restaurant->street.' '.$ResData->restaurant->area.','.$ResData->restaurant->city;?>','<?php echo $ResData->restaurant->telephones;?>',<?php echo $ResData->total;?>,<?php echo $ResData->number_of_people;?>,'<?php echo date('jS M Y', strtotime($ResData->date));?>','<?php echo $ResData->time;?>',<?php echo $ResData->restaurant->rating;?>);">DETAILS</a>
                                                <button class="btn btn-default<?php echo ($ResData->status == 2 && $ResData->total>0)?"":" disabled";?>">PAY </button>
                                            </div>
                                            <div style="margin-bottom:20px;border-bottom:1px solid #ddd;">&nbsp;</div>
                                        </div>
                                        <?php
                                            endforeach;
                                    ?>
                                </div>
                            </div>
                            <?php }
                        ?>
                        <?php if ($page == 'points') {
                            ?>
                            <div>
                                <div class="b">
                                    <?php
                                        foreach ($PointData as $index => $point):   
                                            if ($point->service_id == 1) {
                                                $service = "<p class='label label-success'>DELIVERY</p>";
                                            } elseif ($point->service_id == 2) {
                                                $service = "<p class='label label-warning'>CATERING</p>";
                                            } elseif ($point->service_id == 3) {
                                                $service = "<p class='label label-danger'>RESERVATION</p>";
                                            } elseif ($point->service_id == 4) {
                                                $service = "<p class='label label-info'>PICKUP</p>";
                                            }                                         
                                        ?>
                                        <div>
                                            <div class="col-md-12">
                                                <div class="col-md-3 col-sm-12">
                                                    <?php if(isset($point->restaurant)) { ?>                        
                                                        <img class="img-responsive res-logo" alt="" src="<?php getImagePath($point->restaurant->restro_logo);?>"/>
                                                        <?php } else { ?>
                                                        <img class="img-responsive res-logo" alt="" src="/assets/Customer/img/default_item.png"/>
                                                        <?php } ?>
                                                    <div style="text-align: center;"><?php echo $service;?></div>
                                                </div>
                                                <div class="col-md-3 col-sm-12">
                                                    <h4><?php echo isset($point->restaurant) ? ucwords($point->restaurant->restro_name) : "";?></h4>
                                                    <h6><?php echo isset($point->restaurant) ? ucwords($point->restaurant->location_name) : "";?></h6>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="col-md-12">
                                                        <span class="col-sm-5"><label class="list-label">Order No. :</label></span>
                                                        <span><label class="list-data"><a href="/delivery_order_details/<?php echo $point->order_id;?>" class="gray">#<?php echo isset($point->order)?$point->order->order_no:"";?></a></label></span>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <span class="col-sm-5"><label class="list-label">Date Time :</label></span>
                                                        <span><label class="list-data"><?php echo date('d.m.Y', strtotime($point->created_time));?></label></span>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <span class="col-sm-5"><label class="list-label">Loyalty Point Gained/Used :</label></span>
                                                        <span><a href="/customer_dashboard/points"> <label class="list-data"><i class="green"><?php echo $point->gained_loyalty_point;?></i> pt/<i class="red"><?php echo $point->used_loyalty_point;?></i> pt</label></a></span>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <span class="col-sm-5"><label class="list-label">Loyalty Balance :</label></span>
                                                        <span><a href="/customer_dashboard/points"> <label class="list-data"><i class="green"><?php echo $point->balance_loyalty_point;?></i> pt</label></a></span>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <span class="col-sm-5"><label class="list-label">Mataam Point Gained/Used :</label></span>
                                                        <span><a href="/customer_dashboard/points"> <label class="list-data"><i class="green"><?php echo $point->gained_mataam_point;?></i> pt/<i class="red"><?php echo $point->used_mataam_point;?></i> pt</label></a></span>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <span class="col-sm-5"><label class="list-label">Mataam Balance :</label></span>
                                                        <span><a href="/customer_dashboard/points"> <label class="list-data"><i class="green"><?php echo $point->balance_mataam_point;?></i> pt</label></a></span>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div style="margin-bottom:20px;border-bottom:1px solid #ddd;">&nbsp;</div>
                                        </div>
                                        <?php
                                            endforeach;
                                    ?>
                                </div>
                            </div>
                            <?php }
                        ?>
                        <?php if ($page == 'settings') {
                            ?>
                            <div>
                                <div class="b">
                                    <div class="row">
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <div class="col-md-12" style="margin-left: 20px">
                                                <h3><span class="remove"><i class="fa fa-user"></i></span>My Settings</h3>
                                                <div class="lightBorder"></div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="margin20"></div>
                                                <div class="profilePicBlock">
                                                    <img class="profilePic" alt="" src="<?php if ($Customer_image != '') {getImagePath($Customer_image);} else {echo "/assets/Customer/img/user-profile.png";}
                                                        ?>">
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="margin20"></div>
                                                <div class="col-md-12 center" style="margin: 24px 32%;">
                                                    <div class="fileUpload btn btn-default">
                                                        <span>Change Photo</span>
                                                        <input class="upload" type="file" id="cust_img" name="cust_img">
                                                    </div>
                                                </div>
                                                <!--<div class="text-center">
                                                <input type="file" class="editProfilePic center-block" name="customerimg"></input>
                                                </div>-->
                                            </div>
                                            <div class="col-md-6">

                                                <div class="clearfix"></div>
                                                <div class="margin20"></div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email">First Name:</label>
                                                        <input type="text" class="form-control" id="cust_f_name" name="cust_f_name" value="<?php echo $Customer_f_name;?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="pwd">Last name:</label>
                                                        <input type="text" class="form-control" id="cust_l_name" name="cust_l_name" value="<?php echo $Customer_l_name;?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email">Email:</label>
                                                        <input type="email" class="form-control" id="cust_email" name="cust_email" value="<?php echo $Cu_Email;?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="pwd">Home no:</label>
                                                        <input type="text" disabled="disabled=" class="form-control" id="cust_contact" name="cust_contact" value="<?php echo $Cu_Mobile_no;?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email">Gender:</label>
                                                        <br>
                                                        <input type="radio" id="cust_gender" name="cust_gender" value="1" <?php if ($Customer_gender == 1) {echo 'checked';}
                                                            ?>> Male &nbsp;&nbsp;&nbsp;&nbsp;
                                                        <input type="radio" id="cust_gender" name="cust_gender" value="2" <?php if ($Customer_gender == 2) {echo 'checked';}
                                                            ?>> Female
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="pwd">Birth Date:</label>
                                                        <input type="text" class="form-control" id="birth_date" name="cust_birth" value="<?php echo $Customer_birthdate;?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="pwd">Subscription</label>
                                                        <br>
                                                        <input type="radio" id="notifications" name="notifications" value="1" > Notification &nbsp;&nbsp;&nbsp;&nbsp;
                                                        <input type="radio" id="sms" name="sms" value="2" > SMS &nbsp;&nbsp;&nbsp;&nbsp;
                                                        <input type="radio" id="sub_emails" name="sub_emails" value="3" > Emails
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12" style="margin-left: 20px">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <h3><span class="remove"><i class="fa fa-lock"></i></span>Change Password</h3>
                                                            <div class="lightBorder"></div>
                                                            <br>
                                                            <div class="form-group">
                                                                <input class="form-control newInput what_section text-center" type="password"  placeholder="Enter Current Password" name="old_pass" autocomplete="off" >
                                                            </div>
                                                            <div class="form-group">
                                                                <input class="form-control newInput what_section text-center" type="password"  placeholder="Enter New Password" name="new_pass" autocomplete="off" >
                                                            </div>
                                                            <div class="form-group">
                                                                <input class="form-control newInput what_section text-center" type="password"  placeholder="Re-Enter New Password" name="confirm_pass" autocomplete="off" >
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <h3><span class="remove"><i class="fa fa-tablet"></i></span>Change Mobile no.</h3>
                                                            <div class="lightBorder"></div>
                                                            <br>
                                                            <div class="form-group">
                                                                <input class="form-control newInput what_section text-center" type="password"  placeholder="Enter Current Password" name="m_c_password" autocomplete="off" >
                                                            </div>
                                                            <div class="form-group">
                                                                <input class="form-control newInput what_section text-center" type="text"  placeholder="Enter New Mobile no." name="new_mobile_no" autocomplete="off" >
                                                            </div>
                                                            <div class="form-group">
                                                                <input class="form-control newInput what_section text-center" type="text"  placeholder="Re-Enter New Mobile no." name="confirm_mobile_no" autocomplete="off" >
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3" style="margin-top: 15.8%">
                                                            <button type="submit" class="btn btn-success btn-success-new btn-block btn_new_section" name="btnprofileEdit">Confirm</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="col-md-12">
                                            <?php
                                                $i = 1;
                                                foreach ($customer_address as $key => $address):
                                                ?>
                                                <div class="col-md-6">
                                                    <div class="panel-group">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <h4 class="panel-title">
                                                                    <a data-toggle="collapse" href="#collapse<?php echo $i;?>"><?php echo ucwords($address->billing_full_name);?></a>
                                                                </h4>
                                                            </div>
                                                            <div id="collapse<?php echo $i;?>" class="panel-collapse collapse">
                                                                <div class="panel-body">
                                                                    <div class="col-md-12">
                                                                        <div>
                                                                            <div class="col-md-12">
                                                                                <h4>Billing Address</h4>
                                                                                <div class="col-md-6">
                                                                                    <strong>&nbsp;Full Name</strong>
                                                                                </div>
                                                                                <div class="col-md-6">&nbsp;
                                                                                    <?php echo $address->billing_full_name;?>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <strong>&nbsp;Address Line 1</strong>
                                                                                </div>
                                                                                <div class="col-md-6">&nbsp;
                                                                                    <?php echo $address->billing_addres_1;?>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <strong>&nbsp;Address Line 2</strong>
                                                                                </div>
                                                                                <div class="col-md-6">&nbsp;
                                                                                    <?php echo $address->billing_address_2;?>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <strong>&nbsp;City</strong>
                                                                                </div>
                                                                                <div class="col-md-6">&nbsp;
                                                                                    <?php echo $address->billing_city;?>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <strong>&nbsp;State</strong>
                                                                                </div>
                                                                                <div class="col-md-6">&nbsp;
                                                                                    <?php echo $address->billing_state;?>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <strong>&nbsp;Zip Code No.</strong>
                                                                                </div>
                                                                                <div class="col-md-6">&nbsp;
                                                                                    <?php echo $address->billing_zip_code;?>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <strong>&nbsp;Contact No.</strong>
                                                                                </div>
                                                                                <div class="col-md-6">&nbsp;
                                                                                    <?php echo $address->billing_phoneno;?>
                                                                                </div>
                                                                                <div class="margin20"><br><br></div>
                                                                                <h4>Shipping Address</h4>
                                                                                <div class="col-md-6">
                                                                                    <strong>&nbsp;Full Name</strong>
                                                                                </div>
                                                                                <div class="col-md-6">&nbsp;
                                                                                    <?php echo $address->shipping_full_name;?>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <strong>&nbsp;Address Line 1</strong>
                                                                                </div>
                                                                                <div class="col-md-6">&nbsp;
                                                                                    <?php echo $address->shipping_address_1;?>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <strong>&nbsp;Address Line 2</strong>
                                                                                </div>
                                                                                <div class="col-md-6">&nbsp;
                                                                                    <?php echo $address->shipping_address_2;?>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <strong>&nbsp;City</strong>
                                                                                </div>
                                                                                <div class="col-md-6">&nbsp;
                                                                                    <?php echo $address->shipping_city;?>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <strong>&nbsp;State</strong>
                                                                                </div>
                                                                                <div class="col-md-6">&nbsp;
                                                                                    <?php echo $address->shipping_state;?>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <strong>&nbsp;Zip Code No.</strong>
                                                                                </div>
                                                                                <div class="col-md-6">&nbsp;
                                                                                    <?php echo $address->shipping_zip_code;?>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <strong>&nbsp;Contact No.</strong>
                                                                                </div>
                                                                                <div class="col-md-6">&nbsp;
                                                                                    <?php echo $address->shipping_phoneno;?>
                                                                                </div>
                                                                            </div>
                                                                            <br>
                                                                            <a href="#" class="btn btn-success" style="float:right;margin-top:10px;" data-toggle="modal" data-target="#editAddressModel" onclick='editAddressFun("<?php echo $address->id;?>")' >Edit this Address</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                    $i++;
                                                    endforeach;
                                            ?>
                                        </div>
                                    </div>
                                    <div class="margin20"></div>
                                    <!--<form action="" method="post" >
                                    <div class="row">
                                    <?php
                                        if (isset($successMsg)) {
                                        ?>
                                        <div class="col-md-12" style="text-align:center;">
                                        <?php echo $successMsg;?>
                                        </div>
                                        <?php
                                        }
                                    ?>
                                    <div class="col-md-12">
                                    <h3><span class="remove"><i class="fa fa-lock"></i></span> Change Password</h3>
                                    <div class="lightBorder"></div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="margin20"></div>
                                    <div class="col-md-6">
                                    <div class="form-horizontal">
                                    <div class="col-md-12">
                                    <div class="form-group">
                                    <div class="col-sm-12">
                                    <input type="password" class="form-control searchInput" placeholder="Old Password" name="old_pass" required>
                                    <span style="color:red"><?PHP echo form_error('old_pass');?></span>
                                    </div>
                                    </div>
                                    <div class="form-group">
                                    <div class="col-sm-12">
                                    <input type="password" class="form-control searchInput" placeholder="New Password" name="new_pass" required>
                                    <span style="color:red"><?PHP echo form_error('new_pass');?></span>
                                    </div>
                                    </div>
                                    <div class="form-group">
                                    <div class="col-sm-12">
                                    <input type="password" class="form-control searchInput" placeholder="Confirm Password" name="confirm_pass" required>
                                    <span style="color:red"><?PHP echo form_error('confirm_pass');?></span>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="margin40"></div>
                                    <button type="submit" name="btnpassword" class="btn btn-block btn-success-new">Confirm</button>
                                    </div>
                                    </div>
                                    </form>-->
                                </div>
                            </div>
                            <?php }
                        ?>
                        <?php if ($page == 'promotions') {
                            ?>
                            <?php
                                foreach ($promotions as $pro => $proData):
                                ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-3 col-sm-12">
                                            <h5 class="text-left">
                                                <?php
                                                    if ($proData->status == 1) {
                                                        $stl = 'class="opened"';
                                                        $status_title = "Open";
                                                    } elseif ($proData->status == 2) {
                                                        $stl = 'class="busy"';
                                                        $status_title = "Busy";
                                                    } else {
                                                        $stl = 'class="close"';
                                                        $status_title = "Close";
                                                    }
                                                ?>
                                                <span <?php echo $stl;?>></span> <?php echo $status_title;?>
                                            </h5>
                                            <?php
                                                if ($proData->restaurant_logo != '') {
                                                ?>
                                                <img class="img-responsive center-block" alt="" src="<?php $img = explode('public_html', $proData->restaurant_logo);
                                                    echo $img[1];?>" style="width: 150px">
                                                <?php
                                                } else {
                                                ?>
                                                <img class="img-responsive center-block" alt="" src="/assets/Customer/img/icon/bottomIcon2.png" style="height:150px;width: 150px">
                                                <?php
                                                }
                                                $service = "";
                                                switch ($proData->service_id) {
                                                    case '1':
                                                        $service = "<p class='label label-success'>DELIVERY</p>";
                                                        $color = "#73B720";
                                                        break;
                                                    case '2':
                                                        $service = "<p class='label label-warning'>CATERING</p>";
                                                        $color = "#FF8205";
                                                        break;
                                                    case '3':
                                                        $service = "<p class='label label-danger'>RESERVATION</p>";
                                                        $color = "#D31E03";
                                                        break;
                                                    case '4':
                                                        $service = "<p class='label label-info'>PICKUP</p>";
                                                        $color = "#2793FF";
                                                        break;
                                                }
                                            ?>
                                            <div class="serviceLabel">
                                                <?php echo $service?>
                                            </div>
                                        </div>
                                        <div class="col-md-9 col-sm-12">
                                            <h4><?php echo ucwords($proData->restro_name);?></h4>
                                            <div class="detail">
                                                <h4 style="color:#73B720"><?php echo ucwords($proData->name);?></h4>
                                                <p><?php echo $proData->description;?></p>
                                                <p>Amount KD <?php echo number_format($proData->price, 3);?></p>
                                                <p>Validity: <?php echo date('d/m/Y', strtotime($proData->to_date));?></p>
                                            </div>
                                            <div class="col-md-8 pull-right" style="margin-bottom: 5px;padding-right: 0">
                                                <div class="row">
                                                    <div class="col-md-6 col-xs-12 col-sm-8">                                                        
                                                        <a href="#" data-toggle="modal" data-target="#areaSelectModal" style="font-size: 14px;" class="btn btn-yellow btn-yellow-new-sm btn-block" onclick="onClickAddPromotionToCart(<?php echo $proData->id;?>, <?php echo $proData->restro_id;?>, <?php echo $proData->location_id;?>, <?php echo $proData->service_id;?>)"><img src="/assets/Administration/images/icon/cartIcon.png" alt="" style="height: 20px;"> ADD TO CART </a>
                                                    </div>
                                                    <div class="col-md-6 col-xs-12 col-sm-8">
                                                        <a href="/restaurant_view/<?php echo $proData->restro_id;?>/<?php echo $proData->location_id;?>" style="font-size: 14px !important;background-color:<?php echo $color;?>;border-color:<?php echo $color;?>;" class="btn btn-block btn_new_section btn-success-new pull-right">GO TO MENU <i class="fa fa-caret-right"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="col-md-12">
                                            <div class="lightBorder"></div>
                                            <div class="margin20"></div>
                                        </div>
                                    </div>

                                </div>
                                <?php
                                    endforeach;}
                        ?>
                        <?php if ($page == 'notifications') {
                            ?>

                            <div>
                                <?php
                                    foreach ($web_list as $list => $noti):
                                    ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="padTB10"><span class="remove"><i class="fa fa-times-circle"></i></span><?php echo $noti->message;?></p>
                                            <div class="clearfix"></div>
                                            <div class="col-md-12">
                                                <div class="lightBorder"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        endforeach;
                                ?>
                            </div>
                            <?php }
                        ?>
                        <?php if ($page == 'policies') {?>
                            <div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <?php echo $privacy_data['text'];?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php }
                        ?>
                        <?php if ($page == 'terms') {?>
                            <div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <?php echo $tearms_data['text'];?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="margin20"></div>
</div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Address</h4>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <h3>Billing Address</h3>
                            <div class="form-group">
                                <label for="email">Full Name:</label>
                                <input type="text" class="form-control" id="billing_full_name" name="billing_full_name" required>
                            </div>
                            <div class="form-group">
                                <label for="pwd">Area:</label>
                                <input type="text" class="form-control" id="billing_city" name="billing_city">
                            </div>
                            <div class="form-group">
                                <label for="pwd">Building:</label>
                                <input type="text" class="form-control" id="billing_addres_1" name="billing_addres_1">
                            </div>
                            <div class="form-group">
                                <label for="email">Block:</label>
                                <input type="text" class="form-control" id="billing_address_2" name="billing_address_2">
                            </div>
                            <div class="form-group">
                                <label for="email">Floor:</label>
                                <input type="text" class="form-control" id="billing_state" name="billing_state">
                            </div>
                            <div class="form-group">
                                <label for="pwd">Street:</label>
                                <input type="text" class="form-control" id="billing_zip_code" name="billing_zip_code">
                            </div>
                            <div class="form-group">
                                <label for="pwd">Apartment:</label>
                                <input type="text" class="form-control" id="billing_phoneno" name="billing_phoneno" required>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" value="1" onchange="toggleCheckbox(this)"> Shipping Address Same as billing </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h3>Shipping Address</h3>
                            <div class="form-group">
                                <label for="email">Full Name:</label>
                                <input type="text" class="form-control" id="shipping_full_name" name="shipping_full_name" required>
                            </div>
                            <div class="form-group">
                                <label for="pwd">Area:</label>
                                <input type="text" class="form-control" id="shipping_city" name="shipping_city">
                            </div>
                            <div class="form-group">
                                <label for="pwd">Building:</label>
                                <input type="text" class="form-control" id="shipping_address_1" name="shipping_address_1">
                            </div>
                            <div class="form-group">
                                <label for="email">Block:</label>
                                <input type="text" class="form-control" id="shipping_address_2" name="shipping_address_2">
                            </div>
                            <div class="form-group">
                                <label for="email">Floor:</label>
                                <input type="text" class="form-control" id="shipping_state" name="shipping_state">
                            </div>
                            <div class="form-group">
                                <label for="pwd">Street:</label>
                                <input type="text" class="form-control" id="shipping_zip_code" name="shipping_zip_code">
                            </div>
                            <div class="form-group">
                                <label for="pwd">Apartment:</label>
                                <input type="text" class="form-control" id="shipping_phoneno" name="shipping_phoneno" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" name="btnaddressave">Submit</button>
            </div>
        </div>
        </form>
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
    function toggleCheckbox1(element)
    {
        if(element.checked)
        {
            var full_name = document.getElementById("billing_full_namee").value;
            var billing_addres_1 = document.getElementById("billing_addres_1e").value;
            var billing_address_2 = document.getElementById("billing_address_2e").value;
            var billing_city = document.getElementById("billing_citye").value;
            var billing_state = document.getElementById("billing_statee").value;
            var billing_zip_code = document.getElementById("billing_zip_codee").value;
            var phoneno = document.getElementById("billing_phonenoe").value;
            document.getElementById("shipping_full_namee").value = full_name;
            document.getElementById("shipping_address_1e").value = billing_addres_1;
            document.getElementById("shipping_address_2e").value = billing_address_2;
            document.getElementById("shipping_citye").value = billing_city;
            document.getElementById("shipping_statee").value = billing_state;
            document.getElementById("shipping_zip_codee").value = billing_zip_code;
            document.getElementById("shipping_phonenoe").value = phoneno;
        }
    }
</script>
<!-- Modal -->
<div id="EditProfileModel" class="modal fade" role="dialog" data-backdrop="static" >
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Profile</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">First Name:</label>
                                <input type="text" class="form-control" id="cust_f_name" name="cust_f_name" value="<?php echo $Customer_f_name;?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pwd">Last name:</label>
                                <input type="text" class="form-control" id="cust_l_name" name="cust_l_name" value="<?php echo $Customer_l_name;?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="cust_email" name="cust_email" value="<?php echo $Cu_Email;?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pwd">Phone Number:</label>
                                <input type="text" class="form-control" id="cust_contact" name="cust_contact" value="<?php echo $Cu_Mobile_no;?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Gender:</label>
                                <br>
                                <input type="radio" id="cust_gender" name="cust_gender" value="1" <?php if ($Customer_gender == 1) {echo 'checked';}
                                    ?>> Male &nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" id="cust_gender" name="cust_gender" value="2" <?php if ($Customer_gender == 2) {echo 'checked';}
                                    ?>> Female
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pwd">Birth Date:</label>
                                <input type="text" class="form-control" id="birth_date" name="cust_birth" value="<?php echo $Customer_birthdate;?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="pwd">Profile Image:</label>
                                <input type="file" id="cust_img" name="cust_img">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" name="btnprofileEdit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--rating model-->
<div id="myModal2" class="modal fade" role="dialog" data-backdrop="static" >
    <div class="modal-dialog new-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <form action="" method="post">
                    <button type="button" class="close close1" data-dismiss="modal"><i class="fa fa-times-circle"></i></button>
                    <h4 class="modal-title modal-title-alt"><b>PLEASE RATE THIS ORDER</b></h4>
                    <textarea class="ratingMsg" rows="10" placeholder="Write your review here" name="message"></textarea>
                    <div class="row">
                        <div class="col-md-offset-2 col-md-8">
                            <div class="ratingNew">
                                <span><i class="fa fa-star" id="star1"></i></span>
                                <span><i class="fa fa-star white" id="star2"></i></span>
                                <span><i class="fa fa-star white" id="star3"></i></span>
                                <span><i class="fa fa-star white" id="star4"></i></span>
                                <span><i class="fa fa-star white" id="star5"></i></span>
                                <span class="overallRate" id="showstarcount">1 Stars</span>
                                <input type="hidden" id="hiddenRat" name="star_value">
                                <input type="hidden" id="hidden_pop_order" name="hidden_pop_order">
                                <input type="hidden" id="hidden_pop_location" name="hidden_pop_location">
                                <input type="hidden" id="hidden_pop_restro" name="hidden_pop_restro">
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="margin20"></div>
                        <div class="col-md-offset-2 col-md-8">
                            <button class="btnt btn-success-new-sm" type="submit" name="orderratIt">RATE IT</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="reserveDetailModal" class="modal fade" role="dialog" data-backdrop="static" >
    <div class="modal-dialog new-dialog">        
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close close1" data-dismiss="modal"><i class="fa fa-times-circle"></i></button>
                <h4 class="modal-title modal-title-alt"><b>RESERVE DETAILS</b></h4>
                <div class="margin20"></div>

                <div id="reserveDetailTplContainer"></div>
            </div>
        </div>
    </div>
</div>

<script id="reserveDetailTpl" type="text/x-jQuery-tmpl">
    <div class="row">
    <div class="col-md-5">
    <div>                            
    <span class="${statusClass(status)}"></span> ${statusTitle(status)}
    </div>
    <div>
    <img class="img-responsive res-logo" alt="" src="${restroLogoPath(restro_logo)}">
    </div>
    </div>
    <div class="col-md-7">
    <div class="restro_title">${restro_name}</div>
    <div class="restro_desc">${restro_description}</div>
    <div class="rating-view"></div>
    </div>
    </div>
    <div style="color:#D31E03;font-size:15px;font-weight:bold;border-bottom:2px solid #D31E03;padding:5px 20px;">RESTAURANT LOCATION</div>
    <div style="padding:20px;">
    <div><span>Address:&nbsp;</span><span>${address}</span></div>
    <div><span>Phone:&nbsp;</span><span>${telephone}</span></div>
    <div><span>Reservation for person:&nbsp;</span><span>${formatPrice(deposit)}</span></div>
    </div>
    <div style="padding:20px;line-height:26px;">
    <div class="row"><span class="list-label">Number of people:&nbsp;</span><span class="list-value">${number_of_people}</span></div>
    <div class="row"><span class="list-label">Reservation date:&nbsp;</span><span class="list-value">${reserve_date}</span></div>
    <div class="row"><span class="list-label">Reservation time:&nbsp;</span><span class="list-value">${reserve_time}</span></div>
    </div>

</script>
<script src="/assets/Customer/js/jquery.tmpl.js" type="text/javascript"></script>
<script src="/assets/common/plugins/rating/jquery.rateyo.js" type="text/javascript"></script>

<script>
    function statusClass(status) {
        if(status == 1) return 'opened';
        else if(status == 2) return 'busy';
            else return 'close';
    }
    function statusTitle(status) {
        if(status == 1) return 'Open';
        else if(status == 2) return 'Busy';
            else return 'Close';
    }
    function restroLogoPath(restro_logo) {
        if(restro_logo) return '/images/'+restro_logo.split('/images/')[1];
        return '/assets/Customer/img/icon/bottomIcon2.png';
    }
    function formatPrice(price) {
        return "KD " + Number(price).toFixed(2);
    }

    function openReserveDetailModal(status, restro_logo, restro_name, restro_description, address, telephone, deposit, number_of_people, reserve_date, reserve_time, rating) {
        $('#reserveDetailTplContainer').html('');

        $("#reserveDetailTpl").tmpl({
            status: status,
            restro_logo: restro_logo,
            restro_name: restro_name,
            restro_description: restro_description,
            address: address,
            telephone: telephone,
            deposit: deposit,
            number_of_people: number_of_people,
            reserve_date: reserve_date,
            reserve_time: reserve_time

        }).appendTo("#reserveDetailTplContainer"); 

        //var rating = 1.5;
        $('.rating-view').rateYo({rating:rating?rating:0, starWidth:'24px', ratedFill:'#f1c40f'}); 
    }
</script>


<div id="areaSelectModal" class="modal fade" role="dialog" data-backdrop="static" >
    <div class="modal-dialog new-dialog">        
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close close1" data-dismiss="modal"><i class="fa fa-times-circle"></i></button>
                <h4 class="modal-title modal-title-alt"><b>SELECT AREA</b></h4>
                <div class="margin20"></div>
                <div class="input-group" style="margin-bottom: 10px;">                    
                    <span class="input-group-btn">
                        <button id="search-area-button" class="btn btn-secondary" type="button"><i class="fa fa-search"></i></button>
                    </span>
                    <input id="search-area-input" type="text" class="form-control" placeholder="Search for..." onkeyup="onChangeSearchArea()">
                </div>
                <div id="area-tree-view" style="max-height:600px;overflow-y:auto;"></div>
            </div>
            <div class="modal-footer">
                <button id="btn-area-select-submit" class="btn btn-primary">OK</button>
            </div>

        </div>
    </div>
</div>

<link rel="stylesheet" href="/assets/common/plugins/bootstrap-treeview/dist/bootstrap-treeview.min.css" type="text/css">
<script src="/assets/common/plugins/bootstrap-treeview/dist/bootstrap-treeview.min.js" type="text/javascript"></script>


<script>
    function onClickReOrder(order_id, restro_id, location_id, service_type) {
        if(service_type == 1 || service_type == 2) {

            $.ajax({
                url: "/api/restaurants/"+restro_id+"/areas?location_id="+location_id+"&service_id="+service_type,
                type: "GET",
                success: function(response) {
                    console.log('getRestroAreas response', response);                

                    if(response.code == 0 && response.resource.length>0) {
                        var color = "";
                        if(service_type == 1) {
                            color = "green";
                        } else if(service_type == 2) {
                            color = "orange";
                        }
                        var trees = [];
                        response.resource.forEach(function(area){
                            console.log(area);
                            if(trees[area.city_id] === undefined) {
                                trees[area.city_id] = {
                                    text: area.city_name, 
                                    selectable: false, 
                                    state: {
                                        expanded:true
                                    },
                                    nodes: []
                                };
                            }
                            trees[area.city_id].nodes.push({
                                areaId: area.id,
                                text: area.name,
                                icon: 'custom-icon-normal icon-item',
                                selectedIcon: 'custom-icon-normal icon-item-selected-'+color
                            });
                        });

                        console.log(Object.values(trees));
                        $('#area-tree-view').treeview({
                            data: Object.values(trees),
                            highlightSelected: false,
                            expandIcon: 'custom-icon-large icon-bulletin-gray',
                            collapseIcon: 'custom-icon-large icon-bulletin-'+color,
                            color: '#6B6B6B',
                            backColor: '#F5F5F5',
                            onhoverColor: '#F5F5F5',
                            borderColor: '#FFFFFF'
                        });

                        $('#btn-area-select-submit').click(function(e){
                            var selectedNodes =  $('#area-tree-view').treeview('getSelected'); console.log(selectedNodes); //return;

                            if(selectedNodes.length == 0) {
                                alert('Please select an area'); return;
                            }
                            location.href = "/reorder?service_id="+service_type+"&order_id="+order_id+"&area_id="+selectedNodes[0].areaId;
                        });
                    } else {
                        alert("Can't find restro areas");
                    }
                }
            });
        } else {
            location.href = "/reorder?service_id="+service_type+"&order_id="+order_id;
        }
    }


    function onChangeSearchArea() {
        var keyword = $('#search-area-input').val();
        $('#area-tree-view').treeview('search', [ keyword, {
            ignoreCase: true,     // case insensitive
            exactMatch: false,    // like or equals
            revealResults: true,  // reveal matching nodes
        }]);
    }

    function onClickAddPromotionToCart(promo_id, restro_id, location_id, service_type) {
        if(service_type == 1 || service_type == 2) {

            $.ajax({
                url: "/api/restaurants/"+restro_id+"/areas?location_id="+location_id+"&service_id="+service_type,
                type: "GET",
                success: function(response) {
                    console.log('getRestroAreas response', response);                

                    if(response.code == 0 && response.resource.length>0) {
                        var color = "";
                        if(service_type == 1) {
                            color = "green";
                        } else if(service_type == 2) {
                            color = "orange";
                        }
                        var trees = [];
                        response.resource.forEach(function(area){
                            console.log(area);
                            if(trees[area.city_id] === undefined) {
                                trees[area.city_id] = {
                                    text: area.city_name, 
                                    selectable: false, 
                                    state: {
                                        expanded:true
                                    },
                                    nodes: []
                                };
                            }
                            trees[area.city_id].nodes.push({
                                areaId: area.id,
                                text: area.name,
                                icon: 'custom-icon-normal icon-item',
                                selectedIcon: 'custom-icon-normal icon-item-selected-'+color
                            });
                        });

                        console.log(Object.values(trees));
                        $('#area-tree-view').treeview({
                            data: Object.values(trees),
                            highlightSelected: false,
                            expandIcon: 'custom-icon-large icon-bulletin-gray',
                            collapseIcon: 'custom-icon-large icon-bulletin-'+color,
                            color: '#6B6B6B',
                            backColor: '#F5F5F5',
                            onhoverColor: '#F5F5F5',
                            borderColor: '#FFFFFF'
                        });

                        $('#btn-area-select-submit').click(function(e){
                            var selectedNodes =  $('#area-tree-view').treeview('getSelected'); console.log(selectedNodes); //return;

                            if(selectedNodes.length == 0) {
                                alert('Please select an area'); return;
                            }
                            location.href = "/add_promoitem_to_cart?service_id="+service_type+"&promo_id="+promo_id+"&area_id="+selectedNodes[0].areaId;
                        });
                    } else {
                        alert("Can't find restro areas");
                    }
                }
            });
        } else {
            location.href = "/add_promo_to_cart?service_id="+service_type+"&promo_id="+promo_id;
        }
    }
</script>
<?php
    $this->load->view("includes/Customer/advertise");
    $this->load->view("includes/Customer/footer");
?>
<script>
    $(function() {
        var dateToday = new Date();
        $("#birth_date" ).datepicker({dateFormat: 'yy-mm-dd', changeMonth: true,
            changeYear: true,
            dateFormat: 'dd-mm-yy',
            yearRange: '-100:+1'});
    });
    $('#star1').click(function (){
        $('#star1').attr('class', 'fa fa-star');
        $('#star2').attr('class', 'fa fa-star white');
        $('#star3').attr('class', 'fa fa-star white');
        $('#star4').attr('class', 'fa fa-star white');
        $('#star5').attr('class', 'fa fa-star white');
        $('#hiddenRat').val(1);
        $('#showstarcount').html('1 Stars');
    });
    $('#star2').click(function (){
        $('#star1').attr('class', 'fa fa-star');
        $('#star2').attr('class', 'fa fa-star');
        $('#star3').attr('class', 'fa fa-star white');
        $('#star4').attr('class', 'fa fa-star white');
        $('#star5').attr('class', 'fa fa-star white');
        $('#hiddenRat').val(2);
        $('#showstarcount').html('2 Stars');
    });
    $('#star3').click(function (){
        $('#star1').attr('class', 'fa fa-star');
        $('#star2').attr('class', 'fa fa-star');
        $('#star3').attr('class', 'fa fa-star');
        $('#star4').attr('class', 'fa fa-star white');
        $('#star5').attr('class', 'fa fa-star white');
        $('#hiddenRat').val(3);
        $('#showstarcount').html('3 Stars');
    });
    $('#star4').click(function (){
        $('#star1').attr('class', 'fa fa-star');
        $('#star2').attr('class', 'fa fa-star');
        $('#star3').attr('class', 'fa fa-star');
        $('#star4').attr('class', 'fa fa-star');
        $('#star5').attr('class', 'fa fa-star white');
        $('#hiddenRat').val(4);
        $('#showstarcount').html('4 Stars');
    });
    $('#star5').click(function (){
        $('#star1').attr('class', 'fa fa-star');
        $('#star2').attr('class', 'fa fa-star');
        $('#star3').attr('class', 'fa fa-star');
        $('#star4').attr('class', 'fa fa-star');
        $('#star5').attr('class', 'fa fa-star');
        $('#hiddenRat').val(5);
        $('#showstarcount').html('5 Stars');
    });
</script>
<script>
    function ratPop(order, location, restro){ console.log(order, location, restro);
        $('#hidden_pop_order').val(order);
        $('#hidden_pop_location').val(location);
        $('#hidden_pop_restro').val(restro);
    }
</script>
<?php
    if ((isset($_SESSION['UserChangeMobileNo'])) && ($_SESSION['UserChangeMobileNo'] != '')) {
    ?>
    <!-- Modal -->
    <div id="OtpModel123" class="modal fade" >
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Edit Profile</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">First Name:</label>
                                    <input type="text" class="form-control" id="cust_f_name" name="cust_f_name" value="<?php echo $Customer_f_name;?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pwd">Last name:</label>
                                    <input type="text" class="form-control" id="cust_l_name" name="cust_l_name" value="<?php echo $Customer_l_name;?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" id="cust_email" name="cust_email" value="<?php echo $Cu_Email;?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pwd">Phone Number:</label>
                                    <input type="text" class="form-control" id="cust_contact" name="cust_contact" value="<?php echo $Cu_Mobile_no;?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Gender:</label>
                                    <br>
                                    <input type="radio" id="cust_gender" name="cust_gender" value="1" <?php if ($Customer_gender == 1) {echo 'checked';}
                                        ?>> Male &nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" id="cust_gender" name="cust_gender" value="2" <?php if ($Customer_gender == 2) {echo 'checked';}
                                        ?>> Female
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pwd">Birth Date:</label>
                                    <input type="text" class="form-control" id="birth_date" name="cust_birth" value="<?php echo $Customer_birthdate;?>">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="pwd">Profile Image:</label>
                                    <input type="file" id="cust_img" name="cust_img">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" name="btnprofileEdit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    }
?>
<script type="text/javascript">
    $(document).ready(function(){
        //$("#OtpModel123").modal('show');
        $("#OtpModel123").modal();
    });
</script>
<!-- edit address Modal -->
<div id="editAddressModel" class="modal fade" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Address</h4>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                <div class="row" id="AddressData">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" name="btnaddresEdit">Submit</button>
            </div>
        </div>
        </form>
    </div>
</div>
<!-- Modal -->
<script>
    function editAddressFun(str){
        $.ajax({
            method:"post",
            url:'/ajax_customer_edit_address',
            data:{Aid:str},
            success:function(response)
            {
                $("#AddressData").html(response);
            }
        });
    }
    $(document).on('change', '#cusCity', function(event) {
        event.preventDefault();
        var city_id = $(this).val();
        $.ajax({
            url: '<?=base_url('customer/get_area')?>/'+city_id,
            type: 'GET',
            dataType: 'html',
        })
        .always(function(select) {
            console.log(select);

            $('#cusArea').empty();
            $('#cusArea').append($(select));
        });
    });

</script>