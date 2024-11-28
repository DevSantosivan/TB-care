<?php
// Database connection details
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "tb-care";

// Establish database connection
$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Check connection
if (mysqli_connect_error()) {
    die('Connection failed: ' . mysqli_connect_error());
}

// Set the default time zone to Asia/Manila
date_default_timezone_set('Asia/Manila');

$sql = "SELECT user_name FROM users WHERE is_active = 1";
    $result = $con->query($sql);


 























































































































    
