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

    <title>Hello, world!</title>
	<style>
	  .myCellButton{
		  padding: 10px;
		  cursor: pointer;
		  transition: background-color 0.7s;
	  }
	  .myCellButton:hover{
		  background-color: #d9d9d9;
	  }
	  
	  
		/* color for the "add to basket" button */
		.myButtonColor {
		  background-color: #bea374;
		}
		
		.myButtonColor:hover {
		  background-color: #ad8c52;
		}
		
	</style>
  </head>
  <body>
  
<?php

// Include 'loginAlert' template
	require 'template/loginAlert.php';
// Alert if login process was successful
// Unset $_SESSION['loginSuccessful'] to prevent from repeting the alert, when ie refreshing or comming back to the page

// Alert if logout process was successful
// Unset $_POST['logoutUser'] to prevent from repeting the alert, when ie refreshing or comming back to the page
// Unset $_SESSION['username']. It is required for checking 'logStatus' when the user logged out.
?>
  
	<div class="container">
	<hr>
	<!-- End of Log in/log out button -->
	   <div class="row">
		<div class="col-12 text-right">

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

		</div>
	  </div>
	<!-- End of Log in/log out button -->
	  <hr>
	  <div class="row">
		<div class="col-12 text-center">
		  <h1>SHOPPING BASKET</h1>
		  <br>
		</div>
	  </div>
	  <!-- Include form for processing data -->
	  <form id="orderForm" action='orderConfirm.php' method='post'>
	  <div class="row">
	    <div class="table-responsive">
		  <table id="myTable" class="table table-hover">
		    <thead class="text-center table-dark">
			  <th>PRODUCT</th>
			  <th>DESCRIPTION</th>
			  <th colspan=2>PRICE</th>
			  <th colspan=3>QUANTITY</th>
			  <th>AMOUNT</th>
			  <th>DELETE</th>
			</thead>
			<tbody id="myTableBody"></tbody>
			<tfoot class="font-weight-bold">
			  <tr>
			    <td colspan=7 class="text-right">TOTAL:
				</td>
				<td id="myTotal" class="text-center">
				</td>
				<td>
				</td>
			  </tr>
			</tfoot>
		  </table>
		  <!-- End of class=table-responsive containing table -->
		  </div>  
	  <!-- End of row containing table -->  
	  </div>
	  <div class="row text-center">
		<div class="col-4 ">
		  <a class="btn btn-block btn-secondary" href="index.php" role="button">CONTINUE SHOPPING</a>
		</div>
		<div class="col-4">
		</div>
		<div class="col-4"><button type="button" class="btn btn-block btn-success" onclick="submitOrder()" value="Order form">PROCEED TO CHECKOUT</button>
		</div>
	  </div>
	  <!-- End of the form -->
	  </form>
	  <hr>
	</div>
<!-- Beginning of footer -->
<?php
		// Include 'footer' template
		require 'template/footer.php';	
?>
<!-- End of footer -->

	

    <!-- Optional JavaScript -->
	<!-- Log in. log out script -->
	<script>
		window.onload = function(){
		  orderTableOnLoad();
		  showAmount();
		};
	</script>
	
	<script src="myJS/logInOut.js?1"></script>
	
	<!-- Remove "cart" from navbar -->
	<script>
		// You can remove child element of the parent. So to remove element it is needed to know parent and child element.
		var child = document.getElementById("cart");
		// Find the parent via child element and remove child.
		child.parentNode.removeChild(child);
	</script>

	<!-- Script for manipulation the order -->
	<script defer>
	// The function 'submitOrder()' submits form with id = 'orderForm'.
	// It checks if the user is logged in. If not it opens 'loginForm.php'
		function submitOrder(){
		// Check if the user is logged in. 'Log in' means that User is not logged in 
		// (toChangeInfo: change it to 'LOGGED OUT'!!!)
			if('<?php echo $_SESSION['logStatus'] ?>' == "Log in"){
				if(confirm("You are not logged in. To proceed click 'OK'")){
				// Simulate clicking on the 'login/logout' button. Trigger those button.	
					document.getElementById("loginLogoutButton").click();
				}	
			}else{
				document.getElementById("orderForm").submit();
			}
		}	
	  
	// This function is invoked after the page is load. It fills up the "amount" and "total" in the table.
		function showAmount(){
			// Declare and assing a variable "total". 
			// It stores the total price for products. When an "order basket" is empty it displays 0.
			var total = 0;
			// Get the rows from the table body
			var rows = document.getElementById("myTable").getElementsByTagName("tbody")[0].getElementsByTagName("tr");
			// Get the number of rows in table body
			var rowsNumber = rows.length;
			var i;
			// Loop through and change the amount, that is (price * quantity) in the "amount" column
			for(i = 0; i < rowsNumber; i++){
				// Get the price and parse it to number
				var price = Number(rows[i].children[2].innerHTML);
				// Get the current quantity and parse it to number
				var quantity = Number(rows[i].children[5].innerHTML);
				// Change the amount in "amount" column, display 2 decimals
				rows[i].children[7].innerHTML = (price * quantity).toFixed(2);
			}
			// Change "total":
			// Get the number of rows in table body
			var rowsNumber = rows.length;
			// Loop through and add amounts in "amount" column. Stor it in variable "total".
			for(var i = 0; i < rowsNumber; i++){
				var amount = Number(rows[i].children[7].innerHTML);
				total += amount;
			}
			// Display "total" in appropriate table cell
			document.getElementById("myTotal").innerHTML = total.toFixed(2);
			}
	  
	// This function manipulates HTML. It allows to change the quantity of product, amount, total 
	// and removes the product from the order basket when the quantity is below 1 or when a user explicitly wish so.
		function changeQuantity(i, element){
			// Declare and assing a variable "total". It stores the total price for products.
			var total = 0;
			// Parse "i" value to number
			i = Number(i);
			// Get the parent element
			var parent = element.parentElement;
			// Get the value of the child elements:
			// Get the price and parse it to number
			var price = Number(parent.children[2].innerHTML);
			// Get the current quantity and parse it to number
			var quantity = Number(parent.children[5].innerHTML);
			// Manipulate the HTML:
			// Change quantity
			quantity += i;
			//Confirm removing element
			if(quantity <= 0){
			  if(confirm("Are you sure you want to remove this item")){
				remove(element);
			  }else{
				  quantity = 1;
			  }
			}
			
			if(!quantity <= 0){
			  parent.children[5].innerHTML = quantity;
			  // Change the amount in "amount" column, display 2 decimals
			  parent.children[7].innerHTML = (price * quantity).toFixed(2);
			}
			// Change "total"
			// Get rows from table body
			var rows = document.getElementById("myTable").getElementsByTagName("tbody")[0].getElementsByTagName("tr");
			// Get the number of rows in table body
			var rowsNumber = rows.length;
			// Loop through and add amounts in "amount" column. Stor it in variable "total".
			for(var i = 0; i < rowsNumber; i++){
				  var amount = Number(rows[i].children[7].innerHTML);
				  total += amount;
			}
			// Display "total" in appropriate table cell
			document.getElementById("myTotal").innerHTML = total.toFixed(2);


			// remove element - table row. Check the condition for "quantity" equals to 0
			
		}
		
	// Function "remove" removes table row from the table
		function remove(element){
			// Get the row to be deleted
			var parent = element.parentElement;
			// Get the index of the row to be deleted in the table
			var indexOfRow = parent.rowIndex;
			// Delete the row from the table
			document.getElementById("myTable").deleteRow(indexOfRow);
			// Invoke function "showAmount" after deleting to update table
			showAmount();
		}
	
	
	</script>

<!-- Script for building the HTML of table with products -->
	<script>
// <!-- This function builds HTML and adds product to the order table	
	  function addProductElement(productID, productImage, productName, productPrice){
	  	  // Take the parent element
		  var parent = document.getElementById("myTableBody");
		  
		  // Create and add <tr class='text-center'>
		  var trElement = document.createElement("tr");
		  trElement.className = "text-center";
		  parent.appendChild(trElement);
		  
		  // Create and add <td width=10% class='align-middle'> as a child of 'trElement'
		  var td1 = document.createElement("td");
		  td1.className = "align-middle";
		  td1.setAttribute("width", "10%");
		  trElement.appendChild(td1);
		  
		  // Create and add <a href='productDetail.php?productDetailID=" . $row['productID'] . "'> as a child of 'td1'
		  var aElement = document.createElement("a");
		  aElement.setAttribute("href", "productDetail.php?productDetailID=" + productID);
		  td1.appendChild(aElement);
		  
		  // Create and add <img src=''productIMG'/1.jpg' class='img-fluid' alt='productName' style='display: inline-block;'> as a child of 'aElement'
		  var imgElement = document.createElement("img");
		  imgElement.className = "img-fluid";
		  imgElement.setAttribute("src", productImage);
		  imgElement.setAttribute("alt", productName);
		  imgElement.setAttribute("style", "display: inline-block;");
		  aElement.appendChild(imgElement);
		  
		  // Create and add <td class='align-middle text-justify'> as a child of 'trElement'
		  var td2 = document.createElement("td");
		  td1.className = "align-middle text-justify";
		  trElement.appendChild(td2);
		  
		  // Create and add <p>'productName'</p> as a child of 'td2'
		  var p1Element = document.createElement("p");
		  td2.appendChild(p1Element);
		  
		  // Create and add textNode='productName' as a child of 'p1Element'
		  var productNameText = document.createTextNode(productName);
		  p1Element.appendChild(productNameText);
		  
		  // Create and add <p class='myFontSizeMin'>PRODUCT NUMBER: 'productID'</p> as a child of 'td2'
		  var p2Element = document.createElement("p");
		  p2Element.className = "myFontSizeMin";
		  td2.appendChild(p2Element);
		  
		  // Create and add textNode=PRODUCT NUMBER: 'productID' as a child of 'p2Element'
		  var productIDText = document.createTextNode("PRODUCT NUMBER:" + productID);
		  p2Element.appendChild(productIDText);
		  
		  // Create and add <input type='hidden' name='proceedOrder' value='productID'> as a child of 'td2'
		  var inputElement = document.createElement("input");
		  inputElement.setAttribute("type", "hidden");
		  inputElement.setAttribute("name", "proceedOrder");
		  inputElement.setAttribute("value", productID);
		  td2.appendChild(inputElement);
		  
		  // Create and add <td class='align-middle text-right'>'price'</td> as a child of 'trElement'
		  var td3 = document.createElement("td");
		  td3.className = "align-middle text-right";
		  trElement.appendChild(td3);
		  
		  // Create and add textNode 'price' as a child of 'td3'
		  var priceText = document.createTextNode(productPrice);
		  td3.appendChild(priceText);

		  // Create and add <td class='align-middle text-left'>EURO</td> as a child of 'trElement'
		  var td4 = document.createElement("td");
		  td4.className = "align-middle text-left";
		  trElement.appendChild(td4);
		  
		  // Create and add textNode 'EURO' as a child of 'td4'
		  var euroText = document.createTextNode("EURO");
		  td4.appendChild(euroText);

		  // Create and add <td class='align-middle myCellButton' onclick='changeQuantity(-1, this)'><</td> as a child of 'trElement'
		  var td5 = document.createElement("td");
		  td5.className = "align-middle myCellButton";
		  td5.setAttribute("onclick", "changeQuantity(-1, this)");
		  trElement.appendChild(td5);
		  
		  // Create and add textNode '<' as a child of 'td5'
		  var leftArrowText = document.createTextNode("<");
		  td5.appendChild(leftArrowText);

		  // Create and add <td class='align-middle'>1</td> as a child of 'trElement'
		  var td6 = document.createElement("td");
		  td6.className = "align-middle";
		  trElement.appendChild(td6);
		  
		  // Create and add textNode '1' as a child of 'td6'
		  var quantityText = document.createTextNode("1");
		  td6.appendChild(quantityText);
		  
		  // Create and add <td class='align-middle myCellButton' onclick='changeQuantity(+1, this)'>></td> as a child of 'trElement'
		  var td7 = document.createElement("td");
		  td7.className = "align-middle myCellButton";
		  td7.setAttribute("onclick", "changeQuantity(+1, this)");
		  trElement.appendChild(td7);
		  
		  // Create and add textNode '>' as a child of 'td7'
		  var rightArrowText = document.createTextNode(">");
		  td7.appendChild(rightArrowText);
		  
		  // Create and add <td class='align-middle'></td> as a child of 'trElement'
		  var td8 = document.createElement("td");
		  td8.className = "align-middle";
		  trElement.appendChild(td8);
		  
		  // Create and add <td class='align-middle myCellButton' onclick='remove(this)'>X</td> as a child of 'trElement'
		  var td9 = document.createElement("td");
		  td9.className = "align-middle myCellButton";
		  td9.setAttribute("onclick", "remove(this)");
		  trElement.appendChild(td9);
		  
		  // Create and add textNode 'X' as a child of 'td9'
		  var removeText = document.createTextNode("X");
		  td9.appendChild(removeText);
	  }  
	
// <!-- This function adds product to the cart -->	
	  function addToOrderTable(e){
		  alert("Code running 1");
		// Function uses localStorage/sessionStorage
		// Check if localStorage is support by a web browser
		if (typeof(Storage) !== "undefined") {
		// Code for localStorage/sessionStorage.
		  // Get the variables:
		  // Get the parrent node
		  alert("Code running 2");
		  
		/*  OLD CODE
		  divProduct = e.parentNode;
		  productImage = divProduct.childNodes[1].childNodes[1].childNodes[1].getAttribute("src");
		  productName = divProduct.childNodes[3].innerHTML;
		  productPrice = divProduct.childNodes[5].innerHTML;
		  productID = divProduct.childNodes[8].value;
		  //pInfo = JSON.parse(productID);
		  alert("Value of ID, Image, sssss....: " + productID);
		  */
		  
		  productData = e.nextSibling.value;
		  parsedData = JSON.parse(productData);
		  productID = parsedData.id;
		  productImage = parsedData.image;
		  productName = parsedData.name;
		  productPrice = parsedData.price;
		  
		  
		  // Create variable 'productsInCart' as an array. This array has arrays 'product = [productID, productImage, productName, productPrice]'
		  var productsInCart = [];
		  // Create array product
		  var product = [productID, productImage, productName, productPrice];
		  
		  // Check if there is variable called 'cart'
		  if(localStorage.cart){

		  // Retrieve data from localStorage and parse it to object
		  productsInCart = JSON.parse(localStorage.getItem("cart"));

			// Variable for checking if the product exist in the cart. Set up to 'false'.
			var productIsInCart = false;
			// Loop through the JSON object and check if the product already is in the cart by comparing 'productID'
			// Check the length of the array 'productsInCart'
			var prodInCartLength = productsInCart.length;
			// Create the variable 'i' for iterating throught loop
			var i;
			// Create the loop
			for(i = 0; i < prodInCartLength; i++){
				if(productsInCart[i][0] === productID){
					productIsInCart = true;
					break;
				}
			}
			
			// Check if the product is already in the cart.
			if(productIsInCart){
			// If the product is in the cart do not add the product to the cart and to localStorage JSON 'cart'
			alert("The selected product was already in the cart. To change the quantity go to check in.");
			}else{
			  // Add the product to cart
		      addProductElement(productID, productImage, productName, productPrice);
			
			  // Add the product to the localStorage 'cart'
			  // Add 'product[]' to the 'productInCart[]'
			  productsInCart.push(product);
		      // Convert 'productInCart[]' to JSON and add 'productInCart[]' as a value of locatStorage variable 'cart'
			  localStorage.setItem("cart", JSON.stringify(productsInCart));
			  alert("Product was added to the cart succesfully.");
			}
		  }else{
	        // Add the product to cart
		    addProductElement(productID, productImage, productName, productPrice);
			// Add 'product[]' to the 'productInCart[]'
			productsInCart.push(product);
		    // Create localStorege variable 'cart'. Convert 'productInCart[]' to JSON and add 'productInCart[]' as a value of locatStorage variable 'cart'
			localStorage.setItem("cart", JSON.stringify(productsInCart));
		  }
		} else {
		// Sorry! No Web Storage support..
		alert("Storage is not supported by this web browser.");
		}    
	  }
// <!-- End of addToCart function -->

// <!-- This function builds te cart on loading page if there is any product in a localStore 'cart' -->
// <!-- INVOKE THIS FUNCTION IN BODY TAB ONLOAD PAGE -->
	function orderTableOnLoad(){
		// Check if there is localStore = cart
		if(localStorage.cart){
			var productID, productImage, productName, productPrice;
			// Retrieve data from localStorage and pars it to object
			var productsInCart = [];
			productsInCart = JSON.parse(localStorage.getItem("cart"));
			
			// Loop through the JSON object and add product to the cart
			// Check the length of the array 'productsInCart'
			var prodInCartLength = productsInCart.length;
			// Create the variable 'i' for iterating throught loop
			var i;
			// Create the loop
			for(i = 0; i < prodInCartLength; i++){
				productID = productsInCart[i][0];
				productImage = productsInCart[i][1];
				productName = productsInCart[i][2];
				productPrice = productsInCart[i][3];
			// Add product to the cart	
				addProductElement(productID, productImage, productName, productPrice);
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