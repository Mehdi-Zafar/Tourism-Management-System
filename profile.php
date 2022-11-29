<?php session_start();
include('config.php');
$email = $_SESSION['email'];
$query1 = "SELECT Customer_id FROM customer WHERE Customer_email = '$email'";
$result1 = mysqli_query($con, $query1);
while ($row1 = mysqli_fetch_array($result1)) {
    $Customer_id = $row1[0];
}
$query8 = "SELECT Customer_name FROM customer WHERE Customer_email = '$email'";
$result8 = mysqli_query($con, $query8);
while ($row8 = mysqli_fetch_array($result8)) {
    $Customer_name = $row8[0];
}
$query2 = "SELECT Booking_id FROM booking WHERE Customer_id = '$Customer_id'";
$result2 = mysqli_query($con, $query2);
$arrayofrows = mysqli_fetch_all($result2);
$row2 = mysqli_fetch_array($result2);
$count = mysqli_num_rows($result2);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />

    <title>🆃🅱 Travel Bug | My Profile</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Stylish&display=swap" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="border-bottom: 1px dashed white;">
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
                            <li><a class="dropdown-item" href="murree_package.php">Murree Package</a></li>
                            <li><a class="dropdown-item" href="skardu_package.php">Skardu Package</a></li>
                            <li><a class="dropdown-item" href="naran_package.php">Naran Package</a></li>
                            <li><a class="dropdown-item" href="hunza_package.php">Hunza Package</a></li>
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
                        <button type="submit" class="btn btn-primary">Login</button>
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
    </div><br>

    <center>
        <h1 class="text-dark" id="profilehead">Welcome to your Profile "<?php echo "$Customer_name"; ?>"</h1>
    </center>

    <?php if ($count == 0) : ?>
        <center><br>
            <h3 style="margin-bottom: 13.2%;">You currently have not purchased any packages!</h3>
        </center>
    <?php else : ?>
        <center>
            <h3><u>Your Packages</u></h3>
        </center>

        <center>
            <div style="overflow-x: auto;">
                <table>
                    <tr>
                        <th>S.no</th>
                        <th>Package Name</th>
                        <th>Hotel Name</th>
                        <th>Transportation</th>
                        <th>Booking Date<br>(YYYY/MM/DD)</th>
                        <th>No of people</th>
                        <th>Booking Total</th>
                    </tr>
                    <?php for ($i = 0; $i < $count; $i++) :
                        $booking_id = implode($arrayofrows[$i]); ?>
                        <tr>
                            <td><?php echo $i + 1; ?></td>
                            <td><?php $query4 = "SELECT Package_id FROM booking WHERE Booking_id='$booking_id'";
                                $result4 = mysqli_query($con, $query4);
                                while ($row4 = mysqli_fetch_array($result4)) {
                                    $Package_id = $row4[0];
                                }
                                $query3 = "SELECT Package_name FROM package WHERE Package_id ='$Package_id'";
                                $result3 = mysqli_query($con, $query3);
                                while ($row3 = mysqli_fetch_array($result3)) {
                                    $Packagename = $row3[0];
                                }
                                echo "$Packagename"; ?></td>
                            <td><?php $query11 = "SELECT Hotel_id FROM hotel_info WHERE Package_id='$Package_id'";
                                $result11 = mysqli_query($con, $query11);
                                while ($row11 = mysqli_fetch_array($result11)) {
                                    $Hotel_id = $row11[0];
                                }
                                $query12 = "SELECT Hotel_name FROM hotel WHERE Hotel_id = '$Hotel_id'";
                                $result12 = mysqli_query($con, $query12);
                                while ($row12 = mysqli_fetch_array($result12)) {
                                    $Hotel_name = $row12[0];
                                }
                                echo "$Hotel_name";
                                ?></td>
                            <td><?php $query9 = "SELECT Transportation_id FROM booking_transportation WHERE Booking_id='$booking_id'";
                                $result9 = mysqli_query($con, $query9);
                                while ($row9 = mysqli_fetch_array($result9)) {
                                    $transport_id = $row9[0];
                                }
                                $query10 = "SELECT Transportation_type FROM transportation WHERE Transportation_id = '$transport_id'";
                                $result10 = mysqli_query($con, $query10);
                                while ($row10 = mysqli_fetch_array($result10)) {
                                    $transport_name = $row10[0];
                                }
                                echo "$transport_name";
                                ?></td>
                            <td><?php $query5 = "SELECT Booking_date FROM booking WHERE Booking_id='$booking_id'";
                                $result5 = mysqli_query($con, $query5);
                                while ($row5 = mysqli_fetch_array($result5)) {
                                    $booking_date = $row5[0];
                                }
                                echo "$booking_date"; ?></td>
                            <td><?php $query6 = "SELECT Person FROM booking WHERE Booking_id='$booking_id'";
                                $result6 = mysqli_query($con, $query6);
                                while ($row6 = mysqli_fetch_array($result6)) {
                                    $person = $row6[0];
                                }
                                echo "$person"; ?></td>
                            <td><?php $query7 = "SELECT Booking_total FROM booking WHERE Booking_id='$booking_id'";
                                $result7 = mysqli_query($con, $query7);
                                while ($row7 = mysqli_fetch_array($result7)) {
                                    $total = $row7[0];
                                }
                                echo "$total"; ?></td>
                        </tr>
                    <?php endfor ?>
                </table>
            </div>
        </center>

    <?php endif ?>

    <div class="card text-center bg-dark" id="footer">
        <div class="card-header">For all the Hodophiles out there</div>
        <div class="card-body">
            <h5 class="card-title">
                We travel not to escape life but for life not to escape us!
            </h5>
            <p class="card-text"></p>
            <a href="contact.php" class="btn btn-danger">Contact Us</a>
        </div>
        <div class="card-footer text-muted">&copy; 2022 Travel Bug. All rights reserved.</div>
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