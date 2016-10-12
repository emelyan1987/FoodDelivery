<?PHP
    $this->load->view("includes/Restaurant_Owner/header"); 
    $this->load->view("includes/Restaurant_Owner/sidebar");
    $this->load->helper('restaurant_helper');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h4 class="border_bottom">Manage Restaurant</h4>
                    </div><!-- /.box-header -->
                    <div class="box-body">

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>

                                    <th>Logo <img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                    <th>Restaurant Name <img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                    <th>Fixed Fees<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                    <th>Cuisine<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                    <!--<th>Status<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>-->
                                    <th style="text-align: center;">Action<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($retro_list as $ks => $vs): ?>                    

                                    <tr>

                                        <td>
                                            <?php
                                                if($vs->restaurant_logo != '')
                                                {
                                                ?>
                                                <img src="<?php echo getImagePath($vs->restaurant_logo);?>" style="width:60px;height:60px;" >
                                                <?php
                                                }
                                                else
                                                {
                                                ?>
                                                <img src="/assets/Customer/img/icon/bottomIcon2.png" height="50" >
                                                <?php
                                                }
                                            ?>
                                        </td>
                                        <td><?php echo ucwords($vs->restro_name);?></td>
                                        <td><?php echo $vs->yearly_fee;?></td>
                                        <td>
                                            <?PHP 
                                                $cousine=getCuisine($vs->id);
                                                foreach($cousine as $ks=>$vs1)
                                                {
                                                    echo ucwords($vs1->name.  ",");


                                                }
                                        ?></td>


                                        
                                        </td>

                                        <td width="200" style="text-align: center;">
                                            <div class="col-md-12">
                                                <!--<a href="/edit_owner_restro/<?php echo $vs->id;?>"  class="edit"><img src="<?PHP echo base_url();  ?>assets/Administration/images/icon/edit.png" alt="" >Edit </a> |-->
                                                <!--<a href="/view_my_restro/<?php echo $vs->id;?>">View</a> | -->
                                                <!--<a href="/restro_add_menu/<?php echo $vs->id;?>">Menu</a> | -->
                                                <!--<a href="/manage_restro_table/<?php echo $vs->id;?>">Table</a> |-->
                                                <a href="/manage_restro_location/<?php echo $vs->id;?>">Location </a>
                                            </div>





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
