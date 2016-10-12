<?php
  $this->load->helper('customer_helper');
?>
<div class="row">
                                	<?php
                                	foreach($restro_item as $it => $TE):
                                	?>
                                    <div class="col-md-6">
                                        <div class="border">
                                            <div class="col-md-12">
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="row">
                                                        <img class="img-responsive img-menu" src="<?php if($TE->image != ''){  getImagePath($TE->image); } ?>" alt="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <a href="/view_restro_pickup/<?php echo $restro_id; ?>/<?php echo $TE->id; ?>" ><h4><?php echo ucwords($TE->item_name); ?></h4></a>
                                                    <p class="just"><?php echo $TE->item_description; ?></p>
                                                    <div class="menuList">
                                                        <span class="menuListPT">16pt</span>
                                                        <span class="menuListPrice">KD <?php echo $TE->item_price; ?></span>
                                                        <img class="img-responsive" src="/assets/Customer/img/icon/bow.png" alt="">
                                                        <img class="img-responsive" src="/assets/Customer/img/icon/love.png" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="margin20"></div>
                                    </div>
                                    <?php
                                    endforeach;
                                    ?>
                                    
</div>
                                