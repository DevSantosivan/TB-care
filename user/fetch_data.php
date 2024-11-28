<?php
include('extension/connect.php');

// Query the database for the latest patient data
$query = "SELECT log_id, firstname, lastname, med2 FROM patient";
$result = mysqli_query($con, $query);

$patients = array();
while ($row = mysqli_fetch_assoc($result)) {
    // Store each patient's data in the array
    $patients[] = $row;
}

// Return the data as JSON
header('Content-Type: application/json');
echo json_encode($patients);
?>
