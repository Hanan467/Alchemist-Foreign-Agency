<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
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
            <li><a href="./home.php" class="active scrollto">Home</a></li>
            <li><a href="./myprojects.php" class="scrollto">My projects</a></li>
            <li><a href="./new_campaign.php" class="scrollto">New campaign</a></li>
            <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-person"></i> 
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="./profile.php">Account</a></li>
            <li><a class="dropdown-item" href="./Index.php">Log out</a></li>
          </ul>
        </li>
            </ul>
          <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>
      </div>
    </header>
    <!-- end header-->
  
<section style="background-color: #f2f6fc;" class="ps-5">
 <?php
include("conn.php");

    $query = "SELECT user.Username, campaign.Title, campaign.Image, profile.Profile_picture, campaign.Funding_goal,campaign.Campaign_Id,campaign.Description,campaign.Category,
                     COALESCE(SUM(backing.Amount_pledged), 0) AS Total_Pledged_Amount
              FROM campaign
              LEFT JOIN user ON user.User_Id = campaign.User_Id 
              LEFT JOIN profile ON user.User_Id = profile.User_Id
              LEFT JOIN backing ON campaign.Campaign_Id = backing.Campaign_Id
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
            $description = $row["Description"];
            $category = $row["Category"];
            $cpid = $row["Campaign_Id"];
            echo '<div class="col-lg-6 mb-4">
<div class="card">
    <img src="assets/campaignpic/' . $img . '" class="card-img-top" alt="..."style="height:300px;" >
    <div class="row p-0">
        <img src="assets/img/' . $pp . '" style="height: 40px; width:60px;" class="card-img-top col-3 ms-2" alt="...">
        <p class="card-text col-4 mt-2 m-0 ">' . $uname. '</p>
    </div>
    <div class="card-body">
    <h5 class="card-title">' . $title . '</h5>
            <span class="raise mt-3"> Category: '.$category.'</span><br>
            <span class="raise mt-3"> Funding goal: $'.$funding_goal.'</span>

            
    </div>
</div>
</div>
<div class="col-lg-5 ">       
<div class="card">
 <div class="card-body">
 <h5 class="card-title mb-4 text-primary">About the project</h5>
 <p>'. $description.'</p>
 <form action="approve_campaign.php" method="post">
 <input type="hidden" name="campaign_id" value="' . $cpid . '">
 <button class="btn btn-primary" name="approve" type="submit">
 Approve Project</button> 
 <form>
 </div>
</div>
</div>';
        }
      }
        if(isset($_POST["approve"])){
          $cpid = $_POST["campaign_id"];
          $query2="UPDATE campaign SET Is_approved='1' WHERE Campaign_Id='$cpid'";
          $result2 = mysqli_query($conn,$query2);
          if($result2){
              echo '<p>Campaign Approved</p>';
          }
          else{
              echo '<p>Something went wrong,Please try again!</p>';
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