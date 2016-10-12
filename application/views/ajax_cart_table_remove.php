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
                                                        <div class="col-md-2">
                                                             <span class="removeItem" onclick='removeItem("<?php echo $ca->id; ?>");'><i class="fa fa-times-circle"></i></span>
                                                            
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h4><?php getTableName($ca->table_id); ?></h4>
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
                                               
                                                
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="col-sm-12">
                                                    <div class="border">
                                                        <div class="col-sm-offset-6 col-sm-6">
                                                            
                                                            <div><strong>Total Amount:</strong> <label id="total_label">  KD <?php echo $total; ?></label></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                     <input type="hidden" id="hd_total" name="hd_total" value="<?php echo $total; ?>">
                                     <input type="hidden" id="hd_charges" name="hd_charges" value="0.500">
                                     <input type="hidden" id="hd_orderTime" name="hd_orderTime" > 
                                     <input type="hidden" id="hd_paymentType" name="hd_paymentType" >
                                        <div class="clearfix"></div>
                                        <div class="margin20"></div>