<div id="tab1" class="tab-pane fade in active">
                                      <h3>Coupons</h3>

                                    <?php foreach($coupons_list as $ks => $vs): ?>
                                      <div class="margin20"></div>
                                      <div class="row">
                                          <div class="col-md-12">
                                            <div class="border">
                                                <div class="col-md-4">
                                                    <div class="col-sm-4 col-md-4">
                                                        <?php 
                                                        
                                                            $stl = 'class="opened"';
                                                            $status_title = "Open";
                                                      
                                                         ?>
                                                       
                                                    </div>
                                                    <div class="col-sm-6 col-md-6">
                                                        
                                                        <img class="img-responsive resimg" alt="" src="/assets/Customer/img/icon/bottomIcon2.png"  width="100" height="100">
                                                        

                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <a href="/restaurant_view/<?php echo $vs->id; ?>"><h4 class="restrotitle"></h4></a>
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
                                                    <label class="list-label">Coupon Code: <?php echo $vs->coupon_code; ?></label>
                                                    <label class="list-data">&nbsp;Validity <?php echo $vs->to_date; ?></label>
                                                    <br>
                                                    <label class="list-label">Discount: <?php echo $vs->discount; ?></label>
                                                    <br>
                                                    <label class="list-label">Location: <?php echo $vs->location_id; ?></label>
                                                    <label class="list-data">&nbsp;
                                                   
                                                       

                                                    </label>
                                                    
                                                </div>
                                            </div>
                                          </div>
                                      </div>

                                    <?php endforeach; ?>


                                      </div>