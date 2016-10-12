<div class="heading" style="    background: #D31E03;">Pending Orders</div>
                        <br>
                        <div class="table-responsive">
                            <table id="example1"  class="table table-striped table-bordered table_design">
                                <thead>
                                    
                                    <tr >
                                        <th>ORDER NO.<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>LOCATION NAME<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>CUSTOMER<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>DATE<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <th>TIME<img src="/assets/Administration/images/sortIcon.png" class="sortingImage" alt=""></th>
                                        <!--<th>AMOUNT</th>-->
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
                                        <!--<td>
                                            
                                                <?php if($ord->status == 1){ echo '<div class="pending">Pending</div>'; } ?>
                                                <?php if($ord->status == 2){ echo '<div class="delivered" style="border: 1px solid #5784D6;">Under Process</div>'; } ?>
                                                <?php if($ord->status == 3){ echo '<div class="delivered">Completed</div>'; } ?>
                                                <?php if($ord->status == 4){ echo '<div class="cancelled">Cancelled</div>'; } ?>
                                                
                                            
                                        </td>-->
                                        <td><?php echo getuseremail($ord->user_id); ?></td>
                                        <td><?php echo $ord->date; ?></td>
                                        <td><?php echo $ord->time; ?></td>
                                        <!--<td>KD <?php echo $ord->total + $ord->delivery_charges; ?></td>-->
                                        <td><?php getUserMobileNo($ord->user_id); ?></td>
                                        <td><a href="/restro_reservation_order_view/<?php echo $ord->id; ?>/"><i class="fa fa-eye"></i></a></td>
                                    </tr>
                                    <?php
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>