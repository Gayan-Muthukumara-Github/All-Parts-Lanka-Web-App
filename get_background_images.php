<?php
include('admin/config/dbcon.php');

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if table exists
$table_check = "SHOW TABLES LIKE 'background_images'";
$table_result = mysqli_query($con, $table_check);

if(mysqli_num_rows($table_result) == 0) {
    // Table doesn't exist, return empty array
    header('Content-Type: application/json');
    echo json_encode([]);
    exit();
}

// Fetch only active background images with their paths
$query = "SELECT id, image_name, image_path FROM background_images WHERE status = 1 ORDER BY created_at DESC";
$query_run = mysqli_query($con, $query);

if(!$query_run) {
    // Query failed, log the error
    error_log("Database query failed: " . mysqli_error($con));
    header('Content-Type: application/json');
    echo json_encode([]);
    exit();
}

$images = array();
if(mysqli_num_rows($query_run) > 0) {
    while($row = mysqli_fetch_assoc($query_run)) {
        if(!empty($row['image_path'])) {
            $images[] = array(
                'id' => $row['id'],
                'name' => $row['image_name'],
                'path' => $row['image_path']
            );
        }
    }
}

// If no images found, add a default image
if(empty($images)) {
    // You can add a default image here if needed
    // $default_image = file_get_contents('images/default_background.jpg');
    // $images[] = base64_encode($default_image);
}

// Return images as JSON
header('Content-Type: application/json');
echo json_encode($images);
?> 