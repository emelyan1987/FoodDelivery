<?php
            foreach($item_catlist as $it => $itemCat):
            ?>
              <div class="col-md-6"><input type="checkbox" name="category" value="<?php echo $itemCat->id; ?>" onclick="getCheckedCheckboxesFor('category')" <?php if(restroCateChkByLocation($itemCat->id,$restro_id,$location_id,$service_id) == 1){ echo "checked"; } ?>> <?php echo ucwords($itemCat->cat_name); ?></div>
            <?php 
            endforeach;
            ?>