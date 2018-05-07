<!DOCTYPE html>

<?php
	if(session_status() == PHP_SESSION_NONE)
		session_start();
?> 

<html>

	<head>
		<link rel="icon" href="resources/logos/favicon.png">
		<title>Wedding Bells</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="resources/externcss/contact.css">
	</head>

	<body>

		<div class="quicklinks">
			<?php if(isset($_SESSION['username'])): ?>
				<span><?php echo "Hello, "; ?><a href="myprofile.php" target="_blank" id="profilelink"><?php echo $_SESSION['username'] . "!"; ?></a></span>
				<a href="logout.php"><b>Logout</b></a>
			<?php endif ?>
			<?php if(!isset($_SESSION['username'])): ?>
				<button onclick="document.getElementById('id01').style.display='block'"><b>Login</b></button>
			<?php endif ?>
		</div>	

		<div class="header">
			<img src="resources/logos/logo3.png" id="logo"/>
		</div>

		<div class="topnav">
  			<a href="home.php">Home</a>
  			<a href="about.php">About Us</a>
			<a href="gallery.php">Gallery</a>
			<a href="contact.php">Contact Us</a>
			<p id="clock">Your time: <span id="datetime"></span></p>
		</div>

		<div class="maincontent">
			<h1>IRRS Technologies Pvt. Ltd.</h1>
			<h3>Chowbaga Road, Kolkata - 700107</h3>
			<p>Email: irrs.tech@gmail.com</p>
		</div>

		<div id="mySidenav" >
  			<a href="tos.php" id="termsofservice">Terms of Service</a>
		</div>

		<div class="quicklinks" id="footerdiv">
			<p id="footer" align="center">&copy; 2018 <abbr title="IshaniRayRohitSingh">IRRS</abbr> Technologies. All Rights Reserved.</p>
		</div>

		<div id="id01" class="modal">
  			<span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
  			<form class="modal-content" action="login.php" method="post">
    			<div class="container">
      				<h1>Login</h1>
      				<hr/>

      				<b>Username</b><br/>
      				<input type="text" placeholder="Enter your weddingbells.in username" name="username" required>
      				<br/>

      				<b>Password</b><br/>
      				<input type="password" placeholder="Enter your weddingbells.in password" name="psw" id="togg2" required>
              		<a onclick="pwdTxtToggle2()" id="togg2lnk">Show password</a>
      				<br/>

        			<button type="submit">Login</button>

              		<p align="center" style="font-size:12px"><i>(If you've forgotten your password, please contact us.)</i></p>

        			<p align="center">Don't have an account? <a href="signup.php" target="_blank">Click here</a> to sign up.</p>
    			</div>
  			</form>
		</div>

		<script>
	      function pwdTxtToggle2() 
	      {
	        var x = document.getElementById("togg2");
	        if(x.type === "password")
	        { 
	            x.type = "text";
	            document.getElementById("togg2lnk").innerHTML = "Hide password";
	        }
	        else
	        {
	            x.type = "password";
	            document.getElementById("togg2lnk").innerHTML = "Show password";
	        }
	      }
	    </script>

		<script>
			var dt = new Date();
			document.getElementById("datetime").innerHTML = dt.toLocaleTimeString();
		</script>

	</body>

</html>
