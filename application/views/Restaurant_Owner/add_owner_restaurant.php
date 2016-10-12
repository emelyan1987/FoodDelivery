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
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Add New Retaurant  

                 </h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" action='/add_owner_restaurant/' enctype ="multipart/form-data" >
                  <div class="box-body">

                   
                     <div class="form-group">
                      <label for="exampleInputPassword1">Retaurant Name</label>
                      <input type="text" class="form-control" id="exampleInputPassword1" name="restro_name" placeholder="Enter retaurant Name">
                      <span style="color:red"><?PHP  echo form_error('restro_name'); ?></span>

                    </div>

                     <div class="form-group">
                      <label for="exampleInputPassword1">Retaurant Address</label>
                      <textarea class="form-control" id="exampleInputPassword1" name="restro_address" placeholder="Enter retaurant Name"></textarea> 
                    <span><?PHP  echo form_error('restro_address'); ?></span>
                    </div>



                      <div class="form-group">
                      <label for="exampleInputPassword1">Retaurant Services</label>
                      <br>
                      
                      <input type="checkbox" name="restro_services[]" value="1">DELIVERY
                      <input type="checkbox" name="restro_services[]" value="2">CATERING
                      <input type="checkbox" name="restro_services[]" value="3">RESERVATION
                      <input type="checkbox" name="restro_services[]" value="4">PICKUP

                    <span><?PHP  echo form_error('restro_address'); ?></span>
                    </div>




                     <div class="form-group">
                      <label for="exampleInputPassword1">Country</label>
                      <select name="restro_country" class="form-control">
                            <option value="">--country--</option>
                            <option value="india">india</option>
                      </select>
                      <span style="color:red"><?PHP  echo form_error('restro_country'); ?></span>
                    </div>

                     <div class="form-group">
                      <label for="exampleInputPassword1">State</label>
                       <select name="restro_state" class="form-control">
                            <option value="">--state--</option>
                            <option value="bihar">bihar</option>
                       </select>
                       <span style="color:red"><?PHP  echo form_error('restro_state'); ?></span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">City</label>
                      <select name="restro_city" class="form-control">
                            <option value="">--city--</option>
                            <option value="india">chhapra</option>
                      </select>
                      <span style="color:red"><?PHP  echo form_error('restro_city'); ?></span>
                    </div>
                  <div class="form-group">
                      <label for="exampleInputPassword1">Latitude</label>
                      <input type="text" class="form-control" id="exampleInputPassword1" name="restro_latitude" placeholder="Enter retaurant Name">
                    <span><?PHP  echo form_error('restro_latitude'); ?></span>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputPassword1">Longitude</label>
                      <input type="text" class="form-control" id="exampleInputPassword1" name="restro_longitude" placeholder="Enter retaurant Name">
                     <span style="color:red"><?PHP  echo form_error('restro_longitude'); ?></span>
                    </div>
                    
                     
                    <div class="form-group">
                      <label for="exampleInputPassword1">Restaurant near by</label>
                      <input type="text" class="form-control" id="exampleInputPassword1" name="restro_near_by" placeholder="Enter restro_near_by">
                    <span><?PHP  echo form_error('restro_near_by'); ?></span>
                    </div>

                     <div class="form-group">
                      <label for="exampleInputPassword1">Room Type</label>

                        <select name="restro_type" class="form-control">
                            <option value="">--Type--</option>
                            <option value="ac">Ac</option>
                            <option value="non_ac">Non-Ac</option>
                            <option value="both">Both</option>
                            
                      </select> 
                          <span style="color:red"><?PHP  echo form_error('restro_type'); ?></span>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputPassword1">Food Type</label>
                       <select name="restro_food_type" class="form-control">
                            
                            <option value="">--Food Type--</option>
                            <option value="veg">Veg</option>
                            <option value="non_veg">Non-veg</option>
                            <option value="both">Both</option>
                            
                            
                      </select>
                            <span style="color:red"><?PHP  echo form_error('restro_food_type'); ?></span>
                    </div>


                    <div class="form-group">
                      <label for="exampleInputFile">Gallery Image</label>
                      <input type="file" id="exampleInputFile" name="uploadedimages[]">
                      <input type="file" id="exampleInputFile" name="uploadedimages[]">
                      <input type="file" id="exampleInputFile" name="uploadedimages[]">
                      <input type="file" id="exampleInputFile" name="uploadedimages[]">

                      <span style="color:red"><?PHP echo isset($image_errors)?$image_errors:"";  ?>   <?php echo form_error('uploadedimages[]'); ?>  </span>
                      
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
  $this->load->view("includes/Restaurant_Owner/footer");
?>
