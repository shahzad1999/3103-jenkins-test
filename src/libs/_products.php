<?php
// Require Product.php file
require_once('func/Product.php');

// Require DBConnect.php file
require_once('func/DBConnect.php');

// Require Cart.php file
require_once('func/Cart.php');

// Instantiate the database connection
$db = new Connect();

// Instantiate the Product class and pass the $db object to it
$product = new Product($db);

// Check if the "mooncake_id" is set in the URL
if (isset($_GET['mooncake_id'])) {
    // Get the mooncake details using the Product class
    $mooncake_id = $_GET['mooncake_id'];
    $mooncake = $product->getProductWithRatings($mooncake_id);

    if (!empty($mooncake)) {
        ?>
        <!-- Your existing HTML code -->
        <section id="product" class="py-3">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <!-- Product image -->
                        <img src="./assets/products/<?php echo $mooncake['ImageURL']; ?>" alt="<?php echo $mooncake['Name']; ?>" class="img-fluid">
                    </div>
                    <div class="col-sm-6 py-5">
                        <h5 class="font-size-20"><?php echo $mooncake['Name']; ?></h5>
                        <div>
                            <small>ID: <?php echo $mooncake['MooncakeID']; ?></small>
                        </div>
                        <!-- Star ratings and price information -->
                        <div class="rating text-warning font-size-12">
                            <!-- Star ratings PHP code (unchanged) -->
                        </div>
                        <table class="my-3 font-size-14">
                            <?php
                            if ($mooncake_id >= 7 && $mooncake_id <= 10) {
                                // Display the section if mooncake_id is between 7 and 10: Special Price
                                ?>
                                <tr>
                                    <td>SGD:&nbsp;</td>
                                    <td><strike>
                                        <div class="font-size-20">
                                            <span id="product-price1" data-base-price="23.00">
                                                $23.00 
                                            </span>
                                        </div>
                                    </strike></td>
                                </tr>
                            <?php
                            }
                            ?>
                            <tr>
                                <td>SGD:&nbsp;</td>
                                <td>
                                    <div class="font-size-20 text-danger price-div">
                                        <!-- Updated span to include data-base-price -->
                                        <span id="product-price2" data-base-price="<?php echo $mooncake['Price']; ?>">
                                            $<?php echo $mooncake['Price']; ?>
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <span class="font-size-12">&nbsp;&nbsp;Inclusive of GST</span>
                                </td>
                            </tr>
                        </table>
                        <!-- Quantity selection and "Add to Cart" form -->
                        <div class="my-3">
                            <div class="row">
                                <div class="col-7">
                                </div>
                                <div class="col-6">
                                    <div class="qty d-flex">
                                        <h6>Quantity</h6>
                                        <div class="px-4 d-flex">
                                            <select id="quantity-select" class="quantity-select">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="4">Box of 4</option>
                                                <option value="6">Box of 6</option>
                                            </select>
                                            <!-- Hidden input for selected quantity -->
                                            <input type="hidden" name="selected_quantity" value="1" id="hidden-quantity-input">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col pt-4">
                                <!-- Form for adding to the cart -->
                            <form action="cart.php" method="post">
                            <?php
                                if (isset($_SESSION['userid'])) {
                                    // If the user is logged in, show the form with the user ID
                                ?>
                                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['userid']; ?>">
                                    <input type="hidden" name="item_id" value="<?php echo $mooncake['MooncakeID']; ?>">
                                    <button type="submit" name="buy_product_submit" class="btn btn-warning form-control" style="width: 40%;">Add to Cart</button>
                               <?php
                                } else {
                                    
                                ?>
                                <input type="button"  name="buy_product_submit" class="btn btn-warning form-control" style="width: 40%;" value="Add to Cart" onclick="showLoginAlert()">
                                <script>
                                    function showLoginAlert() {
                                        alert("Please log in to add items to your cart.");
                                    }
                                </script>
                                <?php
                                }
                                ?>
                            </form>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="col-12">
                        <h6>Product Description</h6>
                        <hr>
                        <p class="font-size-14"><?php echo $mooncake['Description']; ?></p>
                        <h6>Storage Instructions for Mooncakes</h6>
                        <hr>
                        <?php
                        // Retrieve storage instructions from your database
                        $storageInstructions = $mooncake['Storage_Instructions'];
                        if (isset($storageInstructions) && !is_null($storageInstructions)) {
                            $instructionList = explode("\n", $storageInstructions);
                            $index = 1; // Initialize the index
                            echo '<ul class="font-size-14 instruction-list">';
                            foreach ($instructionList as $instruction) {
                                $instruction = trim($instruction); // Remove any leading/trailing whitespace
                                if (!empty($instruction)) {
                                    echo '<li class="instruction-list-item">';
                                    echo '<div class="instruction-icon">' . $index . '</div>';
                                    echo '<p>' . $instruction . '</p>';
                                    echo '</li>';
                                    $index++; // Increment the index for the next instruction
                                }
                            }
                            echo '</ul>';
                        } else {
                            // Handle the case where storage instructions are not available
                            echo '<p>No storage instructions available.</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
    } else {
        echo 'Mooncake not found.';
    }
} else {
    echo 'Mooncake ID not provided.';
}
?>
