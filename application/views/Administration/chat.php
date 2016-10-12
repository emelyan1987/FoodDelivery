<?PHP
  $this->load->view("includes/Administration/header"); 
  $this->load->view("includes/Administration/sidebar");
  ?>

<!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
           
	  <form action="" method="post">
            <section class="content">
                <div class="row">
				
				
                    <div class="col-md-8">
                   
                   <div class="drawingSection">
                   
                              <div id="getmsg"> </div>
                              
					<label>Input Message</label>		
                     			<?php echo form_open_multipart('') ?>
					  
					  <textarea class="form-control" rows="4" name="message" id="message"></textarea>
					  <span style="color:red"> </span></br>
					  <input type="hidden" value="" name="usid" id="usid" >
					  
					  	<button type="button" onClick="showusermsg();" class="btn btn-default">Submit</button>				  
					  </form>         
								   
                                </div>
                    </div>
                    
				
					
								
					<div class="col-md-4">
                   
                  		<?php
                                $i = 1;
                                foreach($chatuser as $chat => $username)
                                {
                                ?>
                                
				  <span onclick='showuserid("<?php echo $username->id; ?>");'><div><?php echo $username->chatname; ?></div></span>
				  
				  <?php
                                $i++;
                                }
    
                                ?>
                    </div>
                 </div>
            </section>
</form>
          </div><!-- /.content-wrapper -->
          
  </div>

</div>
<?PHP
  $this->load->view("includes/Administration/footer");
?>




<script>

function showusermsg(){
           
var msg = document.getElementById("message").value
var id = document.getElementById("usid").value
 //alert(id);
 	  $.ajax({

                        url: "/ajax_userGETmessage/",
                        type: "post",
                        data: {user_id: id, message: msg},
                        success: function (response) {
                        $("#getmsg").html(response);
                      //alert(response);
                      	document.getElementById("message").value= "";
                      	                   
                        }
                        
              	  })
       
    }
</script>


<script>

    function showuserid(userID){
        
 
            $.ajax({

                        url: "/ajax_userid/",
                        type: "post",
                        data: {uid:userID},
                        success: function (response) {
                         $("#getmsg").html(response);
                        //alert(response);
                        $("#usid").val(userID);
                        }
                        
              })
              
 setTimeout(function() { showuserid(userID) }, 1000);            
          
    }
</script>






  
