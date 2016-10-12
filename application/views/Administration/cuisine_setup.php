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
                    <h4 class="border_bottom">Lists - Food Category Setup</h4>                   
                    <div class="clear_h10"></div> 
                    <h4>CUISINE</h4>                  
                    <div class="table-responsive">
                    <table class="table table_design tbl" style="width:60%;">
                    <tbody>
                      <?php
                      foreach($cuisine_list as $cu => $cuisine):

                      ?>
                    <tr>
                          <td><?php echo ucwords($cuisine->name); ?></td>
                          <td align="right"><a href="/delete_cuisine/<?php echo $cuisine->id; ?>" class="delete">x</a></td>
                    </tr>
                    <?php
                    endforeach;
                    ?>
                    </tbody></table>
                    </div>
                    <form action="" method="post">
                    <input id="Text1" type="text" class="pad7" required name="cuisineName">
                    <!--&nbsp; &nbsp;
                    <a href="" class="btn bg-gray-light2"><span class="add_sign">+</span> Add</a>-->
                    
                    <div class="clear_h10"></div>                   
                   <button type="submit" class="btn bg-green" name="btncuisine">Save</button>
                 </form>

                   <div class="clear_h20"></div>
                   <h4>FOOD TYPE</h4>                  
                    <div class="table-responsive">
                    <table class="table table_design tbl" style="width:60%;">
                    <tbody>
<?php
foreach($foodtype as $food => $fType):
?>
                      <tr><td><?php echo $fType->food_title; ?></td>
                        <td align="right"><a href="/delete_foodtype/<?php echo $fType->id; ?>" class="delete">x</a></td></tr>
<?php
endforeach;
?>
                    </tbody></table>
                    </div>
                    <form action="" method="post">
                    <input id="Text2" type="text" class="pad7" name="foodtype">
                    <!--&nbsp; &nbsp;
                    <a href="" class="btn bg-gray-light2"><span class="add_sign">+</span> Add</a>-->
                    
                  <div class="clear_h10"></div>                   
                   <button type="submit" class="btn bg-green" name="btnfood">Save</button>
                 </form>
                   <div class="clear_h20"></div>
                   <h4>RESTAURANT CATEGORY</h4>                  
                    <div class="table-responsive">
                    <table class="table table_design tbl" style="width:60%;">
                    <tbody>

<?php
foreach($seocategory as $seocat => $cat):
?>
                    <tr><td><?php echo $cat->name; ?></td>
                        <td align="right"><a href="/delete_seo_category/<?php echo $cat->id; ?>" class="delete">x</a></td></tr>
<?php
endforeach;
?>
                    </tbody></table>
                    </div>
                    <form action="" method="post">
                    <input id="Text3" type="text" class="pad7" name="category">
                    <!--&nbsp; &nbsp;
                    <a href="" class="btn bg-gray-light2"><span class="add_sign">+</span> Add</a>-->
                    
                    <div class="clear_h10"></div>                   
                   <button type="submit" class="btn bg-green" name="btncat">Save</button>
                 </form>

                   
                   </div> 
                 </div>
            </section>
      </div><!-- /.content-wrapper -->
<?PHP
  $this->load->view("includes/Administration/footer");
?>
