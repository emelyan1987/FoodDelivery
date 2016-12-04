<?PHP
    $this->load->view("includes/Customer/header");
    $this->load->helper('customer_helper');
    foreach ($restroInfo as $re => $ES):
        $item_cat = explode(',', $ES->category_id);
    ?>
    <style>
        .nav-pills > li.active > a > .menuListImg {
            margin: -8px 8px -8px -8px;
            background: #D31E03;
        }
        .menuTitle{
            background: #D31E03;
        }
        .menuListIcon{
            color: #D31E03;
        }
        .roundedOneRed label:after{
            background: #D31E03;
        }
        .blueBorder{
            border-bottom: 4px solid #D31E03;
        }
        .selectLocation {
            border-color: #D31E03 !important;
            color: #D31E03;
        }
        .list-button {
            background: #fff;
            color: #D31E03;
            border: 2px solid #D31E03;
        }
        .carousel-inner .item .col-md-4 a {
            padding: 0px;
            display: inline-block;
            width: 60%;
            padding-left: 15px;
        }
    </style>
    <div class="container-fluid">
        <div class="margin20"></div>
        <div class="row">
            <div class="col-md-3 col-sm-12">
                <div class="searchBox">
                    <a href="/filter?service=3"><h4><i class="fa fa-angle-left"></i> Back to restaurant list</h4></a>
                </div>
                <div class="row">
                    <div class="col-sm-3 pull-right">
                        <?php
                            if ($ES->status == 1) {
                                $stl = 'class="opened"';
                                $status_title = "Open";
                            } elseif ($ES->status == 2) {
                                $stl = 'class="busy"';
                                $status_title = "Busy";
                            } else {
                                $stl = 'class="close"';
                                $status_title = "Close";
                            }
                        ?>
                        <span <?php echo $stl;?>></span> <?php echo $status_title;?>
                    </div>
                    <div class="col-sm-12">
                        <img class="img-responsive res-logo" alt="" src="<?php if ($ES->restaurant_logo != '') {getImagePath($ES->restaurant_logo);}
                            ?>">
                    </div>
                    <br>
                    <div class="col-sm-12 col-md-12">
                        <?php
                            $restro_img = get_restro_allImage($ES->id);
                            foreach ($restro_img as $ResImg => $resimg):
                            ?>
                            <div class="col-xs-3">
                                <br>
                                <img class="img-responsive" alt="" src="<?php if ($resimg->restro_images != '') {getImagePath($resimg->restro_images);}
                                    ?>" >
                            </div>
                            <?php
                                endforeach;
                        ?>



                    </div>
                    <div class="col-sm-12">
                        <h4 class="text-center"><?php echo ucwords($ES->restro_name);?></h4>
                    </div>
                    <div class="col-sm-12">
                        <labe><?php echo $ES->restro_description;?></label>

                        <label class="list-label">Payment:</label>
                        <label class="list-data">&nbsp;<?php
                                $payArray = explode(',', $ES->method_type);
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
                        <div class="ratings">
                            <?php
                                $ratArray = getRestroRatingValues($ES->id);
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


                            <label><?php echo $ratArray['rating_num'];?> reviews</label>
                        </div>
                        <a href="/restaurant_rating/<?php echo $ES->id?>">Put Your Review</a>
                        <div>
                            <?php if ($ES->restro_status == 1): ?>
                                <img src="/assets/Customer/img/icon/love.png" alt="">
                                <?php endif?>
                            <?php if ($ES->promotion != ""): ?>
                                <img src="/assets/Customer/img/icon/bow.png" alt="">
                                <?php endif?>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="margin20"></div>
                <div class="row">
                    <!--<div class="col-sm-12">
                    <div class="menuTitle">
                    Menu
                    </div>
                    <ul class="nav nav-pills nav-stacked newTabStyle">
                    <li class="active">
                    <a href="/reservation_tabel/<?php echo $ES->id;?>" aria-expanded="true">
                    <img class="menuListImg" src="/assets/Customer/img/icon/smallLogoCss.png">
                    <span class="menuListTitle">All</span>
                    <span class="menuListIcon"><i class="fa fa-angle-right"></i></span>
                    </a>
                    </li>
                    <?php
                        $i = 1;
                        foreach ($restroCat as $res_cat => $cat_id) {
                        ?>

                        <li onclick='datafetchbycat("<?php echo $cat_id->category_id;?>");'>
                        <a data-toggle="tab" href="#tab<?php echo $cat_id->id;?>" aria-expanded="true">
                        <img class="menuListImg" src="/assets/Customer/img/icon/smallLogoCss.png">
                        <span class="menuListTitle"><?php get_itemcatName($cat_id->category_id);?></span>
                        <span class="menuListIcon"><i class="fa fa-angle-right"></i></span>
                        </a>
                        </li>
                        <?php
                            $i++;
                        }
                    ?>

                    </ul>

                    </div>-->
                    <input type="hidden" id="restroID" value="<?php echo $ES->id;?>">
                </div>
            </div>
            <div class="col-md-9">
                <div class="row">

                    <!--<?php foreach ($advt as $ad => $adm): ?>
                        <div class="main_fourth">
                        <img class="img-thumbnail" src="<?php getImagePath($adm->image);?>">
                        </div>

                        <?php endforeach;?> -->
                    <div id="myCarousel" class="carousel fdi-Carousel slide">
                        <!-- Carousel items -->
                        <div class="carousel fdi-Carousel slide" id="eventCarousel" data-interval="0">
                            <div class="carousel-inner onebyone-carosel">
                                <div class="item active">
                                    <?php
                                        $i1 = 0;
                                        $i2 = 0;
                                        $i3 = 0;
                                        foreach ($advt1 as $ad => $adm): $i1 = 1;?>

                                        <div class="col-md-4 text-center">
                                            <a href="#"><img src="<?php getImagePath($adm->image);?>" class="img-responsive center-block"></a>
                                        </div>

                                        <?php endforeach;?>

                                </div>
                                <div class="item">
                                    <?php foreach ($advt2 as $ad => $adm): $i2 = 1;?>

                                        <div class="col-md-4 text-center">
                                            <a href="#"><img src="<?php getImagePath($adm->image);?>" class="img-responsive center-block"></a>
                                        </div>

                                        <?php endforeach;?>
                                </div>
                                <div class="item">
                                    <?php foreach ($advt3 as $ad => $adm): $i3 = 1;?>

                                        <div class="col-md-4 text-center">
                                            <a href="#"><img src="<?php getImagePath($adm->image);?>" class="img-responsive center-block"></a>
                                        </div>

                                        <?php endforeach;?>
                                </div>

                            </div>
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                                <?php
                                    if ($i1 == 1) {
                                    ?>
                                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                    <?php
                                    }
                                    if ($i2 == 1) {
                                    ?>
                                    <li data-target="#myCarousel" data-slide-to="1"></li>
                                    <?php
                                    }
                                    if ($i3 == 1) {
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
                    <div class="tab-content">
                        <div id="tab1" class="tab-pane fade active in">
                            <div class="row">
                                <?php
                                    foreach ($restro_tables as $it => $TE):
                                    ?>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="border" style="background: url('/assets/Customer/img/table2.jpg'); background-size: cover; min-height:200px;">
                                            <div class="col-md-12">
                                                <h2 class="text-center"><?php echo ucwords($TE->table_no);?></h2>
                                            </div>
                                            <div class="margin20"></div>
                                            <div class="col-md-12 col-sm-12">
                                                <div class="col-sm-6 col-xs-6 text-center">
                                                    <h4>User Limit </h4>
                                                    <h4><?php echo $TE->user_limit;?></h4>
                                                </div>
                                                <div class="col-sm-6 col-xs-6 text-center">
                                                    <h4>Availability</h4>
                                                    <a class="btn btn-danger" href="/reservation_checkout/<?php echo $ES->id;?>/<?php echo $TE->id;?>" >Available</a>
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
    /*function datafetchbycat(str){
    var item_cat = str;
    var restro_id = document.getElementById("restroID").value;
    $.ajax({
    url: "/ajax_show_item_by_cat/",
    type: "post",
    data: {ids:item_cat,restro_id:restro_id,act:'TABLE'} ,
    success: function (response) {
    $("#tab1").html(response);
    }
    })
    }*/

</script>