<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

    <!--Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
<header>
      <div class="container d-flex align-items-center justify-content-between">
        <h1 class="logo"><a href="./Index.php">BackIt</a></h1> 
        <div class="input-group rounded ms-5">
            <input type="search" class="form-control rounded" placeholder="Search projects" aria-label="Search" aria-describedby="search-addon" />
            <span class="input-group-text border-0" id="search-addon">
              <i class="bi bi-search"></i>
            </span>
          </div>
        <nav class="navbar">
         <ul>
         <li><a href="./Index.php" class="">Home</a></li>
            <li><a href="" class="">About Us</a></li>
            <li><a href="./"class="">Discover</a></li>
            <li><a href="./login.php"class=" active">Login</a></li>
          </ul>
          <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>
      </div>
    </header>
    <section class="vh-40" style="background-color: #f2f6fc;">
  <div class="container py-3 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 50px;">
          <div class="row g-0">
          <div class="form-outline mb-4 col-lg-5 d-none d-md-block mt-5">
    <img src="https://storage.googleapis.com/shopify-customerio/tools/image_attachment/image/9-16-rectangle-alvaro-reyes-qwwphwip31m-unsplash-jpg_custom_resized.jpg"
        alt="login form" class="img-fluid" style="border-radius: 1rem; height: 600px; width: 600px;;" />
</div>

            <div class="form-outline mb-4 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

                <form action="register.php" method="post">
                <div class="d-flex align-items-center mb-3 pb-1">
                    <span class="h1 fw-bold mb-0">BackIt</span>
                  </div>

                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Get started by creating your account</h5>

                        <div class="mb-4">
                            <label class="small mb-1" for="inputUsername">Username</label>
                            <input class="form-control mt-3" id="inputUsername" type="text" placeholder="Enter your username" name="uname">
                        </div>
                        <div class="row gx-3 mb-4">

                            <div class="col-md-6">
                                <label class="small mb-1" for="inputFirstName">First name</label>
                                <input class=" form-control mt-3" id="inputFirstName" type="text" placeholder="Enter your first name" name="fname">
                            </div>

                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLastName">Last name</label>
                                <input class=" form-control mt-3" id="inputLastName" type="text" placeholder="Enter your last name" name="lname">
                            </div>
                        </div>
                        <div class="row gx-3 mb-4">
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputEmailAddress">Email address</label>
                            <input class=" form-control mt-3" id="inputEmailAddress" type="email" placeholder="Enter your email address"name="email">
                        </div>

                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPhone">Phone number</label>
                                <input class=" form-control mt-3" id="inputPhone" type="tel" placeholder="Enter your phone number" name="phone_no">
                            </div>
                        </div>

                        <div class="row gx-3 mb-4">
                        <div class="col-md-6">
                            <label class="small mb-1" for="InputPassword">Password</label>
                            <input type="password" class="form-control" id="InputPassword" placeholder="Password" name="password" required>
                        </div>

                         <div class="col-md-6">
                            <label class="small mb-1" for="InputcPassword">Confirm Password</label>
                            <input type="password" class="form-control" id="InputcPassword" placeholder="Confirm Password" name="confirm_password" required>
                         </div>
                        </div>
                        <button class="btn btn-primary" type="submit" name="register">Register</button>
                        <p class="mb-5 mt-2 pb-lg-2" style="color: #393f81;">Have an account? <a href="./login.php"
                      style="color: #73A5C6;">Login here</a></p>
                  <a href="#" class="small text-muted">Terms of use.</a>
                  <a href="#" class="small text-muted">Privacy policy</a>
                    </form>
                <?php
                include("conn.php");
                if(isset($_POST["register"])){
                     $uname = $_POST["uname"];
                     $fname = $_POST["fname"];
                     $lname = $_POST["lname"];
                     $email = $_POST["email"];
                     $pass = md5($_POST["password"]);
                     $conf = md5($_POST["confirm_password"]);
                     $phone_no = $_POST["phone_no"];
                     if($conf==$pass){
                      $query = "INSERT INTO user (Username,First_name,Last_name,Email,Password,Phone_no) VALUES ('$uname','$fname','$lname','$email','$pass','$phone_no')";

                          try{
                              mysqli_query($conn,$query);
                              echo "Welcome you have registered succesfully!";
                             }
                          catch(mysqli_sql_exception){
                               echo "Something went wrong";
                              }
                            }
                     else{
                           echo '<p style="color: red;">password mismatch!<p>';
                          }
                        }
                    ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
    <!-- ======= Footer ======= -->
  <footer id="footer">

<div class="footer-top">
  <div class="container">
    <div class="row">

      <div class="col-lg-3 form-outline mb-4 footer-contact">
        <h3>BackIt<span>.</span></h3>
        <p>
          Addis Ababa, Ethiopia<br><br>
          <strong>Phone:</strong> +251 1589 55488 55<br>
          <strong>Email:</strong> BackIt@gmail.com<br>
        </p>
      </div>

      <div class="col-lg-3 form-outline mb-4 footer-links">
        <h4>Useful Links</h4>
        <ul>
        <li><a href="./Index.php" class="active">Home</a></li>
            <li><a href="">About Us</a></li>
            <li><a href="./">Discover</a></li>
            <li><a href="./login.php">Login</a></li>
        </ul>
      </div>

      <div class="col-lg-3 form-outline mb-4 footer-links">
        <h4>Our Social Networks</h4>
        <p>You can reach us through the following platforms</p>
        <div class="social-links mt-3">
          <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
          <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
          <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
          <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
        </div>
      </div>

    </div>
  </div>
</div>

<div class="container py-4">
  <div class="copyright">
    &copy; Copyright <strong><span>Bidify</span></strong>. All Rights Reserved
  </div>
  <div class="credits">
    Designed by <a href="#">Hanan Ansar</a>
  </div>
</div>
</footer><!-- End Footer -->

<div id="preloader"></div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->

<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!--Main JS File
<script src="assets/js/main.js"></script>-->
</body>
</html>