<?php 
	//start file
	require 'head.php';
?>
<!-- HTML header and form start -->
<h1>create user</h1>
<form action="add_user.php" method="post">

	<label for="userName">Username:*</label>
	<input type="text" autofocus id="userName" name="userName" required/>
	<br />
	<label for="firstName">First Name:</label>
	<input type="text" id="firstName" name="firstName" />
	<label for="middleName">Middle Name:</label>
	<input type="text" id="middleName" name="middleName" />
	<label for="lastName">Last Name:</label>
	<input type="text" id="lastName" name="lastName" />
	<label for="startDAte">Start Date:*</label>
    <input type="date" id="startDate" name="startDate" required/>
	<label for="active">Currently Active:*</label>
	<input type="checkbox" name="active" id="active" required checked/>
	<label for="payStatus">Pay Status:*</label>
	<input type="checkbox" name="payStatus" id="payStatus" required/>
	<label for="email">Email:*</label>
	<input type="text" id="email" placeholder="Email Address" name="email" />
	<label for="phone">Phone Number:</label>
	<input id="phone" name="phone" type="tel" required pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="xxx-xxx-xxxx" />











	<!-- Start php -->
	<?php
		$sql = "SELECT eventtypeid, eventtypename FROM eventtype ORDER BY eventtypename";
		$types = mysqli_query($conn, $sql);

		echo '<select id="eventType" name="eventType" required>';

		while ($type = mysqli_fetch_array($types)) {
			$typeId = $type['eventtypeid'];
			$tname = $type['eventtypename'];
			echo '<option value="' . $typeId . '">' . $tname . '</option>';
		}
		echo '<option value="-1">Other</option>';
		// End of type select box
		echo '</select>';
		
		echo '
		<div id="typeSubForm" class="hidden">
			<label for="newType">New Event</label>
			<input type="text" name="newType" id="newType" />
		</div>';

		echo '<br /><label for="eventDate">Event date:</label>';
    echo '<input type="date" id="eventDate" name="eventDate" />
          <input type="time" name="eventTime" id="eventTime" />';
		
		echo '<br /><label for="locationId">Location:</label>';


		
		$sql = "SELECT locationid, locationname FROM location ORDER BY locationid";
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
