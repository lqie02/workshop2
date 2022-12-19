<?php  

include "connection.php";
error_reporting(0);
session_start();

$msg='';

if(isset($_POST['btn_login']))
{

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
      $sql ="SELECT * FROM staff WHERE staffEmail = '".$email."' AND staffPassword = '".$password."' AND staffType = '".$role."'";

      //$result = mysqli_query($conn, $sql);
	  $result = $conn->query($sql);
    
      if($result->num_rows > 0)
      {
        $row = $result->fetch_assoc();

        $_SESSION['staff_id'] = $row["staff_id"];
        $_SESSION['staffName'] = $row['staffName'];
        $_SESSION['staffEmail'] = $row['staffEmail'];
		$_SESSION['staffType'] = $row['staffType'];
		$_SESSION['admin_id'] = $row['admin_id'];
		$_SESSION['department_id'] = $row['department_id'];

        echo "<script>alert('Login Success!');</script>";
        echo"<meta http-equiv='refresh' content='0; url=admin/dashboard.php'/>";
      }
      else
      {
       echo "<script>alert('Woops! Email or Password or Role was wrong');</script>";
        echo"<meta http-equiv='refresh' content='0; url=loginStaff.php'/>";
      } 
      break;
    
    case "Manager":
      $sql ="SELECT * FROM staff WHERE staffEmail = '".$email."' AND staffPassword = '".$password."' AND staffType = '".$role."'";

      $result = $conn->query($sql);
    
      if($result->num_rows > 0)
      {
        $row = $result->fetch_assoc();

        $_SESSION['staff_id'] = $row["staff_id"];
        $_SESSION['staffName'] = $row['staffName'];
        $_SESSION['staffEmail'] = $row['staffEmail'];
		$_SESSION['staffType'] = $row['staffType'];
		$_SESSION['admin_id'] = $row['admin_id'];
		$_SESSION['department_id'] = $row['department_id'];
        
        echo "<script>alert('Login Success!');</script>";
        echo"<meta http-equiv='refresh' content='0; url=admin/addproduct.php'/>";
      }
      else
      { echo "<script>alert('Woops! Email or Password or Role was wrong');</script>";
    echo"<meta http-equiv='refresh' content='0; url=loginStaff.php'/>";
      }
       break;

      case "Rider":
      $sql ="SELECT * FROM staff WHERE staffEmail = '".$email."' AND staffPassword = '".$password."' AND staffType = '".$role."'";

      $result = $conn->query($sql);
    
      if($result->num_rows > 0)
      {
        $row = $result->fetch_assoc();

        $_SESSION['staff_id'] = $row["staff_id"];
        $_SESSION['staffName'] = $row['staffName'];
        $_SESSION['staffEmail'] = $row['staffEmail'];
		$_SESSION['staffType'] = $row['staffType'];
		$_SESSION['admin_id'] = $row['admin_id'];
		$_SESSION['department_id'] = $row['department_id'];
        
        
      echo "<script>alert('Login Success!');</script>";
      echo"<meta http-equiv='refresh' content='0; url=rider/menu.php'/>";
      }
      else
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

          <div class="result text-center mb-0 text-danger"  id="result"><p><?php echo $msg?></p>
          </div>
        </div>
      </form>
    </form>
  </section>
</body>
</html>
