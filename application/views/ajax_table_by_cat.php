<div class="row">
                                	<?php
                                	foreach($restro_tables as $it => $TE):
                                	?>
                                    <div class="col-md-3">
                                        <div class="border">
                                            <div class="col-md-12">
                                                <div class="col-md-12 col-sm-6">
                                                    <div class="row text-center" >
                                                        <h4><?php echo $TE->table_no; ?></h4>
                                                       
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-sm-6">
                                                    <div class="col-md-8">User Limit :</div>
                                                    <div class="col-md-4"><?php echo $TE->user_limit; ?></div>
                                                </div>
                                                <div class="col-md-12 col-sm-6 text-center">

    <a class="btn btn-danger" href="/view_reservation_restro_table/<?php echo $ES->id; ?>/<?php echo $TE->id; ?>" >Available</a>
    
              
                                                    <div class="menuList">
                                                        <span class="menuListPT"></span>
                                                        
                                                        <img class="img-responsive" src="/assets/Customer/img/icon/bow.png" alt="">
                                                        <img class="img-responsive" src="/assets/Customer/img/icon/love.png" alt="">
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="margin20"></div>
                                    </div>
                                    <?php
                                    endforeach;
                                    ?>
                                    
                                </div>