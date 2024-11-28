<?php
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $fileName = isset($_GET['fileName']) ? $_GET['fileName'] : '';

    if (!empty($fileName)) {
        $uploadDir = 'uploads/';
        $fileToDelete = $uploadDir . $fileName;

        if (file_exists($fileToDelete)) {
            if (unlink($fileToDelete)) {
                // File deletion successful

                // JavaScript to display a notification, delay for 2 seconds, and then refresh the page
                echo '<script>
                    // Display the notification
                    alert("File deleted successfully.");
                    
                    // Delay for 2 seconds (2000 milliseconds) and then refresh the page
                    setTimeout(function() {
                        window.location.reload();
                    }, 2000);
                </script>';
            } else {
                // File deletion failed
                echo json_encode(['success' => false, 'error' => 'Error deleting the file.']);
            }
        } else {
            // File not found
            echo json_encode(['success' => false, 'error' => 'File not found.']);
        }
    } else {
        // Missing fileName parameter
        echo json_encode(['success' => false, 'error' => 'Missing fileName parameter.']);
    }
} else {
    // Invalid request method
    echo json_encode(['success' => false, 'error' => 'Invalid request method.']);
}
?>
