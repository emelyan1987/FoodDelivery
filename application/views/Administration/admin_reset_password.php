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
                    <h4 class="border_bottom">RESET PASSWORD - RESTAURANT OWNER</h4>     
                    <h5><b><?PHP echo isset($change_msg)?$change_msg:"" ?></b></h5>              
                     
                      <form action='/admin_reset_password/' method="post">
                    <div class="table-responsive">
                    <table class="table bg-gray-light tbl" style="width:60%;">
                    <!--<tr><td>USER TYPE</td>
                        <td><input id="Radio1" type="radio" name="owner" checked="checked" value="1"/> <span>RESTAURANT</span> &nbsp; &nbsp; 
                                </td></tr>-->
                    <tr><td width="30%">PICK OWNER ID:</td>
                        <td>
				<select name="owner_id">
					<?php
					foreach($owner_code_list as $am => $key):
					?>
					<option value="<?php echo $key->owner_id; ?>"><?php echo $key->owner_id; ?></option> 
					<?php
					endforeach;
					?>
				</select>
			</td></tr>
                    <!--<tr><td>ENTER OLD PASSWORD</td>
                        <td><input id="Text1" type="text" name="op" placeholder="Enter Old password" />
						<span style="color:red">
						  <?PHP echo form_error("op"); ?>
						</span></td></tr>-->
                    <tr><td>ENTER NEW PASSWORD</td>
                        <td><input id="Text2" type="text" name="np" placeholder="Enter New password" />
						<span style="color:red">
						  <?PHP echo form_error("np"); ?>
						</span>
						</td></tr>
                    <tr><td>RE-ENTER NEW PASSWORD</td>
                        <td><input id="Text3" type="text" name="cp" placeholder="Enter Confirm password"/><span style="color:red;"><?PHP echo form_error("cp"); echo isset($not_msg)?$not_msg:""; ?></span></span></td></tr>
                    <tr><td></td><td>

                      <button type="submit" name="add" class="btn bg-gray-light2">Save Changes</button></td></tr>
                    </table> 
                    </div>
                   </form>
                    
                    </div>
                 </div>
            </section>

          </div><!-- /.content-wrapper -->


<?PHP
  $this->load->view("includes/Administration/footer");
?>




