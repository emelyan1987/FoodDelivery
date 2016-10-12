<?PHP
  $this->load->view("includes/Customer/header"); 
  $this->load->helper('customer_helper');

  ?> 
<style>
            .loginArea {
                padding: 0 20px;
                margin: 10px;
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
        customRadio("search-engine");            
        customRadio("confirm");
    })
</script>

  <?php foreach($retro_list as $ks => $vs): ?> 
  
 <div class="container">
            <div class="row">
            	<div class="col-md-12">
                	<div class="row">
                    	<div class="col-md-5"></div>
                        <div class="col-md-2">
                        	<div class="gray-outbox">
                                 <?php
                                                        if($vs->restaurant_logo != '')
                                                        {
                                                        ?>
                                                        <a href="/restaurant_profile/<?php echo $vs->id; ?>">
                                                        <img class="img-responsive resimg" alt="" src="<?php $img = explode('public_html',$vs->restaurant_logo); 
                                                    echo $img[1];?>" > </a>
                                                        <?php
                                                        }
                                                        else
                                                        {
                                                        ?>
                                                        <a href="/restaurant_profile/<?php echo $vs->id; ?>">
                                                        <img class="img-responsive resimg" alt="" src="/assets/Customer/img/icon/bottomIcon2.png"  width="100" height="100"> </a>
                                                        <?php
                                                        }
                                                        ?>
                            </div>
                            
                        </div>
                        
                        <div class="col-md-5"></div>
                    </div>
                    <div class="row">
                    	<div class="col-md-12 text-center resturant-txt">
							<h1><?php echo ucwords($vs->restro_name); ?></h1>
                        </div>
                    </div>
                    <div class="row">
                    	<div class="col-md-2"></div>
                    	<div class="col-md-7 descp-txt">
                        	<h1>Description</h1>
                            <p>General info about the restaurant goes here on two or more than two lines General info about the restaurant goes here on two or more than two lines General info about the restaurant</p>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                   <div class="row">
<div class="col-md-12">
<h4 class="text-center"><span class="bg-white serice-txt">AVAILABLE SERVICE<span></span></span></h4>
<div class="tabBorderTop_section"></div>
<?php foreach($retsro_service_list as $ks => $Rest): ?>
<?php $pr[]=$Rest->service_type; ?>
<?php endforeach; ?>  

  <ul class="nav nav-tabs nav-justified myTabs restrotab">
<?php 

if (in_array(1,$pr))
  { ?>
<li class="active"><a onclick="myservicefun(&quot;4&quot;);" href="#tab1" data-toggle="tab">
<span class="tab-icon"></span> DELIVERY</a></li>
<?php } else { ?>
<li class="">
<span class="tab-icon"></span> DELIVERY</a></li>
<?php } ?>


<?php if (in_array(2,$pr)) {  ?>
<li class="active"><a onclick="myservicefun(&quot;4&quot;);" href="#tab1" data-toggle="tab">
<span class="tab-icon1"></span> CATERING</a></li>
<?php } else { ?>
<li class="">
<span class="tab-icon1"></span> CATERING</a></li>
<?php } ?>



<?php if (in_array(4,$pr)){ ?>
<li class="active"><a onclick="myservicefun(&quot;4&quot;);" href="#tab1" data-toggle="tab">
<span class="tab-icon2"></span> PICKUP</a></li>
<?php } else { ?>
<li class="">
<span class="tab-icon2"></span> PICKUP</a></li>
<?php } ?>



<?php  if (in_array(3,$pr)){ ?>
<li class="active"><a onclick="myservicefun(&quot;3&quot;);" href="#tab1" data-toggle="tab">
<span class="tab-icon3"></span> RESERVATION</a></li>
<?php } else { ?>
<li class="">
<span class="tab-icon3"></span> RESERVATION</a></li>
<?php } ?>

</ul>





<div class="tabBorderBottomnew_section"></div>
</div>
</div>
                    
                    <div class="row min-outbox">
                    	<div class="col-md-5">
                        	<div class="row">
                            	<div class="col-md-12">
                                	<div class="col-md-4"></div>
                                	<div class="col-md-4 content-leftsection">
                                        <div class="min-txt">Min. order: </div>
                                        <div class="del-txt">Delivery Time: </div>
                                	</div>
                                    <div class="col-md-4 content-leftsection">
                                        <div class="min-txtone"><?php echo $vs->RestroMin; ?></div>
                                        <div class="min-txtone"><?php if($vs->order_days != 0){ echo $vs->order_days."Day "; } ?><?php if($vs->order_hour != 0){ echo $vs->order_hour."Hour "; } ?></div>
                                	</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1 line-section">
                        
                        </div>
                       <div class="col-md-5">
                        	<div class="row">
                            	<div class="col-md-12">
                                <div class="col-md-4"></div>
                                	<div class="col-md-2 content-leftsection">
                                        <div class="min-txt">Payment </div>
                                       
                                	</div>
                                    <div class="col-md-5 content-leftsection">
                                        	<div class="row">
                                            	<div class="col-md-2"><img src="/assets/Customer/img/cash.png" alt="" border="0"></div>
                                                <div class="col-md-10 cash_content">Cash</div>
                                            </div>
                                            <div class="row">
                                            	<div class="col-md-2"><img src="/assets/Customer/img/credit_img.png" alt="" border="0"></div>
                                                <div class="col-md-10 cash_content">Credit Card</div>
                                            </div>
                                            <div class="row">
                                            	<div class="col-md-2"><img src="/assets/Customer/img/knet.png" alt="" border="0"></div>
                                                <div class="col-md-10 cash_content">Knet</div>
                                            </div>
                                	</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                  
                    
                    <div class="row">
                         <div class="col-md-12">
                            <h4 class="text-center"><span class="bg-white cun-txt">CUISINES<span></span></span></h4>
                            <div class="tabBorderTop_section"></div>
                            <div class="tabBorderBottom"></div>
                        </div>
                        
                        <div class="col-md-12">
                        	<div class="nav_outbox">
                            	<ul>
                            	<?php foreach($restro_cuisin_list as $ks => $cuis): ?>
                                	<li><?php echo getCuisineById($cuis->cuisine_id); ?></li>
                                    
          <?php endforeach; ?> 
                                    
                                </ul>
                            </div>
                        </div>
                        
                        

                        <div class="col-md-12 line-bottom">
                        <h4 class="text-center"></h4>
                        <div class="tabBorderTop_section"></div>
                        
                        <div class="tabBorderBottom"></div>




</div>
                    </div>
                    <div class="list-outbox">
                    <a class="list-button button_greensection" href="/restaurant_view/<?php echo $vs->id; ?>">Go to menu <i class="fa fa-angle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="advert">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <img class="img-responsive center-block" alt="" src="/assets/Customer/img/add.jpg"/>
                    </div>
                </div>
            </div>
        </div>
 <?php endforeach; ?>         
<?PHP
  $this->load->view("includes/Customer/footer"); 
?>          