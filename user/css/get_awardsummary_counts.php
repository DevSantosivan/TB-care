<?php
// Include your database connection
include('extension/connect.php');

// Fetch summary counts
$query = mysqli_query($con, "SELECT 
            COUNT(*) AS total_count,
            SUM(CASE WHEN YEAR(Date) = 2023 THEN 1 ELSE 0 END) AS total_count_2023,
            SUM(CASE WHEN YEAR(Date) = 2024 THEN 1 ELSE 0 END) AS total_count_2024,
            SUM(CASE WHEN YEAR(Date) = 2025 THEN 1 ELSE 0 END) AS total_count_2025,
            SUM(CASE WHEN YEAR(Date) = 2026 THEN 1 ELSE 0 END) AS total_count_2026,
            SUM(CASE WHEN YEAR(Date) = 2027 THEN 1 ELSE 0 END) AS total_count_2027,
            SUM(CASE WHEN YEAR(Date) = 2028 THEN 1 ELSE 0 END) AS total_count_2028,
            SUM(CASE WHEN YEAR(Date) = 2029 THEN 1 ELSE 0 END) AS total_count_2029,
            SUM(CASE WHEN YEAR(Date) = 2030 THEN 1 ELSE 0 END) AS total_count_2030,
            SUM(CASE WHEN Type_of_Presentation = 'national' THEN 1 ELSE 0 END) AS national_count,
            SUM(CASE WHEN Type_of_Presentation = 'international' THEN 1 ELSE 0 END) AS international_count
        FROM awardsummary");

if ($query) {
    $row = mysqli_fetch_assoc($query);
    $total_count = $row['total_count'];
    $total_count_2023 = $row['total_count_2023'];
    $total_count_2024 = $row['total_count_2024'];
    $total_count_2025 = $row['total_count_2025'];
    $total_count_2026 = $row['total_count_2026'];
    $total_count_2027 = $row['total_count_2027'];
    $total_count_2028 = $row['total_count_2028'];
    $total_count_2029 = $row['total_count_2029'];
    $total_count_2030 = $row['total_count_2030'];
    $national_count = $row['national_count'];
    $international_count = $row['international_count'];

    // Return JSON response
    echo json_encode([
        'total' => $total_count,
        '2023' => $total_count_2023,
        '2024' => $total_count_2024,
        '2025' => $total_count_2025,
        '2026' => $total_count_2026,
        '2027' => $total_count_2027,
        '2028' => $total_count_2028,
        '2029' => $total_count_2029,
        '2030' => $total_count_2030,
        'national' => $national_count,
        'international' => $international_count,
    ]);
} else {
    // Handle database query error
    echo json_encode(['error' => 'Error fetching summary counts.']);
}

// Close the database connection
mysqli_close($con);
?>
