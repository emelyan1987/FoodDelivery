<?PHP
  $this->load->view("includes/Administration/header"); 
  $this->load->view("includes/Administration/sidebar");
  ?>
   <!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            
            <!-- Main content -->
           
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                    <h4 class="border_bottom">RESET PASSWORD - USER</h4>                   

                    <div class="table-responsive">
                    <table class="table bg-gray-light tbl" style="width:60%;">
                    <tr><td>USER TYPE</td>
                        <td><input id="Radio1" type="radio" name="1" checked="checked"/> <span>RESTAURANT</span> &nbsp; &nbsp; 

                           <!-- <input id="Radio2" type="radio" name="1"/> <span>CUSTOMER</span>-->    

                          </td></tr>
                    <tr><td width="30%">PICK USER ID:</td>
                        <td><select id="Select2" style="width:60%;"><option></option></select></td></tr>
                    <tr><td>ENTER OLD PASSWORD</td>
                        <td><input id="Text1" type="text" /></td></tr>
                    <tr><td>ENTER NEW PASSWORD</td>
                        <td><input id="Text2" type="text" /></td></tr>
                    <tr><td>RE-ENTER NEW PASSWORD</td>
                        <td><input id="Text3" type="text" /></td></tr>
                    <tr><td></td><td><a href="" class="btn bg-gray-light2">Save Changes</a></td></tr>
                    </table> 
                    </div>
                   
                    
                    </div>
                 </div>
            </section>

          </div><!-- /.content-wrapper -->


<?PHP
  $this->load->view("includes/Administration/footer");
?>




