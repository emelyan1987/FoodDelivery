<?PHP
$this->load->view("includes/Administration/header");
$this->load->view("includes/Administration/sidebar");
?>
   <body class="hold-transition skin-green">

          <!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
            <!-- Content Header (Page header) -->

            <!-- Main content -->

            <section class="content">
                 <div class="row">
                    <div class="col-md-12">
                      <?PHP
echo isset($success) ? $success : "";

?><br>

                    <a href="/restaurant_list/" class="btn bg-gray-light2">< &nbsp;Back to Restaurant List</a>
                    <div class="clear_h10"></div>
                    <h4 class="border_bottom">General Restaurant Information</h4>

                    <div class="table-responsive">
                      <form method="post" enctype="multipart/form-data">
                    <table class="table bg-gray-light tbl" style="width:80%;">
                    <tr><td width="20%">Owner Code:</td>


                        <td><select onChange="checkOwnerId(this.value)"  id="owner_code" name="owner_code" class="form-control">
                               <option value="">--Owner Code--</option>
                               <?PHP
foreach ($owner_code_list as $ks => $vs) {
	if ($vs->owner_id != "") {
		echo "<option value='$vs->owner_id'>$vs->owner_id</option>";
	}
}
?>
                        </select>
                        <span style="color:red" class="ownerCodeMsg"><?PHP echo form_error('owner_code');?></span>
                        </td>

                      </tr>



                        <tr><td width="20%">Name:</td>
                        <td><input class="form-control" id="name" type="text" name="restro_name" placeholder="Name"/> <span style="color:red"><?PHP echo form_error('restro_name');?></span></td></tr>

                    <tr><td>Restaurant Information:</td>
                        <td><input class="form-control" id="restro_info" type="text" name="restro_info" placeholder=" Restaurant Information"/><span style="color:red"><?PHP echo form_error('restro_info');?></span></td></tr>
                    <tr><td>Logo:</td>
                        <td><input id="restro_logo" type="file" name="restro_logo" placeholder="Owner Code"/><br><span style="color:red"> <?PHP echo isset($image_errors) ? $image_errors : "";?></span> </td></tr>

                         <tr><td>Gallery Images:</td>
                        <td><input id="gallery_image" type="file" name="gallery_image[]" /><input id="gallery_image" type="file" name="gallery_image[]" /><input id="gallery_image" type="file" name="gallery_image[]" /><input id="gallery_image" type="file" name="gallery_image[]" /><br><span style="color:red"> <?PHP echo isset($image_errors2) ? $image_errors2 : "";?></span> </td></tr>

                    <tr><td>Contact Person:</td>
                        <td><input class="form-control" id="comtact_person" type="text" name="contact_person" placeholder="Contact Person"/><span style="color:red"><?PHP echo form_error('contact_person');?></span></td></tr>
                    <tr><td>Telephones:</td>
                        <td><input class="form-control" id="phone" type="text" name="telephones" placeholder="Telephones"/><span style="color:red"><?PHP echo form_error('telephones');?></span></td></tr>
                    <tr><td>Fixed Yearly Fees:</td>
                        <td>

                          <!--<select id="yearly_fee" name="yearly_fee">
                            <?php
//foreach($planData as $pl => $plan):
?>
                              <option value="<?php //echo $plan->plan_price; ?>"><?php //echo $plan->plan_name." (".$plan->plan_price." KD )"; ?></option>
                            <?php
//endforeach;
?>
                          </select>-->

                          <input class="form-control" id="yearly_fee" type="text" name="yearly_fee" placeholder="Fixed Yearly Fees"/>
                          <span style="color:red"><?PHP echo form_error('yearly_fee');?></span></td></tr>
                        <tr><td>Select Status:</td>


                        <td><select class="form-control" name="restro_status">
                             <option value="">Restaurant Status</option>
                             <option value="1">Featured Restaurant</option>
                             <option value="3">Newly Opened</option>
                             <option value="2">Promotions</option>
                             <option value="4">Coupons </option>
                          </select><span style="color:red"><?PHP echo form_error('restro_status');?></span></td></tr>
                    </table>
                    </div>
                     <h4 class="border_bottom">Restaurant Setup</h4>
                    <h5>Assign Restaurant To Cuisine</h5>
                    <div class="col-md-8" id="cuisine_list">

                       <?PHP
foreach ($cuisine_list as $ks => $vs) {
	?>

                                  <div class="col-md-4">
                                    <label class="checkbox"><input type="checkbox" name="cuisine[]" value="<?PHP echo $vs->id?>"><?PHP
echo $vs->name;?></label>
                                </div>

                              <?PHP

}

?>
                    </div>
                    <div class="col-md-4">

                    <a href="#"  data-toggle="modal" data-target="#myModalCuisine" class="edit text-blue"> <img src="<?PHP echo base_url();?>assets/Administration/images/icon/edit.png" alt="" /> Add Cuisine list</a>

                    </div>
                    <div class="clear_h10"></div>

                    <h5>Assign Restaurant To Food Type</h5>
                    <div class="col-md-8" id="food_type">


                       <?PHP
foreach ($food_type_list as $ks => $vs) {
	?>
                                 <div class="col-md-4"><label class="checkbox"><input type="checkbox" name="food_type[]" value="<?PHP echo $vs->id?>"><?PHP
echo $vs->food_title;?></label></div>
                              <?PHP

}

?>



                    </div>
                    <div class="col-md-4">
                    <a href="#" data-toggle="modal" data-target="#myModalFoodType" class="edit text-blue"><img src="<?PHP echo base_url();?>assets/Administration/images/icon/edit.png" alt="" /> Add Food typelist</a>
                    </div>
                    <div class="clear_h10"></div>

                    <h5>Assign Restaurant To Category</h5>
                    <div class="col-md-8" id="category_list">
                     <?PHP
foreach ($get_seo_category_list as $ks => $vs) {
	?>
                                 <div class="col-md-4"><label class="checkbox"><input type="checkbox" name="restro_seo_cat[]" value="<?PHP echo $vs->id?>"><?PHP
echo $vs->name;?></label></div>
                              <?PHP

}

?>
                    </div>
                    <div class="col-md-4">
                    <a href="#" data-toggle="modal" data-target="#myModalcategory" class="edit text-blue"><img src="<?PHP echo base_url();?>assets/Administration/images/icon/edit.png" alt="" /> Add Category list</a>
                    </div>

                    <div class="clear_h10"></div>

                    <button type="submit"  class="btn bg-green" value="Save & Add Location">Save & Add Location</button>
                    </div>
                    </div>
                 </div>
            </section>
                 <input type="hidden" id="user_id" value="">
                 <input type="hidden" id="admin_id" value="<?PHP echo $admin_id;?>">

          </div><!-- /.content-wrapper -->
</div>


<?PHP
$this->load->view("includes/Administration/footer");
?>
 <script type="text/javascript">
       function get_owner_id(value)
       {
          //alert(value)

          $.ajax
            ({
                method:"post",
                url:"/Administration/Restaurant/getall_owner_id/",
                data:{oid:value},
                success:function(data1)
                {
                  //alert(data1);

                        if(data1)
                        {

                            $(".ownerList").html(data1);
                        }
                       else
                       {
                             $(".ownerList").html("");

                       }
                }

            });

       }


   </script>



   <!-- Modal -->
<div id="myModalFoodType" class="modal fade" role="dialog"
data-backdrop="static" >
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Food Type</h4>
      </div>
      <div class="modal-body">


        <div class="row">
    <div class="col-md-12">
      <div class="form-horizontal">
        <div class="form-group">
          <label class="col-md-4 control-label">Enter Title</label>
          <div class="col-md-6">
            <input class="form-control" type="text" class="form-control" name="food_title" id="food_title" placeholder="Food Type Title">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-4 control-label">Enter Description</label>
          <div class="col-md-6">
            <textarea name="food_type_desc" id="food_type_desc" class="form-control" > </textarea>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-12">
            <input class="form-control" type="button" class="center-block btn btn-success"

onClick="addFoodType()" value="Add New Food Type">
          </div>
        </div>
      </div>
    </div>
  </div>




      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id="myModalCuisine" class="modal fade" role="dialog"
data-backdrop="static" >
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Cuisine</h4>
      </div>
      <div class="modal-body">



        <div class="row">
    <div class="col-md-12">
      <div class="form-horizontal">
        <div class="form-group">
          <label class="col-md-4 control-label">Enter Cuisine Name</label>
          <div class="col-md-6">
            <input class="form-control" type="text" class="form-control" name="cuisine_name"

id="cuisine_name" placeholder="Enter Cuisine Name">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-4 control-label">Enter Description</label>
          <div class="col-md-6">
            <textarea name="cuisine_description" class="form-control"

id="cuisine_description"> </textarea>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-12">
            <input class="form-control" type="button" class="center-block btn btn-success"

name="cuisine" onclick="addCuisine()" value="Add Cuisine">
          </div>
        </div>
      </div>
    </div>
  </div>




      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>





<script>
    function addFoodType(){
      var food_type = document.getElementById('food_title').value;
      var admin_id= $("#admin_id").val();
      var food_type_desc=$("#food_type_desc").val();

      if(food_type != '' && admin_id!='' && food_type_desc!='')
      {

                  $.ajax({

                  url: "/ajax_food_type_add/",
                  type: "post",
                  data: {food_type:food_type,user_id:0,admin_id:admin_id,food_type_desc:food_type_desc} ,
                  //data: {cName:cuisine,userid:userid,adminid:0} ,
                  success: function (response)
                  {

                       $("#food_type").html(response);
                       $("#food_type").load();
                       $('#myModal').modal('hide');

                  }
                })
      }

    }
 function addCuisine()
 {
        var cuisine_name = document.getElementById('cuisine_name').value;
        var admin_id= $("#admin_id").val();
        var cuisine_description=$("#cuisine_description").val();

      if(cuisine_name != '' && admin_id!='' && cuisine_description!='')
      {

                  $.ajax({

                  url: "/ajax_cuisine_add/",
                  type: "post",
                  data: {cName:cuisine_name,userid:0,adminid:admin_id,cuisine_desc:cuisine_description},
                  //data: {cName:cuisine,userid:userid,adminid:0} ,
                  success: function (response) {

                       $("#cuisine_list").html(response);
                       $("#cuisine_list").load();
                       $('#myModalCuisine').modal('hide');

                  }
                })
      }

    }



</script>


<div id="myModalcategory" class="modal fade" role="dialog"
data-backdrop="static" >
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Category</h4>
      </div>
      <div class="modal-body">


        <div class="row">
    <div class="col-md-12">
      <div class="form-horizontal">
        <div class="form-group">
          <label class="col-md-4 control-label">Enter Category Name</label>
          <div class="col-md-6">
            <input class="form-control" type="text" class="form-control" name="category_name" id="category_name" placeholder="Category Name">
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-12">
            <input class="form-control" type="button" class="center-block btn btn-success" name="category" onClick="addcategory()" value="Add category">
          </div>
        </div>
      </div>
    </div>
  </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script>
 function addcategory()
 {
        var category_name = document.getElementById('category_name').value;
        var admin_id= $("#admin_id").val();
        //var cuisine_description=$("#cuisine_description").val();

      if(category_name != '' && admin_id!='')
      {

                  $.ajax({

                  url: "/ajax_category_add/",
                  type: "post",
                  data: {cName:category_name,userid:0,adminid:admin_id},
                  //data: {cName:cuisine,userid:userid,adminid:0} ,
                  success: function (response) {

                       $("#category_list").html(response);
                       $("#category_list").load();
                       $('#myModalcategory').modal('hide')
                  }
                })
      }

    }



function   checkOwnerId(value)
{

        if(value!="")
        {
               $.ajax({

                       method:"post",
                       url:"/Administration/Restaurant/check_owner_id",
                       data:{oid:value},
                       success:function(response)
                       {
                          if(response==1)
                          {
                              $(".ownerCodeMsg").html("Owner Code Already Used");

                          }
                          else if(response==0)
                          {
                             $(".ownerCodeMsg").html("");
                          }

                       }

               });
        }

}

</script>