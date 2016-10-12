  <?PHP
  $this->load->view("includes/Administration/header"); 
  $this->load->view("includes/Administration/sidebar");
  ?>
  <!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            
            <!-- Main content -->
            <form method="post">
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                       
                        <?PHP
                        if(isset($success_msg))
                         {
                                echo $success_msg;
                         }
                        ?>
                    
                    <a href="/restaurant_locations/<?php echo $restro_id; ?>" class="btn bg-gray-light2">< &nbsp;Back to Location List</a>
                    <div class="clear_h10"></div>
                    <h4 class="border_bottom">Location Name</h4>                   
                    <input type="hidden" name="location_id" value="<?php echo $location_id; ?>" id="location_id" >
                    <div class="table-responsive">
                    <table class="table bg-gray-light tbl" style="width:80%;">
                    <tr><td width="20%">NAME:</td>
                        <td colspan="2"><input id="location_name" name="location_name"  type="text" placeholder="Location name"/>
                              <span style="color:red"><?PHP  echo form_error("location_name"); ?></span>
                        </td></tr>
                    <tr><td>CONTACT PERSON:</td>
                        <td colspan="2"><input id="contact_name" name="contact_name" type="text" placeholder="Contact Person"/>
                          <span style="color:red"><?PHP  echo form_error("contact_name"); ?></span>
                        </td></tr>
                    <tr><td>TELEPHONES:</td>
                        <td ><input id="telephones" name="telephones" type="text" placeholder="Telephones No. 1"/>
                               <span style="color:red"><?PHP  echo form_error("telephones"); ?></span>

                        </td>
                        <td ><input id="telephones2" name="telephones2" type="text" placeholder="Telephones No. 2"/>
                               

                        </td>
                    </tr>
                    <tr><td>&nbsp;</td>
                        <td ><input id="telephones3" name="telephones3" type="text" placeholder="Telephones No. 3"/>
                               

                        </td>
                        <td >&nbsp;
                               

                        </td>
                    </tr>
                    <tr><td>LATITUDE & LONGITUDE:</td>
                        <td><input id="latitude" type="text" name="latitude" placeholder="Latitude"/> 
                      <span style="color:red"><?PHP  echo form_error("latitude"); ?></span>

                        </td>
                        <td><input id="longitude"  type="text" name="longitude" placeholder="longitude"/>
                              <span style="color:red"><?PHP  echo form_error("longitude"); ?></span>
                        </td></tr>
                    <tr><td>FEATURED LOCATION<br /><em style="font-size:11px;">(Super Admin feature only)</em></td>
                      
                        <td><input id="featured" type="radio"  name="featured" value="1"/> <span>Yes</span>&nbsp; &nbsp;
                        <input id="featured"   type="radio" name="featured" value="0"/> <span>No</span>

                           <span style="color:red"><?PHP  echo form_error("featured"); ?></span>  
                    </td></tr>
                    </table> 
                    </div>

                    <h4 class="border_bottom">Address:</h4>  
                    <div class="table-responsive">
                    <table class="table bg-gray-light tbl" style="width:80%;">
                    <tr><td>CITY:<br />

                        <select name="restro_city" onchange='areashowbycity(1,this.value,"restro_area");'>
                             <option value="">Select City</option>
                             <?PHP
                              foreach($city_list as $ks=>$vs)
                              {
                                 
                         ?>

                                   <option value="<?PHP echo $vs->id; ?>"> <?PHP  echo $vs->city_name; ?></option>";

                                  <?PHP

                              }

                             ?>      
                        </select>
                        <span style="color:red"><?PHP  echo form_error("restro_city"); ?></span>  
                    </td>



                        <td>AREA:<br />

                        <select Name="restro_area" id="restro_area">
                            <option value="">Select Area</option>
                               
                           

                        </select>
                           <span style="color:red"><?PHP  echo form_error("restro_area"); ?></span>
                    </td></tr>


                    <!--<tr><td colspan="2"><a href="" class="edit text-blue"><img src="<?PHP echo base_url();  ?>assets/Administration/images/icon/edit.png" alt="" /> Edit City list</a></td></tr>-->
                    <tr><td>BLOCK:<br />
                        <input id="block" type="text" name="block" placeholder="Block"/>
                        <span style="color:red"><?PHP  echo form_error("block"); ?></span>
                     </td>
                        <td>STREET:<br />
                        <input id="street" type="text" name="street" placeholder="Street"/>
                        <span style="color:red"><?PHP  echo form_error("street"); ?></span>
                        </td></tr>
                         <tr><td>BUILDING:<br />
                        <input id="building" type="text" name="building" placeholder="Building"/>

                        <span style="color:red"><?PHP  echo form_error("building"); ?></span>

                    </td></tr>
                    </table>
                    </div>
                   
                   <h4 class="border_bottom">Register service, Comission & Edit options:</h4>                   
                   <div class="table-responsive">
                            <table class="table table_design">
                                <thead>
                                    <tr>
                                        <th>SELECT SERVICE:</th>
                                        <th>Comission:</th>
                                        <!--<th>MENU CATEGORY:</th>-->
                                        <th>SETUP SERVICE:</th>
                                        <th>ACTIVE:</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input id="Radio3" type="checkbox" name="service_pickup" value="1" /> <span id="pickup_font">PICKUP</span></td>
                                        <td>KD <input id="C_amount_pickup" type="text" value="" name="C_amount_pickup" onkeyup="comFun1(this.value,'C_percent_pickup')" />
                                            &nbsp;or&nbsp;
                                            <input id="C_percent_pickup" type="text" value=""  class="text-right"  name="C_percent_pickup" onkeyup="comFun1(this.value,'C_amount_pickup')"/> %</td> 
                                        <!--<td><span id="pickup_count"><?php //categoryCountByService(4,$restro_id,$location_id); ?></span>  <a href="#" class="btn bg-gray-light2" data-toggle="modal" data-target="#category" onclick="mycategory(4)"><span class="add_sign">+</span> Add</a></td>-->
                                        <td><a data-toggle="modal" data-target="#myPickUp" class="btn border-gray text-black MyPickupLink"><span><img id="im_pickup" src="<?PHP echo base_url();  ?>assets/Administration/images/icon/setup_gray.png" alt="" /></span> Setup</a></td>
                                        <td><input id="Radio4" type="radio" checked="checked" name="pickup_status" value="1"/> <span>YES</span> &nbsp;
                                            <input id="Radio5" type="radio" name="pickup_status" value="0"/> <span>NO</span></td>                                        
                                    </tr>
                                    <tr>
                                        <td><input id="Radio6" type="checkbox" name="service_delivery" value="1" id="service_delivery" /> <span id="delivery_font">DELIVERY</span></td>
                                        <td>KD <input type="text" value=""  name="C_amount_delivery"  onkeyup="comFun1(this.value,'C_percent_delivery')" id="C_amount_delivery"/>
                                            &nbsp;or&nbsp;
                                            <input type="text" value=""  class="text-right"   name="C_percent_delivery"  onkeyup="comFun1(this.value,'C_amount_delivery')" id="C_percent_delivery"/> %</td>
                                        <!--<td><span id="delivery_count"><?php //categoryCountByService(1,$restro_id,$location_id); ?></span> <a href="#" class="btn border-gray text-black" data-toggle="modal" data-target="#category" onclick="mycategory(1)"><span class="add_sign">+</span> Add</a></td>-->
                                        <td><a data-toggle="modal" data-target="#myDelivery" class="btn border-gray text-black MyDeliveryLink"><span><img id="im_delivery" src="<?PHP echo base_url();  ?>assets/Administration/images/icon/setup_gray.png" alt="" /></span> Setup</a></td>
                                        <td><input id="Radio7" type="radio" checked="checked" name="delivery_status" value="1"/> <span>YES</span> &nbsp;
                                            <input id="Radio8" type="radio"  name="delivery_status" value="0"/> <span>NO</span></td>                                        
                                    </tr>
                                   <tr>
                                        <td><input id="Radio9" type="checkbox"  name="service_reservation" value="1" id="service_reservation" /> <span id="reservation_font">RESERVATION</span></td>
                                        <td>KD <input type="text" value="" name="C_amount_reservation"  onkeyup="comFun1(this.value,'C_percent_reservation')" id="C_amount_reservation"/>
                                            &nbsp;or&nbsp;
                                            <input type="text" value=""  class="text-right"  name="C_percent_reservation"  onkeyup="comFun1(this.value,'C_amount_reservation')" id="C_percent_reservation"/> %</td>
                                        <!--<td>N/A</td>-->
                                        <td><a data-toggle="modal" data-target="#myReservation" class="btn border-gray text-black MyReservationLink"><span><img id="im_reservation" src="<?PHP echo base_url();  ?>assets/Administration/images/icon/setup_gray.png" alt="" /></span> Setup</a></td>
                                        <td><input id="Radio10" type="radio" checked="checked"  name="reservation_status" value="1"/> <span>YES</span> &nbsp;
                                            <input id="Radio11" type="radio"  name="reservation_status" value="0"/> <span>NO</span></td>                                        
                                    </tr>
                                    <tr>
                                        <td><input id="Radio12" type="checkbox" name="service_catering" value="1"/> <span id="catering_font">CATERING</span></td>
                                        <td>KD <input type="text" value=""  name="C_amount_catering"  onkeyup="comFun1(this.value,'C_percent_catering')" id="C_amount_catering" />
                                            &nbsp;or&nbsp;
                                            <input type="text" value=""  class="text-right"   name="C_percent_catering"  onkeyup="comFun1(this.value,'C_amount_catering')" id="C_percent_catering"/> %</td>
                                        <!--<td><span id="catering_count"><?php //categoryCountByService(2,$restro_id,$location_id); ?></span> <a href="#" class="btn border-gray text-black" data-toggle="modal" data-target="#category" onclick="mycategory(2)"><span class="add_sign">+</span> Add</a></td>-->
                                        <td><a  data-toggle="modal" data-target="#myCatering" class="btn border-gray text-black MyCateringLink"><span><img id="im_catering" src="<?PHP echo base_url();  ?>assets/Administration/images/icon/setup_gray.png" alt="" /></span> Setup</a></td>
                                        <td><input id="Radio13" type="radio" checked="checked"  name="catering_status" value="1"/> <span>YES</span> &nbsp;
                                            <input id="Radio14" type="radio"  name="catering_status" value="0"/> <span>NO</span></td>                                   
                                    </tr>
                                </tbody>
                            </table>
                    </div>
                   

                       <button type="submit" name="add_location" class="btn bg-green" id="savebtn">Save</button>
                       <a href="/restaurant_locations/<?php echo $restro_id; ?>" type="button" data-dismiss="modal" class="btn btn-danger">Close</a>

                    </div>
                 </div>
            </section>
              </form>

          </div><!-- /.content-wrapper -->
           <?PHP
  $this->load->view("includes/Administration/footer");
?>



<!-- Modal -->
<div id="category" class="modal fade" role="dialog" data-backdrop="static" >
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <div id="message" ></div>
        <h4 class="modal-title" id="titleDiv"></h4>
      </div>
      <div class="modal-body">
          <div class="col-md-12">
            <div id="catfetch">
            <?php
            foreach($item_catlist as $it => $itemCat):
            ?>
              <div class="col-md-6"><input type="checkbox" name="category" value="<?php echo $itemCat->id; ?>" onclick="getCheckedCheckboxesFor('category')"> <?php echo ucwords($itemCat->cat_name); ?></div>
            <?php 
            endforeach;
            ?>
          </div>
            <input type="hidden" id="category_id" >
            <input type="hidden" id="serviceid" >
            <input type="hidden" id="user_id_category" value="<?PHP echo isset($user_id)?$user_id:''; ?>">
            <input type="hidden" id="restro_id_category" value="<?PHP echo isset($restro_id)?$restro_id:''; ?>"> 

           
          </div>
          <div class="col-md-12">
            <br>
            <div class="col-md-7"><input type="text" id="new_cat_name" placeholder="Menu Category Name" class="form-control"></div>
            <div class="col-md-5"><input type="submit" onclick="addNewMenuCategory();" value="Add New Menu category" class="btn btn-success"><br><br></div>
          </div>
      </div>
      <div class="modal-footer" style="margin-top:10px;">

        <button type="button" class="btn btn-success" onclick="mycategory1()">Save</button>
        <button type="button" data-dismiss="modal" class="btn btn-danger">Close</button>
      </div>
    </div>

  </div>
</div>

<script>
    function addNewMenuCategory(){

      var str_data = document.getElementById("new_cat_name").value;
        
      if(str_data != '')
      {
          $.ajax({
          url: "/ajax_add_item_category/",
          type: "post",
          data: {cName:str_data} ,
          success: function (response) {
              
                  $("#catfetch").html(response);
             
               
              
                
            }
          })
        }
    }
</script>

<script>
function mycategory(str){
        //$('input:checkbox').removeAttr('checked');
        if(str == '1')
        {
            var modelTitle = "DELIVERY MENU CATEGORY";
        }
        if(str == '2')
        {
            var modelTitle = "CATERING MENU CATEGORY";       
        }
        if(str == '4')
        {
            var modelTitle = "PICKUP MENU CATEGORY";       
        }

        document.getElementById("titleDiv").innerHTML = modelTitle;


        document.getElementById("serviceid").value = str;

}


    function mycategory1(){
       

        var category_id = document.getElementById("category_id").value;
        var service_id = document.getElementById("serviceid").value;
        var user_id = document.getElementById("user_id_category").value;
        var restro_id = document.getElementById("restro_id_category").value;
        var location_id = document.getElementById("location_id").value;

        $.ajax({
        url: "/ajax_item_category_add/",
        type: "post",
        data: {category_id:category_id,service_id:service_id,user_id:user_id,restro_id:restro_id,location_id:location_id} ,
        success: function (response) {
             if(service_id == 1)
             {
                $("#delivery_count").html(response);
             }
             if(service_id == 2)
             {
                 $("#catering_count").html(response);
             }
             if(service_id == 4)
             {
                 $("#pickup_count").html(response);
             }
            
              

              $('#category').modal('hide');
          }
        })

    }
  
</script>

<script type="text/javascript">
function getCheckedCheckboxesFor(checkboxName) {
    var checkboxes = document.querySelectorAll('input[name="' + checkboxName + '"]:checked'), values = [];
    Array.prototype.forEach.call(checkboxes, function(el) {
        values.push(el.value);
    });

    document.getElementById("category_id").value = values;
    
}
</script>



<!--pickup service form-->
<div id="myPickUp" class="modal fade" role="dialog" data-backdrop="static" >
  <div class="modal-dialog  modal-lg">
  <div class="modal-content">
            <!-- Content Header (Page header) -->
            
            <!-- Main content -->
           
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                    <!--<a href="#" class="btn bg-gray-light2">< &nbsp;Back to Add Location</a>-->
                      <div class="clear_h10"></div>
                    <h4 class="border_bottom" style="width:100%;">Service Setup - PICKUP</h4>                   
                     <div class="pickup_msg"></div>
                    <div class="table-responsive" >
                    <table class="table bg-gray-light tbl" style="width:100%;">
                    <tr><td width="30%">ORDER TIME:</td>
                        
                        <input type="hidden" name="pickup_id" id="pickup_id" value="4">
                        <input type="hidden" name="user_id" id="user_id_pickup" value="<?PHP echo isset($user_id)?$user_id:''; ?>">
                        <input type="hidden" name="restro_id" id="restro_id_pickup" value="<?PHP echo isset($restro_id)?$restro_id:''; ?>">


                        <td><!--<input type="text" name="pickup_order_time" id="pickup_order_time">-->
                          <div class="col-md-2">
                              <select id="pordert_days">
                                  <?php
                                  for($i = 0; $i<=10; $i++)
                                  {
                                  ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?> Days</option>
                                  <?php
                                  }
                                  ?>
                                  
                              </select>
                          </div>
                          <div class="col-md-2">
                              <select id="pordert_hour">
                                  <?php
                                  for($i = 0; $i<=24; $i++)
                                  {
                                  ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?> Hour</option>
                                  <?php
                                  }
                                  ?>
                                  
                              </select>
                          </div>
                          <div class="col-md-2">
                              <select id="pordert_minitue">
                                  <?php
                                  for($i = 0; $i<=59; $i++)
                                  {
                                  ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?> Min.</option>
                                  <?php
                                  }
                                  ?>
                                  
                              </select>
                          </div>
                          <div class="col-md-2">
                              <!--<select id="pordert_second">
                                  <?php
                                  //for($i = 0; $i<=59; $i++)
                                  {
                                  ?>
                                    <option value="<?php //echo $i; ?>"><?php //echo $i; ?> Sec.</option>
                                  <?php
                                  }
                                  ?>
                                  
                              </select>-->
                          </div>
                            </td></tr>
                    
                     <tr><td colspan="2">
                     <table class="table bg-gray-light" width="100%">
                      <tr><td colspan="4">ADD PAYMENT OPTION</td></tr>
                      <tr><td><input id="pickup_payment" type="checkbox" name="pickup_payment" value="1"/> &nbsp;<img src="<?PHP echo base_url();  ?>assets/Administration/images/icon/cash.png" alt="" /> &nbsp;Cash</td>
                         <td><input id="pickup_payment" type="checkbox"  name="pickup_payment"  value="2"/> &nbsp;<img src="<?PHP echo base_url();  ?>assets/Administration/images/icon/knet.png" alt="" /> &nbsp;Knet</td>
                         <td><input id="pickup_payment" type="checkbox"  name="pickup_payment" value="3"/> &nbsp;<img src="<?PHP echo base_url();  ?>assets/Administration/images/icon/creditcard.png" alt="" /> &nbsp;Credit Card</td>
                         <td><input id="pickup_payment" type="checkbox"  name="pickup_payment" value="4"/> &nbsp;<img src="<?PHP echo base_url();  ?>assets/Administration/images/icon/paypal.png" alt="" /> &nbsp;Paypal</td>
                     </tr>
                     </table>
                     </td></tr>
                    </table> 
                    </div>

                    <h4 class="border_bottom" style="width:100%;">Working Hours:</h4>
                    <div class="table-responsive">
                    <div style="width:80%; background:#f8f8f8;">                  
                    <table class="table bg-gray-light tbl" style="width:60%;">
                   
                    <tr><td></td><td>FROM</td><td>TO</td></tr>
                    <tr><td>Monday:</td>
                        <td><input type="text"  value="10:30 AM" id="pickup_monday_from"></td>
                        <td><input type="text"  value="10:00 AM" id="pickup_monday_to"></td></tr>
                    <tr>
                        <td>Tuesday:</td>
                        <td><input type="text"  value="10:30 AM" id="pickup_tuesday_from" ></td>
                        <td><input type="text"  value="10:00 AM"  id="pickup_tuesday_to"></td>
                    </tr>
                    <tr><td>Wednesday:</td>
                        <td><input type="text"  value="10:30 AM" id="pickup_wednesday_from"></td>
                        <td><input type="text"  value="10:00 AM" id="pickup_wednesday_to" ></td></tr>
                    <tr><td>Thursday:</td>
                        <td><input type="text"  value="10:30 AM"  id="pickup_thursday_from"  ></td>
                        <td><input type="text"  value="10:00 AM" id="pickup_thursday_to"   ></td></tr>
                    <tr><td>Friday:</td>
                        <td><input type="text"  value="10:30 AM" id="pickup_friday_from"   ></td>
                        <td><input type="text"  value="10:00 AM" id="pickup_friday_to"   ></td></tr>
                    <tr><td>Saturady:</td>
                        <td><input type="text"  value="10:30 AM" id="pickup_saturday_from" ></td>
                        <td><input type="text"  value="10:00 AM" id="pickup_saturday_to"   ></td></tr>
                    <tr><td>Sunday:</td>
                        <td><input type="text"  value="10:30 AM" id="pickup_sunday_from"  ></td>
                        <td><input type="text"  value="10:00 AM" id="pickup_sunday_to"  ></td></tr>
                    
                    </table>
                    </div> 
                    </div>
                    <div class="clear_h20"></div>

                    
                   <a href="javascript:void(0)" onClick="savePickUp()" class="btn bg-green">SAVE</a>
                   <a href="#" type="button" data-dismiss="modal" class="btn btn-danger">Close</a>
                    </div>
                 </div>
            </section>

          </div><!-- /.content-wrapper -->
</div>
</div>

<script>
  function savePickUp()
  {


       var pickup_payment_method = new Array();
        $('input[id="pickup_payment"]:checked').each(function() {
        pickup_payment_method.push(this.value);

        });

         var pickup_id=$("#pickup_id").val();
         //var pickup_order_time=$("#pickup_order_time").val();

         var pordert_days=$("#pordert_days").val();
         var pordert_hour=$("#pordert_hour").val();
         var pordert_minitue=$("#pordert_minitue").val();
         //var pordert_second=$("#pordert_second").val();
         var pordert_second= 0;

         var pickup_payment=pickup_payment_method;
         var user_id_pickup=$("#user_id_pickup").val();
         var restro_id_pickup=$("#restro_id_pickup").val();
         var pickup_monday_from=$("#pickup_monday_from").val();
         var pickup_monday_to=$("#pickup_monday_to").val();
         var pickup_tuesday_from=$("#pickup_tuesday_from").val();
         var pickup_tuesday_to=$("#pickup_tuesday_to").val();

         var pickup_wednesday_from=$("#pickup_wednesday_from").val();
         var pickup_wednesday_to=$("#pickup_wednesday_to").val();
         var pickup_thursday_from=$("#pickup_thursday_from").val();
         var pickup_thursday_to=$("#pickup_thursday_to").val();
         var pickup_friday_from=$("#pickup_friday_from").val();
         var pickup_friday_to=$("#pickup_friday_to").val();
         var pickup_saturday_from=$("#pickup_saturday_from").val();
         var pickup_saturday_to=$("#pickup_saturday_to").val();
         var pickup_sunday_from=$("#pickup_sunday_from").val();
         var pickup_sunday_to=$("#pickup_saturday_to").val();
         var restro_id_pickup=$("#restro_id_pickup").val(); 
         var location_id=$("#location_id").val(); 
         $.ajax({

                method:"post",
                url:"/add_pickup_service/",
                data:{pickup_id:pickup_id,pordert_days:pordert_days,pordert_hour:pordert_hour,pordert_minitue:pordert_minitue,pordert_second:pordert_second,pickup_payment:pickup_payment,user_id_pickup:user_id_pickup,restro_id_pickup:restro_id_pickup,pickup_monday_from:pickup_monday_from,pickup_monday_to:pickup_monday_to,pickup_tuesday_from:pickup_tuesday_from,pickup_tuesday_to:pickup_tuesday_to,pickup_wednesday_from:pickup_wednesday_from,pickup_wednesday_to:pickup_wednesday_to,pickup_thursday_from:pickup_thursday_from,pickup_thursday_to:pickup_thursday_to,pickup_friday_from:pickup_friday_from,pickup_friday_to:pickup_friday_to,pickup_saturday_from:pickup_saturday_from,pickup_saturday_to:pickup_saturday_to,pickup_sunday_from:pickup_sunday_from,pickup_sunday_to:pickup_sunday_to,location_id:location_id},
                success:function(data)
                {

                      if(data)
                      {

                        $(".pickup_msg").text("Service setup successfully");

                        $('#myPickUp').modal('hide');


                        var chkData1 = $('#MyHiddenVal').val();
                        var kl1 = parseInt(chkData1) + 1;
                        $('#MyHiddenVal').val(kl1);

                        var a1 = $('#MyHiddenVal').val();
                        var a2 = $('#MyHiddenChked').val();

                        if(a1 == a2)
                        {
                            document.getElementById('savebtn').style.visibility = 'visible';
                        }
                        else
                        {
                            document.getElementById('savebtn').style.visibility = 'hidden';  
                        }
                       
                      }
 
                }

         });



  }
</script>




  <div id="myDelivery" class="modal fade" role="dialog" data-backdrop="static" > 
  <div class="modal-dialog  modal-lg">
  <div class="modal-content">
            <!-- Content Header (Page header) -->
            
            <!-- Main content -->
           
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                    <!--<a href="AddLocation.html" class="btn bg-gray-light2">< &nbsp;Back to Add Location</a>-->
                    <div class="clear_h10"></div>
                    <h4 class="border_bottom" style="width:100%;">Service Name - Delivery</h4>

                    <div class="delivery_msg"></div>

                    <input type="hidden" name="user_id" id="user_id_delivery" value="<?PHP echo isset($user_id)?$user_id:''; ?>">
                    <input type="hidden" name="restro_id" id="restro_id_delivery" value="<?PHP echo isset($restro_id)?$restro_id:''; ?>">
                    <input type="hidden" name="delivery_id" id="delivery_id" value="1">

                    <div class="table-responsive">
                    <table class="table bg-gray-light tbl" style="width:100%;">
                    <tr>
                        <td width="30%">MIN ORDER:</td>
                        <td><input type="text" name="delivery_min_order" id="delivery_min_order" placeholder="MIN ORDER" style="width:150px;"></td>
                    </tr>
                    <tr>
                        <td>ORDER TIME:</td>
                        <td><!--<input type="text" name="delivery_order_time" id="delivery_order_time">-->

                          <div class="col-md-2">
                              <select id="dordert_days">
                                  <?php
                                  for($i = 0; $i<=10; $i++)
                                  {
                                  ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?> Days</option>
                                  <?php
                                  }
                                  ?>
                                  
                              </select>
                          </div>
                          <div class="col-md-2">
                              <select id="dordert_hour">
                                  <?php
                                  for($i = 0; $i<=24; $i++)
                                  {
                                  ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?> Hour</option>
                                  <?php
                                  }
                                  ?>
                                  
                              </select>
                          </div>
                          <div class="col-md-2">
                              <select id="dordert_minitue">
                                  <?php
                                  for($i = 0; $i<=59; $i++)
                                  {
                                  ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?> Min.</option>
                                  <?php
                                  }
                                  ?>
                                  
                              </select>
                          </div>
                          <div class="col-md-3">
                              <!--<select id="dordert_second">
                                  <?php
                                  //for($i = 1; $i<=60; $i++)
                                  {
                                  ?>
                                    <option value="<?php //echo $i; ?>"><?php //echo $i; ?> Sec.</option>
                                  <?php
                                  }
                                  ?>
                                  
                              </select>-->
                          </div>
                        </td>
                    </tr>
                    <!--<tr>
                        <td>DELIVERY CHARGES PER ORDER</td>
                        <td><input id="delivery_delivery_charge" type="text"/></td>
                    </tr>-->
                    <tr>
                        <td colspan="2">
                            <table class="table bg-gray-light" width="100%">
                            <tr>
                                <td colspan="4">ADD PAYMENT OPTION</td>
                            </tr>
                            <tr>
                                <td><input id="delivery_payment" type="checkbox" name="delivery_payment" value="1"/> &nbsp;<img src="<?PHP echo base_url();  ?>assets/Administration/images/icon/cash.png" alt="" /> &nbsp;Cash</td>
                                <td><input id="delivery_payment" type="checkbox"  name="delivery_payment"  value="2"/> &nbsp;<img src="<?PHP echo base_url();  ?>assets/Administration/images/icon/knet.png" alt="" /> &nbsp;Knet</td>
                                <td><input id="delivery_payment" type="checkbox"  name="delivery_payment" value="3"/> &nbsp;<img src="<?PHP echo base_url();  ?>assets/Administration/images/icon/creditcard.png" alt="" /> &nbsp;Credit Card</td>
                                <td><input id="delivery_payment" type="checkbox"  name="delivery_payment" value="4"/> &nbsp;<img src="<?PHP echo base_url();  ?>assets/Administration/images/icon/paypal.png" alt="" /> &nbsp;Paypal</td>
                            </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <table class="table" width="100%">                      
                                  <tr>
                                      <td>ADD CITY</td><td>ADD AREA</td>
                                  </tr>
                                  <tr>
                                      <td>
                                          <select id="delivery_city" onchange='areashowbycity(2,this.value,"delivery_area");'>
                                            <option value=''>Select city</option>
                                              <?PHP
                                              foreach($city_list as $ks=>$vs)
                                              {
                                              
                                                echo "<option value='$vs->id,$vs->city_name'>$vs->city_name</option>";
                                              }

                                             
                                             ?>
                                            </select>
                                      </td>
                                      <td>
                                          <select id="delivery_area">

                                              <option value=''>Select Area</option>
                                              

                                          </select>
                                      </td>
                                      <td><input type="text" id="dprice" placeholder="Delivery Price" ></td>
                                      <td width="80">
                                     <button type='button'  onClick="create_delivery_city_area()" class="btn bg-gray-light2" ><span class="add_sign">+</span> Add</button>
                                      </td>
                                  </tr>
                            </table>
                          </td>
                    </tr>
                     <tr><td colspan="2" style="font-size:15px;">
                     <script>
                      function create_delivery_city_area()
                        {
                             var city_detail=$("#delivery_city").val();
                              
                                var value1=city_detail.split(",");
                            
                               var city_id=value1[0];
                               var city_name=value1[1];

                                  
                                   
                              var area_detail=$("#delivery_area").val();

                              var value=area_detail.split(",");
                              var area_id=value[0];

                              var area_name=value[1];

                              var price_detail=$("#dprice").val();

                             
                              var del_price = price_detail;

                              

                                if(city_id!="" && area_id!="")
                                 {
                                    if($("#delivery_section").find("#city"+city_id).text()!="")
                                    {
                                  
                                      $("<a  class='delivery_area' rel="+area_id+" id='delete"+area_id+"' onClick='delete_delivery_area(this.id)'>"+area_name+"&nbsp;(<span id='"+del_price+"' class='delivery_price'>"+del_price+"</span>)&nbsp;&nbsp;x</a>|").appendTo("#city"+city_id);
                                
                                    }
                                    else
                                    {
                                   
                                     $("#delivery_section").append("<div   id='city"+city_id+"'><b>City Name-"+city_name+"</b><span id='"+city_id+"' class='delivery_city'></span><div class='border-gray'></div><div class='clear_h10'></div></div>");
                                    
                                     $("<a  class='delivery_area' rel="+area_id+"  id='delete"+area_id+"' onClick='delete_delivery_area(this.id)'>"+area_name+"&nbsp;(<span id='"+del_price+"' class='delivery_price'>"+del_price+"</span>)&nbsp;&nbsp;x</a>|" ).appendTo("#city"+city_id);
                                     
                                   }
                            }
                           
                                     
                          
                        }
                       
                         function delete_delivery_area(v)
                         {
                              
                                $("#"+v).remove();

                         }

                     </script>

                      <div id="delivery_section">

                      </div>


                       </td>
                     </tr>

                      <style>
                              #delivery_section a{
                                cursor: pointer;
                              }
                              #delivery_section a{
                                  background: #c1c1c1 !important;
                                  color: #fff;
                                  font-size: 13px;
                                  font-weight: 600;
                                  border-radius: 100px;
                                  padding: 0px 5px 2px;
                                  margin-left: 10px;
                              }
                             #delivery_section a:hover, #delivery_section a:active, #delivery_section a:focus {
                                  outline: none;
                                  text-decoration: none;
                                  color: white;
                                  background: #7BC623 !important;

                              }
                      </style>

                    </table> 
                    </div>

                    <h4 class="border_bottom" style="width:100%;">Working Hours:</h4>
                    <div class="table-responsive">
                    <div style="width:80%; background:#f8f8f8;">                  
                    <table class="table bg-gray-light tbl" style="width:60%;">
                   
                    
                     
                   <tr><td></td><td>FROM</td><td>TO</td></tr>
                    <tr>
                        <td>Monday:</td>
                        <td><input type="text"  value="10:30 AM" id="delivery_monday_from"></td>
                        <td><input type="text"  value="10:00 PM"  id="delivery_monday_to" ></td>
                    </tr>
                    <tr><td>Tuesday:</td>
                        <td><input type="text" value="10:30 AM" id="delivery_tuesday_from" ></td>
                        <td><input type="text" value="10:00 PM" id="delivery_tuesday_to" ></td></tr>
                    <tr><td>Wednesday:</td>
                        <td><input type="text" value="10:30 AM" id="delivery_wednesday_from"  ></td>
                        <td><input type="text" value="10:00 PM" id="delivery_wednesday_to"  ></td></tr>
                    <tr><td>Thursday:</td>
                        <td><input type="text" value="10:30 AM" id="delivery_thursday_from"  ></td>
                        <td><input type="text" value="10:00 PM" id="delivery_thursday_to"   ></td></tr>
                    <tr><td>Friday:</td>
                        <td><input type="text" value="10:30 AM" id="delivery_friday_from"   ></td>
                        <td><input type="text" value="10:00 PM" id="delivery_friday_to"   ></td></tr>
                    <tr><td>Saturady:</td>
                        <td><input type="text" value="10:30 AM" id="delivery_saturday_from" ></td>
                        <td><input type="text" value="10:00 PM" id="delivery_saturday_to"   ></td></tr>
                    <tr><td>Sunday:</td>
                        <td><input type="text" value="10:30 AM"  id="delivery_sunday_from"  ></td>
                        <td><input type="text" value="10:00 PM" id="delivery_sunday_to"  ></td></tr>

                    
                    </table>
                    </div> 
                    </div>
                    <div class="clear_h20"></div>

                   
                   <a href="javascript:void(0)" onClick="add_delivery_service()" class="btn bg-green">SAVE</a>
                   <a href="#"  type="button" data-dismiss="modal" class="btn btn-danger">close</a>
                    </div>
                 </div>
            </section>

          </div><!-- /.content-wrapper -->
</div>
</div>


<script>

  function add_delivery_service()
  {
              
               var delivery_payment_method = new Array();
               $('input[id="delivery_payment"]:checked').each(function() {
              delivery_payment_method.push(this.value);

        });

           var delivery_area= new Array();
        $('.delivery_area').each(function() {
        delivery_area.push(this.rel) ;

        });
                



           var delivery_city= new Array();
        $('.delivery_city').each(function() {
        delivery_city.push(this.id) ;

        });
        

        var delivery_price = new Array();
        $('.delivery_price').each(function() {
        delivery_price.push(this.id) ;

        });


         var delivery_id=$("#delivery_id").val();
        // var delivery_order_time=$("#delivery_order_time").val();

         var dordert_days=$("#dordert_days").val();
         var dordert_hour=$("#dordert_hour").val();
         var dordert_minitue=$("#dordert_minitue").val();
         //var dordert_second=$("#dordert_second").val();
         var dordert_second= 0;



         var delivery_min_order=$("#delivery_min_order").val();
         var delivery_payment=delivery_payment_method;

         var delivery_city=delivery_city;
         var delivery_area=delivery_area;
         var delivery_price=delivery_price;


         var delivery_user_id=$("#restro_id_delivery").val();

         var delivery_delivery_charge=$("#delivery_delivery_charge").val();
         var delivery_restro_id=$("#user_id_delivery").val();
         var delivery_monday_from=$("#delivery_monday_from").val();
         var delivery_monday_to=$("#delivery_monday_to").val();
         var delivery_tuesday_from=$("#delivery_tuesday_from").val();
         var delivery_tuesday_to=$("#delivery_tuesday_to").val();
         var delivery_wednesday_from=$("#delivery_wednesday_from").val();
         var delivery_wednesday_to=$("#delivery_wednesday_to").val();
         var delivery_thursday_from=$("#delivery_thursday_from").val();
         var delivery_thursday_to=$("#delivery_thursday_to").val();
         var delivery_friday_from=$("#delivery_friday_from").val();
         var delivery_friday_to=$("#delivery_friday_to").val();
         var delivery_saturday_from=$("#delivery_saturday_from").val();
         var delivery_saturday_to=$("#delivery_saturday_to").val();
         var delivery_sunday_from=$("#delivery_sunday_from").val();
         var delivery_sunday_to=$("#delivery_sunday_to").val();
         var location_id=$("#location_id").val(); 

         $.ajax({

                method:"post",
                url:"/add_delivery_service/",
                data:{delivery_id:delivery_id,dordert_days:dordert_days,dordert_hour:dordert_hour,dordert_minitue:dordert_minitue,dordert_second:dordert_second,delivery_min_order:delivery_min_order,delivery_delivery_charge:delivery_delivery_charge,delivery_city:delivery_city,delivery_area:delivery_area,delivery_user_id:delivery_user_id,delivery_restro_id:delivery_restro_id,delivery_payment:delivery_payment, delivery_monday_from:delivery_monday_from,delivery_monday_to:delivery_monday_to,delivery_tuesday_from:delivery_tuesday_from,delivery_tuesday_to:delivery_tuesday_to,delivery_wednesday_from:delivery_wednesday_from,delivery_wednesday_to:delivery_wednesday_to,delivery_thursday_from:delivery_thursday_from,delivery_thursday_to:delivery_thursday_to,delivery_friday_from:delivery_friday_from,delivery_friday_to:delivery_friday_to,delivery_saturday_from:delivery_saturday_from,delivery_saturday_to:delivery_saturday_to,delivery_sunday_from:delivery_sunday_from,delivery_sunday_to:delivery_sunday_to,location_id:location_id,delivery_price:delivery_price},
                success:function(data)
                {
                    if(data)
                    {
                            $(".delivery_msg").text("Added successfully");

                            $('#myDelivery').modal('hide');

                        var chkData1 = $('#MyHiddenVal').val();
                        var kl1 = parseInt(chkData1) + 1;
                        $('#MyHiddenVal').val(kl1);

                        var a1 = $('#MyHiddenVal').val();
                        var a2 = $('#MyHiddenChked').val();

                        if(a1 == a2)
                        {
                            document.getElementById('savebtn').style.visibility = 'visible';
                        }
                        else
                        {
                            document.getElementById('savebtn').style.visibility = 'hidden';  
                        }

                    }
 
                }

         });



  }
</script>



<!-- Reservation-->
<div id="myReservation" class="modal fade" role="dialog" data-backdrop="static" >
<div class="modal-dialog  modal-lg">
<div class="modal-content">
            <!-- Content Header (Page header) -->
            
            <!-- Main content -->
           
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                    <!--<a href="AddLocation.html" class="btn bg-gray-light2">< &nbsp;Back to Add Location</a>-->
                    <div class="clear_h10"></div>
                    <h4 class="border_bottom" style="width:100%;">Service Setup - RESERVATION</h4>  
                    <div class="reservation_msg"></div>                 
                    <div class="clear_h20"></div> 
        <input type="hidden" name="user_id" id="user_id_reservation" value="<?PHP echo isset($user_id)?$user_id:''; ?>">
        <input type="hidden" name="restro_id" id="restro_id_reservation" value="<?PHP echo isset($restro_id)?$restro_id:''; ?>">
                     <input type="hidden" name="reservation_id" id="reservation_id" value="3">


                     <div class="clear_h10"></div>
                     <h4 class="border_bottom">Happy Hours:</h4>
                    <div class="table-responsive">
                    <div style="width:80%; background:#f8f8f8;">                  
                    <table class="table bg-gray-light tbl" style="width:60%;">
                   
                    <tbody><tr>

                        <td>From </td>
                        <td><input type="text" id="res_happy_from" name="happy_from"  value=""> </td>
                        <td>to </td>
                        <td><input type="text" id="res_happy_to" name="happy_to"  value=""> </td>
                    </tr>
                    </tbody>
                    </table>


                    <h4 class="border_bottom" style="width:100%;">Working Hours:</h4>
                    <div class="table-responsive">
                    <div style="width:80%; background:#f8f8f8;">                  
                    <table class="table bg-gray-light tbl" style="width:60%;">
                   
                    <tr><td></td><td>FROM</td><td>TO</td></tr>
                    <tr>
                        <td>Monday:</td>
                        <td><input type="text" value="10:30 AM" id="reservation_monday_from"></td>
                        <td><input type="text" value="10:00 PM" id="reservation_monday_to" ></td>
                    </tr>
                    <tr>
                        <td>Tuesday:</td>
                        <td><input type="text" value="10:30 AM" id="reservation_tuesday_from" ></td>
                        <td><input type="text" value="10:00 PM" id="reservation_tuesday_to" ></td></tr>
                    <tr><td>Wednesday:</td>
                        <td><input type="text" value="10:30 AM"  id="reservation_wednesday_from"  ></td>
                        <td><input type="text" value="10:00 PM" id="reservation_wednesday_to"  ></td></tr>
                    <tr><td>Thursday:</td>
                        <td><input type="text" value="10:30 AM" id="reservation_thursday_from"  ></td>
                        <td><input type="text" value="10:00 PM" id="reservation_thursday_to"   ></td></tr>
                    <tr><td>Friday:</td>
                        <td><input type="text" value="10:30 AM" id="reservation_friday_from"   ></td>
                        <td><input type="text" value="10:00 PM" id="reservation_friday_to"   ></td></tr>
                    <tr><td>Saturady:</td>
                        <td><input type="text" value="10:30 AM" id="reservation_saturday_from" ></td>
                        <td><input type="text" value="10:00 PM" id="reservation_saturday_to"   ></td>
                    </tr>
                    <tr><td>Sunday:</td>
                        <td><input type="text" value="10:30 AM" id="reservation_sunday_from" ></td>
                        <td><input type="text" value="10:00 PM" id="reservation_sunday_to" ></td>
                    </tr>
                    
                    </table>
                    </div> 
                    </div>
                    <div class="clear_h20"></div>

                   
                   <a href="javascript:void(0)" onClick="add_reservation_services()" class="btn bg-green">SAVE</a>
                   <a herf="#" type="button" data-dismiss="modal" class="btn btn-danger"> Close</a>
                    </div>
                 </div>
            </section>

          </div><!-- /.content-wrapper -->
</div>
</div>


<script>

  function add_reservation_services()
  {
         var reservation_id=$("#reservation_id").val();
         var reservation_user_id=$("#user_id_reservation").val();
         var reservation_restro_id=$("#restro_id_reservation").val();

         var reservation_monday_from=$("#reservation_monday_from").val();
         var reservation_monday_to=$("#reservation_monday_to").val();
         var reservation_tuesday_from=$("#reservation_tuesday_from").val();
         var reservation_tuesday_to=$("#reservation_tuesday_to").val();
         var reservation_wednesday_from=$("#reservation_wednesday_from").val();
         var reservation_wednesday_to=$("#reservation_wednesday_to").val();
         var reservation_thursday_from=$("#reservation_thursday_from").val();
         var reservation_thursday_to=$("#reservation_thursday_to").val();
         var reservation_friday_from=$("#reservation_friday_from").val();
         var reservation_friday_to=$("#reservation_friday_to").val();
         var reservation_saturday_from=$("#reservation_saturday_from").val();
         var reservation_saturday_to=$("#reservation_saturday_to").val();
         var reservation_sunday_from=$("#reservation_sunday_from").val();
         var reservation_sunday_to=$("#reservation_sunday_to").val();
         var location_id=$("#location_id").val();
         var happy_from=$("#res_happy_from").val();
         var happy_to=$("#res_happy_to").val();

         $.ajax({

                method:"post",
                url:"/add_reservation_service/",
                data:{reservation_id:reservation_id,reservation_restro_id:reservation_restro_id,reservation_user_id:reservation_user_id, reservation_monday_from:reservation_monday_from,reservation_monday_to:reservation_monday_to,reservation_tuesday_from:reservation_tuesday_from,reservation_tuesday_to:reservation_tuesday_to,reservation_wednesday_from:reservation_wednesday_from,reservation_wednesday_to:reservation_wednesday_to,reservation_thursday_from:reservation_thursday_from,reservation_thursday_to:reservation_thursday_to,reservation_friday_from:reservation_friday_from,reservation_friday_to:reservation_friday_to,reservation_saturday_from:reservation_saturday_from,reservation_saturday_to:reservation_saturday_to,reservation_sunday_from:reservation_sunday_from,reservation_sunday_to:reservation_sunday_to,location_id:location_id,happy_from:happy_from,happy_to:happy_to},
                success:function(data)
                {
                    if(data)
                    {
                          
                          $(".reservation_msg").text("added successfully");

                          $('#myReservation').modal('hide');

                        var chkData1 = $('#MyHiddenVal').val();
                        var kl1 = parseInt(chkData1) + 1;
                        $('#MyHiddenVal').val(kl1);

                        var a1 = $('#MyHiddenVal').val();
                        var a2 = $('#MyHiddenChked').val();

                        if(a1 == a2)
                        {
                            document.getElementById('savebtn').style.visibility = 'visible';
                        }
                        else
                        {
                            document.getElementById('savebtn').style.visibility = 'hidden';  
                        }

                    }
 
                }

         });



  }
</script>
<!--catering form-->
<div id="myCatering" class="modal fade" role="dialog" data-backdrop="static" >
<div class="modal-dialog  modal-lg">
<div class="modal-content">
            <!-- Content Header (Page header) -->           
            <!-- Main content -->
           
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                    <!--<a href="AddLocation.html" class="btn bg-gray-light2"><&nbsp;Back to Add Location</a>-->
                    <div class="clear_h10"></div>
                    <h4 class="border_bottom" style="width:100%;">Service Setup - Catering</h4> 
                    <div class='catering_msg'></div>
                       <input type="hidden" name="user_id" id="user_id_catering" value="<?PHP echo isset($user_id)?$user_id:''; ?>">
                    <input type="hidden" name="restro_id" id="restro_id_catering" value="<?PHP echo isset($restro_id)?$restro_id:''; ?>">
        
                      <input type="hidden" name="catering_id" id="catering_id" value="2">

                    <div class="table-responsive">
                    <table class="table bg-gray-light tbl" style="width:100%;">
                    <tr><td width="30%">MIN ORDER:</td>
                        <td><input type="text" name="catering_min_order" id="catering_min_order" placeholder="MIN ORDER" style="width:150px;">
                            </td></tr>
                    <tr><td>ORDER TIME:</td>
                        <td>
                            <!--<input type="text" name="catering_order_time" id="catering_order_time">-->

                          <div class="col-md-2">
                              <select id="cordert_days">
                                  <?php
                                  for($i = 0; $i<=10; $i++)
                                  {
                                  ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?> Days</option>
                                  <?php
                                  }
                                  ?>
                                  
                              </select>
                          </div>
                          <div class="col-md-2">
                              <select id="cordert_hour">
                                  <?php
                                  for($i = 0; $i<=24; $i++)
                                  {
                                  ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?> Hour</option>
                                  <?php
                                  }
                                  ?>
                                  
                              </select>
                          </div>
                          <div class="col-md-2">
                              <select id="cordert_minitue">
                                  <?php
                                  for($i = 0; $i<=59; $i++)
                                  {
                                  ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?> Min.</option>
                                  <?php
                                  }
                                  ?>
                                  
                              </select>
                          </div>
                          <div class="col-md-3">
                              <!--<select id="cordert_second">
                                  <?php
                                  //for($i = 1; $i<=60; $i++)
                                  {
                                  ?>
                                    <option value="<?php //echo $i; ?>"><?php //echo $i; ?> Sec.</option>
                                  <?php
                                  }
                                  ?>
                                  
                              </select>-->
                          </div>
                        </td></tr>
                    <!--<tr><td>DELIVERY CHARGES PER ORDER</td>
                        <td><input id="catering_delivery_charge" type="text"/></td></tr>-->
                     <tr><td colspan="2">
                     <table class="table bg-gray-light" width="100%">
                      <tr><td colspan="4">ADD PAYMENT OPTION</td></tr>
                       <tr><td><input id="catering_payment" type="checkbox"  name="catering_payment" value="1"/> &nbsp;<img src="<?PHP echo base_url();  ?>assets/Administration/images/icon/cash.png" alt="" /> &nbsp;Cash</td>
                         <td><input   id="catering_payment" type="checkbox"  name="catering_payment"  value="2"/> &nbsp;<img src="<?PHP echo base_url();  ?>assets/Administration/images/icon/knet.png" alt="" /> &nbsp;Knet</td>
                         <td><input   id="catering_payment" type="checkbox"  name="catering_payment" value="3"/> &nbsp;<img src="<?PHP echo base_url();  ?>assets/Administration/images/icon/creditcard.png" alt="" /> &nbsp;Credit Card</td>
                         <td><input   id="catering_payment" type="checkbox"  name="catering_payment" value="4"/> &nbsp;<img src="<?PHP echo base_url();  ?>assets/Administration/images/icon/paypal.png" alt="" /> &nbsp;Paypal</td>
                     </tr>
                     </table>
                     </td></tr>
                     <tr><td colspan="2">
                     <table class="table" width="100%">                      
                     <tr><td>ADD CITY</td><td>ADD AREA</td></tr>
                     <tr><td> <select id="catering_city"  onchange='areashowbycity(2,this.value,"catering_area");'>
                                            <option value=''>Select city</option>
                                              <?PHP
                                              foreach($city_list as $ks=>$vs)
                                              {
                                              
                                                echo "<option value='$vs->id,$vs->city_name'>$vs->city_name</option>";
                                              }

                                             
                                             ?>
                                            </select>

                                          </td>
                                       <td> <select id="catering_area" >
                                            <option value=''>Select area</option>
                                            
                                            </select>
                                            </td>
                                            <td><input type="text" id="cprice" placeholder="Delivery Price" ></td>
                         <td width="80"><button type='button'  onClick="create_catering_city_area()" class="btn bg-gray-light2" ><span class="add_sign">+</span> Add</button></td></tr>
                     </table>
                     </td></tr>
                     <tr>

                      <td colspan="2" style="font-size:15px;">
                     
                      <script>
                      function create_catering_city_area()
                        {
                             var city_detail=$("#catering_city").val();
                              
                                var value1=city_detail.split(",");
                            
                               var city_id=value1[0];
                               var city_name=value1[1];

                              

                              var area_detail=$("#catering_area").val();

                              var value=area_detail.split(",");
                              var area_id=value[0];

                              var area_name=value[1];

                              
                              var price_detail=$("#cprice").val();

                             
                              var cat_price = price_detail;
                              

                                if(city_id!="" && area_id!="")
                                 {
                                    if($("#catering_section").find(".city"+city_id).text()!="")
                                    {
                                  
                                      $("<a  class='catering_area'   rel="+area_id+" id='delete"+area_id+"'  onClick='delete_catering_area(this.id)'>"+area_name+"&nbsp;(<span id='"+cat_price+"' class='catering_price'>"+cat_price+"</span>)&nbsp;&nbsp;x</a>|" ).appendTo(".city"+city_id);
                                    }
                                    else
                                    {
                                   
                                     $("#catering_section").append("<div  class='city"+city_id+"'><b>City Name-"+city_name+"</b><span id='"+city_id+"' class='catering_city'></span><div class='border-gray'></div><div class='clear_h10'></div></div>");
                                    
                                     $("<a  class='catering_area'   rel="+area_id+" id='delete"+area_id+"'  onClick='delete_catering_area(this.id)'>"+area_name+"&nbsp;(<span id='"+cat_price+"' class='catering_price'>"+cat_price+"</span>)&nbsp;&nbsp;x</a>|" ).appendTo(".city"+city_id);
                                     
                                   }
                            }
                           
                                     
                          
                        }
                       
                         function delete_catering_area(v)
                         {
                               

                                $("#"+v).remove();

                         }

                     </script>

                      <div id="catering_section">

                      </div>


                       </td>
                     </tr>

                      <style>
                              #catering_section a{
                                cursor: pointer;
                              }
                              #catering_section a{
                                  background: #c1c1c1 !important;
                                  color: #fff;
                                  font-size: 13px;
                                  font-weight: 600;
                                  border-radius: 100px;
                                  padding: 0px 5px 2px;
                                  margin-left: 10px;
                              }
                             #catering_section a:hover, #catering_section a:active, #catering_section a:focus {
                                  outline: none;
                                  text-decoration: none;
                                  color: white;
                                  background: #7BC623 !important;

                              }
                      </style>

                    </table> 
                    </div>

                    <h4 class="border_bottom" style="width:100%;">Working Hours:</h4>
                    <div class="table-responsive">
                    <div style="width:80%; background:#f8f8f8;">                  
                    <table class="table bg-gray-light tbl" style="width:60%;">
                   
                     <tr><td></td><td>FROM</td><td>TO</td></tr>
                    <tr><td>Monday:</td>
                        <td><input type="text" value="10:30 AM" id="catering_monday_from"></td>
                        <td><input type="text" value="10:00 PM" id="catering_monday_to" value="10:00 AM" ></td>
                    </tr>
                    <tr><td>Tuesday:</td>
                        <td><input type="text" value="10:30 AM" id="catering_tuesday_from" ></td>
                        <td><input type="text" value="10:00 PM" id="catering_tuesday_to" ></td></tr>
                    <tr><td>Wednesday:</td>
                        <td><input type="text" value="10:30 AM" id="catering_wednesday_from"></td>
                        <td><input type="text" value="10:00 PM" id="catering_wednesday_to"></td>
                    </tr>
                    <tr><td>Thursday:</td>
                        <td><input type="text" value="10:30 AM" id="catering_thursday_from"  ></td>
                        <td><input type="text" value="10:00 PM" id="catering_thursday_to"   ></td>
                    </tr>
                    <tr><td>Friday:</td>
                        <td><input type="text" value="10:30 AM" id="catering_friday_from"   ></td>
                        <td><input type="text" value="10:00 PM" id="catering_friday_to"   ></td>
                    </tr>
                    <tr><td>Saturady:</td>
                        <td><input type="text" value="10:30 AM" id="catering_saturday_from" ></td>
                        <td><input type="text" value="10:00 PM" id="catering_saturday_to"   ></td>
                    </tr>
                    <tr><td>Sunday:</td>
                        <td><input type="text" value="10:30 AM" id="catering_sunday_from"  ></td>
                        <td><input type="text" value="10:00 PM" id="catering_sunday_to"  ></td>
                    </tr>
                    
                    </table>
                    </div> 
                    </div>
                    <div class="clear_h20"></div>

                   
                   <a href="javascript:void(0)" onClick="add_catering_services()" class="btn bg-green">SAVE</a>
                   <a href="#" type="button" data-dismiss="modal" class="btn btn-danger">Close</a>
                    </div>
                 </div>
            </section>

          </div><!-- /.content-wrapper -->
</div>
</div>


<input type="hidden" id="MyHiddenChked" value="0">
<input type="hidden" id="MyHiddenVal" value="0">
</form>

<script>
  function add_catering_services()
  {
    

               var catering_payment_method = new Array();
               $('input[id="catering_payment"]:checked').each(function() {
              catering_payment_method.push(this.value);

        });

           var catering_area= new Array();
        $('.catering_area').each(function() 
        {
          catering_area.push(this.rel);
        });
                
           

           var catering_city= new Array();
        $('.catering_city').each(function() {
        catering_city.push(this.id) ;

        });

        var catering_price = new Array();
        $('.catering_price').each(function() {
        catering_price.push(this.id) ;

        });


         var catering_id=$("#catering_id").val();
         //var catering_order_time=$("#catering_order_time").val();

         var cordert_days=$("#cordert_days").val();
         var cordert_hour=$("#cordert_hour").val();
         var cordert_minitue=$("#cordert_minitue").val();
         //var cordert_second=$("#cordert_second").val();
         var cordert_second= 0;


         var catering_min_order=$("#catering_min_order").val();
         var catering_delivery_charge=$("#catering_delivery_charge").val();
         
         var catering_payment=catering_payment_method;

         var catering_city=catering_city;
         var catering_area=catering_area;
         var catering_price=catering_price;
         
         var catering_user_id=$("#user_id_catering").val();
         var catering_restro_id=$("#restro_id_catering").val();

         var catering_monday_from=$("#catering_monday_from").val();
         var catering_monday_to=$("#catering_monday_to").val();
         var catering_tuesday_from=$("#catering_tuesday_from").val();
         var catering_tuesday_to=$("#catering_tuesday_to").val();
         var catering_wednesday_from=$("#catering_wednesday_from").val();
         var catering_wednesday_to=$("#catering_wednesday_to").val();
         var catering_thursday_from=$("#catering_thursday_from").val();
         var catering_thursday_to=$("#catering_thursday_to").val();
         var catering_friday_from=$("#catering_friday_from").val();
         var catering_friday_to=$("#catering_friday_to").val();
         var catering_saturday_from=$("#catering_saturday_from").val();
         var catering_saturday_to=$("#catering_saturday_to").val();
         var catering_sunday_from=$("#catering_sunday_from").val();
         var catering_sunday_to=$("#catering_sunday_to").val();
         var location_id=$("#location_id").val();
         $.ajax({

                method:"post",
                url:'/add_catering_services/',
                data:{catering_id:catering_id,cordert_days:cordert_days,cordert_hour:cordert_hour,cordert_minitue:cordert_minitue,cordert_second:cordert_second,catering_delivery_charge:catering_delivery_charge,catering_min_order:catering_min_order,catering_user_id:catering_user_id,catering_restro_id:catering_restro_id,catering_payment:catering_payment, catering_city: catering_city, catering_area: catering_area, catering_monday_from:catering_monday_from,catering_monday_to:catering_monday_to,catering_tuesday_from:catering_tuesday_from,catering_tuesday_to:catering_tuesday_to,catering_wednesday_from:catering_wednesday_from,catering_wednesday_to:catering_wednesday_to,catering_thursday_from:catering_thursday_from,catering_thursday_to:catering_thursday_to,catering_friday_from:catering_friday_from,catering_friday_to:catering_friday_to,catering_saturday_from:catering_saturday_from,catering_saturday_to:catering_saturday_to,catering_sunday_from:catering_sunday_from,catering_sunday_to:catering_sunday_to,location_id:location_id,catering_price:catering_price},
                success:function(data)
                {
                  
                    if(data)
                    {

                        $(".catering_msg").text("Service added successfully");

                        $('#myCatering').modal('hide');

                        var chkData1 = $('#MyHiddenVal').val();
                        var kl1 = parseInt(chkData1) + 1;
                        $('#MyHiddenVal').val(kl1);

                        var a1 = $('#MyHiddenVal').val();
                        var a2 = $('#MyHiddenChked').val();

                        if(a1 == a2)
                        {
                            document.getElementById('savebtn').style.visibility = 'visible';
                        }
                        else
                        {
                            document.getElementById('savebtn').style.visibility = 'hidden';  
                        }

                    }

 
                }

         });



  }
</script>

<script>
    function areashowbycity(type,dataval,divid){

      if(type == 1)
      {
          var mycity_id = dataval;
      }
      else
      {
          var value=dataval.split(",");
          var mycity_id=value[0];

          

      }
        $.ajax({

                method:"post",
                url:'/ajax_area_get_by_city/',
                data:{city_id:mycity_id,type:type},
                success:function(data)
                {
                 
                    if(data)
                    {

                        $("#"+divid).html(data);

                    }

 
                }

         });
    }
</script>



<script>
  $("#Radio3").click(function()
  {
    $("#pickup_font").toggleClass("ft");
    $("#cat_pickup_color").toggleClass("bg-gray-light2");
    

  });
  $("#Radio6").click(function()
  {
    $("#delivery_font").toggleClass("ft");
    $("#cat_delivery_color").toggleClass("bg-gray-light2");
    

  });
  $("#Radio9").click(function()
  {
    $("#reservation_font").toggleClass("ft");

  });
  $("#Radio12").click(function()
  {
    $("#catering_font").toggleClass("ft");
    $("#cat_catering_color").toggleClass("bg-gray-light2");
    

  });
  
</script>
<style>
  .ft
  {
    font-weight: bold;
  }

</style>
<script>
$('.MyPickupLink').bind('click', false);
 $('#Radio3').click(function() 
 {
    if($(this).is(":checked"))
    {
       $("img#im_pickup").attr("src","/assets/Administration/images/icon/setup_blue.png");  
       
        $('.MyPickupLink').attr('disabled', false);
         $('.MyPickupLink').unbind('click', false);

        //$('.MyPickupLink').click(function() { return true; });
     
        var chkData = $('#MyHiddenChked').val();
        
        var kl = parseInt(chkData) + 1;
        $('#MyHiddenChked').val(kl);   
        
    }
    else
    {
        $("img#im_pickup").attr("src","/assets/Administration/images/icon/setup_gray.png");
        
        //$('.MyPickupLink').click(function() { return false; });
        $('.MyPickupLink').bind('click', false);

        $('.MyPickupLink').attr('disabled', true); 
        
        var chkData = $('#MyHiddenChked').val();
        var kl = parseInt(chkData) - 1;
        $('#MyHiddenChked').val(kl); 

    }
       
});

$('.MyDeliveryLink').bind('click', false);
 $('#Radio6').click(function() 
 {
    if($(this).is(":checked"))
    {
       $("img#im_delivery").attr("src","/assets/Administration/images/icon/setup_blue.png");
       
        $('.MyDeliveryLink').attr('disabled', false);
        $('.MyDeliveryLink').unbind('click', false);

        var chkData = $('#MyHiddenChked').val();
        var kl = parseInt(chkData) + 1;
        $('#MyHiddenChked').val(kl);  
       
    }
    else
    {
        $("img#im_delivery").attr("src","/assets/Administration/images/icon/setup_gray.png");   
        //$('.MyDeliveryLink').click(function() { return false; });
        $('.MyDeliveryLink').attr('disabled', true);
        $('.MyDeliveryLink').bind('click', false);

        var chkData = $('#MyHiddenChked').val();
        var kl = parseInt(chkData) - 1;
        $('#MyHiddenChked').val(kl);
    }
       
});

$('.MyReservationLink').bind('click', false);
 $('#Radio9').click(function() 
 {
    if($(this).is(":checked"))
    {
       $("img#im_reservation").attr("src","/assets/Administration/images/icon/setup_blue.png"); 
       
        $('.MyReservationLink').attr('disabled', false); 
        $('.MyReservationLink').unbind('click', false);
        var chkData = $('#MyHiddenChked').val();
        var kl = parseInt(chkData) + 1;
        $('#MyHiddenChked').val(kl);
        
    }
    else
    {
        $("img#im_reservation").attr("src","/assets/Administration/images/icon/setup_gray.png");  
        
        $('.MyReservationLink').attr('disabled', true); 
        $('.MyReservationLink').bind('click', false);
        var chkData = $('#MyHiddenChked').val();
        var kl = parseInt(chkData) - 1;
        $('#MyHiddenChked').val(kl);
       
    }
       
});

$('.MyCateringLink').bind('click', false);
 $('#Radio12').click(function() 
 {
    if($(this).is(":checked"))
    {
       $("img#im_catering").attr("src","/assets/Administration/images/icon/setup_blue.png"); 
       
        $('.MyCateringLink').attr('disabled', false);  
        $('.MyCateringLink').unbind('click', false);
        var chkData = $('#MyHiddenChked').val();
        var kl = parseInt(chkData) + 1;
        $('#MyHiddenChked').val(kl);
        
    }
    else
    {
        $("img#im_catering").attr("src","/assets/Administration/images/icon/setup_gray.png"); 
        
        $('.MyCateringLink').attr('disabled', true);
        $('.MyCateringLink').bind('click', false);
        var chkData = $('#MyHiddenChked').val();
        var kl = parseInt(chkData) - 1;
        $('#MyHiddenChked').val(kl);  
    }
       
});

         
</script>

<script>
    $(function() {
        $('#pickup_monday_from').timepicker();
        $('#pickup_monday_to').timepicker();
        $('#pickup_tuesday_from').timepicker();
        $('#pickup_tuesday_to').timepicker();
        $('#pickup_wednesday_from').timepicker();
        $('#pickup_wednesday_to').timepicker();
        $('#pickup_thursday_from').timepicker();
        $('#pickup_thursday_to').timepicker();
        $('#pickup_friday_from').timepicker();
        $('#pickup_friday_to').timepicker();
        $('#pickup_saturday_from').timepicker();
        $('#pickup_saturday_to').timepicker();
        $('#pickup_sunday_from').timepicker();
        $('#pickup_sunday_to').timepicker();

        $('#delivery_monday_from').timepicker();
        $('#delivery_monday_to').timepicker();
        $('#delivery_tuesday_from').timepicker();
        $('#delivery_tuesday_to').timepicker();
        $('#delivery_wednesday_from').timepicker();
        $('#delivery_wednesday_to').timepicker();
        $('#delivery_thursday_from').timepicker();
        $('#delivery_thursday_to').timepicker();
        $('#delivery_friday_from').timepicker();
        $('#delivery_friday_to').timepicker();
        $('#delivery_saturday_from').timepicker();
        $('#delivery_saturday_to').timepicker();
        $('#delivery_sunday_from').timepicker();
        $('#delivery_sunday_to').timepicker();

        $('#reservation_monday_from').timepicker();
        $('#reservation_monday_to').timepicker();
        $('#reservation_tuesday_from').timepicker();
        $('#reservation_tuesday_to').timepicker();
        $('#reservation_wednesday_from').timepicker();
        $('#reservation_wednesday_to').timepicker();
        $('#reservation_thursday_from').timepicker();
        $('#reservation_thursday_to').timepicker();
        $('#reservation_friday_from').timepicker();
        $('#reservation_friday_to').timepicker();
        $('#reservation_saturday_from').timepicker();
        $('#reservation_saturday_to').timepicker();
        $('#reservation_sunday_from').timepicker();
        $('#reservation_sunday_to').timepicker();

        $('#catering_monday_from').timepicker();
        $('#catering_monday_to').timepicker();
        $('#catering_tuesday_from').timepicker();
        $('#catering_tuesday_to').timepicker();
        $('#catering_wednesday_from').timepicker();
        $('#catering_wednesday_to').timepicker();
        $('#catering_thursday_from').timepicker();
        $('#catering_thursday_to').timepicker();
        $('#catering_friday_from').timepicker();
        $('#catering_friday_to').timepicker();
        $('#catering_saturday_from').timepicker();
        $('#catering_saturday_to').timepicker();
        $('#catering_sunday_from').timepicker();
        $('#catering_sunday_to').timepicker();

        $('#res_happy_from').timepicker();
        $('#res_happy_to').timepicker();

    });
</script>

<script>
    function comFun1(str,divVal)
    {
      
        if(str != '')
        {
            $("#"+divVal).attr('disabled','disable');
        }
        else
        {
            $("#"+divVal).removeAttr('disabled','disable');
        }

    }

    
</script>

<script>

  $('.MyPickupLink').attr('disabled', true);  

  $('.MyDeliveryLink').attr('disabled', true);

  $('.MyCateringLink').attr('disabled', true); 

  $('.MyReservationLink').attr('disabled', true);    
</script>




