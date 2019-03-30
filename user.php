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
	<label for="startDate">Start Date:*</label>
    <input type="date" id="startDate" name="startDate" value="<?php echo date('Y') . '-' . date('m') . '-' . date('d'); ?>" required/>
	<label for="active">Currently Active:*</label>
	<input type="checkbox" name="active" id="active" required checked/>
	<label for="payStatus">Pay Status:*</label>
	<input type="checkbox" name="payStatus" id="payStatus" required/>
	<label for="email">Email:</label>
	<input type="email" id="email" placeholder="you@email.com" name="email" />
	<label for="phone">Phone Number:</label>
	<input id="phone" name="phone" type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="xxx-xxx-xxxx" />
	<label for="chatStatus">Active in Chat:*</label>
	<input type="checkbox" name="chatStatus" id="chatStatus" required/>
	<label for="discord">Discord Tag:</label>
	<input id="discord" name="discord" type="text" pattern="[a-z0-9._%+-]+#[0-9]{4}$" placeholder="username#0000" />

	<button id="addStream" type="button">+Add Streaming Platform</button>
	<input type="submit" value="Submit" />
	<input type="hidden" id="streamCount" value=0 />
</form>
<!-- So I was in fact a terrible person and put inline JS into the HTML, but it was the only way I could make it work -->
<?php
	$platformSql = "SELECT StreamPlatformID, StreamPlatformName FROM StreamPlatform";
	$platforms = mysqli_query($conn, $platformSql);

	$platformNames = array();
	$platformIds = array();
	while ($row = mysqli_fetch_array($platforms)) {
		$platformIds[] = $row['StreamPlatformID'];
		$platformNames[] = $row['StreamPlatformName'];
	}

	$platformNames = json_encode($platformNames);
	$platformIds = json_encode($platformIds);
?>
<script type="text/javascript">

	var platformIds = <?php echo json_encode($platformIds) ?>;
	var platformNames = <?php echo json_encode($platformNames) ?>;

	var platformIds = JSON.parse(platformIds);
	var platformNames = JSON.parse(platformNames);

	var addStream = document.getElementById("addStream");
	var streamCount = 0;
	var streamCounter = document.getElementById("streamCount");

	addStream.onclick = addStreamForm;

	function addStreamForm () {
		streamCount += 1;
		streamCounter.value = streamCount;
		var subform = document.createElement("div");
		subform.id = "stream" + streamCount + "SubForm";

		var selectLabel = document.createElement("label");
		selectLabel.setAttribute("for", "streamPlatform" + streamCount);
		selectLabel.textContent = "Stream Platform:*";
		subform.appendChild(selectLabel);

		var streamPlatform = document.createElement("select");
		streamPlatform.name = "streamPlatform" + streamCount;
		streamPlatform.required = true;
		for (var i = 0; i < platformIds.length; i++)
		{
			var option = document.createElement("option");
			option.value = platformIds[i];
			option.textContent = platformNames[i];
			streamPlatform.appendChild(option);
		}

		var option = document.createElement("option");
		option.value = -1;
		option.textContent = "Other";
		streamPlatform.appendChild(option);

		subform.appendChild(streamPlatform);

		// Create second level sub form here
		var platformSubform = document.createElement("div");
		platformSubform.id = "platform" + streamCount + "SubForm";
		platformSubform.className = "hidden";
		
		var newPlatformLabel = document.createElement("label");
		newPlatformLabel.for = "newPlatform" + streamCount;
		newPlatformLabel.textContent = "New Streaming Platform Name:";
		platformSubform.appendChild(newPlatformLabel);

		var newPlatform = document.createElement("input");
		newPlatform.type = "text";
		newPlatform.name = "newPlatform" + streamCount;
		newPlatform.id = newPlatform.name;
		platformSubform.appendChild(newPlatform);

		streamPlatform.onchange = function () {
			UpdateSelect(streamPlatform.value, platformSubform);
		}
		subform.appendChild(platformSubform);
		// End of second level sub form

		var urlLabel = document.createElement("label");
		urlLabel.setAttribute("for", "streamUrl" + streamCount);
		urlLabel.textContent = "Stream URL:*";
		subform.appendChild(urlLabel);

		var url = document.createElement("input");
		url.type = "text";
		url.name = "streamUrl" + streamCount;
		url.id = url.name;
		subform.appendChild(url);

		document.querySelector("form").insertBefore(subform, addStream);
	}

	function UpdateSelect (val, form) {
		console.log("got to update select function");
		if (val == -1) {
			form.className = "";
			console.log("Subform revealed");
		}
		else {
			form.className = "hidden";
		}
	}

</script>
<?php require 'footer.php'; ?>
