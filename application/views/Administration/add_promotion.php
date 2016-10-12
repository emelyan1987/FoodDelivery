<?PHP
    $this->load->view("includes/Administration/header");
    $this->load->view("includes/Administration/sidebar");
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <form action="" method="post">
    <section class="content">
    <a href="/show_promotion/" class="btn bg-gray-light2"><span class="add_sign"><</span> Back to Promotion List</a>
    <div class="row">
        <div class="col-md-12">
            <h4 class="border_bottom">Promotion</h4>
        </div>
        <div class="col-md-6">
            <div class="table-responsive">
                <table class="table bg-gray-light tbl" style="width:100%;" id="searchdatatbl">
                <tr>
                <td width="20%">Name:</td>
                <td width="80%">
                <select class="form-control" name="user_code" id="user_code" onchange="locationGet(this.value)">
                    <option value="0" >-Select Restaurant name-</option>
                    <?php
                        foreach ($owner_code_list as $own => $ownData):
                        ?>
                        <option value="<?php echo getOwnerIdByCode($ownData->owner_id);?>-<?php echo $ownData->owner_id;?>"><?php echo getRestroNameByOwnerCode($ownData->owner_id);?></option>
                        <?php
                            endforeach;
                    ?>
                </select>
            </div>
        </div>
        </td>
        <td width="10%"></td>
        <td width="80%">
            <!--<input type="button" onclick="code_search();" value="Search" class="btn btn-default" id="searchbtn">-->
        </td>
        </tr>
        <tr>
            <td width="20%">Location:</td>
            <td><select class="form-control" id="pro_location" name="pro_location" onchange="getService(this.value)">
                    <option>Location Name</option>
                </select>
            </td>
        </tr>
        <tr><td>Service:</td>
            <td><select class="form-control" id="pro_service" name="pro_service" onchange="code_search();">
                    <option value="0">Service Name</option>
                </select>
            </td></tr>
        <tr>
        <td colspan="2" style="padding:0 !important">
        <table class="table bg-gray-light tbl">
            <tr><td width="36.5%">Promotion Name:</td>
                <td colspan="4"><input id="Text1" type="text" name="pro_name"/></td></tr>
            <tr><td>Description:</td>
                <td colspan="4"><textarea id="TextArea1" rows="6" cols="20" name="pro_description"></textarea></td></tr>
        </table>
    </div>
    </td>
    </tr>
    </table>
</div>
</div>
<div class="col-md-6">
    <div class="table-responsive">   
        <table class="table bg-gray-light tbl" style="width:100%;">
            <tr>
                <td colspan="4" style="padding:0">
                    <table id="showMoreItem" class="table" style="width:100%;margin-bottom: 16px;">
                        <tr>
                            <td width="20%">Item-1</td>
                            <td colspan="3" width="80%">
                                <select class="form-control" id="itemAj1" name="pro_item_id[]" onchange="variationshow(this.value,'ajaxvar1');">
                                    <option value="0">Select Item</option>
                                </select></td></tr>
                        <tr >
                            <td colspan="4" id="ajaxvar1" class="kill-padding">
                            </td>
                        </tr>
                        <tr>
                            <td width="20%">Item-2</td>
                            <td colspan="3">
                                <select class="form-control" id="itemAj2" name="pro_item_id[]" onchange="variationshow(this.value,'ajaxvar2');">
                                    <option value="0">Select Item</option>
                                </select></td></tr>
                        <tr >
                            <td colspan="4" id="ajaxvar2" class="kill-padding">
                            </td>
                        </tr>
                        <tr>
                            <td width="20%">Item-3</td>
                            <td colspan="3">
                                <select class="form-control" id="itemAj3" name="pro_item_id[]" onchange="variationshow(this.value,'ajaxvar3');">
                                    <option value="0">Select Item</option>
                                </select></td></tr>
                        <tr >
                            <td colspan="4" id="ajaxvar3" class="kill-padding">
                            </td>
                        </tr>
                        <tr>
                            <td width="20%">Item-4</td>
                            <td colspan="3">
                                <select class="form-control" id="itemAj4" name="pro_item_id[]" onchange="variationshow(this.value,'ajaxvar4');">
                                    <option value="0">Select Item</option>
                                </select></td></tr>
                        <tr >
                            <td colspan="4" id="ajaxvar4" class="kill-padding">
                            </td>
                        </tr>
                        <tr>
                            <td width="20%">Item-5</td>
                            <td colspan="3">
                                <select class="form-control" id="itemAj5" name="pro_item_id[]" onchange="variationshow(this.value,'ajaxvar5');">
                                    <option value="0">Select Item</option>
                                </select></td></tr>
                        <tr >
                            <td colspan="4" id="ajaxvar5" class="kill-padding">
                            </td>
                        </tr>
                        <tr><td width="20%">Total Price:</td>
                            <td colspan="3"><input id="Text11" type="text" value="" style="width:100%;" name="pro_price"/></td>    
                        </tr>  
                        <tr><td width="20%">From:</td>
                            <td width="30%"><input id="datepicker" type="text" name="from_date"></td>
                            <td width="20%" style="text-align: center;">To</td>
                            <td width="30%"><input id="datepicker1" type="text" name="to_date"> </td>
                        </tr>
                    </table>
                </td>
            </tr>



        </table>
    </div>
</div>
<div class="col-md-6 col-md-offset-5">
    <button class="btn bg-green">SAVE</button>
</div>
</div>
</section>
<input id="owner_id" type="hidden" name="owner_id"/>
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
        var myarr = ucode.split('-');
        var owner_id =  myarr[0];
        var owner_code =  myarr[1];
        var location_id = document.getElementById('pro_location').value;
        var pro_service = document.getElementById('pro_service').value;
        if(pro_service != 0)
        {
            $.ajax({
                method:"post",
                url:"/promotion_owner_serach/",
                data:{user_code:owner_code,owner_id:owner_id,location_id:location_id,service_id:pro_service},
                success:function(data)
                {
                    if(data)
                    {
                        document.getElementById('itemAj1').innerHTML  = data;
                        document.getElementById('itemAj2').innerHTML  = data;
                        document.getElementById('itemAj3').innerHTML  = data;
                        document.getElementById('itemAj4').innerHTML  = data;
                        document.getElementById('itemAj5').innerHTML  = data;
                    }
                }
            });
        }
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
        //$("#showMoreItem").append('<tr><td>Item </td><td><input id="Text5" type="text" placeholder="Item Name" name="item_name_variation1[]" required></td><td>PRICE:</td><td><div class="col-md-9"><input id="Text6" type="text" value="" name="price_variation1[]" required></div><div class="col-md-3">KD</div></td></tr>');
    }
</script>
<?PHP
    $this->load->view("includes/Administration/footer");
?>
<script>
    $(function() {
        $( "#datepicker" ).datepicker({
            format: 'yyyy-mm-dd'
        });
    });
    $(function() {
        $( "#datepicker1" ).datepicker({
            format: 'yyyy-mm-dd'
        });
    });
</script>
<script>
    function locationGet(str){
        var myarr = str.split('-');
        var value =  myarr[0];
        $.ajax({
            method:"post",
            url:'/get_location_for_restro_owner/',
            data:{id:value},
            success:function(response)
            {
                $("#pro_location").html(response);
                $("#owner_id").val(value);
            }
        });
    }
    function getService(str){
        var owner_val = document.getElementById('user_code').value;
        var myarr = owner_val.split('-');
        var owner_id =  myarr[0];
        $.ajax({
            method:"post",
            url:'/get_service_for_restro_owner/',
            data:{location:str,owner_id:owner_id,res:1},
            success:function(response)
            {
                $("#pro_service").html(response);
            }
        });
    }
</script>