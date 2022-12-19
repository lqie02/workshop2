<?php
session_start();
include('../connection.php');
if(isset($_SESSION["staff_id"]))
{
	$id= $_SESSION["staff_id"];
	$name= $_SESSION["staffName"];
}
else{
	header('Location: ../loginStaff.php');
}	
?>

<!doctype html>
<html lang="en" dir="ltr">
<head>
<meta charset="utf-8">
	<link rel="icon" href="../img/2.png" type="image/png" sizes="20x20">
<title>Rider Menu</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="menu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
</head>
	
<body>
	
	<nav>
		<input type="checkbox" id="check">
        <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
		</label>
		<!--<label class="logo">FK Restaurant</label>-->
		<img src="../img/logo.png" type="image/png" alt="FK Restaurant">
		<label class="logo">FK Restaurant</label>
		<ul>
		<li><a class="active" href="menu.php">Home</a></li>
		<li><a href="rider_acceptorder.php">Delivered Status</a></li>
        <li><a href="rider_orderhistory.php">Delivered History</a></li>
        <li><a href="../logout.php">Logout</a></li>
		</ul>
	</nav>
	<section>
	<div class="text">
	<p>Welcome, </p>
		<p class="txt"> <?php echo $_SESSION["staffName"]?>.</p>
		
		</div>
	</section>
	
	
	
</body>
</html>