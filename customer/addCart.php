<?php session_start(); 
 include('../connection.php');
 //include('../includes/DatabaseClass.php');
 //$db = new DatabaseClass ();

 if(isset($_POST['post_type']) && $_POST['post_type'] == 'add'){

   $query = mysqli_query($conn,"SELECT * FROM item WHERE item_id='".$_POST['item_id']."'");

   if($query->num_rows > 0){
    $row = mysqli_fetch_assoc($query);
     
    if(isset($_SESSION['items'][$row['item_id']])){
       $_SESSION['items'][$row['item_id']] += 1;
    }else{
       $_SESSION['items'][$row['item_id']] = 1;
    }
   	
   	 $json['success'] = 'Product Add To Cart Success';
   }else{
     $json['error'] = 'Product Not Found';
   }
   

   	header('Content-Type: application/json; charset=utf-8');
    echo json_encode($json);
 }

 if(isset($_POST['post_type']) && $_POST['post_type'] == 'remove'){

    unset($_SESSION['items'][$_POST['item_id']]);
    $json['success'] = 1;

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($json);
 }

  
 if(isset($_POST['post_type']) && $_POST['post_type'] == 'update'){

    $_SESSION['items'][$_POST['item_id']] = $_POST['qty'];
    $json['success'] = 1;

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($json);
 }

 if(isset($_POST['post_type']) && $_POST['post_type'] == 'discount'){


   
   $discount  = mysqli_query($conn,"SELECT * FROM voucher WHERE code='".$_POST['discount']."'");


   if($discount->num_rows>0){
    $row = mysqli_fetch_assoc($discount);
    $json['success'] = 1;
    $_SESSION['order']['discount'] = $row['discount'];
    $_SESSION['order']['code']     =  $row['code'];
   }else{
    unset($_SESSION['order']['discount']);
    unset($_SESSION['order']['code']);

    $json['error'] = 'Discount Code not Valid';

   }

   header('Content-Type: application/json; charset=utf-8');
   echo json_encode($json);

 }

 

 

?>