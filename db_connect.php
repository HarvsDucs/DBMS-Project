<?php
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = 'blogdb'; // your database name
$newPort = 3307; // The new port number you're using for MySQL

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $newPort);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
