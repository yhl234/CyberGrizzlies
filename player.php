<?php 
	//start file
	require 'head.php';
?>
<!-- HTML header and form start -->
<h1>create player</h1>
<form action="add_player.php" method="post">

	<label for="userId">User:</label>

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
			// Second level subform
			echo '<div id="genreSubForm" class="hidden">';
				echo '<label for="newGenreName">New Genre Name:</label>';
				echo '<input type="text" name="newGenreName" id="newGenreName" required />';
			// End of second level subform
			echo '</div>';
		// End of first level subform
		echo '</div>';


		// Status selection
		echo '<label for="statusId">Player Status:</label>';
		$sql = "SELECT statusId, statusname FROM status ORDER BY statusname";
		$statuses = mysqli_query($conn, $sql);

		echo '<select id="statusId" name="statusId" required>';

		while ($status = mysqli_fetch_array($statuses)) {
			$statusId = $status['statusId'];
			$sname = $status['statusname'];

			echo '<option value="' . $statusId . '">' . $sname . '</option>';
		}
		echo '<option value=-1>Other</option>';
		echo '</select>';

		// Start of status subform
		echo '<div id="statusSubForm" class="hidden">';
			echo '<br /><label for="newStatus">New Status:</label>';
			echo '<input type="text" name="newStatus" id="newStatus"/>';
		echo '</div>';


		echo '<br /><label for="locationId">Usual Play Location:</label>';
		$sql = "SELECT locationid, locationname FROM location ORDER BY locationid";
		$locs = mysqli_query($conn, $sql);

		echo '<select id="locationId" name="locationId" required>';

		while ($loc = mysqli_fetch_array($locs)) {
			$locId = $loc['locationid'];
			$lname = $loc['locationname'];
			echo '<option value="' . $locId . '">' . $lname . '</option>';
		}
		echo '<option value="-1">Other</option>';	
		echo '</select>';


		echo '<br /><label for="platformId">Game Platform:</label>';
		$sql = "SELECT gameplatformid, gameplatformname FROM gameplatform ORDER BY gameplatformname";
		$plats = mysqli_query($conn, $sql);

		echo '<select id="platformId" name="platformId" required>';

		while ($plat = mysqli_fetch_array($plats)) {
			$platId = $plat['gameplatformid'];
			$platName = $plat['gameplatformname'];
			echo '<option value="' . $platId . '">' . $platName . '</option>';
		}
		echo '<option value="-1">Other</option>';	
		echo '</select>';
		echo '<div id="platformSubForm" class="hidden">';
			echo '<br /><label for="newPlatformName">New Platform Name:</label>';
			echo '<input type="text" name="newPlatformName" id="newPlatformName"/>';
		echo '</div>';


		// Form submit 
		echo '<br /><input type="submit" value="Submit" />';

	//End form
	echo '</form>';
	// Include script to handle subform hiding
  echo '<script src="js/event.js"></script>';
	//End file
	require 'footer.php';
	?>
