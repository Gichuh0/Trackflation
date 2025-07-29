<?php
require 'dbconn.php';
session_start();
if (isset($_SESSION['success'])) {
    echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
    unset($_SESSION['success']);
}
if ($_SERVER["REQUEST_METHOD"] == 'POST' &&
    isset($_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['password'])) {

    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($fname) || empty($lname) || empty($email) || empty($password)) {
        die("All fields are required.");
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (fname, lname, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $fname, $lname, $email, $hashed_password);

    if ($stmt->execute()) { 
        $_SESSION['user'] = $email; 
        $_SESSION['success'] = "You are now logged in";
        header("Location: welcome.php");
        exit();
    } else {
        die("Error: " . $conn->error);
    }
    $stmt->close();
} else {
    die("All fields are required.");
}
?>