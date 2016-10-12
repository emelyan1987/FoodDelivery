<section class="content">
              <!-- Small boxes (Stat box) -->
              <div class="row" style="margin-bottom:10px;">
              <form action="" method="POST" class="form-inline" role="form">
                <div class="col-md-8 col-md-offset-3">
                <div class="col-lg-2 col-xs-6">
                <div class="form-group">
                    <input type="text" name="from_date" placeholder="From Date" class="form-control" id="datepicker" required>
                    </div>
                </div>
                <div class="col-lg-2 col-xs-6" style="margin-left:50px;">
                <div class="form-group">
                    <input type="text" name="to_date" placeholder="To Date"  class="form-control"  id="datepicker1" required>
                    </div>
                </div>
                <div class="col-lg-2 col-xs-6" style="margin-left:50px;">
                    <input type="submit" name="btnsearch" class="btn btn-success">
                </div>
                </div>
                <div class="col-md-8 col-md-offset-2" style="margin-top:10px;">
                          <div class="form-group">
                          <label for="owner_id">Restaurant Name</label>
<select class="form-control" name="owner_id" onchange="locationGet(this.value)" id="owner_id">
                            <option value="">-Select Restaurant name-</option>
                            <?php
foreach ($owner_code_list as $oc => $list):
?>
                            <option value="<?php echo getOwnerIdByCode($list->owner_id);?>"><?php echo getRestroNameByOwnerCode($list->owner_id);?></option>
                            <?php endforeach;?>

                          </select>
                          </div>
                          <div class="form-group">
                          <label for="owner_id">Restaurant Name</label>
                             <select class="form-control" id="location_id" name="location_id" onchange="getService(this.value)">
                            <option value="">-Select Location-</option>


                          </select>
                          </div>
                </div>
              </form>

              </div>
              <div class="row">
                <a href="/commission_reports/">
                <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-green">

                    <div class="icon">
                        <img class="img-responsive" src="<?PHP echo base_url();?>assets/Restaurant_Owner/images/icon/car.png" alt="">
                    </div>
                    <div class="inner">
                        <h4>DELIVERY</h4>
                        <h4 id="delivery_tot"><?php echo getCommissionCount(1);?></h4>
                    </div>
                  </div>

                  <!--<div class="small-box-bottom bg-gray-light">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                      <tbody><tr><td colspan="2">TODAY SALES: KD 1,250</td></tr>
                      <tr><td colspan="2">TODAY ORDERS: 40</td></tr>
                    </tbody></table>
                  </div>-->
                </div>
              </a>
              <!-- ./col -->
              <a href="/catering_commission_reports/">
                <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-yellow">

                    <div class="icon">
                        <img src="<?PHP echo base_url();?>assets/Restaurant_Owner/images/icon/man.png" class="img-responsive" alt=""/>
                    </div>
                    <div class="inner">
                        <h4>CATERING</h4>
                        <h4 id="catering_tot"><?php echo getCommissionCount(2);?></h4>
                    </div>
                  </div>

                  <!--<div class="small-box-bottom bg-gray-light">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                      <tbody><tr><td colspan="2">TODAY SALES: KD 1,250</td></tr>
                      <tr><td colspan="2">TODAY ORDERS: 40</td></tr>
                    </tbody></table>
                  </div>-->
                </div>
              </a>
                <!-- ./col -->
              <a href="/reservation_commission_reports/">
                <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-red">

                    <div class="icon">
                        <img src="<?PHP echo base_url();?>assets/Restaurant_Owner/images/icon/food.png" class="img-responsive" alt=""/>
                    </div>
                    <div class="inner">
                      <h4>RESERVATION</h4>
                    </div>
                  </div>

                  <!--<div class="small-box-bottom bg-gray-light">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                      <tbody><tr><td colspan="2">TODAY SALES: KD 1,250</td></tr>
                      <tr><td colspan="2">TODAY ORDERS: 40</td></tr>
                    </tbody></table>
                  </div>-->
                </div>
              </a>
                <!-- ./col -->
             <a href="/pickup_commission_reports/">
                <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-aqua">

                    <div class="icon">
                        <img src="<?PHP echo base_url();?>assets/Restaurant_Owner/images/icon/cock.png" class="img-responsive" alt=""/>
                    </div>
                    <div class="inner">
                      <h4>PICK UP</h4>
                      <h4 id="catering_tot"><?php echo getCommissionCount(4);?></h4>
                    </div>
                  </div>

                  <!--<div class="small-box-bottom bg-gray-light">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                      <tbody><tr><td colspan="2">TODAY SALES: KD 1,250</td></tr>
                      <tr><td colspan="2">TODAY ORDERS: 40</td></tr>
                    </tbody></table>
                  </div>-->
                </div>
              </a><!-- ./col -->
              </div><!-- /.row -->
              <!-- Main row -->
            </section>


