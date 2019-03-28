<?php
// Start the session
	session_start();
// Create a database connection
	require 'config/connect.php';
	
// session_destroy();

// setcookie("logoutUserCookie", "", time() - 3600);
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

	<!-- My CSS -->
	<link rel="stylesheet" type="text/css" href="myCSS/mystyle.css">
    <title>Fashionista</title>

	
  </head>
  <body onload = cartOnLoad()>

<?php

// Include 'loginAlert' template
	require 'template/loginAlert.php';
// Alert if login process was successful
// Unset $_SESSION['loginSuccessful'] to prevent from repeting the alert, when ie refreshing or comming back to the page

// Alert if logout process was successful
// Unset $_POST['logoutUser'] to prevent from repeting the alert, when ie refreshing or comming back to the page
// Unset $_SESSION['username']. It is required for checking 'logStatus' when the user logged out.
?>

  <!-- Log in info -->
	<div class="container-fluid d-none d-md-block" style="margin-top: 15px;">
	  <div class="row">
	    <div class="col-3">
			<a class="badge badge-info" href="#" target="_blank">RECEIVE OUR NEWSLETTER</a>
		</div>
		<div class="col-6 text-center">
			<h1>Welcome To #FASHIONISTA</h1>
		</div>
		<div class="col-3 text-right">
			<a class="badge badge-light" href="loginForm.php" target="_blank">REGISTER TO WEBSTORE</a>		
		</div>
	  </div>
	  <hr>
	</div>
	<!-- End of log in info -->
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
		// Close database connection
		mysqli_close($connection);
	?>
	<!-- The end of Navbar -->
	<!-- Carousel -->
<div class="container">
	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="margin-top: 10px">
	  <ol class="carousel-indicators">
		<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
		<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
		<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
	  </ol>
	  <div class="carousel-inner">
		<div class="carousel-item active">
		  <img class="d-block w-100" src="image/carouselImg/1.jpg" alt="First slide">
		  <div class="carousel-caption d-none d-md-block">
			<h5>THE BEST MENS CLOTHS</h5>
			<p>Buy today</p>
		  </div>
		</div>
		<div class="carousel-item">
		  <img class="d-block w-100" src="image/carouselImg/2.jpg" alt="Second slide">
		  <div class="carousel-caption d-none d-md-block">
			<h1>Be #Fashionista</h1>
		  </div>
		</div>
		<div class="carousel-item">
		  <img class="d-block w-100" src="image/carouselImg/3.jpg" alt="Third slide">
		  <div class="carousel-caption d-none d-md-block">
			<h2>NEW ARRIVALS</h2>
			<p>SHOP NOW</p>
		  </div>
		</div>
	  </div>
	  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	  </a>
	  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	  </a>
	</div>
	<!-- The end of carousel -->
	<hr>
	<!-- Image to select all products -->
	<div class="row">
		<div class="col-12">
			<div class="myContainer">
				<a href="product.php" type='submit'>
					<img class="img-fluid" src="image/indexPage/1.jpg" alt="Show All Products">
					<span class='overlay overlayIndex'>SEE ALL PRODUCTS</span>
				</a>
			</div>
		</div>
	</div>
	<!-- End of image for selecting all products -->
	<hr>
	<!-- Images for selecting according to gender -->
	<div class="row">
		<div class="col-6">
			<div class="myContainer">
				<a href="product.php?gender=men" type='submit'>
					<img class="img-fluid" src="image/indexPage/5.jpg" alt="Show Products for Men">
					<span class='overlay overlayIndex'>MEN</span>
				</a>
			</div>
		</div>
		<div class="col-6">
			<div class="myContainer">
				<a href="product.php?gender=women" type='submit'>
					<img class="img-fluid" src="image/indexPage/6.jpg" alt="Show Products for Women">
					<span class='overlay overlayIndex'>WOMEN</span>
				</a>
			</div>
		</div>
	</div>	
	<!-- End of images for selecting according to gender -->
</div>
	<!-- The end of container -->
	<!-- Beginning of footer -->
<?php
		// Include 'footer' template
		require 'template/footer.php';	
?>
	<!-- End of footer -->


    <!-- Optional JavaScript -->
	
	<script src="myJS/myJS.js?12345"></script>
	
	<script src="myJS/logInOut.js?1"></script>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  </body>
</html>