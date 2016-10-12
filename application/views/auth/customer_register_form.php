<?PHP

    $this->load->view("includes/Customer/header");
  
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
.content_please_section{padding-top:0px; margin-top:-20px;}
.col-xs-12.have-txtoutbox{margin-top:-10px !important;}
.captha-outsectionbox{margin-top:10px !important;}
.btn.btn-block.btn-success-new.register-now{margin-top:-10px !important;}
#captcha_text{margin-top:-5px;}

</style>


 
 
 
 
  <style>
            .loginArea {
                padding: 0 20px;
                margin: 5px;
                border: 1px solid #eee;
                border-radius: 10px;
            }
			 .loginAreaone {
                padding: 0 20px;
                margin: 12px;
                border: 1px solid #eee;
                border-radius: 10px;
            }
			
			
            .signText{
                font-weight: normal;
                text-transform: capitalize;
                color: #373737;
				font-family:Tahoma, Geneva, sans-serif;
				font-size:25px;
            }
			.signTextone{font-family:"Trebuchet MS", Arial, Helvetica, sans-serif; font-size:23px; color:#6A6A6A; font-weight:bold;}
            .text-forgot{
                text-decoration: underline;
                color: #888 !important;
                font-size: 18px;
            }
            .text-new-user{
                text-decoration: none;
                color: #73B720 !important;
                font-size: 18px;
				font-weight:normal;
				font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
            }
            .new-lable{
                font-size: 14px;
                font-weight: normal;
            }
            input.form-control{
                border: 1px solid #333;
            }
            .succ { font-size: 28px; font-family: "Trebuchet MS", Arial, Helvetica, sans-serif; }
			.col-md-9 { margin-top:9px; }
			.pers_info { margin-top:0px; }
			
			.name_section{margin-top:-10px;}
        </style>
        
     <script type="text/javascript">
    function customRadio(radioName){
        var radioButton = $('input[name="'+ radioName +'"]');
        $(radioButton).each(function(){
            $(this).wrap( "<span class='custom-radio'></span>" );
            if($(this).is(':checked')){
                $(this).parent().addClass("selected");
            }
        });
        $(radioButton).click(function(){
            if($(this).is(':checked')){
                $(this).parent().addClass("selected");
            }
            $(radioButton).not(this).each(function(){
                $(this).parent().removeClass("selected");
            });
        });
    }
    $(document).ready(function (){
        customRadio("gender");
        customRadio("policy");
        customRadio("search-engine");            
        customRadio("confirm");
    })
</script>
 <div class="container">
            <div class="row">
               <?php echo form_open($this->uri->uri_string()); ?>
                    <div class="col-md-12">
                        
                        <div class="col-sm-6">
						 <div class="row">
                                    <div class="col-xs-12 col-md-9">
									
							</div>	</div>		
                            <div class="loginArea">
							<h3 class="signText">Sign Up</h3>
                                
                               <h3 class="succ"> <?php if ($this->session->flashdata('successMsg') != '') { 
    echo $this->session->flashdata('successMsg');  } ?></h3>
	
	
<div class="row">
<div class="col-xs-12 col-md-9 pers_info">
<div class="form-group">
<h3 class="signTextone">Personal Info.</h3>


</div>
</div>
</div>

	
	
	
	
	
	
                                <div class="row">
                                    <div class="col-xs-12 col-md-9 name_section">
                                        <div class="form-group">
                                            <h4>Name<em>*</em></h4>
                                            <input type="text" name="f_name" value="<?php echo set_value('f_name'); ?>" id="name" class="form-control">
                                             <span class="required-server"><?php echo form_error('f_name','<p style="color:#F83A18">','</p>'); ?></span> 
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-md-6 name_section">
                                        <div class="form-group">
                                            <h4>Email<em>*</em></h4>
                                            <input type="email" name="email" value="<?php echo set_value('email'); ?>" id="email" class="form-control">
                                            <span class="required-server"><?php echo form_error('email','<p style="color:#F83A18">','</p>'); ?></span>
                                             <?php if(isset($EmailMsg)){ echo $EmailMsg; } ?>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6 name_section">
                                        <div class="form-group">
                                            <h4>Mobile no.<em>*</em></h4>
                                            <input type="text" name="mobile" value="<?php echo set_value('mobile'); ?>" id="mobile" class="form-control">
                                            <span class="required-server"><?php echo form_error('mobile','<p style="color:#F83A18">','</p>'); ?></span>
                                             <?php if(isset($mobilelMsg)){ echo $mobilelMsg; } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-md-6 name_section">
                                        <div class="form-group">
                                            <h4>Password<em>*</em></h4>
                                            <input type="text" name="password" value="<?php echo set_value('password'); ?>" id="password" class="form-control">
                                            <span class="required-server"><?php echo form_error('password','<p style="color:#F83A18">','</p>'); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6 name_section">
                                        <div class="form-group">
                                            <h4>Confirm Password<em>*</em></h4>
                                            <input type="text" name="confirm_password" value="<?php echo set_value('confirm_password'); ?>" id="confirm_password" class="form-control">
                                            <span class="required-server"><?php echo form_error('confirm_password','<p style="color:#F83A18">','</p>'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-md-6 name_section">
                                        <div class="form-group">
                                            <h4>Gender</h4>
                                                <label><span class="custom-radio selected"><input type="radio" <?php echo set_radio('gender', 'male', TRUE); ?> value="male" name="gender"></span> Male</label>
                                                <label><span class="custom-radio space-left"><input type="radio" <?php echo set_radio('gender', 'female', TRUE); ?> value="female" name="gender"></span> Female</label>
                                                <span class="required-server"><?php echo form_error('gender','<p style="color:#F83A18">','</p>'); ?></span>
                    				    </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6 name_section">
                                        <div class="form-group">
                                            <h4>Birthday</h4>
                                            <span class="combodate">
                                            <select class="day form-control" name="day" style="width: auto;">
                                            <option value="">Day</option>
                                            <option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option></select>&nbsp;
 
                                         
                                            <select class="month form-control"  name="month" style="width: auto;"><option value="">Month</option><option value="0">Jan</option><option value="1">Feb</option><option value="2">Mar</option><option value="3">Apr</option><option value="4">May</option><option value="5">Jun</option><option value="6">Jul</option><option value="7">Aug</option><option value="8">Sep</option><option value="9">Oct</option><option value="10">Nov</option><option value="11">Dec</option></select>&nbsp;

                                            
                                            
                                            <select class="year form-control" name="year" style="width: auto;"><option value="">Year</option><option value="2015">2015</option><option value="2014">2014</option><option value="2013">2013</option><option value="2012">2012</option><option value="2011">2011</option><option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option><option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option><option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option><option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option><option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option><option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option><option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970">1970</option></select>

                                            
                                            </span>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
						
						
                        <div class="col-sm-6">
                            <div class="loginAreaone">
                                <h3 class="signTextone">Address Info.</h3>
                                <div class="row">
                                    <div class="col-xs-12 col-md-6 name_section">
                                        <div class="form-group">
                                            <h4>Choose Your City<em>*</em></h4>
                                            <select id="stack_id" name="city" class="form-control">
                                            <option value="">Select City</option>
                                            <?php
                                            foreach($city as $ct => $city):
                                            ?>
                                            <option value="<?php echo ucwords($city->city_name); ?>" ><?php echo ucwords($city->city_name); ?></option>
                                            <?php
                                            endforeach;
                                            ?>
    	`									</select>
    	<span class="required-server"><?php echo form_error('city','<p style="color:#F83A18">','</p>'); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6 name_section">
                                        <div class="form-group">
                                            <h4>Address Name<em>*</em></h4>
                                            <input type="text" name="address" value="<?php echo set_value('address'); ?>" class="form-control" Placeholder="Home Office etc.">
                                            <span class="required-server"><?php echo form_error('address','<p style="color:#F83A18">','</p>'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
								
								<div class="col-xs-12 col-md-6 name_section">
                                        <div class="form-group">
                                            <h4>Choose Your Area<em>*</em></h4>
                                            <select id="stack_id" name="area" class="form-control">
                                            <option value="">Select Area</option>
                                            <?php
                                            foreach($area as $ct => $area):
                                            ?>
                                            <option value="<?php echo ucwords($area->name); ?>" ><?php echo ucwords($area->name); ?></option>
                                            <?php
                                            endforeach;
                                            ?>
    	`									</select>
    	<span class="required-server"><?php echo form_error('area','<p style="color:#F83A18">','</p>'); ?></span>
                                        </div>
                                    </div>
								
															
                                    <div class="col-xs-12 col-md-6 name_section">
                                        <div class="form-group">
                                            <h4>Block<em>*</em></h4>
                                            <input type="text" name="block" value="<?php echo set_value('block'); ?>" class="form-control">
                                             <span class="required-server"><?php echo form_error('block','<p style="color:#F83A18">','</p>'); ?></span>
                                        </div>
                                    </div>
									</div>
                                   
                                <div class="row">
                                    <div class="col-xs-12 col-md-6 name_section">
                                        <div class="form-group">
                                            <h4>Street<em>*</em></h4>
                                            <input type="text" name="street" value="<?php echo set_value('street'); ?>" class="form-control">
                                             <span class="required-server"><?php echo form_error('street','<p style="color:#F83A18">','</p>'); ?></span>
                                        </div>
                                    </div>
                               
								 <div class="col-xs-12 col-md-6 name_section">
                                        <div class="form-group">
                                            <h4>House Name/Number<em>*</em></h4>
                                            <input type="text" name="house_name" value="<?php echo set_value('house_name'); ?>" class="form-control">
                                            <span class="required-server"><?php echo form_error('house_name','<p style="color:#F83A18">','</p>'); ?></span>
                                        </div>
                                    </div>
                                </div>
								
								
								 <div class="row">
                                    <div class="col-xs-12 col-md-6 name_section">
                                        <div class="form-group">
                                            <h4>Floor<em>*</em></h4>
                                            <input type="text" name="floor" value="<?php echo set_value('floor'); ?>" class="form-control">
                                             <span class="required-server"><?php echo form_error('floor','<p style="color:#F83A18">','</p>'); ?></span>
                                        </div>
                                    </div>
                               
								 <div class="col-xs-12 col-md-6 name_section">
                                        <div class="form-group">
                                            <h4>Appartment<em>*</em></h4>
                                            <input type="text" name="appartment" value="<?php echo set_value('appartment'); ?>" class="form-control">
                                            <span class="required-server"><?php echo form_error('appartment','<p style="color:#F83A18">','</p>'); ?></span>
                                        </div>
                                    </div>
                                </div>
								
								
								
								
                                <div class="row">
                                    <div class="col-xs-12 name_section">
                                        <div class="form-group">
                                            <h4>Extra Direction<small><small class="add-txt"> (add more details for the restaurant's driver to Find you Faster)</small></small></h4>
                                            <input type="text" value="<?php echo set_value('direction'); ?>" name="direction" class="form-control">
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 have-txtoutbox">
                            <div class="form-group">
                            <div class="roundedOne">
                                <input type="checkbox" name="check" id="roundedOne" value="1">
                                <label for="roundedOne"><span> I have read and understood the <a href="" class="text-new-user"/>Privacy Policy</a> and agree to the <a href=""  class="text-new-user">Terms of Use.</span></label>
                                
                            </div>
                           <span class="required-server"><?php echo form_error('check','<p style="color:#F83A18">','</p>'); ?></span>  
                   </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="margin20"></div>
                        <div class="row">
                        	<div class="col-md-12">
                            	<div class="col-md-11 content_please_section">
                            		<div class="please-txt">Please enter the code shown in the Image.</div>
                            	</div>
                                <div class="col-md-12 captha-outsectionbox">
                                <div class="col-md-2 captha-section text-center">
                                 <input type="text" name="captcha" class="form-control searchInput front40 unselectable capcthaBackground" id="showCaptcha" placeholder="captcha" disabled="" value="<?php echo $capctha_code; ?>" onselectstart="return false" onpaste="return false;" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off>	
                                </div>
                                <div class="col-md-1 captha-img"><a href="javascript:void(0);" onclick="captchRefrech();"><img src="<?PHP echo base_url(); ?>/assets/Customer/img/captha_img.jpg" alt="" border="0"></a></div>
                                </div>
                                <div class="col-md-12 captha-box">
                                	<div class="row">
                                		<div class="col-md-3">
                                			<input type="text" name="captcha_text" id="captcha_text" class="form-control">
							 <span class="required-server"><?php echo form_error('captcha_text','<p style="color:#F83A18">','</p>'); ?></span>
											
							
									
                                			
                                			 <?php if(isset($successMsg)){ echo $successMsg; } ?>
                                		</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="col-md-3 col-xs-12">
                                    <div class="form-group">    
                                        <button type="submit" class="btn btn-block btn-success-new register-now" name="register">Register Now</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php echo form_close(); ?>
            </div>
        </div>
        <div class="advert">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <img class="img-responsive center-block" alt="" src="<?PHP echo base_url(); ?>/assets/Customer/img/add.jpg"/>
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