<?php
            foreach($item_catlist as $it => $itemCat):
            ?>
              <div class="col-md-6"><input type="checkbox" name="category" value="<?php echo $itemCat->id; ?>" onclick="getCheckedCheckboxesFor('category')"> <?php echo ucwords($itemCat->cat_name); ?></div>
            <?php 
            endforeach;
            ?>