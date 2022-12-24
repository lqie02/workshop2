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
if(isset($_POST['submit']))
{
	
	
	$staffName = $_POST['staffName'];
	$staffEmail = $_POST['staffEmail'];
	$staffType = $_POST['staffType'];
	$password = $_POST['password'];
	$department_id =$_POST['department_id'];
	
	$query = "UPDATE staff SET staffName='$staffName',staffEmail='$staffEmail',staffType='$staffType',staffPassword='$password',admin_id='$id',department_id='$department_id' WHERE staff_id = '$staff_id' ";
	
	$res = mysqli_query($conn,$query);
	
	if($res)
	{
		header("Location: admin_manage.php?msg=Data upadate successfully");
	}
	else
	{
		echo "Failed: " .mysqli_error($conn);
	}
}

?>

<!doctype html>
<html lang="en" dir="ltr">
<head>
<meta charset="utf-8">
	<link rel="icon" href="../img/2.png" type="image/png" sizes="20x20">
    
	<!--Bootstrap-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<!--font Awesome-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
	
	<title>Edit Info</title>
</head>
	
<body>
	
	<?php include('headermanage.php');?>
	<br><br>
	<div class= "container">
		<div class="text-center mb-4">
			<h3>Edit Staff Information</h3>
			<p class="text-muted">Click update after changing any information</p>		
		</div>
		
		<?php 
			
			$sql = "SELECT * FROM staff WHERE staff_id = $staff_id LIMIT 1";
			$result = mysqli_query($conn,$sql);
			$row = mysqli_fetch_assoc($result);
		?>
		
		
		<div class="container d-flex justify-content-center">
			<form action="" method="post" style="width:50vw; min-width:300px;">
				<div class="row">
					<div>
						<label class="form-label">Name :</label>
						<input type="text" class="form-control" name="staffName" value="<?php echo $row['staffName'] ?>">
					</div>
					
					<div><br>
						<label class="form-label">Email :</label>
						<input type="email" class="form-control" name="staffEmail" placeholder="name@example.com" value="<?php echo $row['staffEmail'] ?>">
					</div>
					
					
					<div><br>
						<label class="form-label">Password :</label>
						<input pattern=".{8,}" type="password" class="form-control" name="password" placeholder="Password" value=" <?php echo $row['staffPassword'] ?>" required title="8 characters minimum">
					</div>
					
					
					<div class="form-group mb-3"><br>
						<label>Select Role : </label> &nbsp;
						<input type="radio" class="form-check-input" name="staffType" id="Rider" value="Rider" <?php echo ($row['staffType']=='Rider')? "checked":""; ?>>
						<label for"Rider" class="form-input-label">Rider</label>&nbsp;
						<input type="radio" class="form-check-input" name="staffType" id="Manager" value="Manager" <?php echo ($row['staffType']=='Manager')? "checked":""; ?>>
						<label for"Manager" class="form-input-label">Manager</label>&nbsp;
					</div><br>
					
					<div class="form-group mb-3">
						<label>Select Department : </label> &nbsp;
						<input type="radio" class="form-check-input" name="department_id" id="department_id" value="8001" <?php echo ($row['department_id']=='8001')? "checked":""; ?>>
						<label for"department_id" class="form-input-label">Rider</label>&nbsp;
						
						<input type="radio" class="form-check-input" name="department_id" id="department_id" value="8000" <?php echo ($row['department_id']=='8000')? "checked":""; ?>>
						<label for"department_id" class="form-input-label">Management</label>&nbsp;
					</div>
					
					
					
					<div><br>
						<button type="submit" class="btn btn-success" name="submit">Update</button> &nbsp;
						<a href="admin_manage.php" class="btn btn-danger"> Cancel</a>
					</div>
					
				</div>
			</form>
		</div>
	</div>
	
	<!--bootsrap-->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	
</body>
</html>