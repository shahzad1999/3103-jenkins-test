<?php
ob_start();
// require functions.php file
require('func/functions.php');
// include header.php file
include('func/header.php');
?>

<?php

/*  include register form  */
include('libs/_register-form.php')
/*  include register form  */

?>

<?php
// include footer.php file
include('func/footer.php');
?>


<script src="./js/form-validator.js"></script>
<script>
    var signUpForm = new Validator('#sign-up');
</script>