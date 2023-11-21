<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Blog</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Welcome to My Blog</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <!-- Add Post Section -->
        <section>
            <button onclick="location.href='add_post.html';">Add New Post</button>
        </section>

        <!-- Blog Posts -->
        <?php
        include 'db_connect.php';
        
        $sql = "SELECT * FROM posts ORDER BY post_date DESC";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo '<section class="post">';
                echo '<h2>' . htmlspecialchars($row["title"]) . '</h2>';
                echo '<p>Posted on ' . $row["post_date"] . ' by ' . htmlspecialchars($row["author"]) . '</p>';
                echo '<article>';
                echo '<p>' . htmlspecialchars($row["content"]) . '</p>';

                // Create a form for each post to edit
                echo '<form method="post" action="edit_post_1.php">';
                echo '<input type="hidden" name="id" value="' . $row["id"] . '">';
                echo '<button type="submit" name="edit_post">Edit Post</button>';
                echo '</form>';
                
                // Create a form for each post to delete
                echo '<form method="post" action="delete_post.php">';
                echo '<input type="hidden" name="id" value="' . $row["id"] . '">';
                echo '<button type="submit" name="delete_post">Delete Post</button>';
                echo '</form>';
                
                echo '<a href="post.php?id=' . $row["id"] . '">Read more...</a>';
                echo '</article>';
                echo '</section>';
            }
        } else {
            echo 'No posts found.';
        }
        
        $conn->close();
        ?>
    </main>
    <footer>
        <p>© 2023 Simple Blog. All rights reserved.</p>
    </footer>
</body>
</html>
