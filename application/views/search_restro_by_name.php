<ul>
		<?php
		foreach($restro_list as $rest => $restro):
		?>
				<li> 
					<a href="/<?php echo $r_url; ?>/<?php echo $restro->id; ?>/<?php echo $restro->location_id; ?>" >
					<div class="row"> 
					<!--<div class="col-md-3"> 
						<?php
	                    if($restro->restaurant_logo != '')
	                    {
	                    ?>
	                    <img class="img-responsive" alt="" src="<?php $img = explode('public_html',$restro->restaurant_logo); 
	                	echo $img[1];?>">
	                    <?php
	                    }
	                    else
	                    {
	                    ?>
	                    <img class="img-responsive" alt="" src="/assets/Customer/img/icon/bottomIcon2.png">
	                    <?php
	                    }
	                    ?>
                    </div>-->
                    <div class="col-md-12"> 
                    	<!--<?php 
                                                if($restro->status == 1){
                                                    $stl = 'class="opened"';
                                                    $status_title = "Open";
                                                }
                                                elseif($restro->status == 2)
                                                {
                                                    $stl = 'class="busy"';
                                                    $status_title = "Busy";
                                                }
                                                else
                                                {
                                                    $stl = 'class="close"';
                                                    $status_title = "Close";
                                                }
                                                 ?>
                                                <span <?php echo $stl; ?>></span> <?php echo $status_title; ?>
                                               <br>-->
                    	<?php echo ucwords($restro->restro_name); ?>(<span style="font-size:11px;"><?php echo ucwords($restro->location_name); ?></span>)
                	</div>
                </div>
                </li>
		<?php
		endforeach;
		?>

</ul>