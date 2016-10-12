<?php
foreach($state as $st => $ta):
?>
	<option value="<?php echo $ta->id; ?>"><?php echo $ta->state_name; ?></option>
<?php
endforeach;
?>