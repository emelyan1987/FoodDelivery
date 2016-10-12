<section class="content-header">
                <div class="row">
                    <div class="col-md-12">
                        <p>Today's Date: <?php echo date('Y-M-d'); ?></p>
                    </div>
                </div>

                 <div class="row">
                  <form action="" method="post">
                    <div class="col-md-4">
                          <select class="form-control" name="location_id">
                                    <option value="0">Select Location</option>
                                <?php
                                foreach($Locations as $loc => $list):
                                ?>
                                    <option value="<?php echo $list->id; ?>"> <?php echo $list->location_name; ?></option>
                                <?php
                                endforeach;
                                ?>
                          </select>
                    </div>
                    <div class="col-md-4">
                          <input type="submit" name="btnsearch" value="Search" class="btn btn-success">
                    </div>
                  </form>
                  </div>
</section>


<?php
if(@$showStatus == 0)
{
?>
            <!-- Main content -->
            <section class="content">
              <!-- Small boxes (Stat box) -->
              <div class="row">
                <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <a href="/restro_delivery_notification/">
                  <div class="small-box bg-green">
                    <i class="upper"><?php getownerordercount(1); ?></i>
                    <div class="icon">
                        <img class="img-responsive" src="<?PHP echo base_url();  ?>assets/Restaurant_Owner/images/icon/car.png" alt="">  
                    </div>
                    <div class="inner">
                        <h4>DELIVERY</h4>
                    </div>
                  </div>
                  </a>
                  <!--<div class="small-box-bottom bg-gray-light">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                      <tr><td colspan="2">TOTAL ORDERS: <?php getownerordercount(1); ?></td></tr>
                      <tr><td colspan="2">ORDERS AMOUNT: KD 500</td></tr>
                      <tr><td>STATUS:</td><td><span class="text-red">BUSY</span> <input checked="checked" id="Checkbox1" type="checkbox" /></td></tr>
                      <tr><td>From:</td><td> <input id="Text1" type="text" value="6:30 AM" /></td></tr>
                      <tr><td>To:</td><td> <input id="Text2" type="text" value="4:00 PM"/></td></tr>
                    </table>
                  </div>-->
                </div><!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <a href="/restro_catering_notification/">
                  <div class="small-box bg-yellow">
                    <i class="upper"><?php getownerordercount(2); ?></i>
                    <div class="icon">
                        <img src="<?PHP echo base_url();  ?>assets/Restaurant_Owner/images/icon/man.png" class="img-responsive" alt=""/>
                    </div>
                    <div class="inner">
                        <h4>CATERING</h4>
                    </div>
                  </div>
                  </a>
                  <!--<div class="small-box-bottom bg-gray-light">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                      <tr><td colspan="2">TOTAL ORDERS: <?php getownerordercount(2); ?></td></tr>
                      <tr><td colspan="2">ORDERS AMOUNT: KD 500</td></tr>
                      <tr><td>STATUS:</td><td>BUSY <input id="Checkbox2" type="checkbox" /></td></tr>
                      <tr><td>From:</td><td> <input id="Text3" type="text" value="6:30 AM" /></td></tr>
                      <tr><td>To:</td><td> <input id="Text4" type="text" value="4:00 PM"/></td></tr>
                    </table>
                  </div>-->
                </div><!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <a href="/restro_reservation_notification/">
                  <div class="small-box bg-red">
                   <i class="upper"><?php getownerordercount(3); ?></i>
                    <div class="icon">
                        <img src="<?PHP echo base_url();  ?>assets/Restaurant_Owner/images/icon/food.png" class="img-responsive" alt=""/>
                    </div>
                    <div class="inner">
                      <h4>RESERVATION</h4>
                    </div>
                  </div>
                  </a>
                  <!--<div class="small-box-bottom bg-gray-light">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                      <tr><td colspan="2">TOTAL ORDERS: <?php getownerordercount(3); ?></td></tr>
                      <tr><td>STATUS:</td><td><span class="text-red">BUSY</span> <input id="Checkbox3" checked="checked" type="checkbox" /></td></tr>
                      <tr><td>From:</td><td> <input id="Text5" type="text" value="6:30 AM" /></td></tr>
                      <tr><td>To:</td><td> <input id="Text6" type="text" value="4:00 PM"/></td></tr>
                      <tr><td>&nbsp;</td></tr>
                    </table>
                  </div>-->
                </div><!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <a href="/restro_pickup_notification/">
                  <div class="small-box bg-aqua">
                    <i class="upper"><?php getownerordercount(4); ?></i>
                    <div class="icon">
                        <img src="<?PHP echo base_url();  ?>assets/Restaurant_Owner/images/icon/cock.png" class="img-responsive" alt=""/>
                    </div>
                    <div class="inner">
                      <h4>PICK UP</h4>
                    </div>
                  </div>
                  </a>
                  <!--<div class="small-box-bottom bg-gray-light">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                      <tr><td colspan="2">TOTAL ORDERS: <?php getownerordercount(4); ?></td></tr>
                      <tr><td colspan="2">ORDERS AMOUNT: KD 500</td></tr>
                      <tr><td>STATUS:</td><td>BUSY <input id="Checkbox4" type="checkbox" /></td></tr>
                      <tr><td>From:</td><td> <input id="Text7" type="text" value="6:30 AM" /></td></tr>
                      <tr><td>To:</td><td> <input id="Text8" type="text" value="4:00 PM"/></td></tr>
                    </table>
                  </div>-->
                </div><!-- ./col -->
              </div><!-- /.row -->
              <!-- Main row -->
            </section><!-- /.content -->


<?php
}else{

foreach($servicedata as $ser => $SR):
      if($SR->service_type == 1)
      {
?>
          <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <a href="javascript:void(0)" onclick="ServiceFun(1)">
                  <div class="small-box bg-green">
                    <!--<i class="upper"><?php getordercount(1); ?></i>-->
                    <div class="icon">
                        <img class="img-responsive" src="<?PHP echo base_url();  ?>assets/Restaurant_Owner/images/icon/car.png" alt="">  
                    </div>
                    <div class="inner">
                        <h4>DELIVERY</h4>
                    </div>
                  </div>
                  </a>
                  <div class="small-box-bottom bg-gray-light">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                      <tr><td colspan="2">TOTAL ORDERS: <?php getordercount_filter(1,$restro_id,$location_id); ?></td></tr>
                      <tr><td colspan="2">ORDERS AMOUNT: KD 500</td></tr>
                      <tr><td>STATUS:</td><td><span class="text-red">BUSY</span> <input <?php if($SR->open_status == 1){ echo 'checked="checked"'; } ?> id="chkFun1" type="checkbox" /></td></tr>
                      <tr><td>From:</td><td> <input id="dfrom" type="text" value="<?php echo $SR->open_from; ?>" /></td></tr>
                      <tr><td>To:</td><td> <input id="dto" type="text" value="<?php echo $SR->open_to; ?>"/></td></tr>
                      <tr><td colspan="2" id="dMsg"></td></tr>
                    </table>
                  </div>
                </div>
      <?php
      }
      elseif($SR->service_type == 2)
      {
      ?>
          <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <a href="javascript:void(0)"  onclick="ServiceFun(2)">
                  <div class="small-box bg-yellow">
                      <!--<i class="upper"><?php getordercount(2); ?></i>-->
                    <div class="icon">
                        <img src="<?PHP echo base_url();  ?>assets/Restaurant_Owner/images/icon/man.png" class="img-responsive" alt=""/>
                    </div>
                    <div class="inner">
                        <h4>CATERING</h4>
                    </div>
                  </div>
                  </a>
                  <div class="small-box-bottom bg-gray-light">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                     <tr><td colspan="2">TOTAL ORDERS: <?php getordercount_filter(2,$restro_id,$location_id); ?></td></tr>
                      <tr><td colspan="2">ORDERS AMOUNT: KD 500</td></tr>
                      <tr><td>STATUS:</td><td><span class="text-red">BUSY</span> <input <?php if($SR->open_status == 1){ echo 'checked="checked"'; } ?> id="chkFun2" type="checkbox" /></td></tr>
                      <tr><td>From:</td><td> <input id="cfrom" type="text" value="<?php echo $SR->open_from; ?>" /></td></tr>
                      <tr><td>To:</td><td> <input id="cto" type="text" value="<?php echo $SR->open_to; ?>"/></td></tr>
                      <tr><td colspan="2" id="cMsg"></td></tr>
                    </table>
                  </div>
                </div>
      <?php
      }
      elseif($SR->service_type == 3)
      {
      ?>
            <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <a href="javascript:void(0)"  onclick="ServiceFun(3)">
                  <div class="small-box bg-red">
                     <!--<i class="upper"><?php getordercount(3); ?></i>-->
                    <div class="icon">
                        <img src="<?PHP echo base_url();  ?>assets/Restaurant_Owner/images/icon/food.png" class="img-responsive" alt=""/>
                    </div>
                    <div class="inner">
                      <h4>RESERVATION</h4>
                    </div>
                  </div>
                  </a>
                  <div class="small-box-bottom bg-gray-light">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                      <tr><td colspan="2">TOTAL ORDERS: <?php getordercount_filter(3,$restro_id,$location_id); ?></td></tr>
                      <tr><td>STATUS:</td><td><span class="text-red">BUSY</span> <input <?php if($SR->open_status == 1){ echo 'checked="checked"'; } ?> id="chkFun3" type="checkbox" /></td></tr>
                      <tr><td>From:</td><td> <input id="rfrom" type="text" value="<?php echo $SR->open_from; ?>" /></td></tr>
                      <tr><td>To:</td><td> <input id="rto" type="text" value="<?php echo $SR->open_to; ?>"/></td></tr>
                      <tr><td>&nbsp;</td></tr>
                      <tr><td colspan="2" id="rMsg"></td></tr>
                    </table>
                  </div>
                </div>
      <?php
      }
      elseif($SR->service_type == 4)
      {
      ?>
            <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <a href="javascript:void(0)"  onclick="ServiceFun(4)">
                  <div class="small-box bg-aqua">
                     <!--<i class="upper"><?php getordercount(4); ?></i>-->
                    <div class="icon">
                        <img src="<?PHP echo base_url();  ?>assets/Restaurant_Owner/images/icon/cock.png" class="img-responsive" alt=""/>
                    </div>
                    <div class="inner">
                      <h4>PICK UP</h4>
                    </div>
                  </div>
                  </a>
                  <div class="small-box-bottom bg-gray-light">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                      <tr><td colspan="2">TOTAL ORDERS: <?php getordercount_filter(4,$restro_id,$location_id); ?></td></tr>
                      <tr><td colspan="2">ORDERS AMOUNT: KD 500</td></tr>
                      <tr><td>STATUS:</td><td><span class="text-red">BUSY</span> <input <?php if($SR->open_status == 1){ echo 'checked="checked"'; } ?> id="chkFun4" type="checkbox" /></td></tr>
                      <tr><td>From:</td><td> <input id="pfrom" type="text" value="<?php echo $SR->open_from; ?>" /></td></tr>
                      <tr><td>To:</td><td> <input id="pto" type="text" value="<?php echo $SR->open_to; ?>"/></td></tr>
                      <tr><td colspan="2" id="pMsg"></td></tr>
                    </table>
                  </div>
                </div>
      <?php
      }
      ?>


<?php
endforeach;
}
?>
