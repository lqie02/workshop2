<?php ob_start(); $title = "Menu"; include('header.php') ;?>
<br>
<center><?php include('sidebar.php') ;?></center>
<body>

<div class="container">

<section class="products">

   <h1 class="heading">Desserts</h1>
   <div class="msg"></div>
   <div class="row">
   <div class="box-container" id="product">

      <?php

      $sql = "SELECT * FROM item where category_id = '6004' ";

      $implode = array();

      if (isset($_GET['category_id'])) {
        $implode[] = 'category_id='.$_GET['category_id'];
      }

      if ($implode) {
         $sql .= " WHERE " . implode(" AND ", $implode);
      }


      $query =mysqli_query($conn,$sql);

      if($query->num_rows > 0){?>


        <?php while($fetch_product = mysqli_fetch_assoc($query)) { ?>
       

        <!--   border for product -->
          <div class="col-md-15">
            <form method="post">
          <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:10px; padding:16px;" align="center">

            <img src="/fkfood<?php echo $fetch_product['image']; ?>" alt="">
            <h3><?php echo $fetch_product['itemName']; ?></h3>
            <div class="price">RM<?php echo $fetch_product['unitPrice']; ?></div>
            <input type="hidden" name="item_id" value="<?php echo $fetch_product['item_id'];?>">

            <button type="button" id="button-cart" onclick="addCart('<?php echo $fetch_product['item_id']; ?>')" class="btn btn-primary" name="add_to_cart">Add to cart</button>
          </div>
          <br><br>
       </div>
        <?php } ?>
      <?Php } else {?>
        <div class="empty"> Item not Found </div>
      <?php } ?>

   
   </div>
   </div>

</section>

</div>

<script type="text/javascript"><!--
function addCart(item_id){
  var post_value = { item_id : item_id, post_type: 'add' }
  $.ajax({
    url: '/fkfood/customer/addCart.php',
    type: 'post',
    data: post_value,
    dataType: 'json',
    beforeSend: function() {
      
    },
    complete: function() {

    },
    success: function(json) {
      $('.alert, .text-danger').remove();

      if (json['error']) {
         $('.msg').after('<div class="alert alert-danger">' + json['error'] + '</div>');
      }
      
      if (json['success']) {
        $('.msg').after('<div class="alert alert-success">' + json['success'] + '</div>');
      }
    },

  });
};
//--></script>

<!-- custom js file link  -->
<script src="../js/script.js"></script>

</body>
</html>
