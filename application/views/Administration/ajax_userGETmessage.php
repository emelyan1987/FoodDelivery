<!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
           
	  <form action="" method="post">
            <section class="content">
                <div class="row">
				
				
                    <div class="col-md-8">
                   
                   <div class="drawingSection">
                   
                              <div id="getmsg"> </div>
                              
						
                     			<?php echo form_open_multipart('') ?>
					<?php   foreach($allmsg as $chat => $username): ?>
					
					<p style="background: beige;padding: 5px;border-radius: 5px;width: 100%;"> 
					<?php if($username->sender_type==1) { echo "<span style='color:red;'>Admin</span>"; } else { echo "<span style='color:blue;'>User</span>"; } ?> <span> <?php echo $username->message; ?></span> </p>
					
					
					<?php endforeach ?> 
					  
					  </form>         
								   
                                </div>
                    </div>
					
										
					
                 </div>
            </section>
</form>
          </div><!-- /.content-wrapper -->
          
  </div>

</div>

