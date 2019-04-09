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
	echo '</select>';


	$sql = "";

		if ($query) {
			$sql = "SELECT username, isremote FROM Attendee INNER JOIN user WHERE `EventID` = $eventId ORDER BY isremote DESC, username";
            
            
            echo '<table>

            <caption>Search attendees by event date and attendence type</caption>

            <th>Attendee Username</th><th>Attendence Type</th>';
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)) {
                if ($row['isremote'] == 1){
                    $row['isremote'] = "Attending";
                }
                elseif($row['isremote'] == 0){
                    $row['isremote'] = "Not Attending";
                }
                else{
                    $row['isremote'] = "N/A";
                }
                echo '
                <tr>
                    <td>' . $row['username'] . '</td>
                    <td>' . $row['isremote'] . '</td>
                </tr>';
            }
            echo '</table>';
		}
		else {
			echo 'No events could be found!';
		}

require 'footer.php';
?>


<!--
    
To Do:

1. Populate drop down list with events by date (includes event name and date) DONE

2. Show attendees for event

3. Order attendees by attendence type (isRemote y/n)


-->