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
        $_SESSION['custname'] = $row['custName'];

       
        echo "<script>alert('Login Success!');</script>";
        echo"<meta http-equiv='refresh' content='0; url=http://localhost/fkfood/Location.php />";
		  
      }
      else
        echo "<script>alert('Woops! Email or Password was wrong');</script>";
        echo"<meta http-equiv='refresh' content='0; url=loginCust.php'>";

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


          <div class="text-center pt-3 mb-5 pb-1">
          <a href="location.php"></a><button name="btn_login" class="btn">Log in></button>
          </div>

          <div class="d-flex align-items-center justify-content-center pb-4">
          <p class="login-register-text">Don't have an account?
          <a href="#" onclick="window.open('http://localhost/fkfood/regCust.php')"; >Register Here</a>.</p>
          </div>

          <div class="result text-center mb-0 text-danger"  id="result"><p><?php echo $msg?></p>
          </div>
        </div>
      </form>
    </form>
  </section>
</body>
</html>
