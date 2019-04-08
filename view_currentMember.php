<?php 
	//start file
	require 'head.php';
?>
<h1>Current Members</h1>
<!-- Current (and/or past) Members-->
 <nav>
	 <ul>
		 <li><a href="view_currentMember.php?ActiveStatus=All">All Members</a></li>
		 <li><a href="view_currentMember.php?ActiveStatus=True">Current Members</a></li>
		 <li><a href="view_currentMember.php?ActiveStatus=False">Past Members</a></li>
	 </ul>
 </nav>
 <table>
	<th>First Name</th>
	<th>Last Name</th>
	<th>Email</th>
	<th>Phone</th>
	
<?php 
	$where = $_GET['ActiveStatus'];
	if ($where == 'True'){
		$sql = "SELECT FirstName, LastName, Email, Phone FROM User WHERE ActiveStatus = '1' ORDER BY UserID";
	}else if($where == 'False'){
		$sql = "SELECT FirstName, LastName, Email, Phone FROM User WHERE ActiveStatus = '0' ORDER BY UserID"; 
	}else{
		$sql = "SELECT FirstName, LastName, Email, Phone 
		FROM User ORDER BY ActiveStatus";
	}
	
	
	$result = mysqli_query($conn, $sql);
	foreach ($result as $row) {
			$FirstName = $row['FirstName'];
			$LastName = $row['LastName'];
			$Email = $row['Email'];
			$Phone = $row['Phone'];
		
			echo '
			<tr>
				<td>' . $FirstName . '</td>
				<td>' . $LastName . '</td>
				<td>' . $Email . '</td>
				<td>' . $Phone . '</td>
			</tr>';
		}
	
?>
</table>
<?php require 'footer.php'; ?>
