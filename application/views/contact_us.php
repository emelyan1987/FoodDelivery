<?PHP
  $this->load->view("includes/Customer/header"); 
  error_reporting(0);
?>

<form action="/contact/" method="POST" >
<div class="container-fluid">
            <div class="margin20"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="border">
                        <div class="col-md-12">
                            <div class="margin20"></div>
                            <h3>Contact Us</h3>
                            <?php if($successMsg != ''){ echo $successMsg; }?>
                        </div>
                        <div class="col-md-5">
                            <div class="form-horizontal">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control searchInput" placeholder="First Name" name="fname">
                                        <span style="color:red"><?PHP  echo form_error('fname'); ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control searchInput" placeholder="Last Name" name="lname">
                                        <span style="color:red"><?PHP  echo form_error('lname'); ?></span>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control searchInput" placeholder="Telephone" name="telephone">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control searchInput" placeholder="Email" name="email">
                                         <span style="color:red"><?PHP  echo form_error('email'); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <!--<div class="margin40"></div>-->
                            <div class="form-horizontal">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <textarea class="form-control myTextArea" placeholder="Enter Your Message Here" rows="12" name="message"></textarea>
                                        <span style="color:red"><?PHP  echo form_error('message'); ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="col-md-offset-8 col-md-4">
                                            <button class="btn btn-success btn-success-new btn-block">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="margin20"></div>
        </div>

        <div class="advert">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <img class="img-responsive center-block" alt="" src="/assets/Customer/img/add.jpg">
                    </div>
                </div>
            </div>
        </div>

</form>

<?PHP
  $this->load->view("includes/Customer/footer"); 
?>  