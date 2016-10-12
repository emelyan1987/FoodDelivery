<?PHP
  $this->load->view("includes/Customer/header"); 
  ?>
        <div class="container-fluid">
            <div class="myNewTemplate">
                <div class="row">
                    <div class="col-md-12">
                        <div class="one_half">
                            <!--<div class="center-block">-->
                            
                            <div class="drawingSection">
					<label>Your Message</label>		
                      
					    
					   
					   <?php foreach($chat_list as $ks => $vs): ?>
					  <p style="background: beige;padding: 5px;border-radius: 5px;color: #8A8A8A;width: 100%;"> <?php echo $vs->message; ?> </p></br>
						<?PHP    endforeach; ?> 
						
					 
					  
					  </form>         
								   
                                </div>
                            
                            
                            
                            
                            
                            
                                <div class="drawingSection">
                              
					<label>Input Message</label>		
                      <?php echo form_open_multipart('') ?>
					  
					  <textarea class="form-control" rows="4" name="message" id="message"></textarea>
					  <span style="color:red"><?PHP  echo form_error('message'); ?></span></br>
					  <input type="submit" name="add_msg" value="Submit" >
					  </form>         
								   
                                </div>
                            <!--</div>-->
                        </div>
                        
						
						
						
                    </div>
                </div>
            </div>
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
        
    </body>



<script>
    function incrementval(str){
        var getval = document.getElementById(str).value; 
        
        
        var newval = parseInt(getval)+1;
        document.getElementById(str).value = newval;
        
    }
    function descrementval(str){

        var getval = document.getElementById(str).value;
        if(getval > 1)
        {
        var newval = parseInt(getval)-1;
        document.getElementById(str).value = newval;
        }
    }
</script>


        
</html>
<script>
setTimeout(function(){
   window.location.reload(1);
}, 3000);
</script>