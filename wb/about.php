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
		<link rel="stylesheet" type="text/css" href="resources/externcss/about.css">
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
			<h1>Our Vision</h1>
			<p>We at <b>IRRS Technologies</b> believe that choosing a life-partner based on cast, creed, ethnicity, age-difference, inheritance, et al. is a thing of the past.<br/><br/>The only thing that should matter in this day and age is finding a partner who is as educated, open-minded, financially-independent, and established in life as you are. A marriage is meant to be among equals, after all!<br/><br/>If you come from the same school of thought as we do, and are looking for someone to share life's adventures with - someone who will be for <i>keeps</i> - you've landed at the perfect place. With a <b>weddingbells.in</b> account, you might just find your match!<br/><br/>We value your privacy, therefore, we have devised a model wherein all initial communication takes place via email.<br/><br/>If you're wondering about the cost... <b>Wedding Bells</b> is free, and always will be. :)<br/><br/><i>- Ray & Singh</i><br/><b>Founders, weddingbells.in</b></p>
		</div>

		<div id="mySidenav" >
  			<a href="tos.php" id="termsofservice">Terms of Service</a>
		</div>

		<div class="quicklinks">
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
