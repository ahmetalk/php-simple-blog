<link rel="stylesheet" type="text/css" href="navbar.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inconsolata&display=swap" rel="stylesheet">
<nav>
    <ul class="navbar-list">
        <li class="navbar-item"><a href="index.php">Home</a></li>
        <li class="navbar-item"><a href="profile.php">Profile</a></li>
        <li class="navbar-item"><a href="new.php">Create</a></li>
        <?php
        if (isset($_SESSION["user_id"])) {
            // If logged in, display a "Logout" link
            echo '<li class="navbar-item"><a href="logout.php">Logout</a></li>';
        } else {
            // If not logged in, display "Login" and "Signup" links
            echo '<li class="navbar-item"><a href="login.php">Login</a></li>';
            echo '<li class="navbar-item"><a href="signup.php">Signup</a></li>';
        }
        ?>
    </ul>
</nav>
