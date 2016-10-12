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
                    
                    <a href="add_faq" class="btn bg-gray-light2">< &nbsp;Back to FAQ  Setup</a>
                    <br>
                   
                    <div class="clear_h10"></div>
                     <?PHP echo $this->session->flashdata("msg","Category Added Successfully");  ?>
                     <div class="clear_h10"></div>
                   
                       <input id="faq_cat" type="text" style="width: 29%;" placeholder="Enter FAQ category name" name="faq_cat" class="pad7"/>&nbsp; &nbsp;<button  style="padding: 9px;margin-top: -4px;" type="submit" name="save" class="btn bg-green">Save Category</button> 
                    <br><span style="color:red;"><?PHP echo form_error("faq_cat"); ?></span>
                    
                   

                   
                    <h4 class="border_bottom">List of FAQ Category</h4>                   
                    <div class="clear_h10"></div> 
                 
                    <div class="table-responsive">
                    <table class="table table_design tbl" style="width:60%;">
                    	<?PHP

                            foreach($faq_category_list as $ks=>$vs)
                            {
                            	?>
                          <tr>
                    	<td> <?PHP echo $vs->name; ?></td>
                        <td align="right">
         <a href="javascript:void(0)" onClick="updateCat(this.id)" id="<?PHP echo $vs->id; ?>,<?PHP echo $vs->name; ?>" > <img src="<?PHP echo base_url(); ?>assets/Administration/images/icon/edit.png" alt="">Edit</a>
                            <a href="javascript:void(0)" onClick="deleteCat(this.id)" id="<?PHP echo $vs->id; ?>" class="delete">x</a></td></tr> 
                          <?PHP
                               }
                          ?>

                    </table>
                    </div>
                                   
                    </div>
                 </div>
            </section>
            </form>

          </div><!-- /.content-wrapper -->
  <?PHP
  $this->load->view("includes/Administration/footer");
?>

<script>
   function updateCat(value)
   { 

          var v=value.split(",");
          $("#cat_edit_id").val(v[0]);
          $("#cat_edit_name").val(v[1]);
          
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
          FAQ Category Name <input type="text" class="form-control" id='cat_edit_name'>
                     <span id="cat_name_msg"></span>
               <input type="hidden" name="cat_edit_id" id="cat_edit_id">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onClick="editCat()">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>
         function editCat()
         {

            

               var cat_id=$("#cat_edit_id").val();
               var cat_name=$("#cat_edit_name").val();
                   //alert(cat_name);

                   if(cat_name=="")
                   {
                        $(".cat_name_msg").html("Please Enter FAQ Caegory Name");
                        $(".cat_name_msg").css("color","red");


                   }
                   else
                   {

                         

                       $.ajax({
                                 method:"post",
                                 url:'/faq_category_update/'+cat_id,
                                 data:{id:cat_id,cat_name:cat_name},
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

         function deleteCat(id)
         {
         	                $.ajax({
                                 method:"post",
                                 url:'/Administration/Dashboard/faq_category_delete/',
                                 data:{id:id},
                                 success:function(response)
                                 {
                                     if(response)
                                     {
                                     	
                                        window.location.reload();
                                     }
                                 }  
 
                             })
         }
</script>