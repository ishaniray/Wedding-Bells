<!DOCTYPE html>

<?php

if(session_status() == PHP_SESSION_NONE)
   session_start();

if(isset($_SESSION['username']))
{
  echo "<script>location.href='home.php'</script>";
  exit(0);
}

?>

<?php include("qsignupdbentry.php") ?>

<html>

	<head>
		<link rel="icon" href="resources/logos/favicon.png">

		<title>Wedding Bells</title>

		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" type="text/css" href="resources/externcss/index.css">

    <script>
          function validateForm()
          {
              var x = document.forms["qsuForm"]["email"].value;
              if(!validateEmail(x))
              {
                alert("Please enter a valid email.");
                return false;
              }

              x = document.forms["qsuForm"]["username"].value;
              if(hasWhitespace(x))
              {
                alert("Username cannot have whitespaces.");
                return false;
              }
              if(x.length < 4)
              {
                alert("Username must be at least 4 characters long.")
                return false;
              }

              x = document.forms["qsuForm"]["psw"].value;
              if(hasWhitespace(x))
              {
                alert("Password cannot have whitespaces.");
                return false;
              }             
              if(x.length < 6)
              {
                alert("Password must be at least 6 characters long.");
                return false;
              }
              if(!hasNumber(x))
              {
                alert("Password must contain one or more digits.");
                return false;
              }

              return true;
          }

          function validateEmail(x)
          {
              if(hasWhitespace(x))
                return false;
              var atPos = x.indexOf("@");  
              var ldotPos = x.lastIndexOf(".");  
              if(atPos < 1 || ldotPos < (atPos + 2) || (ldotPos + 2) > (x.length - 1))
                return false;
              else
                return true;
          }

          function hasNumber(x) 
          {
              return /\d+/.test(x);
          }

          function hasWhitespace(x)
          {
              return /\s+/.test(x);
          }
    </script>
	</head>

	<body onload="disclaimer()">

		<div class="quicklinks">
			<button onclick="document.getElementById('id01').style.display='block'"><b>Login</b></button>
		</div>	

		<div class="header">
			<img src="resources/logos/logo3.png" id="logo"/>
		</div>

		<div class="topnav">
  		<a href="index.php">Home</a>
  		<a href="about.php">About Us</a>
			<a href="gallery.php">Gallery</a>
			<a href="contact.php">Contact Us</a>
			<p id="clock">Your time: <span id="datetime"></span></p>
		</div>

		<div id="mySidenav" >
  			<a href="tos.php" id="termsofservice">Terms of Service</a>
		</div>

		<div class="row">
			<div class="column">
				<p id="hometext1">A new-age matrimonial site for working professionals.</p>
				<p id="hometext2">Let us help you find a partner who is every bit your equal.</p>
			</div>
			<div class="column">
				<form name="qsuForm" onsubmit="return validateForm()" action="index.php" method="post">
  					<div class="container">
    					<h1>Sign up!</h1>
    					<p>Please fill this form to quickly create an account.</p>
    					<hr/>

    					<b>Email</b><br/>
    					<div <?php if (isset($email_error)): ?> class="form_error" <?php endif ?> >
    						<input type="text" placeholder="eg. youremail@domain.com" name="email" value="<?php echo $email; ?>" required>
    						<?php if (isset($email_error)): ?>
    							<span><br/><?php echo $email_error; ?></span>
    						<?php endif ?>
    					</div>
    					<br/>

    					<b>Choose a username</b><br/>
    					<div <?php if (isset($username_error)): ?> class="form_error" <?php endif ?> >
    						<input type="text" name="username" placeholder="eg. your_name" value="<?php echo $username; ?>" required>
    						<?php if (isset($username_error)): ?>
    							<span><br/><?php echo $username_error; ?></span>
    						<?php endif ?>
    					</div>
    					<br/>

    					<b>Create a password</b><br/>
    					<input type="password" placeholder="Must contain one or more digits" name="psw" id="togg1" required>
              			<a onclick="pwdTxtToggle1()" id="togg1lnk">Show password</a>
    					<br/>

    					<p>By creating an account you agree to our <a href="tos.php">terms of service</a>.</p>

      					<button type="submit" id="but01" name="register">Sign Up</button>
  					</div>
				</form>
			</div>
		</div>

		<div class="visitorcounter" align="right">
			<?php
				$ip = $_SERVER['REMOTE_ADDR'];
				$conn = mysqli_connect("localhost", "root", "", "weddingbells");
				if(!$conn)
					exit(0);
				$sql = "SELECT * FROM visitors WHERE ip = '$ip'";
				$result = mysqli_query($conn, $sql);
				if(mysqli_num_rows($result) == 0)
				{
					$sql = "INSERT INTO visitors (ip) VALUES ('$ip')";
					mysqli_query($conn, $sql);
				}
				$sql = "SELECT COUNT(ip) FROM visitors";
				$result = mysqli_query($conn, $sql);
				$row = mysqli_fetch_array($result, MYSQLI_NUM);
				$count = $row[0];
				mysqli_close($conn);
			?>
			<p>Visitor count: <?php echo $count; ?></p>
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

		<?php if(!isset($_SESSION['visited'])): ?>
			<div id="id02" class="modal">
	  			<span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
	  			<form class="modal-content">
	    			<div class="container">
	      				<h1 align="center" style="color:red">Disclaimer</h1>
	      				<hr/>
	      				<p align="center"><b>This is a dummy site created strictly for educational purposes.<br/><br/>NOTHING in here is to be taken at face value.</b></p>
	      				<p align="center" style="font-size:12px"><i>(Please click the 'X' button to continue to the site.)</i></p>
                <p align="center" style="font-size:12px">(Note: 1. Site is not responsive, i.e., mobile-friendly. | 2. Viewport must at least be 1105px wide. | <br/> 3. Site needs JavaScript to run properly. | 4. We log your public IP address.)</p>
	    			</div>
	  			</form>
			</div>
		<?php $_SESSION['visited'] = true; ?>
		<?php endif ?>

		<script>
			var dt = new Date();
			document.getElementById("datetime").innerHTML = dt.toLocaleTimeString();
		</script>

		<script>
			function disclaimer()
			{
        		<?php if(!isset($_POST["register"])): ?>
				  	document.getElementById("id02").style.display="block";
        		<?php endif ?>
			}
		</script>

    <script>
      function pwdTxtToggle1() 
      {
        var x = document.getElementById("togg1");
        if(x.type === "password")
        { 
            x.type = "text";
            document.getElementById("togg1lnk").innerHTML = "Hide password";
        }
        else
        {
            x.type = "password";
            document.getElementById("togg1lnk").innerHTML = "Show password";
        }
      }
    </script>

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

	</body>

</html>
