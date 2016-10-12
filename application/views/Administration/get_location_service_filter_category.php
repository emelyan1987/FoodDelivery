<?php
                      foreach($category as $cat => $catdata):
                      ?>
                    <tr><td><?php echo ucwords($catdata->cat_name); ?></td>
		    <td><?php if($catdata->user_id != ''){ echo getOwnerCodeById($catdata->user_id); } ?></td>
			 <td><?php if($catdata->location_id != ''){ echo getOwnerlocationByLId($catdata->location_id); } ?></td>
			 <td><?php if($catdata->service_id == 1){ echo "DELIVERY"; }elseif($catdata->service_id == 2){ echo "CATERING"; }elseif($catdata->service_id == 3){ echo "RESERVATION"; }elseif($catdata->service_id == 4){ echo "PICKUP"; } ?></td>
                        
                        <td align="right"><a href="/delete_item_category/<?php echo $catdata->id; ?>" class="delete">x</a></td>
                    </tr>
                    <?php
                      endforeach;
                    ?>