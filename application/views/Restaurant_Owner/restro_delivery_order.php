<?PHP
  $this->load->view("includes/Restaurant_Owner/header"); 
  $this->load->view("includes/Restaurant_Owner/sidebar");
  ?>
<!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
            <!-- Content Header (Page header) -->
           
            <!-- Main content -->
<?php
            $this->load->view("includes/Restaurant_Owner/dash_order_box");
?>
            <!-- /.content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <h2 style="margin-top:-4px;">PENDING Orders</h2>
                            <table id="example1" class="table table-striped table-bordered table_design">
                                
                                <thead>
                                    <tr class="bg-green">
                                        <th colspan="9">DELIVERY ORDERS</th>
                                    </tr>
                                </thead>
                                <thead>
                                    <tr>
                                        <th>ORDER ID<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>PAYMENT STATUS<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>STATUS<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>CUSTOMER<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>DATE<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>TIME<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>AMOUNT<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
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
                                        <td><?php if($ord->pay_done == 0){ echo '<div class="pending">Pending</div>'; } ?>
                                            <?php if($ord->pay_done == 1){ echo '<div class="delivered">Completed</div>'; } ?></td>
                                        <td>
                                            <?php if($ord->status == 1){ echo '<div class="pending">Pending</div>'; } ?>
                                            <?php if($ord->status == 2){ echo '<div class="delivered" style="border: 1px solid #5784D6;">Under Process</div>'; } ?>
                                            <?php if($ord->status == 3){ echo '<div class="delivered">Completed</div>'; } ?>
                                            <?php if($ord->status == 4){ echo '<div class="cancelled">Cancelled</div>'; } ?>
                                                
                                           
                                        </td>
                                        <td><?php echo getuseremail($ord->user_id); ?></td>
                                        <td><?php echo $ord->delivery_date; ?></td>
                                        <td><?php echo $ord->delivery_time; ?></td>
                                        <td>KD <?php echo $ord->total + $ord->delivery_charges; ?></td>
                                        <!--/restro_delivery_view/<?php //echo $ord->id; ?>-->
                                        <td><?php getUserMobileNo($ord->user_id); ?></td>
                                        <td><a href="/restro_delivery_order_view/<?php echo $ord->id; ?>/"><i class="fa fa-eye"></i></a></td>
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
  $this->load->view("includes/Restaurant_Owner/footer");
?>
