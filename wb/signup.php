<!DOCTYPE html>

<?php include("signupdbentry.php") ?>

<html>
	<head>
			<link rel="icon" href="resources/logos/favicon.png">
			
			<title>Wedding Bells - Sign Up</title>

			<link rel="stylesheet" type="text/css" href="resources/externcss/signup.css">

			<meta name="viewport" content="width=device-width, initial-scale=1">

		   	<script>
		   	  function validateForm()
		   	  {
		   	  		var x = document.forms["fsuForm"]["email"].value;
		   	  		if(!validateEmail(x))
		   	  		{
		   	  			alert("Please enter a valid email.");
		   	  			return false;
		   	  		}

		   	  		x = document.forms["fsuForm"]["username"].value;
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

		   	  		x = document.forms["fsuForm"]["psw"].value;
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

		   	  		var y = document.forms["fsuForm"]["psw2"].value;
		   	  		if(x != y)
		   	  		{
		   	  			alert("Password fields do not match. Try again.");
		   	  			return false;
		   	  		}

		   	  		x = document.forms["fsuForm"]["fullname"].value;
		   	  		if(hasNumber(x))
		   	  		{
		   	  			alert("Name cannot contain digits.");
		   	  			return false;
		   	  		}

		   	  		var gender = document.forms["fsuForm"]["gender"].value;
		   	  		var dob = document.forms["fsuForm"]["dob"].value;
		   	  		var now = new Date();
        			var birthdate = dob.split("-");
        			var born = new Date(birthdate[0], birthdate[1] - 1, birthdate[2]);
        			var age = getAge(born, now);
        			
        			if(gender == 'M' && age < 21)
        			{
        				alert("You need to be at least 21 years of age to register.");
        				return false;
        			}
        			if(gender == 'F' && age < 18)
        			{
        				alert("You need to be at least 18 years of age to register.");
        				return false;
        			}

		   	  		x = document.forms["fsuForm"]["pincode"].value;
		   	  		if(x < 700001 || x > 700162)
		   	  		{
		   	  			alert("Please enter a valid pincode.");
		   	  			return false;
		   	  		}

		   	  		x = document.forms["fsuForm"]["salary"].value;
		   	  		if(x < 2 || x > 99)
		   	  		{
		   	  			alert("Salary entered is not within range.");
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

		   	  function getAge(born, now) 
		   	  {
      				var birthday = new Date(now.getFullYear(), born.getMonth(), born.getDate());
      				if (now >= birthday) 
        				return now.getFullYear() - born.getFullYear();
      				else
        				return now.getFullYear() - born.getFullYear() - 1;
    		  }
    	  	</script>
	</head>
	<body>
			
			<div id="navbar">
  				<a href="index.php">Home</a>
  				<a href="about.php">About Us</a>
				<a href="gallery.php">Gallery</a>
				<a href="contact.php">Contact Us</a>
			</div>

			<form name="fsuForm" action="signup.php" onsubmit="return validateForm()" method="post" enctype="multipart/form-data">
					<div class="container">
						<h1>Join Wedding Bells</h1>
						<p><i>Please fill this form to get started.</i></p>
						<hr/>

						<b>Email</b><br/>
						<div <?php if (isset($email_error)): ?> class="form_error" <?php endif ?> >
							<input type="text" placeholder="eg. youremail@domain.com" name="email" value="<?php echo $em; ?>" required>
							<?php if (isset($email_error)): ?>
    							<span><br/><?php echo $email_error; ?></span>
    						<?php endif ?>
    					</div>
						<br/>

						<b>Choose a username</b><br/>
						<div <?php if (isset($username_error)): ?> class="form_error" <?php endif ?> >
							<input type="text" name="username" placeholder="eg. your_name" value="<?php echo $usr; ?>" required>
							<?php if (isset($username_error)): ?>
    							<span><br/><?php echo $username_error; ?></span>
    						<?php endif ?>
    					</div>
						<br/>

						<b>Create a password</b><br/>
						<a onclick="pwdTxtToggle()" id="togglnk">Show password</a>
						<input type="password" placeholder="6 or more characters, including one or more digits" name="psw" id="togg" required>
						<br/>

						<b>Retype password</b><br/>
						<input type="password" placeholder="Retype the password you've typed above" name="psw2" required>
						<br/>

						<b>Full name</b><br/>
						<input type="text" placeholder="Your full name" name="fullname" required>
						<br/>

						<b>Gender</b><br/>
						<input type="radio" name="gender" value="M" checked> Male 
  						<input type="radio" name="gender" value="F"> Female 
  						<br/><br/>

						<b>Date of Birth</b><br/>
						<input type="date" name="dob">
						<br/>

						<b>Your pincode</b><br/>
						<input type="number" name="pincode" placeholder="Must be a local (Kolkata) pincode">
						<br/>

						<b>Educational qualifications</b><br/>
						<input type="text" name="eduqual" placeholder="Your degrees">
						<br/>

						<b>Profession </b>
						<select name="profession">
							<option value="" disabled selected>Select your profession</option>
							<option value="Doctor">Doctor</option>
							<option value="Lawyer">Lawyer</option>
							<option value="Engineer">Engineer</option>
							<option value="Artist">Artist</option>
							<option value="Musician">Musician</option>
							<option value="Photographer">Photographer</option>
							<option value="Writer">Writer</option>
							<option value="Law Enforcement Official">Law Enforcement Official</option>
							<option value="Accountant">Accountant</option>
							<option value="Educator">Educator</option>
							<option value="Entrepreneur">Entrepreneur</option>
							<option value="Business Analyst">Business Analyst</option>
							<option value="Other">Other</option>
						</select>
						<br/>

						<b>Job description</b><br/>
						<input type="text" name="jobdesc" placeholder="Describe your current job">
						<br/>

						<b>Salary (in lakhs per annum)</b><br/>
						<input type="number" step="any" name="salary" placeholder="INR (2L <= your salary < 100L)">
						<br/>

						<b>Bio</b><br/>
						<textarea rows="4" cols="110" placeholder="A few lines about yourself" name="bio"></textarea>
						<br/>

						<b>Upload your photo (.jpg file only)</b><br/><br/>
						<input type="file" name="propic">

						<p align="center">By creating an account you agree to our <a href="tos.php">terms of service</a>.</p>

	  					<button type="submit" name="register">Sign Up</button>
					</div>
			</form>

			<div class="quicklinks">
						<p id="footer" align="center">&copy; 2018 <abbr title="IshaniRayRohitSingh">IRRS</abbr> Technologies. All Rights Reserved.</p>
			</div>

			<script>
				/* When the user scrolls down 20px from the top of the document, slide down the navbar */
				window.onscroll = function() {scrollFunction()};

				function scrollFunction() 
				{
   					if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) 
					{
        						document.getElementById("navbar").style.top = "0";
    					} 
					else 
					{
        						document.getElementById("navbar").style.top = "-50px";
    					}
				}

		      function pwdTxtToggle() 
		      {
		        var x = document.getElementById("togg");
		        if(x.type === "password")
		        { 
		            x.type = "text";
		            document.getElementById("togglnk").innerHTML = "Hide password";
		        }
		        else
		        {
		            x.type = "password";
		            document.getElementById("togglnk").innerHTML = "Show password";
		        }
		      }
		   </script>
	</body>
</html>