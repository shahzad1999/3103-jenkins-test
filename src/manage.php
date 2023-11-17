<?php
ob_start();
// require functions.php file
require('func/functions.php');
// include header.php file
include('func/header.php');
?>

<?php
if ($_SESSION['role'] === 'Admin') {
    /*  include manage product */
    include('libs/_manage-product.php');
}
?>

<?php
// include footer.php file
include('func/footer.php');
?>
<script src="./js/form-validator.js"></script>