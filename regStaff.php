<?php

include "connection.php";
error_reporting(0);
session_start();

if($_SERVER['REQUEST_METHOD'] == "POST")
{
	function test_input($data) 
	{
  		$data = trim($data);
 		$data = stripslashes($data);
  		$data = htmlspecialchars($data);
  		return $data;
	}

	$staffName = test_input($_POST['staffName']);
	$staffEmail = test_input($_POST['staffEmail']);
	$staffType = test_input($_POST['staffType']);
	$password = test_input($_POST['password']);
	$cpassword =test_input($_POST['cpassword']);
	$department_id =test_input($_POST['department_id']);


	if($password != $cpassword)
	{
		echo "<script>alert('Two passwords that enter do not match');</script>";
		echo"<meta http-equiv='refresh' content='0; url=regCust.php'/>";
	} 
	else 
	{
		
		//$qry="SELECT d.department_id FROM department d join staff s ON s.department_id= d.department_id WHERE staffType=$staffType";
		//$result = $mysqli -> query($qry);
		//$row = $result -> fetch_assoc();

		//$result = mysqli_query($conn, $query);
		//$row = mysqli_fetch_assoc($result);
		
		$query = "INSERT INTO staff(staffName, staffEmail, staffType, staffPassword,manager_id,department_id) VALUES ('$staffName', '$staffEmail', '$staffType', '$password', 11000, '$department_id')";

		
			if(mysqli_query($conn, $query))
			{
				echo "<script>alert('Sucessfully register! Please proceed to login.');</script>";
				echo"<meta http-equiv='refresh' content='0; url=index.php'/>";
			}
			else
			{
				echo "<script>alert('Registration fail! Please try again. ');</script>";


				echo"<meta http-equiv='refresh' content='0; url=reg_cust.php'/>";
			}
		}
		
   	 
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/2.png" type="image/png" sizes="20x20">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="style1.css">
	<title>Staff Registration</title>
	
</head>
<body>
	<div class="container">
		<form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Staff Register</p>
			<div class="input-group">
				<input type="text" placeholder=" Name" name="staffName" value="<?php echo $staffName; ?>" required>
			</div>
			<div class="input-group">
				<input type="email" placeholder="Email" name="staffEmail" value="<?php echo $staffEmail; ?>" required>
			</div>


			




			<!-- <div class="input-group">
				<input type="text" placeholder="Role" name="staffType" value="<?php echo $staffType; ?>" required>
			</div> -->
			<div class="input-group">
				<input type="password" placeholder="Password" name="password" value="<?php echo $password; ?>" required>
            </div>
            <div class="input-group">
				<input type="password" placeholder="Confirm Password" name="cpassword" value="<?php echo $cpassword; ?>" required>
			</div>

			<div calss = "form-group">
				<label class = "col-sm-3 control-label"> &nbsp;Select role&nbsp;&nbsp;</label> 
			<select class="form-control" name="staffType" value="<?php echo $staffType; ?>" required>
                    	 <option selected="true" disabled="disabled" value="">- Select role -</option >
                     	 <option value="rider">Rider</option>
                     	 <option value="hr Staff">HR Staff</option>
                     	 <option value="kitchen Staff">Kitchen Staff</option>
                     	 <option value="Floor Staff">Floor Staff</option>
            </select> 
        </div></br>
		
		
	
			 <div calss = "form-group">
				<label class = "col-sm-3 control-label"> &nbsp;Select Department&nbsp;&nbsp;</label> 
			<select class="form-control" name="department_id" value="<?php echo $department_id; ?>" required>
                    	 <option selected="true" disabled="disabled" value="">- Select department -</option >
                     	 <option value=8003>Rider</option>
                     	 <option value=8004>HR</option>
                     	 <option value=8002>Kitchen</option>
                     	 <option value=8001>Floor</option>
				
				
				
            </select> 
        </div></br> 

			<div class="input-group">
				<button name="submit" class="btn">Register</button>
			</div>
			<p class="login-register-text">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Have an account? <a href="dashboard.php">Login Here</a>.</p>
		</form>
	</div>
</body>
</html>
