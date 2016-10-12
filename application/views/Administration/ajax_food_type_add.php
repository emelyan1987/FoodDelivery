                            <?php
                            foreach($food_type_list as $ks => $vs):
                            ?>
                           <div class="col-md-3">
                           	<label class="checkbox" ><input type="checkbox" name="food_type[]" value="<?php echo $vs->id; ?>"> 
                            <?php echo $vs->food_title; ?></label>  </div>
                            <?php
                            endforeach;
                            ?>