<?php
include 'db_connect.php'; // Include your database connection

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Retrieve the form data by using the post ID
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = $_POST['author'];

    //echo $id;
    //echo $title;
    //echo $content;
    //echo $author;
    // Prepare an update statement to update the post
    $sql = "UPDATE posts SET title=?, content=?, author=? WHERE id=?";

    // Prepare and bind
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $title, $content, $author, $id);

    // Execute the statement and check if it's successful
    if ($stmt->execute()) {
        echo "Record updated successfully";
        // Redirect to the blog page or display a success message
        header('Location: blogpage.php');
    } else {
        echo "Error updating record: " . $conn->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} elseif (isset($_GET['id'])) {
    // The form has not been submitted, display it with the current post data

    $id = $_GET['id']; // Get the post ID from the URL

    // Prepare a select statement to retrieve the post's data
    $sql = "SELECT * FROM posts WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Get the data
        $post = $result->fetch_assoc();
        $title = $post['title'];
        $content = $post['content'];
        $author = $post['author'];
    } else {
        echo "Post not found";
    }
    $stmt->close();
    $conn->close();
}
?>
