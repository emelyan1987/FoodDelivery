<ul>
	<?php
	foreach($cuisin_list as $cu => $list):
	?>
                                                <li onclick='valuechangeintxt("<?php echo $list->name; ?>","<?php echo $divid; ?>")'><span ><?php echo $list->name; ?></span></li>
                                            
    <?php
    endforeach;
    ?>     
    <?php
	foreach($restro_list as $cu => $list):
	?>
                                                <li onclick='valuechangeintxt("<?php echo $list->restro_name; ?>","<?php echo $divid; ?>")'><span ><?php echo $list->restro_name; ?></span></li>
                                            
    <?php
    endforeach;
    ?>
    <?php
	foreach($food_list as $cu => $list):
	?>
                                                <li onclick='valuechangeintxt("<?php echo $list->food_title; ?>","<?php echo $divid; ?>")'><span ><?php echo $list->food_title; ?></span></li>
                                            
    <?php
    endforeach;
    ?>
    
</ul>