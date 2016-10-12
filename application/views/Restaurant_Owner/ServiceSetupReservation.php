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
                    <h4 class="border_bottom">Service Name - RESERVATION</h4>                   

                     <div class="clear_h10"></div>
                     <h4 class="border_bottom">Happy Hours:</h4>
                    <div class="table-responsive">
                    <div style="width:80%; background:#f8f8f8;">                  
                    <table class="table bg-gray-light tbl" style="width:60%;">
                   
                    <tbody><tr>

                        <td>From </td>
                        <td><input type="text" id="happy_from" name="happy_from"  value="<?php if($restroWork['happy_from'] != ''){ echo $restroWork['happy_from']; }else{ echo '00:00 00'; } ?>"> </td>
                        <td>to </td>
                        <td><input type="text" id="happy_to" name="happy_to"  value="<?php if($restroWork['happy_to'] != ''){ echo $restroWork['happy_to']; }else{ echo '00:00 00'; } ?>"> </td>
                    </tr>
                    </tbody>
                    </table>
                    <h4 class="border_bottom">Working Hours:</h4>
                    <div class="table-responsive">
                    <div style="width:80%; background:#f8f8f8;">                  
                    <table class="table bg-gray-light tbl" style="width:60%;">
                   
                    <tbody><tr><td></td><!--<td>Open</td><td>Close</td>--><td>FROM</td><td>TO</td></tr>

                    <tr><td>Monday:</td>
                        <!--<td><input type="radio" name="monday" value="1" <?php if($restroWork['monday_status'] == 1){ echo "checked"; } ?>></td>
                        <td><input type="radio" name="monday" value="0" <?php if($restroWork['monday_status'] == 0){ echo "checked"; } ?>></td>-->
                        <td>
                        	 <input type="text" id="monday_from" name="monday_from"  value="<?php if($restroWork['monday_from'] != ''){ echo $restroWork['monday_from']; }else{ echo '10:00 AM'; } ?>">
                        </td>
                        <td>
                        	<input type="text" id="monday_to" name="monday_to" value="<?php if($restroWork['monday_to'] != ''){ echo $restroWork['monday_to']; }else{ echo '11:00 PM'; } ?>">
                        </td>
                    </tr>
                    <tr><td>Tuesday:</td>
                        <!--<td><input type="radio" name="tuesday" value="1" <?php if($restroWork['tuesday_status'] == 1){ echo "checked"; } ?>></td>
                        <td><input type="radio" name="tuesday" value="0" <?php if($restroWork['tuesday_status'] == 0){ echo "checked"; } ?>></td>-->
                        <td>
                           <input type="text" id="tuesday_from" name="tuesday_from" value="<?php if($restroWork['tuesday_from'] != ''){ echo $restroWork['tuesday_from']; }else{ echo '10:00 AM'; } ?>">
                        </td>
                        <td>
                          <input type="text" id="tuesday_to" name="tuesday_to" value="<?php if($restroWork['tuesday_to'] != ''){ echo $restroWork['tuesday_to']; }else{ echo '11:00 PM'; } ?>">
                        </td>    
                    </tr>
                    <tr><td>Wednesday:</td>
                        <!--<td><input type="radio" name="wednesday" value="1" <?php if($restroWork['wednesday_status'] == 1){ echo "checked"; } ?>></td>
                        <td><input type="radio" name="wednesday" value="0" <?php if($restroWork['wednesday_status'] == 0){ echo "checked"; } ?>></td>-->
                        <td>
                           <input type="text" id="wednesday_from" name="wednesday_from" value="<?php if($restroWork['wednesday_from'] != ''){ echo $restroWork['wednesday_from']; }else{ echo '10:00 AM'; } ?>">
                        </td>
                        <td>
                          <input type="text" id="wednesday_to" name="wednesday_to" value="<?php if($restroWork['wednesday_to'] != ''){ echo $restroWork['wednesday_to']; }else{ echo '11:00 PM'; } ?>">
                        </td>   
                    </tr>
                    <tr><td>Thursday:</td>
                        <!--<td><input type="radio" name="thursday" value="1" <?php if($restroWork['thursday_status'] == 1){ echo "checked"; } ?>></td>
                        <td><input type="radio" name="thursday" value="0" <?php if($restroWork['thursday_status'] == 0){ echo "checked"; } ?>></td>-->
                        <td>
                           <input type="text" id="thursday_from" name="thursday_from" value="<?php if($restroWork['thursday_from'] != ''){ echo $restroWork['thursday_from']; }else{ echo '10:00 AM'; } ?>">
                        </td>
                        <td>
                          <input type="text" id="thursday_to" name="thursday_to" value="<?php if($restroWork['thursday_to'] != ''){ echo $restroWork['thursday_to']; }else{ echo '11:00 PM'; } ?>">
                        </td>    
                    </tr>
                    <tr><td>Friday:</td>
                        <!--<td><input type="radio" name="friday" value="1" <?php if($restroWork['friday_status'] == 1){ echo "checked"; } ?>></td>
                        <td><input type="radio" name="friday" value="0" <?php if($restroWork['friday_status'] == 0){ echo "checked"; } ?>></td>-->
                        <td>
                           <input type="text" id="friday_from" name="friday_from" value="<?php if($restroWork['friday_from'] != ''){ echo $restroWork['friday_from']; }else{ echo '10:00 AM'; } ?>">
                        </td>
                        <td>
                          <input type="text" id="friday_to" name="friday_to" value="<?php if($restroWork['friday_to'] != ''){ echo $restroWork['friday_to']; }else{ echo '11:00 PM'; } ?>">
                        </td>     
                    </tr>
                    <tr><td>Saturady:</td>
                        <!--<td><input type="radio" name="saturday" value="1" <?php if($restroWork['saturday_status'] == 1){ echo "checked"; } ?>></td>
                        <td><input type="radio" name="saturday" value="0" <?php if($restroWork['saturday_status'] == 0){ echo "checked"; } ?>></td>-->
                        <td>
                           <input type="text" id="saturday_from" name="saturday_from" value="<?php if($restroWork['saturday_from'] != ''){ echo $restroWork['saturday_from']; }else{ echo '10:00 AM'; } ?>">
                        </td>
                        <td>
                          <input type="text" id="saturday_to" name="saturday_to" value="<?php if($restroWork['saturday_to'] != ''){ echo $restroWork['saturday_to']; }else{ echo '11:00 PM'; } ?>">
                        </td>
                    </tr>
                    <tr><td>Sunday:</td>
                        <!--<td><input type="radio" name="sunday" value="1" <?php if($restroWork['sunday_status'] == 1){ echo "checked"; } ?>></td>
                        <td><input type="radio" name="sunday" value="0" <?php if($restroWork['sunday_status'] == 0){ echo "checked"; } ?>></td>-->
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

        $('#happy_from').timepicker();
        $('#happy_to').timepicker();

    });
</script>