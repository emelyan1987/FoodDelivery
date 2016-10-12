<?php foreach ($data_list as $ks => $vs): ?>
                            <div class="col-md-6">
                                <div class="checkbox">
                                	<label>
                                    <input type="checkbox" value="<?php echo $vs->id;?>" name="item_cat[]"><?php echo ucwords($vs->cat_name);?>
                                	</label>
                                </div>
                            </div>
                            <?PHP endforeach;?>