<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('extension/connect.php');

// Function to generate a random OTP
function generate_otp($length = 6) {
    $otp = '';
    for ($i = 0; $i < $length; $i++) {
        $otp .= mt_rand(0, 9); // Generate a random number between 0 and 9
    }
    return $otp;
}

function is_valid_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// PHPMailer function to send the OTP
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function send_email_notification($to, $subject, $message) {
    $smtp_host = 'smtp.gmail.com';
    $smtp_port = '587'; // or 465 for SSL
    $smtp_username = 'tbcare926@gmail.com';
    $smtp_password = 'wsmjeyfpnewlrezu';

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host       = $smtp_host;
    $mail->SMTPAuth   = true;
    $mail->Username   = $smtp_username;
    $mail->Password   = $smtp_password;
    $mail->SMTPSecure = 'tls';
    $mail->Port       = $smtp_port;
    
    $mail->setFrom($smtp_username, 'TB-CARE');
    $mail->addAddress($to);
    $mail->Subject = $subject;
    $mail->Body    = $message;

    return $mail->send();
}

$status = ''; 
$otp_sent = false; // Add a flag to check if the OTP is sent

if (isset($_POST['register'])) {
    $user_name = mysqli_real_escape_string($con, $_POST['username']);

    // Generate a one-time PIN (OTP)
    $otp_pin = generate_otp();

    // Check if the email is valid
    if (is_valid_email($user_name)) {
        // Check if the user already exists in the database
        $query_check = mysqli_query($con, "SELECT * FROM users WHERE user_name = '$user_name'");

        if (mysqli_num_rows($query_check) > 0) {
            // If user exists, update the OTP
            $query_update = mysqli_query($con, "UPDATE users SET otpin = '$otp_pin' WHERE user_name = '$user_name'");

            if ($query_update) {
                // Send the OTP via email
                $subject = 'Your One-Time PIN (OTP) FOR FILES';
                $message = 'Your one-time PIN is: ' . $otp_pin;
                if (send_email_notification($user_name, $subject, $message)) {
                    $status = '<div class="alert alert-success">Your OTP has been generated and sent to your email.</div>';
                    $otp_sent = true; // Mark that the OTP was sent successfully
                } else {
                    $status = '<div class="alert alert-warning">Failed to send OTP via email.</div>';
                }
            } else {
                $status = '<div class="alert alert-danger">Failed to generate OTP. Please try again later.</div>';
            }
        } else {
            // User does not exist
            $status = '<div class="alert alert-danger">User does not exist in the system.</div>';
        }
    } else {
        $status = '<div class="alert alert-warning">Invalid email format.</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/login.css">
    <title>Generate OTP</title>
</head>
<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #e6f7ff;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 600px;
    margin: 50px auto;
    padding: 20px;
    background-color: white;
    border-radius: 10px;
    box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
}

.form-wrapper {
    text-align: left;
    padding: 20px;
}

h2 {
    font-size: 24px;
    color: #333;
    margin-bottom: 10px;
}

small {
    display: block;
    margin-bottom: 20px;
    color: red;
}

.actions {
    margin-top: 20px;
}

.button-back, .button-send {
    display: inline-block;
    background-color: #3498db;
    color: white;
    text-decoration: none;
    padding: 10px 15px;
    border-radius: 5px;
    border: none;
    font-size: 16px;
    cursor: pointer;
}

.button-back:hover, .button-send:hover {
    background-color: #2980b9;
}

.button-back {
    text-align: center;
    margin-top: 10px;
    text-decoration: none;
}


</style>
<body>
    <div class="container">
        <div class="form-wrapper">
            <h2>Generate OTP</h2>
            <small style="color:red"><?php echo $status; ?></small>

            <!-- If OTP was sent, show the "Back" button instead -->
            <?php if ($otp_sent): ?>
                <div class="actions">
                    <a href="dashboard" class="button-back">Back</a>
                </div>
            <?php else: ?>
                <form method="post">
                    <input type="hidden" id="username" name="username" value="sikatpinoy6@gmail.com" required>
                    <div class="actions">
                        <button type="submit" name="register" class="button-send">Send OTP Now</button>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
