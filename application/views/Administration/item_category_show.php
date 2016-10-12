<?PHP
    $this->load->view("includes/Administration/header");
    $this->load->view("includes/Administration/sidebar");
?>
<style>
    .pagination {
        margin:0 !important;
        float: right;
    }
</style>
<body>
<div class="content-wrapper">

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!--<a href="AddRestaurant.html" class="btn bg-gray-light2">&lt; &nbsp;Back to Add Restaurant</a>-->
                <div class="clear_h10"></div>

                <div class="box-header">
                    <br>
                    <br>
                    <div class="header-tool">
                        <h3 class="box-title">List of Item Category</h3>
                        <a href="/item_category_setup/" class="btn bg-gray-light2"><span class="add_sign">+</span> Add New</a>

                    </div>
                </div>

                <div class="col-md-12 form-group">
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-4 text-right">
                                <label for="owner_id" class="control-label">Code:</label>
                            </div>
                            <div class="col-md-8">
                                <select class="form-control" name="owner_id" onchange="locationGet(this.value)" id="owner_id">
                                    <option value="">-Select Owner Code-</option>
                                    <?php
                                        foreach ($owner_code_list as $oc => $list):
                                        ?>
                                        <option value="<?php echo getOwnerIdByCode($list->owner_id);?>"><?php echo $list->owner_id;?></option>
                                        <?php endforeach;?>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-4 text-right">
                                <label for="location_id" class="control-label">Locations:</label>
                            </div>
                            <div class="col-md-8">
                                <select class="form-control" id="location_id" name="location_id" onchange="getService(this.value)">
                                    <option value="">-Select Location-</option>


                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-4 text-right">
                                <label for="service_id" class="control-label">Service:</label>
                            </div>
                            <div class="col-md-8">
                                <select class="form-control" name="service_id" id="service_id" onchange="filteringData(this.value);">
                                    <option value="">-Select Service-</option>


                                </select>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="table-responsive">

                    <table id="example1" class="table table-bordered  table-responsive">
                        <thead>
                            <tr class="tr1">
                                <th>Name<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                <th>Owner Code<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                <th>Location<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                <th>Service<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                <th>Action<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>

                            </tr>
                        </thead>
                        <tbody id="filterDataShow">
                            <?php
                                foreach ($category as $cat => $catdata):
                                ?>
                                <tr><td><?php echo ucwords($catdata->cat_name);?></td>
                                    <td><?php if ($catdata->user_id != '') {echo getOwnerCodeById($catdata->user_id);}
                                    ?></td>
                                    <td><?php if ($catdata->location_id != '') {echo getOwnerlocationByLId($catdata->location_id);}
                                    ?></td>
                                    <td><?php if ($catdata->service_id == 1) {echo "DELIVERY";} elseif ($catdata->service_id == 2) {echo "CATERING";} elseif ($catdata->service_id == 3) {echo "RESERVATION";} elseif ($catdata->service_id == 4) {echo "PICKUP";}
                                    ?></td>
                                    <td align="right">
                                        <a href="/edit_item_category/<?php echo $catdata->id;?>" class="edit border-gray padding_less" style="float:left;"><i class="fa fa-pencil text-blue" aria-hidden="true"></i> Edit</a>
                                        <a href="/delete_item_category/<?php echo $catdata->id;?>" class="delete confirmation">x</a></td>
                                </tr>
                                <?php
                                    endforeach;
                            ?>
                        </tbody>
                    </table>


                    <!--<table class="table table_design tbl" style="width:60%;" id="example2">
                    <thead>
                    <tr>
                    <th>Name</th>
                    <th style="text-align:right;">Action</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        //foreach($category as $cat => $catdata):
                    ?>
                    <tr><td><?php //echo ucwords($catdata->cat_name); ?></td>
                    <td align="right"><a href="/delete_item_category/<?php //echo $catdata->id; ?>" class="delete">x</a></td>
                    </tr>
                    <?php
                        //endforeach;
                    ?>
                    </tbody></table>-->
                </div>



            </div>
        </div>
    </section>
</div><!-- /.content-wrapper -->
<?PHP
    $this->load->view("includes/Administration/footer");
?>

<script src="<?PHP echo base_url();?>assets/Administration/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?PHP echo base_url();?>assets/Administration/plugins/datatables/dataTables.bootstrap.min.js"></script>

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
            url:'/get_location_service_filter_category/',
            data:{location:location_id,owner_id:owner_id,service:str},
            success:function(response)
            {

                $("#filterDataShow").html(response);

            }



        });

    }

</script>

<style>
    .tr1 {
        background: #F8F8F8;
    }
</style>


<script type="text/javascript">
    var elems = document.getElementsByClassName('confirmation');
    var confirmIt = function (e) {
        if (!confirm('Are you sure?')) e.preventDefault();
    };
    for (var i = 0, l = elems.length; i < l; i++) {
        elems[i].addEventListener('click', confirmIt, false);
    }
</script>