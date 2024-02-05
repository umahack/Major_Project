<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'signup');
    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if username and password match in the database
    $stmt = $conn->prepare("SELECT * FROM users WHERE uname = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Valid credentials, set session variables and redirect to user_dashboard.php
            $_SESSION['username'] = $username;
            header("Location: user_dashboard.php");
            exit;
        } else {
            // Invalid password, redirect to login.html with an error
            header("Location: login.html?error=invalid_password");
            exit;
        }
    } else {
        // Invalid username, redirect to login.html with an error
        header("Location: login.html?error=invalid_username");
        exit;
    }

    // Close connections and statements
    $stmt->close();
    $conn->close();
} else {
    // If someone tries to access this page without submitting the form, redirect to login page
    header("Location: login.html");
    exit;
}
?>
