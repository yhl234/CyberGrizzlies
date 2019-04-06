<?php 
	//start file
	require 'head.php';
?>
<!-- HTML header and form start -->
<h1>Events by User and Date</h1>
<h2>Search events by which user attended and date range</h2>

<?php 

	$userId = $_GET['userId'];
	$startDate = $_GET['startDate'];
	$endDate = $_GET['endDate'];
	$sql = "";
	$query = true;

	if (empty($userId)) {
		$query = false;
	}

	echo '<label for="userId">User Attending:</label>';
	$sql = "SELECT userId, username, firstname, lastname FROM User ORDER BY userId";
	$users = mysqli_query($conn, $sql);
	// Start the user select box
	echo '<select id="userId" name="userId" required>';
	// Echo out all the users as options
	while ($user = mysqli_fetch_array($users)) {
		$id = $user['userId'];
		$uname = $user['username'];
		$fname = $user['firstname'];
		$lname = $user['lastname'];
		if ($id == $userId) {
			echo '<option value="' . $id . '" selected>' . $uname . ' (' . $fname . ' ' . $lname . ')</option>';
		}
		else {
			echo '<option value="' . $id . '">' . $uname . ' (' . $fname . ' ' . $lname . ')</option>';
		}
	}
	// End of users select box
	echo '</select>';

	echo '<label for="startDate">Start date:</label>';
	echo '<input type="date" id="startDate" name="startDate" value="' . $_GET['startDate'] . '"/>';

	echo '<label for="endDate">End date:</label>';
	echo '<input type="date" id="endDate" name="endDate" value="' . $_GET['endDate'] . '"/>';


	$sql = "";
	// $query = false;
	if ($query) {
		if ($startDate && !$endDate) {
			$sql = "SELECT * FROM event WHERE Date(EventDateTime) >= '" . $startDate . "'";
			// echo 'start and no end';
		}
		else if ($endDate && !$startDate) {
			$sql = "SELECT * FROM event WHERE Date(EventDateTime) <= '" . $endDate . "'";
			// echo 'end and no start';
		}
		else if ($startDate && $endDate) {
			$sql = "SELECT * FROM event WHERE Date(EventDateTime) >= '" . $startDate . "' AND Date(EventDateTime) <= '" . $endDate . "'";
			// echo 'start and end';
		}
		else {
			$sql = "SELECT * FROM event";
			// echo 'no start or end';
		}
		echo '<table><th>Event Name</th><th>Event Type</th><th>Event Date</th><th>Event Location</th><th>Event Description</th>';
		$result = mysqli_query($conn, $sql);
		while ($row = mysqli_fetch_array($result)) {
			$name = $row['EventName'];
			$type = $row['EventTypeID'];
			$types = mysqli_query($conn, "SELECT * FROM eventtype");
			while ($trow = mysqli_fetch_array($types)) {
				if ($trow['EventTypeID'] == $type) {
					$type = $trow['EventTypeName'];
				}
			}
			$time = $row['EventDateTime'];
			$location = $row['LocationID'];
			$locs = mysqli_query($conn, "SELECT * FROM location");
			while ($lrow = mysqli_fetch_array($locs)) {
				if ($lrow['LocationID'] == $location) {
					$location = $lrow['LocationName'];
				}
			}
			$description = $row['EventDescription'];
			echo '
			<tr>
				<td>' . $name . '</td>
				<td>' . $type . '</td>
				<td>' . $time . '</td>
				<td>' . $location . '</td>
				<td>' . $description . '</td>
			</tr>';
		}
		echo '</table>';
	}


	





	echo '<script src="./js/memberevent.js"></script>';
require 'footer.php';
?>
