<?php 
$title = "Payment Page"; include('header.php');


     if(isset($_POST['Pay_Now'])) {
       if (isset($_SESSION['items']) && !empty($_SESSION['items'])){
           $total = 0; 
           $total_qty=0; 
           foreach($_SESSION['items'] as $key => $qty) { 
               $query = mysqli_query($conn,"SELECT * FROM item WHERE item_id='".$key."'");
               if($query->num_rows > 0) { 
                 $row_product = mysqli_fetch_assoc($query);
                 $total += $row_product['unitPrice'] * $qty;
                 $total_qty += $qty;
               } 
           } 

           if($_POST['discount']){
             $discount_query = mysqli_query($conn,"SELECT * FROM voucher WHERE code='".$_POST['discount']."'");
             $row_discount = mysqli_fetch_assoc($discount_query);
             $voucher_no = $row_discount['voucher_no'];
           }else{
             $voucher_no = 0; 
           }

           //add main order 
           $order_query = mysqli_query($conn,"INSERT INTO orders SET amount = '" .(float)$total ."', qty = '" .(int)$total_qty . "', orderStatus ='Pending', discount ='".(float)$_POST['discount_total']."', total = '".(float)$_POST['final_total']."', customer_id = '".$_SESSION['customer_id']."', orderDate = NOW() ");

           $order_id =mysqli_insert_id($conn);


           $payment_query = mysqli_query($conn,"INSERT INTO payment SET totalAmount = '".(float)$_POST['final_total']."', order_id = '".(int)$order_id ."', paymentDate = NOW(), payMethod = '".$_POST['payMethod']."' , voucher_no ='".$voucher_no."'");


           $delivery_query = mysqli_query($conn,"INSERT INTO delivery SET deliveryStatus = 'Pending', order_id = '".(int)$order_id ."', dateTime = NOW() ");

           
           foreach($_SESSION['items'] as $key => $qty) { 
              $item_detail = mysqli_query($conn,"SELECT * FROM item WHERE item_id='".$key."'");
              $row = mysqli_fetch_assoc($item_detail);
              $order_query = mysqli_query($conn,"INSERT INTO order_detail SET order_id = '" .(int)$order_id ."', item_id = '" .(int)$key . "', quantity ='".(int)$qty."', name ='".$row['itemName']."', price ='".(float)$row['unitPrice']."'");
           }


      } 

      
    }//end post if
?>

<?php if(isset($order_id)){ unset($_SESSION['items']); unset($_SESSION['order']);?>
  <h2  class = "location-logo">Thank You For Your Payment</h2>
  <h3 style="text-align: center;">Order Placed : Order ID #<?php echo $order_id;?></h3>

  <?php $order_info = mysqli_query($conn,"SELECT * FROM orders WHERE order_id='".$order_id."'");
   $row = mysqli_fetch_assoc($order_info);
  ?>
  <?php $order_details = mysqli_query($conn,"SELECT * FROM order_detail WHERE order_id='".$order_id."'");?>

  <div class="resipt" style="width:350px; margin: 20px auto; text-align: center;">
    FK Restaurant<br/>
    Address 1<br/>
    Address 2 <br/>
    387398 Selangor<br/>
    Malaysia
    <hr>
    <table style="width:100%">
      <thead>
        <tr>
          <td> NO. </td>
          <td>Item</td>
          <td>QTY</td>
          <td>Price</td>
          <td>Total</td>
        </tr>
      </thead>
      <tbody>
    <?php $no =1; 

     while($detail = mysqli_fetch_assoc($order_details)) { ?>
       <tr>
         <td style="padding:5px;"><?php echo $no;?></td>
         <td style="padding:5px;"><?php echo $detail['name'];?></td>
         <td style="padding:5px;"><?php echo $detail['quantity'];?></td>
         <td style="padding:5px;">RM <?php echo $detail['price'];?></td>
         <td style="padding:5px;">RM <?php echo $detail['price']*$detail['quantity'];?></td>
       </tr>
    <?php $no++; } ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="4" style="text-align:right;">Sub Total</td>
        <td>RM <?php echo $row['amount'];?></td>
      </tr>
       <tr>
        <td colspan="4" style="text-align:right;">Discount</td>
        <td>RM <?php echo $row['discount'];?></td>
      </tr>
      <tr>
        <td colspan="4" style="text-align:right;">Total</td>
        <td>RM <?php echo $row['total'];?></td>
      </tr>
    </tfoot>
   </table>
  </div>

<div style="text-align:center;">
  <h2><a href="/fkfood/customer/rating.php?order_id=<?php echo $order_id;?>">Rate us</a></h2>
</div>

<?php } else { ?>
  <h2  class = "location-logo">Sorry Order Error</h2>
  <h3 style="text-align: center;">Contact Admin</h3>
<?php } ?>
