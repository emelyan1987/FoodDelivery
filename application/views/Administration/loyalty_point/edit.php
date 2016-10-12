<?PHP
    $this->load->view("includes/Administration/header");
    $this->load->view("includes/Administration/sidebar");
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->


    <section class="content">
        <a href="/loyalty_point_list" class="btn bg-gray-light2">&lt; &nbsp;Back to Loyality Redeem</a>
        <h4 class="border_bottom">LOYALTY POINTS REDEEM SETUP</h4>                   


        <form name="dataForm">
            <div class="row" style="margin:0;">
                <div class="col-md-6">
                    <div class="form-card">
                        <div class="form-group row">
                            &nbsp;            
                        </div>
                        <div class="form-group row">
                            <label for="restro-select" class="col-xs-3 col-form-label">Restaurant: </label>
                            <div class="col-xs-9">
                                <select id="restro-select" class="form-control" onchange="getLocations(this.value)" name="restaurant">
                                    <option value="">-Select Restaurant-</option>
                                    <?php foreach ($restro_list as $restro):?>
                                        <option value="<?php echo $restro->id;?>" <?php echo isset($data)&&$data->restro_id==$restro->id?"selected":""?>><?php echo $restro->restro_name;?></option>
                                        <?php endforeach;?>  
                                </select>     
                            </div>            
                        </div>
                        <div class="form-group row">
                            <label for="location-select" class="col-xs-3 col-form-label">Location: </label>
                            <div class="col-xs-9">
                                <select id="location-select" class="form-control" name="location" onchange="getServices(this.value)">
                                    <option value="">-Select Location-</option> 
                                    <?php foreach ($location_list as $location):?>
                                        <option value="<?php echo $location->id;?>" <?php echo $data->location_id==$location->id?"selected":""?>><?php echo $location->location_name;?></option>
                                        <?php endforeach;?>
                                </select> 
                            </div>                
                        </div>
                        <div class="form-group row">
                            <label for="service-select" class="col-xs-3 col-form-label">Service: </label>
                            <div class="col-xs-9">
                                <select id="service-select" class="form-control" name="service" onchange="onServiceSelectChange()">
                                    <option value="">-Select Service-</option> 
                                    <?php foreach ($service_list as $service):?>
                                        <option value="<?php echo $service->id;?>" <?php echo $data->service_id==$service->id?"selected":""?>><?php echo $service->cat_name;?></option>
                                        <?php endforeach;?>
                                </select> 
                            </div>                
                        </div>
                    </div>
                </div>   
                <div class="col-md-6">
                    <div class="form-card">
                        <div class="form-inline form-group row">
                            <div class="col-md-8" style="text-align:center;">Redeem Points Range</div>                            
                            <div class="col-md-4" style="text-align:center;">Percentage</div>                            
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4"><input class="form-control" type="number" placeholder="From" value="<?php echo isset($data)?$data->from1:""?>" id="from1-input" name="from1" min="0"></div>
                            <div class="col-md-4"><input class="form-control" type="number" placeholder="To" value="<?php echo isset($data)?$data->to1:""?>" id="to1-input" name="to1" min="0"></div>
                            <div class="col-md-4"><input class="form-control" type="number" placeholder="%" value="<?php echo isset($data)?$data->discount1:""?>" id="discount1-input" name="discount1" step="0.1" min="0" max="100"></div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4"><input class="form-control" type="number" placeholder="From" value="<?php echo isset($data)?$data->from2:""?>" id="from2-input" name="from2" min="0"></div>
                            <div class="col-md-4"><input class="form-control" type="number" placeholder="To" value="<?php echo isset($data)?$data->to2:""?>" id="to2-input" name="to2" min="0"></div>
                            <div class="col-md-4"><input class="form-control" type="number" placeholder="%" value="<?php echo isset($data)?$data->discount2:""?>" id="discount2-input" name="discount2" step="0.1" min="0" max="100"></div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4"><input class="form-control" type="number" placeholder="From" value="<?php echo isset($data)?$data->from3:""?>" id="from3-input" name="from3" min="0"></div>
                            <div class="col-md-4"><input class="form-control" type="number" placeholder="To" value="<?php echo isset($data)?$data->to3:""?>" id="to3-input" name="to3" min="0"></div>
                            <div class="col-md-4"><input class="form-control" type="number" placeholder="%" value="<?php echo isset($data)?$data->discount3:""?>" id="discount3-input" name="discount3" step="0.1" min="0" max="100"></div>
                        </div>
                    </div>
                </div>
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

    function getServices(str){

        var restro_id = $("#restro-select").val();
        var location_id = $("#location-select").val();

        if(restro_id=="" || location_id == "") return;
        $.ajax({
            method:"post",
            url:'/get_service_for_restro_location',
            data:{restro_id: restro_id, location_id: location_id},
            success:function(response)
            {
                response = JSON.parse(response);

                if(response && response.data) {
                    var services = response.data
                    var html = "<option value=''>-Select Service-</option>";
                    for(var i=0; i<services.length; i++) {
                        var service = services[i];
                        html += "<option value='"+service.id+"'>"+service.cat_name+"</option>";
                    }
                    $("#service-select").html(html);
                }
            }     
        });
    }    
    
    function onServiceSelectChange(){
         console.log("asdfasdf")
        
        var restro_id = $("#restro-select").val();
        var location_id = $("#location-select").val();
        var service_id = $("#service-select").val();

        if(restro_id=="" || location_id=="" || service_id=="") return;
        $.ajax({
            method:"get",
            url:'/loyalty_point',
            data:{
                restro_id: restro_id, 
                location_id: location_id,
                service_id: service_id
            },
            success:function(response)
            {
                response = JSON.parse(response);

                console.log(response);
                if(response && response.data) {
                    
                }
            }     
        });
    }


    function validateFormData() {
        if(dataForm.restaurant.value=='') return false;
        if(dataForm.location.value=='') return false;
        if(dataForm.service.value=='') return false;  
        return true;
    }
    function onSaveBtnClick() {
        
        if(validateFormData()) {
            var data = {
                restro_id: dataForm.restaurant.value,
                location_id: dataForm.location.value,
                service_id: dataForm.service.value,
                from1: dataForm.from1.value,
                to1: dataForm.to1.value,   
                discount1: dataForm.discount1.value,
                from2: dataForm.from2.value,
                to2: dataForm.to2.value,   
                discount2: dataForm.discount2.value,
                from3: dataForm.from3.value,
                to3: dataForm.to3.value,   
                discount3: dataForm.discount3.value
            };
            $.ajax({
                method:"post",
                url:'/loyalty_point/<?php echo isset($data)?$data->id:""?>',
                data:data,
                success:function(response)
                {
                    console.log(response);
                    response = JSON.parse(response);

                    if(!response) {
                        alert("Request failed");
                    } else {
                        if(response.success) {
                            location.href="/loyalty_point_list";
                        } else {
                            alert(response.message);
                        }    
                    }

                }     
            });  
        }
    }
</script>  