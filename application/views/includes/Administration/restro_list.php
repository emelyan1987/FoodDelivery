<?php
    //print_r($restro_list);

?>
<form action="" method="post">
<div class="col-md-9">
<select class="form-control" name="restro_id">
  <option value="0">Select Retaurant</option>
  <?PHP
    foreach($restro_list as $ks=>$vs)
    {
       echo "<option value='".$vs->id."'>".ucwords($vs->restro_name)."</option>";
    }
  ?>
</select>
</div>
<div class="col-md-3">
<input type="submit" name="btnorderSearch" value="Search" class="btn btn-success">
</div>
</form>