<?php
session_start(); // Start the session to store user information
var_dump($_POST);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'signup');
    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    }

    $email = $_POST['email'];
    $password = $_POST['pwd'];

    // Check if email and password match in the database
    $stmt = $conn->prepare("SELECT * FROM registration WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    /*$row = $result->fetch_assoc();
    echo "Email: " . $row["email"] . " Password: " . $row["hashed_password"];*/
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['hashed_password'])) {
            // Valid credentials, set session variables and redirect to main.html
            $_SESSION['email'] = $email;
            $stmt->close();
            $conn->close();
            header("Location: main.html?successful_login");
            exit;
        } else {
            // Invalid password, redirect to login.html
            $stmt->close();
            $conn->close();
            header("Location: login.html?error=invalid_password");
            exit;
        }
    } else {
        // Invalid email, redirect to login.html
        $stmt->close();
        $conn->close();
        header("Location: login.html?error=invalid_email");
        exit;
    }
}
?>