var gameCB = document.getElementById("gameId");
var gameSub = document.getElementById("gameSubForm");

var genreCB = document.getElementById("genreId");
var genreSub = document.getElementById("genreSubForm");

var statusCB = document.getElementById("statusId");
var statusSub = document.getElementById("statusSubForm");

var platCB = document.getElementById("platformId");
var platSub = document.getElementById("platformSubForm");

UpdateGame();
UpdateGenre();
UpdateStatus();
UpdatePlat();

gameCB.onchange = UpdateGame;
genreCB.onchange = UpdateGenre;
statusCB.onchange = UpdateStatus;
platCB.onchange = UpdatePlat;

function UpdateGame () {
	if (gameCB.value == -1)
	{
		gameSub.className = "";
	}
	else
	{		
		gameSub.className = "hidden";
	}
}

function UpdateGenre () {
	if (genreCB.value == -1)
	{
		genreSub.className = "";
	}
	else
	{		
		genreSub.className = "hidden";
	}
}

function UpdateStatus () {
	if (statusCB.value == -1)
	{
		statusSub.className = "";
	}
	else
	{		
		statusSub.className = "hidden";
	}
}

function UpdatePlat () {
	if (platCB.value == -1)
	{
		platSub.className = "";
	}
	else
	{		
		platSub.className = "hidden";
	}
}

