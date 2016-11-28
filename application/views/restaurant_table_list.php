<?PHP
$this->load->view("includes/Customer/header");
?>
<style>
  .roundedOneRed label:after{
    background: #D31E03;
  }
  .blueBorder{
    border-bottom: 4px solid #D31E03;
  }
  .fullw{
    width: 100%;
  }
  .btn-danger {
    background-color: #d43939 !important;
    font-weight: bold;

  }
  .tableContainer{
    padding: 10px 0 10px 0;
        border-bottom: 2px solid #eee;
    clear: both;
    overflow: auto;}
  .selectLocation {
    border-color: #D31E03 !important;
    color: #D31E03;
  }
  .list-button {
    background: #fff;
    color: #D31E03;
    border: 2px solid #D31E03;
    margin: 15px 0 0 15px;
    display: inline-block;
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
    margin: 15px 0 0 15px;
    display: inline-block;
    background-color: #d31e03;
    border-color: #d31e03;
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
  }
  .l-label {
    font-size: 15px;
    font-weight: normal;
    float: left;
    color: #888;
  }
  .fa.fa-angle-right {
    color: #fff !important;
  }
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
        <img src="/assets/Customer/img/icon/smallLogoRed.png" alt="">
        <span>Filters</span>
      </div>
      <div class="blueBorder"></div>
      <ul class="filterList">
        <li>
          <div class="roundedOne roundedOneRed">
            <input type="checkbox" value="ALL"  onClick="checkCon1(this.id)" id="roundedOne" class="myCheckBox1" name="check" />
            <label for="roundedOne"><span>All</span></label>
          </div>
        </li>
        <li>
          <div class="roundedOne roundedOneRed">
            <input type="checkbox" value="2" onClick="checkCon1(this.id)" id="roundedOne1" class="myCheckBox2" name="check2" />
            <label for="roundedOne1"><span>Featured</span></label>
          </div>
        </li>
        <li>
          <div class="roundedOne roundedOneRed">
            <input type="checkbox" value="3" onClick="checkCon1(this.id)" id="roundedOne2" name="check3" />
            <label for="roundedOne2"><span>Promotion</span></label>
          </div>
        </li>
        <li>
          <div class="roundedOne roundedOneRed">
            <input type="checkbox" value="4" onClick="checkCon1(this.id)" id="roundedOne3" name="check4" />
            <label for="roundedOne3"><span>Ratings</span></label>
          </div>
        </li>
      </ul>
      <div class="blueBorder"></div>
      <div class="margin20"></div>
      <div class="filterHeader">
        <img src="/assets/Customer/img/icon/smallLogoRed.png" alt="">
        <span>Filter By Cuisine</span>
      </div>
      <div class="blueBorder"></div>
      <ul class="filterList">
        <?php
        foreach ($cuisin_list as $cu => $ui):
          ?>
        <li>
          <div class="roundedOne roundedOneRed">
            <input type="checkbox" value="<?php echo $ui->id;?>" onClick="checkCon(this.id)" id="rounded<?php echo $ui->id;?>" name="check<?php echo $ui->id;?>" class="cb" />
            <label for="rounded<?php echo $ui->id;?>"><span><?php echo $ui->name;?></span></label>
          </div>
        </li>
        <?php
        endforeach;
        ?>
        <input type="hidden" id="cusineIDS" >
      </ul>
      <div class="blueBorder"></div>
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
<div class="row less10">
  <div class="col-md-12">
    <div class="form-horizontal">
      <div class="form-group">
        <div class="col-md-offset-4 col-md-4">
          <select class="form-control selectLocation" onchange="citychange(this.value)">
            <option value="0">Need to change location?</option>
            <?php
            foreach ($city as $ct => $it):
              ?>
            <option value="<?php echo $it->id;?>" ><?php echo ucwords($it->name) . " , " . ucwords($it->city_name);?></option>
            <?php
            endforeach;
            ?>
          </select>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <h4 class="text-center"><span class="bg-white">Changed your Mind ? Just click a different category</span></h4>
    <div class="tabBorderTop"></div>
    <ul class="nav nav-tabs nav-justified myTabs">
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
        <li <?php if ($k == 3) {?>class="active" <?php }
          ?> ><a data-toggle="tab" href="#tab1" onclick='myservicefun("<?php echo $b->id;?>");'>
          <span <?php echo $cls_service;?>></span> <?php echo $b->cat_name;?></a></li>
          <?php
          $k++;
        }
        ?>
      </ul>
      <div class="tabBorderBottom"></div>
      <div class="tab-content">
        <?php foreach ($retro_list as $ks => $vs): ?>
          <div class="row">
          <div class="col-sm-12">
          <div class="tableContainer">
            <div class="col-sm-3">
            <p>
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
            </p>
            <?php
                      if ($vs->restaurant_logo != '') {
                        ?>
                        <img class="img-responsive resimg" alt="" src="<?php $img = explode('public_html', $vs->restaurant_logo);
                        echo $img[1];?>" style="width: 150px;height: 150px;margin: 0 auto">
                        <?php
                      } else {
                        ?>
                        <img style="width: 150px;height: 150px;margin: 0 auto" class="img-responsive resimg" alt="" src="/assets/Customer/img/icon/bottomIcon2.png">
                        <?php
                      }
                      ?>
                      <p class="text-center" style="margin-top: 6px;margin-bottom: 0">
                          <?php if ($vs->restro_status == 1): ?>
                             <img src="/assets/Customer/img/icon/love.png" alt="">
                          <?php endif?>
                          <?php if ($vs->promotion != ""): ?>
                             <img src="/assets/Customer/img/icon/bow.png" alt="">
                          <?php endif?>
                      </p>
            </div>
            <div class="col-sm-9">
              <a href="/reservation_tabel/<?php echo $vs->id;?>"><h4><?php echo ucwords($vs->restro_name);?></h4></a>
              <div class="ratings">
              <div class="row">
              <div class="col-md-10">
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
                      <?php }
                      ?>
                    <?php
                  } else {
                    ?>
                    <span>
                      <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                      <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                      <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                      <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                      <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                      <?php
                    }
                    ?>
                      </span>
                        <label style="line-height: 3"><?php echo $ratArray['rating_num'];?> reviews</label>
                        <label class="pull-right" style="margin-bottom: 0;line-height: 3">Deposit : <strong>KD 10.000</strong></label>
                  </div>
                  </div>
                  </div>
                  <div class="row">
                      <div class="col-sm-2" style="margin-bottom: 10px;padding-right: 0"><a href="/reservation_tabel/<?php echo $vs->id; ?>" class="btn btn-danger fullw">1:00</a></div>
                      <div class="col-sm-2" style="margin-bottom: 10px;padding-right: 0"><a href="/reservation_tabel/<?php echo $vs->id; ?>" class="btn btn-danger fullw">3:00</a></div>
                      <div class="col-sm-2" style="margin-bottom: 10px;padding-right: 0"><a href="/reservation_tabel/<?php echo $vs->id; ?>" class="btn btn-danger fullw">5:00</a></div>
                      <div class="col-sm-2" style="margin-bottom: 10px;padding-right: 0"><a href="/reservation_tabel/<?php echo $vs->id; ?>" class="btn btn-danger fullw">6:00</a></div>
                      <div class="col-sm-2" style="margin-bottom: 10px;padding-right: 0"><a href="/reservation_tabel/<?php echo $vs->id; ?>" class="btn btn-danger fullw">6:00</a></div>
                    </div>
                    <div class="row">
                      <div class="col-sm-10">
                    <h5 class="text-center" style="margin-top: 0">Happy hours</h5>
                        
                      </div> 
                    </div>
                     <div class="row">
                      <div class="col-sm-2" style="margin-bottom: 10px;padding-right: 0"><a href="/reservation_tabel/<?php echo $vs->id; ?>" class="btn btn-danger fullw">1:00</a></div>
                      <div class="col-sm-2" style="margin-bottom: 10px;padding-right: 0"><a href="/reservation_tabel/<?php echo $vs->id; ?>" class="btn btn-danger fullw">3:00</a></div>
                      <div class="col-sm-2" style="margin-bottom: 10px;padding-right: 0"><a href="/reservation_tabel/<?php echo $vs->id; ?>" class="btn btn-danger fullw">5:00</a></div>
                      <div class="col-sm-2" style="margin-bottom: 10px;padding-right: 0"><a href="/reservation_tabel/<?php echo $vs->id; ?>" class="btn btn-danger fullw">6:00</a></div>
                      <div class="col-sm-2" style="margin-bottom: 10px;padding-right: 0"><a href="/reservation_tabel/<?php echo $vs->id; ?>" class="btn btn-danger fullw">6:00</a></div>
                    </div>
                  </div>

                  </div>
                  </div>
                  </div><!-- table contianer end-->
                <?php endforeach;?>
                <!-- <div class="tabBorderTop" style="border-bottom: 2px solid #aaa;margin-top: 20px"></div> -->
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
      <?PHP
      $this->load->view("includes/Customer/footer");
      ?>
    </body>
    </html>
    <script>
      function checkCon(id)
      {
        if($('#'+id).attr('checked'))
        {
          $('#'+id).removeAttr('checked');
        }
        else
        {
          $('#'+id).attr('checked', 'checked');
        }
        var group = [];
        $(document).ready(function($) {
          $(".cb").each(function() {
            if($(this).is('.cb:checked')) {
              code = $(this).attr('id');
              var dataval = document.getElementById(code).value;
              group.push(dataval);
            }
          });
          if(group != '')
          {
            $.ajax({
              url: "/ajax_restaurants_fetch_cuisine/",
              type: "post",
              data: {ids:group,act:'TABLE'} ,
              success: function (response) {
                $("#tab1").html(response);
              }
            })
          }
          else
          {
            checkCon1("roundedOne");
          }
        });
      }
    </script>
    <script>
      function citychange(str) {
        if(str != 0)
        {
          $.ajax({
            url: "/citychange/",
            type: "post",
            data: {id:str,act:'TABLE'} ,
            success: function (response) {
              $("#tab1").html(response);
            }
          })
        }
      }
    </script>
    <script>
      function myservicefun(str){
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
// @abdulmanan7 changes
// $.ajax({
// url: "/ajax_restaurants_fetch/",
// type: "post",
// data: {ids:str,act:act} ,
// success: function (response) {
//     $("#tab1").html(response);
// }
// })
}
</script>
<!--<script>
function checkCon1(id)
{
if($('#'+id).attr('checked'))
{
$('#'+id).removeAttr('checked');
}
else
{
$('#'+id).attr('checked', 'checked');
}
$.ajax({
url: "/ajax_show_all_restro/",
type: "post",
data: {act:'TABLE'} ,
success: function (response) {
$("#tab1").html(response);
}
})
}
</script>-->
<script>
  function checkCon1(id)
  {
    if(id == 'roundedOne')
    {
      $('#roundedOne').attr('checked', 'checked');
      $('#roundedOne1').removeAttr('checked', 'checked');
      $('#roundedOne2').removeAttr('checked', 'checked');
      $('#roundedOne3').removeAttr('checked', 'checked');
      $.ajax({
        url: "/ajax_show_all_restro/",
        type: "post",
        data: {act:'TABLE',filter_id:1},
        success: function (response) {
          $("#tab1").html(response);
        }
      })
    }
    else if(id == 'roundedOne1')
    {
      $('#roundedOne1').attr('checked', 'checked');
      $('#roundedOne').removeAttr('checked', 'checked');
      $('#roundedOne2').removeAttr('checked', 'checked');
      $('#roundedOne3').removeAttr('checked', 'checked');
      $.ajax({
        url: "/ajax_show_all_restro/",
        type: "post",
        data: {act:'TABLE',filter_id:2},
        success: function (response) {
          $("#tab1").html(response);
        }
      })
    }
    else if(id == 'roundedOne2')
    {
      $('#roundedOne2').attr('checked', 'checked');
      $('#roundedOne').removeAttr('checked', 'checked');
      $('#roundedOne1').removeAttr('checked', 'checked');
      $('#roundedOne3').removeAttr('checked', 'checked');
      $.ajax({
        url: "/ajax_show_all_restro/",
        type: "post",
        data: {act:'TABLE',filter_id:3},
        success: function (response) {
          $("#tab1").html(response);
        }
      })
    }
    else if(id == 'roundedOne3')
    {
      $('#roundedOne3').attr('checked', 'checked');
      $('#roundedOne').removeAttr('checked', 'checked');
      $('#roundedOne1').removeAttr('checked', 'checked');
      $('#roundedOne2').removeAttr('checked', 'checked');
    }
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
        data: {textsearch:abc,urltype:3},
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
  $('.selectLocation').select2({
    theme:"classic"
  });
</script>