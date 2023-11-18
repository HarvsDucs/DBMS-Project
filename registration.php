<?php
// Start session if you plan to use sessions
session_start();

// Check if the form has been submitted and the required POST variables are set
if (isset($_POST['username']) && isset($_POST['password'])) {
    // Assign the POST data to variables
    $newUsername = $_POST['username'];
    $originalPassword = $_POST['password'];

    // Hash the password
    $hashedPassword = password_hash($originalPassword, PASSWORD_DEFAULT);

    // Now insert the new user into the database with the hashed password
    $conn = new mysqli('localhost', 'root', '', 'login_system', 3307);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the insert statement
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $newUsername, $hashedPassword);

    // Execute and check for success
    if ($stmt->execute()) {
        echo "New user registered successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    // Not all POST variables are set, or the form has not been submitted
    echo "Required data is missing.";
}

?>
