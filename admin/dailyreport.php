<?php
session_start();
include('../connection.php');
if(isset($_SESSION["staff_id"]))
{
	$id= $_SESSION["staff_id"];
	
	if((time()-$_SESSION['Active_Time'])>600)
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
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<link rel="icon" href="../img/2.png" type="image/png" sizes="20x20">
	
	<meta name="generator" content="Bootply" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="css/bootstrap.min.css" rel="stylesheet">
<style>
	hr{
		height: 2px;
		background-color: black;
	}
	div .row1{
		background-color:#A2ADD0  ;
		
	}
	</style>
	
	<title>Report</title>
</head>
	
<body>
	
	<?php include('headersale.php'); ?>
	
	
	<div class="container" >
	<!--center-->
		<div class="col-sm-8 ">
			<div class="row">
				<div class="col-xs-12">
					<h3 style="padding-left:150px; font-weight: bold;">Sales Report Foreign Key Restaurant</h3>
					<hr>
					
					<form name="bwdatesdata" action="" method="post" action="">
						<table width="100%" height="117" border="0">
							<tr>
							<th  width="27%" height="63" scope="row" style="font-size:17px">From Date :</th>
							<td width="73%">
								<input type="date" name="fdate" class="form-control" id="fdate">
							</td>
							</tr>
							
					<tr>
					 <th width="27%" height="63" scope="row " style="font-size:17px">To Date :</th>
					 <td width="73%">
						<input type="date" name="tdate" class="form-control" id="tdate">
						</td>
					</tr>
							
					<tr>
						<th width="27%" height="63" scope="row" style="font-size:17px">Request Type :</th>
						<td width="73%" style="font-size:17px">
							<input type="radio" name="requesttype" value="mtwise" checked="true" >&nbsp; Month &nbsp;&nbsp;
							<input type="radio" name="requesttype" value="yrwise" >&nbsp;Year 		
						</td>
					</tr>
							
					<tr>
						<th width="27%" height="63" scope="row"></th>
						<td width="73%">
						<button class="btn btn-primary mb1 black bg-aqua" type="submit" name="submit" style="font-size:16px">Submit</button>
					</tr>				
						</table>
					</form>
				</div>
			</div>
	<hr>
	<div class="row">
	<div class="col-xs-12">
		<?php
		if(isset($_POST['submit']))
		{
			$fdate=$_POST['fdate'];
			$tdate=$_POST['tdate'];
			$rtype=$_POST['requesttype'];
		
		?>
		<?php
		if($rtype=='mtwise')
		{ 
			$month1=strtotime($fdate);
			$month2=strtotime($tdate);
			$m1=date("F",$month1);
			$m2=date("F",$month2);
			$y1=date("Y",$month1);
			$y2=date("Y",$month2);
			?>
		<h3 align="center" class="header-title m-t-0 m-b-30" style="font-weight: bold;">Sales Report Monthly</h3><br>
		<h4 align="center" >Sales Report  from <?php echo $m1."-".$y1;?> to <?php echo $m2."-".$y2;?></h4>
		<hr>
		<div class="row1">
			<table class="table table-bordered" width="100%" border="10" style="padding-left: 40px">
			<thead>
             <tr>
				<th><center>NO.</center></th>
				<th><center>FOOD</center></th>
				<th><center>TOTAL QUANTITY</center></th>
				<th><center>MONTH / YEAR</center> </th>
				<th><center>SALES (RM)</center></th>
			  </tr>
             </thead>
				<?php 
			$ret=mysqli_query($conn,"SELECT month(o.orderDate) AS lmonth,year(o.orderDate) AS lyear,sum(p.totalAmount) AS amount,m.itemName AS NAME,SUM(od.quantity) AS TOTAL FROM payment p,item m, order_detail od, orders o WHERE date(paymentDate) between '$fdate' and '$tdate' AND m.item_id=od.item_id AND o.order_id=od.order_id AND o.orderDate AND p.order_id=o.order_id GROUP BY lmonth,lyear,od.item_id ORDER BY SUM(quantity) DESC");
			$result=mysqli_num_rows($ret);
			$ftotal=0;
			if($result>0)
			{
				$cnt=1;
				while($row=mysqli_fetch_array($ret))
				{
					?>
				<tbody>
					<tr>
						<td><center><?php echo $cnt; ?></center></td>
						<td><center><?php echo $row['NAME']; ?></center></td>
						<td><center><?php echo $row['TOTAL']; ?></center></td>
						<td><center><?php echo $row['lmonth']."/".$row['lyear']; ?></center></td>
						<td><center><?php echo $total=$row['amount']; ?></center></td>
					</tr>
					<?php
					
					$ftotal+=$total;
					$cnt++;
				} ?>
				<tr>
					<td colspan="4" align="center">TOTAL</td>
					<td><center><?php echo $ftotal; ?></center></td>
				</tr>
				</tbody>
			</table>
			<?php
			}}
		else
		{
			$year1=strtotime($fdate);
			$year2=strtotime($tdate);
			$y1=date("Y",$year1);
			$y2=date("Y",$year2);
			?>
			
			<h3  align="center" class="header-title m-t-0 m-b-30" style="font-weight: bold;">Sales Report Yearly</h3> <br>
			<h4 align="center" >Sales Report  from <?php echo $y1;?> to <?php echo $y2;?></h4>
			
			<hr>
        	<div class="row1">
            	<table class="table table-bordered " width="100%"  border="0" style="padding-left:40px">
                <thead>
                <tr>
				<th><center>NO.</center></th>
				<th><center>FOOD</center></th>
				<th><center>TOTAL QUANTITY</center></th>
				<th><center> YEAR</center> </th>
				<th><center>SALES (RM)</center></th>
				</tr>
                </thead>
				
			<?php
			$ret=mysqli_query($conn,"SELECT month(o.orderDate) AS lmonth,year(o.orderDate) AS lyear,SUM(p.totalAmount) AS amount, m.itemName AS NAME, SUM(od.quantity) AS TOTAL FROM payment p,item m, order_detail od, orders o  WHERE date(paymentDate) between '$fdate' and '$tdate' AND m.item_id=od.item_id AND o.order_id=od.order_id AND o.orderDate AND p.order_id=o.order_id GROUP BY lyear,od.item_id ORDER BY SUM(quantity) DESC");
			$result=mysqli_num_rows($ret);
			$ftotal=0;
			if($result>0)
			{
				$cnt=1;
				while($row=mysqli_fetch_array($ret))
				{
					?>
					<tbody>
					<tr>
						<td><center><?php echo $cnt; ?></center></td>
						<td><center><?php echo $row['NAME']; ?></center></td>
						<td><center><?php echo $row['TOTAL']; ?></center></td>
						<td><center><?php echo $row['lyear']; ?></center></td>
						<td><center><?php echo $total=$row['amount']; ?></center></td>
					</tr>
					<?php
					
					$ftotal+=$total;
					$cnt++;
				} ?>
				<tr>
					<td colspan="4" align="center">TOTAL</td>
					<td><center><?php echo $ftotal; ?></center></td>
				</tr>
				</tbody>
				</table> <?php  } } } ?>
			</div>
		</div>
	 </div>
    </div>  
   
  </div><!--/center-->

</div><!--/container-->

	<!-- script references -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>