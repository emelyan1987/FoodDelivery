<?PHP
  $this->load->view("includes/Administration/header"); 
  $this->load->view("includes/Administration/sidebar");
  ?>
 <!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            
            <!-- Main content -->
           <form method="post">

            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                    
                    <!--<a href="add_new_city" class="btn bg-gray-light2">< &nbsp;Back to City Setup</a>-->
        
                    <div class="clear_h10"></div>
                   <?PHP
                            if(isset($area_msg))
                            {
                   ?>
                     <div class="alert alert-success">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong> <?PHP

                      echo $area_msg;
                  
                    ?></strong>
                </div>
                <?PHP  
                 }
                ?>
                   
                    <h4 class="border_bottom">Lists - City</h4>                   
                    <div class="clear_h10"></div> 
                    
                    <h4>CITY NAME</h4>
                    <div class="table-responsive">
                    <table class="table table_design tbl" style="width:60%;">
                    	<?PHP

                            foreach($city_list as $ks=>$vs)
                            {
                            	?>
                          <tr>
                    	<td> <?PHP echo $vs->city_name; ?></td>
                        <td align="right">
                            <a href="javascript:void(0)" onClick="updateCity(this.id)" id="<?PHP echo $vs->id; ?>,<?PHP echo $vs->city_name; ?>" > <img src="<?PHP echo base_url(); ?>assets/Administration/images/icon/edit.png" alt="">Edit</a>
<?php $city_exist = CityExistWithRestro($vs->id); ?>

<?php
if($city_exist == 0)
{
?>

                            <a href="javascript:void(0)" onClick="delete_city(this.id)" id="<?PHP echo $vs->id; ?>" class="delete" >x</a>
<?php
}
else
{
  echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
}
?></td></tr> 
                          <?PHP
                               }
                          ?>

                    </table>
                    </div>
                    <input id="city" type="text" placeholder="Enter City name" name="city" class="pad7"/>
                    <br><span><?PHP echo form_error("city"); ?></span> <span><?PHP 
                    echo isset($city_msg1)?$city_msg1:""; ?></span>
                    &nbsp; &nbsp;
                    <!--<a href="" class="btn bg-gray-light2"><span class="add_sign">+</span> Add</a>-->
                    
                    <div class="clear_h10"></div>                   
                   <button type="submit" name="save" class="btn bg-green">Save</button>                  
                    </div>
                 </div>
            </section>
            </form>

          </div><!-- /.content-wrapper -->
  <?PHP
  $this->load->view("includes/Administration/footer");
?>

<script>
   function updateCity(value)
   { 

          var v=value.split(",");
          $("#city_edit_id").val(v[0]);
          $("#city_edit_name").val(v[1]);
          
    $('#myModal').modal()                      // initialized with defaults
    $('#myModal').modal({ keyboard: false })   // initialized with no keyboard
    $('#myModal').modal('show')  

   }
</script>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Update City</h4>
      </div>
      <div class="modal-body">
          City Name <input type="text" class="form-control" id='city_edit_name'>
                     <span id="city_name_msg"></span>
               <input type="hidden" name="city_edit_id" id="city_edit_id">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onClick="editCity()">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>
         function editCity()
         {

            

               var city_id=$("#city_edit_id").val();
               var city_name=$("#city_edit_name").val();
                   if(city_name=="")
                   {
                        $(".city_name_msg").html("Please Enter City Name");
                        $(".city_name_msg").css("color","red");


                   }
                   else
                   {

                         

                       $.ajax({
                                 method:"post",
                                 url:'/update_city/'+city_id,
                                 data:{id:city_id,city_name:city_name},
                                 success:function(response)
                                 {
                                     if(response)
                                     {
                                        $('#myModal').modal()                      // initialized with defaults
                                        $('#myModal').modal({ keyboard: false })   // initialized with no keyboard
                                        $('#myModal').modal('hide') 
                                        window.location.reload();
                                     }
                                 }  
 
                             })
                   }

                    
         }
</script>


<script>
       function delete_city(value)
       {
           if(value)
           {
                
                var v=confirm("Do You Want To Delete This City?");
                if(v==true)
                {
                    $.ajax({
                               method:"post",
                               url:"/delete_city/",
                               data:{cid:value},
                               success:function(response)
                               {
                                  if(response)
                                  {
                                     window.location.reload();
                                  }
                               } 
                       

                       })
                }

           }

       }
</script>