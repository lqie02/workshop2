<?php $title = 'Customer Register'; include('header.php'); ?>

<?php

if($_SERVER['REQUEST_METHOD'] == "POST"){
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

	$query = $db->query("SELECT DISTINCT * FROM customer WHERE LCASE(custEmail) = '" . $db->escape($custEmail) . "'");

    if($query->num_rows){
        echo "<script>alert('email address exit in data base pls login');</script>";
    }elseif($password != $cpassword){
		echo "<script>alert('Two passwords that enter do not match');</script>";
		echo"<meta http-equiv='refresh' content='0; url=regCust.php'/>";
	}else {

        $db->query("INSERT INTO customer SET custName = '" . $db->escape($custName)."', custEmail = '" . $db->escape($custEmail) . "', custTel ='".$db->escape($custTel)."', address = '".$db->escape($address)."', custPassword ='".$db->escape(md5($password))."'");
		// echo($conn->query($query));
		// exit();
		if($db->getLastId()){
			echo "<script>alert('Sucessfully register! Please proceed to login.');</script>";
			echo"<meta http-equiv='refresh' content='0; url=index.php'/>";
		}else{
			echo "<script>alert('Registration fail! Please try again.');</script>";
			echo"<meta http-equiv='refresh' content='0; url=regCust.php'/>";
		}
	}
}else{
	$custName = '';
	$custEmail = '';
	$custTel = '';
    $address = '';
    $password = '';
    $cpassword = '';

}
?>

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
				<input pattern=".{8,}" type="password" placeholder="Password" name="password"  value="<?php echo $password; ?>" required title="8 characters minimum">
            </div>
            <div class="input-group">
				<input pattern=".{8,}" type="password" placeholder="Confirm Password" name="cpassword" value="<?php echo $cpassword; ?>" required title="8 characters minimum">
			</div>
			<div class="input-group">
				<button name="submit" class="btn">Register</button>
			</div>
			<p class="login-register-text">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Have an account? <a href="index.php">Login Here</a>.</p>
		</form>
	</div>
</body>

<?php include('footer.php');?>
