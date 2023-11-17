<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Include PHPMailer library
class Reset
{
    private $db;

    public function __construct(Connect $db)
    {
        if (!isset($db->con)) {
            exit;
        }
        $this->db = $db;
    }

    public function sendOTP($email = null) {
        $data = json_decode(file_get_contents('php://input'), true);
    
        // Create a PHPMailer instance
        $mail = new PHPMailer(true);

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
            $mail->addAddress($email); // Recipient email
            $mail->addReplyTo('issemooncakes@gmail.com', 'admin_issemooncakes'); // Reply-to address

            // Generate a random OTP (6 digits)
            $OTP = rand(100000, 999999);

            // Email subject and body
            $mail->isHTML(true);
            $mail->Subject = 'OTP Code for Lunar Delights';
            $mail->Body = "Your OTP code is: " . $OTP;

            //Check if admin or user
            $sql = "SELECT OTP FROM users WHERE Email = ?";
            $result = $this->fetchSingleRow($sql, "s", $email);
            if($result) {
                $sql = "UPDATE users SET OTP='{$OTP}' WHERE Email = ?";
            }
            else {
                $sql = "UPDATE admin SET OTP='{$OTP}' WHERE Email = ?";
            }
            //Update OTP
            $result = $this->fetchSingleRow($sql, "s", $email);
            $_SESSION['email'] = $email;
            
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

    public function sendOTPProfile($username, $fullname, $email, $address , $phone) {
        $data = json_decode(file_get_contents('php://input'), true);
    
        // Create a PHPMailer instance
        $mail = new PHPMailer(true);

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
            $mail->addAddress($email); // Recipient email
            $mail->addReplyTo('issemooncakes@gmail.com', 'admin_issemooncakes'); // Reply-to address

            // Generate a random OTP (6 digits)
            $OTP = rand(100000, 999999);

            // Email subject and body
            $mail->isHTML(true);
            $mail->Subject = 'OTP Code for Lunar Delights';
            $mail->Body = "Your OTP code is: " . $OTP;

            //Check if admin or user
            $sql = "SELECT OTP FROM users WHERE Email = ?";
            $result = $this->fetchSingleRow($sql, "s", $email);
            if($result) {
                $sql = "UPDATE users SET OTP='{$OTP}' WHERE Email = ?";
            }
            else {
                $sql = "UPDATE admin SET OTP='{$OTP}' WHERE Email = ?";
            }
            //Update OTP
            $result = $this->fetchSingleRow($sql, "s", $email);
            $_SESSION['email'] = $email;
            $_SESSION['OTPsent'] = True;
            $_SESSION['storedUsername'] = $username;
            $_SESSION['storedFullName'] = $fullname;
            $_SESSION['storedEmail'] = $email;
            $_SESSION['storedAddress'] = $address;
            $_SESSION['storedPhone'] = $phone;
             
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

    public function verifyOTP($OTP = null, $email = null) {
        //Get stored OTP
        $sql = "SELECT OTP FROM users WHERE Email = ?";
        $isAdmin = False;
        $result = $this->fetchSingleRow($sql, "s", $email);
        if($result == null) {
            $sql = "SELECT OTP FROM admin WHERE Email = ?";
            $isAdmin = True;
            $result = $this->fetchSingleRow($sql, "s", $email);
        }

        if ($OTP === $result['OTP']) {
            $_SESSION['validOTP'] = True;
            if ($isAdmin) {
                $sql = "UPDATE admin SET OTP=null WHERE Email = ?";
            }
            else {
                $sql = "UPDATE users SET OTP=null WHERE Email = ?";
            }
            $result = $this->fetchSingleRow($sql, "s", $email);
            return 1;
        }
        else {
            echo "<script>alert('Incorrect OTP!');</script>";
            return 0;
        }
        header("Refresh:0");
        
    }

    public function verifyOTPProfile($OTP = null, $email = null) {
        //Get stored OTP
        $_SESSION['OTPsent'] = False;
        $sql = "SELECT OTP FROM users WHERE Email = ?";
        $isAdmin = False;
        $result = $this->fetchSingleRow($sql, "s", $email);
        if($result == null) {
            $sql = "SELECT OTP FROM admin WHERE Email = ?";
            $isAdmin = True;
            $result = $this->fetchSingleRow($sql, "s", $email);
        }
        if ($OTP === $result['OTP']) {
            $_SESSION['validOTP'] = True;
            if ($isAdmin) {
                $sql = "UPDATE admin SET OTP=null WHERE Email = ?";
            }
            else {
                $sql = "UPDATE users SET OTP=null WHERE Email = ?";
            }
            $result = $this->fetchSingleRow($sql, "s", $email);
            $_SESSION['OTPsent'] = False;
            return 1;
        }
        else {
            echo "<script>alert('Incorrect OTP!');</script>";
            return 0;
        }
        header("Refresh:0");
    }

    public function resetPassword($email, $newPassword1, $newPassword2) {
        if ($newPassword1 !== $newPassword2) {
            echo "<script>alert('Passwords do not match!');</script>";
        }
        else {
            $hashedPassword = password_hash($newPassword1, PASSWORD_BCRYPT);
            // Generate a random salt
            $salt = password_hash(random_bytes(16), PASSWORD_DEFAULT);

            //Check if admin or user
            $sql = "SELECT * FROM users WHERE Email = ?";
            $result = $this->fetchSingleRow($sql, "s", $email);
            if($result) {
                $sql = "UPDATE users SET PasswordHash='{$hashedPassword}', PasswordSalt='{$salt}' WHERE Email = ?";
            }
            else {
                $sql = "UPDATE admin SET PasswordHash='{$hashedPassword}', PasswordSalt='{$salt}' WHERE Email = ?";
            }
            //Update password
            $result = $this->fetchSingleRow($sql, "s", $email);
            $_SESSION['validOTP'] = False;
        }
        return null;
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
}
