<?php $title = 'Customer Staff'; include('header.php'); ?>

<?php

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



		$query = $db->query("SELECT DISTINCT * FROM staff WHERE LCASE(staffEmail) = '" . $db->escape($staffEmail) . "'");
         

		if($query->num_rows > 0){
            echo "<script>alert('email address exit in data base pls login');</script>";
	    }elseif($password != $cpassword){
			echo "<script>alert('Two passwords that enter do not match');</script>";
			echo"<meta http-equiv='refresh' content='0; url=regCust.php'/>";
		}else {
		  $db->query("INSERT INTO staff SET staffName = '" . $db->escape($staffName)."', staffEmail = '" . $db->escape($staffEmail) . "', staffType ='".$db->escape($staffType)."', staffPassword ='".$db->escape(md5($password))."', admin_id ='11000', department_id = '".$department_id."'");
		 
		    if($db->getLastId()){
		 	  echo "<script>alert('Sucessfully register! Please proceed to login.');</script>";
		      echo"<meta http-equiv='refresh' content='0; url=loginStaff.php'/>";
			}else{
				echo "<script>alert('Registration fail! Please try again. ');</script>";
			    echo"<meta http-equiv='refresh' content='0; url=regStaff.php'/>";
			}

		}

		

}


?>


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


			<div class="input-group">
				<input pattern=".{8,}" type="password" placeholder="Password" name="password" value="<?php echo $password; ?>" required title="8 characters minimum">
            </div>
            <div class="input-group">
				<input pattern=".{8,}" type="password" placeholder="Confirm Password" name="cpassword" value="<?php echo $cpassword; ?>" required title="8 characters minimum">
			</div>

			<div calss = "form-group">
				<label class = "col-sm-3 control-label"> &nbsp;Select role&nbsp;&nbsp;</label> 
			<select class="form-control" name="staffType" value="<?php echo $staffType; ?>" required>
                    	 <option selected="true" disabled="disabled" value="">- Select role -</option >
                     	 <option value="Rider">Rider</option>
                     	 <option value="Manager">Manager</option>
                     	 
            </select> 
        </div></br>
		
		 <div calss = "form-group">
				<label class = "col-sm-3 control-label"> &nbsp;Select Department&nbsp;&nbsp;</label> 
			<select class="form-control" name="department_id" value="<?php echo $department_id; ?>" required>
                    	 <option selected="true" disabled="disabled" value="">- Select department -</option >
                     	 <option value=8001>Rider</option>
                     	 <option value=8000>Management</option>		
            </select> 
        </div></br> 
		

			<div class="input-group">
				<button name="submit" class="btn">Register</button>
			</div>
			<p align="center" class="login-register-text"> Have an account? <a href="loginStaff.php">Login Here</a>.</p>
		</form>
	</div>
</body>

<?php include('footer.php');?>