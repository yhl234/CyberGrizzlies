<?php 
	//start file
	require 'head.php';
?>
<!-- HTML header and form start -->
<h1>Add an attendee:</h1>
<form action="add_attendance.php" method="post">
	<label for="userId">User:</label>

	<!-- Start php -->
	<?php
		// require 'connect.php';
		// This will order all the option in the dropdown by date of creation (probably the most useful)
		$sql = "SELECT userId, username, firstname, lastname FROM User ORDER BY userId";
		$users = mysqli_query($conn, $sql);
		// Start the user select box
		echo '<select id="userId" name="userId" required>';
		// Echo out all the users as options
		while ($user = mysqli_fetch_array($users)) {
			$userId = $user['userId'];
			$uname = $user['username'];
			$fname = $user['firstname'];
			$lname = $user['lastname'];
			echo '<option value="' . $userId . '">' . $uname . ' (' . $fname . ' ' . $lname . ')</option>';
		}
		// End of users select box
		echo '</select>';
		
		// Event label
		echo '<br /><label for="eventId">Event:</label>';
		
		// Orders all events by date happening
		$sql = "SELECT eventId, eventname, eventdatetime FROM Event ORDER BY eventdatetime";
		$events = mysqli_query($conn, $sql);

		// Start event select box
		echo '<select id="eventId" name="eventId" required>';

		while ($event = mysqli_fetch_array($events)) {
			$eventId = $event['eventId'];
			$ename = $event['eventname'];
			$etime = $event['eventdatetime'];

			// Convert the full datetime to just the date (time isn't super necessary)
			$dt = new DateTime($etime);
			$date = $dt->format('m/d/Y');
			echo '<option value="' . $eventId . '">' . $ename . ' - ' . $date . '</option>';
		}
		// End user select 
		echo '</select>';

		// Status label
		echo '<br /><label for="statusId">Player status:</label>';

		// Orders all the statuses alphabetically by status name
		$sql = "SELECT statusId, statusname FROM status ORDER BY statusname";
		$statuses = mysqli_query($conn, $sql);

		// Start status select box
		echo '<select id="statusId" name="statusId" required>';

		while ($status = mysqli_fetch_array($statuses)) {
			$statusId = $status['statusId'];
			$sname = $status['statusname'];

			echo '<option value="' . $statusId . '">' . $sname . '</option>';
		}
		// Add "other" option, will trigger opening subform
		echo '<option value=-1>Other</option>';
		// End status select box
		echo '</select>';

		// Add new status subform, default hidden
		echo '<div id="statusSubForm" class="hidden">';
		// Subform consists only of label and text field
		echo '<br /><label for="newStatus">New Status:</label>';
		echo '<input type="text" name="newStatus" id="newStatus"/>';
		// End status subform
		echo '</div>';

		echo '<br /><label for="isRemote">Attending remotely:</label>';
		echo '<input type="checkbox" name="isRemote" id="isRemote" />';

		// Platform label
		echo '<br /><label for="platformId">Platform:</label>';

		// Orders platforms alphabetically
		$sql = "SELECT gameplatformId, gameplatformname FROM gameplatform ORDER BY gameplatformname";
		$platforms = mysqli_query($conn, $sql);

		// Start of platform select box
		echo '<select id="platformId" name="platformId" required>';

		// Insert default empty entry?
		// echo '<option disabled selected value=""> -- select an option -- </option>';

		while ($platform = mysqli_fetch_array($platforms)) {
			$platformId = $platform['gameplatformId'];
			$pname = $platform['gameplatformname'];

			echo '<option value="' . $platformId . '">' . $pname . '</option>';
		}
		// End platform select
		echo '</select>';
	
		// Form submit button
		echo '<br /><input type="submit" value="Submit" />';

	//End form
	echo '</form>';
	// Include script to handle subform hiding
	echo '<script src="js/attendance.js"></script>';
	//End file
	require 'footer.php';
	?>
