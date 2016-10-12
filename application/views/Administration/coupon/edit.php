<?PHP
    $this->load->view("includes/Administration/header");
    $this->load->view("includes/Administration/sidebar");
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->


    <section class="content">
        <a href="/coupon_list" class="btn bg-gray-light2">&lt; &nbsp;Back to coupon list</a>
        <h4 class="border_bottom">Add Coupon</h4>                   


        <form name="dataForm">

            <div class="form-inline form-group">
                <label for="restro-select" class="col-xs-2 col-form-label">Restaurant: </label>
                <select id="restro-select" class="form-control" onchange="getLocations(this.value)" name="restaurant">
                    <option value="">-Select Restaurant-</option>
                    <?php foreach ($restro_list as $restro):?>
                        <option value="<?php echo $restro->id;?>" <?php echo isset($data)&&$data->restro_id==$restro->id?"selected":""?>><?php echo $restro->restro_name;?></option>
                        <?php endforeach;?>  
                </select>                 
            </div>
            <div class="form-inline form-group">
                <label for="location-select" class="col-xs-2 col-form-label">Location: </label>
                <select id="location-select" class="form-control" name="location">
                    <option value="">-Select Location-</option> 
                    <?php foreach ($location_list as $location):?>
                        <option value="<?php echo $location->id;?>" <?php echo $data->location_id==$location->id?"selected":""?>><?php echo $location->location_name;?></option>
                        <?php endforeach;?>
                </select>                 
            </div>
            <div class="form-inline form-group">
                <label for="coupon-code-input" class="col-xs-2 col-form-label">Coupon Code: </label>
                <input class="form-control" type="input" value="<?php echo isset($data)?$data->coupon_code:""?>" id="coupon-code-input" name="coupon_code">
            </div>                
            <div class="form-inline form-group">
                <label class="col-xs-2">Validate Date</label>  
                <input class="form-control" type="date" id="from-date-input" name="from_date" value="<?php echo isset($data)?$data->from_date:""?>">                
            </div>  
            <div class="form-inline form-group">
                <label class="col-xs-2"></label>               
                <input class="form-control" type="date" id="to-date-input" name="to_date" value="<?php echo isset($data)?$data->to_date:""?>">                
            </div>  
            <div class="form-inline form-group">
                <label for="discount-input" class="col-xs-2 col-form-label">Discount: </label>
                <input class="form-control" type="number" value="<?php echo isset($data)?$data->discount:""?>" id="discount-input" name="discount" step="0.1" min="0" max="100">  %
            </div>   
            <button type="button" class="btn btn-success" name="btnsave" onclick="onSaveBtnClick()">Save</button>
        </form>
        <?php echo validation_errors(); ?>
    </section>
</div>
<?PHP
    $this->load->view("includes/Administration/footer");
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

    function getLocations(str){
        var value = str;
        $.ajax({
            method:"post",
            url:'/get_locations_for_restro',
            data:{restro_id: value},
            success:function(response)
            {
                response = JSON.parse(response);

                if(response && response.data) {
                    var locations = response.data
                    var html = "<option value=''>-Select Location-</option>";
                    for(var i=0; i<locations.length; i++) {
                        var location = locations[i];
                        html += "<option value='"+location.id+"'>"+location.location_name+"</option>";
                    }
                    $("#location-select").html(html);
                }
            }     
        });
    }

    function validateData(data) {
        return true;
    }
    function onSaveBtnClick() {
        var data = {
            restro_id: dataForm.restaurant.value,
            location_id: dataForm.location.value,
            coupon_code: dataForm.coupon_code.value,
            from_date: dataForm.from_date.value,
            to_date: dataForm.to_date.value,
            discount: dataForm.discount.value
        };
        if(validateData(data)) {
            $.ajax({
                method:"post",
                url:'/coupon/<?php echo isset($data)?$data->id:""?>',
                data:data,
                success:function(response)
                {
                    console.log(response);
                    response = JSON.parse(response);

                    if(!response) {
                        alert("Request failed");
                    } else {
                        if(response.success) {
                            location.href="/coupon_list";
                        } else {
                            alert(response.message);
                        }    
                    }

                }     
            });  
        }
    }
</script>  