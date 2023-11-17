<?php
// Require Product.php file
require_once('func/Product.php'); 

// Require Cart.php file
require_once('func/Cart.php');

// Assuming you have a user account object (e.g., $acc) for user-related operations.
// Ensure that 'logged' key is set in the session data.
if (isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
    // User is logged in, so you can access their data.
    $userID = $_SESSION['userid'];

    // Check if the 'users' key exists in the session data.
    if (isset($_SESSION['users'])) {
        $usersData = $_SESSION['users'];

        // Ensure that the user's data exists in the 'users' array.
        if (isset($usersData[$userID]['fullname'])) {
            $fullname = $usersData[$userID]['fullname'];
        } else {
            $fullname = 'Guest';
        }
    } else {
        $fullname = 'Guest';
    }
} else {
    $fullname = 'Guest';
}
?>

<!-- Shopping cart section  -->
<section id="cart" class="py-3 mb-5">
    <div class="container">
        <h5 class="font-size-20">
            Shopping Cart <span>
                (<?php
                if ($_SESSION['logged'] == 1) {
                    print $_SESSION['username'];
                } else {
                    echo 'Guest';
                }
                ?>)
            </span>
        </h5>
        <!--  shopping cart items -->
        <div class="row">
            <div class="col-sm-9">
                <!-- Empty Cart -->
                <div class="row border-top py-3 mt-3">
                    <div class="col-sm-12 text-center py-2">
                        <img src="./assets/empty_cart.png" alt="Empty Cart" class="img-fluid" style="height: 200px;">
                        <p class="font-size-16 text-black-50">Empty Cart</p>
                    </div>
                </div>
                <!-- .Empty Cart -->
            </div>
            <!-- subtotal section-->
            <div class="col-sm-3">
                <div class="sub-total border text-center mt-2">
                    <h6 class="font-size-12  text-danger py-3">
                        <i class="fas fa-times"></i><br>
                        Your order is NOT eligible for FREE Delivery.
                    </h6>
                    <div class="border-top py-4">
                        <h5 class="font-size-20">
                            <p>Subtotal (0 item) :</p>
                            <p class="text-danger">
                                <span>$</span>
                                <span id="deal-price"> 0 </span>
                            </p>
                        </h5>
                        <!-- Button to Proceed to Buy -->
                        <div class="container">
                            <a type="submit" class="btn btn-warning mt-3" href="./checkout.php">Proceed to Buy</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- !subtotal section-->
        </div>
        <!-- !shopping cart items -->
    </div>
</section>
<!-- !Shopping cart section  -->
