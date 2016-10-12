<?PHP
$this->load->view("includes/Administration/header");
$this->load->view("includes/Administration/sidebar");
?>
 <!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
            <!-- Content Header (Page header) -->

            <!-- Main content -->
           <form method="post">

            <section class="content">
                <div class="row">
                    <div class="col-md-12">

                    <!--<a href="AddLocation.html" class="btn bg-gray-light2">< &nbsp;Back to Area Setup</a>-->

                    <div class="clear_h10"></div>
                   <?PHP
if (isset($area_msg)) {
	?>
                     <div class="alert alert-success">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong> <?PHP

	echo $area_msg;

	?></strong>
                </div>
                <?PHP
}
?>

                    <h4 class="border_bottom">Lists - Area</h4>
                    <div class="clear_h10"></div>

                    <h4>AREA NAME</h4>
                    <div class="table-responsive">
                    <table id="example1"  class="table table_design tbl" style="width:60%;">
                    	<?PHP

foreach ($area_list as $ks => $vs) {
	?>
                          <tr>
                    	<td> <?PHP echo $vs->name;?> (<?PHP echo $vs->city_name;?>)</td>
                        <td align="right">
                          <a href="javascript:void(0)" onClick="updateArea(this.id)" id="<?PHP echo $vs->id;?>,<?PHP echo $vs->name;?>" > <img src="<?PHP echo base_url();?>assets/Administration/images/icon/edit.png" alt="">Edit</a>
                          <?php $city_exist = AreaExistWithRestro($vs->id);?>
<?php
if ($city_exist == 0) {
		?>
                            <a href="javascript:void(0)" onClick="delete_area(this.id)" id="<?PHP echo $vs->id;?>" class="delete">x</a></td></tr>
<?php
} else {
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	}
	?>
                          <?PHP
}
?>

                    </table>
                    </div>
                     <select name="city_id">
                      <option value="">Select City</option>
                      <?PHP
foreach ($city_list as $ks => $vs) {
	echo "<option value='$vs->id'>$vs->city_name</option>";

}
?>
                     </select>


                    <input id="area" type="text" placeholder="Enter Area name" name="area" class="pad7"/>
                    <br><span><?PHP echo form_error("name");?></span> <span><?PHP echo isset($area_msg1) ? $area_msg1 : "";?></span>
                    &nbsp; &nbsp;
                    <!--<a href="" class="btn bg-gray-light2"><span class="add_sign">+</span> Add</a>-->

                    <div class="clear_h10"></div>
                   <button type="submit" name="save" class="btn bg-green">Save</button>
                    </div>
                 </div>
            </section>
            </form>

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
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>


<script>
       function delete_area(value)
       {
           if(value)
           {

                var v=confirm("Do You Want To Delete This Area?");
                if(v==true)
                {
                    $.ajax({
                               method:"post",
                               url:"/delete_area/",
                               data:{aid:value},
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
   function updateArea(value)
   {

          var v=value.split(",");
          $("#area_edit_id").val(v[0]);
          $("#area_edit_name").val(v[1]);

    $('#myModal').modal()                      // initialized with defaults
    $('#myModal').modal({ keyboard: false })   // initialized with no keyboard
    $('#myModal').modal('show')

   }
</script>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Update Area</h4>
      </div>
      <div class="modal-body">
          Area Name <input type="text" class="form-control" id='area_edit_name'>
                     <span id="area_name_msg"></span>
               <input type="hidden" name="area_edit_id" id="area_edit_id">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onClick="editarea()">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>
         function editarea()
         {



               var area_id=$("#area_edit_id").val();
               var area_name=$("#area_edit_name").val();
                   if(area_name=="")
                   {
                        $(".area_name_msg").html("Please Enter Area Name");
                        $(".area_name_msg").css("color","red");


                   }
                   else
                   {



                       $.ajax({
                                 method:"post",
                                 url:'/update_area/'+area_id,
                                 data:{id:area_id,area_name:area_name},
                                 success:function(response)
                                 {

                                     if(response)
                                     {
                                        $('#myModal').modal()                      // initialized with defaults
                                        $('#myModal').modal({ keyboard: false })   // initialized with no keyboard
                                        $('#myModal').modal('hide')
                                        window.location.reload();
                                     }
                                 }

                             })
                   }


         }
</script>