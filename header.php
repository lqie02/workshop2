<header class="header">

   <div class="flex">
   <img src="admin/images/logo.png" alt="logo" style="width:100px;">
      <br></br><a href="#" class="logo">FK Restaurant</a>

      <nav class="navbar">
         <a href="admin/addproduct.php">add products</a>
         <a href="customer/viewmenu.php">menu</a>
      </nav>

      <?php
      
      $select_rows = mysqli_query($conn, "SELECT * FROM `order_detail`") or die('query failed');
      $row_count = mysqli_num_rows($select_rows);

      ?>

      <a href="cart.php" class="cart">cart <span><?php echo $row_count; ?></span> </a>

      <div id="menu-btn" class="fas fa-bars"></div>

   </div>

</header>
