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
echo '<form method="POST" action="update_edit_edit.php?id=' . $id .'&table='.$table.'">';
foreach($row as $key => $value)
{
	if( !is_int($key) )
	{
		if ($key == $tableID){
			continue;
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
<button type="submit"> Edit </button>
</div>
</form>';


mysqli_close($conn);

?>

<?php require 'footer.php'?>