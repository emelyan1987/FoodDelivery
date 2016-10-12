<?php
                                                        foreach($addressData as $add => $address):
                                                        ?>
                                                            <option value="<?php echo $address->id; ?>"><?php echo $address->billing_addres_1; ?></option>
                                                        <?php
                                                        endforeach;
?>