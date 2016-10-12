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
                 <a href="/careers_list/" class="btn bg-gray-light2"><span class="add_sign"> </span><< Back</a>
                  <br>
                  <br>
                  <h3 class="box-title">Name:&nbsp;&nbsp;<?PHP echo $c_view['fname'] ?>&nbsp;<?PHP echo $c_view['lname'] ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                   <tr>
                        <td>Job Title:</td><td><?PHP echo $c_view['job_title']; ?></td>
                   	</tr>
                   	<tr>
                       <td>Telephone:</td><td><?PHP echo $c_view['telephone']; ?></td>
                   	</tr>
                   			<tr>
                       <td>Email:</td><td><?PHP echo $c_view['email']; ?></td>
                   	</tr>
                   		<tr>
                   			
                   		
                   		<tr>
                   			<tr>
                   				<td>Download Resume</td>
                       <td> <?php 
                         $img = explode('public_html',$c_view['image']); 
                         //echo $img[1];
                           ?>
                           <a href="<?PHP echo base_url().$img[1]; ?>" download="" class="fa fa-download"></a>
                         </td> 
                   	</tr>
                   	                                         
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

