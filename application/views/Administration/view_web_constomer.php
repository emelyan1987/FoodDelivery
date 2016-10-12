<?PHP
$this->load->view("includes/Administration/header");
$this->load->view("includes/Administration/sidebar");
?>

  <?php

foreach ($customer_maindata as $main => $cuManin):
	$Cu_Email = $cuManin->email;
	$Cu_banned = $cuManin->banned;
	$Cu_mobile_no = $cuManin->mobile_no;
	$Cu_modified = $cuManin->modified;
	$Cu_device = $cuManin->login_device;

endforeach;

foreach ($customer_profile as $CP => $cust):
	$Customer_country = $cust->country;
	$Customer_website = $cust->website;
	$Customer_f_name = $cust->f_name;
	$Customer_l_name = $cust->l_name;
	$Customer_mobile = $cust->mobile;
	$Customer_state = $cust->state;
	$Customer_city = $cust->city;
	$Customer_address = $cust->address;
	$Customer_image = $cust->image;
	$Customer_points = $cust->points;

endforeach;
?>
    <div class="content-wrapper">
<section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <a href="/web_customers/" class="btn bg-gray-light2">&lt; &nbsp;Back to customers list</a>

                        <div class="clear_h10"></div>
                        <ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#home">Profile</a></li>
  <li><a data-toggle="tab" href="#address">Address</a></li>
  <li><a data-toggle="tab" href="#DOrders">Delivery Orders</a></li>
  <li><a data-toggle="tab" href="#Corders">Catering Orders</a></li>
  <li><a data-toggle="tab" href="#Rorders">Reservation Orders</a></li>
  <li><a data-toggle="tab" href="#Porders">Pickup Orders</a></li>
</ul>

<div class="tab-content">
    <div id="home" class="tab-pane fade in active">
            <form action="" method="post" enctype="multipart/form-data">
                    <div class="table-responsive">
                    <table class="table bg-gray-light tbl" style="width:100%;">
                    <tbody>
                        <tr><td width="20%"><?php
if ($Customer_image != '') {
	?>
                                    <img src="<?php echo getImagePath($Customer_image);?>" height="150">
                                    <?php
}
?></td>
                            <td>


                            </td>
                        </tr>
                        <tr><td width="20%">First Name:</td>
                            <td><?php echo $Customer_f_name;?>

                            </td>
                        </tr>
                        <tr><td width="20%">Last Name:</td>
                            <td><?php echo $Customer_l_name;?>


                            </td>
                        </tr>
                        <tr><td width="20%">Email:</td>
                            <td><?php echo $Cu_Email;?>

                            </td>
                        </tr>
                        <tr><td width="20%">Mobile No.:</td>
                            <td><?php echo $Cu_mobile_no;?>

                            </td>
                        </tr>
                        <tr><td width="20%">Registered date:</td>
                            <td><?php echo $Cu_modified;?>


                            </td>
                        </tr>
                        <tr><td width="20%">Registered by:</td>
                            <td><?php if ($Cu_device == 1) {echo "Mobile";} else {echo "Web";}
?>


                            </td>
                        </tr>
                        <tr><td width="20%">Points:</td>
                            <td>
                                    <?php echo $Customer_points;?>

                            </td>
                        </tr>
                        <tr><td width="20%">Status:</td>
                            <td>
                                    <?php if ($Cu_banned == 1) {echo 'Banned';} else {echo "Active";}
?>

                            </td>
                        </tr>

                    </tbody></table>
                    </div>
                    <a href="/edit_web_constomer/<?php echo $this->uri->segment(2);?>" class="btn bg-default" >Edit Profile</a>
                    <div class="clear_h20"></div>
             </form>
    </div>
    <div id="address" class="tab-pane fade">
            <div class="col-md-8">
                <?php
$i = 1;
foreach ($customer_address as $key => $address):

?>
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
                <div class="col-md-6">
                    <h4>Billing Address</h4>
                    <div class="col-md-6">
                        <strong>Full Name</strong>
                    </div>
                    <div class="col-md-6">
                        <?php echo $address->billing_full_name;?>
                    </div>
                    <div class="col-md-6">
                        <strong>Address Line 1</strong>
                    </div>
                    <div class="col-md-6">
                        <?php echo $address->billing_addres_1;?>
                    </div>
                    <div class="col-md-6">
                        <strong>Address Line 2</strong>
                    </div>
                    <div class="col-md-6">
                       <?php echo $address->billing_address_2;?>
                    </div>
                    <div class="col-md-6">
                        <strong>City</strong>
                    </div>
                    <div class="col-md-6">
                        <?php echo $address->billing_city;?>
                    </div>
                    <div class="col-md-6">
                        <strong>State</strong>
                    </div>
                    <div class="col-md-6">
                        <?php echo $address->billing_state;?>
                    </div>
                    <div class="col-md-6">
                        <strong>Zip Code No.</strong>
                    </div>
                    <div class="col-md-6">
                       <?php echo $address->billing_zip_code;?>
                    </div>
                    <div class="col-md-6">
                        <strong>Contact No.</strong>
                    </div>
                    <div class="col-md-6">
                        <?php echo $address->billing_phoneno;?>
                    </div>
                </div>
                <div class="col-md-6">
                    <h4>Shipping Address</h4>
                    <div class="col-md-6">
                        <strong>Full Name</strong>
                    </div>
                    <div class="col-md-6">
                        <?php echo $address->shipping_full_name;?>
                    </div>
                    <div class="col-md-6">
                        <strong>Address Line 1</strong>
                    </div>
                    <div class="col-md-6">
                       <?php echo $address->shipping_address_1;?>
                    </div>
                    <div class="col-md-6">
                        <strong>Address Line 2</strong>
                    </div>
                    <div class="col-md-6">
                       <?php echo $address->shipping_address_2;?>
                    </div>
                    <div class="col-md-6">
                        <strong>City</strong>
                    </div>
                    <div class="col-md-6">
                        <?php echo $address->shipping_city;?>
                    </div>
                    <div class="col-md-6">
                        <strong>State</strong>
                    </div>
                    <div class="col-md-6">
                        <?php echo $address->shipping_state;?>
                    </div>
                    <div class="col-md-6">
                        <strong>Zip Code No.</strong>
                    </div>
                    <div class="col-md-6">
                        <?php echo $address->shipping_zip_code;?>
                    </div>
                    <div class="col-md-6">
                        <strong>Contact No.</strong>
                    </div>
                    <div class="col-md-6">
                       <?php echo $address->shipping_phoneno;?>
                    </div>
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
    <div id="DOrders" class="tab-pane fade">
        <table id="example1" class="table table-striped table-bordered table_design">
                                <thead>
                                    <tr class="bg-green">
                                        <th colspan="9" style="color:white;">DELIVERY</th>

                                    </tr>
                                    <tr>
                                        <th>ORDER NO<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>LOCATION NAME<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>PAYMENT STATUS<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>STATUS<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>CUSTOMER NAME<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>PRICE<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>ORDER TIME<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <!--<th>AMOUNT</th>-->
                                        <th>CONTACT<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>DETAILS<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
foreach ($customer_orders as $or => $ord):
?>
                                    <tr>
                                        <td>#<?php echo $ord->order_no;?></td>
                                        <td><?php echo ucwords(getOwnerlocationByLId($ord->restro_location_id));?></td>
                                        <td><div class="pending">Pending</div></td>
                                        <td>
                                            <?php if ($ord->status == 1) {echo '<div class="pending">Pending</div>';}
?>
                                            <?php if ($ord->status == 2) {echo '<div class="delivered" style="border: 1px solid #5784D6;">Under Process</div>';}
?>
                                            <?php if ($ord->status == 3) {echo '<div class="delivered">Completed</div>';}
?>
                                            <?php if ($ord->status == 4) {echo '<div class="cancelled">Cancelled</div>';}
?>


                                        </td>
                                        <td><?php echo ucwords(getuseremail($ord->user_id));?></td>


                                        <td>KD <?php echo $ord->total + $ord->delivery_charges;?></td>
                                        <td>
                                            <?php if ($ord->status == 1) {echo '<div class="pending">' . $ord->delivery_time . '</div>';}
?>
                                            <?php if ($ord->status == 2) {echo '<div class="delivered" style="border: 1px solid #5784D6;">' . $ord->delivery_time . '</div>';}
?>
                                            <?php if ($ord->status == 3) {echo '<div class="delivered">' . $ord->delivery_time . '</div>';}
?>
                                            <?php if ($ord->status == 4) {echo '<div class="cancelled">' . $ord->delivery_time . '</div>';}
?>
                                         </td>

                                        <!--/restro_delivery_view/<?php //echo $ord->id; ?>-->
                                         <td><?php getUserMobileNo($ord->user_id);?></td>
                                        <td><a href="/delivery_order_view/<?php echo $ord->id;?>/"><i class="fa fa-eye"></i></a></td>
                                    </tr>
                                    <?php
endforeach;
?>
                                </tbody>
                            </table>

    </div>
    <div id="Corders" class="tab-pane fade">
                <table id="example1"  class="table table-striped table-bordered table_design">
                                <thead>
                                    <tr class="bg-orange">
                                        <th colspan="9" style="color:white;">CATERING</th>

                                    </tr>
                                    <tr >
                                        <th>ORDER NO.<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>LOCATION NAME<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>PAYMENT STATUS<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>STATUS<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>CUSTOMER NAME<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <!--<th>DATE</th>-->
                                        <th>PRICE<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>ORDER TIME<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>CONTACT<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>DETAILS<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
foreach ($customer_catering as $or => $ord):
?>
                                    <tr>
                                        <td>#<?php echo $ord->order_no;?></td>
                                        <td><?php echo getOwnerlocationByLId($ord->restro_location_id);?></td>
                                        <td><div class="pending">Pending</div></td>
                                        <td>
                                            <?php if ($ord->status == 1) {echo '<div class="pending">Pending</div>';}
?>
                                            <?php if ($ord->status == 2) {echo '<div class="delivered" style="border: 1px solid #5784D6;">Under Process</div>';}
?>
                                            <?php if ($ord->status == 3) {echo '<div class="delivered">Completed</div>';}
?>
                                            <?php if ($ord->status == 4) {echo '<div class="cancelled">Cancelled</div>';}
?>
                                        </td>
                                        <td><?php echo getuseremail($ord->user_id);?></td>
                                        <!--<td><?php echo $ord->date;?></td>-->
                                          <td>KD <?php echo $ord->total + $ord->delivery_charges;?></td>
                                          <td>
                                            <?php if ($ord->status == 1) {echo '<div class="pending">' . $ord->time . '</div>';}
?>
                                            <?php if ($ord->status == 2) {echo '<div class="delivered" style="border: 1px solid #5784D6;">' . $ord->time . '</div>';}
?>
                                            <?php if ($ord->status == 3) {echo '<div class="delivered">' . $ord->time . '</div>';}
?>
                                            <?php if ($ord->status == 4) {echo '<div class="cancelled">' . $ord->time . '</div>';}
?>
                                          </td>

                                        <!--/restro_delivery_view/<?php //echo $ord->id; ?>-->
                                         <td><?php getUserMobileNo($ord->user_id);?></td>
                                        <td><a href="/catering_order_view/<?php echo $ord->id;?>"><i class="fa fa-eye"></i></a></td>
                                    </tr>
                                    <?php
endforeach;
?>
                                </tbody>
                            </table>

    </div>
    <div id="Rorders" class="tab-pane fade">
                <table id="example1"  class="table table-striped table-bordered table_design">
                                <thead>
                                    <tr class="bg-red">
                                        <th colspan="9" style="color:white;">RESERVATION</th>

                                    </tr>
                                    <tr >
                                        <th>ORDER NO.<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>LOCATION NAME<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>PAYMENT STATUS<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>STATUS<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>CUSTOMER NAME<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                         <th>PRICE<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>ORDER TIME<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>CONTACT<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>DETAILS<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
foreach ($customer_reservation as $or => $ord):
?>
                                    <tr>
                                        <td>#<?php echo $ord->order_no;?></td>
                                        <td>Location1</td>
                                        <td><div class="pending">Pending</div></td>
                                        <td>

                                                <?php if ($ord->status == 1) {echo '<div class="pending">Pending</div>';}
?>
                                                <?php if ($ord->status == 2) {echo '<div class="delivered" style="border: 1px solid #5784D6;">Under Process</div>';}
?>
                                                <?php if ($ord->status == 3) {echo '<div class="delivered">Completed</div>';}
?>
                                                <?php if ($ord->status == 4) {echo '<div class="cancelled">Cancelled</div>';}
?>


                                        </td>
                                        <td><?php echo getuseremail($ord->user_id);?></td>
                                        <!--<td><?php //echo //$ord->date; ?></td>-->
                                        <td>KD <?php echo $ord->total + $ord->delivery_charges;?></td>
                                        <td>
                                          <?php if ($ord->status == 1) {echo '<div class="pending">' . $ord->time . '</div>';}
?>
                                          <?php if ($ord->status == 2) {echo '<div class="delivered" style="border: 1px solid #5784D6;">' . $ord->time . '</div>';}
?>
                                          <?php if ($ord->status == 3) {echo '<div class="delivered">' . $ord->time . '</div>';}
?>
                                          <?php if ($ord->status == 4) {echo '<div class="cancelled">' . $ord->time . '</div>';}
?>
                                        </td>

                                         <td><?php getUserMobileNo($ord->user_id);?></td>
                                        <td><a href="/reservation_order_view/<?php echo $ord->id;?>/"><i class="fa fa-eye"></i></a></td>
                                    </tr>
                                    <?php
endforeach;
?>
                                </tbody>
                            </table>
    </div>
    <div id="Porders" class="tab-pane fade">
                    <table id="example1" class="table table-striped table-bordered table_design">
                                <thead>
                                    <tr class="bg-aqua">
                                        <th colspan="9" style="color:white;">PICKUP</th>

                                    </tr>
                                    <tr >
                                        <th>ORDER ID<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>LOCATION NAME<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>PAYMENT STATUS<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>STATUS<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>CUSTOMER NAME<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <!--<th>DATE</th>-->
                                         <th>PRICE<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>ORDER TIME<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>

                                        <th>CONTACT<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>DETAILS<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
foreach ($customer_pickup as $or => $ord):
?>
                                    <tr>
                                        <td>#<?php echo $ord->order_no;?></td>
                                        <td>Location1</td>
                                        <td><div class="pending">Pending</div></td>
                                        <td>
                                           <?php if ($ord->status == 1) {echo '<div class="pending">Pending</div>';}
?>
                                           <?php if ($ord->status == 2) {echo '<div class="delivered" style="border: 1px solid #5784D6;">Under Process</div>';}
?>
                                           <?php if ($ord->status == 3) {echo '<div class="delivered">Completed</div>';}
?>
                                           <?php if ($ord->status == 4) {echo '<div class="cancelled">Cancelled</div>';}
?>
                                        </td>
                                        <td><?php echo getuseremail($ord->user_id);?></td>
                                        <!--<td><?php //echo $ord->date; ?></td>-->
                                        <td>KD <?php echo $ord->total + $ord->delivery_charges;?></td>

                                        <td>
                                          <?php if ($ord->status == 1) {echo '<div class="pending">' . $ord->time . '</div>';}
?>
                                           <?php if ($ord->status == 2) {echo '<div class="delivered" style="border: 1px solid #5784D6;">' . $ord->time . '</div>';}
?>
                                           <?php if ($ord->status == 3) {echo '<div class="delivered">' . $ord->time . '</div>';}
?>
                                           <?php if ($ord->status == 4) {echo '<div class="cancelled">' . $ord->time . '</div>';}
?>
                                        </td>
                                         <td><?php getUserMobileNo($ord->user_id);?></td>
                                        <td><a href="/pickup_order_view/<?php echo $ord->id;?>/"><i class="fa fa-eye"></i></a></td>
                                    </tr>
                                    <?php
endforeach;
?>
                                </tbody>
                            </table>
    </div>
</div>

            </section>
        </div>

<?PHP
$this->load->view("includes/Administration/footer");
?>