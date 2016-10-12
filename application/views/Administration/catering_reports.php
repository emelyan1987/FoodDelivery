<?PHP
  $this->load->view("includes/Administration/header"); 
  $this->load->view("includes/Administration/sidebar");
  ?>

  <body>
  <div class="content-wrapper">



 <section class="content">
                <div class="row">
                    <div class="col-md-12">
                     <?php $this->load->view('includes/Administration/reports_filter');  ?> 
                      
                     <div class="heading bg-yellow">Sales BY ITEM</div>
                        <div class="table-responsive">
                            <table class="table table_design" id="example1">
                                <thead>

                                <tr>
                                        <th>ORDER NO.<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>RESTAURANT NAME<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>LOCATION NAME<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>SERVICE NAME<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <!--<th>AREA<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>-->
                                        <th>DATE<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>TIME<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>VALUE<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>DELIVERY CHARGES<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>ITEM NAME<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach($orders as $or => $ord):
                                    ?>
                                    <tr>
                                        <td><?php echo $ord->order_no; ?></td>
                                        <td><?php echo ucwords($ord->restro_name); ?></td> 
                                        <td><?php echo getOwnerlocationByLId($ord->restro_location_id); ?></td>
                                        <td>CATERING</td>
                                        <!--<td>AREA 1</td>-->
                                        <td><?php echo $ord->date; ?></td>
                                        <td><?php echo $ord->time; ?></td>
                                        <td><?php echo $ord->total; ?> KD</td>
                                        <td><?php echo $ord->delivery_charges; ?></td>
                                        <td><?php getOrderItemDetails($ord->id,2); ?></td>
                                    </tr>
                                    <?php
                                    endforeach;
                                    ?>
                                    
                                                                      
                                    
                                    
                                </tbody>
                            </table>
                    </div>

                    <!--<center>
                    <a href="" class="btn bg-gray-light2 padding_less">< PREVIOUS</a>
                    &nbsp; <strong>PAGE 3</strong> &nbsp;
                    <a href="" class="btn bg-gray-light2 padding_less">NEXT ></a>
                    </center>-->
                    <div class="clear_h20"></div>
                    <a href="" class="btn bg-black">EXPORT TO EXCEL</a>
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