<!-- start #account -->
<section id="account" class="py-3">
    <?php 
        if ($_SESSION['logged'] == 0) {
            header("Location: login.php");
        }
        if (!isset($_SESSION['OTPsent'])) {
            $_SESSION['OTPsent'] = false;
        } 
    ?>
<div class="container-xl px-4 mt-4">
    <div class="row">
        <div class="col-xl-8">
            <!-- Account details card-->
            
            <div>
                <div>
                <?php 
                    if ($_SESSION['OTPsent'] === False) { 
                        echo 'Account Details';
                    }
                    else {
                        echo 'Enter OTP to continue';
                    }
                ?>
                </div>
                <div class="card-body">
                    <?php
                        if ($_SESSION['role'] === 'Admin') {
                            $user = $acc->getAccount($_SESSION['userid'], 'admin');
                        }
                        else {
                            $user = $acc->getAccount($_SESSION['userid'], 'users');
                        }  
                    ?>
                    <?php if ($_SESSION['OTPsent'] === False) { 
                        echo '<form method="POST">
                            <!-- Form Group (Username)-->
                            <div class="mb-3 form-group">
                                <label class="small mb-1" for="inputUsername">Username</label>
                                <input class="form-control" name="inputUsername-' . $_SESSION['userid'] . '" type="text" value="' . $user['Username'] . '">
                            </div>
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (Full name)-->
                                <div class="col-md-6 form-group">
                                    <label class="small mb-1" for="inputFullName">Full Name</label>
                                    <input class="form-control" name="inputFullName-' . $_SESSION['userid'] . '" type="text" value="' . $user['FullName'] . '">
                                </div>
                                <!-- Form Group (Email)-->
                                <div class="col-md-6 form-group">
                                    <label class="small mb-1" for="inputEmail">Email</label>
                                    <input class="form-control" name="inputEmail-' . $_SESSION['userid'] . '" type="text" value="' . $user['Email'] . '">
                                </div>
                            </div>
                            <!-- Form Group (Address)-->
                            <div class="mb-3 form-group">
                                <label class="small mb-1" for="inputAddress">Address</label>
                                <input class="form-control" name="inputAddress-' . $_SESSION['userid'] . '" type="text" value="' . $user['Address'] . '">
                            </div>						
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (phone number)-->
                                <div class="col-md-6 form-group">
                                    <label class="small mb-1" for="inputPhone">Phone number</label>
                                    <input class="form-control" name="inputPhone-' . $_SESSION['userid'] . '" type="tel" value="' . $user['Phone'] . '">
                                </div>
                                <!-- Form Group (birthday)-->
                                <div class="col-md-6 form-group">
                                    <label class="small mb-1" for="inputDOC">Date of Creation</label>
                                    <input class="form-control" name="inputDOC" type="text" disabled="disabled" value="' . $user['RegistrationDate'] . '">
                                </div>
                            </div>
                            <button class="btn btn-primary form-submit" type="submit"
                                formaction="useraccount.php?id=' . $_SESSION['userid'] . '"
                                name="send-otp-profile">Save changes
                            </button>
                        </form>';
                    }
                    else {
                        echo '<form method="POST">
                            <div class="form-group" id="otp-group" style="padding:10px;margin-top:20px;">
                                <label for="otp">Enter OTP:</label>
                                <input type="text" id="otp" name="otp-' . $_SESSION['userid'] . '" style="width: 100%;">
                                <input type="hidden" id="profile" name="inputUsername-' . $_SESSION['userid'] . '" style="width: 100%;" value = "' . $_SESSION['storedUsername'] . '">
                                <input type="hidden" id="profile" name="inputFullName-' . $_SESSION['userid'] . '" style="width: 100%;" value = "' . $_SESSION['storedFullName'] . '">
                                <input type="hidden" id="profile" name="email" style="width: 100%;" value = "' . $_SESSION['storedEmail'] . '">
                                <input type="hidden" id="profile" name="inputAddress-' . $_SESSION['userid'] . '" style="width: 100%;" value = "' . $_SESSION['storedAddress'] . '">
                                <input type="hidden" id="profile" name="inputPhone-' . $_SESSION['userid'] . '" style="width: 100%;" value = "' . $_SESSION['storedPhone'] . '">
                                <button class="form-submit" type="submit" 
                                formaction="useraccount.php?id=' . $_SESSION['userid'] . '"
                                name="send-otp-email">Resend OTP</button>
                                <button class="form-submit" type="submit" 
                                formaction="useraccount.php?id=' . $_SESSION['userid'] . '&role=' . $_SESSION['role'] . '"
                                name="verify-otp-profile">Verify OTP</button>
                            </div>
                        </form>';
                    }
                    ?>    
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</section>
