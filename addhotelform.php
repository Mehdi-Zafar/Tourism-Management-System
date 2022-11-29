<?php
include('config.php');

$name = $_POST['name'];
$type = $_POST['type'];
$address = $_POST['address'];
$address2 = $_POST['address2'];
$description = $_POST['description'];

$query = "INSERT INTO hotel(Hotel_name, Hotel_type, Hotel_desc) VALUES('$name', '$type', '$description')";
$result = mysqli_query($con, $query);
$query2 = "SELECT Hotel_id FROM hotel WHERE Hotel_name = '$name'";
$result2 = mysqli_query($con, $query2);
while ($row = mysqli_fetch_array($result2)) {
    $hotel_id = $row[0];
}
$query3 = "INSERT INTO hotel_info(Hotel_id,Hotel_address) VALUES('$hotel_id','$address')";
$result3 = mysqli_query($con, $query3);
if ($address2 != null) {
    $query4 = "INSERT INTO hotel_info(Hotel_id,Hotel_address) VALUES('$hotel_id','$address2')";
    $result4 = mysqli_query($con, $query4);
}


if ($result && $result2 && $result3) {
    echo "<script>alert('New hotel added successfully!')</script>";
    echo "<script>location='addhotel.php'</script>";
} else {
    echo "<script>alert('Unsuccessful!')</script>";
    echo "<script>location='addhotel.php'</script>";
}
