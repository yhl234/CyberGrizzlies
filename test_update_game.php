<?php
require 'connect.php';
	//safer than only post
	$GameID = $_POST['updateId'];
	$GameName = $_POST['updateName'];
	$GenreID = $_POST['updateGenre'];
	$SingleMulti = $_POST['updateMulti'];

		if (is_numeric($GameID)) {
	// success and go back
		$sql = "UPDATE Games SET GameName = '$GameName', GenreID = '$GenreID', SingleMulti = '$SingleMulti' WHERE GameID = $GameID";
		mysqli_query($conn, $sql) or die('Error updating database.');
		mysqli_close($conn);
  
		header('Location: game.php');
	}
	// fail and go back 
	else {
		echo 'Invalid user ID.  Click <a href="javascript:history.go(-1)">HERE</a> to go back.';
	}

?>
