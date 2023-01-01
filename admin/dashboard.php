<?php
session_start();
include('../connection.php');
if(isset($_SESSION["staff_id"]))
{
	$id= $_SESSION["staff_id"];
	$name= $_SESSION["staffName"];
	
	if((time()-$_SESSION['Active_Time'])>300)
	{
		header('Location:../loginStaff.php');
	}
	else
	{
		$_SESSION['Active_Time'] = time();
	}
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
	<link rel="stylesheet" type="text/css" href="dashboard.css">
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
</head>
	
<body>
	
	<?php include('headeradmin.php'); ?>
	
	<div>
	<p>Welcome, </p>
		<p class="txt"> <?php echo $_SESSION["staffName"]?>.</p><br><br>
	<p class="txt1">Current Date : <span id="date-today"></span></p>
	<p class="txt2">Current Time : 
		<span id="current-time"></span>	
	</div>
	
	
	
	<script>
		let dateToday = document.getElementById("date-today");
		
		let today = new Date();
		let day = `${today.getDate() < 10 ? "0" : ""}${today.getDate()}`;
		let month = `${(today.getMonth()+1) < 10 ? "0" : ""}${today.getMonth()+1}`;
		let year = today.getFullYear();
		
		dateToday.textContent = `${day}/${month}/${year}`;
	</script>
	<script>
		let time = document.getElementById("current-time");
		setInterval(()=>{
			let d = new Date();
			time.innerHTML = d.toLocaleTimeString();
		},10)
		</script>

</body>
</html>