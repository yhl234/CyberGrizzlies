<?php 
	//start file
	require 'head.php';
?>
<!-- HTML header and form start -->
<h1>create player</h1>
<form action="add_player.php" method="post">

	<?php
		$sql = "SELECT userId, username, firstName, lastName FROM user ORDER BY userId";
		$users = mysqli_query($conn, $sql);

		echo '<select id="userId" name="userId" required>';

		while ($user = mysqli_fetch_array($users)) {
			$userId = $user['userId'];
			$username = $user['username'];
			$fname = $user['firstName'];
			$lname = $user['lastName'];
			echo '<option value="' . $userId . '">' . $username . ' (' . $fname . ' ' . $lname . ')</option>';
		}
		echo '</select>'; 
	?>

	<label for="gamertag">Gamer tag:</label>
	<input type="text" autofocus id="gamertag" placeholder="In game name" name="eventName" />
	<br /><label for="gameId">Game:</label>

	<?php
		$sql = "SELECT gameId, gamename FROM game ORDER BY gamename";
		$games = mysqli_query($conn, $sql);

		echo '<select id="gameId" name="gameId" required>';

		while ($game = mysqli_fetch_array($games)) {
			$gameId = $game['gameId'];
			$gamename = $game['gamename'];
			echo '<option value="' . $gameId . '">' . $gamename . '</option>';
		}
		echo '<option value="-1">Other</option>';
		echo '</select>';
		
		echo '<div id="gameSubForm" class="hidden">';
			echo '<label for="gameName">Game Name:</label>';
			echo '<input type="text" name="gameName" id="gameName" required />';
			echo '<label for="multiplayer">Multiplayer:</label>';
			echo '<input type="checkbox" name="multiplayer" id="multiplayer" />';
			echo '<label for="genreId">Genre:</label>';

			$sql = "SELECT genreid, genrename FROM genre ORDER BY genrename";
			$genres = mysqli_query($conn, $sql);

			echo '<select id="genreId" name="genreId" required>';

			while ($genre = mysqli_fetch_array($genres)) {
				$genreId = $genre['genreId'];
				$genreName = $game['genrename'];
				echo '<option value="' . $genreId . '">' . $genreName . '</option>';
			}
			echo '<option value="-1">Other</option>';
			echo '</select>';

			echo '<div id="genreSubForm" class="hidden">';
				echo '<label for="newGenreName">New Genre Name:</label>';
				echo '<input type="text" name="newGenreName" id="newGenreName" required />';
			echo '</div>';
		echo '</div>';


		// Form submit button
		echo '<br /><input type="submit" value="Submit" />';

	//End form
	echo '</form>';
	// Include script to handle subform hiding
  echo '<script src="js/event.js"></script>';
	//End file
	require 'footer.php';
	?>
