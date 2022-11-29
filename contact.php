<?php session_start();
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

  <title>🆃🅱 Travel Bug | Contact Us</title>
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
            <a class="nav-link text-white" href="contact.php">Contact Us</a>
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

  <center>
    <img src="images\contact.jpg" class="img-fluid" alt="..." />
  </center>

  <div class="card text-center bg-dark">
    <h3>
      <div class="card-header">Become a part of our family</div>
    </h3>
    <div class="card-body">
      <blockquote class="blockquote mb-0">
        <p>
          Contact no:- 034659385783
          <br />
          Email ID:- travelbug@gmail.com <br />
          Address:- Shop#3, street#4, ABC Area, Karachi
        </p>

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