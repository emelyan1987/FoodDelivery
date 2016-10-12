<?PHP

foreach($customer_maindata as $main => $cuManin):
	$Cu_Email = $cuManin->email;
    $Cu_Mobile_no = $cuManin->mobile_no;
endforeach;


  $this->load->view("includes/Customer/header"); 
  $this->load->helper('customer_helper');


    if($this->session->userdata('user_id') != '') 
    {

    
    }
    else
    {

   			//redirect('/login/');
   			?>
   			<script>window.location.href="customer_login"; </script>
   			<?php
    }

?>

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
                        <div class="col-md-3">
                            <div class="margin20"></div>
                            <ul class="nav nav-pills nav-stacked newTabStyle1">
                                <li  <?php if($page == 'orders'){ echo 'class="active"'; } ?>>
                                    <a href="/customer_dashboard/orders">
                                        <span class="menuListTitle">My Orders</span>
                                        <span class="menuListIcon"><i class="fa fa-angle-right"></i></span>
                                    </a>
                                </li>
                                <li <?php if($page == 'reservations'){ echo 'class="active"'; } ?>>
                                    <a href="/customer_dashboard/reservations">
                                        <span class="menuListTitle">My Reservations</span>
                                        <span class="menuListIcon"><i class="fa fa-angle-right"></i></span>
                                    </a>
                                </li>
                                <li <?php if($page == 'settings'){ echo 'class="active"'; } ?>>
                                    <a href="/customer_dashboard/settings">
                                        <span class="menuListTitle">Settings</span>
                                        <span class="menuListIcon"><i class="fa fa-angle-right"></i></span>
                                    </a>
                                </li>
                                <li <?php if($page == 'promotions'){ echo 'class="active"'; } ?>>
                                    <a href="/customer_dashboard/promotions">
                                        <span class="menuListTitle">Promotions</span>
                                        <span class="menuListIcon"><i class="fa fa-angle-right"></i></span>
                                    </a>
                                </li>
                                <li  <?php if($page == 'notifications'){ echo 'class="active"'; } ?>>
                                    <a href="/customer_dashboard/notifications">
                                        <span class="menuListTitle">Notifications</span>
                                        <span class="menuListIcon"><i class="fa fa-angle-right"></i></span>
                                    </a>
                                </li>
                                <li <?php if($page == 'policies'){ echo 'class="active"'; } ?>>
                                    <a href="/customer_dashboard/policies">
                                        <span class="menuListTitle">Policies</span>
                                        <span class="menuListIcon"><i class="fa fa-angle-right"></i></span>
                                    </a>
                                </li>
                                <li <?php if($page == 'terms'){ echo 'class="active"'; } ?>>
                                    <a href="/customer_dashboard/terms">
                                        <span class="menuListTitle">Terms and conditions</span>
                                        <span class="menuListIcon"><i class="fa fa-angle-right"></i></span>
                                    </a>
                                </li>
                                
                            </ul>
                        </div>
                                                        <?php
                                foreach($customer_profile as $CP => $cust):
                                        $Customer_country =  $cust->country;
                                        $Customer_website =  $cust->website;
                                        $Customer_f_name =  $cust->f_name;
                                        $Customer_l_name =  $cust->l_name;
                                        $Customer_state =  $cust->state;
                                        $Customer_city =  $cust->city;
                                        $Customer_address =  $cust->address;
                                        $Customer_image =  $cust->image; 
                                        $Customer_birthdate =  $cust->birthdate;
                                        $Customer_gender =  $cust->gender;

                                endforeach;	
                                ?>
                        <div class="col-md-9">
                            <div class="tab-content">

                                <?php if($page == 'orders'){ ?>                                
                                <div>
                                    <div class="border-left">
                                        <?php
                                        foreach($orderData as $or => $ord):

                                            if($ord->status == 1)
                                            {
                                                $cls_status = 'class="gray"';
                                                $title_status = 'Pendding';
                                            }
                                            elseif($ord->status == 2)
                                            {
                                                $cls_status = 'class="blue"';
                                                $title_status = 'Under Process';
                                            }
                                            elseif($ord->status == 3)
                                            {
                                                $cls_status = 'class="green"';
                                                $title_status = 'Completed';
                                            }
                                            elseif($ord->status == 4)
                                            {
                                                $cls_status = 'class="red"';
                                                $title_status = 'Canceled';
                                            }
                                        ?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-3 col-sm-12">
                                                    <h5 class="text-center">Delivery Status <label <?php echo $cls_status; ?>><?php echo $title_status; ?></label></h5>
                                                    <img class="img-responsive center-block" alt="" src="/assets/Customer/img/partner2.jpg"/>
                                                </div>
                                                <div class="col-md-3 col-sm-12">
                                                    <div class="margin40"></div>
                                                    <h4><?php echo ucwords($ord->restro_name); ?></h4>
                                                </div>
                                                <div class="col-md-3"> 
                                                    <label class="list-label">Order No. :</label><label class="list-data"><a href="/delivery_order_details/<?php echo $ord->id; ?>">#<?php echo $ord->order_no; ?></a></label>
                                                    <label class="list-label">Amount :</label><label class="list-data">KD <?php echo $ord->total + $ord->delivery_charges - $ord->discount_amount; ?></label>
                                                    <label class="list-label">Date Time :</label><label class="list-data"><?php echo $ord->delivery_date." ".$ord->delivery_time; ?></label>
                                                    <label class="list-label">Point Gain :</label><label class="list-data"><i class="green"><?php echo $ord->order_points; ?></i> pt</label>
                                                    <label class="list-label">Point Used :</label><label class="list-data"><i class="red"><?php echo $ord->used_points; ?></i> pt</label>
                                                    <!--<label class="list-label">Order Details :</label><label>3 medium pizza , one coke , two beers</label>-->
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="margin20"></div>
                                                    <a class="btn btn-block btn-rate" data-toggle="modal" data-target="#myModal2" onclick='ratPop("<?php echo $ord->id; ?>","<?php echo $ord->restro_id; ?>");'>Rate it <i class="fa fa-star"></i></a>
                                                    
                                                    <div class="margin20"></div>
                                                    <button class="btn btn-block btn-track">Track it <i class="fa fa-navigation"></i></button>
                                                    <div class="margin20"></div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-md-12">
                                                    <div class="lightBorder"></div>
                                                    <div class="margin20"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        endforeach;
                                        ?>
                                    </div>
                                </div>
                                <?php } ?>


                                <?php if($page == 'reservations'){ ?>  
                                <div>
                                    <div class="border-left">
                                        
                                        
                                        <?php
                                        foreach($ReservationData as $res => $ResData):

                                            if($ResData->status == 1)
                                            {
                                                $cls_status = 'class="gray"';
                                                $title_status = 'Pendding';
                                            }
                                            elseif($ResData->status == 2)
                                            {
                                                $cls_status = 'class="blue"';
                                                $title_status = 'Under Process';
                                            }
                                            elseif($ResData->status == 3)
                                            {
                                                $cls_status = 'class="green"';
                                                $title_status = 'Completed';
                                            }
                                            elseif($ResData->status == 4)
                                            {
                                                $cls_status = 'class="red"';
                                                $title_status = 'Canceled';
                                            }
                                        ?>
                                        <div class="row">

                                            <div class="col-md-12">
                                                <div class="col-md-3 col-sm-12">
                                                    <h5 class="text-center">Delivery Status <label <?php echo $cls_status; ?>><?php echo $title_status; ?></label></h5>
                                                    <img class="img-responsive center-block" alt="" src="/assets/Customer/img/partner2.jpg"/>
                                                </div>
                                                <div class="col-md-3 col-sm-12">
                                                    <div class="margin40"></div>
                                                    <h4><?php echo ucwords($ResData->restro_name); ?></h4>
                                                </div>
                                                <div class="col-md-3"> 
                                                    <label class="list-label">Order No. :</label><label class="list-data">#<?php echo $ResData->order_no; ?></label>
                                                    <label class="list-label">Amount :</label><label class="list-data">KD <?php echo $ResData->total; ?></label>
                                                    <label class="list-label">Date Time :</label><label class="list-data"><?php echo $ResData->date." ".$ResData->time; ?></label>
                                                    
                                                    <!--<label class="list-label">Order Details :</label><label>3 medium pizza , one coke , two beers</label>-->
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="margin20"></div>
                                                   <a class="btn btn-block btn-rate" href="/restaurant_rating/<?php echo $ResData->restro_id; ?>">Rate it <i class="fa fa-star"></i></a>
                                                    <div class="margin20"></div>
                                                    <button class="btn btn-block btn-track">Track it <i class="fa fa-navigation"></i></button>
                                                    <div class="margin20"></div>
                                                </div>
                                            
                                            <div class="clearfix"></div>
                                            <div class="col-md-12">
                                                <div class="lightBorder"></div>
                                                <div class="margin20"></div>
                                            </div>
                                        </div>
                                        </div>
                                        <?php
                                        endforeach;
                                        ?>

                                    </div>
                                </div>
                                <?php } ?>


                                <?php if($page == 'settings'){ ?>
                                <div>
                                    <div class="border-left">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h3><span class="remove"><i class="fa fa-user"></i></span> Customer Settings</h3>
                                                <div class="lightBorder"></div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="margin20"></div>
                                                <div class="profilePicBlock">
                                                    <img class="profilePic" alt="" src="<?php if($Customer_image != ''){ getImagePath($Customer_image); }else{ echo "/assets/Customer/img/user-profile.png"; } ?>">
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="margin40"></div>
                                                <!--<div class="text-center">
                                                    <input type="file" class="editProfilePic center-block" name="customerimg"></input>
                                                </div>-->
                                            </div>
                                            <div class="col-md-6">
                                                <div class="margin20"></div>
                                                <div class="pull-right">
                                                    <span class="checkoutEdit" data-toggle="modal" data-target="#EditProfileModel" style="    cursor: pointer;"><i class="fa fa-edit"></i> Edit</span>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="margin20"></div>
                                                <ul class="profileDetails">
                                                    <li><label>Name : <b><?php echo $Customer_f_name." ".$Customer_l_name; ?></b></label></li>
                                                    <li><label>Email : <b><?php echo $Cu_Email; ?></b></label></li>
                                                    <li><label>Mobile : <b>+91 <?php echo $Cu_Mobile_no; ?></b></label></li>
                                                   
                                                    <li><button class="list-button" type="button" data-toggle="modal" data-target="#myModal">Add Address <i class="fa fa-plus"></i></button></li>
                                                    <li><label>Gender : <b><?php if($Customer_gender == 1){ echo 'MALE'; }else{ echo "FEMALE"; } ?></b></label></li>
                                                    <li><label>Birthday : <b><?php echo $Customer_birthdate; ?></b></label></li>
                                                    <!--<li><label>Address : <b><?php //echo $Customer_address; ?></b></label></li>
                                                    <li><label>City : <b><?php //echo $Customer_city; ?></b></label></li>
                                                    <li><label>State : <b><?php //echo $Customer_state; ?></b></label></li>
                                                    <li><label>Country : <b><?php //echo $Customer_country; ?></b></label></li>-->
                                                </ul>
                                            </div>


                                            <div class="col-md-12">
                <?php
                $i=1;
                foreach ($customer_address as $key => $address):
                
                ?>
            <div class="col-md-6">
              <div class="panel-group">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4 class="panel-title">
                      <a data-toggle="collapse" href="#collapse<?php echo $i; ?>"><?php echo ucwords($address->billing_full_name); ?></a>
                    </h4>
                  </div>
                  <div id="collapse<?php echo $i; ?>" class="panel-collapse collapse">
                    <div class="panel-body">
                    <div class="col-md-12">
                        <div>
                <div class="col-md-12">
                    <h4>Billing Address</h4>
                    <div class="col-md-6">
                        <strong>&nbsp;Full Name</strong>
                    </div>
                    <div class="col-md-6">&nbsp;
                        <?php echo $address->billing_full_name; ?>
                    </div>
                    <div class="col-md-6">
                        <strong>&nbsp;Address Line 1</strong>
                    </div>
                    <div class="col-md-6">&nbsp;
                        <?php echo $address->billing_addres_1; ?>
                    </div>
                    <div class="col-md-6">
                        <strong>&nbsp;Address Line 2</strong>
                    </div>
                    <div class="col-md-6">&nbsp;
                       <?php echo $address->billing_address_2; ?>
                    </div>
                    <div class="col-md-6">
                        <strong>&nbsp;City</strong>
                    </div>
                    <div class="col-md-6">&nbsp;
                        <?php echo $address->billing_city; ?>
                    </div>
                    <div class="col-md-6">
                        <strong>&nbsp;State</strong>
                    </div>
                    <div class="col-md-6">&nbsp;
                        <?php echo $address->billing_state; ?>
                    </div>
                    <div class="col-md-6">
                        <strong>&nbsp;Zip Code No.</strong>
                    </div>
                    <div class="col-md-6">&nbsp;
                       <?php echo $address->billing_zip_code; ?>
                    </div>
                    <div class="col-md-6">
                        <strong>&nbsp;Contact No.</strong>
                    </div>
                    <div class="col-md-6">&nbsp;
                        <?php echo $address->billing_phoneno; ?>
                    </div>
                
                <div class="margin20"><br><br></div>
                    <h4>Shipping Address</h4>
                    <div class="col-md-6">
                        <strong>&nbsp;Full Name</strong>
                    </div>
                    <div class="col-md-6">&nbsp;
                        <?php echo $address->shipping_full_name; ?>
                    </div>
                    <div class="col-md-6">
                        <strong>&nbsp;Address Line 1</strong>
                    </div>
                    <div class="col-md-6">&nbsp;
                       <?php echo $address->shipping_address_1; ?>
                    </div>
                    <div class="col-md-6">
                        <strong>&nbsp;Address Line 2</strong>
                    </div>
                    <div class="col-md-6">&nbsp;
                       <?php echo $address->shipping_address_2; ?>
                    </div>
                    <div class="col-md-6">
                        <strong>&nbsp;City</strong>
                    </div>
                    <div class="col-md-6">&nbsp;
                        <?php echo $address->shipping_city; ?>
                    </div>
                    <div class="col-md-6">
                        <strong>&nbsp;State</strong>
                    </div>
                    <div class="col-md-6">&nbsp;
                        <?php echo $address->shipping_state; ?>
                    </div>
                    <div class="col-md-6">
                        <strong>&nbsp;Zip Code No.</strong>
                    </div>
                    <div class="col-md-6">&nbsp;
                        <?php echo $address->shipping_zip_code; ?>
                    </div>
                    <div class="col-md-6">
                        <strong>&nbsp;Contact No.</strong>
                    </div>
                    <div class="col-md-6">&nbsp;
                       <?php echo $address->shipping_phoneno; ?>
                    </div>
                </div>
                <br>
                <a href="#" class="btn btn-success" style="float:right;margin-top:10px;" data-toggle="modal" data-target="#editAddressModel" onclick='editAddressFun("<?php echo $address->id; ?>")' >Edit this Address</a> 
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
                                        	if(isset($successMsg))
                                        	{
                                        	?>
                                        	<div class="col-md-12" style="text-align:center;">
                                        		<?php echo $successMsg; ?>
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
                                                                <span style="color:red"><?PHP  echo form_error('old_pass'); ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-sm-12">
                                                                <input type="password" class="form-control searchInput" placeholder="New Password" name="new_pass" required>
                                                                <span style="color:red"><?PHP  echo form_error('new_pass'); ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-sm-12">
                                                                <input type="password" class="form-control searchInput" placeholder="Confirm Password" name="confirm_pass" required>
                                                                <span style="color:red"><?PHP  echo form_error('confirm_pass'); ?></span>
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
                                <?php } ?>


                                <?php if($page == 'promotions'){ ?>
                                <div>
                                    <div class="border-left">
                                        <?php
                                        foreach($promotions as $pro => $proData):
                                        ?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-3 col-sm-12">
                                                    <h5 class="text-center">
                                                <?php 
                                                if($proData->status == 1){
                                                    $stl = 'class="opened"';
                                                    $status_title = "Open";
                                                }
                                                elseif($proData->status == 2)
                                                {
                                                    $stl = 'class="busy"';
                                                    $status_title = "Busy";
                                                }
                                                else
                                                {
                                                    $stl = 'class="close"';
                                                    $status_title = "Close";
                                                }
                                                 ?>
                                                <span <?php echo $stl; ?>></span> <?php echo $status_title; ?>
                                                    </h5>
                                                                                                   <?php
                                                if($proData->restaurant_logo != '')
                                                {
                                                ?>
                                                <img class="img-responsive center-block" alt="" src="<?php $img = explode('public_html',$proData->restaurant_logo); 
                                            echo $img[1];?>" style="height:100px;">
                                                <?php
                                                }
                                                else
                                                {
                                                ?>
                                                <img class="img-responsive center-block" alt="" src="/assets/Customer/img/icon/bottomIcon2.png" style="height:100px;">
                                                <?php
                                                }
                                                ?>
                                                </div>
                                                <div class="col-md-3 col-sm-12">
                                                    <div class="margin40"></div>
                                                    <h4><?php echo ucwords($proData->restro_name); ?></h4>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="margin40"></div>
                                                    <div><button class="list-button">Go to menu <i class="fa fa-angle-right"></i></button></div>
                                                    <div class="margin20"></div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-md-12">
                                                <div class="lightBorder"></div>
                                                <div class="margin20"></div>
                                            </div>
                                        </div>
                                        <?php
                                        endforeach;
                                        ?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-3 col-sm-12">
                                                    <h5 class="text-center"><span class="opened"></span> open</h5>
                                                    <img class="img-responsive center-block" alt="" src="/assets/Customer/img/partner1.jpg"/>
                                                </div>
                                                <div class="col-md-3 col-sm-12">
                                                    <div class="margin40"></div>
                                                    <h4>Restaurant Name</h4>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="margin40"></div>
                                                    <div><button class="list-button">Go to menu <i class="fa fa-angle-right"></i></button></div>
                                                    <div class="margin20"></div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-md-12">
                                                <div class="lightBorder"></div>
                                                <div class="margin20"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-3 col-sm-12">
                                                    <h5 class="text-center"><span class="closed"></span> closed</h5>
                                                    <img class="img-responsive center-block" alt="" src="/assets/Customer/img/partner4.jpg"/>
                                                </div>
                                                <div class="col-md-3 col-sm-12">
                                                    <div class="margin40"></div>
                                                    <h4>Restaurant Name</h4>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="margin40"></div>
                                                    <div><button class="list-button">Go to menu <i class="fa fa-angle-right"></i></button></div>
                                                    <div class="margin20"></div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-md-12">
                                                <div class="lightBorder"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>


                                <?php if($page == 'notifications'){ ?>
                                <div>
                                    <div class="border-left">
                                        <?php
                                        foreach($web_list as $list =>$noti):
                                        ?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p class="padTB10"><span class="remove"><i class="fa fa-times-circle"></i></span><?php echo $noti->message; ?></p>
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
                                </div>
                                <?php } ?>


                                <?php if($page == 'policies'){ ?>
                                <div>
                                    <div class="border-left">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-12">
                                                    <?php echo $privacy_data['text']; ?>
                                                </div>
                                            </div>        
                                        </div>        
                                    </div>
                                </div>
                                <?php } ?>

                                <?php if($page == 'terms'){ ?>
                                <div>
                                    <div class="border-left">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-12">
                                                    <?php echo $tearms_data['text']; ?>
                                                </div>
                                            </div>        
                                        </div>        
                                    </div>
                                </div>
                                <?php } ?>
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
                    <input type="text" class="form-control" id="cust_f_name" name="cust_f_name" value="<?php echo $Customer_f_name; ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="pwd">Last name:</label>
                    <input type="text" class="form-control" id="cust_l_name" name="cust_l_name" value="<?php echo $Customer_l_name; ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="cust_email" name="cust_email" value="<?php echo $Cu_Email; ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="pwd">Phone Number:</label>
                    <input type="text" class="form-control" id="cust_contact" name="cust_contact" value="<?php echo $Cu_Mobile_no; ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="email">Gender:</label>
                    <br>
                    <input type="radio" id="cust_gender" name="cust_gender" value="1" <?php if($Customer_gender == 1){ echo 'checked'; } ?>> Male &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" id="cust_gender" name="cust_gender" value="2" <?php if($Customer_gender == 2){ echo 'checked'; } ?>> Female 
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="pwd">Birth Date:</label>
                    <input type="text" class="form-control" id="birth_date" name="cust_birth" value="<?php echo $Customer_birthdate; ?>">
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
                                                                            <input type="hidden" id="hiddenRat" name="rating_value">
                                                                            <input type="hidden" id="hidden_pop_order" name="hidden_pop_order">
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
<!--rating model-->


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
    function ratPop(order,restro){

        $('#hidden_pop_order').val(order);
        $('#hidden_pop_restro').val(restro);
    }
</script>


<?php
if((isset($_SESSION['UserChangeMobileNo'])) && ($_SESSION['UserChangeMobileNo'] != ''))
{
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
                    <input type="text" class="form-control" id="cust_f_name" name="cust_f_name" value="<?php echo $Customer_f_name; ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="pwd">Last name:</label>
                    <input type="text" class="form-control" id="cust_l_name" name="cust_l_name" value="<?php echo $Customer_l_name; ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="cust_email" name="cust_email" value="<?php echo $Cu_Email; ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="pwd">Phone Number:</label>
                    <input type="text" class="form-control" id="cust_contact" name="cust_contact" value="<?php echo $Cu_Mobile_no; ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="email">Gender:</label>
                    <br>
                    <input type="radio" id="cust_gender" name="cust_gender" value="1" <?php if($Customer_gender == 1){ echo 'checked'; } ?>> Male &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" id="cust_gender" name="cust_gender" value="2" <?php if($Customer_gender == 2){ echo 'checked'; } ?>> Female 
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="pwd">Birth Date:</label>
                    <input type="text" class="form-control" id="birth_date" name="cust_birth" value="<?php echo $Customer_birthdate; ?>">
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
</script>
