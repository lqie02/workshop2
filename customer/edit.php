<?php $title = "Edit Profile"; include('header.php') ; 
  
  

  if(isset($_POST['submit'])){
     $customer_query =mysqli_query($conn,"UPDATE customer SET custName = '" .$_POST['custName'] ."', custTel = '" .$_POST['custTel'] . "', address = '".$_POST['address']."' WHERE customer_id = '".$_SESSION['customer_id']."'");
     
  

     if($_POST['custPassword']){
     	$customer_query = mysqli_query($conn,"UPDATE customer SET custPassword = '" .md5($_POST['custPassword']) ."'  WHERE customer_id = '".$_SESSION['customer_id']."'");
     }

     $success = 'Profile Update Success';
  }

  $customer = mysqli_query($conn,"SELECT * FROM customer WHERE customer_id='".$_SESSION['customer_id']."'");
  $row = mysqli_fetch_assoc($customer);

?>


<body class="edit-page">
	<div class="container">
		<h2  class = "location-logo" style="margin-bottom:20px;">Edit Profile</h2>
        <?php if(isset($success)){?>
        	<div class="alert alert-success"><?php echo $success;?></div>
        <?php }?>
		<form action="" method="POST" class="form-horizontal">

			<div class="form-group required">
              <label class="col-sm-2 control-label">Name</label>
              <div class="col-sm-10"><input type="text" name="custName" value="<?php echo $row['custName'];?>" class="form-control">
              </div>
            </div>

            <div class="form-group required">
              <label class="col-sm-2 control-label">Email</label>
              <div class="col-sm-10"><input type="text" name="custEmail" value="<?php echo $row['custEmail'];?>" class="form-control" readonly>
              </div>
            </div>

            <div class="form-group required">
              <label class="col-sm-2 control-label">Telefon</label>
              <div class="col-sm-10"><input type="text" name="custTel" value="<?php echo $row['custTel'];?>" class="form-control">
              </div>
            </div>

             <div class="form-group required">
              <label class="col-sm-2 control-label">Address</label>
              <div class="col-sm-10"><input type="text" name="address" value="<?php echo $row['address'];?>" class="form-control">
              </div>
            </div>

            <div class="form-group ">
              <label class="col-sm-2 control-label">Password</label>
              <div class="col-sm-10"><input pattern=".{8,}" type="password" placeholder="Password"  name="custPassword" value="" class="form-control" title="8 characters minimum">
              </div>
            </div>

    
           
         
           	<div class="form-group ">
           	 <label class="col-sm-2 control-label"></label>
           	 <input type="submit" name="submit" value="submit" class="btn btn-primary">
            </div>

		</form>
	</div>
</body>