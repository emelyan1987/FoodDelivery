<?PHP
$this->load->view("includes/Restaurant_Owner/header");
$this->load->view("includes/Restaurant_Owner/sidebar");
?>

  <body>
  <div class="content-wrapper">



 <section class="content">
                <div class="row">
                    <div class="col-md-12">
                    <a href="/restro_item_category_show" class="btn bg-gray-light2">&lt; &nbsp;Back to item category list</a>
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
                          Locations:
                        </div>
                        <div class="col-md-4" >
                          <select class="form-control" id="location_id" name="location_id" onchange="getService(this.value)">
                            <option value="">-Select Location-</option>
			    <?php
foreach ($Locations as $loc => $list):
?>
				<option value="<?php echo $list->id;?>" <?php if ($cusineData['location_id'] == $list->id) {echo "selected";}
?>> <?php echo $list->location_name;?></option>
			    <?php
endforeach;
?>

                          </select>
			  <input type="hidden" value="<?php echo $this->tank_auth->get_user_id();?>" name="owner_id" id="owner_id">
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
                          <input type="text" name="item_category" class="form-control" value="<?php echo $cusineData['cat_name'];?>" >
                          <span class="text-red"><?php echo form_error('item_category');?></span>
                        </div>

                    </div>


                    <div>
                      <button type="submit" class="btn btn-success" name="btncategory">Save</button>

                    </div>
      </form>



                    </div>
                 </div>
            </section>
      </div><!-- /.content-wrapper -->
<?PHP
$this->load->view("includes/Restaurant_Owner/footer");
?>


<script>
      $(function () {
        $("#example1").DataTable({
          "dom": '<fl<t>ip>'
        });
        $('#example2').DataTable({
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
