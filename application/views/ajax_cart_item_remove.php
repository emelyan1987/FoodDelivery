
    <div class="margin20"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="col-sm-6">
                <!--<h4 class="text-uppercase">Restaurant Name</h4>-->
            </div>
            <div class="col-sm-6">
                <a href="/restaurants/" class="btn btn-success btn-block"><i class="fa fa-plus"></i> Add More Items</a>
            </div>
        </div>
    </div>
    <div class="margin20"></div>
    <?php
    $total = 0;
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
                         <span class="removeItem" onclick='removeItem("<?php echo $ca->id; ?>");'><i class="fa fa-times-circle"></i></span>
                        <img class="itemCheckImg" src="<?php get_item_image($ca->product_id); ?>" alt="">
                    </div>
                    <div class="col-md-4">
                        <h4><?php get_item_name($ca->product_id); ?></h4>
                        <span>Qty : <?php echo $ca->quantity; ?> </span>
                    </div>
                    <div class="col-md-4">
                        <h4>Total</h4>
                        <h4>KD <?php echo $ca->price; ?></h4>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <?php
    $total = $total + $ca->price;
    endforeach;
    ?>
    
    <div class="row">
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
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-12">
                <div class="border">
                    <div class="col-sm-offset-6 col-sm-6">
                        <div><i>Minimum Order:</i> <label class="green">KD 7.500</label></div>
                        <div><i>Minimum Order:</i> <label class="red">KD 9.500</label></div>
                        <div><strong>Total Amount:</strong> <label>KD <?php echo $total; ?></label></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
    <div class="clearfix"></div>
    <div class="margin20"></div>
