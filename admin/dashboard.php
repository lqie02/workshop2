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
<title>Dashboard</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
</head>
	
<body>
	
	<?php include('headeradmin.php'); ?>
	
	<div class="text">
	<p>Welcome, </p>
		<p class="txt"> <?php echo $_SESSION["staffName"]?>.</p>
		
		</div>

</body>
</html>