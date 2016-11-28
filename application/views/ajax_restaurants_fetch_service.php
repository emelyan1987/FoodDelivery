<?php foreach ($restro_list as $ks => $vs): ?>
    <div class="margin20"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="border">
                <div class="col-md-4">
                    <div class="col-sm-4 col-md-4">
                        <?php
                            if ($vs->status == 1) {
                                $stl = 'class="opened"';
                                $status_title = "Open";
                            } elseif ($vs->status == 2) {
                                $stl = 'class="busy"';
                                $status_title = "Busy";
                            } else {
                                $stl = 'class="close"';
                                $status_title = "Close";
                            }
                        ?>
                        <span <?php echo $stl;?>></span> <?php echo $status_title;?>
                    </div>
                    <div class="col-sm-8 col-md-8">
                        <?php
                            if ($vs->restro_logo != '') {
                            ?>
                            <a href="/restaurant_profile/<?php echo $vs->restro_id;?>">
                                <img class="img-responsive resimg" alt="" src="<?php $img = explode('public_html', $vs->restro_logo);
                                    echo $img[1];?>"> </a>
                            <?php
                            } else {
                            ?>
                            <a href="/restaurant_profile/<?php echo $vs->id;?>">
                            <img class="img-responsive resimg" alt="" src="/assets/Customer/img/icon/bottomIcon2.png"> </a>
                            <?php
                            }
                        ?>

                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <a href="/restaurant_profile/<?php echo $vs->restro_id;?>"><h4 class="restrotitle"><?php echo ucwords($vs->restro_name);?></h4></a>
                    <div class="ratings">
                        <?php
                            if($vs->rating!=null){
                            ?>
                            <span>
                                <?php
                                    $rating = round($vs->rating);
                            
                                    if ($rating == 5) {
                                    ?>
                                    <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                    <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                    <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                    <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                    <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                    <?php
                                    } elseif ($rating == 4) {
                                    ?>
                                    <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                    <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                    <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                    <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                    <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                    <?php
                                    } elseif ($rating == 3) {
                                    ?>
                                    <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                    <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                    <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                    <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                    <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                    <?php
                                    } elseif ($rating == 2) {
                                    ?>
                                    <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                    <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                    <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                    <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                    <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                    <?php
                                    } elseif ($rating == 1) {
                                    ?>
                                    <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                    <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                    <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                    <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                    <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                    <?php
                                    } else {
                                    ?>
                                    <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                    <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                    <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                    <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                    <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                    <?php
                                    }
                                ?>
                            </span>
                            <?php
                            } else {
                            ?>
                            <span>
                                <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                            </span>
                            <?php
                            }

                        ?>


                        <label><?php echo count($vs->reviews);?> reviews</label>
                    </div>
                    <div  class="restroheart">
                        <?php if ($vs->restro_state == 1): ?>
                            <img src="/assets/Customer/img/icon/love.png" alt="">
                            <?php endif?>
                        <?php if ($vs->promo_id != ""): ?>
                            <img src="/assets/Customer/img/icon/bow.png" alt="">
                            <?php endif?>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="list-label">Min. Order:</label>
                    <label class="list-data">&nbsp;KD <?php echo $vs->min_order;?></label>
                    <br>
                    <label class="list-label">Delivery Time:</label>
                    <label class="list-data">&nbsp;<?php echo $vs->order_time . " Min. ";?></label>
                    <br>
                    <label class="list-label">Payment:</label>
                    <label class="list-data">&nbsp;
                        <?php
                            $payArray = explode(',', $vs->payment_method);
                            if (in_array(1, $payArray)) {
                                echo '<img class="" alt="" src="/assets/Customer/img/cash.png">';
                            }
                            if (in_array(2, $payArray)) {
                                echo '<img class="" alt="" src="/assets/Customer/img/knet.png">';
                            }
                            if (in_array(3, $payArray)) {
                                echo '<img class="" alt="" src="/assets/Customer/img/card.png">';
                            }
                            if (in_array(4, $payArray)) {
                                echo '<img class="" alt="" src="/assets/Customer/img/paypal.png">';
                            }
                    ?></label>

                    <br><br>
                    <div><a href="/restaurant_view/<?php echo $vs->restro_id;?>/<?php echo $vs->location_id;?>" class="list-button">Go to menu <i class="fa fa-angle-right"></i></a></div>
                </div>
            </div>
        </div>
    </div>

    <?php endforeach;?>
