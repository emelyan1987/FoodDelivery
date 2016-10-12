<?php
    foreach($tableinfo as $ta => $ab):
    ?>
<!--    <div class="form-group">
        <label for="exampleInputPassword1">Location</label>
        <select class="form-control" name="location_id" require>
            <option value="">-Select Location-</option>
            <?php
                foreach($Locations as $loc => $locData):
                ?>
                <option value="<?php echo $locData->id; ?>" <?php if($locData->id == $ab->location_id){ echo "selected"; } ?>><?php echo $locData->location_name; ?></option>
                <?php
                    endforeach;
            ?>

        </select>
        <span style="color:red"><?PHP  echo form_error('location_id'); ?></span>

    </div>
-->    <div class="form-group">
        <label for="exampleInputPassword1">Table No. / Name</label>
        <input type="text" class="form-control" name="table_no" placeholder="Enter Item Name" require value="<?php echo $ab->table_no; ?>">
        <span style="color:red"><?PHP  echo form_error('table_no'); ?></span>

    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">User Limit</label>
        <input type="number" class="form-control" name="user_limit" placeholder="Enter Item Name" min="1" max="10" require value="<?php echo $ab->user_limit; ?>">
        <span style="color:red"><?PHP  echo form_error('user_limit'); ?></span>

    </div>

    <!--<div class="form-group">
    <label for="exampleInputPassword1">Price</label>
    <input type="text" class="form-control" id="exampleInputPassword1" name="price" placeholder="Enter Price" require value="<?php echo $ab->price; ?>">
    <span style="color:red"><?PHP  echo form_error('price'); ?></span>

    </div>-->
    <div class="form-group">
        <label for="exampleInputPassword1">Description</label>
        <textarea class="form-control" id="exampleInputPassword1" name="description" ><?php echo $ab->description; ?></textarea>


    </div>


    <div class="form-group">
        <label for="exampleInputPassword1">Table Status</label>
        <Select class="form-control" name="status" require>
            <option value="1" <?php if($ab->status == 1){ echo "selected"; } ?>>Available</option>
            <!--<option value="2" <?php if($ab->status == 2){ echo "selected"; } ?>>Booked</option>-->
            <option value="0" <?php if($ab->status == 0){ echo "selected"; } ?>>Not Available</option>
        </select>
        <span style="color:red"><?PHP  echo form_error('status'); ?></span>

    </div>
    <input type="hidden" name="tbleID" id="tbleID" value="<?php echo $ab->id; ?>"  >
    <input type="submit" name="btnEditTable" value="Edit Table" class="btn btn-success">

    <?php
        endforeach;
?>