<?php

//Database connection
$conn = mysqli_connect('localhost', 'root');

mysqli_select_db($conn, 'tourism');

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];
$number = $_POST['number'];
$alternate_number = $_POST['alternate_number'];
$address = $_POST['address'];

if ($password == $cpassword) {
    $query = "INSERT INTO `customer`(`Customer_name`, `Customer_email`, `Customer_password`, `Customer_address`)
VALUES ('$name','$email','$password','$address')";
    mysqli_query($conn, $query);
    $query3 = "SELECT Customer_id FROM customer WHERE Customer_email = '$email'";
    $result3 = mysqli_query($conn, $query3);
    while ($row = mysqli_fetch_array($result3)) {
        $id = $row[0];
    }
    $query2 = "INSERT INTO customer_info(Customer_id,Customer_contact_no) VALUES($id,$number);";
    mysqli_query($conn, $query2);
    if ($alternate_number != null) {
        $query4 = "INSERT INTO customer_info(Customer_id, Customer_contact_no) VALUES($id,$alternate_number);";
        mysqli_query($conn, $query4);
    }
    $_SESSION['email'] = $email;
    echo "<script>alert('Signup Successful, you can now login!')</script>";
    echo "<script>location='home.php'</script>";
} else {
    echo "<script>alert('Error: Password and Confirm Password fields do not match!')</script>";
    echo "<script>location='home.php'</script>";
    exit('Signup unsuccessful');
}
