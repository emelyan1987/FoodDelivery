<?PHP
  $this->load->view("includes/Restaurant_Owner/header"); 
  $this->load->view("includes/Restaurant_Owner/sidebar");
?>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link type="text/css" href="<?PHP echo base_url();  ?>assets/Restaurant_Owner/dist/css/jquery.timepicker.css" />

<script type="text/javascript" src="<?PHP echo base_url();  ?>assets/Restaurant_Owner/dist/js/jquery.timepicker.js"></script>

<!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
            <!-- Content Header (Page header) -->
<section class="content">


  <form action="" method="post" >
                <div class="row">

                    <div class="col-md-12">
                    <a href="/manage_restro_location/<?php echo $restroWork['restro_id']; ?>" class="btn bg-gray-light2">&lt; &nbsp;Back to Add Location</a>
                  
                    
                    <div class="clear_h10"></div>
                    <h4 class="border_bottom">Service Name - CATERING</h4>                   

                    <div class="table-responsive">
                    <table class="table bg-gray-light tbl" style="width:80%;">
                    <tbody>
                    <tr><td>ORDER TIME:</td>
                        <td>
                            <div class="col-md-1">&nbsp;</div>
                            <div class="col-md-11"><!--<input type="text" value="<?php //echo $restroWork['order_time']; ?>" name="order_delivery_time">-->
                                <div class="col-md-3">
                              <select name="dordert_days">
                                
                                  <?php
                                  for($i = 0; $i<=10; $i++)
                                  {
                                  ?>
                                    <option value="<?php echo $i; ?>" <?php if($restroWork['order_days'] == $i){ echo "selected"; } ?>><?php echo $i; ?> Days</option>
                                  <?php
                                  }
                                  ?>
                                  
                              </select>
                          </div>
                          <div class="col-md-3">
                              <select name="dordert_hour">
                                
                                  <?php
                                  for($i = 0; $i<=24; $i++)
                                  {
                                  ?>
                                    <option value="<?php echo $i; ?>"  <?php if($restroWork['order_hour'] == $i){ echo "selected"; } ?>><?php echo $i; ?> Hour</option>
                                  <?php
                                  }
                                  ?>
                                  
                              </select>
                          </div>
                          <div class="col-md-3">
                              <select name="dordert_minitue">
                               
                                  <?php
                                  for($i = 0; $i<=59; $i++)
                                  {
                                  ?>
                                    <option value="<?php echo $i; ?>" <?php if($restroWork['order_minitue'] == $i){ echo "selected"; } ?>><?php echo $i; ?> Min.</option>
                                  <?php
                                  }
                                  ?>
                                  
                              </select>
                          </div>
                          <div class="col-md-3">
			  <input type="hidden" name="dordert_second" value="0">
                              <!--<select name="dordert_second">
                                 <option value="0">0 Sec.</option>
                                  <?php
                                  //for($i = 1; $i<=60; $i++)
                                  //{
                                  ?>
                                    <option value="<?php //echo $i; ?>" <?php //if($restroWork['order_second'] == $i){ echo "selected"; } ?>><?php //echo $i; ?> Sec.</option>
                                  <?php
                                  //}
                                  ?>
                                  
                              </select>-->
                          </div>
                            </div>
                        </td>
                    </tr>
                   
                    
                     <tr><td colspan="2">
                     <!--<table class="table bg-gray-light" width="100%">
                      <tbody><tr><td colspan="4">ADD PAYMENT OPTION</td></tr>
                      <tr>
                      		<td>
                      			<div class="col-md-3"><input id="Radio1" name="payment[]" type="checkbox" value="1" <?php if(chkRestropaymethod(1,$resData->id) ==  1){ echo 'checked'; } ?>> &nbsp;</div>
                      			<div class="col-md-9"><img src="<?PHP echo base_url();  ?>assets/Restaurant_Owner/images/icon/cash.png" alt=""> &nbsp;Cash</div>
                      		</td>
                         	<td>
                         		<div class="col-md-3"><input id="Radio2" name="payment[]" type="checkbox" value="2" <?php if(chkRestropaymethod(2,$resData->id) ==  1){ echo 'checked'; } ?>> &nbsp;</div>
                         		<div class="col-md-9"><img src="<?PHP echo base_url();  ?>assets/Restaurant_Owner/images/icon/knet.png" alt=""> &nbsp;Knet</div>
                         	</td>
                         	<td>
                         		<div class="col-md-3"><input id="Radio3" name="payment[]" type="checkbox" value="3" <?php if(chkRestropaymethod(3,$resData->id) ==  1){ echo 'checked'; } ?>> &nbsp;</div>
                         		<div class="col-md-9"><img src="<?PHP echo base_url();  ?>assets/Restaurant_Owner/images/icon/creditcard.png" alt=""> &nbsp;Credit Card</div>
                         	</td>
                         	<td>
                         		<div class="col-md-3"><input id="Radio4" name="payment[]" type="checkbox" value="4" <?php if(chkRestropaymethod(4,$resData->id) ==  1){ echo 'checked'; } ?>> &nbsp;</div>
                         		<div class="col-md-9"><img src="<?PHP echo base_url();  ?>assets/Restaurant_Owner/images/icon/paypal.png" alt=""> &nbsp;Paypal</div>
                         	</td>
                     </tr>
                     </tbody></table>-->
                     </td></tr>
                    
                  </tbody></table> 
                    </div>

                    <h4 class="border_bottom">Working Hours:</h4>
                    <div class="table-responsive">
                    <div style="width:80%; background:#f8f8f8;">                  
                    <table class="table bg-gray-light tbl" style="width:60%;">
                   
                    <tbody><tr><td></td><td>Open</td><td>Close</td><td>FROM</td><td>TO</td></tr>

                    <tr><td>Monday:</td>
                        <td><input type="radio" name="monday" value="1" <?php if($restroWork['monday_status'] == 1){ echo "checked"; } ?>></td>
                        <td><input type="radio" name="monday" value="0" <?php if($restroWork['monday_status'] == 0){ echo "checked"; } ?>></td>
                        <td>
                        	 <input type="text" id="monday_from" name="monday_from"  value="<?php if($restroWork['monday_from'] != ''){ echo $restroWork['monday_from']; }else{ echo '10:00 AM'; } ?>">
                        </td>
                        <td>
                        	<input type="text" id="monday_to" name="monday_to" value="<?php if($restroWork['monday_to'] != ''){ echo $restroWork['monday_to']; }else{ echo '11:00 PM'; } ?>">
                        </td>
                    </tr>
                    <tr><td>Tuesday:</td>
                        <td><input type="radio" name="tuesday" value="1" <?php if($restroWork['tuesday_status'] == 1){ echo "checked"; } ?>></td>
                        <td><input type="radio" name="tuesday" value="0" <?php if($restroWork['tuesday_status'] == 0){ echo "checked"; } ?>></td>
                        <td>
                           <input type="text" id="tuesday_from" name="tuesday_from" value="<?php if($restroWork['tuesday_from'] != ''){ echo $restroWork['tuesday_from']; }else{ echo '10:00 AM'; } ?>">
                        </td>
                        <td>
                          <input type="text" id="tuesday_to" name="tuesday_to" value="<?php if($restroWork['tuesday_to'] != ''){ echo $restroWork['tuesday_to']; }else{ echo '11:00 PM'; } ?>">
                        </td>    
                    </tr>
                    <tr><td>Wednesday:</td>
                        <td><input type="radio" name="wednesday" value="1" <?php if($restroWork['wednesday_status'] == 1){ echo "checked"; } ?>></td>
                        <td><input type="radio" name="wednesday" value="0" <?php if($restroWork['wednesday_status'] == 0){ echo "checked"; } ?>></td>
                        <td>
                           <input type="text" id="wednesday_from" name="wednesday_from" value="<?php if($restroWork['wednesday_from'] != ''){ echo $restroWork['wednesday_from']; }else{ echo '10:00 AM'; } ?>">
                        </td>
                        <td>
                          <input type="text" id="wednesday_to" name="wednesday_to" value="<?php if($restroWork['wednesday_to'] != ''){ echo $restroWork['wednesday_to']; }else{ echo '11:00 PM'; } ?>">
                        </td>   
                    </tr>
                    <tr><td>Thursday:</td>
                        <td><input type="radio" name="thursday" value="1" <?php if($restroWork['thursday_status'] == 1){ echo "checked"; } ?>></td>
                        <td><input type="radio" name="thursday" value="0" <?php if($restroWork['thursday_status'] == 0){ echo "checked"; } ?>></td>
                        <td>
                           <input type="text" id="thursday_from" name="thursday_from" value="<?php if($restroWork['thursday_from'] != ''){ echo $restroWork['thursday_from']; }else{ echo '10:00 AM'; } ?>">
                        </td>
                        <td>
                          <input type="text" id="thursday_to" name="thursday_to" value="<?php if($restroWork['thursday_to'] != ''){ echo $restroWork['thursday_to']; }else{ echo '11:00 PM'; } ?>">
                        </td>    
                    </tr>
                    <tr><td>Friday:</td>
                        <td><input type="radio" name="friday" value="1" <?php if($restroWork['friday_status'] == 1){ echo "checked"; } ?>></td>
                        <td><input type="radio" name="friday" value="0" <?php if($restroWork['friday_status'] == 0){ echo "checked"; } ?>></td>
                        <td>
                           <input type="text" id="friday_from" name="friday_from" value="<?php if($restroWork['friday_from'] != ''){ echo $restroWork['friday_from']; }else{ echo '10:00 AM'; } ?>">
                        </td>
                        <td>
                          <input type="text" id="friday_to" name="friday_to" value="<?php if($restroWork['friday_to'] != ''){ echo $restroWork['friday_to']; }else{ echo '11:00 PM'; } ?>">
                        </td>     
                    </tr>
                    <tr><td>Saturady:</td>
                        <td><input type="radio" name="saturday" value="1" <?php if($restroWork['saturday_status'] == 1){ echo "checked"; } ?>></td>
                        <td><input type="radio" name="saturday" value="0" <?php if($restroWork['saturday_status'] == 0){ echo "checked"; } ?>></td>
                        <td>
                           <input type="text" id="saturday_from" name="saturday_from" value="<?php if($restroWork['saturday_from'] != ''){ echo $restroWork['saturday_from']; }else{ echo '10:00 AM'; } ?>">
                        </td>
                        <td>
                          <input type="text" id="saturday_to" name="saturday_to" value="<?php if($restroWork['saturday_to'] != ''){ echo $restroWork['saturday_to']; }else{ echo '11:00 PM'; } ?>">
                        </td>
                    </tr>
                    <tr><td>Sunday:</td>
                        <td><input type="radio" name="sunday" value="1" <?php if($restroWork['sunday_status'] == 1){ echo "checked"; } ?>></td>
                        <td><input type="radio" name="sunday" value="0" <?php if($restroWork['sunday_status'] == 0){ echo "checked"; } ?>></td>
                        <td>
                           <input type="text" id="sunday_from" name="sunday_from" value="<?php if($restroWork['sunday_from'] != ''){ echo $restroWork['sunday_from']; }else{ echo '10:00 AM'; } ?>">
                        </td>
                        <td>
                          <input type="text" id="sunday_to" name="sunday_to" value="<?php if($restroWork['sunday_to'] != ''){ echo $restroWork['sunday_to']; }else{ echo '11:00 PM'; } ?>">
                        </td>
                    </tr>
                    
                    </tbody></table>
                    </div> 
                    </div>
                    <div class="clear_h20"></div>

                   
                   <button type="submit" class="btn bg-green" name="btnsave">SAVE</button>
                    </div>
                 </div>
               </form>
            </section>


  </div>          


<script>
                $('#datepairExample .time').timepicker({
                    'showDuration': true,
                    'timeFormat': 'g:ia'
                });
     
                $('#datepairExample').datepair();
</script>

  <?PHP
  $this->load->view("includes/Restaurant_Owner/footer");
?>


<script>
    $(function() {

        $('#monday_from').timepicker();
        $('#monday_to').timepicker();
        $('#tuesday_from').timepicker();
        $('#tuesday_to').timepicker();
        $('#wednesday_from').timepicker();
        $('#wednesday_to').timepicker();
        $('#thursday_from').timepicker();
        $('#thursday_to').timepicker();
        $('#friday_from').timepicker();
        $('#friday_to').timepicker();
        $('#saturday_from').timepicker();
        $('#saturday_to').timepicker();
        $('#sunday_from').timepicker();
        $('#sunday_to').timepicker();

        

    });
</script>