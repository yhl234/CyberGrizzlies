<?php 
require 'head.php';

	$username = $_POST['userName'];
	$fname = $_POST['firstName'];
	$mname = $_POST['middleName'];
	$lname = $_POST['lastName'];
	$date = $_POST['startDate'];
	$active = $_POST['active'];
	$pay = $_POST['payStatus'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$chat = $_POST['chatStatus'];
	$discord = $_POST['discord'];

	$ok = true;
	$errormsg = "Uncaught error.";

	// String validation
	if (empty($username) || strlen($username) > 24) {
		$ok = false;
		$errormsg = "Please enter a new username under 24 characters long.";
	}
	if (strlen($fname) > 24) {
		$ok = false;
		$errormsg = "Please enter a first name under 24 characters long.";
	}
	if (strlen($mname) > 24) {
		$ok = false;
		$errormsg = "Please enter a middle name under 24 characters long.";
	}
	if (strlen($lname) > 24) {
		$ok = false;
		$errormsg = "Please enter a last name under 24 characters long.";
	}
	if (strlen($email) > 64) {
		$ok = false;
		$errormsg = "Please enter an email under 64 characters long.";
	}
	if (strlen($phone) > 13) {
		$ok = false;
		$errormsg = "Please enter a phone number under 13 characters long.";
	}
	if (strlen($discord) > 64) {
		$ok = false;
		$errormsg = "Please enter a Discord tag under 64 characters long.";
	}

	// Empty string to null conversion
	if ($fname == "") {
		$fname = null;
	}
	if ($mnmae == "") {
		$mname = null;
	}
	if ($lname == "") {
		$lname = null;
	}
	if ($email == "") {
		$email = null;
	}
	if ($phone == "") {
		$phone = null;
	}
	if ($discord == "") {
		$discord = null;
	}

	// Checkbox conversion
	if ($active == "on") {
		$active = 1;
	}
	else {
		$active = 0;
	}
	if ($pay == "on") {
		$pay = 1;
	}
	else {
		$pay = 0;
	}
	if ($chat == "on") {
		$chat = 1;
	}
	else {
		$chat = 0;
	}

	// User validation complete

	// This is redundant having two identical loops, but ALL of the validation needs to be done first, because this form is the only access to the stream and streamplatform tables, so if any part of it fails, it ALL has to fail
	$streamCount = $_POST['streamCount'];
	if ($streamCount > 0) {
		// For each stream entered, submit it
		for ($i = 1; $i <= $streamCount; $i++) {
			$platformId = $_POST['streamPlatform' . $i];
			$url = $_POST['streamUrl' . $i];

			// Per stream validation
			if(strlen($url) > 100) {
				$ok = false;
				$errormsg = "Please enter a stream URL under 100 characters for stream " . $streamCount . ".";
			}

			if ($platformId == -1)
			{
				$newPlatform = $_POST['newPlatform' . $i];

				if (strlen($newPlatform) > 12)
				{
					$ok = false;
					$errormsg = "Please enter a streaming platform name under 12 characters for new streaming platform under stream " . $streamCount . ".";
				}
			}
		}
	}

	$userId = 0;
	if ($ok)
	{
		// Users must be submitted first to generate the userId for the streaming table
		$sql = "INSERT INTO user 
		(username, firstname, middlename, lastname, startdate, activestatus, paystatus, email, phone, chatstatus, discordtag)
		VALUES ( '" . $username . "', '" . $fname . "', '" . $mname . "', '" . $lname . "', '" . $date . "', '" . $active . "', '" . $pay . "', '" . $email . "', '" . $phone . "', '" . $chat . "', '" . $discord . "');";
		if (mysqli_query($conn, $sql)) {
			echo "<p>New user " . $username . " created successfully.</p>";
			$userId = mysqli_insert_id($conn);
		}
		else {
			$ok = false;
			echo "<p>Could not create new user.</p>";
			echo "<p>" . $errormsg . "</p>";
		}
	}
	
	if (($streamCount > 0) && $ok) 
	{
		// For each stream entered, submit it
		for ($i = 1; $i <= $streamCount; $i++) 
		{
			echo $i;
			$platformId = $_POST['streamPlatform' . $i];
			$url = $_POST['streamUrl' . $i];

			// Add new stream platform if necessary
			if ($platformId == -1)
			{
				$newPlatform = $_POST['newPlatform' . $i];

				if ($ok)
				{
					$sql = "INSERT INTO StreamPlatform (streamplatformname) VALUES ('" . $newPlatform . "');";
					if (mysqli_query($conn, $sql)) {
						echo '<p>New stream platform ' . $newPlatform . ' created successfully.</p>';
						$platformId = mysqli_insert_id($conn);
					}
					else {
						$ok = false;
						echo '<p>Error creating new stream platform.</p>';
					}
				}
			}

			if ($ok) {
				$sql = "INSERT INTO stream (streamlink, userid, streamplatformid) VALUES ('" . $url . "', '" . $userId . "', '" . $platformId . "');";
				if (mysqli_query($conn, $sql)) {
				}
			}
			else {
				echo '<p>Error creating new streaming entry ' . $streamCount . '.</p>';
				echo "<p>" . $errormsg . "</p>";
			}
		}
	}
	

require 'footer.php';
?>