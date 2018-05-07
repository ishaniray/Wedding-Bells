<!DOCTYPE html>

<?php

$usr = "";
$em = "";

if(isset($_POST['register']))
{
	if(session_status() == PHP_SESSION_NONE)
		session_start();

	if(isset($_SESSION['username']))
	{
		echo "<script>alert('Please log out from your current session to create a new account.')</script>";
		echo "<script>location.href='home.php'</script>";
		exit(0);
	}

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "weddingbells";

	$conn = mysqli_connect($servername, $username, $password, $dbname);
	if (!$conn)
	    die(mysqli_connect_error());

	if($_FILES['propic']['type'] == 'image/jpeg')
		$filename = 'resources/propics/' . $_POST['username'] . '.jpg';
	else
	{
		echo "<script>alert('File format not supported. Try again.')</script>";
		exit(0);
	}

	$usr = mysqli_real_escape_string($conn, $_POST['username']);
	$pwd = mysqli_real_escape_string($conn, $_POST['psw']);
	$em = mysqli_real_escape_string($conn, $_POST['email']);
	$fn = mysqli_real_escape_string($conn, $_POST['fullname']);
	$gd = $_POST['gender'];
	$dob = $_POST['dob'];
	$pc = $_POST['pincode'];
	$eq = mysqli_real_escape_string($conn, $_POST['eduqual']);
	$pr = $_POST['profession'];
	$jd = mysqli_real_escape_string($conn, $_POST['jobdesc']);
	$sal = $_POST['salary'];
	$bio = mysqli_real_escape_string($conn, $_POST['bio']);

	$sql_u = "SELECT * FROM credentials WHERE username='$usr'";
	$sql_e = "SELECT * FROM credentials WHERE email='$em'";
	$res_u = mysqli_query($conn, $sql_u);
	$res_e = mysqli_query($conn, $sql_e);

	if(mysqli_num_rows($res_u) > 0)
	  	  $username_error = "Sorry, the username you chose is already taken."; 	
	else if(mysqli_num_rows($res_e) > 0)
	  	  $email_error = "Sorry, this email is already registered with us.";
	else
	{
		$sql = "INSERT INTO credentials (username, password, email) VALUES ('$usr', '$pwd', '$em')";
		if (!mysqli_query($conn, $sql)) 
		    echo "<script>alert('An error occured. Please try again.')</script>";

		$sql = "INSERT INTO userbase (username, gender, fullname, dob, pincode, eduqual, profession, jobdesc, salary, message, imgpath) VALUES ('$usr', '$gd', '$fn', '$dob', $pc, '$eq', '$pr', '$jd', $sal, '$bio', '$filename')";

		if (!mysqli_query($conn, $sql))
		    echo "<script>alert('An error occured. Please try again.')</script>";
		else
		{
			copy($_FILES['propic']['tmp_name'], $filename);
			echo "<script>alert('Signup successful!')</script>";
		}

		echo "<script>location.href='home.php'</script>";
	}
	mysqli_close($conn);
}

?>