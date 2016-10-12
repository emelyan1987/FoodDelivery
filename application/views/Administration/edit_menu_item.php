<?PHP
    $this->load->view("includes/Administration/header"); 
    $this->load->view("includes/Administration/sidebar");

    foreach($itemDetails as $itm => $itmD):
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content">

            <form role="form" method="post" action='' enctype ="multipart/form-data" >
                <div class="row">
                <div class="col-md-12">
                    <a href="/show_item_list/" class="btn bg-gray-light2">&lt; &nbsp;Back to Edit Menu Item</a>
                    <div class="clear_h10"></div>
                    <h4 class="border_bottom">Edit Menu ITem</h4>                   
                    <div class="clear_h10"></div>                   
                    <div class="table-responsive">
                        <table class="table bg-gray-light tbl" style="width:65%;">
                            <tbody>
                                <tr>
                                    <td width="20%">OWNER CODE</td>
                                    <td><?php if($itmD->user_id != ''){ echo getOwnerCodeById($itmD->user_id); } ?></td></tr>
                                <tr>
                                <tr>
                                    <td width="20%">LOCATION</td>
                                    <td><?php if($itmD->location_id != ''){ echo getOwnerlocationByLId($itmD->location_id); } ?></td></tr>
                                <tr>
                                <tr>
                                    <td width="20%">SERVICE</td>
                                    <td><?php if($itmD->service_id == 1){ echo "DELIVERY"; }elseif($itmD->service_id == 2){ echo "CATERING"; }elseif($itmD->service_id == 3){ echo "RESERVATION"; }elseif($itmD->service_id == 4){ echo "PICKUP"; } ?></td></tr>
                                <tr>
                                <?php
                                    if($itmD->image != '')
                                    {
                                    ?>
                                    <tr><td colspan="2"><img src="<?php getImagePath($itmD->image); ?>" style="width:200px;height:200px;"></td></tr>
                                    <?php
                                    }
                                ?>
                                <tr><td colspan="2"><input type="file" name="uploadedimages" class="form-control"></td></tr>
                                <tr>
                                    <td width="20%">NAME</td>
                                    <td><input type="text" class="form-control" id="exampleInputPassword1" name="item_name" placeholder="Enter Item Name" value="<?php echo $itmD->item_name; ?>">
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
                                    <td><input type="text" class="form-control" name="item_price" placeholder="Enter Item Price" value="<?php echo $itmD->item_price; ?>" id="item_price">
                                        <span style="color:red"><?PHP  echo form_error('item_price'); ?></span></td></tr>
                                <tr><td>DESCRIPTION</td>
                                    <td><textarea class="form-control" id="exampleInputPassword1" name="item_description" placeholder="Enter Item Description"><?php echo $itmD->item_description; ?></textarea></td></tr>
                                <tr><td>POINTS</td>
                                    <td>
                                        <div class="col-md-6">
                                            When Amount <input type="text" name="order_point_amount" Placeholder="Amount" class="form-control"  value="<?php echo $itmD->order_point_amount; ?>">
                                        </div>
                                        <div class="col-md-6">
                                            Get Points <input type="number" class="form-control" name="loyalty_points" placeholder="Enter Item Loyalty Points" min="0" max="300" value="<?php echo $itmD->loyalty_points; ?>">
                                        </div>
                                    </td></tr>
                                <tr><td>Category</td>
                                    <td>
                                        <?php
                                            $cat_list = getEditItemCategory($itmD->user_id,$itmD->location_id,$itmD->service_id);
                                            foreach($cat_list as $ks => $vs): ?>
                                            <div class="col-md-6">
                                                <div class="col-md-2">
                                                    <input type="checkbox" value="<?php echo $vs->id; ?>" name="item_cat[]" <?php if(chkitemcategory($vs->id,$itmD->id) == 1){ echo "checked"; } ?>> 
                                                </div>
                                                <div class="col-md-10">
                                                    <?php echo ucwords($vs->cat_name); ?>
                                                </div>
                                            </div>
                                            <?PHP endforeach; ?>
                                        <!--<select class="form-control" name="item_cat" style="padding:7px; ">
                                        <option value="">-Select One-</option>
                                        <?php foreach($cat_list as $ks => $vs): ?>
                                            <option value="<?php echo $vs->id; ?>" <?php if($vs->id == $itmD->item_cat){ echo "selected"; } ?>><?php echo $vs->cat_name; ?></option>
                                            <?PHP endforeach; ?>
                                        </select>-->
                                        <span style="color:red"><?PHP  echo form_error('item_cat'); ?></span>
                                    </td></tr>
                                <tr><td>Active</td>
                                    <td><input type="checkbox" name="status" value="1" <?php if($itmD->status == 1){ echo "checked"; } ?>> </td></tr>
                            </tbody></table> 
                    </div>



                    <div class="clear_h20"></div>
                    Assign VAriation? &nbsp; &nbsp;
                    &nbsp; <input id="Radio7" type="radio" name="variation" checked="checked" onclick="hide('show');" value="1" <?php
                        if($itmD->variation == 1){ echo "checked"; } ?>> <span>YES</span>
                    &nbsp; <input id="Radio8" type="radio" name="variation" onclick="hide('hide');" value="0" <?php
                        if($itmD->variation == 0){ echo "checked"; } ?>> <span>NO</span>

                    <div class="clear_h20"></div>
                    <?php
                        if($itmD->variation == 1)
                        {
                            $stlo = 'style="visibility: visible;display:block; height: auto;"';
                        }
                        else
                        {
                            $stlo = 'style="visibility: hidden;display:none; height: auto;"';
                        }
                    ?>

                    <div id="Panel1" <?php echo $stlo; ?>>

                        <div id="setup_requirements_div" <?php if($itmD->service_id != 2){ ?>style="display:none;" <?php } ?> >
                            <h4 class="border_bottom">Setup Requirements</h4>
                            <textarea rows="5" cols="50" name="setup_requirements" id="setup_requirements"><?php echo $itmD->setup_requirements; ?></textarea>
                        </div>
                        <h4 class="border_bottom">Variations</h4>
                        <div class="table-responsive">
                            <table class="table bg-gray-light tbl" style="width:65%;">
                                <tbody>
                                    <?php
                                        if($varData1['variation_name'] != '')
                                        {
                                        ?>

                                        <tr>
                                            <td width="20%">VARIATION 1:</td>
                                            <td><input id="Text3" type="text" name="variation_name1" value="<?php echo $varData1['variation_name']; ?>" >
                                                <input id="Text3" type="hidden" name="variation_id1" value="<?php echo $varData1['id']; ?>" >
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>MANDATORY</td>
                                            <td>&nbsp; <input id="Radio9" type="radio" name="v_mandatory1" checked="checked" value="1" <?php if($varData1['mandatory'] == 1){ echo "checked"; } ?> > <span>YES</span>
                                                &nbsp; <input id="Radio10" type="radio" name="v_mandatory1" value="0" <?php if($varData1['mandatory'] == 0){ echo "checked"; } ?>> <span>NO</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>MULTIPLE ITEMS</td>
                                            <td>&nbsp; <input id="Radio11" type="radio" name="v_multi_item1" checked="checked" value="1" <?php if($varData1['multi_item'] == 1){ echo "checked"; } ?> > <span>YES</span>
                                                &nbsp; <input id="Radio12" type="radio" name="v_multi_item1" value="0" <?php if($varData1['multi_item'] == 1){ echo "checked"; } ?>> <span>NO</span></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <table class="table bg-gray-light tbl" id="variation1Item">
                                                    <?php
                                                        $variationData1 = get_All_Variation_Data($varData1['id'],$varData1['item_id']);
                                                        foreach($variationData1 as $varD => $VD):
                                                        ?>
                                                        <tr>
                                                            <td>ITEM </td>
                                                            <td><input id="Text5" type="text" placeholder="Item Name" name="item_name_variation1[]" required value="<?php echo $VD->title; ?>"></td>
                                                            <td>PRICE:</td>
                                                            <td><div class="col-md-9"><input id="Text6" type="text" value="<?php echo $VD->price; ?>" name="price_variation1[]" required> <input id="Text6" type="hidden" value="<?php echo $VD->id; ?>" name="id_variation1[]" required></div><div class="col-md-3">KD</div></td>
                                                        </tr>
                                                        <?php
                                                            endforeach;
                                                    ?>
                                                </table>
                                            </td>
                                        </tr>

                                        <!--<tr><td></td>
                                        <td><button type="button" class="btn bg-gray-light2" onclick="variationMore1();"><span class="add_sign">+</span> Add Item</button></td>
                                        <td></td>
                                        <td></td>
                                        </tr>-->


                                        <?php
                                        }
                                        if($varData2['variation_name'] != '')
                                        {
                                        ?>

                                        <tr>
                                            <td width="20%">VARIATION 2:</td>
                                            <td><input id="Text3" type="text" name="variation_name2" value="<?php echo $varData2['variation_name']; ?>" >
                                                <input id="Text3" type="hidden" name="variation_id2" value="<?php echo $varData2['id']; ?>" >
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>MANDATORY</td>
                                            <td>&nbsp; <input id="Radio9" type="radio" name="v_mandatory2" checked="checked" value="1" <?php if($varData2['mandatory'] == 1){ echo "checked"; } ?>> <span>YES</span>
                                                &nbsp; <input id="Radio10" type="radio" name="v_mandatory2" value="0" <?php if($varData2['mandatory'] == 0){ echo "checked"; } ?>> <span>NO</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>MULTIPLE ITEMS</td>
                                            <td>&nbsp; <input id="Radio11" type="radio" name="v_multi_item2" checked="checked" value="1" <?php if($varData2['multi_item'] == 1){ echo "checked"; } ?> > <span>YES</span>
                                                &nbsp; <input id="Radio12" type="radio" name="v_multi_item2" value="0" <?php if($varData2['multi_item'] == 0){ echo "checked"; } ?> > <span>NO</span></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <table class="table bg-gray-light tbl" id="variation2Item">
                                                    <?php
                                                        $variationData2 = get_All_Variation_Data($varData2['id'],$varData2['item_id']);

                                                        foreach($variationData2 as $varD => $VD):
                                                        ?>
                                                        <tr>
                                                            <td>ITEM </td>
                                                            <td><input id="Text5" type="text" placeholder="Item Name" name="item_name_variation2[]" required value="<?php echo $VD->title; ?>"></td>
                                                            <td>PRICE:</td>
                                                            <td><div class="col-md-9"><input id="Text6" type="text" value="<?php echo $VD->price; ?>" name="price_variation2[]" required> <input id="Text6" type="hidden" value="<?php echo $VD->id; ?>" name="id_variation2[]" required></div><div class="col-md-3">KD</div></td>
                                                        </tr>
                                                        <?php
                                                            endforeach;
                                                    ?>
                                                </table>
                                            </td>
                                        </tr>

                                        <!--<tr><td></td>
                                        <td><button type="button" class="btn bg-gray-light2" onclick="variationMore2();"><span class="add_sign">+</span> Add Item</button></td>
                                        <td></td>
                                        <td></td>
                                        </tr>-->
                                        <?php
                                        }
                                        if($varData3['variation_name'] != '')
                                        {
                                        ?>
                                        <tr>
                                            <td width="20%">VARIATION 3:</td>
                                            <td><input id="Text3" type="text" name="variation_name3" value="<?php echo $varData3['variation_name']; ?>">
                                                <input id="Text3" type="hidden" name="variation_id3" value="<?php echo $varData3['id']; ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>MANDATORY</td>
                                            <td>&nbsp; <input id="Radio9" type="radio" name="v_mandatory3" checked="checked" value="1" <?php if($varData3['mandatory'] == 1){ echo "checked"; } ?>> <span>YES</span>
                                                &nbsp; <input id="Radio10" type="radio" name="v_mandatory3" value="0" <?php if($varData3['mandatory'] == 0){ echo "checked"; } ?>> <span>NO</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>MULTIPLE ITEMS</td>
                                            <td>&nbsp; <input id="Radio11" type="radio" name="v_multi_item3" checked="checked" value="1" <?php if($varData3['multi_item'] == 1){ echo "checked"; } ?>> <span>YES</span>
                                                &nbsp; <input id="Radio12" type="radio" name="v_multi_item3" value="0" <?php if($varData3['multi_item'] == 0){ echo "checked"; } ?>> <span>NO</span></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <table class="table bg-gray-light tbl" id="variation3Item">
                                                    <?php
                                                        $variationData3 = get_All_Variation_Data($varData3['id'],$varData3['item_id']);

                                                        foreach($variationData3 as $varD => $VD):
                                                        ?>
                                                        <tr>
                                                            <td>ITEM </td>
                                                            <td><input id="Text5" type="text" placeholder="Item Name" name="item_name_variation3[]" required value="<?php echo $VD->title; ?>"></td>
                                                            <td>PRICE:</td>
                                                            <td><div class="col-md-9"><input id="Text6" type="text" value="<?php echo $VD->price; ?>" name="price_variation3[]" required> <input id="Text6" type="hidden" value="<?php echo $VD->id; ?>" name="id_variation3[]" required></div><div class="col-md-3">KD</div></td>
                                                        </tr>
                                                        <?php
                                                            endforeach;
                                                    ?>
                                                </table>
                                            </td>
                                        </tr>
                                        <?php
                                        }
                                    ?>
                                    <!--<tr><td></td>
                                    <td><button type="button" class="btn bg-gray-light2" onclick="variationMore3();"><span class="add_sign">+</span> Add Item</button></td>
                                    <td></td>
                                    <td></td>
                                    </tr>-->
                                </tbody></table>
                        </div>
                        <div class="border-gray" style="width:65%;"></div><div class="clear_h10"></div>


                        <!--<h4>Variations</h4>
                        <div class="border-gray" style="width:65%;"></div><div class="clear_h10"></div>
                        <?php echo $varData1['variation_name']; ?> <a href="" class="delete">x</a> |
                        <?php echo $varData2['variation_name']; ?> <a href="" class="delete">x</a> |
                        <?php echo $varData3['variation_name']; ?> <a href="" class="delete">x</a> |
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
                opanel.style.display = 'none';
            }
            else {
                opanel.style.visibility = 'visible';
                opanel.style.height = 'auto';
                opanel.style.display = 'block';
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
        endforeach;
    $this->load->view("includes/Administration/footer");
?>