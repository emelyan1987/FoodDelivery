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
                  <a href="/contact_us_list/" class="btn bg-gray-light2"><span class="add_sign"> </span><< Back</a>
                  <br>
                  <br>
                  <h3 class="box-title">Name:&nbsp;&nbsp;<?PHP echo $c_view['fname'] ?>&nbsp;<?PHP echo $c_view['lname'] ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                   <tr>
                        <td>Name:</td><td><?PHP echo $c_view['fname']; ?> &nbsp;<?PHP echo $c_view['lname']; ?></td>
                   	<tr>
                   	<tr>
                       <td>Telephone:</td><td><?PHP echo $c_view['telephone']; ?></td>
                   	<tr>
                   			<tr>
                       <td>Email:</td><td><?PHP echo $c_view['email']; ?></td>
                   	<tr>
                   		<tr>
                   			<tr>
                       <td>Message:</td><td><?PHP echo $c_view['message']; ?></td>
                   	<tr>
                   			<tr>
                       <td>Date:</td><td><?PHP echo $c_view['date']; ?></td>
                   	<tr>
                   	                                         
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

