<?php
include('extension/connect.php');

// Get the user ID from the request
$user_id = $_GET['user_id'];

// Query to fetch the comments for the specific user
$query = mysqli_query($con, "SELECT users.full_name, comments.comment FROM comments INNER JOIN users ON comments.user_id = users.user_id WHERE comments.user_id = '$user_id' ORDER BY comments.comment_id ASC");

$chat = [];

while($row = mysqli_fetch_assoc($query)) {
    $chat[] = $row; // Collect comments and user details
}

// Return data as JSON for AJAX call
echo json_encode($chat);
?>
