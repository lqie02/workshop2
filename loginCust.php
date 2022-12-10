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
   $email = test_input($_POST['email']);
    $password = test_input($_POST['password']);

      $sql ="SELECT * FROM customer WHERE custEmail = '".$email."' AND custPassword = '".$password."'";

      $result = $conn->query($sql);
    
      if($result->num_rows > 0)
      {
        $row = $result->fetch_assoc();

        $_SESSION['customer_id'] = $row["customer_id"];
        $_SESSION['custName'] = $row['custName'];
		$_SESSION['custEmail'] = $row['custEmail'];
		$_SESSION['custTel'] = $row['custTel'];
		$_SESSION['address'] = $row['address'];

       // mysqli_query($conn,"delete from loginlogs where IpAddress='$ip_address'");
        echo "<script>alert('Login Success!');</script>";
        echo"<meta http-equiv='refresh' content='0; url=http://localhost/fkfood/Location.php />";
		  
      }
      else
        echo "<script>alert('Woops! Email or Password was wrong');</script>";
        echo"<meta http-equiv='refresh' content='0; url=loginCust.php'/>";

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
          </div>

          <div class="result text-center mb-0 text-danger"  id="result"><p><?php echo $msg?></p>
          </div>
        </div>
      </form>
    </form>
  </section>
</body>
</html>
