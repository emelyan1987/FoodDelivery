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
                        <a href="/add_item/" class="btn bg-gray-light2"><span class="add_sign">+</span> Add New</a>
                        <br>
                        <br>
                        <h3 class="box-title">List of Items</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="col-md-12 form-group">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-4 text-right">
                                        <b>Owner Code:</b>
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
                                        <b>Locations:</b>
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
                                        <b>Service:</b>
                                    </div>
                                    <div class="col-md-8">
                                        <select class="form-control" name="service_id" id="service_id" onchange="filteringData(this.value);">
                                            <option value="">-Select Service-</option>


                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <table id="example1" class="table table-bordered  table-responsive">
                            <thead>
                                <tr class="tr1">
                                    <th>Owner Code<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                    <th>Location<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                    <th>Service<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>

                                    <th>Item Name<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                    <th>Image<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                    <th>Price<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                    <th>Category<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                    <!--<th>Description<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>-->
                                    <th>Status<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                    <th>Action<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>

                                </tr>
                            </thead>
                            <tbody id="filterDataShow">
                                <?php foreach ($item_list as $ks => $vs):

                                    ?>

                                    <tr>
                                        <td><?php if ($vs->user_id != '') {echo getOwnerCodeById($vs->user_id);}
                                        ?></td>
                                        <td><?php if ($vs->location_id != '') {echo getOwnerlocationByLId($vs->location_id);}
                                        ?></td>
                                        <td><?php if ($vs->service_id == 1) {echo "DELIVERY";} elseif ($vs->service_id == 2) {echo "CATERING";} elseif ($vs->service_id == 3) {echo "RESERVATION";} elseif ($vs->service_id == 4) {echo "PICKUP";}
                                        ?></td>
                                        <td><?php echo ucwords($vs->item_name);?></td>
                                        <td>
                                            <?php
                                                if ($vs->image != '') {
                                                ?>

                                                <img src="<?php $img = explode('public_html', $vs->image);
                                                    echo $img[1];?>" style="width:60px;height:60px;">
                                                <?php
                                                }
                                        ?></td>
                                        <td> KD <?php echo $vs->item_price;?></td>
                                        <td><?php
                                            $allCatid = getcatByItem($vs->id);
                                            $i = 1;
                                            foreach ($allCatid as $item => $ImId):
                                                if ($i != 1) {
                                                    echo " , ";
                                                }

                                                getCategoryName($ImId->category_id);
                                                $i++;
                                                endforeach;
                                        ?></td>
                                        <!--<td><?php //echo $vs->item_description; ?></td>-->
                                        <td><?php if ($vs->status == 1) {echo "<span class='text-green'>Active</span>";} else {echo "<span class='text-red'>Deactive</span>";}
                                            ?>
                                        </td>
                                        <td>

                                            <a href="/edit_menu_item/<?php echo $vs->id;?>" class="edit border-gray padding_less" style="float:left;"><i class="fa fa-pencil text-blue" aria-hidden="true"></i></a>

                                            <a href="/delete_item/<?php echo $vs->id;?>" class="delete confirmation">x</a>
                                        </td>

                                    </tr>
                                    <?PHP

                                        endforeach;

                                ?>


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
<script src="<?PHP echo base_url();?>assets/Administration/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?PHP echo base_url();?>assets/Administration/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
    $(function () {
        $("#example1").DataTable({
            "dom": '<fl<t>ip>'
        });
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
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
            data:{location:str,owner_id:owner_id,res:1},
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
            url:'/get_location_service_filter_item/',
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