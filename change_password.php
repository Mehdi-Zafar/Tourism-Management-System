<?php
session_start();
include('config.php');
$email = $_SESSION['email'];
$old_password = $_POST['oldpassword'];
$new_password = $_POST['newpassword'];
$confirm_new_password = $_POST['cnewpassword'];
$query = "SELECT Customer_password FROM customer WHERE Customer_email = '$email';";
$result = mysqli_query($con, $query);
while ($row = mysqli_fetch_array($result)) {
    $password = $row[0];
}
if ($password == $old_password) {
    if ($new_password == $confirm_new_password) {
        $query2 = "UPDATE customer SET Customer_password = '$new_password' WHERE Customer_email = '$email';";
        $result2 = mysqli_query($con, $query2);
        echo "<script>alert('Your password has been changed successfully!')</script>";
        echo "<script>location='home.php'</script>";
    } else {
        echo "<script>alert('New password and confirm new password fields do not match!')</script>";
        echo "<script>location='home.php'</script>";
    }
} else {
    echo "<script>alert('Your old password is not valid!')</script>";
    echo "<script>location='home.php'</script>";
}
