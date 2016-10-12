<?PHP
  $this->load->view("includes/Restaurant_Owner/header"); 
  $this->load->view("includes/Restaurant_Owner/sidebar");
  ?>

<!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
            <!-- Content Header (Page header) -->
<section class="content">
          <div class="row">
            <div class="col-xs-12">
         <div class="box">
          <a href="/manage_restro_table/<?php echo $this->uri->segment('2'); ?>" class="btn bg-gray-light2"> Back to Restaurant tables</a>
                <div class="box-header">
                  <h3 class="box-title">Manage Restaurant Table</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <!--<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" style="float:right;">Add Tables</button> <br><br>-->
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>User Email<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                        <th>Contact<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                        <th>No. of User<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                        <!--<th>Price<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>-->
                        <th>Booking Date<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                        <th>Booking Time<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                        <th>Status<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                        <th>Action<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach($tablebooking as $ks => $vs): ?>                    
                               
                    <tr>
                        <td><?php echo $vs->email;?></td>
                        <td><?php getUserMobileNo($vs->customer_id); ?></td>
                        <td><?php echo $vs->user_limit;?></td>
                        <!--<td><?php echo $vs->price;?></td>-->
                        <td><?php echo $vs->booking_date;?></td>
                        <td><?php echo $vs->booking_time;?></td>
                        <td><?php if($vs->status == 0){ echo "<span style='color:blue' >Pendding</span>"; }elseif($vs->status == 1){ echo "<span style='color:green' >Booked</span>"; } ?></td>
                        <td><?php if($vs->status == 0){ ?><a href="" class="btn btn-info" onclick='BookedFun("<?php echo $vs->id; ?>,<?php getUserMobileNo($vs->customer_id); ?>,<?php echo $vs->booking_date;?>,<?php echo $vs->booking_time;?>")'>Booking Confirm</a> <?php } ?></td>
                        
                        
                    </tr>
                    <?PHP

                    endforeach;

                    ?>
                                           
                         
                                          </tbody>
                    
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>
</div>
<?PHP
  $this->load->view("includes/Restaurant_Owner/footer");
?>



<!-- Modal1 -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Table</h4>
      </div>
      <div class="modal-body">
        <form role="form" method="post" action='' enctype ="multipart/form-data" >
                <div class="box-body">

                   
                     <div class="form-group">
                      <label for="exampleInputPassword1">Table No. / Name</label>
                      <input type="text" class="form-control" id="exampleInputPassword1" name="table_no" placeholder="Enter Table No." require>
                      <span style="color:red"><?PHP  echo form_error('table_no'); ?></span>

                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">User Limit</label>
                      <input type="number" class="form-control" id="exampleInputPassword1" name="user_limit" placeholder="Enter User Limit" min="1" max="10" require>
                      <span style="color:red"><?PHP  echo form_error('user_limit'); ?></span>

                    </div>
                     <div class="form-group">
                      <label for="exampleInputPassword1">Price</label>
                      <input type="text" class="form-control" id="exampleInputPassword1" name="price" placeholder="Enter Price" require>
                      <span style="color:red"><?PHP  echo form_error('price'); ?></span>

                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Description</label>
                      <textarea class="form-control" id="exampleInputPassword1" name="description" ></textarea>
                      

                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Table Status</label>
                      <Select class="form-control" name="status" require>
                        <option value="1">Available</option>
                        <!--<option value="2">Booked</option>-->
                        <option value="0">Not Available</option>
                      </select>
                      <span style="color:red"><?PHP  echo form_error('status'); ?></span>

                    </div>
                    <input type="submit" name="btnsavetable" value="Add Table" class="btn btn-success">

               </div>
          </form>

      </div>
      <div class="modal-footer">
        
      </div>
    </div>

  </div>
</div>




<!-- Modal1 -->
<div id="myModal1" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Table</h4>
      </div>
      <div class="modal-body">
        <form role="form" method="post" action='' enctype ="multipart/form-data" >
                <div class="box-body" id="tableEditResult">

                   
                     

               </div>
          </form>

      </div>
      <div class="modal-footer">
        
      </div>
    </div>

  </div>
</div>

<script>
  function EditTable(str,restroId){
   
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
     document.getElementById("tableEditResult").innerHTML = xhttp.responseText;
    }
    };
    xhttp.open("GET", "/ajax_edit_restro_table/"+restroId+"/"+str, true);
    xhttp.send();
  }
</script>

<script>
    function BookedFun(str,mobile,booking_date,booking_time){
        if(str != '')
        {
            $.ajax({

                    url: "/status_change_table_details/",
                    type: "post",
                    data: {order_detail_id:str,mobile:mobile,booking_date:booking_date,booking_time:booking_time} ,
                    success: function (response) {
                      //alert(response);
                       if(response)
                       {
                            window.location.reload();
                       }
                    }
            })
        }

    }
</script>