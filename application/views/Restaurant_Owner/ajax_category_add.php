<?PHP
                            foreach($get_seo_category_list as $ks=>$vs)
                            {
                               ?>
                                 <div class="col-md-4">
                                 	<label class="checkbox" ><input type="checkbox" name="restro_seo_cat[]" value="<?PHP echo $vs->id ?>"><?PHP
                                  echo $vs->name; ?></label></div>  
                              <?PHP 

                            }

                         ?>