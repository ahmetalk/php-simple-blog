<?php
session_start();

// Check if the user is logged in, if not, redirect to the login page
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

include("database.php");

// Initialize variables
$title = "";
$postContent = "";
$message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_SPECIAL_CHARS);
    $postContent = $_POST["postContent"];
    
    // Check for empty fields
    if (empty($title) || empty($postContent)) {
        $message = "Please fill in both title and post content.";
    } else {
        $userId = $_SESSION["user_id"];
        
        // Insert the new post into the "posts" table
        $insertQuery = "INSERT INTO posts (user_id, title, post) VALUES ($userId, '$title', '$postContent')";
        if (mysqli_query($conn, $insertQuery)) {
            $message = "Post created successfully!";
        } else {
            $message = "Error: " . mysqli_error($conn);
        }
    }
}

mysqli_close($conn);
?>
<?php include("navbar.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="new.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata&display=swap" rel="stylesheet">
    <title>Create New Post</title>
</head>
<body>
    <h1>Create New Post</h1>
    
    <!-- Display a message if there's one to show -->
    <?php
    if (!empty($message)) {
        echo "<p>$message</p>";
    }
    ?>

    <!-- New Post Form -->
    <form action="new.php" method="post">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
        <br>

        <label for="postContent">Post Content:</label>
        <textarea id="postContent" name="postContent" rows="4" required></textarea>
        <br>

        <input type="submit" value="Create Post">
    </form>

    <p><a href="index.php">Back to Homepage</a></p>
</body>
</html>
