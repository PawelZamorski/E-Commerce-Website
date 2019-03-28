<?php


echo	"<nav class='navbar navbar-expand-lg navbar-light bg-light sticky-top'>
	  <a class='navbar-brand' href='index.php'><img src='image/logo/2.jpg' alt='logo' class='rounded-circle'></a>
	  <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
		<span class='navbar-toggler-icon'></span>
	  </button>
	  <div class='collapse navbar-collapse' id='navbarSupportedContent'>
		<!-- Beginning of category and product list -->
		<ul class='navbar-nav mr-auto'>
		  <li class='nav-item active'>
			<a class='nav-link' href='index.php'>Home<span class='sr-only'>(current)</span></a>
		  </li>";
			  
// Create query: select "gender"
$resultGender = mysqli_query($connection,
	"SELECT DISTINCT genderName FROM gender, product WHERE product.genderID=gender.genderID");	

// Fetch the data and add to the HTML
while($rowGender = mysqli_fetch_array($resultGender)){
	echo "	<li class='nav-item dropdown'>
				<a class='nav-link dropdown-toggle text-capitalize' href='#' id='navbarDropdown'
				role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>"
					. $rowGender['genderName'] . 
				"</a>
				<div class='dropdown-menu' aria-labelledby='navbarDropdown'>
				
				<!-- Link selecting all products for specified gender -->		
					<a class='dropdown-item' href='product.php?gender=" . $rowGender['genderName'] . "'>Select all</a>
					<div class='dropdown-divider text-uppercase' style='margin: 0;'></div>
					
				<!-- List of links selecting all products for specified gender and category	-->";			 	
// Add list of links selecting all products for specified gender and category
		// Create query: select 'category' where 'genderName' = $rowGender
		$resultCategory = mysqli_query($connection, "SELECT DISTINCT categoryName FROM category, gender, product 
				WHERE category.categoryID=product.categoryID 
				AND gender.genderID=product.genderID 
				AND gender.genderName='" . $rowGender['genderName'] . "'");
		// Fetch the data and add to the HTML
		while($rowCategory = mysqli_fetch_array($resultCategory)){			
			echo "	<a class='dropdown-item text-capitalize' href='product.php?gender=" . $rowGender['genderName'] . "&category=" . $rowCategory['categoryName'] . "'>". $rowCategory['categoryName'] ."</a>
			<div class='dropdown-divider' style='margin: 0;'></div>";
		}
		// Release returned data 
		mysqli_free_result($resultCategory);
		

echo				"</div>
				</li>";  
	}
	
// Release returned data 
	mysqli_free_result($resultGender);	 
		 
echo	"</ul>
		<!-- End of category and product list -->
		<!-- Beginning of right side menu. Change the class 'mr-auto' to 'ml-auto' for displaying list on the right side of the navbar -->
		
		<ul class='navbar-nav ml-auto'>";
// Add user name if user is logged in
if($_SESSION['logStatus'] === "Log out"){
	echo	"<li class='nav-item'>
				<a class='nav-link disabled' href='#' style='cursor: context-menu;'>Welcome &nbsp;" . $_SESSION['username'] . "</a>
			</li>";
}


// Creat the global variable 'currentURI' for storing the current uri. This is to redirect to the current page after the login process. CHECK IF THE HISTORY MAY BE USED TO COME BACK TO THE PREVIOUS PAGE
// $_SESSION['currentURI'] = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

echo		  "
<!-- NO NEED OF FORM - REMOVE IT !!! -->
		<form id='loginLogoutForm' class='form-inline my-2 my-lg-0' method='post'>
		    <button id='loginLogoutButton' class='btn btn-outline-success my-2 my-sm-0' role='button' onclick='loginLogout(this)'>" . $_SESSION['logStatus'] . "</button>
<!-- NO NEED OF FORM - REMOVE IT !!! -->		  
		</form>";
// Use AJAX to logout from the page. Function loginLogout() checks if the user is login or logout and processes the appropriate code
// Use PHP to login to the page. Redirect to the login page. Once it is successful come back to the page from which the login form was requested


echo			  
	"<!-- Add to cart -->
		  <li id='cart' class='nav-item dropdown'>	  
			<a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
			  Cart
			</a>
			
	<!-- Add class 'dropdown-menu-right' to display dopdown menu no left side -->
			<div class='dropdown-menu dropdown-menu-right' aria-labelledby='navbarDropdown'>
			  <form id='cartForm' action='orderProcess.php' method='post'>
	<!-- Add button 'See shopping basket' -->
			    <button type='submit' class='btn btn-success btn-block'>SEE SHOPPING BASKET</button>
			    <button type='button' class='btn btn-warning btn-block' onclick='removeAllItems()'>REMOVE ALL ITEMS</button>
			  </form>
			</div>
		  </li>
		</ul>
		<!-- end of cart -->
	  </div>
	</nav>";

?>