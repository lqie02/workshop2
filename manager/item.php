<?php $title= "Item"; include('headerstaff.php');?>

<?php 

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_query = $db->query("DELETE FROM `item` WHERE item_id = $delete_id ");
   if($delete_query){
      header('location:/fkfood/staff/item.php');
      $message[] = 'product has been deleted';
   }else{
      header('location:/fkfood/staff/item.php');
      $message[] = 'product could not be deleted';
   };
}

 if(isset($_POST['add_product'])){

   $p_name = $_POST['p_name'];
   $p_price = $_POST['p_price'];
   $p_status= $_POST['p_status'];
   $p_category_id = $_POST['p_category_id'];
   $p_image = $_FILES['p_image']['name'];
   $p_image_tmp_name = $_FILES['p_image']['tmp_name'];
   $p_image_folder = '../images/'.$p_image;
   $p_image_folder_path = '/images/'.$p_image;

   $insert_query = $db->query("INSERT INTO item SET itemName = '" . $db->escape($p_name)."', unitPrice = '" . $db->escape($p_price) ."', itemStatus ='".$db->escape($p_status)."', category_id = '".$p_category_id."', image='".$db->escape($p_image_folder_path)."', staff_id = '".$_SESSION['staff_id']."'");

   if($db->getLastId()){
      move_uploaded_file($p_image_tmp_name, $p_image_folder);
      $message[] = 'product add succesfully';
      header('location:/fkfood/staff/item.php');
   }else{
      $message[] = 'could not add the product';
      header('location:/fkfood/staff/item.php');
   }

 }
 if(isset($_POST['update_product'])){
  
  $update_p_id = $_POST['update_p_id'];
  $update_p_name = $_POST['update_p_name'];
  $update_p_price = $_POST['update_p_price'];
  $update_p_status= $_POST['update_p_status'];
  $update_p_category_id = $_POST['category_id'];
  $update_p_image = $_FILES['update_p_image']['name'];
  $update_p_image_tmp_name = $_FILES['update_p_image']['tmp_name'];
  
  $update_p_image_folder = '../images/'.$update_p_image;
  
  if($_FILES['update_p_image']['tmp_name']){
     move_uploaded_file($update_p_image_tmp_name, $update_p_image_folder);
     $update_p_image_folder_path = '/images/'.$update_p_image;
  }else{
  	 $update_p_image_folder_path = $_POST['image'];
  }

  $query = $db->query("UPDATE item SET itemName = '" . $db->escape($update_p_name)."', unitPrice = '" . $db->escape($update_p_price) ."', itemStatus ='".$db->escape($update_p_status)."', category_id = '".$update_p_category_id."', image='".$db->escape($update_p_image_folder_path)."' WHERE item_id='".$update_p_id."'");

   if($query){
      $message[] = 'product updated succesfully';
      header('location:/fkfood/staff/item.php');
   }else{
      $message[] = 'product could not be updated';
      header('location:/fkfood/staff/item.php');
   }

 }
?>
<body class="item">
<div class="container">

<section>
 <?php $category_query = $db->query("SELECT * FROM `category`");?>
<form action="" method="post" class="add-product-form" enctype="multipart/form-data">
   <h3>Add a new product</h3>
   <input type="text" name="p_name" placeholder="enter the product name" class="box" required>
   <input type="number" name="p_price" min="0" placeholder="enter the product price" class="box" required>
   <select name="p_category_id" >
      	<?php foreach($category_query->rows as $category) {?>
      	<option value="<?php echo $category['category_id'];?>" ><?php echo $category['categoryName'];?></option>
        <?php } ?>
   </select>

      <input type="varchar" name="p_status" min="0" placeholder="enter the status" class="box" required>
      <input type="file" name="p_image" accept="image/png, image/jpg, image/jpeg" class="box" style="display: inline;" required>
      <input type="submit" value="add the product" name="add_product" class="btn" style="margin-bottom:20px;">
</form>

</section>

<section class="display-product-table">

   <table class="table table-bordered table-hover">

      <thead>
      	 <th style="width:10px;">No</th>
         <th>product Image</th>
         <th>Product Name</th>
         <th>Product Price</th>
       <!--   <th>Product Status</th>-->
         <th>Action</th>
      </thead>

      <tbody>
      	 <?php $items = $db->query("SELECT * FROM item "); ?>
         <?php if ($items->num_rows > 0){ ?>
	        <?php $no = 1; foreach($items->rows as $item){?>
              <tr>
              	<td ><?php echo $no;?></td>
              	<td ><img src="../<?php echo $item['image']; ?>" style="width: 100px;" alt=""></td>
              	<td><?php echo $item['itemName'];?></td>
              	<td>RM <?php echo $item['unitPrice'];?></td>
              	<td>
	               <a href="item.php?delete=<?php echo $item['item_id']; ?>" class="delete-btn" onclick="return confirm('are your sure you want to delete this?');"> <i class="fas fa-trash"></i> delete </a>
	               <a href="item.php?edit=<?php echo $item['item_id']; ?>" class="option-btn"> <i class="fas fa-edit"></i> update </a>
	            </td>
              </tr>
	        <?php  $no++; } ?>
	     <?php } else {?>
           <tr>
           	<td colspan="5"><div class='empty'>no product added</div></td>
           </tr>
	     <?php } ?>
        
      </tbody>
   </table>

</section>

<section class="edit-form-container">

   <?php
   
   if(isset($_GET['edit'])){
      $edit_id = $_GET['edit'];
      $edit_query = $db->query("SELECT * FROM `item` WHERE item_id ='".$edit_id."'");
      

       if($edit_query->num_rows > 0){
       	$category_query = $db->query("SELECT * FROM `category`");
   ?>

   <form action="" method="post" enctype="multipart/form-data" style="margin-bottom: 30px;">

      <img src="../<?php echo $edit_query->row['image']; ?>" style="width: 150px;margin-right: 30px;" alt="">
      <input type="hidden" name="image" value="<?php echo $edit_query->row['image'];?>">
      <input type="hidden" name="update_p_id" value="<?php echo  $edit_query->row['item_id']; ?>">
      <input type="text"  required name="update_p_name" value="<?php echo $edit_query->row['itemName']; ?>">
      <input type="number" min="0" class="box" required name="update_p_price" value="<?php echo $edit_query->row['unitPrice']; ?>">
      <input type="varchar" min="0" class="box" required name="update_p_status" value="<?php echo $edit_query->row['itemStatus']; ?>"><br/>
      <div style="margin-bottom:10px;"></div>
      <select name="category_id" >
      	<?php foreach($category_query->rows as $category) {?>
      		<?php if($edit_query->row['category_id'] == $category['category_id'] ) { ?>
      		  <option value="<?php echo $category['category_id'];?>" selected><?php echo $category['categoryName'];?></option>
      	    <?php } else {?>
      	      <option value="<?php echo $category['category_id'];?>"><?php echo $category['categoryName'];?></option>
      	    <?php } ?>
      	<?php } ?>
      </select>
      <input type="file" name="update_p_image" accept="image/png, image/jpg, image/jpeg" style="display:inline;">

      <input type="submit" value="update the prodcut" name="update_product" class="btn">
   </form>

   <?php
        }
         echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
     }
   ?>

</section>

</div>
</body>