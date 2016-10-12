<?PHP
  $this->load->view("includes/Restaurant_Owner/header"); 
  $this->load->view("includes/Restaurant_Owner/sidebar");
  ?>

<!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
            <!-- Content Header (Page header) -->
<section class="content">
          <div class="row">
            <div class="col-xs-12">
         <div class="box">
                <div class="box-header">
                  <h4 class="border_bottom">Manage Item Category</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Item Category Name</th>
                        <th>Image</th>
                        <th>Description</th>
                        
                        <th>Status</th>
                        <th>Action</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach($item_list as $ks => $vs): 

                    ?>                    
                               
                    <tr>
                        <td><?php echo ucwords($vs->cat_name);?></td>
                        <td>
                      <?php
                      if($vs->image != '')
                      {
                      ?>

                          <img src="<?php $img = explode('public_html',$vs->image); 
                        echo $img[1];?>" height="60">
                      <?php
                      }
                      ?></td>
                        <td><?php echo $vs->item_cat_description;?></td>
                        
                        <td><?php if($vs->status==1) { echo "Active"; } else { echo "Deactive"; } ?>
                        </td>
                        <td>
                          <a href="/edit_menu_category/<?php echo $vs->id; ?>" class="edit border-gray padding_less"><i class="fa fa-pencil text-blue" aria-hidden="true"></i> Edit</a>
                          
                          <a href="/delete_my_item_cat/<?php echo $vs->id; ?>" class="delete">x</a>
                        </td>
                        
                    </tr>
                    <?PHP

                    endforeach;

                    ?>
                                           
                         
                                          </tbody>
                    
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>
</div>
<?PHP
  $this->load->view("includes/Restaurant_Owner/footer");
?>
