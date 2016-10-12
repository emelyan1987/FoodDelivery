<?php
foreach($addressData as $key => $addr):
?>
<div class="col-md-12">
              
                <div class="col-md-6">
                  <h3>Billing Address</h3>
                  <div class="form-group">
                    <label for="email">Full Name:</label>
                     <input type="hidden" name="address_id" value="<?php echo $addr->id; ?>">
                    <input type="text" class="form-control" id="billing_full_namee" name="billing_full_namee" required value="<?php echo $addr->billing_full_name; ?>">
                  </div>
                  <div class="form-group">
                    <label for="pwd">Building:</label>
                    <input type="text" class="form-control" id="billing_addres_1e" name="billing_addres_1e" value="<?php echo $addr->billing_addres_1; ?>">
                  </div>
                  <div class="form-group">
                    <label for="email">Block:</label>
                    <input type="text" class="form-control" id="billing_address_2e" name="billing_address_2e" value="<?php echo $addr->billing_address_2; ?>">
                  </div>
                  <div class="form-group">
                    <label for="pwd">Area:</label>
                    <input type="text" class="form-control" id="billing_citye" name="billing_citye" value="<?php echo $addr->billing_city; ?>">
                  </div>
                  <div class="form-group">
                    <label for="email">Floor:</label>
                    <input type="text" class="form-control" id="billing_statee" name="billing_statee" value="<?php echo $addr->billing_state; ?>"> 
                  </div>
                  <div class="form-group">
                    <label for="pwd">Street:</label>
                    <input type="text" class="form-control" id="billing_zip_codee" name="billing_zip_codee" value="<?php echo $addr->billing_zip_code; ?>">
                  </div>
                  <div class="form-group">
                    <label for="pwd">Apartment:</label>
                    <input type="text" class="form-control" id="billing_phonenoe" name="billing_phonenoe" required value="<?php echo $addr->billing_phoneno; ?>">
                  </div>
                  <div class="checkbox">
                    <label><input type="checkbox" value="1" onchange="toggleCheckbox1(this)"> Shipping Address Same as billing </label>
                  </div>
                </div>
                <div class="col-md-6">
                  <h3>Shipping Address</h3>
                  <div class="form-group">
                    <label for="email">Full Name:</label>
                    <input type="text" class="form-control" id="shipping_full_namee" name="shipping_full_namee" required value="<?php echo $addr->shipping_full_name; ?>">
                  </div>
                  <div class="form-group">
                    <label for="pwd">Building:</label>
                    <input type="text" class="form-control" id="shipping_address_1e" name="shipping_address_1e" value="<?php echo $addr->shipping_address_1; ?>">
                  </div>
                  <div class="form-group">
                    <label for="email">Block:</label>
                    <input type="text" class="form-control" id="shipping_address_2e" name="shipping_address_2e" value="<?php echo $addr->shipping_address_2; ?>">
                  </div>
                  <div class="form-group">
                    <label for="pwd">Area:</label>
                    <input type="text" class="form-control" id="shipping_citye" name="shipping_citye" value="<?php echo $addr->shipping_city; ?>">
                  </div>
                  <div class="form-group">
                    <label for="email">Floor:</label>
                    <input type="text" class="form-control" id="shipping_statee" name="shipping_statee" value="<?php echo $addr->shipping_state; ?>">
                  </div>
                  <div class="form-group">
                    <label for="pwd">Street:</label>
                    <input type="text" class="form-control" id="shipping_zip_codee" name="shipping_zip_codee" value="<?php echo $addr->shipping_zip_code; ?>">
                  </div>
                  <div class="form-group">
                    <label for="pwd">Apartment:</label>
                    <input type="text" class="form-control" id="shipping_phonenoe" name="shipping_phonenoe" required value="<?php echo $addr->shipping_phoneno; ?>">
                  </div>
                  
                </div>
            
</div>

<?php
endforeach;
?>