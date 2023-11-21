<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
</head>
<body>
    <h1>Edit Post</h1>
    <form action="edit_post.php" method="post">
        <!-- Add a hidden input field to store the id value -->
        <input type="hidden" name="id" value="<?php echo isset($_POST['id']) ? $_POST['id'] : ''; ?>">

        <br><label for="title">Title:</label><br>
        <input type="text" id="title" name="title" required><br><br>

        <label for="content">Content:</label><br>
        <textarea id="content" name="content" required></textarea><br><br>

        <label for="author">Author:</label><br>
        <input type="text" id="author" name="author" required><br><br>

        <input type="submit" name="submit" value="Update Post">
    </form>
</body>
</html>