<?php
$servername = "mycgdb.mysql.database.azure.com";
$dbusername = "cgadmin@mycgdb";
$dbpassword = "Password!";
$dbname = "mycgdb";

// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
