<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="icon" href="../img/2.png" type="image/png" sizes="20x20">
	<style>

		.dropbtn
			{
				background-color: #a6e7ff;
				color: black;
				padding: 20px;
				font-size: 18px;
				border-color:antiquewhite;
				border-radius: 10px;
				
			}
		
		.dropdown{
			position:relative;
			display: inline-block;
			margin-left: 650px;
			margin-top: 40px;
		}
		
		.dropdown-content {
			  display: none;
			  position:relative;
			  background-color: #f1f1f1;
			  min-width: 160px;
			  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
			  z-index: 1;
			
		}

		.dropdown-content a {
			  color: black;
			  padding: 12px 16px;
			  text-decoration: none;
			  display: block;
			
		}

		.dropdown-content a:hover {background-color: #ddd; }

		.dropdown:hover .dropdown-content {display: block;}

		.dropdown:hover .dropbtn {background-color: #aaf0d1;  }

		body{
			
			width: 100%;
			background-image: url("../img/4.png");;
			
			background-position: center;
			background-size: cover;
			height: 109vh;
		}
		
		
		.logo
		{
			color: #ffc40c;
			font-size: 40px;
			font-family: Constantia, "Lucida Bright", "DejaVu Serif", Georgia, "serif";
			align-items: center;
			text-align: center;
			float: center;
			padding-top: 100px;
		}
		
		p{
			color: antiquewhite;
			text-align: center;
			font-size: 20px;
			float: center;
		}
		
			
	
	</style>
	
	<title> Location </title>

</head>
	
<body>
	
	
	
		<h2  class = "logo">FOREIGN KEY RESTAURANT</h2><br>
		<p>Move the mouse over the button to open the dropdown menu.</p>
		
	<div class="dropdown">
  	<button class="dropbtn" >Choose Location</button>
	  <div class="dropdown-content">
		<a href="viewmenu.php">Bangi</a>
		<a href="viewmenu.php">Shah Alam2</a>
		<a href="viewmenu.php">Putrajaya</a>
		<a href="viewmenu.php">Petaling Jaya</a>
	  </div>
	</div>
	
	</body>
</html>