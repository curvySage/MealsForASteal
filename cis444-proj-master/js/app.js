var upVote = "../img/voting/upvote-selected.svg";
var downVote = "../img/voting/downvote-selected.svg";

function up(clicked_id){
var upImage = document.getElementById(clicked_id);

	if(upVote == "../img/voting/upvote-selected.svg"){
		upImage.src = "../img/voting/upvote-selected.svg";
		upVote = "../img/voting/upvote-not-selected.svg";
	}
	else if(upVote == "../img/voting/upvote-not-selected.svg"){
		upImage.src = "../img/voting/upvote-not-selected.svg";
		upVote = "../img/voting/upvote-selected.svg";
	}
}

function down(clicked_id){
var downImage = document.getElementById(clicked_id);

	if(downVote == "../img/voting/downvote-selected.svg"){
		downImage.src = "../img/voting/downvote-selected.svg";
		downVote = "../img/voting/downvote-not-selected.svg";
	}
	else if(downVote == "../img/voting/downvote-not-selected.svg"){
		downImage.src = "../img/voting/downvote-not-selected.svg";
		downVote = "../img/voting/downvote-selected.svg";
	}
}

function loadImg(){
	var image = document.getElementById("photo");
	image.src = ""
}

function addItem(){
	var elem = document.getElementById("list");
	elem.innerHTML += document.getElementById("items").value + "\n";
}

function removeItem(){
	var allTxt = document.getElementById("list");
	var rmTxt = document.getElementById("items");
	
	allTxt.value = allTxt.value - rmTxt.value;	
	}
	
function clearAll(){
	var title = document.getElementById("title");
	var item = document.getElementById("items");
	var list = document.getElementById("list");
	
	title.value = "";
	item.value = "";
	list.value = "";
}