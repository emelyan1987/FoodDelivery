<?PHP
  $this->load->view("includes/Administration/header"); 
  $this->load->view("includes/Administration/sidebar");
  ?>
    <div class="content-wrapper">
<section class="content">
                <div class="row">
                    <div class="col-md-12">
            <form action="" method="post">
                    <h4 class="border_bottom"><?php echo $template['title']; ?></h4>                   
                    <?php 
                    if(isset($success_msg))
                    {
                        echo '<span class="text-green" >'.$success_msg.'</span>';
                    }
                    ?>
                    <div class="table-responsive">
                    <table class="table bg-gray-light tbl" style="width:80%;">
                    <tbody>

                        <tr><td width="20%">Email Subject:</td>
                            <td><input  type="text" style="width:60%;" name="subject" placeholder="Email Subject" value="<?php echo $template['subject']; ?>">
                                <br>
                                <span style="color:red"><?PHP  echo form_error('subject'); ?></span>
                            
                            </td>
                        </tr>
                        <tr><td width="20%">Email Message:</td>
                            <td><textarea style="width:60%;" name="message" rows="10"><?php echo $template['message']; ?></textarea>
                                <br>
                                <span style="color:red"><?PHP  echo form_error('message'); ?></span>
                            
                            </td>
                        </tr>
                        
                        <tr><td width="20%">Variables:</td>
                            <td>
                                <table class="table">
                                    <tr>
                                        <td>User Name</td>
                                        <td>{UserName}</td>
                                    </tr>
                                    <tr>
                                        <td>User Email</td>
                                        <td>{UserEmail}</td>
                                    </tr>
                                    <tr>
                                        <td>Payment Method</td>
                                        <td>{PaymenthMethod}</td>
                                    </tr>
                                    <tr>
                                        <td>Order ID</td>
                                        <td>{OrderID}</td>
                                    </tr>
                                    <tr>
                                        <td>Order Status</td>
                                        <td>{OrderStatus}</td>
                                    </tr>
                                    <tr>
                                        <td>Order Service Name</td>
                                        <td>{ServiceName}</td>
                                    </tr>
                                    <tr>
                                        <td>Order Details</td>
                                        <td>{OrderDetails}</td>
                                    </tr>
                                    <tr>
                                        <td>Current date</td>
                                        <td>{CurrentDate}</td>
                                    </tr>
                                    <tr>
                                        <td>Current Time</td>
                                        <td>{CurrentTime}</td>
                                    </tr>
                                    <tr>
                                        <td>Order Address Details</td>
                                        <td>{AddressDetails}</td>
                                    </tr>
                                </table>
                            
                            </td>
                        </tr>
                        
                    </tbody></table> 
                    </div>
                    <input type="submit" class="btn bg-gray-light2" value="Save" name="btnsave">
                    <a href="/email_templates/" class="btn bg-gray-light2" >Back</a>
                    <div class="clear_h20"></div>
             </form>   
            
            </section>
        </div>

<?PHP
  $this->load->view("includes/Administration/footer");
?>