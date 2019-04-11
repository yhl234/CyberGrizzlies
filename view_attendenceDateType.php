<?php 
	//start file
	require 'head.php';
?>
<!-- HTML header and form start -->
<h1>Attendees by date and type</h1>

<?php 

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
			echo '<option value="view_attendenceDateType.php?id=' . $eventId . '">' . $eventName . ' (' . $eventDateTime . ')</option>';
	}
  echo '
  </div>
  </select>';
	$id = $_GET['id'];

	$sql = "SELECT username, firstname, lastname, isremote FROM Attendee INNER JOIN user WHERE `EventID` = $id";
            
            
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

require 'footer.php';
?>
<script src="js/view_attendenceDateType.js" defer></script>

<!--
    
To Do:

1. Table is showing duplicate attendees, where is the issue coming from?


-->