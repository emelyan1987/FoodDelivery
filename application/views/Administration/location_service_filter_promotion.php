<?php foreach($promotion as $pr => $promo): 

                    ?>                    
                               
                    <tr>
                        <td><?php echo ucwords($promo->name); ?></td>
                        <!--<td><?php echo getOwnerCodeById($promo->user_id); ?></td>-->
                        <td><?php $odID = getOwnerCodeById($promo->user_id); echo getRestroNameByOwnerCode($odID); ?></td>
                        <td><?php echo getOwnerlocationByLId($promo->location_id); ?></td>
                        <td><?php if($promo->service_id == 1){ echo "DELIVERY"; }elseif($promo->service_id == 2){ echo "CATERING"; }elseif($promo->service_id == 3){ echo "RESERVATION"; }elseif($promo->service_id == 4){ echo "PICKUP"; } ?></td>
                        <td> KD <?php echo $promo->price;?></td>
                        <td><?php echo $promo->from_date;?></td>
                        <td><?php echo $promo->to_date;?></td>
                       <td><a href="/edit_promotion/<?php echo $promo->id; ?>" class="edit"><img src="<?PHP echo base_url();  ?>assets/Administration/images/icon/edit.png" alt="" />Edit</a>
                            <a href="/delete_promotion/<?php echo $promo->id; ?>/show_promotion" class="delete confirmation" >x</a>

                       </td>
                    </tr>
                    <?PHP

                    endforeach;

                    ?>