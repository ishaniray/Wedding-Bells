<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "weddingbells";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) 
    die(mysqli_connect_error());

$usr = "'" . $_POST['username'] . "'";

$sql = "SELECT password from credentials where username = " . $usr;
$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);
$pass = $row['password'];

if(session_status() == PHP_SESSION_NONE)
	session_start();

if($pass == $_POST['psw'])
{
	$_SESSION['username'] = $_POST['username'];
	echo "<script>location.href='home.php'</script>";
}
else
{
	echo "<script>alert('Sorry, we could not authenticate you.')</script>";
	echo "<script>location.href='index.php'</script>";
}

mysqli_close($conn);

?>
