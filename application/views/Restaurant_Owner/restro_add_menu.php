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
                  <h3 class="box-title">Manage Restaurant Category  

                 </h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" action='/restro_add_menu/<?php echo $restro_id; ?>' enctype ="multipart/form-data" >
                  <div class="box-body">

                   
                     
                    <div class="form-group">
                      <label for="exampleInputPassword1">Item Category</label>
                      <select class="form-control" name="item_cat[]" multiple>
                        
                        <?php foreach($cat_list as $ks => $vs): ?>
                        <option value="<?php echo $vs->id; ?>" <?php if(in_array($vs->id,$select_arr)){ echo "selected"; } ?>><?php echo $vs->cat_name; ?></option>
                        <?PHP endforeach; ?>
                      </select>
                      <span style="color:red"><?PHP  echo form_error('item_cat'); ?></span>

                    </div>
                   
                    <div class="form-group">
                      <label for="exampleInputPassword1"></label>
                      <input type="hidden" name="restro_id" value="<?php echo $restro_id; ?>"> 
                      <span style="color:red"><?PHP  echo form_error('restro_id'); ?></span>
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
