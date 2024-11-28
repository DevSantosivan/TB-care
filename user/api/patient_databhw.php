<?php
header('Content-Type: application/json');
include('../extension/connect.php');

// Assuming the user ID is stored in the session
$userid = $_SESSION['user_id'];

// Fetch the username of the logged-in user
$user_query = mysqli_query($con, "SELECT user_name FROM users WHERE user_id = '$userid'");
$user_data = mysqli_fetch_assoc($user_query);
$uname = $user_data['user_name']; // Get the username

// Query to get the total counts for EPTB and PTB, filtering by the user's uname
$query = "
    SELECT 
        SUM(CASE WHEN tb_type = 'eptb' THEN 1 ELSE 0 END) as tb_count,
        SUM(CASE WHEN tb_type = 'ptb' THEN 1 ELSE 0 END) as ptb_count
    FROM patient
    WHERE uname = '$uname'
";

$result = mysqli_query($con, $query);

$data = mysqli_fetch_assoc($result);

// Calculate total patients
$total_patients = $data['tb_count'] + $data['ptb_count'];

// Calculate percentages
$ptb_percentage = ($total_patients > 0) ? ($data['ptb_count'] / $total_patients) * 100 : 0;
$eptb_percentage = ($total_patients > 0) ? ($data['tb_count'] / $total_patients) * 100 : 0;

// Return data with percentages
$response = [
    'ptb_percentage' => round($ptb_percentage, 1),
    'eptb_percentage' => round($eptb_percentage, 1)
];

echo json_encode($response);
?>
