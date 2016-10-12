<?PHP
  $this->load->view("includes/Restaurant_Owner/header"); 
  $this->load->view("includes/Restaurant_Owner/sidebar");

  foreach($restroinfo as $kt => $ut)
  {
      
  ?>

<!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
     <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">View Retaurant  

                 </h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" action='' enctype ="multipart/form-data" >
                  <div class="box-body">

                   
                     <div class="form-group">
                      <label class="col-md-4" >Retaurant Name</label>
                      <?php echo $ut->restro_name; ?>

                    </div>

                     <div class="form-group">
                      <label class="col-md-4" >Retaurant Address</label>
                      <?php echo $ut->restro_address; ?>
                    </div>



                       <!--<div class="form-group">
                      <label class="col-md-4">Retaurant Services</label>
                      <?php //echo $ut->restro_services; ?>
                      
                     <input type="checkbox" name="restro_services[]" value="1">DELIVERY
                      <input type="checkbox" name="restro_services[]" value="2">CATERING
                      <input type="checkbox" name="restro_services[]" value="3">RESERVATION
                      <input type="checkbox" name="restro_services[]" value="4">PICKUP

                 
                    </div>-->




                     <div class="form-group">
                      <label class="col-md-4">Country</label>
                      <?php echo $ut->restro_country; ?>
                    </div>

                     <div class="form-group">
                      <label class="col-md-4">State</label>
                       <?php echo $ut->restro_state; ?>
                    </div>
                    <div class="form-group">
                      <label class="col-md-4">City</label>
                      <?php echo $ut->restro_city; ?>
                      
                    </div>
                  <div class="form-group">
                      <label class="col-md-4">Latitude</label>
                     <?php echo $ut->restro_latitude; ?>
                  </div>

                  <div class="form-group">
                      <label class="col-md-4">Longitude</label>
                      <?php echo $ut->restro_longitude; ?>
                  </div>
                    
                     
                  <div class="form-group">
                      <label class="col-md-4">Restaurant near by</label>
                      <?php echo $ut->restro_near_by; ?>
                  </div>

                  <div class="form-group">
                      <label class="col-md-4">Room Type</label>
                      <?php echo $ut->restro_type; ?>
                  </div>

                  <div class="form-group">
                      <label class="col-md-4">Food Type</label>
                      <?php echo $ut->restro_food_type; ?>
                  </div>
                  <div class="form-group">
                    <label class="col-md-4">&nbsp;</label>
                    <a href="/edit_owner_restro/<?php echo $ut->id; ?>" class="btn btn-info">Edit </a>
                  </div>


                  </div><!-- /.box-body -->

                  
                </form>
              </div><!-- /.box -->
          </div>

      </div>
  </section>
</div>
</div>
<?PHP
}

  $this->load->view("includes/Restaurant_Owner/footer");
?>
