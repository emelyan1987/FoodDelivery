<?PHP
  $this->load->view("includes/Restaurant_Owner/header"); 
  $this->load->view("includes/Restaurant_Owner/sidebar");
  ?>

<!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
     <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <a href="/restro_dashboard/" class="btn bg-gray-light2">&lt; &nbsp;Back to Dashboard</a>
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h4 class="border_bottom">Add / Update Loyalty Point</h4>
                </div><!-- /.box-header -->
                <!-- form start -->
  
   <?php
                    if($lo_message)
                    {
                    ?>
                        <div class="alert alert-success">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> <?php echo $lo_message; ?>
</div>
                    <?php
                    }
                    ?>
  
  
                
                
                <form role="form" method="post" action='' enctype ="multipart/form-data" >
                  <div class="box-body">
          
                     <div class="form-group">
                      <label for="exampleInputPassword1">Loyalty Point</label>
                      <input type="text" class="form-control" id="points_value" name="points_value" value="<?php echo $point['points_value']; ?>"  placeholder="Enter Loyalty Point">
                      <span style="color:red"><?PHP  echo form_error('points_value'); ?></span>

                    </div>

                     





                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-success">Update</button>
                  </div>
                </form>
              </div><!-- /.box -->
          </div>

      </div>
  </section>
</div>
</div>
<?PHP
  $this->load->view("includes/Restaurant_Owner/footer");
?>
