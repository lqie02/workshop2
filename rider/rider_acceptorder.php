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


$sql=mysqli_query($conn,"SELECT * FROM delivery");
if(isset($_GET['delivery_id'])&&($_GET['deliveryStatus']))
{
	
	$delivery_id = $_GET['delivery_id'];
	$deliveryStatus = $_GET['deliveryStatus'];
	mysqli_query($conn,"UPDATE delivery SET deliveryStatus='$deliveryStatus' , staff_id = '$id' WHERE delivery_id='$delivery_id'");
	
	header("Loation:rider_acceptorder.php");
	
	if($deliveryStatus =="Delivered")
	{
	mysqli_query($conn,"UPDATE delivery SET dateTime = NOW() WHERE delivery_id='$delivery_id'");}	
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
	
	<title>Delivered Status</title>
</head>
	
<body>
	
	<?php include('headeraccept_new.php'); ?>
	

			  <br><br><br>
				<!--<h2 class="txt1">CUSTOMER ORDER</h2>    --> 
		   
		    <div class="container">
			<table class="table table-hover text-center">
				 <thead class="table-dark">
				<tr  style="font-size: 17px">
					<th scope="col">NO.</th>
					<th scope="col">ORDER ID</th>
					<th scope="col">NAME</th>
					<th scope="col">ADDRESS</th>
					<th scope="col">TELEPHONE NUMBER</th>
					<th scope="col">DATE AND TIME</th>	
					<th scope="col">STATUS</th>	
					<th scope="col">ACTION ORDER</th>							
				</tr>
				</thead>
				<tbody>
	<?php
	
	$id=$_SESSION["staff_id"];
	$ret=mysqli_query($conn,"SELECT * FROM orders o
	INNER JOIN customer c ON o.customer_id = c.customer_id
	INNER JOIN delivery d ON o.order_id = d.order_id
	WHERE deliveryStatus != 'delivered'");
	
	
	$i=1;
		   
		if(mysqli_num_rows($ret)>0){
			while ($row=mysqli_fetch_assoc($ret)){
				?><tr  style="font-size: 17px">
					<td><?php echo $i++ ?></td>
					<td><?php echo $row['order_id'] ?></td>
					<td><?php echo $row['custName'] ?></td>
					<td><?php echo $row['address'] ?></td>
					<td><?php echo $row['custTel'] ?></td>
					<td><?php echo $row['dateTime'] ?></td>
					<td><?php echo $row['deliveryStatus'] ?></td>
					
					<td><select onChange="status_update(this.options[this.selectedIndex].value,'<?php echo $row['delivery_id'] ?>')"</td>
						<option value="">Update Status</option>	
						<option value="Accept">Accept</option>
						<option value="Delivered"> Delivered</option>
						</select>
				
		</tr>
		<?php }
		} ?>
	</tbody>
	</table>								
	</div>
	<script type="text/javascript">
	function status_update(value,delivery_id)
		{
			alert("Do you want to " + value + "?");
			let url = "http://localhost/fkfood/rider/rider_acceptorder.php";
			window.location.href = url+"?delivery_id="+delivery_id+"&deliveryStatus="+value;
		}
	</script>
	<!--bootsrap-->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>