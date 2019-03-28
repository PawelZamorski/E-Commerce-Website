

<?php
// Start the session
	session_start();
echo "username from php: " . $_SESSION['username'];
	if(isset($_SESSION['username'])){
		unset($_SESSION['username']); 
		echo "babla";
	}
	
echo "other text";
?>