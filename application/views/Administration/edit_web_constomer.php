<?PHP
  $this->load->view("includes/Administration/header"); 
  $this->load->view("includes/Administration/sidebar");
  ?>

  <?php

  foreach($customer_maindata as $main => $cuManin):
    $Cu_Email = $cuManin->email;
    $Cu_banned = $cuManin->banned;
    $Cu_mobile_no = $cuManin->mobile_no;
    $Cu_modified = $cuManin->modified;
    $Cu_device = $cuManin->login_device;
    
  endforeach;


                                foreach($customer_profile as $CP => $cust):
                                        $Customer_country =  $cust->country;
                                        $Customer_website =  $cust->website;
                                        $Customer_f_name =  $cust->f_name;
                                        $Customer_l_name =  $cust->l_name;
                                        $Customer_mobile =  $cust->mobile;
                                        $Customer_state =  $cust->state;
                                        $Customer_city =  $cust->city;
                                        $Customer_address =  $cust->address;
                                        $Customer_image =  $cust->image;
                                        

                                endforeach; 
                                ?>
    <div class="content-wrapper">
<section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <a href="/web_customers/" class="btn bg-gray-light2">&lt; &nbsp;Back to customers list</a>

                        <div class="clear_h10"></div>
            <form action="" method="post" enctype="multipart/form-data">
                    <h4 class="border_bottom">Edit WebCustomer</h4>                   
                    <?php 
                    if(isset($success_msg))
                    {
                        echo '<span class="text-green" >'.$success_msg.'</span>';
                    }
                    ?>
                    <div class="table-responsive">
                    <table class="table bg-gray-light tbl" style="width:80%;">
                    <tbody>
                        <tr><td width="20%">First Name:</td>
                            <td><input  type="text" style="width:60%;" name="f_name" placeholder="First name" value="<?php echo $Customer_f_name; ?>">
                                <br>
                               
                            
                            </td>
                        </tr>
                        <tr><td width="20%">Last Name:</td>
                            <td><input  type="text" style="width:60%;" name="l_name" placeholder="Last Name" value="<?php echo $Customer_l_name; ?>">
                                <br>
                                
                            
                            </td>
                        </tr>
                        <tr><td width="20%">Email:</td>
                            <td><input  type="text" style="width:60%;" name="email" placeholder="Email"  value="<?php echo $Cu_Email; ?>">
                                <br>
                               
                            
                            </td>
                        </tr>
                        <tr><td width="20%">Mobile No.:</td>
                            <td><input  type="text" style="width:60%;" name="mobile" placeholder="Mobile No." value="<?php echo $Cu_mobile_no; ?>">
                                <br>
                                
                            
                            </td>
                        </tr>
                        <tr><td width="20%">Registered date:</td>
                            <td><?php echo $Cu_modified; ?>
                                
                            
                            </td>
                        </tr>
                        <tr><td width="20%">Registered by:</td>
                            <td><?php if($Cu_device == 1){ echo "Mobile"; }else{ echo "Web"; } ?>
                                
                            
                            </td>
                        </tr>
                        <tr><td width="20%">Image:</td>
                            <td><input  type="file" style="width:60%;" name="cust_img">
                                <br>
                                <?php
                                if($Customer_image != '')
                                {
                                    ?>
                                    <img src="<?php echo getImagePath($Customer_image); ?>" height="150">
                                    <?php
                                }
                                ?>
                            
                            </td>
                        </tr>
                        <tr><td width="20%">Status:</td>
                            <td><select name="status" style="width:60%;">
                                    <option value="0" <?php if($Cu_banned ==0){ echo 'selected'; } ?>>Active</option>
                                    <option value="1" <?php if($Cu_banned ==1){ echo 'selected'; } ?>>Banned</option>
                                </select>

                            
                            </td>
                        </tr>
                        
                    </tbody></table> 
                    </div>
                    <input type="submit" class="btn bg-success" value="Save" name="btnsave">
                    <div class="clear_h20"></div>
             </form>   
            
            </section>
        </div>

<?PHP
  $this->load->view("includes/Administration/footer");
?>


