<?php $title = 'homepage';
 include('header.php') ;?>

<!DOCTYPE html>
<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" a href="../footer.css">  
<style>
.container {
  position: relative;
  width: 100%;
  max-width: 1015px;
}

.container img {
  width: 100%;
  height: 80%;
}

.container .btn {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-80%, -80%);
  background-color: #ffcc66;
  color: black;
  font-size: 16px;
  padding: 12px 24px;
  border: black;
  cursor: pointer;
  border-radius: 7px;
  text-align: center;
}

.container .btn:hover {
  background-color:  #ffe6b3;
}

  
</style>
<div style="background-color:#f5f5f0">
</head>
<div style="background-color:#f5f5f0">
<body>
<div class="slideshow-container">

<div class="mySlides fade">
 <!--  <div class="numbertext">1 / 3</div> -->
  <img src="../img/welcome.png" style="width:100%">
</div>

<div class="mySlides fade">
<!--   <div class="numbertext">2 / 3</div> -->
  <img src="../img/promo.jpeg"  style="width:100%">
</div>

<div class="mySlides fade">
<!--   <div class="numbertext">3 / 3</div> -->
  <img src="../img/super.jpg"  style="width:100%">
</div>

</div>
<br>

<div style="text-align:center">
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span> 
  <br></br>
</div>

<script>
let slideIndex = 0;
showSlides();

function showSlides() {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 6000); // Change image every 2 seconds
}
</script>


<center>
      <div class="row"> 
        <div class="column">
       <img src="../img/new.png" height="250" width="315">&nbsp;&nbsp;
       <img src="../img/delivery.png"  height="250" width="330">&nbsp;&nbsp;
      <img src="../img/fish.png" height="250" width="322">&nbsp;&nbsp;
  </div>
</div>
</div>


<br><br><hr class="solid"><br><br>

<div class="container">
  <img src="../img/banner.jpg" alt="Snow" height="250" width="1000">
  <button class="btn">Start Order</button>
</div>

<?php include('../footer.php');?>

</body>
</html>
