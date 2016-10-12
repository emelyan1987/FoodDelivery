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

                    <div class="box-header">
                        <h3 class="box-title border_bottom">Manage Item Category</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="col-md-12 form-group form-inline">

                            <div class="col-md-10">  
                                <label>Location</label>
                                <select class="form-control" id="location_id" name="location_id" onchange="getService(this.value)">
                                    <option value="">-Select Location-</option>
                                    <?php
                                        foreach($Locations as $loc => $list):
                                        ?>
                                        <option value="<?php echo $list->id; ?>"> <?php echo $list->location_name; ?></option>
                                        <?php
                                            endforeach;
                                    ?>

                                </select>
                                <input type="hidden" value="<?php echo $this->tank_auth->get_user_id(); ?>" name="owner_id" id="owner_id">
                                <label>Service</label>
                                <select class="form-control" name="service_id" id="service_id" onchange="filteringData(this.value);">
                                    <option value="">-Select Service-</option>


                                </select>  
                                
                            </div>
                            <div class="col-md-2">
                                <a href="/restro_add_item/" class="btn bg-gray-light2"><span class="add_sign">+</span> Add New</a>

                            </div>
                        </div>  


                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Item Name<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                    <th>Image<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                    <th>Price<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                    <th>Category<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                    <th>Description<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                    <th>Status<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                    <th>Action<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>

                                </tr>
                            </thead>
                            <tbody  id="filterDataShow">
                                <?php foreach($item_list as $ks => $vs): 

                                    ?>                    

                                    <tr>
                                        <td><?php echo ucwords($vs->item_name); ?></td>
                                        <td>
                                            <?php
                                                if($vs->image != '')
                                                {
                                                ?>

                                                <img src="<?php $img = explode('public_html',$vs->image); 
                                                    echo $img[1];?>" style="width:60px;height:60px;">
                                                <?php
                                                }
                                        ?></td>
                                        <td> KD <?php echo $vs->item_price;?></td>
                                        <td><?php 
                                            $allCatid = getcatByItem($vs->id);
                                            $i = 1;
                                            foreach($allCatid as $item => $ImId):
                                                if($i != 1)
                                                {
                                                    echo " , ";
                                                }

                                                getCategoryName($ImId->category_id);
                                                $i++;
                                                endforeach;
                                        ?></td>
                                        <td><?php echo $vs->item_description;?></td>
                                        <td><?php if($vs->status==1) { echo "<span class='text-green'>Active</span>"; } else { echo "<span class='text-red'>Deactive</span>"; } ?>
                                        </td>
                                        <td>

                                            <a href="/edit_restro_item/<?php echo $vs->id; ?>" class="edit border-gray padding_less"><i class="fa fa-pencil text-blue" aria-hidden="true"></i> </a>

                                            <a href="/delete_my_item/<?php echo $vs->id; ?>" class="delete">x</a>
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

<script>

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
            url:'/restro_location_service_filter_item/',
            data:{location:location_id,owner_id:owner_id,service:str},
            success:function(response)
            {

                $("#filterDataShow").html(response);

            }



        });

    }

</script>
