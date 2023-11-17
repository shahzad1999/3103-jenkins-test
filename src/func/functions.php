<?php
// start a session
session_start();
error_reporting(E_ALL & ~E_NOTICE);

if(!isset($_SESSION['username']))
{
	$_SESSION['username'] = "Guest";
}

if (!isset($_SESSION['logged'])) {
    $_SESSION['logged'] = false;
}

// require MySQL Connection
require('func/DBConnect.php');

// require Product Class
require('func/Product.php');

// require Cart Class
require('func/Cart.php');

// require Account Class
require('func/Account.php');

// require Manage Class
require('func/Manage.php');

// require Reset Class
require('func/Reset.php');

// Connect object
$db = new Connect();

// Product object
$product = new Product($db);
$productData = $product->getData();

// Cart object
$cart = new Cart($db);

// Account object
$acc = new Account($db);
$accData = $acc->getData('admin');

// Manage object
$manage = new Manage($db);
$manageData = $manage->getData();

$reset = new Reset($db);

function sanitize($input, $db){
    return htmlspecialchars(mysqli_real_escape_string($db->con, $input), ENT_QUOTES, 'UTF-8');
}

// Request method post 
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['top_sale_submit']) && isset($_POST['item_id']) && isset($_POST['user_id'])) {
        // call method addToCart
        $cart->addToCart(
            sanitize($_POST['user_id'], $db),
            sanitize($_POST['item_id'], $db),
        );
    }
}

// request method post 
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['special_price_submit']) && isset($_POST['item_id']) && isset($_POST['user_id'])) {
        // call method addToCart
        $cart->addToCart(
            sanitize($_POST['user_id'], $db),
            sanitize($_POST['item_id'], $db),
        );
    }
}

// request method post
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['new_mooncakes_submit']) && isset($_POST['item_id']) && isset($_POST['user_id'])) {
        // call method addToCart
        $cart->addToCart(
            sanitize($_POST['user_id'], $db),
            sanitize($_POST['item_id'], $db),
        );
    }
}

// request method post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete-cart-submit'])) {
        // call method deleteCart  
        $cart->deleteCart(
            sanitize($_POST['OrderID'], $db),
        );
        
    }
}
// request method post
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['buy_product_submit'])) {
        // call method addToCart
        $cart->addToCart(
            sanitize($_POST['user_id'], $db),
            sanitize($_POST['item_id'], $db),
        );
    }
}
// request method post for login
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['login-submit'])) {
        // call method user login
        $acc->login(
            sanitize($_POST['username'], $db),
            sanitize($_POST['password'], $db),
            'users'
        );
    }
}

// request method post for login
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['admin-login-submit'])) {
        // call method admin login
        $acc->login(
            sanitize($_POST['username'], $db),
            sanitize($_POST['password'], $db), 
            'admin'
        );
    }
}

// request method post
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['logout-submit'])) {
        // call method logout
        $acc->logout();
    }
}

// request method post
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['edit-profile'])) {
        // call method logout
        $acc->edit_profile();
    }
}

// request method post
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['register-submit'])) {
        // call method register
        $acc->register(
            sanitize($_POST['username'], $db),
			sanitize($_POST['fullname'], $db),
            sanitize($_POST['password'], $db),
            sanitize($_POST['email'], $db),
            sanitize($_POST['address'], $db),
			sanitize($_POST['phone'], $db),
        );
    }
}
// request method post
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['manage-delete'])) {
        if (isset($_GET['id'])) {
            // call method deleteProduct
            $manage->deleteProduct(
                sanitize($_GET['id'], $db),
            );
        } else {
            echo "<script>alert('invalid id');</script>";
        }
    }
}
// request method post
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['manage-update'])) {
        if (isset($_GET['id'])) {
            // call method updateProduct
            $manage->updateProduct(
                sanitize($_GET['id'], $db),
                sanitize($_POST['name-' . $_GET['id']], $db),
                sanitize($_POST['desc-' . $_GET['id']], $db),
                sanitize($_POST['stock-' . $_GET['id']], $db),
                sanitize($_POST['price-' . $_GET['id']], $db),
                sanitize($_FILES['image-' . $_GET['id']], $db),
            );
        } else {
            echo "<script>alert('invalid id');</script>";
        }
    }
}
// request method post
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['manage-insert'])) {
        // call method insertProduct
        $manage->insertProduct(
            sanitize($_POST['name-' . $_GET['id']], $db),
            sanitize($_POST['desc-' . $_GET['id']], $db),
            sanitize($_POST['stock-' . $_GET['id']], $db),
            sanitize($_POST['price-' . $_GET['id']], $db),
            sanitize($_FILES['image-' . $_GET['id']], $db),
        );
    }
}
// request method post
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['admin-account-delete'])) {
        if (isset($_GET['id'])) {
            // call method deleteAcc
            $acc->deleteAdminAcc(
                sanitize($_GET['id'], $db),
                'admin',
            );
        } else {
            echo "<script>alert('invalid id');</script>";
        }
    }
}
// request method post
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['admin-account-update'])) {
        if (isset($_GET['id'])) {
            // call method updateAcc
            $acc->updateAdminAcc(
                sanitize($_GET['id'], $db),
                sanitize($_POST['username-' . $_GET['id']], $db),
                sanitize($_POST['fullname-' . $_GET['id']], $db),				
                sanitize($_POST['email-' . $_GET['id']], $db),
				sanitize($_POST['address-' . $_GET['id']], $db),
				sanitize($_POST['phone-' . $_GET['id']], $db),
                'admin',
            );
        } else {
            echo "<script>alert('invalid id');</script>";
        }
    }
}
// request method post
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['admin-account-insert'])) {
        // call method addAdmin
        $acc->addAdmin(
            sanitize($_GET['id'], $db),
            sanitize($_POST['username-' . $_GET['id']], $db),
            sanitize($_POST['fullname-' . $_GET['id']], $db),				
            sanitize($_POST['email-' . $_GET['id']], $db),
            sanitize($_POST['address-' . $_GET['id']], $db),
            sanitize($_POST['phone-' . $_GET['id']], $db),
        );
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['useraccount-update'])) {
        if (isset($_GET['id'])) {
            // call method usrupdateAcc
            $acc->usrupdateAcc(
                sanitize($_GET['id'], $db),
                sanitize($_POST['inputUsername-' . $_GET['id']], $db),
				sanitize($_POST['inputFullName-' . $_GET['id']], $db),
                sanitize($_POST['inputEmail-' . $_GET['id']], $db),
				sanitize($_POST['inputAddress-' . $_GET['id']], $db),
				sanitize($_POST['inputPhone-' . $_GET['id']], $db),
                sanitize($_GET['role'], $db),
            );
        } else {
            echo "<script>alert('invalid id');</script>";
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['send-otp-email'])) {
        $reset->sendOTP(
            sanitize($_POST['email'], $db),
        );
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['resend-otp-email'])) {
        if (isset($_GET['id'])) {
            $reset->sendOTPProfile(
                sanitize($_POST['inputEmail-' . $_GET['id']], $db),
            );
        }
        else {
            echo "<script>alert('invalid id');</script>";
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['verify-otp'])) {
        $reset->verifyOTP(
            sanitize($_POST['otp'], $db),
            sanitize($_GET['email'], $db),
        );
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['reset-password'])) {
        if (isset($_GET['id'])) {
            $reset->resetPassword(
                sanitize($_GET['email'], $db),
                sanitize($_POST['new-password'], $db),
                sanitize($_POST['confirm-new-password'], $db),
            );
        }
        else {
            echo "<script>alert('invalid id');</script>";
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['send-otp-profile'])) {
        if (isset($_GET['id'])) {
            $reset->sendOTPProfile(
                sanitize($_POST['inputUsername-' . $_GET['id']], $db),
                sanitize($_POST['inputFullName-' . $_GET['id']], $db),
                sanitize($_POST['inputEmail-' . $_GET['id']], $db),
                sanitize($_POST['inputAddress-' . $_GET['id']], $db),
                sanitize($_POST['inputPhone-' . $_GET['id']], $db),
            );
        }
        else {
            echo "<script>alert('invalid id');</script>";
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['verify-otp-profile'])) {
        if (isset($_GET['id'])) {
            $result = $reset->verifyOTPProfile(
                sanitize($_POST['otp-' . $_GET['id']], $db),
                sanitize($_POST['email'], $db),
            );
            if ($result) {
                $acc->usrupdateAcc(
                    sanitize($_GET['id'], $db),
                    sanitize($_POST['inputUsername-' . $_GET['id']], $db),
				    sanitize($_POST['inputFullName-' . $_GET['id']], $db),
                    sanitize($_POST['email'], $db),
                    sanitize($_POST['inputAddress-' . $_GET['id']], $db),
				    sanitize($_POST['inputPhone-' . $_GET['id']], $db),
                    sanitize($_GET['role'], $db),
                );
            } 
        }
        else {
            echo "<script>alert('invalid id');</script>";
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['send-otp-login'])) {
        $acc->sendOTPLogin(
            sanitize($_POST['username'], $db),
            sanitize($_POST['password'], $db),
        );
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['verify-otp-login'])) {
        $result = $acc->verifyOTPLogin(
            sanitize($_POST['otp'], $db),
            sanitize($_POST['username'], $db),
        );
        if ($result) {
            $acc->login(
                sanitize($_POST['username'], $db),
                sanitize($_POST['password'], $db),
                'users'
            );
        } 
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['verify-otp-admin-login'])) {
        $result = $acc->verifyOTPLogin(
            sanitize($_POST['otp'], $db),
            sanitize($_POST['username'], $db),
        );
        if ($result) {
            $acc->login(
                sanitize($_POST['username'], $db),
                sanitize($_POST['password'], $db),
                'admin'
            );
        } 
    }
}

?>