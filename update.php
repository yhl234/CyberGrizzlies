<?php require 'head.php';?>
<script src="js/update.js" defer></script>
<?php
require 'connect.php';
// query all table name
$sql = "SELECT TABLE_NAME
FROM INFORMATION_SCHEMA.TABLES
WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA='CyberGrizzlies'";
$result =  mysqli_query($conn, $sql) or die('Error');
// redirect from add
$redirect = $_GET['table'];
echo '<input id="redirect" name="redirect" type="hidden" value="'. $redirect .'"/>';

// populate drop down

echo '<div>
	<select id="selectedTable">
			<option value="">---</option>';
while ($row = mysqli_fetch_array($result)){
	foreach($row as $key => $value){
		if( !is_int($key) ){
			if($value == $redirect){
				echo '<option value="' . $value . '"selected>' . $value . '</option>';
			} else{
				echo '<option value="'.$value.'">'.$value.'</option>';
			}
		}
	}
}
echo '</select></div>';
mysqli_close($conn);
?>
<article>
<?php
//user table
echo '
<div id=left>
<div id="User">
<h3> User </h3>
<table>
<th>Username</th>
<th>First Name</th>
<th>Last name</th>
<th>View</th>
<th>Edit</th>
<th>Delete</th>	
';
?>

<?php
require 'connect.php';
$sql = "SELECT * FROM User;";
$result =  mysqli_query($conn, $sql) or die('Error');
while ($row = mysqli_fetch_array($result)){
	echo 
	'<tr>'.
	'<td>' .$row['UserName'].'</td>'.
	'<td>' .$row['FirstName'].'</td>'.
	'<td>' .$row['LastName'].'</td>'.
	//view
	'<td><a href="update.php?id=' . $row['UserID'] .'&table=User&mode=view">View</a></td>'.
	//update
	'<td><a href="update.php?id=' . $row['UserID'] .'&table=User&mode=edit">Edit</a></td>'.
	//delete
	'<td><a href="update_delete.php?id=' . $row['UserID'] .'&table=User"
	onclick="return confirm(\'Are you sure you want to delete ' . $row['UserName'] . '?\' );">Delete</a></td>'
	.'</tr>';
}
echo '</table></div>';
mysqli_close($conn);
?>


<?php
//Players table
echo '
<div id="Player">
<h3> Player </h3>
<table>
<th>Username</th>
<th>First Name</th>
<th>Last Name</th>
<th>Game Tag</th>
<th>View</th>
<th>Edit</th>
<th>Delete</th>	
';
require 'connect.php';
$sql = "SELECT * FROM User NATURAL JOIN Player;";
$result =  mysqli_query($conn, $sql) or die('Error');
while ($row = mysqli_fetch_array($result)){
	echo 
	'<tr>'.
	'<td>' .$row['UserName'].'</td>'.
	'<td>' .$row['FirstName'].'</td>'.
	'<td>' .$row['LastName'].'</td>'.
	'<td>' .$row['GamerTag'].'</td>'.
	//view
	'<td><a href="update.php?id=' . $row['PlayerID'] .'&table=Player&mode=view">View</a></td>'.
	//update
	'<td><a href="update.php?id=' . $row['PlayerID'].'&table=Player&mode=edit">Edit</a></td>'.
	//delete
	'<td><a href="update_delete.php?id=' . $row['PlayerID'] .'&table=Player"
	onclick="return confirm(\'Are you sure you want to delete ' . $row['UserName'] . '?\' );">Delete</a></td>'
	.'</tr>';
}
echo '</table></div>';
mysqli_close($conn);
?>


<?php
//Status table
echo '
<div id="Status">
<h3> Status </h3>
<table>
<th>StatusName</th>
<th>View</th>
<th>Edit</th>
<th>Delete</th>	
';
require 'connect.php';
$sql = "SELECT * FROM Status;";
$result =  mysqli_query($conn, $sql) or die('Error');
while ($row = mysqli_fetch_array($result)){
	echo 
	'<tr>'.
	'<td>' .$row['StatusName'].'</td>'.
	//view
	'<td><a href="update.php?id=' . $row['StatusID'] .'&table=Status&mode=view">View</a></td>'.
	//update
	'<td><a href="update.php?id=' . $row['StatusID'].'&table=Status&mode=edit">Edit</a></td>'.
	//delete
	'<td><a href="update_delete.php?id=' . $row['StatusID'] . '&table=Status"
	onclick="return confirm(\'Are you sure you want to delete ' . $row['StatusName'] . '?\' );">Delete</a></td>'
	.'</tr>';
}
echo '</table></div>';
mysqli_close($conn);
?>

<?php
//Attendees table
echo '
<div id="Attendee">
<h3> Attendee </h3>
<table>
<th>UserName</th>
<th>Event Name</th>
<th>Status</th>
<th>View</th>
<th>Edit</th>
<th>Delete</th>	
';
require 'connect.php';
$sql = "SELECT * FROM Attendee NATURAL JOIN Event NATURAL JOIN User NATURAL JOIN Status;";
$result =  mysqli_query($conn, $sql) or die('Error');
while ($row = mysqli_fetch_array($result)){
	echo 
	'<tr>'.
	'<td>' .$row['UserName'].'</td>'.
	'<td>' .$row['EventName'].'</td>'.
	'<td>' .$row['StatusName'].'</td>'.

	//view
	'<td><a href="update.php?id=' . $row['AttendeeID'] .'&table=Attendee&mode=view">View</a></td>'.
	//update
	'<td><a href="update.php?id=' . $row['AttendeeID'].'&table=Attendee&mode=edit">Edit</a></td>'.
	//delete
	'<td><a href="update_delete.php?id=' . $row['AttendeeID'] . '&table=Attendee"
	onclick="return confirm(\'Are you sure you want to delete ' . $row['UserName'] . '?\' );">Delete</a></td>'
	.'</tr>';
}
echo '</table></div>';
mysqli_close($conn);
?>

<?php
//Events table
echo '
<div id="Event">
<h3> Event </h3>
<table>
<th>Event Name</th>
<th>DateTime</th>
<th>Type</th>
<th>View</th>
<th>Edit</th>
<th>Delete</th>	
';
require 'connect.php';
$sql = "SELECT * FROM Event NATURAL JOIN EventType;";
$result =  mysqli_query($conn, $sql) or die('Error');
while ($row = mysqli_fetch_array($result)){
	echo 
	'<tr>'.
	'<td>' .$row['EventName'].'</td>'.
	'<td>' .$row['EventDateTime'].'</td>'.
	'<td>' .$row['EventTypeName'].'</td>'.
	//view
	'<td><a href="update.php?id=' . $row['EventID'] .'&table=Event&mode=view">View</a></td>'.
	'<td><a href="update.php?id=' . $row['EventID'] .'&table=Event&mode=edit">Edit</a></td>'.
	//delete
	'<td><a href="update_delete.php?id=' . $row['EventID'] . '&table=Event"
	onclick="return confirm(\'Are you sure you want to delete ' . $row['EventName'] . '?\' );">Delete</a></td>'
	.'</tr>';
}
echo '</table></div>';
mysqli_close($conn);
?>

<?php
//EventsType table
echo '
<div id="EventType">
<h3> Event Type </h3>
<table>
<th>EventTypeName</th>
<th>View</th>
<th>Edit</th>
<th>Delete</th>	
';
require 'connect.php';
$sql = "SELECT * FROM EventType;";
$result =  mysqli_query($conn, $sql) or die('Error');
while ($row = mysqli_fetch_array($result)){
	echo 
	'<tr>'.
	'<td>' .$row['EventTypeName'].'</td>'.
	//view
	'<td><a href="update.php?id=' . $row['EventTypeID'] .'&table=EventType&mode=view">View</a></td>'.
	//update
	'<td><a href="update.php?id=' . $row['EventTypeID'] .'&table=EventType&mode=edit">Edit</a></td>'.
	//delete
	'<td><a href="update_delete.php?id=' . $row['EventTypeID'] . '&table=EventType"
	onclick="return confirm(\'Are you sure you want to delete ' . $row['EventTypeName'] . '?\' );">Delete</a></td>'
	.'</tr>';
}
echo '</table></div>';
mysqli_close($conn);
?>

<?php
//Location table
echo '
<div id="Location">
<h3> Location </h3>
<table>
<th>Location</th>
<th>Address</th>
<th>View</th>
<th>Edit</th>
<th>Delete</th>	
';
require 'connect.php';
$sql = "SELECT * FROM Location;";
$result =  mysqli_query($conn, $sql) or die('Error');
while ($row = mysqli_fetch_array($result)){
	echo 
	'<tr>'.
	'<td>' .$row['LocationName'].'</td>'.
	'<td>' .$row['LocationAddress'].'</td>'.
	//view
	'<td><a href="update.php?id=' . $row['LocationID'] .'&table=Location&mode=view">View</a></td>'.
	//update
	'<td><a href="update.php?id=' . $row['LocationID']  .'&table=Location&mode=edit">Edit</a></td>'.
	//delete
	'<td><a href="update_delete.php?id=' . $row['LocationID'] . '&table=Location"
	onclick="return confirm(\'Are you sure you want to delete ' . $row['LocationName'] . '?\' );">Delete</a></td>'
	.'</tr>';
}
echo '</table></div>';
mysqli_close($conn);
?>

<?php
//Games table
echo '
<div id="Game">
<h3> Game </h3>
<table>
<th>Game Name</th>
<th>Genre</th>
<th>View</th>
<th>Edit</th>
<th>Delete</th>	
';
require 'connect.php';
$sql = "SELECT * FROM Game NATURAL JOIN Genre;";
$result =  mysqli_query($conn, $sql) or die('Error');
while ($row = mysqli_fetch_array($result)){
	echo 
	'<tr>'.
	'<td>' .$row['GameName'].'</td>'.
	'<td>' .$row['GenreName'].'</td>'.

	//view
	'<td><a href="update.php?id=' . $row['GameID'] .'&table=Game&mode=view">View</a></td>'.
	//update
	'<td><a href="update.php?id=' . $row['GameID'] .'&table=Game&mode=edit">Edit</a></td>'.
	//delete
	'<td><a href="update_delete.php?id=' . $row['GameID'] . '&table=Game"
	onclick="return confirm(\'Are you sure you want to delete ' . $row['GameName'] . '?\' );">Delete</a></td>'
	.'</tr>';
}
echo '</table></div>';
mysqli_close($conn);
?>

<?php
//Genre table
echo '
<div id="Genre">
<h3> Genre </h3>
<table>
<th>Genre</th>
<th>View</th>
<th>Edit</th>
<th>Delete</th>	
';
require 'connect.php';
$sql = "SELECT * FROM Genre;";
$result =  mysqli_query($conn, $sql) or die('Error');
while ($row = mysqli_fetch_array($result)){
	echo 
	'<tr>'.
	'<td>' .$row['GenreName'].'</td>'.
	//view
	'<td><a href="update.php?id=' . $row['GenreID'] .'&table=Genre&mode=view">View</a></td>'.
	//update
	'<td><a href="update.php?id=' . $row['GenreID'].'&table=Genre&mode=edit">Edit</a></td>'.
	//delete
	'<td><a href="update_delete.php?id=' . $row['GenreID'] . '&table=Genre"
	onclick="return confirm(\'Are you sure you want to delete ' . $row['GenreName'] . '?\' );">Delete</a></td>'
	.'</tr>';
}
echo '</table></div>';
mysqli_close($conn);
?>

<?php
//GamePlatform table
echo '
<div id="GamePlatform">
<h3> Game Platform </h3>
<table>
<th>Platform</th>
<th>View</th>
<th>Edit</th>
<th>Delete</th>	
';
require 'connect.php';
$sql = "SELECT * FROM GamePlatform;";
$result =  mysqli_query($conn, $sql) or die('Error');
while ($row = mysqli_fetch_array($result)){
	echo 
	'<tr>'.
	'<td>' .$row['GamePlatformName'].'</td>'.
	//view
	'<td><a href="update.php?id=' . $row['GamePlatformID'] .'&table=GamePlatform&mode=view">View</a></td>'.
	//update
	'<td><a href="update.php?id=' . $row['GamePlatformID'] .'&table=GamePlatform&mode=edit">Edit</a></td>'.
	//delete
	'<td><a href="update_delete.php?id=' . $row['GamePlatformID'] . '&table=GamePlatform"
	onclick="return confirm(\'Are you sure you want to delete ' . $row['GamePlatformName'] . '?\' );">Delete</a></td>'
	.'</tr>';
}
echo '</table></div>';
mysqli_close($conn);
?>

<?php
//Streaming table
echo '
<div id="Stream">
<h3> Streaming </h3>
<table>
<th>User Name</th>
<th>StreamPlatform</th>
<th>View</th>
<th>Edit</th>
<th>Delete</th>	
';
require 'connect.php';
$sql = "SELECT * FROM Stream NATURAL JOIN StreamPlatform NATURAL JOIN User NATURAL JOIN STATUS;";
$result =  mysqli_query($conn, $sql) or die('Error');
while ($row = mysqli_fetch_array($result)){
	echo 
	'<tr>'.
	'<td>' .$row['UserName'].'</td>'.
	'<td>' .$row['StreamPlatformName'].'</td>'.

	//view
	'<td><a href="update.php?id=' . $row['StreamID'] .'&table=Stream&mode=view">View</a></td>'.
	//update
	'<td><a href="update.php?id=' . $row['StreamID'] .'&table=Stream&mode=edit">Edit</a></td>'.
	//delete
	'<td><a href="update_delete.php?id=' . $row['StreamID'] . '&table=Stream"
	onclick="return confirm(\'Are you sure you want to delete ' . $row['UserName'] . '?\' );">Delete</a></td>'
	.'</tr>';
}
echo '</table></div>';
mysqli_close($conn);
?>

<?php
//StreamPlatform table
echo '
<div id="StreamPlatform">
<h3> Stream Platform </h3>
<table>
<th>Stream Platform</th>
<th>View</th>
<th>Edit</th>
<th>Delete</th>	
';
require 'connect.php';
$sql = "SELECT * FROM StreamPlatform;";
$result =  mysqli_query($conn, $sql) or die('Error');
while ($row = mysqli_fetch_array($result)){
	echo 
	'<tr>'.
	'<td>' .$row['StreamPlatformName'].'</td>'.
	//view
	'<td><a href="update.php?id=' . $row['StreamPlatformID'] .'&table=StreamPlatform&mode=view">View</a></td>'.
	//update
	'<td><a href="update.php?id=' . $row['StreamPlatformID'].'&table=StreamPlatform&mode=edit">Edit</a></td>'.
	//delete
	'<td><a href="update_delete.php?id=' . $row['StreamPlatformID'] . '&table=StreamPlatform"
	onclick="return confirm(\'Are you sure you want to delete ' . $row['StreamPlatformName'] . '?\' );">Delete</a></td>'
	.'</tr>';
}
//id left
echo '</table></div></div>';
mysqli_close($conn);
?>
</article>

<aside>
<?php
//view -------------------------------------------------------------
require 'connect.php';
$table = $_GET['table'];
$id = $_GET['id'];
$idString = "ID";
$mode = $_GET['mode'];
$tableID = $table .$idString;
$sql = "SELECT * FROM $table WHERE $tableID = $id";
$result = mysqli_query($conn, $sql) or die();
$row = mysqli_fetch_array($result);

if ($mode == 'view'){
	echo '<div class = "view '. $table.'"><a class="cancel" href="update.php"><i class="fas fa-times"></i></a><h3>View'.$table.'</h3><table>';
	//for each piece of information saved in the array, display it to the user.
	foreach($row as $key => $value)
	{
		if( !is_int($key) ){
			//skip primary key
			if ($key == $tableID){
				continue;
			// if field is xxxID	
			}elseif (substr($key,-2) == $idString){
				$tableName = trim($key,"ID");
				$option = $tableName."Name";
				$sql = "SELECT $option FROM $tableName where $key = $value";
				$select = mysqli_query($conn, $sql);
				//dropdown 
				while ($row = mysqli_fetch_array($select)) {
					echo'<tr><td>' . $tableName . ' </td><td> ' . $row[$option] . '</td></tr>';
				}
			// set yes no for 1 0
			}elseif ($key == 'IsRemote' || $key == 'SingleMulti' || $key == 'ActiveStatus' || $key =='PayStatus' || $key == 'ChatStatus'){
				if ($value == '1'){
					echo'<tr><td>' . $key . ' </td><td> Yes </td></tr>';
				}elseif ($value == '0'){
					echo'<tr><td>' . $key . ' </td><td> No </td></tr>';
				}
			}else{
				echo '<tr><td>'.$key.' </td><td> '.$value.'</td></tr>';
			}
		}
	}
	echo 
	'<tr><td><a href="update.php?id=' . $id.'&table='.$table.'&mode=edit">Edit</a></td>'.
	'<td><a href="update_delete.php?id=' . $id .'&table='.$table.'"
	onclick="return confirm(\'Are you sure you want to delete ' . $row['UserName'] . '?\' );">Delete</a></td>
	</table></div>';

	mysqli_close($conn);
} else{
	//edit -------------------------------------------------------------
	echo '<div class="view edit"><a class="cancel" href="update.php"><i class="fas fa-times"></i></a><h3>Edit'.$table.'</h3><form method="POST" action="update_edit_edit.php?id=' . $id .'&table='.$table.'">';
	foreach($row as $key => $value)
	{
		if( !is_int($key) ){
			//skip primary key
			if ($key == $tableID){
				continue;
			// if field is xxxID
			} elseif (substr($key,-2) == $idString){
				$tableName = trim($key,"ID");
				$option = $tableName."Name";
				$sql = "SELECT $key FROM $tableName where $key = $value";
				$select = mysqli_query($conn, $sql);
			//dropdown selected
				while ($row = mysqli_fetch_array($select)) {
					$selectValue = $row[$key];
					
				}
				$sql = "SELECT $key, $option FROM $tableName";
				$dropdown = mysqli_query($conn, $sql);
			//dropdown 
				echo '<div><label for="'.$key.'">'.$key.':</label>
				<select id="'.$key.'" name="'.$key.'">';
				while ($row = mysqli_fetch_array($dropdown)) {
					if($selectValue == $row[$key]){
						echo '<option value="' . $row[$key] . '"selected>' . $row[$option] . '</option>';
					}else{
						echo '<option value="' . $row[$key] . '">' . $row[$option] . '</option>';
					}
				}
				echo '</select><div>';		

			}elseif ($key == 'IsRemote' || $key == 'SingleMulti' || $key == 'ActiveStatus' || $key =='PayStatus' || $key == 'ChatStatus'){
				echo '<div><label for="'.$key.'">'.$key.':</label>
				<select id="'.$key.'" name="'.$key.'">';
				if ($value == '1'){
					echo '<option value="1">Yes</option>';
					echo '<option value="0">No</option>';

				}elseif ($value == '0'){
					echo '<option value="0">No</option>';
					echo '<option value="1">Yes</option>';

				}
				echo '</select><div>';
			}elseif ($key == 'EventDateTime'){
				echo '
				<div>
					<label for="'.$key.'">'.$key.':</label>
					<input type="datetime-local" id="'.$key.'" name="'.$key.'" value="'.$value.'" required />
				</div>
				';
			}elseif ($key == 'StartDate'){
				echo '
				<div>
					<label for="'.$key.'">'.$key.':</label>
					<input type="date" id="'.$key.'" name="'.$key.'" value="'.$value.'" required />
				</div>
				';
			}else{
				echo '
				<div>
					<label for="'.$key.'">'.$key.':</label>
					<input id="'.$key.'" name="'.$key.'" value="'.$value.'" required />
				</div>
				';
			}
		}
	}
	echo 
	'<div>
	<button type="submit"> Save </button>
	</div></div>
	</form>';
	//id edit


	mysqli_close($conn);
}
?>

<?php

// require 'connect.php';
// $table = $_GET['table'];
// $id = $_GET['id'];
// $idString = "ID";
// $tableID = $table .$idString;
// $sql = "SELECT * FROM $table WHERE $tableID = $id";
// $result = mysqli_query($conn, $sql) or die('View Error.'.$sql);


// $row = mysqli_fetch_array($result);
// //for each piece of information saved in the array, display it to the user.


?>
</aside>

<?php require 'footer.php'?>