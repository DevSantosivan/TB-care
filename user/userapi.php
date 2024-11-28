<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "faculty";

// Create a MySQL connection
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set the content type to JSON
header('Content-Type: application/json');

// API endpoint to fetch file information
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'getFileInformation') {
    // Modify the query to filter by uname if the 'uname' parameter is provided
    $query = "SELECT date_uploaded, uploader_name, file_name, size, type_of_files, uname FROM file_upload_logs";
    
    if (isset($_GET['uname'])) {
        $uname = $conn->real_escape_string($_GET['uname']);
        $query .= " WHERE uname = '$uname'";
    }

    $result = $conn->query($query);
    if ($result) {
        $fileData = array();

        while ($row = $result->fetch_assoc()) {
            $fileData[] = $row;
        }

        echo json_encode($fileData);
    } else {
        echo json_encode(array('error' => 'Unable to fetch file information'));
    }
}

// Close the database connection
$conn->close();
?>
