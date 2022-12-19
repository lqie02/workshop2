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


$sql=mysqli_query($conn,"SELECT * FROM delivery");
if(isset($_GET['delivery_id'])&&($_GET['deliveryStatus']))
{
	
	$delivery_id = $_GET['delivery_id'];
	$deliveryStatus = $_GET['deliveryStatus'];
	mysqli_query($conn,"UPDATE delivery SET deliveryStatus='$deliveryStatus' , staff_id = '$id' WHERE delivery_id='$delivery_id'");
	
	header("Loation:rider_acceptorder.php");
	
	if($deliveryStatus =="delivered")
	{
	mysqli_query($conn,"UPDATE delivery SET dateTime = NOW() WHERE delivery_id='$delivery_id'");}	
}
?>

<!doctype html>
<html lang="en" dir="ltr">
<head>
<meta charset="utf-8">
	<link rel="icon" href="../img/2.png" type="image/png" sizes="20x20">
<title>Delivered Status</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="menu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
</head>
	
<body>
	
	<nav>
		<input type="checkbox" id="check">
        <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
		</label>
		<!--<label class="logo">FK Restaurant</label>-->
		<img src="../img/logo.png" type="image/png" alt="FK Restaurant">
		<label class="logo">FK Restaurant</label>
		<ul>
		<li><a href="menu.php">Home</a></li>
		<li><a class="active" href="rider_acceptorder.php">Delivered Status</a></li>
        <li><a href="rider_orderhistory.php">Delivered History</a></li>
        <li><a href="../logout.php">Logout</a></li>
		</ul>
	</nav>
	<section>
	
			
	<!--<input type="hidden" name="rider_id" value="<?php print $id ?>">-->
	
			  <br><br><br>
				<h2 class="txt1">CUSTOMER ORDER</h2>     
		      <br>
		    <div>
			<table>
				
				<tr>
					<th><center>NO.</center></th>
					<th><center>ORDER ID</center></th>
					<th><center>NAME</center></th>
					<th><center>ADDRESS</center></th>
					<th><center>TELEPHONE NUMBER</center></th>
					<th><center>STATUS</center></th>	
					<th><center>ACTION ORDER</center></th>							
				</tr>
					
				
	<?php
	
	$id=$_SESSION["staff_id"];
	$ret=mysqli_query($conn,"SELECT * FROM orders o
	INNER JOIN customer c ON o.customer_id = c.customer_id
	INNER JOIN delivery d ON o.order_id = d.order_id
	WHERE deliveryStatus != 'delivered'");
	
	
	$i=1;
		   
		if(mysqli_num_rows($ret)>0){
			while ($row=mysqli_fetch_assoc($ret)){
				?><tr>
					<td><center><?php echo $i++ ?></center></td>
					<td><center><?php echo $row['order_id'] ?></center></td>
					<td><center><?php echo $row['custName'] ?></center></td>
					<td><center><?php echo $row['address'] ?></center></td>
					<td><center><?php echo $row['custTel'] ?></center></td>
					<td><center><?php echo $row['deliveryStatus'] ?></center></td>
					
					<td><center><select onChange="status_update(this.options[this.selectedIndex].value,'<?php echo $row['delivery_id'] ?>')"</td>
						<option value="">Update Status</option>	
						<option value="accept">accept</option>
						<option value="delivered"> delivered</option>
						</select></center>
				</td>
		</tr>
		<?php }
		} ?>
		
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
	
</body>
</html>