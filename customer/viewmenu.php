<?php ob_start(); $title = "Manu"; include('header.php') ;?>

<body>

<div class="container">

<section class="products">

   <h1 class="heading">MENU</h1>
   <div class="msg"></div>
   <div class="row">
   <div class="box-container" id="product">

      <?php

      $sql = "SELECT * FROM item ";

      $implode = array();

      if (isset($_GET['category_id'])) {
        $implode[] = 'category_id='.$_GET['category_id'];
      }

      if ($implode) {
         $sql .= " WHERE " . implode(" AND ", $implode);
      }

      $query = $db->query($sql);

      if($query->num_rows > 0){?>
        <?php foreach ($query->rows as $key => $fetch_product) { ?>
         <div class="col-sm-12 col-md-4 col-lg-4 col-xs-12">
          <div class="box">
            <img src="/fkfood<?php echo $fetch_product['image']; ?>" alt="">
            <h3><?php echo $fetch_product['itemName']; ?></h3>
            <div class="price">RM<?php echo $fetch_product['unitPrice']; ?></div>
            <input type="hidden" name="item_id" value="<?php echo $fetch_product['item_id'];?>">

            <button type="button" id="button-cart" onclick="addCart('<?php echo $fetch_product['item_id']; ?>')" class="btn btn-primary" name="add_to_cart">Add to cart</button>
          </div>
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
