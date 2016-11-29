<ul>
    <?php
        foreach($area_list as $cu => $list):
        ?>
        <li onclick="citychangeintxt('<?php echo addslashes($list->city_name); ?>,<?php echo addslashes($list->name); ?>','<?php echo $divid; ?>','<?php echo $list->id; ?>')"><span ><?php echo $list->city_name; ?>,<?php echo $list->name; ?></span></li>

        <?php
            endforeach;
    ?>  

</ul>