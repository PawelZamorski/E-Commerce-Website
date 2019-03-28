<?php	
// GET method is used as the page is refreshed each time after adding product to cart in order to clear POST and avoid "Confirm Form Resubmission".

// Check conditions
	
	// Check if the user selected category in the menu. If so, the $_GET method sended 'category' and 'gender' value
	if(isset($_GET['category']) && $_GET['category'] !== '' && isset($_GET['gender']) && $_GET['gender'] !== ''){
	  $category=$_GET['category'];
	  $gender=$_GET['gender'];
	
	// Create query: select all products for appropriate 'gender' and 'category'
	  $result = mysqli_query($connection,"SELECT productID, productName, productIMG, price FROM product, gender, category 
			WHERE product.genderID=gender.genderID
			AND product.categoryID=category.categoryID 
			AND gender.genderName='". $gender ."'
			AND category.categoryName='" . $category . "'");
			
	// Check if the user selected 'gender'. If so, the $_GET method sended only 'gender' value
	}elseif(isset($_GET['gender']) && $_GET['gender'] !== ''){
	  $gender=$_GET['gender'];
	
	// Create query: select all product for appropriate gender
	  $result = mysqli_query($connection,"SELECT productID, productName, productIMG, price FROM product, gender 
			WHERE product.genderID=gender.genderID 
			AND gender.genderName='". $gender ."'");
	
	// Option when neither gender nor category was selected
	}else{
	// Select all products.
	  $result = mysqli_query($connection,"SELECT * FROM PRODUCT");
	}
	
// Add products to the page	
	while($row = mysqli_fetch_array($result))
	{
		echo"
		<!-- Class 'product' is used in script, function 'changeCol(element)' -->
			<div class='product col-md-4'>
			  <div class='myContainer'>
			    <a href='productDetail.php?productDetailID=" . $row['productID'] . "' type='submit'>
				  <img src='" . $row['productIMG'] . "/1.jpg' alt='" . $row['productName'] . "' class='img-fluid myImg'>
				  <span class='overlay overlayProduct'>SEE DETAILS</span>
			    </a>
			  </div>
			  <p class='text-center text-uppercase font-weight-bold' style='margin-bottom: 0;'>" . $row['productName'] . "</p>
			  <p class='text-center myFontSizeMin'>" . $row['price'] . " EUR</p>
			  <button class='btn btn-block myButtonColor' type='button' onclick='addToCart(this)'>ADD</button><input type='hidden' name='name' value='{ &quot;id&quot;:&quot;" . $row['productID'] . "&quot;, &quot;image&quot;:&quot;" . $row['productIMG'] . "/1.jpg&quot;, &quot;name&quot;:&quot;" . $row['productName'] . "&quot;, &quot;price&quot;:&quot;" . $row['price'] . "&quot; }'>
<!-- The coment to the above code: Create button and an input element as a type 'hidden' for storing data as a JSON object. The <input> must be a nextChild of <button>. It means that there must be no space, text or other element. -->			  
			  
<!-- OLD CODE: Add value as na array 
	<input type='hidden' name='name' value='" . $row['productID'] . "'>
-->

			</div>";						
	}

// Release returned data 
	mysqli_free_result($result);
?>