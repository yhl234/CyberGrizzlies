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
echo '<select>';
while ($row = mysqli_fetch_array($result)){
	echo '
	
		<option value="volvo">'.$row.'</option>
  ';
}
echo '</select>';
mysqli_close($conn);
?>


<?php
//user table
echo '
<h3> Users </h3>
<table>
<th>Username</th>
<th>First Name</th>
<th>Last name</th>
<th>View</th>
<th>Edit</th>
<th>Delete</th>	
';
require 'connect.php';
$sql = "SELECT * FROM Users;";
$result =  mysqli_query($conn, $sql) or die('Error');
while ($row = mysqli_fetch_array($result)){
	echo 
	'<tr>'.
	'<td>' .$row['UserName'].'</td>'.
	'<td>' .$row['FirstName'].'</td>'.
	'<td>' .$row['LastName'].'</td>'.
	//view
	'<td><a href="update.php?id=' . $row['UserID'] .'">View</a></td>'.
	//update
	'<td><a href="update.php?id=' . $row['UserID'] .'&name='.$row['UserID'].'&genre='.$row['UserID'].'&single='.$row['UserID'].'">Edit</a></td>'.
	//delete
	'<td><a href="delete.php?id=' . $row['UserID'] . '"
	onclick="return confirm(\'Are you sure you want to delete ' . $row['UserName'] . '?\' );">Delete</a></td>'
	.'</tr>';
}
echo '</table>';
mysqli_close($conn);
?>


<?php
//Players table
echo '
<h3> Players </h3>
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
$sql = "SELECT * FROM Users NATURAL JOIN Players;";
$result =  mysqli_query($conn, $sql) or die('Error');
while ($row = mysqli_fetch_array($result)){
	echo 
	'<tr>'.
	'<td>' .$row['UserName'].'</td>'.
	'<td>' .$row['FirstName'].'</td>'.
	'<td>' .$row['LastName'].'</td>'.
	'<td>' .$row['GamerTag'].'</td>'.
	//view
	'<td><a href="update.php?id=' . $row['UserID'] .'">View</a></td>'.
	//update
	'<td><a href="update.php?id=' . $row['UserID'] .'&name='.$row['UserID'].'&genre='.$row['UserID'].'&single='.$row['UserID'].'">Edit</a></td>'.
	//delete
	'<td><a href="delete.php?id=' . $row['UserID'] . '"
	onclick="return confirm(\'Are you sure you want to delete ' . $row['UserName'] . '?\' );">Delete</a></td>'
	.'</tr>';
}
echo '</table>';
mysqli_close($conn);
?>


<?php
//Status table
echo '
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
	'<td><a href="update.php?id=' . $row['UserID'] .'">View</a></td>'.
	//update
	'<td><a href="update.php?id=' . $row['UserID'] .'&name='.$row['UserID'].'&genre='.$row['UserID'].'&single='.$row['UserID'].'">Edit</a></td>'.
	//delete
	'<td><a href="delete.php?id=' . $row['UserID'] . '"
	onclick="return confirm(\'Are you sure you want to delete ' . $row['UserName'] . '?\' );">Delete</a></td>'
	.'</tr>';
}
echo '</table>';
mysqli_close($conn);
?>

<?php
//Attendees table
echo '
<h3> Attendees </h3>
<table>
<th>UserName</th>
<th>Event Name</th>
<th>Status</th>
<th>View</th>
<th>Edit</th>
<th>Delete</th>	
';
require 'connect.php';
$sql = "SELECT * FROM Attendees NATURAL JOIN Events NATURAL JOIN Users  NATURAL JOIN Status;";
$result =  mysqli_query($conn, $sql) or die('Error');
while ($row = mysqli_fetch_array($result)){
	echo 
	'<tr>'.
	'<td>' .$row['UserName'].'</td>'.
	'<td>' .$row['EventName'].'</td>'.
	'<td>' .$row['StatusName'].'</td>'.

	//view
	'<td><a href="update.php?id=' . $row['UserID'] .'">View</a></td>'.
	//update
	'<td><a href="update.php?id=' . $row['UserID'] .'&name='.$row['UserID'].'&genre='.$row['UserID'].'&single='.$row['UserID'].'">Edit</a></td>'.
	//delete
	'<td><a href="delete.php?id=' . $row['UserID'] . '"
	onclick="return confirm(\'Are you sure you want to delete ' . $row['UserName'] . '?\' );">Delete</a></td>'
	.'</tr>';
}
echo '</table>';
mysqli_close($conn);
?>

<?php
//Events table
echo '
<h3> Events </h3>
<table>
<th>Event Name</th>
<th>DateTime</th>
<th>Type</th>
<th>View</th>
<th>Edit</th>
<th>Delete</th>	
';
require 'connect.php';
$sql = "SELECT * FROM Events NATURAL JOIN EventsType;";
$result =  mysqli_query($conn, $sql) or die('Error');
while ($row = mysqli_fetch_array($result)){
	echo 
	'<tr>'.
	'<td>' .$row['EventName'].'</td>'.
	'<td>' .$row['EventDateTime'].'</td>'.
	'<td>' .$row['TypeName'].'</td>'.
	//view
	'<td><a href="update.php?id=' . $row['UserID'] .'">View</a></td>'.
	//update
	'<td><a href="update.php?id=' . $row['UserID'] .'&name='.$row['UserID'].'&genre='.$row['UserID'].'&single='.$row['UserID'].'">Edit</a></td>'.
	//delete
	'<td><a href="delete.php?id=' . $row['UserID'] . '"
	onclick="return confirm(\'Are you sure you want to delete ' . $row['UserName'] . '?\' );">Delete</a></td>'
	.'</tr>';
}
echo '</table>';
mysqli_close($conn);
?>

<?php
//EventsType table
echo '
<h3> Events Type </h3>
<table>
<th>StatusName</th>
<th>View</th>
<th>Edit</th>
<th>Delete</th>	
';
require 'connect.php';
$sql = "SELECT * FROM EventsType;";
$result =  mysqli_query($conn, $sql) or die('Error');
while ($row = mysqli_fetch_array($result)){
	echo 
	'<tr>'.
	'<td>' .$row['TypeName'].'</td>'.
	//view
	'<td><a href="update.php?id=' . $row['UserID'] .'">View</a></td>'.
	//update
	'<td><a href="update.php?id=' . $row['UserID'] .'&name='.$row['UserID'].'&genre='.$row['UserID'].'&single='.$row['UserID'].'">Edit</a></td>'.
	//delete
	'<td><a href="delete.php?id=' . $row['UserID'] . '"
	onclick="return confirm(\'Are you sure you want to delete ' . $row['UserName'] . '?\' );">Delete</a></td>'
	.'</tr>';
}
echo '</table>';
mysqli_close($conn);
?>

<?php
//Locations table
echo '
<h3> Locations </h3>
<table>
<th>Location</th>
<th>Address</th>
<th>View</th>
<th>Edit</th>
<th>Delete</th>	
';
require 'connect.php';
$sql = "SELECT * FROM Locations;";
$result =  mysqli_query($conn, $sql) or die('Error');
while ($row = mysqli_fetch_array($result)){
	echo 
	'<tr>'.
	'<td>' .$row['LocationName'].'</td>'.
	'<td>' .$row['LocationAddress'].'</td>'.
	//view
	'<td><a href="update.php?id=' . $row['UserID'] .'">View</a></td>'.
	//update
	'<td><a href="update.php?id=' . $row['UserID'] .'&name='.$row['UserID'].'&genre='.$row['UserID'].'&single='.$row['UserID'].'">Edit</a></td>'.
	//delete
	'<td><a href="delete.php?id=' . $row['UserID'] . '"
	onclick="return confirm(\'Are you sure you want to delete ' . $row['UserName'] . '?\' );">Delete</a></td>'
	.'</tr>';
}
echo '</table>';
mysqli_close($conn);
?>

<?php
//Games table
echo '
<h3> Games </h3>
<table>
<th>Game Name</th>
<th>Genre</th>
<th>View</th>
<th>Edit</th>
<th>Delete</th>	
';
require 'connect.php';
$sql = "SELECT * FROM Games NATURAL JOIN Genre;";
$result =  mysqli_query($conn, $sql) or die('Error');
while ($row = mysqli_fetch_array($result)){
	echo 
	'<tr>'.
	'<td>' .$row['GameName'].'</td>'.
	'<td>' .$row['GenreName'].'</td>'.

	//view
	'<td><a href="update.php?id=' . $row['UserID'] .'">View</a></td>'.
	//update
	'<td><a href="update.php?id=' . $row['UserID'] .'&name='.$row['UserID'].'&genre='.$row['UserID'].'&single='.$row['UserID'].'">Edit</a></td>'.
	//delete
	'<td><a href="delete.php?id=' . $row['UserID'] . '"
	onclick="return confirm(\'Are you sure you want to delete ' . $row['UserName'] . '?\' );">Delete</a></td>'
	.'</tr>';
}
echo '</table>';
mysqli_close($conn);
?>

<?php
//Genre table
echo '
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
	'<td><a href="update.php?id=' . $row['UserID'] .'">View</a></td>'.
	//update
	'<td><a href="update.php?id=' . $row['UserID'] .'&name='.$row['UserID'].'&genre='.$row['UserID'].'&single='.$row['UserID'].'">Edit</a></td>'.
	//delete
	'<td><a href="delete.php?id=' . $row['UserID'] . '"
	onclick="return confirm(\'Are you sure you want to delete ' . $row['UserName'] . '?\' );">Delete</a></td>'
	.'</tr>';
}
echo '</table>';
mysqli_close($conn);
?>

<?php
//GamePlatform table
echo '
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
	'<td>' .$row['PlatformName'].'</td>'.
	//view
	'<td><a href="update.php?id=' . $row['UserID'] .'">View</a></td>'.
	//update
	'<td><a href="update.php?id=' . $row['UserID'] .'&name='.$row['UserID'].'&genre='.$row['UserID'].'&single='.$row['UserID'].'">Edit</a></td>'.
	//delete
	'<td><a href="delete.php?id=' . $row['UserID'] . '"
	onclick="return confirm(\'Are you sure you want to delete ' . $row['UserName'] . '?\' );">Delete</a></td>'
	.'</tr>';
}
echo '</table>';
mysqli_close($conn);
?>

<?php
//Streaming table
echo '
<h3> Streaming </h3>
<table>
<th>User Name</th>
<th>StreamPlatform</th>
<th>View</th>
<th>Edit</th>
<th>Delete</th>	
';
require 'connect.php';
$sql = "SELECT * FROM Streaming NATURAL JOIN StreamPlatform NATURAL JOIN Users NATURAL JOIN STATUS;";
$result =  mysqli_query($conn, $sql) or die('Error');
while ($row = mysqli_fetch_array($result)){
	echo 
	'<tr>'.
	'<td>' .$row['UserName'].'</td>'.
	'<td>' .$row['StreamPlatformName'].'</td>'.

	//view
	'<td><a href="update.php?id=' . $row['UserID'] .'">View</a></td>'.
	//update
	'<td><a href="update.php?id=' . $row['UserID'] .'&name='.$row['UserID'].'&genre='.$row['UserID'].'&single='.$row['UserID'].'">Edit</a></td>'.
	//delete
	'<td><a href="delete.php?id=' . $row['UserID'] . '"
	onclick="return confirm(\'Are you sure you want to delete ' . $row['UserName'] . '?\' );">Delete</a></td>'
	.'</tr>';
}
echo '</table>';
mysqli_close($conn);
?>

<?php
//StreamPlatform table
echo '
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
	'<td><a href="update.php?id=' . $row['UserID'] .'">View</a></td>'.
	//update
	'<td><a href="update.php?id=' . $row['UserID'] .'&name='.$row['UserID'].'&genre='.$row['UserID'].'&single='.$row['UserID'].'">Edit</a></td>'.
	//delete
	'<td><a href="delete.php?id=' . $row['UserID'] . '"
	onclick="return confirm(\'Are you sure you want to delete ' . $row['UserName'] . '?\' );">Delete</a></td>'
	.'</tr>';
}
echo '</table>';
mysqli_close($conn);
?>


<?php require 'footer.php'?>