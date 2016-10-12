 <?PHP
error_reporting(-1);
$this->load->view("includes/Administration/header");
$this->load->view("includes/Administration/sidebar");
?>
 <div class="content-wrapper">
     <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
        <h4 class="border_bottom">Edit Restaurant Owner</h4>
                <!-- form start -->
                <form role="form" method="post" action="" enctype ="multipart/form-data">
                <div class="row">
                  <div class="col-md-6">
                  <div class="mini-wall">

                  	<div class="form-group">
                      <label for="exampleInputEmail1">First Name</label>
                      <input type="text" name="f_name" class="form-control" id="exampleInputEmail1" placeholder="Enter owner's first name " value="<?php echo $owner_detail['f_name'];?>">
                    <span style="color:red"><?PHP echo form_error('f_name');?></span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Last Name</label>
                      <input type="text" name="l_name" class="form-control" id="exampleInputEmail1" placeholder="Enter owner's last name " value="<?php echo $owner_detail['l_name'];?>">
                     <span style="color:red"><?PHP echo form_error('l_name');?></span>

                    </div >
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                    <input type="text" name="email"   class="form-control" id="exampleInputEmail1" placeholder="Enter email address" value="<?php echo $owner_detail['email'];?>">

                    <span style="color:red" id="emailMsg"><?PHP echo form_error('email');?>
                    </div>


                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Enter Password" >
                      <span style="color:red"><?PHP echo form_error('password');?></span>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $owner_detail['user_id'];?>">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Status</label>
                       <select name="status" class="form-control">

                             <option value="0" <?PHP if ($owner_detail['banned'] == 0) {echo "selected";}
?> >Active</option>

                             <option value="1" <?PHP if ($owner_detail['banned'] == 1) {echo "selected";}
?>>Deactivate</option>


                       </select>
                      <span style="color:red"><?PHP echo form_error('mobile');?></span>
                    </div>

                  </div>
                                      </div>
                  <div class="col-md-6">
                    <div class="mini-wall">




                    <div class="form-group">
                      <label for="exampleInputEmail1">Address</label>
                      <textarea name="address" rows="5" class="form-control"  id="exampleInputEmail1" placeholder="Enter Address"><?php echo $owner_detail['address'];?></textarea>

                    <span style="color:red"><?PHP echo form_error('address');?></span>
                    </div>
                     <div class="form-group">
                      <label for="exampleInputEmail1">Website</label>


                      <input type="text" name="website" class="form-control" id="exampleInputEmail1" placeholder="Enter website link" value="<?php echo $owner_detail['website'];?>">
                    <span style="color:red"><?PHP echo form_error('website');?></span>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputPassword1">Mobile</label>
                      <input type="text" name="mobile" class="form-control" id="exampleInputPassword1" placeholder="Enter Mobile" value="<?php echo $owner_detail['mobile'];?>">
                      <span style="color:red"><?PHP echo form_error('mobile');?></span>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputPassword1">Profile picture</label>
                      <input type="file" name="profile_pic"  placeholder="Select picture">
                      <?php if ($owner_detail['image'] != "") {?>
                       <img src="<?PHP echo getImagePath($owner_detail['image']);?>" height="100" width="100">
                       <?php }
?>
                      <span style="color:red"><?PHP echo form_error('profile_pic');?></span>

                    </div>
                  </div>
                </div><!--row end -->
                   <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Update</button>
                  </div>
                </form>
          </div>
          </div>
  </section>
</div>
<?PHP
$this->load->view("includes/Administration/footer");
?>


   <script type="text/javascript">
       function check_Email(value)
       {
         $.ajax
            ({
                method:"post",
                url:"Customer/check_email/",
                data:{email:value},
                success:function(data1)
                {

                        if(data1)
                        {
                              //alert(data1);

                            $("#emailMsg").text(data1);

                        }
                }

            });

       }
   </script>