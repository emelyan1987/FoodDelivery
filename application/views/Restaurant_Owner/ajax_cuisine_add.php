<?php
                            foreach($cuisin as $cu => $ui):
                            ?>
                           <div class="col-md-3">
                           	<label class="checkbox" ><input type="checkbox" name="resto_cuisine[]" value="<?php echo $ui->id; ?>"> 
                            <?php echo $ui->name; ?>  </label></div>
                            <?php
                            endforeach;
                            ?>