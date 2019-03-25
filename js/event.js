var locCB = document.getElementById("locationId");
var typeCB = document.getElementById("eventType");
var locForm = document.getElementById("locSubForm");
var typeForm = document.getElementById("typeSubForm");

typeCB.onchange = function () {
	if (typeCB.value == -1)
	{
		typeForm.className = "";
		console.log("type subform revealed");
	}
	else
	{		
		typeForm.className = "hidden";
		console.log("type subform hidden");
	}
};

locCB.onchange = function () {
	if (locCB.value == -1)
	{
		locForm.className = "";
		console.log("location subform revealed");
	}
	else
	{		
		locForm.className = "hidden";
		console.log("location subform hidden");
	}
};