<?php
    $this->load->helper('customer_helper');
?>
<div class="row">
    <?php
        foreach ($restro_item as $it => $TE):
        ?>
        <div class="col-md-6">
            <div class="border">
                <div class="col-md-12">
                    <div class="col-md-4 col-sm-4">
                        <div class="row">
                            <img class="img-responsive img-menu" src="<?php if ($TE->image != '') {getImagePath($TE->image);} else {echo '/assets/Customer/img/default_item.png';}
                                ?>" alt="">
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-8 item-desc">
                        <a href="/view_restro_item/<?php echo $restro_id;?>/<?php echo $location_id;?>/<?php echo $TE->id;?>" class="rest-link"><h4><?php echo ucwords($TE->name);?></h4></a>
                        <p class="just"><?php echo $TE->description;?></p>
                        <div class="menuList">
                            <span class="menuListPT"><?php echo $TE->redeem_point;?>pt</span>
                            <span class="menuListPrice">KD <?php echo number_format($TE->price, 3);?></span>
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
