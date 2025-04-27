<?php
// Database credentials
$host = 'localhost';
$username = 'root';    // Default for USBWebserver
$password = 'usbw';        // Default (empty password) for USBWebserver
$database = 'sjcbookstore';

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>