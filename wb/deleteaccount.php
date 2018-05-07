<!DOCTYPE html>

<html>

	<head>
		<link rel="icon" href="resources/logos/favicon.png">
		<title>Delete Account | Wedding Bells</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>

	<body>

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

		$sql = "SELECT * from userbase where username = '$usr'";
		$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result) > 0)
		{
			$sql = "DELETE from userbase where username = '$usr'";
			if(!mysqli_query($conn, $sql))
			{
				echo mysqli_error($conn);
				exit(0);
			}
		}

		$sql = "DELETE from credentials where username = '$usr'";
		if(!mysqli_query($conn, $sql))
		{
			echo mysqli_error($conn);
			exit(0);
		}
		else
			echo "<h1 align='center'>Account deleted successfully.</h1>";

		mysqli_close($conn);

		session_destroy();

		?>
	</body>
</html>
