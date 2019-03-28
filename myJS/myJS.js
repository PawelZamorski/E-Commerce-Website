
// <!-- This function builds HTML and adds product to the cart	
	  function addProductElement(productID, productImage, productName, productPrice){
		  // Add <div class='w-100'>
		  var cartProductDiv = document.createElement("div");
		  cartProductDiv.className = "w-100";
		  
		  // Add div to the cart
		  var element = document.getElementById("cartForm");
		  element.insertBefore(cartProductDiv, element.childNodes[0]);
		  // Add <a href="productDetail.php?productDetailID=productID>. Link wraps other elements
		  var cartProductLink = document.createElement("a");
		  cartProductLink.className = "dropdown-item";
		  cartProductLink.setAttribute("href", "productDetail.php?productDetailID=" + productID);
		  cartProductLink.setAttribute("style", "display: inline-block;");
		  
		  cartProductDiv.appendChild(cartProductLink);
		  // Add <img> element as a child of <a> element
		  var cartProductImage = document.createElement("img");
		  cartProductImage.setAttribute("class", "img-fluid");
		  cartProductImage.setAttribute("src", productImage);
		  cartProductImage.setAttribute("alt", productName);
		  cartProductImage.setAttribute("style", "display: inline-block;");
		  cartProductImage.setAttribute("width", "40%");
		  
		  cartProductLink.appendChild(cartProductImage);
		  // Add <div> element a child of <a> element. It is a wraper for name and price
		  var cartProductDivDescription = document.createElement("div");
		  cartProductDivDescription.setAttribute("style", "display: inline-block;  font-size: 12px; vertical-align:top; white-space: normal; width: 60%; text-transform: uppercase;");
		  
		  cartProductLink.appendChild(cartProductDivDescription);
		  
		  // Add <span> element as a child of cartProductDivDescription containing the name of the product
		  var cartProductSpanName = document.createElement("span");
		  
		  cartProductDivDescription.appendChild(cartProductSpanName);
		  
		  //Add <b> element as a child of span element
		  var cartProductBoldName = document.createElement("b");
		  
		  cartProductSpanName.appendChild(cartProductBoldName);
		  
		  // Add 'name' of the product as a child of <b> element
		  var cartProductName = document.createTextNode(productName);
		  
		  cartProductBoldName.appendChild(cartProductName);
		  
		  // Add <br> element as a child of a div
		  var cartProductBreak = document.createElement("br");
		  
		  cartProductDivDescription.appendChild(cartProductBreak);
		  // Add <span> element as a child of cartProductDivDescription containing the price of the product
		  var cartProductSpanPrice = document.createElement("span");
		  
		  cartProductDivDescription.appendChild(cartProductSpanPrice);
		  
		  //Add <b> element as a child of span element
		  var cartProductBoldPrice = document.createElement("b");
		  
		  cartProductSpanPrice.appendChild(cartProductBoldPrice);
		  
		  // Add 'name' of the product as a child of <b> element
		  var cartProductPrice = document.createTextNode(productPrice);
		  
		  cartProductBoldPrice.appendChild(cartProductPrice);
		  
		  // Add <input> element for storing the ID of product
		  var cartProductID = document.createElement("input");
		  cartProductID.setAttribute("type", "hidden");
		  cartProductID.setAttribute("name", "orderProcess[]");
		  cartProductID.setAttribute("value", productID);
		  
		  cartProductDivDescription.appendChild(cartProductID);
	  }
	
// <!-- This function adds product to the cart -->	
	  function addToCart(e){
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
	function cartOnLoad(){
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
	
	
// <!-- This function removes all items from the cart -->
	function removeAllItems(){
		alert("remove button is working or not working");
		if(localStorage.cart){
			localStorage.removeItem("cart");			
		}		
	}
	
