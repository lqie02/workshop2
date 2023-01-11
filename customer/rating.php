<?php $title = "Rating"; include('header.php') ;?>

<?php if(isset($_POST['submit'])){
    
    if(isset($_POST['rating'])){
    	$rating = $_POST['rating'];
    }else{
    	$rating = 0;
    }
   
   $query = mysqli_query($conn,"INSERT INTO rating SET score='".$rating."', R_remark='".$_POST['text']."', order_id ='".$_POST['order_id']."'");

   if(mysqli_insert_id($conn)){
   	 echo '<h2 style="text-align: center;">Thank You For Your Rating</h2>';
     exit;
   }else{
      echo '<h3 style="text-align: center;">Error on submit pls try again!</h3>';
   }
   

}
?>

<body>
	<div class="container">
		<?php if(isset($_GET['order_id'])){
            $order_info = mysqli_query($conn,"SELECT * FROM orders WHERE order_id='".$_GET['order_id']."'");
          }
	   
	      if(isset($order_info) && $order_info->num_rows > 0 ){ 
	    ?>

	    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'].'?order_id='.$_GET['order_id'];?>" class="form-horizontal" style="margin-top: 30px;">
	    	<div class="form-group required">
               <label class="control-label col-sm-2" for="input-review">Name</label>

               <div class="col-sm-10">
               	<input type="hidden" name="order_id" value="<?php echo $_GET['order_id'];?>">
                <input type="text" name="name" class="form-control" value="<?php echo $_SESSION['custName'];?>" readonly>
               </div>

	    	</div>
	    	<div class="form-group required">
	    		  <label class="control-label col-sm-2" for="input-review">Review</label>
                  <div class="col-sm-10">
                  	<textarea name="text" rows="5" id="input-review" class="form-control"></textarea>
                  </div>
            </div>
            <div class="form-group required">
            	  <label class="control-label col-sm-2">Rating</label>
                  <div class="col-sm-10">
                  	
                    &nbsp;&nbsp;&nbsp; Bad&nbsp;
                     <input type="radio" name="rating" value="1" />
                    &nbsp;
                    <input type="radio" name="rating" value="2" />
                    &nbsp;
                    <input type="radio" name="rating" value="3" />
                    &nbsp;
                    <input type="radio" name="rating" value="4" />
                    &nbsp;
                    <input type="radio" name="rating" value="5" />
                    &nbsp;Good
                  </div>
            </div>

           <div class="form-group ">
           	<label class="control-label col-sm-2"></label>
	    	<input type="submit" name="submit" value="Submit" class="btn btn-primary">
	       </div>
	    </form>

		<?php } else { ?>
			<h2 style="text-align:center;">Order Not Found</h2>
		<?php } ?>
	</div>
</body>

