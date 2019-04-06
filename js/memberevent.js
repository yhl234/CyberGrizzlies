var user = document.getElementById("userId");
var sDate = document.getElementById("startDate");
var eDate = document.getElementById("endDate");
console.log(sDate);


user.addEventListener("change", Update);
sDate.onchange = Update;
eDate.onchange = Update;


function Update () {
	window.location.replace("./view_memberevent.php?userId=" + user.value + "&startDate=" + sDate.value + "&endDate=" + eDate.value);
}