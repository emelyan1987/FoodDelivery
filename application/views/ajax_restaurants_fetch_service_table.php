<h3>Results for City,Area</h3>

                            <?php foreach($retro_list as $ks => $vs): ?>
                              <div class="margin20"></div>
                              <div class="row">
                                  <div class="col-md-12">
                                    <div class="border">
                                        <div class="col-md-4">
                                            <div class="col-sm-6 col-md-6">
                                                <?php 
                                                if($vs->status == 1){
                                                    $stl = 'class="opened"';
                                                    $status_title = "Open";
                                                }
                                                elseif($vs->status == 2)
                                                {
                                                    $stl = 'class="busy"';
                                                    $status_title = "Busy";
                                                }
                                                else
                                                {
                                                    $stl = 'class="close"';
                                                    $status_title = "Close";
                                                }
                                                 ?>
                                                <span <?php echo $stl; ?>></span> <?php echo $status_title; ?>
                                            </div>
                                            <div class="col-sm-6 col-md-6">
                                                <?php
                                                if($vs->restaurant_logo != '')
                                                {
                                                ?>
                                                <a href="/restaurant_profile/<?php echo $vs->id; ?>">
                                                <img class="img-responsive resimg" alt="" src="<?php $img = explode('public_html',$vs->restaurant_logo); 
                                            echo $img[1];?>"> </a>
                                                <?php
                                                }
                                                else
                                                {
                                                ?>
                                                <a href="/restaurant_profile/<?php echo $vs->id; ?>">
                                                <img class="img-responsive resimg" alt="" src="/assets/Customer/img/icon/bottomIcon2.png"> </a>
                                                <?php
                                                }
                                                ?>
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                           <!-- <a href="/reservation_tabel/<?php echo $vs->id; ?>"><h4 class="restrotitle"><?php echo ucwords($vs->restro_name); ?></h4></a> -->
                                           <a href="/restaurant_profile/<?php echo $vs->id; ?>"><h4 class="restrotitle"><?php echo ucwords($vs->restro_name); ?></h4></a>
                                            <div class="ratings">
                                                 <?php 

                                                   $ratArray = getRestroRatingValues($vs->id);
                                                if($ratArray['rating_num'] != 0)
                                                {
                                                   $getR = $ratArray['rating_value'] / $ratArray['rating_num'];
                                                   $getR = round($getR);
                                                ?>
                                                <span>
                                                <?php
                                                if($getR == 5)
                                                {
                                                ?>
                                                         <img class="" alt="" src="/assets/Customer/img/star.png" width="30"> 
                                                         <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                                         <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                                         <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                                         <img class="" alt="" src="/assets/Customer/img/star.png" width="30">  
                                                <?php
                                                }
                                                elseif($getR == 4)
                                                {
                                                ?>
                                                         <img class="" alt="" src="/assets/Customer/img/star.png" width="30"> 
                                                         <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                                         <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                                         <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                                         <img class="" alt="" src="/assets/Customer/img/star1.png" width="30"> 
                                                <?php
                                                }
                                                elseif($getR == 3)
                                                {
                                                ?>
                                                         <img class="" alt="" src="/assets/Customer/img/star.png" width="30"> 
                                                         <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                                         <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                                         <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                                         <img class="" alt="" src="/assets/Customer/img/star1.png" width="30"> 
                                                <?php
                                                }
                                                elseif($getR == 2)
                                                {
                                                ?>
                                                         <img class="" alt="" src="/assets/Customer/img/star.png" width="30"> 
                                                         <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                                         <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                                         <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                                         <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">  
                                                <?php
                                                }
                                                elseif($getR == 1)
                                                {
                                                ?>
                                                         <img class="" alt="" src="/assets/Customer/img/star.png" width="30"> 
                                                         <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                                         <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                                         <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                                         <img class="" alt="" src="/assets/Customer/img/star1.png" width="30"> 
                                                <?php
                                                }
                                                else
                                                {
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
                                                }
                                                else
                                                {
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
                                                    
                                                
                                                <label><?php echo $ratArray['rating_num']; ?> reviews</label>
                                            </div>
                                            <div class="restroheart">
                                                <img src="/assets/Customer/img/icon/love.png" alt="">
                                                <img src="/assets/Customer/img/icon/bow.png" alt="">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                                <label class="col-sm-12">Working Time:</label>
                                                <label class="list-label col-sm-6">Mon-Fri: </label><label class="list-label col-sm-6"><?php echo $vs->monday_from; ?>-<?php echo $vs->friday_to; ?></label>
                                                <label class="list-label col-sm-6">Sat-Sun: </label><label class="list-label col-sm-6"><?php echo $vs->saturday_from; ?>-<?php echo $vs->sunday_to; ?></label>
                                                <div><a href="/reservation_tabel/<?php echo $vs->id; ?>" class="list-button">Go to tables <i class="fa fa-angle-right"></i></a></div>
                                        </div>
                                    </div>
                                  </div>
                              </div>
                              
                            <?php endforeach; ?>
                              