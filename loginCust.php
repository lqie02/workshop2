<?php  
session_start();
include "connection.php";
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
  
  $query = mysqli_query($conn, "select count(*) as total_count from loginlogs where TryTime > $time and IpAddress='$ip_address'"); 
    $check_login_row=mysqli_fetch_assoc($query);
    $total_count=$check_login_row['total_count'];
  
  //checking when the attempts exceed three,wait 15 sec to login again
  if($total_count == 3)
  {
    $msg="To many failed login attempts. Please login after 30 sec.";
  }
  else
  {
    //Getting Post Values
    $email = test_input($_POST['email']);
    $password = test_input($_POST['password']);

      $sql ="SELECT * FROM customer WHERE custEmail = '".$email."' AND custPassword = '".$password."'";

      $result = mysqli_query($conn,$sql);

      if(mysqli_num_rows($result) > 0)
      {
      $row = mysqli_fetch_assoc($result);

      $_SESSION['customer_id'] = $row["customer_id"];
      $_SESSION['custName'] = $row['custName'];
      $_SESSION['custEmail'] = $row['custEmail'];
      $_SESSION['custTel'] = $row['custTel'];
      $_SESSION['address'] = $row['address'];
      $_SESSION['Active_Time'] = time();

          mysqli_query($conn,"delete from loginlogs where IpAddress='$ip_address'");
      echo "<script>alert('Login Success!');</script>";
      echo"<meta http-equiv='refresh' content='0; url=customer/homepage.php'/>";

      }
      else
      {
        
        $total_count++;
      $rem_attm = 3 - $total_count;
      if($rem_attm == 0)
      {

        $msg="To many failed login attempts. Please login after 30 sec";
      }
      else
      {

        $msg="Email or Password was wrong.<br/>$rem_attm attempts remaining";
      }
      $try_time=time();
      mysqli_query($conn,"INSERT INTO loginlogs(IpAddress,TryTime) values('$ip_address','$try_time')");
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
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="img/2.png" type="image/png" sizes="20x20">
  
    <!-- Bootstrap core CSS-->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Custom styles for this template-->
    <link rel="stylesheet" type="text/css" href="style1.css"> 
  <title>Customer Login</title>
</head>
<body>

  <div class="container">
    <form action="" method="POST" class="login-email">
      <p align="center" class="login-text" style="font-size: 2rem; font-weight: 800;">Login Customer</p>
      <br>
        <p align="justify">Please login to your account : </p><br>

        <div class="input-group">
          <input type="email" name="email" placeholder="Email address" autofocus required/>
        </div>

        <div class="input-group">
          <input type="password" name="password" minlength="8"  placeholder="Password" autofocus required/>
        </div><br>



          <div class="input-group">
          <button name="btn_login" class="btn">Log in</button>
          </div>

          <div class="d-flex align-items-center justify-content-center pb-4">
          <p align="center" class="login-register-text">Do not have an account?
          <a href="regCust.php" >Register Here</a>.</p>
          </div><br>

          <div class="result text-center mb-0 text-danger"  id="result"  align="center" style="color: red"><p><?php echo $msg ?></p>
          </div>
        </div>
      </form>
    </form>
  </section>
</body>
</html>