<?php
if(isset($item_list))
{
?>
<option value="0">-Select Item-</option>
					<?php
					foreach($item_list as $it=>$item):
					?>
					<option value="<?php echo $item->id; ?>"><?php echo $item->item_name; ?></option>
					<?php
					endforeach;
					?>
			
			
<?php
}

?>
