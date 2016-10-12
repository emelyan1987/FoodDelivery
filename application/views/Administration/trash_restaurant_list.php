<?PHP
$this->load->view("includes/Administration/header");
$this->load->view("includes/Administration/sidebar");
?>
   <link rel="stylesheet" href="<?PHP echo base_url();?>assets/Administration/plugins/datatables/dataTables.bootstrap.css">
  <body>
  <div class="content-wrapper">

  <form method="post" action="/restore_restaurant/">
  <section class="content">
                <div class="row">
                    <div class="col-md-12">

                      <!--<a href='/add_new_restaurant/' class="btn bg-gray-light2"><span class="add_sign">+</span> Add Restaurant</a>-->
                       <button type="submit" name="restore" value="go" class="btn bg-gray-light2"><&nbsp;Restore Restaurant</button>
                      <br><br>
                    <h4>Trash Restaurant List</h4>

                     <?PHP echo $this->session->flashdata("msg");?>

                    <div class="clear_h10"></div>
                    <div class="table-responsive">
                            <table class="table table_design table-bordered dataTable no-footer" id="example2">
                                <thead>
                                    <tr>
                                        <th>Select</th>
                                        <th>Logo</th>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Fixed Fees</th>
                                        <th>Cuisine</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                       <?php foreach ($restro_list as $ks => $vs): ?>


                       <tr>
                        <td><?php $RId = $vs->id;?>

                          <input type="checkbox" name="trash_restro[]" value="<?PHP echo $RId;?>"></td>
                          <td>
                                <?php
if ($vs->restaurant_logo) {
	?>
                            <img src="<?PHP echo getImagePath($vs->restaurant_logo);?>"  height="50" width="50" class="img-size">
                                <?PHP
}
?>

                          </td>
                          <td><?php echo getOwnerCode($vs->user_id);?></td>
                          <td class="text-info"><?php echo $vs->restro_name;?></td>

                        <td><?php echo $vs->yearly_fee;?></td>
                        <td><?PHP
$cousine = getCuisine($vs->id);
foreach ($cousine as $ks => $vs) {
	echo $vs->name . ",";

}
?></td>

                        <td align="right">
                          <a href="/restaurant_edit/<?php echo $RId;?>" class="edit"><img src="<?PHP echo base_url();?>assets/Administration/images/icon/edit.png" alt="" />Edit</a>&nbsp;&nbsp;
                          <a href="/restaurant_locations/<?php echo $RId;?>" class="edit"><i class="fa fa-location-arrow" aria-hidden="true" style="color:#0087FF;"></i> Location</a>&nbsp;&nbsp;

                        <!--<a href="/delete_restaurant/<?php echo $RId;?>" class="delete">x</a>--> <a href="javascript:void(0)" onClick="delete_restaurant(this.id)" id="<?PHP echo $RId;?>" class="delete">x</a></td>

                      </tr>
                      <?PHP

endforeach;

?>
                       </tbody>
                       </table>
                    </div>

                    <div class="clear_h10"></div>
                    <!--<a href="AddRestaurant.html" class="btn bg-gray-light2"><span class="add_sign">+</span> Add Restaurant</a>-->



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
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": true
        });
      });
    </script>

    <style>
    .img-size
    {
      width: 110px;height: 65px;background-size: cover;
    }
    .text-info
    {
      text-transform:capitalize;
    }
    </style>
    <script>
       function delete_restaurant(value)
       {
           if(value)
           {

                var v=confirm("Do You Want To Delete This Restaurant Permanently?");
                if(v==true)
                {
                    $.ajax({
                               method:"post",
                               url:"/trash_delete_restaurant/"+value,
                               data:{rid:value},
                               success:function(response)
                               {
                                  if(response)
                                  {
                                    alert(response);

                                     //window.location="http://restro.powersoftware.eu/restaurant_list";
                                  }
                               }


                       })
                }

           }

       }
    </script>