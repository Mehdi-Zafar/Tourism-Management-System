<?php
include('config.php');

$type = $_POST['type'];
$description = $_POST['description'];

$query = "INSERT INTO transportation(Transportation_type, Transportation_desc) VALUES('$type', '$description')";
$result = mysqli_query($con, $query);

if ($result) {
    echo "<script>alert('New transport added successfully!')</script>";
    echo "<script>location='addtransport.php'</script>";
} else {
    echo "<script>alert('Unsuccessful!')</script>";
    echo "<script>location='addtransport.php'</script>";
}
