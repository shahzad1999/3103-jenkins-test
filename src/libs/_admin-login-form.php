<!-- start login -->
<section class="login">
    <?php
        if (!isset($_SESSION['OTPsent'])) {
            $_SESSION['OTPsent'] = false;
        }
    ?>
    <div class="main py-3">
        <!-- log in -->
        <form method="POST" class="form" id="sign-in">
            <?php if ($_SESSION['logged'] == true) { ?>
                <h3>
                    Welcome back,
                    <span>
                        <?php echo $user = $acc->getAccount($_SESSION['userid'], 'admin')['Username']; ?>!
                    </span>
                </h3>
                <h5 class="mb-2">
                    <strong>
                        <?php 
                        echo $user = $acc->getAccount($_SESSION['userid'], 'admin')['Email']; ?>
                    </strong>
                </h5>
                <p class="text-muted">
                    Web designer<br/>
                    <span class="badge bg-primary">
                        Administrator
                    </span>
                </p>
				<button class="form-submit" type="submit" name="edit-profile">Edit profile</button>
                <button class="form-submit" type="submit" name="logout-submit">Log out</button>
            <?php }
            else {
                if ($_SESSION['OTPsent'] === False) {
                    echo '<h3 class="heading">Sign in</h3>
                    <p class="desc">Log in to access admin functions!</p>
                    <div class="row" style="width: 400px;">
                        <div class="col">
                            <div class="form-group">
                                <label for="username" class="form-label">Username</label>
                                <input id="username" name="username" type="text" rules="required|min:3|max:10"
                                    placeholder="Enter username" class="form-control">
                                <span class="form-message"></span>
                            </div>

                            <div class="form-group">
                                <label for="password" class="form-label">Password</label>
                                <input id="password" name="password" type="password" rules="required|min:3"
                                    placeholder="Enter password" class="form-control">
                                <span class="form-message"></span>
                            </div>
                        </div>
                    </div>

                    <button class="form-submit" type="submit" name="send-otp-login">Sign in</button>
                    <a href="./reset_password.php">Forgot Password?</a>';
                }
                else {
                    echo '<form method="POST">
                        <div class="form-group" id="otp-group" style="padding:10px;margin-top:20px;">
                            <label for="otp">Enter OTP:</label>
                            <input type="text" id="otp" name="otp" style="width: 100%;">
                            <input type="hidden" id="profile" name="username" style="width: 100%;" value = "' . $_SESSION['storedUsername'] . '">
                            <input type="hidden" id="profile" name="password" style="width: 100%;" value = "' . $_SESSION['storedPassword'] . '">
                            <button class="form-submit" type="submit" 
                            name="send-otp-login">Resend OTP</button>
                            <button class="form-submit" type="submit" 
                            name="verify-otp-admin-login">Verify OTP</button>
                        </div>
                    </form>';
                }
            }
        ?>
        </form>

    </div>
</section>
<!-- !start login -->