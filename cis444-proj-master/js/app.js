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
	var elem = document.getElementById("ingredient-form");
	// elem.innerHTML += document.getElementById("items").value + "\n";
	// for (var i = 0; i < 4; i++) {
 //  		elem.removeChild(elem.lastChild);
 //  	}
  	// elem.removeChild(elem.lastChild);
  	// elem.removeChild(elem.lastChild);
	elem.innerHTML += '<div class="add-ingredient-input" id="ingredients-form"><div></div><input type="text" value="" placeholder="Amount & Ingredient" class="ingredient" id = "items"></input><img src="../img/plus.svg" alt="add" onclick = "addItem();"><img src="../img/minus.svg" alt="remove" onclick = "removeItem();"></div>';
}

function removeItem(){
	var select = document.getElementById('ingredient-form');
  	select.removeChild(select.lastChild);
	// var allTxt = document.getElementById("list");
	// var rmTxt = document.getElementById("items");
	
	// allTxt.value = allTxt.value - rmTxt.value;	
	}
	
function clearAll(){
	var title = document.getElementById("title");
	var item = document.getElementById("items");
	var list = document.getElementById("list");
	
	title.value = "";
	item.value = "";
	list.value = "";
}