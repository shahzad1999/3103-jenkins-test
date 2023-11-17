<?php
ob_start();
// require functions.php file
require('func/functions.php');
// include header.php file
include('func/header.php');
?>

<?php

/*  include login form  */
include('libs/_login-form.php')
/*  include login form  */

?>

<?php
// include footer.php file
include('func/footer.php');

?>

<script src="./js/form-validator.js"></script>
<script>
    var signInForm = new Validator('#sign-in');
</script>