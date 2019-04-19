<?php 
	//start file
	require 'head.php';
?>
<!-- HTML header and form start -->
<h1>Events by User and Date</h1>
<h2>Search events by which user attended and date range</h2>

<?php 

	$userId = $_GET['userId'];
	if (!$userId) {
		$userId = 1;
	}
	$startDate = $_GET['startDate'];
	$endDate = $_GET['endDate'];
	$sql = "";
	$query = true;

	if (empty($userId)) {
		$query = false;
	}

  echo '
  <div>
  <label for="userId">User Attending:</label>';
	$sql = "SELECT userId, username, firstname, lastname FROM User ORDER BY userId";
	$users = mysqli_query($conn, $sql);
	// Start the user select box
	echo '<select id="userId" name="user2Id" required>';
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
  echo '
  </select>
  </div>';

  echo 
  '
  <div>
  <label for="startDate">Start date:</label>';
  echo '<input type="date" id="startDate" name="startDate" value="' . $_GET['startDate'] . '"/>
  </div>';

  echo '
  <div>
  <label for="endDate">End date:</label>';
  echo '<input type="date" id="endDate" name="endDate" value="' . $_GET['endDate'] . '"/>
  </div>';


	$sql = "";
	// $query = false;
	if ($query) {
		if ($startDate && !$endDate) {
			$sql = "SELECT e.* FROM event as e INNER JOIN attendee as a WHERE a.eventid = e.eventid AND a.userid = " . $userId . " AND (e.EventDateTime) >= '" . $startDate . "' ORDER BY Date(e.EventDateTime)";
			// echo 'start and no end';
		}
		else if ($endDate && !$startDate) {
			$sql = "SELECT e.* FROM event as e INNER JOIN attendee as a WHERE a.eventid = e.eventid AND a.userid = " . $userId . " AND (e.EventDateTime) <= '" . $endDate . "' ORDER BY Date(e.EventDateTime)";
			// echo 'end and no start';
		}
		else if ($startDate && $endDate) {
			$sql = "SELECT e.* FROM event as e INNER JOIN attendee as a WHERE a.eventid = e.eventid AND a.userid = " . $userId . " AND (EventDateTime) <= '" . $endDate . "' ORDER BY Date(e.EventDateTime)";
			// echo 'start and end';
		}
		else {
			$sql = "SELECT e.* FROM event as e INNER JOIN attendee as a WHERE a.eventid = e.eventid AND a.userid = " . $userId . " ORDER BY (e.EventDateTime)";
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
