<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Get and sanitize input
$name    = isset($_POST['name']) ? strip_tags(trim($_POST['name'])) : '';
$contact = isset($_POST['contact']) ? strip_tags(trim($_POST['contact'])) : '';
$message = isset($_POST['message']) ? strip_tags(trim($_POST['message'])) : '';

// Basic validation
if ($name === '' || $contact === '' || $message === '') {
    http_response_code(400);
    echo json_encode(['error' => 'All fields are required.']);
    exit;
}

// Create feedback entry
$entry = [
    'name'      => $name,
    'contact'   => $contact,
    'message'   => $message,
    'timestamp' => date('Y-m-d H:i:s')
];

// Define file path
$data_dir  = __DIR__ . '/../data';
$json_file = $data_dir . '/feedback.json';

// Ensure directory exists
if (!file_exists($data_dir)) {
    mkdir($data_dir, 0777, true);
}

// Load existing entries or create new array
$existing = file_exists($json_file) ? json_decode(file_get_contents($json_file), true) : [];

// Append new entry
$existing[] = $entry;

// Save to JSON file
file_put_contents($json_file, json_encode($existing, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

// Send success response
echo json_encode(['success' => 'Feedback saved successfully.']);
?>
