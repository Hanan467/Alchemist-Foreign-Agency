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
    <title>New campaign</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

    <!--Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <style>
        body{
            background-color:#f2f6fc;
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
    <section>
    <div class="container mt-2">
    <div class="card border-0 p-3">
    <div class="card-title">
        <h2 class="text-center mb-3 mt-2">Create new campaign</h2>
    </div>
      <form action="new_campaign.php" method="post" enctype="multipart/form-data">
      <div class="row">
        <div class="form-group col-md-6 ">
          <label for="inputitem" class="ms-1">project name</label>
          <input type="text" class="form-control ms-1" id="inputitem" placeholder="project name" name="project-name">
        </div>
        <div class="form-group col-md-6">
        <label for="inputState">Category</label>
          <select id="inputState" class="form-control"  name="category">
            <option selected>Eduacation</option>
            <option>Social</option>
            <option>Business</option>
            <option>Medical</option>
            <option>Nature</option>
            <option>Entertainment</option>
          </select>
        </div>
      </div>
      <div class="row mt-2">
       <div class="form-group col-md-6 ">
        <div class="mb-2 mt-2">
            <img id="selectedImage" src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg"
            alt="example placeholder" style="width: 600px; height: 150px;" class="ms-1" />
        </div>
        <div class="container ms-5">
            <div class="btn btn-primary btn-rounded ms-5">
                <label class="form-label text-white" for="customFile1">Upload project image</label>
                <input type="file" class="form-control d-none ms-2" id="customFile1"  name="image" onchange="displaySelectedImage(event, 'selectedImage')" />
            </div>
        </div>
      </div>
      <div class="form-group col-md-6">
      <label for="exampleFormControlTextarea1">Description</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="5"  name="description"></textarea>  </div>
      
      <div class="row">
      <div class="form-group col-md-6 ">
          <label for="inputitem" class="ms-1">Funding Goal</label>
          <input type="number" class="form-control ms-1" id="inputitem" placeholder="Funding Goal" name="goal">
        </div>
        <div class="form-group col-md-6">
          <label for="inputitem">Campaign Start Date</label>
          <input type="date" class="form-control" id="inputitem"  name="start-date">
        </div>
      </div>
      <div class="form-group mt-3">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="gridCheck">
          <label class="form-check-label" for="gridCheck">
            Check me out
          </label>
        </div>
      </div >
      <button type="submit" class="btn btn-primary col-lg-4 mx-auto mt-3"  name="submit">Submit</button>
      </form>
      <?php
      include("conn.php");
      if(isset($_POST["submit"])){ 

        $pname = $_POST["project-name"];
        $category = $_POST["category"];
        $description = $_POST["description"];
        $funding_goal = $_POST["goal"];
        $start_date = $_POST["start-date"];
        $img = $_FILES["image"]["name"]; 
        $query = "INSERT INTO campaign (User_Id,Title,description,Funding_goal,Start_date,Image,Category) VALUES('$id','$pname','$description','$funding_goal','$start_date','$img','$category')";
        $insert = mysqli_query($conn,$query);
            if($insert){ 
                move_uploaded_file($_FILES['image']['tmp_name'],"assets/campaignpic/$img"); 
                echo' <p> Campaign created succesfully </p>';
            }  
            else{
              echo' <p> Campaign creation failed! try again </p>';

            }
      }

      ?>
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