<div class="heading">Pending Orders</div>
                        <div class="table-responsive">
                            <table id="example1" class="table table-striped table-bordered table_design">
                                <thead>
                                    
                                    <tr>
                                        <th>ORDER NO.<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>LOCATION NAME<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>PAYMENT STATUS<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <!--<th>SERVICE<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>-->
                                        <th>CUSTOMER NAME<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>PRICE<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>ORDER TIME<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>CONTACT<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>DETAILS<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach($order as $or => $ord):
                                    ?>
                                    <tr>
                                        <td>#<?php echo $ord->order_no; ?></td>
                                        <td><?php echo getOwnerlocationByLId($ord->restro_location_id); ?></td>
                                        <td><div class="pending">Pending</div></td>
                                        
                                        <!--<td>
                                            <?php if($ord->status == 1){ echo '<div class="pending">Pending</div>'; } ?>
                                            <?php if($ord->status == 2){ echo '<div class="delivered" style="border: 1px solid #5784D6;">Under Process</div>'; } ?>
                                            <?php if($ord->status == 3){ echo '<div class="delivered">Completed</div>'; } ?>
                                            <?php if($ord->status == 4){ echo '<div class="cancelled">Cancelled</div>'; } ?>
                                                
                                           
                                        </td>-->
                                        <!--<td>service1</td>-->
                                        <td><?php echo getuseremail($ord->user_id); ?></td>
                                        <!--<td><?php echo $ord->delivery_date; ?></td>-->
                                         <td>KD <?php echo $ord->total + $ord->delivery_charges; ?></td>
                                        <td>
                                            <?php if($ord->status == 1){ echo '<div class="pending">'.$ord->delivery_time.'</div>'; } ?>
                                            <?php if($ord->status == 2){ echo '<div class="delivered" style="border: 1px solid #5784D6;">'.$ord->delivery_time.'</div>'; } ?>
                                            <?php if($ord->status == 3){ echo '<div class="delivered">'.$ord->delivery_time.'</div>'; } ?>
                                            <?php if($ord->status == 4){ echo '<div class="cancelled">'.$ord->delivery_time.'</div>'; } ?>
                                         </td>
                                       
                                        <!--/restro_delivery_view/<?php //echo $ord->id; ?>-->
                                         <td><?php getUserMobileNo($ord->user_id); ?></td>
                                        <td><a href="/delivery_order_view/<?php echo $ord->id; ?>/"><i class="fa fa-eye"></i></a>
                                          &nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" onClick="delete_order(this.id,1)" id="<?PHP echo $ord->id; ?>" class="delete" >x</a>
                                        </td>
                                    </tr>
                                    <?php
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>

                            

                        </div>