<!--body opening tag -->
<?php require 'header.php';?>
<main>
	<table>
		<th>ID</th>
		<th>Name</th>
		<th>GenreName</th>
		<th>SingleMulti</th>
		<th>Update</th>
		<th>Delete</th>	
		
<?php
// output table content
require 'connect.php';
$sql = "SELECT GameID, GameName, GenreName, SingleMulti 
		FROM Games INNER JOIN Genre
		WHERE Games.GenreID = Genre.GenreID;";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($result)){
	echo '<tr>'.
		'<td>' .$row['GameID'].'</td>'.
		'<td>' .$row['GameName'].'</td>'.
		'<td>' .$row['GenreName'].'</td>'.
		'<td>' .$row['SingleMulti'].'</td>'.
		//store data to url
		'<td><a id="edit" href="game.php?id=' . $row['GameID'] .'&name='.$row['GameName'].'&genre='.$row['GenreName'].'&single='.$row['SingleMulti'].'">Edit</a></td>'.
		//I not sure it is a good idea or not
		'<td><a class = "text-danger" href="delete.php?id=' . $row['GameID'] . '"
		onclick="return confirm(\'Are you sure you want to delete ' . $row['GameName'] . '?\' );">Delete</a></td>'
		.'</tr>';
}
//set variable from url
$GameID = $_GET['id'];
$GameName = $_GET['name'];
$GenreName = $_GET['genre'];
$SingleMulti = $_GET['single'];
//disconnect
mysqli_close($conn);
?>
	</table>
<!-- update area -->
	<form method="POST" action="update_game.php">
		<h3>Update Game</h3>
		<input name="updateId" type="hidden" value="<?php echo $GameID;?>"/>
		<div>
			<label for="updateName">Name:</label>
			<input id="updateName" name="updateName" value="<?php echo $GameName;?>" required />
		</div>
		<div>
			<label for="updateGenre">Genre:</label>
			<select name="updateGenre" id="updateGenre" required>
				<option disabled selected value> -- select an option -- </option>

			<?php
			// dropdown for Genre
				require 'connect.php';
				$sql = "SELECT * FROM Genre";
				$result = mysqli_query($conn, $sql);
				while ($row = mysqli_fetch_array($result)){
					echo 
						'<option value="'.$row['GenreID'].'">'.$row['GenreName'].'</option>';
				}
				$conn = null;
			?>
			</select>
		</div>
		<div>
			<label for="updateMulti">Multi player?</label>
			<select name="updateMulti" id="updateMulti">
				<option disabled selected value> -- select an option -- </option>
				<option value="1">Yes</option>
				<option value="0">No</option>
			</select>
		</div>
		<div>
			<button type="submit"> Update Game</button>
		</div>
	</form>
<!-- add game area -->
	<form method="post" action="addgame_game.php">
		<h3>Add Game</h3>
		<div>
			<label for="addGameName">New Game Name:</label>
			<input name="addGameName" required />
		</div>
		<div>
			<label for="addGameGenre">Genre:</label>
			<select name="addGameGenre" id="addGameGenre" required>
				<option disabled selected value> -- select an option -- </option>
			<?php
			// dropdown for Genre
				require 'connect.php';
				$sql = "SELECT * FROM Genre";
				$result = mysqli_query($conn, $sql);
				while ($row = mysqli_fetch_array($result)){
					echo 
						'<option value="'.$row['GenreID'].'">'.$row['GenreName'].'</option>';
				}
				$conn = null;
			?>
						</select>
		</div>
		<div>
			<label for="addGameMulti">Multi player?</label>
			<select name="addGameMulti" id="addGameMulti">
				<option disabled selected value> -- select an option -- </option>
				<option value="1">Yes</option>
				<option value="0">No</option>
			</select>
			
		</div>
		<div>
			<button type="submit"> Add New Game</button>
		</div>
	</form>
<!-- add Genre area -->
<form method="post" action="addgenre_game.php">
		<h3>Add Genre</h3>
		<div>
			<label for="addGenreName">New Genre:</label>
			<input name="addGenreName" required />
		</div>
		<div>
			<button type="submit"> Add New Genre</button>
		</div>
	</form>	
</main>






<?php require 'footer.php';?>
<!--body closing tag -->
