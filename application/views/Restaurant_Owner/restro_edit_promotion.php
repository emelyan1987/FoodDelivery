<?PHP
  $this->load->view("includes/Restaurant_Owner/header"); 
  $this->load->view("includes/Restaurant_Owner/sidebar");
  ?>

<style>
    .pad3{
        padding: 3px;

    }
</style>
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
                    <?php
                    if($success_msg)
                    {
                    ?>
                        <div class="alert alert-success">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> <?php echo $success_msg; ?>
</div>
                    <?php
                    }
                    ?>
                    <div class="table-responsive">
                    <table class="table bg-gray-light tbl" style="width:80%;" id="searchdatatbl">
		   
                    
<tr>
            <td width="20%">LOCATION:</td>
                        <td>
            <?php
            foreach($location as $lo=>$loc):
            ?>
            <?php if($loc->id == $promotion['location_id']){ echo $loc->location_name; } ?>
            <?php
            $owner_id = $loc->user_id;
            endforeach;
            ?>
            
            
            <input type="hidden" value="<?php echo $owner_id; ?>" name="owner_id" >
            </td>
            </tr>
                    <tr><td>SERVICE:</td>
                        <td>
            <?php if($promotion['service_id'] == 1){ echo "DELIVERY"; } ?>
            <?php if($promotion['service_id'] == 2){ echo "CATERING"; } ?>
            <?php if($promotion['service_id'] == 3){ echo "RESERVATION"; } ?>
            <?php if($promotion['service_id'] == 4){ echo "PICKUP"; } ?>
            
            </td></tr>
            
            
        <tr>
        <td colspan="2">
        <div class="table-responsive">

                    <table class="table bg-gray-light tbl" style="width:80%;">
                    
                    <tr>
                        <td width="20%">Promotion Name:</td>
                        <td colspan="4"><input id="Text1" type="text" name="pro_name" value="<?php echo $promotion['name']; ?>" />
                            <br>
                            <span style="color:red"><?PHP  echo form_error('pro_name'); ?></span>
                        </td>
                    </tr>
                    <tr><td>Description:</td>
                        <td colspan="4"><textarea id="TextArea1" rows="2" cols="20" name="pro_description"><?php echo $promotion['description']; ?></textarea>
<br><span style="color:red"><?PHP  echo form_error('pro_description'); ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <table id="showMoreItem" class="table" style="width:100%;">
                                
                    
                    <?php
                    $i = 1;
                    foreach($pitems as $pi => $itemdata):
                        $divname = "ajaxvar".$i;
                    ?>
                                <tr>
                                        <td><strong>ITEM-<?php echo $i; ?></strong></td>
                                        <td colspan="2">
                                        <strong>
                                        <?php
                                        foreach($item_list as $it=>$item):
                                        if($itemdata->item_id == $item->id){
                                            echo $item->item_name; 
                                        }
                                        endforeach;
                                        ?></strong>
                                        </td>
                                </tr>
                                <tr >
                                    <td colspan="3" id="<?php echo $divname; ?>">
                                    <table style="width:100%;" border="1" class="table-responsive">       
                                    <?php
                                    $itmVarData = get_data_item_variation($this->uri->segment(2),$itemdata->item_id);
                                    foreach($itmVarData as $it => $itD)
                                    {

                                    $getvarAllData   = getvarAllData($this->uri->segment(2),$itemdata->item_id,$itD->id);


                                     //print_r($getvarAllData);
                                     //print_r($getvarAllData);
                                    ?>
                                    
                                    <?php
                                    foreach($getvarAllData as  $gt => $gtvarD)
                                    {
                                    ?>
                                
                                                    <tr >
                                                        
                                                        <td class="pad3"><?php echo $itD->variation_name; ?></td>
                                                        <td class="pad3"><?php echo $gtvarD->title; ?></td>
                                                        <td class="pad3">Qty:</td>
                                                        <td class="pad3"><?php echo $gtvarD->quantity; ?></td>
                                                    </tr>
                                
                                    <?php 
                                    }
                                    ?>

                                    
                                    <?php
                                    }
                                    ?>
                                    </table>   
                                    </td>
                                </tr>
                    <?php
                    $i++;
                    endforeach;
                    ?>
                    
                    
                                
                    
                </table>
            </td>
            </tr>
                    
                   
                    
                    </table> 
                 </div>
         </td>
         </tr>

         <tr>
            <td colspan="2">
                    <div class="table-responsive"  style="clear: both;">
                    <table class="table bg-gray-light tbl" style="width:80%;">
                    <tr><td width="15%">Total Price:</td>
                        <td colspan="3"><input id="Text11" type="text" value="<?php echo $promotion['price']; ?>" style="width:50%;" name="pro_price"/></td></tr>
                    <tr><td width="15%">From:</td>
                        <td><input id="datepicker" type="text" name="from_date" value="<?php echo $promotion['from_date']; ?>"></td>
                        <td width="10%">To:</td>
                        <td><input id="datepicker1" type="text" name="to_date" value="<?php echo $promotion['to_date']; ?>"> </td></tr>
                    <tr><td><button class="btn bg-green">SAVE</button></td>
                        
                    </tr>
                    </table>
                    </div>
            </td>
         </tr>
            

    
                    </table> 
                    </div>

                    

                    
                    </div>
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
 function variationshow(str,divid,pro_id){
	  
	    var item_id = str;
	    
	    $.ajax({
		method:"post",
                url:"/restro_ajax_variation_show/",
                data:{item_id:item_id,divid:divid,pro_id:pro_id},
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