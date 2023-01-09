<?php ob_start();$title = "Menu"; include('header.php') ;?>

<body>
	
<div class="container">
   <h1 class="heading">Cart</h1>
   <div class="msg"></div>
  <div class="cart-box">
  	<table >
   <?php if (isset($_SESSION['items']) && !empty($_SESSION['items'])){?>
    <form action="pay.php" method="POST" class="pay">
     <thead>
     	<tr>
       <td style="padding: 10px;">No</td>
     	 <td style="padding: 10px;"><h4>Product</h4></td>
     	 <td style="padding: 10px;"><h4>Name</h4></td>
     	 <td style="padding: 10px;"><h4>Price</h4></td>
     	 <td style="padding: 10px;"><h4>Quantity</h4></td>
     	 <td style="padding: 10px;"><h4>Total</h4></td>
       <td></td>
     	</tr>
     </thead>
      <?php $no = 1; $total = 0; foreach($_SESSION['items'] as $key => $qty) { ?>
      	<tr>
      	
      <?php $query = mysqli_query($conn,"SELECT * FROM item WHERE item_id='".$key."'");  
        if($query->num_rows > 0){
           $row = mysqli_fetch_assoc($query);
          $total += $row['unitPrice'] * $qty;

          if(isset($_SESSION['order']['code'])){
            $code = $_SESSION['order']['code'];
            $discount = $_SESSION['order']['discount'];

          }else{
            $code = '';
            $discount ='';
          }
      ?>
         <td style="padding: 10px;"><h2><?php echo $no;?></h2></td>
         <td style="padding: 10px;"><img src="/fkfood<?php echo $row['image']; ?>" style="height: 150px;"></td>
         <td style="padding: 10px;"><h3><?php echo $row['itemName']; ?></h3></td>
         <td style="padding: 10px;"><h3>RM <?php echo $row['unitPrice']; ?></h3></td>
         <td><input type="number" name="qty[<?php echo $key;?>]" id="qty-<?php echo $key;?>" value="<?php echo $qty;?>" style="height: 32px;font-size: 16px;width: 100px;"><button type="button" data-toggle="tooltip" title="" class="btn btn-primary" onclick="update(<?php echo $key;?>);" data-original-title="Update" style="margin-top: 0px;"><i class="fa fa-refresh"></i></button></td>
         <td style="padding: 10px; font-weight: bold;"><h3>RM <?php echo $row['unitPrice']*$qty; ?></h3></td>
         <td><button type="button" data-toggle="tooltip" title="" class="btn btn-danger" onclick="remove(<?php echo $key;?>);" data-original-title="Remove"><i class="fa fa-times-circle"></i></button></td>
           
       <?php  } ?>
       </tr>
      <?php $no++; } ?>
     <tfoot>
      <tr>
        <td  colspan="1" style="width:100px">Discount Code </td>
        <td>
          <input type="hidden" name="discount" value="<?php echo $discount;?>">
          <input type="text" value="<?php echo $code;?>" style="margin-left: 20px;height: 32px;font-size: 16px;width: 200px;" id="discount" name="discount"><button type="button" data-toggle="tooltip" title="" class="btn btn-primary" onclick="updateDiscount();" data-original-title="Update" style="margin-top: 0px;"><i class="fa fa-refresh"></i></button></td>
      </tr>
      <tr>
      <td colspan="1" >Payment Option </td>

      <td colspan="2"><select  name="payMethod" style="margin-left: 20px;height: 32px;font-size: 16px;width: 200px;">
        <option value="cash">C.O.D</option>
        <option value="online banking">Online Bank in</option>
      </select></td>
     	<td colspan="2" style="padding: 5px;text-align:right;"><h3 style="margin: 0px;">Subtotal Total : </h3></td>
     	<td style="padding: 5px;"><h3 style="margin: 0px;">RM <?php echo $total;?></h3></td>
      <tr/>
      <tr>
      <?php
        $discount_total = 0; 

        if(isset($_SESSION['order']['discount'])){
          $discount_total = $total * ($_SESSION['order']['discount']/100);
        }

        $final_total = $total - $discount_total; 
      ?>

      <td colspan="5" style="padding: 5px;text-align:right;"><h3 style="margin: 0px;">Discount Total <?php if($discount){ echo '('.$discount.'%)'; }?> : </h3></td>
      <td style="padding: 5px;"><h3 style="margin: 0px;">
       <input type="hidden" name="discount_total" value="<?php echo $discount_total;?>">
        RM <?php echo $discount_total;?></h3></td>
      <tr/>
      <tr>
      <td colspan="5" style="padding: 5px;text-align:right;"><h3 style="margin: 0px;">Total : </h3></td>
      <td style="padding: 5px;"><input type="hidden" name="final_total" value="<?php echo $final_total;?>"><h3 style="margin: 0px;">RM <?php echo $final_total;?></h3></td>
      <tr/>
     </tfoot>
    </table>

    <div class="pull-left" style="margin-bottom: 30px;">
    	<input type="submit" name="Pay Now" value="pay" class="btn btn-primary">
    </div>

   </form>
    </div>
   <?php } else { ?>
     <div class="empty">Cart Empty</div>
   <?php } ?>

</div>

<script type="text/javascript"><!--

function updateDiscount(){
  var post_value = { discount : $('#discount').val(), post_type: 'discount' };
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

      if (json['success']) {
        location = 'cart.php';
      }else{
       
        location = 'cart.php';
         $('.msg').after('<div class="alert alert-danger">' + json['error'] + '</div>');
      }
    },

  });

}

function remove(item_id){
  var post_value = { item_id : item_id, post_type: 'remove' }
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

      if (json['success']) {
        location = 'cart.php';
      }
    },

  });
};


function update(item_id){

  qty = $('#qty-'+item_id).val();

  var post_value = { item_id : item_id, post_type: 'update',qty : qty }
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

      if (json['success']) {
        location = 'cart.php';
      }
    },

  });
};
//--></script>

</body>
</html>