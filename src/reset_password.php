<?php
    // require functions.php file
    require('func/functions.php');
?>
<!DOCTYPE html>
<html lang="en">
<?php
    ob_start();
    // include header.php file
    include('func/header.php');
    if (!isset($_SESSION['validOTP'])) {
        $_SESSION['validOTP'] = false;
    }
?>
<head>
    <title>Reset Password</title>
    <link rel="stylesheet" type="text/css" href="css/reset_password.css">
</head>
<body>
    <section>
        <div class="container">
            <h2>Reset Password</h2>
            <form method="POST" id="send-form" class="form">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" style="width: 100%;" required>
                    <button class="form-submit" type="submit" name="send-otp-email">Send OTP</button>
                </div>
            </form>
            <form method="POST" id="verify-form" class="form">
                <div class="form-group" id="otp-group">
                    <label for="otp">Enter OTP:</label>
                    <input type="text" id="otp" name="otp" style="width: 100%;" required>
                    <button class="form-submit" type="submit" 
                    formaction="reset_password.php?email=<?php echo $_SESSION['email'] ?>"
                    name="verify-otp">Verify OTP</button>
                </div>
            </form>
            <?php if($_SESSION['validOTP']) {
                echo '<form method="POST" id="reset-form" class="form">
                    <div class="form-group">
                        <label for="new-password">New Password:</label>
                        <input id="new-password" name="new-password" type="password" rules="required|min:3"
                                        placeholder="Enter new password" class="form-control" style="width: 100%;" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm-new-password">Confirm New Password:</label>
                        <input id="confirm-new-password" name="confirm-new-password" type="password" rules="required|min:3"
                                        placeholder="Confirm new password" class="form-control" style="width: 100%;" required>
                    </div>
                    <button class="form-submit" type="submit" name="reset-password">Reset Password</button>
                </form>';
            }
            ?>
            <div id="message"></div>
        </div>
    </section>
</body>
<?php 
    // include footer.php file
    include('func/footer.php');
?>
<script src="./js/form-validator.js"></script>
</html>
