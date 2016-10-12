<option value="">-Select Service-</option>
<?php
foreach($service_list as $lo => $list):
	
?>
	<option value="<?php echo $list->id; ?>"><?php echo ucwords($list->cat_name); ?></option>
<?php
endforeach;
?>