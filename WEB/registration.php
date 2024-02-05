<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'signup');
    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    }

    // Fetch data from the signup form
    $name = $_POST['name'];
    $uname = $_POST['uname'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';

    // Insert data into the 'users' table
    $stmt = $conn->prepare("INSERT INTO users (name, uname, email, phonenumber, password, gender) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $uname, $email, $phonenumber, $password, $gender);
    $stmt->execute();

    // Close connections
    $stmt->close();
    $conn->close();

    // Redirect to a success page or user dashboard
    header("Location: Success.php");
    exit;
}
?>

