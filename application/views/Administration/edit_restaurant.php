<?PHP
    $this->load->view("includes/Administration/header");
    $this->load->view("includes/Administration/sidebar");

    foreach ($restroData as $res => $REs):
    ?>
    <body class="hold-transition skin-green">

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <!-- Main content -->

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <?php
                        if (isset($success_msg)) {
                        ?>

                        <div class="alert alert-success">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success!</strong> <?php echo $success_msg;?>
                        </div>
                        <?PHP
                        }
                    ?>
                    </span><br>

                    <a href="/restaurant_list/" class="btn bg-gray-light2">< &nbsp;Back to Restaurant List</a>
                    <div class="clear_h10"></div>
                    <h4 class="border_bottom">General Restaurant Information</h4>

                    <div class="table-responsive">
                        <form method="post" enctype="multipart/form-data">
                        <table class="table bg-gray-light tbl" style="width:80%;">
                            <tr><td width="20%">Owner Code:</td>
                                <td>
                                    <input type="hidden" name="owner_code" value="<?php echo $REs->owner_code;?>" >
                                <?php echo $REs->owner_code;?></td></tr>

                            <tr><td width="20%">Name:</td>
                                <td><input id="name" type="text" name="restro_name" value="<?php echo $REs->restro_name;?>" /> <span style="color:red"><?PHP echo form_error('restro_name');?></span></td></tr>

                            <tr><td width="20%">Restaurent Information:</td>
                                <td><input id="restro_info" type="text" name="restro_info" value="<?php echo $REs->restro_description;?>"/><span style="color:red"><?PHP echo form_error('restro_info');?></span></td></tr>
                            <tr><td>Logo:</td>
                                <td><input id="restro_logo" type="file" name="restro_logo" /><!--<br><span style="color:red"> <?PHP //echo isset($image_errors)?$image_errors:""; ?></span>--> </td></tr>
                            <tr><td></td>
                                <td> <?php
                                    if ($REs->restaurant_logo) {
                                    ?>
                                    <img src="<?PHP echo getImagePath($REs->restaurant_logo);?>"  style="width:200px;height:200px;" >
                                    <?PHP
                                    }
                                ?></td></tr>

                            <tr><td>Gallery Images:</td>
                                <td><input id="gallery_image" type="file" name="gallery_image[]" /><input id="gallery_image" type="file" name="gallery_image[]" /><input id="gallery_image" type="file" name="gallery_image[]" /><input id="gallery_image" type="file" name="gallery_image[]" /><!--<br><span style="color:red"> <?PHP //echo isset($image_errors2)?$image_errors2:""; ?></span>--> </td></tr>

                            <tr>
                                <td></td>
                                <td>
                                    <div class="form-group">
                                        <?php
                                            foreach ($restroimg as $mk => $tk) {
                                            ?>
                                            <div class="col-md-4"><img src="<?php $img = explode('public_html', $tk->restro_images);
                                                echo $img[1];?>" class="img-thumbnail"  style="width:200px;height:200px;"></div>
                                            <?php
                                            }
                                        ?>

                                    </div>
                                </td>
                            </tr>
                            <tr><td>Contact Person:</td>
                                <td><input id="comtact_person" type="text" name="contact_person" value="<?php echo $REs->contact_person;?>" /><span style="color:red"><?PHP echo form_error('contact_person');?></span></td></tr>
                            <tr><td>Telephone:</td>
                                <td><input id="phone" type="text" name="telephones" value="<?php echo $REs->telephones;?>"/><span style="color:red"><?PHP echo form_error('telephones');?></span></td></tr>
                            <tr><td>Fixed Yearly Fees:</td>
                                <td><input id="yearly_fee" type="text" name="yearly_fee" value="<?php echo $REs->yearly_fee;?>" /><span style="color:red"><?PHP echo form_error('yearly_fee');?></span></td></tr>
                            <tr><td>Select Status:</td>


                                <td>
                                <div class="col-md-12">
                                    <span class="col-md-3"><label class="checkbox"><input type="checkbox" name="restro_status[]" value="1" <?php if (($REs->restro_status&1) == 1) {echo "checked";}?>/> Newly Opened </label></span>
                                    <span class="col-md-3"><label class="checkbox"><input type="checkbox" name="restro_status[]" value="2" <?php if (($REs->restro_status&2) == 2) {echo "checked";}?>/> Featured Restaurant</label></span>
                                    <span class="col-md-3"><label class="checkbox"><input type="checkbox" name="restro_status[]" value="3" <?php if (($REs->restro_status&4) == 4) {echo "checked";}?>/> Promotions</label></span>
                                    <span class="col-md-3"><label class="checkbox"><input type="checkbox" name="restro_status[]" value="4" <?php if (($REs->restro_status&8) == 8) {echo "checked";}?>/> Coupons</label></span>
                                    </div>
                                            <span style="color:red"><?PHP echo form_error('restro_status');?></span></td></tr>
                        </table>
                    </div>
                    <h4 class="border_bottom">Restaurant Setup</h4>
                    <h5>Assign Restaurant To Cuisine</h5>
                    <div class="col-md-8" id="cuisine_list">

                        <?PHP
                            foreach ($cuisine_list as $ks => $vs) {
                            ?>

                            <div class="col-md-4"><label class="checkbox"><input type="checkbox" name="cuisine[]" value="<?PHP echo $vs->id?>" <?php $cVal = check_cuisine($vs->id, $REs->id);if ($cVal == 1) {echo "checked";}
                                        ?>><?PHP
                                    echo $vs->name;?></label></div>

                            <?PHP

                            }

                        ?>
                    </div>
                    <div class="col-md-4">

                        <a href="#"  data-toggle="modal" data-target="#myModalCuisine" class="edit text-blue"> <img src="<?PHP echo base_url();?>assets/Administration/images/icon/edit.png" alt="" /> Add Cuisine list</a>

                    </div>
                    <div class="clear_h10"></div>

                    <h5>Assign Restaurant To Food Type</h5>
                    <div class="col-md-8">
                        <div class="table-responsive" id="food_type">

                            <?PHP
                                foreach ($food_type_list as $ks => $vs) {
                                ?>
                                <div class="col-md-4"><label class="checkbox"><input type="checkbox" name="food_type[]" value="<?PHP echo $vs->id?>" <?php if (check_foodtype($vs->id, $REs->id) == 1) {echo "checked";}
                                            ?>><?PHP
                                        echo $vs->food_title;?></label></div>
                                <?PHP

                                }

                            ?>


                        </div>
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
                            <div class="col-md-4"><label class="checkbox"><input type="checkbox" name="restro_seo_cat[]" value="<?PHP echo $vs->id?>"  <?php if (restroseoCatChk($vs->id, $REs->id) == 1) {echo "checked";}
                                        ?>><?PHP
                                    echo $vs->name;?></label></div>
                            <?PHP

                            }

                        ?>
                    </div>
                    <div class="col-md-4">
                        <a href="#"  data-toggle="modal" data-target="#myModalcategory" class="edit text-blue" ><img src="<?PHP echo base_url();?>assets/Administration/images/icon/edit.png" alt="" /> Add Category list</a>
                    </div>

                    <div class="clear_h10"></div>
                    <!--<h5>Assign Restaurant As Feature</h5>

                    <div class="col-md-5">
                    <table class="table" style="width:100%;">
                    <tr><td><input id="feature" name="feature" type="radio" value="1" <?php if ($REs->assign_featured == 1) {echo "checked";}
                    ?> /> <span>Yes</span></td>
                    <td><input id="feature"      name="feature" type="radio" value="0" <?php if ($REs->assign_featured == 0) {echo "checked";}
                    ?> /> <span>No</span> <span style="color:red"><?PHP echo form_error('feature');?></span></td></tr>
                    </table>
                    <div class="clear_h10"></div>   
                    </div> -->
                    <button type="submit"  class="btn bg-green" value="Save">Save</button>
                </div>
            </div>
        </section>
        <input type="hidden" id="user_id" value="">
        <input type="hidden" id="admin_id" value="<?PHP echo $admin_id;?>">

    </div><!-- /.content-wrapper -->
    </div>


    <?PHP
        endforeach;
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
<div id="myModalFoodType" class="modal fade" role="dialog" data-backdrop="static">
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
                                <label class="col-md-4 control-label">Enter Food Title</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="food_title" id="food_title" placeholder="Enter Food Title">
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
                                    <input type="button" class="center-block btn btn-success"  onClick="addFoodType()" value="Add New Food Type">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<div id="myModalCuisine" class="modal fade" role="dialog" data-backdrop="static">
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
                                    <input type="text" class="form-control" name="cuisine_name"

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
                                    <input type="button" class="center-block btn btn-success"

                                        name="cuisine" onclick="addCuisine()" value="Add Cuisine">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
                success: function (response) {

                    $("#food_type").html(response);
                    $("#food_type").load();
                    $('#myModal').modal('hide')
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
                    $('#myModalCuisine').modal('hide')
                }
            })
        }

    }



</script>




<div id="myModalcategory" class="modal fade" role="dialog" data-backdrop="static">
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
                                <input type="text" class="form-control" name="category_name" id="category_name" placeholder="Category Name">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="button" class="center-block btn btn-success"

                                    name="category" onClick="addcategory()" value="Add category">
                            </div>
                        </div>
                    </div>
                </div>
            </div>




            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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



</script>