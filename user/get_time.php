<?php
// Connect to your database
include('extension/connect.php');

// Fetch the time for log_id = 1
$query = "SELECT hours FROM time WHERE log_id = 1";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);

// Return the time as JSON
echo json_encode($row);
?>
