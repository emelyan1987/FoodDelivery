<?PHP
  $this->load->view("includes/Customer/header"); 
  error_reporting(0);
?>

<style>
.searchInput {
    width: 100%;
    padding: 20px 0 !important;
    height: 50px;
    text-align: center;
    border: none;
    background: #eee;
}
.colorinput{
        color: #a5a5a5;
        height: 50px;
}
.front40{
    font-size: 30px;
}
.unselectable {
  -webkit-user-select: none;  /* Chrome all / Safari all */
  -moz-user-select: none;     /* Firefox all */
  -ms-user-select: none;      /* IE 10+ */
  user-select: none;          /* Likely future */       
}
.capcthaBackground{
    background:url("/assets/Customer/img/1.JPG");
}

.fileUpload {
    position: relative;
    overflow: hidden;
    margin: 10px;
}
.fileUpload input.upload {
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    padding: 0;
    font-size: 20px;
    cursor: pointer;
    opacity: 0;
    filter: alpha(opacity=0);
}
.btn-upload {
    border: 1px solid #aaa;
    color: #999 !important;
    border-radius: 0px;
    padding: 10px 30px;
    font-size: 18px;

}
.light-color{
    color: #999;

}

</style>



<form action="/career/" method="POST" enctype="multipart/form-data" >
<div class="container-fluid">
            <div class="margin20"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="border">
                        <div class="col-md-12">
                            <div class="margin20"></div>
                            <h3>Careers</h3>
                            <p>if you are interested in joining baytie.com team, kindly send an updated CV to careers@baytie.com or submit the form below:</p>

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
                                        <select class="form-control selectInput colorinput" name="job_title">
                                            <option value="">-Job Title-</option>
                                            <?php
                                            foreach($type as $tp =>$ty):
                                            ?>
                                                <option value="<?php echo $ty->id; ?>"><?php echo ucwords($ty->title); ?></option>
                                            <?php
                                            endforeach;
                                            ?>
                                        </select>
                                        <span style="color:red"><?PHP  echo form_error('job_title'); ?></span>
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
                            <div class="margin40"></div>
                            <div class="form-horizontal">
                                <div class="form-group">
                                    <label class="col-md-5"><h4 class="light-color">Upload Your CV</h4></label>
                                    <div class="col-md-5">
                                        <div class="fileUpload btn btn-upload">
                                            <span>Browse <i class="glyphicon glyphicon-triangle-bottom"></i></span>
                                            <input type="file" class="upload" name="uploadedimages"/>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="margin20"></div>
                                <div class="form-group">
                                    <label class="col-sm-12 light-color">Please Enter the code shown in the image</label>
                                </div>
                                <div class="margin20"></div>
                                <div class="form-group">
                                    <div class="col-md-5">
                                        <input type="text" class="form-control searchInput " name="captcha_text">
                                    </div>
                                    <div class="col-md-5">
                                       <input type="text" class="form-control searchInput front40 unselectable capcthaBackground" id="showCaptcha" placeholder="captcha" disabled="" value="<?php echo $capctha_code; ?>" onselectstart="return false" onpaste="return false;" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off>



                                         <!--<label for="captcha"><?php echo $captcha['image']; ?></label>
    <br>
    <input type="text" autocomplete="off" name="userCaptcha" placeholder="Enter above text" value="<?php //if(!empty($userCaptcha)){ echo $userCaptcha;} ?>" />
    <span class="required-server"><?php //echo form_error('userCaptcha','<p style="color:#F83A18">','</p>'); ?></span> -->


                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-default" type="button" onclick="captchRefrech();"><i class="fa fa-refresh"></i></button>
                                    </div>
                                </div>
                                <div class="margin20"></div>
                                <div class="form-group">
                                    <div class="col-md-5"><a href="" class="btn btn-default btn-block btn-default-new">Reset</a></div>
                                    <div class="col-md-5"><button class="btn btn-success btn-block btn-success-new" type="submit">submit form</button></div>
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

<?PHP
  $this->load->view("includes/Customer/footer"); 
?>  

<script>
$('#capcthaShow').bind('copy paste', function (e) {
        e.preventDefault();
    });
</script>

<script>
    function captchRefrech(){
        $.ajax({

                                url: "/Home/getCaptch/",
                                type: "post",
                                data: {val:1},
                                success: function (response) {
                                    
                                    $("#showCaptcha").val(response);
                                    
                                }
                        })
    }
</script>