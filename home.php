<?php
session_start();
if (!isset($_SESSION['email'])) {
    $_SESSION['email'] = null;
}
include('config.php');
$ids = mysqli_query($con, "SELECT * from package");
$row = mysqli_fetch_array($ids, MYSQLI_ASSOC);
$count = mysqli_num_rows($ids);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />

    <title>🆃🅱 Travel Bug</title>
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
                        <a class="nav-link text-white" aria-current="page" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About Us</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact Us</a>
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


    <div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images\water.jpg" class="d-block w-100" alt="..." />
                <div class="carousel-caption d-none d-md-block">
                    <strong>
                        <h3>Welcome to Travel Bug</h3>
                    </strong>
                    <h5 class="text-light">Specialists in the art of travel</h5>
                    <button type="button" class="btn btn-primary">Travel</button>
                    <button type="button" class="btn btn-warning">Tourism</button>
                    <button type="button" class="btn btn-success">Adventure</button>
                </div>
            </div>
            <div class="carousel-item">
                <img src="images\tourism2.jpg" class="d-block w-100" alt="..." />
                <div class="carousel-caption d-none d-md-block">
                    <strong>
                        <h3>Welcome to Travel Bug</h3>
                    </strong>
                    <h5 class="text-light">Specialists in the art of travel</h5>
                    <button type="button" class="btn btn-primary">Travel</button>
                    <button type="button" class="btn btn-warning">Tourism</button>
                    <button type="button" class="btn btn-success">Adventure</button>
                </div>
            </div>
            <div class="carousel-item">
                <img src="images\forest.jpg" class="d-block w-100" alt="..." />
                <div class="carousel-caption d-none d-md-block">
                    <strong>
                        <h3>Welcome to Travel Bug</h3>
                    </strong>
                    <h5 class="text-light">Specialists in the art of travel</h5>
                    <button type="button" class="btn btn-primary">Travel</button>
                    <button type="button" class="btn btn-warning">Tourism</button>
                    <button type="button" class="btn btn-success">Adventure</button>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="row row-cols-1 row-cols-md-2 g-4">
        <?php for ($x = 1; $x < $count + 1; $x++) : ?>
            <div class="col">
                <div class="card" id="card1">
                    <img src="<?php $img = mysqli_query($con, " SELECT Picture FROM package where Package_id = '$x'");
                                while ($row = mysqli_fetch_array($img)) {
                                    $image = $row['Picture'];
                                    echo "images\\$image";
                                } ?>" class=" card-img-top" alt="..." style="width: 100%;height:400px">
                    <div class="card-body bg-success text-white">
                        <h3 class="card-title"><?php $package_name_query = "SELECT Package_name from package where Package_id = '$x'";
                                                $result = mysqli_query($con, $package_name_query);
                                                while ($row = mysqli_fetch_array($result)) {
                                                    $package_name = $row[0];
                                                }
                                                echo "$package_name"; ?></h3>
                        <p class="card-text"><?php $package_type_query = "SELECT Package_type from package where Package_id = $x";
                                                $result2 = mysqli_query($con, $package_type_query);
                                                while ($row2 = mysqli_fetch_array($result2)) {
                                                    $package_type = $row2[0];
                                                } ?>
                            <span style="font-weight: bold;"><?php echo "$package_type"; ?></span> comprising of 5 days and 4 nights along with transportation and hotel!
                        </p>
                        <a href="<?php $link_query = "SELECT link from package where Package_id = '$x'";
                                    $result2 = mysqli_query($con, $link_query);
                                    while ($row = mysqli_fetch_array($result2)) {
                                        $link = $row[0];
                                    }
                                    echo "$link"; ?>" class="btn btn-dark text-light">View Package</a>
                    </div>
                </div>
            </div>
        <?php endfor ?>

    </div><br>

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