<?php include("navbar.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="signup.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata&display=swap" rel="stylesheet">
    <title>Signup</title>
</head>
<body>
    <h1>Signup</h1>
    <form action="signup_process.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required minlength="6" maxlength="15">
        <br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required minlength="6" maxlength="15">
        <br>

        <input type="submit" value="Signup">
    </form>
</body>
</html>
