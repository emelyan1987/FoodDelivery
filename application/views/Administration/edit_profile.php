<?PHP
  $this->load->view("includes/Administration/header"); 
  $this->load->view("includes/Administration/sidebar");
  ?>
  <div class="content-wrapper">
             <section class="content">
             		<div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Edit Profile 
                  
                 </h3>
                 <br>
                 <span class="green"><?PHP //echo $this->session->flashdata("updatemsg"); ?></span>

                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" action="" enctype="multipart/form-data">
                  <div class="box-body">

                  	<div class="form-group">
                      <label for="exampleInputEmail1">First Name</label>
                      <input type="text" name="f_name" class="form-control" id="exampleInputEmail1" placeholder="Enter owner's first name " value="<?php echo $pro['f_name']; ?>">
                    <span style="color:red"></span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Last Name</label>
                      <input type="text" name="l_name" class="form-control" id="exampleInputEmail1" placeholder="Enter owner's last name " value="<?php echo $pro['l_name']; ?>">
                     <span style="color:red"></span>
                   
                    </div>
                  	

                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="text" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter owner's email address" value="<?php echo $pro['email']; ?>">
                    <span style="color:red"></span>
                    </div>
                  

                    <div class="form-group">
                      <label for="exampleInputPassword1">Mobile</label>
                      <input type="text" name="mobile" class="form-control" id="exampleInputPassword1" placeholder="Mobile" value="<?php echo $pro['mobile']; ?>">
                      <span style="color:red"></span>
                    </div>
                    

                     

                    


                    
                     <div class="form-group">
                      <label for="exampleInputPassword1">Address</label>
                      <textarea class="form-control" id="exampleInputPassword1" name="address" placeholder="Enter Address"><?php echo $pro['address']; ?></textarea> 
                    <span></span>
                    </div>
<?php if($pro['image'] != '')
{
?>
<div class="form-group">
                      <label for="exampleInputFile">&nbsp;</label>
                      <img src="<?php getImagePath($pro['image']); ?>" class="img-thumbnail" style="height:150px;" >
                    </div>
<?php	
} ?>
                    

                    <div class="form-group">
                      <label for="exampleInputFile">Profile Image</label>
                      <input type="file" id="exampleInputFile" name="uploadedimages">
                      

                      <span style="color:red">     </span>
                      
                    </div>


                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div><!-- /.box -->
          </div>
             </section>
  </div>
<?PHP
  $this->load->view("includes/Administration/footer");
?>