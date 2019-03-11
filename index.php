<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Page Title</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" media="screen" href="main.css">
	<script src="main.js"></script>
</head>
<body>
<?php
	// $host = "mycgdb.mysql.database.azure.com";
	// $username = "cgadmin@mycgdb";
	// $password = "Password!";
	// $db_name = "mycgdb";

	// Establishes the connection
	// $conn = mysqli_init();
	// mysqli_real_connect($conn, $host, $username, $password, $db_name, 3306);
	// if (mysqli_connect_errno($conn)) {
	// die('Failed to connect to MySQL: '.mysqli_connect_error());
	// }
	$conn = new mysqli("mycgdb.mysql.database.azure.com", "cgadmin@mycgdb", "Password!" , "mycgdb");
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	// echo '<p>connect is good</p>';
	// mysqli_close($conn); 
?>
</body>
</html>
