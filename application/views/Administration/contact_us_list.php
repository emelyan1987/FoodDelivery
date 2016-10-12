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
                  <!--<a href="/add_item/" class="btn bg-gray-light2"><span class="add_sign">+</span> Add New</a>-->
                  <br>
                  <br>
                  <h3 class="box-title">List of Contacts</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>NAME<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                        <!--<th>JOB_TITLE<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>-->
                        <th>TELEPHONE<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                        <th>EMAIL<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                        <th>MESSAGE<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
						<th>DATE<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                        <th>Action<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>

                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($c_list as $ks => $vs):

?>

                    <tr>
                        <td><?php echo ucwords($vs->fname);?> &nbsp;&nbsp; <?php echo ucwords($vs->fname);?></td>

                        <td><?php echo $vs->telephone;?></td>
                        <td><?php echo $vs->email;?></td>
                        <td><?php echo $vs->message;?></td>
						<td><?php echo $vs->date?></td>

                        <td>

                          <a href="/view_contact/<?php echo $vs->id;?>" class="edit border-gray padding_less"><i class="fa fa-eye" aria-hidden="true"></i></a>

                          <a href="javascript:void(0)" onClick="delete_contact(<?php echo $vs->id;?>)" class="delete">x</a>
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
    <script>
    function delete_contact(value)
    {
        var cn=confirm("Do you want to delete this contact?");
		  if(cn==true)
		  {
			   $.ajax({
				    method:"post",
                    url:"/Administration/Contact_us/delete_contact",
                    data:{v:value},
                    success:function(response)
					{
						window.location.reload();
					}

			   });
		  }


    }
    </script>