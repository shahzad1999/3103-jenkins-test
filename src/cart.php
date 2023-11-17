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

<?php
/*  include cart items if it is not empty */
count($cart->getCart($_SESSION['userid'] ?? 0)) ? include('libs/_cart-template.php') : include('libs/_cart-notFound.php');
/*  include cart items if it is not empty */

/*  include top sale section */
include('libs/_top-sale.php');
/*  include top sale section */
?>

<?php
// include footer.php file
include('func/footer.php');
?>
