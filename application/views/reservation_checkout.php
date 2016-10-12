<?PHP
  $this->load->view("includes/Customer/header"); 
  $this->load->helper('customer_helper');


$happyTime = $restroInfo['happy_from'];
$happyTimeto = $restroInfo['happy_to'];

$happyTimestr = strtotime($restroInfo['happy_to']);



$Htimestamp1 = strtotime($happyTime);
if($happyTimestr > $Htimestamp1)
{
    $happyTime1 = date('h:i A', $Htimestamp1);
}
else
{
    $happyTime1 = '';
}

$Htimestamp2 = strtotime($happyTime) + 60*60;
if($happyTimestr > $Htimestamp2)
{
    $happyTime2 = date('h:i A', $Htimestamp2);
}
else
{
    $happyTime2 = '';
}


$Htimestamp3 = strtotime($happyTime) + 60*60 + 60*60;
if($happyTimestr > $Htimestamp3)
{
    $happyTime3 = date('h:i A', $Htimestamp3);
}
else
{
    $happyTime3 = '';
}


$Htimestamp4 = strtotime($happyTime) + 60*60 + 60*60 + 60*60;
if($happyTimestr > $Htimestamp4)
{
    $happyTime4 = date('h:i A', $Htimestamp4);
}
else
{
    $happyTime4 = '';
}






?>

<style>
.locationheader {
    height: 40px;
    display: inline-block;
    text-align: center;
    line-height: 40px;
    background: #fff;
    padding: 0 15px;
    font-size: 18px;
    border: 2px solid #d31e03;
    color: #d31e03;
    font-weight: bold;
}
.noneborderradius{
    border-radius: 0px;
}

.mytext{
    border-radius: 0px;
}

</style>

<form action="" method="post" >
<div class="container-fluid">
            <div class="margin20"></div>
            <div class="row">
                <div class="col-md-3 col-sm-12">
                    
                        <a href="/reservation_tabel/<?php echo $this->uri->segment('2'); ?>"><h4><i class="fa fa-angle-left"></i> Back to restaurant</h4></a>
                    
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        <div class="bottomIconSection">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-xs-6 col-sm-3 col-md-3">
                            <img class="img-responsive center-block" alt="" src="/assets/Customer/img/icon/bottomIcon1.png">
                            <h4 class="bottomIconTitle"><span>1</span> Choose Restaurant</h4>
                        </div>
                        <div class="col-xs-6 col-sm-3 col-md-3">
                            <img class="img-responsive center-block" alt="" src="/assets/Customer/img/icon/bottomIcon2.png">
                            <h4 class="bottomIconTitle"><span>2</span> Choose Food</h4>
                        </div>
                        <div class="col-xs-6 col-sm-3 col-md-3">
                            <img class="img-responsive center-block" alt="" src="/assets/Customer/img/icon/bottomIcon3.png">
                            <h4 class="bottomIconTitle"><span>3</span> Place Order</h4>
                        </div>
                        <div class="col-xs-6 col-sm-3 col-md-3">
                            <img class="img-responsive center-block" alt="" src="/assets/Customer/img/icon/bottomIcon4.png">
                            <h4 class="bottomIconTitle"><span>4</span> Enjoy</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="tab-content">
                        <div id="tab1" class="tab-pane fade in active">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="itemCheck">
                                        <div class="margin20"></div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-6">
                                                    <h3 class="text-uppercase">RESERVATION DETAILS</h3>
                                                </div>
                                                <div class="col-md-6">
                                                    <!--<select class="addressSelection" name="useraddress" onchange="addressFun(this.value)"  id="CustomerAddressData">
                                                        <option value="">-Select Address-</option>
                                                        <?php
                                                        foreach($addressData as $add => $address):
                                                        ?>
                                                            <option value="<?php echo $address->id; ?>"><?php echo $address->billing_addres_1; ?></option>
                                                        <?php
                                                        endforeach;
                                                        ?>
                                                    </select>-->
                                                    <!--<span class="red"><?php echo form_error('useraddress'); ?></span>-->
                                                    <div class="pull-right">
                                                        <!--<a data-toggle="modal" data-target="#customerAddress" style="cursor: pointer;"><span class="checkoutEdit"><i class="fa fa-home"></i> Add New Address</span></a>-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--<div class="margin20"></div>
                                        <div class="row">
                                           <div class="col-md-12" id="addressdata">
                                                
                                            </div>
                                        </div>
                                        <div class="margin20"></div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-12">
                                                    <textarea class="form-control" rows="3" placeholder="Please enter extra direction." name="extra_direction"></textarea>
                                                </div>
                                            </div>
                                        </div>-->
                                        <div class="margin20"></div>
                                        <div class="row">
                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-12">
                                                     
                                                    <div class="col-md-3">
                                                        Table Name:
                                                    </div>
                                                    <div class="col-md-3">
                                                       <strong><?php ucwords(getTableName($this->uri->segment('3'))); ?></strong>
                                                    </div>
                                                </div>
                                                <hr/>
                                            </div>
                                        </div>
                                         <div class="margin20">
                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-12">
                                                     
                                                    <div class="col-md-3">
                                                        Number Of Persons:
                                                    </div>
                                                    <div class="col-md-3">
                                                       <strong><?php echo $_SESSION['res_user']; ?></strong>
                                                    </div>
                                                </div>
                                                <hr/>
                                            </div>
                                        </div> 
                                        <div class="margin20"></div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-12">
                                                    <div class="col-md-3">
                                                        Reservation Date:
                                                    </div>
                                                    <div class="col-md-3">
                                                        <strong><?php echo date('d-M-Y',strtotime($_SESSION['res_date'])); ?></strong>
                                                    </div>
                                                     
                                                </div>
                                                <hr/>
                                            </div>
                                        </div>
                                        <div class="margin20"></div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-12">
                                                    <div class="col-md-3">
                                                        <span class="locationheader">LOCATION <i class="fa fa-play"></i></span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <strong>Address: </strong> <?php echo $locationData['street'].' ,Block No. '.$locationData['block']; ?><br><?php echo $locationData['name'].' , '.$locationData['city_name']; ?>
                                                        <br>
                                                        <strong>Phone: </strong> <?php echo $locationData['telephones']; if($locationData['telephones2'] != ''){ echo ' , '.$locationData['telephones2']; } if($locationData['telephones3'] != ''){ echo ' , '.$locationData['telephones3']; } ?>
                                                    </div>
                                                     
                                                </div>

                                            </div>
                                        </div>
                                        <div class="margin20"></div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-12">
                                                    <div class="col-md-3">
                                                        Reservation Time:
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input class="form-control text-center openTimeController mytext" name="cat_time" id="booking_time" placeholder="hh:mm:am/pm">
                                            <div id="datetimepicker3" class="input-append">
                                                <!---Time Picker-->
                                                <div style="margin-top: 15px;">
                                                    <span class="closeTimeInput">x</span>
                                                    <select onchange="gettimevalue()" id="time1" style="height:30px;">
                                                        <?php
                                                        for($h = 1; $h<=12; $h++){
                                                        ?>
                                                            <option value="<?php if($h < 10){ echo 0; } ?><?php echo $h; ?>"> <?php if($h < 10){ echo 0; } ?><?php echo $h; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    <select onchange="gettimevalue()" id="time2" style="height:30px;">
                                                        <?php
                                                        for($M = 1; $M<=60; $M++){
                                                        ?>
                                                            <option value="<?php if($M < 10){ echo 0; } ?><?php echo $M; ?>"> <?php if($M < 10){ echo 0; } ?><?php echo $M; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    <select onchange="gettimevalue()" id="time3" style="height:30px;">
                                                        <option value="AM">AM</option>
                                                        <option value="PM">PM</option>
                                                    </select>
                                                </div>
                                                <!---Time Picker-->
                                                <span class="add-on">
                                                  <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                                                  </i>
                                                </span>
                                            </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="button" class="btn btn-success noneborderradius" value="CHECK TIME" onclick="timeShowFun()">
                                                </div>
                                                    </div>
                                                    
                                            </div>
                                        </div>
                                        <div class="margin20" ></div>
                                        <div class="row">
                                            <div class="col-md-12" id="timeshow">
                                                
                                                     
                                                
                                            </div>
                                            <div class="col-md-12" >
                                            <div class="margin20" style="height:10px;"></div>
                                            <div class="col-md-12" >
                                             <span> Happy Hour for reserving between <?php echo $happyTime; ?> and <?php echo $happyTimeto; ?> </span>
                                            </div>
                                            <div class="margin20" style="height:10px;"></div>
                                            <div class="col-md-12" >
                                                <?php
                                                if($happyTime1 != '')
                                                {
                                                ?>
                                                
                                                    <div class="col-md-3">
                                                        <input type="radio" name="booking_time" value="<?php echo $happyTime1; ?>" 
                                                        <?php
                                                        $booked = chkTableBookedOnTime($happyTime1);
                                                        if($booked != 0 )
                                                        {
                                                            echo "disabled";
                                                        }
                                                        ?>                                                  
                                                         > 
                                                         
                                                        <?php 
                                                        if($booked != 0 )
                                                        {
                                                            echo "<span style='color:red'>".$happyTime1."</span>";
                                                        }
                                                        else
                                                        {
                                                            echo $happyTime1; 
                                                        }
                                                        ?>
                                                    </div>
                                                <?php
                                                }

                                                if($happyTime2 != '')
                                                {
                                                ?>
                                                    <div class="col-md-3">
                                                        <input type="radio" name="booking_time" value="<?php echo $happyTime2; ?>" 
                                                        <?php
                                                        $booked = chkTableBookedOnTime($happyTime2);
                                                        if($booked != 0 )
                                                        {
                                                            echo "disabled";
                                                        }
                                                        ?> 
                                                        > 

                                                        <?php 
                                                        if($booked != 0 )
                                                        {
                                                            echo "<span style='color:red'>".$happyTime2."</span>";
                                                        }
                                                        else
                                                        {
                                                            echo $happyTime2; 
                                                        }
                                                        ?>
                                                       
                                                    </div>
                                                <?php
                                                }

                                                if($happyTime3 != '')
                                                {
                                                ?>
                                                    <div class="col-md-3">
                                                        <input type="radio" name="booking_time" value="<?php echo $happyTime3; ?>" 
                                                        <?php
                                                        $booked = chkTableBookedOnTime($happyTime3);
                                                        if($booked != 0 )
                                                        {
                                                            echo "disabled";
                                                        }
                                                        ?> 
                                                        > 

                                                        <?php 
                                                        if($booked != 0 )
                                                        {
                                                            echo "<span style='color:red'>".$happyTime3."</span>";
                                                        }
                                                        else
                                                        {
                                                            echo $happyTime3; 
                                                        }
                                                        ?>
                                                        
                                                    </div>
                                                <?php
                                                }

                                                if($happyTime4 != '')
                                                {
                                                ?>
                                                    <div class="col-md-3">
                                                        <input type="radio" name="booking_time" value="<?php echo $happyTime4; ?>" 
                                                        <?php
                                                        $booked = chkTableBookedOnTime($happyTime4);
                                                        if($booked != 0 )
                                                        {
                                                            echo "disabled";
                                                        }
                                                        ?> 
                                                    > 
                                                        <?php 
                                                        if($booked != 0 )
                                                        {
                                                            echo "<span style='color:red'>".$happyTime4."</span>";
                                                        }
                                                        else
                                                        {
                                                            echo $happyTime4; 
                                                        }
                                                        ?>
                                                    </div>
                                                <?php
                                                }

                                                ?>
                                                </div>



                                            </div>
                                        </div>
                                        <div class="margin20" style="height:40px;"></div>
                                        
                                       
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-offset-4 col-md-4">
                                                   
                            <?php
                            if(@$_SESSION['Customer_User_Id'] != '') 
                            {
                            ?>
                                            <button type="submit" name="btncheckout" class="btn btn-danger btn-danger-new btn-block">MAKE RESERVATION</button>
                            <?php
                            }
                            else
                            {
                            ?>
                                            <a class="btn btn-danger btn-danger-new btn-block" id="login_toggle2">MAKE RESERVATION</a>
                            <?php
                            }
                            ?>

                                  <!--id="login_toggle2"-->                  

                                                </div>
                                            </div>
                                        </div>
                                        <div class="margin20"></div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="itemCheck" id="show_cartdata">
                                        <div class="margin20"></div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                
                                            </div>
                                        </div>
                                        <div class="margin20"></div>
                                        
                                        
                                        <div class="row">
                                            <div class="col-sm-12" style="text-align:center;">
                                                <div class="col-sm-12">
                                                    <div class="col-sm-4" style="float:right">
                                                        <?php 
                                                    if($restroInfo['status'] == 1){
                                                        $stl = 'class="opened"';
                                                        $status_title = "Open";
                                                    }
                                                    elseif($restroInfo['status'] == 2)
                                                    {
                                                        $stl = 'class="busy"';
                                                        $status_title = "Busy";
                                                    }
                                                    else
                                                    {
                                                        $stl = 'class="close"';
                                                        $status_title = "Close";
                                                    }
                                                     ?>
                                                    <span <?php echo $stl; ?>></span> <?php echo $status_title; ?>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    
                                                <?php 
                                                if($restroInfo['restaurant_logo'] != '')
                                                {
                                                ?>
                                                <img src="<?php getImagePath($restroInfo['restaurant_logo']); ?>" height="100">
                                                <?php
                                                }
                                                ?>
                                                </div>
                                                <div class="col-sm-12">
                                                    
                                                <h3><?php echo $restroInfo['restro_name']; ?></h3>
                                                </div>
                                                <div class="col-sm-12">
                                                    
                                                <h5><?php echo $restroInfo['restro_description']; ?></h5>
                                                </div>
                                                <div class="col-sm-12">
                                                    
                                                <h5>Working Time:</h5>
                                                <h4>Mon-Fri: <?php echo $restroInfo['monday_from']; ?>-<?php echo $restroInfo['friday_to']; ?> </h4>
                                                <h4>Sat-Sun: <?php echo $restroInfo['saturday_from']; ?>-<?php echo $restroInfo['sunday_to']; ?> </h4>
                                                </div>

                                                <div class="col-sm-12">
                                                <div class="ratings">
                                                <?php 

                                                 $ratArray = getRestroRatingValues($restroInfo['id']);
                                                if($ratArray['rating_num'] != 0)
                                                {
                                                   $getR = $ratArray['rating_value'] / $ratArray['rating_num'];
                                                   $getR = round($getR);
                                                ?>
                                                <span>
                                                <?php
                                                if($getR == 5)
                                                {
                                                ?>
                                                    <img class="" alt="" src="/assets/Customer/img/star.png" width="30"> 
                                                         <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                                         <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                                         <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                                         <img class="" alt="" src="/assets/Customer/img/star.png" width="30">  
                                                <?php
                                                }
                                                elseif($getR == 4)
                                                {
                                                ?>
                                                    <img class="" alt="" src="/assets/Customer/img/star.png" width="30"> 
                                                         <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                                         <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                                         <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                                         <img class="" alt="" src="/assets/Customer/img/star1.png" width="30"> 
                                                <?php
                                                }
                                                elseif($getR == 3)
                                                {
                                                ?>
                                                    <img class="" alt="" src="/assets/Customer/img/star.png" width="30"> 
                                                         <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                                         <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                                         <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                                         <img class="" alt="" src="/assets/Customer/img/star1.png" width="30"> 
                                                <?php
                                                }
                                                elseif($getR == 2)
                                                {
                                                ?>
                                                     <img class="" alt="" src="/assets/Customer/img/star.png" width="30"> 
                                                         <img class="" alt="" src="/assets/Customer/img/star.png" width="30">
                                                         <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                                         <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                                         <img class="" alt="" src="/assets/Customer/img/star1.png" width="30"> 
                                                <?php
                                                }
                                                elseif($getR == 1)
                                                {
                                                ?>
                                                    <img class="" alt="" src="/assets/Customer/img/star.png" width="30"> 
                                                         <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                                         <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                                         <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                                         <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                                <?php
                                                }
                                                else
                                                {
                                                ?>
                                                     <img class="" alt="" src="/assets/Customer/img/star1.png" width="30"> 
                                                         <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                                         <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                                         <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                                         <img class="" alt="" src="/assets/Customer/img/star1.png" width="30"> 
                                                <?php
                                                }
                                                ?>
                                                </span>
                                                <?php
                                                }
                                                else
                                                {
                                                ?>
                                                <span>
                                                    <img class="" alt="" src="/assets/Customer/img/star1.png" width="30"> 
                                                         <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                                         <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                                         <img class="" alt="" src="/assets/Customer/img/star1.png" width="30">
                                                         <img class="" alt="" src="/assets/Customer/img/star1.png" width="30"> 
                                                </span>
                                                <?php
                                                }


                                                ?>
                                                    
                                                
                                                <label><?php echo $ratArray['rating_num']; ?> reviews</label>

                                                </div>
                                            </div>
                                        </div>
                                       
                                     <input type="hidden" id="hd_total" name="hd_total" value="0.00">
                                     <input type="hidden" id="hd_charges" name="hd_charges" value="0.00">
                                     <input type="hidden" id="hd_orderTime" name="hd_orderTime" > 
                                     
                                        <div class="clearfix"></div>
                                        <div class="margin20"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab2" class="tab-pane fade">
                            hello
                        </div>
                        <div id="tab3" class="tab-pane fade">
                            hello
                        </div>
                        <div id="tab4" class="tab-pane fade">
                            hello
                        </div>
                    </div>
                    <div class="margin20"></div>
                </div>
            </div>
        </div>

        <div class="container-fluid"></div>
</form>
<?php
$this->load->view("includes/Customer/footer"); 
?>


<script>
    function addressFun(str){
        if(str != '')
        {

            $.ajax({

                    url: "/ajaxaddressFetch/",
                    type: "post",
                    data: {address:str} ,
                    success: function (response) {
                        $("#addressdata").html(response);
                    }
            })
        }
    }
</script>




<script>
   function removeItem(table){

     if (table == "") {
        document.getElementById("show_cartdata").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("show_cartdata").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","/ajax_cart_table_remove/"+table,true);
        xmlhttp.send();
    }

    
     
   }
</script>




<!-- Modal -->
<div id="customerAddress" class="modal fade" role="dialog" data-backdrop="static" >
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Address</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div id="msgadress">

            </div>
             <form action="" method="post">
                <div class="col-md-6">
                <h3>Billing Address</h3>
                  <div class="form-group">
                    <label for="email">Full Name:</label>
                    <input type="text" class="form-control" id="billing_full_name" name="billing_full_name">
                  </div>
                  <div class="form-group">
                    <label for="pwd">Address line 1:</label>
                    <input type="text" class="form-control" id="billing_addres_1" name="billing_addres_1">
                  </div>
                  <div class="form-group">
                    <label for="email">Address line 2:</label>
                    <input type="text" class="form-control" id="billing_address_2" name="billing_address_2">
                  </div>
                  <div class="form-group">
                    <label for="pwd">City:</label>
                    <input type="text" class="form-control" id="billing_city" name="billing_city">
                  </div>
                  <div class="form-group">
                    <label for="email">State:</label>
                    <input type="text" class="form-control" id="billing_state" name="billing_state"> 
                  </div>
                  <div class="form-group">
                    <label for="pwd">Zip Code:</label>
                    <input type="text" class="form-control" id="billing_zip_code" name="billing_zip_code">
                  </div>
                  <div class="form-group">
                    <label for="pwd">Phone Number:</label>
                    <input type="text" class="form-control" id="billing_phoneno" name="billing_phoneno">
                  </div>
                  <div class="checkbox">
                    <label><input type="checkbox" value="1" onchange="toggleCheckbox(this)"> Shipping Address Same as billing </label>
                  </div>

                </div>
                <div class="col-md-6">
                  <h3>Shipping Address</h3>
                  <div class="form-group">
                    <label for="email">Full Name:</label>
                    <input type="text" class="form-control" id="shipping_full_name" name="shipping_full_name">
                  </div>
                  <div class="form-group">
                    <label for="pwd">Address line 1:</label>
                    <input type="text" class="form-control" id="shipping_address_1" name="shipping_address_1">
                  </div>
                  <div class="form-group">
                    <label for="email">Address line 2:</label>
                    <input type="text" class="form-control" id="shipping_address_2" name="shipping_address_2">
                  </div>
                  <div class="form-group">
                    <label for="pwd">City:</label>
                    <input type="text" class="form-control" id="shipping_city" name="shipping_city">
                  </div>
                  <div class="form-group">
                    <label for="email">State:</label>
                    <input type="text" class="form-control" id="shipping_state" name="shipping_state">
                  </div>
                  <div class="form-group">
                    <label for="pwd">Zip Code:</label>
                    <input type="text" class="form-control" id="shipping_zip_code" name="shipping_zip_code">
                  </div>
                  <div class="form-group">
                    <label for="pwd">Phone Number:</label>
                    <input type="text" class="form-control" id="shipping_phoneno" name="shipping_phoneno">
                  </div>
                  <button type="button" class="btn btn-success" name="btnaddressave" onclick="saveAddress()">Save</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>

  </div>
</div>



<!-- Modal -->

<script>
    function toggleCheckbox(element)
    {
       if(element.checked)
       {
           var full_name = document.getElementById("billing_full_name").value;
           var billing_addres_1 = document.getElementById("billing_addres_1").value;
           var billing_address_2 = document.getElementById("billing_address_2").value;
           var billing_city = document.getElementById("billing_city").value;
           var billing_state = document.getElementById("billing_state").value;
           var billing_zip_code = document.getElementById("billing_zip_code").value;
           var phoneno = document.getElementById("billing_phoneno").value;
         


           document.getElementById("shipping_full_name").value = full_name; 
           document.getElementById("shipping_address_1").value = billing_addres_1;
           document.getElementById("shipping_address_2").value = billing_address_2;
           document.getElementById("shipping_city").value = billing_city;
           document.getElementById("shipping_state").value = billing_state;
           document.getElementById("shipping_zip_code").value = billing_zip_code;
           document.getElementById("shipping_phoneno").value = phoneno;
       }

    }
</script>

<script>
    function saveAddress(){
           var full_name = document.getElementById("billing_full_name").value;
           var billing_addres_1 = document.getElementById("billing_addres_1").value;
           var billing_address_2 = document.getElementById("billing_address_2").value;
           var billing_city = document.getElementById("billing_city").value;
           var billing_state = document.getElementById("billing_state").value;
           var billing_zip_code = document.getElementById("billing_zip_code").value;
           var phoneno = document.getElementById("billing_phoneno").value;

           var shipping_full_name = document.getElementById("shipping_full_name").value; 
           var shipping_address_1 = document.getElementById("shipping_address_1").value;
           var shipping_address_2 = document.getElementById("shipping_address_2").value;
           var shipping_city = document.getElementById("shipping_city").value;
           var shipping_state = document.getElementById("shipping_state").value;
           var shipping_zip_code = document.getElementById("shipping_zip_code").value;
           var shipping_phoneno = document.getElementById("shipping_phoneno").value;


           $.ajax({

            url: "/customer_address_add/",
            type: "post",
            data: {full_name:full_name,billing_addres_1:billing_addres_1,billing_address_2:billing_address_2,billing_city:billing_city,billing_state:billing_state,
                billing_zip_code:billing_zip_code,phoneno:phoneno,shipping_full_name:shipping_full_name,shipping_address_1:shipping_address_1,shipping_address_2:shipping_address_2,
                shipping_city:shipping_city,shipping_state:shipping_state,shipping_zip_code:shipping_zip_code,shipping_phoneno:shipping_phoneno} ,
            success: function (response) {
                $("#CustomerAddressData").html(response);
                $("#msgadress").html('<div class="alert alert-success"><strong>Success!</strong> Address added successfully done!</div>');
                
                $('#customerAddress').modal('hide');
            }
        })
    }
</script>


<script>
    function gettimevalue(){

        var t1 = document.getElementById('time1').value;
        var t2 = document.getElementById('time2').value;
        var t3 = document.getElementById('time3').value;

        var t4 = t1+':'+t2+' '+t3;

        document.getElementById('booking_time').value = t4;

    }
</script>
<script>
    $(".openTimeController").click(function (){
        $("#datetimepicker3").css('display','block');
    });
    $(".closeTimeInput").click(function (){
        $("#datetimepicker3").css('display','none');
    });
</script>


<script>
    function timeShowFun(){
        var res_time = $("#booking_time").val();
        $("#datetimepicker3").css('display','none');

        if(res_time != '')
        {
            $.ajax({

                    url: "/ajax_resrvation_booking_time/",
                    type: "post",
                    data: {res_time:res_time} ,
                    success: function (response) {
                        $("#timeshow").html(response);
                    }
            })
        }
        
    }
</script>


<script>
    $('#login_toggle2').click(function (){
        
        $('#myLogin').toggleClass('login');
        $('.login-dropdown').toggleClass('blockedContent');
    });
</script>


