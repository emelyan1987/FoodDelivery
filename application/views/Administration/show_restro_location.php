<?PHP
    $this->load->view("includes/Administration/header");
    $this->load->view("includes/Administration/sidebar");
?>
<link rel="stylesheet" href="<?PHP echo base_url();?>assets/Administration/plugins/datatables/dataTables.bootstrap.css">
<body>
<div class="content-wrapper">


    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <a href='/restaurant_list/' class="btn bg-gray-light2"> Back to Restaurant Location</a>
                <div class="header-tool">

                    <h4><?php $resNaME = getRestroName($restro_id);
                        echo $resNaME;?></h4>
                    <a href='/add_restro_location/<?php echo $restro_id;?>' class="btn bg-gray-light2" style="float:right;"><span class="add_sign">+</span> Add Location</a>
                </div>
                <br><br>
                <div class="clear_h10"></div>
                <div class="table-responsive">
                    <table class="table table_design table-bordered dataTable no-footer" id="example1">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Contact Person</th>
                                <th>Telephones</th>
                                <th>City</th>
                                <th>Area</th>
                                <th>Service</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($restro_location as $ks => $vs): ?>


                                <tr>
                                    <td><?php echo ucwords($vs->location_name);?></td>
                                    <td><?php echo ucwords($vs->location_contact_person);?></td>
                                    <td><?php echo $vs->telephones;?></td>
                                    <td><?php getCityName($vs->city);?></td>
                                    <td><?php getAreaName($vs->area);?></td>
                                    <td><?php getAllRestroLocationServiceName($restro_id, $vs->id);?></td>
                                    <td align="right">
                                        <a href="/restaurant_edit_location/<?php echo $restro_id;?><?php echo $vs->id;?>" class="edit"><img src="<?PHP echo base_url();?>assets/Administration/images/icon/edit.png" alt="" />Edit</a>&nbsp;&nbsp;

                                        <a href="javascript:void(0)" onClick="delete_restaurant_loc(this.id)" id="<?PHP echo $vs->id;?>" class="delete">x</a></td>

                                </tr>
                                <?PHP

                                    endforeach;

                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="clear_h10"></div>
                <!--<a href="AddRestaurant.html" class="btn bg-gray-light2"><span class="add_sign">+</span> Add Restaurant</a>-->



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
    function delete_restaurant_loc(value)
    {
        if(value)
        {

            var v=confirm("Do You Want To Delete This Restaurant Location?");
            if(v==true)
            {
                $.ajax({
                    method:"post",
                    url:"/delete_restaurant_location/",
                    data:{lid:value},
                    success:function(response)
                    {
                        if(response)
                        {
                            window.location.reload();
                        }
                    }


                })
            }

        }

    }
</script>