<?php require 'header.php';?>
<!-- 
	query all table name
	populate drop down
	set VARIABLE from selected
	if (VARIABLE == xx){
		show xxx xxx xxx
	}
	sql = select xxx from VARIABLE
 -->



<?php
require 'connect.php';
// query all table name
$sql = "SELECT TABLE_NAME
FROM INFORMATION_SCHEMA.TABLES
WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA='CyberGrizzlies'";
$result =  mysqli_query($conn, $sql) or die('Error');
// populate drop down
echo '<ul>';
while ($row = mysqli_fetch_array($result)){
	foreach($row as $key => $value){
		if( !is_int($key) ){
		echo '<li><a href="#'.$value.'">'.$value.'</a></li>';
		}
	}
}
echo '</ul>';
mysqli_close($conn);
?>


<?php
//user table
echo '
<h3 id="User"> User </h3>
<table>
<th>Username</th>
<th>First Name</th>
<th>Last name</th>
<th>View</th>
<th>Edit</th>
<th>Delete</th>	
';
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
	'<td><a href="update_view.php?id=' . $row['UserID'] .'&table=User">View</a></td>'.
	//update
	'<td><a href="update_edit.php?id=' . $row['UserID'] .'&table=User">Edit</a></td>'.
	//delete
	'<td><a href="update_delete.php?id=' . $row['UserID'] .'&table=User"
	onclick="return confirm(\'Are you sure you want to delete ' . $row['UserName'] . '?\' );">Delete</a></td>'
	.'</tr>';
}
echo '</table>';
mysqli_close($conn);
?>


<?php
//Players table
echo '
<h3 id="Player"> Player </h3>
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
	'<td><a href="update_view.php?id=' . $row['PlayerID'] .'&table=Player">View</a></td>'.
	//update
	'<td><a href="update_edit.php?id=' . $row['PlayerID'].'&table=Player">Edit</a></td>'.
	//delete
	'<td><a href="update_delete.php?id=' . $row['PlayerID'] .'&table=Player"
	onclick="return confirm(\'Are you sure you want to delete ' . $row['UserName'] . '?\' );">Delete</a></td>'
	.'</tr>';
}
echo '</table>';
mysqli_close($conn);
?>


<?php
//Status table
echo '
<h3 id="Status"> Status </h3>
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
	'<td><a href="update_view.php?id=' . $row['StatusID'] .'&table=Status">View</a></td>'.
	//update
	'<td><a href="update_edit.php?id=' . $row['StatusID'].'&table=Status">Edit</a></td>'.
	//delete
	'<td><a href="update_delete.php?id=' . $row['StatusID'] . '&table=Status"
	onclick="return confirm(\'Are you sure you want to delete ' . $row['StatusName'] . '?\' );">Delete</a></td>'
	.'</tr>';
}
echo '</table>';
mysqli_close($conn);
?>

<?php
//Attendees table
echo '
<h3 id="Attendee"> Attendee </h3>
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
	'<td><a href="update_view.php?id=' . $row['AttendeeID'] .'&table=Attendee">View</a></td>'.
	//update
	'<td><a href="update_edit.php?id=' . $row['AttendeeID'].'&table=Attendee">Edit</a></td>'.
	//delete
	'<td><a href="update_delete.php?id=' . $row['AttendeeID'] . '&table=Attendee"
	onclick="return confirm(\'Are you sure you want to delete ' . $row['UserName'] . '?\' );">Delete</a></td>'
	.'</tr>';
}
echo '</table>';
mysqli_close($conn);
?>

<?php
//Events table
echo '
<h3 id="Event"> Event </h3>
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
	'<td>' .$row['TypeName'].'</td>'.
	//view
	'<td><a href="update_view.php?id=' . $row['EventID'] .'&table=Event">View</a></td>'.
	'<td><a href="update_edit.php?id=' . $row['EventID'] .'&table=Event">Edit</a></td>'.
	//delete
	'<td><a href="update_delete.php?id=' . $row['EventID'] . '&table=Event"
	onclick="return confirm(\'Are you sure you want to delete ' . $row['EventName'] . '?\' );">Delete</a></td>'
	.'</tr>';
}
echo '</table>';
mysqli_close($conn);
?>

<?php
//EventsType table
echo '
<h3 id="EventType"> Event Type </h3>
<table>
<th>StatusName</th>
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
	'<td>' .$row['TypeName'].'</td>'.
	//view
	'<td><a href="update_view.php?id=' . $row['EventTypeID'] .'&table=EventType">View</a></td>'.
	//update
	'<td><a href="update_edit.php?id=' . $row['EventTypeID'] .'&table=EventType">Edit</a></td>'.
	//delete
	'<td><a href="update_delete.php?id=' . $row['EventTypeID'] . '&table=EventType"
	onclick="return confirm(\'Are you sure you want to delete ' . $row['TypeName'] . '?\' );">Delete</a></td>'
	.'</tr>';
}
echo '</table>';
mysqli_close($conn);
?>

<?php
//Location table
echo '
<h3 id="Location"> Location </h3>
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
	'<td><a href="update_view.php?id=' . $row['LocationID'] .'&table=Location">View</a></td>'.
	//update
	'<td><a href="update_edit.php?id=' . $row['LocationID']  .'&table=Location">Edit</a></td>'.
	//delete
	'<td><a href="update_delete.php?id=' . $row['LocationID'] . '&table=Location"
	onclick="return confirm(\'Are you sure you want to delete ' . $row['LocationName'] . '?\' );">Delete</a></td>'
	.'</tr>';
}
echo '</table>';
mysqli_close($conn);
?>

<?php
//Games table
echo '
<h3 id="Game"> Game </h3>
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
	'<td><a href="update_view.php?id=' . $row['GameID'] .'&table=Game">View</a></td>'.
	//update
	'<td><a href="update_edit.php?id=' . $row['GameID'] .'&table=Game">Edit</a></td>'.
	//delete
	'<td><a href="update_delete.php?id=' . $row['GameID'] . '&table=Game"
	onclick="return confirm(\'Are you sure you want to delete ' . $row['GameName'] . '?\' );">Delete</a></td>'
	.'</tr>';
}
echo '</table>';
mysqli_close($conn);
?>

<?php
//Genre table
echo '
<h3 id="Genre"> Genre </h3>
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
	'<td><a href="update_view.php?id=' . $row['GenreID'] .'&table=Genre">View</a></td>'.
	//update
	'<td><a href="update_edit.php?id=' . $row['GenreID'].'&table=Genre">Edit</a></td>'.
	//delete
	'<td><a href="update_delete.php?id=' . $row['GenreID'] . '&table=Genre"
	onclick="return confirm(\'Are you sure you want to delete ' . $row['GenreName'] . '?\' );">Delete</a></td>'
	.'</tr>';
}
echo '</table>';
mysqli_close($conn);
?>

<?php
//GamePlatform table
echo '
<h3 id="GamePlatform"> Game Platform </h3>
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
	'<td>' .$row['PlatformName'].'</td>'.
	//view
	'<td><a href="update_view.php?id=' . $row['GamePlatformID'] .'&table=GamePlatform">View</a></td>'.
	//update
	'<td><a href="update_edit.php?id=' . $row['GamePlatformID'] .'&table=GamePlatform">Edit</a></td>'.
	//delete
	'<td><a href="update_delete.php?id=' . $row['GamePlatformID'] . '&table=GamePlatform"
	onclick="return confirm(\'Are you sure you want to delete ' . $row['PlatformName'] . '?\' );">Delete</a></td>'
	.'</tr>';
}
echo '</table>';
mysqli_close($conn);
?>

<?php
//Streaming table
echo '
<h3 id="Stream"> Streaming </h3>
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
	'<td><a href="update_view.php?id=' . $row['StreamID'] .'&table=Stream">View</a></td>'.
	//update
	'<td><a href="update_edit.php?id=' . $row['StreamID'] .'&table=Stream">Edit</a></td>'.
	//delete
	'<td><a href="update_delete.php?id=' . $row['StreamID'] . '&table=Stream"
	onclick="return confirm(\'Are you sure you want to delete ' . $row['UserName'] . '?\' );">Delete</a></td>'
	.'</tr>';
}
echo '</table>';
mysqli_close($conn);
?>

<?php
//StreamPlatform table
echo '
<h3 id="StreamPlatform"> Stream Platform </h3>
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
	'<td><a href="update_view.php?id=' . $row['StreamPlatformID'] .'&table=StreamPlatform">View</a></td>'.
	//update
	'<td><a href="update_edit.php?id=' . $row['StreamPlatformID'].'&table=StreamPlatform">Edit</a></td>'.
	//delete
	'<td><a href="update_delete.php?id=' . $row['StreamPlatformID'] . '&table=StreamPlatform"
	onclick="return confirm(\'Are you sure you want to delete ' . $row['StreamPlatformName'] . '?\' );">Delete</a></td>'
	.'</tr>';
}
echo '</table>';
mysqli_close($conn);
?>


<?php require 'footer.php'?>