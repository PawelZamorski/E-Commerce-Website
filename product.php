<?php
// Start the session
	session_start();
// Create a database connection
	require 'config/connect.php';
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
	
	<div class="container" style="margin-top: 15px;">
	<!-- Beginning of row with buttons changing the number of columns -->
	  <div class="row">
	    <div class="col-md-12 d-none d-md-inline-block text-right">
		  <p class="d-md-inline-block">View:&nbsp;</p><button type="button" class="btn btn-outline-info btn-sm" onclick="changeCol(this)">3</button> <button type="button" class="btn btn-outline-info btn-sm" onclick="changeCol(this)">6</button>
		  <hr style="margin-bottom: 0;">
		</div>
	  </div>
	<!-- the end of number of products in a row -->
	
	<!-- The beginning of poducts desplay -->
	  <div class="row">

<?php	
	// The file 'config/selectProduct.php' performs Database Query, uploads the result, releases returned data
		require 'config/selectProduct.php';	
	// Close database connection
		mysqli_close($connection);
?>
	
	<!-- The end of product desplay -->
	  </div>
	<!-- The end of container -->
	<div>	
	<!-- Beginning of footer -->
	<?php
		// Include 'footer' template
		require 'template/footer.php';	
?>
	<!-- End of footer -->

	
    <!-- Optional JavaScript -->
	<script src="myJS/myJS.js?1234">	</script>
	
	<script src="myJS/logInOut.js"></script>

	<script>
	<!-- Function changing the number of columns is a row to 6 -->	
	  function changeCol(element){
		// Get all elements with the class 'product'
		var x = document.getElementsByClassName("product");
		// Get the value of the button that invokes the change of class 'col'
		var buttonNumber = Number(element.innerHTML);
		// Check the condition depending on the value of the button
		// Next iterate through class collection and change the class
		if(buttonNumber === 3){
		  for (i=0; i<x.length; i++){
			x[i].classList.remove("col-md-2");
			x[i].classList.add("col-md-4");
		  }
		}else{
		  for (i=0; i<x.length; i++){
			x[i].classList.remove("col-md-4");
			x[i].classList.add("col-md-2");
		  } 
		}
	  }
	</script>

	
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  </body>
</html>