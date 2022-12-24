<?php
session_start();
include('../connection.php');


if(isset($_SESSION["staff_id"]))
{
	$id= $_SESSION["staff_id"];
}
else{
	header('Location: ../loginStaff.php');
}	

$staff_id = $_GET['staff_id'];
$sql = "DELETE FROM staff WHERE staff_id = '$staff_id'";
$result = mysqli_query($conn,$sql);


if($result)
{
	echo "<script>alert('Delete staff successfully');</script>";
	echo"<meta http-equiv='refresh' content='0; url=admin_manage.php'/>";
}
else
{
	echo "Failed: " .mysqli_error($conn);
}

/*if($result)
{
	header("Location: admin_manage.php?msg=Record delete successfully");
}
else
{
	echo "Failed: " .mysqli_error($conn);
}*/
?>

