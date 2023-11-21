<?php
include 'db_connect.php';

// Check if the 'id' parameter exists in the POST request
if (isset($_POST['id'])) {
    // Sanitize and validate the 'id' value
    $id = intval($_POST['id']);

    // Prepare a DELETE SQL statement to delete the record with the given ID
    $sql = "DELETE FROM posts WHERE id = ?";

    // Use a prepared statement to avoid SQL injection
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        // Bind the ID parameter to the statement
        $stmt->bind_param("i", $id);

        // Execute the DELETE statement
        if ($stmt->execute()) {
            // Record successfully deleted
            echo 'Record with ID ' . $id . ' has been deleted.';
            header('Location: blogpage.php');
        } else {
            // Error occurred while deleting
            echo 'Error: Unable to delete record.';
        }
        
        // Close the prepared statement
        $stmt->close();
    } else {
        // Error preparing the statement
        echo 'Error: Unable to prepare statement.';
    }
} else {
    // 'id' parameter is missing in the POST request
    echo 'Error: No ID specified for deletion.';
}

// Close the database connection
$conn->close();
?>
