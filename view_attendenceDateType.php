<?php 
	//start file
	require 'head.php';
?>
<!-- HTML header and form start -->
<h1>Attendees by date and type</h1>

<?php 

	$eventId = $_GET['EventId'];
	if (!$eventId) {
		$eventId = 1;
	}
	// $startDate = $_GET['startDate'];
	// $endDate = $_GET['endDate'];
	// $sql = "";
	$query = true;

	if (empty($eventId)) {
		$query = false;
	}

	echo '<label for="EventId">Events:</label>';
	$sql = "SELECT EventId, EventName, EventDateTime FROM Event ORDER BY EventDateTime";
	$event = mysqli_query($conn, $sql);
	// Start the event select box
	echo '<select id="EventId" name="EventId" required>';
	// Echo out all the events as options
	while ($event = mysqli_fetch_array($event)) {
		$eventId = $event['EventId'];
        $eventName = $event['EventName'];
        $eventDateTime = $event['EventDateTime'];
		if ($id == $eventId) {
			echo '<option value="' . $eventId . '" selected>' . $eventName . ' (' . $eventDateTime . ')</option>';
		}
		else {
			echo '<option value="' . $eventId . '" selected>' . $eventName . ' (' . $eventDateTime . ')</option>';
		}
	}
	// End of users select box
	echo '</select>';

	// echo '<label for="startDate">Start date:</label>';
	// echo '<input type="date" id="startDate" name="startDate" value="' . $_GET['startDate'] . '"/>';

	// echo '<label for="endDate">End date:</label>';
	// echo '<input type="date" id="endDate" name="endDate" value="' . $_GET['endDate'] . '"/>';


	$sql = "";

		if ($query) {
			$sql = "SELECT username, isremote FROM Attendee INNER JOIN user WHERE `EventID` = $eventId";
            
            
            echo '<table>
            <caption>Search attendees by event date and attendence type</caption>

            <th>Attendee Username</th><th>Attendence Type</th>';
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)) {
                // $username = $row['UserName'];
                // $attendenceType = $row['IsRemote'];
                // $attendenceTypes = mysqli_query($conn, "SELECT * FROM IsRemote");
                // // while ($trow = mysqli_fetch_array($attendenceTypes)) {
                // //     if ($trow['IsRemote'] == $type) {
                // //         $type = $trow['TypeName'];
                // //     }
                // // }
                // // $time = $row['EventDateTime'];
                // // $location = $row['LocationID'];
                // $locs = mysqli_query($conn, "SELECT * FROM location");
                // while ($lrow = mysqli_fetch_array($locs)) {
                //     if ($lrow['LocationID'] == $location) {
                //         $location = $lrow['LocationName'];
                //     }
                // }
                // $description = $row['EventDescription'];
                echo '
                <tr>
                    <td>' . $row['username'] . '</td>
                    <td>' . $row['isremote'] . '</td>
                </tr>';
                // $description = $row['EventDescription'];
                // echo '
                // <tr>
                // 	<td>' . $name . '</td>
                // 	<td>' . $type . '</td>
                // 	<td>' . $time . '</td>
                // 	<td>' . $location . '</td>
                // 	<td>' . $description . '</td>
                // </tr>';
            }
            echo '</table>';
		}
		else {
			// $sql = "SELECT e.* FROM event as e INNER JOIN attendee as a WHERE a.eventid = e.eventid AND a.userid = " . $userId . " ORDER BY (e.EventDateTime)";
			echo 'please select an event';
		}


	// echo '<script src="./js/memberevent.js"></script>';
require 'footer.php';
?>


<!--
    
To Do:

1. Populate drop down list with events by date (includes event name and date) DONE

2. Show attendees for event

3. Order attendees by attendence type (isRemote y/n)


-->