<?php 
session_start();
include('../connection.php');

if(isset($_SESSION["customer_id"]))
{
	$id = $_SESSION["customer_id"];
}
else
{
	header('Location: ../loginCust.php');
}

if(isset($_POST['submit']))
{
	$custName = $_POST['custName'];
	$custEmail = $_POST['custEmail'];
	$custTel = $_POST['custTel'];
	$address = $_POST['address'];
	$custPassword = $_POST['custPassword'];
	
	$query = "UPDATE customer SET custName='$custName',custEmail='$custEmail',custTel='$custTel',address='$address',custPassword='$custPassword' WHERE customer_id='$id'";
	$ret = mysqli_query($conn,$query);
	
	if($ret)
	{
		echo "<script>alert('Update successfully');</script>";
		echo"<meta http-equiv='refresh' content='0; url=customerinfo.php'/>";
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
			<h3>Edit Customer Information</h3>
			<p class="text-muted">Click update after changing any information</p>		
		</div>
		
		<?php 
			
			$sql = "SELECT * FROM customer WHERE customer_id = $id";
			$result = mysqli_query($conn,$sql);
			$row = mysqli_fetch_assoc($result);
		?>
		
		
		<div class="container d-flex justify-content-center">
			<form action="" method="post" style="width:50vw; min-width:300px;">
				<div class="row">
					<div>
						<label class="form-label">Name :</label>
						<input type="text" class="form-control" name="custName" value="<?php echo $row['custName'] ?>">
					</div>
					
					<div><br>
						<label class="form-label">Email :</label>
						<input type="email" class="form-control" name="custEmail" placeholder="name@example.com" value="<?php echo $row['custEmail'] ?>">
					</div>
					
					<div><br>
						<label class="form-label">Telephone :</label>
						<input type="text" class="form-control" name="custTel" placeholder="01x-xxxxxxx" value="<?php echo $row['custTel'] ?>">
					</div>
					
					<div><br>
						<label class="form-label">Address:</label>
						<input type="text" class="form-control" name="address" value="<?php echo $row['address'] ?>">
					</div>
					
					<div><br>
						<label class="form-label">Password :</label>
						<input pattern=".{8,}" type="password" class="form-control" name="custPassword" placeholder="Password" value=" <?php echo $row['custPassword'] ?>" required title="8 characters minimum">
					</div>
					
				
					<div><br>
						<button type="submit" class="btn btn-success" name="submit">Update</button> &nbsp;
						<a href="customerinfo.php" class="btn btn-danger"> Cancel</a>
					</div>
					
				</div>
			</form>
		</div>
	</div>
	
	<!--bootsrap-->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	
</body>
</html>
