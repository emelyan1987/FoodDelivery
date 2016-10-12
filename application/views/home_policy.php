<?PHP
  $this->load->view("includes/Customer/header"); 
  $this->load->helper('customer_helper');
?>

<div class="container-fluid">
            <div class="margin20"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="border">
                        <div class="col-md-12">
                            <div class="margin20"></div>
                            <?php echo $privacy_data['text']; ?>
                            
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="margin20"></div>
        </div>
        
<?php
$this->load->view("includes/Customer/advertise"); 
$this->load->view("includes/Customer/footer"); 
?>