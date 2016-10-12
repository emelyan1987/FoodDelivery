<?PHP
    $this->load->view("includes/Administration/header"); 
    $this->load->view("includes/Administration/sidebar");
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <h4 class="border_bottom">ADD AND MANAGE ADVERTISEMENTS - APP</h4>                   
                <div class="clear_h10"></div>                   
                <div class="table-responsive">
                    <table class="table bg-gray-light tbl" style="width:80%;">
                        <tbody>
                            <?php
                                foreach($AdvertiseType as $Ad => $adVer):

                                    $AdvertData = getAdvertData($adVer->id,2);


                                ?>
                                <tr>
                                    <td><h4><?php echo $adVer->title; ?></h4></td>
                                </tr>
                                <form action="" method="post"  enctype="multipart/form-data">
                                    <tr>


                                        <td>
                                            <div class="col-md-4">
                                                <input id="File1" type="file" name="advertise_imag" style="float:left; width:70%;">
                                                <br><br>
                                                <span style="color: #B1B1B1;">please upload 400 * 400 images</span>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="hidden" name="advertise_type" value="<?php echo $adVer->id; ?>">
                                                <button class="btn btn-success" name="btnupload" type="submit">Upload</button>
                                            </div>
                                            <!--<div class="col-md-4">
                                            <a href="/delete_advertise/<?php //echo $adVer->id; ?>" class="btn btn-danger">Delete All Pictures</a>
                                            </div>-->

                                            <br>
                                            <span style="color:red"><?PHP  echo form_error('advertise_imag'); ?></span><br>
                                            <span style="color:red"><?PHP  echo form_error('advertise_type'); ?></span>
                                            <div class="clear_h10"></div>

                                            <div class="col-md-12">
                                                <?php
                                                    foreach($AdvertData as $adv => $advImg):

                                                        if(isset($advImg->image))
                                                        {
                                                        ?>
                                                        <div class="col-md-3" >
                                                            <a href="/delete_advertise/<?php echo $advImg->id; ?>" class="delete" style="float:right; position:absolute; top:12px;right:28px; background:#6B6B6B;">x</a>
                                                            <img src="<?php  getImagePath($advImg->image); ?>" alt="" style="width:200px;height:200px;" class="img-thumbnail"></div>
                                                        <?php
                                                        } 
                                                        else
                                                        {
                                                        ?>  
                                                        <div class="col-md-3">
                                                            <a href="" class="delete">x</a>
                                                        <img src="<?php echo base_url(); ?>assets/Administration/images/item_big.jpg" alt="" height="130px" class="img-thumbnail"> </div>  
                                                        <?php
                                                        }  

                                                        endforeach;
                                                ?>
                                            </div>
                                            <div class="clear_h10"></div>
                                        </td>

                                    </tr>
                                </form>
                                <tr>
                                    <td colspan="2"></td>
                                </tr>
                                <?php
                                    endforeach;
                            ?>


                        </tbody>
                    </table>
                </div>




            </div> 
        </div>
    </section>
</div>
</div>


<?PHP
    $this->load->view("includes/Administration/footer");
?>
