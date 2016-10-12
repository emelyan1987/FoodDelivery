<?PHP
  $this->load->view("includes/Administration/header"); 
  $this->load->view("includes/Administration/sidebar");
  ?>
     <div class="content-wrapper">
     <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h2>Change Password  
                   
                 </h2>
                 <br>
                 
                  <?PHP  echo isset($change_msg)?$change_msg:""; ?>

                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" action='/admin_change_password/' enctype ="multipart/form-data" >
                  <div class="box-body">

                  	<!--<div class="form-group">
                      <label for="exampleInputEmail1">Enter You Old Password</label>
                      <input type="password" name="pass" class="form-control" id="exampleInputEmail1" placeholder="Enter You Old Password" value="<?PHP //echo set_value('pass') ?>">
                    <span style="color:red"><?PHP  //echo form_error('pass'); ?></span>
                    </div>-->
                    <div class="form-group">
                      <label for="exampleInputEmail1">Enter Your New Password</label>
                      <input type="password" name="new_pass" class="form-control" id="exampleInputEmail1" placeholder="Enter Your New Password" value="<?PHP echo set_value('new_pass') ?>">
                     <span style="color:red"><?PHP  echo form_error('new_pass'); ?></span>
                   
                    </div >
                  	<div class="form-group">
                      <label for="exampleInputEmail1">Enter Your Confirm Password</label>
                      <input type="password" name="confirm_pass" class="form-control" id="exampleInputEmail1" placeholder="Enter Your Confirm Password" value="<?PHP echo set_value('confirm_pass') ?>">
                   <span style="color:red"><?PHP  echo form_error('confirm_pass'); ?></span>

                    </div>


                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div><!-- /.box -->
          </div>

      </div>
  </section>
</div>
</div>


<?PHP
  $this->load->view("includes/Administration/footer");
?>