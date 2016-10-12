

<?php
$time = $time;
$timestamp1 = strtotime($time) - 60*60 - 60*60;
$timestamp2 = strtotime($time) - 60*60;
$timestamp3 = strtotime($time) + 60*60;
$timestamp4 = strtotime($time) + 60*60 + 60*60;

$time1 = date('h:i A', $timestamp1);
$time2 = date('h:i A', $timestamp2);
$time3 = date('h:i A', $timestamp3);
$time4 = date('h:i A', $timestamp4);

?>
<div class="col-md-12" >
                                                    <div class="col-md-3">
                                                        <input type="radio" name="booking_time" value="<?php echo $time1; ?>" 
                                                        <?php
                                                        $booked = chkTableBookedOnTime($time1);
                                                        if($booked != 0 )
                                                        {
                                                            echo "disabled";
                                                        }
                                                        ?>                                                  
                                                         > 
                                                         
                                                        <?php 
                                                        if($booked != 0 )
                                                        {
                                                            echo "<span style='color:red'>".$time1."</span>";
                                                        }
                                                        else
                                                        {
                                                            echo $time1; 
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="radio" name="booking_time" value="<?php echo $time2; ?>" 
                                                        <?php
                                                        $booked = chkTableBookedOnTime($time2);
                                                        if($booked != 0 )
                                                        {
                                                            echo "disabled";
                                                        }
                                                        ?> 
                                                        > 

                                                        <?php 
                                                        if($booked != 0 )
                                                        {
                                                            echo "<span style='color:red'>".$time2."</span>";
                                                        }
                                                        else
                                                        {
                                                            echo $time2; 
                                                        }
                                                        ?>
                                                       
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="radio" name="booking_time" value="<?php echo $time; ?>" 
                                                        <?php
                                                        $booked = chkTableBookedOnTime($time);
                                                        if($booked != 0 )
                                                        {
                                                            echo "disabled";
                                                        }
                                                        ?> 
                                                        > 

                                                        <?php 
                                                        if($booked != 0 )
                                                        {
                                                            echo "<span style='color:red'>".$time."</span>";
                                                        }
                                                        else
                                                        {
                                                            echo $time; 
                                                        }
                                                        ?>
                                                        
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="radio" name="booking_time" value="<?php echo $time3; ?>" 
                                                        <?php
                                                        $booked = chkTableBookedOnTime($time3);
                                                        if($booked != 0 )
                                                        {
                                                            echo "disabled";
                                                        }
                                                        ?> 
                                                    > 
                                                        <?php 
                                                        if($booked != 0 )
                                                        {
                                                            echo "<span style='color:red'>".$time3."</span>";
                                                        }
                                                        else
                                                        {
                                                            echo $time3; 
                                                        }
                                                        ?>
                                                    </div>




</div>

                                                    <?php
                                                        /*$booked = chkTableBookedOnTime($time1);
                                                        if($booked != 0 )
                                                        {
                                                            echo "disabled";
                                                        }*/
                                                        ?>

