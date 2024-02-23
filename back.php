<?php
if (isset($_GET['cid'])) {
  $cid = $_GET['cid'];}
if (isset($_GET['uid'])) {
    $uid = $_GET['uid'];}

if (isset($_POST["pledge"])){
  $amount = $_POST["amount"];
  $cardno =  $_POST["cardno"];
  $cvc =  $_POST["cvc"];
  $exp =  $_POST["expiration"];

  $query2 = "INSERT INTO backing(User_Id,Campaign_Id,Amount_pledged) VALUES('$uid','$cid','$amount')";
  $result2 = mysqli_query($conn,$query2);
  if($result2){
    echo' <p> Thank you for your pledge!</p>';
  }
  else{
    echo "We're sorry, but we couldn't process your pledge Please try again";
  }
}
?>