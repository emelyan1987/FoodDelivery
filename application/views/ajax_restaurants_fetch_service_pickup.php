                            <?php foreach ($retro_list as $ks => $vs): ?>
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
if ($vs->restaurant_logo != '') {
	?>
                                                <a href="/restaurant_profile/<?php echo $vs->id;?>">
                                                <img class="img-responsive resimg" alt="" src="<?php $img = explode('public_html', $vs->restaurant_logo);
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
                                          <!--  <a href="/pickup_restaurant/<?php echo $vs->id;?>"><h4><?php echo ucwords($vs->restro_name);?></h4></a> -->
                                          <a href="/restaurant_profile/<?php echo $vs->id;?>"><h4><?php echo ucwords($vs->restro_name);?></h4></a>
                                            <div class="ratings">
                                                 <?php

$ratArray = getRestroRatingValues($vs->id);
if ($ratArray['rating_num'] != 0) {
	$getR = $ratArray['rating_value'] / $ratArray['rating_num'];
	$getR = round($getR);
	?>
                                                <span>
                                                <?php
if ($getR == 5) {
		?>
                                                    <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                                         <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                                         <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                                         <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                                         <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                                <?php
} elseif ($getR == 4) {
		?>
                                                    <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                                         <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                                         <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                                         <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                                         <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                                <?php
} elseif ($getR == 3) {
		?>
                                                     <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                                         <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                                         <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                                         <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                                         <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                                <?php
} elseif ($getR == 2) {
		?>
                                                    <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                                         <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                                         <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                                         <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                                         <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                                <?php
} elseif ($getR == 1) {
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


                                                <label><?php echo $ratArray['rating_num'];?> reviews</label>
                                            </div>
                                            <div>
                                               <?php if ($vs->restro_status == 1): ?>
                                                <img src="/assets/Customer/img/icon/love.png" alt="">
                                            <?php endif?>
                                                 <?php if ($vs->promotion != ""): ?>
                                                <img src="/assets/Customer/img/icon/bow.png" alt="">
                                            <?php endif?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <!--<label class="list-label">Min. Order:</label>
                                            <label class="list-data">&nbsp;KD <?php //echo $vs->RestroMin; ?></label>-->

                                             	<label class="list-label">Delivery Time:</label>
                            			<label class="list-data">&nbsp;<?php if ($vs->order_days != 0) {echo $vs->order_days . " Day ";}
?><?php if ($vs->order_hour != 0) {echo $vs->order_hour . " Hour ";}
?>
                                                <?php if ($vs->order_minitue != 0) {echo $vs->order_minitue . " Min. ";}
?><?php //if($vs->order_second != 0){ echo $vs->order_second."Sec. "; } ?> </label>
                            			<label class="list-label">Payment:</label>
                            			<label class="list-data">&nbsp;
                                            <?php
$payArray = explode(',', $vs->method_type);
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
?>

                                        </label>
                                            <br><br>
                                            <div><a href="/pickup_restaurant/<?php echo $vs->id;?>" class="list-button">Go to menu <i class="fa fa-angle-right"></i></a></div>
                                        </div>
                                    </div>
                                  </div>
                              </div>

                            <?php endforeach;?>
