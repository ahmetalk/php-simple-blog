<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata&display=swap" rel="stylesheet">
    <title>Home</title>
</head>
<body>
    <?php
    session_start();
    include("navbar.php");

    ?>

    <h1>Welcome to the Homepage</h1>

    <!-- Display recent posts -->
    <h2>Recent Posts</h2>
    <?php
    include("database.php");

    // Pagination settings
    $postsPerPage = 5; // Number of posts per page
    $currentPage = 1; // Default current page

    if (isset($_GET["page"])) {
        $currentPage = $_GET["page"];
    }

    $offset = ($currentPage - 1) * $postsPerPage; // Calculate offset

    // Query to select recent posts count (for pagination)
    $countQuery = "SELECT COUNT(*) as total FROM posts";
    $countResult = mysqli_query($conn, $countQuery);

    if ($countResult) {
        $row = mysqli_fetch_assoc($countResult);
        $totalPosts = $row["total"];
        $totalPages = ceil($totalPosts / $postsPerPage);
    } else {
        echo "Error: " . mysqli_error($conn);
        $totalPages = 1;
    }

    // Query to select recent posts with pagination
    $query = "SELECT title, post FROM posts ORDER BY created_at DESC LIMIT $postsPerPage OFFSET $offset";

    // Perform the query
    $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if ($result) {
        // Fetch and display each post
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="post">';
            echo "<h3>" . $row['title'] . "</h3>";
            echo "<p>" . $row['post'] . "</p>";
            echo "</div>";
        }

        // Free the result set
        mysqli_free_result($result);
    } else {
        // Handle the error if the query fails
        echo "Error: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
    ?>

    <!-- Pagination buttons -->
    <div class="pagination">
        <?php
        // Display "Previous" button if not on the first page
        if ($currentPage > 1) {
            echo '<a href="index.php?page=' . ($currentPage - 1) . '">Previous</a>';
        }

        // Display "Next" button if not on the last page
        if ($currentPage < $totalPages) {
            echo '<a href="index.php?page=' . ($currentPage + 1) . '">Next</a>';
        }
        ?>
    </div>

    <!-- Link to create a new post -->
    <?php
    if (isset($_SESSION["user_id"])) {
        echo '<p><a href="new.php">Create a New Post</a></p>';
    }
    ?>
</body>
</html>
