<?php
session_start();
include('config.php');
$email = $_POST['email'];
$password = $_POST['password'];

//to prevent from mysqli injection  
$email = stripcslashes($email);
$password = stripcslashes($password);
$email = mysqli_real_escape_string($con, $email);
$password = mysqli_real_escape_string($con, $password);

$sql = "select * from customer where Customer_email = '$email' and Customer_password = '$password'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$count = mysqli_num_rows($result);

if ($count == 1) {
    $_SESSION['email'] = $email;
    header("location: home.php");
} else {
    echo "<script>alert('Invalid Username or Password!')</script>";
    echo "<script>location.href='home.php'</script>";
}
