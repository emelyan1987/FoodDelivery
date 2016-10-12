
<div class="table-responsive">
    <table class="table bg-gray-light tbl" style="width:100%;">
        <tr><td>Date: </td><td></td></tr>
        <tr><td style="padding-top: 13px;width:90px;">Date From:</td>
            <td><input id="datepicker" type="text" /></td>
            <td style="padding-top: 13px;">To:</td>
            <td><input id="datepicker1" type="text" /></td>
            <td style="padding-top: 13px;width:90px;">Sales By:</td>
            <td><select id="Select1" ><option>Item Name</option>
                    <?php
                        foreach ($item_list as $itm => $it):
                        ?>
                        <option value="<?php echo $it->id;?>"><?php echo ucwords($it->item_name);?></option>
                        <?php
                            endforeach;
                    ?>

                </select></td>
            <td style="padding-top: 13px;">Area:</td>
            <td><select id="Select2" >
                    <option>-Select-</option>
                    <?php
                        foreach ($area_list as $area => $ar):
                        ?>
                        <option value="<?php echo $ar->id;?>"><?php echo ucwords($ar->name);?></option>
                        <?php
                            endforeach;
                    ?>
                </select></td>
            <td><a href="" class="btn bg-green">Generate Report</a></td></tr>
    </table>
</div>
<div class="row">
    <div class="col-md-12">
        <a href="/reports/" class="btn bg-green" style="padding:10px;">Delivery</a>&nbsp;&nbsp;
        <a href="/catring_reports/" class="btn bg-yellow" style="padding:10px;">Catering</a>&nbsp;&nbsp;
        <a href="/reservation_reports/" class="btn bg-red" style="padding:10px;">Reservation</a>&nbsp;&nbsp;
        <a href="/pickup_reports/" class="btn bg-aqua" style="padding:10px;">Pickup</a>&nbsp;&nbsp;
    </div>
                    </div>