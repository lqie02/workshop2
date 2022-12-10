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

  $time=time()-30;
  $ip_address=getIpAddr();

  // Getting total count of hits on the basis of IP
  $query = mysqli_query($conn, "select count(*) as total_count from loginlogs where TryTime > $time and IpAddress='$ip_address'"); 
  $check_login_row=mysqli_fetch_assoc($query);
  $total_count=$check_login_row['total_count'];

  //Checking if the attempt 3, or youcan set the no of attempt her. For now we taking only 3 fail attempted
  if($total_count == 3)
  {
    $msg="To many failed login attempts. Please login after 30 sec";
  }
  else
  {
    //Getting Post Values
    $email = test_input($_POST['email']);
    $password = test_input($_POST['password']);
    $role = test_input($_POST['role']);
  
    switch ($role) {
      case "Admin":
      $sql ="SELECT * FROM staff WHERE staffEmail = '".$email."' AND staffPassword = '".$password."'";

      $result = mysqli_query($conn, $sql);
    
      if(mysqli_num_rows($result) > 0)
      {
        $row = $result->fetch_assoc();

        $_SESSION['admin_id'] = $row["admin_id"];
        $_SESSION['staffName'] = $row['staffName'];
        $_SESSION['staffEmail'] = $row['staffEmail'];
        
        mysqli_query($conn,"delete from loginlogs where IpAddress='$ip_address'");
        echo "<script>alert('Login Success!');</script>";
        echo"<meta http-equiv='refresh' content='0; url=admin/index.php?dashboard'>";
      }
      else
      {
        $total_count++;
        $rem_attm = 3 - $total_count;
        if($rem_attm==0)
        {
          $msg="To many failed login attempts. Please login after 30 sec";
        }
        else
        {
          $msg="Please enter valid login details.<br/>$rem_attm attempts remaining";
        }
        $try_time=time();
        mysqli_query($conn,"insert into loginlogs(IpAddress,TryTime) values('$ip_address','$try_time')");
      }
      break;
    
    case "Manager":
      $sql ="SELECT * FROM staff WHERE staffEmail = '".$email."' AND staffPassword = '".$password."'";

      $result = mysqli_query($conn, $sql);
    
      if(mysqli_num_rows($result) > 0)
      {
        $row = $result->fetch_assoc();

        $_SESSION['staff_id'] = $row["staff_id"];
        $_SESSION['staffName'] = $row['staffName'];
        $_SESSION['staffEmail'] = $row['staffEmail'];
        
        mysqli_query($conn,"delete from loginlogs where IpAddress='$ip_address'");
        echo "<script>alert('Login Success!');</script>";
        echo"<meta http-equiv='refresh' content='0; url=admin/index.php?dashboard'>";
      }
      else
      {
        $total_count++;
        $rem_attm = 3 - $total_count;
        if($rem_attm==0)
        {
          $msg="To many failed login attempts. Please login after 30 sec";
        }
        else
        {
          $msg="Please enter valid login details.<br/>$rem_attm attempts remaining";
        }
        $try_time=time();
        mysqli_query($conn,"insert into loginlogs(IpAddress,TryTime) values('$ip_address','$try_time')");
      }
      break;

      case "Staff":
      $sql ="SELECT * FROM staff WHERE staffEmail = '".$email."' AND staffPassword = '".$password."'";

      $result = mysqli_query($conn, $sql);
    
      if(mysqli_num_rows($result) > 0)
      {
        $row = $result->fetch_assoc();

        $_SESSION['staff_id'] = $row["staff_id"];
        $_SESSION['staffName'] = $row['staffName'];
        $_SESSION['staffEmail'] = $row['staffEmail'];
        
        mysqli_query($conn,"delete from loginlogs where IpAddress='$ip_address'");
        echo "<script>alert('Login Success!');</script>";
        echo"<meta http-equiv='refresh' content='0; url=admin/index.php?dashboard'>";
      }
      else
      {
        $total_count++;
        $rem_attm = 3 - $total_count;
        if($rem_attm==0)
        {
          $msg="To many failed login attempts. Please login after 30 sec";
        }
        else
        {
          $msg="Please enter valid login details.<br/>$rem_attm attempts remaining";
        }
        $try_time=time();
        mysqli_query($conn,"insert into loginlogs(IpAddress,TryTime) values('$ip_address','$try_time')");
      }
      break;

      default: 
      echo "<script>alert('Please select role');</script>";
      echo"<meta http-equiv='refresh' content='0; url=index.php'/>";
      break;
    }
  }
}

  // Getting IP Address
  function getIpAddr(){
  if (!empty($_SERVER['HTTP_CLIENT_IP']))
  {
    $ipAddr=$_SERVER['HTTP_CLIENT_IP'];
  }
  elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
  {
    $ipAddr=$_SERVER['HTTP_X_FORWARDED_FOR'];
  }
  else
  {
    $ipAddr=$_SERVER['REMOTE_ADDR'];
  }
  return $ipAddr;
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
	
    <!-- Bootstrap core CSS-->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Custom styles for this template-->
    <link rel="stylesheet" type="text/css" href="style1.css">	

</head>
<body>

<section class="h-100 gradient-form">

  <form name="loginForm" method="post" >
    <form action="" method="POST" class="login-email">
      <p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
      <div class="container">
        <p>Please login to your account</p>

        <div class="input-group">
          <input type="email" name="email" id="form2Example11" class="form-control" placeholder="Email address" autofocus required/>
        </div>

        <div class="input-group">
          <input type="password" name="password" id="form2Example22" minlength="8" class="form-control" placeholder="Password" autofocus required/>
        </div>

        <select class="form-control" name="role" autofocus required>
          <option selected="true" disabled="disabled" value="">- Select role -</option >
          <option value="Staff">Admin</option>
          <option value="Staff">Rider</option>
          <option value="Staff">Manager</option>
          </select>

          <div class="text-center pt-3 mb-5 pb-1">
          <button name="btn_login" class="btn">Log in</button>
          </div>

          <div class="d-flex align-items-center justify-content-center pb-4">
          <p class="login-register-text">Don't have an account?
          <a href="#" onclick="window.open('http://localhost/fkfood/register.php')"; >Register Here</a>.</p>
          </div>

          <div class="result text-center mb-0 text-danger"  id="result"><p><?php echo $msg?></p>
          </div>
        </div>
      </form>
    </form>
  </section>
</body>
</html>