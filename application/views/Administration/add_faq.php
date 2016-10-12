<?PHP
  $this->load->view("includes/Administration/header"); 
  $this->load->view("includes/Administration/sidebar");
  ?>
    <div class="content-wrapper">
<section class="content">
                <div class="row">
                    <div class="col-md-12">
            <form action="" method="post">
                    <h4 class="border_bottom">ADD NEW FAQ</h4>  
                    <?PHP  echo  $this->session->flashdata("msg"); ?>                 
                    
                    <div class="table-responsive">
                    <table class="table bg-gray-light tbl" style="width:80%;">
                    <tbody>
                        <tr>
                            <td>CATEGORY</td>
                            <td>
							<select name="faq_cat">
                                 <option value="">Select Category</option>
                                   <?PHP
                                     foreach($faq_category_list as $ks=>$vs)
                                      {
                                         echo "<option value='$vs->id'>$vs->name</option>";
                                       }
                                   ?>
                                  
                                  </select><br>
                                  <span style="color:red"><?PHP  echo form_error("faq_cat"); ?></span>
                              </td>
                        </tr>
                        
                        <tr>
                            <td>TITLE</td>
                            <td><input type="text" name="faq_title"  placeholder="Enter Title" 
                                value="<?PHP echo set_value('faq_title')  ?>"><br>
                                <span style="color:red"><?PHP  echo form_error("faq_title"); ?></span></td>
                        </tr>
                        <tr><td>DESCRIPTION</td>
                        <td><textarea id="TextArea1" rows="10" cols="30" name="faq_description"  
						placeholder="Enter Description"></textarea>
                            <br>
                            <span style="color:red"><?PHP  echo form_error('faq_description'); ?></span>
                        </td></tr>
                   
                    
                    </tbody></table> 
                    </div>
                    <input type="submit" class="btn bg-gray-light2" value="Submit" name="btnweb">
                    <div class="clear_h20"></div>
             </form>   
            
            </section>
        </div>

<?PHP
  $this->load->view("includes/Administration/footer");
?>


