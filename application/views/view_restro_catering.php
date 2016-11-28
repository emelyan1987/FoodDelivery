<?PHP
$this->load->view("includes/Customer/header");
$this->load->helper('customer_helper');
foreach ($restroInfo as $re => $ES):
	$item_cat = explode(',', $ES->category_id);
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
						<a href="/catering_restaurant/<?php echo $ES->id;?>"><h4><i class="fa fa-angle-left"></i> Back to restaurant</h4></a>
					</div>
					<div class="clearfix"></div>
					<div class="row">
						<div class="col-sm-12">
							<div class="menuTitle">
								Menu
							</div>
							<ul class="nav nav-pills nav-stacked newTabStyle">
								<li class="active">
									<a href="/catering_restaurant/<?php echo $ES->id;?>" aria-expanded="true">
										<img class="menuListImg" src="/assets/Customer/img/icon/smallLogoCss.png">
										<span class="menuListTitle">All</span>
										<span class="menuListIcon"><i class="fa fa-angle-right"></i></span>
									</a>
								</li>
								<?php
	$i = 1;
	foreach ($restroCat as $res_cat => $cat_id) {
		?>
								<li>
									<a href="/catering_restaurant/<?php echo $ES->id;?>" >
										<img class="menuListImg" src="/assets/Customer/img/icon/smallLogoCss.png">
										<span class="menuListTitle"><?php get_itemcatName($cat_id->category_id);?></span>
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
				<!-- restaurant items start -->
				<div class="col-md-9">
					<div class="tab-content">
						<div id="tab1" class="tab-pane fade in active">
							<?php
	foreach ($restro_item_info as $res => $est):
	?>
							<div class="row">
								<div class="col-md-12">
									<h3><?php echo ucwords($est->item_name);?></h3>
								</div>
								<form action="" method="post" >
									<div class="col-md-6">
										<img style="width: 100%" class="img-responsive" alt="" src="<?php if ($est->image != '') {getImagePath($est->image);} else {echo '/assets/Customer/img/default_item.png';}
	?>"/>
										<div class="margin20"></div>
										<h3><?php echo $est->item_name?></h3>
										<div class="margin20"></div>
										<h4>Details :</h4>
										<p><?php echo $est->item_description;?></p>
										<div class="margin20"></div>
										<h4>Price : <span id="priceSpan">KD&nbsp;<?php echo number_format($est->item_price, 3);?></span></h4>
										<div class="margin20"></div>
										<div class="form-horizontal">
											<input type="hidden" value="<?php echo $est->item_price;?>" id="getPrice" name="getPrice" >
											<?php
	$itemvar1 = getItemVariation($est->id, 1);
	if ($itemvar1 != '') {
		?>
											<div class="form-group">
												<h4 class="col-md-12">Menu item choice categories</h4>
											</div>
											<div class="form-group">
												<div class="col-md-12">
													<?php
	$i = 1;
		foreach ($itemvar1 as $itm => $var):
			if ($i == 1) {
				?>
															<select <?=($var->multi_item == 1) ? "id='veriationSelect' multiple='multiple'" : ""?> class="form-control iconInput" name="variation_ids[]" onchange='showvariationPrice(this.value,"<?php echo $est->id;?>",1)'>
																<option value="0"> -<?php echo ucwords($var->variation_name);?>- </option>
																<option value="<?php echo $var->id;?>"> <?php echo ucwords($var->title) . " - KD&nbsp;" . number_format($var->price, 3);?> </option>
																<?php
		} else {
				?>
																<option value="<?php echo $var->id;?>"> <?php echo ucwords($var->title) . " - KD&nbsp;" . number_format($var->price, 3);?> </option>
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
	$itemvar1 = getItemVariation($est->id, 2);
	if ($itemvar1 != '') {
		?>
											<div class="form-group">
												<div class="col-md-12">
													<?php
	$i = 1;
		foreach ($itemvar1 as $itm => $var):
			if ($i == 1) {
				?>
															<select <?=($var->multi_item == 1) ? "id='veriationSelect' multiple='multiple'" : ""?> class="form-control iconInput" name="variation_ids[]" onchange='showvariationPrice(this.value,"<?php echo $est->id;?>",2)'>
																<option value="0"> -<?php echo ucwords($var->variation_name);?>- </option>
																<option value="<?php echo $var->id;?>"> <?php echo ucwords($var->title) . " - KD&nbsp;" . number_format($var->price, 3);?> </option>
																<?php
		} else {
				?>
																<option value="<?php echo $var->id;?>"> <?php echo ucwords($var->title) . " - KD&nbsp;" . number_format($var->price, 3);?> </option>
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
	$itemvar1 = getItemVariation($est->id, 3);
	if ($itemvar1 != '') {
		?>
											<div class="form-group">
												<div class="col-md-12">
													<?php
	$i = 1;
		foreach ($itemvar1 as $itm => $var):
			if ($i == 1) {
				?>
															<select <?=($var->multi_item == 1) ? "id='veriationSelect' multiple='multiple'" : ""?> class="form-control iconInput" name="variation_ids[]" onchange='showvariationPrice(this.value,"<?php echo $est->id;?>",3)'>
																<option value="0"> -<?php echo ucwords($var->variation_name);?>- </option>
																<option value="<?php echo $var->id;?>"> <?php echo ucwords($var->title) . " - KD&nbsp;" . number_format($var->price, 3);?> </option>
																<?php
		} else {
				?>
																<option value="<?php echo $var->id;?>"> <?php echo ucwords($var->title) . " - KD&nbsp;" . number_format($var->price, 3);?> </option>
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
													<input type="hidden" id="last_price" name="last_price"  value="<?php echo number_format($est->item_price, 3);?>">
												</div>
											</div>
											<div class="form-group">
												<div class="col-sm-5">
													<div class="center-block quantity">
														<div class="margin20"></div>
														<button type="button" class="btn-minus-default" onclick="descrementval('quantity_user')"><b><i class="fa fa-minus"></i></b></button>
														<input class="newInputQuantity text-center" name="quantity" type="text"  value="1" id="quantity_user">
														<button type="button" class="btn-minus-green" onclick="incrementval('quantity_user')"><b><i class="fa fa-plus"></i></b></button>
														<div class="margin20"></div>
													</div>
												</div>
												<div class="col-sm-7">
													<input type="hidden" name="restro_id" value="<?php echo $ES->id;?>" >
													<input type="hidden" name="item_id" value="<?php echo $est->id;?>">
													<input type="hidden" name="item_name" value="<?php echo $est->item_name;?>" >
													<input type="hidden" name="item_price" value="<?php echo $est->item_price;?>" >
													<input type="hidden" name="item_img" value="<?php if ($est->image != '') {getImagePath($est->image);} else {echo '/assets/Customer/img/default_item.png';}
	?>" >
													<button type="submit" name="btnaddtocart" class="btn btn-yellow btn-yellow-new-sm btn-block"><img src="/assets/Administration/images/icon/cartIcon.png" alt=""> ADD TO CART</button>
												</div>
											</div>
										</div>
									</div>
								</form>
								<div class="col-md-6">
									<div class="itemCheck">
										<div class="row">
											<div class="col-md-12">
												<div class="col-sm-6">
													<!-- <h4 class="text-uppercase"><?php echo $ES->restro_name;?></h4> -->
												</div>
												<a href="/catering_restaurant/<?php echo $ES->id;?>" class="btn btn-default btn-block pull-right"><i class="fa fa-plus"></i>   Add More Items</a>
											</div>
										</div>
										<div class="margin20"></div>
										<div class="wall">
											<?php
	$shobtn = 0;
	foreach ($cartData as $ca => $CD):
		if ($CD['data'] == 'CATERING') {
			$shobtn = 1;
			?>
													<div class="row">
														<div class="col-md-12">
															<div class="col-md-12" style="padding:0px 3px 0 3px">
																<div class="border pos-rel">
																	<span class="editItem">Edit  <i class="fa fa-pencil"></i></span>
																	<div class="col-md-4" style="padding-right:0;margin-left: 18px;">
																		<span class="removeItem"><i class="fa fa-times-circle" style="color: #cbcbcb;"></i></span>
																		<img class="itemCheckImg" src="<?php echo $CD['img'];?>" alt=""/>
																	</div>
																	<div class="col-md-4" style="padding-left:0;">
																		<h4 style="margin-bottom: 0px;"><?php echo $CD['name'];?></h4>
																		<span>Qty : <?php echo $CD['qty'];?> </span><br>
																		<!-- <span>Price : KD&nbsp;<?php echo number_format($CD['price'], 3);?> </span> -->
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
		}
	endforeach;
	?>
											<div class="row">
													<div class="col-sm-12">
														<div class="col-sm-6" style="padding: 0px 0px 0 3px;">
															<div class="border">
																<div class="form-horizontal">
																	<div class="col-sm-12">
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
																	<div class="green">Gained/Used: 16pt</div>
																	<div class="green">Balance: 16pt</div>
																</div>
															</div>
														</div>
														<div class="col-sm-6" style="padding:0px 3px 0px 2px">
															<div class="border">
																<div class="col-sm-12" style="padding: 0 5px;">
																	<p>Mataam Points</p>
																	<div class="green">Gained/Used: 16pt</div>
																	<div class="green">Balance: 16pt</div>
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
                                                echo '<div class="col-sm-3"><span class="custom-radio-container"><span class="custom-radio"><input type="radio" id="pItem1" value="1" name="item"></span></span>&nbsp;<img class="" alt="" src="/assets/Customer/img/cash.png" style="    margin-bottom: 8px;">Cash</div>';
                                            }
                                            if (in_array(2, $payArray)) {
                                                echo '<div class="col-sm-3"><span class="custom-radio-container"><span class="custom-radio"><input type="radio" id="pItem2" value="2" name="item"></span></span>&nbsp;<img class="" alt="" src="/assets/Customer/img/knet.png" style="    margin-bottom: 8px;">Knet</div>';
                                            }
                                            if (in_array(3, $payArray)) {
                                                echo '<div class="col-sm-3"><span class="custom-radio-container"><span class="custom-radio"><input type="radio" id="pItem3" value="3" name="item"></span></span>&nbsp;<img class="" alt="" src="/assets/Customer/img/card.png" style="    margin-bottom: 8px;">Debit Card</div>';
                                            }
                                            if (in_array(4, $payArray)) {
                                                echo '<div class="col-sm-3"><span class="custom-radio-container"><span class="custom-radio"><input type="radio" id="pItem4" value="4" name="item"></span></span>&nbsp;<img class="" alt="" src="/assets/Customer/img/paypal.png" style="    margin-bottom: 8px;">Paypal</div>';
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
																	<div>Delivery Charges: <span class="green pull-right">KD&nbsp;0.000</span></div>
																	<div>Grand Total: <span class="green pull-right">KD&nbsp;<?php echo $totalAmount = number_format($this->cart->total(), 3);?>
																	</span></div>
																</div>
															</div>
														</div>
													</div>
												</div>

											<form action="" method="post" >
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
												<div class="clearfix"></div>
												<div class="margin20"></div>
												<div class="row">
													<div class="col-sm-12">
														<div class="col-sm-12" style="padding: 0px">
															<?php
	if ($shobtn == 1) {
		if (@$_SESSION['Customer_User_Id'] != '') {
			?>
															<button style="width: 100%" type="submit" name="addtocartbtn" class="btn btn-yellow btn-yellow-new btn-block"><img src="/assets/Administration/images/icon/cartIcon.png" alt=""> CHECKOUT</button>
															<?php
	} else {
			?>
															<button style="width: 100%" type="button" class="btn btn-yellow btn-yellow-new btn-block" data-toggle="modal" data-target="#myModal"><img src="/assets/Administration/images/icon/cartIcon.png" alt=""> CHECKOUT</button>
															<?php
	}
	}
	?>
														</div>
														<div class="clearfix"></div>
													</div>
												</div>
											</form>
										</div>
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
$("#priceSpan").html("KD "+tot);
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
$("input:checkbox").click(function(){
var self = $(this);
if (self.is(':checked')) {
// self.
$('input:checkbox').not(this).prop('checked', false);
}
});
$('#veriationSelect').select2({
theme:"classic",
tags:true,
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