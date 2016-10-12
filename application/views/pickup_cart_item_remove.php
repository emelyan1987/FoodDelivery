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