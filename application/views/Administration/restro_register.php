<?PHP
$this->load->view("includes/Administration/header");
$this->load->view("includes/Administration/sidebar");
?>
<link rel="stylesheet" href="<?PHP echo base_url();?>assets/Administration/plugins/datatables/dataTables.bootstrap.css">
<body>
  <div class="content-wrapper">
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <?PHP
if ($this->session->flashdata('updateMsg')) {
	?>
            <div class="alert alert-success">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>
                <?php
echo $this->session->flashdata('updateMsg');?>
              </strong>
            </div>
            <?php
}
?>
          <!--<a href='/new_customer/' class="btn bg-gray-light2"><span class="add_sign">+</span> Add New</a>-->
          <br>
          <h4>RESTAURANT REGISTRATION LIST</h4>
          <div class="clear_h10"></div>
          <div class="table-responsive">
            <table class="table table_design table-bordered" id="example2">
              <thead>
                <tr>
                  <th style="text-align: center !important;">Name<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                  <th style="text-align: center !important;">Email<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                  <th style="text-align: center !important;">Restro Phone<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                  <th style="text-align: center !important;">Address<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                  <!--  <th style="text-align: center !important;">STATUS<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th> -->
                  <th style="text-align: center !important;">Action<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                </tr>
              </thead>
              <tbody>
                <?PHP
foreach ($restro_register_list as $ks => $vs) {
	?>
                  <tr>
                    <td align="center"><?PHP echo ucfirst($vs->restro_name);?></td>
                    <td align="center"><?PHP echo $vs->restro_email;?></td>
                    <td align="center"><?PHP echo $vs->restro_phone;?></td>
                    <td align="center"><?PHP echo $vs->restro_address;?></td>
                    <!-- <td align="center"><img src="<?PHP if ($vs->image != '') {getImagePath($vs->image);} else {echo "/assets/Administration/images/user-profile.png";}
	?>" height="50" class="img-size" width="50"></td>
                    <td align="center"><?PHP if ($vs->banned == 0) {echo "<span class='text-success'>Active</span>";} else {echo "<span class='text-danger'>Deativated</span>";}
	?></td>   -->
                      <td align="center">
                        <!--<a href="/view_web_constomer/<?PHP echo $vs->id;?>" class="edit"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;&nbsp; -->
                        <a href="/edit_restro_register/<?PHP echo $vs->id;?>" class="edit"><img src="<?PHP echo base_url();?>assets/Administration/images/icon/edit.png" alt="" />Edit</a>
                        <a href="/delete_restro_register/<?PHP echo $vs->id;?>" class="delete">x</a></td>
                      </tr>
                      <?PHP
}
?>
                  </tbody>
                </table>
              </div>
              <div class="clear_h10"></div>
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
        function delCustomer(v)
        {
          var v1=confirm("Do u want to delete this Customer?");
          if(v1)
          {
            $.ajax({
              type: "POST",
              url: "/Administration/Customer/deleteCust/",
              data: {cid:v},
              cache: false,
              success: function(result)
              {
                if(result)
                {
                  window.location.reload();
                }
              }
            });
          }
        }
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