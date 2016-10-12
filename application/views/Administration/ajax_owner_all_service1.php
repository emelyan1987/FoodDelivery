<option value="">-Select Service-</option>
<?php
foreach($service_list as $lo => $list):
	if($list->id != 3)
	{
?>
	<option value="<?php echo $list->id; ?>"><?php echo ucwords($list->cat_name); ?></option>
<?php
	}
endforeach;
?>