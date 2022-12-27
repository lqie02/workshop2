<?php $title = "location"; include('header.php') ;?>

<body>
	<div class="container">
		<section class="category">
			<h1 class="heading">Category</h1>
			   <div class="msg"></div>
			   <div class="row">
			   <div class="box-container" id="categorys">
                  <?php
                   $query = $db->query("SELECT * FROM category ");
                   if($query->num_rows > 0){
                  ?>
                  <?php foreach ($query->rows as $key => $category) { ?>
                  	<div class="col-sm-12 col-md-4 col-lg-4 col-xs-12 category-box">
                  		<h3 style="text-align:center;"><a href="/fkfood/customer/viewmenu.php?category_id=<?php echo $category['category_id'];?>"><?php echo $category['categoryName']; ?></a></h3>
                  		<p style="color:#000;font-size:14px;"><?php echo $category['description']; ?></p>
                  	</div>
                  <?php }?>
                  <?php } ?>
			   </div>
			   </div>
		</section>
	</div>
</body>