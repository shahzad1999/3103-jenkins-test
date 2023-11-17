<?php
// Require Product.php file
require_once('func/Product.php'); 

// Require Cart.php file
require_once('func/Cart.php');
?>

<!-- Shopping cart section -->
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
        <!-- shopping cart items -->
        <div class="row">
            <div class="col-sm-9">
                <?php
                $products = $cart->getGroupedCartItems($_SESSION['userid'] ?? 0);
                $subTotal = [];  
                foreach ($products as $productItems):
                    //print_r($productItems);
                 
                    $item = $product->getProductWithRatings($productItems['OrderID']);
                    //print_r("Info in Item: ",$item);
                    ?>
                    <!-- cart item -->
                    <div class="row border-top py-3 mt-3">
                        <div class="col-sm-2">
                            <img src="./assets/products/<?php echo $item['ImageURL']; ?>" style="height: 120px;" alt="cart1" class="img-fluid">
                        </div>
                        <div class="col-sm-8">
                            <h5 class="font-size-20">
                                <?php echo $item['Name']; ?>
                            </h5>    
                            <!-- product rating -->
                            <div class="d-flex">
                                <div class="rating text-warning font-size-12">
                                    <?php
                                    $ratingScore = $item['Rating_Score'];
                                    $filledStars = floor($ratingScore);
                                    $halfStar = ($ratingScore - $filledStars) >= 0.5;

                                    // Display the filled stars
                                    for ($i = 0; $i < $filledStars; $i++) {
                                        echo '<span><i class="fas fa-star"></i></span>';
                                    }

                                    // Display the half-filled star, if applicable
                                    if ($halfStar) {
                                        echo '<span><i class="fas fa-star-half-alt"></i></span>';
                                    }

                                    // Calculate the number of empty stars
                                    $emptyStars = 5 - $filledStars - ($halfStar ? 1 : 0);

                                    // Display the remaining empty stars
                                    for ($i = 0; $i < $emptyStars; $i++) {
                                        echo '<span><i class="far fa-star"></i></span>';
                                    }
                                    ?>
                                    <!-- Display the number of reviews -->
                                    <a href="#" class="px-2 font-size-14"><?php echo $item['Reviews']; ?></a>
                                </div>
                            </div>
                            <!--  !product rating-->

                            <!-- product qty -->
                            <div class="qty d-flex pt-2">
                                <div class="d-flex w-25">
                                    <input type="text" data-id="<?php echo $productItems['Quantity'] ?? '0'; ?>" class="qty_input text-center border px-2 w-100 bg-light" disabled value="<?php echo $productItems['Quantity']?>">
                                </div>
                                <form method="POST"> 
                                    <input type="hidden" value="<?php echo $productItems['OrderID'] ?? 0; ?>" name="OrderID">
                                    <button type="submit" name="delete-cart-submit" class="btn text-danger px-3 border-right">Delete</button>
                                </form>
                            </div>
                            <!-- !product qty -->
                        </div>
                        <div class="col-sm-2 text-right">
                            <div class="font-size-20 text-danger">
                                $<span class="product_price" data-id="<?php echo $item['MooncakeID'] ?? '0'; ?>">
                                    <?php 
                                    $price = $item['Price'] ?? 0;
                                    $quantity = $productItems['Quantity'] ?? 1; // Use a default quantity of 1 if not set
                                    $subtotalItem = $price * $quantity; // Calculate the subtotal for this item
                                    $subTotal[] = $subtotalItem; // Add the subtotal for this item to the $subTotal array
                                    echo $subtotalItem; // Output the subtotal for this item
                                    ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- !cart item -->
                    <?php
                endforeach;
                ?>
            </div>
            <!-- subtotal section-->
            <div class="col-sm-3">
                <div class="sub-total border text-center mt-2">
                    <?php
                    $subtotal = isset($subTotal) ? $cart->getSum($subTotal) : 0;
                    if ($subtotal >= 250) {
                        echo '<h6 class="font-size-12 text-success py-3"><i class="fas fa-check"></i>Your order is eligible for FREE Delivery.</h6>';
                    } else {
                        echo '<h6 class="font-size-12 text-danger py-3"><i class="fas fa-times"></i>Your order is NOT eligible for FREE Delivery.</h6>';
                    }
                    ?>
                    <div class="border-top py-4">
                        <h5 class="font-size-20">
                            <p>Subtotal (<?php echo isset($subTotal) ? count($subTotal) : 0; ?> item) :</p>
                            <p class="text-danger">
                                <span>$</span>
                                <span id="deal-price">
                                    <?php echo $subtotal; ?>
                                </span>
                            </p>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
        <!-- !shopping cart items -->
    </div>
</section>
<!-- !Shopping cart section  -->
