<?PHP



    $this->load->view("includes/Customer/header"); 
    $this->load->helper('customer_helper');


    if($_SESSION['Customer_User_Id'] != '') 
    {


    }
    else
    {

        //redirect('/login/');
    ?>
    <script>window.location.href="/"; </script>
    <?php        
    }
?>

<div class="container-fluid">
    <div class="margin20"></div>
    <div class="row">
        <div class="col-md-12">
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <a href="/customer_dashboard/" class="btn bg-gray-light2">< &nbsp;Back to previous page</a>
                        <div class="clear_h10"></div>
                        <h4 class="border_bottom">ORDER DETAILS</h4>
                        <ul>
                            <li><strong>Order number: </strong> #<?php echo $order_data->order_no; ?></li>
                            <li><strong>Customer Name:</strong> <?php echo $customer_data->profile->f_name.' '.$customer_data->profile->l_name; ?></li>
                            <li><strong>Customer Email:</strong> <?php echo $customer_data->email; ?></li>
                            <li><strong>Date:</strong> <?php echo $order_data->date; ?></li>
                            <li><strong>Time: </strong> <?php echo $order_data->time; ?></li>
                            <?php if(isset($order_data->delivery_date)){?><li><strong>Delivery Date:</strong> <?php echo $order_data->delivery_date; ?></li><?php }?>
                            <?php if(isset($order_data->delivery_date)){?><li><strong>Delivery Time: </strong> <?php echo $order_data->delivery_time; ?></li><?php }?>
                            <?php
                                $service = "";
                                if($order_data->service_type == 1){
                                    $service = '<span class="btn-success">DELIVERY</span>';
                                } else if($order_data->service_type == 2){
                                    $service = "<span class='label label-warning'>CATERING</span>";
                                } else if($order_data->service_type == 3){
                                    $service = "<span class='label label-danger'>RESERVATION</span>";
                                } else if($order_data->service_type == 4){
                                    $service = "<span class='label label-info'>PICKUP</span>";
                                }

                                $payment_title = "";
                                if($order_data->payment_method == 1){
                                    $payment_title = "Cash";
                                } else if($order_data->payment_method == 2){
                                    $payment_title = "Knet";
                                } else if($order_data->payment_method == 3){
                                    $payment_title = "Credit Card";
                                } else if($order_data->payment_method == 4){
                                    $payment_title = "PayPal";
                                }
                            ?>
                            <li><strong>Type: </strong> &nbsp;<?php echo $service;?></li>
                            <li><strong>Payment Type: </strong>&nbsp;<?php echo $payment_title; ?></li>

                        </ul>

                        <div class="clear_h10"></div>
                        <h5 class="border_bottom">CUSTOMER ADDRESS DETAILS</h5>
                        <ul>
                            <li><strong>Address: </strong> <?php echo $customer_address->address_name; ?></li>
                            <li><strong>Street: </strong> <?php echo $customer_address->street; ?></li>
                            <li><strong>Block: </strong> <?php echo $customer_address->block; ?></li>
                            <li><strong>House: </strong> <?php echo $customer_address->house; ?></li>
                            <li><strong>Floor: </strong> <?php echo $customer_address->floor; ?></li>
                            <li><strong>Appartment: </strong> <?php echo $customer_address->appartment; ?></li>
                            <li><strong>Area: </strong> <?php echo $customer_address->area_name; ?></li>
                        </ul>
                        <div class="clear_h10"></div>
                        <h4 class="border_bottom">ORDER FULL DETAILS</h4>
                        <div class="table-responsive">
                            <table class="table table_design">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Item Name</th>
                                        <th>Comment</th>
                                        <th>VARIATIONS</th>
                                        <th>Quantity</th>
                                        <th>PRICE</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                        foreach($order_details as $Or => $ord):
                                        ?>
                                        <tr>
                                            <td><img src="<?php getImagePath($ord->item_image); ?>" alt="" class="img-responsive" style="width:100px;" /></td>
                                            <td><strong><?php echo $ord->item_name; ?></strong></td>
                                            <td width="30%"><?php echo $ord->notes; ?></td>
                                            <td>
                                            <?php if(isset($ord->variations)) {
                                               foreach($ord->variations as $variation) {
                                                   echo "<div>".$variation->variation_name." - ".$variation->title."(KD ".$variation->price.")</div>";
                                               } 
                                            }?>
                                            </td>
                                            <td><?php echo $ord->quantity; ?></td>
                                            <td>KD <?php echo $ord->price; ?></td>
                                            <td>KD <?php echo $ord->price * $ord->quantity; ?></td>
                                        </tr>
                                        <?php
                                            endforeach;
                                    ?>           
                                    <tr>
                                        <td colspan="4" class="border_none"></td>
                                        <td colspan="2" align="right">                           

                                            Get Points: <?php echo $order_data->order_points; ?>
                                            <div class="line"></div>
                                            Used Points: <?php echo $order_data->used_points; ?>
                                            <div class="line"></div>
                                            Used Coupon: <?php echo $order_data->coupon_code; ?>
                                            <div class="line"></div>
                                            Discount: <?php echo $order_data->discount_amount; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="border_none"></td>
                                        <td colspan="2" align="right">                           

                                            Delivery charges: KD <?php echo $order_data->delivery_charges; ?>
                                            <div class="line"></div>
                                            Total Bill: KD <?php echo $order_data->total; ?>
                                            <div class="line"></div>
                                            Discount: <?php echo $order_data->discount_amount; ?>
                                            <div class="line"></div>
                                            <strong>Grand Total: KD <?php echo $grandTotal = $order_data->delivery_charges + $order_data->total - $order_data->discount_amount; ?> </strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <?php

                                $time = strtotime($order_data->time);
                                $curTime = strtotime(date('H:i a'));
                                $startTime = date("H:i", strtotime('+3 minutes', $time));
                                $endtimeTime = date("H:i", strtotime($curTime));

                                if($endtimeTime > $startTime)
                                {
                                ?>
                                <form action="" method="post">

                                    <table class="table bg-gray-light" width="100%">
                                        <tr><td>ACTION STATUS: &nbsp;
                                            <select id="Select1" style="width:20%;" name="status">
                                                <option value="">-Select Status-</option>
                                                <option value="4" <?php if($ordD->status == 4){ echo "selected"; } ?>>Cancel Order</option>
                                            </select></td></tr>
                                        <tr><td ><span class="text-red">(IF)</span> Reject order: Reason of rejection</td></tr>
                                        <tr><td>COMMENTS:<br />
                                                <textarea id="TextArea1" rows="2" cols="20" style="width:100%;" name="reject_reson"><?php echo $ordD->reject_reson; ?></textarea>
                                            </td></tr>
                                        <tr><td><button type="submit" name="updatestatus" class="btn bg-green">UPDATE STATUS</button></td></tr>
                                    </table>
                                </form>
                                <?php
                                }
                            ?>
                        </div>

                    </div>
                </div>
            </section>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="margin20"></div>
</div>






<?php

    $this->load->view("includes/Customer/advertise"); 
    $this->load->view("includes/Customer/footer"); 
?>