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
              <a href="/restro_item_category_list/" class="btn bg-gray-light2">&lt; &nbsp;Back to Add Menu Category</a>
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h4 class="border_bottom">Add Menu Category</h4>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" action='/restro_add_item_category/' enctype ="multipart/form-data" >
                  <div class="box-body">

                   
                     <div class="form-group">
                      <label for="exampleInputPassword1">Menu Category Name</label>
                      <input type="text" class="form-control" id="exampleInputPassword1" name="cat_name" placeholder="Enter Menu Category Name">
                      <span style="color:red"><?PHP  echo form_error('cat_name'); ?></span>

                    </div>

                     <div class="form-group">
                      <label for="exampleInputPassword1">Menu Category Description</label>
                      <textarea class="form-control" id="exampleInputPassword1" name="item_cat_description" placeholder="Enter Menu Category Description"></textarea> 
                    
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Menu Category Image</label>
                      <input type="file" name="uploadedimages" class="form-control">
                    
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Active</label>
                      <input type="checkbox" name="status" value="1"> 
                    
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
  $this->load->view("includes/Restaurant_Owner/footer");
?>
