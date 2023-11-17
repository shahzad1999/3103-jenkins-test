<?php
    // require functions.php file
    require('func/functions.php');

?>
<!DOCTYPE html>
<html lang="en">
<?php
    ob_start();
    // include header.php file
    include('func/header.php');

    require_once('func/DBConnect.php');
    $db = new Connect();

    require_once('func/Cart.php');
    $cart = new Cart($db);

?>



    <id="main-site">
        <section id="payment" class="py-3">
            <div class="container">
                <h1>Payment Page</h1>
                 <div id="debugOutput"></div>
                <form id="payment-form">
                    <div class="payment-options-details">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Payment form fields (e.g., card number) -->
                            <div class="form-group">
                                <label for="card-number">Card Number</label>
                                <input type="text" class="form-control" id="card-number" name="card-number" placeholder="Enter card number" required>
                                <div class="invalid-feedback">Invalid card number.</div>
                            </div>
                            
                        </div>
                        <div class="col-md-3">
                            <!-- Expiration Date -->
                            <div class="form-group">
                                <label for="card-expiration">Expiration Date (MM/YYYY)</label>
                                <input type="text" class="form-control" id="card-expiration" name="card-expiration" placeholder="MM/YYYY" required>
                                <div class="invalid-feedback">Invalid expiration date.</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <!-- CVV -->
                            <div class="form-group">
                                <label for="card-cvv">CVV</label>
                                <input type="text" class="form-control" id="card-cvv" name="card-cvv" placeholder="CVV" required>
                                <div class="invalid-feedback">Invalid CVV.</div>
                            </div>
                        </div>
                    </div>
                    <!-- Additional payment details (e.g., name on card, billing address, etc.) -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="card-name">Name on Card</label>
                                <input type="text" class="form-control" id="card-name" name="card-name" placeholder="Name on card" required>
                            </div>
                        </div>
                
                    </div>
                    </div>
                    <div class="delivery-options-details">
                        <h5>Billing Details</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="deliveryAddress">Address Line 1</label>
                                    <input type="text" class="form-control" id="deliveryAddress" name="deliveryAddress" placeholder="Address Line 1" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="deliveryAddress2">Address Line 2</label>
                                    <input type="text" class="form-control" id="deliveryAddress2" name="deliveryAddress2" placeholder="Address Line 2" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="deliveryCity">City</label>
                                    <input type="text" class="form-control" id="deliveryCity" name="deliveryCity" placeholder="City" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="deliveryState">State</label>
                                    <input type="text" class="form-control" id="deliveryState" name="deliveryState" placeholder="State" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="deliveryPostalCode">Postal Code</label>
                                    <input type="text" class="form-control" id="deliveryPostalCode" name="deliveryPostalCode" placeholder="Postal Code" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="deliveryCountry">Country</label>
                                    <input type="text" class="form-control" id="deliveryCountry" name="deliveryCountry" placeholder="Country" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- add validation if they choose door step delivery -->
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="same-as-delivery" name="same-as-delivery">
                        <label class="form-check-label" for="same-as-delivery">Same as Delivery Address</label>
                    </div>




                    <!-- <div class="text-center mt-3"> -->
                    <!-- Submit Payment Button -->
                    <div class="text-center mt-3">
                        <a class="btn btn-warning mt-3" href="invoice.php">Proceed to Buy</a>
                    </div>
                </form>
            </div>
          
        </section>
        <script src="js/payment.js"></script>
        <script>
    // Check if localStorage is available
    if (typeof localStorage !== 'undefined') {
        // Retrieve the values from localStorage
        var deliveryOption = localStorage.getItem('deliveryOption');
        var pickupDate = localStorage.getItem('pickupDate');
        var pickupTime = localStorage.getItem('pickupTime');
        var deliveryAddress = localStorage.getItem('deliveryAddress');
        var deliveryAddress2 = localStorage.getItem('deliveryAddress2');
        var deliveryCity = localStorage.getItem('deliveryCity');
        var deliveryState = localStorage.getItem('deliveryState');
        var deliveryPostalCode = localStorage.getItem('deliveryPostalCode');
        var deliveryCountry = localStorage.getItem('deliveryCountry');
        var deliveryDate = localStorage.getItem('deliveryDate');
        var deliveryTime = localStorage.getItem('deliveryTime');

        // Select the "Same as Delivery Address" checkbox by ID
        var sameAsDeliveryCheckbox = document.getElementById('same-as-delivery');

        // Function to update the "Same as Delivery Address" checkbox based on the delivery option
        function updateSameAsDeliveryCheckbox() {
            const deliveryOption = localStorage.getItem('deliveryOption');
            const sameAsDeliveryCheckbox = document.getElementById('same-as-delivery');

            if (sameAsDeliveryCheckbox && deliveryOption === 'selfPickup') {
                sameAsDeliveryCheckbox.disabled = true;
            } else {
                sameAsDeliveryCheckbox.disabled = false;
            }
        }

        // Initial update of the checkbox based on the delivery option
        updateSameAsDeliveryCheckbox();

        // Add an event listener to the checkbox
        sameAsDeliveryCheckbox.addEventListener('change', function () {
            if (this.checked) {
                // The checkbox is checked, so you can perform an action here
                // Set the retrieved values to the input fields on the "payment.php" page
                document.getElementById('deliveryAddress').value = deliveryAddress;
                document.getElementById('deliveryAddress2').value = deliveryAddress2;
                document.getElementById('deliveryCity').value = deliveryCity;
                document.getElementById('deliveryState').value = deliveryState;
                document.getElementById('deliveryPostalCode').value = deliveryPostalCode;
                document.getElementById('deliveryCountry').value = deliveryCountry;
            } else {
                // The checkbox is unchecked, you can handle this case if needed
                // Set the retrieved values to the input fields on the "payment.php" page
                document.getElementById('deliveryAddress').value = "";
                document.getElementById('deliveryAddress2').value = "";
                document.getElementById('deliveryCity').value = "";
                document.getElementById('deliveryState').value = "";
                document.getElementById('deliveryPostalCode').value = "";
                document.getElementById('deliveryCountry').value = "";
            }
        });
    }
</script>



    </main>
    <?php 
        // include footer.php file
        include('func/footer.php');
    ?>
    <script src="./js/form-validator.js"></script>
</html>
