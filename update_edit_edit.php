<?php
require 'connect.php';
$table = $_GET['table'];
$id = $_GET['id'];
$idString = "ID";
$tableID = $table .$idString;
$sql = "SELECT * FROM $table WHERE $tableID = $id";
$result = mysqli_query($conn, $sql) or die('View Error.'.$sql);



$row = mysqli_fetch_array($result);
$output = "";
foreach($row as $key => $value){
//for each piece of information saved in the array, display it to the user.
	if( !is_int($key) ){
		// print_r($key);
		if ($key == $tableID){
			continue;
		}else{
			$input = mysqli_real_escape_string($conn,$_POST[$key]);
			// print_r($input);
			$outputC = $outputC."$key ='$input',";
		}
	}
}
$output = substr($outputC,0,-1);
$sql = "UPDATE $table SET $output WHERE $tableID = $id ";
mysqli_query($conn, $sql) or die('Error updating database.'.$sql);


mysqli_close($conn);
header('Location: update.php?id=' . $id .'&table='.$table.'&mode=view');
?>
