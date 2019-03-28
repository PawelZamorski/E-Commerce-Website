<?php
// Start the session
session_start();
// Create a database connection
	require 'config/connect.php';
	

		
// Perform Database Query
		$result = mysqli_query($connection, "SELECT clientid, firstname FROM CLIENT WHERE LOGIN = '" . $_POST['email'] . "' AND PASSWORD = '" . $_POST['password'] . "'");

// Checking if there is any row where the login is equal to the login inserted in the registration form
		if(mysqli_num_rows($result) != 0){
			while($row = mysqli_fetch_array($result)){
				$_SESSION['userid'] = $row['clientid'];
				$_SESSION['username'] = $row['firstname'];
		//Use session to keep track if the process of login is sucessful 
				$_SESSION['loginSuccessful'] = 'successful';				
			}
			  header("location: " . $_COOKIE['currentURI'] . "");
		// Delete the cookie. Set the expiration date to one hour ago
			  setcookie("currentURI", "", time() - 3600);
		}else{
			header("location: loginForm.php");
		// User not logged in. Send info and come back to login form. Use session
				$_SESSION['loginSuccessful'] = 'failed';
		}
// Release returned data 
		mysqli_free_result($result);
?>