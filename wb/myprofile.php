<!DOCTYPE html>

<?php

if(session_status() == PHP_SESSION_NONE)
	session_start();

if(!isset($_SESSION['username']))
{
	echo "<script>location.href='index.php'</script>";
	exit(0);
}

$usr = $_SESSION['username'];

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

		<link rel="stylesheet" type="text/css" href="resources/externcss/myprofile.css">

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

			echo "<label>Email: </label><span>" . $row2['email'] . "</span><br/><br/>";
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

		<p style="margin-left: 450px"><a href="editprofile.php" target="_blank">Edit profile</a> <button onclick="document.getElementById('deletemodal').style.display='block'" style="margin-left: 15px; cursor: pointer;">Delete account</button></p>

		<div id="deletemodal" class="modal">
  			<span onclick="document.getElementById('deletemodal').style.display='none'" class="close" title="Close Modal">&times;</span>
  			<form class="modal-content">
    			<div class="container">
      				<h1 align="center" style="color:red">Are you sure?</h1>
      				<p align="center"><i>(This action is irreversible.)</i></p>
      				<a style="margin-left: 195px;" href="deleteaccount.php">Yes</a>
      				<button style="margin-left: 50px;" onclick="document.getElementById('deletemodal').style.display='none'">No</button>
    			</div>
  			</form>
		</div>

	</body>

</html>