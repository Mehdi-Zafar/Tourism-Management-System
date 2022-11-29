<?php
session_start();
include('config.php');
if (isset($_POST['delete'])) {
    $query0 = "SELECT max(booking_id) FROM booking;";
    $result0 = mysqli_query($con, $query0);
    while ($row = mysqli_fetch_array($result0)) {
        $booking = $row[0];
    }
    $query4 = "SELECT Customer_id FROM booking where Booking_id = '$booking'; ";
    $result4 = mysqli_query($con, $query4);
    while ($row = mysqli_fetch_array($result4)) {
        $customer_id = $row[0];
    }
    $query5 = "SELECT Package_id FROM booking where Booking_id = '$booking'; ";
    $result5 = mysqli_query($con, $query5);
    while ($row = mysqli_fetch_array($result5)) {
        $package_id = $row[0];
    }
    $query1 = "DELETE FROM booking_transportation where booking_id = '$booking';";
    $result1 = mysqli_query($con, $query1);
    $query2 = "DELETE FROM booking_hotel where booking_id = '$booking'";
    $result2 = mysqli_query($con, $query2);
    $query3 = "DELETE FROM customer_booking where booking_id = '$booking';";
    $result3 = mysqli_query($con, $query3);
    $query = "DELETE FROM booking where booking_id = '$booking';";
    $result = mysqli_query($con, $query);
    $query6 = "DELETE FROM customer_package where Customer_id = '$customer_id' and Package_id = '$package_id';";
    $result6 = mysqli_query($con, $query6);

    echo '<script>alert("Your booking was deleted!")</script>';
    echo "<script>location='booking.php'</script>";
}
$ids = mysqli_query($con, "SELECT * from package");
$row = mysqli_fetch_array($ids, MYSQLI_ASSOC);
$count = mysqli_num_rows($ids);

$transport_ids = mysqli_query($con, "SELECT * from transportation");
$row2 = mysqli_fetch_array($transport_ids, MYSQLI_ASSOC);
$transport_count = mysqli_num_rows($transport_ids);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

    <title>🆃🅱 Travel Bug | Booking</title>
    <link rel="stylesheet" href="style.css" Type="text/css" media="all">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
    </div>

    <div>
        <img src="images\300x600(3).jpg" class="floatRight img-responsive">
    </div>

    <div>
        <img src="images\300x600(3).jpg" class="floatLeft img-responsive">
    </div>

    <center>
        <div>
            <strong><u>
                    <h1>BOOKING</h1>
                </u></strong>
        </div>
    </center>


    <div class="row">
        <u>
            <h2 class="mb-3">Package Name</h2>
        </u>

        <form action="book.php" method="POST">
            <?php for ($i = 1; $i < $count + 1; $i++) : ?>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="package" id="$i" value=<?php echo "$i"; ?>>
                    <label class="form-check-label" for="exampleRadios1">
                        <h3><?php $package_name_query = "SELECT Package_name from package where Package_id = '$i'";
                            $result = mysqli_query($con, $package_name_query);
                            while ($row = mysqli_fetch_array($result)) {
                                $package_name = $row[0];
                            }
                            echo "$package_name"; ?></h3>
                    </label>
                </div>
            <?php endfor ?>
            <br>
            <u>
                <h2 class="mb-3">Transportation</h2>
            </u>
            <?php for ($i = 1; $i < $transport_count + 1; $i++) : ?>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="transport" id="$i" value=<?php echo "$i"; ?>>
                    <label class="form-check-label" for="exampleRadios1">
                        <h3><?php $transport_name_query = "SELECT Transportation_type from transportation where Transportation_id = '$i'";
                            $result2 = mysqli_query($con, $transport_name_query);
                            while ($row = mysqli_fetch_array($result2)) {
                                $transport_name = $row[0];
                            }
                            echo "$transport_name"; ?></h3>
                    </label>
                </div>
            <?php endfor ?>
            <br>
            <!-- <script type="text/javascript">
                function fn2() {
                    var murree = $("input[id='1']:checked").val();
                    var skardu = $("input[id='2']:checked").val();
                    var naran = $("input[id='3']:checked").val();
                    var hunza = $("input[id='4']:checked").val();
                    var people = document.getElementById("person").value;
                    var corolla = $("input[id='']:checked").val();
                    var hilux = $("input[id='hilux']:checked").val();
                    var hiace = $("input[id='hiace']:checked").val();
                    if (skardu) {
                        if (people > 2) {
                            var string = "Hotel Name: Hotel Bliss"
                            var price = people * 15000
                            var package = 15000
                            var place = "Skardu Package"
                            document.getElementById('output4').innerHTML = string
                            document.getElementById('output5').innerHTML = place
                        }
                    } else if (murree) {
                        if (people == 2) {
                            var string = "Hotel Name: Crown Plaza"
                            var price = 20000
                            var package = 10000
                            var place = "Murree Package"
                            document.getElementById('output4').innerHTML = string
                            document.getElementById('output5').innerHTML = place
                        }
                    } else if (naran) {
                        if (people > 2) {
                            var string = "Hotel Name: Spotlight Hotel"
                            var price = people * 13000
                            var package = 13000
                            var place = "Naran Package"
                            document.getElementById('output4').innerHTML = string
                            document.getElementById('output5').innerHTML = place
                        }
                    } else if (hunza) {
                        if (people > 2) {
                            var string = "Hotel Name: Royal Galaxy"
                            var price = people * 15000
                            var package = 15000
                            var place = "Hunza Package"
                            document.getElementById('output4').innerHTML = string
                            document.getElementById('output5').innerHTML = place
                        }
                    } else {
                        var package = null
                        var price = null
                        alert("Select one package")

                    }
                    if (people == 0) {
                        alert("Enter valid number of people");
                    }

                    if (corolla) {
                        var transport = "Transport: Toyota Corolla"
                    } else if (hilux) {
                        var transport = "Transport: Toyota Hilux"
                    } else if (hiace) {
                        var transport = "Transport: Toyota Hiace"
                    } else {
                        var transport = null
                        alert("Select one transport")
                    }
                    if (people != 2 && murree) {
                        alert("Only 2 people allowed as it is a couple package")
                    }
                    if (people < 3 && (skardu || naran || hunza)) {
                        alert("More than 2 people allowed as it is a family package")
                    }
                    if (people > 2 && (package == null)) {
                        var people = null
                        var transport = "-------"
                        var string = "-------"
                        var place = "-------"
                        document.getElementById('output4').innerHTML = string
                        document.getElementById('output5').innerHTML = place
                    }
                    document.getElementById('output').innerHTML = price;
                    document.getElementById('output2').innerHTML = people;
                    document.getElementById('output3').innerHTML = package;
                    document.getElementById('output6').innerHTML = transport;

                }
            </script> -->


            <center>
                <label for="No of people">Total no of people:</label>
                <input type="number" id="person" name="person" value="null"><br>
            </center>
            <br>
            <center>
                <button type="submit" name="confirmbtn" onclick="fn2()" id="confirmbtn" class="btn btn-dark btnclick">Confirm</button>
                <p style="margin-bottom: 50px; "><strong>(Make sure to check all details before pressing this button)</strong></p>
            </center>
        </form>
        <br>
    </div>
    </div>
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

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <script src="../../assets/js/vendor/holder.min.js"></script>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';

            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');

                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>





    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>