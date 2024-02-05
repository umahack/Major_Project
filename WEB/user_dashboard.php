<?php
session_start();

if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    // If the user is not logged in, redirect to the login page
    header("Location: login.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <!-- Add your stylesheets or additional styling here -->
</head>
<body>
    <div class="container">
        <h1>Welcome, <?php echo $username; ?>!</h1>
        <p>This is your dashboard. Add more content as needed.</p>
        <!-- Add additional content or links as needed -->
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
