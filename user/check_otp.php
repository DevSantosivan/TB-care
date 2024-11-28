<?php
include('extension/connect.php');
include('extension/check-login.php');

$userid = $_SESSION['userid'];
$input_otp = mysqli_real_escape_string($con, $_POST['otpin']);

// Query to fetch the stored OTP from the database for the current user
$query = mysqli_query($con, "SELECT otpin FROM users WHERE user_id='$userid'");
$user = mysqli_fetch_array($query);

if ($user) {
    // Verify the entered OTP against the stored OTP
    if ($input_otp === $user['otpin']) {
        // Clear the OTP after successful use
        $clear_otp = mysqli_query($con, "UPDATE users SET otpin = NULL WHERE user_id='$userid'");
        
        if ($clear_otp) {
            echo 'success';
        } else {
            echo 'error_clearing_otp'; // Error if unable to clear OTP
        }
    } else {
        echo 'failure'; // OTP does not match
    }
} else {
    echo 'user_not_found'; // No user found
}
?>
