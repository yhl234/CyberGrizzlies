<?php
require 'connect.php';
	//safer than only post
	$GameID = $_POST['id'];
	$GameName = $_POST['name'];
	$GenreName = $_POST['genre'];
	$SingleMulti = $_POST['single'];

		if (is_numeric($id)) {
	// success and go back
		$sql = "UPDATE Games SET GameName = '$GameName', GenreName = '$GenreName', SingleMulti = '$SingleMulti' WHERE GameID = $GameID";
		mysqli_query($conn, $sql) or die('Error updating database.');
		mysqli_close($conn);
  
		header('Location: game.php');
	}
	// fail and go back 
	else {
		echo 'Invalid user ID.  Click <a href="javascript:history.go(-1)">HERE</a> to go back.';
	}

?>
