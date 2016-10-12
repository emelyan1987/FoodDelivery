<?PHP
  $this->load->view("includes/Customer/header"); 
  $this->load->helper('customer_helper');
  foreach($restroInfo as $re => $ES) :

 
  ?>

  <style>
            .nav-pills > li.active > a > .menuListImg {
                margin: -8px 8px -8px -8px;
                background: #FF8205;
            }
            .menuTitle{
                background: #FF8205;
            }
            .menuListIcon{
                color: #FF8205;
            }
            .roundedOneOrange label:after{
                background: #FF8205;
            }
            .blueBorder{
                border-bottom: 4px solid #FF8205;
            }
            .selectLocation {
                border-color: #FF8205 !important;
                color: #FF8205;
            }
            .list-button {
                background: #fff;
                color: #FF8205;
                border: 2px solid #FF8205;
            }
			.carousel-inner {
				position: relative;
				width: 65%;
				overflow: hidden;
				margin: 0px auto;
			}
            .carousel-inner .item .col-md-4 a {
				padding: 0px; 
				display: inline-block;
				width: 100%;
				padding-left: 15px; 

			}
        </style>
<div class="container-fluid">
            <div class="margin20"></div>
            <div class="row">
                <div class="col-md-3">
                    <div class="searchBox">
                        <a href="/catering_filter/"><h4><i class="fa fa-angle-left"></i> Back to restaurant list</h4></a>
                    </div>
                    <div class="row">
                        <div class="col-sm-3 col-md-3">
                            <?php 
                            if($ES->status == 1){
                                $stl = 'class="opened"';
                                $status_title = "Open";
                            }
                            elseif($ES->status == 2)
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
                        <div class="col-sm-12 col-md-12">
                            <?php
                            $restro_img = get_restro_allImage($ES->id);
                            foreach($restro_img as $ResImg => $resimg):

                            ?>
                            <div class="col-xs-3">
                                <br>
                            <img class="img-responsive" alt="" src="<?php if($resimg->restro_images != ''){  getImagePath($resimg->restro_images); } ?>" >
                            </div>
                            <?php
                            endforeach;
                            ?>
                            
                           

                            

                        </div>
                        <div class="col-sm-12">
                            <h4 class="text-center"><?php echo ucwords($ES->restro_name); ?></h4>
                        </div>
                        <div class="col-sm-12">
                            <label class="list-label">Min. Order:</label>
                            <label class="list-data">&nbsp;KD <?php echo $ES->RestroMin; ?></label>
                            
                            
                            <label class="list-label">Delivery Time:</label>
                            <label class="list-data">&nbsp;<?php if($ES->order_days != 0){ echo $ES->order_days."Day "; } ?><?php if($ES->order_hour != 0){ echo $ES->order_hour."Hour "; } ?>
                                                <?php if($ES->order_minitue != 0){ echo $ES->order_minitue."Min. "; } ?><?php //if($ES->order_second != 0){ echo $ES->order_second."Sec. "; } ?> </label>
                            <label class="list-label">Payment:</label>
                            <label class="list-data">&nbsp;<?php 
                                                $payArray = explode(',',$ES->method_type); 
                                                if(in_array(1,$payArray))
                                                {
                                                    echo '<img class="" alt="" src="/assets/Customer/img/cash.png">';
                                                }
                                                if(in_array(2,$payArray))
                                                {
                                                    echo '<img class="" alt="" src="/assets/Customer/img/knet.png">';
                                                }
                                                if(in_array(3,$payArray))
                                                {
                                                    echo '<img class="" alt="" src="/assets/Customer/img/card.png">';
                                                }
                                                if(in_array(4,$payArray))
                                                {
                                                    echo '<img class="" alt="" src="/assets/Customer/img/paypal.png">';
                                                }
                                                ?></label>
                            
                            <div class="ratings">
                                 <?php 

                                                   $ratArray = getRestroRatingValues($ES->id);
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
                            <a href="/restaurant_rating/<?php echo $ES->id ?>">Put Your Review</a>
                            <div>
                                <img src="/assets/Customer/img/icon/love.png" alt="">
                                <img src="/assets/Customer/img/icon/bow.png" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="margin20"></div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="menuTitle">
                                Menu
                            </div>
                            <ul class="nav nav-pills nav-stacked newTabStyle">
                                <li class="active">
                                    <a href="/catering_restaurant/<?php echo $ES->id; ?>" aria-expanded="true">
                                        <img class="menuListImg" src="/assets/Customer/img/icon/smallLogoCss.png">
                                        <span class="menuListTitle">All</span>
                                        <span class="menuListIcon"><i class="fa fa-angle-right"></i></span>
                                    </a>
                                </li>
                                <?php
                                $i = 1;
                                foreach($restroCat as $res_cat => $cat_id)
                                {
                                ?>
                                
                                <li onclick='datafetchbycat("<?php echo $cat_id->category_id; ?>");'>
                                    <a data-toggle="tab" href="#tab<?php echo $cat_id->id; ?>" aria-expanded="true">
                                        <img class="menuListImg" src="/assets/Customer/img/icon/smallLogoCss.png">
                                        <span class="menuListTitle"><?php get_itemcatName($cat_id->category_id); ?></span>
                                        <span class="menuListIcon"><i class="fa fa-angle-right"></i></span>
                                    </a>
                                </li>
                                <?php
                                $i++;
                                }
                                ?>
                               
                            </ul>

                            <input type="hidden" id="restroID" value="<?php echo $ES->id; ?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <h3 class="col-md-12"><?php echo ucwords($ES->restro_name); ?></h3>
                    
                    
                        <!--<?php    foreach($advt as $ad => $adm) :    ?>  
                        <div class="main_fourth">
                            <img class="img-thumbnail" src="<?php getImagePath($adm->image); ?>"> 
                        </div>
                       
                      <?php     endforeach;    ?>-->   
                        
                        
                            <div id="myCarousel" class="carousel fdi-Carousel slide">
                     <!-- Carousel items -->
                        <div class="carousel fdi-Carousel slide" id="eventCarousel" data-interval="0">
                            <div class="carousel-inner onebyone-carosel">
                                <div class="item active">
                                     <?php 
$i1 = 0;
$i2 = 0;
$i3 = 0;
                                        foreach($advt1 as $ad => $adm) :    $i1 = 1; ?>  
                                    
                                    <div class="col-md-4 text-center">
                                        <a href="#"><img src="<?php getImagePath($adm->image); ?>" class="img-responsive center-block"></a>
                                    </div>
                                   
                                    <?php     endforeach;    ?>  

                                    
                                </div>
                                <div class="item">
                                    <?php    foreach($advt2 as $ad => $adm) :  $i2 = 1;  ?>  
                                    
                                    <div class="col-md-4 text-center">
                                        <a href="#"><img src="<?php getImagePath($adm->image); ?>" class="img-responsive center-block"></a>
                                    </div>
                                   
                                    <?php     endforeach;    ?>  
                                </div>
                                <div class="item">
                                    <?php    foreach($advt3 as $ad => $adm) : $i3 = 1;   ?>  
                                    
                                    <div class="col-md-4 text-center">
                                        <a href="#"><img src="<?php getImagePath($adm->image); ?>" class="img-responsive center-block"></a>
                                    </div>
                                   
                                    <?php     endforeach;    ?>  
                                </div>
                                
                            </div>
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                                <?php
                                if($i1 == 1){
                                ?>
                                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                <?php
                                }

                                if($i2 == 1)
                                {
                                ?>
                                <li data-target="#myCarousel" data-slide-to="1"></li>
                                <?php
                                }

                                if($i3 == 1)
                                {
                                ?>
                                <li data-target="#myCarousel" data-slide-to="2"></li>
                                <?php
                                }

                                ?>
                              
                              
                              
                              
                            </ol>
                        </div>
                        <!--/carousel-inner-->
                    </div><!--/myCarousel-->
 
                    </div>
                    <div class="margin20"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="tab-content">
                                <div id="tab1" class="tab-pane fade active in">
                                    <div class="row">
                                        <?php
                                        foreach($restro_item as $it => $TE):
                                        ?>
                                        <div class="col-md-6">
                                            <div class="border">
                                                <div class="col-md-12">
                                                    <div class="col-md-6 col-sm-6">
                                                        <div class="row">
                                                            <img class="img-responsive img-menu" src="<?php if($TE->image != ''){  getImagePath($TE->image); }else{ echo '/assets/Customer/img/default_item.png'; } ?>" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <a href="/view_restro_catering/<?php echo $ES->id; ?>/<?php echo $TE->id; ?>" class="rest-link"><h4><?php echo ucwords($TE->item_name); ?></h4></a>
                                                        <p class="just"><?php echo $TE->item_description; ?></p>
                                                        <div class="menuList">
                                                            <span class="menuListPT"><?php echo $TE->loyalty_points; ?>pt</span>
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



                                </div>

                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>


        <div class="container-fluid"></div>

        <div class="advert">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <img class="img-responsive center-block" alt="" src="/assets/Customer/img/add.jpg">
                    </div>
                </div>
            </div>
        </div>
        <?php
        endforeach;
        ?>
<?PHP
  $this->load->view("includes/Customer/footer"); 
?>       
        
   
<script>
    function datafetchbycat(str){
        var item_cat = str;
        var restro_id = document.getElementById("restroID").value;
        $.ajax({

        url: "/ajax_show_item_by_cat/",
        type: "post",
        data: {ids:item_cat,restro_id:restro_id,act:'CATERING'} ,
        success: function (response) {
            $("#tab1").html(response);
        }
        })
    }
    
</script>