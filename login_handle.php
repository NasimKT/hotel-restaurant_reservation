<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['user'];
    $password = $_POST['pass'];

    $sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['admin'] = true;
        header("Location: admin_panel.php");
        exit();
    } else {
        $response = "Login failed. Invalid username or password.";
        header("Location: invalid.html");
        exit();
    }
} else {
    $response = "Invalid request.";
}

$conn->close();

?>
