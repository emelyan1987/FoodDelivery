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
					<label>Enter ChatName </label>		
                      <?php echo form_open_multipart('') ?>
					  <input class="form-control" type="text" name="chatname" id="chatname"> </br>
					  <span style="color:red"><?PHP echo isset($chatname_msg)?$chatname_msg:""; ?></span></br>
					   
					  <input type="submit" name="chat" value="Submit" >
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

<script>
    $(document).ready(function(){
    
                $(".insideFirstColumn").css("opacity","1");
                $(".insideSecondColumn").css("opacity","0.5");
                $(".insideThirdColumn").css("opacity","0.5");
                $(".insideFourthColumn").css("opacity","0.5");
                $(".pickupTab").css("display","block");
                $(".deliveryTab").css("display","none");
                $(".cateringTab").css("display","none");
                $(".reservationTab").css("display","none");

});
</script>
    <script>
            function changeTab1(){
                $(".insideFirstColumn").css("opacity","1");
                $(".insideSecondColumn").css("opacity","0.5");
                $(".insideThirdColumn").css("opacity","0.5");
                $(".insideFourthColumn").css("opacity","0.5");
                $(".pickupTab").css("display","block");
                $(".deliveryTab").css("display","none");
                $(".cateringTab").css("display","none");
                $(".reservationTab").css("display","none");
            }
            function changeTab2(){
                $(".insideFirstColumn").css("opacity","0.5");
                $(".insideSecondColumn").css("opacity","1");
                $(".insideThirdColumn").css("opacity","0.5");
                $(".insideFourthColumn").css("opacity","0.5");
                $(".deliveryTab").css("display","block");
                $(".pickupTab").css("display","none");
                $(".cateringTab").css("display","none");
                $(".reservationTab").css("display","none");
            }
            function changeTab3(){
                $(".insideFirstColumn").css("opacity","0.5");
                $(".insideSecondColumn").css("opacity","0.5");
                $(".insideThirdColumn").css("opacity","1");
                $(".insideFourthColumn").css("opacity","0.5");
                $(".deliveryTab").css("display","none");
                $(".pickupTab").css("display","none");
                $(".cateringTab").css("display","block");
                $(".reservationTab").css("display","none");
            }
            function changeTab4(){
                $(".insideFirstColumn").css("opacity","0.5");
                $(".insideSecondColumn").css("opacity","0.5");
                $(".insideThirdColumn").css("opacity","0.5");
                $(".insideFourthColumn").css("opacity","1");
                $(".deliveryTab").css("display","none");
                $(".pickupTab").css("display","none");
                $(".cateringTab").css("display","none");
                $(".reservationTab").css("display","block");
            }
        </script>

        
</html>