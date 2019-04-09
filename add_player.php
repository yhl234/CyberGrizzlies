<?php 
require 'head.php';

	$userId = $_POST['userId'];
	$gamertag = $_POST['gamertag'];
	$gameId = $_POST['gameId'];
	$gameName = "";
	$multiplayer = "";
	$genreId = "";
	$newGenreName = "";
	$addNewGame = false;
	$addNewGenre = false;
	if ($gameId == -1) {
		$addNewGame = true;
		$gameName = $_POST['gameName'];
		$multiplayer = $_POST['multiplayer'];
		$genreId = $_POST['genreId'];
		if ($genreId == -1) {
			$newGenreName = $_POST['newGenreName'];
			$addNewGenre = true;
		}
		if ($multiplayer == "on") {
			$multiplayer = 1;
		}
		else {
			$multiplayer = 0;
		}
	}
	$statusId = $_POST['statusId'];
	$newStatus = "";
	$addNewStatus = false;
	if ($statusId == -1) {
		$addNewStatus = true;
		$newStatus = $_POST['newStatus'];
	}
	$locationId = $_POST['locationId'];
	$platformId = $_POST['platformId'];
	$newPlatformName = "";
	$addNewPlatform = false;
	if ($platformId == -1) {
		$addNewPlatform = true;
		$newPlatformName = $_POST['newPlatformName'];
	}

	// End of input retrieval

	$ok = true;
	$errormsg = "Uncaught error.";

	if(empty($gamertag) || strlen($gamertag) > 64) {
		$ok = false;
		$errormsg = "Please enter a gamer tag under 64 characters long.";
	}
	if ($addNewGame) {
		if (empty($gameName) || strlen($gameName) > 24) {
			$ok = false;
			$errormsg = "Please enter a new game name under 24 characters long.";	
		}
		if ($addNewGenre) {
			if (empty($newGenreName) || strlen($newGenreName) > 24) {
				$ok = false;
				$errormsg = "Please enter a new genre name under 24 characters long.";
			}
		}
	}
	if ($addNewStatus) {
		if (empty($newStatus) || strlen($newStatus) > 12) {
			$ok = false;
			$errormsg = "Please enter a new status under 12 characters long.";
		}
	}
	if ($addNewPlatform) {
		if(empty($newPlatformName) || strlen($newPlatformName) > 12) {
			$ok = false;
			$errormsg = "Please enter a new platform name under 12 characters long.";
		}
	}
	// Full validation complete
	

	if ($ok) {
		if ($addNewGenre)
		{
			$sql = "INSERT INTO genre (genrename) VALUES ('" . $newGenreName . "');";
			if (mysqli_query($conn, $sql)) {
				//Confirm with the user
				echo '<p>New genre ' . $newGenreName . ' created successfully.</p>';

				$genreId = mysqli_insert_id($conn);
			}
			else {
				echo '<p>Error creating new genre.</p>';
			}
		}

		if ($addNewGame)
		{
			$sql = "INSERT INTO game (gamename, singlemulti, genreid) VALUES ('" . $gameName . "', " . $multiplayer . ", " . $genreId . ");";
			if (mysqli_query($conn, $sql)) {
				echo '<p>New game ' . $gameName . ' created successfully.</p>';
				$gameId = mysqli_insert_id($conn);
			}
			else {
				echo '<p>Error creating new game.</p>';
			}
		}

		if ($addNewStatus)
		{
			$sql = "INSERT INTO status (statusname) VALUES ('" . $newStatus . "');";
			if (mysqli_query($conn, $sql)) {
				echo '<p>New status ' . $newStatus . ' created successfully.</p>';
				$statusId = mysqli_insert_id($conn);
			}
			else {
				echo '<p>Error creating new status.</p>';
			}
		}

		if ($addNewPlatform)
		{
			$sql = "INSERT INTO gameplatform (gameplatformname) VALUES ('" . $newPlatformName . "');";
			if (mysqli_query($conn, $sql)) {
				echo '<p>New platform ' . $newPlatformName . ' created successfully.</p>';
				$platformId = mysqli_insert_id($conn);
			}
			else {
				echo '<p>Error creating new platform.</p>';
			}
		}

		$sql = "INSERT INTO player (userid, gamertag, gameid, statusid, locationid, gameplatformid) VALUES (" . $userId . ", '" . $gamertag . "', " . $gameId . ", " . $statusId . ", " . $locationId . ", " . $platformId . ");";
		if (mysqli_query($conn, $sql)) {
			//Confirm with the user
			$playerId = mysqli_insert_id($conn);
			echo '<p>Player ' . $gamertag . ' created successfully.</p>';
			echo '<p>You will be redirected to the new player in 3 seconds...</p>';
			header( "refresh:3;url=./update.php?id=" . $playerId . "&table=Player&mode=view" );
		}
		else {
			echo '<p>Error creating new player.</p>';
			echo '<p>' . $errormsg . '</p>';
		}
	}
	else {
		echo '<p>' . $errormsg . '</p>';
	}

require 'footer.php';
?>