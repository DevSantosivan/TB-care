<?php
include('extension/connect.php');

// Get the user ID from the request
$user_id = $_GET['user_id'];

// Fetch comments and associated user information from the database
$query = mysqli_query($con, "SELECT users.picture, users.user_name, users.comment FROM users WHERE user_id = '$user_id'");

$chat = mysqli_fetch_assoc($query);

// Return the comments and pictures as JSON for AJAX
echo json_encode($chat);
?>
