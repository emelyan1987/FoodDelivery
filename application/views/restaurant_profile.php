<?PHP
    $this->load->view("includes/Customer/header");
    $this->load->helper('customer_helper');
?>
<style>
    .loginArea {
        padding: 0 20px;
        margin: 10px;
        border: 1px solid #eee;
        border-radius: 10px;
    }
    .signText{
        font-weight: normal;
        text-transform: capitalize;
        color: #373737;
        font-family:Tahoma, Geneva, sans-serif;
        font-size:25px;
    }
    .signTextone{font-family:"Trebuchet MS", Arial, Helvetica, sans-serif; font-size:23px; color:#6A6A6A; font-weight:bold;}
    .text-forgot{
        text-decoration: underline;
        color: #888 !important;
        font-size: 18px;
    }
    .text-new-user{
        text-decoration: none;
        color: #73B720 !important;
        font-size: 18px;
        font-weight:normal;
        font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
    }
    .new-lable{
        font-size: 14px;
        font-weight: normal;
    }
    input.form-control{
        border: 1px solid #333;
    }
    .list-button{
        color: #fff !important;
        padding: 15px 30px !important;
        font-weight: 500 !important;
    }
    .half-line{
        margin-top: 20px;
        margin-bottom: 20px;
        border: 0;
        border-top: 2px solid #eee;
        width: 50%;
    }
    .res-logo{
        width: 200px !important;
        height: 200px !important;
        max-width: 200px !important;
        max-height: 200px !important;
        margin: 0 auto !important;
    }
</style>
<script type="text/javascript">
    function customRadio(radioName){
        var radioButton = $('input[name="'+ radioName +'"]');
        $(radioButton).each(function(){
            $(this).wrap( "<span class='custom-radio'></span>" );
            if($(this).is(':checked')){
                $(this).parent().addClass("selected");
            }
        });
        $(radioButton).click(function(){
            if($(this).is(':checked')){
                $(this).parent().addClass("selected");
            }
            $(radioButton).not(this).each(function(){
                $(this).parent().removeClass("selected");
            });
        });
    }
    $(document).ready(function (){
        customRadio("gender");
        customRadio("search-engine");
        customRadio("confirm");
    })
</script>
<?php
    echo $map['js'];
?>
<div class="container">
<div class="row">
    <div class="margin20"></div>
    <div class="row">
        <div class="col-md-4">
            <div class="row">
                <div class="col-sm-3 pull-right">
                    <?php
                        if ($restaurant->status == 1) {
                            $stl = 'class="opened"';
                            $status_title = "Open";
                        } elseif ($restaurant->status == 2) {
                            $stl = 'class="busy"';
                            $status_title = "Busy";
                        } else {
                            $stl = 'class="close"';
                            $status_title = "Close";
                        }
                    ?>
                    <span <?php echo $stl;?>></span> <?php echo $status_title;?>
                </div>
                <div class="col-sm-12">
                    <img class="img-responsive res-logo" alt="" src="<?php if ($restaurant->restaurant_logo != '') {getImagePath($restaurant->restaurant_logo);}?>">
                </div>
                <br>
                <div class="col-sm-12">
                    <?php
                        $restro_imgs = get_restro_allImage($restaurant->id);
                        foreach ($restro_imgs as $ResImg => $resimg):
                        ?>
                        <div class="col-xs-<?php echo 12/count($restro_imgs);?>">
                            <br>
                            <img class="img-responsive" alt="" src="<?php if ($resimg->restro_images != '') {getImagePath($resimg->restro_images);}
                                ?>" >
                        </div>
                        <?php
                            endforeach;
                    ?>
                </div>
                <div class="col-sm-12">
                    <h4 class="text-center"><?php echo ucwords($restaurant->restro_name);?></h4>
                </div>
                <div class="col-sm-12">
                    <div class="row">
                        <?php if ($restaurant->restro_status&2 != 0): ?>
                            <img src="/assets/Customer/img/icon/love.png" alt="">
                            <?php endif?>
                        <?php if ($restaurant->restro_status&4 != 0): ?>
                            <img src="/assets/Customer/img/icon/bow.png" alt="">
                            <?php endif?>
                    </div>
                    <div class="row">
                        <label class="list-label">Cuisines:</label>
                        <label class="list-data">&nbsp;
                            <?php
                                echo implode(', ', $restaurant->cuisines);
                            ?>
                        </label>
                    </div>
                    <div class="row">
                        <label class="list-label">Food Types:</label>
                        <label class="list-data">&nbsp;
                            <?php
                                echo implode(', ', $restaurant->food_types);
                            ?>
                        </label>
                    </div>
                    <div class="row">
                        <label class="list-label">Category:</label>
                        <label class="list-data">&nbsp;
                            <?php
                                echo implode(', ', $restaurant->categories);
                            ?>
                        </label>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="row">
                        <label class="list-label">Locations:</label>
                    </div>
                    <label class="list-data">&nbsp;
                        <?php
                            foreach($restaurant->locations as $loc) {
                                echo '<div class="row"><a href="/restaurant_profile/'.$restaurant->id.'/'.$loc->id.'">'.$loc->location_name.'</a></div>';
                            }
                        ?>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="row">
                <?php
                    echo $map['html'];
                ?>
            </div>
            <div class="margin20"></div>
            <div class="row">
                <?php 
                    if(isset($location)) {       
                        echo '<h3>' . $location->location_name . '</h3>';              
                        echo '<h5>'.$location->street.' '.$location->block.' '.$location->building.', '.$location->city_name.' '.$location->area_name.' '.'</h5>';
                        if(isset($location->services)) {
                            foreach($location->services as $service) {
                                switch($service->id){
                                    case 1:
                                        $class_name = 'tab-icon';
                                        break;
                                    case 2:
                                        $class_name = 'tab-icon1';
                                        break;
                                    case 3:
                                        $class_name = 'tab-icon3';
                                        break;
                                    case 4:
                                        $class_name = 'tab-icon2';
                                        break;
                                }
                            ?> 
                            <div style="margin:20px;">
                                <div style="margin:10px;padding:10px;border-bottom: 1px solid #ddd;"><span class="<?php echo $class_name;?>"></span> <?php echo $service->name;?></div>
                                <?php 
                                    if($service->id==1 || $service->id==2) {
                                    ?>
                                    <div class="row">
                                        <label class="list-label">Min Order:</label>
                                        <label class="list-data">&nbsp;
                                            KD <?php echo number_format($service->working_hour->min_order, 2);?>
                                        </label>
                                    </div>
                                    <div class="row">
                                        <label class="list-label">Order Time:</label>
                                        <label class="list-data">&nbsp;
                                            <?php 
                                                if ($service->working_hour->order_days != 0) {
                                                    echo $service->working_hour->order_days . " Day ";
                                                }
                                                if ($service->working_hour->order_hour != 0) {
                                                    echo $service->working_hour->order_hour . " Hour ";
                                                }
                                                if ($service->working_hour->order_minitue != 0) {
                                                    echo $service->working_hour->order_minitue . " Min. ";
                                                }
                                            ?>
                                        </label>
                                    </div>
                                    <?php  
                                    }
                                ?>

                                <?php 
                                    if(isset($service->payment) && isset($service->payment->method_type)) {
                                    ?>
                                    <div class="row">
                                        <label class="list-label">Payment:</label>
                                        <label class="list-data">&nbsp;
                                            <?php
                                                $payArray = explode(',', $service->payment->method_type);
                                                if (in_array(1, $payArray)) {
                                                    echo '<img class="" alt="" src="/assets/Customer/img/cash.png">';
                                                }
                                                if (in_array(2, $payArray)) {
                                                    echo '<img class="" alt="" src="/assets/Customer/img/knet.png">';
                                                }
                                                if (in_array(3, $payArray)) {
                                                    echo '<img class="" alt="" src="/assets/Customer/img/card.png">';
                                                }
                                                if (in_array(4, $payArray)) {
                                                    echo '<img class="" alt="" src="/assets/Customer/img/paypal.png">';
                                                }
                                            ?>
                                        </label>
                                    </div>
                                    <?php  
                                    }
                                ?>

                                <?php 
                                    if($service->id==1 || $service->id==2) {
                                    ?>
                                    <div class="row">
                                        <label class="list-label">Charge Amount per Area:</label>                                       
                                            <?php 
                                                if (isset($service->areas)) {
                                                    ?>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Area Name</th>
                                                        <th>Charge Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach($service->areas as $i=>$area) {
                                                    ?>
                                                    <tr>
                                                        <th scope="row"><?php echo ($i+1);?></th>
                                                        <td><?php echo $area['area_name'];?></td>
                                                        <td><?php echo $area['charge_amount'];?></td>
                                                    </tr>
                                                    <?php
                                                    } 
                                                    ?>    
                                                </tbody>                                                
                                            </table>
                                                    <?php  
                                                }
                                            ?>
                                    </div>
                                    <?php  
                                    }
                                ?>

                                    <div class="row">
                                        <label class="list-label">Working Hour:</label>                                       
                                            <?php 
                                                if (isset($service->working_hour)) {
                                                    ?>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Weekday</th>
                                                        <th>From</th>
                                                        <th>To</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $weekdays = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday');
                                                    foreach($weekdays as $i=>$weekday) {
                                                    ?>
                                                    <tr>
                                                        <th scope="row"><?php echo ucfirst($weekday);?></th>
                                                        <td><?php echo $service->working_hour->{$weekday.'_from'};?></td>
                                                        <td><?php echo $service->working_hour->{$weekday.'_to'};?></td>
                                                    </tr>
                                                    <?php
                                                    } 
                                                    ?>    
                                                </tbody>                                                
                                            </table>
                                                    <?php  
                                                }
                                            ?>
                                    </div>

                                    

                                <?php 
                                    if($service->id==3) {
                                    ?>
                                    <div class="row">
                                        <label class="list-label">Seating Hour:</label>                                       
                                            <?php 
                                                if (isset($service->seating_infos)) {
                                                    $seating_infos = $service->seating_infos;
                                                    ?>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Weekday</th>
                                                        <th>Category</th>
                                                        <th>From</th>
                                                        <th>To</th>
                                                        <th>Point</th>
                                                        <th>Deposit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $weekdays = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday');
                                                    foreach($weekdays as $i=>$weekday) {
                                                    ?>
                                                    <tr>
                                                        <th scope="row" rowspan="3"><?php echo ucfirst($weekday);?></th>
                                                        <td>Breakfast</td>
                                                        <td><?php echo isset($seating_infos[1])?$seating_infos[1]->{$weekday.'_from'}:"";?></td>
                                                        <td><?php echo isset($seating_infos[1])?$seating_infos[1]->{$weekday.'_to'}:"";?></td>
                                                        <td><?php echo isset($seating_infos[1])?$seating_infos[1]->{$weekday.'_point'}:"";?></td>
                                                        <td><?php echo isset($seating_infos[1])?$seating_infos[1]->{$weekday.'_deposit'}:"";?></td>
                                                    </tr>
                                                    <tr>                                                        
                                                        <td>Lunch</td>
                                                        <td><?php echo isset($seating_infos[2])?$seating_infos[2]->{$weekday.'_from'}:"";?></td>
                                                        <td><?php echo isset($seating_infos[2])?$seating_infos[2]->{$weekday.'_to'}:"";?></td>
                                                        <td><?php echo isset($seating_infos[2])?$seating_infos[2]->{$weekday.'_point'}:"";?></td>
                                                        <td><?php echo isset($seating_infos[2])?$seating_infos[2]->{$weekday.'_deposit'}:"";?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Dinner</td>
                                                        <td><?php echo isset($seating_infos[3])?$seating_infos[3]->{$weekday.'_from'}:"";?></td>
                                                        <td><?php echo isset($seating_infos[3])?$seating_infos[3]->{$weekday.'_to'}:"";?></td>
                                                        <td><?php echo isset($seating_infos[3])?$seating_infos[3]->{$weekday.'_point'}:"";?></td>
                                                        <td><?php echo isset($seating_infos[3])?$seating_infos[3]->{$weekday.'_deposit'}:"";?></td>
                                                    </tr>
                                                    <?php
                                                    } 
                                                    ?>    
                                                </tbody>                                                
                                            </table>
                                                    <?php  
                                                }
                                            ?>
                                    </div>
                                    <?php  
                                    }
                                ?>
                            </div>
                            <?php
                            }
                        }
                    }
                ?>
            </div>
        </div>
    </div>
    <div class="margin20"></div>
</div>
<div class="advert">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <img class="img-responsive center-block" alt="" src="/assets/Customer/img/add.jpg"/>
            </div>
        </div>
    </div>
</div>

<?PHP
    $this->load->view("includes/Customer/footer");
?>