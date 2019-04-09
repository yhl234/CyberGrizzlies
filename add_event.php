<?php 
require 'head.php';

	$name = $_POST['eventName'];
	$typeId = $_POST['eventType'];
	$date = $_POST['eventDate'];
	$time = $_POST['eventTime'];
	$locationId = $_POST['locationId'];
	$desc = $_POST['eventDesc'];

	$newEventType = "";
	$newLocName = "";
	$newLocAddr = "";

	$addNewType = false;
	$addNewLocation = false;
	// If "other" was selected, grab the newly entered status
	if($typeId == -1) {
		$addNewType = true;
		$newEventType = $_POST['newType'];
	}

	if ($locationId == -1) {
		$addNewLocation = true;
		$newLocName = $_POST['newLocName'];
		$newLocAddr = $_POST['newLocAddr'];
	}

	// Initialize validation variables
	$ok = true;
	$errormsg = "Uncaught error.";

	// Validation
	if (empty($name)) {
		$ok = false;
		$errormsg = "Please enter a name for the event.";
	}
	if (empty($date)) {
		$ok = false;
		$errormsg = "Please enter a date for the event.";
	}
	if (empty($time)) {
		$ok = false;
		$errormsg = "Please enter a time for the event.";
	}
	if (empty($desc)) {
		$ok = false;
		$errormsg = "Please enter a description for the event.";
	}
	// If they selected a new status and didn't fill it out
	if ($addNewType) {
		if (empty($newEventType) || strlen($newEventType) > 32) {
			$ok = false;
			$errormsg = "Please enter a new event name under 32 characters in length.";
		}
	}
	if ($addNewLocation) {
		if (empty($newLocAddr) || empty($newLocName) || strlen($newLocAddr) > 64 || strlen($newLocName) > 32) {
			$ok = false;
			$errormsg = "Please enter a location name under 32 characters and an address under 64 characters.";
		}

		$locNameSql = "SELECT locationId FROM location WHERE locationname = '" . $newLocName . "';";
		if (mysqli_query($conn, $locNameSql)->num_rows > 0)
		{
			$ok = false;
			$errormsg = "New location already exists! Please select it from the dropdown.";
		}
	}

	

	if ($ok) {
		if ($addNewType)
		{
			$typeSql = "INSERT INTO eventType (eventtypename) VALUES ('" . $newEventType . "');";
			if (mysqli_query($conn, $typeSql)) {
				//Confirm with the user
				echo '<p>New event type created successfully.</p>';

				$typeId = mysqli_insert_id($conn);
			}
			else {
				echo '<p>Error creating new event type.</p>';
			}
		}

		if ($addNewLocation)
		{
			$locSql = "INSERT INTO location (locationName, locationAddress) VALUES ('" . $newLocName . "', '" . $newLocAddr . "');";
			if (mysqli_query($conn, $locSql)) {
				echo '<p>New location created successfully.</p>';
				$locationId = mysqli_insert_id($conn);
			}
			else {
				echo '<p>Error creating new location.</p>';
			}
		}

		$datetime = $date . " " . $time;

		$eventSql = "INSERT INTO event (eventName, eventTypeId, eventdatetime, locationId, eventDescription) VALUES ('" . $name . "', " . $typeId . ", '" . $datetime . "', " . $locationId . ", '" . $desc . "');";
		if (mysqli_query($conn, $eventSql)) {
			//Confirm with the user
			$eventId = mysqli_insert_id($conn);
			echo '<p>Event created successfully.</p>';
			echo '<p>You will be redirected to the new event in 3 seconds...</p>';
			header( "refresh:3;url=./update.php?id=" . $eventId . "&table=Event&mode=view" );
		}
		else {
			echo '<p>Error creating new event.</p>';
			echo '<p>' . $errormsg . '</p>';
		}
	}
	else {
		echo '<p>' . $errormsg . '</p>';
	}

require 'footer.php';
?>