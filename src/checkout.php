<?php
ob_start();
// require functions.php file
require('func/functions.php');

require_once('func/DBConnect.php');
$db = new Connect();

require_once('func/Cart.php');
$cart = new Cart($db);

// include header.php file
include('func/header.php');
?>
<head>
    <title>Checkout</title>
    <link rel="stylesheet" type="text/css" href="css/checkout.css">
</head>
<body>
    <?php
    /*  include cart items if it is not empty */
    count($cart->getCart($_SESSION['userid'] ?? 0)) ? include('libs/_checkout_cart_template.php') : include('libs/_cart-notFound.php');
    /*  include cart items if it is not empty */

    ?>
   <!-- Container to select Delivery option -->
   <div class="container">
        <div class="delivery_option_container">
            <h5>Delivery Option</h5>
                <div class="form-check">
                <input class="form-check-input" type="radio" name="deliveryOption" id="delivery" value="delivery" >
                <label class="form-check-label" for="delivery">
                    Delivery
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="deliveryOption" id="selfPickup" value="selfPickup">
                <label class="form-check-label" for="selfPickup">
                    Self Pickup
                </label>
            </div>
        </div>

        <!-- Container for Self Pickup or Delivery Details -->
        <div class="pickup-or-delivery-details container mt-3">
            <!-- Self Pickup Details -->
            <div class="self-pickup-options">
                <h5>Self Pickup Details</h5>
                <!-- Table for Self Pickup Locations -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Location</th>
                            <th>Open Time</th>
                            <th>Close Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Store 1</td>
                            <td>9:00 AM</td>
                            <td>6:00 PM</td>
                        </tr>
                        <tr>
                            <td>Store 2</td>
                            <td>10:00 AM</td>
                            <td>7:00 PM</td>
                        </tr>
                        <tr>
                            <td>Store 3</td>
                            <td>8:00 AM</td>
                            <td>5:00 PM</td>
                        </tr>
                        <!-- You can add more locations here -->
                    </tbody>
                </table>
                <div class="form-group">
                    <div class="col-sm-6">
                    <label for="pickupLocation">Select Pickup Location</label>
                    <select class="form-select" id="pickupLocation" name="pickupLocation" required>
                        <option value="store1">Store 1</option>
                        <option value="store2">Store 2</option>
                        <option value="store3">Store 3</option>
                    </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-6">
                    <label for="pickupDate">Select Pickup Date</label>
                    <input type="date" class="form-control" id="pickupDate" name="pickupDate" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                    <label for="pickupTime">Select Pickup Time</label>
                    <input type="time" class="form-control" id="pickupTime" name="pickupTime" required>
                    </div>
                </div>
            </div>

            <!-- Delivery Details -->
            <div class="delivery-options-details">
                <h5>Delivery Details</h5>
                <div class="form-group">
                    <label for="deliveryAddress">Address Line 1</label>
                    <input type="text" class="form-control" id="deliveryAddress" name="deliveryAddress" placeholder="Address Line 1" required>
                </div>
                <div class="form-group">
                    <label for="deliveryAddress2">Address Line 2</label>
                    <input type="text" class="form-control" id="deliveryAddress2" name="deliveryAddress2" placeholder="Address Line 2" required>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                    <label for="deliveryCity">City</label>
                    <input type="text" class="form-control" id="deliveryCity" name="deliveryCity" placeholder="City" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                    <label for="deliveryState">State</label>
                    <input type="text" class="form-control" id="deliveryState" name="deliveryState" placeholder="State" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                    <label for="deliveryPostalCode">Postal Code</label>
                    <input type="text" class="form-control" id="deliveryPostalCode" name="deliveryPostalCode" placeholder="Postal Code" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                    <label for="deliveryCountry">Country</label>
                    <input type="text" class="form-control" id="deliveryCountry" name="deliveryCountry" placeholder="Country" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                    <label for="deliveryDate">Select Delivery Date</label>
                    <input type="date" class="form-control" id="deliveryDate" name="deliveryDate" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                    <label for="deliveryTime">Select Delivery Time</label>
                    <input type="time" class="form-control" id="deliveryTime" name="deliveryTime" required>
                    </div>
                </div>
            </div>
        </div>

        
        <!-- Button to Proceed to Buy -->
        <div class="container">
            <a href="payment.php" type="submit" class="btn btn-warning mt-3">Proceed to Buy</a>
        </div>
    </div>
    
    
    <script src="js/checkout.js"></script>
    <script src="./js/form-validator.js"></script>
    <script>
        
        // Check if localStorage is available
        if (typeof localStorage !== 'undefined') {
        // Retrieve stored values and set them to the respective input fields
        document.getElementById('delivery').checked = localStorage.getItem('deliveryOption') === 'delivery';
        document.getElementById('selfPickup').checked = localStorage.getItem('deliveryOption') === 'selfPickup';
        document.getElementById('pickupDate').value = localStorage.getItem('pickupDate');
        document.getElementById('pickupTime').value = localStorage.getItem('pickupTime');
        document.getElementById('deliveryAddress').value = localStorage.getItem('deliveryAddress');
        document.getElementById('deliveryAddress2').value = localStorage.getItem('deliveryAddress2');
        document.getElementById('deliveryCity').value = localStorage.getItem('deliveryCity');
        document.getElementById('deliveryState').value = localStorage.getItem('deliveryState');
        document.getElementById('deliveryPostalCode').value = localStorage.getItem('deliveryPostalCode');
        document.getElementById('deliveryCountry').value = localStorage.getItem('deliveryCountry');
        document.getElementById('deliveryDate').value = localStorage.getItem('deliveryDate');
        document.getElementById('deliveryTime').value = localStorage.getItem('deliveryTime');
        }

        // Event listeners to store the values when they change
        document.getElementById('delivery').addEventListener('change', function () {
        localStorage.setItem('deliveryOption', this.checked ? 'delivery' : 'selfPickup');
        });
        document.getElementById('selfPickup').addEventListener('change', function () {
        localStorage.setItem('deliveryOption', this.checked ? 'selfPickup' : 'delivery');
        });
        document.getElementById('pickupDate').addEventListener('input', function () {
        localStorage.setItem('pickupDate', this.value);
        });
        document.getElementById('pickupTime').addEventListener('input', function () {
        localStorage.setItem('pickupTime', this.value);
        });
        document.getElementById('deliveryAddress').addEventListener('input', function () {
        localStorage.setItem('deliveryAddress', this.value);
        });
        document.getElementById('deliveryAddress2').addEventListener('input', function () {
        localStorage.setItem('deliveryAddress2', this.value);
        });
        document.getElementById('deliveryCity').addEventListener('input', function () {
        localStorage.setItem('deliveryCity', this.value);
        });
        document.getElementById('deliveryState').addEventListener('input', function () {
        localStorage.setItem('deliveryState', this.value);
        });
        document.getElementById('deliveryPostalCode').addEventListener('input', function () {
        localStorage.setItem('deliveryPostalCode', this.value);
        });
        document.getElementById('deliveryCountry').addEventListener('input', function () {
        localStorage.setItem('deliveryCountry', this.value);
        });
        document.getElementById('deliveryDate').addEventListener('input', function () {
        localStorage.setItem('deliveryDate', this.value);
        });
        document.getElementById('deliveryTime').addEventListener('input', function () {
        localStorage.setItem('deliveryTime', this.value);
        });


    </script>
</body>
<?php
/*  include top sale section */
include('libs/_top-sale.php');
/*  include top sale section */
?>
<?php
// include footer.php file
include('func/footer.php');
?>
