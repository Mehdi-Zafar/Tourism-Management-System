<?php
session_start();
include('config.php');
if ($_SESSION['email'] == null) {
    echo "<script>alert('Login to Continue!')</script>";
    echo "<script>location='booking.php'</script>";
    exit('Login to Continue!');
}
$package = $_POST['package'];
$person = $_POST['person'];
$transport = $_POST['transport'];
if ($package == null) {
    echo "<script>alert('Select a Package!')</script>";
    echo "<script>location='booking.php'</script>";
    exit('Select a Package!');
}
if ($person == null) {
    echo "<script>alert('Enter number of people!')</script>";
    echo "<script>location='booking.php'</script>";
    exit('Enter number of people!');
}
if ($transport == null) {
    echo "<script>alert('Select a Transport!')</script>";
    echo "<script>location='booking.php'</script>";
    exit('Select a Transport!');
}
$query7 = "SELECT Hotel_id FROM hotel_info WHERE Package_id='$package'";
$result7 = mysqli_query($con, $query7);
while ($row7 = mysqli_fetch_array($result7)) {
    $hotel_id = $row7[0];
}
$query8 = "SELECT Hotel_name FROM hotel WHERE Hotel_id = '$hotel_id'";
$result8 = mysqli_query($con, $query8);
while ($row8 = mysqli_fetch_array($result8)) {
    $hotel = $row8[0];
}
$query9 = "SELECT Package_name FROM package WHERE Package_id='$package'";
$result9 = mysqli_query($con, $query9);
while ($row9 = mysqli_fetch_array($result9)) {
    $package_name = $row9[0];
}
$query10 = "SELECT Amount_per_person FROM package WHERE Package_id='$package'";
$result10 = mysqli_query($con, $query10);
while ($row10 = mysqli_fetch_array($result10)) {
    $package_price = $row10[0];
}
$query11 = "SELECT Transportation_type FROM transportation WHERE Transportation_id='$transport'";
$result11 = mysqli_query($con, $query11);
while ($row11 = mysqli_fetch_array($result11)) {
    $vehicle = $row11[0];
}
$query12 = "SELECT Hotel_address FROM hotel_info WHERE Package_id='$package'";
$result12 = mysqli_query($con, $query12);
while ($row12 = mysqli_fetch_array($result12)) {
    $hotel_address = $row12[0];
}
$query13 = "SELECT Package_type FROM package WHERE Package_id='$package'";
$result13 = mysqli_query($con, $query13);
while ($row13 = mysqli_fetch_array($result13)) {
    $package_type = $row13[0];
}
$booking_total = $package_price * $person;
// if ($package == 1) {
//     $hotel = 'Crown Plaza';
//     $hotel_address = 'Mall Road, Murree';
//     $hotel_id = 1;
//     $package_name = 'Murree Package';
//     $package_price = 10000;
//     $booking_total = $package_price * $person;
// } else if ($package == 2) {
//     $hotel = 'Crown Plaza';
//     $hotel_address = 'Shaheen Road, Skardu';
//     $hotel_id = 1;
//     $package_name = 'Skardu Package';
//     $package_price = 15000;
//     $booking_total = $package_price * $person;
// } else if ($package == 3) {
//     $hotel = 'Spotlight Hotel';
//     $hotel_address = 'Khan Road, Naran Valley';
//     $hotel_id = 2;
//     $package_name = 'Naran Package';
//     $package_price = 13000;
//     $booking_total = $package_price * $person;
// } else if ($package == 4) {
//     $hotel = 'Royal Galaxy';
//     $hotel_address = 'Wazir Road, Hunza Valley';
//     $hotel_id = 3;
//     $package_name = 'Hunza Package';
//     $package_price = 15000;
//     $booking_total = $package_price * $person;
// }
// if ($transport == 1) {
//     $vehicle = 'Toyota Corolla';
// } else if ($transport == 2) {
//     $vehicle = 'Toyota Hilux';
// } else if ($transport == 3) {
//     $vehicle = 'Toyota Hiace';
// }
$ids = mysqli_query($con, "SELECT * from package");
$row = mysqli_fetch_array($ids, MYSQLI_ASSOC);
$counts = mysqli_num_rows($ids);

if (isset($_POST['confirmbtn'])) {
    if (($person > 2 and $package_type == 'Family Package') or ($person == 2 and $package_type == 'Couple Package')) {
        $email = $_SESSION['email'];
        $person = $_POST['person'];
        $package = $_POST['package'];
        $transport = $_POST['transport'];
        $query0 = "SELECT max(booking_id) FROM booking;";
        $result0 = mysqli_query($con, $query0);
        while ($row = mysqli_fetch_array($result0)) {
            $booking = $row[0];
        }
        $result_booking = $booking + 1;
        $query1 = "SELECT Customer_id FROM customer WHERE Customer_email = '$email'";
        $result1 = mysqli_query($con, $query1);
        while ($row = mysqli_fetch_array($result1)) {
            $id = $row[0];
        }
        $sql = "SELECT * FROM booking WHERE Customer_id = '$id' and Package_id = '$package';";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);
        if ($count == 1) {
            echo "<script>alert('You have already purchased this package!')</script>";
            echo "<script>location='booking.php'</script>";
            exit('Login to Continue!');
        } else {
            $query2 = "INSERT INTO booking(Booking_id,Package_id, Customer_id, Booking_type, Booking_total, Person, Booking_desc) 
        VALUES('$result_booking','$package','$id', 'Online','$booking_total','$person','5 day trip which includes stay at your hotel with transportation(air conditioned).');";
            $result2 = mysqli_query($con, $query2);
            $query3 = "INSERT INTO booking_transportation(Booking_id,Transportation_id) VALUES ('$result_booking','$transport');";
            $result3 = mysqli_query($con, $query3);
            $query4 = "INSERT INTO booking_hotel(Booking_id,Hotel_id) VALUES ('$result_booking','$hotel_id');";
            $result4 = mysqli_query($con, $query4);
            $query5 = "INSERT INTO customer_booking(Booking_id,Customer_id) VALUES('$result_booking','$id');";
            $result5 = mysqli_query($con, $query5);
            $query6 = "INSERT INTO customer_package(Customer_id, Package_id) VALUES('$id','$package');";
            $result6 = mysqli_query($con, $query6);

            $_SESSION['package'] = $package;
            $_SESSION['person'] = $person;
            $_SESSION['booking_total'] = $booking_total;

            echo '<script>alert("Booking Successfull!")</script>';
        }
    } else {
        echo '<script>alert("Booking unsuccessfull!")</script>';
        echo "<script>location='booking.php'</script>";
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />

    <title>🆃🅱 Travel Bug | Checkout</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Stylish&display=swap" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <?php if ($_SESSION['email'] == "mali@gmail.com") : ?>
                <a class="navbar-brand" href="#">🆃🅱Travel Bug🔒</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            <?php else : ?>
                <a class="navbar-brand" href="#">🆃🅱Travel Bug</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            <?php endif; ?>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About Us</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact Us</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Packages
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php for ($x = 1; $x < $count + 1; $x++) : ?>
                                <li><a class="dropdown-item" href="<?php $link_query = "SELECT link from package where Package_id = '$x'";
                                                                    $result2 = mysqli_query($con, $link_query);
                                                                    while ($row = mysqli_fetch_array($result2)) {
                                                                        $link = $row[0];
                                                                    }
                                                                    echo "$link"; ?>"><?php $package_name_query = "SELECT Package_name from package where Package_id = '$x'";
                                                                                        $result = mysqli_query($con, $package_name_query);
                                                                                        while ($row = mysqli_fetch_array($result)) {
                                                                                            $package_name = $row[0];
                                                                                        }
                                                                                        echo "$package_name"; ?></a></li>
                            <?php endfor ?>
                        </ul>
                    </li>
                </ul>

                <div class="mx-2">
                    <?php if (!isset($_SESSION['email'])) : ?>
                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#LoginModal">
                            Log In
                        </button>
                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#SignUpModal">
                            Sign Up
                        </button>
                    <?php endif; ?>
                </div>
                <?php if (isset($_SESSION['email'])) : ?>
                    <div class="dropdown text-end" id="emailborder">
                        <a href="#" class="d-block link-light text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo $_SESSION['email'] ?>
                        </a>
                    <?php endif; ?>
                    <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                        <li><a class="dropdown-item" href="profile.php">My Profile</a></li>
                        <div class="dropdown-divider"></div>
                        <?php if ($_SESSION['email'] == "mali@gmail.com") : ?>
                            <li><a class="dropdown-item" href="addpackage.php">Add Package</a></li>
                            <div class="dropdown-divider"></div>
                            <li><a class="dropdown-item" href="addtransport.php">Add Transport</a></li>
                            <div class="dropdown-divider"></div>
                            <li><a class="dropdown-item" href="addhotel.php">Add Hotel</a></li>
                            <div class="dropdown-divider"></div>
                        <?php endif; ?>
                        <li><button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#ChangePasswordModal">Change Password</button></li>
                        <div class="dropdown-divider"></div>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                    </div>
            </div>
        </div>
    </nav>

    <!-- Login Modal -->
    <div class="modal fade" id="LoginModal" tabindex="-1" aria-labelledby="LoginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="LoginModalLabel">
                        Log in to Travel Bug
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="connectl.php" method="post">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" required />
                            <div id="emailHelp" class="form-text">
                                We'll never share your email with anyone else.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password" required />
                        </div>
                        <button type="submit" class="btn btn-primary" name="login">Login</button>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-dismiss="modal" data-bs-target="#SignUpModal">Sign Up</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Sign Up Modal -->
    <div class="modal fade" id="SignUpModal" tabindex="-1" aria-labelledby="SignUpModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="SignUpModalLabel">Sign Up</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="connectsu.php" method="post">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Name</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name" required />
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" required />
                            <div id="emailHelp" class="form-text">
                                We'll never share your email with anyone else.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password" required />
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="cexampleInputPassword1" name="cpassword" required />
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Contact Number</label>
                            <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="number" required />
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Alternate Number(optional)</label>
                            <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="alternate_number" />
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Address</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="address" required />
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Create Account
                        </button>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-dismiss="modal" data-bs-target="#LoginModal">Already a member</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!--Change Password Modal -->
    <div class="modal fade" id="ChangePasswordModal" tabindex="-1" aria-labelledby="ChangePasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ChangePasswordModalLabel">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="change_password.php" method="POST">
                        <div class="mb-3">
                            <label for="exampleInputPassword2" class="form-label">Old Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="oldpassword" required />
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword2" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="newpassword" required />
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword2" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="cnewpassword" required />
                        </div>
                        <button type="submit" class="btn btn-primary" name="changepassword">Change Password</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>




    <div>
        <img src="images\300x870(3).jpg" class="floatRight">
    </div>

    <div>
        <img src="images\300x870(3).jpg" class="floatLeft">
    </div>
    <form action="booking.php" method="POST">
        <center>
            <h1>
                <u><strong>𝙲𝚑𝚎𝚌𝚔𝚘𝚞𝚝</strong></u>
            </h1>
        </center>
        <br>

        <div style="margin-left: 5px;">
            <center>
                <h3><strong>Here are the details of your Package. Hope you like our service!</strong></h3>
            </center>
        </div>
        <br>
        <center>
            <div class="row">
                <div class="col-md-4 order-md-2 mb-4" style="margin-left: auto; margin-right:auto ;width: auto;margin-bottom:-2%">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between lh-condensed bg-dark text-light">
                            <div>
                                <h3>
                                    <?php echo $package_name ?>
                                </h3>
                            </div>
                        </li>
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between lh-condensed bg-dark text-light">
                                <div>
                                    <h5>
                                        <?php echo 'Hotel Name: ', $hotel ?>
                                    </h5>
                                </div>
                            </li>
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between lh-condensed bg-dark text-light">
                                    <div>
                                        <h5>
                                            <?php echo 'Hotel Address: ', $hotel_address ?>
                                        </h5>
                                    </div>
                                </li>
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between lh-condensed bg-dark text-light">
                                        <div>
                                            <h5>
                                                <?php echo 'Transport: ', $vehicle ?>
                                            </h5>
                                        </div>
                                    </li>
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex justify-content-between lh-condensed bg-dark text-light">
                                            <div>
                                                <h6 class="my-0">Price per person</h6>
                                            </div>
                                            <span class="text-muted">
                                                <?php echo $package_price ?>
                                            </span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between lh-condensed bg-dark text-light">
                                            <div>
                                                <h6 class="my-0">No of people</h6>
                                            </div>
                                            <span class="text-muted">
                                                <?php echo $person ?>
                                            </span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between bg-dark text-light">
                                            <span>Total (PKR)</span>
                                            <strong>
                                                <?php echo $booking_total ?>
                                            </strong>
                                        </li>
                                    </ul>
                </div>
        </center>

        <center>
            <h3><strong>Did you change your mind?</strong></h3>
        </center>
        <center>
            <div class="d-grid gap-2 d-md-block" style="width: fit-content;">
                <button class="btn btn-dark btn-lg" type="submit" name="delete">Delete</button>
            </div>
        </center>
    </form>
    <center>
        <h3><strong>We know the world is full of choices. Thank you for choosing us!</strong></h3>
    </center>
    <br>
    <center>
        <a href="home.php" class="btn btn-dark btn-lg" style="margin-bottom: 20px;">Go to Homepage</a>
    </center>
    <br>
    <br>

    <div class="card text-center bg-dark">
        <div class="card-header">For all the Hodophiles out there</div>
        <div class="card-body">
            <h5 class="card-title">
                We travel not to escape life but for life not to escape us!
            </h5>
            <p class="card-text"></p>
            <a href="contact.php" class="btn btn-danger">Contact Us</a>
        </div>
        <div class="card-footer text-muted">
            &copy; 2022 Travel Bug. All rights reserved.
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
</body>

</html>