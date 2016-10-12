<?PHP
$this->load->view("includes/Administration/header");
$this->load->view("includes/Administration/sidebar");
?>
  <body>
  <div class="content-wrapper">



 <section class="content">
                <div class="row">
                    <div class="col-md-12">
                    <a href="/item_category_show" class="btn bg-gray-light2">&lt; &nbsp;Back to item category list</a>
                    <div class="clear_h10"></div>
                    <h4 class="border_bottom">Add Item Category </h4>
                    <div class="clear_h10"></div>
                    <?php
if (isset($success_msg)) {
	echo '<div class="alert alert-success">
  <strong>Success!</strong> ' . $success_msg . '
</div>';
}
?>
                    <form action="" method="post" >
                    <div class="col-md-12 form-group">
                        <div class="col-md-2">
                          Owner Code:
                        </div>
                        <div class="col-md-4">
                          <select class="form-control" name="owner_id" onchange="locationGet(this.value)" id="owner_id">
                            <option value="">-Select Owner Code-</option>
                            <?php
foreach ($owner_code_list as $oc => $list):
?>
                            <option value="<?php echo getOwnerIdByCode($list->owner_id);?>" <?php if ($cusineData['user_id'] == getOwnerIdByCode($list->owner_id)) {echo "selected";}
?> ><?php echo $list->owner_id;?></option>
                            <?php endforeach;?>

                          </select>
                          <span class="text-red"><?php echo form_error('owner_id');?></span>
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <div class="col-md-2">
                          Locations:
                        </div>
                        <div class="col-md-4" >
                          <select class="form-control" id="location_id" name="location_id" onchange="getService(this.value)">
                            <option value="">-Select Location-</option>
                            <?php
if ($cusineData['location_id'] != '') {
	?>

                            <option value="<?php echo $cusineData['location_id'];?>" selected><?php echo getOwnerlocationByLId($cusineData['location_id']);?></option>
                           <?php
}
?>

                          </select>
                          <span class="text-red"><?php echo form_error('location_id');?></span>
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <div class="col-md-2">
                          Service:
                        </div>
                        <div class="col-md-4">
                          <select class="form-control" name="service_id" id="service_id">
                            <option value="">-Select Service-</option>
                            <?php
if ($cusineData['service_id'] != '') {
	?>

                            <option value="<?php echo $cusineData['service_id'];?>" selected><?php if ($cusineData['service_id'] == 1) {echo "DELIVERY";} elseif ($cusineData['service_id'] == 2) {echo "CATERING";} elseif ($cusineData['service_id'] == 3) {echo "RESERVATION";} elseif ($cusineData['service_id'] == 4) {echo "PICKUP";}
	?></option>
                           <?php
}
?>

                          </select>
                          <span class="text-red"><?php echo form_error('service_id');?></span>
                        </div>

                    </div>
                    <div class="col-md-12 form-group">
                        <div class="col-md-2">
                          Category Name:
                        </div>
                        <div class="col-md-4">
                          <input type="text" name="item_category" class="form-control" value="<?php echo $cusineData['cat_name'];?>">
                          <span class="text-red"><?php echo form_error('item_category');?></span>
                        </div>

                    </div>


                    <div>
                      <button type="submit" class="btn bg-green" name="btncategory">Save</button>

                    </div>
                    </form>



                    </div>
                 </div>
            </section>
      </div><!-- /.content-wrapper -->
<?PHP
$this->load->view("includes/Administration/footer");
?>

<script src="<?PHP echo base_url();?>assets/Administration/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?PHP echo base_url();?>assets/Administration/plugins/datatables/dataTables.bootstrap.min.js"></script>

 <script>
      $(function () {
        $("#example1").DataTable({
          "dom": '<fl<t>ip>'
        });
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": true
        });
      });
    </script>

    <script>
        function locationGet(str){
          var value = str;
           $.ajax({
                          method:"post",
                          url:'/get_location_for_restro_owner/',
                          data:{id:value},
                          success:function(response)
                          {

                             $("#location_id").html(response);

                          }



                     });
        }

        function getService(str){

          var owner_id = document.getElementById('owner_id').value;

          $.ajax({
                          method:"post",
                          url:'/get_service_for_restro_owner/',
                          data:{location:str,owner_id:owner_id},
                          success:function(response)
                          {

                             $("#service_id").html(response);

                          }



                     });

        }
    </script>