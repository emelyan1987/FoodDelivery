<?PHP
$this->load->view("includes/Administration/header");
$this->load->view("includes/Administration/sidebar");
?>

<!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
            <!-- Content Header (Page header) -->
<section class="content">
          <div class="row">
            <div class="col-xs-12">
         <div class="box">


                <div class="box-header">
                  <a href="/add_promotion/" class="btn btn-round bg-gray-light2 pull-right"><span class="add_sign">+</span> Add New</a>
                  <br>
                  <h3 class="box-title">Promotion List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">

                     <div class="col-md-12 form-group">
                      <div class="col-md-4">
                       <div class="row">
                        <div class="col-md-4 text-right">
                          <label for="owner_id" class="control-label">Name:</label>
                        </div>
                        <div class="col-md-8">
                          <select class="form-control" name="owner_id" onchange="locationGet(this.value)" id="owner_id">
                            <option value="">-Select Restaurant name-</option>
                            <?php
foreach ($owner_code_list as $oc => $list):
?>
                            <option value="<?php echo getOwnerIdByCode($list->owner_id);?>"><?php echo getRestroNameByOwnerCode($list->owner_id);?></option>
                            <?php endforeach;?>

                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                       <div class="row">
                        <div class="col-md-4 text-right">
                           <label for="owner_id" class="control-label">Locations:</label>
                        </div>
                        <div class="col-md-8">
                           <select class="form-control" id="location_id" name="location_id" onchange="getService(this.value)">
                            <option value="">-Select Location-</option>


                          </select>
                        </div>
                        </div>
                  </div>
                  <div class="col-md-4">
                     <div class="row">
                        <div class="col-md-4 text-right">
                          <label for="owner_id" class="control-label">Service:</label>
                        </div>
                        <div class="col-md-8">
                           <select class="form-control" name="service_id" id="service_id" onchange="filteringData(this.value);">
                            <option value="">-Select Service-</option>


                          </select>
                        </div>
                   </div>
                 </div>
                    </div>




                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <!--<th>Owner Code</th>-->
                        <th>Restro Name</th>
                        <th>Location Name</th>
                        <th>Service</th>
                        <th>Price</th>
                        <th>From Date</th>
                        <th>To Date</th>
                        <th>Action</th>

                      </tr>
                    </thead>
                    <tbody id="filterDataShow">
                    <?php foreach ($promotion as $pr => $promo):

?>

                    <tr>
                        <td><?php echo ucwords($promo->name);?></td>
                        <!--<td><?php echo getOwnerCodeById($promo->user_id);?></td>-->
                        <td><?php $odID = getOwnerCodeById($promo->user_id);
echo getRestroNameByOwnerCode($odID);?></td>
                        <td><?php echo getOwnerlocationByLId($promo->location_id);?></td>
                        <td><?php if ($promo->service_id == 1) {echo "DELIVERY";} elseif ($promo->service_id == 2) {echo "CATERING";} elseif ($promo->service_id == 3) {echo "RESERVATION";} elseif ($promo->service_id == 4) {echo "PICKUP";}
?></td>
                        <td> KD <?php echo $promo->price;?></td>
                        <td><?php echo $promo->from_date;?></td>
                        <td><?php echo $promo->to_date;?></td>
                       <td><a href="/edit_promotion/<?php echo $promo->id;?>" class="edit"><img src="<?PHP echo base_url();?>assets/Administration/images/icon/edit.png" alt="" />Edit</a>
                            <a href="/delete_promotion/<?php echo $promo->id;?>/show_promotion" class="delete confirmation" >x</a>

                       </td>
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

        <script type="text/javascript">
    var elems = document.getElementsByClassName('confirmation');
    var confirmIt = function (e) {
        if (!confirm('Are you sure?')) e.preventDefault();
    };
    for (var i = 0, l = elems.length; i < l; i++) {
        elems[i].addEventListener('click', confirmIt, false);
    }
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
                          data:{location:str,owner_id:owner_id,res:1},
                          success:function(response)
                          {

                             $("#service_id").html(response);

                          }



                     });

        }


  function filteringData(str){
    var owner_id = document.getElementById('owner_id').value;
    var location_id = document.getElementById('location_id').value;


          $.ajax({
                          method:"post",
                          url:'/location_service_filter_promotion/',
                          data:{location:location_id,owner_id:owner_id,service:str},
                          success:function(response)
                          {

                             $("#filterDataShow").html(response);

                          }



                     });

  }

    </script>