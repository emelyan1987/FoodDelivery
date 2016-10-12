<?PHP
  $this->load->view("includes/Restaurant_Owner/header"); 
  $this->load->view("includes/Restaurant_Owner/sidebar");

  foreach($restroinfo as $kt => $ut)
  {
      $resto_cu = explode(',',$ut->resto_cuisine);
     

    //$restro_services = explode(',',$ut->restro_services);
  ?>

<!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
            <!-- Content Header (Page header) -->
<section class="content">



<form role="form" method="post" action="" enctype ="multipart/form-data" >
   <div class="row">
                    <div class="col-md-12">
                    <a href="/manage_my_restro_list/" class="btn bg-gray-light2">&lt; &nbsp;Back to Restaurant List</a>
                    <div class="clear_h10"></div>
                    <?php
                    if($success_msg)
                    {
                    ?>
                        <div class="alert alert-success">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> <?php echo $success_msg; ?>
</div>
                    <?php
                    }
                    ?>
                    <h4 class="border_bottom">General Restaurant Information</h4>                   

                    <div class="table-responsive">
                    <table class="table bg-gray-light tbl" style="width:80%;">
                    <tbody><tr><td width="20%">NAME:</td>
                        <td><input type="text" class="form-control" id="exampleInputPassword1" name="restro_name" placeholder="Enter retaurant Name" value="<?php echo trim($ut->restro_name); ?>">
                      <span style="color:red"><?PHP  echo form_error('restro_name'); ?></span></td></tr>
                    <tr><td>RESTAURANT INFORAMTION:</td>
                        <td><textarea id="Text13" class="form-control" name="restro_description"><?php echo $ut->restro_description; ?></textarea></td></tr>
                    <tr>
                        <td>LOGO:</td>
                        <td>
                          <input type="file" id="exampleInputFile" name="logo">
                          

                          <!--<span style="color:red"><?PHP //echo isset($logo)?$logo:"";  ?><?php //echo form_error('logo'); ?>  </span>-->

                        </td>
                    </tr>
                    <?php
                    if($ut->restaurant_logo != '')
                    {
                    ?>
                    
                    <tr>
                      <td></td>
                      <td>
                          <div class="form-group">
                              
                                <div class="col-md-4"><img src="<?php getImagePath($ut->restaurant_logo); ?>" class="img-thumbnail"></div>
                          </div>
                      </td>
                    </tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <td>GALLERY IMAGES:</td>
                        <td>
                          <input type="file" id="exampleInputFile" name="uploadedimages[]">
                          <input type="file" id="exampleInputFile" name="uploadedimages[]">
                          <input type="file" id="exampleInputFile" name="uploadedimages[]">
                          <input type="file" id="exampleInputFile" name="uploadedimages[]">

                          <!--<span style="color:red"><?PHP //echo isset($image_errors)?$image_errors:"";  ?>   <?php //echo form_error('uploadedimages[]'); ?>  </span>-->

                        </td>
                    </tr>
                    <tr>
                      <td></td>
                      <td>
                          <div class="form-group">
                              <?php
                              foreach($restroimg as $mk => $tk)
                              {
                              ?>
                                <div class="col-md-4"><img src="<?php $img = explode('public_html',$tk->restro_images); 
                              echo $img[1];?>" class="img-thumbnail"></div>
                              <?php
                              }
                              ?>

                          </div>
                      </td>
                    </tr>
                    <tr><td>CONTACT PERSON:</td>
                        <td><input id="Text15" type="text" class="form-control" name="contact_person" value="<?php echo trim($ut->contact_person); ?>"></td></tr>
                    <tr><td>TELEPHONES:</td>
                        <td><input id="Text16" type="text" class="form-control" name="telephones" value="<?php echo trim($ut->telephones); ?>"></td></tr>
                    
                    </tbody></table> 
                    </div>


                    <h4 class="border_bottom">Restaurant Setup</h4> 
                    <h5>ASSIGN RESTAURANT TO CUISINE</h5>                  
                    <div class="col-md-10" id="showallcuisine">
                    <?php
                            foreach($cuisin as $cu => $ui):
                            ?>
                           <div class="col-md-4">
                            <label class="checkbox"><input type="checkbox" name="resto_cuisine[]" value="<?php echo $ui->id; ?>" <?php $cVal = check_cuisine($ui->id,$ut->id); if($cVal == 1){ echo "checked";} ?>> 
                            <?php echo ucwords($ui->name); ?> </label> </div>
                            <?php
                            endforeach;
                            ?>
                    </div>
                    <div class="col-md-3">
                    <!--<a href="#" data-toggle="modal" data-target="#myModal" class="edit text-blue"><i class="fa fa-pencil text-blue"></i> Edit Cuisine list</a>-->
                    </div>
                    
                    <div class="clear_h10"></div>
                    
                    <h5>ASSIGN RESTAURANT TO FOOD TYPE</h5>                  
                    <div class="col-md-10" id="foodtypeshow">
                        
                        <?php
                        foreach($food_type as $food => $fType):
                        ?>
                        <div class="col-md-4">
                          <label class="checkbox"><input type="checkbox" name="food_type[]" value="<?php echo $fType->id; ?>" <?php if(check_foodtype($fType->id,$ut->id) == 1){ echo "checked";} ?>> 
                        <?php echo ucwords($fType->food_title); ?></label>  </div>
                        <?php
                        endforeach;
                        ?>

                        <!--<select name="restro_food_type" class="form-control">
                            
                            <option value="">--Food Type--</option>
                            <option value="veg" <?php if($ut->restro_food_type == 'veg'){ echo "selected"; } ?>>Veg</option>
                            <option value="non_veg" <?php if($ut->restro_food_type == 'non_veg'){ echo "selected"; } ?>>Non-veg</option>
                            <option value="both" <?php if($ut->restro_food_type == 'both'){ echo "selected"; } ?>>Both</option>
                            
                            
                      </select>-->
                            <span style="color:red"><?PHP  echo form_error('food_type[]'); ?></span>
                    </div>
                    <div class="col-md-3">
                    <!--<a href="#" data-toggle="modal" data-target="#myModal12" class="edit text-blue"><i class="fa fa-pencil text-blue"></i>  Edit Food typelist</a>-->
                    </div>
                    <div class="clear_h10"></div>

                    <h5>ASSIGN RESTAURANT TO CATEGORY</h5>                  
                    <div class="col-md-10">
                        
                        
                        <?php foreach($seo_category as $ks => $vs): ?>
                        <div class="col-md-4" >
                          <label class="checkbox"><input type="checkbox" name="seo_cat[]" value="<?php echo $vs->id; ?>" <?php if(restroseoCatChk($vs->id,$ut->id) == 1){ echo "checked"; } ?>> <?php echo ucwords($vs->name); ?>
                          </label></div>
                        <?PHP endforeach; ?>
                       <br>
                        <span style="color:red"><?PHP  echo form_error('item_cat'); ?></span>
                    </div>
                    <div class="clear_h10"></div>
                    <h5>RESTAURANT STATUS</h5>                  
                    <div class="col-md-10">
                          <select name="restro_status">
                              <option value="1" <?php if($ut->status == 1){ echo "selected"; } ?>>Open</option>
                              <option value="2" <?php if($ut->status == 2){ echo "selected"; } ?>>Busy</option>
                              <option value="0" <?php if($ut->status == 0){ echo "selected"; } ?>>Closed</option>
                          </select>
                         
                       
                    </div>
                    <div class="clear_h10"></div>
                    <button type="submit" class="btn bg-green" name="btnsave">Save</button>&nbsp;
                    
                    </div>
                    </div>
                 </div>

</form>


                  </section>





<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Cuisine</h4>
      </div>
      <div class="modal-body">
       <input type="text" name="cusineName" id="cusineName" class="form-control" placeholder="Enter Cuisine Title">
       <input type="hidden" id="userid" value="<?php echo $this->tank_auth->get_user_id(); ?>">
       <br>
       <textarea id="cuisinedescription" class="form-control">Cuisine Description here</textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" onclick="addcuisine();">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

      </div>
    </div>

  </div>
</div>





<!-- Modal -->
<div id="myModal12" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Food Type</h4>
      </div>
      <div class="modal-body">
       <input type="text" id="foodtype" class="form-control" placeholder="Enter Food Type Title">
       <input type="hidden" id="userid" value="<?php echo $this->tank_auth->get_user_id(); ?>">
       <br>
       <textarea id="foodtypedescription" class="form-control">Food Type Description here</textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" onclick="addfoodtype();">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

      </div>
    </div>

  </div>
</div>




</div>
<?PHP
}
  $this->load->view("includes/Restaurant_Owner/footer");
?>

<script>
    function addcuisine(){
      var cuisine = document.getElementById('cusineName').value;
      var userid = document.getElementById('userid').value; 
      var desc = document.getElementById('cuisinedescription').value;
      if(cuisine != '')
      {
              
                  $.ajax({

                  url: "/ajax_cuisine_add/",
                  type: "post",
                  data: {cName:cuisine,userid:userid,adminid:0,cuisine_desc:desc} ,
                  success: function (response) {
                      //alert(response);              
                      $("#showallcuisine").html(response);

                      $('#myModal').modal('hide')
                  }
                })
      }
        
    }
</script>

<script>
    function addfoodtype(){
      var foodtype = document.getElementById('foodtype').value;
      var userid = document.getElementById('userid').value; 
      var description = document.getElementById('foodtypedescription').value;

      if(foodtype != '')
      {
              
                  $.ajax({

                  url: "/ajax_food_type_add/",
                  type: "post",
                  data: {food_type:foodtype,user_id:userid,admin_id:0,food_type_desc:description} ,
                  success: function (response) {
                      //alert(response);              
                      $("#foodtypeshow").html(response);

                      $('#myModal12').modal('hide')
                  }
                })
      }
        
    }
</script>

<script>
  function showState(str){
    

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {

     document.getElementById("state").innerHTML = xhttp.responseText;
      }
    };
    xhttp.open("GET","/show_state/"+str, true);
    xhttp.send();
  }
</script> 




<script>
    function showCity(str){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {

              document.getElementById("city").innerHTML = xhttp.responseText;
        }
      };
      xhttp.open("GET","/show_city/"+str, true);
      xhttp.send();
    }
</script>
