var selected = document.querySelector('select');
var view = document.querySelector('aside')
var tables = ['Player', 'Status', 'Attendee', 'Event', 'EventType', 'Location', 'Game', 'Genre', 'GamePlatform', 'Stream', 'StreamPlatform', 'User'];
var redirect = document.querySelector('#redirect').value;

function showTable(){
	//get value from input
	var tableID = selected.value.toString();
	//use that value to query
	for ( var i = 0; i < tables.length; i++){
		var hided = document.getElementById(tables[i]);
		var display = document.getElementById(tableID);
		if (tableID == tables[i]){
			display.style.display = 'unset';
		} else{
			hided.style.display = 'none';
		}
	}
	//show select table
}

function cleaner(){
	view.innerHTML = '';
}

selected.addEventListener('change', function () {
	//save value from selected
	localStorage.setItem('selected',this.value);
	showTable();
	cleaner();
	
});

window.addEventListener('load',function(){
	var val = localStorage.getItem('selected');
	if (val && redirect == false){
		selected.value = val;
		showTable();
	}else if (redirect){
		showTable();
	}
})