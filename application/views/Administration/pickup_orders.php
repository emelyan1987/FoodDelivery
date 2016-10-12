  <?PHP
  $this->load->view("includes/Administration/header"); 
  $this->load->view("includes/Administration/sidebar");
  ?>
<!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="row">
                    <div class="col-md-12">
                       <!--<div class="col-md-2">SELECT RESTAURANT</div>-->
                      <div class="col-md-4" style="margin-left: -14px;">
                        <?PHP $this->load->view("includes/Administration/restro_list"); ?>
                           </div>                                                             
                        <p style="float:right;">Today's Date: <?php echo date('Y-M-d'); ?></p>
                        
                    </div>
                </div>
            </section>
            <!-- Main content -->
<?php
            $this->load->view("includes/Administration/order_box");
?>
            <!-- /.content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-12">

                        <div class="table-responsive">
                            <h2 style="margin-top:-4px;float:left">PENDING Orders</h2>

                                <!--<div style="float:right;"> <select class="form-control">
                                                                                                  <option value="">Select Retaurant</option>
                                                                                                  <option>Restaurant1</option>
                                                                                                  <option>Restaurant1</option>
                                                                                                  <option>Restaurant1</option>
                                                                                              </select>
                                                                                            </div>-->
                            <table id="example1" class="table table-striped table-bordered table_design">
                                <thead>
                                    <tr class="bg-aqua">
                                        <th colspan="11" style="color:white;">PICKUP</th>
                                        
                                    </tr>
                                    <tr >
                                        <th>ORDER ID<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>LOCATION NAME<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>PAYMENT STATUS<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>CITY<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>AREA<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>CUSTOMER NAME<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <!--<th>DATE</th>-->
                                         <th>PRICE<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>ORDER TIME<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                       
                                        <th>CONTACT<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>DETAILS<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach($order as $or => $ord):
                                    ?>
                                    <tr>
                                        <td>#<?php echo $ord->order_no; ?></td>
                                        <td><?php echo getOwnerlocationByLId($ord->restro_location_id); ?></td>
                                        <td>
                                            <?php if($ord->pay_done == 0){ echo '<div class="pending">Pending</div>'; } ?>
                                            <?php if($ord->pay_done == 1){ echo '<div class="delivered">Completed</div>'; } ?></td>
                                        <!--<td>
                                           <?php if($ord->status == 1){ echo '<div class="pending">Pending</div>'; } ?>
                                           <?php if($ord->status == 2){ echo '<div class="delivered" style="border: 1px solid #5784D6;">Under Process</div>'; } ?>
                                           <?php if($ord->status == 3){ echo '<div class="delivered">Completed</div>'; } ?>
                                           <?php if($ord->status == 4){ echo '<div class="cancelled">Cancelled</div>'; } ?>
                                        </td>-->
                                        <?php
                                         $getLocData = getLocationCityArea($ord->restro_location_id);


                                        ?>
                                        <td><?php echo getCityName($getLocData['city']); ?></td>
                                        <td><?php echo getAreaName($getLocData['area']); ?></td>
                                        <td><?php echo getuseremail($ord->user_id); ?></td>
                                        <!--<td><?php //echo $ord->date; ?></td>-->
                                        <td>KD <?php echo $ord->total + $ord->delivery_charges; ?></td>
                                        
                                        <td>
                                          <?php if($ord->status == 1){ echo '<div class="pending">'.$ord->time.'</div>'; } ?>
                                           <?php if($ord->status == 2){ echo '<div class="delivered" style="border: 1px solid #5784D6;">'.$ord->time.'</div>'; } ?>
                                           <?php if($ord->status == 3){ echo '<div class="delivered">'.$ord->time.'</div>'; } ?>
                                           <?php if($ord->status == 4){ echo '<div class="cancelled">'.$ord->time.'</div>'; } ?>
                                        </td>
                                         <td><?php getUserMobileNo($ord->user_id); ?></td>
                                        <td><a href="/pickup_order_view/<?php echo $ord->id; ?>/"><i class="fa fa-eye"></i></a>
&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" onClick="delete_order(this.id,4)" id="<?PHP echo $ord->id; ?>" class="delete" >x</a>
                                        </td>
                                    </tr>
                                    <?php
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                    </div>
                    </div>
                </div>
            </section>
          </div><!-- /.content-wrapper -->
          

 <?PHP
  $this->load->view("includes/Administration/footer");
?>

<script src="<?PHP echo base_url();  ?>assets/Administration/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?PHP echo base_url();  ?>assets/Administration/plugins/datatables/dataTables.bootstrap.min.js"></script>
 <script>
      $(function () {
       
        $('#example1').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>


        <script>
          function delete_order(order_id,order_type){

            if(order_id)
           {
                
                var v=confirm("Do You Want To Delete This Order?");
                if(v==true)
                {
                    $.ajax({
                                 method:"post",
                                 url:'/delete_order/',
                                 data:{Oid:order_id,type:order_type},
                                 success:function(response)
                                 {
                                     if(response)
                                     {
                                        
                                        window.location.reload();
                                     }
                                 }  
 
                             })
                }

           }

          }
    </script>
