<?php

@include '../connection.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" href="../img/2.png" type="image/png" sizes="20x20">
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
      <link rel="stylesheet" href="../css/styleheader.css" />
      <link rel="stylesheet" href="../css/style.css">
</head>
<body>
   
     <div class="menu-bar">
      <h1 class="logo">FK<span>Restaurant</span></h1>
      <ul>     
        <li><a href="viewmenu.php"> Menu</a></li>

        <li><a href="#">Category <i class="fa fa-search"></i></a></li>
        <li><a href="">Edit Profile</a></li>
        <li><a href="#">Contact us</a></li>
    </div>

<!--     <div class="hero">
      &nbsp;
    </div> -->


<section class="products">

   <h1 class="heading">MENU</h1>

   <div class="box-container">

      <?php
      
      $select_products = mysqli_query($conn, "SELECT * FROM `item`");
      if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
      ?>

      <form action="" method="post">
         <div class="box">
            <img src="uploaded_img/<?php echo $fetch_product['image']; ?>" alt="">
            <h3><?php echo $fetch_product['itemName']; ?></h3>
            <div class="price">RM<?php echo $fetch_product['unitPrice']; ?></div>
            <input type="hidden" name="product_name" value="<?php echo $fetch_product['itemName']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_product['unitPrice']; ?>">
             <input type="hidden" name="product_status" value="<?php echo $fetch_product['itemStatus']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
            <input type="submit" class="btn" value="add to cart" name="add_to_cart">
         </div>
      </form>

      <?php
         };
      };
      ?>

   </div>

</section>

</div>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
