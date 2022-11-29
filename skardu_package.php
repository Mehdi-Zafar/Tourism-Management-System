<?php session_start();
include('config.php');
$ids = mysqli_query($con, "SELECT * from package");
$row = mysqli_fetch_array($ids, MYSQLI_ASSOC);
$count = mysqli_num_rows($ids);
$tc = mysqli_query($con, "SELECT * from transportation");
$row = mysqli_fetch_array($tc, MYSQLI_ASSOC);
$transportcount = mysqli_num_rows($tc);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

  <title>🆃🅱 Travel Bug | Skardu Package</title>
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
    <div class="m-3">
      <strong><u>
          <EM>
            <h1>SKARDU PACKAGE</h1>
          </EM>
        </u></strong>
    </div>
  </center>

  <ul class="nav nav-tabs">
    <?php for ($i = 1; $i < $count + 1; $i++) : ?>
      <li class="nav-item">
        <a class="nav-link active bg-dark text-light" aria-current="page" href="<?php $link_query = "SELECT link from package where Package_id = '$i'";
                                                                                $result2 = mysqli_query($con, $link_query);
                                                                                while ($row = mysqli_fetch_array($result2)) {
                                                                                  $link = $row[0];
                                                                                }
                                                                                echo "$link"; ?>"><?php $package_name_query = "SELECT Package_name from package where Package_id = '$i'";
                                                                                                  $result = mysqli_query($con, $package_name_query);
                                                                                                  while ($row = mysqli_fetch_array($result)) {
                                                                                                    $package_name = $row[0];
                                                                                                  }
                                                                                                  if ($package_name == 'Skardu Package') {
                                                                                                    echo "<span style='color:deepskyblue'>$package_name</span>";
                                                                                                  } else {
                                                                                                    echo "$package_name";
                                                                                                  } ?></a>
      </li>
    <?php endfor ?>
  </ul>

  <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="images\skardu4.jpg" class="d-block w-100" alt="..." />
      </div>
      <div class="carousel-item">
        <img src="images\skardu5.jpg" class="d-block w-100" alt="..." />
      </div>
      <div class="carousel-item">
        <img src="images\skardu2.jpg" class="d-block w-100" alt="..." />
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <div>
    <center>
      <u>
        <h2><strong>An Insight</strong></h2>
      </u>
    </center>
  </div>

  <div>
    <h4>
      Skardu is a town in the region of the same name in the Gilgit-Baltistan,
      Pakistan. Skardu, capital of Baltistan is perched 2,438 metres above sea
      level in the backdrop of the great peaks of the Karakorams. Balti people
      are a mixture of Tibetan and Caucasian stock and speak Balti, an ancient
      form of Tibetan. Due to the similarity of its culture, lifestyle and
      architecture with Tibet, Baltistan is also known as the "Tibet-e-Khurd"
      (Little Tibet). It borders on the Chinese province of Xinjiang and
      Ladakh. The tourist season is from April to October. Apart from its
      incomparable cluster of mountain peaks and glaciers Baltistan's five
      valleys, - Shigar, Skardu, Khaplu, Rondu and Kharmang are noted for
      their luscious peaches, apricots, apples and pears.
    </h4>
  </div>
  <br />

  <div>
    <center>
      <u>
        <h2><strong>Package Description</strong></h2>
      </u>
    </center>
  </div>

  <div>
    <h4>
      <?php $Packagedesc_query = "SELECT Package_desc from package where Package_name = 'Skardu Package'";
      $result2 = mysqli_query($con, $Packagedesc_query);
      while ($row = mysqli_fetch_array($result2)) {
        $Packagedesc = $row[0];
      }
      echo "$Packagedesc"; ?>
    </h4>
  </div>
  <br />
  <div>
    <center>
      <u>
        <h2><strong>Hotel Description</strong></h2>
      </u>
    </center>
  </div>
  <div>
    <h4>
      <?php $Hoteldesc_query = "SELECT Hotel_desc from hotel where Hotel_name = 'Crown Plaza'";
      $result3 = mysqli_query($con, $Hoteldesc_query);
      while ($row = mysqli_fetch_array($result3)) {
        $Hoteldesc = $row[0];
      }
      echo "$Hoteldesc"; ?>
    </h4>
  </div>
  <br>
  <div>
    <center>
      <u>
        <h2><strong>Transport Description</strong></h2>
      </u>
    </center>
  </div>
  <div>
    <h4>
      <?php for ($i = 1; $i < $transportcount + 1; $i++) {
        $Transportname_query = "SELECT Transportation_type from transportation where Transportation_id = '$i'";
        $result5 = mysqli_query($con, $Transportname_query);
        while ($row = mysqli_fetch_array($result5)) {
          $transportname = $row[0];
        }
        $Transportdesc_query = "SELECT Transportation_desc from transportation where Transportation_id = '$i'";
        $result4 = mysqli_query($con, $Transportdesc_query);
        while ($row = mysqli_fetch_array($result4)) {
          $transportdesc = $row[0];
        }
        echo "<strong>$transportname</strong>: $transportdesc";
        echo "<br>";
      } ?>
    </h4>
  </div><br>

  <center>
    <h4><strong><span class="pricebox"><?php $Packageprice_query = "SELECT Amount_per_person from package where Package_name = 'Skardu Package'";
                                        $result2 = mysqli_query($con, $Packageprice_query);
                                        while ($row = mysqli_fetch_array($result2)) {
                                          $Packageprice = $row[0];
                                        }
                                        echo "Package Price per person: Rs.$Packageprice"; ?></span></strong></h4>
  </center>
  <br>
  <center>
    <a href="booking.php" class="btn btn-dark btn-lg">Book Now</a>
  </center>
  <br />

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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>