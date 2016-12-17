<?PHP
    $this->load->view("includes/Customer/header"); 
    $this->load->helper('customer_helper');
?>

<form action="" method="post">
    <div class="container-fluid">
        <div class="margin20"></div>
        <div class="clearfix"></div>
        <div class="row">

            <div class="col-md-12">
                <div class="tab-content">
                    <div id="tab1" class="tab-pane fade in active">
                        <?php
                            if(count($DcartData) > 0)
                            {

                            ?>
                            <div class="row">
                                <div class="col-md-9">
                                    <h3>Delivery</h3>
                                </div>
                                <div class="col-md-3"><button type="submit" name="delivery_checkout" class="btn btn-yellow btn-yellow-new btn-block"><img src="/assets/Administration/images/icon/cartIcon.png" alt=""> CHECKOUT</button></div>

                            </div>
                            <div class="margin20"></div>

                            <div class="row" id="show_cartdata">

                                <?php
                                    if($DcartData != '')
                                    {   
                                        $i = 0;
                                        foreach($DcartData as $DXc => $Dcart):

                                        ?>
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="col-md-12">
                                                        <div class="border">
                                                            <!--<div class="col-md-12">
                                                            <span class="editItem"><i class="fa fa-edit"></i> Edit</span>
                                                            </div>-->
                                                            <div class="col-md-4">
                                                                <span class="removeItem" onclick='removeItem("<?php echo $Dcart->id; ?>");'><i class="fa fa-times-circle"></i></span>
                                                                <img class="itemCheckImg" src="<?php get_item_image($Dcart->product_id); ?>" alt=""/>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <h4><?php get_item_name($Dcart->product_id); ?></h4>
                                                                <span>Qty : <?php echo $Dcart->quantity; ?> </span><br>
                                                                <span>Price : KD <?php echo $Dcart->price; ?> </span>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <h4>Total</h4>
                                                                <h4>KD <?php echo $tot = $Dcart->price * $Dcart->quantity; ?></h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="margin20"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                            $restro_id = $Dcart->restro_id; 
                                            $i = 1;
                                            endforeach;
                                    }

                                ?>
                                <?php
                                    if($i == 1)
                                    {  
                                    ?>
                                    <input type="hidden" name="delivery_restro_id" value="<?php echo $restro_id; ?>" >
                                    <?php
                                    }
                                ?>
                            </div>
                            <?php
                            }
                        ?>


                        <?php
                            if(count($CcartData) > 0)
                            {

                            ?>
                            <div class="row">
                                <div class="col-md-9">
                                    <h3>Catering</h3>
                                </div>
                                <div class="col-md-3"><button type="submit" name="catering_checkout" class="btn btn-yellow btn-yellow-new btn-block"><img src="/assets/Administration/images/icon/cartIcon.png" alt=""> CHECKOUT</button></div>

                            </div>
                            <div class="margin20"></div>

                            <div class="row"  id="show_catering_cartdata">

                                <?php
                                    if($CcartData != '')
                                    {   
                                        $i = 0;
                                        foreach($CcartData as $DXc => $Dcart):

                                        ?>
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="col-md-12">
                                                        <div class="border">
                                                            <!--<div class="col-md-12">
                                                            <span class="editItem"><i class="fa fa-edit"></i> Edit</span>
                                                            </div>-->
                                                            <div class="col-md-4">
                                                                <span class="removeItem" onclic='removeItemCatering("<?php echo $Dcart->id; ?>")'><i class="fa fa-times-circle"></i></span>
                                                                <img class="itemCheckImg" src="<?php get_item_image($Dcart->product_id); ?>" alt=""/>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <h4><?php get_item_name($Dcart->product_id); ?></h4>
                                                                <span>Qty : <?php echo $Dcart->quantity; ?> </span><br>
                                                                <span>Price : KD <?php echo $Dcart->price; ?> </span>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <h4>Total</h4>
                                                                <h4>KD <?php echo $tot = $Dcart->price * $Dcart->quantity; ?></h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="margin20"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                            $restro_id = $Dcart->restro_id; 
                                            $i =1;
                                            endforeach;
                                    }

                                ?>
                                <?php
                                    if($i == 1)
                                    { 
                                    ?>
                                    <input type="hidden" name="catering_restro_id" value="<?php echo $restro_id; ?>" >
                                    <?php
                                    }
                                ?>
                            </div>
                            <?php
                            }
                        ?>


                        <?php
                            if(count($PcartData) > 0)
                            {

                            ?>
                            <div class="row">
                                <div class="col-md-9">
                                    <h3>Pickup</h3>
                                </div>
                                <div class="col-md-3"><button type="submit" name="pickup_checkout" class="btn btn-yellow btn-yellow-new btn-block"><img src="/assets/Administration/images/icon/cartIcon.png" alt=""> CHECKOUT</button></div>

                            </div>
                            <div class="margin20"></div>

                            <div class="row" id="show_pickup_cartdata">

                                <?php
                                    if($PcartData != '')
                                    {   
                                        $i = 0;
                                        foreach($PcartData as $DXc => $Dcart):

                                        ?>
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="col-md-12">
                                                        <div class="border">
                                                            <!--<div class="col-md-12">
                                                            <span class="editItem"><i class="fa fa-edit"></i> Edit</span>
                                                            </div>-->
                                                            <div class="col-md-4">
                                                                <span class="removeItem" onclick='removeItemPickup("<?php echo $ca->id; ?>");'><i class="fa fa-times-circle"></i></span>
                                                                <img class="itemCheckImg" src="<?php get_item_image($Dcart->product_id); ?>" alt=""/>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <h4><?php get_item_name($Dcart->product_id); ?></h4>
                                                                <span>Qty : <?php echo $Dcart->quantity; ?> </span><br>
                                                                <span>Price : KD <?php echo $Dcart->price; ?> </span>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <h4>Total</h4>
                                                                <h4>KD <?php echo $tot = $Dcart->price * $Dcart->quantity; ?></h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="margin20"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                            $restro_id = $Dcart->restro_id;
                                            $i = 1; 
                                            endforeach;
                                    }

                                ?>
                                <?php
                                    if($i == 1)
                                    { 
                                    ?>
                                    <input type="hidden" name="pickup_restro_id" value="<?php echo $restro_id; ?>" >
                                    <?php
                                    }
                                ?>
                            </div>

                            <?php
                            }
                        ?>


                        <?php
                            if(count($RcartData) > 0)
                            {

                            ?>
                            <div class="row">
                                <div class="col-md-9">
                                    <h3>Rservation</h3>
                                </div>
                                <div class="col-md-3"><button type="submit" name="reservation_checkout" class="btn btn-yellow btn-yellow-new btn-block"><img src="/assets/Administration/images/icon/cartIcon.png" alt=""> CHECKOUT</button></div>

                            </div>
                            <div class="margin20"></div>

                            <div class="row" id="show_pickup_cartdata">

                                <?php
                                    if($RcartData != '')
                                    {   
                                        $i = 0;
                                        foreach($RcartData as $DXc => $Dcart):

                                        ?>
                                        <div class="col-md-3">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="col-md-12">
                                                        <div class="border">
                                                            <!--<div class="col-md-12">
                                                            <span class="editItem"><i class="fa fa-edit"></i> Edit</span>
                                                            </div>-->
                                                            <div class="col-md-2">
                                                                <span class="removeItem" ><i class="fa fa-times-circle"></i></span>

                                                            </div>
                                                            <div class="col-md-10">
                                                                <h4><?php echo ucwords(getTableName($Dcart->table_id)); ?></h4><br>
                                                                <span>User Limit : <?php echo $Dcart->user_limit; ?> </span><br>
                                                                <span>Reservation Date : KD <?php echo $Dcart->res_date; ?> </span>
                                                                <span>Notes : <?php echo $Dcart->notes; ?> </span>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="margin20"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                            $restro_id = $Dcart->restro_id;
                                            $i = 1; 
                                            endforeach;
                                    }

                                ?>
                                <?php
                                    if($i == 1)
                                    { 
                                    ?>
                                    <input type="hidden" name="reservation_restro_id" value="<?php echo $restro_id; ?>" >
                                    <?php
                                    }
                                ?>
                            </div>
                            <?php
                            }
                        ?>

                        <?php
                            if((count($DcartData) == 0) && (count($CcartData) == 0) && (count($PcartData) == 0) && (count($RcartData) == 0))
                            {
                            ?>
                            <div>
                                <label class="label-danger text-center">Your Cart Is Empty</label> 
                            </div>
                            <?php
                            }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<?php
    $this->load->view("includes/Customer/advertise"); 
    $this->load->view("includes/Customer/footer"); 
?>




<script>


    function removeItem(item){

        $.ajax({

            url: "/delivery_cart_item_remove/",
            type: "post",
            data: {item:item} ,
            success: function (response) {

                $("#show_cartdata").html(response);
            }
        })
    }



    function removeItemPickup(item){
        $.ajax({

            url: "/pickup_cart_item_remove/",
            type: "post",
            data: {item:item} ,
            success: function (response) {

                $("#show_pickup_cartdata").html(response);
            }
        })
    }


    function removeItemCatering(item){
        $.ajax({

            url: "/ajax_cart_pickup_remove/",
            type: "post",
            data: {item:item} ,
            success: function (response) {

                $("#show_catering_cartdata").html(response);
            }
        })
    }

</script>



