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
                <a href="/restro_coupon_setup/" class="btn bg-gray-light2"><span class="add_sign">+</span> Add New</a>
                <div class="box">
                    <div class="box-header">

                        <h3 class="box-title">Manage Coupon</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Coupon Code<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                    <th>From Date<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                    <th>To Date<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                    <th>Discount<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                    <th>Action<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($coupondata as $ks => $vs): 
                                    ?>                    
                                    <tr>
                                        <td><?php echo $vs->coupon_code; ?></td>
                                        <td><?php echo $vs->from_date; ?></td>
                                        <td><?php echo $vs->to_date; ?></td>
                                        <td><?php echo $vs->discount; ?> %</td>

                                        <td>

                                            <a href="/restro_coupon_edit/<?php echo $vs->id; ?>"><i class="fa fa-edit" aria-hidden="true"></i> </a>
                                                      &nbsp;
                                            <a href="/delete_my_coupon/<?php echo $vs->id; ?>"><i class="fa fa-remove"></i></a>
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
