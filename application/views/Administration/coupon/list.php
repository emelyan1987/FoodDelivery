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
                        <h3 class="box-title">Manage Coupon</h3>

                    </div><!-- /.box-header -->      
                    <div class="row">               
                        <div class="col-md-8">
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
                                <select id="location-select">
                                    <option value="">-Select Location-</option>  
                                </select>
                            </span>
                            &nbsp;<button class="btn" onclick="onSearchBtnClick()"><i class="fa fa-search"></i></button>
                        </div>    
                        <div class="col-md-4">
                            <a href="/coupon_edit/" class="btn bg-gray-light2" style="float:right;"><i class="fa fa-plus"></i> Add New</a>
                        </div>
                    </div>     
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Restaurant<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                    <th>Location<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                    <th>Coupon Code<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                    <th>From Date<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                    <th>To Date<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                    <th>Discount<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="data-body">
                                <?php foreach($data as $ks => $vs):?>                    
                                    <tr>
                                        <td><?php echo $vs->restro;?></td>
                                        <td><?php echo $vs->location; ?></td>       
                                        <td><?php echo $vs->coupon_code; ?></td>
                                        <td><?php echo $vs->from_date; ?></td>
                                        <td><?php echo $vs->to_date; ?></td>
                                        <td><?php echo $vs->discount; ?> %</td>

                                        <td>     
                                            <a href="/coupon_edit/<?php echo $vs->id; ?>" class="btn"><i class="fa fa-edit" aria-hidden="true"></i> </a>
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

    function reloadData() {
        var params = {},
        restro_id = $("#restro-select").val(),
        location_id = $("#location-select").val();        

        if(restro_id && restro_id.length>0) params.restro_id = restro_id;
        if(location_id && location_id.length>0) params.location_id = location_id;

        console.log(params);
        $.ajax({
            method:"get",
            url:'/coupon',
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
                        html += "<td>"+item.coupon_code+"</td>";
                        html += "<td>"+item.from_date+"</td>";
                        html += "<td>"+item.to_date+"</td>";
                        html += "<td>"+item.discount+" %</td>";

                        html += "<td>";
                        html += "<a href='/coupon_edit/"+item.id+"' class='btn'><i class='fa fa-edit'></i> </a>";
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
                url:'/coupon/'+id,              
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