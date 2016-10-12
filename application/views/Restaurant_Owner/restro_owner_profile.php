<?PHP
  $this->load->view("includes/Restaurant_Owner/header"); 
  $this->load->view("includes/Restaurant_Owner/sidebar");
  ?>

<!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
            <!-- Content Header (Page header) -->
<section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Profile 

                 </h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" action="/restro_owner_profile/" enctype="multipart/form-data">
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
                      <input type="text" name="mobile" class="form-control" id="exampleInputPassword1" placeholder="Mobile Number" value="<?php echo $pro['mobile']; ?>">
                      <span style="color:red"></span>
                    </div>
                    

                     

                    


                    
                     <div class="form-group">
                      <label for="exampleInputPassword1">Address</label>
                      <textarea class="form-control" id="exampleInputPassword1" name="address" placeholder="Enter retaurant Name"><?php echo $pro['address']; ?></textarea> 
                    <span></span>
                    </div>




                     <div class="form-group">
                      <label for="exampleInputPassword1">Country</label>
                      <!--<select name="country" class="form-control" onchange="showState(this.value);">
                            <option value="">--country--</option>
                            <?php
                            foreach($country as $co => $ou):
                            ?>
                                <option value="<?php echo $ou->id; ?>"><?php echo $ou->country_name; ?></option>
                            <?php
                            endforeach;
                            ?>
                      </select>-->
                      <input type="text"  name="country" value="<?php echo $pro['country']; ?>" class="form-control">
                      <span style="color:red"></span>
                    </div>

                     <div class="form-group">
                      <label for="exampleInputPassword1">State</label>
                       <!--<select name="state" class="form-control" id="state" onchange='showCity(this.value);'>
                            <option value="">--state--</option>
                            
                       </select>-->
                       <input type="text"  name="state" value="<?php echo $pro['state']; ?>" class="form-control">
                       <span style="color:red"></span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">City</label>
                      <!--<select name="city" class="form-control" id="city">
                            <option value="">--city--</option>
                            
                      </select>-->
                       <input type="text"  name="city" value="<?php echo $pro['city']; ?>" class="form-control">
                      <span style="color:red"></span>
                    </div>
                
                    
                     
                    <?php
                    if($pro['image'] != ''){
                    ?>

                     <div class="form-group">
                        <img src="<?php getImagePath($pro['image']); ?>" class="img thumbnail" style="height:150px;">
                     </div>
                     <?php
                    }
                    ?>

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

      </div>
  </section>
</div>
<?PHP
  $this->load->view("includes/Restaurant_Owner/footer");
?>


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