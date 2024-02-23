<?php
session_start();
if (isset($_GET['cid'])) {
    $cid = $_GET['cid'];
    $_SESSION["cid"]=$cid;
  }
if (isset($_GET['uid'])) {
      $uid = $_GET['uid'];}
      
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta pay="viewport" content="width=device-width, initial-scale=1.0">
    <title>campaign detail</title>
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
    <section style="background-color: #f2f6fc;" class="ps-5">
    <?php
    include("conn.php");
    $query = "SELECT user.Username, campaign.Title, campaign.Image, profile.Profile_picture, campaign.Funding_goal,campaign.Description,
    COALESCE(SUM(backing.Amount_pledged), 0) AS Total_Pledged_Amount
FROM campaign
inner JOIN user ON user.User_Id = campaign.User_Id 
inner JOIN profile ON user.User_Id = profile.User_Id
left JOIN backing ON campaign.Campaign_Id = backing.Campaign_Id
WHERE campaign.Campaign_Id = '$cid'"; 

$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
$row = mysqli_fetch_assoc($result);
echo '<div class="row mt-4">';
$uname = $row["Username"];
$title = $row["Title"];
$img = $row["Image"];
$pp = $row["Profile_picture"];
$funding_goal = $row["Funding_goal"];
$total_pledged = $row["Total_Pledged_Amount"];
$percent = ($total_pledged / $funding_goal) * 100;
$description = $row["Description"];
echo '<div class="col-lg-6">
<div class="card">
    <img src="assets/campaignpic/' . $img . '" class="card-img-top" alt="..."style="height:300px;" >
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
</div>
<div class="col-lg-5 ">       
<div class="card">
 <div class="card-body">
 <h5 class="card-title mb-4 text-primary">About the project</h5>
 <p>'. $description.'</p>
 <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
 Back this project </button> 
 </div>
</div>
</div>
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
      <div class="modal-header">
          <h5 class="modal-title">Payment</h5>
          <button type="button" class="close btn-danger" data-dismiss="modal">&times;</button>
        </div>
        
        <div class="modal-body">  
          <form action="campaign_detail.php?cid=' . $_SESSION["cid"] .'&uid='. $_SESSION["id"] . ' " method="post">
          <h5>Pay with credit card</h5>
            <div class="form-group">
              <label for="pay">Amount to pledge</label>
              <input type="number" class="form-control" id="pay" name="amount">
            </div>
            <div class="form-group">
              <label for="cardno">Card number</label>
              <input type="number" class="form-control" id="cardno" placeholder="************" name="cardno">
              </div>
            <div class="row mb-4">
            <div class="form-group col-6">
              <label for="cvc">CVC</label>
              <input type="number" class="form-control" id="cvc" placeholder="****" name="cvc">
              </div>
              <div class="form-group col-6">
              <label for="exp">Expiration</label>
              <input type="date" class="form-control" id="exp" placeholder="MMYY" name="expiration">
            </div>
            </div>
            <div class = "text-center mb-3">
            <button type="submit" class="btn btn-primary" name="pledge">Pledge Now</button>    
            <hr>
            <p>Or select another method</p>
            <p>Pay with <a></a></p>
            </div>
          </form>
        </div>
        
      </div>
    </div>
  </div>';

}
include("back.php");
?>
    </section>
    <!-- jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>