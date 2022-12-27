<?php ob_start();session_start();$title = 'Customer Login'; include('header.php'); ?>

<?php


if(isset($_POST['btn_login'])){

  function test_input($data) 
  {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
  }
    //Getting Post Values
    $email = test_input($_POST['email']);
    $password = test_input($_POST['password']);
    $role = test_input($_POST['role']);
  
      switch ($role) {
      case "Admin":
      
      $query = $db->query("SELECT DISTINCT * FROM staff WHERE LCASE(staffEmail) = '" . $db->escape($email) . "' AND staffPassword ='".$db->escape(md5($password))."' AND staffType='".$role."'");
    
      if($query->num_rows > 0){
      
        $_SESSION['staff_id'] = $query->row["staff_id"];
        $_SESSION['staffName'] =  $query->row['staffName'];
        $_SESSION['staffEmail'] =  $query->row['staffEmail'];
    		$_SESSION['staffType'] =  $query->row['staffType'];
    		$_SESSION['admin_id'] =  $query->row['admin_id'];
    		$_SESSION['department_id'] =  $query->row['department_id'];

        //echo "<script>alert('Login Success!');</script>";
        header("Location: admin/addproduct.php");
        exit;

      }else{
        echo "<script>alert('Woops! Email or Password or Role was wrong');</script>";
        echo"<meta http-equiv='refresh' content='0; url=loginStaff.php'/>";
      } 
      break;
    
    case "Manager":

       $query = $db->query("SELECT DISTINCT * FROM staff WHERE LCASE(staffEmail) = '" . $db->escape($email) . "' AND staffPassword ='".$db->escape(md5($password))."' AND staffType='".$role."'");

      if($query->num_rows > 0) {
        
        $_SESSION['staff_id'] = $query->row["staff_id"];
        $_SESSION['staffName'] =  $query->row['staffName'];
        $_SESSION['staffEmail'] =  $query->row['staffEmail'];
        $_SESSION['staffType'] =  $query->row['staffType'];
        $_SESSION['admin_id'] =  $query->row['admin_id'];
        $_SESSION['department_id'] =  $query->row['department_id'];

        //echo "<script>alert('Login Success!');</script>";
        header("Location: staff/dashboard.php");
        exit;
      }else{ 
        echo "<script>alert('Woops! Email or Password or Role was wrong');</script>";
        echo"<meta http-equiv='refresh' content='0; url=loginStaff.php'/>";
      }
       break;

      case "Rider":
       $query = $db->query("SELECT DISTINCT * FROM staff WHERE LCASE(staffEmail) = '" . $db->escape($email) . "' AND staffPassword ='".$db->escape(md5($password))."' AND staffType='".$role."'");

      if($query->num_rows > 0)
      {
       
        $_SESSION['staff_id'] = $query->row["staff_id"];
        $_SESSION['staffName'] =  $query->row['staffName'];
        $_SESSION['staffEmail'] =  $query->row['staffEmail'];
        $_SESSION['staffType'] =  $query->row['staffType'];
        $_SESSION['admin_id'] =  $query->row['admin_id'];
        $_SESSION['department_id'] =  $query->row['department_id'];

        
        
        //echo "<script>alert('Login Success!');</script>";
        header("Location: rider/dashboard.php");
        exit;
      }else
      {
		     echo "<script>alert('Woops! Email or Password or Role was wrong');</script>";
        echo"<meta http-equiv='refresh' content='0; url=loginStaff.php'/>";
      }
     break;

      default: 
      echo "<script>alert('Please select role');</script>";
      echo"<meta http-equiv='refresh' content='0; url=loginStaff.php'/>";
      break;
    }
  
}

?>

<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="img/2.png" type="image/png" sizes="20x20">
	
    <!-- Bootstrap core CSS-->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Custom styles for this template-->
    <link rel="stylesheet" type="text/css" href="style1.css">
	<title>Staff Login</title>

</head>
<body>
	<div class="container">
    <form action="" method="POST" class="login-email">
      <p align="center" class="login-text" style="font-size: 2rem; font-weight: 800;">Login Staff</p><br>
      
        <p align="justify">Please login to your account :</p>
		<br>

        <div class="input-group">
          <input type="email" name="email"  placeholder="Email address" autofocus required/>
        </div>

        <div class="input-group">
          <input type="password" name="password"  minlength="8"  placeholder="Password" autofocus required/>
        </div>

        <div class="form-group">
		<label class = "col-sm-3 control-label"> &nbsp;Select role&nbsp;&nbsp;</label>
		<select class="form-control" name="role" autofocus required>
          <option selected="true" disabled="disabled" value="">- Select role -</option >
          <option value="Admin">Admin</option>
          <option value="Rider">Rider</option>
          <option value="Manager">Manager</option>
          </select>
		</div></br>

          <div class="input-group">
          <button name="btn_login" class="btn">Log in</button>
          </div>

          <div class="d-flex align-items-center justify-content-center pb-4">
          <p align="center" class="login-register-text">Do not have an account?
          <a href="regStaff.php" >Register Here</a>.</p>
          </div>

         
        </div>
      </form>
    </form>
  </section>
</body>
</html>
