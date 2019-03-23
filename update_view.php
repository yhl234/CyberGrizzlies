<?php require 'header.php';?>

<?php
require 'connect.php';
$table = $_GET['table'];
$id = $_GET['id'];
$idString = "ID";
$tableID = $table .$idString;
$sql = "SELECT * FROM $table WHERE $tableID = $id";
$result = mysqli_query($conn, $sql) or die('View Error.'.$sql);


$row = mysqli_fetch_array($result);
//for each piece of information saved in the array, display it to the user.
foreach($row as $key => $value)
{
	if( !is_int($key) )
	{
		echo $key.' | '.$value.'<br />';
	}
}
echo 
'<a href="update.php?id=' . $row['UserID'] .'&name='.$row['UserID'].'&genre='.$row['UserID'].'&single='.$row['UserID'].'">Edit</a>'.
'<a href="update_delete.php?id=' . $id .'&table='.$table.'"
onclick="return confirm(\'Are you sure you want to delete ' . $row['UserName'] . '?\' );">Delete</a></td>';


mysqli_close($conn);

?>

<?php require 'footer.php'?>