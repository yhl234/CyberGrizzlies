var selected = document.querySelector('select');

function showTable(){
	//get value from input
	var tableID = selected.value.toString();
	//use that value to query
	var tableName = document.getElementById(tableID);
	//show select table
	tableName.style.display = 'unset';
}
selected.addEventListener('input', function () {
	showTable();
});