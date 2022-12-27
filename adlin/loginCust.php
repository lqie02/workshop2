<?php $title = 'Customer Login'; include('header.php'); ?>

<?php

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
      
      $query = $db->query("SELECT DISTINCT * FROM customer WHERE LCASE(custEmail) = '" . $db->escape($email) . "' AND custPassword ='".$db->escape(md5($password))."'");
    
      
      if($query->row > 0){

        $_SESSION['customer_id'] = $query->row["customer_id"];
        $_SESSION['custName'] = $query->row['custName'];
		    $_SESSION['custEmail'] = $query->row['custEmail'];
		    $_SESSION['custTel'] = $query->row['custTel'];
		    $_SESSION['address'] = $query->row['address'];

       
        echo "<script>alert('Login Success!');</script>";
        echo"<meta http-equiv='refresh' content='0; url=customer/Location.php'/>";
		  
      }
      else{
		      echo "<script>alert('Woops! Email or Password was wrong');</script>";
          echo"<meta http-equiv='refresh' content='0; url=loginCust.php'/>";
	    }
        
}
?>

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

<?php include('footer.php');?>
