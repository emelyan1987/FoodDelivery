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
          <a href="/restro_add_promotion/" class="btn bg-gray-light2"><span class="add_sign">+</span> Add New</a>
                <div class="box-header">
                  <h3 class="box-title">Manage Promotions</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Name<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                        <th>Price<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                        <th>From Date<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                        <th>To Date<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                        <th>Action<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>


                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($promotion as $pr => $promo):

?>

                    <tr>
                        <td><?php echo ucwords($promo->name);?></td>
                        <td> KD <?php echo $promo->price;?></td>
                        <td><?php echo $promo->from_date;?></td>
                        <td><?php echo $promo->to_date;?></td>
                        <td><a href="/restro_edit_promotion/<?php echo $promo->id;?>" class="edit border-gray padding_less" style="float:left;"><i class="fa fa-pencil text-blue" aria-hidden="true"></i> </a></td>
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
<script src="<?PHP echo base_url();?>assets/Restaurant_Owner/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?PHP echo base_url();?>assets/Restaurant_Owner/plugins/datatables/dataTables.bootstrap.min.js"></script>
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