<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Include PHPMailer library
class Account
{
    private $db;

    public function __construct(Connect $db)
    {
        if (!isset($db->con)) {
            exit;
        }
        $this->db = $db;
    }

    public function getData($table = 'users')
    {
        $sql = "SELECT * FROM $table";
        $stmt = $this->prepareAndExecute($sql);

        if ($stmt) {
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        return [];
    }

    public function getAccount($userID = null, $table = 'users')
    {
        if ($userID !== null) {
            if ($table === 'users'){
                $sql = "SELECT * FROM $table WHERE UserID = ?";
            }
            else {
                $sql = "SELECT * FROM $table WHERE AdminID = ?";
            }
            $result = $this->fetchSingleRow($sql, "i", $userID);
            return $result;
        }

        return null;
    }

	public function deleteAdminAcc($userID = null, $table = 'admin')
    {
        if ($userID !== null) {
            $sql = "DELETE FROM $table WHERE AdminID = ?";
			header("Refresh:0");
            return $this->fetchSingleRow($sql, "i", $userID);
        }

        return null;
    }
	
	public function updateAdminAcc($userID = null, $username = null, $fullname = null, $email = null, $address = null, $phone = null, $table = 'admin')
	{
		{
			if ($userID !== null) {
				$sql = "UPDATE $table SET Username='{$username}', FullName='{$fullname}', Email='{$email}', Address='{$address}', Phone='{$phone}' WHERE AdminID = ?";
				$result = $this->fetchSingleRow($sql, "i", $userID);
				header("Refresh:0");
				return $result;
			}

			return null;
		}

	}
	
	public function usrupdateAcc($userID = null, $username = null, $fullname = null, $email = null, $address = null, $phone = null, $role = null)
	{
		{
			if ($userID !== null) {
                if ($role == 'User') {
                    $sql = "UPDATE users SET Username='{$username}', FullName='{$fullname}', Email='{$email}', Address='{$address}', Phone='{$phone}' WHERE UserID = ?";
                }
				else {
                    $sql = "UPDATE admin SET Username='{$username}', FullName='{$fullname}', Email='{$email}', Address='{$address}', Phone='{$phone}' WHERE AdminID = ?";
                }
				$result = $this->prepareAndExecute($sql, "i", $userID);
                $_SESSION['validOTP'] = False;
				header("Location: useraccount.php");
				return $result;
			}

			return null;
		}

	}
	
    public function login($username = null, $password = null, $table = 'users')
    {
        if ($username !== null && $password !== null) {
            $sql = "SELECT * FROM $table WHERE Username = ?";
            $stmt = $this->prepareAndExecute($sql, "s", $username);

            if ($stmt) {
                $row = $stmt->get_result()->fetch_assoc();

                if ($row && password_verify($password, $row['PasswordHash'])) {
                    $this->startSession($row, $table);
                    return true;
                }
            }
        }

        return false;
    }

    public function logout()
    {
        if ($this->isUserLoggedIn()) {
            $this->endSession();
            return true;
        }

        return false;
    }
	
	public function edit_profile()
    {
        if ($this->isUserLoggedIn()) {
            header("Location: useraccount.php");
			window.location(url);
        }

        return false;
    }

    private function prepareAndExecute($sql, ...$params)
    {
        $stmt = $this->db->con->prepare($sql);

        if ($stmt) {
            if (!empty($params)) {
                $stmt->bind_param(...$params);
            }
            $stmt->execute();
            return $stmt;
        }

        return null;
    }

    private function fetchSingleRow($sql, $types, ...$params)
    {
        $stmt = $this->prepareAndExecute($sql, $types, ...$params);
        if ($stmt) {
            $result = $stmt->get_result();
            return $result->num_rows === 1 ? $result->fetch_assoc() : null;
        }

        return null;
    }
   
    
    public function register(
        $username = null,
		$fullname = null,
        $password = null,
        $email = null,
        $address = null,
		$phone = null
    ) {
        if (
            $username != null
            && $password != null
            && $email != null
        ) {
            if ($address == null) {
                $address = null;
            }
            // Set the default role to 'User'
			$datetime = date_create()->format('Y-m-d H:i:s');
            // Hash the password with bcrypt
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            // Generate a random salt
            $salt = password_hash(random_bytes(16), PASSWORD_DEFAULT);
    		$userid = 0;
			$OTP = null;
                       
            
            // Use prepared statements with named parameters
            $sqlAccount = "INSERT INTO users (UserID, Username, FullName, PasswordHash, PasswordSalt, Email, RegistrationDate, Address, Phone, OTP) 
                            VALUES ('$userid', '$username', '$fullname', '$hashedPassword', '$salt', '$email', '$datetime', '$address', '$phone', '$OTP')";
            
            // Prepare and execute the SQL statement
            $stmt = $this->db->con->prepare($sqlAccount);
            
            if ($stmt) {
                // Execute the statement
                if ($stmt->execute()) {
                    echo "<script>alert('Register Success');</script>";
                    header("Location: login.php");
                    return true;
                } else {
                    echo "<script>alert('Register fail');</script>";
                    return false;
                }
            }
        }
    }
	
	
	// Adding of users via Admin Panel
	public function addAdmin(
		$userid = null,
        $username = null,
		$fullname = null,
        $email = null,
        $address = null,
		$phone = null,
    ) {
        if (
            $username != null
            && $email != null
        ) {
            if ($address == null) {
                $address = null;
            }
			
			$password = substr(str_shuffle('abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRTUVWXYZ2346789'),0,10);
            // Hash the password with bcrypt
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            // Generate a random salt
            $salt = password_hash(random_bytes(16), PASSWORD_DEFAULT);
			$datetime = date_create()->format('Y-m-d H:i:s');
            // Hash the password with bcrypt
    		$userid = 0;
			$OTP = 000000;
                       
            
            // Use prepared statements with named parameters
            $sqlAccount = "INSERT INTO admin (AdminID, Username, FullName, PasswordHash, PasswordSalt, Email, RegistrationDate, Address, Phone, OTP) 
                            VALUES ('$userid', '$username', '$fullname', '$hashedPassword', '$salt', '$email', '$datetime', '$address', '$phone', '$OTP')";
            
            // Prepare and execute the SQL statement
            $stmt = $this->db->con->prepare($sqlAccount);
            
            if ($stmt) {
                // Execute the statement
                if ($stmt->execute()) {
                    echo "<script>alert('Register Success');</script>";
                    header('Location: ' . $_SERVER['REQUEST_URI']);
                    return true;
                } else {
                    return false;
                }
            }
        }
    }

    public function sendOTPLogin($username, $password) {
        $data = json_decode(file_get_contents('php://input'), true);
        
        // Create a PHPMailer instance
        $mail = new PHPMailer(true);

        // Generate a random OTP (6 digits)
        $OTP = rand(100000, 999999);

        //Check if admin or user
        $sql = "SELECT Email FROM users WHERE Username = ?";
        $result = $this->fetchSingleRow($sql, "s", $username);
        if($result) {
            $sql = "UPDATE users SET OTP='{$OTP}' WHERE Username = ?";
        }
        else {
            $sql = "SELECT Email FROM admin WHERE Username = ?";
            $result = $this->fetchSingleRow($sql, "s", $username);
            $sql = "UPDATE admin SET OTP='{$OTP}' WHERE Username = ?";
        }
        try {
            // Server settings
            $mail->isSMTP();
            $mail->SMTPDebug = SMTP::DEBUG_OFF; // Set to DEBUG_SERVER for debugging
            $mail->Host = 'smtp.gmail.com'; // Your SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'issemooncakes@gmail.com'; // Your SMTP username
            $mail->Password = 'jkba tiio sbvz mjia'; // Your SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
            $mail->Port = 587; // Set the SMTP port to use TLS

            // Recipients
            $mail->setFrom('issemooncakes@gmail.com', 'admin_issemooncakes'); // Your email and name
            $mail->addAddress($result['Email']); // Recipient email
            $mail->addReplyTo('issemooncakes@gmail.com', 'admin_issemooncakes'); // Reply-to address

            // Email subject and body
            $mail->isHTML(true);
            $mail->Subject = 'OTP Code for Lunar Delights';
            $mail->Body = "Your OTP code is: " . $OTP;

            //Update OTP
            $result = $this->fetchSingleRow($sql, "s", $username);
            $_SESSION['OTPsent'] = True;
            $_SESSION['storedUsername'] = $username;
            $_SESSION['storedPassword'] = $password;
             
            //Send email
            $mail->send();
            http_response_code(200);
            header("Refresh:0");
            return null;
        } 
        catch (Exception $e) {
            http_response_code(500);
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    public function verifyOTPLogin($OTP = null, $username = null) {
        //Get stored OTP
        $_SESSION['OTPsent'] = False;
        $sql = "SELECT OTP FROM users WHERE Username = ?";
        $isAdmin = False;
        $result = $this->fetchSingleRow($sql, "s", $username);
        if($result == null) {
            $sql = "SELECT OTP FROM admin WHERE Username = ?";
            $isAdmin = True;
            $result = $this->fetchSingleRow($sql, "s", $username);
        }
        if ($OTP === $result['OTP']) {
            $_SESSION['validOTP'] = True;
            if ($isAdmin) {
                $sql = "UPDATE admin SET OTP=null WHERE Username = ?";
            }
            else {
                $sql = "UPDATE users SET OTP=null WHERE Username = ?";
            }
            $result = $this->fetchSingleRow($sql, "s", $username);
            $_SESSION['OTPsent'] = False;
            return 1;
        }
        else {
            echo "<script>alert('Incorrect OTP!');</script>";
            return 0;
        }
        header("Refresh:0");
    }

    private function startSession($user, $table)
    {
        $_SESSION['username'] = $user['Username'];
        if ($table == 'users'){
            $_SESSION['userid'] = $user['UserID'];
        }
        else {
            $_SESSION['userid'] = $user['AdminID'];
        }
        if ($table == 'users'){
            $_SESSION['role'] = 'User';
        }
        else {
            $_SESSION['role'] = 'Admin';
        }
        $_SESSION['fullname'] = $user['FullName'];
        $_SESSION['email'] = $user['Email'];
        $_SESSION['address'] = $user['Address'];
        $_SESSION['phone'] = $user['Phone'];
        $_SESSION['date'] = $user['RegistrationDate'];
        $_SESSION['logged'] = true;
        echo "<script>alert('Login Success');</script>";
        header('Location: ' . $_SERVER['REQUEST_URI']);
    }

    private function endSession()
    {
        session_start();
        $_SESSION['logged'] = false;
        $_SESSION['OTPsent'] = False;
        header('Location: ' . $_SERVER['REQUEST_URI']);
    }

    private function isUserLoggedIn()
    {
        return isset($_SESSION['logged']) && $_SESSION['logged'] == true;
    }
}
