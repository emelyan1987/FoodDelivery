<?PHP
$this->load->view("includes/Administration/header");
$this->load->view("includes/Administration/sidebar");
?>
   <link rel="stylesheet" href="<?PHP echo base_url();?>assets/Administration/plugins/datatables/dataTables.bootstrap.css">
  <body>
  <div class="content-wrapper">
            <section class="content">
          <div class="row">
            <div class="col-xs-12">
         <div class="box">
                <div class="box-header">
                   <a href='/new_plan/'><button type="button" class="btn btn-primary">Add New</button></a><br><br>

                  <h3 class="box-title">List of plan</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Name</th>
                         <th>Amount</th>
                          <th>Detail</th>
                          <th>Date</th>

                        <th>Status</th>
                        <th>Action</th>

                      </tr>
                    </thead>
                    <tbody>
                        <?PHP
foreach ($plan_list as $ks => $vs) {

	?>

                               <tr>
                                  <td><?PHP echo $vs->plan_name;?></td>
                                  <td><?PHP echo $vs->plan_price;?></td>

                                  <td><?PHP echo $vs->plan_detail;?></td>
                                  <td><?PHP echo $vs->plan_date;?></td>
                                  <td>Active</td>
                                  <td><a href="/edit_plan/<?PHP echo $vs->id;?>/">Edit</a>|<a href="">Delete</a> </td>

                               </tr>
                       <?PHP

}
?>

                    </tbody>

                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
<?PHP
$this->load->view("includes/Administration/footer");
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