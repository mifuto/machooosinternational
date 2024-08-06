<?php

// Set the upload folder path
$upload_folder = 'tinymceuploads/';

// Get the uploaded file data
$file_data = $_FILES['file'];

// Generate a unique filename for the uploaded file
$file_name = uniqid() . '_' . $file_data['name'];

// Move the uploaded file to the upload folder
move_uploaded_file($file_data['tmp_name'], $upload_folder . $file_name);

// Set the response object with the image URL
$response = new stdClass();
$response->location = $upload_folder . $file_name;

// Send the response as JSON
echo json_encode($response);