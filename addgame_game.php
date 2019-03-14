<?php
require 'connect.php';
	//safer than only post
	$GameName = $_POST['addGameName'];
	$GenreName = $_POST['addGameGenre'];
	$SingleMulti = $_POST['addGameMulti'];

		$sql = "INSERT INTO Games (GameName, SingleMulti, GenreID)
		VALUES ('$GameName', '$SingleMulti', '$GenreName')";
		mysqli_query($conn, $sql) or die('Error updating database.');
		mysqli_close($conn);
		header('Location: game.php');
?>
