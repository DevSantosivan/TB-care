<?php
header('Content-Type: application/json');
include('../extension/connect.php');

$query = "
    SELECT 
        address, 
        SUM(CASE WHEN treatment = 1 THEN 1 ELSE 0 END) as treatment_count,
        COUNT(*) as patient_count
    FROM patient
    GROUP BY address
    ORDER BY address
";

$result = mysqli_query($con, $query);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

mysqli_close($con);

echo json_encode($data);
?>
