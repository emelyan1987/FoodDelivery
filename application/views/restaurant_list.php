<?PHP
    $this->load->view("includes/Customer/header");

    if($_SESSION['filter_service'] == 1) {
        $borderClass = "greenBorder";
        $bulletinIcon = "/assets/Customer/img/icon/smallLogo.png";
        $color = "#73B720";
    } else if($_SESSION['filter_service'] == 2) {
        $borderClass = "orangeBorder";
        $bulletinIcon = "/assets/Customer/img/icon/smallLogoOrange.png";
        $color = "#FF8205";
    } else if($_SESSION['filter_service'] == 3) {
        $borderClass = "redBorder";
        $bulletinIcon = "/assets/Customer/img/icon/smallLogoRed.png";
        $color = "#D31E03";
    } else if($_SESSION['filter_service'] == 4) {
        $borderClass = "blueBorder";
        $bulletinIcon = "/assets/Customer/img/icon/smallLogoBlue.png";
        $color = "#2793FF";
    }
?>
<style>
    .greenBorder{
        border-bottom: 4px solid #73B720;
    }
    .blueBorder{
        border-bottom: 4px solid #2793FF;
    }
    .orangeBorder{
        border-bottom: 4px solid #FF8205;
    }
    .redBorder{
        border-bottom: 4px solid #D31E03;
    }
    .roundedOne label:after{
        background: <?php echo $color;?>;
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
    .less10{
        margin-top:-23px;;
    }
    .list-button {
        background-color: <?php echo $color;?>;
        border-color: <?php echo $color;?>;
        border-radius: 0 !important;
        box-shadow: 0 -24px 0 rgba(0, 0, 0, 0.10) inset;
        color: #fff !important;
        font-family: "Ubuntu","Ubuntu Beta",UbuntuBeta,Ubuntu,"Bitstream Vera Sans","DejaVu Sans",Tahoma,sans-serif;
        font-weight: normal;
        padding: 16px 0;
        text-transform: capitalize;
        font-size: 13px !important;
        width: 160px;
        text-align: center;
        margin: 15px 0 0 0px;
        display: inline-block;
    }
    .fa.fa-angle-right {
        color: #ffffff !important;
    }
    .rating-view {
        display: inline-block;
    }
    /*.select2-container--classic .select2-selection--single {
    background-color: #73b720;
    /* border: 1px solid #aaa;
    border-radius: 0px !important;
    outline: 0;
    color: #fff;
    background-image: -webkit-linear-gradient(to bottom, #7ed810 50%, #73b720 49%);
    background-image: -o-linear-gradient(to bottom, #7ed810 50%, #73b720 49%);
    background-image: linear-gradient(to bottom, #7ed810 50%, #73b720 49%);
    background-repeat: repeat-x;
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#FFFFFFFF', endColorstr='#FFEEEEEE', GradientType=0);
    }*/
</style>
<div class="container-fluid">
    <div class="margin20"></div>
    <div class="row">
        <div class="col-md-3">
            <div class="searchBox">
                <span class="mySearchBoxIcon"><i class="fa fa-search"></i></span>
                <input type="search" class="searchInput" placeholder="Search Restaurant" onkeyup="SearchRestro(this.value)" >
                <div class="mySelectionDiv1" id="restroShowDiv">

                </div>
            </div>
            <div class="filterHeader">
                <img src="<?php echo $bulletinIcon;?>" alt="">
                <span>Filters</span>
            </div>
            <div class="<?php echo $borderClass;?>"></div>
            <ul class="filterList">
                <li>
                    <div class="roundedOne">
                        <input type="radio" value="all"  onClick="searchRestros()" id="roundedOne" class="myCheckBox1" name="kind" checked='checked'/>
                        <label for="roundedOne"><span>All</span></label>
                    </div>
                </li>
                <li>
                    <div class="roundedOne">
                        <input type="radio" value="featured" onClick="searchRestros()" id="roundedOne1" class="myCheckBox2" name="kind"/>
                        <label for="roundedOne1"><span>Featured</span></label>
                    </div>
                </li>
                <li>
                    <div class="roundedOne">
                        <input type="radio" value="promotion" onClick="searchRestros()" id="roundedOne2" name="kind" />
                        <label for="roundedOne2"><span>Promotion</span></label>
                    </div>
                </li>
                <li>
                    <div class="roundedOne">
                        <input type="radio" value="ratings" onClick="searchRestros()" id="roundedOne3" name="kind"/>
                        <label for="roundedOne3"><span>Ratings</span></label>
                    </div>
                </li>
            </ul>
            <div class="<?php echo $borderClass;?>"></div>
            <div class="margin20"></div>
            <div class="filterHeader">
                <img src="<?php echo $bulletinIcon;?>" alt="">
                <span>Filter By Cuisine</span>
            </div>
            <div class="<?php echo $borderClass;?>"></div>
            <ul class="filterList">
                <?php
                    foreach ($cuisin_list as $cu => $ui):
                    ?>

                    <li>
                        <div class="roundedOne">
                            <input type="checkbox" value="<?php echo $ui->id;?>" onClick="searchRestros()" id="cusine-checkbox-<?php echo $ui->id;?>" name="check<?php echo $ui->id;?>" class="cusine-checkbox" />
                            <label for="cusine-checkbox-<?php echo $ui->id;?>"><span><?php echo $ui->name;?></span></label>
                        </div>
                    </li>
                    <?php
                        endforeach;
                ?>

                <input type="hidden" id="hiddenCuisineId" >
            </ul>
            <div class="<?php echo $borderClass;?>"></div>
            <div class="margin20"></div>
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
            <!--<div class="margin20"></div>-->
            <div>
                <div class="row less10">
                    <div class="col-md-12">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <div class="col-md-offset-4 col-md-4">
                                    <form action="/filter?service=<?php echo $_SESSION["filter_service"];?>" method="post">
                                        <select id="area-select" class="form-control btn-success-newone selectLocation" name="filter_area" onchange="submit()">
                                            <option value="0">Need to change location?</option>
                                            <?php
                                                foreach ($city as $ct => $it):
                                                ?>
                                                <option value="<?php echo $it->id;?>" <?php if($_SESSION["order_area_id"]==$it->id) echo "selected"; ?>><?php echo ucwords($it->name) . " , " . ucwords($it->city_name);?></option>
                                                <?php
                                                    endforeach;
                                            ?>
                                        </select>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="text-center"><span class="bg-white">Changed your Mind ? Just click a different category<span></h4>
                        <div class="tabBorderTop"></div>
                        <ul class="nav nav-tabs nav-justified myTabs restrotab" id="mind">
                            <?php
                                $k = 1;
                                foreach ($service_list as $a => $b) {
                                    if ($k == 1) {
                                        $cls_service = 'class="tab-icon"';
                                    }
                                    if ($k == 2) {
                                        $cls_service = 'class="tab-icon1"';
                                    }
                                    if ($k == 3) {
                                        $cls_service = 'class="tab-icon3"';
                                    }
                                    if ($k == 4) {
                                        $cls_service = 'class="tab-icon2"';
                                    }
                                ?>

                                <li <?php if ($b->id == $_SESSION['filter_service']) {?>class="active" <?php }
                                    ?> ><a data-toggle="tab" href="#tab1" onclick='myservicefun("<?php echo $b->id;?>");'>
                                    <span <?php echo $cls_service;?> ></span> <?php echo $b->cat_name;?></a></li>
                                <?php
                                    $k++;
                                }
                            ?>
                        </ul>
                        <div class="tabBorderBottom"></div>
                        <div class="tab-content"  id="copp">
                            <div id="restro-list" class="tab-pane fade in active">

                            </div>
                        </div>
                        <div id="tab2" class="tab-pane fade">
                            <h3>Results for City,Area</h3>
                        </div>
                        <div id="tab3" class="tab-pane fade">
                            <h3>Results for City,Area</h3>
                        </div>
                        <div id="tab4" class="tab-pane fade">
                            <h3>Results for City,Area</h3>
                        </div>
                    </div>
            </div>  </div>
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
<?PHP
    $this->load->view("includes/Customer/footer");
?>


<script id="restroTemplate" type="text/x-jQuery-tmpl">
    <div class="margin20"></div>
    <div class="row">
    <div class="col-md-12">
    <div class="border">
    <div class="col-md-4">
    <div class="col-sm-4 col-md-4">

    <span class="${statusClass(status)}">${statusTitle(status)}</span> 
    </div>
    <div class="col-sm-6 col-md-6">
    <a href="/restaurant_profile/${restro_id}"><img class="img-responsive resimg" alt="" src="${restroLogoPath(restro_logo)}" > </a>
    </div>
    </div>
    <div class="col-md-4 col-sm-12">
    <a href="/restaurant_profile/${restro_id}"><h4 class="restrotitle">${restro_name}</h4></a>
    <div class="ratings"> 
    <div class="rating-view"></div>
    <label>${reviews} reviews</label>
    </div>
    {{if slots}}
    <div class="row">
    {{each slots}}
    <div class="col-sm-2" style="margin-bottom: 10px;padding-right: 0; color:#73b720;"><a href="/reservation_checkout/${restro_id}" class="btn btn-danger fullw">${time}</a>${seating_info.point}pt</div>
    {{/each}}
    </div>
    {{/if}}

        <div class="restroheart">
        {{if restro_state==1}}<img src="/assets/Customer/img/icon/love.png" alt="">{{/if}}
    {{if promo_id}}<img src="/assets/Customer/img/icon/bow.png" alt="">{{/if}}
    </div>
    </div>
    <div class="col-md-4">
    {{if service_type!=3}}
    <label class="list-label">Min. Order:</label>
    <label class="list-data">&nbsp;${formatPrice(min_order)}</label>
    <br>
    <label class="list-label">Delivery Time:</label>
    <label class="list-data">&nbsp;${order_time} Min.</label>
    <br>
    {{/if}}
    <label class="list-label">Payment:</label>
    {{if hasPaymentOption(payment_method, "1")}}<img class="" alt="" src="/assets/Customer/img/cash.png">{{/if}}
    {{if hasPaymentOption(payment_method, "2")}}<img class="" alt="" src="/assets/Customer/img/knet.png">{{/if}}
    {{if hasPaymentOption(payment_method, "3")}}<img class="" alt="" src="/assets/Customer/img/card.png">{{/if}}
    {{if hasPaymentOption(payment_method, "4")}}<img class="" alt="" src="/assets/Customer/img/paypal.png">{{/if}}
    <div>{{if service_type!=3}}<a href="/restaurant_view/${restro_id}/${location_id}" class="btn-success-newone list-button">Go to menu <i class="fa fa-angle-right"></i></a>{{/if}}</div>
    </div>
    </div>
    </div>
    </div>
</script>
</body>
</html>


<script src="/assets/Customer/js/jquery.tmpl.js" type="text/javascript"></script>
<script src="/assets/common/plugins/rating/jquery.rateyo.js" type="text/javascript"></script>
<script>

    function statusClass(status) {
        if(status == 1) return 'opened';
        else if(status == 2) return 'busy';
            else return 'close';
    }
    function statusName(status) {
        if(status == 1) return 'Open';
        else if(status == 2) return 'Busy';
            else return 'Close';
    }
    function restroLogoPath(restro_logo) {
        if(restro_logo) return '/images/'+restro_logo.split('/images/')[1];
        return '/assets/Customer/img/icon/bottomIcon2.png';
    }
    function formatPrice(price) {
        return "KD " + Number(price).toFixed(2);
    }
    function hasPaymentOption(payment_method, option) {
        if(payment_method == null) return false;

        var methods = payment_method.split(','); 
        if(methods.indexOf(option) > -1) return true;

        return false;
    }

    $(document).ready(function(){
        var restro_list = eval('<?php echo addslashes(json_encode($restro_list));?>'); 

        $("#restroTemplate").tmpl(restro_list).appendTo("#restro-list"); 

        $(".rating-view").each(function(index){           
            var rating = restro_list[index].rating; console.log(rating);
            $(this).rateYo({rating:rating?rating:0, starWidth:'24px', ratedFill:'#f1c40f'}); 
        });
    });
</script>

<script>
    function searchRestros(){
        var params = {};
        params.service_type = <?php echo $_SESSION['filter_service']; ?>;

        params.area = $("#area-select").val();        

        var cuisines = [];
        $(".cusine-checkbox").each(function() {
            if($(this).is('.cusine-checkbox:checked')) {
                cuisines.push($(this).val());
            }
        });
        params.cuisines = cuisines.join(',');

        params.kind = $("input:radio[name='kind']:checked").val(); console.log("Search restaurant params", params);
        $.ajax({
            url: "/api/restaurants",
            type: "get",
            data: params,
            success: function (response) {
                console.log('searchRestros',response);

                $("#restro-list").html('') ;
                if(response.code == 0) {
                    var restro_list = response.resource;
                    $("#restroTemplate").tmpl(restro_list).appendTo("#restro-list"); 

                    $(".rating-view").each(function(index){           
                        var rating = restro_list[index].rating;
                        $(this).rateYo({rating:rating?rating:0, starWidth:'24px', ratedFill:'#f1c40f'}); 
                    });
                }
            }
        })
    }
    function changeArea(area_id) {
        searchRestros();
    }
</script>


<script>
    function myservicefun(str){
        var cuineIds = document.getElementById('hiddenCuisineId').value;
        var act = '';
        if(str == 1)
        {
            act = "DELIVERY";
        }
        if(str == 2)
        {
            act = "CATERING";
        }
        if(str == 3)
        {
            act = "TABLE";
        }
        if(str == 4)
        {
            act = "PICKUP";
        }
        window.location.href = "http://mataam.net/home?ref="+act;

        // $.ajax({

        //     url: "/ajax_restaurants_fetch/",
        //     type: "post",
        //     data: {ids:str,act:act,cuineIds:cuineIds} ,
        //     success: function (response) {
        //         $("#tab1").html(response);
        //     }
        // })
    }

</script>



<script>

    function SearchRestro(abc){

        if(abc != "")
        {
            $("#restroShowDiv").show();

            $.ajax({

                url: "/search_restro_by_name/",
                type: "post",
                data: {textsearch:abc,urltype:1},
                success: function (response) {
                    $("#restroShowDiv").html(response);

                }
            })
        }
        else
        {
            $("#restroShowDiv").hide();
        }
    }
</script>


<script>
    if($('#roundedOne3').attr('checked')) {

        $("#mind").hide();
        //alert("hello");
        $.ajax({

            url: "/Home_coupon_filter/",
            type: "post",
            data: {filter_id: 4},
            success: function (response) {
                //alert(response);
                $("#copp").html(response);

            }
        })

    }
    $('.selectLocation').select2({
        theme:"classic"
    });

</script>

