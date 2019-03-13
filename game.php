<!--body opening tag -->
<?php require 'header.php';?>
<main>
	<table>
		<th>ID</th>
		<th>Name</th>
		<th>Ground</th>
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
	
</main>






<?php require 'footer.php';?>
<!--body closing tag -->
