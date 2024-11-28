<?php
header('Content-Type: application/json');
include('../extension/connect.php');

// SQL query to count patients by address
$query = "
    SELECT 
        address, 
        COUNT(*) as patient_count
    FROM patient
    GROUP BY address
    ORDER BY patient_count DESC
";

$result = mysqli_query($con, $query);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

mysqli_close($con);

echo json_encode($data);
?>
