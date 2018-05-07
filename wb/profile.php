<!DOCTYPE html>

<?php

if(session_status() == PHP_SESSION_NONE)
	session_start();

if(!isset($_SESSION['username']))
{
	echo "<script>location.href='index.php'</script>";
	exit(0);
}

$usr = $_GET['usr'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "weddingbells";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if(!$conn)
	die(mysqli_connect_error());

$sql = "SELECT * FROM userbase WHERE username = '$usr'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0) 
	$row = mysqli_fetch_assoc($result);
else
{
	echo "An error occured.";
	exit(0);
}

$sql = "SELECT email FROM credentials WHERE username = '$usr'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0) 
	$row2 = mysqli_fetch_assoc($result);
else
{
	echo "An error occured.";
	exit(0);
}

mysqli_close($conn);

?>

<html>

	<head>

		<link rel="icon" href="resources/logos/favicon.png">

		<title><?php echo $row['fullname']; ?> | Wedding Bells</title>

		<link rel="stylesheet" type="text/css" href="resources/externcss/profile.css">

		<meta name="viewport" content="width=device-width, initial-scale=1">

	</head>

	<body>

		<h1 align="center"><?php echo $row['fullname']; ?></h1><hr width="200px"/><br/><br/><br/>

		<img src="resources/propics/<?php echo $usr; ?>.jpg" width="400"/>

		<div id="details">

			<?php

			$dob = new DateTime($row['dob']);
			$today = new DateTime();
			$age = date_diff($dob, $today);

	    	echo "<label>Age: </label><span>" . $age -> format("%y") . "</span><br/><br/>";
	    	echo "<label>Pincode: </label><span>" . $row["pincode"] . "</span><br/><br/>";
	    	echo "<label>Educational Qualifications: </label><span>" . $row["eduqual"] . "</span><br/><br/>";
	    	echo "<label>Profession: </label><span>" . $row["profession"] . "</span><br/><br/>";
	    	echo "<label>Job Description: </label><span>" . $row["jobdesc"] . "</span><br/><br/>";
	    	echo "<label>Salary (per annum): </label><span>" . $row["salary"] . " lakhs </span><br/><br/>";
	    	echo "<label>About me: </label><span>" . $row["message"] . "</span><br/><br/>";
	    		
			?>

		</div>

		<br/>

		<p style="margin-left: 450px">Interested? <a href="mailto:<?php echo $row2['email']; ?>">Click here</a> to drop me a mail.</p>

	</body>

</html>