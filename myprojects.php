<?php
    session_start();
    if(isset($_SESSION["id"])){
        $id = $_SESSION["id"];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
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
    <section style="background-color: #f2f6fc;">
    <h3 class="text-center m-0">My projects</h3>
    <?php
include("conn.php");
$query = "SELECT campaign.Title, campaign.Image, campaign.Funding_goal, backing.Amount_pledged, campaign.Campaign_Id,
    COALESCE(SUM(backing.Amount_pledged), 0) AS Total_Pledged_Amount
    FROM campaign 
    LEFT JOIN backing ON campaign.Campaign_Id = backing.Campaign_Id 
    WHERE campaign.User_Id = '$id' 
    GROUP BY campaign.Campaign_Id";

$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $title = $row["Title"];
        $img = $row["Image"];
        $funding_goal = $row["Funding_goal"];
        $total_pledged = $row["Total_Pledged_Amount"];
        $percent = ($total_pledged / $funding_goal) * 100;
        $camp_id = $row["Campaign_Id"];

        $query2 = "SELECT backing.Amount_pledged, user.Username, profile.Profile_picture FROM backing 
            LEFT JOIN user ON backing.User_Id = user.User_Id 
            LEFT JOIN profile ON user.User_Id = profile.User_Id
            WHERE backing.Campaign_Id = '$camp_id'";
        $result2 = mysqli_query($conn, $query2);

        echo '<div class="row mt-4 ms-3">';
        
        echo '<div class="col-lg-5 mx-5">
                <div class="card mb-2 border-0"style="height:400px;">
                    <img src="assets/campaignpic/' . $img . '" class="card-img-top" alt="..." style="height:250px;">
                    <div class="card-body">
                        <h5 class="card-title">' . $title . '</h5>
                            <span class="raise mt-3"> $'.$total_pledged.' raised of $'.$funding_goal.'<i class="val"></i></span>
                            <div class="progress">
                                <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="'.$percent.'" aria-valuemin="0" aria-valuemax="100"  style="width:'.$percent.'%;"></div>
                            </div>
                    </div>
                </div>
            </div>';

        echo '<div class="col-lg-5">
                <div class="card ms-5 border-0">
                    <div class="card-body">
                        <h5 class="card-title">Transaction history</h5>
                        <hr/>';
        if (mysqli_num_rows($result2) > 0) {
            while ($row2 = mysqli_fetch_assoc($result2)) {
                $username = $row2["Username"];
                $amount_pledged = $row2["Amount_pledged"];
                $pp = $row2["Profile_picture"];
                echo '<div class="row mt-3 mb-4">
                        <div class="col-lg-2">
                            <img src="assets/img/' . $pp . '" style="height: 40px; width:60px;" class="card-img-top col-3 ms-2" alt="...">
                        </div>
                        <div class="col-lg-7">
                            <p>' . $username . '</p>
                        </div>
                        <div class="col-lg-3">
                        <p>$' . $amount_pledged . '</p>
                        </div>
                    </div>';
            }
        }
        echo '</div></div></div>'; 
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