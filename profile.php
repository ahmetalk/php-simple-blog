<?php
session_start();
include("database.php"); // Include the database connection code

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}

// Get the user's ID from the session
$user_id = $_SESSION["user_id"];

// Query to fetch the user's basic information
$userInfoQuery = "SELECT username, reg_date FROM users WHERE id = $user_id";
$userInfoResult = mysqli_query($conn, $userInfoQuery);

if (!$userInfoResult) {
    // Handle the error if the query fails
    echo "Error: " . mysqli_error($conn);
    exit();
}

// Fetch the user's information
$userInfo = mysqli_fetch_assoc($userInfoResult);

// Query to fetch the user's posts
$userPostsQuery = "SELECT title, post FROM posts WHERE user_id = $user_id ORDER BY created_at DESC";
$userPostsResult = mysqli_query($conn, $userPostsQuery);

if (!$userPostsResult) {
    // Handle the error if the query fails
    echo "Error: " . mysqli_error($conn);
    exit();
}

// Close the database connection
mysqli_close($conn);
include("navbar.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="profile.css"> <!-- Add your CSS file for styling -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata&display=swap" rel="stylesheet">
    <title>Profile</title>
</head>
<body>
    <h1>Welcome, <?php echo $userInfo["username"]; ?>!</h1>

    <!-- Display basic user information -->
    <p>Registration Date: <?php echo $userInfo["reg_date"]; ?></p>
    <p>Number of Posts: <?php echo mysqli_num_rows($userPostsResult); ?></p>

    <!-- Display user's posts -->
    <h2>Your Posts</h2>
    <?php
    while ($row = mysqli_fetch_assoc($userPostsResult)) {
        echo '<div class="post">';
        echo "<h3>" . $row['title'] . "</h3>";
        echo "<p>" . $row['post'] . "</p>";
        echo "</div>";
    }
    ?>

    <!-- Add a link to return to the homepage or any other desired page -->
    <p><a href="index.php">Back to Homepage</a></p>
</body>
</html>
