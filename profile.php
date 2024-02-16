<?php
    session_start();
    if(isset($_SESSION["id"])){
        $id = $_SESSION["id"];
    }
    include("conn.php");
    $query = "SELECT * FROM user WHERE User_Id = '$id'";
    $result = mysqli_query($conn,$query);
    if(mysqli_num_rows($result)>0){
        $row = mysqli_fetch_assoc($result);
        $uname = $row["Username"];
        $fname = $row["First_name"];
        $lname = $row["Last_name"];
        $email = $row["Email"];
        $phone_no = $row["Phone_no"];
        $bday = $row["Birthday"];

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
    <section style="background-color: #f2f6fc; height: 100vh">
        <div class="container mt-2">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header"> Profile picture </div>
                        <div class="card-body text-center">
                            <img id="selectedImage" src="./assets/img/avatar3.png" alt="" class="img-account-profile rounded-circle "><br>
                            <div class="btn btn-rounded  btn-primary mt-3">
                                <label class="form-label" for="externalElement">Edit profile picture</label>
                                <input type="file" class=" form-control mt-3 d-none ms-2" id="externalElement" onchange="displaySelectedImage(event, 'selectedImage')" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 ">
                    <div class="card">
                        <div class="card-header">
                            Account Details
                        </div>
                        <div class="card-body">
                        <form action="profile.php" method="post" enctype="multipart/form-data">
                        <div class="mb-4">
                            <label class="small mb-1" for="inputUsername">Username</label>
                            <input class="form-control mt-3" id="inputUsername" type="text" placeholder="Enter your username" name="uname" value="<?php echo $uname;?>">
                        </div>
                        <div class="row gx-3 mb-4">

                            <div class="col-md-6">
                                <label class="small mb-1" for="inputFirstName">First name</label>
                                <input class=" form-control mt-3" id="inputFirstName" type="text" placeholder="Enter your first name" value="<?php echo $fname;?>" name="fname">
                            </div>

                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLastName">Last name</label>
                                <input class=" form-control mt-3" id="inputLastName" type="text" placeholder="Enter your last name" value="<?php echo $lname;?>" name="lname">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="small mb-1" for="inputEmailAddress">Email address</label>
                            <input class=" form-control mt-3" id="inputEmailAddress" type="email" placeholder="Enter your email address" value="<?php echo $email;?>" name="email">
                        </div>

                        <div class="row gx-3 mb-4">

                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPhone">Phone number</label>
                                <input class=" form-control mt-3" id="inputPhone" type="tel" placeholder="Enter your phone number" name="phone" value="<?php echo $phone_no;?>">
                            </div>

                            <div class="col-md-6">
                                <label class="small mb-1" for="inputBirthday">Birthday</label>
                                <input class=" form-control mt-3" id="inputBirthday" type="date" name="birthday" placeholder="Enter your birthday" value="<?php echo $bday;?>">
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit" name="save">Save changes</button>
                    </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    if(isset($_POST["save"])){
        $uname = $_POST["uname"];
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $email = $_POST["email"];
        $phone_no = $_POST["phone"];
        $bday = $_POST["birthday"];
        $img = $_FILES["image"]["name"]; 
        $query2 = "UPDATE user SET Username = '$uname',First_name = '$fname',Last_name = '$lname',Email = '$email',Phone_no = '$phone_no',Birthday = '$bday' WHERE User_Id = '$id'";
        try{
            $insert = mysqli_query($conn,$query);
            if($insert){ 
                move_uploaded_file($_FILES['image']['tmp_name'],"picture/$img"); 
            }
            mysqli_query($conn,$query2);
            echo "Profile updated succesfully!";
           }
        catch(mysqli_sql_exception){
             echo "Something went wrong";
            }    }

    ?>
<!-- Vendor JS Files -->

<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!--Main JS File -->
<script src="assets/js/main.js"></script>
</body>
</html>