<?PHP
    $this->load->view("includes/Administration/header");
    $this->load->view("includes/Administration/sidebar");
?>
<script>

    /*
    var showPage = $('#example1_wrapper').children(':first').children(':first');
    showPage.appendTo('#example1_wrapper > .row');*/

</script>
<body>
<div class="content-wrapper">

    <section class="content">
    <form action="" method="post">
        <div class="row">
        <div class="col-md-12">
        <!--<a href="AddRestaurant.html" class="btn bg-gray-light2">&lt; &nbsp;Back to Add Restaurant</a>-->
        <div class="clear_h10"></div>

        <div class="box-header">

            <button type="button" class="btn btn-round bg-gray-light2 pull-right" data-toggle="modal" data-target="#myModal" style="float:right;"> <span class="add_sign">+</span> Add Tables</button>
            <br>
            <br>
            <h3 class="box-title">List of Restaurant Tables</h3>
        </div>

        <div class="col-md-12 form-group">
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-4 text-right">
                    <label for="owner_id" class="control-label">Owner Code:</label>
                </div>
                <div class="col-md-8">
                    <select class="form-control" name="search_owner_id" onchange="locationGet(this.value)" id="owner_id">
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
                    <select class="form-control" id="location_id" name="search_location_id" onchange="getService(this.value)">
                        <option value="">-Select Location-</option>


                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">

                <input type="submit" name="btnsearch" class="btn btn-success" value="Search" >
            </div>
        </div>
    </form>
</div>

<div class="table-responsive">

    <table id="example1" class="table table_design table-bordered dataTable no-footer">
        <thead>
            <tr class="tr1">
                <th>Table Name/No.<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                <th>Owner Code<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                <th>Location<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                <th>User Limit<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                <th>Price<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                <th>Status<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                <th width="15%">Action<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>

            </tr>
        </thead>
        <tbody id="filterDataShow">
            <?php
                foreach ($TablesData as $tab => $tabData):
                ?>
                <tr><td><?php echo ucwords($tabData->table_no);?></td>
                    <td><?php if ($tabData->user_id != '') {echo getOwnerCodeById($tabData->user_id);}
                    ?></td>
                    <td><?php if ($tabData->location_id != '') {echo getOwnerlocationByLId($tabData->location_id);}
                    ?></td>
                    <td><?php echo $tabData->user_limit;?></td>
                    <td><?php echo $tabData->price;?></td>
                    <td><?php if ($tabData->status == 1) {echo "<span style='color:green'>Available</span>";} else {echo "<span style='color:red'>Not Available</span>";}
                    ?></td>
                    <td align="right">
                        &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" data-toggle="modal" data-target="#myModal1" onclick='EditTable("<?php echo
                            $tabData->id?>","<?php echo $tabData->restro_id?>","<?php echo $tabData->user_id?>");' class="edit border-gray padding_less" style="float:left;"><i class="fa fa-pencil text-blue" aria-hidden="true"></i></a>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="/tables_booking/<?php echo $tabData->restro_id;?>/<?php echo $tabData->id;?>" style="float:left;margin-left:10px;">All Booking</a> &nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="/delete_restro_table/<?php echo
                            $tabData->id?>" class="delete confirmation" >x</a>


                    </td>
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
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
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


    function locationGet1(str){
        var value = str;
        $.ajax({
            method:"post",
            url:'/get_location_for_restro_owner/',
            data:{id:value},
            success:function(response)
            {

                $("#location_id1").html(response);

            }



        });
    }


    function locationGet2(str){
        var value = str;
        $.ajax({
            method:"post",
            url:'/get_location_for_restro_owner/',
            data:{id:value},
            success:function(response)
            {

                $("#location_id2").html(response);

            }



        });
    }





</script>




<!-- Modal1 -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Table</h4>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action='' enctype ="multipart/form-data" >
                    <div class="box-body">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Owner Code:</label>
                                <select class="form-control" name="owner_id1" onchange="locationGet1(this.value)" id="owner_id1">
                                    <option value="">-Select Owner Code-</option>
                                    <?php
                                        foreach ($owner_code_list as $oc => $list):
                                        ?>
                                        <option value="<?php echo getOwnerIdByCode($list->owner_id);?>"><?php echo $list->owner_id;?></option>
                                        <?php endforeach;?>

                                </select>
                                <span style="color:red"><?PHP echo form_error('owner_id1');?></span>

                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="exampleInputPassword1">Location</label>
                                <select class="form-control" name="location_id1" require id="location_id1">
                                    <option value="">-Select Location-</option>


                                </select>
                                <span style="color:red"><?PHP echo form_error('location_id');?></span>

                            </div>
                        </div>

                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="exampleInputPassword1">Table No. / Name</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" name="table_no" placeholder="Enter Table No." require>
                                <span style="color:red"><?PHP echo form_error('table_no');?></span>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">User Limit</label>
                                <input type="number" class="form-control" id="exampleInputPassword1" name="user_limit" placeholder="Enter User Limit" min="1" max="10" require>
                                <span style="color:red"><?PHP echo form_error('user_limit');?></span>

                            </div>
                        </div>
                        <!--<div class="form-group">
                        <label for="exampleInputPassword1">Price</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name="price" placeholder="Enter Price" require>
                        <span style="color:red"><?PHP echo form_error('price');?></span>

                        </div>-->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Description</label>
                                <textarea class="form-control" id="exampleInputPassword1" name="description" ></textarea>


                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="priceInput">Deposit Amount for Reservation</label>
                                <input type="number" class="form-control" id="priceInput" name="price" placeholder="Enter Price" min="0" step="0.1">                                
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="smsInput">SMS Message for Reservation</label>
                                <textarea class="form-control" id="smsInput" name="sms" ></textarea>


                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Table Status</label>
                                <Select class="form-control" name="status" require>
                                    <option value="1">Available</option>
                                    <!--<option value="2">Booked</option>-->
                                    <option value="0">Not Available</option>
                                </select>
                                <span style="color:red"><?PHP echo form_error('status');?></span>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">&nbsp;</label>
                                <br>
                                <input type="submit" name="btnsavetable" value="Add Table" class="btn btn-success">
                            </div>
                        </div>


                    </div>

                </form>

            </div>
            <div class="modal-footer">

            </div>
        </div>

    </div>
</div>




<!-- Modal1 -->
<div id="myModal1" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Table</h4>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action='' enctype ="multipart/form-data" >
                    <div class="box-body" id="tableEditResult">




                    </div>
                </form>

            </div>
            <div class="modal-footer">

            </div>
        </div>

    </div>
</div>

<script type="text/javascript">
    function EditTable(str,restroId,user){

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                document.getElementById("tableEditResult").innerHTML = xhttp.responseText;
            }
        };
        xhttp.open("GET", "/admin_edit_restro_table/"+restroId+"/"+str+"/"+user, true);
        xhttp.send();
    }
    var elems = document.getElementsByClassName('confirmation');
    var confirmIt = function (e) {
        if (!confirm('Are you sure?')) e.preventDefault();
    };
    for (var i = 0, l = elems.length; i < l; i++) {
        elems[i].addEventListener('click', confirmIt, false);
    }
</script>

