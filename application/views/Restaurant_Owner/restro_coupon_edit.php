<?PHP
    $this->load->view("includes/Restaurant_Owner/header"); 
    $this->load->view("includes/Restaurant_Owner/sidebar");
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->


    <section class="content">
        <form action="" method="post" >
            <div class="row">
                <div class="col-md-12">
                    <a href="/restro_coupon_show" class="btn bg-gray-light2">&lt; &nbsp;Back to coupon list</a>
                    <h4 class="border_bottom">Setup Coupons</h4> 

                    <?php if($success_msg) { ?>
                        <div class="alert alert-success">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success!</strong> <?php echo $success_msg; ?>
                        </div>
                        <?php  } ?>                          

                    <?php
                        foreach($coupondata as $co => $coupon):
                        ?>
                        <div class="table-responsive">
                            <table class="table bg-gray-light tbl" style="width:80%;">
                                <tbody>
                                    <tr>
                                        <td width="20%">COUPON CODE:</td>
                                        <td colspan="4"><input id="Text12" type="text" name="coupon_code" value="<?php echo $coupon->coupon_code; ?>"></td>
                                    </tr>
                                    <tr>
                                        <td>VALIDITY DATE:</td>
                                        <td width="80">FROM:</td>
                                        <td><input id="datepicker" type="text" name="from_date" value="<?php echo $coupon->from_date; ?>"></td>
                                        <td width="80">TO:</td>
                                        <td><input id="datepicker1" type="text" name="to_date" value="<?php echo $coupon->to_date; ?>"> </td>
                                    </tr>
                                    <tr>
                                        <td>COUPON DISCOUNT:</td>
                                        <td colspan="2"><input id="Text16" type="text"  class="text-right" name="discount" style="width:90%" value="<?php echo $coupon->discount; ?>"> %</td>
                                    </tr>
                                    <tr>
                                        <td colspan="5">MY LOCATION</td>
                                    </tr>
                                    <tr>
                                        <td colspan="5">
                                            <?php
                                                foreach($location as $lo=> $loc):
                                                ?>
                                                <input id="Radio2" type="radio" name="location_id" value="<?php echo $loc->id; ?>"  <?php if($loc->id==$coupon->location_id){ ?> checked="checked" <?php } ?>> &nbsp; <span><?php echo $loc->location_name; ?></span> &nbsp;  &nbsp;

                                                <?php

                                                    endforeach;
                                            ?>        
                                        </td>
                                    </tr>
                                </tbody></table> 
                        </div>
                        <button type="submit" class="btn btn-success" name="btnsave">Save</button>

                        <?php
                            endforeach;
                    ?>
                </div>
            </div>
        </form>
    </section>
</div>
<?PHP
    $this->load->view("includes/Restaurant_Owner/footer");
?>


<script>
    $(function() {
        var dateToday = new Date();
        $( "#datepicker" ).datepicker({dateFormat: 'yy-mm-dd',minDate: dateToday });

    });

    $(function() {
        var dateToday = new Date();
        $( "#datepicker1" ).datepicker({dateFormat: 'yy-mm-dd',minDate: dateToday });
    });

  </script>

