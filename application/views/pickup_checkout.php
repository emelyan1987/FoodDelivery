<?PHP
  $this->load->view("includes/Customer/header"); 
  $this->load->helper('customer_helper');

$payMethod = explode(',',$getPaymentgateways['method_type']);
?>

<style>
            .nav-pills > li.active > a > .menuListImg {
                margin: -8px 8px -8px -8px;
                background: #2793FF;
            }
            .menuTitle{
                background: #2793FF;
            }
            .menuListIcon{
                color: #2793FF;
            }
            .roundedOneBlue label:after{
                background: #2793FF;
            }
            .blueBorder{
                border-bottom: 4px solid #2793FF;
            }
            .selectLocation {
                border-color: #2793FF !important;
                color: #2793FF;
            }
            .list-button {
                background: #fff;
                color: #2793FF;
                border: 2px solid #2793FF;
            }
        </style>

<form action="" method="post" >
<div class="container-fluid">
            <div class="margin20"></div>
            <div class="row">
                <div class="col-md-3 col-sm-12">
                   
                        <a href="/pickup_restaurant/<?php echo $_SESSION['order_restro_id']; ?>"><h4><i class="fa fa-angle-left"></i> Back to restaurant</h4></a>
                    
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
                <div class="col-md-12">
                    <div class="tab-content">
                        <div id="tab1" class="tab-pane fade in active">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="itemCheck">
                                        <div class="margin20"></div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-6">
                                                    <h4 class="text-uppercase">Address</h4>
                                                </div>
                                                <div class="col-md-6">
                                                    <select class="addressSelection" name="useraddress" onchange="addressFun(this.value)"  id="CustomerAddressData">
                                                        <option value="">-Select Address-</option>
                                                        <?php
                                                        foreach($addressData as $add => $address):
                                                        ?>
                                                            <option value="<?php echo $address->id; ?>"><?php echo $address->billing_addres_1; ?></option>
                                                        <?php
                                                        endforeach;
                                                        ?>
                                                    </select>
                                                    <span class="red"><?php echo form_error('useraddress'); ?></span>
                                                    <div class="pull-right">
                                                        <a data-toggle="modal" data-target="#customerAddress" style="cursor: pointer;"><span class="checkoutEdit"><i class="fa fa-home"></i> Add New Address</span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="margin20"></div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div id="addressdata">

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
                                                    <h4>Date / Time: </h4>
                                                </div>
                                                <div class="col-sm-3 col-sm-3 col-md-3">
                                                    <div class="form-horizontal">
                                                        <div class="col-sm-12">
                                                            <input type="text" name="Ddate" value="<?php echo date('Y-M-d'); ?>" id="datepicker" class="form-control">
                                                        </div>
                                                    </div>
                                                    <span class="red"><?php echo form_error('Ddate'); ?></span>
                                                </div>
                                                <div class="col-sm-6 col-sm-6 col-md-6">
                                                    <div class="form-horizontal">
                                                        <div class="col-sm-12">
                                                            <input type="text" name="Dtime" value="<?php echo date('H:i A'); ?>" class="form-control text-center openTimeController" id="Dtime">
                                                        
                                                              <div id="datetimepicker3" class="input-append">
                                                <!---Time Picker-->
                                                <div style="margin-top: 15px;">
                                                    <span class="closeTimeInput">x</span>
                                                    <select onchange="gettimevalue()" id="time1" style="height:30px;">
                                                        <?php
                                                        for($h = 1; $h<=12; $h++){
                                                        ?>
                                                            <option value="<?php if($h < 10){ echo 0; } ?><?php echo $h; ?>"> <?php if($h < 10){ echo 0; } ?><?php echo $h; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    <select onchange="gettimevalue()" id="time2" style="height:30px;">
                                                        <?php
                                                        for($M = 1; $M<=60; $M++){
                                                        ?>
                                                            <option value="<?php if($M < 10){ echo 0; } ?><?php echo $M; ?>"> <?php if($M < 10){ echo 0; } ?><?php echo $M; ?></option>
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
                                            <span class="red"><?php echo form_error('Dtime'); ?></span>


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
                                                            if(in_array(1,$payMethod))
                                                            {
                                                            ?>
                                                            <div class="paymentMethod">
                                                                
                                                                 <div class="roundedOne">
                                                                    <input type="radio" value="1" onClick="checkCon1(this.id)"  id="roundedOne6" class="myCheckBox1" name="hd_paymentType" />
                                                                     <label for="roundedOne6"><span><img class="" alt="" src="/assets/Customer/img/cash.png"> cash</span></label>
                                                                </div>
                                                            </div>
                                                            <?php
                                                            }
                                                            ?>
                                                            <?php
                                                            if(in_array(2,$payMethod))
                                                            {
                                                            ?>
                                                            <div class="paymentMethod">
                                                                
                                                                <div class="roundedOne">
                                                                    <input type="radio" value="2" onClick="checkCon1(this.id)"  id="roundedOne7" class="myCheckBox1" name="hd_paymentType" />
                                                                     <label for="roundedOne7"><span><img class="" alt="" src="/assets/Customer/img/knet.png"> Knet</span></label>
                                                                </div>
                                                            </div>
                                                            <?php
                                                            }
                                                            ?>
                                                            <?php
                                                            if(in_array(3,$payMethod))
                                                            {
                                                            ?>
                                                            <div class="paymentMethod">
                                                                <div class="roundedOne">
                                                                    <input type="radio" value="3" onClick="checkCon1(this.id)"  id="roundedOne8" class="myCheckBox1" name="hd_paymentType" />
                                                                     <label for="roundedOne8"><span><img class="" alt="" src="/assets/Customer/img/card.png"> Credit Card</span></label>
                                                                </div>
                                                            </div>
                                                            <?php
                                                            }
                                                            ?>
                                                            <?php
                                                            if(in_array(4,$payMethod))
                                                            {
                                                            ?>
                                                            <div class="paymentMethod">
                                                                
                                                                <div class="roundedOne">
                                                                    <input type="radio" value="4" onClick="checkCon1(this.id)"  id="roundedOne9" class="myCheckBox1" name="hd_paymentType" />
                                                                     <label for="roundedOne9"><span><img class="" alt="" src="/assets/Customer/img/paypal.png"> Paypal</span></label>
                                                                </div>
                                                            </div>
                                                            <?php
                                                            }
                                                            ?>
                                                            <span class="red"><?php echo form_error('hd_paymentType'); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="line"></div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="col-md-6">
                                                    <h4>Total :</h4>
                                                </div>
                                                <div class="col-md-6">
                                                    <h4 class="text-right" id="order_total">KD 0.000</h4>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="line"></div>
                                            </div>
                                            <div class="col-md-12" id="discountvalue">
                                                
                                            </div>
                                            <div class="col-md-12">
                                                <div class="col-md-6">
                                                    <h4>Delivery Charges :</h4>
                                                </div>
                                                <div class="col-md-6">
                                                    <h4 class="text-right" id="order_charges">KD 0.000</h4>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="line"></div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="col-md-6">
                                                    <h4>Grand Total :</h4>
                                                </div>
                                                <div class="col-md-6">
                                                    <h4 class="text-right" id="order_grandTotal">KD 0.000</h4>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="margin20"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-offset-4 col-md-4">
                                                    <button type="submit" name="btncheckout" class="btn btn-yellow btn-yellow-new btn-block"><i class="fa fa-shopping-cart"></i> CHECKOUT</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="margin20"></div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="itemCheck" id="show_cartdata">
                                        <div class="margin20"></div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-sm-6">
                                                    <!--<h4 class="text-uppercase">Restaurant Name</h4>-->
                                                </div>
                                                <div class="col-sm-6">
                                                    <a href="/pickup_restaurant/<?php echo $_SESSION['order_restro_id']; ?>" class="btn btn-primary btn-block"><i class="fa fa-plus"></i> Add More Items</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="margin20"></div>
                                        <?php
                                        $total = 0;
                                        $i = 0;
                                        $itemIds = 0;
                                        foreach($cartData as $cart => $ca):
                                        ?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-12">
                                                    <div class="border">
                                                        <div class="col-md-12">
                                                            <span class="editItem"><i class="fa fa-edit"></i> Edit</span>
                                                        </div>
                                                        <div class="col-md-4">
                                                             <span class="removeItem" onclick='removeItemPickup("<?php echo $ca->id; ?>");'><i class="fa fa-times-circle"></i></span>
                                                            <img class="itemCheckImg" src="<?php get_item_image($ca->product_id); ?>" alt="">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <h4><?php get_item_name($ca->product_id); ?></h4>
                                                            <span>Qty : <?php echo $ca->quantity; ?> </span>
                                                            <span>Price : <?php echo $ca->price; ?> </span>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <h4>Total</h4>
                                                            <h4>KD <?php echo $ca->price * $ca->quantity; ?></h4>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        <?php
                                        $total = $total + ($ca->price * $ca->quantity);

                                        $itemIds = $itemIds.','.$ca->product_id;
                                        endforeach;
                                        ?>
                                        
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="col-sm-6">
                                                    <div class="border">
                                                        <div class="form-horizontal">
                                                            <div class="col-sm-12">
                                                                <h4 class="padTB10">Redeem Coupon</h4>
                                                                <input type="text" class="form-control" placeholder="Insert Coupon Code Here" id="coupon_code" name="coupon_code">
                                                                <div class="padTB10">
                                                                    <div class="roundedOne">
                                                                        <input type="radio" value="1" id="radiocoupon" name="discount_opt" onClick="checkCon123(this.id)" class="myCheckBox1">
                                                                        <label for="radiocoupon"><span>Use Coupon</span></label>
                                                                    </div>

                                                                    <div id="couponmsg"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                    <?php
                                     $ext_ids = explode(',',$itemIds);
                                     $order_points = 0;
                                     foreach($ext_ids as $itm_ids)
                                     {

                                        if($itm_ids != 0){
                                          $loyaltiD = getitemPoint($itm_ids);
                                          
                                          if($total > $loyaltiD['order_point_amount'])
                                          {
                                                $order_points = $order_points+$loyaltiD['loyalty_points'];
                                          }


                                        }
                                     }
                                     
                                     ?>
                                                <div class="col-sm-6">
                                                    <div class="border">
                                                        <div class="form-horizontal">
                                                            <div class="col-sm-12">
                                                                <h4 class="padTB10">Loyalty Points</h4>
                                                                <div>You Gained <span class="green"><?php echo $order_points; ?>pt</span></div>
                                                                <div>Total Points <span class="green"><?php echo $cust_point; ?>pt</span></div>
                                                                <div class="padTB10">
                                                                    <div class="roundedOne">
                                                                        <input type="radio" value="2" id="radiopoints" name="discount_opt"   onClick="checkCon123(this.id)" class="myCheckBox1">
                                                                        <label for="radiopoints"><span>Use Points</span></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="col-sm-12">
                                                    <div class="border">
                                                        <div class="col-sm-offset-6 col-sm-6">
                                                             
                                                            
                                                            <div><strong>Total Amount:</strong> <label id="total_label">KD <?php echo $total; ?></label></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                     <input type="hidden" id="hd_total" name="hd_total" value="<?php echo $total; ?>">
                                     <input type="hidden" id="hd_charges" name="hd_charges" value="<?php echo $deliveryCharges; ?>">
                                     <input type="hidden" id="hd_points" name="hd_points" value="<?php echo $order_points; ?>"> 
                                      <input type="hidden" id="hd_discount" name="hd_discount" value="0"> 
                                       <input type="hidden" id="hd_cust_point" name="hd_cust_point" value="<?php echo $cust_point; ?>" >
                                       
                                       <input type="hidden" id="hd_used_points" name="hd_used_points" value="0" >
                                     
                                     
                                        <div class="clearfix"></div>
                                        <div class="margin20"></div>
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

        <div class="container-fluid"></div>
</form>
<?php
$this->load->view("includes/Customer/footer"); 
?>



 <script>

           function checkCon123(id)
            {


              if(id=="radiocoupon")
              {
                   $("#radiocoupon").attr("checked","checked");
                   $("#roundedOne4").removeAttr("checked","checked");

                   //$("#sheduledate").css("display", "none");

                   discountFun(1);
                   
                      
              } 

             if(id=="radiopoints")
              {
                   $("#radiopoints").attr("checked","checked");
                   $("#radiocoupon").removeAttr("checked","checked");

                   //$("#sheduledate").css("display", "block");
                   
                      discountFun(2);
              } 
              
            } 


function discountFun(str){
    if(str == 1)
    {

       var coupon_code = document.getElementById('coupon_code').value;
       var tot = document.getElementById('hd_total').value;
       if(coupon_code != '')
       {
        
            $.ajax({

                    url: "/order_coupon/",
                    type: "post",
                    data: {coupon_code:coupon_code,service_type:1,total:tot} ,
                    success: function (response) {
                        //alert(response);
                        if((response == 'EXPIRE') || (response == 'INVALID'))
                        {
                            if(response == 'EXPIRE')
                            {
                                $("#couponmsg").html('<span class="text-red"> Expire This Coupon </span>');
                            }
                            if(response == 'INVALID')
                            {
                                $("#couponmsg").html('<span class="text-red"> Invalid This Coupon Code</span>');
                            }
                            

                             
                        }
                        else
                        {
                            $("#discountvalue").html('<div class="col-md-6"><h4>Discount By Coupon ('+coupon_code+'):</h4></div><div class="col-md-6"><h4 class="text-right" id="coupone_txt">KD '+response+'</h4></div><div class="clearfix"></div><div class="line"></div>');
                            document.getElementById('hd_discount').value = response;
                            

                            var tot = document.getElementById('hd_total').value;
                            var discount = document.getElementById('hd_discount').value;
                            var charge = document.getElementById('hd_charges').value;

                            var a = parseFloat(tot);
                            var d = parseFloat(discount);
                            var b = parseFloat(charge);
                            var grand_tot = a - d;
                            grand_tot = grand_tot + b;
                            document.getElementById('order_grandTotal').innerHTML = "KD "+grand_tot;
                        }

                        
                    }
            })
       }
       
    }
    if(str == 2)
    {
        document.getElementById('coupon_code').value = '';
        var hd_points = document.getElementById('hd_cust_point').value;
        var tot = document.getElementById('hd_total').value;

        $.ajax({

                    url: "/order_used_points/",
                    type: "post",
                    data: {points:hd_points,total:tot} ,
                    success: function (response) {
                        stmk = response;
                        var arrt = stmk.split(",");

                        if((arrt[0] != '') && (arrt[1] != ''))
                        {
                            var used_points = arrt[1];
                            var discount_amount = arrt[0];

                            $("#discountvalue").html('<div class="col-md-6"><h4>Discount By Points ('+used_points+'):</h4></div><div class="col-md-6"><h4 class="text-right" id="coupone_txt">KD '+discount_amount+'</h4></div><div class="clearfix"></div><div class="line"></div>');
                            
                            document.getElementById('hd_discount').value = discount_amount;
                            document.getElementById('hd_used_points').value = used_points;
                            

                            var tot = document.getElementById('hd_total').value;
                            var discount = document.getElementById('hd_discount').value;
                            var charge = document.getElementById('hd_charges').value;

                            var a = parseFloat(tot);
                            var d = parseFloat(discount);
                            var b = parseFloat(charge);
                            var grand_tot = a - d;
                            grand_tot = grand_tot + b;
                            document.getElementById('order_grandTotal').innerHTML = "KD "+grand_tot;
                        }
                        
                    }

             })
        
    }
}


</script>
    <script>

            function checkCon1(id)
            {
                      if(id=="roundedOne6")
                      {
                           $("#roundedOne6").attr("checked","checked");
                           $("#roundedOne7").removeAttr("checked","checked");
                           $("#roundedOne8").removeAttr("checked","checked");
                           $("#roundedOne9").removeAttr("checked","checked");
                           
                           
                              
                      } 

                     if(id=="roundedOne7")
                      {
                           $("#roundedOne7").attr("checked","checked");
                           $("#roundedOne6").removeAttr("checked","checked");
                           $("#roundedOne8").removeAttr("checked","checked");
                           $("#roundedOne9").removeAttr("checked","checked");
                           
                              
                      }
                       if(id=="roundedOne8")
                      {
                           $("#roundedOne8").attr("checked","checked");
                           $("#roundedOne6").removeAttr("checked","checked");
                           $("#roundedOne7").removeAttr("checked","checked");
                           $("#roundedOne9").removeAttr("checked","checked");
                           
                              
                      }
                       if(id=="roundedOne9")
                      {
                           $("#roundedOne9").attr("checked","checked");
                           $("#roundedOne6").removeAttr("checked","checked");
                           $("#roundedOne7").removeAttr("checked","checked");
                           $("#roundedOne8").removeAttr("checked","checked");
                           
                              
                      } 
              
            } 
        </script>

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
    function order_time(str){
        document.getElementById('hd_orderTime').value = str;
    }
    function paymentget(str){
        document.getElementById('hd_paymentType').value = str;
    }
</script>
<script>

var tot = document.getElementById('hd_total').value;
var charge = document.getElementById('hd_charges').value;

var a = parseFloat(tot);
var b = parseFloat(charge);
var grand_tot = a + b;
document.getElementById('order_total').innerHTML = "KD "+tot;
document.getElementById('order_charges').innerHTML = "KD "+charge;
document.getElementById('order_grandTotal').innerHTML = "KD "+grand_tot;
</script>





<script>
function removeItemPickup(item){
$.ajax({

        url: "/ajax_cart_pickup_remove/",
        type: "post",
        data: {item:item} ,
        success: function (response) {
                
        $("#show_cartdata").html(response);
        }
})
}
</script>




   <script>
  $(function() {
    var dateToday = new Date();
    $( "#datepicker" ).datepicker({dateFormat: 'yy-mm-dd',minDate: dateToday });
  });
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

        document.getElementById('Dtime').value = t4;

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