<?php
$host = "mycgdb.mysql.database.azure.com";
$username = "cgadmin@mycgdb";
$password = "Password!";
$db_name = "mycgdb";

//Establishes the connection
$conn = mysqli_init();
mysqli_real_connect($conn, $host, $username, $password, $db_name, 3306);
if (mysqli_connect_errno($conn)) {
die('Failed to connect to MySQL: '.mysqli_connect_error());
}


?>
