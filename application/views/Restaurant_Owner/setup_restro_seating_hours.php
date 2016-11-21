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
                        <form role="form" method="post" action='' enctype ="multipart/form-data" >
                            <section class="content">                
                                <h4 class="border_bottom" style="width:100%;">Seating Hours:</h4>
                                <div class="table-responsive">
                                    <div style="width:100%; background:#f8f8f8;">                   
                                        <table class="table bg-gray-light tbl" style="width:100%;">
                                            <tr><td></td><td>Category</td><td>From</td><td>To</td><td>Max Cover</td><td>Largest Party Size</td><td>Booking Limit</td><td>Cover Count</td><td>Points</td><td>Deposit Amount</td></tr>

                                            <?php
                                                $weekdays = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday');

                                                foreach($weekdays as $weekday) {
                                                ?>
                                                <tr><td colspan="9" style="border-top:1px solid;"></td></tr>
                                                <tr>
                                                    <td><?php echo ucfirst($weekday); ?>:</td>
                                                    <td>Breakfast</td>
                                                    <td><input type="text" value="<?php echo isset($SeatingInfo[0])?$SeatingInfo[0][$weekday."_from"]:"";?>" name="seating_info_<?php echo $weekday;?>_from[]" class="timepicker"></td>
                                                    <td><input type="text" value="<?php echo isset($SeatingInfo[0])?$SeatingInfo[0][$weekday."_to"]:"";?>" name="seating_info_<?php echo $weekday;?>_to[]"  class="timepicker"></td>
                                                    <td><input type="text" value="<?php echo isset($SeatingInfo[0])?$SeatingInfo[0][$weekday."_max_cover"]:"";?>" name="seating_info_<?php echo $weekday;?>_max_cover[]" ></td>
                                                    <td><input type="text" value="<?php echo isset($SeatingInfo[0])?$SeatingInfo[0][$weekday."_largest_party_size"]:"";?>" name="seating_info_<?php echo $weekday;?>_largest_party_size[]" ></td>
                                                    <td><input type="text" value="<?php echo isset($SeatingInfo[0])?$SeatingInfo[0][$weekday."_booking_limit"]:"";?>" name="seating_info_<?php echo $weekday;?>_booking_limit[]" ></td>
                                                    <td><input type="text" value="<?php echo isset($SeatingInfo[0])?$SeatingInfo[0][$weekday."_cover_count"]:"";?>" name="seating_info_<?php echo $weekday;?>_cover_count[]" ></td>
                                                    <td><input type="text" value="<?php echo isset($SeatingInfo[0])?$SeatingInfo[0][$weekday."_point"]:"";?>" name="seating_info_<?php echo $weekday;?>_point[]" ></td>
                                                    <td><input type="text" value="<?php echo isset($SeatingInfo[0])?$SeatingInfo[0][$weekday."_deposit"]:"";?>" name="seating_info_<?php echo $weekday;?>_deposit[]" ></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td>Lunch</td>
                                                    <td><input type="text" value="<?php echo isset($SeatingInfo[1])?$SeatingInfo[1][$weekday."_from"]:"";?>" name="seating_info_<?php echo $weekday;?>_from[]" class="timepicker"></td>
                                                    <td><input type="text" value="<?php echo isset($SeatingInfo[1])?$SeatingInfo[1][$weekday."_to"]:"";?>" name="seating_info_<?php echo $weekday;?>_to[]"  class="timepicker"></td>
                                                    <td><input type="text" value="<?php echo isset($SeatingInfo[1])?$SeatingInfo[1][$weekday."_max_cover"]:"";?>" name="seating_info_<?php echo $weekday;?>_max_cover[]" ></td>
                                                    <td><input type="text" value="<?php echo isset($SeatingInfo[1])?$SeatingInfo[1][$weekday."_largest_party_size"]:"";?>" name="seating_info_<?php echo $weekday;?>_largest_party_size[]" ></td>
                                                    <td><input type="text" value="<?php echo isset($SeatingInfo[1])?$SeatingInfo[1][$weekday."_booking_limit"]:"";?>" name="seating_info_<?php echo $weekday;?>_booking_limit[]" ></td>
                                                    <td><input type="text" value="<?php echo isset($SeatingInfo[1])?$SeatingInfo[1][$weekday."_cover_count"]:"";?>" name="seating_info_<?php echo $weekday;?>_cover_count[]" ></td>
                                                    <td><input type="text" value="<?php echo isset($SeatingInfo[1])?$SeatingInfo[1][$weekday."_point"]:"";?>" name="seating_info_<?php echo $weekday;?>_point[]" ></td>
                                                    <td><input type="text" value="<?php echo isset($SeatingInfo[1])?$SeatingInfo[1][$weekday."_deposit"]:"";?>" name="seating_info_<?php echo $weekday;?>_deposit[]" ></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td>Dinner</td>
                                                    <td><input type="text" value="<?php echo isset($SeatingInfo[2])?$SeatingInfo[2][$weekday."_from"]:"";?>" name="seating_info_<?php echo $weekday;?>_from[]" class="timepicker"></td>
                                                    <td><input type="text" value="<?php echo isset($SeatingInfo[2])?$SeatingInfo[2][$weekday."_to"]:"";?>" name="seating_info_<?php echo $weekday;?>_to[]"  class="timepicker"></td>
                                                    <td><input type="text" value="<?php echo isset($SeatingInfo[2])?$SeatingInfo[2][$weekday."_max_cover"]:"";?>" name="seating_info_<?php echo $weekday;?>_max_cover[]" ></td>
                                                    <td><input type="text" value="<?php echo isset($SeatingInfo[2])?$SeatingInfo[2][$weekday."_largest_party_size"]:"";?>" name="seating_info_<?php echo $weekday;?>_largest_party_size[]" ></td>
                                                    <td><input type="text" value="<?php echo isset($SeatingInfo[2])?$SeatingInfo[2][$weekday."_booking_limit"]:"";?>" name="seating_info_<?php echo $weekday;?>_booking_limit[]" ></td>
                                                    <td><input type="text" value="<?php echo isset($SeatingInfo[2])?$SeatingInfo[2][$weekday."_cover_count"]:"";?>" name="seating_info_<?php echo $weekday;?>_cover_count[]" ></td>
                                                    <td><input type="text" value="<?php echo isset($SeatingInfo[2])?$SeatingInfo[2][$weekday."_point"]:"";?>" name="seating_info_<?php echo $weekday;?>_point[]" ></td>
                                                    <td><input type="text" value="<?php echo isset($SeatingInfo[2])?$SeatingInfo[2][$weekday."_deposit"]:"";?>" name="seating_info_<?php echo $weekday;?>_deposit[]" ></td>
                                                </tr>
                                                <?php
                                                }
                                            ?>

                                        </table>
                                    </div>
                                </div>
                                <div class="clear_h20"></div>
                                <input type="submit" name="btnsavetable" value="Save" class="btn btn-success">
                            </section>
                        </form>
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
    $(function() {
        $('input.timepicker').timepicker();
    });
</script>