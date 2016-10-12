<!--<h1>Mataam Payment Information</h1>-->

<form method="post" action="<?php echo $this->config->item('posturl'); ?>" id="myForm">

	<input type="hidden" name="upload" value="1" >
	<input type="hidden" name="return" value="<?php echo $this->config->item('returnurl'); ?>" >
	<input type="hidden" name="cmd" value="_cart" >
	<input type="hidden" name="business" value="<?php echo $this->config->item('business'); ?>" >
	<input type="hidden" name="discount_amount_cart" value="<?php echo $_SESSION['pay_discount']; ?>" />
	

<?php
if($_SESSION['pay_type'] == 1)
{

	$tit = 'Mataam Delivery Order';
}
elseif($_SESSION['pay_type'] == 2)
{

	$tit = 'Mataam Catering Order';
}
if($_SESSION['pay_type'] == 3)
{

	$tit = 'Mataam Reservation Order';
}
if($_SESSION['pay_type'] == 4)
{

	$tit = 'Mataam Pickup Order';
}
?>	
	<input type="hidden" name="item_name_1" value="<?php echo $tit; ?>" >
	<input type="hidden" name="item_number_1" value="<?php echo $_SESSION['pay_order_no']; ?>" >
	<input type="hidden" name="amount_1" value="<?php echo $_SESSION['pay_amount']; ?>" >
	<input type="hidden" name="quantity_1" value="1" >

	
	<!--<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/x-click-but6.gif" >-->
</form>


<?php
if(($_SESSION['pay_method'] == 4) && ($_SESSION['pay_amount'] != '') && ($_SESSION['pay_amount'] != 0))
{
?>

<script type="text/javascript">
	document.getElementById("myForm").submit();
</script>
<?php
}


?>