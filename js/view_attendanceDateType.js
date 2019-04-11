var selected = document.querySelector('select');

selected.addEventListener('change', function () {
	location = this.value
	//save value from selected
	localStorage.setItem('selected',this.value);
});

window.addEventListener('load',function(){
	var val = localStorage.getItem('selected');
	if (val){
		selected.value = val;
	}else {
		return false;
	}
})
