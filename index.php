<?php ob_start(); $title = 'Customer Login'; include('header.php'); ?>

<?php
$msg = '';

if(isset($_POST['btn_login']))
{

  function test_input($data) 
  {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
  }

  $time= time()-30;
  $ip_address = getIpAddr();

  $query_login_count =  mysqli_query($conn,"select count(*) as total_count from loginlogs where TryTime > $time and IpAddress='$ip_address'");

  $check_login_row = mysqli_fetch_assoc($query_login_count);

  
  if(isset($check_login_row['total_count'])){
    $total_count = $check_login_row['total_count'];
  }else{
    $total_count = 0;
  }
   
   

  //Getting Post Values
    $email = test_input($_POST['email']);
    $password = test_input($_POST['password']);
      
   $query =  mysqli_query($conn,"SELECT DISTINCT * FROM customer WHERE LCASE(custEmail) = '" . $email . "' AND custPassword ='". md5($password)."'");


  if($query->num_rows > 0){

        
        $row = mysqli_fetch_assoc($query);
      

        session_start();
        $_SESSION['customer_id'] = $row["customer_id"];
        $_SESSION['custName']   = $row['custName'];
        $_SESSION['custEmail'] = $row['custEmail'];
        $_SESSION['custTel'] = $row['custTel'];
        $_SESSION['address'] = $row['address'];

        mysqli_query($conn,"DELETE FROM loginlogs WHERE IpAddress = '" . $ip_address . "'");
        //echo "<script>alert('Login Success!');</script>";
        header("Location: customer/viewmenu.php");
        exit;

      
    }else{

      $total_count++;
      $rem_attm = 3 - $total_count;
      


      if($rem_attm == 0)
      {

        $msg="To many failed login attempts. Please login after 30 sec";
      }else{
        $msg="Email or Password was wrong.<br/>$rem_attm attempts remaining";
      }
      $try_time=time();

      $insert_loginlogs = mysqli_query($conn,"INSERT INTO loginlogs SET IpAddress='".$ip_address."', TryTime ='".$try_time."'  ");


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
          <a href="manager/regCust.php" >Register Here</a>.</p>
          </div>

          <div class="result text-center mb-0 text-danger"  id="result"  align="center" style="color: red"><p><?php echo $msg ?></p>
          </div>

        </div>
      </form>
    </form>
  </section>
</body>

