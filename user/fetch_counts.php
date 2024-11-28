<?php
include('extension/connect.php');

// Query to count active users with normal rank
$is_active_status = 0;
$total_users_query = mysqli_query($con, "SELECT COUNT(*) AS total_users FROM users WHERE is_active = $is_active_status AND user_rank='normal'");
$total_users_count = mysqli_fetch_assoc($total_users_query)['total_users'];

// Query to count comments with non-zero values
$comment_count_query = mysqli_query($con, "SELECT COUNT(*) as comment_count FROM users WHERE comment_count > 0");
$comment_count = mysqli_fetch_assoc($comment_count_query)['comment_count'];

// Query to check for low stock medicines
$lowStockQuery = mysqli_query($con, "SELECT COUNT(*) as lowStockCount FROM inventory WHERE total < 100");
$lowStockCount = mysqli_fetch_assoc($lowStockQuery)['lowStockCount'];

// Return the counts as JSON
echo json_encode([
    'total_users_count' => $total_users_count,
    'comment_count' => $comment_count,
    'lowStockCount' => $lowStockCount
]);
?>
