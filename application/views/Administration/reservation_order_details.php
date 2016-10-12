<?PHP
    $this->load->view("includes/Administration/header"); 
    $this->load->view("includes/Administration/sidebar");

    foreach($orderdata as $ord => $ordD):
    ?>

    <style>
        .listOdnary {
            list-style: none;
            padding: 0;
            width: 100%;
        }

        .listOdnary1 {
            list-style: none;
            padding: 0;
            width: 100%;
        }
        .listOdnary1 li {
            display: inline-block;
            width: 98%;
            margin-left: 2%;
        }
        .listOdnary li {
            display: inline-block;
            width: 47%;
            margin-left: 2%;
        }
        @media(max-width: 1024px)
        {
            .listOdnary li {
            display: inline-block;
            width: 98%;
            margin-left: 2%; 
        }
        }
        .listOdnaryTitle {
            font-size: 16px;
            height: 35px;
            line-height: 35px;
            font-weight: bold;
            padding: 0 15px;
        }
        .listOdnaryDetail {
            background: #eee;
            height: 35px;
            font-size: 16px;
            padding: 0 15px;
            line-height: 35px;
            margin-bottom: 5px;
        }
        .border_bottom {
            width:100% !important ;
        }
        .mystatusClass{
            font-size: 20px;
        }
        .desclaimer p{
            font-size: 11px;
            line-height: 1;
            margin: 0px;
        }
    </style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <!-- Main content -->

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <a href="/reservation_orders/" class="btn bg-gray-light2">< &nbsp;Back to previous page</a>
                    <div class="clear_h10"></div>
                    <h4 class="border_bottom">ORDER Details</h4>
                    <ul class="listOdnary">
                        <li><div class="listOdnaryTitle">Order number: </div><div class="listOdnaryDetail"> #<?php echo $ordD->order_no; ?></div></li>
                        <li><div class="listOdnaryTitle">Customer Name:</div><div class="listOdnaryDetail"> <?php echo $ordD->f_name.' '.$ordD->l_name; ?></div></li>
                        <!--<li><div class="listOdnaryTitle">Customer Email:</div><div class="listOdnaryDetail"> <?php echo $ordD->Cust_email; ?></div></li>-->
                        <li><div class="listOdnaryTitle">Restaurant Name:</div><div class="listOdnaryDetail"> <?php echo $ordD->restro_name; ?></div></li>
                        <li><div class="listOdnaryTitle">Customer Phone No.:</div><div class="listOdnaryDetail"> <?php echo getUserMobileNo($ordD->user_id); ?></div></li>
                        <li><div class="listOdnaryTitle">Restaurant Location:</div><div class="listOdnaryDetail"> <?php echo getOwnerlocationByLId($ordD->restro_location_id); ?></div></li>

                        <li><div class="listOdnaryTitle">Order Type:</div><div class="listOdnaryDetail"> RESERVATION </div></li>

                        <li><div class="listOdnaryTitle">Order Date:</div><div class="listOdnaryDetail"> <?php echo $ordD->date; ?></div></li>
                        <li><div class="listOdnaryTitle">Order Time: </div> <div class="listOdnaryDetail"><?php echo $ordD->time; ?></div></li>
                        <li><div class="listOdnaryTitle">Payment Status: </div><div class="col-md-12"> <div class="btn-group">
                                    <?php
                                        //if($ordD->payment_method == 1)
                                        {

                                            if($ordD->pay_done == 1)
                                            {
                                            ?>
                                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Completed
                                            </button>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Pending
                                            </button>
                                            <?php
                                            }

                                        }
                                    ?>
                                    <div class="dropdown-menu">
                                        <div class="col-md-12">
                                            <a class="dropdown-item" href="javascript:void(0)" onclick='payFun(3,"<?php echo $ordD->id; ?>",0);'>
                                                <div class="col-md-12 btn-default mystatusClass">
                                                    Pending
                                                </div>
                                            </a>
                                            <a class="dropdown-item" href="javascript:void(0)" style="color:#fff;" onclick='payFun(3,"<?php echo $ordD->id; ?>",1);'>
                                                <div class="col-md-12  btn-success mystatusClass">
                                                    Completed
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div></div></li>
                    </ul>

                    <div class="clear_h10"></div>
                    <h4 class="border_bottom">RESTAURANT Address</h4>
                    <ul class="listOdnary">
                        <?php
                            $locArray = getlocationAllDetails($ordD->restro_location_id);
                        ?>
                        <li><div class="listOdnaryTitle">City:</div><div class="listOdnaryDetail"> <?php echo $locArray['city_name']; ?></div></li>
                        <li><div class="listOdnaryTitle">Area: </div><div class="listOdnaryDetail"> <?php echo $locArray['name']; ?> </div></li>
                        <li><div class="listOdnaryTitle">Building:</div><div class="listOdnaryDetail"> <?php echo $locArray['building']; ?> </div></li>
                        <li><div class="listOdnaryTitle">Block:</div><div class="listOdnaryDetail"> <?php echo $locArray['block']; ?></div></li>
                        <li><div class="listOdnaryTitle">Street:</div><div class="listOdnaryDetail"><?php echo $locArray['street']; ?></div></li>
                        <li><div class="listOdnaryTitle">Telephones:</div><div class="listOdnaryDetail"> <?php echo $locArray['telephones']; ?></div></li>

                    </ul>
                    <div class="clear_h10"></div>
                    <h4 class="border_bottom">ORDER FULL DETAILS</h4>
                    <div class="table-responsive">
                        <table class="table table_design">
                            <thead>
                                <tr>

                                    <th>Table Name / No.</th>
                                    <th>Booking Date</th>
                                    <th>Booking Time</th>
                                    <th>User Limit</th>
                                    <th>Comment</th>


                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                    foreach($orderdetails as $Or => $ord):
                                    ?>
                                    <tr>

                                        <td><strong><?php echo $ord->table_no; ?></strong></td>
                                        <td><?php echo $ord->booking_date; ?></td>
                                        <td><?php echo $ord->booking_time; ?></td>
                                        <td><?php echo $ord->user_limit; ?></td>
                                        <td width="30%"><?php echo $ord->notes; ?></td> 

                                    </tr>
                                    <?php
                                        endforeach;
                                ?>           
                                <!--<tr>
                                <td colspan="4" class="border_none"></td>
                                <td colspan="2" align="right">                           

                                Delivery charges: KD <?php echo $ordD->delivery_charges; ?>
                                <div class="line"></div>
                                Total Bill: KD <?php echo $ordD->total; ?>
                                <div class="line"></div>
                                <strong>Grand Total: KD <?php echo $grandTotal = $ordD->delivery_charges + $ordD->total; ?> </strong>
                                </td>
                                </tr>-->
                            </tbody>
                        </table>
                    </div>

                    <div class="table-responsive">
                        <table class="table table_design">

                            <tr>
                                <td>
                                    <h4 >DISCLAIMER</h4>
                                </td>
                            </tr>
                            <tr>
                                <td class="desclaimer">
                                    <p>This product was ordered by the customer from the above-mentioned restaurant via Mataam, which acts as an intermediary between customers and the subscribed restaurants.</p>
                                    <p>This transaction is subject to the terms and conditions of the use of Mataam, which are listed on our website. By entering into this transaction the customer is deemed to have read and accepted these terms and conditions.</p>
                                    <p>The purpose of this summary is to display and record the details of this transaction. It should not be regarded as an invoice issued by the restaurant.</p>
                                    <p>Mataam has no involvement in the preparation, production, pricing or delivery of this product. The restaurant has sole responsibility for these processes, as well as for the quality and validity of the product.</p>
                                    <p>Mataam accepts no responsibility for any damage or injury that may arise from this transaction. In the event of a complaint, the customer is requested to contact Mataam in order for us to pursue the issue with the restaurant.</p>
                                    <p>As per the contract between Mataam and the restaurant, the restaurant is solely responsible for its online menu content including descriptions, images and prices of menu items, discount coupons and promotions, minimum order values and delivery fees. Mataam accepts no responsibility or legal liability arising from any discrepancy between the menu content displayed on Mataam and the restaurant’s own delivery menu. </p>
                                    <p>We encourage Mataam users to advise us of any discrepancies found, in order for us to raise them with the restaurant concerned.</p>

                                </td>
                            </tr>
                        </table>
                    </div>


                    <form action="" method="post">
                        <table class="table bg-gray-light" width="100%">
                            <tr><td>ACTION STATUS: &nbsp;
                                <select id="Select1" style="width:20%;" name="status">
                                    <option value="1" <?php if($ordD->status == 1){ echo "selected"; } ?>>Pending</option>
                                    <!--<option value="2" <?php if($ordD->status == 2){ echo "selected"; } ?>>Under Process</option>-->
                                    <option value="3" <?php if($ordD->status == 3){ echo "selected"; } ?>>Completed</option>
                                    <option value="4" <?php if($ordD->status == 4){ echo "selected"; } ?>>Cancelled</option></select></td></tr>
                            <tr><td ><span class="text-red">(IF)</span> Reject order: Reason of rejection</td></tr>
                            <tr><td>COMMENTS:<br />
                                    <textarea id="TextArea1" rows="2" cols="20" style="width:100%;" name="reject_reson"><?php echo $ordD->reject_reson; ?></textarea>
                                </td></tr>
                            <tr><td><button type="submit" name="updatestatus" class="btn bg-green">UPDATE STATUS</button></td></tr>
                        </table>
                    </form>
                </div>
            </div>
        </section>

    </div><!-- /.content-wrapper -->


    <?PHP
        endforeach;
    $this->load->view("includes/Administration/footer");
?>

<script>
    function payFun(service,order_id,status){
        if(order_id != '')
        {
            var v=confirm("Do You Want To Change Payment Status of This Order?");
            if(v==true)
            {
                $.ajax({
                    method:"post",
                    url:'/paymentdone_order/',
                    data:{Oid:order_id,type:service,status:status},
                    success:function(response)
                    {
                        if(response)
                        {

                            window.location.reload();
                        }
                    }  

                })
            }            
        }
    }
</script>