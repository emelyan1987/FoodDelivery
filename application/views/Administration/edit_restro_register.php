<?PHP
$this->load->view("includes/Administration/header");
$this->load->view("includes/Administration/sidebar");
?>
<div class="content-wrapper">
  <section class="content">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
          <h4 class="border_bottom">Edit Restro Registration <?php ($edit_restro_reg);?></h4>
          <!-- form start -->
          <?php echo form_open_multipart('')?>
           <div class="row">
            <div class="col-md-6">
              <div class="mini-wall">
          <input type="hidden" name="cuid" class="form-control"  value="<?php echo $edit_restro_reg['id'];?>">
            <div class="form-group">
              <label for="exampleInputEmail1">Restro Name</label>
              <input type="text" name="restro_name" class="form-control" id="exampleInputEmail1"  value="<?php echo $edit_restro_reg['restro_name'];?>">
              <span style="color:red"></span>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Contact Name</label>
              <input type="text" name="contact_name" class="form-control" id="exampleInputEmail1" value="<?php echo $edit_restro_reg['contact_name'];?>">
              <span style="color:red"></span>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Restro Phone</label>
              <input type="text" name="restro_phone" class="form-control" id="exampleInputEmail1"  value="<?php echo $edit_restro_reg['restro_phone'];?>">
              <span style="color:red"></span>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Cellphone</label>
              <input type="text" name="cell_phone" class="form-control" id="exampleInputPassword1"  value="<?php echo $edit_restro_reg['cell_phone'];?>">
              <span></span>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Restro Address</label>
              <input type="text" name="restro_address" class="form-control" id="exampleInputPassword1"  value="<?php echo $edit_restro_reg['restro_address'];?>">
              <span style="color:red"></span>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Contact Email</label>
              <input type="text" name="contact_email" class="form-control" id="exampleInputPassword1"  value="<?php echo $edit_restro_reg['contact_email'];?>">
              <span style="color:red"></span>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Restro Email</label>
              <input type="text" name="restro_email" class="form-control" id="exampleInputPassword1"  value="<?php echo $edit_restro_reg['restro_email'];?>">
              <span style="color:red"></span>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Main Cuisine</label>
              <input type="text" name="main_cuisine" class="form-control" id="exampleInputPassword1"  value="<?php echo $edit_restro_reg['main_cuisine'];?>">
              <span style="color:red"></span>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Secondary Cuisine</label>
              <input type="text" name="secondary_cuisine" class="form-control" id="exampleInputPassword1" value="<?php echo $edit_restro_reg['secondary_cuisine'];?>">
              <span style="color:red"></span>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">About Us</label>
              <input type="text" name="about_us" class="form-control" id="exampleInputPassword1"  value="<?php echo $edit_restro_reg['about_us'];?>">
              <span style="color:red"></span>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Services</label>
              <input type="text" name="services" class="form-control" id="exampleInputPassword1"  value="<?php echo $edit_restro_reg['services'];?>">
              <span style="color:red"></span>
            </div>
            </div><!--minwall end-->
            </div><!--col6 end-->
            <div class="col-md-6">
              <div class="mini-wall">
            <div class="form-group">
              <label for="exampleInputPassword1">Work Time</label>
              <input type="text" name="work_time" class="form-control" id="exampleInputPassword1"  value="<?php echo $edit_restro_reg['work_time'];?>">
              <span style="color:red"></span>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Menu Link</label>
              <input type="text" name="menu_link" class="form-control" id="exampleInputPassword1"  value="<?php echo $edit_restro_reg['menu_link'];?>">
              <span style="color:red"></span>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Message</label>
              <input type="text" name="message" class="form-control" id="exampleInputPassword1" value="<?php echo $edit_restro_reg['message'];?>">
              <span style="color:red"></span>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Pickup Min Order</label>
              <input type="text" name="pickup_min_order" class="form-control" id="exampleInputPassword1"  value="<?php echo $edit_restro_reg['pickup_min_order'];?>">
              <span style="color:red"></span>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Delivery Min Order</label>
              <input type="text" name="delivery_min_order" class="form-control" id="exampleInputPassword1" value="<?php echo $edit_restro_reg['delivery_min_order'];?>">
              <span style="color:red"></span>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Delivery Charge</label>
              <input type="text" name="delivery_charge" class="form-control" id="exampleInputPassword1" value="<?php echo $edit_restro_reg['delivery_charge'];?>">
              <span style="color:red"></span>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Catering Min Order</label>
              <input type="text" name="catering_min_order" class="form-control" id="exampleInputPassword1"  value="<?php echo $edit_restro_reg['catering_min_order'];?>">
              <span style="color:red"></span>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">From</label>
              <input type="text" name="time_from" class="form-control" id="exampleInputPassword1" value="<?php echo $edit_restro_reg['time_from'];?>">
              <span style="color:red"></span>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">To</label>
              <input type="text" name="time_to" class="form-control" id="exampleInputPassword1"  value="<?php echo $edit_restro_reg['time_to'];?>">
              <span style="color:red"></span>
            </div>
            <div class="form-group" style="margin-bottom: 95px;">
              <label for="exampleInputFile">Profile Image</label>
              <input type="file" id="exampleInputFile" name="restro_logo">
              <span style="color:red">     </span>
            </div>
            </div>
            </div>
           <div class="col-md-12">
           <div class="form-action">
              <button type="submit" name="edit_restro_reg" class="btn btn-primary">Submit</button>
              </div>
            </div>
            <?php echo form_close();?>
            </div><!-- /.col-12 -->
          </div>
        </section>
      </div>
      <?PHP
$this->load->view("includes/Administration/footer");
?>