<?php session_start(); include('../connection.php'); //include('../includes/DatabaseClass.php'); ?>
<?php //$db = new DatabaseClass (); ?>

<?php if(!isset($_SESSION['customer_id'])){ 

  header("Location:../index.php");
  exit;
}?>

<!<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="img/2.png" type="image/png" sizes="20x20">
  
    <!-- Bootstrap core CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="/fkfood/customer/css/styleheader.css" />
    <link rel="stylesheet" href="/fkfood/customer/css/style.css">
    <link rel="stylesheet" href="/fkfood/customer/css/bootstrap.css">

    <!-- js files -->
    <script src="../js/jquery-2.1.1.min.js"></script>
    <script src="../js/jquery-ui.js"></script>
    
    
    <title><?php echo  $title; ?></title>
</head>

   <div class="menu-bar">
      <h1 class="logo">FK<span>Restaurant</span></h1>
      <ul>     
         <li><a href="homepage.php">Home  <i class="fa fa-home"></i></a></li>
       <li><a href="viewmenu.php">Menu<i class="fas fa-drumstick-bite"></i></a></li>
        <li><a href="category.php">Category <i class="fa fa-list"></i></a></li>
        <li><a href="edit.php">Edit Profile <i class="fa fa-user"></i></a></li>
        <li><a href="contact.php">Contact us  <i class="fa fa-phone"></i></a></li>
        <li><a href="cart.php">View Cart <i class="fa fa-cart-plus"></i></a></li>
        <li><a href="logout.php">Logout</a></li>
    </div>
