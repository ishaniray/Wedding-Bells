<!DOCTYPE html>

<?php

if(session_status() == PHP_SESSION_NONE)
	session_start();

if(!isset($_SESSION['username']))
{
	echo "<script>location.href='index.php'</script>";
	exit(0);
}

?>

<html>
	<head>
			<link rel="icon" href="resources/logos/favicon.png">
			
			<title>Complete Registration - WB</title>

			<link rel="stylesheet" type="text/css" href="resources/externcss/regcompletion.css">

			<meta name="viewport" content="width=device-width, initial-scale=1">

			<script>
		   	  function validateForm()
		   	  {
		   	  		var x = document.forms["rcForm"]["fullname"].value;
		   	  		if(hasNumber(x))
		   	  		{
		   	  			alert("Name cannot contain digits.");
		   	  			return false;
		   	  		}

		   	  		var gender = document.forms["rcForm"]["gender"].value;
		   	  		var dob = document.forms["rcForm"]["dob"].value;
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

		   	  		x = document.forms["rcForm"]["pincode"].value;
		   	  		if(x < 700001 || x > 700162)
		   	  		{
		   	  			alert("Please enter a valid pincode.");
		   	  			return false;
		   	  		}

		   	  		x = document.forms["rcForm"]["salary"].value;
		   	  		if(x < 2 || x > 99)
		   	  		{
		   	  			alert("Salary entered is not within range.");
		   	  			return false;
		   	  		}

		   	  		return true;
		   	  }

		   	  function hasNumber(x) 
		   	  {
  					return /\d+/.test(x);
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
  				<a href="logout.php">Logout</a>
  				<a href="deleteaccount.php">Delete Account</a>
			</div>

			<form name="rcForm" onsubmit="return validateForm()" action="regcompdbentry.php" method="post" enctype="multipart/form-data">
					<div class="container">
						<h1>Complete your registration</h1>
						<p><i>We need a few more details from you.</i></p>
						<hr/>

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

						<p align="center">By furnishing above details, you agree to our <a href="tos.php">terms of service</a>.</p>

	  					<button type="submit">Submit</button>
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
			</script>
	</body>
</html>