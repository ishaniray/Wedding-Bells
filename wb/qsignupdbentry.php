<!DOCTYPE html>

<?php

$username = "";
$email = "";

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

	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['psw']);

	$sql_u = "SELECT * FROM credentials WHERE username='$username'";
	$sql_e = "SELECT * FROM credentials WHERE email='$email'";
	$res_u = mysqli_query($conn, $sql_u);
	$res_e = mysqli_query($conn, $sql_e);

	if(mysqli_num_rows($res_u) > 0)
	  	  $username_error = "Sorry, the username you chose is already taken."; 	
	else if(mysqli_num_rows($res_e) > 0)
	  	  $email_error = "Sorry, this email is already registered with us.";
	else
	{ 
		  $sql = "INSERT INTO credentials (username, email, password) VALUES ('$username', '$email', '$password')";
		  if (!mysqli_query($conn, $sql))
	    	echo "<script>alert('An error occured. Please try again.')</script>";
	      else
			echo "<script>alert('We are good to go! You can now login from the home page.')</script>";
	}

	mysqli_close($conn);
}

?>