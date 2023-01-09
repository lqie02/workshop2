<?php $title = "Edit Profile"; include('header.php') ; 
  
  

  if(isset($_POST['submit'])){
     $customer_query =mysqli_query($conn,"UPDATE customer SET custName = '" .$_POST['custName'] ."', custTel = '" .$_POST['custTel'] . "', address = '".$_POST['address']."' WHERE customer_id = '".$_SESSION['customer_id']."'");
     
  

     if($_POST['custPassword']){
     	$customer_query = mysqli_query($conn,"UPDATE customer SET custPassword = '" .md5($_POST['custPassword']) ."'  WHERE customer_id = '".$_SESSION['customer_id']."'");
     }
 echo '<script>alert("Update successfully"); location.replace(document.referrer);</sc
  }

  $customer = mysqli_query($conn,"SELECT * FROM customer WHERE customer_id='".$_SESSION['customer_id']."'");
  $row = mysqli_fetch_assoc($customer);

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <link rel="stylesheet" a href="/fkfood/customer/css/stylee.css">  -->
 <link rel="stylesheet" a href="/fkfood/customer/css/aisya.css"> 
  <link rel="stylesheet" a href="/fkfood/customer/css/bootstrapla.css">
  <script src="java.js"></script>  
  <title>Customer Details</title>  
</head>
<body>


 <div class="page">
  <div class="container">
    <div class="left">
      <div class="inforegister">Customer Details</div>
      <div class="eula">Please click submit after changing any information</div>
    </div>
    <div class="right">
      <svg viewBox="0 0 320 300">
        
        </defs>
        <path d="m 40,120.00016 239.99984,-3.2e-4 c 0,0 24.99263,0.79932 25.00016,35.00016 0.008,34.20084 -25.00016,35 -25.00016,35 h -239.99984 c 0,-0.0205 -25,4.01348 -25,38.5 0,34.48652 25,38.5 25,38.5 h 215 c 0,0 20,-0.99604 20,-25 0,-24.00396 -20,-25 -20,-25 h -190 c 0,0 -20,1.71033 -20,25 0,24.00396 20,25 20,25 h 168.57143" />
      </svg>


      <div class="form">
        <form action="editla.php" method="post">
        <label>Name</label>
        <input type="text" style="font-size: 16px" placeholder="Name" name="custName">

        <label>Email</label>
        <input type="text" style="font-size: 16px" placeholder="Email" name="custEmail" >

        <label>Telephone</label>
        <input type="text" style="font-size: 16px" placeholder="Telephone" name="custTel">

        <label>Address</label>
        <input type="text" style="font-size: 16px" placeholder="Address" name="address">
        
        <label>Password</label>
        <input pattern=".{8,}" type="password" placeholder="Password"  name="custPassword" value="" class="form-control" title="8 characters minimum">
        <br><br>
       <button class="button button3" name="submit">Submit</button>
      </div>
    </div>
  </div>
</form>
</div>

</body>
</html>
