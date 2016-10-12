<?PHP
    $this->load->view("includes/Restaurant_Owner/header"); 
    $this->load->view("includes/Restaurant_Owner/sidebar");
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <a href="/manage_my_restro_list/" class="btn bg-gray-light2"> Back to Restaurant</a>
                    <div class="box-header">
                        <h3 class="box-title">Manage Restaurant Table</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" style="float:right;">Add Tables</button> <br><br>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Table No. / Name<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                    <th>Location<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                    <th>User Limit<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                    <th>Status<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>

                                    <!--<th>Price<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>-->
                                    <th style="text-align: center;">Action<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($restrotables as $ks => $vs): ?>                    

                                    <tr>
                                        <td><?php echo $vs->table_no;?></td>
                                        <td><?php echo getOwnerlocationByLId($vs->location_id); ?></td>
                                        <td><?php echo $vs->user_limit;?></td>
                                        <!--<td>KD <?php echo $vs->price;?> </td>-->
                                        <td><?php if($vs->status==1){ echo "<span style='color:green'>Available</span>"; }elseif($vs->status==2){ echo "<span style='color:orange'>Booked</span>"; }else{ echo "<span style='color:red'>Not Available</span>"; } ?>
                                        </td>
                                        <td><a href="#" data-toggle="modal" data-target="#myModal1" onclick='EditTable("<?php echo 
                                                $vs->id ?>","<?php echo  $vs->restro_id ?>");' >Edit </a> 
                                            | <a href="#">Delete</a> | <a href="/restro_tables_booking/<?php echo $vs->restro_id;?>/<?php echo $vs->id;?>">All Booking</a>
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
    $this->load->view("includes/Restaurant_Owner/footer");
?>



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


                        <!--<div class="form-group">
                        <label for="exampleInputPassword1">Location</label>
                        <select class="form-control" name="location_id" require>
                        <option value="">-Select Location-</option>
                        <?php
                            foreach($Locations as $loc => $locData):
                            ?>
                            <option value="<?php echo $locData->id; ?>"><?php echo $locData->location_name; ?></option>
                            <?php
                                endforeach;
                        ?>

                        </select>
                        <span style="color:red"><?PHP  echo form_error('location_id'); ?></span>

                        </div>-->

                        <div class="form-group">
                            <label for="exampleInputPassword1">Table No. / Name</label>
                            <input type="text" class="form-control" id="exampleInputPassword1" name="table_no" placeholder="Enter Table No." require>
                            <span style="color:red"><?PHP  echo form_error('table_no'); ?></span>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">User Limit</label>
                            <input type="number" class="form-control" id="exampleInputPassword1" name="user_limit" placeholder="Enter User Limit" min="1" max="10" require>
                            <span style="color:red"><?PHP  echo form_error('user_limit'); ?></span>

                        </div>
                        <!--<div class="form-group">
                        <label for="exampleInputPassword1">Price</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name="price" placeholder="Enter Price" require>
                        <span style="color:red"><?PHP  echo form_error('price'); ?></span>

                        </div>-->
                        <div class="form-group">
                            <label for="exampleInputPassword1">Description</label>
                            <textarea class="form-control" id="exampleInputPassword1" name="description" ></textarea>


                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Table Status</label>
                            <Select class="form-control" name="status" require>
                                <option value="1">Available</option>
                                <!--<option value="2">Booked</option>-->
                                <option value="0">Not Available</option>
                            </select>
                            <span style="color:red"><?PHP  echo form_error('status'); ?></span>

                        </div>
                        <input type="submit" name="btnsavetable" value="Add Table" class="btn btn-success">

                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <?php
                    echo validation_errors();
                ?>
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

<script>
    function EditTable(str,restroId){

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                document.getElementById("tableEditResult").innerHTML = xhttp.responseText;
            }
        };
        xhttp.open("GET", "/ajax_edit_restro_table/"+restroId+"/"+str, true);
        xhttp.send();
    }
</script>