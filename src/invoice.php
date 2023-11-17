<?php
    // Require functions.php file
    require('func/functions.php');
?>
<!DOCTYPE html>
<html lang="en">
<?php
    ob_start();
    // Include header.php file
    include('func/header.php');
    
?>
<head>
    <link rel="stylesheet" type="text/css" href="css/invoice.css">
</head>
<body class="invoice-body">
    <div class="invoice">
        <div class="invoice-header">
            <div class="invoice-logo">
                <img src="../assets/logo.png" alt="Lunar Delights" style="max-width: 150px;">
            </div>
            <div class="invoice-details">
                <p>Invoice Date: <?php 
                  // Set the time zone to Singapore
                date_default_timezone_set('Asia/Singapore');
                echo $currentDateTime = date('F j, Y, g:i a'); ?></p>
            </div>
        </div>

        <div class="invoice-bill-to">
            <h2>Bill To:</h2>
            <p>
            <?php
                if ($_SESSION['logged'] == true) {
                    echo $_SESSION['username'];
                }
            ?>
            </p> 
            <p><span id="bill-address">123 Main Street</span></p>
            <p><span id="bill-address2">Address Line 2</span></p>
            <p><span id="bill-city-state-zip">City, State, ZIP Code</span></p>
        </div>

        <div class="invoice-items">
            <?php
            /* Include cart items if it is not empty */
            count($cart->getCart($_SESSION['userid'] ?? 0)) ? include('libs/invoice_product_template.php') : include('libs/_cart-notFound.php');
            /* Include cart items if it is not empty */
            ?>
        </div>
        <button id="download-pdf"  onclick="proceedToBuy()" href="index.php" >Download PDF</button>
    </div>

    <!-- Start #footer -->
    <footer id="footer" class="bg-black text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-12">
                    <h4 class="font-size-20">Lunar Delights</h4>
                    <p class="font-size-14 text-white-50">Savoring the Celestial Glow: Lunar Delights, Your Mooncake Haven.</p>
                </div>
                <div class="col-lg-4 col-12">
                    <h4 class="font-size-20">Newsletter</h4>
                    <form>
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Enter your email">
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-primary my-2">Subscribe</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-2 col-12">
                    <h4 class="font-size-20">Information</h4>
                    <div class="d-flex flex-column flex-wrap">
                        <a href="#" class="font-size-14 text-white-50 pb-1">About Us</a>
                        <a href="#" class="font-size-14 text-white-50 pb-1">Delivery Information</a>
                        <a href="#" class="font-size-14 text-white-50 pb-1">Privacy Policy</a>
                        <a href="#" class="font-size-14 text-white-50 pb-1">Terms & Conditions</a>
                    </div>
                </div>
                <div class="col-lg-2 col-12">
                    <h4 class="font-size-20">Account</h4>
                    <div class="d-flex flex-column flex-wrap">
                        <a href="#" class="font-size-14 text-white-50 pb-1">My Account</a>
                        <a href="#" class="font-size-14 text-white-50 pb-1">Order History</a>
                        <a href="#" class="font-size-14 text-white-50 pb-1">Payment</a>
                        <a href="#" class="font-size-14 text-white-50 pb-1">Newsletters</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div class="copyright text-center py-2">
        <p class="font-size-14 my-0">&copy; Copyrights 2022. Design By ISSE.</p>
    </div>
    <!-- End #footer -->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

    <!-- Owl Carousel Js file -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha256-pTxD+DSzIwmwhOqTFN+DB+nHjO4iAsbgfyFq5K5bcE0=" crossorigin="anonymous"></script>

    <!-- Isotope plugin cdn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js"
        integrity="sha256-CBrpuqrMhXwcLLUd5tvQ4euBHCdh7wGlDfNz8vbu/iI=" crossorigin="anonymous"></script>

    <!-- Custom Javascript -->
    <script src="js/script.js"></script>
    <script src="invoice.js"></script>
    <script>
        // Check if localStorage is available
        if (typeof localStorage !== 'undefined') {
            // Retrieve the values from localStorage for the "Bill To" section
            var billToAddress = localStorage.getItem('deliveryAddress') || '123 Main Street';
            var billToAddress2 = localStorage.getItem('deliveryAddress2') || 'Address Line 2'; // Default value
            var billToCityStateZIP = localStorage.getItem('deliveryCity') + ', ' +
                localStorage.getItem('deliveryState') + ', ' +
                localStorage.getItem('deliveryPostalCode') || 'City, State, ZIP Code';

            // Update the HTML elements with the retrieved or default data
            document.getElementById('bill-address').textContent = billToAddress;
            document.getElementById('bill-address2').textContent = billToAddress2; // Update "Address Line 2"
            document.getElementById('bill-city-state-zip').textContent = billToCityStateZIP;
        }
    </script>
    <script>
        document.getElementById('download-pdf').addEventListener('click', function() {
            var invoiceContent = document.querySelector('.invoice').innerHTML;
            var styles = document.getElementsByTagName('style');

            // Create a new window and populate it with the invoice content and styles
            var newWindow = window.open('', '', 'width=800,height=600');
            newWindow.document.open();
            newWindow.document.write('<html><head><title>Invoice</title>');

            // Include CSS styles in the new window
            for (var i = 0; i < styles.length; i++) {
                newWindow.document.write(styles[i].outerHTML);
            }

            newWindow.document.write('</head><body>');
            newWindow.document.write(invoiceContent);
            newWindow.document.write('</body></html>');
            newWindow.document.close();

            // Use the window.print() method to open the print dialog and save as PDF
            newWindow.print();
            newWindow.close();
        });
    </script>
    <script>
     function proceedToBuy() {
        // Call the deleteCartbyID method with the user's ID before proceeding to the invoice page
        <?php
        if (isset($_SESSION['userid'])) {
            $userID = $_SESSION['userid'];

            $cart->deleteCartbyID(
                sanitize($userID, $db),
            );
        }
        ?>

        // Redirect to the invoice page
        window.location.href = "invoice.php";
    }
</script>
</body>
</html>
