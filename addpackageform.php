<?php
include('config.php');

$name = $_POST['name'];
$type = $_POST['type'];
$price = $_POST['price'];
$description = $_POST['description'];
$link = $_POST['link'];

if (isset($_POST['submit'])) {

    // Get name of images
    $Get_image_name = $_FILES['image']['name'];

    // image Path
    $image_Path = "images/" . basename($Get_image_name);

    $query = "INSERT INTO package(Package_name, Package_type, Package_desc, Amount_per_person, Link, Picture) VALUES('$name', '$type', '$description','$price','$link','$Get_image_name')";
    $result = mysqli_query($con, $query);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $image_Path) && $result) {
        echo "<script>alert('New package added successfully!')</script>";
        echo "<script>location='addpackage.php'</script>";
    } else {
        echo "<script>alert('Unsuccessful!')</script>";
        echo "<script>location='addpackage.php'</script>";
    }
}
