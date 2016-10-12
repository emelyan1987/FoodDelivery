 <?PHP
$this->load->view("includes/Administration/header");
$this->load->view("includes/Administration/sidebar");
?>
 <div class="content-wrapper">
   <section class="content">
     <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <h4 class="border_bottom">Add New Restaurant Owner</h4>
        <?pHP
if (isset($success)) {
	?>
         <div class="alert alert-success">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong><?PHP echo isset($success) ? $success : "";?></strong>
        </div>
        <?pHP }
?>
        <!-- form start -->
        <form role="form" method="post" action='/new_customer/' enctype ="multipart/form-data">
          <div class="row">
            <div class="col-md-6">
              <div class="mini-wall">

               <div class="form-group">
                <label for="exampleInputEmail1">First Name</label>
                <input type="text" name="f_name" class="form-control" id="exampleInputEmail1" placeholder="Enter owner's first name " value="<?PHP echo set_value('f_name')?>">
                <span style="color:red"><?PHP echo form_error('f_name');?></span>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Last Name</label>
                <input type="text" name="l_name" class="form-control" id="exampleInputEmail1" placeholder="Enter owner's last name " value="<?PHP echo set_value('l_name')?>">
                <span style="color:red"><?PHP echo form_error('l_name');?></span>

              </div >
              <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" name="email" onBlur="check_Email(this.value)"  class="form-control" id="exampleInputEmail1" placeholder="Enter email address" value="<?PHP echo set_value('email')?>">

                <span style="color:red" id="emailMsg"><?PHP echo form_error('email');if (isset($mailCheck1)) {?> <span style="color:red"><?PHP echo $mailCheck1;?></span> <?pHP }
?> </span>
              </div>


              <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Enter  Password">
                <span style="color:red"><?PHP echo form_error('password');?></span>
              </div>

              <div class="form-group">
                <label for="exampleInputPassword1">Retype Password</label>
                <input type="password" name="rpassword" class="form-control" id="exampleInputPassword1" placeholder="Restype Password">
                <span style="color:red"><?PHP echo form_error('rpassword');?> <?PHP if (isset($msg)) {echo $msg;}
?></span>
                </div>
              </div><!--col6 end -->
            </div><!--mini wall end-->
            <div class="col-md-6">
              <div class="mini-wall">
<div class="form-group">
                  <label for="exampleInputEmail1">Address</label>
                  <textarea name="address" rows="5" class="form-control"  id="exampleInputEmail1" placeholder="Enter Address"><?PHP echo set_value('address')?></textarea>
                  <span style="color:red"><?PHP echo form_error('address');?></span>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Website</label>
                  <input type="text" name="website" class="form-control" id="exampleInputEmail1" placeholder="Enter website link" value="<?PHP echo set_value('website')?>">
                  <span style="color:red"><?PHP echo form_error('website');?></span>
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Mobile</label>
                  <input type="text" name="mobile" class="form-control" id="exampleInputPassword1" placeholder="Enter Mobile" value="<?PHP echo set_value('mobile')?>">
                  <span style="color:red"><?PHP echo form_error('mobile');?></span>
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Profile picture</label>
                  <input type="file" name="profile_pic"  placeholder="Select picture">
                  <span style="color:red"><?PHP echo form_error('profile_pic');?></span>
                </div>
              </div><!--mini wall end-->
            </div><!--col6 end -->
          </div><!--row end -->
          <div class="col-md-12">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>
</div>
</div>
<?PHP
$this->load->view("includes/Administration/footer");
?>
<script src="<?PHP echo base_url();?>assets/Restaurant_Owner/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?PHP echo base_url();?>assets/Restaurant_Owner/plugins/datatables/dataTables.bootstrap.min.js"></script>


<script type="text/javascript">
 function check_Email(value)
 {



   $.ajax
   ({
    method:"post",
    url:"/check_email/",
    data:{email:value},
    success:function(data1)
    {

      if(data1)
      {


       $("#emailMsg").text(data1);

     }
   }

 });

 }
</script>