<?php  ob_start();session_start();?>
<?php include('../connection.php'); ?>


<?php if(!isset($_SESSION['staff_id'])){ 

  header("Location:../loginS.php");
  exit;
}?>



<!doctype html>
<html lang="en" dir="ltr">
<head>
<meta charset="utf-8">
	<link rel="icon" href="../img/2.png" type="image/png" sizes="20x20">
   
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/fkfood/manager/css/staff.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="stylesheet" href="/fkfood/manager/css/bootstrap.css">
	<title><?php echo $title;?></title>

	 <!-- js files -->
    <script src="../js/jquery-2.1.1.min.js"></script>
    <script src="../js/jquery-ui.js"></script>
    
  </head>
</head>
	
<body>
	<nav>
		<input type="checkbox" id="check">
        <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
		</label>
		<!--<label class="logo">FK Restaurant</label>-->
		<img src="../img/logo.png" type="image/png" alt="FK Restaurant">
		<label class="logo" >FK Restaurant</label>
		<ul>
		<li><a  class="active" href="dashboard.php">Home</a></li>
		></li>
		<li><a  href="item.php">Manage Item</a></li>
		<li><a  href="category.php">Manage Category</a></li>
        <li><a href="logout.php">Logout</a></li>
		</ul>
	</nav>
</body>
</html>