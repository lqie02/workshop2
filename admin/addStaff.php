<?php
session_start();
include('../connection.php');
if(isset($_SESSION["staff_id"]))
{
	$id= $_SESSION["staff_id"];
	
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

if(isset($_POST['submit']))
{
		$staffName = $_POST['staffName'];
		$staffEmail = $_POST['staffEmail'];
		$staffType = $_POST['staffType'];
		$password = $_POST['password'];
		$department_id =$_POST['department_id'];
	
	if($password != $cpassword)
	{
		echo "<script>alert('Two passwords that enter do not match');</script>";
		echo"<meta http-equiv='refresh' content='0; url=addStaff.php'/>";
	} 
	else
	{
		$query = "INSERT INTO staff(staffName, staffEmail, staffType, staffPassword,admin_id,department_id) VALUES ('$staffName', '$staffEmail', '$staffType', '$password', '$id','$department_id' )";

		$res = mysqli_query($conn,$query);

		if($res)
		{
			echo "<script>alert('Insert successfully');</script>";
			echo"<meta http-equiv='refresh' content='0; url=admin_manage.php'/>";
		}
		else
		{
			echo "Failed: " .mysqli_error($conn);
		}
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
	
	<title>Add Staff</title>
</head>
	<body>
		<?php include('headermanage.php');?>
	<br><br>
		<div class= "container">
		<div class="text-center mb-4">
			<h3>Add Staff Information</h3>
			<p class="text-muted">Complete the form to add a new staff</p>		
		</div>
			<div class="container d-flex justify-content-center">
			<form action="" method="post" style="width:50vw; min-width:300px;">
				<div class="row">
					<div class="cal">
						<label class="form-label">Name : </label>
						<input type="text" class="form-control" name="staffName" placeholder="John">
					</div>
						
					<div class="cal"><br>
						<label class="form-label">Email : </label>
						<input type="text" class="form-control" name="staffEmail" placeholder="example@gmail.com">
					</div>
						
					<div class="cal"><br>
						<label class="form-label">Password : </label>
						<input pattern=".{8,}" type="password" class="form-control" name="staffPassword" placeholder="*********" required title="8 characters minimum">
					</div>
					
					<div class="cal"><br>
						<label class="form-label">Comfirm Password : </label>
						<input pattern=".{8,}" type="password" class="form-control" name="cpassword" placeholder="*********" required title="8 characters minimum">
					</div>
					
					<div class="cal"><br>
						<label class="form-label">Select Role : </label>
						<select class="form-control" name="staffType"  required>
                    	 <option selected="true" disabled="disabled" value="">- Select role -</option >
                     	 <option value="Rider">Rider</option>
                     	 <option value="Manager">Manager</option>
                     	 </select> 
					</div>
					
					<div class="cal"><br>
						<label class="form-label">Select Department : </label>
						<select class="form-control" name="department_id" required>
                    	 <option selected="true" disabled="disabled" value="">- Select department -</option >
                     	 <option value=8001>Rider</option>
							<option value=8000>Management</option>	
           				 </select>
					 </div>
					
					<div><br>
						<button type="submit" class="btn btn-success" name="submit">&nbsp;Save&nbsp;</button>&nbsp;
						<a href="admin_manage.php" class="btn btn-danger">Cancel</a>
					</div>
					<div><br></div>
				  </div>
			 	</form>
			</div>
		</div>
		
		<!--bootsrap-->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	</body>
</html>