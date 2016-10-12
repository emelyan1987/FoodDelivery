<?PHP
  $this->load->view("includes/Administration/header"); 
  $this->load->view("includes/Administration/sidebar");
  ?>

  <body>
  <div class="content-wrapper">



 <section class="content">
                <div class="row">
                    <div class="col-md-12">
                    <!--<a href="AddRestaurant.html" class="btn bg-gray-light2">&lt; &nbsp;Back to Add Restaurant</a>-->
                    <div class="clear_h10"></div>
                    <h4 class="border_bottom">Lists - Menu Category Setup</h4>                   
                    <div class="clear_h10"></div> 
                                     
                    <div class="table-responsive">
                    <table class="table table_design tbl" style="width:60%;">
                    <tbody>
                      <?php
                      foreach($category as $cat => $catdata):
                      ?>
                    <tr><td><?php echo ucwords($catdata->cat_name); ?></td>
                        <td align="right"><a href="/delete_item_category/<?php echo $catdata->id; ?>" class="delete">x</a></td>
                    </tr>
                    <?php
                      endforeach;
                    ?>
                    </tbody></table>
                    </div>
              <form action="" method="post" >
                    <input id="Text1" type="text" class="pad7" name="item_category">
                    <!--&nbsp; &nbsp;
                    <a href="" class="btn bg-gray-light2"><span class="add_sign">+</span> Add</a>-->
                    
                    <div class="clear_h10"></div>                   
                   <button type="submit" class="btn bg-green" name="btncategory">Save</button>
              </form>

                   
                    </div>
                 </div>
            </section>
      </div><!-- /.content-wrapper -->
<?PHP
  $this->load->view("includes/Administration/footer");
?>
