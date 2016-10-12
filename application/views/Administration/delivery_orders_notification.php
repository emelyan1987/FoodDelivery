<?PHP
  $this->load->view("includes/Administration/header"); 
  $this->load->view("includes/Administration/sidebar");
  ?>
<!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
            <!-- Content Header (Page header) -->
           
            <!-- Main content -->

<?php
$this->load->view("includes/Administration/Order_notification_box");
?>            <!-- /.content -->

            <section class="content">
                <div class="row">
                    <div class="col-md-12" id="orderShow">
                    
                      <div class="heading">Pending Orders</div>
                        <div class="table-responsive">
                            <table id="example1" class="table table-striped table-bordered table_design">
                                <thead>
                                    
                                    <tr>
                                        <th>ORDER NO.<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>LOCATION NAME<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>PAYMENT STATUS<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>CITY<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>AREA<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>CUSTOMER NAME<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
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
                                        <td> <?php if($ord->pay_done == 0){ echo '<div class="pending">Pending</div>'; } ?>
                                            <?php if($ord->pay_done == 1){ echo '<div class="delivered">Completed</div>'; } ?></td>
                                        
                                        <!--<td>
                                            <?php if($ord->status == 1){ echo '<div class="pending">Pending</div>'; } ?>
                                            <?php if($ord->status == 2){ echo '<div class="delivered" style="border: 1px solid #5784D6;">Under Process</div>'; } ?>
                                            <?php if($ord->status == 3){ echo '<div class="delivered">Completed</div>'; } ?>
                                            <?php if($ord->status == 4){ echo '<div class="cancelled">Cancelled</div>'; } ?>
                                                
                                           
                                        </td>-->
                                        <!--<td>service1</td>-->
                                        <?php
                                         $getLocData = getLocationCityArea($ord->restro_location_id);


                                        ?>
                                        <td><?php echo getCityName($getLocData['city']); ?></td>
                                        <td><?php echo getAreaName($getLocData['area']); ?></td>
                                        <td><?php echo getuseremail($ord->user_id); ?></td>
                                        <!--<td><?php echo $ord->delivery_date; ?></td>-->
                                         <td>KD <?php echo $ord->total + $ord->delivery_charges; ?></td>
                                        <td>
                                            <?php if($ord->status == 1){ echo '<div class="pending">'.$ord->delivery_time.'</div>'; } ?>
                                            <?php if($ord->status == 2){ echo '<div class="delivered" style="border: 1px solid #5784D6;">'.$ord->delivery_time.'</div>'; } ?>
                                            <?php if($ord->status == 3){ echo '<div class="delivered">'.$ord->delivery_time.'</div>'; } ?>
                                            <?php if($ord->status == 4){ echo '<div class="cancelled">'.$ord->delivery_time.'</div>'; } ?>
                                         </td>
                                       
                                        <!--/restro_delivery_view/<?php //echo $ord->id; ?>-->
                                         <td><?php getUserMobileNo($ord->user_id); ?></td>
                                        <td><a href="/delivery_order_view/<?php echo $ord->id; ?>/"><i class="fa fa-eye"></i></a>
                                          &nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" onClick="delete_order(this.id,1)" id="<?PHP echo $ord->id; ?>" class="delete" >x</a>
                                        </td>
                                    </tr>
                                    <?php
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>

                            

                        </div>
                    </div>
                    <input type="hidden" id="restro_hidden_id" value="<?php echo $restro_id; ?>" >
                    <input type="hidden" id="location_hidden_id"  value="<?php echo $location_id; ?>" >
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



<script>
            function getLocation(value)
            {
                $.ajax({
                          method:"post",
                          url:'/get_location_for_notification/',
                          data:{id:value},
                          success:function(response)
                          {
                             $("#location_id").html(response);

                          }



                     });

            }
         </script>




<script>

  $('#chkFun1').on('click',function(){
    if(this.checked==true){
      var status = 1;
    }else{
      var status = 0;
    }

    var r_id = document.getElementById('restro_hidden_id').value;
    var l_id = document.getElementById('location_hidden_id').value;
    var service_id = 1;
    var dfrom = document.getElementById('dfrom').value;
    var dto = document.getElementById('dto').value;
    
    $.ajax({
                                 method:"post",
                                 url:'/update_location_service_status/',
                                 data:{restro_id:r_id,location_id:l_id,service_id:service_id,from:dfrom,to:dto,status:status},
                                 success:function(response)
                                 {
                                    
                                     if(response)
                                     {
                                        
                                        $("#dMsg").html("<span style='color:green'>Updated Successfully done!</span>");
                                     }
                                 }  
 
                             })
});

</script>


<script>

  $('#chkFun2').on('click',function(){
    if(this.checked==true){
      var status = 1;
    }else{
      var status = 0;
    }

    var r_id = document.getElementById('restro_hidden_id').value;
    var l_id = document.getElementById('location_hidden_id').value;
    var service_id = 2;
    var cfrom = document.getElementById('cfrom').value;
    var cto = document.getElementById('cto').value;
    
    $.ajax({
                                 method:"post",
                                 url:'/update_location_service_status/',
                                 data:{restro_id:r_id,location_id:l_id,service_id:service_id,from:cfrom,to:cto,status:status},
                                 success:function(response)
                                 {
                                    
                                     if(response)
                                     {
                                        
                                        $("#cMsg").html("<span style='color:green'>Updated Successfully done!</span>");
                                     }
                                 }  
 
                             })
});

</script>

<script>

  $('#chkFun3').on('click',function(){
    if(this.checked==true){
      var status = 1;
    }else{
      var status = 0;
    }

    var r_id = document.getElementById('restro_hidden_id').value;
    var l_id = document.getElementById('location_hidden_id').value;
    var service_id = 3;
    var rfrom = document.getElementById('rfrom').value;
    var rto = document.getElementById('rto').value;
    
    $.ajax({
                                 method:"post",
                                 url:'/update_location_service_status/',
                                 data:{restro_id:r_id,location_id:l_id,service_id:service_id,from:rfrom,to:rto,status:status},
                                 success:function(response)
                                 {
                                    
                                     if(response)
                                     {
                                        
                                        $("#rMsg").html("<span style='color:green'>Updated Successfully done!</span>");
                                     }
                                 }  
 
                             })
});

</script>

<script>

  $('#chkFun4').on('click',function(){
    if(this.checked==true){
      var status = 1;
    }else{
      var status = 0;
    }

    var r_id = document.getElementById('restro_hidden_id').value;
    var l_id = document.getElementById('location_hidden_id').value;
    var service_id = 4;
    var pfrom = document.getElementById('pfrom').value;
    var pto = document.getElementById('pto').value;
    
    $.ajax({
                                 method:"post",
                                 url:'/update_location_service_status/',
                                 data:{restro_id:r_id,location_id:l_id,service_id:service_id,from:pfrom,to:pto,status:status},
                                 success:function(response)
                                 {
                                    
                                     if(response)
                                     {
                                        
                                        $("#pMsg").html("<span style='color:green'>Updated Successfully done!</span>");
                                     }
                                 }  
 
                             })
});

</script>

<script>
    function ServiceFun(str){
      var r_id = document.getElementById('restro_hidden_id').value;
      var l_id = document.getElementById('location_hidden_id').value;
      var service_id = str;

        $.ajax({
                                 method:"post",
                                 url:'/filter_order_ajax/',
                                 data:{restro_id:r_id,location_id:l_id,service_id:service_id},
                                 success:function(response)
                                 {
                                    
                                     if(response)
                                     {
                                        
                                        $("#orderShow").html(response);
                                     }
                                 }  
 
                             })
    }
</script>