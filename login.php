<?php
// Start session to store user data once logged in
session_start();

// Database connection variables
$host = 'localhost';
$dbUser = 'root'; // default XAMPP user
$dbPass = ''; // default XAMPP password is empty
$dbName = 'login_system'; // your database name
$newPort = 3307; // The new port number you're using for MySQL

// Create connection
$conn = new mysqli($host, $dbUser, $dbPass, $dbName, $newPort);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user input from form
$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : ''; // Added password retrieval

// Prepare the SQL statement to prevent SQL injection
$stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
$stmt->bind_param("s", $username);

// Execute the prepared statement
$stmt->execute();

// Store the result to check if the account exists in the database
$stmt->store_result();

if ($stmt->num_rows > 0) {
    // Bind result variables
    $stmt->bind_result($id, $hashedPasswordFromDatabase);
    $stmt->fetch();
    
    // Verify the password
    if (password_verify($password, $hashedPasswordFromDatabase)) {
        // Password is correct, create session variables
        $_SESSION['loggedin'] = true;
        $_SESSION['id'] = $id;
        $_SESSION['username'] = $username;
        
        // Redirect to blog page
        header('Location: blogpage.html');
        exit(); // Always include exit() after a header redirect
    } else {
        // Password is not correct
        echo "Incorrect username or password.";
    }
} else {
    // Username doesn't exist
    echo "Incorrect username or password.";
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
