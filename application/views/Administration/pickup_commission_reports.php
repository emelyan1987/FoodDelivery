  <?PHP
  $this->load->view("includes/Administration/header"); 
  $this->load->view("includes/Administration/sidebar");
  ?>
<!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
          
            <!--<section class="content-header">
                <div class="row">
                    <div class="col-md-12">
                      
                      <div class="col-md-4" style="margin-left: -14px;">
                        <?PHP //$this->load->view("includes/Administration/restro_list"); ?>
                           </div>                                                             
                        <p style="float:right;">Today's Date: <?php echo date('Y-M-d'); ?></p>
                        
                    </div>
                </div>
            </section>-->
            <!-- Main content -->
<?php
            $this->load->view("includes/Administration/commission_box");
?>
            <!-- /.content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-12">

                        <div class="table-responsive">
                            <h2 style="margin-top:-4px;float:left">PICKUP Commission</h2>

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
                                        <th colspan="9" style="color:white;">PICKUP</th>
                                        
                                    </tr>
                                    <tr>
                                        <th>RESTAURANT NAME<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>LOCATION NAME<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        
                                        
                                        <th>TOTAL AMOUNT<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>COMMISSION AMOUNT<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                     $tot_com = 0;
                                    foreach($order as $or => $ord):
                                    ?>
                                    <tr>
                                        <td><?php echo ucwords($ord->restro_name); ?></td>
                                        <td><?php echo getOwnerlocationByLId($ord->restro_location_id); ?> </td>
                                        <td>KD <?php echo ($ord->order_total+$ord->order_charges) - $ord->order_discount; ?></td>
                                        <td>KD <?php $locData = getRestroCommissionData($ord->order_restro_id,$ord->location_id,4); 
                                        if($locData['service_commision'] != '')
                                        {
                                            $tot = ($ord->order_total+$ord->order_charges) - $ord->order_discount;
                                            $com_amount = ($tot * $locData['service_commision']) / 100;
                                            $com_text = "(".$locData['service_commision']."%)";
                                        }
                                        else
                                        {
                                           $com_amount = $locData['service_amount'];
                                           $com_text = '';
                                        }

                                        echo $com_amount.' '.$com_text;
                                        ?>
                                        </td>
                                        
                                        
                                        
                                       
                                    </tr>
                                    <?php
                                    $tot_com = $tot_com + $com_amount;
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                            <input type="hidden" value="<?php echo $tot_com; ?>" >
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
  $(function() {
    $( "#datepicker" ).datepicker({
    format: 'yyyy-mm-dd'
});

  });

  $(function() {
    
    $( "#datepicker1" ).datepicker({
    format: 'yyyy-mm-dd'
});
  });

</script>
