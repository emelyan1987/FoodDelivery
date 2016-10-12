<?PHP
    $this->load->view("includes/Restaurant_Owner/header");
    $this->load->view("includes/Restaurant_Owner/sidebar");
?>
<body>
<div class="content-wrapper">



    <section class="content">
        <div class="row">
        <div class="col-md-12">
        <!--<a href="AddRestaurant.html" class="btn bg-gray-light2">&lt; &nbsp;Back to Add Restaurant</a>-->
        <div class="clear_h10"></div>

        <div class="box-header">                    
            <h3 class="box-title border_bottom">List of Item Category</h3>
        </div>

        <div class="col-md-12"> 
            <div class="row form-inline">
                    <div class="col-md-10">
                        <label>Location</label>
                        <select class="form-control" id="location_id" name="location_id" onchange="getService(this.value)">
                            <option value="">-Select Location-</option>
                            <?php
                                foreach ($Locations as $loc => $list):
                                ?>
                                <option value="<?php echo $list->id;?>"> <?php echo $list->location_name;?></option>
                                <?php
                                    endforeach;
                            ?>

                        </select>
                        <input type="hidden" value="<?php echo $this->tank_auth->get_user_id();?>" name="owner_id" id="owner_id">
                        <label>Service</label>
                        <select class="form-control" name="service_id" id="service_id" onchange="filteringData(this.value);">
                            <option value="">-Select Service-</option>


                        </select>
                    </div>
                    <div class="col-md-2">
                        <a href="/restro_item_category_setup/" class="btn bg-gray-light2"><span class="add_sign">+</span> Add New</a>
                    </div>
                </div>
                <div style="height: 20px;"></div>
                <div class="table-responsive" style="clear:both;">

                    <table id="example1" class="table table-bordered table-striped table-responsive" >
                        <thead>
                            <tr>
                                <th>Name<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                <!--<th>Owner Code<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>-->
                                <th>Location<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                <th>Service<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                <th>Action<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>

                            </tr>
                        </thead>
                        <tbody id="filterDataShow">
                            <?php
                                foreach ($category as $cat => $catdata):
                                ?>
                                <tr>
                                    <td><?php echo ucwords($catdata->cat_name);?></td>
                                    <!--<td><?php if ($catdata->user_id != '') {echo getOwnerCodeById($catdata->user_id);}
                                    ?></td>-->
                                    <td><?php if ($catdata->location_id != '') {echo getOwnerlocationByLId($catdata->location_id);}
                                    ?></td>
                                    <td><?php if ($catdata->service_id == 1) {echo "DELIVERY";} elseif ($catdata->service_id == 2) {echo "CATERING";} elseif ($catdata->service_id == 3) {echo "RESERVATION";} elseif ($catdata->service_id == 4) {echo "PICKUP";}
                                    ?></td>

                                    <td align="right">
                                        <a href="/restro_item_category_edit/<?php echo $catdata->id;?>" class="edit border-gray padding_less" style="float:left;"><i class="fa fa-pencil text-blue" aria-hidden="true"></i></a>
                                        <a href="/restro_delete_item_category/<?php echo $catdata->id;?>" class="delete">x</a></td>
                                </tr>
                                <?php
                                    endforeach;
                            ?>
                        </tbody>
                    </table>



                </div>
        </div>
    </section>
</div><!-- /.content-wrapper -->
<?PHP
    $this->load->view("includes/Restaurant_Owner/footer");
?>


<script>
    $(function () {
        $("#example1").DataTable({
            "dom": '<fl<t>ip>'
        });
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true
        });
    });
</script>



<script>
    function locationGet(str){
        var value = str;
        $.ajax({
            method:"post",
            url:'/get_location_for_restro_owner/',
            data:{id:value},
            success:function(response)
            {

                $("#location_id").html(response);

            }



        });
    }

    function getService(str){

        var owner_id = document.getElementById('owner_id').value;

        $.ajax({
            method:"post",
            url:'/get_service_for_restro_owner/',
            data:{location:str,owner_id:owner_id},
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
            url:'/restro_location_service_filter_category/',
            data:{location:location_id,owner_id:owner_id,service:str},
            success:function(response)
            {

                $("#filterDataShow").html(response);

            }



        });

    }

    </script>