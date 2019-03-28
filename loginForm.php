<?php
// Start the session
	session_start();
// Create a database connection
	require 'config/connect.php';
// Check  if the user is logged in
	if (!isset($_SESSION['username'])) {
  	$_SESSION['logStatus'] = "Log in";
	}else{
		$_SESSION['logStatus'] = "Log out";
	}
	
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
    <title>Login/Registration Form</title>
  </head>
  <body>

<?php
// Alert if login process was successful
/*  if(isset($_SESSION['loginSuccessful']) && $_SESSION['loginSuccessful'] == 'successful'){
	echo "<div class='container' style='margin-top: 50px;'>
			<div class='row'>
				<div class='col-sm-12'>
					<div class='alert alert-success alert-dismissible fade show' role='alert'>
						<strong>Login process successful!</strong> Go shopping or check out.
						<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
						<span aria-hidden='true'>&times;</span>
						</button>
					</div>
				</div>
			</div>
		</div>";
  }  
*/

//  Alert if login process was unsuccesful
  if(isset($_SESSION['loginSuccessful']) && $_SESSION['loginSuccessful'] == 'failed'){
	 echo "<div class='container' style='margin-top: 50px;'>
			<div class='row'>
				<div class='col-sm-12'>
					<div class='alert alert-warning alert-dismissible fade show' role='alert'>
						<strong>Login process unsuccessful!</strong> Try again.
						<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
						<span aria-hidden='true'>&times;</span>
						</button>
					</div>
				</div>
			</div>
		</div>";
  }
?>
	
	<!-- Login form -->
	<div class="container" style="margin-top: 50px;">
		<div class="row">
			<div class="col-sm-3">
				<a class="btn btn-block btn-secondary" href="index.php" role="button">CONTINUE SHOPPING</a>
			</div>
			<div class="col-sm-3 cursor myButton activeButton" id="loginButton" onclick="activateForm(this, 'login')">
				<h1>LOGIN</h1>
			</div>
			<div class="col-sm-3 cursor myButton" id="registerButton" onclick="activateForm(this, 'register')">
				<h1>REGISTER</h1>
			</div>
			<div class="col-sm-3">
			</div>
		</div>
	</div>
	<div class="container">	
		<div class="row" id="loginForm">
			<div class="col-sm-3">
			</div>
			<div class="col-sm-6">
				<hr>
				<h4 class="text-center">Login to the website</h4>
				<hr>
				<form id="submitLoginForm" action="server.php" method="post">
					<div class="form-group">
					  <label for="inputEmail">Email</label>
			<!-- Type 'email' is changed on 'text' in order to perform custom email address validation -->
					  <input type="text" class="form-control required" id="inputEmail" placeholder="Email" onfocus="removeWorning(this)" onblur="validateEmail(this)" name="email"><span id="mySpan" style="color: #ff6666; font-size: 80%;"></span>
					</div>
					<div class="form-group">
					  <label for="inputPassword">Password</label>
					  <input type="password" class="form-control required" id="inputPassword" placeholder="Password" onblur="emptyField(this)" onfocus="removeWorning(this)" name="password">
					</div>				
				    <div class="form-group">
					  <div class="form-check">
					    <input class="form-check-input" type="checkbox" id="gridCheck">
					    <label class="form-check-label" for="gridCheck">
						  Confirm to terms and conditions
					    </label>
					  </div>
				    </div>
				  <button type="button" class="btn btn-block btn-primary" onclick="submitLogin()">LOG IN</button>
				</form>
				<hr>
			</div>
			<div class="col-sm-3">
			</div>
		</div>
	</div>
	<!-- End of login form -->
	<!-- Registration form -->
	<div class="container">
		<div class="row" id="registrationForm">
			<div class="col-sm-3">
			</div>
			<div class="col-sm-6">
				<hr>
				<h4 class="text-center">Register to the website</h4>
				<hr>
			<div class="col-sm-3">
			</div>
				<form action="server.php" method="post">
					<div class="form-group">
					  <label for="inputFirstName">First Name</label>
					  <input type="text" class="form-control" id="inputFirstName" placeholder="First Name" onblur="emptyField(this)" onfocus="removeWorning(this)" name="firstName">
					  <label for="inputLastName">Last Name</label>
					  <input type="text" class="form-control" id="inputLastName" placeholder="Last Name" onblur="emptyField(this)" onfocus="removeWorning(this)" name="lastName">
					  <label for="inputAddress">Address</label>
					  <input type="text" class="form-control" id="inputAddress" placeholder="Address" name="address">
					  <label for="inputCity">City</label>
					  <input type="text" class="form-control" id="inputCity" placeholder="City" name="city">
					  <label for="inputCounty">County</label>
					  <input type="text" class="form-control" id="inputCounty" placeholder="County" name="county">
					  <label for="inputEmailRegister">Email</label>
					  <input type="text" class="form-control" id="inputEmailRegister" placeholder="Email" onfocus="removeWorning(this)" onblur="validateEmail(this)" name="email"><span id="mySpan" style="color: #ff6666; font-size: 80%;"></span>
					</div>
					<div class="form-group">
					  <label for="inputPassword">Password</label>
					  <input type="password" class="form-control" id="inputPasswordRegister" placeholder="PasswordRegister" onblur="emptyField(this)" onfocus="removeWorning(this)" name="password">
					</div>
					<div class="form-group">
					  <label for="inputPasswordRepeatRegister">Repeate Password</label>
					  <input type="password" class="form-control" id="inputPasswordRepeatRegister" placeholder="Repeat Password" onblur="incorrectRepetition(this)" onfocus="removeWorning(this)"><span id="mySpan" style="color: #ff6666; font-size: 80%;"></span>
					</div>						
				    <div class="form-group">
					  <div class="form-check">
					    <input class="form-check-input" type="checkbox" id="gridCheckRegister">
					    <label class="form-check-label" for="gridCheckRegister">
						  Confirm to terms and conditions
					    </label>
					  </div>
				    </div>
				  <button type="submit" class="btn btn-block btn-primary">REGISTER</button>
				</form>
				<hr>
			</div>
			<div class="col-sm-3">
			</div>
		</div>
	</div>
	<!-- End of registration form -->
	<!-- Beginning of footer -->
<?php
		// Include 'footer' template
		require 'template/footer.php';	
?>
	<!-- End of footer -->

	<script>
	
	
	// Function 'activateForm' changes the form between login and register
	function activateForm(element, form){
		// Check the condition if the button has already active and the requested form is displayed
		if(!element.classList.contains("activeButton")){
			if(form === "register"){
				// Change the form
				document.getElementById("registrationForm").style.display = "flex";
				document.getElementById("loginForm").style.display = "none";
				// Change the active button
				document.getElementById("loginButton").classList.remove("activeButton");
				element.classList.add("activeButton");
			}else{
				document.getElementById("registrationForm").style.display = "none";
				document.getElementById("loginForm").style.display = "flex";
				// Change the active button
				document.getElementById("registerButton").classList.remove("activeButton");
				element.classList.add("activeButton");
			}
		}
	}	
	
	// VALIDATE LOGIN FORM

		// This function puts 'warning' to the input when it is empty
 		function emptyField(element){
			var s = element.value;
			if(s === ""){
				element.setAttribute("placeholder", "*Required field");
				element.style.backgroundColor="#ff6666";
			}
		}
		
		// This function removes 'warning' from input
		function removeWorning(element){
			element.style.backgroundColor="white";
			element.removeAttribute("placeholder");
		}
		
		
		// Function'validateEmail(element)' validates email address
		function validateEmail(element){					
			var s = element.value;
			// Check if there is any input. If not invoke function emptyField(element).
			if(s === ""){
				// This funcion changes the color of input
				emptyField(element);
				// Set the 'warning' to empty. 
				element.nextSibling.innerHTML = "";
			// Check if the User inserted '@'
			}else if(!s.includes("@")){
				element.nextSibling.innerHTML = "&nbsp;*Invalid emial address. Add @ to the email address.";
				element.nextSibling.style.color = "#ff6666";
			// Check if the email stars or ends with '@'
			}else if(s.endsWith("@") || s.startsWith("@")){
				element.nextSibling.innerHTML = "&nbsp;*The following symbol @ can not be at the beginning or end.";
				element.nextSibling.style.color = "#ff6666";
			// Check if the email ends with '.'
			}else if(s.endsWith(".")){
				element.nextSibling.innerHTML = "&nbsp;*Incorrect place for '.' symbol.";
				element.nextSibling.style.color = "#ff6666";
			// Show that the email is valid
			}else{
				element.nextSibling.innerHTML = "*Validated field";
				element.nextSibling.style.color = "#339933";
			}	
		}

		// This function checks if there is no empty required input before sending form to the server
		function submitLogin(){
			// Get all elements with class 'required' from form
			var required = document.getElementById("submitLoginForm").getElementsByClassName("required");
			var i = 0;
			var counter = 0;
			//Loop through elements and check the condition. Change 'counter' if there is any empty field.
			while(i < required.length){
				if(required[i].value === ""){
					emptyField(required[i]);
					counter++;
				}
				i++;
			}
			// Check if there is any empty input. If there is not, submit
			if(counter == 0){
				document.getElementById("submitLoginForm").submit();
			}
		}
		
		
		
	// VALIDATION FOR 'REGISTER' FORM
		// Function 'incorectRepetition' checkes if the passowrd was correctly repeted in the registration form
		function incorrectRepetition(element){
			var s = element.value;
			var password = document.getElementById("inputPasswordRegister").value;			
			if(s === ""){
				emptyField(element);
				element.nextSibling.innerHTML = "";
			}else if(s !== password){
				element.nextSibling.innerHTML = "*Incorrectly repeated password";
			}else{
				element.nextSibling.innerHTML = "*Validated field";
				element.nextSibling.style.color = "#339933";
			}
			
		}
	</script>
	
	
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  </body>
</html>