<?php
$host = "mycgdb.mysql.database.azure.com";
$username = "cgadmin@mycgdb";
$password = "Password!";
$db_name = "mycgdb";

//Establishes the connection

try{
	$conn = new PDO('mysql:host=mycgdb.mysql.database.azure.com;dbname=mycgdb','cgadmin@mycgdb','Password');
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	// echo "Connected successfully";
}
catch(PDOException $e){
	echo "Connection failed: " . $e->getMessage();
}

?>
