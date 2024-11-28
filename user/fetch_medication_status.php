<?php
include('extension/connect.php');

// Fetch patient data (you can limit it to active or relevant patients)
$query = mysqli_query($con, "SELECT log_id, med2 FROM patient");

$patients = [];

while($row = mysqli_fetch_assoc($query)) {
    $patients[] = $row; // Collect each patient's data (log_id and med2)
}

// Return data as JSON
echo json_encode($patients);
?>
