<section id="new-mooncakes">
    <div class="container">
        <h4 class="font-size-20">New Mooncakes</h4>
        <hr>
        <div class="owl-carousel owl-theme">
            <?php
            // Your PHP code to fetch new mooncakes from the database
            $sql = "SELECT * FROM mooncakes LIMIT 6 OFFSET 10";
            $result = $db->con->query($sql);

            // Check if there are results
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
            <div class="item py-2 border rounded-2 bg-light">
                <div class="product">
                    <a href="product.php?mooncake_id=<?php echo $row['MooncakeID']; ?>">
                        <img src="../assets/products/<?php echo $row['ImageURL']; ?>" alt="<?php echo $row['Name']; ?>" class="img-fluid">
                    </a>
                    <div class="text-center">
                        <h6><a href="product.php?mooncake_id=<?php echo $row['MooncakeID']; ?>" style="color: white;"><?php echo $row['Name']; ?></a></h6> 
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
                echo "No new mooncakes found.";
            }
            ?>
        </div>
    </div>
</section>
