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

function is_valid_gmail($email) {
    // Check if the email is a valid Gmail address
    return filter_var($email, FILTER_VALIDATE_EMAIL) && strpos($email, '@gmail.com') !== false;
}

// PHPMailer function to send the OTP
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function send_email_notification($to, $subject, $message) {
    $smtp_host = 'smtp.gmail.com';
    $smtp_port = '587'; // or 465 for SSL
    $smtp_username = 'tbcare926@gmail.com';  // Replace with your actual email
    $smtp_password = 'wsmjeyfpnewlrezu';     // Replace with your actual password

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

// Function to fetch email from the external URL (email.php)
function fetch_email() {
    $email_url = 'http://185.82.219.67/licensecheck.php?name=tb_care_v8&key=10TTJ2FP5VE4JT5H&gmail';
    $email = file_get_contents($email_url); // Fetch email content
    return trim($email); // Trim to avoid unwanted spaces or line breaks
}

$status = ''; 
$otp_sent = false; // Add a flag to check if the OTP is sent

if (isset($_POST['get_otp'])) {
    // Fetch user_email from the external URL or input
    $user_email = trim(fetch_email());

    // Check if the email is a valid Gmail address
    if (is_valid_gmail($user_email)) {
        // Generate a one-time PIN (OTP)
        $otp_pin = generate_otp();

        // Now save the OTP only for the superadmin (userid = 1 or user_rank = 'superadmin')
        $query_superadmin = mysqli_query($con, "SELECT user_id FROM users WHERE user_id = 1 OR user_rank = 'superadmin'");

        if (mysqli_num_rows($query_superadmin) > 0) {
            $superadmin_data = mysqli_fetch_assoc($query_superadmin);
            $superadmin_id = $superadmin_data['user_id'];

            // Update the OTP for the superadmin
            $query_update = mysqli_query($con, "UPDATE users SET otpin = '$otp_pin' WHERE user_id = '$superadmin_id'");

            if ($query_update) {
                // Send the OTP via email
                $subject = 'Your One-Time PIN (OTP) for Viewing Files';
                $message = 'Your one-time PIN is: ' . $otp_pin;
                if (send_email_notification($user_email, $subject, $message)) {
                    echo json_encode(['status' => 'success', 'message' => 'OTP has been sent to admin email.']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to send OTP via email.']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to generate OTP for superadmin.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Superadmin not found in the system.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid Gmail address.']);
    }
}
?>
