	// This function logins/loguots to/from the page
		function loginLogout(e){
		// Take the status of the log in/log out button.
		// If the innerHTML of the <button> is "Log out", after clicking the button the log out process starts
		// If the innerHTML of the <button> is "Log in", after clicking the button the log in process starts
		  logStatus = e.innerHTML;
		
		// Log in/log out proccess uses <form id="loginLogoutForm">.
		  var formElement = document.getElementById("loginLogoutForm");

		// For log in process action=loginForm.php, where the proccess continue. If the login is successful it redirects to the page from where the log in process started (variable "currentURI").
		// For log out process action="currentURI". It means it redirect directly to the current page.
		// Set up variable currentURI and store it in cookies.
		  var currentURI = location.href;
				
		// Log out from the website	
		  if(logStatus === "Log out"){
			
			formElement.setAttribute("action", currentURI);
			
			// Append <input> element as a child node
			var inputElement = document.createElement("input");
			inputElement.setAttribute("type", "hidden");
			inputElement.setAttribute("name", "logoutUser");
			inputElement.setAttribute("value", "true");
			formElement.appendChild(inputElement);
			// Subbmit form
			formElement.submit();
			
		// Set the cookie for keeping track of logout process. This cookie is used for pop out with info about the log out process.
		  document.cookie = "logoutUserCookie=true";		
			 
		// Log in to the website	  
		  }else if(logStatus === "Log in"){
			// Set the "action"=loginForm.php -> redirect to the login form page
			formElement.setAttribute("action", "loginForm.php");
			// Set "currentURI" as a cookie
			document.cookie = "currentURI=" + currentURI;
			// Submit the form
			formElement.submit();
		  }
		}
