<?php
session_start();
$admin_username = "Maryam";
$admin_password = "1234";

$username = $_POST['username'];
$password = $_POST['password'];

if ($username === $admin_username && $password === $admin_password) {

    $_SESSION['admin_logged_in'] = true;
    header("Location: admin_dashboard.php");
    exit();
} else {
   
    echo "<script>
        alert('Invalid username or password. Please try again.');
        window.location.href='admin_login.php';
    </script>";
}
?>
