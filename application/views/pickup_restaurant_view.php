<?PHP
$this->load->view("includes/Customer/header");
$this->load->helper('customer_helper');
foreach ($restroInfo as $re => $ES):
?>
<style>
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
  .list_data{
    text-align: right !important;   }
    .item-desc{
      position: relative;
      min-height: 150px;
    }
    .menuList{
      position: absolute;
      bottom: 0;
      right: 0;
    }
    .res-logo{
      width: 150px;
      height: 150px;
      text-align: center;
      margin: 10px auto;
    }
        .nav-pills > li.active > a > .menuListImg {
        margin: -8px 8px -8px -8px;
        background: #2793FF;
    }
    .menuTitle{
        background: #2793FF;
    }
    .menuListIcon{
        color: #2793FF;
    }
    .roundedOneBlue label:after{
        background: #2793FF;
    }
    .blueBorder{
        border-bottom: 4px solid #2793FF;
    }
    .selectLocation {
        border-color: #2793FF !important;
        color: #2793FF;
    }
    .list-button {
        background: #fff;
        color: #2793FF;
        border: 2px solid #2793FF;
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
      <div class="col-md-3">
        <div class="searchBox">
          <a href="/pickup_filter/"><h4><i class="fa fa-angle-left"></i> Back to restaurant list</h4></a>
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
          <div class="col-sm-12">
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
            <label class="list-label">Min. Order:</label>
            <label class="list-data">&nbsp;KD <?php echo number_format($ES->RestroMin, 3);?></label>
            <label class="list-label">Delivery Time:</label>
            <label class="list-data">&nbsp;<?php if ($ES->order_days != 0) {echo $ES->order_days . " Day ";}
?><?php if ($ES->order_hour != 0) {echo $ES->order_hour . " Hour ";}
?>
              <?php if ($ES->order_minitue != 0) {echo $ES->order_minitue . " Min. ";}
?><?php //if($ES->order_second != 0){ echo $ES->order_second."Sec. "; } ?></label>
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
            <div class="col-sm-12">
              <div class="menuTitle">
                Menu
              </div>
              <ul class="nav nav-pills nav-stacked newTabStyle">
                <li class="active">
                  <a href="/pickup_restaurant/<?php echo $ES->id;?>" aria-expanded="true">
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
              <input type="hidden" id="restroID" value="<?php echo $ES->id;?>">
            </div>
          </div>
        </div>
        <div class="col-md-9">
          <div class="row">
        <!-- <?php foreach ($advt as $ad => $adm): ?>
        <div class="main_fourth">
          <img class="img-thumbnail" src="<?php getImagePath($adm->image);?>">
        </div>
      <?php endforeach;?>   -->
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
    <div class="col-md-12">
      <div class="tab-content">
        <div id="tab1" class="tab-pane fade active in">
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
                    <a href="/view_restro_pickup/<?php echo $ES->id;?>/<?php echo $TE->id;?>" class="rest-link"><h4><?php echo ucwords($TE->item_name);?></h4></a>
                    <p class="just"><?php echo $TE->item_description;?></p>
                    <div class="menuList">
                      <span class="menuListPT"><?php echo $TE->loyalty_points;?>pt</span>
                      <span class="menuListPrice">KD <?php echo number_format($TE->item_price, 3);?></span>
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
      data: {ids:item_cat,restro_id:restro_id,act:'DELIVERY'} ,
      success: function (response) {
        $("#tab1").html(response);
      }
    })
  }
</script>
<!--review code.............................................-->
<div class="modal fade" id="reviewModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Put Your Review With Us</h4>
      </div>
      <div class="modal-body">
        <INPUT type="HIDDEN" ID="restro_id" name="restro_id" value="<?PHP echo $this->uri->segment(2);?>">
          <INPUT type="HIDDEN" id="rating_value_id" >
            <fieldset class="rating">
              <legend>Please rate:</legend>
              <input type="radio" id="star5" name="rating" value="5" /><label for="star5" onClick="get_starRating(this.id)" id="star5" title="Rocks!">5 stars</label>
              <input type="radio" id="star4" name="rating" value="4"  /><label for="star4" onClick="get_starRating(this.id)" id="star4" title="Pretty good">4 stars</label>
              <input type="radio" id="star3" name="rating" value="3" /><label for="star3" onClick="get_starRating(this.id)" id="star3" title="Good">3 stars</label>
              <input type="radio" id="star2" name="rating" value="2" /><label for="star2" onClick="get_starRating(this.id)" id="star2" title="Average">2 stars</label>
              <input type="radio" id="star1" name="rating" value="1" /><label for="star1" onClick="get_starRating(this.id)" id="star1" title="Poor">1 star</label>
            </fieldset>
            <span id="ratingMsg"></span>
            <br>
            <br><br><br>
            <br>
            <div class="form-group">
              <label for="email">Email address:</label>
              <input type="email" name="email" class="form-control" id="email">
              <span id="emailMsg"></span>
            </div>
            <div class="form-group">
              <label for="name">Name:</label>
              <input type="text" class="form-control" id="name" name="name">
              <span id="nameMsg"></span>
            </div>
            <div class="form-group">
              <label for="msg">Reviews:</label>
              <textarea name="msg" id="msg" class="form-control" ></textarea>
              <span id="msgMsg"></span>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" onClick="add_review()" class="btn btn-primary">Submit</button>
          </div>
        </div>
      </div>
    </div>
    <script>
      function get_starRating(id)
      {
        $("#rating_value_id").val($("#"+id).val());
      }
      function add_review()
      {
        var name=$("#name").val();
        var email=$("#name").val();
        var msg=$("#msg").val();
        var restro_id=$("#restro_id").val();
        var star_value=$("#rating_value_id").val();
        if(name=="")
        {
          $("#nameMsg").text("Please Enter your name");
          $("#nameMsg").css("color","red");
        }
        else if(email=="")
        {
          $("#emailMsg").text("Please Enter Email address");
          $("#emailMsg").css("color","red");
        }
        else if(msg=="")
        {
          $("#msgMsg").text("Please Enter Msg");
          $("#msgMsg").css("color","red");
        }
        else if(star_value=="")
        {
          $("#ratingMsg").text("Please Vote");
          $("#ratingMsg").css("color","red");
        }
        else
        {
          $.ajax({
            method:"post",
            url:"/put_rating/",
            data:{name:name,email:email,msg:msg,restro_id:restro_id,star_value:star_value},
            success:function(response)
            {
              alert("Your Review Submitted successfully...");
            }
          });
        }
      }
    </script>
    <style>
      .rating {
        float:left;
      }
  /* :not(:checked) is a filter, so that browsers that don’t support :checked don’t
  follow these rules. Every browser that supports :checked also supports :not(), so
  it doesn’t make the test unnecessarily selective */
  .rating:not(:checked) > input {
    position:absolute;
    top:-9999px;
    clip:rect(0,0,0,0);
  }
  .rating:not(:checked) > label {
    float:right;
    width:1em;
    padding:0 .1em;
    overflow:hidden;
    white-space:nowrap;
    cursor:pointer;
    font-size:200%;
    line-height:1.2;
    color:#ddd;
    text-shadow:1px 1px #bbb, 2px 2px #666, .1em .1em .2em rgba(0,0,0,.5);
  }
  .rating:not(:checked) > label:before {
    content: '? ';
  }
  .rating > input:checked ~ label {
    color: #ea0;
    text-shadow:1px 1px #c60, 2px 2px #940, .1em .1em .2em rgba(0,0,0,.5);
  }
  .rating:not(:checked) > label:hover,
  .rating:not(:checked) > label:hover ~ label {
    color: gold;
    text-shadow:1px 1px goldenrod, 2px 2px #B57340, .1em .1em .2em rgba(0,0,0,.5);
  }
  .rating > input:checked + label:hover,
  .rating > input:checked + label:hover ~ label,
  .rating > input:checked ~ label:hover,
  .rating > input:checked ~ label:hover ~ label,
  .rating > label:hover ~ input:checked ~ label {
    color: #ea0;
    text-shadow:1px 1px goldenrod, 2px 2px #B57340, .1em .1em .2em rgba(0,0,0,.5);
  }
  .rating > label:active {
    position:relative;
    top:2px;
    left:2px;
  }
</style>