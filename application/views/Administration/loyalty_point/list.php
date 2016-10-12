<?PHP
    $this->load->view("includes/Administration/header");
    $this->load->view("includes/Administration/sidebar");
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">   
                        <h3 class="box-title">All Loyalty Setup List</h3>
                                
                            <a href="/loyalty_point_edit/" class="btn bg-gray-light2" style="float:right;"><i class="fa fa-plus"></i> Add New</a>
                        
                    </div><!-- /.box-header -->      
                    <div>               
                       <span>
                                <label for="restro-select">Restaurant:&nbsp;</label>
                                <select id="restro-select" onchange="getLocations(this.value)">
                                    <option value="">-Select Restaurant-</option>
                                    <?php foreach ($restro_list as $restro):?>
                                        <option value="<?php echo $restro->id;?>"><?php echo $restro->restro_name;?></option>
                                        <?php endforeach;?>

                                </select>
                            </span>
                            <span>
                                <label for="location-select">Location:&nbsp;</label>
                                <select id="location-select" onchange="getServices(this.value)">
                                    <option value="">-Select Location-</option>  
                                </select>
                            </span>
                            <span>
                                <label for="service-select">Service:&nbsp;</label>
                                <select id="service-select">
                                    <option value="">-Select Service-</option>  
                                </select>
                            </span>
                            &nbsp;<button class="btn" onclick="onSearchBtnClick()"><i class="fa fa-search"></i></button>   
                        
                    </div>     
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Restaurant<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                    <th>Location<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                    <th>Service<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                    <th>From1<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                    <th>To1<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                    <th>Discount1<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                    <th>From2<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                    <th>To2<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                    <th>Discount2<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                    <th>From3<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                    <th>To3<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                    <th>Discount3<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="data-body">
                                <?php foreach($data as $ks => $vs):?>                    
                                    <tr>
                                        <td><?php echo $vs->restro;?></td>
                                        <td><?php echo $vs->location; ?></td>       
                                        <td><?php echo $vs->service; ?></td>       
                                        <td><?php echo $vs->from1; ?></td>
                                        <td><?php echo $vs->to1; ?></td>
                                        <td><?php echo $vs->discount1; ?></td>      
                                        <td><?php echo $vs->from2; ?></td>
                                        <td><?php echo $vs->to2; ?></td>
                                        <td><?php echo $vs->discount2; ?></td>      
                                        <td><?php echo $vs->from3; ?></td>
                                        <td><?php echo $vs->to3; ?></td>
                                        <td><?php echo $vs->discount3; ?></td>    

                                        <td>     
                                            <a href="/loyalty_point_edit/<?php echo $vs->id; ?>" class="btn"><i class="fa fa-edit" aria-hidden="true"></i> </a>
                                            <a class="btn" onclick="onDeleteBtnClick(<?php echo $vs->id; ?>)"><i class="fa fa-remove"></i></a>
                                        </td>

                                    </tr>
                                    <?PHP endforeach;?>


                            </tbody>

                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section>
</div>
<?PHP
    $this->load->view("includes/Administration/footer");
?>

<script>
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

    function reloadData() {
        var params = {},
        restro_id = $("#restro-select").val(),
        location_id = $("#location-select").val();        
        service_id = $("#service-select").val();        

        if(restro_id && restro_id.length>0) params.restro_id = restro_id;
        if(location_id && location_id.length>0) params.location_id = location_id;
        if(service_id && service_id.length>0) params.service_id = service_id;

        console.log(params);
        $.ajax({
            method:"get",
            url:'/loyalty_point',
            data: params,
            success:function(response)
            {
                console.log(response);
                response = JSON.parse(response);
                if(response && response.data) {
                    var data = response.data;

                    var html = "";
                    for(var i=0; i<data.length; i++) {
                        var item = data[i];
                        html += "<tr>";
                        html += "<td>"+item.restro+"</td>";
                        html += "<td>"+item.location+"</td>";
                        html += "<td>"+item.service+"</td>";
                        html += "<td>"+item.from1+"</td>";
                        html += "<td>"+item.to1+"</td>";
                        html += "<td>"+item.discount1+"</td>"; 
                        html += "<td>"+item.from2+"</td>";
                        html += "<td>"+item.to2+"</td>";
                        html += "<td>"+item.discount2+"</td>"; 
                        html += "<td>"+item.from3+"</td>";
                        html += "<td>"+item.to3+"</td>";
                        html += "<td>"+item.discount3+"</td>";  

                        html += "<td>";
                        html += "<a href='/loyalty_point_edit/"+item.id+"' class='btn'><i class='fa fa-edit'></i> </a>";
                        html += "<a onclick='onDeleteBtnClick("+item.id+")' class='btn'><i class='fa fa-remove'></i></a>";
                        html += "</td>";

                        html += "</tr>"     ;
                    }
                    $("#data-body").html(html);
                }                            
            }     
        });
    }
    function onSearchBtnClick(){
        reloadData();
    }   

    function onDeleteBtnClick(id){         
        console.log(id);

        if(confirm("Are you sure to delete?")==true) {
            $.ajax({
                method:"delete",
                url:'/loyalty_point/'+id,              
                success:function(response)
                {
                    response = JSON.parse(response);
                    if(response.success) {
                        reloadData();
                    } else {
                        alert("Request failed");
                    }
                }     
            });
        }

    }
</script>