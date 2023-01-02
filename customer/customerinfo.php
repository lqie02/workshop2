<?php
session_start();
include('../connection.php');


if(isset($_SESSION["customer_id"]))
{
	$id= $_SESSION["customer_id"];
}
else{
	header('Location: ../loginCust.php');
}
$query = "SELECT * FROM customer WHERE customer_id = '$id'";
$ret = mysqli_query($conn,$query);
$row = mysqli_fetch_array($ret);

?><!doctype html>
<html lang="en" dir="ltr">
<head>
<meta charset="utf-8">
	<link rel="icon" href="../img/2.png" type="image/png" sizes="20x20">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="customerinfo.css">
	
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
	
	<title>Edit Info</title>
</head>
	
<body>
	<?php include('headermanage.php');?>
	<br><br><h2 class="title">Customer Information</h2>
	
	<div class="container">
  
 <br><br>
  <div class="card" style="width:400px ">
    <img class="card-img-top" src="avatar1.jpg" alt="image"  >
    <div class="card-body">
      <h4 class="txt"><?php echo $row['custName']; ?></h4>
		<br>
	  <p class="text1"><?php echo $row['custEmail']; ?></p>
	  <p class="text1"><?php echo $row['address']; ?></p>
		
   
		
		
      <a href="custUpdateInfo.php" class="btn btn-primary" style="margin-left: 80px">Edit Profile</a> &nbsp;&nbsp;
	  <a href="#" class="btn btn-primary">Go Back</a>
    </div>
  </div>
	</div>
	
	<!--bootstrap-->
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

	</body>
</html>