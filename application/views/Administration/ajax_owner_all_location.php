<option value="">-Select Location-</option>
<?php
foreach($location_list as $lo => $list):
if($list->location_name != '')
{
?>
	<option value="<?php echo $list->id; ?>"><?php echo ucwords($list->location_name); ?></option>
<?php
}
endforeach;
?>