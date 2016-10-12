                                                                                               <select class="form-control" name="location_id">
                                                                                                  <option value="">Select Location</option>
                                                                                                 <?PHP
                                                                                                 foreach($location_list as $ks=>$vs)
                                                                                                 {
                                                                                                  echo "<option value='".$vs->id."'>$vs->location_name</option>"; 
                                                                                                  }

                                                                                                  ?>
                                                                                              </select>