<?php
include('extension/connect.php');
include('extension/check-login.php');

$userid = $_SESSION['userid'];
$input_password = $_POST['otpin'];

// Query to fetch the stored MD5 hashed password for the current user
$query = mysqli_query($con, "SELECT user_encryptedPass FROM users WHERE user_id='$userid'");
$user = mysqli_fetch_array($query);

if ($user) {
    // Verify the entered password against the stored MD5 hashed password
    if (md5($input_password) === $user['user_encryptedPass']) {
        echo 'success';
    } else {
        echo 'failure';
    }
} else {
    echo 'user_not_found';
}
?>
