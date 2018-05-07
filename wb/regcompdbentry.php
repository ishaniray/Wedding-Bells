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

if($_FILES['propic']['type'] == 'image/jpeg')
	$filename = 'resources/propics/' . $_SESSION['username'] . '.jpg';
else
{
	echo "<script>alert('File format not supported. Try again.')</script>";
	echo "<script>location.href='regcompletion.php'</script>";
	exit(0);
}

$usr = mysqli_real_escape_string($conn, $_SESSION['username']);
$fn = mysqli_real_escape_string($conn, $_POST['fullname']);
$gd = $_POST['gender'];
$dob = $_POST['dob'];
$pc = $_POST['pincode'];
$eq = mysqli_real_escape_string($conn, $_POST['eduqual']);
$pr = $_POST['profession'];
$jd = mysqli_real_escape_string($conn, $_POST['jobdesc']);
$sal = $_POST['salary'];
$bio = mysqli_real_escape_string($conn, $_POST['bio']);

$sql = "INSERT INTO userbase (username, gender, fullname, dob, pincode, eduqual, profession, jobdesc, salary, message, imgpath) VALUES ('$usr', '$gd', '$fn', '$dob', $pc, '$eq', '$pr', '$jd', $sal, '$bio', '$filename')";

if (!mysqli_query($conn, $sql))
    echo "<script>alert('An error occured. Please try again.')</script>";
else
{
	copy($_FILES['propic']['tmp_name'], $filename);
	echo "<script>alert('Details updated successfully!')</script>";
}

echo "<script>location.href='home.php'</script>";

mysqli_close($conn);

?>