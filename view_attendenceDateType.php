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

  echo '
  <div>
  <label for="EventId">Events:</label>';
	$sql = "SELECT EventId, EventName, EventDateTime FROM Event ORDER BY EventDateTime";
	$events = mysqli_query($conn, $sql);
	// Start the event select box
	echo '<select id="EventId" name="EventId" required>';
	// Echo out all the events as options
	while ($event = mysqli_fetch_array($events)) {
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
  echo '
  </div>
  </select>';


	$sql = "";

		if ($query) {
			$sql = "SELECT username, firstname, lastname, isremote FROM Attendee INNER JOIN user WHERE `EventID` = $eventId";
            
            
            echo '
            <div>
            <table>
            

            <th>Attendee Id</th><th>Attendee Username</th><th>First Name</th><th>Last Name</th><th>Attendence Type</th>';
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
                    <td>' . $row['attendeeid'] . '</td>
                    <td>' . $row['username'] . '</td>
                    <td>' . $row['firstname'] . '</td>
                    <td>' . $row['lastname'] . '</td>
                    <td>' . $row['isremote'] . '</td>
                </tr>';
            }
            echo '
            </div>
            </table>';
		}
		else {
			echo 'No events could be found!';
		}

require 'footer.php';
?>


<!--
    
To Do:

1. Table is showing duplicate attendees, where is the issue coming from?


-->