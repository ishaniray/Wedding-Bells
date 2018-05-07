<!DOCTYPE html>

<?php include("editprofiledbentry.php") ?>

<html>
	<head>
			<link rel="icon" href="resources/logos/favicon.png">
			
			<title>Wedding Bells - Edit Profile</title>

			<link rel="stylesheet" type="text/css" href="resources/externcss/editprofile.css">

			<meta name="viewport" content="width=device-width, initial-scale=1">

		   	<script>
		   	  function validateForm()
		   	  {
		   	  		var x = document.forms["epForm"]["email"].value;
		   	  		if(!validateEmail(x))
		   	  		{
		   	  			alert("Please enter a valid email.");
		   	  			return false;
		   	  		}

		   	  		x = document.forms["epForm"]["psw"].value;
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

		   	  		var y = document.forms["epForm"]["psw2"].value;
		   	  		if(x != y)
		   	  		{
		   	  			alert("Password fields do not match. Try again.");
		   	  			return false;
		   	  		}

		   	  		x = document.forms["epForm"]["fullname"].value;
		   	  		if(hasNumber(x))
		   	  		{
		   	  			alert("Name cannot contain digits.");
		   	  			return false;
		   	  		}

		   	  		x = document.forms["epForm"]["pincode"].value;
		   	  		if(x < 700001 || x > 700162)
		   	  		{
		   	  			alert("Please enter a valid pincode.");
		   	  			return false;
		   	  		}

		   	  		x = document.forms["epForm"]["salary"].value;
		   	  		if(x < 2 || x > 99)
		   	  		{
		   	  			alert("Salary entered is not between 2 and 99 lakhs.");
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
	<body>
			<div id="navbar">
  				<a href="home.php">Home</a>
  				<a href="about.php">About Us</a>
				<a href="gallery.php">Gallery</a>
				<a href="contact.php">Contact Us</a>
			</div>

			<form name="epForm" action="editprofile.php" onsubmit="return validateForm()" method="post" enctype="multipart/form-data">
					<div class="container">
						<h1>Edit your profile</h1>
						<hr/>

						<b>Email</b><br/>
						<div <?php if (isset($email_error)): ?> class="form_error" <?php endif ?> >
							<input type="text" value="<?php echo $em; ?>" name="email" value="<?php echo $em; ?>" required>
							<?php if (isset($email_error)): ?>
    							<span><br/><?php echo $email_error; ?></span>
    						<?php endif ?>
    					</div>
						<br/>

						<b>Password</b><br/>
						<a onclick="pwdTxtToggle()" id="togglnk">Show password</a>
						<input type="password" value="<?php echo $pwd; ?>" name="psw" id="togg" required>
						<br/>

						<b>Retype password</b><br/>
						<input type="password" value="<?php echo $pwd; ?>" name="psw2" required>
						<br/>

						<b>Full name</b><br/>
						<input type="text" value="<?php echo $fn; ?>" name="fullname" required>
						<br/>

						<b>Your pincode</b><br/>
						<input type="number" name="pincode" value="<?php echo $pc; ?>">
						<br/>

						<b>Educational qualifications</b><br/>
						<input type="text" name="eduqual" value="<?php echo $eq; ?>">
						<br/>

						<b>Profession </b>
						<select name="profession">
							<option value="" disabled selected>Select your profession</option>
							<option value="Doctor" <?php if($pr == 'Doctor'): ?> selected <?php endif; ?>>Doctor</option>
							<option value="Lawyer" <?php if($pr == 'Lawyer'): ?> selected <?php endif; ?>>Lawyer</option>
							<option value="Engineer" <?php if($pr == 'Engineer'): ?> selected <?php endif; ?>>Engineer</option>
							<option value="Artist" <?php if($pr == 'Artist'): ?> selected <?php endif; ?>>Artist</option>
							<option value="Musician" <?php if($pr == 'Musician'): ?> selected <?php endif; ?>>Musician</option>
							<option value="Photographer" <?php if($pr == 'Photographer'): ?> selected <?php endif; ?>>Photographer</option>
							<option value="Writer" <?php if($pr == 'Writer'): ?> selected <?php endif; ?>>Writer</option>
							<option value="Law Enforcement Official" <?php if($pr == 'Law Enforcement Official'): ?> selected <?php endif; ?>>Law Enforcement Official</option>
							<option value="Accountant" <?php if($pr == 'Accountant'): ?> selected <?php endif; ?>>Accountant</option>
							<option value="Educator" <?php if($pr == 'Educator'): ?> selected <?php endif; ?>>Educator</option>
							<option value="Entrepreneur" <?php if($pr == 'Entrepreneur'): ?> selected <?php endif; ?>>Entrepreneur</option>
							<option value="Business Analyst" <?php if($pr == 'Business Analyst'): ?> selected <?php endif; ?>>Business Analyst</option>
							<option value="Other" <?php if($pr == 'Other'): ?> selected <?php endif; ?>>Other</option>
						</select>
						<br/>

						<b>Job description</b><br/>
						<input type="text" name="jobdesc" value="<?php echo $jd; ?>">
						<br/>

						<b>Salary (in lakhs per annum)</b><br/>
						<input type="number" step="any" name="salary" value="<?php echo $sal; ?>">
						<br/>

						<b>Bio</b><br/>
						<input type="text" value="<?php echo $bio; ?>" name="bio">
						<br/>

						<b>Change your photo (optional; .jpg file only)</b><br/><br/>
						<input type="file" name="propic">

	  					<button type="submit" name="edit">Submit</button>
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