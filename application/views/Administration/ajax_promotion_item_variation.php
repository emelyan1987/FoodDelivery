<table style="width:100%;">
<?php
if($divid == 'ajaxvar1')
{
	$VarD = "variation_data1[]";
	$VarP = "variation_price1[]";
}
if($divid == 'ajaxvar2')
{
	$VarD = "variation_data2[]";
	$VarP = "variation_price2[]";
}
if($divid == 'ajaxvar3')
{
	$VarD = "variation_data3[]";
	$VarP = "variation_price3[]";
}
if($divid == 'ajaxvar4')
{
	$VarD = "variation_data4[]";
	$VarP = "variation_price4[]";
}
if($divid == 'ajaxvar5')
{
	$VarD = "variation_data5[]";
	$VarP = "variation_price5[]";
}

$ik = 0;
foreach($itemVariation as $it=> $itemVar):
?>
				   <tr><td></td>
					<td width="37.5%"><?php echo $itemVar->variation_name; ?></td>
					<td><select id="Select4" name="<?php echo $VarD; ?>">
					<?php 
					$data = get_All_Variation_Data($itemVar->id,$item_id);
					foreach($data as $var => $varData):
					?>
					<option value="<?php echo $varData->id; ?>"><?php echo $varData->title; ?></option>
					<?php
					endforeach;
					?>
					</select></td>
                                        <td width="15%" style="text-align: center">Qty:</td><td width="20%"><input id="Text2" type="text" name="<?php echo $VarP; ?>" /></td>
				    </tr>
<?php
$ik++;
endforeach;



if($ik == 0)
{
?>
	<tr><td></td>
					<td width="37.5%">Default Variation</td>
					<td><select id="Select4" name="<?php echo $VarD; ?>">
					
					<option value="DEFAULT111">Default Variation</option>
					
					</select></td>
                                        <td width="15%" style="text-align: center">Qty:</td><td width="20%"><input id="Text2" type="text" name="<?php echo $VarP; ?>" /></td>
				    </tr>
<?php
}
?>				
				    </table>