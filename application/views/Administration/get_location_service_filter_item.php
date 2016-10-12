<?php foreach($item_list as $ks => $vs): 

                    ?>                    
                               
                    <tr>
                       <td><?php if($vs->user_id != ''){ echo getOwnerCodeById($vs->user_id); } ?></td>
                       <td><?php if($vs->location_id != ''){ echo getOwnerlocationByLId($vs->location_id); } ?></td>
                       <td><?php if($vs->service_id == 1){ echo "DELIVERY"; }elseif($vs->service_id == 2){ echo "CATERING"; }elseif($vs->service_id == 3){ echo "RESERVATION"; }elseif($vs->service_id == 4){ echo "PICKUP"; } ?></td>
                        <td><?php echo ucwords($vs->item_name); ?></td>
                        <td>
                      <?php
                      if($vs->image != '')
                      {
                      ?>

                          <img src="<?php $img = explode('public_html',$vs->image); 
                        echo $img[1];?>" height="60">
                      <?php
                      }
                      ?></td>
                        <td> KD <?php echo $vs->item_price;?></td>
                        <td><?php 
                        $allCatid = getcatByItem($vs->id);
                        $i = 1;
                        foreach($allCatid as $item => $ImId):
                          if($i != 1)
                          {
                            echo " , ";
                          }
                          
                          getCategoryName($ImId->category_id);
                        $i++;
                        endforeach;
                        ?></td>
                        <!--<td><?php //echo $vs->item_description; ?></td>-->
                        <td><?php if($vs->status==1) { echo "<span class='text-green'>Active</span>"; } else { echo "<span class='text-red'>Deactive</span>"; } ?>
                        </td>
                        <td>
                          
                          <a href="/edit_menu_item/<?php echo $vs->id; ?>" class="edit border-gray padding_less" style="float:left;"><i class="fa fa-pencil text-blue" aria-hidden="true"></i></a>
                          
                          <a href="/delete_item/<?php echo $vs->id; ?>" class="delete">x</a>
                        </td>
                        
                    </tr>
                    <?PHP

                    endforeach;

                    ?>