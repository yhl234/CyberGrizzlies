<?php
$servername = "mycgdb.mysql.database.azure.com";
$dbusername = "cgadmin@mycgdb";
$dbpassword = "Password!";
$dbname = "mycgdb";

// Create connection
$conn=mysqli_init(); 
mysqli_real_connect($con, "mycgdb.mysql.database.azure.com", "cgadmin@mycgdb", "Password!", "mycgdb", 3306);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>
