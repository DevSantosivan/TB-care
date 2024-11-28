<?php
// Include the database connection file
include('extension/connect.php');

// Query to fetch the log_id and med2 status for all patients
$query = "SELECT log_id, med2 FROM patient";
$result = mysqli_query($con, $query);

$patients = array(); // Initialize an empty array

// Fetch the results and push them into the array
while ($row = mysqli_fetch_assoc($result)) {
    $patients[] = $row;
}

// Return the array as a JSON object
header('Content-Type: application/json');
echo json_encode($patients);
?>
