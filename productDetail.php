<?php
// Start the session
	session_start();
// Create a database connection
	require 'config/connect.php';

// Check if the product was choosen
	if (!isset($_GET['productDetailID'])) {
//Set the variable to 101 to present the page
		$_GET['productDetailID'] = 101;
	}
// Delclare the data
	$productID;
	$productIMG;
	$productName;
	$price;
	$productDescription;

// Store $_GET['productDetailID'] in a variable
	$productID=$_GET['productDetailID'];
	
// Create query, select: productID, productIMG, productName, price
	$result = mysqli_query($connection,"SELECT productIMG, productName, price, productDescription FROM PRODUCT WHERE productID = '" . $productID . "'");

// Fetch the data and add to HTML
	while($row = mysqli_fetch_array($result)){
		$productIMG = $row['productIMG'];
		$productName = $row['productName'];
		$price = $row['price'];
		$productDescription = $row['productDescription'];
	}
	
// Release returned data 
	mysqli_free_result($result);	
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="myCSS/mystyle.css">
	<!-- Title - product name -->
<?php	
// Echo the <title>
	echo "<title>Company Name - " . $productName . "</title>";
?>	
	</head>
	<body onload = cartOnLoad()>";	
	
<?php

// Include 'loginAlert' template
	require 'template/loginAlert.php';
// Alert if login process was successful
// Unset $_SESSION['loginSuccessful'] to prevent from repeting the alert, when ie refreshing or comming back to the page

// Alert if logout process was successful
// Unset $_POST['logoutUser'] to prevent from repeting the alert, when ie refreshing or comming back to the page
// Unset $_SESSION['username']. It is required for checking 'logStatus' when the user logged out.
?>

<!-- Navbar -->
<?php	
// Check  if the user is logged in
	if (!isset($_SESSION['username'])) {
		$_SESSION['logStatus'] = "Log in";
	}else{
		$_SESSION['logStatus'] = "Log out";
	}
// Include 'navbar' template
	require 'template/navbar.php';
?>
	<!-- The end of Navbar -->
	<div class='container myContainerRelative'>
	  <div class='row'>
		<div class='col-md-1'>
		</div>
		<!-- The vertical image gallery (thumbnail) -->
		  <div class='col-md-1 d-none d-md-block myPadding'>
<?php
	// Check the number of images in the appropriate product folder
	  $count=count(glob($productIMG . "/*.jpg"));
	//Initializing the variable "$i" for adding the image in a while loop	
	  $i=1;
	// Add elements to the HTML
	  while($i<=$count){
		echo "<div class='myVerticalSlides'>
				<img class='demo cursor img-fluid' src='" . $productIMG . "/" . $i . ".jpg' onclick='currentSlide(" . $i . ")' alt='" . $productName . "'>
			  </div>";	
		$i++;
	  }
?>
			<!-- Up and down buttons -->
			<a id="up" onclick="plusVerticalSlides(-1)">&#x25B2;</a>
			<a id="down" onclick="plusVerticalSlides(1)">&#x25BC;</a>	
		  </div>
		<!-- End of the vertical image gallery (thumbnail) -->
		<!-- The horizontal image gallery -->
		<div class="col-md-5">
		  <!-- Full-width images with number text -->
<?php
// Add horiontal slides
	  $i=1;
	  while($i<=$count){
		echo "<div class='myHorizontalSlides'>";
		echo "<img class='img-fluid w-100' src='" . $productIMG . "/" . $i . ".jpg' alt='" . $productName . "'>";
		echo "</div>";	
		$i++;
	  }
?>		  
		  <!-- Next and previous buttons -->
		  <a id="left" onclick="plusSlides(-1)">&#10094;</a>
		  <a id="right" onclick="plusSlides(1)">&#10095;</a>	  
		</div>
		<!-- End of the horizontal image gallery -->
		<!-- Product description -->
		<div class="col-md-5">
		  <p id="slideNumber"></p>
		  <br>
<?php
	
// Add the details of the product
	  echo "<h1 class='text-uppercase'>" . $productName . "</h1>
			<br>
			<p>" . $price . " EURO</p>
			<hr>
			<p class='text-justify'>" . $productDescription . "</p>
			<hr>
			<p class='myFontSizeMin'>PRODUCT NUMBER: " . $productID . "</p>
			<!-- Add to cart button -->
			<button class='btn btn-block myButtonColor' type='button' onclick='addToCart(this)'>ADD TO CART</button><input type='hidden' name='name' value='{ &quot;id&quot;:&quot;" . $productID . "&quot;, &quot;image&quot;:&quot;" . $productIMG . "/1.jpg&quot;, &quot;name&quot;:&quot;" . $productName . "&quot;, &quot;price&quot;:&quot;" . $price . "&quot; }'>";
?>	  
		  <br>
		  <p class="myFontSizeMin">COMPOSITION & CARE</p>
		  <ul class="myFontSizeMin">
			<li>100% cotton</li>
			<li>Machine washable even at 30º</li>
		  </ul>
		  <!-- Add product to cart button -->
		  
		</div>
		<!-- End of product description -->
		  </div>
	  <!-- End of "row" -->
	</div>
	<!-- End of main container -->
	<!-- Beginning of footer -->
<?php
		// Include 'footer' template
		require 'template/footer.php';
		// Close database connection
		mysqli_close($connection);	
?>
	<!-- End of footer -->

	
    <!-- Optional JavaScript -->
	<script src="myJS/myJS.js?1234"></script>
	
	<script src="myJS/logInOut.js"></script>
	
	<!-- Script for horizontal slides -->	
	<script>
	// Select random image for slide. Images are numbered from 1. Variable slideIndex stores the number of slide to be displayed on page load
		var max = Number(<?php echo $count ?>);
		var slideIndex = Math.floor(Math.random() * max) + 1;
	// Assign 'verticalSlideIndex' the value of 'slideIndex'
		var	verticalSlideIndex = slideIndex;
	// Invoke function showSlides
		showSlides(slideIndex);
	
	// Change the 'slideIndex' and run function 'showSlides'
		function plusSlides(n) {
		  slideIndex += n;
		  showSlides(slideIndex);
		}
		
		// This function is applied to vertical slides. By clicking on vertical image the horizonal image is changed.
		function currentSlide(n) {
		  showSlides(slideIndex = n);
		}
// The function "showSlides(n)" applies to horizontal images.
// It controls displaying of the images, left and right button.
// It controls as well the opacity of vertical images and invokes "showVerticalSlides" when it is needed.
// It manipulates HTML by diplaying the current image number.
		function showSlides(n) {
		// Declare variable that is used in "for" loop
		  var i;
		// Declare variable and assign to it a collection of all element with the class "myHorizontalSlides"
		// That are all div containing horizontal images 
		  var slides = document.getElementsByClassName("myHorizontalSlides");
		// Declare variable and assign to it a collection of all element with the class "demo"
		// That are all vertical images 
		  var dots = document.getElementsByClassName("demo");
		// Declare variable and assign to it an element with the id "slideNumber"
		// That is for manipulating HTML document by displaying the number of the current image
		  var slideNumber = document.getElementById("slideNumber");
		  
		  var left = document.getElementById("left");
		  var right = document.getElementById("right");
		// Change the style "dislpay: none" of the button with id="left". It indicates if there are or not slides on the left.
			  if (n <= 1) {
				left.style.display = "none";
			  }else{
				left.style.display = "block";
			  }
		
		// Change the style "dislpay: none" of the button with id="right". It indicates if there are or not slides on the right
			  if (n >= slides.length){
				right.style.display = "none";
			  }else{
			    right.style.display = "block";
			  }
		
		// Set the style "display" to "none" for every element with the class "myHorizontalSlides"
		  for (i = 0; i < slides.length; i++) {
			  slides[i].style.display = "none";
		  }
		//  Show the current image. Set the style "display" to "block" to the image that sould be displayed.
		  slides[slideIndex-1].style.display = "block";
		  
		// Replace the style for every element with the class "demo" (applies to the vertical slides)
		  for (i = 0; i < dots.length; i++) {
			  dots[i].className = dots[i].className.replace(" active", "");
		  }
		// Add class "active" (opacity: 1) to the appropriate image in the vertical slides.
		// It is the same image that is currently displayed in the horizonal slides. 
		  dots[slideIndex-1].classList.add("active");
		  
		// Bind horizontal slides with vertical slides.
		// Check the condition when function "showVerticalSlides" should be invoked.
		// It depends on the number of images displayed in a vertical slides.  
		  if (slideIndex <= slides.length - 3){
		    verticalSlideIndex = slideIndex;
			showVerticalSlides(verticalSlideIndex);
		  }else{
			  verticalSlideIndex = slides.length - 3;
			  showVerticalSlides(verticalSlideIndex);
		  }
		
		//  
		  slideNumber.innerHTML = "Image Number: " + slideIndex;
		}
// End of the function "showSlides".
		

			
			
			// Invoke function showSlides with the parameter onclick of the element
			function plusVerticalSlides(n) {
			  verticalSlideIndex += n;
			  showVerticalSlides(verticalSlideIndex);
			}

// The function "showVerticalSlides(x)" applies to vertical images (thumbnails).
// It controls displaying of the images, up and down buttons.
// It invokes functin "showSlides" when it is needed.
			function showVerticalSlides(x) {
			// Variable that is used as a counter in for loop
			  var i;
			// Select all element with the class = mySlides
			  var verticalSlides = document.getElementsByClassName("myVerticalSlides");
			  
			  var up = document.getElementById("up");
			  var down = document.getElementById("down");
			// Change the style "dislpay: none" of the button with id="up". It indicates if there are or not slides above.
			  if (x <= 1) {
				up.style.display = "none";
			  }else{
				up.style.display = "block";
			  }
			// Change the style "dislpay" to "none" or "block" of the button with id="down".
			// It indicates if there are or not slides under
			  if (x >= verticalSlides.length -3){
				down.style.display = "none";
			  }else{
			    down.style.display = "block";
			  }
			  
			  //Set the style: display=none for every element with the class myVerticalSlides 
			  for (i = 0; i < verticalSlides.length; i++) {
				verticalSlides[i].style.display = "none";	  
			  }
			  // Change the style for currently displayed elements on display: block	  
			  verticalSlides[verticalSlideIndex-1].style.display = "block";
			  verticalSlides[verticalSlideIndex].style.display = "block";
			  verticalSlides[verticalSlideIndex+1].style.display = "block";
			  verticalSlides[verticalSlideIndex+2].style.display = "block";
			  }
// End of function "showVerticalSlides".			    
		</script>
		<!-- End of vertical slides script -->
	
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  </body>
</html>