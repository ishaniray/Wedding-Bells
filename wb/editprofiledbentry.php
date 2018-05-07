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
if (!$conn)
    die(mysqli_connect_error());

$sql = "SELECT * from credentials WHERE username = '$usr'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$em = $row['email'];
$pwd = $row['password'];

$sql = "SELECT * from userbase WHERE username = '$usr'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$fn = $row['fullname'];
$pc = $row['pincode'];
$eq = $row['eduqual'];
$pr = $row['profession'];
$jd = $row['jobdesc'];
$sal = $row['salary'];
$bio = $row['message'];

if(isset($_POST['edit']))
{
	if($_FILES['propic']['tmp_name'] != "")
	{
		if($_FILES['propic']['type'] == 'image/jpeg')
			$filename = 'resources/propics/' . $usr . '.jpg';
		else
		{
			echo "<script>alert('File format not supported. Try again.')</script>";
			exit(0);
		}
	}

	$pwd = mysqli_real_escape_string($conn, $_POST['psw']);
	$em = mysqli_real_escape_string($conn, $_POST['email']);
	$fn = mysqli_real_escape_string($conn, $_POST['fullname']);
	$pc = $_POST['pincode'];
	$eq = mysqli_real_escape_string($conn, $_POST['eduqual']);
	$pr = $_POST['profession'];
	$jd = mysqli_real_escape_string($conn, $_POST['jobdesc']);
	$sal = $_POST['salary'];
	$bio = mysqli_real_escape_string($conn, $_POST['bio']);

	$sql_e = "SELECT * FROM credentials WHERE email = '$em' AND username <> '$usr'";
	$res_e = mysqli_query($conn, $sql_e);
	
	if(mysqli_num_rows($res_e) > 0)
	  	  $email_error = "Sorry, this email is already registered with us.";
	else
	{
		$sql = "UPDATE credentials SET email = '$em', password = '$pwd' WHERE username = '$usr'";
		if (!mysqli_query($conn, $sql)) 
		{
		    echo "<script>alert('An error occured. Please try again.')</script>";
		    exit(0);
		}

		$sql = "UPDATE userbase SET fullname = '$fn', pincode = $pc, eduqual = '$eq', profession = '$pr', jobdesc = '$jd', salary = $sal, message = '$bio' WHERE username = '$usr'";

		if (!mysqli_query($conn, $sql))
		    echo "<script>alert('An error occured. Please try again.')</script>";
		else
		{
			if($_FILES['propic']['tmp_name'] != "")
				copy($_FILES['propic']['tmp_name'], $filename);
			echo "<script>alert('Profile successfully edited.')</script>";
		}

		echo "<script>location.href='home.php'</script>";
	}
}

mysqli_close($conn);

?>