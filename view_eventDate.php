<?php 
	//start file
	require 'head.php';
?>
<h1>Events by Date</h1>
<!-- Events by date (past and/or future/upcoming)
-->
<!-- 
	all  EventDateTime > 0
	past EventDateTime < CURRENT_TIMESTAMP()
	future EventDateTime > CURRENT_TIMESTAMP()
	upcoming EventDateTime > CURRENT_TIMESTAMP()AND EventDateTime < DATE_ADD(CURRENT_TIMESTAMP(),INTERVAL 10 DAY)
 -->
 <nav>
	 <ul>
		 <li><a href="view_eventDate.php?date=All">All Events</a></li>
		 <li><a href="view_eventDate.php?date=Past">Past Events</a></li>
		 <li><a href="view_eventDate.php?date=Future">Future Events</a></li>
		 <li><a href="view_eventDate.php?date=Upcoming">Upcoming Events in 10 days</a></li>
	 </ul>
 </nav>
 <table>
	<th>Event Date</th>
	<th>Event Name</th>
	<th>Event Type</th>
	<th>Event Location</th>
	<th>Event Description</th>
<?php 
	$where = $_GET['date'];
	if ($where == 'Past'){
		$sql = "SELECT EventDateTime, EventName, EventTypeName, LocationName, EventDescription 
		FROM EVENT NATURAL JOIN EventType NATURAL JOIN Location
		WHERE EventDateTime < CURRENT_TIMESTAMP()
		ORDER BY EventDateTime";
	}else if ($where == 'Future'){
		$sql = "SELECT EventDateTime, EventName, EventTypeName, LocationName, EventDescription 
		FROM EVENT NATURAL JOIN EventType NATURAL JOIN Location
		WHERE EventDateTime > CURRENT_TIMESTAMP()
		ORDER BY EventDateTime";
	}else if ($where == 'Future'){
		$sql = "SELECT EventDateTime, EventName, EventTypeName, LocationName, EventDescription 
		FROM EVENT NATURAL JOIN EventType NATURAL JOIN Location
		WHERE EventDateTime > CURRENT_TIMESTAMP()
		ORDER BY EventDateTime";
	}else if ($where == 'Upcoming'){
		$sql = "SELECT EventDateTime, EventName, EventTypeName, LocationName, EventDescription 
		FROM EVENT NATURAL JOIN EventType NATURAL JOIN Location
		WHERE EventDateTime > CURRENT_TIMESTAMP()AND EventDateTime < DATE_ADD(CURRENT_TIMESTAMP(),INTERVAL 10 DAY)
		ORDER BY EventDateTime";
	}else{
		$sql = "SELECT EventDateTime, EventName, EventTypeName, LocationName, EventDescription 
		FROM EVENT NATURAL JOIN EventType NATURAL JOIN Location
		WHERE EventDateTime > 0 
		ORDER BY EventDateTime";
	}
	
	
	$result = mysqli_query($conn, $sql);
	foreach ($result as $row) {
			$EventDateTime = $row['EventDateTime'];
			$EventName = $row['EventName'];
			$EventTypeName = $row['EventTypeName'];
			$LocationName = $row['LocationName'];
			$EventDescription = $row['EventDescription'];
			echo '
			<tr>
				<td>' . $EventDateTime . '</td>
				<td>' . $EventName . '</td>
				<td>' . $EventTypeName . '</td>
				<td>' . $LocationName . '</td>
				<td>' . $EventDescription . '</td>
			</tr>';
		}
	
?>
</table>
<?php require 'footer.php'; ?>
