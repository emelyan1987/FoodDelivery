<?PHP
  $this->load->view("includes/Restaurant_Owner/header"); 
  $this->load->view("includes/Restaurant_Owner/sidebar");

  foreach($category_data as $cat => $category):
  ?>

<!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
     <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-8">

              <a href="/restro_item_category_list/" class="btn bg-gray-light2">&lt; &nbsp;Back to Edit Menu Category</a>
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h4 class="border_bottom">Edit Menu Category</h4>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" action='' enctype ="multipart/form-data" >
                  <div class="box-body">

                   
                     <div class="form-group">
                      <label for="exampleInputPassword1">Menu Category Name</label>
                      <input type="text" class="form-control" id="exampleInputPassword1" name="cat_name" placeholder="Enter Menu Category Name" 
                      value="<?php echo $category->cat_name; ?>">
                      <span style="color:red"><?PHP  echo form_error('cat_name'); ?></span>

                    </div>

                     <div class="form-group">
                      <label for="exampleInputPassword1">Menu Category Description</label>
                      <textarea class="form-control" id="exampleInputPassword1" name="item_cat_description" placeholder="Enter Menu Category Description"><?php echo $category->item_cat_description; ?></textarea> 
                    
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Menu Category Image</label>
                      <input type="file" name="uploadedimages" class="form-control">
                    
                    </div>
                    <?php
                    if($category->image != '')
                    {
                    ?>
                    
                    <div class="form-group">
                      <label for="exampleInputPassword1">&nbsp;</label>
                     <div class="col-md-4"><img src="<?php getImagePath($category->image); ?>" class="img-thumbnail"></div>
                    
                    </div>
                    <?php
                    }
                    ?>
                    <div style="clear:both;">&nbsp;</div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Active</label>
                      <input type="checkbox" name="status" value="1" <?php if($category->status == 1){ echo "checked"; } ?>> 
                    
                    </div>





                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                  </div>
                </form>
              </div><!-- /.box -->
          </div>

      </div>
  </section>
</div>
</div>
<?PHP
endforeach;
  $this->load->view("includes/Restaurant_Owner/footer");
?>
