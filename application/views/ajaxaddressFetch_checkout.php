<?php

foreach($addressData as $AdD => $address):
?>
<div>
                <div class="col-md-6">
                    <h4>Billing Address</h4>
                    <div class="col-md-6">
                        <strong>Full Name</strong>
                    </div>
                    <div class="col-md-6">
                        <?php echo $address->billing_full_name; ?>
                    </div>
                    <div class="col-md-6">
                        <strong>Building</strong>
                    </div>
                    <div class="col-md-6">
                        <?php echo $address->billing_addres_1; ?>
                    </div>
                    <div class="col-md-6">
                        <strong>Block</strong>
                    </div>
                    <div class="col-md-6">
                       <?php echo $address->billing_address_2; ?>
                    </div>
                    <div class="col-md-6">
                        <strong>Area</strong>
                    </div>
                    <div class="col-md-6">
                        <?php echo $address->billing_city; ?>
                    </div>
                    <div class="col-md-6">
                        <strong>Floor</strong>
                    </div>
                    <div class="col-md-6">
                        <?php echo $address->billing_state; ?>
                    </div>
                    <div class="col-md-6">
                        <strong>Street</strong>
                    </div>
                    <div class="col-md-6">
                       <?php echo $address->billing_zip_code; ?>
                    </div>
                    <div class="col-md-6">
                        <strong>Apartment</strong>
                    </div>
                    <div class="col-md-6">
                        <?php echo $address->billing_phoneno; ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <h4>Shipping Address</h4>
                    <div class="col-md-6">
                        <strong>Full Name</strong>
                    </div>
                    <div class="col-md-6">
                        <?php echo $address->shipping_full_name; ?>
                    </div>
                    <div class="col-md-6">
                        <strong>Building</strong>
                    </div>
                    <div class="col-md-6">
                       <?php echo $address->shipping_address_1; ?>
                    </div>
                    <div class="col-md-6">
                        <strong>Block</strong>
                    </div>
                    <div class="col-md-6">
                       <?php echo $address->shipping_address_2; ?>
                    </div>
                    <div class="col-md-6">
                        <strong>Area</strong>
                    </div>
                    <div class="col-md-6">
                        <?php echo $address->shipping_city; ?>
                    </div>
                    <div class="col-md-6">
                        <strong>Floor</strong>
                    </div>
                    <div class="col-md-6">
                        <?php echo $address->shipping_state; ?>
                    </div>
                    <div class="col-md-6">
                        <strong>Street</strong>
                    </div>
                    <div class="col-md-6">
                        <?php echo $address->shipping_zip_code; ?>
                    </div>
                    <div class="col-md-6">
                        <strong>Apartment</strong>
                    </div>
                    <div class="col-md-6">
                       <?php echo $address->shipping_phoneno; ?>
                    </div>
                </div>
</div>
<div class="margin20"></div>
<?php
endforeach;
?>