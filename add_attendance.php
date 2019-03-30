<?php 
require 'head.php';

	$userId = $_POST['userId'];
	$eventId = $_POST['eventId'];
	$statusId = $_POST['statusId'];
	$newStatus = "";
	$isRemote = $_POST['isRemote'];
	$platformId = $_POST['gameplatformid'];
	$addNewStatus = false;
	// If "other" was selected, grab the newly entered status
	if($statusId == -1)
	{
		$addNewStatus = true;
		$newStatus = $_POST['newStatus'];
	}

	if ($isRemote == "on") {
		$isRemote = 1;
	}
	else {
		$isRemote = 0;
	}

	// Initialize validation variables
	$ok = true;
	$errormsg = "Uncaught error.";

	// Validation
	if (empty($userId)) {
		$ok = false;
		$errormsg = "Please select a user.";
	}
	if (empty($eventId)) {
		$ok = false;
		$errormsg = "Please select an event.";
	}
	if (empty($statusId)) {
		$ok = false;
		$errormsg = "Please select a status, or enter a new status.";
	}
	// If they selected a new status and didn't fill it out
	if ($addNewStatus) {
		if (empty($newStatus) || strlen($newStatus) > 12) {
			$ok = false;
			$errormsg = "Please enter a unique new status under 12 characters in length.";
		}
	}
	$statusnamesSql = "SELECT statusname FROM status WHERE statusname = '" . $newStatus . "';";
	if (mysqli_query($conn, $statusnamesSql)->num_rows > 0)
	{
		$ok = false;
		$errormsg = "New status already exists! Please select it from the dropdown.";
	}
	if (empty($platformId)) {
		$ok = false;
		$errormsg = "Please select a gaming platform.";
	}

	if ($ok) {
		// If they entered a new status, insert that first
		if ($addNewStatus)
		{
			$statusSql = "INSERT INTO status (statusname) VALUES ('" . $newStatus . "');";
			if (mysqli_query($conn, $statusSql)) {
				//Confirm with the user
				echo '<p>Status created successfully.</p>';

				$statusId = mysqli_insert_id($conn);
			}
			else {
				echo '<p>Error creating new status.</p>';
			}
		}

		$attendSql = "INSERT INTO attendee (userId, eventId, statusId, isRemote, gameplatformId) VALUES (" . $userId . ", " . $eventId . ", " . $statusId . ", " . $isRemote . ", " . $platformId . ");";
		if (mysqli_query($conn, $attendSql)) {
			//Confirm with the user
			echo '<p>Attendee created successfully.</p>';
		}
		else {
			echo '<p>Error creating new attendee.</p>';
			echo '<p>' . $errormsg . '</p>';
		}
	}
	else {
		echo '<p>' . $errormsg . '</p>';
	}

require 'footer.php';
?>