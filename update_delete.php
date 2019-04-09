<?php
require 'connect.php';
$table = $_GET['table'];
$id = $_GET['id'];
$idString = "ID";
$tableID = $table .$idString;

	if (is_numeric($id)) {
	// success and go back
	$sql = "DELETE FROM $table WHERE $tableID = $id";

	mysqli_query($conn, $sql) or die('DELETE Error.'.$sql);
	mysqli_close($conn);
  
	header('Location: update.php');
	}
	// fail and go back 
	else {
		echo 'Invalid '.$table. 'ID.  Click <a href="javascript:history.go(-1)">HERE</a> to go back.';
	}
?>
