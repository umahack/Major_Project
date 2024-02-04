<?php
 $firstName = $_POST['fname'];
 $lastName = $_POST['lname'];
 $gender = $_POST['gender'];
 $email = $_POST['email'];
 $password = $_POST['pwd'];
 $number = $_POST['phone'];

 //database connection
 $conn = new mysqli('localhost','root','','signup');
 if($conn->connect_error){
    die("Connection Failed: " .$conn->connect_error);
 }
 else{
    $stmt = $conn->prepare("insert into registration(firstName, lastName, gender, email, password, number)
    values(?,?,?,?,?,?)");
    $stmt->bind_param("sssssi",$firstName,$lastName,$gender,$email,$password,$number);
    $stmt->execute();
    echo"Registration Successful";
    $stmt->close();
    $conn->close();
 }
?>