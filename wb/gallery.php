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
		<link rel="stylesheet" type="text/css" href="resources/externcss/gallery.css">
		<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Aclonica">
		<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Abhaya Libre">
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
	
		<div id="mySidenav" >
  			<a href="tos.php" id="termsofservice">Terms of Service</a>
		</div>
	
		<!-- Creating Gallery -->
		<div class="row">
  			<div class="column">
    				<img src="resources/gallery/G1.jpg" style="width:100%" onclick="openModeal();currentSlide(1)" class="hover-shadow cursor">
  			</div>
  			<div class="column">
    				<img src="resources/gallery/G2.jpg" style="width:100%" onclick="openModeal();currentSlide(2)" class="hover-shadow cursor">
  			</div>
  			<div class="column">
    				<img src="resources/gallery/G3.jpg" style="width:100%" onclick="openModeal();currentSlide(3)" class="hover-shadow cursor">
  			</div>
  			<div class="column">
    				<img src="resources/gallery/G4.jpg" style="width:100%" onclick="openModeal();currentSlide(4)" class="hover-shadow cursor">
  			</div>
		</div>

		<div id="myModeal" class="modeal">
  			<span class="close cursor" onclick="closeModeal()">&times;</span>
  			<div class="modeal-content">
				<div class="mySlides">
      					<div class="numbertext">1 / 4</div>
      						<img src="resources/gallery/G1_wide.jpg" style=" width:100%">
    					</div>

    				<div class="mySlides">
      					<div class="numbertext">2 / 4</div>
      						<img src="resources/gallery/G2_wide.jpg" style=" width:100%">
   					 </div>

    				<div class="mySlides">
      					<div class="numbertext">3 / 4</div>
      						<img src="resources/gallery/G3_wide.jpg" style=" width:100%">
    					</div>
    
    				<div class="mySlides">
      					<div class="numbertext">4 / 4</div>
      						<img src="resources/gallery/G4_wide.jpg" style=" width:100%">
    					</div>
    
    				<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    				<a class="next" onclick="plusSlides(1)">&#10095;</a>

    				<div class="caption-container">
      					<p id="caption"></p>
    				</div>


    				<div class="column">
      					<img class="demo cursor" src="resources/gallery/G1_wide.jpg" style=" width:100%" onclick="currentSlide(1)" alt="Demo">
    				</div>
    			
				<div class="column">
      					<img class="demo cursor" src="resources/gallery/G2_wide.jpg" style=" width:100%" onclick="currentSlide(2)" alt="Demo">
    				</div>
    
				<div class="column">
      					<img class="demo cursor" src="resources/gallery/G3_wide.jpg" style=" width:100%" onclick="currentSlide(3)" alt="Demo">
    				</div>
    
				<div class="column">
      					<img class="demo cursor" src="resources/gallery/G4_wide.jpg" style=" width:100%" onclick="currentSlide(4)" alt="Demo">
    				</div>
  			</div>
		</div>

		<script>
			function openModeal() 
			{
  				document.getElementById('myModeal').style.display = "block";
			}

			function closeModeal() 
			{
 				document.getElementById('myModeal').style.display = "none";
			}

			var slideIndex = 1;
			showSlides(slideIndex);

			function plusSlides(n) 
			{
  				showSlides(slideIndex += n);
			}

			function currentSlide(n) 
			{
  				showSlides(slideIndex = n);
			}

			function showSlides(n) 
			{
  				var i;
 				var slides = document.getElementsByClassName("mySlides");
  				var dots = document.getElementsByClassName("demo");
  				var captionText = document.getElementById("caption");
  				
				if (n > slides.length) {slideIndex = 1}
  				if (n < 1) {slideIndex = slides.length}
  				
				for (i = 0; i < slides.length; i++) 
				{
      					slides[i].style.display = "none";
  				}
  				for (i = 0; i < dots.length; i++) 
				{
      					dots[i].className = dots[i].className.replace(" active", "");
  				}
  				slides[slideIndex-1].style.display = "block";
  				dots[slideIndex-1].className += " active";
  				captionText.innerHTML = dots[slideIndex-1].alt;
			}
		</script>

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
