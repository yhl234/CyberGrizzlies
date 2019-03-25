<?php 
	//start file
	require 'header.php';
?>
<!-- HTML header and form start -->
<header>
<h1>Add an event:</h1>
</header>
<main>
<form action="add_event.php" method="get">

	<label for="eventName">Event title:</label>
	<input type="text" id="eventName" name="eventName" />
	<br /><label for="eventType">Event type:</label>

	<!-- Start php -->
	<?php
		$sql = "SELECT typeid, typename FROM eventstype ORDER BY typename";
		$types = mysqli_query($conn, $sql);

		echo '<select id="eventType" name="eventType" required>';

		while ($type = mysqli_fetch_array($types)) {
			$typeId = $type['typeid'];
			$tname = $type['typename'];
			echo '<option value="' . $typeId . '">' . $tname . '</option>';
		}
		echo '<option value="-1">Other</option>';
		// End of type select box
		echo '</select>';
		
		echo '
		<div id="typeSubForm" class="hidden">
			<label for="newType">New event type:</label>
			<input type="text" name="newType" id="newType" />
		</div>';

		echo '<br /><label for="eventDate">Event date:</label>';
		echo '<input type="date" id="eventDate" name="eventDate" /><input type="time" name="eventTime" id="eventTime" />';
		
		echo '<br /><label for="locationId">Location:</label>';


		
		$sql = "SELECT locationid, locationname FROM locations ORDER BY locationid";
		$locs = mysqli_query($conn, $sql);

		echo '<select id="locationId" name="locationId" required>';

		while ($loc = mysqli_fetch_array($locs)) {
			$locId = $loc['locationid'];
			$lname = $loc['locationname'];
			echo '<option value="' . $locId . '">' . $lname . '</option>';
		}
		echo '<option value="-1">Other</option>';	
		// End of type select box
		echo '</select>';

		echo '
		<div id="locSubForm" class="hidden">
			<label for="newLocName">New location name:</label>
			<input type="text" name="newLocName" id="newLocName" />
			<br /><label for="newLocAddr">New location address:</label>
			<input type="text" name="newLocAddr" id="newLocAddr" />
		</div>';

		echo '<br /><label for="eventDesc">Event Description</label>';
		echo '<textarea id="eventDesc" name="eventDesc"></textarea>';

		// Form submit button
		echo '<br /><input type="submit" value="Submit" />';

	//End form
	echo '</form>';
	// Include script to handle subform hiding
  echo '<script src="js/event.js"></script>';
	//End file
	require 'footer.php';
	?>
