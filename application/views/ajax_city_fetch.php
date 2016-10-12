<?php
foreach($city as $ci => $it):
?>
	<option value="<?php echo $it->id; ?>"><?php echo $it->city_name; ?></option>
<?php
endforeach;
?>
