<?php
// Define the file path and name



$file_path = $_REQUEST['file_path']; // Replace with the actual image file path
$file_name = $_REQUEST['file_name']; // Replace with the desired download file name

// Check if the file exists
if (file_exists($file_path)) {
    // Set the appropriate headers for image download
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . $file_name . '"');
    header('Content-Length: ' . filesize($file_path));

    // Output the image content to the browser
    readfile($file_path);
    exit;
} else {
    // Handle the case where the image file doesn't exist
    echo "Image file not found";
}
?>
