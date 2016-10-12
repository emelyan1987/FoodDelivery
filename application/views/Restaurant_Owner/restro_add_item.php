<?PHP
  $this->load->view("includes/Restaurant_Owner/header"); 
  $this->load->view("includes/Restaurant_Owner/sidebar");
  ?>

<!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
     <section class="content">

<form role="form" method="post" action='' enctype ="multipart/form-data" >
      <div class="row">
                    <div class="col-md-12">
                    <a href="/restro_item_list/" class="btn bg-gray-light2">&lt; &nbsp;Back to Menu Item</a>
                    <div class="clear_h10"></div>
                    <h4 class="border_bottom">Add Menu ITem</h4>                   
                    <div class="clear_h10"></div>                   
                    <div class="table-responsive">
                    <table class="table bg-gray-light tbl" style="width:65%;">
                    <tbody>
		    <tr>
                        <td width="20%">LOCATIONS</td>
                        <td>
                            <select class="form-control" id="location_id" name="location_id" onchange="getService(this.value)">
                            <option value="">-Select Location-</option>
                           <?php
            			    foreach($Locations as $loc => $list):
            			    ?>
            				<option value="<?php echo $list->id; ?>"> <?php echo $list->location_name; ?></option>
            			    <?php
            			    endforeach;
            			    ?>

                          </select>
			  <input type="hidden" value="<?php echo $this->tank_auth->get_user_id(); ?>" name="owner_id" id="owner_id">
                          <span class="text-red"><?php echo form_error('location_id'); ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td width="20%">SERVICE</td>
                        <td>
                            <select class="form-control" name="service_id" id="service_id" onchange="categoryShow(this.value);">
                            <option value="">-Select Service-</option>
                            

                          </select>
                          <span class="text-red"><?php echo form_error('service_id'); ?></span>
                        </td>
                    </tr>
		    <tr><td>Category</td>
                        <td id="CatShowHere">
                            
                            <span style="color:red"><?PHP  echo form_error('item_cat[]'); ?></span>
                        </td>
		    </tr>
                    <tr>
			<td width="20%">IMAGE</td>
			<td ><input type="file" name="uploadedimages" class="form-control"></td></tr>
                    <tr>
                        <td width="20%">NAME</td>
                        <td><input type="text" class="form-control" id="exampleInputPassword1" name="item_name" placeholder="Enter Item Name">
                      <span style="color:red"><?PHP  echo form_error('item_name'); ?></span></td></tr>

                    <tr>
                        <td width="20%"></td>
                        <td>
                        <div class="col-md-12">
                            <input type="radio" name="price_type" value="1" onclick="variation_price(this.value);">
                            Price will be added by Variation price for this item
                        </div>
                        <div class="col-md-12">
                            <input type="radio" name="price_type" value="2" checked onclick="variation_price(this.value);">
                            Have to enter the price of item and variation price will be extra for this item
                        </div>
                      </td>
                    </tr>
                    <tr id="priceDiv">
                        <td>PRICE</td>
                        <td><input type="text" class="form-control" name="item_price" placeholder="Enter Item Price" id="item_price">
                      <span style="color:red"><?PHP  echo form_error('item_price'); ?></span></td></tr>
                    <tr><td>DESCRIPTION</td>
                        <td><textarea class="form-control" id="exampleInputPassword1" name="item_description" placeholder="Enter Item Description"></textarea></td></tr>
                    <tr><td>POINTS</td>
                        <td>
                            <div class="col-md-6">
                                When Amount <input type="number" name="order_point_amount" Placeholder="Amount" class="form-control" >
                            </div>
                            <div class="col-md-6">
                                Get Points <input type="number" class="form-control" name="loyalty_points" placeholder="Enter Item Loyalty Points" min="0" max="300">
                            </div>
                            </td></tr>
                    
                     
                    <tr><td>Active</td>
                        <td><input type="checkbox" name="status" value="1" > </td></tr>
                    </tbody></table>
                    </div>

                    
                  
                    <div class="clear_h20"></div>
                    Assign VAriation? &nbsp; &nbsp;
                    &nbsp; <input id="Radio7" type="radio" name="variation" checked="checked" onclick="hide('show');" value="1"> <span>YES</span>
                    &nbsp; <input id="Radio8" type="radio" name="variation" onclick="hide('hide');" value="0"> <span>NO</span>
                    
                    <div class="clear_h20"></div>

                    <div id="Panel1" style="visibility: visible; height: auto;">
                        <div id="setup_requirements_div" style="display:none;" >
                    <h4 class="border_bottom">Setup Requirements</h4>
                    <textarea rows="5" cols="50" name="setup_requirements" id="setup_requirements"></textarea>
                </div>
                    <h4 class="border_bottom">Variations</h4>
                    <div class="table-responsive">
                    <table class="table bg-gray-light tbl" style="width:65%;">
                    <tbody>

                        
                        <tr>
                            <td width="20%">VARIATION 1:</td>
                            <td><input id="Text3" type="text" name="variation_name1"></td>
                        </tr>
                        <tr>
                            <td>MANDATORY</td>
                            <td>&nbsp; <input id="Radio9" type="radio" name="v_mandatory1" checked="checked" value="1"> <span>YES</span>
                            &nbsp; <input id="Radio10" type="radio" name="v_mandatory1" value="0"> <span>NO</span>
                            </td>
                        </tr>
                        <tr>
                            <td>MULTIPLE ITEMS</td>
                            <td>&nbsp; <input id="Radio11" type="radio" name="v_multi_item1" checked="checked" value="1"> <span>YES</span>
                            &nbsp; <input id="Radio12" type="radio" name="v_multi_item1" value="0"> <span>NO</span></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <table class="table bg-gray-light tbl" id="variation1Item">
                                    <tr>
                                        <td>ITEM </td>
                                        <td><input id="Text5" type="text" placeholder="Item Name" name="item_name_variation1[]"></td>
                                        <td>PRICE:</td>
                                        <td><div class="col-md-9"><input id="Text6" type="text" value="" name="price_variation1[]"></div><div class="col-md-3">KD</div></td>
                                    </tr>
                                    
                                </table>
                            </td>
                        </tr>
                        
                        <tr><td></td>
                            <td><button type="button" class="btn bg-gray-light2" onclick="variationMore1();"><span class="add_sign">+</span> Add Item</button></td>
                            <td></td>
                            <td></td>
                        </tr>
                    
                    

                    <tr>
                            <td width="20%">VARIATION 2:</td>
                            <td><input id="Text3" type="text" name="variation_name2"></td>
                        </tr>
                        <tr>
                            <td>MANDATORY</td>
                            <td>&nbsp; <input id="Radio9" type="radio" name="v_mandatory2" checked="checked" value="1"> <span>YES</span>
                            &nbsp; <input id="Radio10" type="radio" name="v_mandatory2" value="0"> <span>NO</span>
                            </td>
                        </tr>
                        <tr>
                            <td>MULTIPLE ITEMS</td>
                            <td>&nbsp; <input id="Radio11" type="radio" name="v_multi_item2" checked="checked" value="1"> <span>YES</span>
                            &nbsp; <input id="Radio12" type="radio" name="v_multi_item2" value="0"> <span>NO</span></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <table class="table bg-gray-light tbl" id="variation2Item">
                                    <tr>
                                        <td>ITEM </td>
                                        <td><input id="Text5" type="text" placeholder="Item Name" name="item_name_variation2[]"></td>
                                        <td>PRICE:</td>
                                        <td><div class="col-md-9"><input id="Text6" type="text" value="" name="price_variation2[]"></div><div class="col-md-3">KD</div></td>
                                    </tr>
                                    
                                </table>
                            </td>
                        </tr>
                        
                        <tr><td></td>
                            <td><button type="button" class="btn bg-gray-light2" onclick="variationMore2();"><span class="add_sign">+</span> Add Item</button></td>
                            <td></td>
                            <td></td>
                        </tr>


                     <tr>
                            <td width="20%">VARIATION 3:</td>
                            <td><input id="Text3" type="text" name="variation_name3"></td>
                        </tr>
                        <tr>
                            <td>MANDATORY</td>
                            <td>&nbsp; <input id="Radio9" type="radio" name="v_mandatory3" checked="checked" value="1"> <span>YES</span>
                            &nbsp; <input id="Radio10" type="radio" name="v_mandatory3" value="0"> <span>NO</span>
                            </td>
                        </tr>
                        <tr>
                            <td>MULTIPLE ITEMS</td>
                            <td>&nbsp; <input id="Radio11" type="radio" name="v_multi_item3" checked="checked" value="1"> <span>YES</span>
                            &nbsp; <input id="Radio12" type="radio" name="v_multi_item3" value="0"> <span>NO</span></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <table class="table bg-gray-light tbl" id="variation3Item">
                                    <tr>
                                        <td>ITEM </td>
                                        <td><input id="Text5" type="text" placeholder="Item Name" name="item_name_variation3[]"></td>
                                        <td>PRICE:</td>
                                        <td><div class="col-md-9"><input id="Text6" type="text" value="" name="price_variation3[]"></div><div class="col-md-3">KD</div></td>
                                    </tr>
                                    
                                </table>
                            </td>
                        </tr>
                        
                        <tr><td></td>
                            <td><button type="button" class="btn bg-gray-light2" onclick="variationMore3();"><span class="add_sign">+</span> Add Item</button></td>
                            <td></td>
                            <td></td>
                        </tr>




                    </tbody></table>
                    </div>
                    <div class="border-gray" style="width:65%;"></div><div class="clear_h10"></div>
                    <!--<a href="" class="btn bg-gray-light2"><span class="add_sign">+</span> Add Variation</a>
                    
                    <h4>Variation 1</h4>
                    <div class="border-gray" style="width:65%;"></div><div class="clear_h10"></div>
                    Variation Item 1 <a href="" class="delete">x</a> |
                    Variation Item 2 <a href="" class="delete">x</a> |
                    Variation Item 3 <a href="" class="delete">x</a> |
                    </div>-->
                    <div class="clear_h20"></div>                   
                  
                   
                 </div>






 <button type="submit" class="btn bg-green" name="btnsave">Save </button>

         

      </div>
    </form>
  </section>
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
    function variationMore1(){
        $("#variation1Item").append('<tr><td>ITEM </td><td><input id="Text5" type="text" placeholder="Item Name" name="item_name_variation1[]" required></td><td>PRICE:</td><td><div class="col-md-9"><input id="Text6" type="text" value="" name="price_variation1[]" required></div><div class="col-md-3">KD</div></td></tr>');
   }


  function variationMore2(){
        $("#variation2Item").append('<tr><td>ITEM </td><td><input id="Text5" type="text" placeholder="Item Name" name="item_name_variation2[]" required></td><td>PRICE:</td><td><div class="col-md-9"><input id="Text6" type="text" value="" name="price_variation2[]" required></div><div class="col-md-3">KD</div></td></tr>');

  }

   function variationMore3(){
        $("#variation3Item").append('<tr><td>ITEM </td><td><input id="Text5" type="text" placeholder="Item Name" name="item_name_variation3[]" required></td><td>PRICE:</td><td><div class="col-md-9"><input id="Text6" type="text" value="" name="price_variation3[]" required></div><div class="col-md-3">KD</div></td></tr>');

  }
</script>


<?PHP
  $this->load->view("includes/Restaurant_Owner/footer");
?>


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

        function categoryShow(str){
            var owner_id = document.getElementById('owner_id').value;
            var location_id = document.getElementById('location_id').value;

            $.ajax({
                          method:"post",
                          url:'/ajax_get_location_category/',
                          data:{location:location_id,owner_id:owner_id,service:str},
                          success:function(response)
                          {
                            
                             $("#CatShowHere").html(response);



                          }



                     });

            if(str == 2)
            {
               document.getElementById('setup_requirements_div').style.display = 'block';
            }
        }
    </script>