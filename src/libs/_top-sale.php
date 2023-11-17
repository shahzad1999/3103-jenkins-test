<section id="top-sale">
    <div class="container py-5">
        <h4 class="font-size-20">Top Sale</h4>
        <hr>
        <div class="owl-carousel owl-theme">
            <?php
            // Your PHP code to fetch mooncake details along with their ratings
            $sql = "SELECT mooncakes.*, ratings.Rating_Score FROM mooncakes
                    LEFT JOIN ratings ON mooncakes.MooncakeID = ratings.MooncakeID
                    LIMIT 6";
            $result = $db->con->query($sql);

            // Check if there are results
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                <div class="item py-2 border rounded-2 bg-light">
                    <div class="product">
                        <a href="product.php?mooncake_id=<?php echo $row['MooncakeID']; ?>"><img src="../assets/products/<?php echo $row['ImageURL']; ?>" alt="<?php echo $row['Name']; ?>" class="img-fluid"></a>
                        <div class="text-center">
                            <h6><a href="product.php?mooncake_id=<?php echo $row['MooncakeID']; ?>" style="color: white;"><?php echo $row['Name']; ?></a></h6>
                            <div class="rating text-warning font-size-12">
                                <?php
                                $ratingScore = $row['Rating_Score'];
                                $filledStars = floor($ratingScore);
                                $halfStar = ($ratingScore - $filledStars) >= 0.5;
                                $emptyStars = 5 - $filledStars - ($halfStar ? 1 : 0);

                                // Display the filled stars
                                for ($i = 0; $i < $filledStars; $i++) {
                                    echo '<span><i class="fas fa-star"></i></span>';
                                }

                                // Display the half-filled star, if applicable
                                if ($halfStar) {
                                    echo '<span><i class="fas fa-star-half-alt"></i></span>';
                                }

                                // Display the remaining empty stars
                                for ($i = 0; $i < $emptyStars; $i++) {
                                    echo '<span><i class="far fa-star"></i></span>';
                                }
                                ?>
                            </div>
                            <div class="price py-2">
                                <span>$<?php echo number_format($row['Price'], 2); ?></span>
                            </div>

                            <!-- Form for adding to the cart -->
                            <form action="cart.php" method="post">
                            <?php
                                if (isset($_SESSION['userid'])) {
                                    // If the user is logged in, show the form with the user ID
                                ?>
                                <input type="hidden" name="top_sale_submit" value="true">
                                <input type="hidden" name="user_id" value="<?php echo $_SESSION['userid']; ?>">
                                <input type="hidden" name="item_id" value="<?php echo $row['MooncakeID']; ?>">
                                <button type="submit" name="top_sale_submit" class="btn btn-warning font-size-12">Add to Cart</button>
                                <?php
                                } else {
                                    
                                ?>
                                <input type="button" class="btn btn-warning font-size-12" value="Add to Cart" onclick="showLoginAlert()">
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
            <?php
                }
            } else {
                echo "No mooncakes found.";
            }
            ?>
        </div>
    </div>
</section>
