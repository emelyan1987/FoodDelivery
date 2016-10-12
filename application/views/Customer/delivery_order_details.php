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



foreach($orderdata as $ord => $ordD):
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
                    <h4 class="border_bottom">ORDER Details</h4>
                    <ul>
                    <li><strong>Order number: </strong> #<?php echo $ordD->order_no; ?></li>
                    <li><strong>Customer Name:</strong> <?php echo $ordD->f_name.' '.$ordD->l_name; ?></li>
                    <li><strong>Customer Email:</strong> <?php echo $ordD->Cust_email; ?></li>
                    <li><strong>Date:</strong> <?php echo $ordD->date; ?></li>
                    <li><strong>Time: </strong> <?php echo $ordD->time; ?></li>
                    <li><strong>Delivery Date:</strong> <?php echo $ordD->delivery_date; ?></li>
                    <li><strong>Delivery Time: </strong> <?php echo $ordD->delivery_time; ?></li>
                    <li><strong>Type: </strong> <span class="btn-success"> DELIVERY</span></li>
                    <li><strong>Payment Type: </strong> <?php if($ordD->payment_method == 1){ echo "Cash On delivery"; }elseif($ordD->payment_method == 2){ echo "Knet"; }elseif($ordD->payment_method == 3){ echo "Credit Card"; }elseif($ordD->payment_method == 4){ echo "Paypal"; } ?></li>

                    </ul>
                   
                    <div class="clear_h10"></div>
                    <h5 class="border_bottom">CUSTOMER BILLING DETAILS</h5>
                    <ul>
                    <li><strong>Name: </strong> <?php echo $ordD->billing_full_name; ?></li>
                    <li><strong>Address 1: </strong> <?php echo $ordD->billing_addres_1; ?></li>
                    <li><strong>Address 2: </strong> <?php echo $ordD->billing_address_2; ?></li>
                    <li><strong>City: </strong> <?php echo $ordD->billing_city; ?></li>
                    <li><strong>State: </strong> <?php echo $ordD->billing_state; ?></li>
                    <li><strong>Zip Code: </strong> <?php echo $ordD->billing_zip_code; ?></li>
                    <li><strong>Contact No: </strong> <?php echo $ordD->billing_phoneno; ?></li>
                    </ul>
                     <div class="clear_h10"></div>
                    <h5 class="border_bottom">CUSTOMER SHIPPING DETAILS</h5>
                    <ul>
                    <li><strong>Name: </strong> <?php echo $ordD->shipping_full_name; ?></li>
                    <li><strong>Address 1: </strong> <?php echo $ordD->shipping_address_1; ?></li>
                    <li><strong>Address 2: </strong> <?php echo $ordD->shipping_address_2; ?></li>
                    <li><strong>City: </strong> <?php echo $ordD->shipping_city; ?></li>
                    <li><strong>State: </strong> <?php echo $ordD->shipping_state; ?></li>
                    <li><strong>Zip Code: </strong> <?php echo $ordD->shipping_zip_code; ?></li>
                    <li><strong>Contact No: </strong> <?php echo $ordD->shipping_phoneno; ?></li>
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
                                <td>VARIATIONS</th>
                                <th>Quantity</th>
                                <th class="text-center">PRICE</th>
                                <!--<th class="text-center">Total</th>-->
                            </tr>
                        </thead>
                        <tbody>

              <?php
              foreach($orderdetails as $Or => $ord):
              ?>
                           <tr>
                                <td><img src="<?php getImagePath($ord->image); ?>" alt="" class="img-responsive" style="width:100px;" /></td>
                                <td><strong><?php echo $ord->item_name; ?></strong></td>
                                <td width="30%"><?php echo $ord->notes; ?></td>
                                <td>variations1</td>
                                <td><?php echo $ord->quantity; ?></td>
                                <td class="text-right">KD <?php echo $ord->price; ?></td>
                                <!--<td class="text-right">KD <?php echo $ord->price * $ord->quantity; ?></td>-->
                            </tr>
               <?php
               endforeach;
               ?>           
                            <tr>
                                <td colspan="4" class="border_none"></td>
                                <td colspan="2" align="right">                           
                                
                                Get Points: <?php echo $ordD->order_points; ?>
                                <div class="line"></div>
                                Used Points: <?php echo $ordD->used_points; ?>
                                <div class="line"></div>
                                Used Coupon: <?php echo $ordD->coupon_code; ?>
                                <div class="line"></div>
                                Discount: <?php echo $ordD->discount_amount; ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" class="border_none"></td>
                                <td colspan="2" align="right">                           
                                
                                Delivery charges: KD <?php echo $ordD->delivery_charges; ?>
                                <div class="line"></div>
                                Total Bill: KD <?php echo $ordD->total; ?>
                                <div class="line"></div>
                                Discount: <?php echo $ordD->discount_amount; ?>
                                <div class="line"></div>
                                <strong>Grand Total: KD <?php echo $grandTotal = $ordD->delivery_charges + $ordD->total - $ordD->discount_amount; ?> </strong>
                                </td>
                            </tr>
                            </tbody>
                        </table>

<?php

$time = strtotime($ordD->time);
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
endforeach;
$this->load->view("includes/Customer/advertise"); 
$this->load->view("includes/Customer/footer"); 
?>