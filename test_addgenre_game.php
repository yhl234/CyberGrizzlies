<?php
require 'connect.php';
	//safer than only post
	$GenreName = $_POST['addGenreName'];
		$sql = "INSERT INTO Genre (GenreName)
		VALUES ('$GenreName')";
		mysqli_query($conn, $sql) or die('Error updating database.');
		mysqli_close($conn);
		header('Location: game.php');
?>
