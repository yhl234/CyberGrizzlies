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
	<form method="post" action="#">
		<h3>update</h3>
		<input name="id" type="hidden" value="<?php echo $GameID;?>"/>
		<div>
			<label for="name">Name:</label>
			<input name="name" placeholder="<?php echo $GameName;?>" required />
		</div>
		<div>
			<label for="name">Genre:</label>
			<input name="name" placeholder="<?php echo $GenreName;?>" required />
		</div>
		<div>
			<label for="ground">Single or Multi:</label>
			<input name="ground" placeholder="<?php echo $SingleMulti;?>" required />
		</div>
		<div>
			<button type="submit"> Update</button>
		</div>
	</form>
<!-- add game area -->
	<form method="post" action="#">
		<h3>Add Game</h3>
		<div>
			<label for="name">New Game Name:</label>
			<input name="name" required />
		</div>
		<div>
			<label for="name">Genre:</label>
			<input name="name" required />
		</div>
		<div>
			<label for="ground">Single or Multi:</label>
			<input name="ground" required />
		</div>
		<div>
			<button type="submit"> Add</button>
		</div>
	</form>
<!-- add Genre area -->
<form method="post" action="#">
		<h3>Add Genre</h3>
		<div>
			<label for="name">New Genre:</label>
			<input name="name" required />
		</div>
		<div>
			<button type="submit"> Add</button>
		</div>
	</form>	
</main>






<?php require 'footer.php';?>
<!--body closing tag -->
