<?PHP
  $this->load->view("includes/Restaurant_Owner/header"); 
  $this->load->view("includes/Restaurant_Owner/sidebar");
  ?>

<!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            
            <!-- Main content -->
           
	  <form action="" method="post">
            <section class="content">
                <div class="row">
                    
                    <div class="col-md-12">
                   <a href="/restro_show_promotion" class="btn bg-gray-light2">&lt; &nbsp;Back to promotions list</a>
                    <h4 class="border_bottom">Promotion</h4>                   

                    <div class="table-responsive">
                    <table class="table bg-gray-light tbl" style="width:80%;" id="searchdatatbl">
		   
                    
<tr>
            <td width="20%">LOCATION:</td>
                        <td><select name="pro_location" onchange="getService(this.value)" id="location_id">
                        <option>Location Name</option>
            <?php
            foreach($location as $lo=>$loc):
            ?>
            <option value="<?php echo $loc->id; ?>"><?php echo $loc->location_name; ?></option>
            <?php
            $owner_id = $loc->user_id;
            endforeach;
            ?>
            </select>
            <input type="hidden" value="<?php echo $owner_id; ?>" name="owner_id" >
            </td>
            </tr>
                    <tr><td>SERVICE:</td>
                        <td><select name="pro_service" id="service_id"  onchange="filteringData(this.value);">
                        <option value="0">Service Name</option>
            
            </select>
            
            </td></tr>
            
            
        <tr>
        <td colspan="2">
        <div class="table-responsive">
                    <table class="table bg-gray-light tbl" style="width:80%;">
                    <tr><td width="20%">Promotion Name:</td>
                        <td colspan="4"><input id="Text1" type="text" name="pro_name"/></td></tr>
                    <tr><td>Description:</td>
                        <td colspan="4"><textarea id="TextArea1" rows="2" cols="20" name="pro_description"></textarea></td></tr>
                    <tr>
            <td colspan="2">
                <table id="showMoreItem" class="table" style="width:100%;">
                    <tr>
                    <td>ITEM-1</td>
                    <td colspan="2">
                    <select id="itemdata1" name="pro_item_id[]" onchange="variationshow(this.value,'ajaxvar1');">
                    <option value="0">Select Item</option>
                    </select></td></tr>
                    <tr >
                        <td colspan="3" id="ajaxvar1">
                            
                        </td>
                    </tr>
                    
                    
                     <tr>
                    <td>ITEM-2</td>
                    <td colspan="2">
                    <select id="itemdata2" name="pro_item_id[]" onchange="variationshow(this.value,'ajaxvar2');">
                    <option value="0">Select Item</option>
                    </select></td></tr>
                    <tr >
                        <td colspan="3" id="ajaxvar2">
                            
                        </td>
                    </tr>
                    
                    
                    
                    <tr>
                    <td>ITEM-3</td>
                    <td colspan="2">
                    <select id="itemdata3" name="pro_item_id[]" onchange="variationshow(this.value,'ajaxvar3');">
                    <option value="0">Select Item</option>
                    </select></td></tr>
                    <tr >
                        <td colspan="3" id="ajaxvar3">
                            
                        </td>
                    </tr>
                    
                    
                    
                    <tr>
                    <td>ITEM-4</td>
                    <td colspan="2">
                    <select id="itemdata4" name="pro_item_id[]" onchange="variationshow(this.value,'ajaxvar4');">
                    <option value="0">Select Item</option>
                    </select></td></tr>
                    <tr >
                        <td colspan="3" id="ajaxvar4">
                            
                        </td>
                    </tr>
                    
                    
                    
                        <tr>
                    <td>ITEM-5</td>
                    <td colspan="2">
                    <select id="itemdata5" name="pro_item_id[]" onchange="variationshow(this.value,'ajaxvar5');">
                    <option value="0">Select Item</option>
                    </select></td></tr>
                    <tr >
                        <td colspan="3" id="ajaxvar5">
                            
                        </td>
                    </tr>
                    
                </table>
            </td>
            </tr>
                    
                    <!--<tr><td></td><td><button class="btn bg-gray-light2" onclick="variationMore();"><span class="add_sign">+</span> Add Item</button></td></tr>-->
                    
                    </table> 
                 </div>
         </td>
         </tr>

            
            

    
                    </table> 
                    </div>

                    

                    <div class="table-responsive">
                    <table class="table bg-gray-light tbl" style="width:80%;">
                    <tr><td width="15%">Total Price:</td>
                        <td colspan="3"><input id="Text11" type="text" value="" style="width:50%;" name="pro_price"/></td></tr>
                    <tr><td width="15%">From:</td>
                        <td><input id="datepicker" type="text" name="from_date" placeholder="YYYY-MM-DD"></td>
                        <td width="10%">To:</td>
                        <td><input id="datepicker1" type="text" name="to_date" placeholder="YYYY-MM-DD"> </td></tr>
                    <tr><td><button class="btn btn-success">SAVE</button></td></tr>
                    </table>
                    </div>
                    </div>
                     <input type="hidden" value="<?php echo $this->tank_auth->get_user_id(); ?>" name="owner_id" id="owner_id">
                 </div>
            </section>
</form>
          </div><!-- /.content-wrapper -->
          
  </div>

</div>


  
  
<script type="text/javascript" language="javascript">

    function hide(visibility) {
        var opanel = document.getElementById("Panel1");

        if (visibility.indexOf("hide") > -1) {
            opanel.style.visibility = 'hidden';
            opanel.style.height = '0';
        }
        else {
            opanel.style.visibility = 'visible';
            opanel.style.height = 'auto';
        }
    }
</script>

<script>
    function variation_price(str){
        if(str == 1)
        {
            $("#priceDiv").css("visibility", 'hidden'); 
            $("#item_price").val(0);
        }
        if(str == 2)
        {
            $("#priceDiv").css("visibility", 'visible');
        }
    }
</script>

<script>
 function code_search(){
	  
	    var ucode = document.getElementById('user_code').value;
	    
	    $.ajax({
		method:"post",
                url:"/promotion_owner_serach/",
                data:{user_code:ucode},
                success:function(data)
                {
                    if(data)
                    {
                           
			    $("#searchdatatbl").append(data);

                    }
 
                }

         });
 }
</script>
<script>
 function variationshow(str,divid){
	  
	    var item_id = str;
	    
	    $.ajax({
		method:"post",
                url:"/ajax_variation_show/",
                data:{item_id:item_id,divid:divid},
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
    function ajax_add_more_item(){
	    
	    $.ajax({

                method:"post",
                url:"/add_delivery_service/",
                data:{user_code:ucode},
                success:function(data)
                {
                    if(data)
                    {
                            $(".delivery_msg").text("Added successfully");

                    }
 
                }

         });
        //$("#showMoreItem").append('<tr><td>ITEM </td><td><input id="Text5" type="text" placeholder="Item Name" name="item_name_variation1[]" required></td><td>PRICE:</td><td><div class="col-md-9"><input id="Text6" type="text" value="" name="price_variation1[]" required></div><div class="col-md-3">KD</div></td></tr>');
   }


  
</script>


<?PHP
  $this->load->view("includes/Restaurant_Owner/footer");
?>


<script>
  $(function() {
    var dateToday = new Date();
    $( "#datepicker" ).datepicker({dateFormat: 'yy-mm-dd',minDate: dateToday });

  });

  $(function() {
    var dateToday = new Date();
    $( "#datepicker1" ).datepicker({dateFormat: 'yy-mm-dd',minDate: dateToday });
  });

  </script>


  <script>

function getService(str){

          var owner_id = document.getElementById('owner_id').value;

          $.ajax({
                          method:"post",
                          url:'/get_service_for_restro_owner/',
                          data:{location:str,owner_id:owner_id,res:1},
                          success:function(response)
                          {

                             $("#service_id").html(response);

                          }



                     });

        }


function filteringData(str){

      var owner_id = document.getElementById('owner_id').value;

      var location_id = document.getElementById('location_id').value;
     

          $.ajax({
                          method:"post",
                          url:'/restro_location_filter_item_list/',
                          data:{location:location_id,owner_id:owner_id,service:str},
                          success:function(response)
                          {
                            
                             $("#itemdata1").html(response);
                             $("#itemdata2").html(response);
                             $("#itemdata3").html(response);
                             $("#itemdata4").html(response);
                             $("#itemdata5").html(response);

                          }



                     });

    }

</script>