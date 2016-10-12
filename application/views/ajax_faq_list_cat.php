                              
							   <select class="form-control" id="faq_cat_update_id">
                                 <option value="">Select Category</option>
                                   <?PHP
                                     foreach($faq_category_list as $ks=>$vs)
                                      {
										  if($one_cat['id']==$vs->id)
										  {
                                            echo "<option selected value='$vs->id'>$vs->name</option>";
										   
										  }
										  else
										  {
											  echo "<option value='$vs->id'>$vs->name</option>";
										  }
										  
                                       }
                                   ?>
                                  
                                  </select>