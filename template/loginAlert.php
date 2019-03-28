<?php
// Alert if login process was successful
  if(isset($_SESSION['loginSuccessful']) && $_SESSION['loginSuccessful'] == 'successful'){
	echo "<div class='container'>
			<div class='row'>
				<div class='col-sm-12'>
					<div class='alert alert-success alert-dismissible fade show' role='alert' style='margin-top: 20px'>
						<strong>Login process successful!</strong> Go shopping or check out.
						<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
						<span aria-hidden='true'>&times;</span>
						</button>
					</div>
				</div>
			</div>
		</div>";
// Unset $_SESSION['loginSuccessful'] to prevent from repeting the alert, when ie refreshing or comming back to the page
	unset($_SESSION['loginSuccessful']);
  }

// Alert if logout process was successful
  if(isset($_COOKIE['logoutUserCookie']) && $_COOKIE['logoutUserCookie'] == 'true'){
	echo "<div class='container'>
			<div class='row'>
				<div class='col-sm-12'>
					<div class='alert alert-warning alert-dismissible fade show' role='alert' style='margin-top: 20px'>
						<strong>You have been log out from the website.</strong>
						<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
						<span aria-hidden='true'>&times;</span>
						</button>
					</div>
				</div>
			</div>
		</div>";
// Unset $_POST['logoutUser'] to prevent from repeting the alert, when ie refreshing or comming back to the page
	setcookie("logoutUserCookie", "", time() - 3600);
	
// Unset $_SESSION['username']
	unset($_SESSION['username']);
  }  
?>
