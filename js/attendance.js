var sForm = document.getElementById("statusSubForm");
var statusCB = document.getElementById("statusId");


statusCB.onchange = function () {
	if (statusCB.value == -1)
	{
		sForm.className = "";
		console.log("status subform revealed");
	}
	else
	{		
		sForm.className = "hidden";
		console.log("status subform hidden");
	}
};