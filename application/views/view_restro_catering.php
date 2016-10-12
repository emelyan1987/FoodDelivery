<?PHP
  $this->load->view("includes/Customer/header"); 
  $this->load->helper('customer_helper');
    foreach($restroInfo as $re => $ES) :

  	$item_cat = explode(',',$ES->category_id);
?>

<style>
            .nav-pills > li.active > a > .menuListImg {
                margin: -8px 8px -8px -8px;
                background: #FF8205;
            }
            .menuTitle{
                background: #FF8205;
            }
            .menuListIcon{
                color: #FF8205;
            }
            .roundedOneOrange label:after{
                background: #FF8205;
            }
            .blueBorder{
                border-bottom: 4px solid #FF8205;
            }
            .selectLocation {
                border-color: #FF8205 !important;
                color: #FF8205;
            }
            .list-button {
                background: #fff;
                color: #FF8205;
                border: 2px solid #FF8205;
            }
        </style>
<div class="container-fluid">
            <div class="margin20"></div>
            <div class="row">
                <div class="col-md-3 col-sm-12">
                    <div class="searchBox text-center">
                        <a href="/catering_restaurant/<?php echo $ES->id; ?>"><h4><i class="fa fa-angle-left"></i> Back to restaurant</h4></a>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="menuTitle">
                                Menu
                            </div>
                            <ul class="nav nav-pills nav-stacked newTabStyle">
                                <li class="active">
                                    <a href="/catering_restaurant/<?php echo $ES->id; ?>" aria-expanded="true">
                                        <img class="menuListImg" src="/assets/Customer/img/icon/smallLogoCss.png">
                                        <span class="menuListTitle">All</span>
                                        <span class="menuListIcon"><i class="fa fa-angle-right"></i></span>
                                    </a>
                                </li>
                            	<?php
                            	$i = 1;
                            	foreach($restroCat as $res_cat => $cat_id)
                                {
                                ?>
                                
                                <li>
                                    <a href="/catering_restaurant/<?php echo $ES->id; ?>" >
                                        <img class="menuListImg" src="/assets/Customer/img/icon/smallLogoCss.png">
                                        <span class="menuListTitle"><?php get_itemcatName($cat_id->category_id); ?></span>
                                        <span class="menuListIcon"><i class="fa fa-angle-right"></i></span>
                                    </a>
                                </li>
                                <?php
                                $i++;
                            	}
                            	?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div id="tab1" class="tab-pane fade in active">
                        	<?php
                        	foreach($restro_item_info as $res => $est):
                        	?>

                            <div class="row">
                                <div class="col-md-12">
                                    <h3><?php echo ucwords($est->item_name); ?></h3>
                                </div>
                                <form action="" method="post" >
                                <div class="col-md-6">
                                    <img class="img-responsive" alt="" src="<?php if($est->image != ''){  getImagePath($est->image); }else{ echo '/assets/Customer/img/default_item.png'; } ?>"/>
                                    <div class="margin20"></div>
                                    <h4>Details :</h4>
                                    <p><?php echo $est->item_description; ?></p>
                                    <div class="margin20"></div>
                                    <h4>Price : <span id="priceSpan">KD <?php echo $est->item_price; ?></span></h4>
                                    <div class="margin20"></div>
                                    <div class="form-horizontal">
                                        <input type="hidden" value="<?php echo $est->item_price; ?>" id="getPrice" name="getPrice" >
                                        <?php
                                       $itemvar1 = getItemVariation($est->id,1);

                                       if($itemvar1 != '')
                                       {
                                       ?>
                                       <div class="form-group">
                                            <h4 class="col-md-12">Menu item choice categories</h4>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <select class="form-control iconInput" name="variation_ids[]" onchange='showvariationPrice(this.value,"<?php echo $est->id; ?>",1)'>
                                                    <?php
                                                    $i = 1;
                                                    foreach($itemvar1 as $itm => $var):
                                                        if($i == 1)
                                                        {
                                                    ?>
                                                        <option value="0"> -<?php echo ucwords($var->variation_name); ?>- </option>
                                                        <option value="<?php echo $var->id; ?>"> <?php echo ucwords($var->title)." - KD".$var->price; ?> </option>
                                                    <?php
                                                        }
                                                        else
                                                        {
                                                    ?>
                                                        <option value="<?php echo $var->id; ?>"> <?php echo ucwords($var->title)." - KD".$var->price; ?> </option>
                                                    <?php
                                                        }
                                                    $i++;
                                                    endforeach;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <?php
                                        }
                                        ?>
                                        

                                       <?php
                                       $itemvar1 = getItemVariation($est->id,2);

                                       if($itemvar1 != '')
                                       {
                                       ?>

                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <select class="form-control iconInput" name="variation_ids[]" onchange='showvariationPrice(this.value,"<?php echo $est->id; ?>",2)'>
                                                    <?php
                                                    $i = 1;
                                                    foreach($itemvar1 as $itm => $var):
                                                        if($i == 1)
                                                        {
                                                    ?>
                                                        <option value="0"> -<?php echo ucwords($var->variation_name); ?>- </option>
                                                        <option value="<?php echo $var->id; ?>"> <?php echo ucwords($var->title)." - KD".$var->price; ?> </option>
                                                    <?php
                                                        }
                                                        else
                                                        {
                                                    ?>
                                                        <option value="<?php echo $var->id; ?>"> <?php echo ucwords($var->title)." - KD".$var->price; ?> </option>
                                                    <?php
                                                        }
                                                    $i++;
                                                    endforeach;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                       $itemvar1 = getItemVariation($est->id,3);

                                       if($itemvar1 != '')
                                       {
                                       ?>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <select class="form-control iconInput" name="variation_ids[]" onchange='showvariationPrice(this.value,"<?php echo $est->id; ?>",3)'>
                                                    <?php
                                                    $i = 1;
                                                    foreach($itemvar1 as $itm => $var):
                                                        if($i == 1)
                                                        {
                                                    ?>
                                                        <option value="0"> -<?php echo ucwords($var->variation_name); ?>- </option>
                                                        <option value="<?php echo $var->id; ?>"> <?php echo ucwords($var->title)." - KD".$var->price; ?> </option>
                                                    <?php
                                                        }
                                                        else
                                                        {
                                                    ?>
                                                        <option value="<?php echo $var->id; ?>"> <?php echo ucwords($var->title)." - KD".$var->price; ?> </option>
                                                    <?php
                                                        }
                                                    $i++;
                                                    endforeach;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <?php
                                        }
                                        ?>
                                        
                                        <div class="form-group">
                                           <h4 class="col-md-12">Special Request</h4>
                                            <div class="col-md-12">
                                                <textarea class="form-control iconTextarea" rows="5" placeholder="Write Your Spacial Request (Optional)" name="spacial_request"></textarea>
                                                <input type="hidden" id="price_var1" value="0"> 
                                                 <input type="hidden" id="price_var2"  value="0"> 
                                                  <input type="hidden" id="price_var3"  value="0"> 
                                                  <input type="hidden" id="last_price" name="last_price"  value="<?php echo $est->item_price; ?>"> 
                                                   
                                            </div>
                                        </div>
                                        <?php if($est->setup_requirements != ''){ ?>
                                        <div class="form-group">
                                           <h4 class="col-md-12">Setup Requirements:</h4>
                                            <div class="col-md-12">
                                                <textarea class="form-control" rows="5" disabled style="background-color: #fbfbfb;
    border: white;cursor: auto;"><?php  echo $est->setup_requirements; ?>
                                                </textarea>
                                                
                                                   
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <div class="form-group">
                                            <div class="col-sm-5">
                                                <div class="center-block quantity">
                                                    <div class="margin20"></div>
                                                    <button type="button" class="btn-minus-default" onclick="descrementval('quantity_user')"><b><i class="fa fa-minus"></i></b></button>
                                                    <input class="newInputQuantity text-center" name="quantity" type="text"  value="1" id="quantity_user">
                                                    <button type="button" class="btn-minus-orange" onclick="incrementval('quantity_user')"><b><i class="fa fa-plus"></i></b></button>
                                                    <div class="margin20"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-7">
                                            	<input type="hidden" name="restro_id" value="<?php echo $ES->id; ?>" >
                                                <input type="hidden" name="item_id" value="<?php echo $est->id; ?>">
                                                <input type="hidden" name="item_name" value="<?php echo $est->item_name; ?>" >
                                                <input type="hidden" name="item_price" value="<?php echo $est->item_price; ?>" >

                                                <input type="hidden" name="item_img" value="<?php if($est->image != ''){  getImagePath($est->image); }else{ echo '/assets/Customer/img/default_item.png'; } ?>" >
                                                <button type="submit" name="btnaddtocart" class="btn btn-yellow btn-yellow-new-sm btn-block"><img src="/assets/Administration/images/icon/cartIcon.png" alt=""> AD TO CART</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            	</form>
                                <div class="col-md-6">
                                    <div class="itemCheck">
                                        <div class="margin20"></div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-sm-6">
                                                    <h4 class="text-uppercase"><?php echo $ES->restro_name; ?></h4>
                                                </div>
                                                <div class="col-sm-6">
                                                    <a href="/catering_restaurant/<?php echo $ES->id; ?>" class="btn btn-warning btn-block"><i class="fa fa-plus"></i> Add More Items</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="margin20"></div>
                                        <?php
                                        $shobtn = 0;
                                        foreach($cartData as $ca => $CD):
                                        if($CD['data'] == 'CATERING')
                                        {
                                             $shobtn = 1;
                                        ?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-12">
                                                    <div class="border">
                                                        <div class="col-md-12">
                                                            <!--<span class="editItem"><i class="fa fa-edit"></i> Edit</span>-->
                                                        </div>
                                                        <div class="col-md-4">
                                                            <!--<span class="removeItem"><i class="fa fa-times-circle"></i></span>-->
                                                            <img class="itemCheckImg" src="<?php echo $CD['img']; ?>" alt=""/>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <h4><?php echo $CD['name']; ?></h4>
                                                            <span>Qty : <?php echo $CD['qty']; ?> </span><br>
                                                            <span>Price : KD <?php echo $CD['price']; ?> </span>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <h4>Total</h4>
                                                            <h4>KD <?php echo $CD['subtotal']; ?></h4>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        <?php
                                        }
                                    	endforeach;
                                    	?>
                                        
                                        <!--<div class="row">
                                            <div class="col-sm-12">
                                                <div class="col-sm-6">
                                                    <div class="border">
                                                        <div class="form-horizontal">
                                                            <div class="col-sm-12">
                                                                <h4 class="padTB10">Redeem Coupon</h4>
                                                                <input type="text" class="form-control" placeholder="Insert Coupon Code Here">
                                                                <div class="padTB10">
                                                                    <div class="roundedOne">
                                                                        <input type="checkbox" value="1" id="roundedOne1" name="check">
                                                                        <label for="roundedOne1"><span>Use Coupon</span></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="border">
                                                        <div class="form-horizontal">
                                                            <div class="col-sm-12">
                                                                <h4 class="padTB10">Loyalty Points</h4>
                                                                <div>You Gained <span class="green">16pt</span></div>
                                                                <div>Total Points <span class="green">16pt</span></div>
                                                                <div class="padTB10">
                                                                    <div class="roundedOne">
                                                                        <input type="checkbox" value="1" id="roundedOne" name="check">
                                                                        <label for="roundedOne"><span>Use Points</span></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>-->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="col-sm-12">
                                                    <div class="border">
                                                        <div class="col-sm-offset-6 col-sm-6">
                                                            <div><i>Minimum Order:</i> <label class="green">KD <?php echo $ES->RestroMin; ?></label></div>
                                                            
                                                            <div><strong>Total Amount:</strong> <label>KD <?php echo $totalAmount =  $this->cart->total(); ?></label></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <form action="" method="post" >
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="col-sm-12">
                                                    <div class="border">
                                                        <div class="form-group">
                                                            <div class="col-sm-12">
                                                                <textarea class="form-control" placeholder="Order Notes" name="order_notes"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="margin20"></div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="col-sm-12">
                                                <?php
                            if($shobtn == 1)
                            {
                                                if(@$_SESSION['Customer_User_Id'] != '')
                                                {
                                                ?>
                                                    <button type="submit" name="addtocartbtn" class="btn btn-yellow btn-yellow-new btn-block"><img src="/assets/Administration/images/icon/cartIcon.png" alt=""> TO CHECKOUT</button>
                                                
                                                <?php
                                                }
                                                else
                                                {
                                                ?>
                                                    <button type="button" class="btn btn-yellow btn-yellow-new btn-block" data-toggle="modal" data-target="#myModal"><img src="/assets/Administration/images/icon/cartIcon.png" alt=""> TO CHECKOUT</button>
                                                <?php
                                                }
                            }
                                                ?>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="margin20"></div>
                                            </div>
                                        </div>
                                    	</form>
                                    </div>
                                </div>
                            </div>

                            <?php
                            endforeach;
                            ?>
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
                </div>
            </div>
        </div>
        <div class="container-fluid"></div>
        <div class="advert">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <img class="img-responsive center-block" alt="" src="/assets/Customer/img/add.jpg"/>
                    </div>
                </div>
            </div>
        </div>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog" data-backdrop="static" >
  <div class="modal-dialog   modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <div class="login-box-body">
                            <a href="#">
                                <img src="/assets/Administration/images/logo2.png" class="center-block" alt="">

                            </a>
                            <br/>
                            <form action="" method="post" accept-charset="utf-8">
                                <div class="input-group">
                                   <span class="input-group-addon">+965</span>
                                   <input type="text" name="login" value="" id="login" maxlength="80" size="10" onKeyUp="is_mobile_valid(this.value)"   placeholder="Mobile Number" class="form-control">
            
                                </div>
                                
                                <div class="form-group" style="display: none;" id="otpOpen1">
                                    <br/>
                                     <input type="text" name="login_otp" id="login_otp" placeholder="Enter Your OTP" class="form-control" style="display: none;">
                                </div>
                                <div id="msgDiv" class="input-group" ></div>
                                <span id="mobile_msg" style="color:red;"></span>
                                <br>
                                <div class="row">
                                    <div class="col-md-12" id="btnDiv">
                                        <button type="button" class="btn btn-success btn-success-new btn-block" onclick="cust_login()">Login</button>
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
<?php

	 endforeach;

	 $this->load->view("includes/Customer/footer"); 
?>


<script>

           function is_mobile_valid(txtPhone) {
   
    var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
    if (filter.test(txtPhone) && txtPhone.length==10) {

        $("#mobile_msg").text("");
    }
    else {

          $("#mobile_msg").text("Please enter correct mobile no");
          $("#mobile_msg").css("color","red");
    }
}

            
</script>

<script>

    function showvariationPrice(data_val,item_id,type_id){
        if(data_val != 0)
        {
           
            $.ajax({

                        url: "/ajax_item_variation_price/",
                        type: "post",
                        data: {variation_id:data_val,item_id:item_id},
                        success: function (response) {
                            if(type_id == 1)
                            {
                                document.getElementById('price_var1').value = response;
                            }
                            if(type_id == 2)
                            {
                                document.getElementById('price_var2').value = response;
                            }
                            if(type_id == 3)
                            {
                                document.getElementById('price_var3').value = response;
                            }

                            var price = document.getElementById('getPrice').value;
                            var price1 = document.getElementById('price_var1').value;
                            var price2 = document.getElementById('price_var2').value;
                            var price3 = document.getElementById('price_var3').value; 
                            var tot = parseFloat(price)+parseFloat(price1)+parseFloat(price2);
                            if(tot != 'NaN')
                            {
                                $("#priceSpan").html("KD"+tot); 
                                $("#last_price").val(tot); 
                                
                            }
                            
                        }
              })
        }
        
    }
</script>

<script>
    function cust_login(){
         var mobile_no = document.getElementById('login').value;
         var login_otp = document.getElementById('login_otp').value;
         if(login_otp == ''){
         $.ajax({

                        url: "/ajax_customer_login/",
                        type: "post",
                        data: {mobile_no:mobile_no},
                        success: function (response) {
                         
                           if(response == 1)
                           {
                                $("#msgDiv").html('<span class="text-green">Your Login OTP Code Sent on Your Mobile , Please Check</span>'); 

                                document.getElementById('login_otp').style.display = "block";
                                document.getElementById('otpOpen1').style.display = "block";
                           }
                           else
                           {
                                $("#msgDiv").html('<span class="text-red">Please enter correct mobile no</span>');
                           }
                            
                            
                        }
              })
     }
     else
     {
            $.ajax({

                        url: "/ajax_customer_otp_login/",
                        type: "post",
                        data: {login_otp:login_otp},
                        success: function (response) {
                           
                            if(response == 1)
                            {
                                window.location.href="";
                            }
                            else
                            {
                               window.location.href="";
                            }
                          
                            
                        }
              })
     }
    }
</script>


