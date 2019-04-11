<?php 
	//start file
	require 'head.php';
?>
<!-- HTML header and form start -->
<h1>Attendees by date and type</h1>

<?php 
	$eventId = $_GET['id'];

	if (!$eventId || empty($eventId)) {
		$eventId = 1;
	}



  echo '
  <div>
  <label for="EventId">Events:</label>';
	$sql = "SELECT EventId, EventName, EventDateTime FROM Event ORDER BY EventDateTime";
	$events = mysqli_query($conn, $sql);
	// Start the event select box
	echo '<select id="EventId" name="EventId" required>';
	// Echo out all the events as options
	while ($event = mysqli_fetch_array($events)) {
		$id = $event['EventId'];
        $eventName = $event['EventName'];
        $eventDateTime = $event['EventDateTime'];
		if ($id == $eventId) {
			echo '<option value="view_attendenceDateType.php?id=' . $id . '" selected>' . $eventName . ' (' . $eventDateTime . ')</option>';
		}
		else {
			echo '<option value="view_attendenceDateType.php?id=' . $id . '">' . $eventName . ' (' . $eventDateTime . ')</option>';
		}
	}
  echo '</select>';


			$sql = "SELECT u.username, a.isremote, u.lastname, u.firstname, a.gameplatformId FROM user as u INNER JOIN attendee as a ON u.userId = a.userid WHERE a.eventId = " . $eventId . ";";
			echo '
            <div>
            <table>

            <th>Attendee Name</th><th>Attendance</th><th>Platform</th>';
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)) {
				
				$remote = false;
				$fname = $row["firstname"];
				$lname = $row["lastname"];
				$username = $row["username"];
				$platformId = $row["gameplatformId"];
				if ($row["isremote"] == 1) {
					$remote = "Remote";
				}
				else {
					$remote = "Local";
				}
				$fullname = $username . " (" . $fname . " " . $lname . ")";

				$platformname = "Undefined";
				$platSql = "SELECT GamePlatformName FROM gameplatform WHERE gameplatformid = " . $platformId;
				$presult = mysqli_query($conn, $platSql);
				while ($plat = mysqli_fetch_array($presult)) {
					$platformname = $plat["GamePlatformName"];
				}

                echo '
                <tr>
                    <td>' . $fullname . '</td>
					<td>' . $remote . '</td>
					<td>' . $platformname . '</td>
                </tr>';
            }
            echo '
            </div>
            </table>';
		
			echo '<script src="./js/view_attendanceDateType.js"></script>';
require 'footer.php';
?>


<!--
    
To Do:

1. Populate drop down list with events by date (includes event name and date) DONE

2. Show attendees for event

3. Order attendees by attendence type (isRemote y/n)


-->