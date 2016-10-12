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

                <br><br>
                <div class="header-tool">
                    <h4>RESTAURANT LIST</h4>
                    <a href='/add_new_restaurant/' class="btn bg-gray-light2 pull-right"><span class="add_sign">+</span> Add Restaurant</a>
                </div>
                <?PHP echo $this->session->flashdata("success_emsg");?>
                <div class="clear_h10"></div>
                <div class="table-responsive">
                    <table class="table table_design table-responsive table-bordered " id="example1">
                        <thead>
                            <tr>
                                <th>Logo<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                <th>Code<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                <th>Name<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                <th>Fixed Fees<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                <th>Cuisine<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                <th>Confirm Membership<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>

                                <th>Action<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($restro_list as $ks => $vs):

                                    $active_status = $vs->activation_status;

                                ?>


                                <tr>
                                    <td>  <?php $RId = $vs->id;?>
                                        <?php
                                            if ($vs->restaurant_logo) {
                                            ?>
                                            <img src="<?PHP echo getImagePath($vs->restaurant_logo);?>" style="width:60px;height:60px;" class="img-size">
                                            <?PHP
                                            }
                                        ?>

                                    </td>
                                    <td><?php echo getOwnerCode($vs->user_id);?></td>
                                    <td class="text-info"><?php echo $vs->restro_name;?></td>

                                    <td><?php echo $vs->yearly_fee;?></td>
                                    <td><?PHP
                                        $cousine = getCuisine($vs->id);
                                        foreach ($cousine as $ks => $vs) {
                                            echo $vs->name . ", ";

                                        }
                                    ?></td>
                                    <td>
                                        <?PHP if ($active_status == 1) {
                                            ?>
                                            <button type="button" class="btn btn-success">Activated</button>

                                            <?PHP
                                            } else {
                                            ?>
                                            <button type="button" class="btn btn-default" onClick="sentFinalMail(<?PHP echo $RId;?>)">Send Mail</button>
                                            <?PHP
                                            }
                                        ?>

                                    </td>
                                    <td align="right" width="120px">
                                        <a href="/restaurant_edit/<?php echo $RId;?>" class="edit"><img src="<?PHP echo base_url();?>assets/Administration/images/icon/edit.png" alt="" /></a>&nbsp;&nbsp;
                                        <a href="/restaurant_locations/<?php echo $RId;?>" class="edit"><i class="fa fa-location-arrow" aria-hidden="true" style="color:#0087FF;"></i> Location</a>&nbsp;&nbsp;

                                        <!--<a href="/delete_restaurant/<?php echo $RId;?>" class="delete">x</a>--> <a href="javascript:void(0)" onClick="delete_restaurant(this.id)" id="<?PHP echo $RId;?>" class="delete">x</a></td>

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
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
</script>

<style>
    .img-size
    {
        width: 110px;height: 65px;background-size: cover;
    }
    .text-info
    {
        text-transform:capitalize;
    }
</style>
<script>
    function delete_restaurant(value)
    {
        if(value)
        {

            var v=confirm("Do You Want To Delete This Restaurant?");
            if(v==true)
            {
                $.ajax({
                    method:"post",
                    url:"/delete_restaurant/"+value,
                    data:{rid:value},
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




    function   sentFinalMail(value)
    {

        if(value)
        {

            var v=confirm("Do You Want To Sent Confirm Mail To Restaurant Owner?");
            if(v==true)
            {
                $.ajax({
                    method:"post",
                    url:"/sent_mail_restaurant/"+value,
                    data:{rid:value},
                    success:function(response)
                    {
                        if(response)
                        {

                            if(response)
                            {
                                alert("Mail Has been sent successfully");
                                window.location.reload();
                            }

                        }
                    }


                })
            }

        }

    }
    </script>