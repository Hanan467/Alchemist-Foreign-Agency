<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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
            <li><a href="./home.php?id=<?php echo $_SESSION['id']; ?>" class="active scrollto">Home</a></li>
            <li><a href="./myprojects.php?id=<?php echo $_SESSION['id']; ?>" class="scrollto">My projects</a></li>
            <li><a href="./new_campaign.php?id=<?php echo $_SESSION['id']; ?>" class="scrollto">New campaign</a></li>
            <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-person"></i> 
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="./profile.php?id=<?php echo $_SESSION['id']; ?>">Account</a></li>
            <li><a class="dropdown-item" href="./Index.php">Log out</a></li>
          </ul>
        </li>
            </ul>
          <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>
      </div>
    </header>
    <!-- end header-->
    <div class="container">
  <div class="row mt-2">
    <div class="col-4 col-md-3 col-lg-2">
      <a href="?Category=Eduacation" class="navigation-link">
        <img src="assets/img/education.png" class="img-fluid navigation-img " style="height: 40px; width:40px;" alt="Eduacation">
        <h6 class="navigation-title small " style>Eduacation</h6>
      </a>
    </div>
    <div class="col-4 col-md-3 col-lg-2">
      <a href="?Category=Medical" class="navigation-link">
        <img src="assets/img/medical.png" class="img-fluid navigation-img" style="height: 40px; width:40px;" alt="Medical">
        <h6 class="navigation-title small">Medical</h6>
      </a>
    </div>
    <div class="col-4 col-md-3 col-lg-2">
      <a href="?Category=Nature" class="navigation-link">
        <img src="assets/img/nature.png" class="img-fluid navigation-img" style="height: 40px; width:40px;" alt="Nature">
        <h6 class="navigation-title small">Nature</h6>
      </a>
    </div>
    <div class="col-4 col-md-3 col-lg-2">
      <a href="?Category=Social" class="navigation-link">
        <img src="assets/img/social.png" class="img-fluid navigation-img" style="height: 40px; width:40px;" alt="Social">
        <h6 class="navigation-title small">Social</h6>
      </a>
    </div>
    <div class="col-4 col-md-3 col-lg-2">
      <a href="?Category=Business" class="navigation-link">
        <img src="assets/img/business.png" class="img-fluid navigation-img" style="height: 40px; width:40px;" alt="Business">
        <h6 class="navigation-title small">Business</h6>
      </a>
    </div>
    <div class="col-4 col-md-3 col-lg-2">
      <a href="?Category=Entertainment" class="navigation-link">
        <img src="assets/img/entertainment.png" class="img-fluid navigation-img" style="height: 40px; width:40px;" alt="Entertainment">
        <h6 class="navigation-title small">Entertainment</h6>
      </a>
    </div>
  </div>
</div>
<section style="background-color: #f2f6fc;" class="ps-5">
 <?php
include("conn.php");
if (isset($_GET['Category'])) {
    $Category = $_GET['Category'];
    $query = "SELECT user.Username, campaign.Title, campaign.Image, profile.Profile_picture, campaign.Funding_goal,
                     COALESCE(SUM(backing.Amount_pledged), 0) AS Total_Pledged_Amount
              FROM campaign
              LEFT JOIN user ON user.User_Id = campaign.User_Id 
              LEFT JOIN profile ON user.User_Id = profile.User_Id
              LEFT JOIN backing ON campaign.Campaign_Id = backing.Campaign_Id
              WHERE campaign.Category = '$Category'
              GROUP BY campaign.Campaign_Id"; 
              
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
              echo '<div class="row mt-4">';
        while ($row = mysqli_fetch_assoc($result)) {
            $uname = $row["Username"];
            $title = $row["Title"];
            $img = $row["Image"];
            $pp = $row["Profile_picture"];
            $funding_goal = $row["Funding_goal"];
            $total_pledged = $row["Total_Pledged_Amount"];
            $percent = ($total_pledged / $funding_goal) * 100;
            echo '<div class="col-lg-3">
                            <div class="card" style="height:400px;">
                                <img src="assets/campaignpic/' . $img . '" class="card-img-top" alt="...">
                                <div class="row p-0">
                                    <img src="assets/img/' . $pp . '" style="height: 40px; width:60px;" class="card-img-top col-3 ms-2" alt="...">
                                    <p class="card-text col-4 mt-2 m-0 ">' . $uname. '</p>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">' . $title . '</h5>
                                        <span class="raise mt-3"> $'.$total_pledged.' raised of $'.$funding_goal.'<i class="val"></i></span>
                                        <div class="progress">
                                        <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="'.$percent.'" aria-valuemin="0" aria-valuemax="100"  style="width:'.$percent.'%;"></div>
                                      </div>
                                </div>
                            </div>
                        </div>';
        }
    }
}
?>
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
              <li><a href="Index.php">Home</a></li>
              <li><a href="About.php">About us</a></li>
              <li><a href="#">Contact Us</a></li>
              <li><a href="Register.php">Register</a></li>
              <li><a href="/login.php">Login</a></li>
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
        &copy; Copyright <strong><span>BackIt</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        Designed by <a href="#">Hanan Ansar</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!--Main JS File -->
  <script src="assets/js/main.js"></script>
</body>
</html>