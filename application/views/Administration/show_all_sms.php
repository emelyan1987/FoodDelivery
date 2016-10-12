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
                  <h3 class="box-title">Manage SMS</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Title<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                        <th>Message<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                        <th>Action<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>

                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($template as $ks => $vs):

?>

                    <tr>
                        <td><?php echo ucwords($vs->title);?></td>
                        <td><?php echo ucwords($vs->message);?></td>
                        <td><a href="#" class="edit border-gray padding_less" data-toggle="modal" data-target="#myModal" id="<?php echo $vs->id;?>" onclick='smsFun(this.id,"<?php echo $vs->title;?>","<?php echo $vs->message;?>");'><i class="fa fa-pencil text-blue" aria-hidden="true"></i> Edit</a>

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





<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="titleSMS">Edit SMS</h4>
      </div>
      <form action="" method="post">
      <div class="modal-body">


            <div class="form-group">
              <label for="pwd">Message:</label>
              <textarea class="form-control" name="message" id="message">

              </textarea>
              <input type="hidden" id="sms_id" name="sms_id" >
            </div>


      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" name="btnsave">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>

  </div>
</div>

<script>
  function smsFun(id,title,message){
      $("#sms_id").val(id);
      $("#titleSMS").text(title);
      $("#message").val(message);
  }
</script>