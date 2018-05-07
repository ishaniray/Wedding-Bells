<!DOCTYPE html>

<?php

if(session_status() == PHP_SESSION_NONE)
	session_start();

if(!isset($_SESSION['username']))
{
	echo "<script>location.href='index.php'</script>";
	exit(0);
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "weddingbells";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) 
    die(mysqli_connect_error());

$usr = $_SESSION['username'];

$sql = "SELECT * from userbase where username = '$usr'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) == 0)
{
	echo "<script>location.href='regcompletion.php'</script>";
	exit(0);
}

$row = mysqli_fetch_assoc($result);
$gender = $row['gender'];
if($gender == 'F')
	$sql = "SELECT username, fullname from userbase where gender = 'M'";
else
	$sql = "SELECT username, fullname from userbase where gender = 'F'";
$result = mysqli_query($conn, $sql);

?>

<html>

	<head>
		<link rel="icon" href="resources/logos/favicon.png">
		<title>Wedding Bells</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="resources/externcss/home.css">
	</head>

	<body>

		<div class="quicklinks">
			<span><?php echo "Hello, "; ?><a href="myprofile.php" target="_blank" id="profilelink"><?php echo $_SESSION['username'] . "!"; ?></a></span>
			<a href="logout.php"><b>Logout</b></a>
		</div>	

		<div class="header">
			<img src="resources/logos/logo3.png" id="logo"/>
		</div>

		<div class="topnav">
  			<a href="home.php">Home</a>
  			<a href="about.php">About Us</a>
			<a href="gallery.php">Gallery</a>
			<a href="contact.php">Contact Us</a>
			<form id="searchpanel" method="get" action="home.php">
				<span id="searchlabel">Search: </span> 
				<input type="text" id="searchbox" name="searchterm" placeholder=" Name" />
				<button type="submit" id="searchbutton">Go</button>
			</form>
		</div>

		<div id="mySidenav" >
  			<a href="tos.php" id="termsofservice">Terms of Service</a>
		</div>

		<div class="heading"><b>Your prospective matches:</b></div>

		<div class="filters" align="center">
			<span class="filterlabel">Age: </span>
			<select id="agefilter">
				<option value="" selected>Any</option>
				<option value="le30">30 or less</option>
				<option value="31to40">31 - 40</option>
				<option value="40plus">40+</option>
			</select>
			<button onclick="filter()">Go</button>
		</div>

		<div id="prospects">
			<?php 
			if(isset($_GET['searchterm']))
			{
				$searchterm = $_GET['searchterm'];
				$sql = "SELECT username, fullname from userbase where fullname LIKE '%$searchterm%' AND gender <> '$gender'";
				$result = mysqli_query($conn, $sql);
			}
			?>
			<table align="center">
				<?php if(mysqli_num_rows($result) == 0): ?>
					<tr>
						<td><span class="nrf">No results found.</span></td>
					</tr>
				<?php endif; ?>
				<?php while($row = mysqli_fetch_assoc($result)): ?>
					<tr>
						<td><img src="resources/propics/<?php echo $row['username']; ?>.jpg" width="100px"></td>
						<td class="names"><a href="profile.php?usr=<?php echo $row['username']; ?>" target="_blank"><?php echo $row['fullname']; ?></td>
					</tr>
				<?php endwhile; ?>
			</table>
		</div>

		<div class="quicklinks" id="footerdiv">
			<p id="footer" align="center">&copy; 2018 <abbr title="IshaniRayRohitSingh">IRRS</abbr> Technologies. All Rights Reserved.</p>
		</div>


		<script>
			function filter()
			{
				var x = document.getElementById("agefilter").value;
				if(x == 'le30')
				{
					<?php
					$sql = "SELECT username, fullname from userbase where (DATEDIFF(CURRENT_DATE(), dob) / 365) < 31 AND gender <> '$gender'";
					$result = mysqli_query($conn, $sql);
					?>
					var newContent = "<table align=\"center\"><?php while($row = mysqli_fetch_assoc($result)): ?><tr><td><img src=\"resources/propics/<?php echo $row['username']; ?>.jpg\" width=\"100px\"></td><td class=\"names\"><a href=\"profile.php?usr=<?php echo $row['username']; ?>\" target=\"_blank\"><?php echo $row['fullname']; ?></td></tr><?php endwhile; ?></table>";
					document.getElementById("prospects").innerHTML = newContent;
				}
				else if(x == "31to40")
				{
					<?php
					$sql = "SELECT username, fullname from userbase where ((DATEDIFF(CURRENT_DATE(), dob) / 365) BETWEEN 31 AND 40) AND gender <> '$gender'";
					$result = mysqli_query($conn, $sql);
					?>
					var newContent = "<table align=\"center\"><?php while($row = mysqli_fetch_assoc($result)): ?><tr><td><img src=\"resources/propics/<?php echo $row['username']; ?>.jpg\" width=\"100px\"></td><td class=\"names\"><a href=\"profile.php?usr=<?php echo $row['username']; ?>\" target=\"_blank\"><?php echo $row['fullname']; ?></td></tr><?php endwhile; ?></table>";
					document.getElementById("prospects").innerHTML = newContent;					
				}
				else if(x == "40plus")
				{
					<?php
					$sql = "SELECT username, fullname from userbase where (DATEDIFF(CURRENT_DATE(), dob) / 365) > 40 AND gender <> '$gender'";
					$result = mysqli_query($conn, $sql);
					?>
					var newContent = "<table align=\"center\"><?php while($row = mysqli_fetch_assoc($result)): ?><tr><td><img src=\"resources/propics/<?php echo $row['username']; ?>.jpg\" width=\"100px\"></td><td class=\"names\"><a href=\"profile.php?usr=<?php echo $row['username']; ?>\" target=\"_blank\"><?php echo $row['fullname']; ?></td></tr><?php endwhile; ?></table>";
					document.getElementById("prospects").innerHTML = newContent;					
				}
				else
				{
					<?php
					$sql = "SELECT username, fullname from userbase where gender <> '$gender'";
					$result = mysqli_query($conn, $sql);
					?>
					var newContent = "<table align=\"center\"><?php while($row = mysqli_fetch_assoc($result)): ?><tr><td><img src=\"resources/propics/<?php echo $row['username']; ?>.jpg\" width=\"100px\"></td><td class=\"names\"><a href=\"profile.php?usr=<?php echo $row['username']; ?>\" target=\"_blank\"><?php echo $row['fullname']; ?></td></tr><?php endwhile; ?></table>";
					document.getElementById("prospects").innerHTML = newContent;					
				}
			}
		</script>

	</body>

</html>