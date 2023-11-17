<?php
// Require functions.php file
require('func/functions.php');
?>
<!DOCTYPE html>
<html lang="en">
<?php
// Include header.php file
include('func/header.php');
?>

<main id="main-site">
<?php
// Include _banner-area.php file
include('libs/_banner-area.php');

// Include _top-sale.php file
include('libs/_top-sale.php');

// Include _special-price.php file
include('libs/_special-price.php');

// Include _banner-ads.php file
include('libs/_banner-ads.php');

// Include _new-mooncakes.php file
include('libs/_new-mooncakes.php');

// Include _blogs.php file
include('libs/_blogs.php');
?>
</main>

<?php 
// Include footer.php file
include('func/footer.php');
?>
</html>
