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

	$custName = test_input($_POST['custName']);
	$custEmail = test_input($_POST['custEmail']);
	$custTel = test_input($_POST['custTel']);
	$address = test_input($_POST['address']);
	$password = test_input($_POST['password']);
	$cpassword =test_input($_POST['cpassword']);

	if($password != $cpassword)
	{
		echo "<script>alert('Two passwords that enter do not match');</script>";
		echo"<meta http-equiv='refresh' content='0; url=regCust.php'/>";
	} else {
		$query = "INSERT INTO customer (custName, custEmail, custTel, address, custpassword) VALUES ('$custName', '$custEmail', '$custTel', '$address', '$password')";

		// echo($conn->query($query));
		// exit();
		if($conn->query($query))
		{
			echo "<script>alert('Sucessfully register! Please proceed to login.');</script>";
			echo"<meta http-equiv='refresh' content='0; url=index.php'/>";
		}
		else
		{
			echo "<script>alert('Registration fail! Please try again.');</script>";
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
	<title>Customer Registration</title>
	
</head>
<body>
	<div class="container">
		<form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Customer Register</p>
			<div class="input-group">
				<input type="text" placeholder=" Name" name="custName" value="<?php echo $custName; ?>" required>
			</div>
			<div class="input-group">
				<input type="email" placeholder="Email" name="custEmail" value="<?php echo $custEmail; ?>" required>
			</div>
			<div class="input-group">
				<input type="text" placeholder="Telephone" name="custTel" value="<?php echo $custTel; ?>" required>
			</div>
			<div class="input-group">
				<input type="text" placeholder="Address" name="address" value="<?php echo $address; ?>" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" name="password" value="<?php echo $password; ?>" required>
            </div>
            <div class="input-group">
				<input type="password" placeholder="Confirm Password" name="cpassword" value="<?php echo $cpassword; ?>" required>
			</div>
			<div class="input-group">
				<button name="submit" class="btn">Register</button>
			</div>
			<p class="login-register-text">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Have an account? <a href="dashboard.php">Login Here</a>.</p>
		</form>
	</div>
</body>
</html>