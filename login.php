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
    <style>
      body{
        background-color: f2f6fc;
      }
    </style>
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
            <li><a href="./Index.php">Home</a></li>
            <li><a href="./About.php">About Us</a></li>
            <li><a href="./discover.php">Discover</a></li>
            <li><a href="./login.php" class="active">Login</a></li>
          </ul>
          <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>
      </div>
    </header>
    <section class="vh-40">
  <div class="container py-3 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card">
          <div class="row g-0">
          <div class="col-md-6 col-lg-5 d-none d-md-block mt-5">
    <img src="https://storage.googleapis.com/shopify-customerio/tools/image_attachment/image/9-16-rectangle-alvaro-reyes-qwwphwip31m-unsplash-jpg_custom_resized.jpg"
        alt="login form" class="img-fluid" style="border-radius: 1rem; height: 600px; width: 600px;;" />
</div>

            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

                <form action="login.php" method="post">

                  <div class="d-flex align-items-center mb-3 pb-1">
                    <i class="bi bi-cubes fa-2x me-3" style="color: #ff6219;"></i>
                    <span class="h1 fw-bold mb-0">BackIt</span>
                  </div>

                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>

                   <div class="form-outline mb-4">
                   <label class="form-label" for="emailinput">Email address</label>
                    <input type="email" id="emailinput" class="form-control form-control-lg" name="email" required/>
                  </div>

                  <div class="form-outline mb-4">
                    <label class="form-label" for="password input">Password</label>
                    <input type="password" id="password input" class="form-control form-control-lg" name="password" required />
                  </div>

                  <div class="pt-1 mb-4 ">
                    <button class="btn btn-lg btn-block " type="submit" style="background-color:#7563d7;" name="submit">Login</button>
                  </div>
                  <p class="mb-5 mt-2 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="./register.php"
                      style="color: #73A5C6;">Register here</a></p>
                  <a href="#" class="small text-muted">Terms of use.</a>
                  <a href="#" class="small text-muted">Privacy policy</a>
                </form>
                <?php
                include("conn.php");
                if(isset($_POST["submit"]))
                {
                  $email = $_POST["email"];
                  $password = md5($_POST["password"]);
                  $query = "SELECT * FROM user where Email = '$email' and Password = '$password'";
                  $result = mysqli_query($conn,$query);
                  if(mysqli_num_rows($result)>0){
                    $row = mysqli_fetch_assoc($result);
                    session_start();
                    $_SESSION['id'] = $row['User_Id'];
                    header("location:home.php?id=". $_SESSION['id']);
                  }
                  else{
                    echo '<p style="color: red;">Login failed. Incorrect username or password</p>';
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

      <div class="col-lg-3 col-md-6 footer-contact">
        <h3>BackIt<span>.</span></h3>
        <p>
          Addis Ababa, Ethiopia<br><br>
          <strong>Phone:</strong> +251 1589 55488 55<br>
          <strong>Email:</strong> BackIt@gmail.com<br>
        </p>
      </div>

      <div class="col-lg-3 col-md-6 footer-links">
        <h4>Useful Links</h4>
        <ul>
        <li><a href="./Index.php">Home</a></li>
            <li><a href="">About Us</a></li>
            <li><a href="./">Discover</a></li>
            <li><a href="./login.php" class="active">Login</a></li>
        </ul>
      </div>

      <div class="col-lg-3 col-md-6 footer-links">
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