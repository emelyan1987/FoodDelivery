<ul>
    <?php
        foreach($area_list as $cu => $list):
        ?>
        <li onclick='citychangeintxt("<?php echo htmlspecialchars($list->city_name); ?>,<?php echo htmlspecialchars($list->name); ?>","<?php echo $divid; ?>","<?php echo $list->id; ?>")'><span ><?php echo $list->city_name; ?>,<?php echo $list->name; ?></span></li>

        <?php
            endforeach;
    ?>  

</ul>